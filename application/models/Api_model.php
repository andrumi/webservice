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
			/* $data = array(
			       'id'=> $newdata['id'],
				   'name'=> $newdata['name']
			); */
			$this->db->set('name', $newdata['name']);
			$this->db->where('id',$newdata['id']);
			$success = $this->db->update('heroes');
			/* $success = $this->db->replace('heroes',$data); */
			return $success;
		}
		
}