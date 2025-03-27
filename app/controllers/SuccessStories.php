<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class SuccessStories extends CI_Controller 
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
	
	function manageSuccessStories($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageSuccessStories'] 	= 1;
		$page_data['page_name']  			= 'successStories/manageSuccessStories';
		$page_data['page_title'] 			= 'SuccessStories';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$title						= $this->input->post('title');
					$industries_id				= $this->input->post('industries_id');

					$checkSuccessStoriesExist 	= $this->successstories_model->checkSuccessStoriesExist($title,$industries_id,$type,NULL);

					if(count($checkSuccessStoriesExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Success stories already exist!");
						redirect(base_url() . 'successStories/manageSuccessStories/add', 'refresh');
					}

					$postData = array(
						'title' 	     			=> $title,
						'industries_id' 			=> $industries_id,
						"created_by" 	  			=> $this->user_id,
						"created_date" 	  			=> $this->date_time,
						"last_updated_by" 	  		=> $this->user_id,
						"last_updated_date"			=> $this->date_time
					);

					$this->db->insert('successstories', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['successstories_image']['name']) && $_FILES['successstories_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['successstories_image']['tmp_name'], 'uploads/successstories_image/'.$header_id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Success stories saved successfully!");
							redirect(base_url() . 'successStories/manageSuccessStories/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Success stories submitted successfully!");
							redirect(base_url() . 'successStories/manageSuccessStories', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->successstories_model->getViewData($id);
				
				if($_POST)
				{
					$title						= $this->input->post('title');
					$industries_id				= $this->input->post('industries_id');

					$checkSuccessStoriesExist 	= $this->successstories_model->checkSuccessStoriesExist($title,$industries_id,$type,$id);

					if(count($checkSuccessStoriesExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Success stories already exist!");
						redirect(base_url() . 'successStories/manageSuccessStories/edit/'.$id, 'refresh');
					}

					$postData = array(
						'title' 	     			=> $title,
						'industries_id' 	   		=> $industries_id,
						"created_by" 	  			=> $this->user_id,
						"created_date" 	  			=> $this->date_time,
						"last_updated_by" 	  		=> $this->user_id,
						"last_updated_date"			=> $this->date_time
					);
					
					$this->db->where('successstories_id', $id);
					$result = $this->db->update('successstories', $postData);
					
					if($result)
					{
						if( isset($_FILES['successstories_image']['name']) && $_FILES['successstories_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['successstories_image']['tmp_name'], 'uploads/successstories_image/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Success stories saved successfully!");
							redirect(base_url() . 'successStories/manageSuccessStories/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Success stories submitted successfully!");
							redirect(base_url() . 'successStories/manageSuccessStories', 'refresh');
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

					$succ_msg = 'Success stories active successfully!';
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
					$succ_msg = 'Success stories inactive successfully!';
				}

				$this->db->where('successstories_id', $id);
				$this->db->update('successstories', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->successstories_model->getSuccessStories("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$industries_id 		= isset($_GET['industries_id']) ? $_GET['industries_id'] :NULL;
				$industries_name 	= isset($_GET['industries_name']) ? $_GET['industries_name'] :NULL;
				$keywords 			= isset($_GET['keywords']) ? $_GET['keywords'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL = 'successStories/manageSuccessStories?industries_id='.$industries_id.'&industries_name='.$industries_name.'&keywords='.$keywords.'&active_flag='.$active_flag.'';
				
				if ($industries_id != NULL || $industries_name != NULL || $keywords != NULL ||  $active_flag != NULL) {
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
				
				$page_data['resultData'] = $result = $this->successstories_model->getSuccessStories($limit, $offset, $this->pageCount);
				
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


}
?>
