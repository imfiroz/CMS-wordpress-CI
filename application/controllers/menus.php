<?php
class Menus extends MY_Controller {
	
	public function index()
	{
		$this->load->helper('form');
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
			if( $rows = $this->menumodel->get() )
			{ //Add menu order
				for($i = 1; $i <= $rows; $i++):
					
					if(!$this->menumodel->find_order($i))://if Menu order is not found in menu table then add  
						$post['menu_order'] = $i;
				
					else: //Else add incremental menu order
				
						( $rows == $i ) ? ($post['menu_order'] = $rows ++) : ''; 
						
					endif;
					
				endfor;
			}
			else
			{
				$post['menu_order'] = 1; //Adding menu order for 
			}
			$post['visibility'] = 1; //Setting default menu visibility is unpublish
			unset($post['submit']);
			//echo '<pre>';
			//print_r($post); exit;
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
	public function short_menu($menu_id)
	{
		//Change menu order controller
		$post = $this->input->post();
		$this->load->model('menumodel');
		//finding existing order
		$ext_order_menu = $this->menumodel->find_order($post['menu_order']);
		//changing old menu order number to current order number
		$this->menumodel->update($ext_order_menu->id, ['menu_order' => $post['old_order'] ]);
		//Changing selected menu order number to selected order number
		unset($post['old_order']);
		return $this->_falshAndRedirect($this->menumodel->update($menu_id, $post), 'Menu Order Changed Successfully', 'Menu Order Not Changed, try again');
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
		return redirect('menus');
	}
}