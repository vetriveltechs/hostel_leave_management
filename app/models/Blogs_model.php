<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blogs_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
	
	function getBlogs($offset="",$record="",$countType="")
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

			if(empty($_GET['keywords'])){
				$keywords = 'NULL';
			}else{
				$keywords = "concat('%','".serchFilter($_GET['keywords'])."','%')";
			}

			$blog_category 	= !empty($_GET['blog_category']) ? $_GET['blog_category'] : NULL;

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
			blogs.blog_id,
			blogs.blog_title,
			blogs.short_description,
			blogs.blog_category,
			blogs.active_flag,
			ltv.list_value,
			industries.industries_id,
			industries.industries_name
			from blogs
			left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
			left join industries on industries.industries_id=blogs.industries_id
			where 1=1
			and blogs.category_id = coalesce($category_id,blogs.category_id)
			and	blogs.blog_title like coalesce($keywords,blogs.blog_title)
			and blogs.blog_category = coalesce(if('".$blog_category."' = '',NULL,'".$blog_category."'),blogs.blog_category)
			and blogs.active_flag = if('".$active_flag."' = 'All',blogs.active_flag,'".$active_flag."')
			order by blogs.blog_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkBlogsExist($industries_id='',$blog_url='',$blog_category='',$type='',$id='')
	{
		if($type==='add')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" blogs.blog_id!='".$id."'";
		}

		$query="select blogs.blog_id from blogs
				where 1=1 
				and industries_id='".$industries_id."'
				and blog_url='".$blog_url."'
				and blog_category='".$blog_category."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id='')
	{
		$query = "select 
		blogs.blog_id,
		blogs.blog_title,
		blogs.blog_type,
		blogs.category_id,
		blogs.short_description,
		blogs.description,
		blogs.client_name,
		blogs.blog_category,
		blogs.best_blog,
		blogs.active_flag,
		industries.industries_id,
		industries.industries_name
		from blogs
		left join industries on industries.industries_id=blogs.industries_id
		where 1=1
		and blogs.blog_id='".$id."'";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	function getCategoryBlogs($blog_type='')
	{
		$query="select
		blogs.blog_id,
		blogs.blog_title,
		blogs.short_description,
		blogs.blog_category,
		blogs.active_flag,
		blogs.created_date,
		ltv.list_code
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		where 1=1 
		and blogs.blog_category='".$blog_type."'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getBlogDetails($list_code='',$blog_url='')
	{
		$query="select
		blogs.blog_id,
		blogs.blog_title,
		blogs.client_name,
		blogs.short_description,
		blogs.description,
		blogs.last_updated_date,
		ltv.list_code,
		ltv.list_value
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		where 1=1 
		and ltv.list_code='".$list_code."'
		and blogs.blog_url='".$blog_url."'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	// function getBlogsList(){
	// 	$query="select
	// 	blogs.blog_id,
	// 	blogs.blog_title,
	// 	blogs.short_description,
	// 	blogs.blog_category,
	// 	blogs.active_flag,
	// 	blogs.created_date,
	// 	ltv.list_type_value_id,
	// 	ltv.list_code,
	// 	ltv.list_value,
	// 	industries.industries_id,
	// 	industries.industries_name
	// 	from blogs
	// 	left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
	// 	left join industries on industries.industries_id=blogs.industries_id
	// 	where 1=1 
	// 	and blogs.active_flag='".$this->active_flag."'
	// 	order by blogs.blog_id desc";
	// 	$result = $this->db->query($query)->result_array();
	// 	return $result;
	// }

	function getIndustryBlogs($industries_url='',$blog_limit=""){
		$query="select
		blogs.blog_id,
		blogs.blog_title,
		blogs.short_description,
		blogs.blog_category,
		blogs.active_flag,
		blogs.created_date,
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		industries.industries_id,
		industries.industries_name
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		left join industries on industries.industries_id=blogs.industries_id
		where 1=1 
		and industries.industries_url='".$industries_url."'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc
		limit $blog_limit";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getBlogsList($list_type_value_id='')
	{

		$condition = ($list_type_value_id) ? "AND ltv.list_type_value_id = '$list_type_value_id'" : "AND 1=1";

		$query = "select
		blogs.blog_id,
		blogs.blog_title,
		blogs.short_description,
		blogs.blog_category,
		blogs.active_flag,
		blogs.created_date,
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value,
		industries.industries_id,
		industries.industries_name
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		left join industries on industries.industries_id=blogs.industries_id
		where 1=1 
		and blogs.active_flag='".$this->active_flag."'
		$condition
		order by blogs.blog_id desc";
		
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	public function getBlogsAll($limit = "", $offset = "", $countType = "", $list_code = '') 
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
			blogs.blog_id,
			blogs.blog_title,
			blogs.blog_url,
			blogs.short_description,
			blogs.blog_category,
			blogs.last_updated_date,
			blogs.active_flag,
			ltv.list_type_value_id,
			ltv.list_code,
			ltv.list_value
		FROM blogs
		LEFT JOIN sm_list_type_values AS ltv ON ltv.list_code = blogs.blog_category
		WHERE 1=1
		AND blogs.active_flag = '".$this->active_flag."' 
		$condition
		ORDER BY blogs.blog_id DESC
		$limitQuery";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getRelatedBlog($list_code='',$blog_url='',$blog_limit='')
	{
		$query="select
		blogs.blog_id,
		blogs.blog_title,
		blogs.blog_url,
		blogs.client_name,
		blogs.last_updated_date,
		ltv.list_code,
		ltv.list_value
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		where 1=1 
		and ltv.list_code='".$list_code."'
		and blogs.blog_url!='".$blog_url."'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc
		limit $blog_limit";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	
	function getHomeBestBlogs($blog_limit='')
	{
		$query = "select 
		blogs.blog_id,
		blogs.blog_title,
		blogs.blog_url,
		blogs.client_name,
		blogs.last_updated_date,
		blogs.active_flag,
		ltv.list_code
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		where 1=1
		and blogs.best_blog='Y'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc
		limit $blog_limit";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getBestBlogs($blog_limit='')
	{
		$query = "select 
		blogs.blog_id,
		blogs.blog_title,
		blogs.blog_url,
		blogs.client_name,
		blogs.last_updated_date,
		ltv.list_code
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		where 1=1
		and blogs.best_blog='Y'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc
		limit $blog_limit";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getServicesBlogs($list_code_1='',$list_code_2=""){
		$query="select
		blogs.blog_id,
		blogs.blog_title,
		blogs.short_description,
		blogs.blog_category,
		blogs.active_flag,
		blogs.created_date,
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		left join inv_categories as categories on categories.category_id = blogs.category_id
		LEFT JOIN sm_list_type_values AS ltv1 ON ltv1.list_type_value_id = categories.cat_level_1
		LEFT JOIN sm_list_type_values AS ltv2 ON ltv2.list_type_value_id = categories.cat_level_2
		where 1=1 
		and ltv1.list_code='".$list_code_1."'
		and ltv2.list_code='".$list_code_2."'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getServicesBlogsList($list_code_1=''){
		$query="select
		blogs.blog_id,
		blogs.blog_title,
		blogs.short_description,
		blogs.blog_category,
		blogs.active_flag,
		blogs.created_date,
		ltv.list_type_value_id,
		ltv.list_code,
		ltv.list_value
		from blogs
		left join sm_list_type_values as ltv on ltv.list_code = blogs.blog_category
		left join inv_categories as categories on categories.category_id = blogs.category_id
		LEFT JOIN sm_list_type_values AS ltv1 ON ltv1.list_type_value_id = categories.cat_level_1
		where 1=1 
		and ltv1.list_code='".$list_code_1."'
		and blogs.active_flag='".$this->active_flag."'
		order by blogs.blog_id desc";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
}
