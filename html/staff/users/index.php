<?php require_once( '../../../private/initialize.php' ); ?>
<?php require_login(); ?>
<?php

// Find all admins
$users = User::find_all();
$staff = User::find_by_username( $session->username );


?>
<?php $page_title = 'Users'; ?>
<?php include( SHARED_PATH . '/staff_header.php' ); ?>

<div id="content">
  <div class="admins listing">
	<h1>Users</h1>

	<div class="actions">
	  <a class="action" href="<?php echo url_for( '/staff/users/new.php' ); ?>">Add User</a>
	</div>
	<div class="row">
		<?php foreach ( $users as $user ) { ?>
		<div class="col-sm-6">
		  <section class="card mb-5" id="<?php echo h( $user->id ); ?>">
			<div class="card-header">
			  <h2 class="card-title"><?php echo h( $user->full_name() ); ?></h2>
			  <h5 class="card-subtitle"><?php echo h( $user->username ); ?></h5>
			</div>

			<ul class="list-group list-group-flush">
			  <li class="list-group-item"><strong>Email: </strong> <?php echo h( $user->email ); ?></li>
			  <li class="list-group-item"><strong>Role: </strong> <?php echo $user->is_admin() ? 'Admin' : 'Staff'; ?></li>
			</ul>
			<?php if ( $staff->is_admin() ) { ?>
			<div class="card-footer text-center">
			  <a class="card-link" href="<?php echo url_for( '/staff/users/show.php?id=' . h( u( $user->id ) ) ); ?>">View</a>
			  <a class="card-link" href="<?php echo url_for( '/staff/users/edit.php?id=' . h( u( $user->id ) ) ); ?>">Edit</a>
			  <a class="card-link" href="<?php echo url_for( '/staff/users/delete.php?id=' . h( u( $user->id ) ) ); ?>">Delete</a>
			</div>
			<?php } ?>
		  </section><!--end card-->
		</div>

		<?php } ?>
	</div><!--row-->



  </div>

</div>

<?php include( SHARED_PATH . '/staff_footer.php' ); ?>
