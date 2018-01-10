<?php
class Pagemodel extends CI_Model
{
	public function add(array $array)
	{
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
	public function get_pages()
	{
		$query = $this->db->get('pages');
		return $query->result();
	}
	public function update($id, array $array)
	{
		return $this->db
						->where('id', $id)
						->update('pages', $array);
	}
	public function delete($page_id)
	{
		return $this->db->delete('pages',['id' => $page_id]);
	}
}
