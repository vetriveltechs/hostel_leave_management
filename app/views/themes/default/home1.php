<body>
	<!-- Start Consalt Header Area Style Three-->
<!--==================================================-->
<div class="consalt-header-area style_two style_three inner_page" id="sticky-header" >
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-lg-2">
				<div class="header-logo">
					<a class="active_header" href="<?php echo base_url() .'home'; ?>"><img src="<?php echo base_url();?>assets/frontend/img/logo.svg" alt="logo" style="border-radius:5px;" ></a>
					<a class="active_sticky" href="<?php echo base_url() .'home'; ?>"><img src="<?php echo base_url();?>assets/frontend/img/logo.png" alt="logo" style="border-radius:5px;" ></a>
				</div>
			</div>
			<div class="col-lg-7">
			<div class="header-menu">
                    <ul class="nav_scroll">
                        <li><a href="<?php echo base_url() .'home'; ?>"><strong>Home</strong></a></li>

                        <!-- Services Dropdown -->
						<li>
							<a href="javascript:void(0);"><strong>Services</strong> <span><i class="fas fa-angle-down"></i></span></a>
							<ul class="sub_menu dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 1266px;left: -425px;padding: 40px;">
								<div class="row">
									<!-- First Column: Text -->
									<div class="col-lg-4">
										<h5><strong>Our Services</strong></h5>
										<p class="pt-4"style="text-align: justify;">Discover solutions crafted for your industry’s unique requirements. Our offerings simplify operations, enhance efficiency, and fuel growth, enabling your business to excel in a competitive market.</p>
									</div>

									<!-- Second Column: Menus with Submenus -->
									<div class="col-lg-4">
										<ul>
											<?php 
												$getCategoryListing=$this->categories_model->getCategoryListing();

												
												foreach ($getCategoryListing as $categoryListing) 
												{
													$category_level1_id = $categoryListing['cat_level_1'];
													$getSubCategory = $this->categories_model->getSubCategory($category_level1_id);

													if ($categoryListing['cat_level_2'] !== null && $categoryListing['cat_level_2'] != 0) {
														
														$mainLink  = "javascript:void(0);"; 
													} 
													else 
													{
														$mainLink  = base_url().'services/' . strtolower($categoryListing['list_code']).'/'.$categoryListing['cat_level_2'];
													}
													?>
														<li class="dropdown">
															<!-- Main Menu Link -->
															<a href="<?php echo $mainLink; ?>">
																<?php echo $categoryListing['list_value']; ?>
																<?php
																if ($categoryListing['cat_level_2'] !== null && $categoryListing['cat_level_2'] != 0) {
																	?>
																	<span class="float-end">
																		<i class="fas fa-angle-right" style="color:#2c5226;"></i>
																	</span>
																	<?php
																}
																?>
															</a>

															<?php
															// Sub-menu Logic
															if (count($getSubCategory) > 0) {
																if ($categoryListing['cat_level_2'] !== null && $categoryListing['cat_level_2'] != 0) {
																	?>
																	<ul class="sub-menu2" style="display:none;">
																		<?php
																		foreach ($getSubCategory as $subCategory) 
																		{
																			$subLink = base_url().'services/' . strtolower($subCategory['list_code_1']) . '/' . strtolower($subCategory['list_code_2']);
																			?>
																			<!-- Sub-menu Items -->
																			<li>
																				<a href="<?php echo $subLink; ?>">
																					<?php echo $subCategory['list_value']; ?>
																				</a>
																			</li>
																			<?php
																		}
																		?>
																	</ul>
																	<?php
																}
															}
															?>
														</li>
													<?php		
												}
											?>
										</ul>
									</div>

									<!-- Third Column: Images -->
									<div class="col-lg-4">
										<div class="team_thumb">
										<img src="<?php echo base_url();?>assets/frontend/img/home_one/healthcare.png" alt="" style="width:246px;">
										</div>
									</div>
								</div>
							</ul>
						</li>



                        <li><a href="javascript:void(0);"><strong>Industries</strong> <span><i class="fas fa-angle-down"></i></span></a>
                        	<ul class="sub_menu dropdown-menu" aria-labelledby="dropdownMenuLink" style=" width: 1266px;left: -525px;padding: 40px;">
      
                        		<div class="row pt-2">
                                    <!-- First Column: Text -->
                                    <div class="col-lg-4">
                                    <h5 class="text-center"><strong>Industries</strong></h5>

                                        <p class="pt-4"style="text-align: justify;">We drive innovation across industries, from Food & Beverage to Oil & Gas, providing tailored solutions that enhance quality, sustainability, and growth. By leveraging the latest technologies, we empower businesses to stay ahead in an ever-evolving world.</p>
                                    </div>
									
									<?php 
										$getIndustries	= $this->industries_model->getIndustriesList();
									?>
                                    <!-- Second Column: Menus with Submenus -->
                                    <div class="col-lg-4">
										<ul>
											<?php foreach ($getIndustries as $index => $industry)
												{
													if ($index % 2 == 0)
													{
														?>
															<li><a href="<?php echo base_url() .'industry/'.$industry['industries_url']; ?>"><?php echo $industry['industries_name']; ?></a></li>
														<?php
													}
													
												}
											?>
										</ul>
									</div>

									<!-- Third Column: Images -->
									<div class="col-lg-4">
										<ul>
											<?php foreach ($getIndustries as $index => $industry)
												{
													if ($index % 2 != 0)
													{
														?>
															<li><a href="<?php echo base_url() .'industries/'.$industry['industries_id']; ?>"><?php echo $industry['industries_name']; ?></a></li>
														<?php
													}
													
												}
											?>
										</ul>
									</div>
									

                                  
                                   
                                </div>
                            </ul>
						</li>
                        
                        <li><a href="<?php echo base_url() .'products'; ?>"><strong>Products</strong></a></li>
                        <li><a href="javascript:void(0"><strong>Knowledge center </strong><span><i class="fas fa-angle-down"></i></span></a>
                            <ul class="sub_menu">
                                <li><a href="<?php echo base_url() .'news'; ?>">News</a></li>
                                <li><a href="<?php echo base_url() .'about-us'; ?>">About Us</a></li>
                                <li><a href="<?php echo base_url() .'careers'; ?>">Careers</a></li>
                                <li><a href="<?php echo base_url() .'location'; ?>">Location</a></li>
                                <li><a href="<?php echo base_url() .'success-story.html'; ?>">Case Studies</a></li>
                                <li><a href="<?php echo base_url() .'contact-us'; ?>">Contact Us</a></li>
                                <li><a href="<?php echo base_url() .'blog/all'; ?>">Blogs</a></li>
                                <li><a href="<?php echo base_url() .'whitepapers'; ?>">Whitepapers</a></li>
                                <li><a href="<?php echo base_url() .'success-stories'; ?>">Success Story</a></li>
								<li><a href="<?php echo base_url() .'events'; ?>">Events</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
			</div>
			<div class="col-lg-3">	
				<div class="consalt_header-right">
								
					<div class="header-button style_two butn">
						<a href="<?php echo base_url() .'contact-us'; ?>">Get Support </a>
					</div>
					<div class="sidebar-btn">
						<div class="nav-btn navSidebar-button"><span><i class="bi bi-filter-left"></i></span></div>							
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--==================================================-->
<!-- End Consalt Header Area -->
<!--==================================================-->


