<?php

class Email extends DatabaseObject {

	// ----- START OF ACTIVE RECORD CODE ------
	static protected $table_name = 'posts';
	static protected $db_columns = [ 'id', 'station', 'title', 'link', 'pubDate', 'imageLink', 'featured', 'position', 'category', 'excerpt', 'visible' ];

	public $id;
	public $station;
	public $title;
	public $link;
	public $pubDate;
	public $imageLink;
	public $imageThumb;
	public $featured = 0;
	public $position = 0;
	public $category;
	public $excerpt;
	public $visible;

	public const STATION = [
		1 => 'X96',
		2 => 'Mix',
		3 => 'U92',
		4 => 'Bob',
		5 => 'Eagle',
		6 => 'ESPN',
	];

	public const STATION_URL = [
		1 => 'X96',
		2 => 'Mix1051utah',
		3 => 'U92slc',
		4 => '1007bobfm',
		5 => '1015TheEagle',
		6 => 'ESPN700Sports',
	];

	public const STATION_FB = [
		1 => 'X96Music',
		2 => 'mix1051utah',
		3 => 'U92SLC',
		4 => '1007BOBFM',
		5 => '1015TheEagle',
		6 => 'ESPN700',
	];

	public const STATION_TW = [
		1 => 'X96',
		2 => 'mix1051utah',
		3 => 'U92SLC',
		4 => '1007bobfm',
		5 => '1015TheEagleUT',
		6 => 'ESPN700',
	];

	public const STATION_IG = [
		1 => 'x96fm',
		2 => 'mix1051utah',
		3 => 'U92SLC',
		4 => '1007bobfm',
		5 => '1015TheEagleUT',
		6 => 'ESPN700',
	];

	public const STATION_APP = [
		1 => 'https://itunes.apple.com/us/app/x96-kxrk/id655730921?mt=8',
		2 => 'https://apps.apple.com/us/app/mix-105-1-utah/id653652578',
		3 => 'https://apps.apple.com/us/app/u92-slc/id671489114',
		4 => 'https://apps.apple.com/us/app/rewind-100-7/id656814346',
		5 => 'https://apps.apple.com/us/app/1015-the-eagle/id653586558',
		6 => 'https://apps.apple.com/us/app/espn-700-radio/id403281568',
	];

	public const STATION_GP = [
		1 => 'https://play.google.com/store/apps/details?id=com.broadway.kxrk',
		2 => 'https://play.google.com/store/apps/details?id=com.broadwaymediagroup.kudd',
		3 => 'https://play.google.com/store/apps/details?id=com.broadwaymediagroup.kuuu',
		4 => 'https://play.google.com/store/apps/details?id=com.broadway.KYMV',
		5 => 'https://play.google.com/store/apps/details?id=com.broadway.KEGA',
		6 => 'https://play.google.com/store/apps/developer?id=Broadway+Media',
	];

	public const CATEGORY = [
		0 => 'Other',
		1 => 'News',
		2 => 'Life',
		3 => 'Contests',
		4 => 'Interviews',
		5 => 'RSL',
		6 => 'Utah Jazz',
		7 => 'University of Utah',
		8 => 'Salt Lake Stallions',
	];

	public function __construct( $args = [] ) {
		// $this->brand = isset($args['brand']) ? $args['brand'] : '';
		$this->station = $args['station'] ?? '';
		$this->title = $args['title'] ?? '';
		$this->link = $args['link'] ?? '';
		$this->pubDate = $args['pubDate'] ?? null;
		$this->imageLink = $args['imageLink'] ?? '';
		$this->featured = $args['featured'] ?? 0;
		$this->position = $args['position'] ?? 0;
		$this->category = $args['category'] ?? '';
		$this->excerpt = $args['excerpt'] ?? '';
		$this->visible = $args['visible'] ?? '';

	}

	public function station() {
		if ( $this->station > 0 ) {
			return self::STATION[ $this->station ];
		} else {
			return 'Unknown';
		}
	}

	public function category() {
		if ( $this->category ) {
			return self::CATEGORY[ $this->category ];
		} else {
			return 'Unknown';
		}
	}

