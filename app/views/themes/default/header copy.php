
<!--==================================================-->
<!-- Start Consalt Header Area-->
<!--==================================================-->
<div class="consalt-header-area upper" id="sticky-header" >
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-2 pt-10">
				<div class="header-logo">
					<a href="<?php echo base_url() .'home'; ?>"><img src="<?php echo base_url();?>assets/frontend/img/logo.png" alt="logo" style="width:184px;"></a>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="header-menu">
					<ul class="nav_scroll">
						<li><a href="#">Home</a>
							
						</li>
						<li class="mega-menu">
    <a href="#">Services <span><i class="fas fa-angle-down"></i></span></a>
    <div class="mega-menu-content">
        <!-- First Column with Image -->
        <div class="mega-menu-column">
            <img src="http://192.168.1.40/web_new_jesperapps/assets/frontend/img/home_one/service_thumb01.png" alt="Consulting Services" class="mega-menu-image" />
        </div>

        <!-- Second Column with Sub-category on Hover -->
        <div class="mega-menu-column">
            <h4>Services</h4>
            <ul>
                <li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="service-details.html">Oracle</a></li>
                            <li><a href="service-details.html">Oracle Cloud</a></li>
                            <li><a href="service-details.html">Salesforce</a></li>
                        </ul>
                    </div>
                </li>
				<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="service-details.html">Oracle</a></li>
                            <li><a href="service-details.html">Oracle Cloud</a></li>
                            <li><a href="service-details.html">Salesforce</a></li>
                        </ul>
                    </div>
                </li>
				<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="service-details.html">Oracle</a></li>
                            <li><a href="service-details.html">Oracle Cloud</a></li>
                            <li><a href="service-details.html">Salesforce</a></li>
                        </ul>
                    </div>
                </li>
				<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    
                </li>
				<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    
                </li>
				<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    
                </li>
				<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    
                </li>	<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    
                </li>	<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    
                </li>	<li class="sub-category">
                    <a href="service-details.html">Consulting Managed Services</a>
                    
                </li>
            </ul>
        </div>

        <!-- Third Column -->
        <div class="mega-menu-column">
            <h4>Digital Transformation</h4>
            <ul>
                <li><a href="service-details.html">Automation</a></li>
                <li><a href="service-details.html">Digital Strategy</a></li>
                <li><a href="service-details.html">Customer Experience</a></li>
            </ul>
        </div>
    </div>
</li>

