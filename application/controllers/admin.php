<?php

class admin extends CI_Controller{
	
	public function index(){
		if($this->session->userdata('user_id')) //preventing loggedin user to access this page
			return $this->load->view('admin/dashboard');
		
		///$this->load->model('headermodel');
		//$headerdata = $this->headermodel->get();
		$this->load->helper('form');
		//$this->load->view('public/admin_login', compact('headerdata'));
		$this->load_page_data ($menu_id = NULL ,'public/admin_login', $article = NULL);
	}
	public function login_form(){
		
		$this->load->library('form_validation');
		//set rule
		$this->form_validation->set_rules('username','User Name','required|alpha|trim');
		$this->form_validation->set_rules('password','Password','required');
		
		if($this->form_validation->run() )
		{ //form validation test
			//Passed
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('adminmodel');
			//Getting login user id
			$user_id = $this->adminmodel->login_valid( $username, $password);
			if($user_id){//cradentials valid
				//setting session  user_id variable
				$this->session->set_userdata('user_id',$user_id);
				//flashing message for success login 
				
				$this->session->set_flashdata('loggin_success', 'Loggin successful');
				return redirect('admin');
			}else{
				//cradentials not valid
				//flashing invalid login message to login page 
				$this->session->set_flashdata('loggin_invalid', 'Invalid Username and Password');
				return redirect('admin');
			}
			
		}else{
			//failed redirected to login page
			$this->index();
		}
	}
	public function logout(){
		//logout and redirected to login page
		$this->session->unset_userdata('user_id');
		return redirect('admin');
	}
	private function load_page_data ($menu_id = NULL ,$function_call, $articles = null)
	{
		$this->load->model('headermodel');
		$headerdata = $this->headermodel->get(); //**Getting header title and logo
		
		$this->load->model('publicmodel');
		$menus = $this->publicmodel->get_menu(); //**Getting publish menus
		
		$this->load->model('publicmodel');
		if(	$menu_id	):
			$page_data = $this->publicmodel->get_page_data($menu_id); //**Loading page data with menu id
		else:
			if(	$menus	): //Checking if menu found
				$page_data = $this->publicmodel->get_page_data($menus[0]->id); //**Loading default first page id
			else:
				$page_data = NULL; //***If no publish menu found
			endif; 
		endif;
		//$this->load->view('public/home', compact('headerdata', 'menus', 'page_data'));
		$this->load->view($function_call, ['headerdata' => $headerdata, 'menus' => $menus, 'page_data' => $page_data, 'articles' => $articles]);
	}
}