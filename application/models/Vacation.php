<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacation extends MY_Model {

	function insert_vacation($user,$files,$filenames) {
		$datum = explode(' - ',$this->input->post('date'));

	    $datum1 = DateTime::createFromFormat('d/m/Y', $datum[0]);
	    $submitted_date1 = date_parse_from_format('d/m/Y',$datum1->format('d/m/Y'));

	    $datum2 = DateTime::createFromFormat('d/m/Y', $datum[1]);
	    $submitted_date2 = date_parse_from_format('d/m/Y',$datum2->format('d/m/Y'));

		$startDate = $submitted_date1['year'] . "-"  . $submitted_date1['month'] . "-" . $submitted_date1['day'];
		$endDate = $submitted_date2['year'] . "-"  . $submitted_date2['month'] . "-" . $submitted_date2['day'];	    

		$data = array('signum' => $user,
					  'start_date' => $startDate,
					  'end_date' => $endDate,
					  'workdays' => 0,
					  'status' => 0,
					  'comment' => '',
					  'vacationtype' => $this->input->post('vacationtype'),
					  'num_files' => $files,
					);

		$this->db->insert('vacation',$data);
		$this->insertfiles($this->db->insert_id(),$filenames);	
	}	

	function get_all($user) {
		$this->db->where('signum', $user);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('vacation');
		return $query->result();
	}

	function insertfiles($id,$filenames) {
		foreach($filenames as $file) {
			$data = array(
				'vac_id' => $id,
				'filename' => $file
			);
			$this->db->insert('vacationfiles',$data);
		}
	}

	function get_all_managers() {
		$this->db->where('status',0);
		$this->db->order_by("id", "asc");
		$query = $this->db->get('vacation');
		return $query->result();
	}	

	function delete_vacation($id,$user) {
		$this->db->where('id',$id);
		$this->db->where('signum',$user);
		$this->db->where('status',0);
		$query = $this->db->delete('vacation');
		$this->deleteVacation2($id,$user);
	}

	function deletevacationfiles($id) {
		$this->db->where('vac_id',$id);
		$query = $this->db->delete('vacationfiles');
	}

	function deleteVacation2($id,$user) {
		$this->db->where('vac_id',$id);
		$this->db->where('signum',$user);
		$this->db->where('status',0);
		$query = $this->db->delete('vacation2');
	}

	function get_vacation($id) {
		$this->db->where('id',$id);
		return $this->db->get('vacation')->result();
	}

	function getvacationfiles($id) {
		$this->db->where('vac_id',$id);
		return $this->db->get('vacationfiles')->result();
	}	

	function edit_vacation($status) {
		$data = array('status' => $status,
					  'comment' => $this->input->post('description'),
					);
		$this->db->where('id',$this->input->post('id'));
		$this->db->where('signum',$this->input->post('user'));

		$this->db->update('vacation',$data);		
	}	

}