	public static function find_by_date( $date ) {
		$sql = 'SELECT * FROM ' . static::$table_name . ' ';
		$sql .= "WHERE pubDate='" . self::$database->escape_string( $date ) . "'";
		$obj_array = static::find_by_sql( $sql );
		if ( ! empty( $obj_array ) ) {
			return array_shift( $obj_array );
		} else {
			return false;
		}
	}

	public static function find_by_title( $title ) {
		$sql = 'SELECT * FROM ' . static::$table_name . ' ';
		$sql .= "WHERE title='" . self::$database->escape_string( $title ) . "'";
		$obj_array = static::find_by_sql( $sql );
		if ( ! empty( $obj_array ) ) {
			return array_shift( $obj_array );
		} else {
			return false;
		}
	}

	public static function find_by_link( $link ) {
		$sql = 'SELECT * FROM ' . static::$table_name . ' ';
		$sql .= "WHERE link='" . self::$database->escape_string( $link ) . "'";
		$obj_array = static::find_by_sql( $sql );
		if ( ! empty( $obj_array ) ) {
			return array_shift( $obj_array );
		} else {
			return false;
		}
	}

	public function featured() {
		if ( $this->featured == 1 ) {
			return true;
		}
	}

	public function visible() {
		if ( $this->visible == 1 ) {
			return true;
		}
	}

	public function pubDate() {
		$date = date_create( $this->pubDate );
		$dateformat = date_format( $date, 'D d M Y h:i A' );
		return $dateformat;
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

		if ( is_blank( $this->pubDate ) ) {
			$this->errors[] = 'Date cannot be blank';
		}

		if ( is_blank( $this->imageLink ) ) {
			$this->errors[] = 'Image cannot be blank';
		}

		return $this->errors;
	}

	public static function post_query( $station, $category, $featured ) {
		$sql = 'SELECT * FROM posts ';
		$sql .= 'WHERE station=' . self::$database->escape_string( $station ) . ' ';
		$sql .= 'AND category=' . self::$database->escape_string( $category ) . ' ';
		$sql .= 'AND featured=' . self::$database->escape_string( $featured ) . ' ';
		$sql .= 'AND visible=1 ';
		$sql .= 'ORDER BY position = 0, position, pubDate DESC ';
		$sql .= 'LIMIT 5 ';
		$results = self::find_by_sql( $sql );
		return $results;
	}

	public function get_posts( $station, $category ) {
		global $user;
		global $pagination;
		global $per_page;

		$sql = '(SELECT * FROM posts ';
		$sql .= 'WHERE station=' . self::$database->escape_string( $station ) . ' ';
		$sql .= 'AND category=' . self::$database->escape_string( $category ) . ' ';
		$sql .= 'AND visible=1 ';
		$sql .= 'AND NOT featured=1 ';
		$sql .= 'ORDER BY pubDate DESC ';
		$sql .= 'LIMIT 10) ';
		$sql .= 'UNION (SELECT * FROM posts ';
		$sql .= 'WHERE station=' . self::$database->escape_string( $station ) . ' ';
		$sql .= 'AND category=' . self::$database->escape_string( $category ) . ' ';
		$sql .= 'AND visible=0 ';
		$sql .= 'AND NOT featured=1 ';
		$sql .= 'ORDER BY pubDate DESC ';
		$sql .= 'LIMIT 5) ';
		$sql .= 'ORDER BY pubDate DESC ';
		// $sql .= "LIMIT {$per_page} ";
		$results = self::find_by_sql( $sql );

		// if (!$results) {
		// return false;
		// }
		$category = $this->category(); ?>

	<div class="table-responsive">
	  <table class="list table">
		<tr>
		  <th>Title</th>
		  <th>Category</th>
		  <th>Publish Date</th>
		  <th>Position</th>
		  <th>Featured</th>
		  <th>Visible</th>
		  <th>&nbsp;</th>
			<?php if ( $user->is_admin() ) { ?>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
		<?php } ?>
		</tr>
		  <?php foreach ( $results as $post ) { ?>
		  <tr>
			<form action="<?php echo 'index.php?id=' . h( u( $post->id ) ) . '&station=' . $station; ?>" >
			  <td><?php echo hd( $post->title ); ?></td>
			  <td class="align-middle">
				<select name="post[category]">
				  <option value=""></option>
				  <?php
					foreach ( self::CATEGORY as $category_id => $category_name ) {
						if ( $station != 6 ) {
							if ( $category_id > 3 ) {
								break;
							}
						}
						?>
				  <option value="<?php echo $category_id; ?>"
											<?php
											if ( $post->category == $category_id ) {
												echo 'selected'; }
											?>
					><?php echo $category_name; ?></option>
					<?php } ?>
				</select>
			  </td>
			  <td><?php echo h( $post->pubDate() ); ?></td>
			  <td><input type="number" name="post[position]" value="<?php echo h( $post->position ); ?>" min="1" max="10" /></td>
			  <td class="text-center align-middle">
				<input type="hidden" name="post[featured]" value="0" />
				<input type="checkbox" name="post[featured]" value="1"
				<?php
				if ( $post->featured() ) {
					echo ' checked'; }
				?>
				 />
			  </td>
			  <td class="text-center align-middle">
				<input type="hidden" name="post[visible]" value="0" />
				<input type="checkbox" name="post[visible]" value="1"
				<?php
				if ( $post->visible() ) {
					echo ' checked'; }
				?>
				 />
			  </td>
			  <td class="align-middle"><a class="action" href="<?php echo $post->link; ?>" target="_blank">View</a></td>
				<?php if ( $user->is_admin() ) { ?>
			  <td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/emails/edit.php?id=' . h( u( $post->id ) ) . '&station=' . h( u( $post->station ) ) ); ?>">Edit</a></td>
			  <td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/emails/delete.php?id=' . h( u( $post->id ) ) . '&station=' . h( u( $post->station ) ) ); ?>">Delete</a></td>
			  <td class="align-middle"><input type="submit" value="Update" /></td>
				<?php } ?>
			</form>
			</tr>
		<?php } ?>
		</table>
	</div><!-- $category posts -->
		<?php
	}

