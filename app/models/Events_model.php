<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }

	function getEvents($offset="",$record="",$countType="")
	{
		if($_GET)
		{
			if($countType == 1) #GetTotalCount
			{
				$limit = "";
			}
			else if($countType == 2) #Get Page Wise Count
			{
				$limit = "limit ".$record." , ".$offset." "; 
			}

			if (!isset($_GET['event_id']) || $_GET['event_id'] === '') {
				$event_id = 'NULL';
			} else {
				$event_id = $_GET['event_id'];
			}
			$fromDate 			= !empty($_GET['from_date']) ? date_format(date_create($_GET['from_date']),"Y-m-d") : NULL;
			$toDate 			= !empty($_GET['to_date']) ? date_format(date_create($_GET['to_date']),"Y-m-d") : NULL;
			$active_flag 		= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
				events.event_id,
				events.event_title,
				events.location_name,
				events.start_date,
				events.end_date,
				events.active_flag
				from events
				where 1=1
				and events.event_id = coalesce($event_id,events.event_id)
				and events.active_flag = if('".$active_flag."' = 'All',events.active_flag,'".$active_flag."')
				and (coalesce(events.start_date, '".$this->date."') >= coalesce('".$fromDate."', events.start_date))
            	and (coalesce(events.end_date, '".$this->date."') <= coalesce('".$toDate."', events.end_date))
				order by events.event_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkEventExist($event_url='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="events.event_id!='".$id."'";
		}

		$query="select events.event_id from events
				where 1=1 
				and events.event_url='".$event_url."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getViewData($id="")
	{
		$query = "select 
		events.event_id,
		events.event_title,
		events.description,
		events.start_date,
		events.end_date,
		events.location_name from events
		where 1=1
		and events.event_id = '".$id."'" ;
		
		$result = $this->db->query($query)->result_array();
		
		
		return $result;
	}

	function getEventsAll()
	{
		$query = "select 
		events.event_id,
		events.event_title from events" ;
		
		$result = $this->db->query($query)->result_array();
		
		return $result;
	}

	function ajaxEventsListAll($event_title='') 
	{
		$query = "select 
		events.event_id,
		events.event_title from events
		where 1 = 1
		and events.event_title like '%" . $event_title . "%' ";

		$result = $this->db->query($query)->result_array();
		return $result;
	}




	function getEventDetails($offset="",$record="",$countType="")
	{
		if($_GET)
		{
			if($countType == 1) #GetTotalCount
			{
				$limit = "";
			}
			else if($countType == 2) #Get Page Wise Count
			{
				$limit = "limit ".$record." , ".$offset." "; 
			}

			if (!isset($_GET['event_id']) || $_GET['event_id'] === '') {
				$event_id = 'NULL';
			} else {
				$event_id = $_GET['event_id'];
			}

			$keywords 			= "concat('%','".serchFilter($_GET['keywords'])."','%')";
			$active_flag 		= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';
			

			$query = "select 
				event_details.event_detail_id,
				event_details.title,
				event_details.description,
				event_details.active_flag,
				events.event_title
				from event_details
				left join events on events.event_id=event_details.event_id
				where 1=1
				and events.event_id = coalesce($event_id,events.event_id)
				and event_details.title like coalesce($keywords,event_details.title) 
				and events.active_flag = if('".$active_flag."' = 'All',events.active_flag,'".$active_flag."')
				order by event_details.event_detail_id desc $limit" ;
			
			$result = $this->db->query($query)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function checkEventDetailExist($event_id='',$title,$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="event_details.event_detail_id!='".$id."'";
		}
		
		$title = $this->db->escape_str($title);

		$query="select event_details.event_detail_id from event_details
				where 1=1 
				and event_details.event_id='".$event_id."'
				and event_details.title='".$title."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getEventDetailsView($id="")
	{
		$query = "select 
		event_details.event_detail_id,
		event_details.title,
		event_details.description,
		events.event_id,
		events.event_title from event_details
		left join events on events.event_id=event_details.event_id
		where 1=1
		and event_details.event_detail_id = '".$id."'" ;
		
		$result = $this->db->query($query)->result_array();
		
		return $result;
	}

	function getEventDetail($event_url="")
	{
		$query = "select 
		event_details.event_detail_id,
		event_details.title,
		event_details.description from event_details
		left join events on events.event_id=event_details.event_id
		where 1=1
		and events.event_url = '".$event_url."'" ;
		
		$result = $this->db->query($query)->result_array();
		
		return $result;
	}

	function getEventGallery($offset="",$record="",$countType="")
	{
		if($_GET)
		{
			if($countType == 1) #GetTotalCount
			{
				$limit = "";
			}
			else if($countType == 2) #Get Page Wise Count
			{
				$limit = "limit ".$record." , ".$offset." "; 
			}

			if (!isset($_GET['event_id']) || $_GET['event_id'] === '') {
				$event_id = 'NULL';
			} else {
				$event_id = $_GET['event_id'];
			}

			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.event_id,
			header_tbl.description,
			header_tbl.active_flag,
			events.event_title from event_gallery_headers as header_tbl
			left join events on events.event_id=header_tbl.event_id
			where 1=1
			and events.event_id = coalesce($event_id,events.event_id)
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			group by header_tbl.header_id
			order by header_tbl.header_id desc $limit" ;
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getGalleryView($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.description,
		events.event_id,
		events.event_title from event_gallery_headers as header_tbl
		left join events on events.event_id=header_tbl.event_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.order_sequence,
		line_tbl.line_description,
		line_tbl.active_flag
		from event_gallery_lines as line_tbl
		left join event_gallery_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function checkGalleryExists($event_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from event_gallery_headers as header_tbl
				where 1=1 
				and header_tbl.event_id='".$event_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getEventGalleryList($event_url='')
	{
		$query="select line_tbl.line_id,
		line_tbl.header_id, 
		line_tbl.line_description
		from event_gallery_lines as line_tbl
		left join event_gallery_headers as header_tbl on header_tbl.header_id=line_tbl.header_id
		left join events on events.event_id=header_tbl.event_id
		where 1=1 
		and events.event_url='".$event_url."'
		and line_tbl.active_flag='".$this->active_flag."'
		order by line_tbl.order_sequence asc";
		$result = $this->db->query($query)->result_array();
		return $result;
	}



	function getAbouts($offset="",$record="",$countType="")
	{
		if($_GET)
		{
			if($countType == 1) #GetTotalCount
			{
				$limit = "";
			}
			else if($countType == 2) #Get Page Wise Count
			{
				$limit = "limit ".$record." , ".$offset." "; 
			}

			if (!isset($_GET['event_id']) || $_GET['event_id'] === '') {
				$event_id = 'NULL';
			} else {
				$event_id = $_GET['event_id'];
			}

			$keywords 			= "concat('%','".serchFilter($_GET['keywords'])."','%')";
			$active_flag 		= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.about_title,
			header_tbl.description,
			header_tbl.active_flag,
			events.event_title from about_headers as header_tbl
			left join events on events.event_id=header_tbl.event_id
			where 1=1
			and events.event_id = coalesce($event_id,events.event_id)
			and (header_tbl.about_title like coalesce($keywords,header_tbl.about_title) or header_tbl.description like coalesce($keywords,header_tbl.description))
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			order by header_tbl.header_id desc $limit" ;

			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
		}
		return $result;
	}

	function getAboutsData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.about_title,
		header_tbl.description,
		events.event_id,
		events.event_title from about_headers as header_tbl
		left join events on events.event_id=header_tbl.event_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from about_lines as line_tbl
		left join about_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}


	function checkEventExists($event_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from about_headers as header_tbl
				where 1=1 
				and header_tbl.event_id='".$event_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getBenefits($offset="",$record="",$countType="")
	{
		if($_GET)
		{
			if($countType == 1) #GetTotalCount
			{
				$limit = "";
			}
			else if($countType == 2) #Get Page Wise Count
			{
				$limit = "limit ".$record." , ".$offset." "; 
			}

			if (!isset($_GET['event_id']) || $_GET['event_id'] === '') {
				$event_id = 'NULL';
			} else {
				$event_id = $_GET['event_id'];
			}

			$title 			= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 	= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.event_id,
			header_tbl.title,
			header_tbl.active_flag,
			events.event_title from event_benefits_headers as header_tbl
			left join events as events on events.event_id=header_tbl.event_id
			where 1=1
			and events.event_id = coalesce($event_id,events.event_id)
			and header_tbl.title like coalesce($title,header_tbl.title) 
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			group by header_tbl.header_id
			order by header_tbl.header_id desc $limit" ;

			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getBenefitsView($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.event_id,
		header_tbl.title,
		events.event_title from event_benefits_headers as header_tbl
		left join events as events on events.event_id=header_tbl.event_id
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.line_title,
		line_tbl.line_description,
		line_tbl.active_flag
		from event_benefits_lines as line_tbl
		left join event_benefits_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	
	function checkBenefitsExists($event_id='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition=" header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from event_benefits_headers as header_tbl
				where 1=1 
				and header_tbl.event_id='".$event_id."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	

	function getEventBanners($offset="",$record="",$countType="")
	{
		if($_GET)
		{
			if($countType == 1) #GetTotalCount
			{
				$limit = "";
			}
			else if($countType == 2) #Get Page Wise Count
			{
				$limit = "limit ".$record." , ".$offset." "; 
			}
			

			$title 				= "concat('%','".serchFilter($_GET['title'])."','%')";
			$active_flag 		= !empty($_GET['active_flag']) ? $_GET['active_flag'] : 'NULL';

			$headerQry = "select 
			header_tbl.header_id,
			header_tbl.title,
			header_tbl.description,
			header_tbl.active_flag from event_banner_headers as header_tbl
			where 1=1
			and header_tbl.title like coalesce($title,header_tbl.title) 
			and header_tbl.active_flag = if('".$active_flag."' = 'All',header_tbl.active_flag,'".$active_flag."')
			group by header_tbl.header_id
			order by header_tbl.header_id desc $limit" ;
			
			$result = $this->db->query($headerQry)->result_array();
		}
		else
		{
			$result = array();
			
		}
		return $result;
	}

	function getBannerViewsData($id="")
	{

		$headerQry ="select 
		header_tbl.header_id,
		header_tbl.title,
		header_tbl.description from event_banner_headers as header_tbl
		where 1=1
		and header_tbl.header_id = '".$id."' " ;

		$result['headerData'] = $this->db->query($headerQry)->result_array();

		$lineQry ="select 
		line_tbl.line_id,
		line_tbl.header_id,
		line_tbl.order_sequence,
		line_tbl.active_flag
		from event_banner_lines as line_tbl
		left join event_banner_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
		where 1=1
		and header_tbl.header_id = '".$id."'";
			
		$result['lineData'] = $this->db->query($lineQry)->result_array();

		return $result;
	}

	function checkEventBannerExists($title='',$type='',$id='')
	{
		if($type==='add' || $type==='import')
		{
			$condition=' 1=1';
		}
		else
		{
			$condition="header_tbl.header_id!='".$id."'";
		}

		$query="select header_id from event_banner_headers as header_tbl
				where 1=1 
				and header_tbl.title='".$title."'
				and $condition";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getEventBannersList()
	{

		$query="select line_tbl.line_id,
				line_tbl.header_id,
				header_tbl.title,
				header_tbl.description from event_banner_lines as line_tbl
				left join event_banner_headers as header_tbl on header_tbl.header_id = line_tbl.header_id
				where 1=1
				and line_tbl.active_flag='".$this->active_flag."'
				order by line_tbl.line_id desc";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getUpcomingEvents()
	{
		$currentDate = date('Y-m-d'); // Get today's date

		$query = "select 
		events.event_id,
		events.event_title,
		events.event_url, 
		events.description, 
		events.start_date, 
		events.end_date 
    	from events
    	where 1=1
    	and events.start_date > '".$currentDate."' 
   		order by events.event_id desc";

		$result = $this->db->query($query)->result_array();
		return $result;
	}

	function getPastEvents()
	{
		$currentDate = date('Y-m-d'); // Get today's date

		$query = "select 
		events.event_id,
		events.event_title,
		events.event_url, 
		events.description,
		events.start_date, 
		events.end_date  
    	from events
    	where 1=1
    	and events.end_date is null or events.end_date <= '".$currentDate."' 
   		order by events.event_id desc";

		$result = $this->db->query($query)->result_array();
		return $result;
	}
}
