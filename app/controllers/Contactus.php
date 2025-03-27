<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class Contactus extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
      
        #Cache Control
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	function manageContactUs($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageContactUs']  	= 1;
		$page_data['page_name']  		= 'contactus/manageContactUs';
		$page_data['page_title'] 		= 'Contact Us Details';
		
		if($_GET)
		{
			$totalResult = $this->contactus_model->getContactUs("","",$this->totalCount);
			$page_data["totalRows"] = $totalRows = count($totalResult);

			if(!empty($_SESSION['PAGE']))
			{$limit = $_SESSION['PAGE'];
			}else{$limit = 10;}

			$keywords = isset($_GET['keywords']) ? $_GET['keywords'] :NULL;
		
			$this->redirectURL = 'contactus/manageContactUs?keywords='.$keywords.'';
			
			if ($keywords != NULL) {
				$base_url = base_url().$this->redirectURL;
			} else {
				$base_url = base_url().$this->redirectURL;
			}
			
			$config = PaginationConfig($base_url,$totalRows,$limit);
			$this->pagination->initialize($config);
			$str_links = $this->pagination->create_links();
			$page_data['pagination'] = explode('&nbsp;', $str_links);
			$offset = 0;
			if (!empty($_GET['per_page'])) {
				$pageNo = $_GET['per_page'];
				$offset = ($pageNo - 1) * $limit;
			}
			
			if($offset == 1 || $offset== "" || $offset== 0){
				$page_data["first_item"] = 1;
			}else{
				$page_data["first_item"] = $offset + 1;
			}
			
			$page_data['resultData'] = $result = $this->contactus_model->getContactUs($limit, $offset, $this->pageCount);
			

			if(isset($_GET['per_page']) && $_GET['per_page'] > 1 && count($result) == 0 )
			{
				redirect(base_url().$this->redirectURL, 'refresh');
			}


			#Download Excel start
			$download_excel = isset($_GET['download_excel']) ? $_GET['download_excel']: NULL;
			if($download_excel != NULL) 
			{
						
				$date = date('d_M_Y');
				header("Content-type: application/csv");
				header("Content-Disposition: attachment; filename=\"Contactus_details_".$date.".csv\"");
				header("Pragma: no-cache");
				header("Expires: 0");

				$handle = fopen('php://output', 'w');
				$handle1 = fopen('php://output', 'w');
				fputcsv($handle, array("S.No","First Name","Last Name","Company Name","Company Email","Mobile Number","Message","Created Date")); //, "Price" , "Total"
				$cnt=1;
				foreach ($totalResult as $row) 
				{
					$narray=array(
						$cnt,
						ucfirst($row['first_name']),
						ucfirst($row['last_name']),
						ucfirst($row['company_name']),
						$row['company_email'],
						$row['mobile_number'],
						ucfirst($row['message']),
						date('d-M-Y',strtotime($row['created_date'])),
					);

					fputcsv($handle, $narray);
					$cnt++;
				}
				
				fclose($handle);
				
				exit;
			}
			#Download Excel end 

			#show start and ending Count
			$total_counts = $total_count= 0;
			$pages=$page_data["starting"] = $page_data["ending"]="";
			$pageno = isset($pageNo) ? $pageNo :"";
			
			if( $totalRows == 0 ){
				$page_data["starting"] = 0;
			}else if( $pageno==1 || $pageno=="" ){
				$page_data["starting"] = 1;
			}else{
				$pages = $pageno-1;
				$total_count = $pages * $config["per_page"];
				$page_data["starting"] = ( $config["per_page"] * $pages )+1;
			}
			
			$total_counts = $total_count + count($result);
			$page_data["ending"]  = $total_counts;
			#show start and ending Count end
		}

		$this->load->view($this->adminTemplate, $page_data);
	}

	function manageEnquiry($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageEnquiry']  	= 1;
		$page_data['page_name']  		= 'contactus/manageEnquiry';
		$page_data['page_title'] 		= 'Enquiries';
		
		if($_GET)
		{
			$totalResult = $this->contactus_model->getEnquiry("","",$this->totalCount);
			$page_data["totalRows"] = $totalRows = count($totalResult);

			if(!empty($_SESSION['PAGE']))
			{$limit = $_SESSION['PAGE'];
			}else{$limit = 10;}

			$enquiry_type 	= isset($_GET['enquiry_type']) ? $_GET['enquiry_type'] :NULL;
			$keywords 		= isset($_GET['keywords']) ? $_GET['keywords'] :NULL;
		
			$this->redirectURL = 'contactus/manageEnquiry?enquiry_type='.$enquiry_type.'&keywords='.$keywords.'';

			
			if ($keywords != NULL) {
				$base_url = base_url().$this->redirectURL;
			} else {
				$base_url = base_url().$this->redirectURL;
			}
			
			$config = PaginationConfig($base_url,$totalRows,$limit);
			$this->pagination->initialize($config);
			$str_links = $this->pagination->create_links();
			$page_data['pagination'] = explode('&nbsp;', $str_links);
			$offset = 0;
			if (!empty($_GET['per_page'])) {
				$pageNo = $_GET['per_page'];
				$offset = ($pageNo - 1) * $limit;
			}
			
			if($offset == 1 || $offset== "" || $offset== 0){
				$page_data["first_item"] = 1;
			}else{
				$page_data["first_item"] = $offset + 1;
			}
			
			$page_data['resultData'] = $result = $this->contactus_model->getEnquiry($limit, $offset, $this->pageCount);
			

			if(isset($_GET['per_page']) && $_GET['per_page'] > 1 && count($result) == 0 )
			{
				redirect(base_url().$this->redirectURL, 'refresh');
			}


			#Download Excel start
			$download_excel = isset($_GET['download_excel']) ? $_GET['download_excel']: NULL;
			if($download_excel != NULL) 
			{
						
				$date = date('d_M_Y');
				header("Content-type: application/csv");
				header("Content-Disposition: attachment; filename=\"Enquiry_details_".$date.".csv\"");
				header("Pragma: no-cache");
				header("Expires: 0");

				$handle = fopen('php://output', 'w');
				$handle1 = fopen('php://output', 'w');
				fputcsv($handle, array("S.No","Service Name","Industry Name","Product Name","First Name","Last Name","Company Name","Company Email","Mobile Number","Message","Created Date")); //, "Price" , "Total"
				$cnt=1;
				foreach ($totalResult as $row) 
				{
					$narray=array(
						$cnt,
						isset($row['service_name']) ? ucfirst($row['service_name']) : "",
						isset($row['industries_name']) ? ucfirst($row['industries_name']) : "",
						isset($row['product_name']) ? ucfirst($row['product_name']) : "",
						ucfirst($row['first_name']),
						ucfirst($row['last_name']),
						ucfirst($row['company_name']),
						$row['company_email'],
						ucfirst($row['mobile_number']),
						ucfirst($row['message']),
						date('d-M-Y',strtotime($row['created_date'])),
					);

					fputcsv($handle, $narray);
					$cnt++;
				}
				
				fclose($handle);
				
				exit;
			}
			#Download Excel end 

			#show start and ending Count
			$total_counts = $total_count= 0;
			$pages=$page_data["starting"] = $page_data["ending"]="";
			$pageno = isset($pageNo) ? $pageNo :"";
			
			if( $totalRows == 0 ){
				$page_data["starting"] = 0;
			}else if( $pageno==1 || $pageno=="" ){
				$page_data["starting"] = 1;
			}else{
				$pages = $pageno-1;
				$total_count = $pages * $config["per_page"];
				$page_data["starting"] = ( $config["per_page"] * $pages )+1;
			}
			
			$total_counts = $total_count + count($result);
			$page_data["ending"]  = $total_counts;
			#show start and ending Count end
		}

		$this->load->view($this->adminTemplate, $page_data);
	}

	function manageSubscribes($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageSubscribes']	= 1;
		$page_data['page_name']  		= 'contactus/manageSubscribes';
		$page_data['page_title'] 		= 'Subscribe Details';
		
		if($_GET)
		{
			$totalResult = $this->contactus_model->getSubscribes("","",$this->totalCount);
			$page_data["totalRows"] = $totalRows = count($totalResult);

			if(!empty($_SESSION['PAGE']))
			{$limit = $_SESSION['PAGE'];
			}else{$limit = 10;}

			$keywords = isset($_GET['keywords']) ? $_GET['keywords'] :NULL;
		
			$this->redirectURL = 'contactus/manageSubscribes?keywords='.$keywords.'';
			
			if ($keywords != NULL) {
				$base_url = base_url().$this->redirectURL;
			} else {
				$base_url = base_url().$this->redirectURL;
			}
			
			$config = PaginationConfig($base_url,$totalRows,$limit);
			$this->pagination->initialize($config);
			$str_links = $this->pagination->create_links();
			$page_data['pagination'] = explode('&nbsp;', $str_links);
			$offset = 0;
			if (!empty($_GET['per_page'])) {
				$pageNo = $_GET['per_page'];
				$offset = ($pageNo - 1) * $limit;
			}
			
			if($offset == 1 || $offset== "" || $offset== 0){
				$page_data["first_item"] = 1;
			}else{
				$page_data["first_item"] = $offset + 1;
			}
			
			$page_data['resultData'] = $result = $this->contactus_model->getSubscribes($limit, $offset, $this->pageCount);
			

			if(isset($_GET['per_page']) && $_GET['per_page'] > 1 && count($result) == 0 )
			{
				redirect(base_url().$this->redirectURL, 'refresh');
			}


			#Download Excel start
			$download_excel = isset($_GET['download_excel']) ? $_GET['download_excel']: NULL;
			if($download_excel != NULL) 
			{
						
				$date = date('d_M_Y');
				header("Content-type: application/csv");
				header("Content-Disposition: attachment; filename=\"Subscribe_details_".$date.".csv\"");
				header("Pragma: no-cache");
				header("Expires: 0");

				$handle = fopen('php://output', 'w');
				$handle1 = fopen('php://output', 'w');
				fputcsv($handle, array("S.No","Email","Created Date")); //, "Price" , "Total"
				$cnt=1;
				foreach ($totalResult as $row) 
				{
					$narray=array(
						$cnt,
						$row['subscribe_email'],
						date('d-M-Y',strtotime($row['created_date'])),
					);

					fputcsv($handle, $narray);
					$cnt++;
				}
				
				fclose($handle);
				
				exit;
			}
			#Download Excel end 

			#show start and ending Count
			$total_counts = $total_count= 0;
			$pages=$page_data["starting"] = $page_data["ending"]="";
			$pageno = isset($pageNo) ? $pageNo :"";
			
			if( $totalRows == 0 ){
				$page_data["starting"] = 0;
			}else if( $pageno==1 || $pageno=="" ){
				$page_data["starting"] = 1;
			}else{
				$pages = $pageno-1;
				$total_count = $pages * $config["per_page"];
				$page_data["starting"] = ( $config["per_page"] * $pages )+1;
			}
			
			$total_counts = $total_count + count($result);
			$page_data["ending"]  = $total_counts;
			#show start and ending Count end
		}

		$this->load->view($this->adminTemplate, $page_data);
	}
	
}
?>
