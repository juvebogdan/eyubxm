<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sickleave extends MY_Model {

	function insert_sickleave($user) {
	    $datum1 = DateTime::createFromFormat('d/m/Y', $this->input->post('datestart'));
	    $submitted_date1 = date_parse_from_format('d/m/Y',$datum1->format('d/m/Y'));

	    if($this->input->post('dateend') != '') {
		    $datum2 = DateTime::createFromFormat('d/m/Y', $this->input->post('dateend'));
		    $submitted_date2 = date_parse_from_format('d/m/Y',$datum2->format('d/m/Y'));
		    $endDate = $submitted_date2['year'] . "-"  . $submitted_date2['month'] . "-" . $submitted_date2['day'];
	    }
	    else {
	    	$endDate = '';
	    }

		$startDate = $submitted_date1['year'] . "-"  . $submitted_date1['month'] . "-" . $submitted_date1['day'];	    

		$data = array('signum' => $user,
					  'start_date' => $startDate,
					  'end_date' => $endDate,
					  'workdays' => 0,
					  'status' => 0,
					  'comment' => '',
					  'sicktype' => $this->input->post('sicktype'),
					  'doznake' => isset($_POST['doznake']) ? 1 : 0
					);

		$this->db->insert('sickleave',$data);	
	}	

	function edit_sickleave($user) {
		if ($this->input->post('dateendedit') != '') {
		    $datum1 = DateTime::createFromFormat('d/m/Y', $this->input->post('dateendedit'));
		    $submitted_date1 = date_parse_from_format('d/m/Y',$datum1->format('d/m/Y'));

			$endDate = $submitted_date1['year'] . "-"  . $submitted_date1['month'] . "-" . $submitted_date1['day'];	    

			$data = array('end_date' => $endDate,
						  'doznake' => isset($_POST['doznake']) ? 1 : 0
						);
			$this->db->where('id',$this->input->post('id'));
			$this->db->where('signum',$user);

			$this->db->update('sickleave',$data);
		}
		else {
			$data = array('doznake' => isset($_POST['doznake']) ? 1 : 0);
			$this->db->where('id',$this->input->post('id'));
			$this->db->where('signum',$user);

			$this->db->update('sickleave',$data);
		}	
	}	

	function get_all($user) {
		$this->db->where('signum', $user);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('sickleave');
		return $query->result();
	}

	function get_all_managers() {
		$this->db->where('status',0);
		$this->db->order_by("id", "asc");
		$query = $this->db->get('sickleave');
		return $query->result();
	}	

	function delete_sickleave($id,$user) {
		$status = $this->get_sickleave($id);
		$this->db->where('id',$id);
		$this->db->where('signum',$user);
		$this->db->where('status',0);
		$query = $this->db->delete('sickleave');
		if ($status->end_date != '0000-00-00') {
			$this->deleteSickleave2($id,$user);
		}
	}

	function deleteSickleave2($id,$user) {
		$this->db->where('sick_id',$id);
		$this->db->where('signum',$user);
		$this->db->where('status',0);
		$query = $this->db->delete('sickleave2');
	}

	function get_sickleave($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('sickleave');
		return $query->result();
	}
	
	function edit_vacation_managers($status) {
		$data = array('status' => $status,
					  'comment' => $this->input->post('description'),
					);
		$this->db->where('id',$this->input->post('id'));
		$this->db->where('signum',$this->input->post('user'));

		$this->db->update('sickleave',$data);		
	}	

}