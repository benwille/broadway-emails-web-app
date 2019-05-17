<?php require_once '../../../private/initialize.php'; ?>
<?php require_login(); ?>
<?php

// Find all admins
$admins = Admin::find_all();
$staff  = Admin::find_by_username( $session->username );


?>
<?php $page_title = 'Admins'; ?>
<?php require SHARED_PATH . '/staff_header.php'; ?>

<div id="content">
  <div class="admins listing">
	<h1>Admins</h1>

	<div class="actions">
	  <a class="action" href="<?php echo url_for( '/staff/admins/new.php' ); ?>">Add Admin</a>
	</div>
	<div class="row">
		<?php foreach ( $admins as $admin ) { ?>
		<div class="col-sm-6">
		  <section class="card mb-5" id="<?php echo h( $admin->id ); ?>">
			<div class="card-header">
			  <h2 class="card-title"><?php echo h( $admin->full_name() ); ?></h2>
			  <h5 class="card-subtitle"><?php echo h( $admin->username ); ?></h5>
			</div>

			<ul class="list-group list-group-flush">
			  <li class="list-group-item"><strong>Email: </strong> <?php echo h( $admin->email ); ?></li>
			  <li class="list-group-item"><strong>Role: </strong> <?php echo $admin->is_admin() ? 'Admin' : 'Staff'; ?></li>
			</ul>
			<?php if ( $staff->is_admin() ) { ?>
			<div class="card-footer text-center">
			  <a class="card-link" href="<?php echo url_for( '/staff/admins/show.php?id=' . h( u( $admin->id ) ) ); ?>">View</a>
			  <a class="card-link" href="<?php echo url_for( '/staff/admins/edit.php?id=' . h( u( $admin->id ) ) ); ?>">Edit</a>
			  <a class="card-link" href="<?php echo url_for( '/staff/admins/delete.php?id=' . h( u( $admin->id ) ) ); ?>">Delete</a>
			</div>
			<?php } ?>
		  </section><!--end card-->
		</div>

		<?php } ?>
	</div><!--row-->



  </div>

</div>

<?php require SHARED_PATH . '/staff_footer.php'; ?>
