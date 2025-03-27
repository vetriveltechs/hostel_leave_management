<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_details_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getStaffDetails($offset="",$record="",$countType="")
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

			
			if (!isset($_GET['staff_id']) || $_GET['staff_id'] === '') {
				$staff_id = 'NULL';
			} 
			else {
				$staff_id = $_GET['staff_id'];
			}

			if (!isset($_GET['department_id']) || $_GET['department_id'] === '') {
				$department_id = 'NULL';
			} else {
				$department_id = $_GET['department_id'];
			}

			$academic_year 	= !empty($_GET['academic_year']) ? $_GET['academic_year'] : NULL;

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			staff.staff_id,
			staff.staff_roll_number,
			staff.staff_name,
			staff.department_id,
			staff.academic_year,
			staff.email_id,
			staff.contact_number,
			staff.active_flag,
			departments.department_name,
			ltv.list_value,
			ltv1.list_value as position_name
			from staff_details as staff
			left join emp_departments as departments on departments.department_id = staff.department_id
			left join sm_list_type_values as ltv on ltv.list_code = staff.academic_year
			left join sm_list_type_values as ltv1 on ltv.list_code = staff.position_name
			where 1=1
			and staff.staff_id = coalesce($staff_id,staff.staff_id)
			and staff.department_id = coalesce($department_id,staff.department_id)
			and staff.academic_year = coalesce(if('".$academic_year."' = '',NULL,'".$academic_year."'),staff.academic_year)
			and staff.active_flag = if('".$active_flag."' = 'All',staff.active_flag,'".$active_flag."')
			order by staff.staff_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkStaffExists($email_id='',$contact_number='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="staff.staff_id!='".$id."'";
		}

		$query="select staff.staff_id from staff_details as staff
				where 1=1 
				and staff.email_id='".$email_id."'
				and staff.contact_number='".$contact_number."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id='')
	{
		$query = "select 
		staff.staff_id,
		staff.staff_roll_number,
		staff.staff_name,
		staff.department_id,
		staff.academic_year,
		staff.email_id,
		staff.contact_number,
		staff.position_name
		from staff_details as staff
		where 1=1
		and staff.staff_id='".$id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	

	function getStaffName($staff_type='')
	{
		if($staff_type==='ALL')
		{
			$condition='and 1=1';
		}
		else
		{
			$condition="and staff.active_flag='".$this->active_flag."'";
		}

		$query = "select 
		staff.staff_id,
		staff.staff_name
		from staff_details as staff
		where 1=1
		$condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
}
