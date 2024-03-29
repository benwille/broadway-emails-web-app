<?php require_once( '../../../private/initialize.php' ); ?>
<?php require_login(); ?>
<?php
  $user = User::find_by_username( $session->username );

if ( ! isset( $_GET['station'] ) ) {
	redirect_to( url_for( '/staff/emails/index.php' ) );
}
  $station = $_GET['station'];
foreach ( Email::STATION as $station_id => $station_name ) {
	if ( $station == $station_id ) {
		$stationName = $station_name;
		break;
	}
}

  // Go get posts
  $sql = 'SELECT * FROM posts ';
  $sql .= 'WHERE station=' . $station . ' ';
  $sql .= 'AND featured=1 ';
  $sql .= 'ORDER BY pubDate DESC ';
  $featured = Email::find_by_sql( $sql );

if ( is_post_request() ) {

	// Create record using post parameters
	$args = $_POST['post'];
	$id = $_GET['id'];
	$station = $_GET['station'];
	$post = Email::find_by_id( $id );
	$post->merge_attributes( $args );

	$result = $post->save();
	if ( $result === true ) {

		$session->message( 'The post was updated successfully.' );
		redirect_to( url_for( '/staff/emails/index.php?station=' . $station ) );


	} else {
		// show errors
	}
} else {
	$post = new Email();
}

?>

<?php $page_title = $stationName . ' Posts'; ?>
<?php include( SHARED_PATH . '/staff_header.php' ); ?>

