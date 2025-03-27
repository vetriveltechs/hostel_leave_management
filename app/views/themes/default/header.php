<header>
    <?php
    $getIndustriesList    = $this->industries_model->getIndustriesList();
    ?>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-transparent --bg-transparent header-reverse" data-header-hover="light" style="background-color: rgba(0, 0, 0, 0.09);">
        <!-- <nav class="navbar navbar-expand-lg header-transparent bg-transparent header-reverse" data-header-hover="light"> -->
        <div class="container-fluid">
            <div class="col-auto col-xxl-3 col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="<?php echo base_url() . 'home'; ?>">
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
                        <li class="nav-item"><a href="<?php echo base_url() . 'home'; ?>" class="nav-link">Home</a></li>
                        <script>
    function showTab(tabId) {
        document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('show', 'active'));
        document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
        document.getElementById(tabId).classList.add('show', 'active');
        document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
    }

    function showDropdown() {
        document.getElementById('servicesDropdown').style.display = 'block';
    }

    function hideDropdown() {
        document.getElementById('servicesDropdown').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        showTab('tab-one'); // Set tab-one as active on page load
    });
</script>

<li class="nav-item dropdown submenu hide-on-mobile" onmouseover="showDropdown()" onmouseout="hideDropdown()">
    <a href="javascript:void(0);" class="nav-link">Services</a>
    <i class="fa-solid fa-angle-down dropdown-toggle"></i>

    <div class="dropdown-menu submenu-content w-100" id="servicesDropdown" style="background-color:white; display: none;">
        <div class="container-fluid">
            <div class="d-lg-flex mega-menu flex-column w-100">
                <section class="--bg-solitude-blue pt-0">
                    <div class="row align-items-center">

                        <div class="col-xl-3 col-lg-4 col-md-12 tab-style-02 md-mb-30px sm-mb-20px">
                            <ul class="nav nav-tabs justify-content-center border-0 text-left fw-500 fs-18 alt-font" style="padding: 0 !important;" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation" onmouseover="showTab('tab-one')">
                                    <button class="nav-link text-dark" data-tab="tab-one" style="color:black !important; background: none; border: none; padding: 10px; cursor: pointer;" id="tab-one-tab" type="button" role="tab">
                                        Consulting Managed Services <i class="fa-solid fa-arrow-right ms-1" style="font-size:18px;"></i>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation" onmouseover="showTab('tab-two')">
                                    <button class="nav-link text-dark" data-tab="tab-two" style="color:black !important; background: none; border: none; padding: 10px; cursor: pointer;" id="tab-two-tab" type="button" role="tab">
                                        Cloud Services <i class="fa-solid fa-arrow-right ms-1" style="font-size:18px;"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="col-xl-4 col-lg-8 col-md-12">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade" id="tab-one" role="tabpanel">
                                    <ul class="list-unstyled">
                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                            <a href="services-details/consulting-managed-services/oracle" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                Oracle
                                            </a>
                                        </li>
                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                            <a href="services-details/consulting-managed-services/oracle-cloud" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                Oracle Cloud
                                            </a>
                                        </li>
                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                            <a href="services-details/consulting-managed-services/salesforce" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                Salesforce
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="tab-two" role="tabpanel">
                                    <ul class="list-unstyled">
                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                            <a href="services-details/cloud-services/aws" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                AWS
                                            </a>
                                        </li>
                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                            <a href="services-details/cloud-services/azure" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                Azure
                                            </a>
                                        </li>
                                        <li class="border-bottom border-color-extra-medium-gray py-2">
                                            <a href="services-details/cloud-services/google-cloud" class="d-flex align-items-center text-dark fs-18 alt-font">
                                                Google Cloud
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

