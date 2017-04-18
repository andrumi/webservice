<?php
class Api_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
		public function get_heroes($id = FALSE)
		{
			if ($id === FALSE)
			{
					$query = $this->db->get('heroes');
					return $query->result_array();
			}

			$query = $this->db->get_where('heroes', array('id' => $id));
			return $query->row_array();
		}
		public function get_items($id = FALSE)
		{
			if ($id === FALSE)
			{
					$query = $this->db->get('items');
					return $query->result_array();
			}

			$query = $this->db->get_where('items', array('id' => $id));
			return $query->row_array();
		}
		public function search($term = FALSE)
		{	
            log_message('debug','term = '.$term);	
            $this->db->select('id','name');
            $this->db->from('items');			
			$this->db->like('name',$term);
			$query = $this->db->get();

			log_message('debug','size = '.Count($query));
			return $query->result_array();
		}
		public function get_item($id = FALSE)
		{
			$query = $this->db->get_where('items', array('id' => $id));
			return $query->row_array();
		}
		public function insert_newitem($user= FALSE){
					
			$this->db->set('name', $user);
			$this->db->set('type', 'None');
			$this->db->set('price', 'No price available');// this isn't right because it's a double but it still outputs 0
			$this->db->insert('items');
			$newid =$this->db->insert_id();
			return $newid;
		}
		public function delete_item($id = FALSE){
			$this->db->where('id',$id);
			$sucess = $this->db->delete('items');
			return $sucess;
		}
		public function update_item($newdata){
            
			$this->db->set('name', $newdata['name']);
			$this->db->set('type', $newdata['type']);
			$this->db->set('price', floatval($newdata['price']));
			$this->db->where('id',$newdata['id']);
			$success = $this->db->update('items');
			//returns 1
			return $success;
		}
		
		public function register($user= FALSE){
					
			$this->db->set('name', $user);// using set to allow future use of largere objects
			$this->db->insert('users');
			$newid =$this->db->insert_id();
			return $newid;
		}
		public function get_user($id = FALSE)
		{
			$query = $this->db->get_where('users', array('id' => $id));
			return $query->row_array();
		}
		public function get_hero($id = FALSE)
		{
			$query = $this->db->get_where('heroes', array('id' => $id));
			return $query->row_array();
		}
		public function insert_hero($hero= FALSE){
			$this->db->set('name', $hero);// using set to allow future use of largere objects
			$this->db->insert('heroes');
			$newid =$this->db->insert_id();
			return $newid;
		}
		public function delete_hero($id = FALSE){
			$this->db->where('id',$id);
			$sucess = $this->db->delete('heroes');
			return $sucess;
		}
		public function update_hero($newdata){
            
			$this->db->set('name', $newdata['name']);
			$this->db->where('id',$newdata['id']);
			$success = $this->db->update('heroes');
			//returns 1
			return $success;
		}
		
}