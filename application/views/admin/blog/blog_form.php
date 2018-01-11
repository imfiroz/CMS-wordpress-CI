<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-9 col-md-3 col-sm-4">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Article Blog</h3>
		  </div>
		  <div class="panel-body">
		  	<?= form_open_multipart(
					isset($blog_data) ? "blog/update_article/{$blog_data->id}" : "blog/save_article", 'class="form-horizontal"'); ?>
			<fieldset>
			<legend><?= isset($blog_data) ? "Edit Blog" : "Add Blog" ?></legend>
			<hr>
			<?= form_hidden('user_id', $this->session->userdata('user_id'))?>
			<?= form_hidden(isset($blog_data) ? 'modified' :'created', date('Y-m-d H:i:s'))?>
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Title :</label>
				<div class="col-lg-10">
				<?= form_input( ['name'=>'title', 'class'=>'form-control', 'id'=>'inputEmail', 'placeholder'=>'Enter Title', 'value'=>set_value('title',isset($blog_data) ? $blog_data->title : FALSE )])?>
					<span class="help-block">
					<?= form_error('title','<p class="text-danger">','</p>') ?>
					</span>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Image Upload :</label> 
				<div class="col-lg-10">
				<?= form_upload( ['name'=>'image', 'class'=>'form-control'])?>
					<span class="help-block">
					<?php if(isset($upload_error)) echo $upload_error;?>
					</span>
				</div>
			</div>
			
			<div class="form-group">
			  <label for="textArea" class="col-lg-2 control-label">Body :</label>
			  <div class="col-lg-10">
				<?= form_textarea( ['name'=>'body', 'class'=>'form-control', 'id'=>'textArea', 'rows'=>'3', 'value'=>set_value('body',isset($blog_data) ? $blog_data->body : FALSE )])?>
					<span class="help-block">
					<?= form_error('body','<p class="text-danger">','</p>') ?>
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
			</form>
		  </div>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
