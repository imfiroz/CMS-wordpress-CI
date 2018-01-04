<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CMS</title>
<?= link_tag('assets/css/bootstrap.min.css') ?>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Dashboard</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
       	<li><?= anchor('publiccontroller','View Home')  ?></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><?= anchor('admin/logout','Logout')  ?></li>
      </ul>
    </div>
  </div>
</nav>
<!--Admin controlles-->
<div class="col-lg-3 col-md-3 col-sm-4">
	<div class="list-group table-of-contents">
		<?= anchor('header','Header Setting', ['class'=> 'list-group-item'])  ?>
		<?= anchor('admin/logout','Add Menus', ['class'=> 'list-group-item'])  ?>
		<?= anchor('admin/logout','Add Pages', ['class'=> 'list-group-item'])  ?>
		<?= anchor('admin/logout','Blog', ['class'=> 'list-group-item'])  ?>
		<?= anchor('admin/logout','Plugin', ['class'=> 'list-group-item'])  ?>
	</div>
</div>