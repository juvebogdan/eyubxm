<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bxmtime extends MY_Controller {

	private $user;
	private $user_type;
	private $name;

	public function getUser() {
		return $this->user;
	}

	public function __Construct()
	{
		parent::__Construct();
		if (isset($_SESSION['language'])) {
			if ($_SESSION['language'] == "mn") {
				$this->config->set_item('language', 'montenegrin');
				$this->lang->load('view_file','montenegrin');
			}
			else {
				$this->config->set_item('language', 'english');
				$this->lang->load('view_file','english');
			}
		}
		else {
			$this->config->set_item('language', 'english');
			$this->lang->load('view_file','english');
		}
		$this->load->model("users");
		$this->load->model("employee");
		//put username into global variable
		$this->user = isset($_SESSION['username']) ? substr($_SESSION['username'], 0) : "";
		$this->name = $this->employee->get_user_name($this->user);

		$this->user_type = $this->users->get_user_type($this->user); //get user type
		if($this->user_type == 1) {
			redirect('managers');
		}
		else if ($this->user_type == 2) {

		}
		else if ($this->user_type == 3) {
			redirect('directors');
		}		
		else {
			//redirect('https://fsobxmeyu.com/index.php','refresh');
			redirect('http://localhost/index.php','refresh');
		}
  	}

	public function index()
	{
		$this->load->model("overtime");
		$data['name'] = $this->name;
		$data['overtime_table'] = $this->overtime->get_all_overtime($this->user,"overtimeday");
		$this->load->view('overtime/overtimeday',$data);		
	}
	//adding submitted overtime to overtime table
	public function addovertime($type)
	{
		$this->form_validation->set_rules('overtime','Number of overtime hours','required|trim|numeric');
		//is_current_month custom rule to enable submit for current month only
		$this->form_validation->set_rules('date','Date','required|trim|is_current_month');
		$this->form_validation->set_rules('ticket','Ticket number','required|trim|numeric');
		//alpha_dash_space custom rule to enable only letters and spaces
		$this->form_validation->set_rules('description','Description','trim|alpha_dash_space|max_length[100]');

		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else{
			$this->load->model('overtime');
			if($this->overtime->check_drzavni_praznik() > 0 || $this->overtime->check_vjerski_praznik() > 0) {
				$status = $this->overtime->insert_overtime_holiday($this->user,$type);
			}
			else {
				$status = $this->overtime->insert_overtime($this->user,$type);
			}
			$data['overtime_table'] = $this->overtime->get_all_overtime($this->user,$type);		
			$data['type'] = "alert-success";
			$data['icon'] = "fa-check";
			$data['result'] = "Success";
			$data['message'] = "Successfully added";
			$data['overtimetype'] = $type;
			$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
			$overtime_table = $this->load->view('ajax/overtimetable',$data, TRUE);//load updated overtime table
            $this->output->set_content_type('application/json')//return json array
                         ->set_output(json_encode(array("message" => $result_message, "table" => $overtime_table)));
            $this->email($this->user,"Overtime"); 				
		}		

	}
	//delete entry from overtime table
	public function delete($id,$type) {
		$this->load->model('overtime');
		$this->overtime->delete_entry($id,$this->user,$type);
		if($type=="overtimeday" || $type=="overtimeday_holiday") {
			redirect('bxmtime');
		}
		else {
			redirect('bxmtime/overtimenight');
		}
	}

	public function overtimenight() {
		$this->load->model("overtime");
		$data['name'] = $this->name;
		$data['overtime_table'] = $this->overtime->get_all_overtime($this->user,"overtimenight");
		$this->load->view('overtime/overtimenight',$data);
	}

	public function overview() {
		$this->load->model("overtime");
		$data['name'] = $this->name;
		$data['overtime_table_day'] = $this->overtime->select_all('overtimeday');
		$data['overtime_table_night'] = $this->overtime->select_all('overtimenight');		
		$this->load->view('overview',$data);		
	}

	private function dateDiff ($d1, $d2) {
  		return round(abs(strtotime($d1)-strtotime($d2))/86400);
	}

	public function vacation() {
		$this->load->model("vacation");
		$this->load->model("employee");
		$data['name'] = $this->name;
		$data['employee'] = $this->employee->get_employee($this->user);
		$data['vacation_table'] = $this->vacation->get_all($this->user);
		$this->load->view('vacation',$data);		
	}

	public function delete_vacation($id) {
		$this->load->model('vacation');
		$this->vacation->deletevacationfiles($id);
		$this->vacation->delete_vacation($id,$this->user);
		redirect('bxmtime/vacation');		
	}

	public function addvacation() {

		$this->form_validation->set_rules('date','Date','required|trim|is_inside_two_months');
		$this->form_validation->set_rules('vacationtype','Vacation Type','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else {
			if(isset($_FILES['multipleFiles']) && count($_FILES['multipleFiles']['name']) > 0){
				$this->load->helper('string');
				$error = array();
				$filenames = array();
				$this->load->library('upload');

				$number_of_files = count($_FILES['multipleFiles']['name']);

				$files = $_FILES;

				if(!is_dir('uploads')) {
					mkdir('./uploads',0777,true);
				}

				for($i=0; $i < $number_of_files; $i++) {

					$_FILES['multipleFiles']['name'] = $files['multipleFiles']['name'][$i];
					$_FILES['multipleFiles']['type'] = $files['multipleFiles']['type'][$i];
					$_FILES['multipleFiles']['tmp_name'] = $files['multipleFiles']['tmp_name'][$i];
					$_FILES['multipleFiles']['error'] = $files['multipleFiles']['error'][$i];
					$_FILES['multipleFiles']['size'] = $files['multipleFiles']['size'][$i];

					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '5120';
					$config['max_widht'] = '1920';
					$config['max_height'] = '1080';
					$config['overwrite'] = TRUE;
					$config['remove_spaces'] = TRUE;

					//$config['file_name'] = 'Vacation' . $this->input->post('vacationtype') . '_' . $this->user . '_' . date('M') . '_' . $i;

					array_push($filenames,random_string('unique',15) . "." . strtolower(pathinfo($_FILES['multipleFiles']['name'],PATHINFO_EXTENSION)));

					$config['file_name'] = end($filenames);

					$this->upload->initialize($config);

					if(!$this->upload->do_upload('multipleFiles')) {
						$error['error'] = $this->upload->display_errors();
						foreach ($filenames as $file) { 
							//unlink(FCPATH . 'uploads' . '\/' . $file);
						}				
					}
					else {
						//nothing
					}
				}

				if(!empty($error)) {
					$this->show_error_alert($error['error']);					
				}
				else{
					$this->load->model('vacation');
					$this->vacation->insert_vacation($this->user,$number_of_files,$filenames);
					$data['type'] = "alert-success";
					$data['icon'] = "fa-check";
					$data['result'] = "Success";
					$data['message'] = "Successfully added";
					$data['vacation_table'] = $this->vacation->get_all($this->user);
					$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
					$vacation_table = $this->load->view('ajax/vacationtable',$data, TRUE);//load updated overtime table
		            $this->output->set_content_type('application/json')//return json array
		                         ->set_output(json_encode(array("message" => $result_message, "table" => $vacation_table)));
		            $this->emailattach($this->user,"Vacation",$number_of_files,$filenames);
				}
			}
			else {
				$this->show_error_alert("<p>You must upload personal notice</p>");
			}
		}
	}	

	public function sickleave() {
		$this->load->model("sickleave");
		$data['name'] = $this->name;
		$data['sickleave_table'] = $this->sickleave->get_all($this->user);
		$this->load->view('sickleave',$data);		
	}

	public function addsickleave()
	{
		$this->form_validation->set_rules('datestart','Start Date','required|trim|is_current_month_sick');
		$this->form_validation->set_rules('dateend','End Date','trim');
		$this->form_validation->set_rules('sicktype','Sick Leave Type','trim|required');
		$this->form_validation->set_rules('doznake','Dnevnica','trim');

		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else{
			$datum1 = DateTime::createFromFormat('d/m/Y', $this->input->post('datestart'));
			if ($this->input->post('dateend') != '') {
				$datum2 = DateTime::createFromFormat('d/m/Y', $this->input->post('dateend'));
				$diff=date_diff($datum1,$datum2);
				if ($diff->invert == 1) {
					$this->show_error_alert("Start Date is bigger that End Date");
				}
				else {
					$this->load->model('sickleave');
					$status = $this->sickleave->insert_sickleave($this->user);
					$data['sickleave_table'] = $this->sickleave->get_all($this->user);		
					$data['type'] = "alert-success";
					$data['icon'] = "fa-check";
					$data['result'] = "Success";
					$data['message'] = "Successfully added";
					$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
					$sickleave_table = $this->load->view('ajax/sickleavetable',$data, TRUE);//load updated overtime table
		            $this->output->set_content_type('application/json')//return json array
		                         ->set_output(json_encode(array("message" => $result_message, "table" => $sickleave_table)));
		            $this->email($this->user,"Sickleave");
				}				
			}
			else {
					$this->load->model('sickleave');
					$status = $this->sickleave->insert_sickleave($this->user);
					$data['sickleave_table'] = $this->sickleave->get_all($this->user);		
					$data['type'] = "alert-success";
					$data['icon'] = "fa-check";
					$data['result'] = "Success";
					$data['message'] = "Successfully added";
					$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
					$sickleave_table = $this->load->view('ajax/sickleavetable',$data, TRUE);//load updated overtime table
		            $this->output->set_content_type('application/json')//return json array
		                         ->set_output(json_encode(array("message" => $result_message, "table" => $sickleave_table)));
		            $this->email($this->user,"Sickleave");				
			}							
		}		

	}	

	public function deletesickleave($id) {
		$this->load->model('sickleave');
		$this->sickleave->delete_sickleave($id,$this->user);
		redirect('bxmtime/sickleave');		
	}

	public function sickleavemodal($id) {
		$this->load->model('sickleave');
		//$sickedit = $this->sickleave->get_sickleave($id);
		$data['sickedit'] = $this->sickleave->get_sickleave($id);

		if ($data['sickedit'][0]->status == 0 || $data['sickedit'][0]->end_date != '0000-00-00') {
			$result = $this->load->view('ajax/sickleaveedit_status0',$data, TRUE);
		    $this->output->set_content_type('application/json')//return json array
		                 ->set_output(json_encode(array("result" => $result,"status" => 1)));
		}
		else {
			$result = $this->load->view('ajax/sickleaveedit',$data, TRUE);
		    $this->output->set_content_type('application/json')//return json array
		                 ->set_output(json_encode(array("result" => $result,"status" => 1)));
		}				
	}

	public function sickleaveedit() {
		$this->form_validation->set_rules('dateendedit','Date End','trim|is_current_month_sick_edit');

		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else{
			$this->load->model('sickleave');
			$query = $this->sickleave->get_sickleave($this->input->post('id'));			
			$datum1 = DateTime::createFromFormat('Y-m-d', $query[0]->start_date);
			if ($this->input->post('dateendedit') != '') {
				$datum2 = DateTime::createFromFormat('d/m/Y', $this->input->post('dateendedit'));
				$diff=date_diff($datum1,$datum2);
				if ($diff->invert == 1) {
					$this->show_error_alert("Start Date is bigger that End Date");
				}			
				else {
					$status = $this->sickleave->edit_sickleave($this->user);
					$data['sickleave_table'] = $this->sickleave->get_all($this->user);		
					$data['type'] = "alert-success";
					$data['icon'] = "fa-check";
					$data['result'] = "Success";
					$data['message'] = "Successfully added";
					$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
					$sickleave_table = $this->load->view('ajax/sickleavetable',$data, TRUE);//load updated overtime table
		            $this->output->set_content_type('application/json')//return json array
		                         ->set_output(json_encode(array("message" => $result_message, "table" => $sickleave_table)));
				}
			}
			else {
					$status = $this->sickleave->edit_sickleave($this->user);
					$data['sickleave_table'] = $this->sickleave->get_all($this->user);		
					$data['type'] = "alert-success";
					$data['icon'] = "fa-check";
					$data['result'] = "Success";
					$data['message'] = "Successfully added";
					$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);//load view for message to user
					$sickleave_table = $this->load->view('ajax/sickleavetable',$data, TRUE);//load updated overtime table
		            $this->output->set_content_type('application/json')//return json array
		                         ->set_output(json_encode(array("message" => $result_message, "table" => $sickleave_table)));				
			}		
		}				
	}

	public function taskoverview() {
		$this->load->model('task');
		$data['name'] = $this->name;
		$data['tasks'] = $this->task->get_all_active_tasks();
		$data['today'] = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
		$this->load->view('taskoverview',$data);
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
	        $this->emailtaskclose($this->user,$this->input->post('description'),$this->input->post('id'));			
		}			
	}

	public function cars() {
		$this->load->model('cars');
		$data['name'] = $this->name;
		$data['cars'] = $this->cars->get_all_cars();
		$this->load->view('cars',$data);
	}

	public function addcar() {
		$this->form_validation->set_rules('register','Registracija','trim|alpha_dash_space|is_unique[cars.registracija]|required');
		$this->form_validation->set_rules('type','Tip vozila','trim|alpha_dash|required');
		$this->form_validation->set_rules('kmstatus','Kilometraza','trim|numeric|required');
		$this->form_validation->set_rules('mark','Marka automobila','trim|alpha_dash|required|max_length[30]');
		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else {
			$this->load->model('cars');
			$this->cars->insert_car();
			$data['cars'] = $this->cars->get_all_cars();
			$data['type'] = "alert-success";
			$data['icon'] = "fa-check";
			$data['result'] = "Success";
			$data['message'] = "Successfully added";
			$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);			
			$cars_table = $this->load->view('ajax/carsajaxtable',$data, TRUE);
            $this->output->set_content_type('application/json')//return json array
                         ->set_output(json_encode(array("message" => $result_message, "table" => $cars_table)));			
		}				
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
		$this->load->view('kilometraza',$data);
		//var_dump($data['pregled']);
	}

	public function addkms() {
		$this->form_validation->set_rules('register','Registracija','trim|alpha_dash_space|required');
		$this->form_validation->set_rules('kmstatus','Kilometraza','trim|numeric|required|provjera_kms_stanja');
		$this->form_validation->set_rules('date','Datum','required|trim');
		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else {
			$this->load->model('cars');
			$this->cars->insert_kilometraza();
			$registracije = $this->cars->get_registracije();
			$data['pregled'] = array(); 
			foreach ($registracije as $row) {
				array_push($data['pregled'],$this->cars->get_recent_kilometraza($row->registracija));
			}
			$data['type'] = "alert-success";
			$data['icon'] = "fa-check";
			$data['result'] = "Success";
			$data['message'] = "Successfully added";
			$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);			
			$kilometraza_table = $this->load->view('ajax/kilometrazaajaxtable',$data, TRUE);
            $this->output->set_content_type('application/json')//return json array
                         ->set_output(json_encode(array("message" => $result_message, "table" => $kilometraza_table)));		
		}		
	}

	public function carproblems() {
		$this->load->model('cars');
		$data['name'] = $this->name;
		$data['cars'] = $this->cars->get_all_cars();
		$data['carproblems'] = $this->cars->get_all_problems();
		$this->load->view('carproblems',$data);
	}

	public function addcarproblem() {
		$this->form_validation->set_rules('register','Registracija','trim|alpha_dash_space|required');
		$this->form_validation->set_rules('description','Description','trim|alpha_dash_space|required');
		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else {
			$this->load->model('cars');
			$this->cars->insert_problem($this->user);
			$data['carproblems'] = $this->cars->get_all_problems();
			$data['type'] = "alert-success";
			$data['icon'] = "fa-check";
			$data['result'] = "Success";
			$data['message'] = "Successfully added";
			$result_message = $this->load->view('errors/submitajaxview',$data, TRUE);			
			$carsproblem_table = $this->load->view('ajax/carsproblemajaxtable',$data, TRUE);
            $this->output->set_content_type('application/json')//return json array
                         ->set_output(json_encode(array("message" => $result_message, "table" => $carsproblem_table)));
            $this->emailcarproblemsubmit($this->user,$this->input->post('description'),$this->input->post('register'));				
		}		
	}

	public function problemmodal($id) {
		$this->load->model('cars');
		$data['problemedit'] = $this->cars->get_problem($id);	
		$result = $this->load->view('ajax/problemedit',$data, TRUE);
	    $this->output->set_content_type('application/json')//return json array
	                 ->set_output(json_encode(array("result" => $result,"status" => 1)));	
	}	

	public function problemsolve() {
		$this->form_validation->set_rules('description','Description','trim|alpha_dash_space');
		if($this->form_validation->run()==FALSE){
			$this->show_error_alert(validation_errors());
		}
		else {
			$this->load->model('cars');
			$this->cars->closeproblem($this->user);
			$data['carproblems'] = $this->cars->get_all_problems();
			$problem_table = $this->load->view('ajax/carsproblemajaxtable',$data, TRUE);//load updated overtime table
	        $this->output->set_content_type('application/json')//return json array
	                     ->set_output(json_encode(array("table" => $problem_table)));
	        $this->emailproblemclose($this->user,$this->input->post('description'),$this->input->post('id'));			
		}			
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

	public function changetoenglish() {
		$_SESSION['language'] = "en";
		redirect('bxmtime');
	}

	public function changetomontenegrin() {
		$_SESSION['language'] = "mn";
		redirect('bxmtime');
	}	

	private function email($user,$type) {

		$this->load->model('employee');
		$this->load->model('manager');
		$employee  = $this->employee->get_employee($user);

		$fullname = $employee[0]->name;
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
       
        $to = array($manageremail);
        $subject = $type . " requested";
        //$message = 'Type your gmail message here';
        $data['employee'] = $fullname;
        $data['type'] = $type;
        $message =  $this->load->view('email/employee',$data,true);
        // Load CodeIgniter Email library
        $this->load->library('email', $emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->cc($employee[0]->email);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        //$this->config->set_item('language', 'english');
        $this->email->send();

	
	}

	private function emailattach($user,$type,$number_of_files,$filenames) {

		$this->load->model('employee');
		$this->load->model('manager');
		$employee  = $this->employee->get_employee($user);

		$fullname = $employee[0]->name;
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
       
        $to = array($manageremail);
        $subject = $type . " requested";
        //$message = 'Type your gmail message here';
        $data['employee'] = $fullname;
        $data['type'] = $type;
        $message =  $this->load->view('email/employee',$data,true);
        // Load CodeIgniter Email library
        $this->load->library('email', $emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->cc($employee[0]->email);
        $this->email->subject($subject);
        $this->email->message($message);

		foreach($filenames as $file) {
			$this->email->attach($this->config->item('server_root') . "/eyubxm/uploads/" . $file);				
		}

        // Ready to send email and check whether the email was successfully sent
        //$this->config->set_item('language', 'english');
        $this->email->send();
	
	}	

	private function emailtaskclose($user,$comment,$id) {

		$this->load->model('employee');
		$this->load->model('manager');
		$this->load->model('task');
		$tasksubject = $this->task->get_task($id);
		$tasksubject = $tasksubject[0]->subject;
		$employee  = $this->employee->get_employee($user);

		$fullname = $employee[0]->name;
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
       
        $to = array($manageremail);
        $subject = "Task " . $tasksubject . " has been closed";
        //$message = 'Type your gmail message here';
        $data['employee'] = $fullname;
        $data['subject'] = $tasksubject;
        $data['comment'] = $comment;
        $message =  $this->load->view('email/taskemail',$data,true);
        // Load CodeIgniter Email library
        $this->load->library('email', $emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->cc($employee[0]->email);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        //$this->config->set_item('language', 'english');
        $this->email->send();

	
	}

	private function emailcarproblemsubmit($user,$description,$register) {

		$this->load->model('employee');
		$this->load->model('manager');

		$employee  = $this->employee->get_employee($user);

		$fullname = $employee[0]->name;
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
       
        $to = array($manageremail);
        $subject = "Problem prijavljen";
        //$message = 'Type your gmail message here';
        $data['employee'] = $fullname;
        $data['register'] = $register;
        $data['description'] = $description;
        $message =  $this->load->view('email/carproblemsubmit',$data,true);
        // Load CodeIgniter Email library
        $this->load->library('email', $emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->cc($employee[0]->email);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        //$this->config->set_item('language', 'english');
        $this->email->send();

	
	}

	private function emailproblemclose($user,$comment,$id) {

		$this->load->model('employee');
		$this->load->model('manager');
		$this->load->model('cars');
		$problem = $this->cars->get_problem($id);
		$register = $problem[0]->registracija;
		$employee  = $this->employee->get_employee($user);

		$fullname = $employee[0]->name;
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
       
        $to = array($manageremail);
        $subject = "Problem with car " . $register . " has been closed";
        //$message = 'Type your gmail message here';
        $data['employee'] = $fullname;
        $data['register'] = $register;
        $data['comment'] = $comment;
        $message =  $this->load->view('email/problememail',$data,true);
        // Load CodeIgniter Email library
        $this->load->library('email', $emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->cc($employee[0]->email);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        //$this->config->set_item('language', 'english');
        $this->email->send();

	
	}			


}