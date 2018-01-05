<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-7 col-md-3 col-sm-4">
		<!--Showing flash message here-->
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
		<div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Header Setting</h3>
		  </div>
		  <div class="panel-body">
			<?php if(isset($header_data->id)): ?><!--checking title-->
			<table class="table table-striped table-hover ">
				  <thead>
					<tr>
					  <th>Title</th>
					  <th>Logo</th>
					  <th colspan="2">Action</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td><p class="lead"><?= $header_data->title ?></p></td>
					  <td><?= img(array('src' => $header_data->logo_path, 'width' => '100',
        'height'=> '100')) ?></td>
					  <td colspan="2">
					  <?= anchor("header/edit_header/{$header_data->id}",'Change', ['class'=>'btn btn-info btn-sm'])  ?>
					  <?= anchor("header/delete_header/{$header_data->id}",'Remove', ['class'=>'btn btn-info btn-sm'])  ?>
					  </td>
					</tr>
				  </tbody>
				</table> 
		<?php else: ?>
				
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
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