<!--========= Start Mobile Memu========== -->

<div class="mobile-menu-area sticky d-sm-block d-md-block d-lg-none">
	<div class="mobile-menu">
		<nav class="header-menu">
			<ul class="nav_scroll">
				<li><a href="<?php echo base_url() .'home'; ?>">Home</a>
				
				</li>
				<li><a href="javascript:void(0);">Service</a>
					<ul class="sub_menu">
						<?php 
							$getCategoryListing=$this->categories_model->getCategoryListing();

							
							foreach ($getCategoryListing as $categoryListing) 
							{
								$category_level1_id = $categoryListing['cat_level_1'];
								$getSubCategory = $this->categories_model->getSubCategory($category_level1_id);

								if ($categoryListing['cat_level_2'] !== NULL && $categoryListing['cat_level_2'] != 0) {
									
									$mainLink  = "javascript:void(0);"; 
								} 
								else 
								{
									$mainLink  = base_url().'services/' . strtolower($categoryListing['list_code']).'/'.$categoryListing['cat_level_2'];
								}
								?>
									<li class="dropdown">
										<!-- Main Menu Link -->
										<a href="<?php echo $mainLink; ?>">
											<?php echo $categoryListing['list_value']; ?>
											<?php
											if ($categoryListing['cat_level_2'] !== NULL && $categoryListing['cat_level_2'] != 0) {
												?>
												
												<?php
											}
											?>
										</a>

										<?php
										// Sub-menu Logic
										if (count($getSubCategory) > 0) {
											if ($categoryListing['cat_level_2'] !== null && $categoryListing['cat_level_2'] != 0) {
												?>
												<ul class="sub_menu" style="display:none;">
													<?php
													foreach ($getSubCategory as $subCategory) 
													{
														$subLink = base_url().'services/' . strtolower($subCategory['list_code_1']) . '/' . strtolower($subCategory['list_code_2']);
														?>
														<!-- Sub-menu Items -->
														<li>
															<a href="<?php echo $subLink; ?>">
																<?php echo $subCategory['list_value']; ?>
															</a>
														</li>
														<?php
													}
													?>
												</ul>
												<?php
											}
										}
										?>
									</li>
								<?php		
							}
						?>
					</ul>
				

				</li>
				<li><a href="javascript:void(0);">Industries</a>
					<ul class="sub_menu">
						<?php 
							$getIndustries	= $this->industries_model->getIndustriesList();

							foreach ($getIndustries as $index => $industry)
							{
								?>
									<li><a href="<?php echo base_url() .'industry/'.$industry['industries_url']; ?>"><?php echo $industry['industries_name']; ?></a></li>
								<?php
							}
						?>
					</ul>
				</li>
				<li><a href="<?php echo base_url() .'products'; ?>">Products</a>
					
				</li>
				<li><a href="javascript:void(0);">Knowledge Center</a>
					<ul class="sub_menu">
						<li><a href="<?php echo base_url() .'news'; ?>">News</a></li>
						<li><a href="<?php echo base_url() .'about-us'; ?>">About Us</a></li>
						<li><a href="<?php echo base_url() .'careers'; ?>">Careers</a></li>
						<li><a href="<?php echo base_url() .'location'; ?>">Location</a></li>
						<li><a href="<?php echo base_url() .'success-story.html'; ?>">Case Studies</a></li>
						<li><a href="<?php echo base_url() .'contact-us'; ?>">Contact Us</a></li>
						<li><a href="<?php echo base_url() .'blog/all'; ?>">Blogs</a></li>
						<li><a href="<?php echo base_url() .'whitepapers'; ?>">White Papers</a></li>
						<li><a href="<?php echo base_url() .'success-stories'; ?>">Success Story</a></li>
						<li><a href="<?php echo base_url() .'events'; ?>">Events</a></li>
						<li><a href="<?php echo base_url() .'contact-us'; ?>">Contact</a></li>

					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
<!--========= End Mobile Memu========== -->


<!-- Sidebar Cart Item -->
<div class="xs-sidebar-group info-group">
	<div class="xs-overlay xs-bg-black"></div>
	<div class="xs-sidebar-widget">
		<div class="sidebar-widget-container">
			<div class="widget-heading">
				<a href="javascript:void(0);" class="close-side-widget">
					<i class="far fa-times-circle"></i>
				</a>
			</div>
			<div class="sidebar-textwidget">
				<!-- Sidebar Info Content -->
				<div class="sidebar-info-contents">
					<div class="content-inner">
						<div class="nav-logo">
							<a href="<?php echo base_url() .'home'; ?>"><img src="<?php echo base_url();?>assets/frontend/img/logo.svg" alt="sid img" style="width:184px;"></a>
						</div>
					
						<div class="contact-info">
							<h2>Contact Info</h2>
							<ul class="list-style-one">
							<li><i class="bi bi-geo-alt-fill"></i>Door No. 4/C KM Towers, Second Floor, Vasanth Nagar, Krishnagiri Bypass Road, Hosur - 635109</li>
							<li><i class="fas fa-phone-alt"></i><a href="tel:+91 9900017401" class="text-white">+91 9900017401</a></li>

								<li><i class="bi bi-envelope"></i><a href="mailto:sales@jesperapps.com"  class="text-white">sales@jesperapps.com</a></li>
							</ul>
						</div>
						<!-- Social Box -->
						<ul class="social-box">
						<li class="facebook"><a href="https://www.facebook.com/jesperappss" class="fab fa-facebook-f" target="_blank"></a></li>
							<li class="instagram"><a href="https://www.instagram.com/jesperapps/" class="fab fa-instagram" target="_blank"></a></li>
							<li class="X"><a href="https://x.com/JesperApps" class="fab fa-x" target="_blank"></a></li>
							
							<li class="Linkedin"><a href="https://www.linkedin.com/in/jesperapps/" class="fab fa-linkedin-in" target="_blank"></a></li>
							<li class="youtube"><a href="https://www.youtube.com/@jesperapps3871" class="fab fa-youtube" target="_blank"></a></li>
							</ul>
					</div>
				</div>		
			</div>
		</div>
	</div>
