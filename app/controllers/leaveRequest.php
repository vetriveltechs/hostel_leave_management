<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class leaveRequest extends CI_Controller 
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
	
	function manageLeaveRequest($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageLeaveRequest'] 	= 1;
		$page_data['page_name']  			= 'leaveRequest/manageLeaveRequest';
		$page_data['page_title'] 			= 'Leave Requests';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$leave_days		= $this->input->post('leave_days');
					$reason			= $this->input->post('reason');
					$room_number	= $this->input->post('room_number');

					$from_date 		= isset($_POST['from_date']) ? date("Y-m-d",strtotime($_POST['from_date'])) : NULL;
					$to_date 		= isset($_POST['end_date']) ? date("Y-m-d",strtotime($_POST['end_date'])) : NULL;
					
					$checkLeaveExists 	= $this->leave_request_model->checkLeaveExists($from_date,$type,NULL);

					if(count($checkLeaveExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Leave request for the date already exist!");
						redirect(base_url() . 'leaveRequest/manageLeaveRequest/add', 'refresh');
					}

					$postData = array(
						'leave_days' 	         		=> $leave_days,
						'reason' 	         			=> $reason,
						'room_number' 	         		=> $room_number,
						'from_date'        				=> $from_date,
						'to_date' 	         			=> $to_date,
						'student_id' 	         		=> $this->student_id,
						"created_by" 	  		 		=> $this->user_id,
						"created_date" 	  		 		=> $this->date_time,
						"last_updated_by" 	  		 	=> $this->user_id,
						"last_updated_date" 	 		=> $this->date_time
					);

					$this->db->insert('leave_request', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						$studentName						= $this->student_name;
						$page_data['leave_request'] 		= 1;
						$from 								= NOREPLY_EMAIL;				
						$to 								= $this->first_approver_name;
						$subject 							= 'Leave Request';
						$page_data['leave_days'] 			= $leave_days;
						$page_data['reason'] 				= $reason;	
						$page_data['room_number'] 			= $room_number;
						$page_data['subject'] 				= $subject;
						
						$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
						
						if(EMAIL_TYPE == 2) 
						{
							$sendMail = Send_SMTP($from,$to,$subject,$message,$studentName);
						}

						else 
						{
							$sendMail = Send_Grid($from,$to,$subject,$message,$studentName);
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Leave request saved successfully!");
							redirect(base_url() . 'leaveRequest/manageLeaveRequest/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Leave request submitted successfully!");
							redirect(base_url() . 'leaveRequest/manageLeaveRequest', 'refresh');
						}
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->leave_request_model->getViewData($id);
				if($_POST)
				{
					$from_date 		= isset($_POST['from_date']) ? date("Y-m-d",strtotime($_POST['from_date'])) : NULL;
					$to_date 		= isset($_POST['end_date']) ? date("Y-m-d",strtotime($_POST['end_date'])) : NULL;
					
					$checkLeaveExists 	= $this->leave_request_model->checkLeaveExists($from_date,$type,$id);

					if(count($checkLeaveExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Seo content already exist!");
						redirect(base_url() . 'leaveRequest/manageLeaveRequest/edit/'.$id, 'refresh');
					}

					$postData = array(
						'leave_days' 	         		=> $this->input->post('leave_days'),
						'reason' 	         			=> $this->input->post('reason'),
						'room_number' 	         		=> $this->input->post('room_number'),
						'student_id' 	         		=> $this->student_id,
						'from_date'        				=> $from_date,
						'to_date' 	         			=> $to_date,
						"last_updated_by" 	  		 	=> $this->user_id,
						"last_updated_date" 	 		=> $this->date_time
					);
					
					$this->db->where('leave_request_id', $id);
					$result = $this->db->update('leave_request', $postData);
					
					if($result)
					{
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Leave request saved successfully!");
							redirect(base_url() . 'leaveRequest/manageLeaveRequest/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Leave request submitted successfully!");
							redirect(base_url() . 'leaveRequest/manageLeaveRequest', 'refresh');
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

					$succ_msg = 'Leave request active successfully!';
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
					$succ_msg = 'Leave request inactive successfully!';
				}

				$this->db->where('leave_request_id', $id);
				$this->db->update('leave_request', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;

			case ($type == "leaveapprovedstatus"): #Block & Unblock
				
				$data=array(
					'leave_approved_status'	=> $status,
					'inactive_date' 	=> NULL,
					'last_updated_by'	=> $this->user_id,
					'last_updated_date' => $this->date_time
				);
					
				$succ_msg = 'Task status updated!';
				
				$this->db->where('leave_request_id', $id);
				$this->db->update('leave_request', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;


			default : #Manage
				$totalResult = $this->leave_request_model->getLeaveRequests("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$keywords 				= isset($_GET['keywords']) ? $_GET['keywords'] :NULL;
				$leave_approved_status 	= isset($_GET['leave_approved_status']) ? $_GET['leave_approved_status'] :NULL;
				
				$this->redirectURL = 'leaveRequest/manageLeaveRequest?keywords='.$keywords.'&leave_approved_status='.$leave_approved_status.'';
				
				if ($keywords != NULL || $leave_approved_status) {
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
				
				$page_data['resultData'] = $result = $this->leave_request_model->getLeaveRequests($limit, $offset, $this->pageCount);
				
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
