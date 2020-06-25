<?php require_once( '../../../private/initialize.php' ); ?>
<?php require_login(); ?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$user = User::find_by_id( $id );

?>

<?php $page_title = 'Show User: ' . h( $user->full_name() ); ?>
<?php include( SHARED_PATH . '/staff_header.php' ); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for( '/staff/users/index.php' ); ?>">&laquo; Back to List</a>

  <div class="admin show">

	<h1>User: <?php echo h( $user->full_name() ); ?></h1>

	<div class="attributes">
	  <dl>
		<dt>First name</dt>
		<dd><?php echo h( $user->first_name ); ?></dd>
	  </dl>
	  <dl>
		<dt>Last name</dt>
		<dd><?php echo h( $user->last_name ); ?></dd>
	  </dl>
	  <dl>
		<dt>Email</dt>
		<dd><?php echo h( $user->email ); ?></dd>
	  </dl>
	  <dl>
		<dt>Username</dt>
		<dd><?php echo h( $user->username ); ?></dd>
	  </dl>
	  <dl>
		<dt>Role</dt>
		<dd><?php echo $user->is_admin() ? 'Admin' : 'Staff'; ?></dd>
	  </dl>
	</div>

  </div>

</div>
