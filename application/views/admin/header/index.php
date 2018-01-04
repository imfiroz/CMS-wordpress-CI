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
	<h3>Header Title</h3>
	<?php if(isset($header_data->title)): ?><!--checking title-->
		<h1><?= $header_data->title ?></h1>
	<?php else: ?>
			<table class="table table-striped table-hover ">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Title</th>
				  <th colspan="2">Action</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td colspan="2"><p class="text-danger">Title not set yet.</p></td>
				  <td><a href="#" class="btn btn-info btn-sm">Add Title</a></td>
				</tr>
			  </tbody>
			</table> 
	<?php endif; ?>
	<hr>
	<h3>Header Logo</h3>
	<?php if(isset($header_data->image_path)): ?><!--checking title-->
		<h1><?= $header_data->image_path ?></h1>
	<?php else: ?>
			<table class="table table-striped table-hover ">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Logo</th>
				  <th colspan="2" >Action</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td colspan="2"><p class="text-danger">Logo not set yet.</p></td>
				  <td><a href="#" class="btn btn-info btn-sm">Add Logo</a></td>
				</tr>
			  </tbody>
			</table> 
	<?php endif; ?>
	</div>
	
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
