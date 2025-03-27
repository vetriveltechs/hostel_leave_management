<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leave_request_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getLeaveRequests($offset="",$record="",$countType="")
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

			$keywords 				= "concat('%','".serchFilter($_GET['keywords'])."','%')";
			$leave_approved_status 		= !empty($_GET['leave_approved_status']) ? $_GET['leave_approved_status'] : 'NULL';
			

			$query = "select 
			leave_request.leave_request_id,
			leave_request.leave_days,
			leave_request.room_number,
			leave_request.leave_approved_status,
			leave_request.reason,
			leave_request.from_date,
			leave_request.to_date,
			leave_request.created_date,
			leave_request.active_flag from leave_request
			where 1=1
			and leave_request.room_number like coalesce($keywords,leave_request.room_number)
			and leave_request.leave_approved_status = coalesce(if('".$leave_approved_status."' = '',NULL,'".$leave_approved_status."'),leave_request.leave_approved_status)
			order by leave_request.leave_request_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}


	function getViewData($id='')
	{
		
		$query = "select 
		leave_request.leave_request_id,
		leave_request.leave_days,
		leave_request.room_number,
		leave_request.reason,
		leave_request.from_date,
		leave_request.to_date
		from leave_request
		where 1=1
		and leave_request.leave_request_id='".$id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	function checkLeaveExists($from_date='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="leave_request.leave_request_id !='".$id."'";
		}

		$query="select leave_request.leave_request_id from leave_request
		where 1=1 
		and leave_request.from_date='".$from_date."'
		and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	function getLeaveHistory($student_id='')
	{
		
		if($student_id==='ALL')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="leave_request.student_id ='".$student_id."'";
		}

		$query="select
		leave_request.leave_request_id,
		leave_request.leave_days,
		leave_request.room_number,
		leave_request.leave_approved_status,
		leave_request.reason,
		leave_request.from_date,
		leave_request.to_date,
		leave_request.created_date,
		leave_request.active_flag,
		student_details.student_name from leave_request
		left join student_details on student_details.student_id=leave_request.student_id
		where 1=1
		and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

}
