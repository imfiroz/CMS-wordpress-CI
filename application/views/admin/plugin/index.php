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
			<h3 class="panel-title">Plugin Setting</h3>
		  </div>
		  <div class="panel-body">
			<hr>
				<table class="table table-striped table-hover">
					<thead>
						<th>Sr.no</th>
						<th>Available Plugins</th>
						<th>Status</th>
					</thead>
					<tbody>
					<?php if(count($plugins_data)):
							$count = 1;
							foreach($plugins_data as $plugin_data): 
					?>
							<tr>
								<td><?= $count++ ?></td>
								<td><?= $plugin_data->plugin_name ?></td>
								<td><?= anchor("plugins/change_status/{$plugin_data->id}/{$plugin_data->status}",
									($plugin_data->status == 1)?'Activate':'Deactivate'
											   ,['class'=> 'btn btn-info']) ?>
								</td>
							</tr>
					<?php 	endforeach;
						 else: 
					?>
							<tr>
								<td colspan="3">
									<p>No Plugin added yet!</p>
								</td>
							</tr>
					<?php  endif;?>
					</tbody>
				</table>
			</div>
	<?php  //***Showing here activated plugings
		foreach($plugins_data as $plugin_data):
			$count = 1;
			if($plugin_data->status == 2):
	?>	
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><?= $plugin_data->plugin_name ?></h3>
				  </div>
				  <div class="panel-body">
					<table class="table table-striped table-hover ">
						  <thead>
							<tr>
							  <th>Sr.no</th>
							  <th>Display Menu</th>
							  <th>Setting</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td><?= $count++ ?></td>
							  <td><!--Select Menu Dropdown Form-->
							  <?= form_open("plugins/change_menu/{$plugin_data->id}") ?>
							  <?php if(isset($menu_title)): ?>
							  <div class="form-group">
								  <div class="input-group">
								  	<?= form_hidden('modified', date('Y-m-d H:i:s'))?>
								  	
									<?= form_dropdown('menu_id', $menu_title, $plugin_data->menu_id, ['class' => 'form-control']); ?>
									<span class="input-group-btn">
									  <button class="btn btn-default" type="submit">Submit</button>
									</span>
								  </div>
							  </div>
							  <?= form_close() ?>
							  <?php else: ?>
							  <p>Menu not added yet, add menu first!</p>
							  <?php endif; ?>
							  </td>
							  <td><?=  anchor("imageslider", 'Configure Plugin',['class'=> 'btn btn-info']) ?></td>
							</tr>
						  </tbody>
					 </table>
				  </div>
				</div>
	<?php			
			endif;
		endforeach;
	?>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
