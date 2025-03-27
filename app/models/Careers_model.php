<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Careers_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }

	function getInternship($offset="",$record="",$countType="")
	{
		if($_GET)
		{
			if($countType == 1) #GetTotalCount
			{
				$limit = "";
			}
			else if($countType == 2) #Get Page Wise Count
			{
				$limit = "limit ".$record." , ".$offset." "; 
			}

			
			if(empty($_GET['customer_name']))
			{
				$customer_name = 'NULL';
			}
			else
			{
				$customer_name = "concat('%','".serchFilter($_GET['customer_name'])."','%')";
			}

			$query = "select
			careers.careers_id,
			careers.customer_name,
			careers.email,
			careers.mobile_number,
			careers.internship_duration,
			careers.created_date
			from careers 
			where 1=1
			and	careers.customer_name like coalesce($customer_name,careers.customer_name)
			order by careers_id desc $limit";

			$result = $this->db->query($query)->result_array();
			return $result;
		}
		else
		{
			return array();
		}
	}


}
