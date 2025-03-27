<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Industries_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getIndustries($offset="",$record="",$countType="")
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

			if (!isset($_GET['industries_id']) || $_GET['industries_id'] === '') {
				$industries_id = 'NULL';
			} else {
				$industries_id = $_GET['industries_id'];
			}
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			industries.industries_id,
			industries.industries_code,
			industries.industries_name,
			industries.banner_title,
			industries.overview,
			industries.active_flag
			from industries
			where 1=1
			and industries.industries_id = coalesce($industries_id,industries.industries_id)
			and industries.active_flag = if('".$active_flag."' = 'All',industries.active_flag,'".$active_flag."')
			order by industries.industries_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkIndustriesExist($industries_url='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="industries.industries_id!='".$id."'";
		}

		$query="select industries.industries_id from industries
		where 1=1 
		and industries.industries_url='".$industries_url."'
		and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getIndustriesView($id="")
	{
		$query = "select 
		industries.industries_id,
		industries.industries_code,
		industries.industries_name,
		industries.banner_title,
		industries.description,
		industries.overview,
		industries.video_link,
		industries.active_flag
		from industries
		where 1=1
		and industries.industries_id = '".$id."'" ;
		
		$result = $this->db->query($query)->result_array();
		
		
		return $result;
	}
	function getIndustriesRecords($industries_url='')
	{
		$query = "select 
		industries.industries_id,
		industries.industries_code,
		industries.industries_name,
		industries.banner_title,
		industries.description,
		industries.overview,
		industries.video_link,
		industries.active_flag
		from industries
		where 1=1
		and industries.industries_url = '".$industries_url."'
		and industries.active_flag = '".$this->active_flag."'" ;
		
		$result = $this->db->query($query)->result_array();
		
		
		return $result;
	}

	function getIndustriesList()
	{
		$query = "select 
		industries.industries_id,
		industries.industries_code,
		industries.industries_name,
		industries.industries_url,
		industries.active_flag
		from industries
		where 1=1
		and industries.active_flag = '".$this->active_flag."'" ;
		
		$result = $this->db->query($query)->result_array();
		
		
		return $result;
	}

	function ajaxIndustriesListAll($industries_name='') 
	{
		$query = "select 
		industries.industries_id,
		industries.industries_code,
		industries.industries_name
		from industries
		where 1 = 1
		and (industries.industries_code like '%" . $industries_name . "%' or industries.industries_name like '%" . $industries_name . "%')";

		$result = $this->db->query($query)->result_array();
		return $result;
	}


	function getProductDetails($offset="",$record="",$countType="")
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

			if (!isset($_GET['industries_id']) || $_GET['industries_id'] === '') {
				$industries_id = 'NULL';
			} else {
				$industries_id = $_GET['industries_id'];
			}
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			industries_details.industries_detail_id,
			industries_details.industries_id,
			industries_details.title,
			industries_details.title_description,
			industries_details.active_flag,
			industries.industries_name
			from industries_details
			left join industries on industries.industries_id=industries_details.industries_id
			where 1=1
			and industries.industries_id = coalesce($industries_id,industries.industries_id)
			and industries_details.active_flag = if('".$active_flag."' = 'All',industries_details.active_flag,'".$active_flag."')
			order by industries_details.industries_detail_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkProductDetailsExist($industries_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="industries_details.industries_detail_id!='".$id."'";
		}

		$query="select industries_details.industries_detail_id from industries_details
				where 1=1 
				and industries_details.industries_id='".$industries_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getOurSolutions($offset="",$record="",$countType="")
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

			if (!isset($_GET['industries_id']) || $_GET['industries_id'] === '') {
				$industries_id = 'NULL';
			} else {
				$industries_id = $_GET['industries_id'];
			}

			$solution_title	= "concat('%','".serchFilter($_GET['solution_title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.solution_title,
			header_tbl.description,
			header_tbl.active_flag,
			industries.industries_name from our_solutions_headers as header_tbl
			left join industries on industries.industries_id=header_tbl.industries_id
			where 1=1
			and industries.industries_id = coalesce($industries_id,industries.industries_id)
			and header_tbl.solution_title like coalesce($solution_title,header_tbl.solution_title) 
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			group by header_tbl.header_id
			order by header_tbl.header_id desc $limit" ;
			
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getOurSolutionsView($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.solution_title,
		header_tbl.description,
		industries.industries_id,
		industries.industries_name from our_solutions_headers as header_tbl
		left join industries on industries.industries_id=header_tbl.industries_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_description,
		line_tbl.active_flag
		from our_solutions_lines as line_tbl
		left join our_solutions_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getOurSolutionsAll($industries_id=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.solution_title,
		industries.industries_id,
		industries.industries_name,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.detail_description,
		line_tbl.active_flag
		from our_solutions_lines as line_tbl
		left join our_solutions_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join industries on industries.industries_id=header_tbl.industries_id
		where 1=1
		and industries.industries_id='".$industries_id."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getOurSolutionsHeaders($industries_url='')
	{
		$query ="select 
		header_tbl.header_id,
		header_tbl.solution_title,
		header_tbl.description,
		industries.industries_id,
		industries.industries_name
		from our_solutions_headers as header_tbl
		left join industries on industries.industries_id=header_tbl.industries_id
		where 1=1
		and industries.industries_url='".$industries_url."'
		and header_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getOurSolutionsLines($header_id='')
	{
		$query ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.detail_description,
		line_tbl.active_flag
		from our_solutions_lines as line_tbl
		left join our_solutions_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id='".$header_id."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkOurSolutionsExists($industries_id='',$solution_title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from our_solutions_headers as header_tbl
				where 1=1 
				and header_tbl.industries_id='".$industries_id."'
				and header_tbl.solution_title='".$solution_title."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getBenefits($offset="",$record="",$countType="")
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

			if (!isset($_GET['industries_id']) || $_GET['industries_id'] === '') {
				$industries_id = 'NULL';
			} else {
				$industries_id = $_GET['industries_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.title,
			header_tbl.active_flag,
			industries.industries_id,
			industries.industries_name from industries_benefits_headers as header_tbl
			left join industries on industries.industries_id=header_tbl.industries_id
			where 1=1
			and industries.industries_id = coalesce($industries_id,industries.industries_id)
			and header_tbl.title like coalesce($title,header_tbl.title) 
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			group by header_tbl.header_id
			order by header_tbl.header_id desc $limit" ;
			
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getBenefitsView($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.description,
		industries.industries_id,
		industries.industries_name from industries_benefits_headers as header_tbl
		left join industries on industries.industries_id=header_tbl.industries_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.industries_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from industries_benefits_lines as line_tbl
		left join industries_benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getBenefitsAll($industries_id=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.title,
		industries.industries_id,
		industries.industries_name,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.industries_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from industries_benefits_lines as line_tbl
		left join industries_benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join industries on industries.industries_id=line_tbl.industries_id
		where 1=1
		and industries.industries_id='".$industries_id."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkBenefitsExists($industries_id='',$title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from industries_benefits_headers as header_tbl
				where 1=1 
				and header_tbl.industries_id='".$industries_id."'
				and header_tbl.title='".$title."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getIndustriesBenefits($industries_url=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.description,
		industries.industries_id,
		industries.industries_name,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.industries_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from industries_benefits_lines as line_tbl
		left join industries_benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join industries on industries.industries_id=line_tbl.industries_id
		where 1=1
		and industries.industries_url='".$industries_url."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getIndustryName($industries_url='') 
	{
		$query = "select 
		industries.industries_id,
		industries.industries_name
		from industries
		where 1 = 1
		and industries.industries_url='".$industries_url."'";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

}
