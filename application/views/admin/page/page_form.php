<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-8 col-md-3 col-sm-4">
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Page Setting</h3>
			</div>
			<div class="panel-body">
				<?= form_open(
					isset($page_data) ? "pages/update_page/{$page_data->id}" : "pages/save_page", 'class="form-horizontal"'); ?>
				<?= form_hidden('user_id', $this->session->userdata('user_id'))?>
			  	<?= form_hidden( isset($page_data) ? 'modified' : 'created', date('Y-m-d H:i:s'))?>
				  <fieldset>
					<legend><?= isset($page_data) ? "Edit Page" : "Add Page" ?></legend>
					<hr>
					<div class="form-group">
					  <label for="inputEmail" class="col-lg-2 control-label">Title</label>
					  <div class="col-lg-10">
					  	<?= form_input( ['name'=>'title', 'class'=>'form-control', 'placeholder'=>'Enter Page Title', 'value'=>set_value('menu_title', isset($page_data) ? $page_data->title : false)])?>
					  	<span class="help-block">
					  	<?= form_error('title','<p class="text-danger">','</p>') ?>
					  	</span>
					  </div>
					</div>
					<div class="form-group">
					  <label for="select" class="col-lg-2 control-label">Menu</label>
					  <div class="col-lg-10">
					  	<?= form_dropdown('menu_id', $menu_title, 
							set_value('menu_id', isset($page_data) ? $page_data->menu_id : false), 
							['class' => 'form-control']); ?>
					  </div>
					</div>
					<div class="form-group">
					  <label for="textArea" class="col-lg-2 control-label">Content</label>
					  <div class="col-lg-10">
					  	<?= form_textarea( ['name'=>'content', 'class'=>'form-control', 'id'=>'textArea', 'rows'=>'3', 'value'=>set_value('body',isset($page_data) ? $page_data->content : FALSE )])?>
						<span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
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