</div>
<style>
h1, h2, h3, h4, h5, h6 {
    color: #063232;
    font-family: "Oregon ";
    font-style: normal;
    margin-bottom: 0;
    margin-top: 11px;
    line-height: 1.2;
    font-weight: 600;
    -webkit-transition: .5s;
    transition: .5s;
    font-size: 42px;
}
.consalt-header-area.inner_page .header-button.style_two.butn a {
    background: #0c6e6d;
    padding: 8px 35px;
    border: 1px solid transparent;
    border-radius: 12px;
}
.consalt-header-area.inner_page {
    background: #F4F8F9;
    padding: 0px 56px 0px;
}
/* Ensure submenus appear when hovering over the main menu */
.sub_menu > li:hover > .sub-menu2 {
    display: block;
}

/* Hide submenu by default */
.sub-menu2 {
    display: none;
    position: absolute; /* Use absolute positioning to align it to the right */
    left: 100%; /* Positions the submenu to the right of the parent */
    top: 0; /* Aligns the submenu at the top of the parent */
    padding: 10px; /* Adds some padding to the submenu */
    min-width: 287px; /* Optional: ensures the submenu has a minimum width */
    background-color: #fff; /* Optional: background color for the submenu */
    border: 1px solid #ddd; /* Optional: border around the submenu */
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); /* Optional: shadow effect */
    z-index: 1000; /* Ensures the submenu stays above other content */
}

/* Optional: Styling for the dropdown arrow */
.fas.fa-angle-down,
.fas.fa-angle-right {
    transition: transform 0.3s ease;
}

/* Optional: Additional styling for submenu items */
.sub-menu2 li {
    padding-left: 0px;
}

/* Optional: Change color on hover */
.sub-menu2 li a:hover {
    background-color: #f0f0f0;
}
.mean-container .mean-bar::before {
    content: ""; /* Remove the text content */
    background-image: url('<?php echo base_url();?>assets/frontend/img/logo.svg'); /* Replace with the path to your logo image */
    background-size: contain; /* Ensures the logo fits within the element */
    background-repeat: no-repeat; /* Ensures the logo does not repeat */
    background-position: left center; /* Aligns the logo on the left side */
    width: 156px; 
    height: 36px; 
    position: absolute;
    top: 18px;
    left: 10px;
	border-radius:5px;
}


</style>
<script>
$(document).ready(function() {
    // Toggle sub-menu2 when clicking on the parent menu item
    $('.dropdown > a').on('click', function(event) {
        var $submenu = $(this).siblings('.sub-menu2');
        
        // Close all submenus except the clicked one
        $('.sub-menu2').not($submenu).slideUp();
        
        // Toggle the clicked submenu
        $submenu.stop(true, true).slideToggle();
        
        // Prevent the default action (which would follow the link)
        event.stopPropagation(); // Prevent event from propagating to the document
    });

    // Close submenu if clicked outside of the menu
    $(document).on('click', function(event) {
        // If the click was outside the menu, hide all submenus
        if (!$(event.target).closest('.dropdown').length) {
            $('.sub-menu2').slideUp();
        }
    });
});

</script>
		
<!--==================================================-->
<!-- Start Consalt Hero Area Style Two -->
<!--==================================================-->
<section class="hero_area style_two d-flex align-items-center">
    <!-- Background Video -->
    

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Hero Content -->
                <div class="hero_content mt-0">
                    <h4>JESPERAPPS</h4>
                    <h1>Strategic Insights,<BR> Delivered by JesperApps</h1>
                    <p>Simplifying business challenges with customized consulting and technology-driven solutions. Specializing in Oracle Consulting, we help organizations navigate their digital journey. Let JesperApps lead the way!</p>
                    <!-- Hero Buttons -->
					<div class="slider_button">
                        <div class="hero_btn">
                            <a href="<?php echo base_url() .'contact-us'; ?>"> Free Consultation 
							<span></span></a>
                        </div>
                        <div class="slider_info">
                            <span><i class="fas fa-phone-alt"></i><a href="tel:+91 9900017401">CALL : +91 9900017401</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Optional Image/Graphics can be added here -->
            </div>
        </div>
    </div>

    <!-- Decorative Shapes -->
    <div class="hero_shape testi-shapes">
        <img src="<?php echo base_url();?>assets/frontend/img/home_two/hero_dot_shape.png" alt="">
    </div>
    <div class="hero_shape_2 bounce-animate">
        <img src="<?php echo base_url();?>assets/frontend/img/home_two/hero_shape2.png" alt="">
    </div>
    <div class="hero_shape_3 bounce-animate2">
        <img src="<?php echo base_url();?>assets/frontend/img/home_two/hero_shape1.png" alt="">
    </div>
    <div class="hero_shape_4 bounce-animate-3">
        <img src="<?php echo base_url();?>assets/frontend/img/home_two/hero_shape1.png" alt="">
    </div>
</section>



<!--==================================================-->
<!-- End Consalt Hero Area Style Two -->
<!--==================================================-->
<style>
	section.hero_area.style_two {
    background:url('<?php echo base_url();?>assets/frontend/img/home_two/baner3.png');
    height: 700px;
	object-fit: cover;
	background-repeat: no-repeat;
	
	
}
</style>