<style>
    /* Basic styles for the mega menu container */
    .mega-menu {
        position: relative;
        display: inline-block;
    }

    /* Mega menu content: full width, 3 columns */
    .mega-menu-content {
		display: none;
    position: absolute;
    /* top: 100%; */
    left: -526px;
    width: 94vw;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    z-index: 1000;
    display: grid
;
    grid-template-columns: repeat(3, 1fr);
    gap: 36px;
    }

    /* Mega menu column styling */
    .mega-menu-column h4 {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .mega-menu-column ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mega-menu-column li {
        margin: 5px 0;
    }

    .mega-menu-column a {
        display: block;
        padding: 12px 20px;
        margin: 0;
        line-height: 1.3;
        letter-spacing: normal;
        transition: .1s;
        color: #366B2A;
        font-size: 16px;
        font-weight: 500;
    }

    .mega-menu-column a:hover {
        color: #007BFF;
    }

    /* Add image to first column */
    .mega-menu-column .mega-menu-image {
        width: 100%;
        height: auto;
        margin-bottom: 15px;
    }

    /* Show mega menu when hovering over the Services link */
    .mega-menu:hover .mega-menu-content {
        display: grid;
    }

    /* Styling for the main link */
    .mega-menu a {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #333;
        text-decoration: none;
        position: relative;
    }

    .mega-menu a:hover {
        color: #007BFF;
    }

    /* Optional: Add transition for smooth effect */
    .mega-menu-content {
        transition: opacity 0.3s ease;
        opacity: 0;
        visibility: hidden;
    }

    .mega-menu:hover .mega-menu-content {
        opacity: 1;
        visibility: visible;
    }

    /* Sub-menu styles for the second column */
    .sub-category {
        position: relative;
    }

    .sub-category:hover .sub-menu {
        display: block;
    }

    .sub-menu {
        display: none;
        position: absolute;
        top: 0;
        left: 100%; /* Position the sub-menu to the right of the list item */
        background-color: #f8f8f8;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 200px;
        padding: 10px;
    }

    .sub-menu ul {
        list-style: none;
        padding: 0;
        position: absolute;
    left: 69px;

    }

    .sub-menu a {
        padding: 8px 12px;
        color: #333;
        font-size: 14px;
    }

    .sub-menu a:hover {
        background-color: #007BFF;
        color: #fff;
    }

    /* Responsive Styles */

    /* For tablets and smaller devices (screens below 1024px) */
    @media (max-width: 1024px) {
        .mega-menu-content {
            grid-template-columns: repeat(2, 1fr); /* 2 columns instead of 3 */
        }
    }

    /* For mobile devices (screens below 768px) */
    @media (max-width: 768px) {
        .mega-menu-content {
            grid-template-columns: 1fr; /* Stack the columns vertically */
            padding: 10px; /* Reduce padding on small screens */
        }

        .mega-menu a {
            padding: 10px; /* Adjust padding for the menu links */
            font-size: 14px; /* Adjust font size for mobile */
        }

        .mega-menu-column h4 {
            font-size: 16px; /* Smaller header size for mobile */
        }
    }

    /* Ensure the background remains white on mobile */
    .mega-menu-content {
        background-color: #fff; /* Keep background white */
    }
</style>

						<li><a href="#">Industries <span><i class="fas fa-angle-down"></i></span></a>
							<ul class="sub_menu">
								<li><a href="about-us">About Us</a></li>
								<li><a href="service.html">Our Service</a></li>
								<li><a href="service-details.html">Service Details</a></li>
								<li><a href="team.html">Our Team</a></li>
								<li><a href="pricing.html">Pricing</a></li>								
								<li><a href="portfolio.html">Portfolio</a></li>
								<li><a href="protfolio-details.html">Portfolio Details</a></li>
								<li><a href="404.html">Error Page</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</li>
						<li><a href="<?php echo base_url() .'products.html'; ?>">Products</a>
							
						</li>
						<li><a href="#">Knowledge center <span><i class="fas fa-angle-down"></i></span></a>
							<ul class="sub_menu">
								<li><a href="<?php echo base_url() .'news'; ?>">news</a></li>
								<li><a href="about-us">About Us</a></li>
								<li><a href="service.html">careers</a></li>
								<li><a href="service-details.html">Location</a></li>
								<li><a href="team.html">Case Studies</a></li>
								<li><a href="pricing.html">Contact Us</a></li>								
								<li><a href="portfolio.html">Vission & Mission</a></li>
								<li><a href="protfolio-details.html">Whitepapers</a></li>
								<li><a href="404.html">success story
								</a></li>
							</ul>
						</li>
					</ul>					
				</div>
			</div>
			<div class="col-lg-2 pt-10">
				<div class="header-button">
					<a href="<?php echo base_url() .'contact-us'; ?>">Get A Quote <i class="bi bi-arrow-right"></i></a>
				</div>			
				<div class="sidebar-btn">
					<div class="nav-btn navSidebar-button"><span><i class="bi bi-filter-left"></i></span></div>							
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
				<li><a href="#">Home</a>
					
				</li>
				<li><a href="about.html">About</a></li>
				<li><a href="#">Service</a>
					<ul class="sub_menu">
						<li><a href="service.html">Our Service</a></li>
						<li><a href="service-details.html">Service Details</a></li>
					</ul>
				</li>
				<li><a href="#">Page</a>
					<ul class="sub_menu">
						<li><a href="about.html">About Us</a></li>
						<li><a href="service.html">Our Service</a></li>
						<li><a href="service-details.html">Service Details</a></li>
						<li><a href="team.html">Our Team</a></li>
						<li><a href="pricing.html">Pricing</a></li>						
						<li><a href="portfolio.html">Portfolio</a></li>
						<li><a href="protfolio-details.html">Portfolio Details</a></li>
						<li><a href="404.html">Error Page</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</li>
				<li><a href="#">Portfolio</a>
					<ul class="sub_menu">
						<li><a href="portfolio.html">Portfolio</a></li>
						<li><a href="protfolio-details.html">Portfolio Details</a></li>
					</ul>
				</li>
				<li><a href="#">Blog</a>
					<ul class="sub_menu">
						<li><a href="blog-grid.html">Blog</a></li>
						<li><a href="blog-details.html">Blog Details</a></li>
					</ul>
				</li>
				<li><a href="contact.html">Contact</a></li>
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
				<a href="#" class="close-side-widget">
					<i class="far fa-times-circle"></i>
				</a>
			</div>
			<div class="sidebar-textwidget">
				<!-- Sidebar Info Content -->
				<div class="sidebar-info-contents">
					<div class="content-inner">
						<div class="nav-logo">
							<a href="index.html"><img src="<?php echo base_url();?>assets/frontend/img/logo.png" alt="sid img" style="width:184px;"></a>
						</div>
						<div class="row padding-two">
							<div class="col-lg-6">
								<div class="content-thumb-box">
									<img src="assets/images/home_one/team.jpg" alt="">
								</div>
							</div>
							<div class="col-lg-6 ">
								<div class="content-thumb-box">
									<img src="assets/images/home_one/team1.jpg" alt="">
								</div>
							</div>
							<div class="col-lg-6 ">
								<div class="content-thumb-box">
									<img src="assets/images/home_one/team2.jpg" alt="">
								</div>
							</div>
							<div class="col-lg-6 ">
								<div class="content-thumb-box">
									<img src="assets/images/home_one/team.jpg" alt="">
								</div>
							</div>
						</div>
						<div class="contact-info">
							<h2>Contact Info</h2>
							<ul class="list-style-one">
								<li><i class="bi bi-envelope"></i>Chicago 12, Melborne City, USA</li>
								<li><i class="bi bi-envelope"></i>(+001) 123-456-7890</li>
								<li><i class="bi bi-envelope"></i>Example.com</li>
								<li><i class="bi bi-envelope"></i>Week Days: 09.00 to 18.00 Sunday: Closed</li>
							</ul>
						</div>
						<!-- Social Box -->
						<ul class="social-box">
							<li class="facebook"><a href="#" class="fab fa-facebook-f"></a></li>
							<li class="twitter"><a href="#" class="fab fa-instagram"></a></li>
							<li class="linkedin"><a href="#" class="fab fa-twitter"></a></li>
							<li class="instagram"><a href="#" class="fab fa-pinterest-p"></a></li>
							<li class="youtube"><a href="#" class="fab fa-linkedin-in"></a></li>
						</ul>
					</div>
				</div>		
			</div>
		</div>
	</div>
</div>