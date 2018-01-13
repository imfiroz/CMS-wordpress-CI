<?php
class Plugins extends MY_Controller{
	public function index(){
		$this->load->helper('form');
		$this->load->model('pluginmodel');
		
		$this->load->model('menumodel');
		$menus_data = $this->menumodel->list_menu(); //**Getting menu list
		//Storing array key as menu id and 
		foreach(	$menus_data as $value	):
			if(	$value->visibility == '2' ): ///If menu visibility is published
				$menu_title[$value->id] = $value->menu_title;
			else:
				$menu_title = array();
			endif;
		endforeach;
		
		$plugins_data = $this->pluginmodel->get(); //**Getting Plugins Data
		$this->load->view('admin/plugin/index', compact('plugins_data','menu_title'));
	}
	public function change_status($plugin_id, $status)
	{//**This function updating plugins table
		$this->load->model('pluginmodel');
		$changed_status = ($status == '1') ? '2' : '1' ; //Changing current status
		$data = $this->pluginmodel->update($plugin_id,[ 'status' => $changed_status ]);
		$this->_falshAndRedirect($data, "Plugin Status Changed.", "Plugin Status Not Change,  Try Again.");
	}
	public function change_menu($plugin_id)
	{//**Changing plugin display menu
		$this->load->model('pluginmodel');
		$this->_falshAndRedirect($this->pluginmodel->update($plugin_id,$this->input->post()), "Plugin Displaying Page Set.", "Plugin Displaying Page Not Set.");
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
		return redirect('Plugins');
	}
	
}