<div class="loading-screen" id="loading-screen">
	<span class="bar top-bar"></span>
	<span class="bar down-bar"></span>
	<div class="animation-preloader">
		<div class="spinner"></div>
		<div class="txt-loading">
			<span data-text-preloader="J" class="letters-loading">J</span>
			<span data-text-preloader="E" class="letters-loading">E</span>
			<span data-text-preloader="S" class="letters-loading">S</span>
			<span data-text-preloader="P" class="letters-loading">P</span>
			<span data-text-preloader="E" class="letters-loading">E</span>
			<span data-text-preloader="R" class="letters-loading">R</span>
			<span data-text-preloader="A" class="letters-loading">A</span>
			<span data-text-preloader="P" class="letters-loading">P</span>
			<span data-text-preloader="P" class="letters-loading">P</span>
			<span data-text-preloader="S" class="letters-loading">S</span>


		</div>
	</div>
</div>



<!--==================================================-->
<!-- End Consalt Hero  Area -->
<!--==================================================-->
<section class="about_area style_two style_five pt-0">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 col-md-12">
				<div class="about_thumb">
					<img src="<?php echo base_url();?>assets/frontend/img/home_one/make-it-happen.png" alt="">
					<div class="about_play style_two style_four">
						<a data-aos="flip-left" class="banner-play-btn">
							<div class="text-inner">
								  <svg xmlns="http://www.w3.org/2000/svg" width="250.5" height="250.5" viewBox="0 0 250.5 250.5">
									  <path d="M.25,125.25a125,125,0,1,1,125,125,125,125,0,0,1-125-125" id="e-path-35ee1b2"></path>
									<text>
										<textPath id="e-text-path-35ee1b2" href="#e-path-35ee1b2" startOffset="0%">
											Best Business Consulting  * Best Business Consulting *         
										</textPath>
									</text>
								</svg>							  
						  </div>
						 </a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="section_title home_five">
					<h4>Get to Know Us
					</h4>
					<h1>We Make IT Happen
					</h1>
					<p>Our mission is simple yet impactful: to empower businesses worldwide with exceptional consultation and technology solutions that fuel growth and success. As your trusted partner, we ignite innovation, tackle challenges head-on, and pave the way for your long-term success.
					</p>
				</div>					
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="about_box">
							<div class="about-icon_box style_three">
								<div class="about_icon">
									<img src="<?php echo base_url();?>assets/frontend/img/home-five/about_icon1.png" alt="">
								</div>
								<div class="about_content style_two">
									<h3>Innovative Solutions</h3>
								</div>
							</div>
							<p>We deliver cutting-edge technology tailored to your needs.
</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="about_box">
							<div class="about-icon_box style_three">
								<div class="about_icon">
									<img src="<?php echo base_url();?>assets/frontend/img/home-five/about_icon2.png" alt="">
								</div>
								<div class="about_content style_two">
									<h3>Problem Solvers</h3>
								</div>
							</div>
							<p>We tackle your unique business challenges with precision.</p>
						</div>
					</div>
				</div>
				<p class="about_qute">JesperApps and unlock your organization’s full potential. Together, let’s make IT happen.</p>
				<div class="about_button">
					<div class="about_btn animate_buton">
						<a href="<?php echo base_url() .'about-us'; ?>">Explore More<span></span></a>
					</div>
				</div>					
			</div>
		</div>
	</div>
</section>
<!--==================================================-->
<!-- Start Consalt Feature Area-->
<!--==================================================-->
<section class="feature_area boxed">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- section title -->
				<div class="section_title text-center">
					<h4>Service we offered</h4>
					<h1>Unlock the Full Potential of 
					</h1>
					<h1>Your Business with Our Expertise</h1>
				</div>
			</div>
		</div>
		<div class="row">
			
			<div class="col-lg-3 col-md-6">
				<!-- feature item -->
				<div class="feature_item" >
					<div class="feature_icon">
					<img src="<?php echo base_url();?>assets/frontend/img/home_one/feature_icon04.png" alt="">
					</div>
					<div class="feature_content">
						<h3>Consulting Services</h3>
						<p>Oracle Solutions: Streamline your enterprise systems with our expert Oracle consulting services.
</p>
					</div>
					<div class="feature_number">
						<h6 class="feature_no">01</h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<!-- feature item -->
				<div class="feature_item upper">
					<div class="feature_icon">
						<img src="<?php echo base_url();?>assets/frontend/img/home_one/feature_icon02.png" alt="">
					</div>
					<div class="feature_content">
						<h3>Digital Transformation</h3>
						<p>Redefine your business processes with our end-to-end digital transformation solutions.</p>
					</div>
					<div class="feature_number">
						<h6 class="feature_no">02</h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<!-- feature item -->
				<div class="feature_item">
					<div class="feature_icon">
						<img src="<?php echo base_url();?>assets/frontend/img/home_one/feature_icon03.png" alt="">
					</div>
					<div class="feature_content">
						<h3>Cloud Integration</h3>
						<p>Seamless integration with AWS, Azure, and Google Cloud for robust infrastructure and scalability.</p>
					</div>
					<div class="feature_number">
						<h6 class="feature_no">03</h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<!-- feature item -->
				<div class="feature_item upper">
					<div class="feature_icon">
						<img src="<?php echo base_url();?>assets/frontend/img/home_one/feature_icon01.png" alt="">
					</div>
					<div class="feature_content">
						<h3>Data Science & Analytics</h3>
						<p>Unlock insights with tools like Power BI, Tableau, Databricks, and Snowflake.</p>
					</div>
					<div class="feature_number">
						<h6 class="feature_no">04</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="feature_shape bounce-animate-3">
		<img src="<?php echo base_url();?>assets/frontend/img/home_one/arrow.png" alt="">
	</div>
</section>
<!--==================================================-->
<!-- End Consalt Feature Area-->
<!--==================================================-->






