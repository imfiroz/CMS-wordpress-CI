<?php include('admin_header.php'); ?>
<div class="container">
	<div class="row">
		<?php if($log_msg = $this->session->flashdata('loggin_success')): ?>
			<div class="col-lg-6">
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?= $log_msg ?>
				</div>
			</div>
		<?php endif; ?>	
		<div class="col-lg-7 col-md-3 col-sm-4">

			<h1>Admin Dasboard</h1>
		</div>
	</div>
</div>
<?php include('admin_footer.php'); ?>