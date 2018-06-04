<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Model {

/*$this->db->query($sql, array(3, 'live', 'Rick'));
$error = $this->db->error(); // Has keys 'code' and 'message'
$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);*/

	function get_user_name($signum) {
		$query = $this->db->get_where('managers',array('signum' => $signum));
		if($query->num_rows() == 1) {
			return $query->row()->name;
		}
		else {
			return 0;
		}
	}

	function get_manager_by_id($id) {
		$query = $this->db->get_where('managers',array('m_id' => $id));
		return $query->row()->email;
	}

	function get_manager_id($name) {
		$query = $this->db->get_where('managers',array('name' => $name));
		return $query->row()->m_id;		
	}
}