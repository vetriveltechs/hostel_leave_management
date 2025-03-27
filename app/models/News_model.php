<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getNews($offset="",$record="",$countType="")
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

			if (!isset($_GET['news_title']) || $_GET['news_title'] === '') {
				$news_title = 'NULL';
			} else {
				$news_title = $_GET['news_title'];
			}

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
				news.news_id,
				news.news_title,
				news.short_description,
				news.active_flag
				from news
				where 1=1
				and news.news_id = coalesce($news_title,news.news_id)
				and news.active_flag = if('".$active_flag."' = 'All',news.active_flag,'".$active_flag."')
				order by news.news_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkNewsExist($news_title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="news.news_id!='".$id."'";
		}

		$query="select news.news_id from news
				where 1=1 
				and news.news_title='".$news_title."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id="")
	{
		$query = "select 
		news.news_id,
		news.news_title,
		news.client_name,
		news.short_description,
		news.description,
		news.from_date,
		news.to_date
		from news
		where 1=1
		and news.news_id = '".$id."'" ;
		
		$result = $this->db->query($query)->result_array();
		
		return $result;
	}

	function getNewsAll(){
		$query = "select 
		news.news_id,
		news.news_title
		from news";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	public function getActiveNews($limit = "", $offset = "", $countType = "") 
	{
		$limitQuery = '';
		if ($countType == 1) {
			$limitQuery = "";
		} elseif ($countType == 2) {
			$limitQuery = "LIMIT $offset, $limit";
		}

		$query = "SELECT 
		news.news_id,
		news.news_title,
		news.short_description,
		news.last_updated_date
		FROM news
		WHERE 1=1
		AND COALESCE(news.from_date, '".$this->date."') <= '".$this->date."'
		AND COALESCE(news.to_date, '".$this->date."') >= '".$this->date."'
		AND news.active_flag = '".$this->active_flag."'
		$limitQuery";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getNewsDetails($news_id='')
	{
		$query="select
		news.news_id,
		news.news_title,
		news.short_description,
		news.client_name,
		news.description,
		news.last_updated_date
		from news
		where 1=1 
		and news.news_id='".$news_id."'
		and news.active_flag='".$this->active_flag."'
		order by news.news_id desc";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	

}
