<?php
class Header extends MY_Controller{
	public function index()
	{	
		$this->load->model('headermodel');
		$header_data = $this->headermodel->get();
		$this->load->view('admin/header/index',['header_data'=>$header_data]);
	}
	public function add_title()
	{
		
	}
	public function get_title($id)
	{
		
	}
	//Creating constructer for checking user logged
	public function __construct(){
		parent::__construct();
		if(! $this->session->userdata('user_id'))
			return redirect('admin/login_form');
			
	}
	
}