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
}