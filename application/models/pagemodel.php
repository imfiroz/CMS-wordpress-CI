<?php
class Pagemodel extends CI_Model
{
	public function add(array $array)
	{
		//echo '<pre>';
		//print_r($array); exit;
		return $this->db->insert('pages', $array);
	}
	public function get_page($filed, $value, $select)
	{
		$query = $this->db
						->select($select)
						->where($filed, $value)
						->get('pages');
		return $query->result();
	}
}
