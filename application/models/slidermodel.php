<?php
class Slidermodel extends CI_Model
{
	public function get()
	{
		$query = $this->db
						->order_by('order', 'ASC')
						->get('imageslider');
		return $query->result();
	}
	public function get_num_row()
	{
		$query = $this->db->get('imageslider');
		if(	$query->num_rows()	)//checking return number of rows
		{ 
			return $query->num_rows(); //returning data
		}
		else
		{
			return FALSE; 
		}
	}
	public function add(array $post)
	{
		return $this->db->insert('imageslider', $post);
	}
	public function get_slide($slide_id)
	{
		$query = $this->db
						->where('id', $slide_id)
						->get('imageslider');
		return $query->row();
	}
	public function update($slide_id, array $post)
	{
		return $this->db
						->where('id', $slide_id)
						->update('imageslider', $post);
	}
	public function delete($slide_id)
	{
		return $this->db->delete('imageslider', ['id' => $slide_id]);
	}
	public function find_order($order)
	{
		$query = $this->db
						->where('order', $order)
						->get('imageslider');
		return $query->row();
	}
}