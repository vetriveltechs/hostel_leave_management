<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class Industries extends CI_Controller 
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
	function manageIndustries($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageIndustries'] 		= 1;
		$page_data['page_name']  			= 'industries/manageIndustries';
		$page_data['page_title'] 			= 'Industries';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$industries_code 			= $this->input->post('industries_code');
					$industries_name 			= $this->input->post('industries_name');
					$industries_url 			= url($industries_name);
					$checkIndustriesExist 		= $this->industries_model->checkIndustriesExist($industries_url,$type,NULL);

					if(count($checkIndustriesExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Industry already exist!");
						redirect(base_url() . 'industries/manageIndustries/add', 'refresh');
					}

					$postData = array(
						'industries_code' 		=> $industries_code,
						'industries_name' 		=> $industries_name,
						'industries_url' 		=> $industries_url,
						'banner_title' 	 		=> $this->input->post('banner_title'),
						'description' 	  		=> $this->input->post('description'),
						'overview' 	  			=> $this->input->post('overview'),
						'video_link' 	  		=> $this->input->post('video_link'),
						"created_by" 	 		=> $this->user_id,
						"created_date" 	  		=> $this->date_time,
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);

					$this->db->insert('industries', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['industries_image']['name']) && $_FILES['industries_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['industries_image']['tmp_name'], 'uploads/industries/'.$header_id.'.png');
						}
						if( isset($_FILES['overview_image']['name']) && $_FILES['overview_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['overview_image']['tmp_name'], 'uploads/industries/overview_image/'.$header_id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Industry saved successfully!");
							redirect(base_url() . 'industries/manageIndustries/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Industry submitted successfully!");
							redirect(base_url() . 'industries/manageIndustries', 'refresh');
						}
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->industries_model->getIndustriesView($id);
				if($_POST)
				{
					$industries_code 			= $this->input->post('industries_code');
					$industries_name 			= $this->input->post('industries_name');
					$industries_url 			= url($industries_name);
					$checkIndustriesExist 		= $this->industries_model->checkIndustriesExist($industries_url,$type,$id);

					if(count($checkIndustriesExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Industry already exist!");
						redirect(base_url() . 'industries/manageIndustries/edit/'.$id, 'refresh');
					}

					$postData = array(
						'industries_code' 		=> $industries_code,
						'industries_name' 		=> $industries_name,
						'industries_url' 		=> $industries_url,
						'banner_title' 	  		=> $this->input->post('banner_title'),
						'description' 	  		=> $this->input->post('description'),
						'overview' 	  			=> $this->input->post('overview'),
						'video_link' 	  		=> $this->input->post('video_link'),
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);
					
					$this->db->where('industries_id', $id);
					$header_id = $this->db->update('industries', $postData);
					
					if($header_id)
					{
						if( isset($_FILES['industries_image']['name']) && $_FILES['industries_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['industries_image']['tmp_name'], 'uploads/industries/'.$id.'.png');
						}
						if( isset($_FILES['overview_image']['name']) && $_FILES['overview_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['overview_image']['tmp_name'], 'uploads/industries/overview_image/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Industry saved successfully!");
							redirect(base_url() . 'industries/manageIndustries/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Industry submitted successfully!");
							redirect(base_url() . 'industries/manageIndustries', 'refresh');
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
					$succ_msg = 'Industry active successfully!';
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
					$succ_msg = 'Industry inactive successfully!';
				}
				$this->db->where('industries_id', $id);
				$this->db->update('industries', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 			= $this->industries_model->getIndustries("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{
					$limit = $_SESSION['PAGE'];
				}
				else
				{
					$limit = 10;
				}

				$industries_id 		= isset($_GET['industries_id']) ? $_GET['industries_id'] :NULL;
				$industries_name 	= isset($_GET['industries_name']) ? $_GET['industries_name'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL = 'industries/manageIndustries?industries_id='.$industries_id.'&industries_name='.$industries_name.'&active_flag='.$active_flag.'';
				
				if ($industries_id != NULL || $industries_name !=NULL || $active_flag !=NULL) {
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
				
				if($offset == 1 || $offset== "" || $offset== 0)
				{
					$page_data["first_item"] = 1;
				}
				else
				{
					$page_data["first_item"] = $offset + 1;
				}
				
				$page_data['resultData'] = $result = $this->industries_model->getIndustries($limit, $offset, $this->pageCount);
				
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

	function manageOurSolutions($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageOurSolutions'] 	= 1;
		$page_data['page_name']  			= 'industries/manageOurSolutions';
		$page_data['page_title'] 			= 'Our Solution';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$industries_id 			= $this->input->post('industries_id');
					$solution_title 		= $this->input->post('solution_title');
					
					$getOurSolutionsExists = $this->industries_model->checkOurSolutionsExists($industries_id,$solution_title,$type,NULL);

					if(count($getOurSolutionsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Our solution already exists!");
						redirect(base_url() . 'industries/manageOurSolutions/add', 'refresh');
					}

					$headerData = array(
						"industries_id" 	 	=>  $industries_id,
						"solution_title" 		=>  $solution_title,
						"description" 			=>  $this->input->post('description'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('our_solutions_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['solution_image']['name']) && $_FILES['solution_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['solution_image']['tmp_name'], 'uploads/industries/solution_image/'.$header_id.'.png');
						}

						$count = isset($_POST['line_description']) ? count(array_filter($_POST['line_description'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for($dp=0;$dp<$count;$dp++)
							{
								$line_id 				= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;

								$line_description 		= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
								
								$lineData = array(
									"header_id" 		 	=> $header_id,
									"industries_id" 		=> $industries_id,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('our_solutions_lines', $lineData);
								$line_id = $this->db->insert_id();

							
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Our solution saved successfully!");
							redirect(base_url() . 'industries/manageOurSolutions/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Our solution submitted successfully!");
							redirect(base_url() . 'industries/manageOurSolutions', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->industries_model->getOurSolutionsView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$industries_id 			= $this->input->post('industries_id');
					$solution_title 		= $this->input->post('solution_title');
					
					$getOurSolutionsExists = $this->industries_model->checkOurSolutionsExists($industries_id,$solution_title,$type,$id);

					if(count($getOurSolutionsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Our solution already exists!");
						redirect(base_url() . 'industries/manageOurSolutions/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"industries_id" 		=>  $industries_id,
						"solution_title" 		=>  $solution_title,
						"description" 			=>  $this->input->post('description'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('our_solutions_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['solution_image']['name']) && $_FILES['solution_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['solution_image']['tmp_name'], 'uploads/industries/solution_image/'.$id.'.png');
						}

						$count = isset($_POST['line_description']) ? count(array_filter($_POST['line_description'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for ($dp = 0; $dp < $count; $dp++) {
								
								$line_id 			= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;
								$line_description 	= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
							
								$lineData = array(
									"header_id" 			=> $id,
									"industries_id" 		=> $industries_id,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('our_solutions_lines', $lineData);
									$line_id = $this->db->insert_id();
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('our_solutions_lines', $lineData);
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Our solution saved successfully!");
								redirect(base_url() . 'industries/manageOurSolutions/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Our solution submitted successfully!");
								redirect(base_url() . 'industries/manageOurSolutions', 'refresh');
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
					$succ_msg = 'All our solutions in these industry are now successfully active!';
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
					$succ_msg = 'All our solutions in these industry are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('our_solutions_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->industries_model->getOurSolutions("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$industries_id 		= isset($_GET['industries_id']) ? $_GET['industries_id'] :NULL;
				$industries_name 	= isset($_GET['industries_name']) ? $_GET['industries_name'] :NULL;
				$solution_title 	= isset($_GET['solution_title']) ? $_GET['solution_title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'industries/manageOurSolutions?industries_id='.$industries_id.'&industries_name='.$industries_name.'&solution_title='.$solution_title.'&active_flag='.$active_flag.'';
				
				if ($industries_id != NULL || $industries_name != NULL || $solution_title != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->industries_model->getOurSolutions($limit, $offset, $this->pageCount);

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

	function ajaxAvailableOurSolutions($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Our Solution is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Our Solution is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update(' our_solutions_lines', $data);
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
		$page_data['manageInsBenefits']	= 1;
		$page_data['page_name']  		= 'industries/manageBenefits';
		$page_data['page_title'] 		= 'Benefits';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$industries_id 			= $this->input->post('industries_id');
					$title 					= $this->input->post('title');
					
					$checkBenefitsExists = $this->industries_model->checkBenefitsExists($industries_id,$title,$type,NULL);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Benefits already exists!");
						redirect(base_url() . 'industries/manageBenefits/add', 'refresh');
					}

					$headerData = array(
						"industries_id" 		=>  $industries_id,
						"title" 				=>  $title,
						"description" 			=>  $this->input->post('description'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('industries_benefits_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['benefits_image']['name']) && $_FILES['benefits_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['benefits_image']['tmp_name'], 'uploads/industries/benefits/'.$header_id.'.png');
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
									"industries_id" 		=> $industries_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('industries_benefits_lines', $lineData);
								$line_id = $this->db->insert_id();

								
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "key Features saved successfully!");
							redirect(base_url() . 'industries/manageBenefits/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "key Features submitted successfully!");
							redirect(base_url() . 'industries/manageBenefits', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->industries_model->getBenefitsView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$industries_id 			= $this->input->post('industries_id');
					$title 					= $this->input->post('title');
					
					$checkBenefitsExists = $this->industries_model->checkBenefitsExists($industries_id,$title,$type,$id);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Key Feauture already exists!");
						redirect(base_url() . 'industries/manageBenefits/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"industries_id" 		=>  $industries_id,
						"title" 				=>  $title,
						"description" 			=>  $this->input->post('description'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('industries_benefits_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['benefits_image']['name']) && $_FILES['benefits_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['benefits_image']['tmp_name'], 'uploads/industries/benefits/'.$id.'.png');
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
									"industries_id" 		=> $industries_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('industries_benefits_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('industries_benefits_lines', $lineData);
							
									
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "key Features saved successfully!");
								redirect(base_url() . 'industries/manageBenefits/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "key Features submitted successfully!");
								redirect(base_url() . 'industries/manageBenefits', 'refresh');
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
					$succ_msg = 'All benefits in these industry are now successfully active!';
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
					$succ_msg = 'All benefits in this these are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('industries_benefits_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->industries_model->getBenefits("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$industries_id 		= isset($_GET['industries_id']) ? $_GET['industries_id'] :NULL;
				$industries_name	= isset($_GET['industries_name']) ? $_GET['industries_name'] :NULL;
				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'industries/manageBenefits?industries_id='.$industries_id.'&industries_name='.$industries_name.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($industries_id != NULL || $industries_name != NULL || $title != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->industries_model->getBenefits($limit, $offset, $this->pageCount);

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
				$this->db->update('industries_benefits_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}


	function ajaxIndustriesListAll() 	#ajaxlistitems
	{
		$industries_name = isset($_POST["industries_name"]) ? $_POST["industries_name"] : NULL;
		if($industries_name)  
		{  
			$output = '';  

			$result = $this->industries_model->ajaxIndustriesListAll($industries_name);
			
			$output = '<ul class="list-unstyled-industries_id">';  
			
			if( count($result) > 0 )  
			{  	
				foreach($result as $row)  
				{	
					$industries_id 		= $row["industries_id"];
					$industries_code 	= $row["industries_code"];
					$industries_name 	= $row["industries_name"];
					$output .= '<a><li onclick="return getIndustriesList(\'' .$industries_id. '\',\'' .$industries_code. '\',\'' .$industries_name. '\');">' . $industries_code . '-' . ucfirst($industries_name) . '</li></a>';  
				}  
			}  
			else  
			{  
				$industries_id 		= 0;
				$industries_code 	= "";
				$industries_name 	= "";
				
				$output .= '<li onclick="return getIndustriesList(\'' .$industries_id. '\',\'' .$industries_code. '\',\'' .$industries_name. '\');">No data found.</li>';  
			}
			$output .= '</ul>';  
			echo $output;  
		}
	}

}
?>
