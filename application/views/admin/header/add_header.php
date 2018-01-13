<?php include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php"); ?>
<div class="container">
	<div class="col-lg-9 col-md-3 col-sm-4">
	<?= form_open_multipart('header/add_header', 'class="form-horizontal"'); ?> 
		  <?= form_hidden('user_id', $this->session->userdata('user_id'))?>
		  <?= form_hidden('created', date('Y-m-d H:i:s'))?>
		  <fieldset>
			<legend>Header Setting</legend>
			<div class="row">
				
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Title :</label>
					<div class="col-lg-6">
					<?= form_input( ['name'=>'title', 'class'=>'form-control', 'id'=>'inputEmail', 'placeholder'=>'Enter Title', 'value'=>set_value('title')])?>
					</div>
				</div>
				
				<div class="col-lg-6">
					<?= form_error('title','<p class="text-danger">','</p>') ?>
				</div>
			</div>
			
			<div class="row">
				
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Logo :</label> 
					<div class="col-lg-6">
					<?= form_upload( ['name'=>'logo', 'class'=>'form-control'])?>
					</div>
				</div>
				
				<div class="col-lg-6">
					<?php if(isset($upload_error)) echo $upload_error;?>
				</div>
			</div>
			
			<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2">
					<?= form_reset('reset', 'Reset', ['class'=>'btn btn-default']) ?>
					<?= form_submit('submit', 'Submit', ['class'=>'btn btn-primary']) ?>
				  </div>
			</div>
		</fieldset>
			
	<?= form_close() ?>
	</div>
</div>
<?php include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php"); ?>