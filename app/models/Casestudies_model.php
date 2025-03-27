<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Casestudies_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getCaseStudies($offset="",$record="",$countType="")
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

			$case_study_category 	= !empty($_GET['case_study_category']) ? $_GET['case_study_category'] : NULL;
			$active_flag 			= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			casestudies.casestudies_id,
			casestudies.title,
			casestudies.case_study_category,
			casestudies.client_name,
			casestudies.active_flag,
			ltv.list_value,
			industries.industries_id,
			industries.industries_name
			from casestudies
			left join sm_list_type_values as ltv on ltv.list_code = casestudies.case_study_category
			left join industries on industries.industries_id=casestudies.industries_id
			where 1=1
			and	casestudies.title like coalesce($keywords,casestudies.title)
			and casestudies.industries_id = coalesce($industries_id,casestudies.industries_id)
			and casestudies.case_study_category = coalesce(if('".$case_study_category."' = '',NULL,'".$case_study_category."'),casestudies.case_study_category)
			and casestudies.active_flag = if('".$active_flag."' = 'All',casestudies.active_flag,'".$active_flag."')
			order by casestudies.casestudies_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkCaseStudiesExist($industries_id='',$title='',$case_study_category='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="casestudies.casestudies_id!='".$id."'";
		}

		$query="select casestudies.casestudies_id from casestudies
				where 1=1 
				and industries_id='".$industries_id."'
				and title='".$title."'
				and case_study_category='".$case_study_category."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id='')
	{
		$query = "select 
		casestudies.casestudies_id,
		casestudies.title,
		casestudies.description,
		casestudies.case_study_category,
		casestudies.client_name,
		casestudies.best_casestudy,
		casestudies.active_flag,
		industries.industries_id,
		industries.industries_name
		from casestudies
		left join industries on industries.industries_id=casestudies.industries_id

		where 1=1
		and casestudies.casestudies_id='".$id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getCaseStudyAll($casestudy_title='',$page_type='')
	{
		// if ($page_type == 'add' || $page_type == 'edit') 
		// {
        //     $condition = "and casestudies.active_flag = '".$this->active_flag."'";
        // } 
		// else 
		// {
        //     $condition = "and 1=1";
        // }

		$query = "select 
		casestudies.casestudies_id,
		casestudies.title
		from casestudies
		where 1=1
		and ( casestudies.title like '%" . $casestudy_title . "%' or casestudies.casestudy_url like '%" . $casestudy_title . "%')
		";
		
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	// function getCaseStudiesAll()
	// {
	// 	$query="select
	// 	casestudies.casestudies_id,
	// 	casestudies.title,
	// 	casestudies.description,
	// 	casestudies.case_study_category,
	// 	casestudies.active_flag,
	// 	casestudies.created_date,
	// 	ltv.list_type_value_id,
	// 	ltv.list_code,
	// 	ltv.list_value,
	// 	industries.industries_id,
	// 	industries.industries_name
	// 	from casestudies
	// 	left join sm_list_type_values as ltv on ltv.list_code = casestudies.case_study_category
	// 	left join industries on industries.industries_id=casestudies.industries_id
	// 	where 1=1 
	// 	and casestudies.active_flag='".$this->active_flag."'";
	// 	$result = $this->db->query($query)->result_array();
	// 	return $result;
	// }

	public function getCasestudyList($limit = "", $offset = "", $countType = "", $list_code = '') 
	{
        $limitQuery = '';
        if ($countType == 1) 
		{
            $limitQuery = ""; 
        } 
		elseif ($countType == 2) 
		{
            $limitQuery = "LIMIT $offset, $limit";
        }

        if ($list_code != 'ALL' && $list_code != '') 
		{
            $condition = "and ltv.list_code = '$list_code'";
        } 
		else 
		{
            $condition = "and 1=1";
        }

        $query = "select 
		casestudies.casestudies_id,
		casestudies.title,
		casestudies.casestudy_url,
		casestudies.description,
		casestudies.case_study_category,
		casestudies.active_flag,
		casestudies.last_updated_date,
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		industries.industries_id,
		industries.industries_name
		from casestudies
		left join sm_list_type_values as ltv on ltv.list_code = casestudies.case_study_category
		left join industries on industries.industries_id=casestudies.industries_id
		where 1=1
		$condition
		and casestudies.active_flag='".$this->active_flag."'
		order by casestudies.casestudies_id desc
		$limitQuery";

        $result = $this->db->query($query)->result_array();
        return $result;
    }

	function getIndustryCaseStudies($industries_url='')
	{
		$query="select
		casestudies.casestudies_id,
		casestudies.title,
		casestudies.description,
		casestudies.case_study_category,
		casestudies.active_flag,
		casestudies.created_date,
		ltv.list_code,
		ltv.list_value,
		industries.industries_id,
		industries.industries_name
		from casestudies
		left join sm_list_type_values as ltv on ltv.list_code = casestudies.case_study_category
		left join industries on industries.industries_id=casestudies.industries_id
		where 1=1 
		and industries.industries_url='".$industries_url."'
		and casestudies.active_flag='".$this->active_flag."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getCaseStudiesList($list_type_value_id='')
	{

		$condition = ($list_type_value_id) ? "AND ltv.list_type_value_id = '$list_type_value_id'" : "AND 1=1";

		$query = "select
		casestudies.casestudies_id,
		casestudies.title,
		casestudies.description,
		casestudies.case_study_category,
		casestudies.active_flag,
		casestudies.created_date,
		ltv.list_code,
		ltv.list_value,
		ltv.list_type_value_id,
		industries.industries_id,
		industries.industries_name
		from casestudies
		left join sm_list_type_values as ltv on ltv.list_code = casestudies.case_study_category
		left join industries on industries.industries_id=casestudies.industries_id
		where 1=1 
		and casestudies.active_flag='".$this->active_flag."'
		$condition
		order by casestudies.casestudies_id desc";
		
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getOverviews($offset="",$record="",$countType="")
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

			if (!isset($_GET['casestudies_id']) || $_GET['casestudies_id'] === '') {
				$casestudies_id = 'NULL';
			} else {
				$casestudies_id = $_GET['casestudies_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.casestudies_id,
			header_tbl.description,
			header_tbl.active_flag,
			casestudies.title from overview_headers as header_tbl
			left join casestudies on casestudies.casestudies_id=header_tbl.casestudies_id
			where 1=1
			and casestudies.casestudies_id = coalesce($casestudies_id,casestudies.casestudies_id)
			and header_tbl.description like coalesce($title,header_tbl.description) 
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			order by header_tbl.header_id desc $limit" ;
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getOverviewData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.casestudies_id,
		header_tbl.description,
		header_tbl.conclusion,
		casestudies.casestudies_id,
		casestudies.title from overview_headers as header_tbl
		left join casestudies on casestudies.casestudies_id = header_tbl.casestudies_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from overview_lines as line_tbl
		left join overview_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getOverviewAll($list_code='',$casestudy_url=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.casestudies_id,
		line_tbl.line_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from overview_lines as line_tbl
		left join overview_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join casestudies on casestudies.casestudies_id = line_tbl.header_id
		where 1=1
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkOverviewExists($casestudies_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from overview_headers as header_tbl
				where 1=1 
				and header_tbl.casestudies_id='".$casestudies_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getSolutions($offset="",$record="",$countType="")
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

			if (!isset($_GET['casestudies_id']) || $_GET['casestudies_id'] === '') {
				$casestudies_id = 'NULL';
			} else {
				$casestudies_id = $_GET['casestudies_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.casestudies_id,
			header_tbl.title,
			header_tbl.active_flag,
			casestudies.title as casestudy_title from casestudy_solution_headers as header_tbl
			left join casestudies on casestudies.casestudies_id=header_tbl.casestudies_id
			where 1=1
			and casestudies.casestudies_id = coalesce($casestudies_id,casestudies.casestudies_id)
			and header_tbl.title like coalesce($title,header_tbl.title) 
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			order by header_tbl.header_id desc $limit" ;
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getSolutionviewData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.casestudies_id,
		header_tbl.title,
		casestudies.casestudies_id,
		casestudies.title as casestudy_title from casestudy_solution_headers as header_tbl
		left join casestudies on casestudies.casestudies_id = header_tbl.casestudies_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from casestudy_solution_lines as line_tbl
		left join casestudy_solution_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function checkSolutionExists($casestudies_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from casestudy_solution_headers as header_tbl
				where 1=1 
				and header_tbl.casestudies_id='".$casestudies_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getKeyFeatures($offset="",$record="",$countType="")
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

			if (!isset($_GET['casestudies_id']) || $_GET['casestudies_id'] === '') {
				$casestudies_id = 'NULL';
			} else {
				$casestudies_id = $_GET['casestudies_id'];
			}

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.casestudies_id,
			header_tbl.active_flag,
			casestudies.title as casestudy_title from casestudy_keyfeature_headers as header_tbl
			left join casestudies on casestudies.casestudies_id=header_tbl.casestudies_id
			where 1=1
			and casestudies.casestudies_id = coalesce($casestudies_id,casestudies.casestudies_id)
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			order by header_tbl.header_id desc $limit" ;
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getKeyFeaturesData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.casestudies_id,
		casestudies.casestudies_id,
		casestudies.title as casestudy_title from casestudy_keyfeature_headers as header_tbl
		left join casestudies on casestudies.casestudies_id = header_tbl.casestudies_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from casestudy_keyfeature_lines as line_tbl
		left join casestudy_keyfeature_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function checkKeyFeaturesExists($casestudies_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from casestudy_keyfeature_headers as header_tbl
				where 1=1 
				and header_tbl.casestudies_id='".$casestudies_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getImpacts($offset="",$record="",$countType="")
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

			if (!isset($_GET['casestudies_id']) || $_GET['casestudies_id'] === '') {
				$casestudies_id = 'NULL';
			} else {
				$casestudies_id = $_GET['casestudies_id'];
			}

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.casestudies_id,
			header_tbl.active_flag,
			casestudies.title as casestudy_title from impact_headers as header_tbl
			left join casestudies on casestudies.casestudies_id=header_tbl.casestudies_id
			where 1=1
			and casestudies.casestudies_id = coalesce($casestudies_id,casestudies.casestudies_id)
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			order by header_tbl.header_id desc $limit" ;
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getImpactsData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.casestudies_id,
		casestudies.casestudies_id,
		casestudies.title as casestudy_title from impact_headers as header_tbl
		left join casestudies on casestudies.casestudies_id = header_tbl.casestudies_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from impact_lines as line_tbl
		left join impact_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function checkImpactsExists($casestudies_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from impact_headers as header_tbl
				where 1=1 
				and header_tbl.casestudies_id='".$casestudies_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getCaseStudyDetails($list_code="",$casestudy_url="")
	{
		$query="select
		casestudies.casestudies_id,
		casestudies.title,
		casestudies.description,
		casestudies.case_study_category,
		casestudies.client_name,
		casestudies.active_flag,
		casestudies.created_date,
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		industries.industries_id,
		industries.industries_name
		from casestudies
		left join sm_list_type_values as ltv on ltv.list_code = casestudies.case_study_category
		left join industries on industries.industries_id=casestudies.industries_id
		where 1=1 
		and ltv.list_code='".$list_code."'
		and casestudies.casestudy_url='".$casestudy_url."'
		and casestudies.active_flag='".$this->active_flag."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getRelatedCaseStudies($list_code="",$casestudy_url="",$casestudy_limit="")
	{
		$query="select
		casestudies.casestudies_id,
		casestudies.title,
		casestudies.description,
		casestudies.case_study_category,
		casestudies.casestudy_url,
		casestudies.client_name,
		casestudies.active_flag,
		casestudies.last_updated_date,
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		industries.industries_id,
		industries.industries_name
		from casestudies
		left join sm_list_type_values as ltv on ltv.list_code = casestudies.case_study_category
		left join industries on industries.industries_id=casestudies.industries_id
		where 1=1 
		and ltv.list_code='".$list_code."'
		and casestudies.casestudy_url!='".$casestudy_url."'
		and casestudies.active_flag='".$this->active_flag."'
		limit $casestudy_limit";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
}

