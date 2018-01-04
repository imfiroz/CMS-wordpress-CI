<?php
class headermodel extends CI_Model{
	
	public function get(){
		//fetch data from header database
		$query = $this->db
							->get('header');
		if($query->num_rows()){ //return number for rows
			return $query->row(); //returning data
		}else{
			return FALSE; 
		}
	}
}