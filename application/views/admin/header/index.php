<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<?php if($log_msg = $this->session->flashdata('loggin_success')): ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?= $log_msg ?>
			</div>
		</div>
	</div>
	
	<?php endif; ?>
		
	<div class="col-lg-7 col-md-3 col-sm-4">
		<h1>Showing header data</h1>
	</div>
	
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
