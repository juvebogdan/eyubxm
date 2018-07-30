<?php
class MY_Form_validation extends CI_Form_validation{ 

    protected $CI;

    public function __construct($config = array())
    {
            parent::__construct($config);

            $this->CI =& get_instance();
    }

    public function alpha_dash_space($str)
	{
	    return ( ! preg_match("/^([-a-z0-9_ ,.])+$/i", $str)) ? FALSE : TRUE;
	} 
	public function is_current_month($str)
	{
	    $datum = DateTime::createFromFormat('d/m/Y', $str);
	    $submitted_date = date_parse_from_format('d/m/Y',$datum->format('d/m/Y'));
	    $submitted_month = $submitted_date['month'];
	    $submitted_year = $submitted_date['year'];
	    $server_month = date('m');
	    if ($submitted_year != date('Y')) {
	    	return FALSE;
	    }
	    else if($submitted_month != $server_month && ($server_month - $submitted_month != 1)){
	    	return FALSE;
	    }
	    else if ($submitted_month == $server_month) {
	    	return TRUE;
	    }
	    else {
	    	if (date('d') > 3) {
	    		return FALSE;
	    	}
	    	else {
	    		return TRUE;
	    	}
	    }
	}
	public function is_current_month_sick($str)
	{
	    $datum = DateTime::createFromFormat('d/m/Y', $str);
	    $submitted_date = date_parse_from_format('d/m/Y',$datum->format('d/m/Y'));
	    $submitted_month = $submitted_date['month'];
	    $submitted_year = $submitted_date['year'];
	    $server_month = date('m');
	    if (($submitted_month != $server_month) || ($submitted_year != date('Y'))) {
	    	return FALSE;
	    }
	    else {
	    	return TRUE;
	    }
	}

	public function is_current_month_sick_edit($str)
	{
	    $datum = DateTime::createFromFormat('d/m/Y', $str);
	    $submitted_date = date_parse_from_format('d/m/Y',$datum->format('d/m/Y'));
	    $submitted_month = $submitted_date['month'];
	    $submitted_year = $submitted_date['year'];
	    $server_month = date('m');
	    if (($submitted_month != $server_month) || ($submitted_year != date('Y'))) {
	    	return FALSE;
	    }
	    else {
	    	return TRUE;
	    }
	}

	public function is_range_current_month($str) {
		$datum = explode(' - ', $str);

	    $datum1 = DateTime::createFromFormat('d/m/Y', $datum[0]);
	    $submitted_date1 = date_parse_from_format('d/m/Y',$datum1->format('d/m/Y'));

	    $datum2 = DateTime::createFromFormat('d/m/Y', $datum[1]);
	    $submitted_date2 = date_parse_from_format('d/m/Y',$datum2->format('d/m/Y'));

		$submitted_month1 = $submitted_date1['month'];
		$submitted_month2 = $submitted_date2['month'];

		$submitted_year1 = $submitted_date1['year'];
		$submitted_year2 = $submitted_date2['year'];		

	    $server_month = date('m');
	    $server_year = date('Y');

	    if ($submitted_month1 != $submitted_month2 || $submitted_month1 != $server_month || $submitted_month2 != $server_month || $submitted_year1 != $server_year || $submitted_year2 != $server_year) {
	    	return FALSE;
	    }
	    else {
	    	return TRUE;
	    }
	}

	public function is_start_date_current_month($str) {
		$datum = explode(' - ', $str);

	    $datum1 = DateTime::createFromFormat('d/m/Y', $datum[0]);
	    $submitted_date1 = date_parse_from_format('d/m/Y',$datum1->format('d/m/Y'));

		$submitted_month1 = $submitted_date1['month'];
		$submitted_year1 = $submitted_date1['year'];

	    $server_month = date('m');
	    $server_year = date('Y');

	    if ($submitted_month1 != $server_month || $submitted_year1 != $server_year) {
	    	return FALSE;
	    }
	    else {
	    	return TRUE;
	    }
	}	

	public function is_already_submitted($str) {

		$datum = explode(' - ', $str);

		$datum1 = DateTime::createFromFormat('d/m/Y', $datum[0]);
		$datum2 = DateTime::createFromFormat('d/m/Y', $datum[1]);

		$startDate = date_parse_from_format('d/m/Y',$datum1->format('d/m/Y'));
		$endDate = date_parse_from_format('d/m/Y',$datum2->format('d/m/Y'));

		$startA = DateTime::createFromFormat('Y-m-d', $startDate['year'] . "-"  . $startDate['month'] . "-" . $startDate['day']);
		$endA = DateTime::createFromFormat('Y-m-d', $endDate['year'] . "-"  . $endDate['month'] . "-" . $endDate['day']);				

		$this->CI->load->model('oncall');
		$oncall = $this->CI->oncall->check_if_submitted($this->CI->getUser());
		foreach ($oncall as $row) {
			$cond1 = date_diff($startA,DateTime::createFromFormat('Y-m-d',$row->end_date));
			$cond2 = date_diff($endA,DateTime::createFromFormat('Y-m-d',$row->start_date));
			if ($cond1->invert == 0 && $cond2->invert == 1) {
				return FALSE;
				exit;
			}
		}
		return TRUE;	
	}

	public function is_inside_two_months($str) {
		$datum = explode(' - ', $str);

		$datum1 = DateTime::createFromFormat('d/m/Y', $datum[0]);
		$datum2 = DateTime::createFromFormat('d/m/Y', $datum[1]);

		$startDate = date_parse_from_format('d/m/Y',$datum1->format('d/m/Y'));
		$endDate = date_parse_from_format('d/m/Y',$datum2->format('d/m/Y'));

		if($endDate['month'] - $startDate['month'] > 1) {
			return FALSE;
		}
		else {
			return TRUE;
		}

	}

	public function provjera_kms_stanja($str) {
		$this->CI->load->model('cars');
		$kms = $this->CI->cars->check_kms();
		if ($kms[0]->kilometraza > $str) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
}