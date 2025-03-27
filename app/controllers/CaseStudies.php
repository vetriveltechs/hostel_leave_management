<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class CaseStudies extends CI_Controller 
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
	
	function manageCaseStudies($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageCaseStudies'] 	= 1;
		$page_data['page_name']  			= 'caseStudies/manageCaseStudies';
		$page_data['page_title'] 			= 'CaseStudies';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$industries_id			= $this->input->post('industries_id');
					$title					= $this->input->post('title');
					$casestudy_url			= url($this->input->post('title'));
					$case_study_category	= $this->input->post('case_study_category');
					$best_casestudy 		= isset($_POST['best_casestudy']) ? $_POST['best_casestudy'] : 'N';

					$checkCaseStudyExist 	= $this->casestudies_model->checkCaseStudiesExist($industries_id,$casestudy_url,$case_study_category,$type,NULL);

					if(count($checkCaseStudyExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Case study already exist!");
						redirect(base_url() . 'caseStudies/manageCaseStudies/add', 'refresh');
					}

					$postData = array(
						'industries_id' 		=> $industries_id,
						'title' 	     		=> $title,
						'casestudy_url' 		=> $casestudy_url,
						'case_study_category' 	=> $case_study_category,
						'client_name'			=> $this->input->post('client_name'),
						'description'			=> $this->input->post('description'),
						'editor_images'			=> $this->input->post('editor_images'),
						'best_casestudy' 		=> $best_casestudy,
						"created_by" 	  		=> $this->user_id,
						"created_date" 	  		=> $this->date_time,
						"last_updated_by" 	  	=> $this->user_id,
						"last_updated_date"		=> $this->date_time
					);

					$this->db->insert('casestudies', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['case_study_image']['name']) && $_FILES['case_study_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['case_study_image']['tmp_name'], 'uploads/case_studies/'.$header_id.'.png');
						}

						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/case_studies/banner/'.$header_id.'.png');
						}

						if( isset($_FILES['client_image']['name']) && $_FILES['client_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['client_image']['tmp_name'], 'uploads/case_studies/client_images/'.$header_id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Case study saved successfully!");
							redirect(base_url() . 'caseStudies/manageCaseStudies/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Case study submitted successfully!");
							redirect(base_url() . 'caseStudies/manageCaseStudies', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->casestudies_model->getViewData($id);
				
				if($_POST)
				{
					
					$industries_id			= $this->input->post('industries_id');

					$title					= $this->input->post('title');

					$casestudy_url			= url($this->input->post('title'));
					
					$case_study_category	= $this->input->post('case_study_category');

					$best_casestudy 		= isset($_POST['best_casestudy']) ? $_POST['best_casestudy'] : 'N';

					$checkCaseStudyExist 	= $this->casestudies_model->checkCaseStudiesExist($industries_id,$casestudy_url,$case_study_category,$type,$id);

					if(count($checkCaseStudyExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Case study already exist!");
						redirect(base_url() . 'caseStudies/manageCaseStudies/edit/'.$id, 'refresh');
					}

					$postData = array(
						'industries_id' 		=> $industries_id,
						'title' 	     		=> $title,
						'casestudy_url' 		=> $casestudy_url,
						'case_study_category' 	=> $case_study_category,
						'client_name'			=> $this->input->post('client_name'),
						'description'			=> $this->input->post('description'),
						'best_casestudy' 		=> $best_casestudy,
						"created_by" 	  		=> $this->user_id,
						"created_date" 	  		=> $this->date_time,
						"last_updated_by" 	  	=> $this->user_id,
						"last_updated_date"		=> $this->date_time
					);
					
					$this->db->where('casestudies_id', $id);
					$result = $this->db->update('casestudies', $postData);
					
					if($result)
					{
						if( isset($_FILES['case_study_image']['name']) && $_FILES['case_study_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['case_study_image']['tmp_name'], 'uploads/case_studies/'.$id.'.png');
						}
						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/case_studies/banner/'.$id.'.png');
						}

						if( isset($_FILES['client_image']['name']) && $_FILES['client_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['client_image']['tmp_name'], 'uploads/case_studies/client_images/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Case study saved successfully!");
							redirect(base_url() . 'caseStudies/manageCaseStudies/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Case study submitted successfully!");
							redirect(base_url() . 'caseStudies/manageCaseStudies', 'refresh');
						}
					}
				}
			break;
			
			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag'		=> "Y",
						'inactive_date'		=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);

					$succ_msg = 'Case studies active successfully!';
				}
				else
				{
					$data=array(
						'active_flag'		=> "N",
						'inactive_date'		=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);
					$succ_msg = 'Case studies inactive successfully!';
				}

				$this->db->where('casestudies_id', $id);
				$this->db->update('casestudies', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->casestudies_model->getCaseStudies("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				
				$industries_id 			= isset($_GET['industries_id']) ? $_GET['industries_id'] :NULL;
				$industries_name 		= isset($_GET['industries_name']) ? $_GET['industries_name'] :NULL;
				$case_study_category 	= isset($_GET['case_study_category']) ? $_GET['case_study_category'] :NULL;
				$keywords 				= isset($_GET['keywords']) ? $_GET['keywords'] :NULL;
				$active_flag 			= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL = 'caseStudies/manageCaseStudies?industries_id='.$industries_id.'&industries_name='.$industries_name.'&case_study_category='.$case_study_category.'&keywords='.$keywords.'&case_study_category='.$case_study_category.'&active_flag='.$active_flag.'';
				
				if ($industries_id != NULL | $industries_name != NULL || $case_study_category != NULL || $keywords != NULL || $active_flag != NULL) {
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
				
				$page_data['resultData'] = $result = $this->casestudies_model->getCaseStudies($limit, $offset, $this->pageCount);
				
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

	function ajaxCasestudyListAll() 	#ajaxlistitems
	{
		$casestudy_title 	= isset($_POST["casestudy_title"]) ? $_POST["casestudy_title"] : NULL;
		// $page_type 			= isset($_POST["page_type"]) ? $_POST["page_type"] : NULL;
		
		if($casestudy_title)  
		{  
			$output = '';  

			$result = $this->casestudies_model->getCaseStudyAll($casestudy_title);
			
			$output = '<ul class="list-unstyled-casestudy_id">';  
			
			if( count($result) > 0 )  
			{  	
				foreach($result as $row)  
				{	
					$casestudies_id 	= $row["casestudies_id"];
					$casestudy_title 	= $row["title"];
					$output .= '<a><li onclick="return getCasestudyList(\'' .$casestudies_id. '\',\'' .$casestudy_title. '\');">'.ucfirst($casestudy_title) . '</li></a>';  
				}  
			}  
			else  
			{  
				$casestudies_id 	= 0;
				$casestudy_title 	= "";
				
				$output .= '<li onclick="return getCasestudyList(\'' .$casestudies_id. '\',\'' .$casestudy_title. '\');">No data found.</li>';  
			}
			$output .= '</ul>';  
			echo $output;  
		}
	}

	public function ajaxCaseStudiesList($list_type_value_id = '')
	{
		if (!empty($list_type_value_id) && $list_type_value_id !== 'all') {
			$result = $this->casestudies_model->getCaseStudiesList($list_type_value_id);
		} else {
			$result = $this->casestudies_model->getCaseStudiesList();
		}

		$page_data['result'] = $result;
		$html = $this->load->view('themes/default/case_study_listing', $page_data, true);
		echo $html;
		exit;
	}


	function manageOverviews($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageOverviews']	= 1;
		$page_data['page_name']  		= 'caseStudies/manageOverviews';
		$page_data['page_title'] 		= 'Overviews';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkOverviewExists 	= $this->casestudies_model->checkOverviewExists($casestudies_id,$type,NULL);

					if(count($checkOverviewExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Overview already exists!");
						redirect(base_url() . 'caseStudies/manageOverviews/add', 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"description" 			=>  $this->input->post('description'),
						"conclusion" 			=>  $this->input->post('conclusion'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('overview_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['overview_image']['name']) && $_FILES['overview_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['overview_image']['tmp_name'], 'uploads/case_studies/overviews/'.$header_id.'.png');
						}

						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/case_studies/overviews/banner/'.$header_id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('overview_lines', $lineData);
								$line_id = $this->db->insert_id();

							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Overviews saved successfully!");
							redirect(base_url() . 'caseStudies/manageOverviews/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Overviews submitted successfully!");
							redirect(base_url() . 'caseStudies/manageOverviews', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->casestudies_model->getOverviewData($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkOverviewExists = $this->casestudies_model->checkOverviewExists($casestudies_id,$type,$id);

					if(count($checkOverviewExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Overview already exists!");
						redirect(base_url() . 'caseStudies/manageOverviews/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"description" 			=>  $this->input->post('description'),
						"conclusion" 			=>  $this->input->post('conclusion'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('overview_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['overview_image']['name']) && $_FILES['overview_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['overview_image']['tmp_name'], 'uploads/case_studies/overviews/'.$id.'.png');
						}

						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/case_studies/overviews/banner/'.$id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('overview_lines', $lineData);
									$line_id = $this->db->insert_id();
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('overview_lines', $lineData);
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Overviews saved successfully!");
								redirect(base_url() . 'caseStudies/manageOverviews/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Overviews submitted successfully!");
								redirect(base_url() . 'caseStudies/manageOverviews', 'refresh');
							}
						}
					}
				}
				
			break;

			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag'		=> "Y",
						'inactive_date'		=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);

					$succ_msg = 'Overview active successfully!';
				}
				else
				{
					$data=array(
						'active_flag'		=> "N",
						'inactive_date'		=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);
					$succ_msg = 'Overview inactive successfully!';
				}

				$this->db->where('header_id', $id);
				$this->db->update('overview_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->casestudies_model->getOverViews("","",$this->totalCount);

				
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$casestudies_id 	= isset($_GET['casestudies_id']) ? $_GET['casestudies_id'] :NULL;
				$casestudies_title 	= isset($_GET['casestudies_title']) ? $_GET['casestudies_title'] :NULL;
				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'caseStudies/manageOverviews?casestudies_id='.$casestudies_id.'&casestudies_title='.$casestudies_title.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($casestudies_id != NULL || $casestudies_title !=NULL || $title !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->casestudies_model->getOverViews($limit, $offset, $this->pageCount);

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

	function ajaxAvailableOverviews($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Overview is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Overview is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('overview_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function manageOurSolutions($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 						= $type;
		$page_data['id'] 						= $id;
		$page_data['manageCasestudySolutions']	= 1;
		$page_data['page_name']  				= 'caseStudies/manageOurSolutions';
		$page_data['page_title'] 				= 'Solutions';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkSolutionExists 	= $this->casestudies_model->checkSolutionExists($casestudies_id,$type,NULL);

					if(count($checkSolutionExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Solution already exists!");
						redirect(base_url() . 'caseStudies/manageOurSolutions/add', 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"title" 				=>  $this->input->post('title'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('casestudy_solution_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['solution_image']['name']) && $_FILES['solution_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['solution_image']['tmp_name'], 'uploads/case_studies/solutions/'.$header_id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('casestudy_solution_lines', $lineData);
								$line_id = $this->db->insert_id();

							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Solution saved successfully!");
							redirect(base_url() . 'caseStudies/manageOurSolutions/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Solution submitted successfully!");
							redirect(base_url() . 'caseStudies/manageOurSolutions', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->casestudies_model->getSolutionviewData($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkSolutionExists = $this->casestudies_model->checkSolutionExists($casestudies_id,$type,$id);

					if(count($checkSolutionExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Solution already exists!");
						redirect(base_url() . 'caseStudies/manageOurSolutions/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"title" 				=>  $this->input->post('title'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('casestudy_solution_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['solution_image']['name']) && $_FILES['solution_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['solution_image']['tmp_name'], 'uploads/case_studies/solutions/'.$id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('casestudy_solution_lines', $lineData);
									$line_id = $this->db->insert_id();
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('casestudy_solution_lines', $lineData);
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Overviews saved successfully!");
								redirect(base_url() . 'caseStudies/manageOurSolutions/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Overviews submitted successfully!");
								redirect(base_url() . 'caseStudies/manageOurSolutions', 'refresh');
							}
						}
					}
				}
				
			break;

			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag'		=> "Y",
						'inactive_date'		=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);

					$succ_msg = 'Solution active successfully!';
				}
				else
				{
					$data=array(
						'active_flag'		=> "N",
						'inactive_date'		=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);
					$succ_msg = 'Solution inactive successfully!';
				}

				$this->db->where('header_id', $id);
				$this->db->update('casestudy_solution_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->casestudies_model->getSolutions("","",$this->totalCount);

				
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$casestudies_id 	= isset($_GET['casestudies_id']) ? $_GET['casestudies_id'] :NULL;
				$casestudies_title 	= isset($_GET['casestudies_title']) ? $_GET['casestudies_title'] :NULL;
				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'caseStudies/manageOverviews?casestudies_id='.$casestudies_id.'&casestudies_title='.$casestudies_title.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($casestudies_id != NULL || $casestudies_title !=NULL || $title !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->casestudies_model->getSolutions($limit, $offset, $this->pageCount);

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

	function ajaxAvailableOurSolution($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Solution is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Solution is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('casestudy_solution_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function manageKeyFeatures($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 							= $type;
		$page_data['id'] 							= $id;
		$page_data['manageCasestudyKeyFeatures']	= 1;
		$page_data['page_name']  					= 'caseStudies/manageKeyFeatures';
		$page_data['page_title'] 					= 'Key Features';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkSolutionExists 	= $this->casestudies_model->checkKeyFeaturesExists($casestudies_id,$type,NULL);

					if(count($checkSolutionExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Key feature already exists!");
						redirect(base_url() . 'caseStudies/manageKeyFeatures/add', 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('casestudy_keyfeature_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['key_feature_image']['name']) && $_FILES['key_feature_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['key_feature_image']['tmp_name'], 'uploads/case_studies/key_features/'.$header_id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('casestudy_keyfeature_lines', $lineData);
								$line_id = $this->db->insert_id();

							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Key feature saved successfully!");
							redirect(base_url() . 'caseStudies/manageKeyFeatures/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Key feature submitted successfully!");
							redirect(base_url() . 'caseStudies/manageKeyFeatures', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->casestudies_model->getKeyFeaturesData($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkSolutionExists 	= $this->casestudies_model->checkKeyFeaturesExists($casestudies_id,$type,$id);

					if(count($checkSolutionExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Key feature already exists!");
						redirect(base_url() . 'caseStudies/manageKeyFeatures/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('casestudy_keyfeature_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['key_feature_image']['name']) && $_FILES['key_feature_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['key_feature_image']['tmp_name'], 'uploads/case_studies/key_features/'.$id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('casestudy_keyfeature_lines', $lineData);
									$line_id = $this->db->insert_id();
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('casestudy_keyfeature_lines', $lineData);
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Key feature saved successfully!");
								redirect(base_url() . 'caseStudies/manageKeyFeatures/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Key feature submitted successfully!");
								redirect(base_url() . 'caseStudies/manageKeyFeatures', 'refresh');
							}
						}
					}
				}
				
			break;

			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag'		=> "Y",
						'inactive_date'		=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);

					$succ_msg = 'Key feature active successfully!';
				}
				else
				{
					$data=array(
						'active_flag'		=> "N",
						'inactive_date'		=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);
					$succ_msg = 'Key feature inactive successfully!';
				}

				$this->db->where('header_id', $id);
				$this->db->update('casestudy_keyfeature_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->casestudies_model->getKeyFeatures("","",$this->totalCount);

				
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$casestudies_id 	= isset($_GET['casestudies_id']) ? $_GET['casestudies_id'] :NULL;
				$casestudies_title 	= isset($_GET['casestudies_title']) ? $_GET['casestudies_title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'caseStudies/manageKeyFeatures?casestudies_id='.$casestudies_id.'&casestudies_title='.$casestudies_title.'&active_flag='.$active_flag.'';
				
				if ($casestudies_id != NULL || $casestudies_title !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->casestudies_model->getKeyFeatures($limit, $offset, $this->pageCount);

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

	function ajaxAvailableKeyFeatures($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Key feature is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Key feature is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('casestudy_keyfeature_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function manageImpacts($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageImpacts']		= 1;
		$page_data['page_name']  		= 'caseStudies/manageImpacts';
		$page_data['page_title'] 		= 'Impacts & Results';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkImpactsExists 	= $this->casestudies_model->checkImpactsExists($casestudies_id,$type,NULL);

					if(count($checkImpactsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Impacts & results already exists!");
						redirect(base_url() . 'caseStudies/manageImpacts/add', 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('impact_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['impact_image']['name']) && $_FILES['impact_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['impact_image']['tmp_name'], 'uploads/case_studies/impacts/'.$header_id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('impact_lines', $lineData);
								$line_id = $this->db->insert_id();

							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Impacts & results saved successfully!");
							redirect(base_url() . 'caseStudies/manageImpacts/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Impacts & results submitted successfully!");
							redirect(base_url() . 'caseStudies/manageImpacts', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->casestudies_model->getImpactsData($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$casestudies_id 		= $this->input->post('casestudies_id');
					
					$checkImpactsExists 	= $this->casestudies_model->checkImpactsExists($casestudies_id,$type,$id);

					if(count($checkImpactsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Impacts & results already exists!");
						redirect(base_url() . 'caseStudies/manageKeyFeatures/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"casestudies_id" 		=>  $casestudies_id,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('impact_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['impact_image']['name']) && $_FILES['impact_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['impact_image']['tmp_name'], 'uploads/case_studies/impacts/'.$id.'.png');
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
									"casestudies_id" 		=> $casestudies_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('impact_lines', $lineData);
									$line_id = $this->db->insert_id();
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('impact_lines', $lineData);
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Impacts & results saved successfully!");
								redirect(base_url() . 'caseStudies/manageImpacts/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Impacts & results submitted successfully!");
								redirect(base_url() . 'caseStudies/manageImpacts', 'refresh');
							}
						}
					}
				}
				
			break;

			case ($type == "status"): #Block & Unblock
				if($status == "Y")
				{
					$data=array(
						'active_flag'		=> "Y",
						'inactive_date'		=> NULL,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);

					$succ_msg = 'Impacts & results active successfully!';
				}
				else
				{
					$data=array(
						'active_flag'		=> "N",
						'inactive_date'		=> $this->date_time,
						'last_updated_by'	=> $this->user_id,
						'last_updated_date'	=> $this->date_time,
						// 'end_date'			=> $this->date
					);
					$succ_msg = 'Impacts & results inactive successfully!';
				}

				$this->db->where('header_id', $id);
				$this->db->update('impact_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->casestudies_model->getImpacts("","",$this->totalCount);

				
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$casestudies_id 	= isset($_GET['casestudies_id']) ? $_GET['casestudies_id'] :NULL;
				$casestudies_title 	= isset($_GET['casestudies_title']) ? $_GET['casestudies_title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'caseStudies/manageImpacts?casestudies_id='.$casestudies_id.'&casestudies_title='.$casestudies_title.'&active_flag='.$active_flag.'';
				
				if ($casestudies_id != NULL || $casestudies_title !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->casestudies_model->getImpacts($limit, $offset, $this->pageCount);

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

	function ajaxAvailableImpacts($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Impact & result is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Impact & result is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('impact_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	public function upload_editor_image() {
		if (isset($_FILES['image'])) {
			$target_dir = "uploads/case_studies/editor_images/";
			$filename = $_FILES["image"]["name"];
			$target_file = $target_dir . $filename;
	
			if (!is_dir($target_dir)) {
				mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
			}
	
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				echo json_encode(['status' => 'success', 'url' => base_url($target_file)]);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No image file was uploaded.']);
		}
	}

}
?>
