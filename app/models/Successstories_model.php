<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Successstories_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getSuccessStories($offset="",$record="",$countType="")
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

			if(empty($_GET['keywords'])){
				$keywords = 'NULL';
			}else{
				$keywords = "concat('%','".serchFilter($_GET['keywords'])."','%')";
			}

			if (!isset($_GET['industries_id']) || $_GET['industries_id'] === '') {
				$industries_id = 'NULL';
			} else {
				$industries_id = $_GET['industries_id'];
			}
			$active_flag 			= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			successstories.successstories_id,
			successstories.title,
			successstories.active_flag,
			industries.industries_id,
			industries.industries_name
			from successstories
			left join industries on industries.industries_id = successstories.industries_id
			where 1=1
			and	successstories.title like coalesce($keywords,successstories.title)
			and industries.industries_id = coalesce($industries_id,industries.industries_id)
			and successstories.active_flag = if('".$active_flag."' = 'All',successstories.active_flag,'".$active_flag."')
			order by successstories.successstories_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();

		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkSuccessStoriesExist($title='',$industries_id='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="successstories.successstories_id!='".$id."'";
		}

		$query="select successstories.successstories_id from successstories
				where 1=1 
				and successstories.title='".$title."'
				and successstories.industries_id='".$industries_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id='')
	{
		$query = "select 
		successstories.successstories_id,
		successstories.title,
		successstories.description,
		successstories.active_flag,
		industries.industries_id,
		industries.industries_name
		from successstories
		left join industries on industries.industries_id = successstories.industries_id
		where 1=1
		and successstories.successstories_id='".$id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	function getSuccessStoriesAll($industries_id='')
	{
		$query="select
		successstories.successstories_id,
		successstories.title,
		successstories.description,
		successstories.active_flag,
		successstories.created_date,
		industries.industries_id,
		industries.industries_name
		from successstories
		left join industries on industries.industries_id = successstories.industries_id
		where 1=1 
		and successstories.industries_id='".$industries_id."'
		and successstories.active_flag='".$this->active_flag."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getIndustrySuccessStories($industries_url='',$succesStoriesLimit='')
	{
		$query="select
		successstories.successstories_id,
		successstories.title,
		successstories.description,
		successstories.active_flag,
		successstories.created_date,
		industries.industries_id,
		industries.industries_name
		from successstories
		left join industries on industries.industries_id = successstories.industries_id
		where 1=1 
		and industries.industries_url='".$industries_url."'
		and successstories.active_flag='".$this->active_flag."'
		order by successstories.successstories_id desc
		limit $succesStoriesLimit";
		$result = $this->db->query($query)->result_array();
		return $result;
	}


}
