<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends MY_Model {

	function insert_car() {
		$data = array('registracija' => $this->input->post('register'),
					  'tip' => $this->input->post('type'),
					  'kilometraza' => $this->input->post('kmstatus'),
					  'marka' => $this->input->post('mark'),
					);

		$this->db->insert('cars',$data);	
	}

	function get_all_cars() {
		return $this->db->get('cars')->result();
	}

	function insert_kilometraza() {
		$datum = DateTime::createFromFormat('d/m/Y', $this->input->post('date'));
		$datum = date_format($datum,"Y-m-d");		
		$data = array(
			'kilometraza' => $this->input->post('kmstatus'),
			'updated'=> $datum
			);
		$this->db->where('registracija',$this->input->post('register'));
		$this->db->update('cars',$data);				
	}

	function get_recent_kilometraza($reg) {
		$query = $this->db->query("select * from kilometraza where registracija='" . $reg . "' order by datum desc limit 3");
		return $query->result();
	}

	function get_registracije() {
		$query = $this->db->query('select distinct registracija from kilometraza');
		return $query->result();
	}	

	function get_all_problems() {
		$this->db->where('status',0);
		return $this->db->get('carproblems')->result();		
	}

	function insert_problem($user) {
		$data = array('registracija' => $this->input->post('register'),
					  'status' => 0,
					  'comment' => '',
					  'description' => $this->input->post('description'),
					  'closedby' => "",
					  'createdby' => $user
					);

		$this->db->insert('carproblems',$data);	
	}

	function get_problem($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('carproblems');
		return $query->result();		
	}

	function closeproblem($user) {
		$data = array('closedby' => $user,
					  'status' => 1,
					  'comment' => $this->input->post('description'),
					);
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('carproblems',$data);		
	}	

	function check_kms() {
		$this->db->where('registracija',$this->input->post('register'));
		return $this->db->get('cars')->result();
	}		

}