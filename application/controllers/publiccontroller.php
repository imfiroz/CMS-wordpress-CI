<?php

class Publiccontroller extends CI_Controller{
	
	public function index(){
		$this->load->model('headermodel');
		$headerdata = $this->headermodel->get();
		$this->load->view('public/home', compact('headerdata'));
	}
	
}