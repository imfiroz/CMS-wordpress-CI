<?php
class Imageslider extends MY_Controller
{
	public function index()
	{
		$this->load->helper('form');
		$this->load->model('slidermodel');
		$slider_data = $this->slidermodel->get();
		$this->load->view('admin/slider/index', compact('slider_data'));
	}
	public function add_slide($upload_error = null)
	{
		$this->load->helper('form');
		$this->load->view('admin/slider/slider_form', compact('slider_data','upload_error'));
	}
	public function save_slide()
	{	
		
		$config = [
			    'upload_path'          => './upload_image',
                'allowed_types'        => 'gif|jpg|png|jpeg',
				'max_width'				=> 800,
				'max_height'			=> 400,
				'rule'					=> 'required',
				'errors'                => array(
                        'required' => 'You must provide a %s.',),
		];
		$this->load->library('upload',$config);
		$this->load->library('form_validation');
		$this->load->model('slidermodel');
		if(	$this->form_validation->run('add_slide_rules') && $this->upload->do_upload('image_path'))
		{
			$post = $this->input->post();
			//echo '<pre>';
			//echo $this->slidermodel->get_num_row();  exit;
			//print_r($this->input->post()); exit;
			if( $rows = $this->slidermodel->get_num_row() )
			{ //Add Slide order
				for($i = 1; $i <= $rows; $i++):
					
					if(!$this->slidermodel->find_order($i))://if Slide order is not found in imageslider table then add  
						$post['order'] = $i;
				
					else: //Else add incremental Slide order
				
						( $rows == $i ) ? ($post['order'] = $rows ++) : ''; 
						
					endif;
					
				endfor;
			}
			else
			{
				$post['order'] = 1; //Adding Slide order for 
			}
			//echo '<pre>';
			//print_r($this->input->post()); exit;
				$data = $this->upload->data();
				$image_path = base_url("upload_image/".$data['raw_name'].$data['file_ext']);
				$post['image_path'] = $image_path; //adding image path to post variable
			
			return $this->_falshAndRedirect($this->slidermodel->add($post), 'Slide Added Succcessfully', 'Slide Not Saved, Try Again');
		}
		else
		{
			$upload_error = $this->upload->display_errors(); //uploaded error message
			$this->add_slide($upload_error);
		}
	}
	public function edit_slide($slide_id, $upload_error = NULL)
	{
		$this->load->helper('form');
		$this->load->model('slidermodel');
		$slide_data = $this->slidermodel->get_slide($slide_id);
		$this->load->view('admin/slider/slider_form', compact('slide_data', 'upload_error'));
	}
	public function update_slide($slide_id)
	{
		$config = [
			    'upload_path'          => './upload_image',
                'allowed_types'        => 'gif|jpg|png|jpeg',
				'max_width'				=> 800,
				'max_height'			=> 400,
		];
		$this->load->library('upload',$config);
		$this->load->library('form_validation');
		if(	$this->form_validation->run('add_slide_rules') && $this->upload->do_upload('image_path'))
		{
			$post = $this->input->post();
			//if($this->upload->do_upload('image')):
				$data = $this->upload->data();
				$image_path = base_url("upload_image/".$data['raw_name'].$data['file_ext']);
				$post['image_path'] = $image_path; //adding image path to post variable
			//endif;
			$this->load->model('slidermodel');
			return $this->_falshAndRedirect($this->slidermodel->update($slide_id,$post), 'Slide Updated Succcessfully', 'Slide Not Updated, Try Again');
		}
		else
		{
			$upload_error = $this->upload->display_errors(); //uploaded error message
			$this->edit_slide($slide_id, $upload_error);
		}
		
	}
	public function delete_slide($slide_id)
	{
		$this->load->model('slidermodel');
		return $this->_falshAndRedirect($this->slidermodel->delete($slide_id), 'Selected slide deleted successfully', 'slide not deleted');
	}
	public function short_slide($slide_id)
	{
		//Change slide order controller
		$post = $this->input->post();
		$this->load->model('slidermodel');
		//finding existing order
		$ext_order_slide = $this->slidermodel->find_order($post['order']);
		//changing old slide order number to current order number
		$this->slidermodel->update($ext_order_slide->id, ['order' => $post['old_order'] ]);
		//Changing selected slide order number to selected order number
		unset($post['old_order']);
		return $this->_falshAndRedirect($this->slidermodel->update($slide_id, $post), 'Silde Order Changed Successfully', 'Slide Order Not Changed, try again');
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
		return redirect('imageslider');
	}
}