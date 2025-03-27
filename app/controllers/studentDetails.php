<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class studentDetails extends CI_Controller 
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
	
	function manageStudentDetails($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageStudentDetails'] 	= 1;
		$page_data['page_name']  			= 'studentDetails/manageStudentDetails';
		$page_data['page_title'] 			= 'Student Details';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$email_id 	         	= $this->input->post('email_id');
					$contact_number 	 	= $this->input->post('contact_number');
					
					$checkStudentExists 	= $this->student_details_model->checkStudentExists($email_id,$contact_number,$type,NULL);

					if(count($checkStudentExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Student detail already exist!");
						redirect(base_url() . 'studentDetails/manageStudentDetails/add', 'refresh');
					}

					$postData = array(
						'student_name' 	         		=> $this->input->post('student_name'),
						'department_id' 	     		=> $this->input->post('department_id'),
						'academic_year' 	     		=> $this->input->post('academic_year'),
						'email_id' 	     				=> $email_id,
						'contact_number' 	     		=> $contact_number,
						'guardian_name' 	      		=> $this->input->post('guardian_name'),
						'guardian_number' 	      		=> $this->input->post('guardian_number'),
						'room_number' 	      			=> $this->input->post('room_number'),
						'first_approver_id' 	    	=> $this->input->post('first_approver_id'),
						'second_approver_id' 	  		=> $this->input->post('second_approver_id'),
						"created_by" 	  		 		=> $this->user_id,
						"created_date" 	  		 		=> $this->date_time,
						"last_updated_by" 	  		 	=> $this->user_id,
						"last_updated_date" 	 		=> $this->date_time
					);

					$this->db->insert('student_details', $postData);
					$id = $this->db->insert_id();
					
					if($id)
					{
						$getDocumentData=$this->common_model->documentNumber('STUDENT');
							
						$prefixName 		= isset($getDocumentData[0]['prefix_name']) ? $getDocumentData[0]['prefix_name'] : NULL;
						$startingNumber 	= isset($getDocumentData[0]['next_number']) ? $getDocumentData[0]['next_number'] : NULL;
						$suffixName 		= isset($getDocumentData[0]['suffix_name']) ? $getDocumentData[0]['suffix_name'] : NULL;
						$documentNumber 	= $prefixName.''.$startingNumber.''.$suffixName;
						$updateDocNum 		= array(
							"student_roll_number" 		=>  $documentNumber,
							"last_updated_by" 	  	 	=>  $this->user_id,
							"last_updated_date" 	 	=>  $this->date_time
						);

						$this->db->where('student_id', $id);
						$headerTbl1 = $this->db->update('student_details', $updateDocNum);


						#Update Next Val DOC Number tbl start
						$str_len = strlen($startingNumber);
						$nextValue1 = $startingNumber + 1;
						$nextValue = str_pad($nextValue1,$str_len,"0",STR_PAD_LEFT);

						$doc_num_id = isset($getDocumentData[0]['doc_num_id']) ? $getDocumentData[0]['doc_num_id']:"";
						
						$UpdateData['next_number'] = $nextValue;
						$this->db->where('doc_num_id', $doc_num_id);
						$resultUpdateData = $this->db->update('doc_document_numbering', $UpdateData);
						#Update Next Val DOC Number tbl end


						if( isset($_FILES['student_image']['name']) && $_FILES['student_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['student_image']['tmp_name'], 'uploads/student_images/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Student detail saved successfully!");
							redirect(base_url() . 'studentDetails/manageStudentDetails/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Student detail submitted successfully!");
							redirect(base_url() . 'studentDetails/manageStudentDetails', 'refresh');
						}
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->student_details_model->getViewData($id);
				if($_POST)
				{
					$email_id 	         	= $this->input->post('email_id');
					$contact_number 	 	= $this->input->post('contact_number');
					
					$checkStudentExists 	= $this->student_details_model->checkStudentExists($email_id,$contact_number,$type,$id);

					if(count($checkStudentExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Student detail already exist!");
						redirect(base_url() . 'studentDetails/manageStudentDetails/edit/'.$id, 'refresh');
					}

					$postData = array(
						'student_name' 	         		=> $this->input->post('student_name'),
						'department_id' 	     		=> $this->input->post('department_id'),
						'academic_year' 	     		=> $this->input->post('academic_year'),
						'email_id' 	     				=> $email_id,
						'contact_number' 	     		=> $contact_number,
						'guardian_name' 	      		=> $this->input->post('guardian_name'),
						'guardian_number' 	      		=> $this->input->post('guardian_number'),
						'first_approver_id' 	    	=> $this->input->post('first_approver_id'),
						'second_approver_id' 	  		=> $this->input->post('second_approver_id'),
						'room_number' 	      			=> $this->input->post('room_number'),
						"last_updated_by" 	  		 	=> $this->user_id,
						"last_updated_date" 	 		=> $this->date_time
					);
					
					$this->db->where('student_id', $id);
					$result = $this->db->update('student_details', $postData);
					
					if($result)
					{
						if( isset($_FILES['student_image']['name']) && $_FILES['student_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['student_image']['tmp_name'], 'uploads/student_images/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Student detail saved successfully!");
							redirect(base_url() . 'studentDetails/manageStudentDetails/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Student detail submitted successfully!");
							redirect(base_url() . 'studentDetails/manageStudentDetails', 'refresh');
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

					$succ_msg = 'Student active successfully!';
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
					$succ_msg = 'Student inactive successfully!';
				}

				$this->db->where('student_id', $id);
				$this->db->update('student_details', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->student_details_model->getStudentDetails("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$student_id 				= isset($_GET['student_id']) ? $_GET['student_id'] :NULL;
				$department_id 				= isset($_GET['department_id']) ? $_GET['department_id'] :NULL;
				$academic_year 				= isset($_GET['academic_year']) ? $_GET['academic_year'] :NULL;
				$active_flag 				= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL = 'studentDetails/manageStudentDetails?student_id='.$student_id.'&department_id='.$department_id.'&academic_year='.$academic_year.'&active_flag='.$active_flag.'';
				
				if ($student_id != NULL || $department_id != NULL || $academic_year != NULL || $active_flag!=NULL) 
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
				
				$page_data['resultData'] = $result = $this->student_details_model->getStudentDetails($limit, $offset, $this->pageCount);
				
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
