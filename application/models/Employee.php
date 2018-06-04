<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Model {

/*$this->db->query($sql, array(3, 'live', 'Rick'));
$error = $this->db->error(); // Has keys 'code' and 'message'
$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);*/

	function get_user_name($signum) {
		$query = $this->db->get_where('employee',array('signum' => $signum));
		if($query->num_rows() == 1) {
			return $query->row()->name;
		}
		else {
			return 0;
		}
	}

	function get_employee($user) {
		$query = $this->db->get_where('employee',array('signum' => $user));
		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return 0;
		}
	}

	function select_all($id) {
		$this->db->where('m_id',$id);
		$this->db->order_by('name','asc');
		return $this->db->get('employee')->result();
	}

	function get_all_employees() {
		$this->db->order_by('name','asc');
		return $this->db->get('employee')->result();		
	}

}