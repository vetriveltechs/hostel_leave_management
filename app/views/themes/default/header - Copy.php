<header>
    <?php 
	    $getIndustriesList	= $this->industries_model->getIndustriesList();
    ?>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-transparent --bg-transparent header-reverse" data-header-hover="light" style="background-color: rgba(0, 0, 0, 0.09);">
        <!-- <nav class="navbar navbar-expand-lg header-transparent bg-transparent header-reverse" data-header-hover="light"> -->
        <div class="container-fluid">
            <div class="col-auto col-xxl-3 col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="<?php echo base_url() .'home'; ?>">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/j-logo.png" data-at2x="<?php echo base_url(); ?>assets/frontend/img/j-logo.png" alt="" class="default-logo">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/j-logo.png" data-at2x="<?php echo base_url(); ?>assets/frontend/img/j-logo.png" alt="" class="alt-logo">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/j-logo.png" data-at2x="<?php echo base_url(); ?>assets/frontend/img/j-logo.png" alt="" class="mobile-logo">
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
                        <li class="nav-item dropdown submenu hide-on-mobile ">
                            <a href="javscript:void(0);" class="nav-link">Services</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>

                            <div class="dropdown-menu submenu-content w-100" aria-labelledby="navbarDropdownMenuLink2" style="background-color:white;">
                                <div class="container-fluid">
                                    <div class="d-lg-flex mega-menu flex-column w-100">
                                        <section class="--bg-solitude-blue pt-0">
                                            <div class="row align-items-center">

                                            <div class="col-xl-3 col-lg-4 col-md-12  tab-style-02 md-mb-30px sm-mb-20px">
                                            <!-- Start tab navigation -->
                                                <ul class="nav nav-tabs --justify-content-center border-0 text-left fw-500 fs-18 alt-font" style="padding: 0 0px 0 0 !important;" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        
                                                        <a class="nav-link text-dark" style="color:black!important;opacity:0px;" id="tab-four1-tab" data-bs-toggle="tab" href="#tab-four1" role="tab" aria-controls="tab-four1" aria-selected="true">
                                                            Consulting Managed Services<i class="fa-solid fa-arrow-right ms-5px " style="font-size:18px;"></i>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>

                                        <div class="col-xl-4 col-lg-8 col-md-12">
                                            <div class="tab-content w-100" id="myTabContent">
                                                <div class="tab-pane fade show " id="tab-four1" role="tabpanel" aria-labelledby="tab-four1-tab">
                                                    <ul class="list-unstyled">
                                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                                            <a href="<?php echo base_url(); ?>services-details/consulting-managed-services/oracle" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                                Oracle
                                                            </a>
                                                        </li>
                                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                                            <a href="<?php echo base_url(); ?>services-details/consulting-managed-services/oracle-cloud" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                                Oracle Cloud
                                                            </a>
                                                        </li>
                                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                                            <a href="<?php echo base_url(); ?>services-details/consulting-managed-services/salesforce" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                                Salesforce
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                

                                                
                                            </div>
                                        </div>

                                                <div class="col-xl-5 col-lg-8 col-md-12 d-flex flex-column align-items-start border-start ps-3 border-color-extra-medium-gray">
                                                    <h5>Our Services</h5>
                                                    <p>Discover solutions crafted for your industry’s unique requirements. Our offerings simplify operations, enhance efficiency, and fuel growth, enabling your business to excel in a competitive market.</p>
                                                </div>

                                            </div>
                                        </section>
                                    </div>
                                </div>

                            </div>
                        </li>
                       <li class="nav-item dropdown dropdown-with-icon-style02 d-block d-lg-none">
                                <a href="demo-business-services.html" class="nav-link">Services</a>
                                <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> 
                                    <li class="dropdown-submenu">
                                        <a href="<?php echo base_url(); ?>about-us" class="dropdown-item">About Us</a>
                                        
                                    </li>
                                </ul>
                            </li>

                        <li class="nav-item dropdown submenu hide-on-mobile ">
                            <a href="javascript:void(0)" class="nav-link">Industires</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <div class="dropdown-menu submenu-content w-100" aria-labelledby="navbarDropdownMenuLink2" style="background-color:white;">
                                <div class="container-fluid">
                                    <div class="d-lg-flex mega-menu flex-column w-100">
                                        <section class="--bg-solitude-blue pt-0">
                                            <div class="row align-items-center">

                                            <div class="col-xl-7 col-lg-8 col-md-12 --tab-style-02 --md-mb-30px --sm-mb-20px" style="padding: 0 0px 0 0 !important;color:black;">
                                                <!-- Start tab navigation -->
                                                <?php 
                                                    if(count($getIndustriesList)>0)
                                                    {
                                                        ?>
                                                            <ul class="nav flex-wrap d-flex" style="padding: 0 !important;" id="myTab" role="tablist">
                                                                <?php 
                                                                    foreach ($getIndustriesList as $industriesList) 
                                                                    {
                                                                        ?>
                                                                            <li class="nav-item col-4 mb-2">
                                                                                <a href="<?php echo base_url() .'industries-details/'.$industriesList['industries_url']; ?>" class="nav-link text-center" style="color: black !important;" --id="tab-four1-tab" --data-bs-toggle="tab" --role="tab" --aria-controls="tab-four1" --aria-selected="true">
                                                                                    <?php echo $industriesList['industries_name']; ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                
                                                            </ul>
                                                        <?php
                                                    }
                                                ?>
                                                
                                                
                                            </div>


                                   
                                                <div class="col-xl-5 col-lg-4 col-md-12 d-flex flex-column align-items-start border-start ps-3 border-color-extra-medium-gray">
                                                    <h5>Industries</h5>
                                                    <p>We drive innovation across industries, from Food & Beverage to Oil & Gas, providing tailored solutions that enhance quality, sustainability, and growth. By leveraging the latest technologies, we empower businesses to stay ahead in an ever-evolving world.</p>
                                                    <span class="fs-20 text-dark-gray fw-500 ls-minus-05px pt-4">We specialize in providing tailored solutions to industries such as <a href="<?php echo base_url() .'industry'; ?>" class="fw-600 text-dark pt-2">Explore all Industries<i class="fa-solid fa-arrow-right ms-5px icon-very-small"></i></a></span>

                                                </div>

                                            </div>
                                        </section>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-with-icon-style02 d-block d-lg-none">
                            <a href="demo-business-services.html" class="nav-link">Industries</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> 
                                <li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
                         
                            </ul>
                        </li>

                        <li class="nav-item"><a href="<?php echo base_url() .'products'; ?>" class="nav-link">Products</a></li>

                        <li class="nav-item dropdown dropdown-with-icon-style02">
                                    <a href="demo-business-services.html" class="nav-link">Knowledge center</a>
                                    <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> 
                                        <li><a href="<?php echo base_url(); ?>about-us"><i class="bi bi-briefcase"></i>About Us</a></li>
                                        <li><a href="<?php echo base_url(); ?>blog/all"><i class="bi bi-clipboard-data"></i>Blog</a></li>
                                        <li><a href="<?php echo base_url(); ?>success-story/all"><i class="bi bi-peace"></i>Case Studies</a></li>
                                        <li><a href="<?php echo base_url(); ?>events"><i class="bi bi-bar-chart-line"></i>Events</a></li>
                                        <li><a href="<?php echo base_url(); ?>careers"><i class="bi bi-send-check"></i>Careers</a></li>
                                        <li><a href="<?php echo base_url(); ?>news"><i class="bi bi-globe2"></i>News</a></li>
                                        <!-- <li><a href="<?php echo base_url(); ?>success-stories"><i class="bi bi-globe2"></i>Success Story</a></li> -->
                                        <li><a href="<?php echo base_url(); ?>contact-us"><i class="bi bi-globe2"></i>Contact Us</a></li>

                                    </ul>
                                </li>
                     


                    </ul>
                </div>
            </div>
            <div class="col-auto col-xxl-3 col-lg-2 text-end d-none d-sm-flex">
                <div class="header-icon">
                    <div class="d-none d-xxl-inline-block me-25px xxl-me-10px">
                        <div class="alt-font fs-15 xl-fs-13 widget-text fw-500"><span class="w-35px h-35px bg-base-color d-inline-block lh-36 me-10px border-radius-100px"><i class="feather icon-feather-phone me-10px"></i></span><a href="tel:+91 9900017401" class="widget-text text-white-hover">+91 9900017401</a></div>
                    </div>
                    <div class="header-button"><a href="demo-business-contact.html" class="btn btn-very-small btn-transparent-white-light btn-rounded">Get a quote</a></div>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<style>
    header .navbar-brand img {
        max-height: 40px;
    }

    span.te {
        color: black;
        font-size: 18px;
    }

    .bg-base-color {
        background-color: #2bab22;
    }
    header.sticky.sticky-active [data-header-hover=light] a.btn.btn-very-small.btn-transparent-white-light.btn-rounded {
    /* background: rgb(40 170 43); */
    background-color: #2aaa26;
    border-radius: 4px;
}
.navbar .navbar-nav .dropdown .dropdown-menu a i {
    width: 22px!important;
    display: inline-block;
    vertical-align: middle;
    margin-right: 7px;
    text-align: center;
}
/* Initially, show the menu (default behavior for desktop) */


/* Media query to hide on mobile screens (width < 768px) */
@media (max-width: 991px) {
    .hide-on-mobile {
        display: none !important;
    }
}


</style>