	public function contest_posts( $station ) {
		global $user;
		$sql = 'SELECT * FROM posts ';
		$sql .= 'WHERE station=' . self::$database->escape_string( $station ) . ' ';
		$sql .= 'AND category=3 ';
		$sql .= 'ORDER BY pubDate DESC ';
		$contests = self::find_by_sql( $sql );
		?>

	<div class="table-responsive">
	  <table class="list table">
		<tr>
		  <th>Title</th>
		  <th>Category</th>
		  <th>Publish Date</th>
		  <th>Position</th>
		  <th>Featured</th>
		  <th>&nbsp;</th>
			<?php if ( $user->is_admin() ) { ?>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
		<?php } ?>
		</tr>
		  <?php foreach ( $contests as $post ) { ?>
		  <tr>
			<form action="<?php echo 'index.php?id=' . h( u( $post->id ) ); ?>" method="post" id="postform">
			<td><?php echo h( $post->title ); ?></td>
			<td class="align-middle">
			  <select name="post[category]">
				<option value=""></option>
				<?php foreach ( self::CATEGORY as $category_id => $category_name ) { ?>
				<option value="<?php echo $category_id; ?>"
										  <?php
											if ( $post->category == $category_id ) {
												echo 'selected'; }
											?>
				><?php echo $category_name; ?></option>
				<?php } ?>
			  </select>
			</td>
			<td><?php echo h( $post->pubDate() ); ?></td>
			<td><input type="number" name="post[position]" value="<?php echo h( $post->position ); ?>" min="1" max="10" /></td>
			<td class="text-center align-middle">
			  <input type="hidden" name="post[featured]" value="0" />
			  <input type="checkbox" name="post[featured]" value="1"
				<?php
				if ( $post->featured() ) {
					echo ' checked'; }
				?>
				 />
			</td>
			<td class="align-middle"><a class="action" href="<?php echo $post->link; ?>" target="_blank">View</a></td>
				<?php if ( $user->is_admin() ) { ?>
			<td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/posts/edit.php?id=' . h( u( $post->id ) ) ); ?>">Edit</a></td>
			<td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/posts/delete.php?id=' . h( u( $post->id ) ) ); ?>">Delete</a></td>
			<td class="align-middle"><input type="submit" value="Update" /></td>
			<?php } ?>
			</form>
			</tr>
		<?php } ?>
		</table>
	</div><!-- Contest posts -->

	<?php }

}

?>
