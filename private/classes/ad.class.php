<?php

class Ad extends DatabaseObject {

	static protected $table_name = 'ads';
	static protected $db_columns = [ 'id', 'title', 'imageLink', 'link', 'position', 'station', 'visible' ];

	public $id;
	public $title;
	public $imageLink;
	public $link;
	public $position = 1;
	public $station;
	public $visible;

	const POSITION = [
		0 => 'Below Featured',
		1 => 'Below Contests',
		2 => 'Below News',
		3 => 'Below Life',
		4 => 'Footer',
	];

	const STATION = [
		1 => 'X96',
		2 => 'Mix',
		3 => 'U92',
		4 => 'Rewind',
		5 => 'Eagle',
		6 => 'ESPN',
	];

	public function __construct( $args = [] ) {

		$this->title = $args['title'] ?? '';
		$this->imageLink = $args['imageLink'] ?? '';
		$this->link = $args['link'] ?? '';
		$this->position = $args['position'] ?? 1;
		$this->station = $args['station'] ?? 'a:0:{}';
		$this->visible = $args['visible'] ?? 1;

	}

	public function visible() {
		if ( $this->visible == 1 ) {
			return true;
		}
	}

	public function allStations() {
		$stations = unserialize( $this->station );
		return $stations;
	}

	protected function validate() {
		$this->errors = [];

		if ( ! is_unique_article( $this->link, $this->id ?? 0 ) ) {
			$this->errors[] = '1 or more articles have already been uploaded.';
		}

		if ( is_blank( $this->title ) ) {
			$this->errors[] = 'Title cannot be blank';
		}

		if ( is_blank( $this->link ) ) {
			$this->errors[] = 'Link cannot be blank';
		}

		if ( is_blank( $this->imageLink ) ) {
			$this->errors[] = 'Image cannot be blank';
		}

		if ( is_blank( $this->station ) ) {
			$this->errors[] = 'You must select at least 1 station.';
		}

		return $this->errors;
	}

	public static function ad_query( $station, $position ) {
		$sql = 'SELECT * FROM ads ';
		$sql .= 'WHERE position=' . $position . ' ';
		$sql .= 'AND visible=1 ';
		$sql .= 'ORDER BY position = 0, position, id DESC ';
		$sql .= 'LIMIT 5 ';
		$results = self::find_by_sql( $sql );

		$ads = [];

		foreach ( $results as $ad ) {
			$stationAds = $ad->allStations();
			if ( in_array( $station, $stationAds ) ) {
				$ads[] = $ad;
			}
		}

		return $ads;
	}

	public function get_ads( $station ) {

		global $user;
		global $pagination;
		global $per_page;

		$sql = '(SELECT * FROM ads ';
		$sql .= 'WHERE visible=1 ';
		$sql .= 'ORDER BY id DESC ';
		$sql .= 'LIMIT 10) ';
		$sql .= 'UNION (SELECT * FROM ads ';
		$sql .= 'WHERE visible=0 ';
		$sql .= 'ORDER BY id DESC ';
		$sql .= 'LIMIT 5) ';
		$sql .= 'ORDER BY id DESC; ';
		// $sql .= "LIMIT {$per_page} ";
		// echo $sql;
		$results = self::find_by_sql( $sql );
		// if (!$results) {
		// return false;
		// }
		?>

	<div class="table-responsive">
	  <table class="list table">
		<tr>
		  <th>Title</th>
		  <th>Stations</th>
		  <th>Position</th>
		  <th>Visible</th>
		  <th>&nbsp;</th>
		  <?php if ( $user->is_admin() ) { ?>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
		<?php } ?>
		</tr>
		<?php
		foreach ( $results as $ad ) {
			$stationAd = $ad->allStations();
			if ( in_array( $station, $stationAd ) ) :
				?>
		  <tr>
			<form action="<?php echo url_for( '/staff/ads/index.php?id=' . h( u( $ad->id ) ) . '&station=' . $station ); ?>" method="post" id="postform">
			<td><?php echo h( $ad->title ); ?></td>
			<td>
				<?php
				$stations = ( unserialize( $ad->station ) );
				$stationArray = [];
				foreach ( $stations as $id => $station_id ) {
					$stationArray[] = self::STATION[ $station_id ];
				}
				echo implode( ', ', $stationArray );
				?>
			</td>
			<td class="align-middle">
			  <select name="ad[position]">
				<option value=""></option>
				<?php foreach ( self::POSITION as $position_id => $position_name ) { ?>
				<option value="<?php echo $position_id; ?>" 
										  <?php
											if ( $ad->position == $position_id ) {
												echo 'selected'; }
											?>
				><?php echo $position_name; ?></option>
				<?php } ?>
			  </select>
			</td>
			<td class="text-center align-middle">
			  <input type="hidden" name="ad[visible]" value="0" />
			  <input type="checkbox" name="ad[visible]" value="1"
				<?php
				if ( $ad->visible() ) {
					echo ' checked'; }
				?>
				 />
			</td>
			<td class="align-middle"><a class="action" href="<?php echo $ad->imageLink; ?>" target="_blank">View</a></td>
				<?php if ( $user->is_admin() ) { ?>
			<td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/ads/edit.php?id=' . h( u( $ad->id ) ) . '&station=' . h( u( $station ) ) ); ?>">Edit</a></td>
			<td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/ads/delete.php?id=' . h( u( $ad->id ) ) . '&station=' . h( u( $station ) ) ); ?>">Delete</a></td>
			<td class="align-middle"><input type="submit" value="Update" /></td>
			<?php } ?>
			</form>
			</tr>
				<?php
		endif;
		}
		?>
		</table>
	</div><!-- $ads -->
		<?php
	}

}

?>
