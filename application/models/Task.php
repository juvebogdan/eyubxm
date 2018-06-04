<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Model {

	function insert_task($user) {
		$datum = DateTime::createFromFormat('d/m/Y', $this->input->post('date'));
		$datum = date_format($datum,"Y-m-d");
		$data = array('subject' => $this->input->post('subject'),
					  'assignedto' => $this->input->post('assignemployee'),
					  'deadline' => $datum,
					  'status' => 0,
					  'comment' => '',
					  'description' => $this->input->post('description'),
					  'closedby' => "",
					  'createdby' => $user
					);

		$this->db->insert('tasks',$data);	
	}

	function get_all_active_tasks() {
		$this->db->where('status',0);
		return $this->db->get('tasks')->result();
	}

	function get_task($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('tasks');
		return $query->result();
	}	

	function closetask($user) {
		$data = array('closedby' => $user,
					  'status' => 1,
					  'comment' => $this->input->post('description'),
					);
		$this->db->where('id',$this->input->post('id'));
		$this->db->where('assignedto',$this->input->post('user'));

		$this->db->update('tasks',$data);		
	}

}