<?php

class Publiccontroller extends MY_Controller{
	
	public function index(){
		
		$this->load->view('public/home');
	}
	
}