<!--==================================================-->
<!-- Start Consalt Service Area-->
<!--==================================================-->
<section class="service_area boxed">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- section title -->
				<div class="section_title text-center style_two">
					<h4>Industries Served</h4>
					<h1>We specialize in providing tailored  </h1>
					<h1>solutions to industries such as</h1>
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="blog_list owl-carousel">
				<div class="col-lg-12">
					<div class="single-blog-box">
						<div class="single-blog-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home_one/retail.png" alt="">							
						</div>
						<div class="blog-content">
						<div class="meta-blog">
								<p><span class="solution">Retail & E-Commerce</span></p>
							</div>
							
							<div class="blog-title">
								<h3><a href="javascript:void(0)">Improve customer engagement with data-driven strategies.</a></h3>
							</div>
							<div class="blog_btn">
								<a href="javascript:void(0)">Read More <i class="flaticon flaticon-right-arrow"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="single-blog-box">
						<div class="single-blog-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home_one/healthcare.png" alt="">							
						</div>
						<div class="blog-content">
							<div class="meta-blog">
								<p><span class="solution">Healthcare</span></p>
							</div>
							<div class="blog-title">
								<h3><a href="javascript:void(0)">Enable operational efficiency with secure cloud and analytics solutions.</a></h3>
							</div>
							<div class="blog_btn">
								<a href="javascript:void(0)">Read More <i class="flaticon flaticon-right-arrow"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="single-blog-box">
						<div class="single-blog-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home_one/financial-banking.png" alt="">							
						</div>
						<div class="blog-content">
							<div class="meta-blog">
								<p><span class="solution">Finance & Banking</span></p>
							</div>
							<div class="blog-title">
								<h3><a href="javascript:void(0)">Transform workflows with innovative data platforms and cloud systems.</a></h3>
							</div>
							<div class="blog_btn">
								<a href="javascript:void(0)">Read More <i class="flaticon flaticon-right-arrow"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="single-blog-box">
						<div class="single-blog-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home_one/manufacturing.png" alt="">							
						</div>
						<div class="blog-content">
							<div class="meta-blog">
								<p><span class="solution">Manufacturing</span></p>
							</div>
							<div class="blog-title">
								<h3><a href="javascript:void(0)">Modernize operations through automation and analytics.</a></h3>
							</div>
							<div class="blog_btn">
								<a href="javascript:void(0)">Read More <i class="flaticon flaticon-right-arrow"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="single-blog-box">
						<div class="single-blog-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home_one/technology.png" alt="">							
						</div>
						<div class="blog-content">
							<div class="meta-blog">
								<p><span class="solution">Technology </span></p>
							</div>
							<div class="blog-title">
								<h3><a href="javascript:void(0)">Deliver faster, smarter solutions for competitive growth.</a></h3>
							</div>
							<div class="blog_btn">
								<a href="javascript:void(0)">Read More <i class="flaticon flaticon-right-arrow"></i></a>
							</div>
						</div>
					</div>
				</div>
				
			</div>
									
	
		</div>
	</div>
	<div class="service_shape">
		<img src="<?php echo base_url();?>assets/frontend/img/home_one/service-bg.png" alt="">
	</div>
	<div class="service_fuor rotate">
		<img src="<?php echo base_url();?>assets/frontend/img/home_one/service_rotet.png" alt="">
	</div>
</section>
<!--==================================================-->
<!-- End Consalt Service Area-->
<!--==================================================-->



<!--==================================================-->
<!-- Start Consalt Marquee Area-->
<!--==================================================-->
<div class="marquee_area">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="marquee style2">
					<div class="marquee-block">
						<h3>Business</h3>
						<span>Consulting</span>
						<h3>Solutions </h3>
						<span>Experts</span>
					</div>
					<div class="marquee-block">
						<h3>Business</h3>
						<span>Consulting</span>
						<h3>Solutions</h3>
						<span>Experts</span>
					</div>
			</div>
			</div>
		</div>
	</div>
</div>
<!--==================================================-->
<!-- End Consalt  Marquee Area-->
<!--==================================================-->


<!--==================================================-->
<!-- Start Consalt About Area-->
<!--==================================================-->
<!--==================================================-->
<section class="case-study-area style_three  pt-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- section title -->
				<div class="section_title home_five text-center ">
					<h4>LATEST WORKS</h4>
					<h1>Insights & Resources</h1>
					<h1>With highly Satisfaction</h1>
				</div>
			</div>
		</div>
		<div class="row pdn_0">
			<div class="case_study2 owl-carousel">
				<div class="col-lg-12 pdn_0">
					<div class="case-study-single-box style_two">
						<div class="case-study-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home-five/case1.png" alt="">
							<div class="single_portfolio_icon">
							</div>
							<div class="case-study-content">
								<h3>Explore our blogs for the latest trends in digital transformation and cloud integration.</h3>
							</div>
						</div>					
					</div>
				</div>
				<div class="col-lg-12 pdn_0">
					<div class="case-study-single-box style_two">
						<div class="case-study-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home-five/case2.png" alt="">
							<div class="single_portfolio_icon">
							</div>
							<div class="case-study-content">
								<h3>Download whitepapers on Oracle and Salesforce best practices.</h3>
							</div>
						</div>					
					</div>
				</div>
				<div class="col-lg-12 pdn_0">
					<div class="case-study-single-box style_two">
						<div class="case-study-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home-five/case3.png" alt="">
							<div class="single_portfolio_icon">
							</div>
							<div class="case-study-content">
								<h3>Read case studies showcasing our impact across industries.</h3>
							</div>
						</div>					
					</div>
				</div>
				<div class="col-lg-12 pdn_0">
					<div class="case-study-single-box style_two">
						<div class="case-study-thumb">
							<img src="<?php echo base_url();?>assets/frontend/img/home-five/case4.png" alt="">
							<div class="single_portfolio_icon">
							</div>
							<div class="case-study-content">
								<h3>Business Implement</h3>
								<p>Technology</p>
							</div>
						</div>					
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<!--==================================================-->
<!-- Endnsalt About Area-->
<!--==================================================-->

