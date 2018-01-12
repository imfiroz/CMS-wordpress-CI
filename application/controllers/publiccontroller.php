<?php

class Publiccontroller extends CI_Controller{
	

	public function index($menu_id = NULL)
	{
		$this->load_page_data ($menu_id ,'public/home', $article = null);
	}
	public function blog_list()
	{
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
		
		$this->load_page_data ($menu_id = NULL ,'public/blog', $articles);
	}
	public function blog_details($blog_id)
	{
		$this->load->model('blogmodel');
		$article = $this->blogmodel->find_article($blog_id);
		$this->load_page_data ($menu_id = NULL ,'public/blog_details', $article);
	}
	
	private function load_page_data ($menu_id = NULL ,$function_call, $articles = null)
	{
		$this->load->model('headermodel');
		$headerdata = $this->headermodel->get(); //**Getting header title and logo
		$this->load->model('publicmodel');
		$menus = $this->publicmodel->get_menu(); //**Getting publish menus
		
		$this->load->model('publicmodel');
		if(	$menu_id	):
			$page_data = $this->publicmodel->get_page_data($menu_id); //**Loading page data with menu id
		else:
			if($menus)://Checking if menu found
				$page_data = $this->publicmodel->get_page_data($menus[0]->id); //**Loading default first page id
			else:
				$page_data = NULL; //***If no publish menu found
			endif; //menus
		endif;
		//$this->load->view('public/home', compact('headerdata', 'menus', 'page_data'));
		$this->load->view($function_call, ['headerdata' => $headerdata, 'menus' => $menus, 'page_data' => $page_data, 'articles' => $articles]);
	}
	
}