<?php

require_once( '../../../private/initialize.php' );
$user = User::find_by_username( $session->username );
// $query = $_POST['query'];
$query = $_GET['query'];
$station = $_GET['station'];
if(strlen($query) < 3) {
	$session->message( 'Your search must be at least 3 letters long');
	redirect_to(url_for('/staff/emails/index.php?station=' . $station));
}
$columns = ['title', 'link', 'excerpt'];
$search = Email::search( $query, $columns, $station );

// var_dump($search);
// if ( $result === true ) {
// 	$session->message( 'Cleared out. Ready for a new email.' );
// 	redirect_to( url_for( '/staff/emails/index.php?station=' . $station ) );
// }
?>
<?php include( SHARED_PATH . '/staff_header.php' ); ?>

<h2>Search Results - <?php echo count($search);?> results found</h2>
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
        <?php foreach ( $search as $post ) { ?>
        <tr>
            <form action="<?php echo 'index.php?id=' . h( u( $post->id ) ) . '&station=' . $station; ?>" method="post"
                id="postform">
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
                <td><input type="number" name="post[position]" value="<?php echo h( $post->position ); ?>" min="1"
                        max="10" /></td>
                <td class="text-center align-middle">
                    <input type="hidden" name="post[featured]" value="0" />
                    <input type="checkbox" name="post[featured]" value="1" <?php
				if ( $post->featured() ) {
					echo ' checked'; }
				?> />
                </td>
                <td class="align-middle"><a class="action" href="<?php echo $post->link; ?>" target="_blank">View</a>
                </td>
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
</div><!-- Search Results -->

<script src="<?php echo url_for( '/js/script.js' ); ?>"></script>

<?php include( SHARED_PATH . '/staff_footer.php' ); ?>