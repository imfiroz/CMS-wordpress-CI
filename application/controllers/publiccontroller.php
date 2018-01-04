<?php

class Publiccontroller extends CI_Controller{
	
	public function index(){
		
		$this->load->view('public/home');
	}
	
}