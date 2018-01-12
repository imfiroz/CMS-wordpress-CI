<?php
class headermodel extends CI_Model{
	
	public function get()
	{//fetch data from header database
		$query = $this->db->get('header');
		if(	$query->num_rows()	)
		{ //checking number of rows
			return $query->row(); //returning data
		}else{
			return NULL; 
		}
	}
	public function add_header($array)
	{
		return $this->db->insert('header',$array);
	}
	public function delete_header($id){
		return $this->db->delete('header', ['id' => $id]);
	}
	public function update_header($header_id, array $array)
	{
		return $this->db
						->where('id', $header_id)
						->update('header', $array);
	}
	public function find_header($id)
	{
		$query = $this->db
							->where('id' , $id)
							->get('header');
		return $query->row();
	}
	
}