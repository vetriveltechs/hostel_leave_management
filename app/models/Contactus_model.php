<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contactus_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }

	function getContactUs($offset="",$record="",$countType="")
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

			
			if(empty($_GET['keywords']))
			{
				$keywords = 'NULL';
			}
			else
			{
				$keywords = "concat('%','".serchFilter($_GET['keywords'])."','%')";
			}

			$query = "select
			contact_us.contact_us_id,
			contact_us.first_name,
			contact_us.last_name,
			contact_us.company_name,
			contact_us.company_email,
			contact_us.message,
			contact_us.mobile_number,
			contact_us.created_date
			from contact_us 
			where 1=1
			and	( contact_us.first_name like coalesce($keywords,contact_us.first_name) or contact_us.company_email like coalesce($keywords,contact_us.company_email) or contact_us.company_name like coalesce($keywords,contact_us.company_name))
			order by contact_us_id desc $limit";

			$result = $this->db->query($query)->result_array();
			return $result;
		}
		else
		{
			return array();
		}
	}

	function getEnquiry($offset="",$record="",$countType="")
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

			$enquiry_type 	= !empty($_GET['enquiry_type']) ? $_GET['enquiry_type'] : NULL;
			
			if(empty($_GET['keywords']))
			{
				$keywords = 'NULL';
			}
			else
			{
				$keywords = "concat('%','".serchFilter($_GET['keywords'])."','%')";
			}

			$query = "select
			enquires.enquiry_id,
			enquires.service_name,
			enquires.industries_name,
			enquires.product_name,
			enquires.first_name,
			enquires.last_name,
			enquires.company_name,
			enquires.company_email,
			enquires.message,
			enquires.mobile_number,
			enquires.created_date
			from enquires 
			where 1=1
			and enquires.enquiry_type = coalesce(if('".$enquiry_type."' = '',NULL,'".$enquiry_type."'),enquires.enquiry_type)
			and	( enquires.first_name like coalesce($keywords,enquires.first_name) or 
			enquires.company_email like coalesce($keywords,enquires.company_email) or 
			enquires.company_name like coalesce($keywords,enquires.company_name))

			order by enquiry_id desc $limit";

			$result = $this->db->query($query)->result_array();
			return $result;
		}
		else
		{
			return array();
		}
	}

	function getSubscribes($offset="",$record="",$countType="")
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

			
			if(empty($_GET['keywords']))
			{
				$keywords = 'NULL';
			}
			else
			{
				$keywords = "concat('%','".serchFilter($_GET['keywords'])."','%')";
			}

			$query = "select
			subscribes.subscribe_id,
			subscribes.subscribe_email,
			subscribes.created_date
			from subscribes 
			where 1=1
			and	subscribes.subscribe_email like coalesce($keywords,subscribes.subscribe_email)
			order by subscribe_id desc $limit";

			$result = $this->db->query($query)->result_array();
			return $result;
		}
		else
		{
			return array();
		}
	}
}
