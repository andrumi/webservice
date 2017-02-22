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
}