<?php
class Header extends MY_Controller{
	public function index()
	{	
		$this->load->model('headermodel');
		$header_data = $this->headermodel->get();
		$this->load->view('admin/header/index',['header_data'=>$header_data]);
	}
	public function add_header()
	{
		$config = [ //file upload rules
					'upload_path'  	=> './upload_image',
					'allowed_types' => 'gif|jpg|png|jpeg'
					];
		$this->load->library('upload', $config);
		$this->load->library('form_validation'); //Setting validation rules library
		
		if($this->form_validation->run('add_header_rules') && $this->upload->do_upload('logo')): //if form submitted add rule checked and upload file checked
		
			$post = $this->input->post();
			unset($post['submit']);
			$upload_data = $this->upload->data(); //Getting logo image data 
			$post['logo_path']  = base_url("upload_image/".$upload_data['raw_name'].$upload_data['file_ext']); //created url with file extension and save it on post array 
			$this->load->model('headermodel');
			return $this->_falshAndRedirect($this->headermodel->add_header($post), 'Data Added Succcessfully', 'Data not Inserted');
		else:
		
			$this->load->helper('form');
			$upload_error = $this->upload->display_errors();
			$this->load->view('admin/header/add_header', compact('upload_error'));
			
		endif;
		
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
	//Created flash message and redirect function
	private function _falshAndRedirect($successful, $successMessage, $failureMessage){
		if($successful){
			$this->session->set_flashdata('feedback', $successMessage);
			$this->session->set_flashdata('feedback_class','alert-success');
		}else{
			$this->session->set_flashdata('feedback', $failureMessage);
			$this->session->set_flashdata('feedback_class','alert-danger');
		}
		return redirect('header');
	}
	
}