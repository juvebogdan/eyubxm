<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managers extends MY_Controller {

	private $user;
	private $user_type;
	private $name;

	public function getUser() {
		return $this->user;
	}

	public function __Construct()
	{
		parent::__Construct();
		$this->load->model("users");
		$this->load->model("manager");
		//put username into global variable
		$this->user = isset($_SESSION['username']) ? substr($_SESSION['username'], 0) : "";
		$this->name = $this->manager->get_user_name($this->user);

		$this->user_type = $this->users->get_user_type($this->user); //get user type
		if($this->user_type != 1) {
			redirect('bxmtime');
		}
  	}

	public function index()
	{
		$this->load->model("overtime");
		$data['name'] = $this->name;
		$data['overtime_table'] = $this->overtime->get_all_overtime_managers("overtimeday");
		$this->load->view('managers/overtime/overtimeday',$data);	
	}
	public function overtimemodal($id,$type) {
		$this->load->model('overtime');
		//$sickedit = $this->sickleave->get_sickleave($id);
		$data['overtimeedit'] = $this->overtime->get_overtime($id,$type);	

		$result = $this->load->view('ajax/overtimeedit',$data, TRUE);
	    $this->output->set_content_type('application/json')//return json array
	                 ->set_output(json_encode(array("result" => $result,"status" => 1)));	
	}

	public function overtimeapprove() {
		$this->load->model('overtime');
		$this->overtime->edit_overtime(1);
		if ($this->input->post('type') == 'overtimeday' || $this->input->post('type') == 'overtimeday_holiday') {
			$type = 'overtimeday';
		}
		else if ($this->input->post('type') == 'overtimenight' || $this->input->post('type') == 'overtimenight_holiday') {
			$type = 'overtimenight';
		}
		$data['overtime_table'] = $this->overtime->get_all_overtime_managers($type);	
		$overtime_table = $this->load->view('ajax/overtimetablemanagers',$data, TRUE);//load updated overtime table
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("table" => $overtime_table)));	
        $this->email($this->input->post('user'),"overtime",1);			
	}
	public function overtimedecline() {
		$this->load->model('overtime');
		$this->overtime->edit_overtime(2);
		if ($this->input->post('type') == 'overtimeday' || $this->input->post('type') == 'overtimeday_holiday') {
			$type = 'overtimeday';
		}
		else if ($this->input->post('type') == 'overtimenight' || $this->input->post('type') == 'overtimenight_holiday') {
			$type = 'overtimenight';
		}		
		$data['overtime_table'] = $this->overtime->get_all_overtime_managers($type);	
		$overtime_table = $this->load->view('ajax/overtimetablemanagers',$data, TRUE);//load updated overtime table
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("table" => $overtime_table)));
        $this->email($this->input->post('user'),"overtime",2);             				
	}	

	public function overtimenight()
	{
		$this->load->model("overtime");
		$data['name'] = $this->name;
		$data['overtime_table'] = $this->overtime->get_all_overtime_managers("overtimenight");
		$this->load->view('managers/overtime/overtimenight',$data);	
	}

	public function overview() {
		$this->load->model("overtime");
		$data['name'] = $this->name;
		$data['overtime_table_day'] = $this->overtime->select_all('overtimeday');
		$data['overtime_table_night'] = $this->overtime->select_all('overtimenight');		
		$this->load->view('managers/overview',$data);		
	}

	public function vacation() {
		$this->load->model("vacation");
		$data['name'] = $this->name;
		$data['vacation_table'] = $this->vacation->get_all_managers();
		$this->load->view('managers/vacationmanagers',$data);		
	}		

	public function vacationmodal($id) {
		$this->load->model('vacation');
		//$sickedit = $this->sickleave->get_sickleave($id);
		$data['vacationedit'] = $this->vacation->get_vacation($id);	

		$result = $this->load->view('ajax/vacationedit',$data, TRUE);
	    $this->output->set_content_type('application/json')//return json array
	                 ->set_output(json_encode(array("result" => $result,"status" => 1)));	
	}	

	public function vacationapprove() {
		$this->load->model('vacation');
		$this->vacation->edit_vacation(1);
		$data['vacation_table'] = $this->vacation->get_all_managers();	
		$vacation_table = $this->load->view('ajax/vacationtablemanagers',$data, TRUE);//load updated overtime table
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("table" => $vacation_table)));
        $this->email($this->input->post('user'),"vacation",1);             				
	}
	public function vacationdecline() {
		$this->load->model('vacation');
		$this->vacation->edit_vacation(2);
		$data['vacation_table'] = $this->vacation->get_all_managers();	
		$vacation_table = $this->load->view('ajax/vacationtablemanagers',$data, TRUE);//load updated overtime table
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("table" => $vacation_table)));
        $this->email($this->input->post('user'),"vacation",2);                   					
	}	

	public function sickleave() {
		$this->load->model("sickleave");
		$data['name'] = $this->name;
		$data['sickleave_table'] = $this->sickleave->get_all_managers();
		$this->load->view('managers/sickleavemanagers',$data);		
	}		

	public function sickleavemodal($id) {
		$this->load->model('sickleave');
		//$sickedit = $this->sickleave->get_sickleave($id);
		$data['sickleaveedit'] = $this->sickleave->get_sickleave($id);	

		$result = $this->load->view('ajax/sickleaveeditmanagers',$data, TRUE);
	    $this->output->set_content_type('application/json')//return json array
	                 ->set_output(json_encode(array("result" => $result,"status" => 1)));	
	}	

	public function sickleaveapprove() {
		$this->load->model('sickleave');
		$this->sickleave->edit_vacation_managers(1);
		$data['sickleave_table'] = $this->sickleave->get_all_managers();	
		$sickleave_table = $this->load->view('ajax/sickleavetablemanagers',$data, TRUE);//load updated overtime table
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("table" => $sickleave_table)));
        $this->email($this->input->post('user'),"sick leave",1);              				
	}
	public function sickleavedecline() {
		$this->load->model('sickleave');
		$this->sickleave->edit_vacation_managers(2);
		$data['sickleave_table'] = $this->sickleave->get_all_managers();	
		$sickleave_table = $this->load->view('ajax/sickleavetablemanagers',$data, TRUE);//load updated overtime table
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("table" => $sickleave_table)));
        $this->email($this->input->post('user'),"sick leave",2);              					
	}		

	public function overviewkarnet() {
		$this->load->model("karnet");
		$data['name'] = $this->name;
		$data['karnet_table'] = $this->karnet->select_all();
		$this->load->view('managers/overviewmanagers',$data);		
	}

	public function tasks() {
		$this->load->model('employee');
		$data['employees'] = $this->employee->get_all_employees();
		$data['name'] = $this->name;
		$this->load->view('managers/tasks',$data);
	}

	public function addtask() {
		$this->form_validation->set_rules('subject','Task Subject','required|trim|max_length[30]');
		$this->form_validation->set_rules('date','Date','required|trim');
		$this->form_validation->set_rules('assignemployee','Employee','required|trim|max_length[100]');
		$this->form_validation->set_rules('description','Description','trim|alpha_dash_space');
		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else {
			$this->load->model('task');
			$this->task->insert_task($this->user);
			$data['type'] = "alert-success";
			$data['icon'] = "fa-check";
			$data['result'] = "Success";
			$data['message'] = "Successfully added";			
			$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
            $this->output->set_content_type('application/json')//return json array
                         ->set_output(json_encode(array("message" => $result_message)));			
		}		
	}

	public function taskmodal($id) {
		$this->load->model('task');
		$data['taskedit'] = $this->task->get_task($id);	
		$result = $this->load->view('ajax/taskedit',$data, TRUE);
	    $this->output->set_content_type('application/json')//return json array
	                 ->set_output(json_encode(array("result" => $result,"status" => 1)));	
	}

	public function tasksolve() {
		$this->form_validation->set_rules('description','Description','trim|alpha_dash_space');
		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else {
			$this->load->model('task');
			$this->task->closetask($this->user);
			$data['tasks'] = $this->task->get_all_active_tasks();
			$data['today'] = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
			$task_table = $this->load->view('ajax/tasksajaxtable',$data, TRUE);//load updated overtime table
	        $this->output->set_content_type('application/json')//return json array
	                     ->set_output(json_encode(array("table" => $task_table)));			
		}			
	}	

	public function taskoverview() {
		$this->load->model('task');
		$data['name'] = $this->name;
		$data['tasks'] = $this->task->get_all_active_tasks();
		$data['today'] = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
		$this->load->view('managers/taskoverview',$data);
	}

	public function export() {
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$worksheetname = 'Payroll ' . date('F Y');
		$this->excel->getActiveSheet()->setTitle($worksheetname);
		$this->excel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Tahoma');
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(45.29);
		$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(42.75);
		//set cell A1 content with some text

		$array = array("A"=>"Naziv","B"=>"Redovan rad","C"=>"Nocni rad","D"=>"Prinudni odmor","E"=>"Prekovremeno dan","F"=>"Prekovremeno noc","G"=>"Rad praznik","H"=>"Odmor","I"=>"Drzavni praznik","J"=>"Placeni odmor","K"=>"Trudnicko bolovanje","L"=>"Bolovanje do 70","M"=>"Bolovanje do 80","N"=>"Bolovanje do 90","O"=>"Bolovanje do 100","P"=>"Porodiljsko","Q"=>"Bolovanje preko 70","R"=>"Bolovanje preko 100","S"=>"Vjerski praznik","T"=>"Rad vjerski","U"=>"Korekcija","V"=>"Stimulacija","W"=>"Destimulacija","X"=>"Prevoz","Y"=>"Nocni praznik","Z"=>"Prekovremeno praznik","AA"=>"Prekovremeno praznik nocni");

		$keys = array_keys($array);

		for($i=0;$i<count($array);$i++) {
			$this->excel->getActiveSheet()->setCellValue($keys[$i] . "1", $array[array_keys($array)[$i]]);
			//change the font size
			$this->excel->getActiveSheet()->getStyle($keys[$i] . "1")->getFont()->setSize(8);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle($keys[$i] . "1")->getFont()->setBold(true);
			//set aligment to center for that merged cell (A1 to D1)
			$this->excel->getActiveSheet()->getStyle($keys[$i] . "1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($keys[$i] . "1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getColumnDimension($keys[$i])->setAutoSize(true);

			$this->excel->getActiveSheet()->getStyle($keys[$i] . "1")->applyFromArray(
			    array(
			        'borders' => array(
					    'outline' => array(
					      'style' => PHPExcel_Style_Border::BORDER_THIN
					    )
			        )
			    )
			);			
		}

		$this->load->model("karnet");

		$karnet = $this->karnet->select_all();

		$brojac = 2;

		foreach($karnet as $row) {

			$array = array("A"=>$row->Naziv,"B"=>$row->redovan_rad,"C"=>$row->nocni_rad,"D"=>$row->prinudni,"E"=>$row->prekovremeno_dan,"F"=>$row->prekovremeno_noc,"G"=>$row->rad_praznik,"H"=>$row->odmor,"I"=>$row->drzavni_praznik,"J"=>$row->placeno,"K"=>$row->trudnicko,"L"=>$row->bolovanje_do_70,"M"=>$row->bolovanje_do_80,"N"=>$row->bolovanje_do_90,"O"=>$row->bolovanje_do_100,"P"=>$row->porodiljsko,"Q"=>$row->bolovanje_preko_70,"R"=>$row->bolovanje_preko_100,"S"=>$row->vjerski_praznik,"T"=>$row->rad_vjerski,"U"=>$row->korekcija,"V"=>$row->stimulacija,"W"=>$row->destimulacija,"X"=>$row->prevoz,"Y"=>$row->nocni_praznik,"Z"=>$row->prekovremeno_praznik,"AA"=>$row->prekovremeno_praznik_nocni);

			$keys = array_keys($array);


			for($i=0;$i<count($array);$i++) {
				$this->excel->getActiveSheet()->setCellValue($keys[$i] . $brojac, $array[array_keys($array)[$i]]);
				//change the font size
				$this->excel->getActiveSheet()->getStyle($keys[$i] . $brojac)->getFont()->setSize(9);
				//set aligment to center for that merged cell (A1 to D1)
				$this->excel->getActiveSheet()->getStyle($keys[$i] . $brojac)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle($keys[$i] . $brojac)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->getColumnDimension($keys[$i])->setAutoSize(true);

				$this->excel->getActiveSheet()->getStyle($keys[$i] . $brojac)->applyFromArray(
				    array(
				        'borders' => array(
						    'outline' => array(
						      'style' => PHPExcel_Style_Border::BORDER_THIN
						    )
				        )
				    )
				);			
			}
			$brojac++;

		}


		$filename='Karnet_ECG ' . date('m') . " " . date('Y') . ".xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');		
	}

	public function overviewdaysoff() {
		$this->load->model("employee");
		$this->load->model("manager");
		$manager_id = $this->manager->get_manager_id($this->name);
		$data['name'] = $this->name;
		$data['employee_table'] = $this->employee->select_all($manager_id);
		$this->load->view('managers/freedays',$data);		
	}

	public function kilometraza() {
		$this->load->model('cars');
		$data['name'] = $this->name;
		$data['cars'] = $this->cars->get_all_cars();
		$registracije = $this->cars->get_registracije();
		$data['pregled'] = array(); 
		foreach ($registracije as $row) {
			array_push($data['pregled'],$this->cars->get_recent_kilometraza($row->registracija));
		}
		$this->load->view('managers/kilometraza',$data);
	}

	public function carproblems() {
		$this->load->model('cars');
		$data['name'] = $this->name;
		$data['carproblems'] = $this->cars->get_all_problems();
		$this->load->view('managers/carproblems',$data);
	}	

	public function cars() {
		$this->load->model('cars');
		$data['name'] = $this->name;
		$data['cars'] = $this->cars->get_all_cars();
		$this->load->view('managers/cars',$data);
	}					

	private function email($user,$type,$status) {

		$this->load->model('employee');
		$this->load->model('manager');
		$employee  = $this->employee->get_employee($user);

		$managerid = $employee[0]->m_id;

		$manageremail = $this->manager->get_manager_by_id($managerid);

        // Set SMTP Configuration
        $emailConfig = [
            'protocol' => 'mail', 
            'smtp_host' => 'mail.mtel.me', 
            'smtp_port' => 25, 
            'smtp_user' => '', 
            'smtp_pass' => '', 
            'mailtype' => 'html', 
            'charset' => 'iso-8859-1'
        ];

        // Set your email information
        $from = [
            'email' => 'FSOTimeReport@ericsson.com',
            'name' => 'FSO Time Report'
        ];
       
        $to = array($employee[0]->email);
        $subject = "FSO Approval";
        //$message = 'Type your gmail message here';
        $data['status'] = $status == 1 ? "approved" : "declined";
        $data['type'] = $type;
        $message =  $this->load->view('email/manager',$data,true);
        // Load CodeIgniter Email library
        $this->load->library('email', $emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        

        if ($type=='vacation' && $status==1) {
        	$this->load->model('vacation');
        	$vacation = $this->vacation->getvacationfiles($this->input->post('id'));
 			foreach($vacation as $row) {
				$this->email->attach($this->config->item('server_root') . "/eyubxm/uploads/" . $row->filename);				
			}
			$this->email->cc(array($manageremail,'bogdan.djukic@ericsson.com','aleksandar.milojevic@ericsson.com','dusan.milosevic@ericsson.com','veljko.milosavljevic@ericsson.com'));       	
        }
        else if ($type=='payed leave' && $status==1) {
        	$this->load->model('payedleave');
        	$payedleave = $this->payedleave->getpayedleavefiles($this->input->post('id'));
 			foreach($payedleave as $row) {
				$this->email->attach($this->config->item('server_root') . "/eyubxm/uploads/" . $row->filename);				
			}
			$this->email->cc(array($manageremail,'bogdan.djukic@ericsson.com','aleksandar.milojevic@ericsson.com','dusan.milosevic@ericsson.com','veljko.milosavljevic@ericsson.com'));          	
        }
        else {
        	$this->email->cc($manageremail);
        }



        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        $this->email->send();
	
	}
	private function emailDirectorapprove($user,$type,$status) {

		$this->load->model('employee');
		$this->load->model('manager');
		$employee  = $this->employee->get_employee($user);

		$managerid = $employee[0]->m_id;

		$manageremail = $this->manager->get_manager_by_id($managerid);

        // Set SMTP Configuration
        $emailConfig = [
            'protocol' => 'mail', 
            'smtp_host' => 'mail.mtel.me', 
            'smtp_port' => 25, 
            'smtp_user' => '', 
            'smtp_pass' => '', 
            'mailtype' => 'html', 
            'charset' => 'iso-8859-1'
        ];

        // Set your email information
        $from = [
            'email' => 'FSOTimeReport@ericsson.com',
            'name' => 'FSO Time Report'
        ];
       
        $to = array($employee[0]->email);
        $subject = "FSO Approval";
        //$message = 'Type your gmail message here';
        $data['type'] = $type;
        $message =  $this->load->view('email/director',$data,true);
        // Load CodeIgniter Email library
        $this->load->library('email', $emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->cc(array($manageremail,'bogdan.djukic@ericsson.com','aleksandar.milojevic@ericsson.com','dusan.milosevic@ericsson.com','veljko.milosavljevic@ericsson.com'));
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        $this->email->send();
	
	}	

	private function show_error_alert($message) {
		$data['type'] = "alert-danger";
		$data['icon'] = "fa-ban";
		$data['result'] = "Alert";
		$data['message'] = $message;
		$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
        $this->output->set_content_type('application/json')//return json array
                     ->set_output(json_encode(array("message" => $result_message)));
	}	


}