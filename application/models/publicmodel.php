<?php 
class Publicmodel extends CI_Model
{
	public function get_menu()
	{
		//****Getting Published Menu
		$query = $this->db
						->order_by('menu_order', 'ASC')
						->where('visibility','2')
						->get('menus');
		return $query->result();
	}
	public function get_page_data($menu_id = NULL)
	{
		$query = $this->db
						->like('menu_id', $menu_id)
						->like('visibility', '2')
						->get('pages');
		return $query->row();			
	}
}