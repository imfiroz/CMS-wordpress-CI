<?php

class Blogmodel extends CI_Model{
	
	public function articles_list($limit, $offset){
		//getting user id from session
		//$user_id = $this->session->userdata('user_id');
		//fetch data form articles
		$query = $this->db
							->limit($limit, $offset)
							->get('articles');
		//echo '<pre>'; print_r($query->result()); exit;
		return $query->result();
	}
	public function all_articles_list($limit, $offset){
		
		$query = $this->db
							->limit($limit, $offset)
							->get('articles');
		return $query->result();
	}
	public function search_results($query, $limit, $offset){
		
		$query = $this->db
							->like('title',$query)
							->limit($limit, $offset)
							->get('articles');
		return $query->result();
	}
	public function count_search_results($query){
		$query = $this->db
							->like('title',$query)
							->get('articles');
		return $query->num_rows();
	}
	public function num_rows_all(){
		$query = $this->db->get('articles');
		return $query->num_rows();
	}
	public function num_rows(){
		
		$query = $this->db->get('articles');
		return $query->num_rows();
	}
	public function search($search){
		$query = $this->db
							->like('title',$search)
							->get('articles');
		return $query->result();
	}
	public function add_article($array){
		return $this->db->insert('articles',$array);
	}
	public function find_article($article_id){
		$query = $this->db
						->where('id', $article_id)
						->get('articles');
		return $query->row();
	}
	public function update_article($article_id, array $article){
		return $this->db
						->where('id', $article_id)
						->update('articles', $article);
	}
	public function delete_article($article_id){
		return $this->db->delete('articles', ['id' => $article_id]);
						
	}
}