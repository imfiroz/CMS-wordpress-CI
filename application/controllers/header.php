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
			//echo '<pre>';
			//print_r($post); exit;
			$this->load->model('headermodel');
			return $this->_falshAndRedirect($this->headermodel->add_header($post), 'Data Added Succcessfully', 'Data not Inserted');
		else:
		
			$this->load->helper('form');
			$upload_error = $this->upload->display_errors(); //uploaded error message
			$this->load->view('admin/header/add_header', compact('upload_error'));
			
		endif;
		
	}
	public function edit_header($header_id)
	{
		$this->load->model('headermodel');
		$this->load->helper('form');
		$header_data = $this->headermodel->find_header($header_id);
		$this->load->view('admin/header/edit_header', compact('header_data'));
	}
	public function update_header_data($header_id){
		
		$config = [ //file upload rules
					'upload_path'  	=> './upload_image',
					'allowed_types' => 'gif|jpg|png|jpeg'
					];
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		//echo '<pre>'; print_r($this->input->post()); exit;
		if($this->form_validation->run('add_header_rules') && $this->upload->do_upload('logo')){
			//Updating data
			$post = $this->input->post();  
			unset($post['submit']);
			$upload_data = $this->upload->data(); //Getting logo image data 
			$post['logo_path']  = base_url("upload_image/".$upload_data['raw_name'].$upload_data['file_ext']);
			//created url with file extension and save it on post array 
			//echo '<pre>';
			//print_r($post); exit;
			$this->load->model('headermodel');
			$this->_falshAndRedirect($this->headermodel->update_header($header_id, $post), 'Title and Logo update Succcessfully', 'Updation operation failed!');
			 
		}else{
			//$upload_error = $this->upload->display_errors(); //uploaded error message
			$this->edit_header($header_id);
		}
	}
	public function delete_header($header_id)
	{
		$this->load->model('headermodel');
		$this->_falshAndRedirect($this->headermodel->delete_header($header_id), 'Title and Logo removed Succcessfully', 'Remove operation failed!');
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