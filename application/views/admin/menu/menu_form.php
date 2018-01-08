<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-7 col-md-3 col-sm-4">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Menu Setting</h3>
		  </div>
		  <div class="panel-body">
		  <!--Applying condtion for update and insert task-->
			<?= form_open(
					isset($menu_data) ? "menus/update_menu/{$menu_data->id}" : "menus/save_menu", 'class="form-horizontal"'); ?> 
			  <?= form_hidden('user_id', $this->session->userdata('user_id'))?>
			  <?= form_hidden(isset($menu_data) ? 'modified' : 'created', date('Y-m-d H:i:s'))?>
			  <fieldset>
			  <legend><?= isset($menu_data) ? "Edit Menu" : "Add Menu" ?></legend>
					<hr>
						<div class="form-group">
							<label for="inputEmail" class="col-lg-3 control-label">Menu Name:</label>
							<div class="col-lg-6 col-lg-offset-1">
							<?= form_input( ['name'=>'menu_title', 'class'=>'form-control', 'id'=>'inputEmail', 'placeholder'=>'Enter Menu Name', 'value'=>set_value('menu_title', isset($menu_data) ? $menu_data->menu_title : false)])?>
							</div>
						</div>
						<div class="col-lg-6">
							<?= form_error('menu_title','<p class="text-danger">','</p>') ?>
						</div>
						<div class="form-group">
							  <div class="col-lg-10 col-lg-offset-4">
								<?= form_reset('reset', 'Reset', ['class'=>'btn btn-default']) ?>
								<?= form_submit('submit', 'Submit', ['class'=>'btn btn-primary']) ?>
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
