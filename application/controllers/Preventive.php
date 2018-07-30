<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('Bxmtime.php');

class Preventive extends Bxmtime {


	public function __Construct()
	{
		parent::__Construct();
	}

	public function index() {
		$this->load->model('preventivemodel');
		$data['name'] = $this->name;
		$data['sites'] = $this->preventivemodel->get_all_sites();
		$this->load->view('preventive',$data);
		//$this->load->view('testupload2',$data);
	}

	public function upload() {
		require_once APPPATH."/third_party/UploadHandler.php";
		$upload_handler = new UploadHandler(null,true,null, 'uploads/testni/');
	}

	public function preventive() {
		$this->load->model('preventivemodel');
		$data['name'] = $this->name;
		$data['sites'] = $this->preventivemodel->get_all_sites();
		$this->load->view('preventive',$data);
	}

	public function preventivemmodal($id) {
		$this->load->model('preventivemodel');
		$data['site'] = $this->preventivemodel->get_sitecode($id);	
		$result = $this->load->view('ajax/preventiveedit',$data, TRUE);
	    $this->output->set_content_type('application/json')//return json array
	                 ->set_output(json_encode(array("result" => $result,"status" => 1)));	
	}

	public function submitpregled() {
		$this->load->model('preventivemodel');
		$this->preventivemodel->izvrsi_pregled();
		$data['name'] = $this->name;
		$data['sites'] = $this->preventivemodel->get_all_sites();		
		$locations = $this->load->view('ajax/preventivetable',$data, TRUE);//load updated overtime table
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("status" => 'success', "table" => $locations)));	
	}


	public function checkimages($id) {
		$this->load->model('preventivemodel');
		$site = $this->preventivemodel->get_sitecode($id);	
		if ($site[0]->uradjen == '0') {
	        $this->load->helper('file'); 
	        $path=substr(APPPATH, 0, -12) . 'Maintenance/' . $site[0]->sitecode . '/';
	        delete_files($path, true);
	        rmdir($path);
	        $this->output->set_content_type('application/json')->set_output(json_encode(array("result" => 'obrisane slike',"status" => 1)));		
		}	
	}

}