<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class staffDetails extends CI_Controller 
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
	
	function manageStaffDetails($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageStaffDetails'] 	= 1;
		$page_data['page_name']  			= 'staffDetails/manageStaffDetails';
		$page_data['page_title'] 			= 'Staff Details';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$email_id 	         	= $this->input->post('email_id');
					$contact_number 	 	= $this->input->post('contact_number');
					
					$checkStaffExists 	= $this->staff_details_model->checkStaffExists($email_id,$contact_number,$type,NULL);

					if(count($checkStaffExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Staff detail already exist!");
						redirect(base_url() . 'staffDetails/manageStaffDetails/add', 'refresh');
					}

					$postData = array(
						'staff_name' 	         		=> $this->input->post('staff_name'),
						'department_id' 	     		=> $this->input->post('department_id'),
						'academic_year' 	     		=> $this->input->post('academic_year'),
						'email_id' 	     				=> $email_id,
						'contact_number' 	     		=> $contact_number,
						'position_name' 	      		=> $this->input->post('position_name'),
						"created_by" 	  		 		=> $this->user_id,
						"created_date" 	  		 		=> $this->date_time,
						"last_updated_by" 	  		 	=> $this->user_id,
						"last_updated_date" 	 		=> $this->date_time
					);

					$this->db->insert('staff_details', $postData);
					$id = $this->db->insert_id();
					
					if($id)
					{
						$getDocumentData=$this->common_model->documentNumber('STAFF');
							
						$prefixName 		= isset($getDocumentData[0]['prefix_name']) ? $getDocumentData[0]['prefix_name'] : NULL;
						$startingNumber 	= isset($getDocumentData[0]['next_number']) ? $getDocumentData[0]['next_number'] : NULL;
						$suffixName 		= isset($getDocumentData[0]['suffix_name']) ? $getDocumentData[0]['suffix_name'] : NULL;
						$documentNumber 	= $prefixName.''.$startingNumber.''.$suffixName;
						$updateDocNum 		= array(
							"staff_roll_number" 		=>  $documentNumber,
							"last_updated_by" 	  	 	=>  $this->user_id,
							"last_updated_date" 	 	=>  $this->date_time
						);

						$this->db->where('staff_id', $id);
						$headerTbl1 = $this->db->update('staff_details', $updateDocNum);


						#Update Next Val DOC Number tbl start
						$str_len = strlen($startingNumber);
						$nextValue1 = $startingNumber + 1;
						$nextValue = str_pad($nextValue1,$str_len,"0",STR_PAD_LEFT);

						$doc_num_id = isset($getDocumentData[0]['doc_num_id']) ? $getDocumentData[0]['doc_num_id']:"";
						
						$UpdateData['next_number'] = $nextValue;
						$this->db->where('doc_num_id', $doc_num_id);
						$resultUpdateData = $this->db->update('doc_document_numbering', $UpdateData);
						#Update Next Val DOC Number tbl end


						if( isset($_FILES['staff_image']['name']) && $_FILES['staff_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['staff_image']['tmp_name'], 'uploads/staff_images/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Staff detail saved successfully!");
							redirect(base_url() . 'staffDetails/manageStaffDetails/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Staff detail submitted successfully!");
							redirect(base_url() . 'staffDetails/manageStaffDetails', 'refresh');
						}
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->staff_details_model->getViewData($id);
				if($_POST)
				{
					$email_id 	         	= $this->input->post('email_id');
					$contact_number 	 	= $this->input->post('contact_number');
					
					$checkStaffExists 	= $this->staff_details_model->checkStaffExists($email_id,$contact_number,$type,$id);

					if(count($checkStaffExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Staff detail already exist!");
						redirect(base_url() . 'staffDetails/manageStaffDetails/edit/'.$id, 'refresh');
					}

					$postData = array(
						'staff_name' 	         		=> $this->input->post('staff_name'),
						'department_id' 	     		=> $this->input->post('department_id'),
						'academic_year' 	     		=> $this->input->post('academic_year'),
						'email_id' 	     				=> $email_id,
						'contact_number' 	     		=> $contact_number,
						'position_name' 	      		=> $this->input->post('position_name'),
						"last_updated_by" 	  		 	=> $this->user_id,
						"last_updated_date" 	 		=> $this->date_time
					);
					
					$this->db->where('staff_id', $id);
					$result = $this->db->update('staff_details', $postData);
					
					if($result)
					{
						if( isset($_FILES['staff_image']['name']) && $_FILES['staff_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['staff_image']['tmp_name'], 'uploads/staff_images/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Staff detail saved successfully!");
							redirect(base_url() . 'staffDetails/manageStaffDetails/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Staff detail submitted successfully!");
							redirect(base_url() . 'staffDetails/manageStaffDetails', 'refresh');
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

					$succ_msg = 'Staff active successfully!';
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
					$succ_msg = 'Staff inactive successfully!';
				}

				$this->db->where('staff_id', $id);
				$this->db->update('staff_details', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->staff_details_model->getStaffDetails("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$staff_id 					= isset($_GET['staff_id']) ? $_GET['staff_id'] :NULL;
				$department_id 				= isset($_GET['department_id']) ? $_GET['department_id'] :NULL;
				$academic_year 				= isset($_GET['academic_year']) ? $_GET['academic_year'] :NULL;
				$active_flag 				= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL = 'staffDetails/manageStaffDetails?staff_id='.$staff_id.'&department_id='.$department_id.'&academic_year='.$academic_year.'&active_flag='.$active_flag.'';
				
				if ($staff_id != NULL || $department_id != NULL || $academic_year != NULL || $active_flag!=NULL) 
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
				
				if($offset == 1 || $offset== "" || $offset== 0)
				{
					$page_data["first_item"] = 1;
				}
				else
				{
					$page_data["first_item"] = $offset + 1;
				}
				
				$page_data['resultData'] = $result = $this->staff_details_model->getStaffDetails($limit, $offset, $this->pageCount);
				
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
