<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preventivemodel extends MY_Model {

	function get_all_sites() {
		return $this->db->get('preventive')->result();
	}

	function get_all_types() {
		$this->db->distinct('tip');
		$this->db->select('tip');
		return $this->db->get('preventive')->result();
	}		

	function get_sitecode($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('preventive');
		return $query->result();		
	}

	function izvrsi_pregled() {
		$datum = DateTime::createFromFormat('d/m/Y', $this->input->post('date'));
		$datum = date_format($datum,"Y-m-d");		
		$data = array('uradjen' => '1',
					  'provereni_alarmi' => $this->input->post('alarmi'),
					  'vizuelna_provera' => $this->input->post('visual'),
					  'izmerena_struja' => $this->input->post('struja'),
					  'status' => $this->input->post('status'),
					  'datum' => $datum
					);
		$this->db->where('id',$this->input->post('id'));

		$this->db->update('preventive',$data);				
	}

	function get_filtered_sites($tip, $status) {
		if ($tip != 'all') {
			$this->db->where('tip',$tip);
		}
		if ($status != 'all') {
			$this->db->where('uradjen',$status);
		}
		$query = $this->db->get('preventive');
		return $query->result();		
	}	

}

