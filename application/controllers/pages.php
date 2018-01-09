<?php
class Pages extends MY_Controller{
	public function index()
	{
		$this->load->view('admin/page/index');
	}
	public function add_page()
	{
		$this->load->helper('form');
		$menu_title = $this->menu();
		$this->load->view('admin/page/page_form', compact('menu_title') );
	}
	public function menu()
	{
		$this->load->model('menumodel');
		$menu_data = $this->menumodel->list_menu();
		//Storing array key as menu id and 
		$this->load->model('pagemodel');
		$menu_pb = array();
		foreach(	$menu_data as $value	):
			$page_data =  $this->pagemodel->get_page('menu_id', $value->id, 'visibility'); 
				//echo '<pre>';
				//print_r($page_data);
				foreach(	$page_data as $pg_visibility	) //Getting page visiblity with that menu id
				{
					if(	$pg_visibility->visibility == 2 ):///If page visibility is published with that menu id then removed
						//$menu_title[$value->id] = $value->menu_title;
						$menu_pb[$value->id] = $value->menu_title;
					
					endif;
				}
			if(	$value->visibility == '2' ): ///If menu visibility is published
				$menu_title[$value->id] = $value->menu_title;
			endif;
		endforeach;
		//echo '<pre>';
		$result = array_diff_assoc($menu_title,$menu_pb);
		//print_r($result); exit;
		return $result;
	}
	public function save_page()
	{
		$this->load->library('form_validation');
		if($this->form_validation->run('add_page_rules')): ///Checking form validation
			//echo '<pre>';
			//print_r($this->input->post()); exit;
			$post = $this->input->post();
			$post['visibility'] = 1; //Setting Default Visibility to Unpublish
			$this->load->model('pagemodel');
			return $this->_falshAndRedirect($this->pagemodel->add($post), 'Page Added Successfully', 'Page not Inserted, Try Again');
			
		else:
			$menu_title = $this->menu();
			$this->load->view('admin/page/page_form', compact('menu_title'));
		endif;
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
	private function _falshAndRedirect($successful, $successMessage, $failureMessage)
	{
		//Created flash message and redirect function
		if(	$successful	)
		{
			$this->session->set_flashdata('feedback', $successMessage);
			$this->session->set_flashdata('feedback_class','alert-success');
		}
		else
		{
			$this->session->set_flashdata('feedback', $failureMessage);
			$this->session->set_flashdata('feedback_class','alert-danger');
		}
		return redirect('pages');
	}
}