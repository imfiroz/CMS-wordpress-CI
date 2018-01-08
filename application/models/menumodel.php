<?php
class Menumodel extends CI_Model
{
	public function get()//fetch data from menu database table
	{
		$query = $this->db->get('menus');
		if(	$query->num_rows()	)//checking return number of rows
		{ 
			return $query->num_rows(); //returning data
		}
		else
		{
			return FALSE; 
		}
	}
	public function list_menu()
	{
		$query = $this->db->get('menus');
		return $query->result();
	}
	public function save_menu(array $array)
	{
		return $this->db->insert('menus',$array);
	}
	public function find_menu($menu_id)
	{
		$query = $this->db
						->where('id', $menu_id)
						->get('menus');
		return $query->row();
	}
	public function update($menu_id, array $array)
	{
		return $this->db
						->where('id', $menu_id)
						->update('menus', $array);
	}
	public function delete($menu_id)
	{
		return $this->db->delete('menus', ['id' => $menu_id]);
	}
	
}