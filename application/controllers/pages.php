<?php
class Pages extends MY_Controller{
	public function index()
	{
		$this->load->model('pagemodel');
		$pages_data = $this->pagemodel->get_pages();
		$this->load->view('admin/page/index', compact('pages_data'));
	}
	public function add_page()
	{
		$this->load->helper('form');
		$menu_title = $this->menu();
		$this->load->view('admin/page/page_form', compact('menu_title') );
	}
	public function menu($page_id = NULL)
	{
		$this->load->model('menumodel');
		$menu_data = $this->menumodel->list_menu();
		//Storing array key as menu id and 
		$this->load->model('pagemodel');
		$menu_pb = array();
		foreach(	$menu_data as $value	):
			//$page_data =  $this->pagemodel->get_page('menu_id', $value->id, 'visibility'); 
			//foreach(	$page_data as $pg_visibility	) //Getting page visiblity with that menu id
			//{
				//if(	$pg_visibility->visibility == 2 ):///If page visibility is published with that menu id then removed
					//$menu_pb[$value->id] = $value->menu_title;

				//endif;
			//}
			if(	$value->visibility == '2' ): ///If menu visibility is published
				$menu_title[$value->id] = $value->menu_title;
			endif;
		endforeach;
		$result = array_diff_assoc($menu_title,$menu_pb); 
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
	public function edit_page($page_id)
	{
		//echo $page_id;
		$this->load->helper('form');
		$menu_title = $this->menu($page_id);
		//echo $page_id; exit;
		$selected =  $this->pagemodel->get_page('id', $page_id, '*');
		//echo '<pre>';
		$page_data = $selected[0];
		$this->load->view('admin/page/page_form', compact('menu_title','page_data') );
		//$this->load->view('admin/page/index');
	}
	public function update_page($page_id)
	{
		$this->load->library('form_validation');
		if($this->form_validation->run('add_page_rules')): ///Checking form validation rule
			$this->load->model('pagemodel');
			return $this->_falshAndRedirect($this->pagemodel->update($page_id, $this->input->post()), 'Page Updated Successfully', 'Page not Updated, Try Again');
		else:
			$menu_title = $this->menu($page_id);
			$selected =  $this->pagemodel->get_page('id', $page_id, '*');
			$page_data = $selected[0];
			$this->load->view('admin/page/page_form', compact('menu_title','page_data') );
		endif;
	}
	public function delete_page($page_id)
	{
		$this->load->model('pagemodel');
		return $this->_falshAndRedirect($this->pagemodel->delete($page_id), 'Page Deleted Successfully', 'Page not Deleted, Try Again');
	}
	public function visibility($page_id, $menu_id)
	{
		$this->load->model('pagemodel');
		$page_data = $this->pagemodel->get_page('id',$page_id,'visibility');
		//converting std object to array
		foreach($page_data as $value)
		{	///Getting page visibility on that menu 
			$current_visibilty['visibility'] = $value->visibility;
		}   
		$pb_page_data = $this->pagemodel->get_page('menu_id',$menu_id,'*');
		$pb_visibilty  = NULL;
		foreach(	$pb_page_data as $value	)
		{	///Finding published page on that menu 
			 ($value->visibility == 2 ) ? $pb_visibilty = $value->id   : FALSE;
		}
		if(	$pb_visibilty	)
		{
			if($pb_visibilty == $page_id): //Changing Publish Page to Unpublish 
			//***Update Publish Page to Unpublish**
				$success = $this->pagemodel->update($pb_visibilty, ['visibility' => 1] );
			else:
			//***Interchange visibilty status**
				//**Published page to unpublish**
				$this->pagemodel->update($pb_visibilty, ['visibility' =>$current_visibilty['visibility']] );
				//**Changing current page visibility to publish**
				$pb_v = ($current_visibilty['visibility'] == 1) ? 2 : 1 ;
				$success = $this->pagemodel->update($page_id, ['visibility' => $pb_v] );
				
			endif;
		}
		else
		{	//**if first time selected change to publish**
			$success = $this->pagemodel->update($page_id, ['visibility' => 2]);
		}
		return $this->_falshAndRedirect($success, 'Page Visibility Changed Successfully', 'Page Visibility Not Changed, Try Again');
		
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