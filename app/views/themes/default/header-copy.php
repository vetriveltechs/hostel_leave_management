<header>
    <?php
    $getCategoryListing = $this->categories_model->getCategoryListing();

    $getIndustriesList    = $this->industries_model->getIndustriesList();

    $segment_1 = $this->uri->segment(1);

    $segment_2 = $this->uri->segment(2);

    $segment_3 = $this->uri->segment(3);

    ?>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-transparent --bg-transparent header-reverse mobile-header1" data-header-hover="light" style="background-color: rgba(0, 0, 0, 0.09);;">
        <!-- <nav class="navbar navbar-expand-lg header-transparent bg-transparent header-reverse" data-header-hover="light"> -->
        <div class="container-fluid">
            <div class="col-auto col-xxl-3 col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/j-logo.png" data-at2x="<?php echo base_url(); ?>assets/frontend/img/jesper/j-logo.png" alt="" class="default-logo">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/j-logo.png" data-at2x="<?php echo base_url(); ?>assets/frontend/img/jesper/j-logo.png" alt="" class="alt-logo">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/j-logo.png" data-at2x="<?php echo base_url(); ?>assets/frontend/img/jesper/j-logo.png" alt="" class="mobile-logo">
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
                        <li class="nav-item"><a href="<?php echo base_url(); ?>" class="nav-link header1_links <?php echo ($segment_1 == '' || $segment_1 === 'home') ? 'header1_active_back_ground_color' : 'header1_back_ground_color'; ?>">Home</a></li>
                        <li class="nav-item dropdown submenu hide-on-mobile ">
                            <a href="javascript:void(0)" class="nav-link header1_links <?php echo ($segment_1 === 'service' || $segment_1 === 'services-details') ? 'header1_active_back_ground_color' : 'header1_back_ground_color'; ?>">Services</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>

                            <div class="dropdown-menu submenu-content w-100" aria-labelledby="navbarDropdownMenuLink2" style="background-color:white;">
                                <div class="container-fluid">
                                    <div class="d-lg-flex mega-menu flex-column w-100">
                                        <section class="--bg-solitude-blue pt-0">
                                            <div class="row align-items-center">

                                                <div class="col-xl-3 col-lg-4 col-md-12  tab-style-02 md-mb-30px sm-mb-20px">
                                                    <!-- Start tab navigation -->
                                                    <ul class="nav nav-tabs --justify-content-center border-0 text-left fw-500 fs-18 alt-font category-tab" style="padding: 0 0px 0 0 !important;" id="myTab" role="tablist">
                                                        <?php
                                                        foreach ($getCategoryListing as $categoryListing) {
                                                            $category_level1_id = $categoryListing['cat_level_1'];
                                                            $getSubCategory = $this->categories_model->getSubCategory($category_level1_id);

                                                            if ($categoryListing['cat_level_2'] !== NULL) {
                                                                if ($categoryListing['cat_level_2'] != 0) {
                                                                    $categoryHref = "javascript:void(0)";
                                                                    $categoryOnclick = 'onclick="mainCategoryLisiting(' . $categoryListing['cat_level_1'] . ', 0)"';
                                                                } else {
                                                                    $categoryHref = base_url() . "services-detail/" . strtolower($categoryListing['list_code']);
                                                                    $categoryOnclick = "";
                                                                }
                                                        ?>
                                                                <li class="nav-item category-items">
                                                                    <a class="nav-link --text-dark maincategory_a_tag" style="color:black!important; opacity:1;"
                                                                        id="maincategory_link_<?php echo $categoryListing['cat_level_1']; ?>"
                                                                        href="<?php echo $categoryHref; ?>"
                                                                        <?php echo $categoryOnclick; ?>>
                                                                        <?php echo $categoryListing['list_value']; ?>
                                                                        <?php
                                                                        if ($categoryListing['cat_level_2'] !== NULL && $categoryListing['cat_level_2'] != 0) {
                                                                        ?>
                                                                            <i class="fa-solid fa-arrow-right ms-5px" id="category-arrow-color-<?php echo $categoryListing['cat_level_1']; ?>" style="font-size:18px;"></i>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                </li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>



                                                    </ul>
                                                </div>
                                                <style>
                                                    .category-tab {
                                                        display: flex;
                                                        flex-direction: column;
                                                        /* Stack the items vertically */
                                                        padding: 0;
                                                        margin: 0;
                                                    }

                                                    .tab-style-02 .nav-tabs>li.category-items {
                                                        margin: 0 34px;
                                                        margin-bottom: 20px;
                                                    }
                                                </style>
                                                <script>
                                                    $(document).ready(function() {
                                                        category();
                                                    });


                                                    function category() {
                                                        var segment_value = '<?php echo $this->uri->segment(1); ?>';

                                                        var sec_segment_value = '<?php echo $this->uri->segment(2); ?>';

                                                        var third_segment_value = '<?php echo $this->uri->segment(3); ?>' || ''; // If third segment is missing, pass an empty string


                                                        if (segment_value !== "services-details" && segment_value !== "services-detail") {
                                                            mainCategoryLisiting('0', '0');
                                                        } else {
                                                            $.ajax({
                                                                url: '<?php echo base_url(); ?>welcome/getSecSubCategoryValue/' + sec_segment_value + '/' + third_segment_value, // Ensure function name matches
                                                                type: 'GET',
                                                                dataType: 'json',
                                                                success: function(response) {
                                                                    if (response.category_level_id) {
                                                                        mainCategoryLisiting(response.category_level_id, response.category_level2_id); // Pass category_level_1
                                                                    } else {
                                                                        alert("No category found.");
                                                                    }
                                                                },
                                                                error: function() {
                                                                    alert("Failed to fetch data. Please try again.");
                                                                }
                                                            });

                                                        }
                                                    }

                                                    function mainCategoryLisiting(category_level1_id, category_level2_id) {
                                                        $.ajax({
                                                            url: '<?php echo base_url(); ?>welcome/ajaxSubCategoryList/' + category_level1_id,
                                                            type: 'GET',
                                                            dataType: 'json',
                                                            success: function(response) {
                                                                $("#category-listing").html(response.html);

                                                                $(".maincategory_a_tag").css({
                                                                    'border-bottom': 'none',
                                                                    'color': 'black',
                                                                    'font-weight': 'normal'
                                                                });

                                                                $(".fa-arrow-right").css('color', 'black');

                                                                $('#category-arrow-color-' + response.category_level_id).css('color', '#5758d6');

                                                                $('#maincategory_link_' + response.category_level_id).css({
                                                                    'border-bottom': '2px solid #000',
                                                                    'color': '#5758d6'
                                                                    // 'font-weight': 'bold'  // Fixed missing comma
                                                                });
                                                                if (category_level2_id !== '0') {
                                                                    $('#categroy_level2_' + category_level2_id).css('color', '#5758d6');
                                                                }
                                                            },
                                                            error: function() {
                                                                alert("Failed to fetch data. Please try again.");
                                                            }
                                                        });
                                                    }
                                                </script>



                                                <div class="col-xl-4 col-lg-8 col-md-12">
                                                    <div class="tab-content w-100" id="myTabContent">

                                                        <ul class="list-unstyled" id="category-listing">
                                                            <?php
                                                            $page_data = array();
                                                            echo $this->load->view('themes/default/header_subcategory_listing', $page_data, true);
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-xl-5 col-lg-8 col-md-12 d-flex flex-column align-items-start border-start ps-3 border-color-extra-medium-gray">
                                                    <h5>Our Services </h5>
                                                    <p>Discover solutions crafted for your industry’s unique requirements. Our offerings simplify operations, enhance efficiency, and fuel growth, enabling your business to excel in a competitive market.</p>
                                                    <span class="fs-20 text-dark-gray fw-500 ls-minus-05px pt-4">We specialize in providing tailored solutions to services such as <a href="<?php echo base_url() . 'service/all'; ?>" class="fw-600 text-dark pt-2">Explore all Services<i class="fa-solid fa-arrow-right ms-5px icon-very-small"></i></a></span>
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

                                            <?php if (count($getSubCategory) > 0) {
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
                                                    <?php } ?>
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



                        <li class="nav-item dropdown submenu hide-on-mobile ">
                            <a href="javascript:void(0)" class="nav-link header1_links <?php echo ($segment_1 === 'industry' || $segment_1 === 'industries-details') ? 'header1_active_back_ground_color' : 'header1_back_ground_color'; ?>">Industries</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <div class="dropdown-menu submenu-content w-100" aria-labelledby="navbarDropdownMenuLink2" style="background-color:white;">
                                <div class="container-fluid">
                                    <div class="d-lg-flex mega-menu flex-column w-100">
                                        <section class="--bg-solitude-blue pt-0">
                                            <div class="row align-items-center">

                                                <div class="col-xl-7 col-lg-8 col-md-12 --tab-style-02 --md-mb-30px --sm-mb-20px" style="padding: 0 0px 0 0 !important;color:black;">
                                                    <!-- Start tab navigation -->
                                                    <?php
                                                    if (count($getIndustriesList) > 0) {
                                                    ?>
                                                        <ul class="nav flex-wrap d-flex" style="padding: 0 !important;" id="myTab" role="tablist">
                                                            <?php
                                                            foreach ($getIndustriesList as $industriesList) {
                                                            ?>
                                                                <li class="nav-item col-4 mb-2">
                                                                    <a href="<?php echo base_url() . 'industries-details/' . $industriesList['industries_url']; ?>" class="nav-link text-center <?php echo ($segment_2 === $industriesList['industries_url']) ? 'industry_menu_active_back_ground_color' : 'industry_menu_back_ground_color'; ?>" --style="color: black !important;" --id="tab-four1-tab" --data-bs-toggle="tab" --role="tab" --aria-controls="tab-four1" --aria-selected="true">
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
                                                    <span class="fs-20 text-dark-gray fw-500 ls-minus-05px pt-4">We specialize in providing tailored solutions to industries such as <a href="<?php echo base_url() . 'industry'; ?>" class="fw-600 text-dark pt-2">Explore all Industries<i class="fa-solid fa-arrow-right ms-5px icon-very-small"></i></a></span>

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

                        <li class="nav-item"><a href="<?php echo base_url() . 'product/all'; ?>" class="nav-link header1_links <?php echo ($segment_1 === 'product') ? 'header1_active_back_ground_color' : 'header1_back_ground_color'; ?>">Products</a></li>

                        <li class="nav-item dropdown dropdown-with-icon-style02">
                            <a href="javascript:void(0)" class="nav-link header1_links <?php echo ($segment_1 === 'about-us' || $segment_1 === "blog" || $segment_1 === 'success-story'  || $segment_1 === 'contact-us') ? 'header1_active_back_ground_color' : 'header1_back_ground_color'; ?>">Knowledge center</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a href="<?php echo base_url(); ?>about-us" class="<?php echo ($segment_1 === 'about-us') ? 'sub_link_active_back_ground_color' : 'sub_link__back_ground_color'; ?>"><i class="bi bi-person-badge"></i>About Us</a></li>
                                <li><a href="<?php echo base_url(); ?>blog/all" class="<?php echo ($segment_1 === 'blog') ? 'sub_link_active_back_ground_color' : 'sub_link__back_ground_color'; ?>"><i class="bi bi-journal-text"></i>Blog</a></li>
                                <li><a href="<?php echo base_url(); ?>success-story/all" class="<?php echo ($segment_1 === 'success-story') ? 'sub_link_active_back_ground_color' : 'sub_link__back_ground_color'; ?>"><i class="bi bi-trophy"></i>Success Story</a></li>
                                <?php /* <li><a href="<?php echo base_url(); ?>events" class="<?php echo ($segment_1 === 'events') ? 'sub_link_active_back_ground_color' : 'sub_link__back_ground_color'; ?>"><i class="bi bi-calendar-event"></i>Events</a></li>
                                <li><a href="<?php echo base_url(); ?>careers" class="<?php echo ($segment_1 === 'careers') ? 'sub_link_active_back_ground_color' : 'sub_link__back_ground_color'; ?>"><i class="bi bi-briefcase"></i>Careers</a></li>
                               */?> <?php /*
                                        <li><a href="<?php echo base_url(); ?>careers"><i class="bi bi-send-check"></i>Careers</a></li>
                                        <li><a href="<?php echo base_url(); ?>news"><i class="bi bi-globe2"></i>News</a></li>
                                        <li><a href="<?php echo base_url(); ?>success-stories"><i class="bi bi-globe2"></i>Success Story</a></li>
                                        */ ?>
                                <li><a href="<?php echo base_url(); ?>contact-us" class="<?php echo ($segment_1 === 'contact-us') ? 'sub_link_active_back_ground_color' : 'sub_link__back_ground_color'; ?>"><i class="bi bi-telephone"></i>Contact Us</a></li>

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
                    <div class="header-button"><a href="<?php echo base_url(); ?>contact-us#contact" class="btn btn-very-small btn-transparent-white-light btn-rounded">Get Started</a></div>
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

    .dropdown-icon {
        top: 30px;
        font-size: 16px ! important
    }

    .rotate-icon {
        transform: rotate(180deg);
    }

    .dropdown-item-font {
        color: #1C1D1F !important;
        font-weight: 500 !important;
    }

    .sub_drop_down_tag {
        font-size: 15px;
        line-height: 26px;
        color: rgba(23, 23, 23, 0.1);
        font-weight: 600 !important;
    }

    .header1_active_back_ground_color {
        color: white !important;
        opacity: 0.6 !important;
    }

    .header1_back_ground_color {
        color: white !important;
        opacity: 1;
    }

    /* Apply black color with opacity only for mobile screens */
    @media (max-width: 768px) {
        .header1_active_back_ground_color {
            color: black !important;
            opacity: 0.4 !important;
        }

        .header1_back_ground_color {
            color: black !important;
            opacity: 1 !important;
        }
    }

    header.sticky.sticky-active [data-header-hover=light] .navbar-nav .header1_back_ground_color {
        color: #1c1d1f !important;
    }

    header.sticky.sticky-active [data-header-hover=light] .navbar-nav .header1_active_back_ground_color {
        color: #1c1d1f !important;
        opacity: 0.3 !important
    }

    .submenu-light .navbar-nav .header1_links {
        color: var(--dark-gray) ! important;
    }

    .sub_link_active_back_ground_color {
        color: white !important;
        background-color: var(--base-color);
    }

    .sub_link_back_ground_color {
        color: black;
        background-color: white;
    }

    @media (max-width: 768px) {
        .sub_link_active_back_ground_color {
            color: var(--base-color) !important;
            background-color: white !important;
            font-weight: bold !important;
        }

        .sub_link_back_ground_color {
            color: #1c1d1f !important;
        }
    }

    .industry_menu_active_back_ground_color {
        color: var(--base-color) !important;
        font-weight: bold !important;
    }

    .industry_menu_back_ground_color {
        color: #1c1d1f !important;
    }


    .header1_mobile_active_back_ground_color {
        color: black !important;
        opacity: 0.4 !important;
    }

    .header1_mobile_back_ground_color {
        color: black !important;
        opacity: 1 !important;
    }

    .industry_mobile_menu_active_back_ground_color {
        color: var(--base-color) !important;
        font-weight: bold !important;
    }

    .industry_mobile_menu_back_ground_color {
        color: #1c1d1f !important;
    }

    .industry_mobile_menu_back_ground_color:hover {
        color: var(--base-color) !important;
        background-color: white !important;
    }

    .header1_sec_sub_links_active_back_ground_color {
        color: var(--base-color) !important;
        font-weight: bold !important;
    }

    .header1_sec_sub_links_back_ground_color {
        color: #1C1D1F !important;
        font-size: 15px;
        line-height: 26px;
        font-weight: 500;
        font-weight: 600 !important;
    }

    .header1_sec_sub_links_back_ground_color:hover {
        color: var(--base-color) !important;
        background-color: white !important;
    }

    .header1_sub_links_active_back_ground_color {
        color: #1C1D1F !important;
        opacity: 0.4 !important;

    }

    .header1_sub_links_back_ground_color {
        font-size: 15px;
        line-height: 26px;
        border-bottom: 1px solid rgba(23, 23, 23, 0.1);
        font-weight: 500;
        font-weight: 600 !important;
    }
    @media (max-width: 991px) {
    .navbar .navbar-nav .dropdown .dropdown-menu a, .navbar-modern-inner .navbar-nav .dropdown .dropdown-menu a, .navbar-full-screen-menu-inner .navbar-nav .dropdown .dropdown-menu a {
          padding: 16px 0;
        line-height: 16px;
    }
}
</style>

<script>
    $(document).ready(function() {
        $(".about-menu").hide();

        $(".toggle-menu").click(function(e) {
            let submenu = $(this).siblings(".about-menu");
            let icon = $(this).find(".dropdown-icon");

            if (submenu.length > 0) {
                e.preventDefault();

                $(".about-menu").not(submenu).slideUp();
                $(".dropdown-icon").not(icon).removeClass("rotate-icon");

                submenu.stop(true, true).slideToggle();
                icon.toggleClass("rotate-icon");
            }
        });


        $(".service-toggle").click(function(e) {
            e.stopPropagation();

            let serviceMenu = $(this).siblings(".service-menu");

            $(".service-menu").not(serviceMenu).slideUp();
            $(".service-toggle").not(this).removeClass("rotate-icon");

            serviceMenu.stop(true, true).slideToggle();
            $(this).toggleClass("rotate-icon");
        });

        $(document).click(function(e) {
            if (!$(e.target).closest(".dropdown-submenu").length) {
                $(".about-menu").slideUp();
                $(".dropdown-icon").removeClass("rotate-icon"); // Reset arrows
            }
        });
    });
</script>