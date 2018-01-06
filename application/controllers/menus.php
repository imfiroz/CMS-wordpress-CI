<?php
class Menus extends MY_Controller {
	
	public function index(){
		$this->load->view('admin/menu/index');
	}
	public function add_menu(){
		$this->load->helper('form');
		$this->load->view('admin/menu/menu_form');
	}
	public function save_menu(){
		echo '<pre>';
		print_r($this->input->post());
	}
}