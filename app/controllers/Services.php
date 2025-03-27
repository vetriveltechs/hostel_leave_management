<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class Services extends CI_Controller 
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

	function manageServices($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageServices'] 	= 1;
		$page_data['page_name']  		= 'services/manageServices';
		$page_data['page_title'] 		= 'Services';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$service_name 			= $this->input->post('service_name');
					$category_id 			= $this->input->post('category_id');
					
					$checkServicesExists = $this->services_model->checkServicesExists($service_name,$category_id,$type,NULL);

					if(count($checkServicesExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Service already exists!");
						redirect(base_url() . 'services/manageServices/add', 'refresh');
					}

					$headerData = array(
						"service_name" 	  		=>  $service_name,
						"category_id" 			=>  $category_id,
						"overview" 				=>  $this->input->post('overview'),
						"why_jesperapps" 		=>  $this->input->post('why_jesperapps'),
						"contact_title" 		=>  $this->input->post('contact_title'),
						"contact_description" 	=>  $this->input->post('contact_description'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('service_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['service_image']['name']) && $_FILES['service_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['service_image']['tmp_name'], 'uploads/services/service_images/'.$header_id.'.png');
						}

						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/services/banner/'.$header_id.'.png');
						}

						if( isset($_FILES['overview_image']['name']) && $_FILES['overview_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['overview_image']['tmp_name'], 'uploads/services/overviews/'.$header_id.'.png');
						}

						if( isset($_FILES['why_choose_image']['name']) && $_FILES['why_choose_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['why_choose_image']['tmp_name'], 'uploads/services/why_choose_images/'.$header_id.'.png');
						}

						if( isset($_FILES['why_choose_icon_image']['name']) && $_FILES['why_choose_icon_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['why_choose_icon_image']['tmp_name'], 'uploads/services/why_choose_images/why_choose_icon_images/'.$header_id.'.png');
						}

						$count = isset($_POST['line_title']) ? count(array_filter($_POST['line_title'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for($dp=0;$dp<$count;$dp++)
							{
								$line_id 				= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;

								$line_title 			= !empty($_POST['line_title'][$dp]) ? $_POST['line_title'][$dp] : NULL;

								$line_description 		= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
								
								
								$lineData = array(
									"header_id" 		 	=> $header_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('service_lines', $lineData);
								$line_id = $this->db->insert_id();

								// if( isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] !="" )
								// {
								// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], 'uploads/services/'.$line_id.'.png');
								// }
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Service saved successfully!");
							redirect(base_url() . 'services/manageServices/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Service submitted successfully!");
							redirect(base_url() . 'services/manageServices', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->services_model->getViewData($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$service_name 			= $this->input->post('service_name');
					$category_id 			= $this->input->post('category_id');
					
					$checkServicesExists = $this->services_model->checkServicesExists($service_name,$category_id,$type,$id);

					if(count($checkServicesExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Service already exists!");
						redirect(base_url() . 'services/manageServices/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"service_name" 	  		=>  $service_name,
						"category_id" 			=>  $category_id,
						"overview" 				=>  $this->input->post('overview'),
						"why_jesperapps" 		=>  $this->input->post('why_jesperapps'),
						"contact_title" 		=>  $this->input->post('contact_title'),
						"contact_description" 	=>  $this->input->post('contact_description'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('service_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['service_image']['name']) && $_FILES['service_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['service_image']['tmp_name'], 'uploads/services/service_images/'.$id.'.png');
						}

						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/services/banner/'.$id.'.png');
						}

						if( isset($_FILES['overview_image']['name']) && $_FILES['overview_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['overview_image']['tmp_name'], 'uploads/services/overviews/'.$id.'.png');
						}

						if( isset($_FILES['why_choose_image']['name']) && $_FILES['why_choose_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['why_choose_image']['tmp_name'], 'uploads/services/why_choose_images/'.$id.'.png');
						}

						if( isset($_FILES['why_choose_icon_image']['name']) && $_FILES['why_choose_icon_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['why_choose_icon_image']['tmp_name'], 'uploads/services/why_choose_images/why_choose_icon_images/'.$id.'.png');
						}


						$count = isset($_POST['line_title']) ? count(array_filter($_POST['line_title'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for ($dp = 0; $dp < $count; $dp++) {
								
								$line_id 			= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;
								$line_title 		= !empty($_POST['line_title'][$dp]) ? $_POST['line_title'][$dp] : NULL;
								$line_description 	= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
							
								$lineData = array(
									"header_id" 			=> $id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('service_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									// if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/services/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									// }
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('service_lines', $lineData);
							
									// if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/services/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									// }
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Service saved successfully!");
								redirect(base_url() . 'services/manageServices/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Service submitted successfully!");
								redirect(base_url() . 'services/manageServices', 'refresh');
							}
						}
					}
					
				}
				
			break;

			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag' 		=> 'Y',
						'inactive_date' 	=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date' => $this->date_time,
					);
					$succ_msg = 'Service active successfully!';
				}
				else
				{
					$data=array(
						'active_flag' 		=> 'N',
						'inactive_date' 	=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date' => $this->date_time
					);
					#$data['end_date'] = $this->date;
					$succ_msg = 'Service inactive successfully!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('service_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->services_model->getServices("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$service_name 		= isset($_GET['service_name']) ? $_GET['service_name'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'services/manageServices?service_name='.$service_name.'&active_flag='.$active_flag.'';
				
				if ($service_name != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->services_model->getServices($limit, $offset, $this->pageCount);

				if(isset($_GET['per_page']) && $_GET['per_page'] > 1 && count($result) == 0 )
				{
					redirect(base_url().$this->redirectURL, 'refresh');
				}

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
			break;
		}	
		$this->load->view($this->adminTemplate, $page_data);
	}

	function ajaxAvailableServices($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Service is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Service is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('service_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function manageBenefits($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageSerBenefits']	= 1;
		$page_data['page_name']  		= 'services/manageBenefits';
		$page_data['page_title'] 		= 'Benefits';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$category_id 			= $this->input->post('category_id');
					// $title 					= $this->input->post('title');
					
					$checkBenefitsExists = $this->services_model->checkBenefitsExists($category_id,$type,NULL);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Benefit already exists!");
						redirect(base_url() . 'services/manageBenefits/add', 'refresh');
					}

					$headerData = array(
						"category_id" 	  		=>  $category_id,
						// "title" 				=>  $title,
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('services_benefits_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['benefits_banner_image']['name']) && $_FILES['benefits_banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['benefits_banner_image']['tmp_name'], 'uploads/services/benefits/banner/'.$header_id.'.png');
						}

						$count = isset($_POST['line_title']) ? count(array_filter($_POST['line_title'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for($dp=0;$dp<$count;$dp++)
							{
								$line_id 				= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;

								$line_title 			= !empty($_POST['line_title'][$dp]) ? $_POST['line_title'][$dp] : NULL;

								$line_description 		= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
								
								$lineData = array(
									"header_id" 		 	=> $header_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('services_benefits_lines', $lineData);
								$line_id = $this->db->insert_id();

								// if( isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] !="" )
								// {
								// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], 'uploads/services/benefits/'.$line_id.'.png');
								// }
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Benefits saved successfully!");
							redirect(base_url() . 'services/manageBenefits/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Benefits submitted successfully!");
							redirect(base_url() . 'services/manageBenefits', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->services_model->getBenefitsView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$category_id 			= $this->input->post('category_id');
					// $title 					= $this->input->post('title');
					
					$checkBenefitsExists = $this->services_model->checkBenefitsExists($category_id,$type,$id);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Benefit already exists!");
						redirect(base_url() . 'services/manageBenefits/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"category_id" 	  		=>  $category_id,
						// "title" 				=>  $title,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('services_benefits_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['benefits_banner_image']['name']) && $_FILES['benefits_banner_image']['name'] !="" )
						{
							
							move_uploaded_file($_FILES['benefits_banner_image']['tmp_name'], 'uploads/services/benefits/banner/'.$id.'.png');
						}
						$count = isset($_POST['line_title']) ? count(array_filter($_POST['line_title'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for ($dp = 0; $dp < $count; $dp++) {
								
								$line_id 			= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;
								$line_title 		= !empty($_POST['line_title'][$dp]) ? $_POST['line_title'][$dp] : NULL;
								$line_description 	= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
							
								$lineData = array(
									"header_id" 			=> $id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('services_benefits_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									// if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/services/benefits/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									// }
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('services_benefits_lines', $lineData);
							
									// if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/services/benefits/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									// }
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Benefits saved successfully!");
								redirect(base_url() . 'services/manageBenefits/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Benefits submitted successfully!");
								redirect(base_url() . 'services/manageBenefits', 'refresh');
							}
						}
					}
					
				}
				
			break;

			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag' 		=> 'Y',
						'inactive_date' 	=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date' => $this->date_time,
					);
					$succ_msg = 'All benefits in these services are now successfully active!';
				}
				else
				{
					$data=array(
						'active_flag' 		=> 'N',
						'inactive_date' 	=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date' => $this->date_time
					);
					#$data['end_date'] = $this->date;
					$succ_msg = 'All benefits in these services are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('services_benefits_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->services_model->getBenefits("","",$this->totalCount);

				
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$category_id 		= isset($_GET['category_id']) ? $_GET['category_id'] :NULL;
				// $title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'services/manageBenefits?category_id='.$category_id.'&active_flag='.$active_flag.'';
				
				if ($category_id != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->services_model->getBenefits($limit, $offset, $this->pageCount);

				if(isset($_GET['per_page']) && $_GET['per_page'] > 1 && count($result) == 0 )
				{
					redirect(base_url().$this->redirectURL, 'refresh');
				}

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
			break;
		}	
		$this->load->view($this->adminTemplate, $page_data);
	}

	function ajaxAvailableBenefits($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Benefit is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Benefit is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('services_benefits_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}
	function manageDetails($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageSerDetails']	= 1;
		$page_data['page_name']  		= 'services/manageDetails';
		$page_data['page_title'] 		= 'Details';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$category_id 			= $this->input->post('category_id');
					$title 					= $this->input->post('title');
					
					$checkDetailsExists 	= $this->services_model->checkDetailsExists($category_id,$title,$type,NULL);

					if(count($checkDetailsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Detail already exists!");
						redirect(base_url() . 'services/manageDetails/add', 'refresh');
					}

					$headerData = array(
						"category_id" 	  		=>  $category_id,
						"title" 				=>  $title,
						"description" 			=>  $this->input->post('description'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('services_details_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{

						$count = isset($_POST['line_title']) ? count(array_filter($_POST['line_title'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for($dp=0;$dp<$count;$dp++)
							{
								$line_id 				= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;

								$line_title 			= !empty($_POST['line_title'][$dp]) ? $_POST['line_title'][$dp] : NULL;

								$line_description 		= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
								
								$lineData = array(
									"header_id" 		 	=> $header_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('services_details_lines', $lineData);
								$line_id = $this->db->insert_id();

								if( isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] !="" )
								{
									move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], 'uploads/services/details/'.$line_id.'.png');
								}
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Detail saved successfully!");
							redirect(base_url() . 'services/manageDetails/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Detail submitted successfully!");
							redirect(base_url() . 'services/manageDetails', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->services_model->getDetailsView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$category_id 			= $this->input->post('category_id');
					$title 					= $this->input->post('title');
					
					$checkDetailsExists 	= $this->services_model->checkDetailsExists($category_id,$title,$type,$id);

					if(count($checkDetailsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Detail already exists!");
						redirect(base_url() . 'services/manageDetails/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"category_id" 	  		=>  $category_id,
						"title" 				=>  $title,
						"description" 			=>  $this->input->post('description'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('services_details_headers', $headerData);

					if($result)
					{
						
						$count = isset($_POST['line_title']) ? count(array_filter($_POST['line_title'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for ($dp = 0; $dp < $count; $dp++) {
								
								$line_id 			= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;
								$line_title 		= !empty($_POST['line_title'][$dp]) ? $_POST['line_title'][$dp] : NULL;
								$line_description 	= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
							
								$lineData = array(
									"header_id" 			=> $id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('services_details_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/services/details/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									}
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('services_details_lines', $lineData);
							
									if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/services/details/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									}
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Details saved successfully!");
								redirect(base_url() . 'services/manageDetails/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Details submitted successfully!");
								redirect(base_url() . 'services/manageDetails', 'refresh');
							}
						}
					}
					
				}
				
			break;

			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag' 		=> 'Y',
						'inactive_date' 	=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date' => $this->date_time,
					);
					$succ_msg = 'All details in these services are now successfully active!';
				}
				else
				{
					$data=array(
						'active_flag' 		=> 'N',
						'inactive_date' 	=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date' => $this->date_time
					);
					#$data['end_date'] = $this->date;
					$succ_msg = 'All details in these services are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('services_details_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->services_model->getDetails("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$category_id 		= isset($_GET['category_id']) ? $_GET['category_id'] :NULL;
				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'services/manageDetails?category_id='.$category_id.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($category_id != NULL || $title != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->services_model->getDetails($limit, $offset, $this->pageCount);

				if(isset($_GET['per_page']) && $_GET['per_page'] > 1 && count($result) == 0 )
				{
					redirect(base_url().$this->redirectURL, 'refresh');
				}

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
			break;
		}	
		$this->load->view($this->adminTemplate, $page_data);
	}

	function ajaxAvailableDetails($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Detail is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Detail is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('services_details_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

}
?>
