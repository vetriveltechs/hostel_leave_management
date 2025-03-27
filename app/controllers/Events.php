<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class Events extends CI_Controller 
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
	
	function manageEvents($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageEvents'] 			= 1;
		$page_data['page_name']  			= 'events/manageEvents';
		$page_data['page_title'] 			= 'Events';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$event_title 			= $this->input->post('event_title');
					$event_url 				= url($this->input->post('event_title'));
					$start_date 			= isset($_POST['start_date']) ? date("Y-m-d",strtotime($_POST['start_date'])) : NULL;
					$end_date 				= isset($_POST['end_date']) ? date("Y-m-d",strtotime($_POST['end_date'])) : NULL;
					
					$checkEventExist 		= $this->events_model->checkEventExist($event_url,$type,NULL);

					if(count($checkEventExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event already exist!");
						redirect(base_url() . 'events/manageEvents/add', 'refresh');
					}

					$postData = array(
						'event_title' 	   		=> $event_title,
						'event_url' 	   		=> $event_url,
						'location_name' 	 	=> $this->input->post('location_name'),
						'description' 	 		=> $this->input->post('description'),
						'start_date' 	 		=> $start_date,
						'end_date' 	 			=> $end_date,
						"created_by" 	 		=> $this->user_id,
						"created_date" 	  		=> $this->date_time,
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);

					$this->db->insert('events', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['event_image']['name']) && $_FILES['event_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['event_image']['tmp_name'], 'uploads/events/'.$header_id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Event saved successfully!");
							redirect(base_url() . 'events/manageEvents/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Event submitted successfully!");
							redirect(base_url() . 'events/manageEvents', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->events_model->getViewData($id);

				if($_POST)
				{

					$event_title 			= $this->input->post('event_title');
					$event_url 				= url($this->input->post('event_title'));
					$start_date 			= isset($_POST['start_date']) ? date("Y-m-d",strtotime($_POST['start_date'])) : NULL;
					$end_date 				= isset($_POST['end_date']) ? date("Y-m-d",strtotime($_POST['end_date'])) : NULL;
					$checkEventExist 		= $this->events_model->checkEventExist($event_url,$type,$id);

					if(count($checkEventExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event already exist!");
						redirect(base_url() . 'events/manageEvents/edit/'.$id, 'refresh');
					}

					$postData = array(
						'event_title' 	   		=> $event_title,
						'event_url' 	   		=> $event_url,
						'location_name' 	  	=> $this->input->post('location_name'),
						'description' 	 		=> $this->input->post('description'),
						'start_date' 	 		=> $start_date,
						'end_date' 	 			=> $end_date,
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);
					
					$this->db->where('event_id', $id);
					$result = $this->db->update('events', $postData);
					
					if($result)
					{
						if( isset($_FILES['event_image']['name']) && $_FILES['event_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['event_image']['tmp_name'], 'uploads/events/'.$id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Event saved successfully!");
							redirect(base_url() . 'events/manageEvents/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Event submitted successfully!");
							redirect(base_url() . 'events/manageEvents', 'refresh');
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
					$succ_msg = 'Event active successfully!';
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
					$succ_msg = 'Event inactive successfully!';
				}
				$this->db->where('event_id', $id);
				$this->db->update('events', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 			= $this->events_model->getEvents("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{
					$limit = $_SESSION['PAGE'];
				}
				else
				{
					$limit = 10;
				}

				$event_id 		= isset($_GET['event_id']) ? $_GET['event_id'] :NULL;
				$event_name 	= isset($_GET['event_name']) ? $_GET['event_name'] :NULL;
				$from_date 		= isset($_GET['from_date']) ? $_GET['from_date'] :NULL;
				$to_date 		= isset($_GET['to_date']) ? $_GET['to_date'] :NULL;
				$active_flag 	= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL = 'events/manageEvents?event_id='.$event_id.'&event_name='.$event_name.'&from_date='.$from_date.'&to_date='.$to_date.'&active_flag='.$active_flag.'';
				
				if ($event_id != NULL || $event_name != NULL || $from_date != NULL || $to_date != NULL || $active_flag != NULL) {
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
				
				$page_data['resultData'] = $result = $this->events_model->getEvents($limit, $offset, $this->pageCount);
				
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

	function manageEventDetails($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageEventDetails'] 	= 1;
		$page_data['page_name']  			= 'events/manageEventDetails';
		$page_data['page_title'] 			= 'Events Details';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$event_id 				= $this->input->post('event_id');
					$title 					= $this->input->post('title');
					$checkEventDetailExist	= $this->events_model->checkEventDetailExist($event_id,$title,$type,NULL);

					if(count($checkEventDetailExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event detail already exist!");
						redirect(base_url() . 'events/manageEventDetails/add', 'refresh');
					}

					$postData = array(
						'event_id' 	   			=> $event_id,
						'title' 	 			=> $title,
						'description' 	 		=> $this->input->post('description'),
						"created_by" 	 		=> $this->user_id,
						"created_date" 	  		=> $this->date_time,
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);

					$this->db->insert('event_details', $postData);
					$id = $this->db->insert_id();
					
					if($id)
					{
						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/events/details/banner/'.$id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Event detail saved successfully!");
							redirect(base_url() . 'events/manageEventDetails/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Event detail submitted successfully!");
							redirect(base_url() . 'events/manageEventDetails', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->events_model->getEventDetailsView($id);

				if($_POST)
				{
					$event_id 				= $this->input->post('event_id');
					$title 					= $this->input->post('title');
					$checkEventDetailExist	= $this->events_model->checkEventDetailExist($event_id,$title,$type,$id);

					if(count($checkEventDetailExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event detail already exist!");
						redirect(base_url() . 'events/manageEventDetails/edit/'.$id, 'refresh');
					}

					$postData = array(
						'event_id' 	   			=> $event_id,
						'title' 	   			=> $title,
						'description' 	 		=> $this->input->post('description'),
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);
					
					$this->db->where('event_detail_id', $id);
					$result = $this->db->update('event_details', $postData);
					
					if($result)
					{
						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/events/details/banner/'.$id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Event detail saved successfully!");
							redirect(base_url() . 'events/manageEventDetails/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Event detail submitted successfully!");
							redirect(base_url() . 'events/manageEventDetails', 'refresh');
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
					$succ_msg = 'Event detail active successfully!';
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
					$succ_msg = 'Event detail inactive successfully!';
				}
				$this->db->where('event_detail_id', $id);
				$this->db->update('event_details', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 			= $this->events_model->getEventDetails("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{
					$limit = $_SESSION['PAGE'];
				}
				else
				{
					$limit = 10;
				}

				$event_id 		= isset($_GET['event_id']) ? $_GET['event_id'] :NULL;
				$event_name 	= isset($_GET['event_name']) ? $_GET['event_name'] :NULL;
				$keywords 		= isset($_GET['keywords']) ? $_GET['keywords'] :NULL;
				$active_flag 	= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL = 'events/manageEventDetails?event_id='.$event_id.'&event_name='.$event_name.'&keywords='.$keywords.'&active_flag='.$active_flag.'';
				
				if ($event_id != NULL || $event_name != NULL || $keywords != NULL || $active_flag != NULL) {
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
				
				$page_data['resultData'] = $result = $this->events_model->getEventDetails($limit, $offset, $this->pageCount);
				
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

	function manageEventBanners($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageEventBanners']	= 1;
		$page_data['page_name']  			= 'events/manageEventBanners';
		$page_data['page_title'] 			= 'Event Banners';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$title 			= $this->input->post('title');
					
					$checkEventBannerExists 	= $this->events_model->checkEventBannerExists($title,$type,NULL);

					if(count($checkEventBannerExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event banner already exists!");
						redirect(base_url() . 'events/manageEventBanners/add', 'refresh');
					}

					$headerData = array(
						"title" 				=>  $title,
						"description" 			=>  $this->input->post('description'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('event_banner_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						$count = isset($_POST['order_sequence']) ? count(array_filter($_POST['order_sequence'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for($dp=0;$dp<$count;$dp++)
							{
								$line_id 				= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;

								$order_sequence 		= !empty($_POST['order_sequence'][$dp]) ? $_POST['order_sequence'][$dp] : NULL;
								
								$lineData = array(
									"header_id" 		 	=> $header_id,
									"order_sequence" 		=> $order_sequence,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('event_banner_lines', $lineData);
								$line_id = $this->db->insert_id();

								if( isset($_FILES['banner_image']['name'][$dp]) && $_FILES['banner_image']['name'][$dp] !="" )
								{
									move_uploaded_file($_FILES['banner_image']['tmp_name'][$dp], 'uploads/events/event_banners/'.$line_id.'.png');
								}
							}

							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Event banner saved successfully!");
								redirect(base_url() . 'events/manageEventBanners/edit/'.$header_id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Event banner submitted successfully!");
								redirect(base_url() . 'events/manageEventBanners', 'refresh');
							}
						}
						#Line Data end
					
						
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->events_model->getBannerViewsData($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$title 			= $this->input->post('title');
					
					$checkEventBannerExists 	= $this->events_model->checkEventBannerExists($title,$type,$id);

					if(count($checkEventBannerExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event banner already exists!");
						redirect(base_url() . 'events/manageEventBanners/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"title" 				=>  $title,
						"description" 			=>  $this->input->post('description'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('event_banner_headers', $headerData);

					if($result)
					{
						$count = isset($_POST['order_sequence']) ? count(array_filter($_POST['order_sequence'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for ($dp = 0; $dp < $count; $dp++) {
								
								$line_id 				= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;
								$order_sequence 		= !empty($_POST['order_sequence'][$dp]) ? $_POST['order_sequence'][$dp] : NULL;
								
								$lineData = array(
									"header_id" 			=> $id,
									"order_sequence" 		=> $order_sequence,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] 	= $this->user_id;
									$lineData['created_date'] 	= $this->date_time;
							
									$this->db->insert('event_banner_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									if (isset($_FILES['banner_image']['name'][$dp]) && $_FILES['banner_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/events/event_banners/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['banner_image']['tmp_name'][$dp], $uploadFile);
									}


								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('event_banner_lines', $lineData);
							
									if (isset($_FILES['banner_image']['name'][$dp]) && $_FILES['banner_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/events/event_banners/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['banner_image']['tmp_name'][$dp], $uploadFile);
									}
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Event banner saved successfully!");
								redirect(base_url() . 'events/manageEventBanners/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Event banner submitted successfully!");
								redirect(base_url() . 'events/manageEventBanners', 'refresh');
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
					$succ_msg = 'All banner in this event are now active successfully!';
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
					$succ_msg = 'All banner in this event are now inactive successfully!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('event_banner_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->events_model->getEventBanners("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'events/manageEventBanners?title='.$title.'&active_flag='.$active_flag.'';
				
				if ($title != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->events_model->getEventBanners($limit, $offset, $this->pageCount);

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

	function ajaxAvailableBanner($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Banner is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Banner is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('event_banner_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function manageEventGallery($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageEventGallery']	= 1;
		$page_data['page_name']  			= 'events/manageEventGallery';
		$page_data['page_title'] 			= 'Gallery';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$event_id 				= $this->input->post('event_id');
					
					$checkGalleryExists 	= $this->events_model->checkGalleryExists($event_id,$type,NULL);

					if(count($checkGalleryExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event gallery already exists!");
						redirect(base_url() . 'events/manageEventGallery/add', 'refresh');
					}

					$headerData = array(
						"event_id" 	  			=>  $event_id,
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('event_gallery_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						$count = isset($_POST['order_sequence']) ? count(array_filter($_POST['order_sequence'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for($dp=0;$dp<$count;$dp++)
							{
								$line_id 				= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;

								$order_sequence 		= !empty($_POST['order_sequence'][$dp]) ? $_POST['order_sequence'][$dp] : NULL;

								$line_description 		= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
								
								$lineData = array(
									"header_id" 		 	=> $header_id,
									"event_id" 				=> $event_id,
									"order_sequence" 		=> $order_sequence,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('event_gallery_lines', $lineData);
								$line_id = $this->db->insert_id();

								if( isset($_FILES['gallery_image']['name'][$dp]) && $_FILES['gallery_image']['name'][$dp] !="" )
								{
									move_uploaded_file($_FILES['gallery_image']['tmp_name'][$dp], 'uploads/events/gallery/'.$line_id.'.png');
								}
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Event gallery saved successfully!");
							redirect(base_url() . 'events/manageEventGallery/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Event gallery submitted successfully!");
							redirect(base_url() . 'events/manageEventGallery', 'refresh');
						}
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->events_model->getGalleryView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$event_id 				= $this->input->post('event_id');
					$checkGalleryExists 	= $this->events_model->checkGalleryExists($event_id,$type,$id);

					if(count($checkGalleryExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Event gallery already exists!");
						redirect(base_url() . 'events/manageEventGallery/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"event_id" 	  				=>  $event_id,
						"last_updated_by" 	 		=>  $this->user_id,
						"last_updated_date" 		=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('event_gallery_headers', $headerData);

					if($result)
					{
						$count = isset($_POST['order_sequence']) ? count(array_filter($_POST['order_sequence'])) : NULL;

						#Line Data start
						if($count>0)
						{
							for ($dp = 0; $dp < $count; $dp++) {
								
								$line_id 			= !empty($_POST['line_id'][$dp]) ? $_POST['line_id'][$dp] : 0;
								$order_sequence 	= !empty($_POST['order_sequence'][$dp]) ? $_POST['order_sequence'][$dp] : NULL;
								$line_description 	= !empty($_POST['line_description'][$dp]) ? $_POST['line_description'][$dp] : NULL;
							
								$lineData = array(
									"header_id" 			=> $id,
									"event_id" 				=> $event_id,
									"order_sequence" 		=> $order_sequence,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('event_gallery_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									if (isset($_FILES['gallery_image']['name'][$dp]) && $_FILES['gallery_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/events/gallery/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['gallery_image']['tmp_name'][$dp], $uploadFile);
									}
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('event_gallery_lines', $lineData);

									if (isset($_FILES['gallery_image']['name'][$dp]) && $_FILES['gallery_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/events/gallery/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['gallery_image']['tmp_name'][$dp], $uploadFile);
									}
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Event gallery saved successfully!");
								redirect(base_url() . 'events/manageEventGallery/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) 
							{
								$this->session->set_flashdata('flash_message' , "Event gallery submitted successfully!");
								redirect(base_url() . 'events/manageEventGallery', 'refresh');
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
					$succ_msg = 'All galleries in these event are now successfully active!';
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
					$succ_msg = 'All galleries in these event are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('event_gallery_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 				= $this->events_model->getEventGallery("","",$this->totalCount);
				
				$page_data["totalRows"] 	= $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$event_id 		= isset($_GET['event_id']) ? $_GET['event_id'] :NULL;
				$event_name 	= isset($_GET['event_name']) ? $_GET['event_name'] :NULL;
				$active_flag 	= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'events/manageEventGallery?event_id='.$event_id.'&event_name='.$event_name.'&active_flag='.$active_flag.'';
				
				if ($event_id != NULL || $event_name !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->events_model->getEventGallery($limit, $offset, $this->pageCount);

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

	function ajaxAvailableGallery($type = '', $id = '', $status = '')
    {
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Event gallery is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Event gallery is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('event_gallery_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function ajaxEventsListAll() 	#ajaxlistitems
	{
		$event_title = isset($_POST["event_title"]) ? $_POST["event_title"] : NULL;
		if($event_title)  
		{  
			$output = '';  

			$result = $this->events_model->ajaxEventsListAll($event_title);
			
			$output = '<ul class="list-unstyled-event_title_id">';  
			
			if( count($result) > 0 )  
			{  	
				foreach($result as $row)  
				{	
					$event_id 		= $row["event_id"];
					$event_title 	= $row["event_title"];
					$output .= '<a><li onclick="return getEventsList(\'' .$event_id. '\',\'' .$event_title. '\');">'. ucfirst($event_title) . '</li></a>';  
				}  
			}  
			else  
			{  
				$event_id 		= 0;
				$event_title 	= "";
				
				$output .= '<li onclick="return getEventsList(\'' .$event_id. '\',\'' .$event_title. '\');">No data found.</li>';  
			}
			$output .= '</ul>';  
			echo $output;  
		}
	}

	function manageAbouts($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageAbouts']		= 1;
		$page_data['page_name']  		= 'events/manageAbouts';
		$page_data['page_title'] 		= 'About Events';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$event_id 			= $this->input->post('event_id');
					
					$checkEventExists = $this->events_model->checkEventExists($event_id,$type,NULL);

					if(count($checkEventExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "About event already exists!");
						redirect(base_url() . 'events/manageAbouts/add', 'refresh');
					}

					$headerData = array(
						"event_id" 	  			=>  $event_id,
						"about_title" 			=>  $this->input->post('about_title'),
						"description" 			=>  $this->input->post('description'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('about_headers',$headerData);
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

								$this->db->insert('about_lines', $lineData);
								$line_id = $this->db->insert_id();
								
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "About event saved successfully!");
							redirect(base_url() . 'events/manageAbouts/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "About event submitted successfully!");
							redirect(base_url() . 'events/manageAbouts', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->events_model->getAboutsData($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$event_id 			= $this->input->post('event_id');
					
					$checkEventExists 	= $this->events_model->checkEventExists($event_id,$type,$id);

					if(count($checkEventExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "About event already exists!");
						redirect(base_url() . 'events/manageAbouts/add', 'refresh');
					}

					$headerData = array(
						"event_id" 	  			=>  $event_id,
						"about_title" 			=>  $this->input->post('about_title'),
						"description" 			=>  $this->input->post('description'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->where('header_id', $id);
					$result = $this->db->update('about_headers', $headerData);

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
							
									$this->db->insert('about_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('about_lines', $lineData);
							
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "About event saved successfully!");
								redirect(base_url() . 'events/manageAbouts/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "About event submitted successfully!");
								redirect(base_url() . 'events/manageAbouts', 'refresh');
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
					$succ_msg = 'All aboutus in these event are now successfully active!';
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
					$succ_msg = 'All aboutus in these event are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('about_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 				= $this->events_model->getAbouts("","",$this->totalCount);
				
				$page_data["totalRows"] 	= $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$event_id 		= isset($_GET['event_id']) ? $_GET['event_id'] :NULL;
				$event_name 	= isset($_GET['event_name']) ? $_GET['event_name'] :NULL;
				$keyword 		= isset($_GET['keyword']) ? $_GET['keyword'] :NULL;
				$active_flag	= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'events/manageAbouts?event_id='.$event_id.'&event_name='.$event_name.'&keyword='.$keyword.'&active_flag='.$active_flag.'';
				
				if ($event_id != NULL || $event_name != NULL || $keyword != NULL || $active_flag !=NULL) 
				{
					$base_url = base_url().$this->redirectURL;
				} 
				else 
				{
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
				
				$page_data['resultData'] = $result = $this->events_model->getAbouts($limit, $offset, $this->pageCount);

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

	function ajaxAvailableAbouts($type = '', $id = '', $status = '')
    {
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'About is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'About is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('about_lines', $data);
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
		$page_data['manageEventBenefits']	= 1;
		$page_data['page_name']  		= 'events/manageBenefits';
		$page_data['page_title'] 		= 'Benefits';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$event_id 				= $this->input->post('event_id');
					
					$checkBenefitsExists 	= $this->events_model->checkBenefitsExists($event_id,$type,NULL);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Benefit already exists!");
						redirect(base_url() . 'events/manageBenefits/add', 'refresh');
					}

					$headerData = array(
						"event_id" 	  			=>  $event_id,
						"title" 				=>  $this->input->post('title'),
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('event_benefits_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['benefit_image']['name']) && $_FILES['benefit_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['benefit_image']['tmp_name'], 'uploads/events/banner/'.$header_id.'.png');
						}

						$count 		= isset($_POST['line_title']) ? count(array_filter($_POST['line_title'])) : NULL;

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

								$this->db->insert('event_benefits_lines', $lineData);
								$line_id = $this->db->insert_id();

							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Benefits saved successfully!");
							redirect(base_url() . 'events/manageBenefits/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Benefits submitted successfully!");
							redirect(base_url() . 'events/manageBenefits', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->events_model->getBenefitsView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$event_id 				= $this->input->post('event_id');
					
					$checkBenefitsExists 	= $this->events_model->checkBenefitsExists($event_id,$type,$id);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Benefit already exists!");
						redirect(base_url() . 'events/manageBenefits/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"event_id" 	  			=>  $event_id,
						"title" 				=>  $this->input->post('title'),
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('event_benefits_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['benefit_image']['name']) && $_FILES['benefit_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['benefit_image']['tmp_name'], 'uploads/events/benefits/'.$id.'.png');
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
							
									$this->db->insert('event_benefits_lines', $lineData);
									$line_id = $this->db->insert_id();
							
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('event_benefits_lines', $lineData);
							
									
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Benefits saved successfully!");
								redirect(base_url() . 'events/manageBenefits/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Benefits submitted successfully!");
								redirect(base_url() . 'events/manageBenefits', 'refresh');
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
					$succ_msg = 'All benefits in these event are now successfully active!';
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
					$succ_msg = 'All benefits in these event are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('event_benefits_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->events_model->getBenefits("","",$this->totalCount);

				
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$event_id 		= isset($_GET['event_id']) ? $_GET['event_id'] :NULL;
				$event_name 	= isset($_GET['event_name']) ? $_GET['event_name'] :NULL;
				$title 			= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 	= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'events/manageBenefits?event_id='.$event_id.'&event_name='.$event_name.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($event_id != NULL || $event_name != NULL || $title != NULL || $active_flag !=NULL) 
				{
					$base_url = base_url().$this->redirectURL;
				} 
				else 
				{
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
				
				$page_data['resultData'] = $result = $this->events_model->getBenefits($limit, $offset, $this->pageCount);

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
				$this->db->update('event_benefits_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}
	
}
?>
