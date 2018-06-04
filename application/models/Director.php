<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Director extends MY_Model {

/*$this->db->query($sql, array(3, 'live', 'Rick'));
$error = $this->db->error(); // Has keys 'code' and 'message'
$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);*/

	function get_user_name($signum) {
		$query = $this->db->get_where('directors',array('signum' => $signum));
		if($query->num_rows() == 1) {
			return $query->row()->name;
		}
		else {
			return 0;
		}
	}

}