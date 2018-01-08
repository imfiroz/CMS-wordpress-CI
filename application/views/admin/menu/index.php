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
				  			
							<?= $menu_data->menu_order ?>
							<button  class="btn btn-info btn-sm" onclick="showDiv<?= $menu_data->id ?>()">Change Order</button>
				  			<!--Setting Order form-->
				  			<div style="display: none;" id="orderDIV<?= $menu_data->id ?>">
				  			
						<?= form_open("menus/short_menu/{$menu_data->id}", ['class' => 'form-horizontal']) ?>
							<?= form_hidden('old_order', $menu_data->menu_order)?>
								</fieldset>
								 <div class="form-group">
									  <label for="select" class="col-lg-4 control-label">Selects:</label>
									  <div class="col-lg-5">
									  	<?php
											foreach($menus_data as $order):
												$menu_order[$order->menu_order] =  $order->menu_order;
											endforeach;
										?>
									  	<?= form_dropdown('menu_order',$menu_order, $menu_data->menu_order, ['class' => 'form-control']); ?>
									  </div>
									</div>
									<div class="form-group">
									  <div class="col-lg-10 col-lg-offset-2">
										<button type="submit" class="btn btn-primary">Submit</button>
									  </div>
									</div>
								  </fieldset>
						<?= form_close() ?>
						
							</div>
				  		</td>
				  		<td>
				  			<?= anchor("menus/edit_menu/{$menu_data->id}",'Change', ['class'=>'btn btn-primary btn-sm'])  ?>
				  			<?= anchor("menus/delete_menu/{$menu_data->id}",'Delete', ['class'=>'btn btn-danger btn-sm'])  ?>
				  		</td>
				  		<td>
				  		<!--Setting menu visibility using visibility controller-->
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
<script>
<?php foreach( $menus_data as $menu_data ):  ?>
function showDiv<?= $menu_data->id ?>() {
    var x = document.getElementById("orderDIV<?= $menu_data->id ?>");
	var b = document.getElementById("Button<?= $menu_data->id ?>");
    if (x.style.display === "none") {
        x.style.display = "block";
		b.style.display = "none";
    } else {
        x.style.display = "none";
    }
}
<?php endforeach; ?>
</script>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
