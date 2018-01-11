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
<?php //***Publish Menus Display
if(	isset($menus)	){
	foreach($menus as $menu)
	{ 
		?>
		<li><?= anchor("publiccontroller/index/{$menu->id}",$menu->menu_title) ?></li>
		<?php	
	}
}
?>
        <li class="active"><?= anchor('publiccontroller/blog_list','Blog')  ?></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><?= anchor('admin','Login')  ?></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
	<h1>All Article Blog</h1>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td>Sr. No.</td>
				<td>Blog Title</td>
				<td>Published on</td>
			</tr>
		</thead>
		<tbody>
		<?php 
	
		//echo '<pre>';
		///print_r($articles); exit;
	
		if($articles):
		$count = $this->uri->segment(3);
			foreach($articles as $article): 
		?>
			<tr>
				<td><?= ++$count ?></td>
				<td>
				<?= anchor("Publiccontroller/blog_details/{$article->id}",$article->title) ?>
				</td>
				<td><?= date('d M y H:i:s', strtotime($article->created))?></td>
			</tr>
		<?php
			endforeach;
		else:
		?>
			<tr>
				<td colspan="3">No record added</td>
			</tr>
		<?php 
		endif;
		?>
		</tbody>
	</table>
	<?=  $this->pagination->create_links(); ?>
</div>
<?php include('public_footer.php'); ?>