<div id="content">
    <div class="emails listing">
        <h1><?php echo $stationName; ?> Posts</h1>
        <?php echo display_errors( $post->errors ); ?>

        <div class="d-flex flex-wrap">
            <div class="ml-1">
                <a class="btn btn-primary"
                    href="<?php echo url_for( 'staff/emails/new.php?station=' ) . $station; ?>">New Post</a>
            </div>
            <form action="<?php echo url_for( '/staff/emails/clear.php?station=' . $station ); ?>" method="post">
                <div class="form-group row ml-1" id="">
                    <div class="col-auto">
                        <input type="hidden" name="post[position]" value="0" />
                        <button class="btn btn-outline-primary" type="submit" name="commit" value="Clear Position">Clear
                            Positions</button>
                    </div>
                </div>
            </form>
            <form action="<?php echo url_for( '/staff/emails/clear.php?station=' . $station ); ?>" method="post">
                <div class="form-group row ml-1" id="">
                    <div class="col-auto">
                        <input type="hidden" name="post[featured]" value='0' />
                        <button class="btn btn-outline-primary" type="submit" name="commit" value="Clear Featured">Clear
                            Featured</button>
                    </div>
                </div>
            </form>
            <form action="<?php echo url_for( '/staff/emails/clear.php?station=' . $station ); ?>" method="post">
                <div class="form-group row ml-1" id="">
                    <div class="col-auto">
                        <input type="hidden" name="post[featured]" value="0" />
                        <input type="hidden" name="post[position]" value="0" />
                        <button class="btn btn-outline-primary" type="submit" name="commit" value="Clear All">Clear
                            All</button>
                    </div>
                </div>
            </form>
            <div class="ml-auto">
                <a class="btn btn-primary" href="<?php echo url_for( '/index.php?station=' ) . $station; ?>"
                    target="_blank">Create Email</a>
            </div>
        </div><!-- Clear Buttons -->
        <form action="<?php echo url_for('/staff/emails/search.php?station=' . $station); ?>" class="d-flex my-2">
            <input class="form-control mr-sm-2" name="query" type="search" value="" placeholder="Search"
                aria-label="Search">
            <input type="hidden" name="station" value="<?php echo $station;?>">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
        <h2>Featured Posts</h2>
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
                <?php foreach ( $featured as $post ) { ?>
                <tr>
                    <form action="<?php echo 'index.php?id=' . h( u( $post->id ) ) . '&station=' . $station; ?>"
                        method="post" id="postform">
                        <td><?php echo h( $post->title ); ?></td>
                        <td class="align-middle">
                            <select name="post[category]">
                                <option value=""></option>
                                <?php
					foreach ( Email::CATEGORY as $category_id => $category_name ) {
						if ( $station != 6 ) {
							if ( $category_id > 3 ) {
								break;
							}
						}
						?>
                                <option value="<?php echo $category_id; ?>" <?php
											if ( $post->category == $category_id ) {
												echo 'selected'; }
											?>><?php echo $category_name; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><?php echo h( $post->pubDate() ); ?></td>
                        <td><input type="number" name="post[position]" value="<?php echo h( $post->position ); ?>"
                                min="1" max="10" /></td>
                        <td class="text-center align-middle">
                            <input type="hidden" name="post[featured]" value="0" />
                            <input type="checkbox" name="post[featured]" value="1" <?php
				if ( $post->featured() ) {
					echo ' checked'; }
				?> />
                        </td>
                        <td class="align-middle"><a class="action" href="<?php echo $post->link; ?>"
                                target="_blank">View</a></td>
                        <?php if ( $user->is_admin() ) { ?>
                        <td class="align-middle"><a class="action"
                                href="<?php echo url_for( '/staff/emails/edit.php?id=' . h( u( $post->id ) ) . '&station=' . h( u( $post->station ) ) ); ?>">Edit</a>
                        </td>
                        <td class="align-middle"><a class="action"
                                href="<?php echo url_for( '/staff/emails/delete.php?id=' . h( u( $post->id ) ) . '&station=' . h( u( $post->station ) ) ); ?>">Delete</a>
                        </td>
                        <td class="align-middle"><input type="submit" value="Update" /></td>
                        <?php } ?>
                    </form>
                </tr>
                <?php } ?>
            </table>
        </div><!-- Featured Posts -->

        <!-- Ads -->
        <div class="d-flex">
            <h2>Ads</h2>
            <div class="ml-auto">
                <a class="btn btn-primary" href="<?php echo url_for( 'staff/ads/new.php?station=' ) . $station; ?>">New
                    Ad</a>
            </div>

        </div>
        <?php
	$ads = new Ad();
	$ads->get_ads( $station );
	?>
        <!-- Ads -->

        <?php if ( $station == 6 ) { ?>
        <h2>Interview Posts</h2>
        <?php
		$interviews = new Email();
		$interviews->get_posts( $station, 4 );
		?>

        <h2>RSL Posts</h2>
        <?php
		$rsl = new Email();
		$rsl->get_posts( $station, 5 );
		?>

        <h2>Utah Jazz Posts</h2>
        <?php
		$jazz = new Email();
		$jazz->get_posts( $station, 6 );
		?>

        <h2>U of U Posts</h2>
        <?php
		$utes = new Email();
		$utes->get_posts( $station, 7 );
		?>

        <h2>Salt Lake Stallions</h2>
        <?php
		$stallions = new Email();
		$stallions->get_posts( $station, 8 );
		?>
        <?php } ?>

        <div class="d-flex">
            <h2>Contest Posts</h2>
            <div class="ml-auto">
                <form action="<?php echo url_for( '/staff/emails/hide.php?station=' . $station ); ?>" method="post">
                    <div class="form-group row ml-1" id="">
                        <div class="col-auto">
                            <input type="hidden" name="post[visible]" value='0' />
                            <input type="hidden" name="post[category]" value='3' />
                            <button class="btn btn-outline-primary" type="submit" name="commit" value="Hide Posts">Hide
                                All Posts <i class='fas fa-angle-down'></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
	$contests = new Email();
	$contests->get_posts( $station, 3 );
	?>

        <div class="d-flex">
            <h2>News Posts</h2>
            <div class="ml-auto">
                <form action="<?php echo url_for( '/staff/emails/hide.php?station=' . $station ); ?>" method="post">
                    <div class="form-group row ml-1" id="">
                        <div class="col-auto">
                            <input type="hidden" name="post[visible]" value='0' />
                            <input type="hidden" name="post[category]" value='1' />
                            <button class="btn btn-outline-primary" type="submit" name="commit" value="Hide Posts">Hide
                                All Posts <i class='fas fa-angle-down'></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
	$news = new Email();
	$news->get_posts( $station, 1 );
	?>


        <div class="d-flex">
            <h2>Life Posts</h2>
            <div class="ml-auto">
                <form action="<?php echo url_for( '/staff/emails/hide.php?station=' . $station ); ?>" method="post">
                    <div class="form-group row ml-1" id="">
                        <div class="col-auto">
                            <input type="hidden" name="post[visible]" value='0' />
                            <input type="hidden" name="post[category]" value='2' />
                            <button class="btn btn-outline-primary" type="submit" name="commit" value="Hide Posts">Hide
                                All Posts <i class='fas fa-angle-down'></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
	$life = new Email();
	$life->get_posts( $station, 2 );
	?>

        <h2>Other Posts</h2>
        <?php
	$posts = new Email();
	$posts->get_posts( $station, 0 );
	?>

    </div>

</div>
<script src="<?php echo url_for( '/js/script.js' ); ?>"></script>

<?php include( SHARED_PATH . '/staff_footer.php' ); ?>