<!doctype html>
<html>
<head>
<title>CMS</title>
<meta property="og:url"           content="<?= current_url() ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?= $articles->title ?>" />
<meta property="og:description"   content="<?= $articles->body ?>" />
<meta charset="utf-8">

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
	<div class="panel panel-default">
	  <div class="panel-heading"><h3><?= $articles->title ?></h3></div>
	  <div class="panel-body">
			<span class="pull-right">
				<?= date('d M y H:i:s', strtotime($articles->created))?>
			</span>
	  		<?php if(! is_null($articles->image)): ?>
	  		<div class="col-lg-3">
				<?= img(array('src' => $articles->image, 'width' => '100%', 'height'=> '50%')); ?>
			</div>
			<?php endif; ?>
			<div class="col-lg-6">
				
				<p><?= $articles->body ?></p>
				
				<!-- Your share button code -->
			  		<?= anchor("http://www.facebook.com/sharer/sharer.php?s=100&
				  p[url]='".current_url()."'&p[images][0]={$articles->image}&p[summary]={$articles->body}",'Share on facebook', ['class' => 'btn btn-info btn-xs'])  ?>
				 
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
</body> 
</html>