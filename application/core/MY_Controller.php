<?php

class MY_Controller extends CI_Controller{
	
	//Creating constructer for checking user logged
	public function __construct(){
		parent::__construct();
		if(! $this->session->userdata('user_id'))
			return redirect('admin/login_form');
			
	}
	
}