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
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Menu Setting</h3>
		  </div>
		  <div class="panel-body">
		  	<?= anchor("menus/add_menu/",'Add New Menu', ['class'=>'btn btn-default btn-sm'])?>
			<hr>
			<?php //if(isset($menu_data->id)): ?><!--checking title-->
			<table class="table table-striped table-hover ">
				  <thead>
					<tr>
					  <th>Sr</th>
					  <th>Menu title</th>
					  <th>Order</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
				  		<td><p>1</p></td>
				  		<td><p>home</p></td>
				  		<td><p>2</p></td>
				  		<td>
				  			<?= anchor("menu/edit_menu/",'Change', ['class'=>'btn btn-primary btn-sm'])  ?>
				  			<?= anchor("menu/delete_menu/",'Delete', ['class'=>'btn btn-danger btn-sm'])  ?>
				  			<?= anchor("",'Publish', ['class'=>'btn btn-info btn-sm'])  ?>
				  		</td>
					  </td>
					</tr>
				<!--  </tbody>
				</table> -->
		<?php //else: ?>
				
				  <tbody>
					<tr>
					  <td colspan="4"><p class="text-danger">Title and Logo Not Set Yet.</p></td>
				  </tbody>
				</table> 
		<?php //endif; ?>
		  </div>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
