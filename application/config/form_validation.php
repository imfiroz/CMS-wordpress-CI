<?php

$config = [
	
			'add_header_rules'  => [
										[
											'field' => 'title',
											'lable' => 'Title',
											'rules' => 'required',
										],
										
									],
			'add_menu_rules'  => 	[
										[
											'field' => 'menu_title',
											'lable' => 'Menu Name',
											'rules' => 'required|min_length[3]|max_length[12]|is_unique[menus.menu_title]',
											'errors' => array(
														'required' => 'You must provide a %s.',
														'is_unique' => 'This %s already exists.',
														),
										],
										
									],
			'add_page_rules'  => 	[
										[
											'field' => 'title',
											'lable' => 'title',
											'rules' => 'required',
											'errors' => array(
                        'required' => 'You must provide a %s.',),
	
										],

										],
			'add_blog_rules'  => 	[
											[
												'field' => 'title',
												'lable' => 'Title',
												'rules' => 'required'
											],
											[
												'field' => 'body',
												'lable' => 'Body',
												'rules' => 'required',
											],
										],
			'add_slide_rules'  => 	 [
											[
												'field' => 'heading',
												'lable' => 'Heading',
												'rules' => 'required',
											],
									  ],

	];