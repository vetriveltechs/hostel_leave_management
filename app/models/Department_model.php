<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Department_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getDepartments($offset="",$record="",$countType="")
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

			
			if (!isset($_GET['department_id']) || $_GET['department_id'] === '') {
				$department_id = 'NULL';
			} else {
				$department_id = $_GET['department_id'];
			}
			
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			departments.department_id,
			departments.department_name,
			departments.department_description,
			departments.active_flag
			from emp_departments as departments
			where 1=1
			and departments.department_id = coalesce($department_id,departments.department_id)
			and departments.active_flag = if('".$active_flag."' = 'All',departments.active_flag,'".$active_flag."')
			order by departments.department_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkDepartmentExist($department_name='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="departments.department_id!='".$id."'";
		}

		$query="select departments.department_id from emp_departments as departments
				where 1=1 
				and department_name='".$department_name."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id='')
	{
		$query = "select 
		departments.department_id,
		departments.department_name,
		departments.department_description
		from emp_departments as departments
		where 1=1
		and departments.department_id='".$id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	function getActiveDepartment($department_type='')
	{
		if($department_type==='ALL')
		{
			$condition='and 1=1';
		}
		else
		{
			$condition="and departments.active_flag='".$this->active_flag."'";
		}

		$query = "select 
		departments.department_id,
		departments.department_name
		from emp_departments as departments
		where 1=1
		$condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	
}
