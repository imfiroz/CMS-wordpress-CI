<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_header.php");
?>
<div class="container">
	<div class="col-lg-9 col-md-3 col-sm-4">
		<!--Showing flash message here-->
		<?php if($feedback_msg = $this->session->flashdata('feedback')): ?>
				<div class="row">
					<div class="col-lg-9">
						<div class="alert alert-dismissible  <?= $this->session->flashdata('feedback_class') ?>">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?= $feedback_msg ?>
						</div>
					</div>
				</div>
		<?php endif; ?>
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Blog Setting</h3>
		  </div>
		  <div class="panel-body">
		  	<?= anchor("blog/add_article/",'Add New Blog Article', ['class'=>'btn btn-default btn-sm'])?>
			<hr>
				<table class="table table-striped table-hover">
					<thead>
						<th>Sr.no</th>
						<th>Title</th>
						<th>Action</th>
					</thead>
					<tbody>
					<?php if(count($articles)):
							$count = $this->uri->segment(3);
							foreach($articles as $article): 
					?>
							<tr>
								<td><?= ++$count ?></td>
								<td><?= $article->title ?></td>
								<td>
									<div class="row">
										<div class="col-lg-2">
											<?= anchor("blog/edit_article/{$article->id}",'Edit',['class'=> 'btn btn-info']) ?>
										</div>
										<div class="col-lg-2">
											<?=
												form_open('blog/delete_article'),
												form_hidden('blog_id', $article->id),
												form_submit(['name'=>'submit', 'value'=>'Delete', 'class'=>'btn btn-danger']),
												form_close();
											?>
										</div>
									</div>

								</td>
							</tr>
					<?php 	endforeach;
						 else: 
					?>
							<tr>
								<td colspan="3">
									<p>No records found</p>
								</td>
							</tr>
					<?php endif;?>
					</tbody>
				</table>
				<?=  $this->pagination->create_links(); ?> 
			</div>
		</div>
	</div>
</div>
<?php 
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "../admin_footer.php");
?>
