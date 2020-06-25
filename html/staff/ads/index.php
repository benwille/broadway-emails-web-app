<?php

require_once( '../../../private/initialize.php' );
require_login();
require_admin();

$user = User::find_by_username( $session->username );


// Go get posts
$sql = '(SELECT * FROM ads ';
$sql .= 'WHERE visible=1 ';
$sql .= 'ORDER BY id DESC ';
$sql .= 'LIMIT 10) ';
$sql .= 'UNION (SELECT * FROM ads ';
$sql .= 'WHERE visible=0 ';
$sql .= 'ORDER BY id DESC ';
$sql .= 'LIMIT 5) ';
$sql .= 'ORDER BY id DESC; ';
$ads = Ad::find_by_sql( $sql );

if ( is_post_request() ) {

	// Save record using post parameters
	$args = $_POST['ad'];
	$id = $_GET['id'];
	$ad = Ad::find_by_id( $id );
	$ad->merge_attributes( $args );
	$result = $ad->save();

	if ( $result === true ) {
		$session->message( 'The ad was updated successfully.' );
		redirect_to( url_for( '/staff/ads/index.php' ) );
	} else {
		// show errors
	}
} else {

	// display the form
	$ad = new Ad();

}

?>

<?php $page_title = 'Email Ads'; ?>
<?php include( SHARED_PATH . '/staff_header.php' ); ?>

<div id="content">
	<div class="ads listing">
		<h1>Ads</h1>
		<?php echo display_errors( $ad->errors ); ?>

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
			foreach ( $ads as $ad ) {
				$stationAd = $ad->allStations();

				?>
			  <tr>
				<form action="<?php echo url_for( '/staff/ads/index.php?id=' . h( u( $ad->id ) ) ); ?>" method="post" id="postform">
				<td><?php echo h( $ad->title ); ?></td>
				<td>
				<?php
				$stations = ( unserialize( $ad->station ) );
				$stationArray = [];
				foreach ( $stations as $id => $station_id ) {
					$stationArray[] = Ad::STATION[ $station_id ];
				}
				echo implode( ', ', $stationArray );
				?>
				</td>
				<td class="align-middle">
				  <select name="ad[position]">
					<option value=""></option>
					<?php foreach ( Ad::POSITION as $position_id => $position_name ) { ?>
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
							<td class="align-middle"><a class="action" href="<?php echo $ad->link; ?>" target="_blank">View</a></td>

				<?php if ( $user->is_admin() ) { ?>
							<td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/ads/edit.php?id=' . h( u( $ad->id ) ) ); ?>">Edit</a></td>
				<td class="align-middle"><a class="action" href="<?php echo url_for( '/staff/ads/delete.php?id=' . h( u( $ad->id ) ) ); ?>">Delete</a></td>
				<td class="align-middle"><input type="submit" value="Update" /></td>
				<?php } ?>
				</form>
				</tr>
				<?php
			}
			?>
			</table>
		</div><!-- $ads -->

	</div>
</div>
<script src="<?php echo url_for( '/js/script.js' ); ?>"></script>

<?php include( SHARED_PATH . '/staff_footer.php' ); ?>
