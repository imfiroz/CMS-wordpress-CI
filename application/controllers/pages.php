<?php
class Pages extends MY_Controller{
	public function index()
	{
		$this->load->view('admin/page/index');
	}
	public function add_page()
	{
		$this->load->helper('form');
		$this->load->view('admin/page/page_form');
	}
	public function edit_page()
	{
		echo 'Edit Page';
		//$this->load->view('admin/page/index');
	}
	public function delete_page()
	{
		echo 'Delete Page';
		//$this->load->view('admin/page/index');
	}
	public function visibility()
	{
		echo 'Change Visibility';
	}
}