<?php
class Menus extends MY_Controller {
	
	public function index()
	{
		$this->load->model('menumodel');
		$menus_data = $this->menumodel->list_menu();
		$this->load->view('admin/menu/index', compact('menus_data'));
	}
	public function add_menu()
	{
		$this->load->helper('form');
		$this->load->view('admin/menu/menu_form');
	}
	public function save_menu()
	{
		$this->load->library('form_validation');
		if(	$this->form_validation->run('add_menu_rules')	): 
		//Form validation cheacking through custom library rule
			$this->load->model('menumodel');
			$this->menumodel->get();
			$post = $this->input->post();
			if( $this->menumodel->get() )
			{
				$post['menu_order'] = $this->menumodel->get();
				$post['menu_order'] ++; //Increamenting menu order
				
			}
			else
			{
				$post['menu_order'] = 1; //Adding menu order for 
			}
			$post['visibility'] = 1; //Setting default menu visibility is unpublish
			unset($post['submit']);
			$this->load->model('menumodel');
			return $this->_falshAndRedirect($this->menumodel->save_menu($post), 'Menu Added Successfully', 'Menu not Inserted');
			
		else:
		//If validation failed 
			$this->load->view('admin/menu/menu_form');
		endif;
	}
	public function edit_menu($menu_id)
	{
		$this->load->helper('form');
		$this->load->model('menumodel');
		$menu_data = $this->menumodel->find_menu($menu_id);
		//echo '<pre>';
		//print_r($menu_data); exit;
		$this->load->view('admin/menu/menu_form', compact('menu_data'));
	}
	public function update_menu($menu_id)
	{
		
		$this->load->model('menumodel');
		$post = $this->input->post();
		unset($post['submit']);
		return $this->_falshAndRedirect($this->menumodel->update($menu_id, $post), 'Menu updated Successfully', 'Menu not updated, try again');
		//echo '<pre>';
		//print_r($this->input->post());
	}
	public function delete_menu($menu_id)
	{
		$this->load->model('menumodel');
		return $this->_falshAndRedirect($this->menumodel->delete($menu_id), 'Selected menu deleted successfully', 'Menu not deleted');
	}
	public function visibility($menu_id, $visibility)
	{	//Changing visibility to published or Unpublish
		$this->load->model('menumodel');
		$mode = ($visibility == 1) ? 2 : 1 ; //Visibile mode condtion
		return $this->_falshAndRedirect($this->menumodel->update($menu_id, ['visibility' => $mode]), 'Visibility Changed Successfully', 'Visibility Not Changed, try again');
	}
	//Created flash message and redirect function
	private function _falshAndRedirect($successful, $successMessage, $failureMessage){
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
		return redirect('menus');
	}
	
	
	
}