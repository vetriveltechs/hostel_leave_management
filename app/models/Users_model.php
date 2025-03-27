<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }

	function getManageUsers($offset="",$record="", $countType="")
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

			if(empty($_GET['user_id'])){
				$user_id = 'NULL';
			}else{
				$user_id = $_GET['user_id'];
			}

			if(empty($_GET['active_flag'])){
				$active_flag = 'NULL';
			}else{
				$active_flag = $_GET['active_flag'];
			}

			$user_type = !empty($_GET['user_type']) ? $_GET['user_type'] : NULL;

			
			$query = "select 
					per_user.user_id,
					per_user.reg_user_type,
					per_user.user_name,
					per_user.created_date,
					per_user.last_login_date,
					per_user.last_login_status,
					per_user.active_flag,
					per_user.attribute1,
					per_people_all.first_name as emp_name,
					student_details.student_name,
					staff_details.staff_name
					from per_user
					
					left join per_people_all on per_people_all.person_id = per_user.person_id
					left join student_details on student_details.student_id = per_user.student_id
					left join staff_details on staff_details.staff_id = per_user.staff_id

				where 1=1 
					AND per_user.user_id != 1
					and per_user.reg_user_type = coalesce(if('".$user_type."' = '',NULL,'".$user_type."'),per_user.reg_user_type)
					and per_user.user_id = coalesce($user_id,per_user.user_id)
					and per_user.active_flag = if('".$active_flag."' = 'All', per_user.active_flag,'".$active_flag."')
					order by per_user.user_id desc $limit";
			
			$result = $this->db->query($query)->result_array();

			return $result;
		}
		else
		{
			return array();
		}
	}
}
