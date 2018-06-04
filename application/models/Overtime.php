<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overtime extends MY_Model {

	function insert_overtime($user,$type) {
		$datum = DateTime::createFromFormat('d/m/Y', $this->input->post('date'));
		$datum = date_format($datum,"Y-m-d");
		$data = array('signum' => $user,
					  'number' => $this->input->post('overtime'),
					  'date' => $datum,
					  'status' => 0,
					  'ticket_number' => $this->input->post('ticket'),
					  'description' => $this->input->post('description'),
					  'comment' => ""
					);

		$this->db->insert($type,$data);	
	}

	function insert_overtime_holiday($user,$type) {
		$datum = DateTime::createFromFormat('d/m/Y', $this->input->post('date'));
		$datum = date_format($datum,"Y-m-d");
		$data = array('signum' => $user,
					  'number' => $this->input->post('overtime'),
					  'date' => $datum,
					  'status' => 0,
					  'ticket_number' => $this->input->post('ticket'),
					  'description' => $this->input->post('description'),
					  'comment' => ""
					);

		$this->db->insert($type.'_holiday',$data);	
	}		

	function get_all_overtime($user,$table) {
		$query = $this->db->query('select * from ' . $table . ' where MONTH(date)=' . date('m') . " and signum='" . $user . "'" . ' union select * from ' . $table . '_holiday where MONTH(date)=' . date('m') . " and signum='" . $user . "'" . " order by id desc");
		return $query->result();
	}

	function get_all_overtime_managers($table) {
		$query = $this->db->query('select * from ' . $table . ' where MONTH(date)=' . date('m') . ' and status=0 union select * from ' . $table . '_holiday where MONTH(date)=' . date('m') . ' and status=0');
		return $query->result();
	}	
	

	function delete_entry($id,$user,$type) {
		$this->db->where('id',$id);
		$this->db->where('signum',$user);
		$this->db->where('status',0);
		$query = $this->db->delete($type);
	}

	function select_all($table) {
		$query = $this->db->query('select * from ' . $table . ' where MONTH(date)=' . date('m') . " and status=1 " . ' union select * from ' . $table . '_holiday where MONTH(date)=' . date('m') . " and status=1");
		return $query->result();		
	}
	function check_drzavni_praznik() {
		$datum = DateTime::createFromFormat('d/m/Y', $this->input->post('date'));
		$datum = date_format($datum,"Y-m-d");		
		return $this->db->select('*')->from('drzavni_praznici')->where('datum',$datum)->count_all_results();
	}
	function check_vjerski_praznik() {
		$datum = DateTime::createFromFormat('d/m/Y', $this->input->post('date'));
		$datum = date_format($datum,"Y-m-d");		
		return $this->db->select('*')->from('vjerski_praznici')->where('datum',$datum)->count_all_results();
	}

	function get_overtime($id,$type) {
		$this->db->where('id',$id);
		$query = $this->db->get($type);
		return $query->result();
	}

	function edit_overtime($status) {
		$data = array('number' => $this->input->post('overtime'),
					  'status' => $status,
					  'comment' => $this->input->post('description'),
					);
		$this->db->where('id',$this->input->post('id'));
		$this->db->where('signum',$this->input->post('user'));

		$this->db->update($this->input->post('type'),$data);		
	}

}