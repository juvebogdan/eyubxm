<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Directors extends MY_Controller {

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
		$this->load->model("director");
		//put username into global variable
		$this->user = isset($_SESSION['username']) ? substr($_SESSION['username'], 0) : "";
		$this->name = $this->director->get_user_name($this->user);

		$this->user_type = $this->users->get_user_type($this->user); //get user type
		if($this->user_type != 3) {
			redirect('bxmtime');
		}
  	}

	public function index()
	{
		$this->load->model("karnet");
		$data['name'] = $this->name;
		$data['karnet_table'] = $this->karnet->select_all();
		$this->load->view('director/director',$data);	
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

	private function email($user,$type,$status) {

		$this->load->model('employee');
		$employee  = $this->employee->get_employee($user);

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
        //$this->email->cc('krivokapic.bogdan10@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        $this->email->send();
	
	}	

}