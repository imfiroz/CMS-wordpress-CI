<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CMS</title>
<?= link_tag('assets/css/bootstrap.min.css') ?>
</head>
<body>
<nav class="navbar navbar-inverse">
 <?= img(array('src' => $headerdata->logo_path, 'width' => '60', 'height'=> '60')); ?>
  <div class="container-fluid">
    <div class="navbar-header">
    
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?=  $headerdata->title ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li><?= anchor('publiccontroller/blog_list','Blog', ['class' => 'active'])  ?></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><?= anchor('admin','Login')  ?></li>
      </ul>
    </div>
  </div>
</nav>
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