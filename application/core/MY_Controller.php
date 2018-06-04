<?php

	class MY_Controller extends CI_Controller
	{

		public function __Construct()
		{
			parent::__Construct();
			session_start();
			date_default_timezone_set('Europe/Belgrade');
			if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
				//redirect('https://fsobxmeyu.com/index.php','refresh');
				redirect('http://localhost/index.php','refresh');
			}

	  	}



	}




?>