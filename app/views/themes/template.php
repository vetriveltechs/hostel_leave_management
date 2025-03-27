<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no user-scalable=yes">
		
		
	<!-- SEO -->
	<?php 
		$segment_1 	=  !empty($this->uri->segment(1)) ? $this->uri->segment(1) : "";
		$segment_2 	=  !empty($this->uri->segment(2)) ? "/".$this->uri->segment(2) : "";
		$segment_3 	=  !empty($this->uri->segment(3)) ? "/".$this->uri->segment(3) : "";

		$pageURL	= $segment_1.$segment_2.$segment_3;

		if($pageURL)
		{
			$getSeoContent = $this->db->query("select * from seo_settings where page_url='".$pageURL."' and active_flag='Y'")->result_array();
			?>
				
				<title><?php echo isset($getSeoContent[0]['page_title']) ? $getSeoContent[0]['page_title'] : $page_title ; ?></title>
				<meta name="Title" content="<?php echo isset($getSeoContent[0]['meta_title']) ? $getSeoContent[0]['meta_title'] : META_TITLE ; ?>"/>
				<meta name="description" content="<?php echo isset($getSeoContent[0]['meta_description']) ? $getSeoContent[0]['meta_description'] : META_DESCRIPTION ; ?>"/>
				<meta name="keywords" content="<?php echo isset($getSeoContent[0]['meta_keywords']) ? $getSeoContent[0]['meta_keywords'] : META_KEYWORDS ; ?>"/>
				<meta name="author" content="JesperApps">
				<meta name="Language" content="English">
				<meta name="robots" content="index, follow">
				<meta name="country" content="India">
				<meta name="revisit-after" content="2 days">
				<link rel="canonical" href="<?php echo base_url(isset($getSeoContent[0]['page_url']) ? $getSeoContent[0]['page_url'] : PAGE_URL); ?>" />
				<meta property="og:locale" content="en_US" />
				<meta property="og:type" content="website" />
				<meta name="og_title" content="<?php echo isset($getSeoContent[0]['og_title']) ? $getSeoContent[0]['og_title'] : OG_TITLE ; ?>"/>
				<meta name="og_description" content="<?php echo isset($getSeoContent[0]['og_description']) ? $getSeoContent[0]['og_description'] : OG_DESCRIPTION ; ?>"/>
				<meta name="og_url" content="<?php echo base_url(isset($getSeoContent[0]['og_url']) ? $getSeoContent[0]['og_url'] : OG_URL); ?>"/>
				<?php /*
					<meta name="page_title" content="<?php echo isset($getSeoContent[0]['page_title']) ? $getSeoContent[0]['page_title'] : $page_title ; ?>"/>
					<meta name="og_sitename" content="<?php echo isset($getSeoContent[0]['og_sitename']) ? $getSeoContent[0]['og_sitename'] : OG_SITENAME ; ?>"/>
					<meta name="subject" content="<?php echo META_SUBJECT; ?>"/> 
					<meta property="og:image" content=" " />

				*/ ?>
			<?php
		}
		else
		{
			?>
				<title>JesperApps | Innovative Enterprise Solutions | Consluting</title>
				<meta name="page_title" content="JesperApps | Innovative Enterprise Solutions | Consluting"/>
				<meta name="Title" content="JesperApps | Innovative Enterprise Solutions | Consulting"/>
				<meta name="description" content="JesperApps empowers businesses intelligent solutions to streamline workflows, improve performance, and achieve sustainable success. Get started today!"/>
				<meta name="keywords" content="Best Digital transformation services, Custom enterprise software solutions,top it consulting firms, best it consulting firms, it services and it consulting companies"/>
				<meta name="author" content="JesperApps">
				<meta name="Language" content="English">
				<meta name="robots" content="index, follow">
				<meta name="country" content="India">
				<meta name="revisit-after" content="2 days">
				<link rel="canonical" href="<?php echo base_url() ;?>" />
				<meta property="og:locale" content="en_US" />
				<meta property="og:type" content="website" />
				<meta name="og_title" content="JesperApps | Empowering Businesses with Smart Solutions"/>
				<meta name="og_description" content="Unlock new possibilities with JesperApps. Enhance productivity, simplify operations, and accelerate business success. Let’s build a smarter future together!"/>
				<meta name="og_url" content="<?php echo base_url() ;?>"/>
				<?php /*
					<meta name="page_title" content="<?php echo isset($getSeoContent[0]['page_title']) ? $getSeoContent[0]['page_title'] : $page_title ; ?>"/>
					<meta name="og_sitename" content="<?php echo isset($getSeoContent[0]['og_sitename']) ? $getSeoContent[0]['og_sitename'] : OG_SITENAME ; ?>"/>
					<meta name="subject" content="<?php echo META_SUBJECT; ?>"/> 
					<meta property="og:image" content=" " />
				*/ ?>
				
			<?php
		}

		
	?>
		
			<?php /*
			<meta name="author" content="<?php echo META_AUTHOR; ?>"/>
			<meta name="publisher" content="<?php echo META_PUBLISHER; ?>"/>
			<meta name="copyright" content="<?php echo META_COPYRIGHT; ?>"/>   
			<meta name="owner" content="<?php echo META_OWNER; ?>"/>
			
			<?php echo ANALYTICS_CODE ; */ ?>
		<!-- SEO -->
		<link rel="icon" type="image/png" href="<?php echo base_url();?>uploads/favicon.png" type="image/x-icon">
	
		<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/all.min.css">
		<link href="<?php echo base_url();?>assets/frontend/css/bootstrap.min.css" rel="stylesheet" />	
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/assets/unicons/css/unicons.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/green-energy.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.14.0/devicon.min.css">

		<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>

		<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- style sheets and font icons  -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/vendors.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/icon.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/style.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/responsive.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/fashion-store/fashion-store.css" />

		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/web-agency.css" /> 

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<?php include 'assets/frontend/js/common_script.php';?>
		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" 
		async defer></script>
		<!-- theme JS files -->
		<link href="<?php echo base_url();?>assets/backend/toastr/toastr.css" type="text/css"  rel="stylesheet" />
		<script src="<?php echo base_url();?>assets/backend/toastr/toastr.js"></script>
		<style>
			.content
			{
				padding: 1.25rem 1.25rem;
				-ms-flex-positive: 1;
				flex-grow: 1;
			}
			
			*, ::after, ::before {
				box-sizing: border-box;
			}

		
		</style>
		<script type='application/ld+json'> 
			{
				"@context": "http://www.schema.org",
				"@type": "Organization",
				"name": "JesperApps Software Services",
				"url": "http://www.jesperapps.com/",
				"sameAs": [
					"https://www.jesperapps.com/product/all",
					"https://www.jesperapps.com/industry",
					"https://www.jesperapps.com/service/all"
				],
				"logo": "https://www.jesperapps.com/assets/frontend/img/jesper/j-logo.png",
				"description": "JesperApps offers expert tech consulting and innovative business solutions, including ERP, automation, and cloud services for seamless operations.",
				"address": 
				{
					"@type": "PostalAddress",
					"streetAddress": "Door No. 4/C KM Towers, Second Floor, Krishnagiri Bypass Road",
					"postOfficeBoxNumber": "Vasanth Nagar",
					"addressLocality": "Hosur",
					"addressRegion": "Tamil Nadu",
					"postalCode": "635109",
					"addressCountry": "India"
				},
				"contactPoint": 
				{
					"@type": "ContactPoint",
					"telephone": "+91 93634 88288"
				}
			}
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-TKCR7WZN');
		</script>
		<!-- End Google Tag Manager -->
	</head>
		<body>
			<!-- Google Tag Manager (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKCR7WZN"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
			<?php 
				$segment = $this->uri->segment(1);

				if ($segment == "home" || $segment == "") 
				{
					include THEME_NAME . "/header.php";
					include THEME_NAME . "/" . $page_name . '.php';
					include THEME_NAME . "/footer.php";
				}
				else if ($segment == "thankyou") 
				{
					include THEME_NAME . "/header1.php"; 
					include THEME_NAME . "/" . $page_name . '.php';
					include THEME_NAME . "/footer.php"; 
				}
				else {
				
					include THEME_NAME . "/header1.php"; 
					include THEME_NAME . "/" . $page_name . '.php';
					include THEME_NAME . "/footer.php"; 
					
				}
			?>
		</body>
	</html>

	<link href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css" rel="stylesheet">
	<script src="<?php echo base_url();?>assets/frontend/js/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>assets/backend/toastr/sweetalert2@11.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/vendors.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/main.js"></script>
	

<!-- Tostr success & Error message start -->
<style>.swal-wide{
    width:850px !important;
}</style>
<script type="text/javascript">
	<?php
		$msg = $this->session->flashdata("success_message");
		$flash_message = $this->session->flashdata("flash_message");
		$error_message = $this->session->flashdata("error_message");
		if( $msg != "" || $flash_message !="")
		{
			if($msg !="")
			{
				$message = $msg;
			}
			else if($flash_message !="")
			{
				$message = $flash_message;
			}
			?>  
			//toastr.success('<?php //echo $message;?>');	
			Swal.fire({
				position: 'top',
				//position: 'top-end',
				icon: 'success',
				title: '<?php echo $message;?>',
				showConfirmButton: false,
				timer: 1500,
				width:'350px'
			});		
			<?php 
		}
		else if( $error_message != '')
		{
			?>  
			toastr.error('<?php echo $error_message;?>');			
			<?php 
		}
	?>
	//Scroll Top Starts
	var btn = $('#scroll-top');

	$(window).scroll(function() {
	if ($(window).scrollTop() > 300) {
		btn.addClass('show');
	} else {
		btn.removeClass('show');
	}
	});

	btn.on('click', function(e) {
	e.preventDefault();
	$('html, body').animate({scrollTop:0}, '300');
	});
	//Scroll Top End

	$(function()
	{
		$('.mobile_vali').keyup(function()
		{
			var yourInput = $(this).val();
			re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/a-zA-Z]/gi;
			var isSplChar = re.test(yourInput);
			if(isSplChar)
			{
				var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/a-zA-Z]/gi, '');
				$(this).val(no_spl_char);
			}
		});
	});
</script>


<!-- <a href="https://api.whatsapp.com/send?phone=919361226692&text=Thanks%20for%20contacting%20us.%20We%20will%20get%20back%20to%20you%20soon!" class="float" target="_blank">
  <i class="fa fa-whatsapp" style="margin-top:15px;"></i>
</a> -->




<style>
	.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:88px;
	right:23px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  	font-size:30px;
	box-shadow: 2px 2px 3px #999;
    z-index:100;
}

.my-float{
	margin-top:16px;
}
</style>