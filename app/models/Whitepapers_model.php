<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Whitepapers_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getWhitepapers($offset="",$record="",$countType="")
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

			if(empty($_GET['title'])){
				$title = 'NULL';
			}else{
				$title = "concat('%','".serchFilter($_GET['title'])."','%')";
			}

			$active_flag 			= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			header_tbl.header_id,
			header_tbl.title,
			header_tbl.active_flag
			from whitepaper_headers as header_tbl
			where 1=1
			and	header_tbl.title like coalesce($title,header_tbl.title)
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			order by header_tbl.header_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();

		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkWhitePaperExists($whitepaper_url='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="header_tbl.header_id!='".$id."'";
		}

		$query="select header_tbl.header_id from whitepaper_headers as header_tbl
				where 1=1 
				and header_tbl.whitepaper_url='".$whitepaper_url."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.description from whitepaper_headers as header_tbl
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.author_name,
		line_tbl.designation_id,
		line_tbl.active_flag
		from whitepaper_lines as line_tbl
		left join whitepaper_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}
	
	function getWhitepapersAll()
	{
		$query="select
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.whitepaper_url
		from whitepaper_headers as header_tbl
		where 1=1 
		and header_tbl.active_flag='".$this->active_flag."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	

}
