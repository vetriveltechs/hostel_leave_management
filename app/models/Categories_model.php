<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categories_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }

	function getManageCategories($offset="",$record="", $countType="")
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

			$category_id 	= !empty($_GET['category_id']) ? $_GET['category_id'] : 'NULL';

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$query = "select 
				category.category_id,
				category.category_name,
				category.category_description,
				category.cat_level_1,
				category.cat_level_2,
				category.cat_level_3,
				category.active_flag
				from inv_categories as category
			where 1=1
			and category.category_id = coalesce($category_id,category.category_id)
			and category.active_flag = if('".$active_flag."' = 'All',category.active_flag,'".$active_flag."')
			order by category.category_id desc
			$limit ";

			$result = $this->db->query($query)->result_array();
			return $result;
		}
		else
		{
			return array();
		}
	}

	function getBlogCategory(){
		$query = "select 
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		blogs.industries_id,
		count(blogs.blog_id) as blog_count
		from sm_list_type_values as ltv
		left join blogs on blogs.blog_category = ltv.list_code
		where 1=1
		and ltv.active_flag = '".$this->active_flag."'
		and blogs.active_flag = '".$this->active_flag."'
		group by ltv.list_type_value_id
		having count(blogs.blog_id) > 0";

		$result = $this->db->query($query)->result_array();
		return $result;
		
	}

	function getProductCategory(){
		$query = "select 
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		count(products.product_id) as product_count
		from sm_list_type_values as ltv
		left join products on products.product_category = ltv.list_code
		where 1=1
		and ltv.active_flag = '".$this->active_flag."'
		and products.active_flag = '".$this->active_flag."'
		group by ltv.list_type_value_id
		having count(products.product_id) > 0";

		$result = $this->db->query($query)->result_array();
		return $result;
		
	}

	function getCategoryListing()
	{
		$query = "select
		categories.category_id,
		categories.category_name,
		categories.cat_level_1,
		categories.cat_level_2,
		ltv.list_type_id,
		ltv.list_code,
		ltv2.list_code as list_code_2,
		ltv.list_value,
		count(service_headers.header_id) as service_count
		from inv_categories as categories
		left join sm_list_type_values as ltv on ltv.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		left join service_headers as service_headers on service_headers.category_id = categories.category_id
		where 1=1
		and ltv.list_type_id='12'
		and categories.active_flag='".$this->active_flag."'
		and service_headers.active_flag='".$this->active_flag."'
		group by categories.cat_level_1
		having service_count > 0
		order by ltv.order_sequence asc";

		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getSubCategory($category_level1_id="")
	{
		$query = "select
		categories.category_id,
		categories.category_name,
		categories.cat_level_1,
		categories.cat_level_2,
		ltv2.list_type_value_id,
		ltv1.list_code as list_code_1,
		ltv2.list_code as list_code_2,
		ltv2.list_value,
		count(service_headers.header_id) as service_count
		from inv_categories as categories
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		left join service_headers as service_headers on service_headers.category_id = categories.category_id
		where 1=1
		and categories.cat_level_1='".$category_level1_id."'
		and categories.active_flag='".$this->active_flag."'
		and service_headers.active_flag='".$this->active_flag."'
		group by categories.cat_level_2
		having service_count > 0
		order by ltv2.order_sequence asc";

		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getServiceBlogSubCategory($category_level1_id="")
	{
		$query = "select
		categories.category_id,
		categories.category_name,
		categories.cat_level_1,
		categories.cat_level_2,
		ltv2.list_type_value_id,
		ltv1.list_code as list_code_1,
		ltv2.list_code as list_code_2,
		ltv2.list_value,
		count(blogs.blog_id) as blog_count
		from inv_categories as categories
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		left join blogs on blogs.category_id = categories.category_id
		where 1=1
		and categories.cat_level_1='".$category_level1_id."'
		and categories.active_flag='".$this->active_flag."'
		and blogs.active_flag='".$this->active_flag."'
		group by categories.cat_level_2
		having blog_count > 0
		order by ltv2.order_sequence asc";

		$result = $this->db->query($query)->result_array();

		return $result;
	}


	public function getSecSubCategoryValue($sec_segment_value = "",$third_segment_value="")
	{
		if($third_segment_value=='')
		{
			$condition="";
		}
		else
		{
			$condition ="AND ltv2.list_code = '".strtoupper($third_segment_value)."'";
		}

		$query = "SELECT 
		categories.cat_level_1, 
		categories.cat_level_2, 
		COUNT(service_headers.header_id) AS service_count 
		FROM inv_categories AS categories
		LEFT JOIN sm_list_type_values AS ltv1 ON ltv1.list_type_value_id = categories.cat_level_1
		LEFT JOIN sm_list_type_values AS ltv2 ON ltv2.list_type_value_id = categories.cat_level_2
		LEFT JOIN service_headers AS service_headers ON service_headers.category_id = categories.category_id
		WHERE 1=1
		AND ltv1.list_code = '".strtoupper($sec_segment_value)."'
		
		AND categories.active_flag = '".$this->active_flag."'
		AND service_headers.active_flag = '".$this->active_flag."'
		$condition
		GROUP BY categories.cat_level_1, categories.cat_level_2
		HAVING service_count > 0
		ORDER BY categories.category_id ASC";

		$result = $this->db->query($query)->result_array();

		return $result;
	}

	public function getServicesSubCategoryValue($sec_segment_value = "",$third_segment_value="")
	{
		if($third_segment_value=='')
		{
			$condition="";
		}
		else
		{
			$condition ="AND ltv2.list_code = '".strtoupper($third_segment_value)."'";
		}

		$query = "SELECT 
		categories.cat_level_1, 
		categories.cat_level_2, 
		COUNT(blogs.blog_id) AS blog_count 
		FROM inv_categories AS categories
		LEFT JOIN sm_list_type_values AS ltv1 ON ltv1.list_type_value_id = categories.cat_level_1
		LEFT JOIN sm_list_type_values AS ltv2 ON ltv2.list_type_value_id = categories.cat_level_2
		LEFT JOIN blogs ON blogs.category_id = categories.category_id
		WHERE 1=1
		AND ltv1.list_code = '".strtoupper($sec_segment_value)."'
		and blogs.blog_type='WITHOUT-SERVICE-DATA'
		AND categories.active_flag = '".$this->active_flag."'
		AND blogs.active_flag = '".$this->active_flag."'
		$condition
		GROUP BY categories.cat_level_1, categories.cat_level_2
		HAVING blog_count > 0
		ORDER BY categories.category_id ASC";

		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getCategoryAll(){
		$query = "select 
        categories.category_id,
        categories.category_name,
		ltv.list_value
		from inv_categories as categories
		left join sm_list_type_values as ltv on ltv.list_type_value_id=categories.cat_level_1
		where 1=1
		and categories.active_flag='".$this->active_flag."'";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getCaseStudyCategory(){
		$query = "select 
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		count(casestudies.casestudies_id) as casestudies_count
		from sm_list_type_values as ltv
		left join casestudies on casestudies.case_study_category = ltv.list_code
		where 1=1
		and ltv.active_flag = '".$this->active_flag."'
		and casestudies.active_flag = '".$this->active_flag."'
		group by ltv.list_type_value_id
		having count(casestudies.casestudies_id) > 0";

		$result = $this->db->query($query)->result_array();
		return $result;
		
	}


	function getLastCategoryData()
	{
		$query = "select
		categories.category_id,
		categories.cat_level_1,
		count(service_headers.header_id) as service_count
		from inv_categories as categories
		left join sm_list_type_values as ltv on ltv.list_type_value_id=categories.cat_level_1
		left join service_headers as service_headers on service_headers.category_id = categories.category_id
		where 1=1
		and ltv.list_type_id='12'
		and categories.active_flag='".$this->active_flag."'
		and service_headers.active_flag='".$this->active_flag."'
		group by categories.cat_level_1
		having service_count > 0
		order by ltv.order_sequence asc
		limit 1";

		$result = $this->db->query($query)->result_array();

		return $result;
	}


	function getHomeCategoryListing($homeCategoryLimit='')
	{
		$query = "select
		categories.category_id,
		categories.category_name,
		categories.cat_level_1,
		categories.cat_level_2,
		ltv.list_type_value_id,
		ltv.list_type_id,
		ltv.list_code,
		ltv2.list_code as list_code_2,
		ltv.list_value,
		count(service_headers.header_id) as service_count
		from inv_categories as categories
		left join sm_list_type_values as ltv on ltv.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		left join service_headers as service_headers on service_headers.category_id = categories.category_id
		where 1=1
		and ltv.list_type_id='12'
		and categories.active_flag='".$this->active_flag."'
		and service_headers.active_flag='".$this->active_flag."'
		group by categories.cat_level_1
		having service_count > 0
		order by ltv.order_sequence asc
		limit $homeCategoryLimit";

		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getHomeSubCategory($category_level1_id="",$homeCategoryLimit='')
	{
		$query = "select
		categories.category_id,
		categories.category_name,
		categories.cat_level_1,
		categories.cat_level_2,
		ltv2.list_type_value_id,
		ltv1.list_code as list_code_1,
		ltv2.list_code as list_code_2,
		ltv2.list_value,
		count(service_headers.header_id) as service_count
		from inv_categories as categories
		left join sm_list_type_values as ltv1 on ltv1.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		left join service_headers as service_headers on service_headers.category_id = categories.category_id
		where 1=1
		and categories.cat_level_1='".$category_level1_id."'
		and categories.active_flag='".$this->active_flag."'
		and service_headers.active_flag='".$this->active_flag."'
		group by categories.cat_level_2
		having service_count > 0
		order by ltv2.order_sequence asc
		limit $homeCategoryLimit";

		$result = $this->db->query($query)->result_array();

		return $result;
	}

	function getServiceBlog()
	{
		$query = "select
		categories.category_id,
		categories.category_name,
		categories.cat_level_1,
		categories.cat_level_2,
		ltv.list_type_id,
		ltv.list_code,
		ltv2.list_code as list_code_2,
		ltv.list_value,
		count(blogs.blog_id) as blog_count
		from inv_categories as categories
		left join sm_list_type_values as ltv on ltv.list_type_value_id=categories.cat_level_1
		left join sm_list_type_values as ltv2 on ltv2.list_type_value_id=categories.cat_level_2
		left join blogs on blogs.category_id = categories.category_id
		where 1=1
		and ltv.list_type_id='12'
		and blogs.blog_type='WITHOUT-SERVICE-DATA'
		and categories.active_flag='".$this->active_flag."'
		and blogs.active_flag='".$this->active_flag."'
		group by categories.cat_level_1
		having blog_count > 0
		order by ltv.order_sequence asc";

		$result = $this->db->query($query)->result_array();

		return $result;
	}
	
}
