<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('vendor/autoload.php');
class Products extends CI_Controller 
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
	function manageProducts($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 					= $type;
		$page_data['id'] 					= $id;
		$page_data['manageProducts'] 		= 1;
		$page_data['page_name']  			= 'products/manageProducts';
		$page_data['page_title'] 			= 'Products';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					// $product_category 		= $this->input->post('product_category');
					$product_name 			= $this->input->post('product_name');
					$product_url			= url($product_name);
					$checkProductExist 		= $this->products_model->checkProductExist($product_url,$type,NULL);

					if(count($checkProductExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Product already exist!");
						redirect(base_url() . 'products/manageProducts/add', 'refresh');
					}

					$postData = array(
						// 'product_category' 		=> $product_category,
						'product_name' 	  		=> $product_name,
						'product_url' 	  		=> $product_url,
						'description' 	  		=> $this->input->post('description'),
						'order_sequence' 		=> $this->input->post('order_sequence'),
						"created_by" 	 		=> $this->user_id,
						"created_date" 	  		=> $this->date_time,
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);

					$this->db->insert('products', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['product_image']['name']) && $_FILES['product_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['product_image']['tmp_name'], 'uploads/products/'.$header_id.'.png');
						}
						
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Product saved successfully!");
							redirect(base_url() . 'products/manageProducts/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Product submitted successfully!");
							redirect(base_url() . 'products/manageProducts', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->products_model->getProductsView($id);
				if($_POST)
				{

					// $product_category 		= $this->input->post('product_category');
					$product_name 			= $this->input->post('product_name');
					$product_url			= url($product_name);
					$checkProductExist 		= $this->products_model->checkProductExist($product_url,$type,$id);

					if(count($checkProductExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Product already exist!");
						redirect(base_url() . 'products/manageProducts/edit/'.$id, 'refresh');
					}

					$postData = array(
						// 'product_category' 	 	=> $product_category,
						'product_name' 	  		=> $product_name,
						'product_url' 	  		=> $product_url,
						'description' 	  		=> $this->input->post('description'),
						'order_sequence' 		=> $this->input->post('order_sequence'),
						"last_updated_by" 		=> $this->user_id,
						"last_updated_date" 	=> $this->date_time
					);
					
					$this->db->where('product_id', $id);
					$result = $this->db->update('products', $postData);
					
					if($result)
					{
						if( isset($_FILES['product_image']['name']) && $_FILES['product_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['product_image']['tmp_name'], 'uploads/products/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Product saved successfully!");
							redirect(base_url() . 'products/manageProducts/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Product submitted successfully!");
							redirect(base_url() . 'products/manageProducts', 'refresh');
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
					$succ_msg = 'Product active successfully!';
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
					$succ_msg = 'Product inactive successfully!';
				}
				$this->db->where('product_id', $id);
				$this->db->update('products', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 			= $this->products_model->getProducts("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{
					$limit = $_SESSION['PAGE'];
				}
				else
				{
					$limit = 10;
				}

				// $product_category	= isset($_GET['product_category']) ? $_GET['product_category'] :NULL;
				$product_id 		= isset($_GET['product_id']) ? $_GET['product_id'] :NULL;
				$product_name 		= isset($_GET['product_name']) ? $_GET['product_name'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL 	= 'products/manageProducts?product_id='.$product_id.'&product_name='.$product_name.'&active_flag='.$active_flag.'';
				
				if ($product_id != NULL || $product_name !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->products_model->getProducts($limit, $offset, $this->pageCount);
				
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

	function manageProductDetails($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 						= $type;
		$page_data['id'] 						= $id;
		$page_data['manageProductDetails'] 		= 1;
		$page_data['page_name']  				= 'products/manageProductDetails';
		$page_data['page_title'] 				= 'Product Details';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$product_id 					= $this->input->post('product_id');
					$checkProductDetailsExist 		= $this->products_model->checkProductDetailsExist($product_id,$type,NULL);

					if(count($checkProductDetailsExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Product detail already exist!");
						redirect(base_url() . 'products/manageProductDetails/add', 'refresh');
					}

					$postData = array(
						'product_id' 	  				=> $product_id,
						'title' 	  					=> $this->input->post('title'),
						'title_description' 			=> $this->input->post('title_description'),
						'why_choose_title' 				=> $this->input->post('why_choose_title'),
						'why_choose_jesperapps' 		=> $this->input->post('why_choose_jesperapps'),
						'remarks_title' 				=> $this->input->post('remarks_title'),
						'remarks' 						=> $this->input->post('remarks'),
						"created_by" 	 				=> $this->user_id,
						"created_date" 	  				=> $this->date_time,
						"last_updated_by" 				=> $this->user_id,
						"last_updated_date" 			=> $this->date_time
					);

					$this->db->insert('product_details', $postData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/products/product_details/banner/'.$header_id.'.png');
						}

						if( isset($_FILES['product_details_image']['name']) && $_FILES['product_details_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['product_details_image']['tmp_name'], 'uploads/products/product_details/'.$header_id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Product detail saved successfully!");
							redirect(base_url() . 'products/manageProductDetails/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) 
						{
							$this->session->set_flashdata('flash_message' , "Product detail submitted successfully!");
							redirect(base_url() . 'products/manageProductDetails', 'refresh');
						}
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$page_data['editData'] = $this->products_model->getProductDetailsView($id);


				if($_POST)
				{

					$product_id 			= $this->input->post('product_id');
					$checkProductExist 		= $this->products_model->checkProductDetailsExist($product_id,$type,$id);

					if(count($checkProductExist) > 0)
					{
						$this->session->set_flashdata('error_message' , "Product detail already exist!");
						redirect(base_url() . 'products/manageProductDetails/add', 'refresh');
					}
					
					$postData = array(
						'product_id' 	  				=> $product_id,
						'title' 	  					=> $this->input->post('title'),
						'title_description' 			=> $this->input->post('title_description'),
						'why_choose_title' 				=> $this->input->post('why_choose_title'),
						'why_choose_jesperapps' 		=> $this->input->post('why_choose_jesperapps'),
						'remarks_title' 				=> $this->input->post('remarks_title'),
						'remarks' 						=> $this->input->post('remarks'),
						"last_updated_by" 				=> $this->user_id,
						"last_updated_date" 			=> $this->date_time
					);
					
					$this->db->where('product_detail_id', $id);
					$result = $this->db->update('product_details', $postData);
					
					if($result)
					{
						if( isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/products/product_details/banner/'.$id.'.png');
						}

						if( isset($_FILES['product_details_image']['name']) && $_FILES['product_details_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['product_details_image']['tmp_name'], 'uploads/products/product_details/'.$id.'.png');
						}

						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Product detail saved successfully!");
							redirect(base_url() . 'products/manageProductDetails/edit/'.$id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Product detail submitted successfully!");
							redirect(base_url() . 'products/manageProductDetails', 'refresh');
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
					$succ_msg = 'Product Detail active successfully!';
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
					$succ_msg = 'Product Detail successfully!';
				}
				$this->db->where('product_detail_id', $id);
				$this->db->update('product_details', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult 			= $this->products_model->getProductDetails("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{
					$limit = $_SESSION['PAGE'];
				}
				else
				{
					$limit = 10;
				}

				$product_id 		= isset($_GET['product_id']) ? $_GET['product_id'] :NULL;
				$product_name 		= isset($_GET['product_name']) ? $_GET['product_name'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;
				
				$this->redirectURL 	= 'products/manageProductDetails?product_id='.$product_id.'&product_name='.$product_name.'&active_flag='.$active_flag.'';
				
				if ($product_id != NULL || $product_name !=NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->products_model->getProductDetails($limit, $offset, $this->pageCount);
				
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

	function getItemList(){
	
		$result = $this->common_model->lov("PERIOD");;

	
		if( count($result) > 0)
		{
			echo '<option value="">- Select -</option>';
			foreach($result as $val)
			{
				echo '<option value="'.$val['list_code'].'">'.ucfirst($val['list_value']).'</option>';
			}
		}
		else
		{
			echo '<option value="">- Select -</option>';
		}
	}

	public function getLineDatas()
	{
		
		/* $itemQuery = "select
			transaction.transaction_id,
			sum(transaction.transaction_qty) as trans_qty,
			products.product_id as item_id,
			transaction.organization_id,
			transaction.sub_inventory_id,
			transaction.locator_id,
			transaction.lot_number,
			transaction.serial_number,
			products.product_code as item_name,
			products.product_name as item_description,
			category.category_name,
			sub_inventory.inventory_code,
			sub_inventory.inventory_name,
			item_locators.locator_no,
			item_locators.locator_name

			from inv_transactions as transaction
			left join products on products.product_id = transaction.item_id
			left join category on category.category_id = products.category_id
			left join inv_item_sub_inventory as sub_inventory on sub_inventory.inventory_id = transaction.sub_inventory_id
			left join inv_item_locators as item_locators on item_locators.locator_id = transaction.locator_id
			group by 
			transaction.item_id,
			transaction.organization_id,
			transaction.sub_inventory_id,
			transaction.locator_id,
			transaction.lot_number,
			transaction.serial_number
			
			HAVING trans_qty > 0 "; */

			
		/* $itemQuery = "select 
			products.product_id as item_id,
			products.product_code as item_name,
			products.product_name as item_description

			from products where product_status=1 order by item_name asc"; */

		$itemQuery = "select 
			locator_line_tbl.header_id,
			locator_line_tbl.line_id,
			items.item_id,
			items.item_name,
			items.item_description

			from inv_assign_product_locator_line as locator_line_tbl


			left join inv_sys_items as items on 
			items.item_id = locator_line_tbl.product_id

			where 1=1
			
			and items.active_flag='Y'
			and locator_line_tbl.assign_line_status=1
			";
		
		$data['items'] = $this->db->query($itemQuery)->result_array();

		#$data['discount'] = $this->db->query("select discount_id,discount_name from discount where active_flag='Y'")->result();
		
		/* $taxQry = "select tax_id,tax_name,tax_value from gen_tax 
			where active_flag='Y'
			and coalesce(start_date,'".$this->date."') <= '".$this->date."'
			and coalesce(end_date,'".$this->date."') >= '".$this->date."'
			";
		$data['tax'] = $this->db->query($taxQry)->result_array(); */
		
		/* $uomQry = "select uom_id,uom_code,uom_description from uom 
			where active_flag='Y'
			and coalesce(start_date,'".$this->date."') <= '".$this->date."'
			and coalesce(end_date,'".$this->date."') >= '".$this->date."'
			";
		$data['uom'] = $this->db->query($uomQry)->result_array(); */

		/* $discountType = [];

		foreach( $this->discount_type as $key => $value )
		{
			$discountType[] = array(
				'discount_type' =>  $value,
			);
		}
		$data['discount_type'] = $discountType;

		$organizationQry = "select organization_id,organization_name from org_organizations 
			where active_flag='Y'
			and coalesce(start_date,'".$this->date."') <= '".$this->date."'
			and coalesce(end_date,'".$this->date."') >= '".$this->date."'
			";
		$data['organization'] = $this->db->query($organizationQry)->result_array();
		
		$requestedByQry = "select person_id,first_name,last_name from per_people_all 
			where active_flag='Y'
			";
		$data['requestedBy'] = $this->db->query($requestedByQry)->result_array();

		$subInvQry = "select inventory_id,inventory_code,inventory_name from inv_item_sub_inventory 
			where active_flag='Y'
			and coalesce(start_date,'".$this->date."') <= '".$this->date."'
			and coalesce(end_date,'".$this->date."') >= '".$this->date."'
			";
		$data['subInvQry'] = $this->db->query($subInvQry)->result_array(); */

	    echo json_encode($data);
		exit;
	}

	function ajaxItemList() {
		if(isset($_POST["query"])) {  

			
			$output = '';  
			$item_name = $_POST['query'];
			$counter = $_POST['counter'];
			
			$result = $this->stock_adjustment_model->getAjaxItemlist($item_name);
			
			$output = '<ul class="list-unstyled-item_id">';  
			
			if(count($result) > 0) {  
				foreach($result as $row) {  
					$item_name = $row["item_name"];
					$item_id = $row["item_id"];
					$item_description = $row['item_description'];
					$uom_id = $row['uom'];
					
					$output .= '<a><li onclick="return getItemList(\'' .$item_id. '\',\'' .$item_name. '\',\'' .$item_description. '\',\'' .$uom_id. '\');">'.$item_name.'</li></a>';

				}  
			} 
			else {  
				$item_name = "";
				$item_id = "";
				$item_description = '';
				$uom_id = '';
				
				$output .= '<li onclick="return getItemList(\'' .$item_id. '\',\'' .$item_name. '\',\'' .$item_description. '\', \'' .$uom_id. '\');">Sorry! Item Not Found.</li>';  
			}
			$output .= '</ul>';  
			echo $output;  
		}
	}
	function ajaxUom() {
		if(isset($_POST["uom_id"])) {
			
			$uom_id = $_POST['uom_id'];
			$result = $this->stock_adjustment_model->getAjaxUom($uom_id);
			
			$output = '';
			if(count($result) > 0) {
				
				foreach($result as $row) {
					$uom_id = $row["uom_id"];
					$uom_code = $row["uom_code"];
					
					$output .= $uom_id . '@' . $uom_code;
				}
			}
			echo $output;
		} 
		else {
		
			echo "uom_id is not set";
		}
	}
	
	
	function ajaxTransQty() {
		if(isset($_POST["item_id"])) {
			$item_id = $_POST['item_id'];
			$result = $this->stock_adjustment_model->getAjaxTransQty($item_id);
			
			$output = '';
			if(count($result) > 0) {
				
				foreach($result as $row) {
					$transaction_id = $row["transaction_id"];
					$transaction_qty = $row["transaction_qty"];
					
					$output .= $transaction_id . '@' . $transaction_qty;
				}
			}
			echo $output;
		} 
		else {
		
			echo "Transcation Qty is not found";
		}
	}
	
	
	function ajaxOrganization() 
	{
		$result = $this->stock_adjustment_model->getAjaxOrganization();

		if( count($result) > 0)
		{
			echo '<option value="">- Select -</option>';
			foreach($result as $val)
			{
				echo '<option value="'.$val['organization_id'].'">'.ucfirst($val['organization_name']).'</option>';
			}
		}
		else
		{
			echo '<option value="">- Select -</option>';
		}
		
		die;
	}
	function ajaxselectSubInventory() 
	{
		if(isset($_POST["query"])) {  
			$organization_id=$_POST['query'];
			$result = $this->stock_adjustment_model->getAjaxSubInventory($organization_id);

			if( count($result) > 0)
			{
				echo '<option value="">- Select -</option>';
				foreach($result as $val)
				{
					echo '<option value="'.$val['inventory_id'].'">'.$val['inventory_code'].'-'.ucfirst($val['inventory_name']).'</option>';
				}
			}
			else
			{
				echo '<option value="">- Select -</option>';
			}
			
			die;
		}
	}
	function ajaxSubInventoryLocators() 
	{
		if(isset($_POST["query"])) { 

			$inventory_id=$_POST['query'];

			$result = $this->stock_adjustment_model->getAjaxSubInventoryLocators($inventory_id);

			if( count($result) > 0)
			{
				echo '<option value="">- Select -</option>';
				foreach($result as $val)
				{
					echo '<option value="'.$val['locator_id'].'">'.ucfirst($val['locator_no']).'</option>';
				}
			}
			else
			{
				echo '<option value="">- Select -</option>';
			}
			
			die;
		}
	}


	function ajaxAdjustmentNumberList() 
	{
		if(isset($_POST["query"]))  
		{  
			$output = '';  
			
			$adj_number = $_POST['query'];

			$result = $this->stock_adjustment_model->getAjaxAdjustNumberAll($adj_number);
			
			$output = '<ul class="list-unstyled-adj_number_id">';  
			
			if( count($result) > 0 )  
			{  
				foreach($result as $row)  
				{	
					$adj_number = $row["adj_number"];
					$adj_number_id = $row["header_id"];
					$output .= '<a><li onclick="return getAdjustNumberList(\'' .$adj_number_id. '\',\'' .$adj_number. '\');">'.$adj_number.'</li></a>';  
				}  
			}  
			else  
			{  
				$adj_number = "";
				$adj_number_id = "";
				
				$output .= '<li onclick="return getAdjustNumberList(\'' .$adj_number_id. '\',\'' .$adj_number. '\');">Sorry! Adjust Number Not Found.</li>';  
			}
			$output .= '</ul>';  
			echo $output;  
		}
	}

	public function ajaxSelectLineItemDetails()
	{
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : NULL;
		$item_id = isset($_POST["item_id"]) ? $_POST["item_id"] : NULL;

		if($item_id !=NULL)
		{
			$itemQuery = "select 
			
			products.product_id as item_id,
			products.product_code as item_name,
			products.product_name as item_description,
            products.unit as uom_code,
            
            sub_inventory.inventory_code, 
            sub_inventory.inventory_name, 
            item_locators.locator_no, 
            item_locators.locator_name,
            locator_line_tbl.inventory_id,
            locator_line_tbl.locator_id

			from inv_assign_product_locator_line as locator_line_tbl

			left join inv_assign_product_locator_header as locator_header_tbl on 
				locator_header_tbl.header_id = locator_line_tbl.header_id

			left join products on 
				products.product_id = locator_line_tbl.product_id
                
                
            left join inv_item_sub_inventory as sub_inventory on sub_inventory.inventory_id = locator_line_tbl.inventory_id 
            left join inv_item_locators as item_locators on item_locators.locator_id = locator_line_tbl.locator_id 

			where 1=1
			and locator_header_tbl.warehouse_id='".$organization_id."'
            and locator_line_tbl.product_id='".$item_id."'
			and products.product_status=1
			and locator_line_tbl.assign_line_status=1";
			
			$data = $this->db->query($itemQuery)->result_array();

			echo json_encode($data);
		}exit;
	}

	public function ajaxSelectTransactionLot() 
	{
        $organization_id = $_POST["organization_id"];	
        $item_id = $_POST["item_id"];
        $sub_inventory_id = $_POST["sub_inventory_id"];
        $locator_id = $_POST["locator_id"];

		if($organization_id)
		{			
			$lotQry = "
			select sum(transaction.transaction_qty) as trans_qty, 
			transaction.lot_number
			from inv_transactions as transaction
			where 1=1
			and transaction.organization_id = '".$organization_id."'
			and transaction.item_id = '".$item_id."'
			and transaction.sub_inventory_id = '".$sub_inventory_id."'
			and transaction.locator_id = '".$locator_id."'
			group by 
			transaction.item_id, 
			transaction.organization_id, 
			transaction.sub_inventory_id, 
			transaction.locator_id, 
			transaction.lot_number
			";
			
			$data = $this->db->query($lotQry)->result_array();
		
			if( count($data) > 0)
			{
				echo '<option value="">- Select -</option>';
				
				foreach($data as $val)
				{
					$lot_number = $val['lot_number']."@". $val['trans_qty'];

					echo '<option value="'.$lot_number.'">'.$val['lot_number'].'</option>';
				}
			}
			else
			{
				echo '<option value="">Lot Not Exists!</option>';
			}
		}
		die;
    }


	function manageKeyFeatures($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageKeyFeatures'] = 1;
		$page_data['page_name']  		= 'products/manageKeyFeatures';
		$page_data['page_title'] 		= 'Key Features';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$product_id 			= $this->input->post('product_id');
					$title 					= $this->input->post('title');
					
					$getKeyFeaturesExists = $this->products_model->checkKeyFeaturesExists($product_id,$title,$type,NULL);

					if(count($getKeyFeaturesExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Key Feauture already exists!");
						redirect(base_url() . 'products/manageKeyFeatures/add', 'refresh');
					}

					$headerData = array(
						"product_id" 	  		=>  $product_id,
						"title" 				=>  $title,
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('key_features_headers',$headerData);
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

								$detail_description 	= !empty($_POST['detail_description'][$dp]) ? $_POST['detail_description'][$dp] : NULL;
								
								$lineData = array(
									"header_id" 		 	=> $header_id,
									"product_id" 			=> $product_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"detail_description" 	=> $detail_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('key_features_lines', $lineData);
								$line_id = $this->db->insert_id();

								if( isset($_FILES['key_features_image']['name'][$dp]) && $_FILES['key_features_image']['name'][$dp] !="" )
								{
									move_uploaded_file($_FILES['key_features_image']['tmp_name'][$dp], 'uploads/products/key_features/'.$line_id.'.png');
								}
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "key Features saved successfully!");
							redirect(base_url() . 'products/manageKeyFeatures/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "key Features submitted successfully!");
							redirect(base_url() . 'products/manageKeyFeatures', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->products_model->getKeyFeaturesView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$product_id 			= $this->input->post('product_id');
					$title 					= $this->input->post('title');
					
					$getKeyFeaturesExists = $this->products_model->checkKeyFeaturesExists($product_id,$title,$type,$id);

					if(count($getKeyFeaturesExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Key Feauture already exists!");
						redirect(base_url() . 'products/manageKeyFeatures/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"product_id" 	  		=>  $product_id,
						"title" 				=>  $title,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('key_features_headers', $headerData);

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
								$detail_description = !empty($_POST['detail_description'][$dp]) ? $_POST['detail_description'][$dp] : NULL;
							
								$lineData = array(
									"header_id" 			=> $id,
									"product_id" 			=> $product_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"detail_description" 	=> $detail_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('key_features_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									if (isset($_FILES['key_features_image']['name'][$dp]) && $_FILES['key_features_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/products/key_features/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['key_features_image']['tmp_name'][$dp], $uploadFile);
									}
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('key_features_lines', $lineData);
							
									if (isset($_FILES['key_features_image']['name'][$dp]) && $_FILES['key_features_image']['name'][$dp] != "") {
										$uploadDir = 'uploads/products/key_features/';
										$uploadFile = $uploadDir . $line_id . '.png';
							
										move_uploaded_file($_FILES['key_features_image']['tmp_name'][$dp], $uploadFile);
									}
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "key Features saved successfully!");
								redirect(base_url() . 'products/manageKeyFeatures/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "key Features submitted successfully!");
								redirect(base_url() . 'products/manageKeyFeatures', 'refresh');
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
					$succ_msg = 'All keyfeatures in these product are now successfully active!';
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
					$succ_msg = 'All keyfeatures in these product are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('key_features_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;

			default : #Manage
				$totalResult = $this->products_model->getKeyFeatures("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$product_id 		= isset($_GET['product_id']) ? $_GET['product_id'] :NULL;
				$product_name 		= isset($_GET['product_name']) ? $_GET['product_name'] :NULL;
				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'products/manageKeyFeatures?product_id='.$product_id.'&product_name='.$product_name.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($product_id != NULL || $product_name != NULL || $title != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->products_model->getKeyFeatures($limit, $offset, $this->pageCount);

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
				$this->db->update('key_features_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function keyFeaturesLineData()
    {		
	
		$active_status 	= $this->common_model->lov('ACTIVE-STATUS');
		$activeStatusOptions 	= '';
		if (count($active_status) > 0) 
		{
			foreach ($active_status as $val) 
			{
				$activeStatusOptions .= '<option value="'.$val['list_code'].'">'.ucfirst($val['list_value']).'</option>';
			}
		}

		$data['activeStatus'] = $activeStatusOptions;
		echo json_encode($data);
		exit;		
	}

	function ajaxProductListAll() 	#ajaxlistitems
	{
		$product_name = isset($_POST["product_name"]) ? $_POST["product_name"] : NULL;
		if($product_name)  
		{  
			$output = '';  

			$result = $this->products_model->ajaxProductListAll($product_name);
			
			$output = '<ul class="list-unstyled-product_id">';  
			
			if( count($result) > 0 )  
			{  	
				foreach($result as $row)  
				{	
					$product_id 	= $row["product_id"];
					$product_name 	= $row["product_name"];
					$output .= '<a><li onclick="return getProductList(\'' .$product_id. '\',\'' .$product_name. '\');">' . $product_name . '</li></a>';  
				}  
			}  
			else  
			{  
				$product_id 	= 0;
				$product_name 	= "";
				
				$output .= '<li onclick="return getProductList(\'' .$product_id. '\',,\'' .$product_name. '\');">No data found.</li>';  
			}
			$output .= '</ul>';  
			echo $output;  
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
		$page_data['manageBenefits'] 	= 1;
		$page_data['page_name']  		= 'products/manageBenefits';
		$page_data['page_title'] 		= 'Benefits';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$product_id 			= $this->input->post('product_id');
					$title 					= $this->input->post('title');
					
					$checkBenefitsExists = $this->products_model->checkBenefitsExists($product_id,$title,$type,NULL);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Benefit already exists!");
						redirect(base_url() . 'products/manageBenefits/add', 'refresh');
					}

					$headerData = array(
						"product_id" 	  		=>  $product_id,
						"title" 				=>  $title,
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('benefits_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['benefits_banner_image']['name']) && $_FILES['benefits_banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['benefits_banner_image']['tmp_name'], 'uploads/products/benefits/banner/'.$header_id.'.png');
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
									"product_id" 			=> $product_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('benefits_lines', $lineData);
								$line_id = $this->db->insert_id();

								// if( isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] !="" )
								// {
								// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], 'uploads/products/benefits/'.$line_id.'.png');
								// }
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Benefits saved successfully!");
							redirect(base_url() . 'products/manageBenefits/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Benefits submitted successfully!");
							redirect(base_url() . 'products/manageBenefits', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->products_model->getBenefitsView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$product_id 			= $this->input->post('product_id');
					$title 					= $this->input->post('title');
					
					$checkBenefitsExists = $this->products_model->checkBenefitsExists($product_id,$title,$type,$id);

					if(count($checkBenefitsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Benefit already exists!");
						redirect(base_url() . 'products/manageBenefits/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"product_id" 	  		=>  $product_id,
						"title" 				=>  $title,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('benefits_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['benefits_banner_image']['name']) && $_FILES['benefits_banner_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['benefits_banner_image']['tmp_name'], 'uploads/products/benefits/banner/'.$id.'.png');
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
									"product_id" 			=> $product_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('benefits_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									// if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/products/benefits/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									// }
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('benefits_lines', $lineData);
							
									// if (isset($_FILES['benefits_image']['name'][$dp]) && $_FILES['benefits_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/products/benefits/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['benefits_image']['tmp_name'][$dp], $uploadFile);
									// }
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Benefits saved successfully!");
								redirect(base_url() . 'products/manageBenefits/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Benefits submitted successfully!");
								redirect(base_url() . 'products/manageBenefits', 'refresh');
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
					$succ_msg = 'All benefits in these product are now successfully active!';
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
					$succ_msg = 'All benefits in these product are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('benefits_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->products_model->getBenefits("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$product_id 		= isset($_GET['product_id']) ? $_GET['product_id'] :NULL;
				$product_name 		= isset($_GET['product_name']) ? $_GET['product_name'] :NULL;
				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'products/manageBenefits?product_id='.$product_id.'&product_name='.$product_name.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($product_id != NULL || $product_name != NULL || $title != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->products_model->getBenefits($limit, $offset, $this->pageCount);

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
				$this->db->update('benefits_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}

	function manageDetails($type = '', $id = '', $status = '')
    {
		if (empty($this->user_id))
        {
			redirect(base_url() . 'admin/adminLogin', 'refresh');
		}
	
		$page_data['type'] 				= $type;
		$page_data['id'] 				= $id;
		$page_data['manageDetails'] 	= 1;
		$page_data['page_name']  		= 'products/manageDetails';
		$page_data['page_title'] 		= 'Details';
		
		switch(true)
		{
			case ($type == "add"):
				if($_POST)
				{
					$product_id 			= $this->input->post('product_id');
					$title 					= $this->input->post('title');
					
					$checkDetailsExists = $this->products_model->checkDetailsExists($product_id,$title,$type,NULL);

					if(count($checkDetailsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Details already exists!");
						redirect(base_url() . 'products/manageDetails/add', 'refresh');
					}

					$headerData = array(
						"product_id" 	  		=>  $product_id,
						"title" 				=>  $title,
						"created_by" 	  		=>  $this->user_id,
						"created_date" 	  		=>  $this->date_time,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);

					$this->db->insert('details_headers',$headerData);
					$header_id = $this->db->insert_id();
					
					if($header_id)
					{
						if( isset($_FILES['header_details_image']['name']) && $_FILES['header_details_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['header_details_image']['tmp_name'], 'uploads/products/details/header_img/'.$header_id.'.png');
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
									"product_id" 			=> $product_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"created_by" 	  		=> $this->user_id,
									"created_date" 	  		=> $this->date_time,
									"last_updated_by" 	  	=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);

								$this->db->insert('details_lines', $lineData);
								$line_id = $this->db->insert_id();

								// if( isset($_FILES['details_image']['name'][$dp]) && $_FILES['details_image']['name'][$dp] !="" )
								// {
								// 	move_uploaded_file($_FILES['details_image']['tmp_name'][$dp], 'uploads/products/details/'.$line_id.'.png');
								// }
							}
						}
						#Line Data end
					
						if(isset($_POST["save_btn"]))
						{
							$this->session->set_flashdata('flash_message' , "Details saved successfully!");
							redirect(base_url() . 'products/manageDetails/edit/'.$header_id, 'refresh');
						}
						else if(isset($_POST["submit_btn"])) {
							$this->session->set_flashdata('flash_message' , "Details submitted successfully!");
							redirect(base_url() . 'products/manageDetails', 'refresh');
						}
						
					}
				}
			break;

			case ($type == "edit" || $type == "view"):

				$result 					= $this->products_model->getDetailsView($id);

				$page_data['headerData'] 	= $result['headerData'];
				$page_data['lineData'] 		= $result['lineData'];

				if($_POST)
				{
					$product_id 			= $this->input->post('product_id');
					$title 					= $this->input->post('title');
					
					$checkDetailsExists = $this->products_model->checkDetailsExists($product_id,$title,$type,$id);

					if(count($checkDetailsExists) > 0)
					{
						$this->session->set_flashdata('error_message' , "Details already exists!");
						redirect(base_url() . 'products/manageDetails/edit/'.$id, 'refresh');
					}

					$headerData = array(
						"product_id" 	  		=>  $product_id,
						"title" 				=>  $title,
						"last_updated_by" 	 	=>  $this->user_id,
						"last_updated_date" 	=>  $this->date_time
					);
					$this->db->where('header_id', $id);
					$result = $this->db->update('details_headers', $headerData);

					if($result)
					{
						if( isset($_FILES['header_details_image']['name']) && $_FILES['header_details_image']['name'] !="" )
						{
							move_uploaded_file($_FILES['header_details_image']['tmp_name'], 'uploads/products/details/header_img/'.$id.'.png');
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
									"product_id" 			=> $product_id,
									"line_title" 			=> $line_title,
									"line_description" 		=> $line_description,
									"last_updated_by" 		=> $this->user_id,
									"last_updated_date" 	=> $this->date_time
								);
							
								if ($line_id == 0) 
								{
									
									$lineData['created_by'] = $this->user_id;
									$lineData['created_date'] = $this->date_time;
							
									$this->db->insert('details_lines', $lineData);
									$line_id = $this->db->insert_id();
							
									// if (isset($_FILES['details_image']['name'][$dp]) && $_FILES['details_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/products/details/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['details_image']['tmp_name'][$dp], $uploadFile);
									// }
								} 
								else 
								{
									$this->db->where('header_id', $id);
									$this->db->where('line_id', $line_id);
									$this->db->update('details_lines', $lineData);
							
									// if (isset($_FILES['details_image']['name'][$dp]) && $_FILES['details_image']['name'][$dp] != "") {
									// 	$uploadDir = 'uploads/products/details/';
									// 	$uploadFile = $uploadDir . $line_id . '.png';
							
									// 	move_uploaded_file($_FILES['details_image']['tmp_name'][$dp], $uploadFile);
									// }
								}
							}							
							
							if(isset($_POST["save_btn"]))
							{
								$this->session->set_flashdata('flash_message' , "Details saved successfully!");
								redirect(base_url() . 'products/manageDetails/edit/'.$id, 'refresh');
							}
							else if(isset($_POST["submit_btn"])) {
								$this->session->set_flashdata('flash_message' , "Details submitted successfully!");
								redirect(base_url() . 'products/manageDetails', 'refresh');
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
					$succ_msg = 'All details in these product are now successfully active!';
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
					$succ_msg = 'All details in these product are now successfully inactive!';
				}
				$this->db->where('header_id', $id);
				$this->db->update('details_headers', $data);
				$this->session->set_flashdata('flash_message' , $succ_msg);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			break;
			
			default : #Manage
				$totalResult = $this->products_model->getDetails("","",$this->totalCount);
				$page_data["totalRows"] = $totalRows = count($totalResult);

				if(!empty($_SESSION['PAGE']))
				{$limit = $_SESSION['PAGE'];
				}else{$limit = 10;}

				$product_id 		= isset($_GET['product_id']) ? $_GET['product_id'] :NULL;
				$product_name 		= isset($_GET['product_name']) ? $_GET['product_name'] :NULL;
				$title 				= isset($_GET['title']) ? $_GET['title'] :NULL;
				$active_flag 		= isset($_GET['active_flag']) ? $_GET['active_flag'] :NULL;

				$this->redirectURL = 'products/manageDetails?product_id='.$product_id.'&product_name='.$product_name.'&title='.$title.'&active_flag='.$active_flag.'';
				
				if ($product_id != NULL || $product_name != NULL || $title != NULL || $active_flag !=NULL) {
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
				
				$page_data['resultData'] = $result = $this->products_model->getDetails($limit, $offset, $this->pageCount);

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

	function ajaxAvailableDetails($type = '', $id = '', $status = '')
    {
		
		switch($type)
		{
			case "status":
				if($status == 1){
					$data['active_flag'] = 'Y';
					$succ_msg = 'Detail is Available!';
				}
				else{
					$data['active_flag'] ='N';
					$succ_msg = 'Detail is Unavailable!';
				}

				$data['last_updated_by'] = $this->user_id;
				$data['last_updated_date'] = $this->date_time;


				$this->db->where('line_id', $id);
				$this->db->update('details_lines', $data);
				echo $succ_msg;exit;
			break;
		}
	}
}
?>
