<?php
class Blog extends MY_Controller
{
	public function index()
	{
		$this->load->helper('form');
		$this->load->model('blogmodel');
		$this->load->library('pagination');
		$config = [
			'base_url'			=> base_url('blog/index'),
			'per_page'			=> 5,
			'total_rows'		=> $this->blogmodel->num_rows(),
			'full_tag_open'		=> "<ul class='pagination'>",
			'full_tag_close'	=> "</ul>",
			'first_tag_open'	=> '<li>',
			'first_tag_close'	=> '</li>',
			'last_tag_open'		=> '<li>',
			'last_tag_close'	=> '</li>',
			'next_tag_open'		=> '<li>',
			'next_tag_close'	=> '</li>',
			'prev_tag_open'		=> '<li>',
			'prev_tag_close'	=> '</li>',
			'num_tag_open'		=>	'<li>',
			'num_tag_close'		=> '</li>',
			'cur_tag_open'		=>	"<li class='active'><a>",
			'cur_tag_close'		=>	"</a></li>",
		];
		$this->pagination->initialize($config);
		$articles = $this->blogmodel->articles_list($config['per_page'],$this->uri->segment(3));
		$this->load->view('admin/blog/index', ['articles'=>$articles]);
		
	}
	public function add_article()
	{
		$this->load->helper('form');
		$this->load->view('admin/blog/blog_form');
	}
	public function save_article()
	{
		$config = [
			    'upload_path'          => './upload_image',
                'allowed_types'        => 'gif|jpg|png|jpeg',
		];
		$this->load->library('upload',$config);
		$this->load->library('form_validation');
		if(	$this->form_validation->run('add_blog_rules'))
		{
			$post = $this->input->post();
			if($this->upload->do_upload('image')):
				$data = $this->upload->data();
				$image_path = base_url("upload_image/".$data['raw_name'].$data['file_ext']);
				$post['image'] = $image_path; //adding image path to post variable
			endif;
			$this->load->model('blogmodel');
			return $this->_falshAndRedirect($this->blogmodel->add_article($post), 'Blog Added Succcessfully', 'Blog Not Saved, Try Again');
		}
		else
		{
			$this->load->view('admin/blog/blog_form');
		}
		
	}
	public function edit_article($blog_id)
	{
		$this->load->helper('form');
		$this->load->model('blogmodel');
		$blog_data = $this->blogmodel->find_article($blog_id);
		$this->load->view('admin/blog/blog_form', compact('blog_data'));
	}
	public function update_article($id)
	{
		$config = [
			    'upload_path'          => './upload_image',
                'allowed_types'        => 'gif|jpg|png|jpeg',
		];
		$this->load->library('upload',$config);
		$this->load->library('form_validation');
		if(	$this->form_validation->run('add_blog_rules'))
		{
			$post = $this->input->post();
			if($this->upload->do_upload('image')):
				$data = $this->upload->data();
				$image_path = base_url("upload_image/".$data['raw_name'].$data['file_ext']);
				$post['image'] = $image_path; //adding image path to post variable
			endif;
			$this->load->model('blogmodel');
			return $this->_falshAndRedirect($this->blogmodel->update_article($id,$post), 'Blog Updated Succcessfully', 'Blog Not Updated, Try Again');
		}
		else
		{
			redirect("blog/edit_article/{$id}");
		}
	}
	public function delete_article()
	{
		$blog = $this->input->post();
		$this->load->model('blogmodel');
		return $this->_falshAndRedirect($this->blogmodel->delete_article($blog['blog_id']), 'Blog Removed Succcessfully', 'Blog Not Remove Yet, Try Again');
	}
	private function _falshAndRedirect($successful, $successMessage, $failureMessage)
	{
		if($successful){
			$this->session->set_flashdata('feedback', $successMessage);
			$this->session->set_flashdata('feedback_class','alert-success');
		}else{
			$this->session->set_flashdata('feedback', $failureMessage);
			$this->session->set_flashdata('feedback_class','alert-danger');
		}
		return redirect('blog');
	}
	
}