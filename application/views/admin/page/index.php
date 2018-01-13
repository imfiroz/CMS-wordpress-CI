<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-9 col-md-3 col-sm-4">
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
					  <?php 
						//echo '<pre>';
						$count = 1;
						if($pages_data)
						{
							foreach($pages_data as $page_data):
					   ?>
					  	<tr>
					  		<td><?= $count++ ?></td>
					  		<td><?= $page_data->title ?></td>
					  		<td><?= $page_data->menu_id ?></td>
					  		<td>
					  		<?= anchor("pages/visibility/{$page_data->id}/{$page_data->menu_id}",($page_data->visibility == 2 ) ? 'Published' : 'Unpublise', ['class'=>'btn btn-info btn-sm'])  ?>
					  		</td>
					  		<td>
					  			<?= anchor("pages/edit_page/{$page_data->id}",'Change', ['class'=>'btn btn-primary btn-sm'])  ?>
				  				<?= anchor("pages/delete_page/{$page_data->id}",'Delete', ['class'=>'btn btn-danger btn-sm'])  ?>
					  		</td>
					  	</tr>
					  	<?php
							endforeach;
						  }
						  else
						  {
						?>
				  		<tr>
					  		<td colspan="5"><p class="text-danger">Page not add yet, add page.</p></td>
					  	</tr>
					  	<?php	  
						  } //end of if statment
						?>
					  	
					  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
