  <!-- start header -->
        <header> 
            <!-- start navigation -->
            <nav class="navbar navbar-expand-lg header-transparent --bg-transparent header-reverse glass-effect bg-black" data-header-hover="light" style=" background-color:bisque;">
                <div class="container-fluid bg-black" >
                    <div class="col-auto col-lg-2 me-lg-0 me-auto">
                    <a class="navbar-brand" href="<?php echo base_url() .'home'; ?>">
                            <img src="<?php echo base_url();?>assets/frontend/img/aideanex-logo-white.png" data-at2x="<?php echo base_url();?>assets/frontend/img/aideanex-logo-white.png" alt="" class="default-logo">
                            <img src="<?php echo base_url();?>assets/frontend/img/aideanex-logo-white.png" data-at2x="<?php echo base_url();?>assets/frontend/img/aideanex-logo-white.png" alt="" class="alt-logo">
                            <img src="<?php echo base_url();?>assets/frontend/img/aideanex-logo-white.png" data-at2x="<?php echo base_url();?>assets/frontend/img/aideanex-logo-white.png" alt="" class="mobile-logo"> 
                        </a>
                    </div>
                    <div class="col-auto menu-order position-static">
                        <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav"> 
                            <ul class="navbar-nav alt-font"> 
                                <li class="nav-item"><a href="<?php echo base_url() .'home'; ?>" class="nav-link">Home</a></li>
                                <li class="nav-item"><a href="<?php echo base_url() .'about-us'; ?>" class="nav-link">About Us</a></li>
                                <li class="nav-item dropdown dropdown-with-icon">
                                    <a href="javascript:void(0)" class="nav-link">Services</a>
                                    <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li>
                                            <a href="<?php echo base_url() .'digital-marketing.html'; ?>"><img src="<?php echo base_url() . 'assets/frontend/img/dm.png'; ?>" alt="Digital Marketing" style="width:30px; height:30px;">

                                                <div class="submenu-icon-content">
                                                    <span>Digital Marketing</span>
                                                    <!-- <p>Research and strategy</p> -->
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() .'mobile-app-developement.html'; ?>"><img src="<?php echo base_url() . 'assets/frontend/img/ma.png'; ?>" alt="Mobile App Development" style="width:30px; height:30px;">
                                                <div class="submenu-icon-content">
                                                    <span>Mobile App Development</span>
                                                    <!-- <p>Development and scale</p> -->
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() .'website-developement.html'; ?>"><img src="<?php echo base_url() . 'assets/frontend/img/wa.png'; ?>" alt="Website Development" style="width:30px; height:30px;">
                                                <div class="submenu-icon-content">
                                                    <span>Website Development</span>
                                                    <!-- <p>Testing and evaluation</p> -->
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() .'web-app-developement.html'; ?>"><img src="<?php echo base_url() . 'assets/frontend/img/wb.png'; ?>" alt="Web App Development" style="width:30px; height:30px;">
                                                <div class="submenu-icon-content">
                                                    <span>Web App Development</span>
                                                    <!-- <p>Research and strategy</p> -->
                                                </div>
                                            </a>
                                        </li>
                                        <?php /*
                                        <li>
                                            <a href="<?php echo base_url() .'crm.html'; ?>"><i class="fas fa-user-cog"></i>
                                                <div class="submenu-icon-content">
                                                    <span>CRM</span>
                                                    <!-- <p>Research and strategy</p> -->
                                                </div>
                                            </a>
                                        </li>
                                        */ ?>
                                    </ul>

                                </li>
                                <li class="nav-item"><a href="<?php echo base_url() .'careers'; ?>" class="nav-link">Careers</a></li>
                                <li class="nav-item"><a href="<?php echo base_url() .'blog/all'; ?>" class="nav-link">Blog</a></li>
                                <li class="nav-item"><a href="<?php echo base_url() .'contact-us'; ?>" class="nav-link">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto col-lg-2 text-end md-pe-0">
                        <div class="header-icon">
                            <div class="header-search-icon icon">
                                <!-- <a href="#" class="search-form-icon header-search-form" aria-label="search"><i class="feather icon-feather-search"></i></a> -->
                                <!-- start search input -->
                                <div class="search-form-wrapper">
                                    <button title="Close" type="button" class="search-close alt-font">×</button>
                                    <form id="search-form" role="search" method="get" class="search-form text-left" action="search-result.html">
                                        <div class="search-form-box">
                                            <h2 class="text-dark-gray fw-700 ls-minus-1px text-center mb-4 alt-font">What are you looking for?</h2>
                                            <input class="search-input alt-font" id="search-form-input5e219ef164995" placeholder="Enter your keywords..." name="s" value="" type="text" autocomplete="off">
                                            <button type="submit" class="search-button">
                                                <i class="feather icon-feather-search" aria-hidden="true"></i> 
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- end search input -->
                            </div>
                            <div class="header-push-button icon">
                                <div class="push-button">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span> 
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </nav>
            <!-- end navigation -->
            <!-- start push popup -->
            <div class="push-menu push-menu-style-2 ps-50px pe-50px pt-4 pb-4 bg-white" style="background-color:white">
                <div class="left-circle bg-gradient-emerald-blue-emerald-green"></div>
                <span class="close-menu text-white bg-dark-gray"><i class="fa-solid fa-xmark"></i></span>
                <div class="push-menu-wrapper" data-scroll-options='{ "theme": "dark" }'>
                    <div class="push-menu-header pt-10 pb-30 mb-30 d-block">
                        <!-- <h4 class="alt-font fw-500 text-white lh-42">Scalable business for <span class="text-decoration-line-bottom-medium fw-700">startups</span></h4> -->
                        <h4 class="alt-font fw-500 text-white lh-42"><?php echo SITE_NAME; ?></h4>
                    </div>
                    <div class="push-menu-address pt-30 lg-pt-10">
                        <div class="icon-with-text-style-01 mb-15px">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                                <div class="feature-box-icon me-15px">
                                    <i class="feather icon-feather-map-pin text-dark-gray lh-inherit"></i>
                                </div>
                                <div class="feature-box-content"> 
                                    <p class="w-90 lh-26"><?php echo ADDRESS1; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="icon-with-text-style-01 mb-15px">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                                <div class="feature-box-icon me-15px">
                                    <i class="feather icon-feather-mail text-dark-gray lh-inherit"></i>
                                </div>
                                <div class="feature-box-content"> 
                                    <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="icon-with-text-style-01">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                                <div class="feature-box-icon me-15px">
                                    <i class="feather icon-feather-phone-call text-dark-gray lh-inherit"></i>
                                </div>
                                <div class="feature-box-content"> 
                                    <a href="tel:<?php echo PHONE1; ?>"><?php echo PHONE1; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="separator-line-1px w-100 bg-extra-medium-gray d-block mt-30px mb-30px"></div>
                    </div>
                    <div class="push-menu-social last-paragraph-no-margin">
                        <div class="elements-social social-text-style-01">
                            <ul class="medium-icon dark fw-500">
                                <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a class="twitter" href="https://x.com/aideanex" target="_blank"><i class="fa-brands fa-twitter"></i></a></li> 
                                <li><a class="instagram" href="https://www.instagram.com/aideanex/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li> 
                                <li><a class="linkedin" href="https://www.linkedin.com/company/aideanex" target="_blank"><i class="fa fa-linkedin"></i></a></li> 
                            </ul>
                        </div>
                        <?php /*
                            <p class="fs-14">&COPY; Copyright 2024 <a href="<?php echo base_url() .'home'; ?>" target="_blank">Crafto</a></p>
                        */ ?>
                    </div>
                </div>
            </div>
            <!-- end push popup -->
        </header>
        <!-- end header -->
         <style>
            
header.sticky.sticky-active [data-header-hover=light] .navbar-nav .nav-link {
    color: #ffffff;
}
.navbar-toggler-line {
    background: #f3f7ff;
}
@media (max-width: 767px) { /* Adjust this width based on when you want it to be white */
    header.sticky.sticky-active [data-header-hover=light] .navbar-nav .nav-link {
        color: black !important;
    }
}
.header-push-button {
    color:beige;
}
header.sticky.sticky-active [data-header-hover=light] .icon .push-button span {
    background-color: #ffffff;
}

         </style>
           <style>
            .push-menu .close-menu {
    height: 40px;
    width: 40px;
    text-align: center;
    position: absolute;
    right: 25px;
    top: 29px;
    z-index: 9;
    display: flex
;
    border-radius: 100%;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
}
         </style>