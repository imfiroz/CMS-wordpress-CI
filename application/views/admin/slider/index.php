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
				<div class="panel panel-success">
					<div class="panel-heading">
					<h3 class="panel-title">Image Slider Setting</h3>
					</div>
					<div class="panel-body">
					
					
					
					
					<?= anchor("imageslider/add_slide",'Add New Image', ['class'=>'btn btn-default btn-sm'])?>
					<hr>
					<table class="table table-striped table-hover ">
						  <thead>
							<tr>
							  <th>Sr</th>
							  <th>Tag Heading</th>
							  <th>Image</th>
							  <th>Order</th>
							  <th>Action</th>
							</tr>
						  </thead>
						  <tbody>
				<?php if(  $slider_data	): 
						$count = 0;
						foreach( $slider_data as $image_data ): 
						$count++;
				?>
							<tr>
								<td><p><?= $count ?></p></td>
								<td><p><?= $image_data->heading ?></p></td>
								<td><?= img(array('src' => $image_data->image_path, 'width' => 80, 'height'=> 40)); ?></td>
								<td>

									<?= $image_data->order ?>
									<button  class="btn btn-info btn-sm" onclick="showDiv<?= $image_data->id ?>()">Change Order</button>
									<!--Setting Order form-->
									<div style="display: none;" id="orderDIV<?= $image_data->id ?>">

								<?= form_open("imageslider/short_slide/{$image_data->id}", ['class' => 'form-horizontal']) ?>
									<?= form_hidden('old_order', $image_data->order)?>
										</fieldset>
										 <div class="form-group">
											  <label for="select" class="col-lg-4 control-label">Select:</label>
											  <div class="col-lg-5">
												<?php
													foreach($slider_data as $order):
														$slide_order[$order->order] =  $order->order;
													endforeach;
												?>
												<?= form_dropdown('order',$slide_order, $image_data->order, ['class' => 'form-control']); ?>
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
									<?= anchor("imageslider/edit_slide/{$image_data->id}",'Change', ['class'=>'btn btn-primary btn-sm'])  ?>
									<?= anchor("imageslider/delete_slide/{$image_data->id}",'Delete', ['class'=>'btn btn-danger btn-sm'])  ?>
								</td>
							</tr>
					<?php endforeach;
						else: 
					?>
							<tr>
							  <td colspan="5"><p class="text-danger">Slider Image Not Set Yet.</p></td>
							<tr>
					<?php endif; ?>
						 </tbody>
						</table>
					
					
					
					
					</div>
				</div>
	</div>
</div>
<script>
<?php foreach( $slider_data as $image_data ):  ?>
function showDiv<?= $image_data->id ?>() {
    var x = document.getElementById("orderDIV<?= $image_data->id ?>");
	var b = document.getElementById("Button<?= $image_data->id ?>");
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