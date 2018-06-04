<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karnet extends MY_Model {

	function select_all() {
		$this->db->order_by('Naziv','asc');
		return $this->db->get('main')->result();
	}

}