<li class="nav-item dropdown d-block d-lg-none">
                            <span class="nav-link <?php echo ($segment_1 === 'service' || $segment_1 === 'services-details') ? 'header1_active_back_ground_color' : 'header1_back_ground_color'; ?>">Services</span>
                            <i class="fa-solid fa-angle-down dropdown-toggle service-toggle"></i>
                            <?php
                            if (count($getCategoryListing) > 0) {
                            ?>
                                <ul class="dropdown-menu service-menu">
                                    <?php
                                    foreach ($getCategoryListing as $categoryListing) {
                                        $category_level1_id = $categoryListing['cat_level_1'];
                                        $getSubCategory = $this->categories_model->getSubCategory($category_level1_id);

                                        if ($categoryListing['cat_level_2'] !== NULL && $categoryListing['cat_level_2'] != 0) {
                                            $mainLink  = "javascript:void(0);";

                                            $toggle_menu = "toggle-menu";
                                        } else {
                                            $mainLink  = base_url() . 'services-detail/' . strtolower($categoryListing['list_code']);
                                            $toggle_menu = "";
                                        }
                                    ?>
                                        <li class="dropdown-submenu">
                                            <a href="<?php echo $mainLink; ?>" class="--dropdown-item dropdown-item-font <?php echo $toggle_menu; ?> <?php echo ($segment_2 === strtolower($categoryListing['list_code'])) ? 'header1_sub_links_active_back_ground_color' : 'header1_sub_links_back_ground_color'; ?>">
                                                <?php echo ucfirst($categoryListing['list_value']); ?>
                                                <?php
                                                if ($categoryListing['cat_level_2'] !== NULL && $categoryListing['cat_level_2'] != 0) {
                                                ?>
                                                    <i class="fa-solid fa-angle-down dropdown-icon"></i> <!-- Arrow Icon -->
                                                <?php
                                                }
                                                ?>

                                            </a>

                                            <?php
                                            if (count($getSubCategory) > 0) {
                                            ?>
                                                <ul class="dropdown-menu about-menu">
                                                    <?php foreach ($getSubCategory as $subCategory) {
                                                        if ($subCategory['list_code_2'] == 'AI-AGENTS') {
                                                            $subLink = "https://www.jesperx.ai/";
                                                        } else {
                                                            $subLink = base_url() . 'services-details/' . strtolower($subCategory['list_code_1']) . '/' . strtolower($subCategory['list_code_2']);
                                                        }
                                                    ?>
                                                        <li>
                                                            <a href="<?php echo $subLink; ?>" class="--dropdown-item dropdown-item-font sub_drop_down_tag <?php echo ($segment_3 === strtolower($subCategory['list_code_2'])) ? 'header1_sec_sub_links_active_back_ground_color' : 'header1_sec_sub_links_back_ground_color'; ?>"><?php echo $subCategory['list_value']; ?></a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            <?php
                                            }
                                            ?>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            <?php
                            }
                            ?>

                            <?php
                            ?>

                        </li>
                        <li class="nav-item dropdown submenu hide-on-mobile" id="industriesDropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false">Industries</a>
                            <div class="dropdown-menu submenu-content w-100" aria-labelledby="navbarDropdownMenuLink2" style="background-color:white;">
                                <div class="container-fluid">
                                    <div class="d-lg-flex mega-menu flex-column w-100">
                                        <section class="--bg-solitude-blue pt-0">
                                            <div class="row align-items-center">
                                                <!-- Left Section -->
                                                <div class="col-xl-7 col-lg-8 col-md-12 --tab-style-02 --md-mb-30px --sm-mb-20px" style="padding: 0 !important; color:black;">
                                                    <ul class="nav flex-wrap d-flex" id="myTab" role="tablist" style="padding: 0 !important;">
                                                        <?php if (isset($getIndustriesList) && count($getIndustriesList) > 0) { ?>
                                                            <?php foreach ($getIndustriesList as $industriesList) { ?>
                                                                <li class="nav-item col-4 mb-2">
                                                                    <a href="<?php echo base_url() . 'industries-details/' . $industriesList['industries_url']; ?>" class="nav-link text-center text-dark">
                                                                        <?php echo $industriesList['industries_name']; ?>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <li class="nav-item text-center w-100">No industries available</li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>

                                                <!-- Right Section -->
                                                <div class="col-xl-5 col-lg-4 col-md-12 d-flex flex-column align-items-start border-start ps-3 border-color-extra-medium-gray">
                                                    <h5 class="fw-bold">Industries</h5>
                                                    <p>We drive innovation across industries, from Food & Beverage to Oil & Gas, providing tailored solutions that enhance quality, sustainability, and growth.</p>
                                                    <span class="fs-20 text-dark-gray fw-500 ls-minus-05px pt-4">
                                                        <a href="<?php echo base_url() . 'industry'; ?>" class="fw-600 text-dark pt-2">Explore all Industries <i class="fa-solid fa-arrow-right ms-2 icon-very-small"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-with-icon-style02 d-block d-lg-none">
                            <a href="javascript:void(0)" class="nav-link <?php echo ($segment_1 === 'industry' || $segment_1 === 'industries-details') ? 'header1_mobile_active_back_ground_color' : 'header1_mobile_back_ground_color'; ?>">Industries</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php
                                foreach ($getIndustriesList as $industriesList) {
                                ?>
                                    <li><a href="<?php echo base_url(); ?>industries-details/<?php echo $industriesList['industries_url']; ?>" class="<?php echo ($segment_2 === $industriesList['industries_url']) ? 'industry_mobile_menu_active_back_ground_color' : 'industry_mobile_menu_back_ground_color'; ?>"><?php echo ucfirst($industriesList['industries_name']); ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown dropdown-with-icon-style02" id="knowledgeDropdown">
                                <a href="demo-business-services.html" class="nav-link">Products</a>
                                <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a href="<?php echo base_url(); ?>about-us"><i class="bi bi-briefcase"></i> About Udsds</a></li>
                                    <li><a href="<?php echo base_url(); ?>blog/all"><i class="bi bi-clipboard-data"></i> Blog</a></li>
                                    <li><a href="<?php echo base_url(); ?>case-studies/all"><i class="bi bi-peace"></i> Case Studies</a></li>
                                   
                                </ul>
                        </li>
                        <li class="nav-item dropdown dropdown-with-icon-style02" id="knowledgeDropdown">
                                <a href="demo-business-services.html" class="nav-link">Knowledge Center</a>
                                <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a href="<?php echo base_url(); ?>about-us"><i class="bi bi-briefcase"></i> About Us</a></li>
                                    <li><a href="<?php echo base_url(); ?>blog/all"><i class="bi bi-clipboard-data"></i> Blog</a></li>
                                    <li><a href="<?php echo base_url(); ?>case-studies/all"><i class="bi bi-peace"></i> Case Studies</a></li>
                                    <li><a href="<?php echo base_url(); ?>events"><i class="bi bi-bar-chart-line"></i> Events</a></li>
                                    <li><a href="<?php echo base_url(); ?>careers"><i class="bi bi-send-check"></i> Careers</a></li>
                                    <li><a href="<?php echo base_url(); ?>news"><i class="bi bi-globe2"></i> News</a></li>
                                    <li><a href="<?php echo base_url(); ?>contact-us"><i class="bi bi-globe2"></i> Contact Us</a></li>
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
        width: 22px !important;
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

    .dropdown-menu {
        display: none;
        padding-left: 10px;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-toggle {
        cursor: pointer;
        margin-left: 10px;
    }
    i.fa-solid.fa-angle-down.dropdown-toggle.about-toggle {
    top: 30px;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownMenus = document.querySelectorAll('.nav-item.dropdown');

        dropdownMenus.forEach(menu => {
            const dropdownToggle = menu.querySelector('.dropdown-toggle');
            const dropdownMenu = menu.querySelector('.dropdown-menu');

            if (dropdownToggle && dropdownMenu) {
                // Show dropdown on hover
                menu.addEventListener('mouseenter', function () {
                    dropdownMenu.classList.add('show');
                });

                // Hide dropdown when mouse leaves
                menu.addEventListener('mouseleave', function () {
                    dropdownMenu.classList.remove('show');
                });
            }
        });
    });
</script>