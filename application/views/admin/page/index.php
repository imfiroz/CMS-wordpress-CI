<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-8 col-md-3 col-sm-4">
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
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Page Setting</h3>
			</div>
			<div class="panel-body">
				<?= anchor("pages/add_page",'Add New Page', ['class'=>'btn btn-default btn-sm'])?>
				<hr>
				<table class="table table-striped table-hover ">
					  <thead>
						<tr>
						  <th>Sr</th>
						  <th>Page Title</th>
						  <th>Assign Menu</th>
						  <th>Visibility</th>
						  <th>Action</th>
						</tr>
					  </thead>
					  <tbody>
					  	<tr>
					  		<td>1</td>
					  		<td>Welcome Page XXXX XXXXX xxXX XXX XX</td>
					  		<td>Home</td>
					  		<td>
					  		<?= anchor("pages/visibility/",'Unpublish', ['class'=>'btn btn-info btn-sm'])  ?>
					  		</td>
					  		<td>
					  			<?= anchor("pages/edit_page",'Change', ['class'=>'btn btn-primary btn-sm'])  ?>
				  				<?= anchor("pages/delete_page",'Delete', ['class'=>'btn btn-danger btn-sm'])  ?>
					  		</td>
					  	</tr>
					  	<tr>
					  		<td colspan="5"><p class="text-danger">Page not add yet, add page.</p></td>
					  	</tr>
					  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
