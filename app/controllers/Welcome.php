<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller 
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
	
	public function index()
	{
		if (!empty($this->UserID))
        {
			redirect(base_url()."home.html", 'refresh');
		}
		
		$page_data['landing_page'] = 1;
		$page_data['page_title'] = SITE_NAME." | Home"; #Page Title
		$page_data['page_name']  = "home"; #View Page
		
		if($_POST)
		{

			$full_name			= $this->input->post('client_full_name');
			$email				= $this->input->post('client_email_id');
			$mobile_number		= $this->input->post('client_mobile_number');
			$message			= $this->input->post('message');
			$subject			= "Enquiry";
			// $subject			= $this->input->post('subject');
			$postData		=array(
				'customer_name'			=> $full_name,
				'email'					=> $email,
				'mobile_number'			=> $mobile_number,
				'message'				=> $message,
				'subject'				=> $this->input->post('subject'),
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('contact_us', $postData);
			$id = $this->db->insert_id();
			// print_r($data);
			if($id !="")
			{
			
				$page_data['digitalmarketing']  	= "";
				$page_data['mobileAppDevelopement']	= ""; 
				$page_data['websitedevelopement']	= ""; 
				$page_data['webappdevelopement']	= ""; 
				$page_data['company_name']			= ""; 
				$page_data['industry_type']			= ""; 
				$page_data['contact_us'] 			= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['full_name'] 			= $full_name;
				$page_data['subject'] 				= $this->input->post('subject');
				$page_data['message'] 				= $message;	
				$page_data['email'] 				= $email;
				$page_data['mobile_number'] 		= $mobile_number;
				// $page_data['subject'] = !empty($data['subject']) ? $data['subject'] : "Contact Us";
				
				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$full_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$full_name);
				}
				// echo $sendMail;exit;
				
			}
			// $this->session->set_flashdata('flash_message' , "Thank you for contact!");
			//$this->session->set_flashdata('success_message' , 'Thank you for contact!! Our Technical Team will get back to you soon...');
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}
	
	public function home()
	{
		$page_data['page_title'] = SITE_NAME.' | Welcome to '.SITE_NAME; #Page Title
		$page_data['page_name']  = "home"; #View Page
		
		if($_POST)
		{
			$first_name			= $this->input->post('popup_first_name');
			$last_name			= $this->input->post('popup_last_name');
			$company_name		= $this->input->post('popup_company_name');
			$company_email		= $this->input->post('popup_company_mail');
			$mobile_number		= $this->input->post('popup_mobile_number');
			$message			= $this->input->post('popup_message');
			$subject			= "Brochure Enquiry";

			$postData		=array(
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'mobile_number'			=> $mobile_number,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('contact_us', $postData);
			$id = $this->db->insert_id();
			// print_r($data);
			if($id !="")
			{
				$page_data['contact_us'] 			= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['mobile_number'] 		= $mobile_number;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
				redirect(base_url('uploads/brochure/brochure.pdf'));
			}	
		}
		$this->load->view($this->template, $page_data);
	}
	public function home1()
	{
		$page_data['page_title'] = SITE_NAME.' | Welcome to '.SITE_NAME; #Page Title
		$page_data['page_name']  = "home1"; #View Page
		$this->load->view($this->template, $page_data);
	}
	
	public function aboutUs()
	{
		$page_data['page_title'] = SITE_NAME.' | About Us'; #Page Title
		$page_data['page_name']  = "about-us"; #View Page
		$this->load->view($this->template, $page_data);
	}

	// public function careers()
	// {
	// 	$page_data['page_title'] = SITE_NAME.' | careers'; #Page Title
	// 	$page_data['page_name']  = "careers"; #View Page
	// 	$this->load->view($this->template, $page_data);
	// }
	
	public function blog($list_code='')
	{
		$page_data['page_title'] 				= SITE_NAME.' | Blog'; #Page Title
		$page_data['page_name']  				= "blog"; #View Page
		$page_data['list_code'] 				= strtoupper($list_code); 
	
		$totalResult 							= $this->blogs_model->getBlogsAll("", "", $this->totalCount, strtoupper($list_code));
		$page_data["totalRows"] = $totalRows 	= count($totalResult);

		$limit = 12; 
	
		$base_url = base_url() . 'blog/' . $list_code;

		$config = PaginationConfig($base_url, $totalRows, $limit);
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$page_data['pagination'] = explode('&nbsp;', $str_links);
	
		$offset = 0;
		if (!empty($_GET['per_page'])) {
			$pageNo = $_GET['per_page'];
			$offset = ($pageNo - 1) * $limit;
		}
	
		$page_data['resultData'] 	= $this->blogs_model->getBlogsAll($limit, $offset, $this->pageCount, strtoupper($list_code));
	
		$page_data["starting"] 		= $offset + 1;
		$page_data["ending"] 		= $offset + count($page_data['resultData']);
	
		$this->load->view($this->template, $page_data);
	}

	public function news()
	{
		$page_data['page_title'] 				= SITE_NAME.' | Blog'; #Page Title
		$page_data['page_name']  				= "news"; #View Page
		$totalResult 							= $this->news_model->getActiveNews("", "", $this->totalCount);
		$page_data["totalRows"] = $totalRows 	= count($totalResult);
		$limit = 3; 
		$base_url = base_url() . 'news.html/';
		$config = PaginationConfig($base_url, $totalRows, $limit);
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$page_data['pagination'] = explode('&nbsp;', $str_links);
		$offset = 0;
		if (!empty($_GET['per_page'])) {
			$pageNo = $_GET['per_page'];
			$offset = ($pageNo - 1) * $limit;
		}
	
		$page_data['resultData'] 	= $this->news_model->getActiveNews($limit, $offset, $this->pageCount);
	
		$page_data["starting"] 		= $offset + 1;
		$page_data["ending"] 		= $offset + count($page_data['resultData']);
	
		$this->load->view($this->template, $page_data);
	}

	public function successstories()
	{
		$page_data['page_title'] = SITE_NAME.' | successstories'; #Page Title
		$page_data['page_name']  = "success-stories"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function successstoriesdetails()
	{
		$page_data['page_title'] = SITE_NAME.' | SuccessStoriesdetails'; #Page Title
		$page_data['page_name']  = "success-stories-details"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function events()
	{
		$page_data['page_title'] = SITE_NAME.' | Events'; #Page Title
		$page_data['page_name']  = "events"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function servicesdetails($list_code_1='',$list_code_2='')
	{
		$page_data['page_title'] 		= SITE_NAME.' | services details'; #Page Title
		$page_data['page_name']  		= "services-details"; #View Page
		$page_data['list_code_1']  		= strtoupper($list_code_1);
		$page_data['list_code_2']  		= strtoupper($list_code_2); 
		if($_POST)
		{
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$company_name		= $this->input->post('company_name');
			$company_email		= $this->input->post('company_email');
			$mobile_number		= $this->input->post('mobile_number');
			$message			= $this->input->post('message');
			$subject			= "Service Enquiry";

			// $getServicesName = $this->services_model->getServicesName($category_level1_id,$category_level2_id);

			if($list_code_2!==NULL && $list_code_2!==0)
			{
				$service_name	= strtoupper($list_code_2);
			}
			else
			{
				$service_name=strtoupper($list_code_1);
			}

			$postData		= array(
				'enquiry_type'			=> 'SERVICE-ENQUIRY',
				'service_name'			=> $service_name,
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'mobile_number'			=> $mobile_number,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('enquires', $postData);
			$id = $this->db->insert_id();

			
			// print_r($data);
			if($id !="")
			{
				$page_data['services'] 				= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['service_name']			= $service_name;
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['mobile_number'] 		= $mobile_number;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}
				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
			
			}
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}

	public function blogServices($list_code_1='',$list_code_2='')
	{
		$page_data['page_title'] 		= SITE_NAME.' | services details'; #Page Title
		$page_data['page_name']  		= "blog-services"; #View Page
		$page_data['list_code_1']  		= strtoupper($list_code_1);
		$page_data['list_code_2']  		= strtoupper($list_code_2); 
		if($_POST)
		{
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$company_name		= $this->input->post('company_name');
			$company_email		= $this->input->post('company_email');
			$mobile_number		= $this->input->post('mobile_number');
			$message			= $this->input->post('message');
			$subject			= "Service Enquiry";

			// $getServicesName = $this->services_model->getServicesName($category_level1_id,$category_level2_id);

			if($list_code_2!==NULL && $list_code_2!==0)
			{
				$service_name	= strtoupper($list_code_2);
			}
			else
			{
				$service_name=strtoupper($list_code_1);
			}

			$postData		= array(
				'enquiry_type'			=> 'SERVICE-ENQUIRY',
				'service_name'			=> $service_name,
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'mobile_number'			=> $mobile_number,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('enquires', $postData);
			$id = $this->db->insert_id();

			
			// print_r($data);
			if($id !="")
			{
				$page_data['services'] 				= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['service_name']			= $service_name;
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['mobile_number'] 		= $mobile_number;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}
				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
			
			}
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}

	public function servicesDetail($list_code_1='')
	{
		$page_data['page_title'] 		= SITE_NAME.' | services details'; #Page Title
		$page_data['page_name']  		= "services-detail"; #View Page
		$page_data['list_code_1']  		= strtoupper($list_code_1);
		if($_POST)
		{
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$company_name		= $this->input->post('company_name');
			$company_email		= $this->input->post('company_email');
			$message			= $this->input->post('message');
			$subject			= "Service Enquiry";

			$service_name		= strtoupper($list_code_1);

			$postData		= array(
				'enquiry_type'			=> 'SERVICE-ENQUIRY',
				'service_name'			=> $service_name,
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('enquires', $postData);
			$id = $this->db->insert_id();

			// print_r($data);
			if($id !="")
			{
				$page_data['services'] 				= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['service_name']			= $service_name;
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
			
			}
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}

	public function blogServicesDetail($list_code_1='')
	{
		$page_data['page_title'] 		= SITE_NAME.' | services details'; #Page Title
		$page_data['page_name']  		= "blog-services-details"; #View Page
		$page_data['list_code_1']  		= strtoupper($list_code_1);
		if($_POST)
		{
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$company_name		= $this->input->post('company_name');
			$company_email		= $this->input->post('company_email');
			$message			= $this->input->post('message');
			$subject			= "Service Enquiry";

			$service_name		= strtoupper($list_code_1);

			$postData		= array(
				'enquiry_type'			=> 'SERVICE-ENQUIRY',
				'service_name'			=> $service_name,
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('enquires', $postData);
			$id = $this->db->insert_id();

			// print_r($data);
			if($id !="")
			{
				$page_data['services'] 				= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['service_name']			= $service_name;
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
			
			}
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}

	public function industriesdetails($industries_url='')
	{
		$page_data['page_title'] 		= SITE_NAME.' | industries details '; #Page Title
		$page_data['page_name']  		= "industries-details"; #View Page
		$page_data['industries_url']  	= $industries_url; #View Page
		if($_POST)
		{
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$company_name		= $this->input->post('company_name');
			$company_email		= $this->input->post('company_email');
			$mobile_number		= $this->input->post('mobile_number');
			$message			= $this->input->post('message');
			$subject			= "Industry Enquiry";

			$getIndustryName = $this->industries_model->getIndustryName($industries_url);

			$postData		= array(
				'enquiry_type'			=> 'INDUSTRY-ENQUIRY',
				'industries_name'		=> $getIndustryName[0]['industries_name'],
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'mobile_number'			=> $mobile_number,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('enquires', $postData);
			$id = $this->db->insert_id();

			
			// print_r($data);
			if($id !="")
			{
				$page_data['industries'] 			= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['industry_name']			= $getIndustryName[0]['industries_name'];
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['mobile_number'] 		= $mobile_number;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
			
			}
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}
	public function eventsDetails($event_url='')
	{
		$page_data['page_title'] = SITE_NAME.' | Events Details'; #Page Title
		$page_data['page_name']  = "events-details"; #View Page
		$page_data['event_url']  = $event_url; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function whitepapers()
	{
		$page_data['page_title'] = SITE_NAME.' | Whitepapers'; #Page Title
		$page_data['page_name']  = "whitepapers"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function blogDemo()
	{
		$page_data['page_title'] = SITE_NAME.' | blog-demo'; #Page Title
		$page_data['page_name']  = "blog-demo"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function newsDetails($news_id='')
	{
		$page_data['page_title'] 	= SITE_NAME.' | News Details'; #Page Title
		$page_data['page_name']  	= "news-details"; #View Page
		$page_data['news_id']  		= decode($news_id);
		$this->load->view($this->template, $page_data);
	}
	public function googleads()
	{
		$page_data['page_title'] = SITE_NAME.' | google-ads'; #Page Title
		$page_data['page_name']  = "google-ads"; #View Page
		$this->load->view($this->template, $page_data);
	}	public function emailmarketingservices()
	{
		$page_data['page_title'] = SITE_NAME.' | email-marketing-services'; #Page Title
		$page_data['page_name']  = "email-marketing-services"; #View Page
		$this->load->view($this->template, $page_data);
	}	public function webdesignservices()
	{
		$page_data['page_title'] = SITE_NAME.' | web-design-services'; #Page Title
		$page_data['page_name']  = "web-design-services"; #View Page
		$this->load->view($this->template, $page_data);
	}	public function logodesign()
	{
		$page_data['page_title'] = SITE_NAME.' |logo-design'; #Page Title
		$page_data['page_name']  = "logo-design"; #View Page
		$this->load->view($this->template, $page_data);
	}

	public function joblist()
	{
		$page_data['page_title'] = SITE_NAME.' | Room'; #Page Title
		$page_data['page_name']  = "job-list"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function socialmediamanagementservice()
	{
		$page_data['page_title'] = SITE_NAME.' | Premium'; #Page Title
		$page_data['page_name']  = "social-media-management-service"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function premiumsuite()
	{
		$page_data['page_title'] = SITE_NAME.' | Premium suite'; #Page Title
		$page_data['page_name']  = "premium_suite"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function standard()
	{
		$page_data['page_title'] = SITE_NAME.' | Standard'; #Page Title
		$page_data['page_name']  = "standard"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function location()
	{
		$page_data['page_title'] = SITE_NAME.' | location'; #Page Title
		$page_data['page_name']  = "location"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function seo()
	{
		$page_data['page_title'] = SITE_NAME.' | seo'; #Page Title
		$page_data['page_name']  = "seo"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function industries()
	{
		$page_data['page_title'] 		= SITE_NAME.' | Industries'; #Page Title
		$page_data['page_name']  		= "industries"; #View Page
		
		$this->load->view($this->template, $page_data);
	}

	public function services($list_code='')
	{
		$page_data['page_title'] 				= SITE_NAME.' | Services'; #Page Title
		$page_data['page_name']  				= "services";
		$page_data['list_code']  				= strtoupper($list_code);

		$totalResult 							= $this->services_model->getServiceListAll("", "", $this->totalCount, strtoupper($list_code));
		$page_data["totalRows"] = $totalRows 	= count($totalResult);
	
		$limit = 9; 
	
		$base_url = base_url() . 'service/' . $list_code;

		$config = PaginationConfig($base_url, $totalRows, $limit);
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$page_data['pagination'] = explode('&nbsp;', $str_links);
	
		$offset = 0;
		if (!empty($_GET['per_page'])) {
			$pageNo = $_GET['per_page'];
			$offset = ($pageNo - 1) * $limit;
		}
	
		$page_data['resultData'] 	= $this->services_model->getServiceListAll($limit, $offset, $this->pageCount, strtoupper($list_code));
	
		$page_data["starting"] 		= $offset + 1;
		$page_data["ending"] 		= $offset + count($page_data['resultData']);

		$this->load->view($this->template, $page_data);
	}

	// public function contact()
	// {
	// 	$page_data['page_title'] = SITE_NAME.' | Room'; #Page Title
	// 	$page_data['page_name']  = "contact-us"; #View Page
	// 	$this->load->view($this->template, $page_data);
	// }

	public function blogDetails($list_code="",$blog_url="")
	{
		$page_data['page_title'] 			= SITE_NAME.' | Blog Details'; #Page Title
		$page_data['page_name']  			= "blog-details"; #View Page
		$page_data['list_code']  			= strtoupper($list_code);
		$page_data['blog_url']  			= $blog_url;

		$this->load->view($this->template, $page_data);
	}
	public function thankYou()
	{
		$page_data['page_title'] 		= SITE_NAME.' | Thank You'; #Page Title
		$page_data['page_name']  		= "thankyou"; #View Page
		$this->load->view($this->template, $page_data);
	}
	public function jobDetails()
	{
		$page_data['page_title'] 		= SITE_NAME.' | Job Details'; #Page Title
		$page_data['page_name']  		= "job-details"; #View Page
		// $page_data['job_id']  			= $job_id; #job_id
		// $page_data['job_category_id']  	= $job_category_id; #job_category_id
		if($_POST)
		{
			$postData = array(
				'job_category_id'		=> $job_category_id,
				'full_name'				=> $this->input->post('full_name'),
				'email'					=> $this->input->post('email'),
				'mobile_number'			=> $this->input->post('mobile_number'),
				'experience'			=> $this->input->post('experience'),
				'location'				=> $this->input->post('location'),
				'current_company'		=> $this->input->post('current_company'),
				'expected_salary'		=> $this->input->post('expected_salary'),
				'notice_period'			=> $this->input->post('notice_period'),
				'message'				=> $this->input->post('message'),
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);
			$this->db->insert('org_applied_jobs', $postData);
			$id = $this->db->insert_id();

			if($id!=NULL)
			{
				if( isset($_FILES['resume']['name']) && $_FILES['resume']['name'] != "") 
				{							
					if(is_uploaded_file($_FILES['resume']['tmp_name']))
					{
						$file_parts = pathinfo($_FILES['resume']['name']);
						$ext = $file_parts['extension'];
						$resume= $id.".".$ext;
						move_uploaded_file($_FILES['resume']['tmp_name'], 'uploads/jobs/candidate_resume/'.$resume);
					}
					
					$candidateResume['candidate_resume'] = $resume;
					$this->db->where('applied_job_id', $id);
					$this->db->update('org_applied_jobs', $candidateResume);
				}

				if( isset($_FILES['photo']['name']) && $_FILES['photo']['name'] !="" )
				{
					move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/jobs/' . $id . '.png');
				}

				redirect(base_url()."thankyou", 'refresh');
			}
		}
		$this->load->view($this->template, $page_data);
	}

	public function jobLists()
	{
		$page_data['page_title'] 		= SITE_NAME.' | Job Details'; #Page Title
		$page_data['page_name']  		= "job-lists"; #View Page
		// $page_data['job_id']  			= $job_id; #job_id
		// $page_data['job_category_id']  	= $job_category_id; #job_category_id
		$this->load->view($this->template, $page_data);
	}

	public function digitalmarketing()
	{
		
		$page_data['page_title'] 			= SITE_NAME.' | Welcome to '.SITE_NAME; #Page Title
		$page_data['page_name']  			= "digital-marketing"; #View Page
		$page_data['subject']				= ""; 
		$page_data['message']				= "";
		$page_data['digitalmarketing']  	= 1;
		$page_data['mobileAppDevelopement']	= ""; 
		$page_data['websitedevelopement']	= ""; 
		$page_data['websitedevelopement']	= ""; 

		if($_POST){
			$service_contact_type 	= 'CONTACT-DIGITAL-MARKETING';
			$full_name 				= $this->input->post('full_name');
			$email 					= $this->input->post('email');
			$mobile_number 			= $this->input->post('mobile_number');
			$company_name 			= $this->input->post('company_name');
			$marketing_goals 		= $this->input->post('marketing_goals');
			$current_challenges 	= $this->input->post('current_challenges');
			$subject				= "Enquiry";

			$postData = array(
				"service_contact_type"	=>  $service_contact_type,
				"full_name" 			=>  $full_name,
				"email" 				=>  $email,
				"mobile_number" 		=>  $mobile_number,
				"company_name" 			=>  $company_name,
				"marketing_goals" 		=>  $marketing_goals,
				"current_challenges" 	=>  $current_challenges,
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('services',$postData);
			$header_id = $this->db->insert_id();
			if($header_id !="")
			{
				$from 									= NOREPLY_EMAIL;				
				$to 									= CONTACT_EMAIL;
				$page_data['service_contact_type'] 		= $service_contact_type;
				$page_data['full_name'] 				= $full_name;
				$page_data['email'] 					= $email;
				$page_data['mobile_number'] 			= $mobile_number;
				$page_data['company_name'] 				= $company_name;
				$page_data['marketing_goals'] 			= $marketing_goals;
				$page_data['current_challenges'] 		= $current_challenges;
				$page_data['subject'] 					= $subject;
				// $page_data['subject'] = !empty($data['subject']) ? $data['subject'] : "Contact Us";

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$full_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$full_name);
				}
				//echo $sendMail;exit;

				#Email sent end here				

				// $this->session->set_flashdata('flash_message' , "Thank you for contact!");
				//$this->session->set_flashdata('success_message' , 'Thank you for contact!! Our Technical Team will get back to you soon...');
				redirect(base_url()."thankyou", 'refresh');
			}
		}

		$this->load->view($this->template, $page_data);
	}
	

	public function mobileAppDevelopement()
	{	
		$page_data['page_title'] 			= SITE_NAME.' | Contact Us'; #Page Title
		$page_data['page_name']  			= "mobile-app-developement"; #View Page
		$page_data['subject']				= ""; 
		$page_data['message']				= "";
		$page_data['digitalmarketing']  	= "";
		$page_data['mobileAppDevelopement']	= 1; 
		$page_data['websitedevelopement']	= ""; 
		$page_data['websitedevelopement']	= ""; 
		
		if($_POST)
		{
			$service_contact_type	= 'CONTACT-MOBILE-APP-DEVELOPMENT';

			$full_name 			=  $this->input->post('full_name');
			$email 				=  $this->input->post('email');
			$mobile_number 		=  $this->input->post('mobile_number');
			$company_name 		=  $this->input->post('company_name');
			$platform_type 		=  $this->input->post('platform_type');
			$project_detail 	=  $this->input->post('project_detail');
			$existing_app 		=  $this->input->post('existing_app');
			$subject			= "Enquiry";

			$postData = array(
				"service_contact_type"	=>  $service_contact_type,
				"full_name" 			=>  $full_name,
				"email" 				=>  $email,
				"mobile_number" 		=>  $mobile_number,
				"company_name" 			=>  $company_name,
				"platform_type" 		=>  $platform_type,
				"project_detail" 		=>  $project_detail,
				"existing_app" 			=>  $existing_app,
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('services',$postData);
			$header_id = $this->db->insert_id();

			if($header_id !="")
			{
				$from 									= NOREPLY_EMAIL;				
				$to 									= CONTACT_EMAIL;
				$page_data['service_contact_type'] 		= $service_contact_type;
				$page_data['full_name'] 				= $full_name;
				$page_data['email'] 					= $email;
				$page_data['mobile_number'] 			= $mobile_number;
				$page_data['company_name'] 				= $company_name;
				$page_data['platform_type'] 			= $platform_type;
				$page_data['project_detail'] 			= $project_detail;
				$page_data['existing_app'] 				= $existing_app;
				$page_data['subject'] 					= $subject;
				// $page_data['subject'] = !empty($data['subject']) ? $data['subject'] : "Contact Us";

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$full_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$full_name);
				}
				//echo $sendMail;exit;

				#Email sent end here				

				// $this->session->set_flashdata('flash_message' , "Thank you for contact!");
				//$this->session->set_flashdata('success_message' , 'Thank you for contact!! Our Technical Team will get back to you soon...');
				redirect(base_url()."thankyou", 'refresh');
			}
			
		}
		$this->load->view($this->template, $page_data);
	}
	
	public function websitedevelopement()
	{
		
		$page_data['page_title'] 			= SITE_NAME.' | Welcome to '.SITE_NAME; #Page Title
		$page_data['page_name']  			= "website-developement"; #View Page
		$page_data['subject']				= ""; 
		$page_data['message']				= "";
		$page_data['digitalmarketing']  	= "";
		$page_data['mobileAppDevelopement']	= ""; 
		$page_data['websitedevelopement']	= 1; 
		$page_data['websitedevelopement']	= ""; 
		if($_POST)
		{
			$service_contact_type	= 'CONTACT-WEBSITE-DEVELOPEMENT';
			$full_name 				=  $this->input->post('full_name');
			$email 					=  $this->input->post('email');
			$mobile_number 			=  $this->input->post('mobile_number');
			$company_name 			=  $this->input->post('company_name');
			$website_type 			=  $this->input->post('website_type');
			$project_description 	=  $this->input->post('project_description');
			$subject				= "Enquiry";

			$postData = array(
				"service_contact_type"	=>  $service_contact_type,
				"full_name" 			=>  $full_name,
				"email" 				=>  $email,
				"mobile_number" 		=>  $mobile_number,
				"company_name" 			=>  $company_name,
				"website_type" 			=>  $website_type,
				"project_description" 	=>  $project_description,
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('services',$postData);
			$header_id = $this->db->insert_id();

			if($header_id !="")
			{
				$from 									= NOREPLY_EMAIL;				
				$to 									= CONTACT_EMAIL;
				$page_data['service_contact_type'] 		= $service_contact_type;
				$page_data['full_name'] 				= $full_name;
				$page_data['email'] 					= $email;
				$page_data['mobile_number'] 			= $mobile_number;
				$page_data['company_name'] 				= $company_name;
				$page_data['website_type'] 				= $website_type;
				$page_data['project_description'] 		= $project_description;
				$page_data['subject'] 					= $subject;
				// $page_data['subject'] = !empty($data['subject']) ? $data['subject'] : "Contact Us";

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$full_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$full_name);
				}
				//echo $sendMail;exit;

				#Email sent end here				

				// $this->session->set_flashdata('flash_message' , "Thank you for contact!");
				//$this->session->set_flashdata('success_message' , 'Thank you for contact!! Our Technical Team will get back to you soon...');
				redirect(base_url()."thankyou", 'refresh');
			}
			
		}
		$this->load->view($this->template, $page_data);
	}public function webappdevelopement()
	{
		
		$page_data['page_title'] 			= SITE_NAME.' | Welcome to '.SITE_NAME; #Page Title
		$page_data['page_name']  			= "web-app-developement"; #View Page
		$page_data['subject']				= ""; 
		$page_data['message']				= ""; 
		$page_data['digitalmarketing']  	= "";
		$page_data['websitedevelopement']	= ""; 
		$page_data['webappdevelopement']	= 1; 
		if($_POST)
		{
			$service_contact_type	= 'CONTACT-WEB-APP-DEVELOPEMENT';
			$full_name 				=  $this->input->post('full_name');
			$email 					=  $this->input->post('email');
			$mobile_number 			=  $this->input->post('mobile_number');
			$company_name 			=  $this->input->post('company_name');
			$industry_type 			=  $this->input->post('industry_type');
			$subject				= "Enquiry";

			$postData = array(
				"service_contact_type"	=>  $service_contact_type,
				"full_name" 			=>  $full_name,
				"email" 				=>  $email,
				"mobile_number" 		=>  $mobile_number,
				"company_name" 			=>  $company_name,
				"industry_type" 		=>  $industry_type,
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('services',$postData);
			$header_id = $this->db->insert_id();

			if($header_id !="")
			{
				$from 									= NOREPLY_EMAIL;				
				$to 									= CONTACT_EMAIL;
				$page_data['service_contact_type'] 		= $service_contact_type;
				$page_data['full_name'] 				= $full_name;
				$page_data['email'] 					= $email;
				$page_data['mobile_number'] 			= $mobile_number;
				$page_data['company_name'] 				= $company_name;
				$page_data['industry_type'] 			= $industry_type;
				$page_data['subject'] 					= $subject;
				// $page_data['subject'] = !empty($data['subject']) ? $data['subject'] : "Contact Us";

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$full_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$full_name);
				}
				//echo $sendMail;exit;

				#Email sent end here				

				// $this->session->set_flashdata('flash_message' , "Thank you for contact!");
				//$this->session->set_flashdata('success_message' , 'Thank you for contact!! Our Technical Team will get back to you soon...');
				redirect(base_url()."thankyou", 'refresh');
			}
			
		}
		$this->load->view($this->template, $page_data);
	}public function crm()
	{
		
		$page_data['page_title'] = SITE_NAME.' | Welcome to '.SITE_NAME; #Page Title
		$page_data['page_name']  = "crm"; #View Page
		$this->load->view($this->template, $page_data);
	}

	public function new()	
	{
		$page_data['page_title'] = SITE_NAME.' | About Us'; #Page Title
		$page_data['page_name']  = "new"; #View Page
		$this->load->view($this->template, $page_data);
	}
	
	public function privacyPolicy()
	{
		$page_data['page_title'] = SITE_NAME.' | Privacy Policy'; #Page Title
		$page_data['page_name']  = "privacy_policy"; #View Page
		$this->load->view($this->template, $page_data);
	}
	
	public function error()
	{
		$page_data['page_title'] = '404 Error'; #Page Title
		$page_data['page_name']  = "error"; #View Page
		$this->load->view($this->template, $page_data);
	}

	public function termsAndConditions()
	{
		$page_data['page_title'] = SITE_NAME.' | Terms Conditions'; #Page Title
		$page_data['page_name']  = "terms-and-conditions"; #View Page
		$this->load->view($this->template, $page_data);
	}

	public function refundPolicy()
	{
		$page_data['page_title'] = SITE_NAME.' | Refund Policy'; #Page Title
		$page_data['page_name']  = "refund-policy"; #View Page
		$this->load->view($this->template, $page_data);
	}

	public function cancellationPolicy()
	{
		$page_data['page_title'] = SITE_NAME.' | Cancellation Policy'; #Page Title
		$page_data['page_name']  = "cancellation-policy"; #View Page
		$this->load->view($this->template, $page_data);
	}
	
	public function cms($url = "")
	{	
		$cmsData = $page_data['cmsData'] =  $this->db->query("select * from cms
					where cms_url='".$url."' AND cms_status = 1
				")->result_array();
				
		$page_data['page_title'] = !empty($cmsData[0]['cms_title']) ? SITE_NAME.' | '.$cmsData[0]['cms_title'] :"CMS Pages"; #Page Title
		$page_data['page_name']  = "cms"; #View Page
		$this->load->view($this->template, $page_data);
	}
	

	public function contact()
	{		
		$page_data['page_title'] = SITE_NAME.' | Contact Us'; #Page Title
		$page_data['page_name']  = "contact-us"; #View Page
		
		if($_POST)
		{
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$company_name		= $this->input->post('company_name');
			$company_email		= $this->input->post('company_email');
			$mobile_number		= $this->input->post('mobile_number');
			$message			= $this->input->post('message');
			$subject			= "Customer Enquiry";

			$postData		=array(
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'mobile_number'			=> $mobile_number,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('contact_us', $postData);
			$id = $this->db->insert_id();
			// print_r($data);
			if($id !="")
			{
				$page_data['contact_us'] 			= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['mobile_number'] 		= $mobile_number;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
			
			}
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}
	# ajax Select Qualification
	
	
	public function logout() 
	{
		$this->session->sess_destroy();
		
		$this->session->set_flashdata('success_message' , 'Logged out successfully!');
		redirect(base_url(), 'refresh');
		
	 	$page_data['page_title'] = SITE_NAME.' | Log Out'; #Page Title
		$page_data['page_name']  = "logout"; #logout Page 
		
        #$this->session->set_flashdata('flash_message' , get_phrase('logged_out_successfully!'));
		
		$this->load->view($this->template, $page_data);
    }
	
	# Ajax Select District
	
	public function cookiePolicy()
	{
		$agree_terms = isset($_POST['agree_terms']) ? $_POST['agree_terms']:"";
		$_SESSION['agree_terms'] = $agree_terms;
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
	
	public function subscribes()
	{
		$page_data['page_title'] = SITE_NAME.' | subscribes'; 
		$page_data['page_name']  = "subscribes"; 
		if($_POST)
		{
			$subject			= "Subscribe Enquiry";
			$subscribe_email	= $this->input->post('subscribe_email');

			$postData		= array(
				'subscribe_email'		=> $subscribe_email,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('subscribes', $postData);
			$id = $this->db->insert_id();

			// print_r($data);
			if($id !="")
			{
				$page_data['subscribe'] 			= '';
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['subscribe_email'] 		= $subscribe_email;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,NULL);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,NULL);
				}
			
			}
			redirect(base_url()."subscribes", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}
	
	public function careers()
	{
		$page_data['page_title'] = SITE_NAME.' | Careers'; #Page Title
		$page_data['page_name']  = "careers"; #View Page
		
		if($_POST)
		{

			$customer_name 			= $this->input->post('customer_name');
			$email 					= $this->input->post('email');
			$mobile_number 			= $this->input->post('mobile_number');
			$internship_duration 	= $this->input->post('internshipDuration');
			$message 				= $this->input->post('message');

			$postData	= array(
				'careers_type'			=> 'INTERNSHIP',
				'customer_name'			=> $customer_name,
				'email'					=> $email,
				'mobile_number'			=> $mobile_number,
				'internship_duration'	=> $internship_duration,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);
			
			
			$this->db->insert('careers', $postData);
			$id = $this->db->insert_id();
			
			if($id !="")
			{
				# Upload Resume start
				if( isset($_FILES['applicantResume']['name']) && $_FILES['applicantResume']['name'] != "") 
				{							
					if(is_uploaded_file($_FILES['applicantResume']['tmp_name']))
					{
						$file_parts = pathinfo($_FILES['applicantResume']['name']);
						$ext = $file_parts['extension'];
						$applicantResume= $id.".".$ext;
						move_uploaded_file($_FILES['applicantResume']['tmp_name'], 'uploads/careers/candidate_resume/'.$applicantResume);
					}
					
					$candidateResume['candidate_resume'] = $applicantResume;
					$this->db->where('careers_id', $id);
					$this->db->update('careers', $candidateResume);
				}
				# Upload Resume end
			}
		
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}

	public function careersDetails()
	{
		$page_data['page_title'] = SITE_NAME.' | Careers Detail'; #Page Title
		$page_data['page_name']  = "careers-details"; #View Page
		
		if($_POST)
		{
			$customer_name 			= $this->input->post('customer_name');
			$email 					= $this->input->post('email');
			$mobile_number 			= $this->input->post('mobile_number');
			$internship_duration 	= $this->input->post('internshipDuration');
			$message 				= $this->input->post('message');

			$postData	= array(
				'careers_type'			=> 'INTERNSHIP',
				'customer_name'			=> $customer_name,
				'email'					=> $email,
				'mobile_number'			=> $mobile_number,
				'internship_duration'	=> $internship_duration,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);
			
			$this->db->insert('careers', $postData);
			$id = $this->db->insert_id();
			
			if($id !="")
			{
			}
			
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}
	public function careersLists()
	{
		$page_data['page_title'] = SITE_NAME.' | Careers List'; #Page Title
		$page_data['page_name']  = "careers-lists"; #View Page

		if($_POST)
		{
			$customer_name 				= $this->input->post('customer_name');
			$email 						= $this->input->post('email');
			$mobile_number 				= $this->input->post('mobile_number');
			$internship_duration 		= $this->input->post('internshipDuration');
			$message 					= $this->input->post('message');

			$postData	= array(
				'careers_type'			=> 'INTERNSHIP',
				'customer_name'			=> $customer_name,
				'email'					=> $email,
				'mobile_number'			=> $mobile_number,
				'internship_duration'	=> $internship_duration,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	  		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);
			
			$this->db->insert('careers', $postData);
			$id = $this->db->insert_id();
			
			if($id !="")
			{
			}
			
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}
	public function ajaxLikeCount()
	{
		if (isset($_POST['blog_id'])) {
			$blog_id = $_POST['blog_id'];
			$ip_address = $_SERVER['REMOTE_ADDR'];

			$chckLikeExist = $this->blogs_model->likeExist($blog_id, $ip_address);

			$postData = array(
				'ip_address' => $ip_address,
				'blog_id' => $blog_id,
				'last_updated_by' => -1,
				'last_updated_date' => $this->date_time,
			);

			if (empty($chckLikeExist)) 
			{
				$postData['likes'] = 1;
				$postData['created_by'] = -1;
				$postData['created_date'] = $this->date_time;
				$this->db->insert('blog_likes', $postData);
				$status = 'Liked';
			} 
			else 
			{
				
				$blogLike = $this->blogs_model->blogLike($blog_id, $ip_address);
				$likes = ($blogLike[0]['likes'] == 0) ? 1 : 0;
				$postData['likes'] = $likes;

				$this->db->where('ip_address', $ip_address);
				$this->db->where('blog_id', $blog_id);
				$this->db->update('blog_likes', $postData);

				$status = ($likes == 1) ? 'Liked' : 'Unliked';
			}

			$result = $this->blogs_model->likeCount($blog_id);

			echo json_encode([
				'status' => $status,
				'likes' => $result[0]['like_count'] ?? 0, // Ensure the correct key is used
			]);
		} else {
			echo json_encode(['error' => 'Missing required parameters']);
		}
	}



	public function ajaxViewCount()
	{
		if (isset($_POST['blog_id'])) {
			$blog_id    = $_POST['blog_id'];
			$ip_address = $_SERVER['REMOTE_ADDR']; 

			$chckViewExist = $this->blogs_model->viewsExist($blog_id, $ip_address);

			$postData = array(
				'ip_address'     => $ip_address,
				'blog_id'        => $blog_id,
				"last_updated_by" => -1,
				"last_updated_date" => $this->date_time
			);

			if (count($chckViewExist) == 0) {
				
				$postData['views'] 			= 1;
				$postData['created_by'] 	= -1;
				$postData['created_date'] 	= $this->date_time;
				$this->db->insert('blog_views', $postData);
				$status = 'Viewed';
			} 
			else 
			{
				$previousViews = $chckViewExist[0]['views'];

				$postData['views'] = $previousViews;

				$this->db->where('ip_address', $ip_address);
				$this->db->where('blog_id', $blog_id);
				$this->db->update('blog_views', $postData);
				$status = 'Viewed';
			}

			$result = $this->blogs_model->viewsCount($blog_id);

			if (!empty($result)) {
				
				echo json_encode([
					'status' => $status,
					'views' => $result[0]['view_count'] ?? 0  
				]);
			} 
			else 
			{
				echo json_encode(['error' => 'Failed to retrieve views count.']);
			}
		} 
		else 
		{
			echo json_encode(['error' => 'Missing required parameters']);
		}
	}

	public function product($list_code="")
	{
		$page_data['page_title'] = SITE_NAME.' | Products'; #Page Title
		$page_data['page_name']  = "products"; #View Page
		$page_data['list_code']  = strtoupper($list_code);

		$totalResult 							= $this->products_model->getProductsList("", "", $this->totalCount, strtoupper($list_code));
		$page_data["totalRows"] = $totalRows 	= count($totalResult);
	
		$limit = 9; 
	
		$base_url = base_url() . 'product/' . $list_code;
		
		$config = PaginationConfig($base_url, $totalRows, $limit);
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$page_data['pagination'] = explode('&nbsp;', $str_links);
	
		$offset = 0;
		if (!empty($_GET['per_page'])) {
			$pageNo = $_GET['per_page'];
			$offset = ($pageNo - 1) * $limit;
		}
	
		$page_data['resultData'] 	= $this->products_model->getProductsList($limit, $offset, $this->pageCount, strtoupper($list_code));
	
		$page_data["starting"] 		= $offset + 1;
		$page_data["ending"] 		= $offset + count($page_data['resultData']);
	

		$this->load->view($this->template, $page_data);
	}
	

	function productDetails($product_url="")
	{
		$page_data['page_title'] 	= SITE_NAME.' | Contactus'; #Page Title
		$page_data['page_name']  	= "product-details"; #View Page
		// $page_data['list_code']  	= strtoupper($list_code); #View Page
		$page_data['product_url']  	= $product_url; #View Page
		if($_POST)
		{
			$first_name			= $this->input->post('first_name');
			$last_name			= $this->input->post('last_name');
			$company_name		= $this->input->post('company_name');
			$company_email		= $this->input->post('company_email');
			$mobile_number		= $this->input->post('mobile_number');
			$message			= $this->input->post('message');
			$subject			= "Product Enquiry";
			
			$getProductName = $this->products_model->getProductName($product_url);

			$postData		= array(
				'enquiry_type'			=> 'PRODUCT-ENQUIRY',
				'product_name'			=> $getProductName[0]['product_name'],
				'first_name'			=> $first_name,
				'last_name'				=> $last_name,
				'company_name'			=> $company_name,
				'company_email'			=> $company_email,
				'mobile_number'			=> $mobile_number,
				'message'				=> $message,
				"created_by" 	  		=> -1,
				"created_date" 	 		=> $this->date_time,
				"last_updated_by" 	 	=> -1,
				"last_updated_date" 	=> $this->date_time
			);

			$this->db->insert('enquires', $postData);
			$id = $this->db->insert_id();

			
			// print_r($data);
			if($id !="")
			{
				$page_data['productDetails'] 		= 1;
				$from 								= NOREPLY_EMAIL;				
				$to 								= CONTACT_EMAIL;
				$page_data['product_name'] 			= $getProductName[0]['product_name'];
				$page_data['first_name'] 			= $first_name;
				$page_data['last_name'] 			= $last_name;
				$page_data['company_name'] 			= $company_name;
				$page_data['company_email'] 		= $company_email;
				$page_data['mobile_number'] 		= $mobile_number;
				$page_data['subject'] 				= $subject;
				$page_data['message'] 				= $message;	

				$message = $this->load->view('mail_template/front_mail_template', $page_data, true);
				
				if(EMAIL_TYPE == 2) #SMTP
				{
					$sendMail = Send_SMTP($from,$to,$subject,$message,$first_name);
					// print_r($sendMail);exit;
				}

				else  #Send Grid 
				{
					$sendMail = Send_Grid($from,$to,$subject,$message,$first_name);
				}
			
			}
			
			redirect(base_url()."thankyou", 'refresh');
		}
		$this->load->view($this->template, $page_data);
	}

	public function productsDemo()
	{
		$page_data['page_title'] = SITE_NAME.' | ProductsDemo'; #Page Title
		$page_data['page_name']  = "products_demo"; #View Page
		$this->load->view($this->template, $page_data);
	}

	public function successStory($list_code='')
	{
		$page_data['page_title'] 	= SITE_NAME.' | CaseStudies'; #Page Title
		$page_data['page_name']  	= "success-story"; #View Page
		$page_data['list_code'] 	= strtoupper($list_code); 
	
		$totalResult = $this->casestudies_model->getCasestudyList("", "", $this->totalCount, strtoupper($list_code));
		$page_data["totalRows"] = $totalRows = count($totalResult);
	
		$limit = 8; 
	
		$base_url = base_url() . 'success-story/' . $list_code;
		$config = PaginationConfig($base_url, $totalRows, $limit);
		$this->pagination->initialize($config);
		$str_links = $this->pagination->create_links();
		$page_data['pagination'] = explode('&nbsp;', $str_links);
	
		$offset = 0;
		if (!empty($_GET['per_page'])) {
			$pageNo = $_GET['per_page'];
			$offset = ($pageNo - 1) * $limit;
		}
	
		$page_data['resultData'] = $this->casestudies_model->getCasestudyList($limit, $offset, $this->pageCount, strtoupper($list_code));
	
		$page_data["starting"] = $offset + 1;
		$page_data["ending"] = $offset + count($page_data['resultData']);

		$this->load->view($this->template, $page_data);
	}

	public function successStoryDetails($list_code="",$casestudy_url)
	{
		$page_data['page_title'] 		= SITE_NAME.' | caseStudiesDetails'; #Page Title
		$page_data['page_name']  		= "success-story-details"; #View Page
		$page_data['list_code']  		= strtoupper($list_code); #View Page
		$page_data['casestudy_url']  	= $casestudy_url; #View Page
		$this->load->view($this->template, $page_data);
	}

	public function whitePaperDetails($whitepaper_url='')
	{
		$page_data['page_title'] 		= SITE_NAME.' | Whitepaper Details';
		$page_data['page_name']  		= "whitepapers-details";
		$page_data['whitepaper_url']  	= $whitepaper_url;
		$this->load->view($this->template, $page_data);
	}

	public function ajaxSubCategoryList($category_level1_id = '')
	{
		$getCategory		= $this->categories_model->getLastCategoryData();

		if($category_level1_id==0)
		{
			$category_level1_id = $getCategory[0]['cat_level_1'];
		}

		if (!empty($category_level1_id)) 
		{
			$result = $this->categories_model->getSubCategory($category_level1_id);
		} 

		$page_data['result'] 	= $result;

		// $html = $this->load->view('themes/default/header_subcategory_listing', $page_data, true);
		// echo $html;
		// exit;

		$html = $this->load->view('themes/default/header_subcategory_listing', $page_data, true);

		echo json_encode([
			'category_level_id' => $category_level1_id,
			'html' => $html
		]);
		exit;
	}
	
	public function ajaxServiceBlogCategoryList($category_level1_id = '')
	{
		$getCategory		= $this->categories_model->getLastCategoryData();

		if($category_level1_id==0)
		{
			$category_level1_id = $getCategory[0]['cat_level_1'];
		}

		if (!empty($category_level1_id)) 
		{
			$result = $this->categories_model->getServiceBlogSubCategory($category_level1_id);
		} 

		$page_data['result'] 	= $result;

		// $html = $this->load->view('themes/default/header_subcategory_listing', $page_data, true);
		// echo $html;
		// exit;

		$html = $this->load->view('themes/default/header_services_subcategory_listing', $page_data, true);

		echo json_encode([
			'category_level_id' => $category_level1_id,
			'html' => $html
		]);
		exit;
	}



	public function getSecSubCategoryValue($sec_segment_value = '',$third_segment_value="")
	{
		$category_level1_id = ''; // Default value

		if (!empty($sec_segment_value)) {
			$result = $this->categories_model->getSecSubCategoryValue($sec_segment_value,$third_segment_value);

			// Extract category_level_1 from result (assuming result is not empty)
			if (!empty($result)) {
				$category_level1_id = $result[0]['cat_level_1']; 
				$category_level2_id = $result[0]['cat_level_2']; 
			}
		} 

		echo json_encode([
			'category_level_id' => $category_level1_id,
			'category_level2_id' => $category_level2_id
		]);
		exit;
	}

	public function getServicesSubCategoryValue($sec_segment_value = '',$third_segment_value="")
	{
		$category_level1_id = ''; // Default value

		if (!empty($sec_segment_value)) {
			$result = $this->categories_model->getServicesSubCategoryValue($sec_segment_value,$third_segment_value);

			// Extract category_level_1 from result (assuming result is not empty)
			if (!empty($result)) {
				$category_level1_id = $result[0]['cat_level_1']; 
				$category_level2_id = $result[0]['cat_level_2']; 
			}
		} 

		echo json_encode([
			'category_level_id' => $category_level1_id,
			'category_level2_id' => $category_level2_id
		]);
		exit;
	}
	
}
	
?>