<!--==================================================-->
<!-- Start Testimonial Area -->
<!--==================================================-->
<section class="testimonial_area style_three">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-12">
				<div class="section_title home_five">
					<h4>TESTIMONIAL</h4>
					<h1>What Our Clients Say</h1>
					<p>Hear from businesses that have transformed with JesperApps solutions</p>
				</div>
				<div class="testi-list">
					<ul>
						<li><i class="bi bi-check"></i>100% Clients Satisfaction Gaurantee</li>
					</ul>
				</div>
				<!-- <div class="consalt_btn home_five animate_buton">
					<a href="contact.html">View All  Feedback <span></span></a>
				</div> -->
			</div>
			<div class="col-lg-8 col-md-12">
				<div class="testi_list4 owl-carousel">
					<div class="col-lg-12">
						<div class="testimonial_item style_five">																							
							<div class="testimonial-content">															
								<p>The Hospital Management system by JesperApps has allowed us to improve patient care while reducing administrative time. It's an essential tool for us.</p>	
									<div class="testi-star">
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
									</div>																
							</div>		
							<div class="tesit-auothor">
								<div class="testi-author-thumb">
									<img src="<?php echo base_url();?>assets/frontend/img/home_3/auothor3.png" alt="">
								</div>
								<div class="bio">
									<h4 class="name">Jane Smith</h4>
									<h5 class="designation">Operations Manager, HealthCare Plus</h5>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="testimonial_item style_five">																							
							<div class="testimonial-content">															
								<p>As a startup, JesperApps helped us launch and manage our food delivery system smoothly. The project management software was the backbone of our launch process.</p>	
									<div class="testi-star">
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
									</div>																
							</div>		
							<div class="tesit-auothor">
								<div class="testi-author-thumb">
									<img src="<?php echo base_url();?>assets/frontend/img/home_3/auothor.png" alt="">
								</div>
								<div class="bio">
									<h4 class="name">Mike Johnson</h4>
									<h5 class="designation">Founder, GreenBites Food Delivery</h5>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="testimonial_item style_five">																							
							<div class="testimonial-content">															
								<p>JesperApps has completely streamlined our operations. The ease of managing everything from payroll to inventory in one platform has been a game-changer for our business!</p>	
									<div class="testi-star">
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
										<i class="fa fa-star active"></i>
									</div>																
							</div>		
							<div class="tesit-auothor">
								<div class="testi-author-thumb">
									<img src="<?php echo base_url();?>assets/frontend/img/home_3/auothor.png" alt="">
								</div>
								<div class="bio">
									<h4 class="name">John Doe</h4>
									<h5 class="designation">CEO, Tech Innovators</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--==================================================-->
<!-- End buddy Testimonial Area -->
<!--==================================================-->



<!-- <section class="testimonial_area style_two style_three">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-5">
				<div class="section_title style_three">
					<h1 class="pb-30">What Our Clients Say</h1>
					<p>Hear from businesses that have transformed with JesperApps solutions
					</p>
				</div>
				<div class="counter-single-item style_two style_three style_four">
					<div class="counter-content none">
						
						<div class="counter_title">
							<div class="counter-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
							</div>
							<h5 class="title_two">Avg. Clients Ratings</h5>
						</div>
					</div>
					<div class="counter_shape">
						<img src="<?php echo base_url();?>assets/frontend/img/home_3/about_shape_3.png" alt="">
					</div>
				</div>
				<div class="testi-list">
					<ul>
						<li><i class="bi bi-check"></i>100% Clients Satisfaction Gaurantee</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="testi_list2 owl-carousel">
					<div class="col-lg-12">
						<div class="testimonial_item style_two style_three">
							<div class="tesit-auothor">
								<div class="auothor">
									<img src="<?php echo base_url();?>assets/frontend/img/home_3/auothor.png" alt="">
									<div class="testi_quote">
										<img src="<?php echo base_url();?>assets/frontend/img/home_3/quote.png" alt="">
									</div>
								</div>
								<div class="bio">
									<h4 class="name">John Doe
									</h4>
									<h5 class="designation">CEO, Tech Innovators
									</h5>
								</div>
							</div>	
							<div class="testimonal-content">							
								<p>JesperApps has completely streamlined our operations. The ease of managing everything from payroll to inventory in one platform has been a game-changer for our business!</p>	
								
									
							</div>
							<div class="testi_item_shape">
								<img src="<?php echo base_url();?>assets/frontend/img/home_3/testi_shape.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="testimonial_item style_two style_three second">
							<div class="tesit-auothor">
								<div class="auothor">
									<img src="<?php echo base_url();?>assets/frontend/img/home_3/auothor3.png" alt="">
									<div class="testi_quote">
										<img src="<?php echo base_url();?>assets/frontend/img/home_3/quote.png" alt="">
									</div>
								</div>
								<div class="bio">
									<h4 class="name">Jane Smith
									</h4>
									<h5 class="designation">Operations Manager, HealthCare Plus</h5>
								</div>
							</div>	
							<div class="testimonal-content">							
								<p>The Hospital Management system by JesperApps has allowed us to improve patient care while reducing administrative time. It's an essential tool for us.</p>	
								
								
							</div>
							<div class="testi_item_shape2">
								<img src="<?php echo base_url();?>assets/frontend/img/home_3/testi_shape2.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="testimonial_item style_two style_three">
							<div class="tesit-auothor">
								<div class="auothor">
									<img src="<?php echo base_url();?>assets/frontend/img/home_3/auothor.png" alt="">
									<div class="testi_quote">
										<img src="<?php echo base_url();?>assets/frontend/img/home_3/quote.png" alt="">
									</div>
								</div>
								<div class="bio">
									<h4 class="name">Mike Johnson
									</h4>
									<h5 class="designation">Founder, GreenBites Food Delivery
									</h5>
								</div>
							</div>	
							<div class="testimonal-content">							
								<p>As a startup, JesperApps helped us launch and manage our food delivery system smoothly. The project management software was the backbone of our launch process.</p>	
								
								
							</div>
							<div class="testi_item_shape">
								<img src="<?php echo base_url();?>assets/frontend/img/home_3/testi_shape.png" alt="">
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div> -->
	<div class="testi_shape_all">
		<div class="testi_shape_two dance3">
			<img src="<?php echo base_url();?>assets/frontend/img/home_3/service_shpe2.png" alt="">
		</div>
		<div class="testi_shape_three dance">
			<img src="<?php echo base_url();?>assets/frontend/img/home_3/service_shpe2.png" alt="">
		</div>
		<div class="testi_shape_four bounce-animate">
			<img src="<?php echo base_url();?>assets/frontend/img/home_3/tir.png" alt="">
		</div>
	</div>
