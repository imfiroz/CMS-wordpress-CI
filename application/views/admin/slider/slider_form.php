<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-9 col-md-3 col-sm-4">
		<div class="panel panel-success">
		  <div class="panel-heading">
			<h3 class="panel-title">Image Slider</h3>
		  </div>
		  <div class="panel-body">
		  <!--Applying condtion for update and insert task-->
			<?= form_open_multipart(
					isset($slide_data) ? "imageslider/update_slide/{$slide_data->id}" : "imageslider/save_slide", 'class="form-horizontal"'); ?> 
			  <?= form_hidden(isset($slide_data) ? 'modified' : 'created', date('Y-m-d H:i:s'))?>
			  <?= form_hidden('plugin_id', '1')?>
			  <fieldset>
			  <legend><?= isset($slide_data) ? "Edit Slide" : "Add New Slide" ?></legend>
					<hr>
						<div class="form-group">
							<label for="inputEmail" class="col-lg-2 control-label">Slide Heading:</label>
							<div class="col-lg-10">
							<?= form_input( ['name'=>'heading', 'class'=>'form-control', 'placeholder'=>'Enter Slide Heading', 'value'=>set_value('heading', isset($slide_data) ? $slide_data->heading : false)])?>
							
							<?= form_error('heading','<p class="text-danger">','</p>') ?>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail" class="col-lg-2 control-label">Slide Upload :</label> 
							<div class="col-lg-10">
							<?= form_upload( ['name'=>'image_path', 'class'=>'form-control'])?>
								<span class="help-block">
								<?php if(isset($upload_error)) echo $upload_error;?>
								</span>
							</div>
						</div>
						
						<div class="form-group">
							  <div class="col-lg-10 col-lg-offset-2">
								<button type="reset" class="btn btn-default">Cancel</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							  </div>
						</div>
			  </fieldset>
		   <?= form_close() ?>
	     </div>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
