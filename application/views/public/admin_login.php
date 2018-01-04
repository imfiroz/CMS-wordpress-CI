<?php include('public_header.php'); ?>
<div class="container">
	<?= form_open('admin/login_form', 'class="form-horizontal"'); ?> 
		  <fieldset>
			<legend>Admin Login</legend>
			<?php if($error_msg = $this->session->flashdata('loggin_invalid')): ?>
			<div class="row"><!--Setting loggin error message-->
				<div class="col-lg-6">
					<div class="alert alert-dismissible alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?= $error_msg ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="inputEmail" class="col-lg-2 control-label">User Name</label>
						<div class="col-lg-10">
						<?= form_input( ['name'=>'username', 'class'=>'form-control', 'id'=>'inputEmail', 'placeholder'=>'User Name', 'value'=>set_value('username')])?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<?= form_error('username','<p class="text-danger">','</p>') ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
					  <label for="inputPassword" class="col-lg-2 control-label">Password</label>
					  <div class="col-lg-10">
						<?= form_password(['name'=>'password', 'class'=>'form-control', 'id'=>'inputPassword', 'placeholder'=>'Password', 'value'=>set_value('password')])?>
					  </div>
					</div>
				</div>
				<div class="col-lg-6">
					<?= form_error('password','<p class="text-danger">','</p>') ?>
				</div>
			</div>
			<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2">
					<?= form_reset('reset', 'Reset', ['class'=>'btn btn-default']) ?>
					<?= form_submit('submit', 'Login', ['class'=>'btn btn-primary']) ?>
				  </div>
			</div>
		</fieldset>
	</form>

</div>
<?php include('public_footer.php'); ?>