</section>
<section class="faq_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section_title text-center">
					<h4>FAQ’s</h4>
					<h1>Freequently Asked Questions </h1>
					<h1>Portable Services</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Accordion -->
				<div class="tab_container">
    <div id="tab1" class="tab_content">
        <ul class="accordion">
            <li>
                <a><span> What services does JesperApps offer? </span><i class="bi bi-chevron-right"></i></a>
                <p>
				JesperApps offers a comprehensive range of services, including expert consulting for Oracle and Salesforce solutions, as well as digital transformation services to help businesses innovate and streamline their operations.
                    
                </p>
            </li>

            <!-- <li>
                <a><span> Which industries does JesperApps serve? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    We specialize in providing tailored solutions to industries including:<br>
                    • LIFE – STYLE & HI-TECH<br>
                    • Healthcare<br>
                    • Finance & Automobiles<br>
                    • Manufacturing<br>
                    • Food & Beverages<br>
                </p>
            </li>

            <li>
                <a><span> How long has JesperApps been in business? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    JesperApps has over 7 years of experience delivering innovation and transforming businesses.
                </p>
            </li> -->

            <li>
                <a><span> What makes JesperApps unique compared to other service providers? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    Our experience in advanced technology, customer-centric attitude, and bespoke solutions make us a top choice for organizations looking for innovation and efficiency.
                </p>
            </li>

            <li>
                <a><span> Does JesperApps operate globally? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    Yes, JesperApps serves clients worldwide, providing solutions that cater to diverse industries and business environments.
                </p>
            </li>

            <li>
                <a><span> Can JesperApps customize solutions for specific business needs? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    Yes, JesperApps specializes in creating solutions tailored to the unique requirements of your business.
                </p>
            </li>

            <li>
                <a><span> What kind of companies does JesperApps work with? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    We work with companies of all sizes, from startups to large enterprises, across various industries such as healthcare, manufacturing, finance, and retail.
                </p>
            </li>

            <li>
                <a><span> How can I get started with JesperApps? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    To begin, you can contact us at info@jesperapps.com or call us at +91-9363488288. Our team will guide you through our services and help identify the best solutions for your needs.
                </p>
            </li>

            <li>
                <a><span> Does JesperApps offer training for its solutions? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    Yes, we provide training and onboarding support to help your team effectively utilize our solutions.
                </p>
            </li>

            <!-- <li>
                <a><span> What is JesperApps’ mission? </span><i class="bi bi-chevron-right"></i></a>
                <p>
                    Our mission is to empower businesses by delivering innovative digital transformation solutions and leveraging advanced cloud technologies.
                </p>
            </li> -->
        </ul>
    </div>
</div>

				<!-- End Accordion -->
			</div>
		</div>
	</div>
</section>





<section class="contact_area">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7">
				<div class="contact_thumb">
					<img src="<?php echo base_url();?>assets/frontend/img/home_one/contact-us.png" alt="">
					<div class="call-do-action-info style_two">
						<div class="call-do-social_icon">
							<i class="fas fa-phone-alt"></i>
						</div>
						<div class="call_info">
							<h3><a href="tel:+91 9900017401" class="text-white">+91 9900017401</a></h3>
						</div>
					</div>
					<div class="contact_thumb_shape bounce-animate">
						<img src="<?php echo base_url();?>assets/frontend/img/home_3/contact_shapes.png" alt="">
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<!-- contact form box -->
				<div class="contact-form-box style_two">
					<!-- section title -->
					<div class="section_title style_three style_four text-center ">
						<h4>CONTACT US</h4>
						<h1>Contact us today for expert advice and solutions.</h1>
					</div>
					<form action="<?php echo base_url();?>contact-us" method="POST" id="contactForm" onsubmit="return submitForm(event);">
					<div class="contact_shape bounce-animate">
						<img src="<?php echo base_url();?>assets/frontend/img/home_3/contact_shape.png" alt="">
					</div>
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-lg-12 col-md-12">
                                <div class="form-box">
                                    <input type="text" name="first_name" id="first_name" placeholder=" Name *">
                                    <h6 id="first_name_error" class="error-message"></h6>
                                </div>
                            </div>
                            <!-- Last Name -->
                            <!-- <div class="col-lg-6 col-md-6">
                                <div class="form-box">
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name *">
                                    <h6 id="last_name_error" class="error-message"></h6>
                                </div>
                            </div> -->
                            <!-- Company Name -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box">
                                    <input type="text" name="company_name" id="company_name" placeholder="Company Name *">
                                    <h6 id="company_name_error" class="error-message"></h6>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box">
                                    <input type="email" name="company_email" id="company_email" placeholder="Company Email *">
                                    <h6 id="company_email_error" class="error-message"></h6>
                                </div>
                            </div>
                            <!-- Message -->
                            <div class="col-lg-12 col-md-12">
                                <div class="form-box message">
                                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Write Us *"></textarea>
                                    <h6 id="message_error" class="error-message"></h6>
                                </div>
                            </div>
                            <!-- Captcha -->
                            <div class="col-lg-12 col-md-12">
                                <div class="row ">
                                    <div class="col-lg-4 col-md-3 col-4 mt-1">
                                        <h6 id="mainCaptcha" style="color:#000; display:inline-block;"></h6>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-4 px-0 mt-1">
                                        <button type="button" id="refresh" onclick="Captcha();" class="refresh-btn" style="border:none; background:none;">
                                            <img src="<?php echo base_url();?>assets/frontend/img/sync.png" alt="Sync Alt Icon" class="icon" style="width:20px;height:20px;">
                                        </button>
                                    </div>
                                    <div class="col-lg-7 col-md-8 col-12 mt-1">
                                        <input type="text" name="captcha" id="captcha" class="captcha-input" placeholder="Captcha" />
                                        <h6 id="captcha_error" class="error-message" style="text-align:left;color:red;"></h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="contact-form text-end pt-4">
                                <button type="submit"><i class="far fa-thumbs-up"></i> Request Call Back </button>
                            </div>
                        </div>
                    </form>


					<div id="status"></div>
				</div>  
			</div>
		</div>

	</div>
	<div class="contact_shape1 dance">
		<img src="<?php echo base_url();?>assets/frontend/img/home_3/animate.png" alt="">
	</div>
	<div class="contact_shape2 dance2">
		<img src="<?php echo base_url();?>assets/frontend/img/home_3/service_shpe2.png" alt="">
	</div>
</section>







