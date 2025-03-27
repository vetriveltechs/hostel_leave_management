<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getProducts($offset="",$record="",$countType="")
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

			// $product_category = !empty($_GET['product_category']) ? $_GET['product_category'] : NULL;

			if (!isset($_GET['product_id']) || $_GET['product_id'] === '') {
				$product_id = 'NULL';
			} else {
				$product_id = $_GET['product_id'];
			}
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			products.product_id,
			products.product_name,
			products.active_flag
			from products as products
			where 1=1
			and products.product_id = coalesce($product_id,products.product_id)
			and products.active_flag = if('".$active_flag."' = 'All',products.active_flag,'".$active_flag."')
			order by products.product_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkProductExist($product_url='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="products.product_id!='".$id."'";
		}

		$query="select products.product_id from products
		where 1=1 
		and products.product_url='".$product_url."'
		and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getProductsView($id="")
	{
		$query = "select 
		products.product_id,
		products.product_name,
		products.description,
		products.order_sequence,
		products.active_flag
		from products
		where 1=1
		and products.product_id = '".$id."'" ;
		
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

			if (!isset($_GET['product_id']) || $_GET['product_id'] === '') {
				$product_id = 'NULL';
			} else {
				$product_id = $_GET['product_id'];
			}
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			product_details.product_detail_id,
			product_details.product_id,
			product_details.title,
			product_details.title_description,
			product_details.active_flag,
			products.product_name
			from product_details
			left join products on products.product_id=product_details.product_id
			where 1=1
			and products.product_id = coalesce($product_id,products.product_id)
			and product_details.active_flag = if('".$active_flag."' = 'All',product_details.active_flag,'".$active_flag."')
			order by product_details.product_detail_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkProductDetailsExist($product_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="product_details.product_detail_id!='".$id."'";
		}

		$query="select product_details.product_detail_id from product_details
				where 1=1 
				and product_details.product_id='".$product_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getProductDetailsView($id="")
	{
		$query = "select 
		product_details.product_detail_id,
		product_details.title,
		product_details.title_description,
		product_details.why_choose_title,
		product_details.why_choose_jesperapps,
		product_details.key_features_title,
		product_details.key_features,
		product_details.benefits_title,
		product_details.benefits,
		product_details.who_jesperapps_title,
		product_details.who_jesperapps_description,
		product_details.remarks_title,
		product_details.remarks,
		products.product_id,
		products.product_name
		from product_details
		left join products on products.product_id=product_details.product_id
		where 1=1
		and product_details.product_detail_id = '".$id."'" ;
		
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getProductsAll(){
		$query = "select 
		products.product_id,
		products.product_name
		from products";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getProductsAllList(){
		$query = "select 
		products.product_id,
		products.product_name,
		products.description,
		products.product_url
		from products
		where 1=1
		and products.active_flag='".$this->active_flag."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	function getProductDetailsAll($product_url=''){
		$query = "select 
		product_details.product_detail_id,
		product_details.product_id,
		product_details.title,
		product_details.title_description,
		product_details.why_choose_title,
		product_details.why_choose_jesperapps,
		product_details.key_features_title,
		product_details.key_features,
		product_details.benefits_title,
		product_details.benefits,
		product_details.who_jesperapps_title,
		product_details.who_jesperapps_description,
		product_details.remarks_title,
		product_details.remarks,
		products.product_name from product_details
		left join products on products.product_id=product_details.product_id
		where 1=1
		and products.product_url='".$product_url."'" ;
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

			if (!isset($_GET['product_id']) || $_GET['product_id'] === '') {
				$product_id = 'NULL';
			} else {
				$product_id = $_GET['product_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.title,
			header_tbl.active_flag,
			products.product_name from key_features_headers as header_tbl
			left join products on products.product_id=header_tbl.product_id
			where 1=1
			and products.product_id = coalesce($product_id,products.product_id)
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

	function getKeyFeaturesView($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.title,
		products.product_id,
		products.product_name from key_features_headers as header_tbl
		left join products on products.product_id=header_tbl.product_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.product_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.detail_description,
		line_tbl.active_flag
		from key_features_lines as line_tbl
		left join key_features_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getKeyFeaturesAll($product_url=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.title,
		products.product_id,
		products.product_name,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.product_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.detail_description,
		line_tbl.active_flag
		from key_features_lines as line_tbl
		left join key_features_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join products on products.product_id=line_tbl.product_id
		where 1=1
		and products.product_url='".$product_url."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkKeyFeaturesExists($product_id='',$title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from key_features_headers as header_tbl
				where 1=1 
				and header_tbl.product_id='".$product_id."'
				and header_tbl.title='".$title."'
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

			if (!isset($_GET['product_id']) || $_GET['product_id'] === '') {
				$product_id = 'NULL';
			} else {
				$product_id = $_GET['product_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.title,
			header_tbl.active_flag,
			products.product_name from benefits_headers as header_tbl
			left join products on products.product_id=header_tbl.product_id
			where 1=1
			and products.product_id = coalesce($product_id,products.product_id)
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
		products.product_id,
		products.product_name from benefits_headers as header_tbl
		left join products on products.product_id=header_tbl.product_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.product_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from benefits_lines as line_tbl
		left join benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getBenefitsAll($product_url=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.title,
		products.product_id,
		products.product_name,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.product_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from benefits_lines as line_tbl
		left join benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join products on products.product_id=line_tbl.product_id
		where 1=1
		and products.product_url='".$product_url."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkBenefitsExists($product_id='',$title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from benefits_headers as header_tbl
				where 1=1 
				and header_tbl.product_id='".$product_id."'
				and header_tbl.title='".$title."'
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

			if (!isset($_GET['product_id']) || $_GET['product_id'] === '') {
				$product_id = 'NULL';
			} else {
				$product_id = $_GET['product_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.title,
			header_tbl.active_flag,
			products.product_name from details_headers as header_tbl
			left join products on products.product_id=header_tbl.product_id
			where 1=1
			and products.product_id = coalesce($product_id,products.product_id)
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
		products.product_id,
		products.product_name from details_headers as header_tbl
		left join products on products.product_id=header_tbl.product_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.product_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from details_lines as line_tbl
		left join details_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function getDetailsAll($product_url=''){
		$query ="select 
		header_tbl.header_id,
		header_tbl.title,
		products.product_id,
		products.product_name,
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.product_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from details_lines as line_tbl
		left join details_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		left join products on products.product_id=line_tbl.product_id
		where 1=1
		and products.product_url='".$product_url."'
		and header_tbl.active_flag='".$this->active_flag."'
		and line_tbl.active_flag='".$this->active_flag."'";
		
		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function checkDetailsExists($product_id='',$title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from details_headers as header_tbl
				where 1=1 
				and header_tbl.product_id='".$product_id."'
				and header_tbl.title='".$title."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	function getAppliedJobsCount($job_id="")
	{
		$condition = "1=1 and org_applied_jobs.job_id='".$job_id."' ";
		
		if(!empty($_GET['keywords']))
		{
			$condition .= ' and (
								org_applied_jobs.full_name like "%'.($_GET['keywords']).'%" or	
								org_applied_jobs.email like "%'.($_GET['keywords']).'%" 	
							)';
		}
		
		$query = "select org_applied_jobs.applied_job_id from org_applied_jobs where $condition ";
		$result = $this->db->query($query)->result_array();
		return count($result);
	}
	
	function getAppliedJobs($offset="",$record="",$job_id="")
	{
		$condition = "1=1 and org_applied_jobs.job_id='".$job_id."' ";
		
		if(!empty($_GET['keywords']))
		{
			$condition .= ' and (
								org_applied_jobs.full_name like "%'.($_GET['keywords']).'%" or	
								org_applied_jobs.email like "%'.($_GET['keywords']).'%" 	
							)';
		}
		
		$query = "select org_applied_jobs.*
		
				from org_applied_jobs

				where $condition 
					order by org_applied_jobs.applied_job_id desc
						limit ".$record." , ".$offset." ";
		$result = $this->db->query($query)->result_array();
		return $result;
	}


	function jobCategoryList(){
		$query = "select 
		jobs.job_id,
		job_category.job_category_id, 
		job_category.job_name 
		from org_job_category as job_category
		left join org_jobs as jobs on jobs.job_category_id=job_category.job_category_id
		where 1=1
		and job_category.active_flag='".$this->active_flag."'
		group by job_category.job_category_id";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	function jobCategory(){
		$query = "select 
		jobs.job_id,
		job_category.job_category_id, 
		job_category.job_name 
		from org_job_category as job_category
		left join org_jobs as jobs on jobs.job_category_id=job_category.job_category_id
		where 1=1
		and job_category.active_flag='".$this->active_flag."'
		group by job_category.job_category_id
		having count(jobs.job_id)>0";
		$result = $this->db->query($query)->result_array();
		return $result;
	}


	function getJobLists($job_id='',$job_category_id='')
	{
		$query = "select 
		jobs.job_id, 
		jobs_category.job_category_id,
		jobs_category.job_name,
		jobs.salary,
		jobs.job_location,
		jobs.key_skills,
		jobs.roles_and_response,
		jobs.job_qualification,
		jobs.requirements_and_skills,
		ltv_3.list_value
		from org_jobs as jobs
		left join org_job_category as jobs_category on jobs_category.job_category_id = jobs.job_category_id
		left join org_roles as roles on roles.role_id = jobs.role_id
		left join sm_list_type_values as ltv_1 on ltv_1.list_type_value_id = jobs.industry_type_id
		left join sm_list_type_values as ltv_2 on ltv_2.list_type_value_id = jobs.employment_type_id
		left join sm_list_type_values as ltv_3 on ltv_3.list_type_value_id = jobs.experience_id
		left join emp_designations as designations on designations.designation_id = jobs.designation_id
		left join qualification on qualification.qualification_id = jobs.qualification_id
		where 1=1
		and jobs_category.job_category_id='".$job_category_id."'
		and jobs_category.active_flag='".$this->active_flag."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getJobDetails($job_id='',$job_category_id='')
	{
		$query = "select 
		jobs.job_id, 
		jobs.job_category_id,
		jobs.salary,
		jobs.job_location,
		jobs.key_skills,
		jobs.roles_and_response,
		jobs.job_qualification,
		jobs.requirements_and_skills,
		jobs.functional_area,
		jobs.valid_from,
		jobs.job_description,
		jobs.valid_to,
		jobs.active_flag,
		jobs_category.job_category_id,
		jobs_category.job_name,
		roles.role_name,
		qualification.qualification_name,
		ltv_1.list_value as industry_type,
		ltv_2.list_value as employment_type,
		ltv_3.list_value as experience
		from org_jobs as jobs
		left join org_job_category as jobs_category on jobs_category.job_category_id = jobs.job_category_id
		left join org_roles as roles on roles.role_id = jobs.role_id
		left join sm_list_type_values as ltv_1 on ltv_1.list_type_value_id = jobs.industry_type_id
		left join sm_list_type_values as ltv_2 on ltv_2.list_type_value_id = jobs.employment_type_id
		left join sm_list_type_values as ltv_3 on ltv_3.list_type_value_id = jobs.experience_id
		left join emp_designations as designations on designations.designation_id = jobs.designation_id
		left join qualification on qualification.qualification_id = jobs.qualification_id
		where 1=1
		and jobs.job_id='".$job_id."'
		and jobs_category.job_category_id='".$job_category_id."'
		and jobs_category.active_flag='".$this->active_flag."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function jobsCount($job_category_id='')
	{
		$query = "select 
		jobs.applied_job_id
		from org_applied_jobs as jobs
		where 1=1
		and jobs.job_category_id='".$job_category_id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function ajaxProductListAll($product_name='') 
	{
		$query = "select 
		products.product_id, 
		products.product_name
		from products
		where 1 = 1
		and products.product_name like '%" . $product_name . "%'
		group by product_id";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getProductName($product_url='') 
	{
		$query = "select 
		products.product_id, 
		products.product_name
		from products
		where 1 = 1
		and products.product_url='".$product_url."'";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	public function getProductsList($limit = "", $offset = "", $countType = "", $list_code = '') 
	{
		$limitQuery = '';
		if ($countType == 1) {
			$limitQuery = "";
		} elseif ($countType == 2) {
			$limitQuery = "LIMIT $offset, $limit";
		}

		if ($list_code != 'ALL' && $list_code != '') {
			$condition = "AND ltv.list_code = '$list_code'";
		} else {
			$condition = "AND 1=1";
		}

		$query = "SELECT
			products.product_id,
			products.product_name,
			products.product_url,
			products.description,
			products.product_category,
			products.last_updated_date,
			products.active_flag,
			ltv.list_type_value_id,
			ltv.list_code,
			ltv.list_value
		FROM products
		LEFT JOIN sm_list_type_values AS ltv ON ltv.list_code = products.product_category
		WHERE 1=1
		AND products.active_flag = '".$this->active_flag."' 
		$condition
		ORDER BY products.order_sequence asc
		$limitQuery";

		$result = $this->db->query($query)->result_array();
		return $result;
	}
}
