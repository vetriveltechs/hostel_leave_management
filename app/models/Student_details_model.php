<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student_details_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getStudentDetails($offset="",$record="",$countType="")
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

			
			if (!isset($_GET['student_id']) || $_GET['student_id'] === '') {
				$student_id = 'NULL';
			} else {
				$student_id = $_GET['student_id'];
			}
			if (!isset($_GET['department_id']) || $_GET['department_id'] === '') {
				$department_id = 'NULL';
			} else {
				$department_id = $_GET['department_id'];
			}

			$academic_year 	= !empty($_GET['academic_year']) ? $_GET['academic_year'] : NULL;

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			student.student_id,
			student.student_roll_number,
			student.student_name,
			student.department_id,
			student.academic_year,
			student.email_id,
			student.contact_number,
			student.guardian_name,
			student.guardian_number,
			student.active_flag,
			departments.department_name,
			ltv.list_value
			from student_details as student
			left join emp_departments as departments on departments.department_id = student.department_id
			left join sm_list_type_values as ltv on ltv.list_code = student.academic_year
			where 1=1
			and student.student_id = coalesce($student_id,student.student_id)
			and student.department_id = coalesce($department_id,student.department_id)
			and student.academic_year = coalesce(if('".$academic_year."' = '',NULL,'".$academic_year."'),student.academic_year)
			and student.active_flag = if('".$active_flag."' = 'All',student.active_flag,'".$active_flag."')
			order by student.student_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkStudentExists($email_id='',$contact_number='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="student.student_id!='".$id."'";
		}

		$query="select student.student_id from student_details as student
				where 1=1 
				and student.email_id='".$email_id."'
				and student.contact_number='".$contact_number."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id='')
	{
		$query = "select 
		student.student_id,
		student.student_roll_number,
		student.student_name,
		student.department_id,
		student.academic_year,
		student.email_id,
		student.contact_number,
		student.guardian_name,
		student.guardian_number,
		student.room_number,
		student.first_approver_id,
		student.second_approver_id
		from student_details as student
		where 1=1
		and student.student_id='".$id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	

	function getStudentName($student_type='')
	{
		if($student_type==='ALL')
		{
			$condition='and 1=1';
		}
		else
		{
			$condition="and student.active_flag='".$this->active_flag."'";
		}

		$query = "select 
		student.student_id,
		student.student_name
		from student_details as student
		where 1=1
		$condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
}
