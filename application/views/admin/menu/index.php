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
			<table class="table table-striped table-hover ">
				  <thead>
					<tr>
					  <th>Sr</th>
					  <th>Menu title</th>
					  <th>Order</th>
					  <th>Action</th>
					  <th>Visibility</th>
					</tr>
				  </thead>
				  <tbody>
		<?php if(  $menus_data	): 
				$count = 0;
				foreach( $menus_data as $menu_data ): 
				$count++;
		?>
					<tr>
				  		<td><p><?= $count ?></p></td>
				  		<td><p><?= $menu_data->menu_title ?></p></td>
				  		<td>
				  			<p>
							<?= $menu_data->menu_order ?>
							<?= anchor("",'Change Order', ['class'=>'btn btn-info btn-sm'])  ?>
				  			</p>
				  		</td>
				  		<td>
				  			<?= anchor("menus/edit_menu/{$menu_data->id}",'Change', ['class'=>'btn btn-primary btn-sm'])  ?>
				  			<?= anchor("menus/delete_menu/{$menu_data->id}",'Delete', ['class'=>'btn btn-danger btn-sm'])  ?>
				  		</td>
				  		<td><!--Setting menu visibility using visibility controller-->
				  			<?= anchor("menus/visibility/{$menu_data->id}/{$menu_data->visibility}",( $menu_data->visibility > 1 ? 'Published' : 'Unpublish'), ['class'=>'btn btn-info btn-sm'])  ?>
						</td>
					  </td>
					</tr>
				
			<?php endforeach;
				else: 
			?>
					<tr>
					  <td colspan="5"><p class="text-danger">Title and Logo Not Set Yet.</p></td>
					<tr>
			<?php endif; ?>
	  			 </tbody>
				</table> 
		  </div>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
