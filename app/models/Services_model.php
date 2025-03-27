<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }

	function getServices($offset="",$record="",$countType="")
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
			
			$service_name 		= "concat('%','".serchFilter($_GET['service_name'])."','%')";
			$active_flag 		= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.service_name,
			header_tbl.overview,
			header_tbl.why_jesperapps,
			header_tbl.contact_title,
			header_tbl.contact_description,
			header_tbl.active_flag,
			categories.category_id,
			categories.category_name
			from service_headers as header_tbl
			left join inv_categories as categories on categories.category_id=header_tbl.category_id
			where 1=1
			and header_tbl.service_name like coalesce($service_name,header_tbl.service_name) 
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

	function getViewData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.service_name,
		header_tbl.overview,
		header_tbl.why_jesperapps,
		header_tbl.contact_title,
		header_tbl.contact_description,
		header_tbl.active_flag,
		categories.category_id,
		categories.category_name from service_headers as header_tbl
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from service_lines as line_tbl
		left join service_headers as header_tbl on header_tbl.header_id=line_tbl.header_id
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}


	function checkServicesExists($service_name='',$category_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from service_headers as header_tbl
				where 1=1 
				and header_tbl.service_name='".$service_name."'
				and header_tbl.category_id='".$category_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getServicesHeaderList($list_code_1='',$list_code_2='')
	{
		$query ="select 
		header_tbl.header_id,
		header_tbl.service_name,
		header_tbl.overview,
		header_tbl.why_jesperapps,
		header_tbl.contact_title,
		header_tbl.contact_description,
		header_tbl.active_flag,
		categories.category_id,
		categories.category_name, 
		categories.cat_level_2,
		ltv1.list_value as main_category,
		ltv2.list_value
		from service_headers as header_tbl
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and ltv2.list_code='".$list_code_2."'
		and header_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;

	}

	function getServicesLineList($list_code_1='',$list_code_2='')
	{
		$query ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag,
		ltv1.list_value as main_category,
		ltv2.list_value
		from service_lines as line_tbl
		left join service_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and ltv2.list_code='".$list_code_2."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
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

			if (!isset($_GET['category_id']) || $_GET['category_id'] === '') {
				$category_id = 'NULL';
			} else {
				$category_id = $_GET['category_id'];
			}

			// $title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.category_id,
			header_tbl.active_flag,
			categories.category_name from services_benefits_headers as header_tbl
			left join inv_categories as categories on categories.category_id=header_tbl.category_id
			where 1=1
			and categories.category_id = coalesce($category_id,categories.category_id)
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
		header_tbl.category_id from services_benefits_headers as header_tbl
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from services_benefits_lines as line_tbl
		left join services_benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getBenefitsAll($list_code_1='',$list_code_2=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.category_id,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag,
		categories.category_id,
		categories.category_name
		from services_benefits_lines as line_tbl
		left join services_benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and ltv2.list_code='".$list_code_2."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkBenefitsExists($category_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from services_benefits_headers as header_tbl
				where 1=1 
				and header_tbl.category_id='".$category_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getDetails($offset="",$record="",$countType="")
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

			if (!isset($_GET['category_id']) || $_GET['category_id'] === '') {
				$category_id = 'NULL';
			} else {
				$category_id = $_GET['category_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.title,
			header_tbl.description,
			header_tbl.category_id,
			header_tbl.active_flag,
			categories.category_name from services_details_headers as header_tbl
			left join inv_categories as categories on categories.category_id=header_tbl.category_id
			where 1=1
			and categories.category_id = coalesce($category_id,categories.category_id)
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

	function getDetailsView($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.description,
		header_tbl.category_id from services_details_headers as header_tbl
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from services_details_lines as line_tbl
		left join services_details_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getDetailsAll($list_code_1='',$list_code_2='')
	{
		$query ="select 
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.description,
		header_tbl.category_id,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag,
		categories.category_id,
		categories.category_name
		from services_details_lines as line_tbl
		left join services_details_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and ltv2.list_code='".$list_code_2."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkDetailsExists($category_id='',$title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from services_details_headers as header_tbl
				where 1=1 
				and header_tbl.category_id='".$category_id."'
				and header_tbl.title='".$title."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getServicesName($cat_level1_id='',$cat_level2_id='') 
	{
		if($cat_level1_id!==NULL && $cat_level2_id!==0)
		{
			$condition ="ltv1.list_type_value_id='".$cat_level2_id."'";
		}
		else
		{
			$condition ="ltv1.list_type_value_id='".$cat_level1_id."'";
		}

		$query = "select 
		ltv1.list_type_value_id,
		ltv1.list_value,
		list_type.list_type_id,
		list_type.list_name
		from sm_list_type_values as ltv1
		left join sm_list_types as list_type on list_type.list_type_id=ltv1.list_type_id
		where 1 = 1
		and $condition";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getHomeServices($service_limit="")
	{
		$query="select header_id,
		service_name,
		ltv1.list_code as list_code_1,
		ltv1.list_code as list_value_1,
		ltv2.list_code as list_code_2,
		ltv2.list_type_value_id,
		ltv2.list_value as sub_category_name from service_headers as header_tbl
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1 
		and header_tbl.active_flag='".$this->active_flag."'
		order by ltv2.order_sequence asc
		limit $service_limit";
		$result = $this->db->query($query)->result_array();
		return $result;

	}

	public function getServiceListAll($limit = "", $offset = "", $countType = "", $list_code = '') 
	{
		$limitQuery = '';
		if ($countType == 1) {
			$limitQuery = "";
		} elseif ($countType == 2) {
			$limitQuery = "LIMIT $offset, $limit";
		}

		if ($list_code != 'ALL' && $list_code != '') {
			$condition = "AND ltv1.list_code = '$list_code'";
		} else {
			$condition = "AND 1=1";
		}

		$query = "SELECT
		header_tbl.header_id,
		header_tbl.service_name,
		ltv1.list_code as list_code_1,
		ltv1.list_code as list_value,
		ltv2.list_code as list_code_2
		FROM service_headers as header_tbl
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		WHERE 1=1
		AND header_tbl.active_flag = '".$this->active_flag."' 
		$condition
		ORDER BY header_tbl.header_id DESC
		$limitQuery";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	// Main Category Services Quires Start

	function getServicesSubHeaderList($list_code_1='')
	{
		$query ="select 
		header_tbl.header_id,
		header_tbl.service_name,
		header_tbl.overview,
		header_tbl.why_jesperapps,
		header_tbl.contact_title,
		header_tbl.contact_description,
		header_tbl.active_flag,
		categories.category_id,
		categories.category_name, 
		categories.cat_level_2,
		ltv1.list_value as main_category,
		ltv2.list_value
		from service_headers as header_tbl
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and header_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;

	}

	function getServicesSubLineList($list_code_1='')
	{
		$query ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag,
		ltv1.list_value as main_category,
		ltv2.list_value
		from service_lines as line_tbl
		left join service_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;

	}

	function getSubDetailsAll($list_code_1='')
	{
		$query ="select 
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.description,
		header_tbl.category_id,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag,
		categories.category_id,
		categories.category_name
		from services_details_lines as line_tbl
		left join services_details_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getSubBenefitsAll($list_code_1=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.category_id,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag,
		categories.category_id,
		categories.category_name
		from services_benefits_lines as line_tbl
		left join services_benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join inv_categories as categories on categories.category_id=header_tbl.category_id
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		where 1=1
		and ltv1.list_code='".$list_code_1."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}
	// Main Category Services Quires End


}
