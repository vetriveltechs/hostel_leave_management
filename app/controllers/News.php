<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class News extends CI_Controller 
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
	function manageNews($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageNews'] 			= 1;
		$page_data['page_name']  			= 'news/manageNews';
		$page_data['page_title'] 			= 'Newses';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$news_title 			= $this->input->post('news_title');
					$checkNewsExist 		= $this->news_model->checkNewsExist($news_title,$type,NULL);

					if(count($checkNewsExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "News already exist!");
						redirect(base_url() . 'news/manageNews/add', 'refresh');
					}

					$postData = array(
						'news_title' 	  		=> $news_title,
						'short_description' 	=> $this->input->post('short_description'),
						'description' 			=> $this->input->post('description'),
						'client_name' 			=> $this->input->post('client_name'),
						'editor_images' 		=> $this->input->post('editor_images'),
						'from_date'				=> isset($_POST["from_date"]) ? date('Y-m-d', strtotime($_POST["from_date"])) : NULL,
						'to_date'				=> isset($_POST["to_date"]) ? date('Y-m-d', strtotime($_POST["to_date"])) : NULL,
						"created_by" 	 		=> $this->user_id,
						"created_date" 	  		=> $this->date_time,
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);

					$this->db->insert('news', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['news_image']['name']) && $_FILES['news_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['news_image']['tmp_name'], 'uploads/news/'.$header_id.'.png');
						}

						if( isset($_FILES['background_banner_image']['name']) && $_FILES['background_banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['background_banner_image']['tmp_name'], 'uploads/news/background_banner/'.$header_id.'.png');
						}
						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/news/banner/'.$header_id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "News saved successfully!");
							redirect(base_url() . 'news/manageNews/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "News submitted successfully!");
							redirect(base_url() . 'news/manageNews', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->news_model->getViewData($id);
				if($_POST)
				{

					$news_title 			= $this->input->post('news_title');
					$checkNewsExist 		= $this->news_model->checkNewsExist($news_title,$type,$id);

					if(count($checkNewsExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "News already exist!");
						redirect(base_url() . 'news/manageNews/edit/'.$id, 'refresh');
					}

					$postData = array(
						'news_title' 	  		=> $news_title,
						'short_description' 	=> $this->input->post('short_description'),
						'description' 			=> $this->input->post('description'),
						'client_name' 			=> $this->input->post('client_name'),
						'from_date'				=> isset($_POST["from_date"]) ? date('Y-m-d', strtotime($_POST["from_date"])) : NULL,
						'to_date'				=> isset($_POST["to_date"]) ? date('Y-m-d', strtotime($_POST["to_date"])) : NULL,
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);
					
					$this->db->where('news_id', $id);
					$result = $this->db->update('news', $postData);
					
					if($result)
					{
						if( isset($_FILES['news_image']['name']) && $_FILES['news_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['news_image']['tmp_name'], 'uploads/news/'.$id.'.png');
						}

						if( isset($_FILES['background_banner_image']['name']) && $_FILES['background_banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['background_banner_image']['tmp_name'], 'uploads/news/background_banner/'.$id.'.png');
						}
						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/news/banner/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "News saved successfully!");
							redirect(base_url() . 'news/manageNews/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "News submitted successfully!");
							redirect(base_url() . 'news/manageNews', 'refresh');
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
					$succ_msg = 'News active successfully!';
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
					$succ_msg = 'News inactive successfully!';
				}
				$this->db->where('news_id', $id);
				$this->db->update('news', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 			= $this->news_model->getNews("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{
					$limit = $_SESSION['PAGE'];
				}
				else
				{
					$limit = 10;
				}

				$news_title 		= isset($_GET['news_title']) ? $_GET['news_title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL 	= 'news/manageNews?news_title='.$news_title.'&active_flag='.$active_flag.'';
				
				if ($news_title !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->news_model->getNews($limit, $offset, $this->pageCount);
				
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

	public function upload_editor_image() {
		if (isset($_FILES['image'])) {
			$target_dir = "uploads/news/editor_images/";
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
