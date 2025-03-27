<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department extends CI_Controller 
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
	
	function ManageDepartment($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] = $type;
		$page_data['id'] = $id;
		
		$page_data['ManageDepartment']  = 1;
		$page_data['page_name']         = 'department/ManageDepartment';
		$page_data['page_title']        = 'Departments';
		
		switch(true)
		{
			case ($type == "add"): #View
				if($_POST)
				{
					$department_name        = $this->input->post('department_name');
					
					$checkDepartmentExist 	= $this->department_model->checkDepartmentExist($department_name,$type,NULL);

					if(count($checkDepartmentExist) > 0)
					{
                        $this->session->set_flashdata('error_message' , "Department already exist!");
						redirect(base_url() . 'department/ManageDepartment/add', 'refresh');
					}
					
                    $postData=array(
                        'department_name'           => $department_name,
                        'department_description'    => $this->input->post('department_description'),
                        "created_by" 	  		    => $this->user_id,
						"created_date" 	  		    => $this->date_time,
						"last_updated_by" 	  	    => $this->user_id,
						"last_updated_date"		    => $this->date_time
                    );
					
					$this->db->insert('emp_departments', $postData);
					$id = $this->db->insert_id();
					
					if($id !="")
					{
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Department saved successfully!");
							redirect(base_url() . 'department/ManageDepartment/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Department submitted successfully!");
							redirect(base_url() . 'department/ManageDepartment', 'refresh');
						}
					}
				}
			break;
			
			case ($type == "edit" || $type == "view"): #edit
					
                $page_data['editData'] = $this->department_model->getViewData($id);
				
				if($_POST)
				{
					$department_name        = $this->input->post('department_name');
					
					$checkDepartmentExist 	= $this->department_model->checkDepartmentExist($department_name,$type,$id);

					if(count($checkDepartmentExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Department Already exist!");
						redirect(base_url() . 'department/ManageDepartment/edit/'.$id, 'refresh');
					}

                    $postData=array(
                        'department_name'           => $department_name,
                        'department_description'    => $this->input->post('department_description'),
						"last_updated_by" 	  	    => $this->user_id,
						"last_updated_date"		    => $this->date_time
                    );
					
					$this->db->where('department_id', $id);
					$result = $this->db->update('emp_departments', $postData);
					
					if($result)
					{
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Department saved successfully!");
							redirect(base_url() . 'department/ManageDepartment/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Department submitted successfully!");
							redirect(base_url() . 'department/ManageDepartment', 'refresh');
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

					$succ_msg = 'Department active successfully!';
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
					$succ_msg = 'Department inactive successfully!';
				}

				$this->db->where('department_id', $id);
				$this->db->update('emp_departments', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER["HTTP_REFERER"], 'refresh');
			break;
			
			default : #Manage
            $totalResult = $this->department_model->getDepartments("","",$this->totalCount);
            $page_data["totalRows"] = $totalRows = count($totalResult);

            if(!empty($_SESSION['PAGE']))
            {$limit = $_SESSION['PAGE'];
            }else{$limit = 10;}

            $department_id 		= isset($_GET['department_id']) ? $_GET['department_id'] :NULL;
            
            $active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
            
            $this->redirectURL = 'blogs/manageBlogs?department_id='.$department_id.'&active_flag='.$active_flag.'';
            
            if ( $department_id != NULL || $active_flag != NULL) 
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
            
            $page_data['resultData'] = $result = $this->department_model->getDepartments($limit, $offset, $this->pageCount);
            
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
		}	
		$this->load->view($this->adminTemplate, $page_data);
	}
	
	# Employee Ratings
	
	
}
?>