<script>
    $(document).ready(function () {
        // Generate Captcha on page load
        Captcha();

        // Input event listeners for validation
        $('#first_name').on('input', function () {
            this.value = this.value.replace(/\d/g, ''); // Remove numbers
            validateName($(this).val(), 'first_name');
        });

        $('#last_name').on('input', function () {
            this.value = this.value.replace(/\d/g, ''); // Remove numbers
            validateName($(this).val(), 'last_name');
        });

        $('#company_name').on('input', function () {
            validateCompanyName($(this).val());
        });

        $('#company_email').on('input', function () {
            validateEmail($(this).val());
        });

        $('#message').on('input', function () {
            validateMessage($(this).val());
        });

        $('#captcha').on('input', function () {
            validateCaptcha($(this).val());
        });

        $('#refresh').click(function () {
            Captcha(); // Regenerate Captcha
        });
    });

    // Generate Captcha
    function Captcha() {
        var alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var captcha = '';
        for (var i = 0; i < 6; i++) {
            captcha += alpha.charAt(Math.floor(Math.random() * alpha.length));
        }
        $('#mainCaptcha').text(captcha); // Display Captcha
    }

    // Validation Functions
    function validateName(name, fieldId) {
        const namePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
        if (name === '') {
            $('#' + fieldId + '_error').text('Please enter Name.');
            $('#' + fieldId).addClass('is-invalid').removeClass('is-valid');
        } else if (!namePattern.test(name)) {
            $('#' + fieldId + '_error').text('Invalid name format.');
            $('#' + fieldId).addClass('is-invalid').removeClass('is-valid');
        } else {
            $('#' + fieldId + '_error').text('');
            $('#' + fieldId).removeClass('is-invalid').addClass('is-valid');
        }
    }

    function validateCompanyName(company_name) {
        const companyNamePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
        if (company_name === '') {
            $('#company_name_error').text('Please enter company name.');
            $('#company_name').addClass('is-invalid').removeClass('is-valid');
        }
        else if (!companyNamePattern.test(company_name)) {
            $('#company_name_error').text('Invalid company name format.');
            $('#company_name').addClass('is-invalid').removeClass('is-valid');
		}
        else {
            $('#company_name_error').text('');
            $('#company_name').removeClass('is-invalid').addClass('is-valid');
        }
    }

    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            $('#company_email_error').text('Please enter email.');
            $('#company_email').addClass('is-invalid').removeClass('is-valid');
        } else if (!emailPattern.test(email)) {
            $('#company_email_error').text('Please enter a valid email address.');
            $('#company_email').addClass('is-invalid').removeClass('is-valid');
        } else {
            $('#company_email_error').text('');
            $('#company_email').removeClass('is-invalid').addClass('is-valid');
        }
    }

    function validateMessage(message) {
        if (message.trim() === '') {
            $('#message_error').text('Please enter message.');
            $('#message').addClass('is-invalid').removeClass('is-valid');
        } else {
            $('#message_error').text('');
            $('#message').removeClass('is-invalid').addClass('is-valid');
        }
    }

    function validateCaptcha(captchaValue) {
        const generatedCaptcha = $('#mainCaptcha').text().trim();
        if (captchaValue === '') {
            $('#captcha_error').text('Please enter the captcha.');
            $('#captcha').addClass('is-invalid').removeClass('is-valid');
        } else if (captchaValue !== generatedCaptcha) {
            $('#captcha_error').text('Captcha is incorrect.');
            $('#captcha').addClass('is-invalid').removeClass('is-valid');
        } else {
            $('#captcha_error').text('');
            $('#captcha').removeClass('is-invalid').addClass('is-valid');
        }
    }

    // Form Submission Validation
    function submitForm(event) {
        event.preventDefault(); // Prevent default form submission

        validateName($('#first_name').val(), 'first_name');
        validateName($('#last_name').val(), 'last_name');
        validateCompanyName($('#company_name').val());
        validateEmail($('#company_email').val());
        validateMessage($('#message').val());
        validateCaptcha($('#captcha').val());

        // Check if any field has errors
        if ($('.is-invalid').length === 0) {
            $('#contactForm')[0].submit(); // Submit form if valid
        }
        return false; // Prevent default submission
    }

</script>
<!--==================================================-->
<!-- End Consalt Contact Area  Inner Page -->
<!--==================================================-->









<!--==================================================-->
<!-- Start Consalt Scroll Up-->
<!--==================================================-->
<div class="prgoress_indicator active-progress">
	<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 212.78;"></path>
	</svg>
 </div>
<!--==================================================-->
<!-- End Consalt Scroll Up-->
<!--==================================================-->
<style>

.meta-blog p span:before {
    position: absolute;
    content: "";
    right: -26px;
    top: 10px;
    width: 10px;
    height: 10px;
    border-radius: 5px;
    background-color:rgb(255, 255, 255);
}
.single-blog-thumb img 
{
	border-radius:0px;
}

@media (min-width: 320px) and (max-width: 479px) {
    .hero-thumb {
		display:block;
    }
}
@media (min-width: 320px) and (max-width: 479px) {
    section.hero_area {
        background-size: cover;
        background-position: left;
        height: 712px;
        border-radius: 50px;
    }
}

.section_title.home_five h4::before {
    position: absolute;
    content: "";
    right: -59px;
    top: 7px;
    height: 4px;
    width: 50px;
    display: inline-block;
    background: url('<?php echo base_url();?>assets/frontend/img/home-five/sub_title-shpe.png') no-repeat;
}
.testimonial_item.style_five .testimonial-content::after {
    position: absolute;
    content: "";
    right: 22px;
    background: url('<?php echo base_url();?>assets/frontend/img/home-five/arrow.png');
    height: 50px;
    width: 62px;
    background-repeat: no-repeat;
}
section.testimonial_area.style_three {
    background: url('<?php echo base_url();?>assets/frontend/img/home_3/testi_bg.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    padding: 100px 0 15px;
    overflow: hidden;
}
section.contact_area {
    padding: 70px 0 200px;
    position: relative;
    overflow: hidden;
}
section.faq_area {
    background: #fff;
    padding: 105px 0 0px;
}
.call-do-action-info.style_two {
    border-radius: 40px;
    background-color: rgb(12 110 109);
    border: 2px solid #ffffff45;
    position: absolute;
    bottom: 10%;
    padding: 18px 40px 20px 0;
    left: 10%;
}
@media (min-width: 320px) and (max-width: 479px){
.call-do-action-info.style_two {
    border-radius: 19px;
    background-color: rgb(12 110 109);
    border: 2px solid #ffffff45;
    position: absolute;
    bottom: 6%;
    padding: 0px 20px 24px 24px;
    left: 12%;
}}
</style>

</body>