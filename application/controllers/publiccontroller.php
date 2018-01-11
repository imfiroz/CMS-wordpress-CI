<?php

class Publiccontroller extends CI_Controller{
	

	public function index()
	{
		$this->load->model('headermodel');
		$headerdata = $this->headermodel->get();
		$this->load->view('public/home', compact('headerdata'));
	}
	public function blog_list()
	{
		$this->load->model('headermodel');
		$headerdata = $this->headermodel->get();
		$this->load->model('blogmodel');
		$this->load->library('pagination');
		$config = [
			'base_url'			=> base_url('publiccontroller/blog_list'),
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
		//echo '<pre>'; print_r($articles); exit;
		$this->load->view('public/blog', compact('headerdata', 'articles'));
	}
	public function blog_details($blog_id)
	{
		$this->load->model('headermodel');
		$headerdata = $this->headermodel->get();
		$this->load->model('blogmodel');
		$article = $this->blogmodel->find_article($blog_id);
		$this->load->view('public/blog_details', compact('headerdata', 'article'));
	}
	
	
}