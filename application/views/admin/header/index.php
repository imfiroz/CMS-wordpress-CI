<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-7 col-md-3 col-sm-4">
		<h3>Header Setting</h3>
		<?php if($feedback_msg = $this->session->flashdata('feedback')): ?>
		<div class="row">
			<div class="col-lg-9">
				<div class="alert alert-dismissible  <?= $this->session->flashdata('feedback_class') ?>">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?= $feedback_msg ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if(isset($header_data->id)): ?><!--checking title-->

			<h1><?= $header_data->title ?></h1>
			<h1><?= $header_data->logo_path ?></h1>

		<?php else: ?>
				<table class="table table-striped table-hover ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Title</th>
					  <th>Logo</th>
					  <th colspan="2">Action</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td colspan="3"><p class="text-danger">Title and Logo Not Set Yet.</p></td>
					  <td><?= anchor('header/add_header','Add', ['class'=>'btn btn-info btn-sm'])  ?></td>
					</tr>
				  </tbody>
				</table> 
		<?php endif; ?>
	
	
	</div>
	
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
