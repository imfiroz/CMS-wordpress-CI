<?php
class Pluginmodel extends CI_Model
{
	public function get()
	{
		$query = $this->db->get('plugins');
		return $query->result();
	}
	public function update($plugin_id, array $array)
	{
		return  $this->db
						->where('id', $plugin_id)
						->update('plugins', $array);
	}
	public function get_by_field($filed, $value, $select)
	{
		$query = $this->db
						->select($select)
						->like('status',2) //**Only Getting activated data
						->like($filed, $value) 
						->get('plugins');
		return $query->row();
	}
}