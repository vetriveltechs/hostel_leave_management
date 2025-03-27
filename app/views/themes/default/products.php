<body data-mobile-nav-style="classic" class="custom-cursor">
    <?php
    $getProductCategory     = $this->categories_model->getProductCategory();
    ?>
    <section class="mt-5 ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(<?php echo base_url(); ?>assets/frontend/img/jesper/product-banner.png)">
        <div class="container">
            <div class="row align-items-center extra-small-screen">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h1 class="mb-20px alt-font text-yellow">Explore products designed to simplify and enhance your life
                    </h1>
                    <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Discover Products That Elevate Your Experience
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-tranquil position-relative " style="    background-color: #f3f8f8;">
 
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-xl-5 lg-mb-30px text-center text-xl-start">
                    <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Our Products</h2>
                </div>
                <?php /*
                    if(count($getProductCategory)>0)
                    {
                        ?>
                            <div class="col-xl-7 tab-style-04 text-center text-xl-end">
                                <!-- filter navigation -->
                                <ul class="--portfolio-filter fw-500 nav nav-tabs justify-content-center justify-content-xl-end border-0" >
                                    <li class="nav product-li-list"><a href="<?php echo base_url(); ?>product/all" class="<?php echo ($list_code === '' || $list_code === 'ALL') ? 'product_active_back_ground_color' : 'product_back_ground_color'; ?>">All</a></li>
                                    <?php 
                                        foreach ($getProductCategory as $productCategory) 
                                        { 
                                            $isActive = ($list_code == $productCategory['list_code']) ? 'product_active_back_ground_color' : 'product_back_ground_color';
                                            ?>
                                                <li class="nav product-li-list"><a href="<?php echo base_url(); ?>product/<?php echo strtolower($productCategory['list_code']); ?>" class="<?php echo $isActive; ?>"><?php echo ucfirst($productCategory['list_value']); ?></a></li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                                <!-- end filter navigation --> 
                            </div>
                        <?php
                    }
                */ ?>
            </div>
            <style>
                .product-li-list {
                    padding: 0 25px;
                }
            </style>
            <?php
            if (count($resultData) > 0) {
            ?>
                <div class="row" data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="col-12 filter-content p-md-0">
                        <ul class="portfolio-wrapper grid-loading grid grid-3col xxl-grid-3col xl-grid-3col lg-grid-2col md-grid-2col sm-grid-1col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>
                            <!-- start portfolio item -->
                            <?php
                            foreach ($resultData as $products) {
                                $product_page_url   = ($products['product_url'] === 'hrms') ? "https://hrms.jesperapps.com/" : base_url() . 'product-details/' . $products['product_url'];

                                $page_target        = ($products['product_url'] === 'hrms') ? 'target="_blank"' : '';

                                $product_url        = "uploads/products/" . $products['product_id'] . ".png";
                            ?>

                                <li class="grid-item design transition-inner-all">
                                    <div class="services-box-style-06 border-radius-6px hover-box overflow-hidden box-shadow-large">
                                        <div class="image">
                                            <a href="<?php echo $product_page_url; ?>" <?php echo $page_target; ?>>
                                                <img src="<?php echo base_url() . $product_url; ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="bg-white">
                                            <div class="ps-50px pe-50px pt-35px sm-p-35px sm-pb-0">
                                                <a href="javascript:void(0)" class="d-inline-block fs-19 primary-font fw-600 text-dark-gray mb-5px" style="background: linear-gradient(to right, rgb(0, 87, 183), rgb(0, 150, 136), rgb(2, 109, 26)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                                    <?php echo ucfirst($products['product_name']); ?>
                                                </a>
                                                <p class="text-dark"><?php echo ucfirst($products['description']) ?></p>
                                            </div>
                                            <div class="border-top border-color-extra-medium-gray pt-15px pb-20px text-center">
                                                <a href="<?php echo $product_page_url; ?>" <?php echo $page_target; ?> class="btn btn-link btn-hover-animation-switch btn-large fw-700">
                                                    <span>
                                                        <span class="btn-text" style="background: linear-gradient(to right, rgb(0, 87, 183), rgb(0, 150, 136), rgb(2, 109, 26)); 
                                                                            -webkit-background-clip: text; 
                                                                            -webkit-text-fill-color: transparent;">Explore more</span>
                                                        <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                        <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                    </span>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                            <!-- end portfolio item -->

                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 showing-count text-dark">
                        Showing <?php echo $starting; ?> to <?php echo $ending; ?> of <?php echo $totalRows; ?> entries
                    </div>
                    <!-- Pagination -->
                    <?php if (isset($pagination)) {
                    ?>
                        <div class="col-md-8" style="float:right;padding: 0px 20px 0px 0px;">
                            <?php foreach ($pagination as $link) {
                                echo $link;
                            } ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php

            } else {
            ?>
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>uploads/nodata.png" alt="No data available" style="width: 300px;height:300px">
                </div>
            <?php
            }

            ?>


        </div>
    </section>
    <?php /* <section class="background-position-center-top p-0 sm-background-image-none pt-10 pb-5 --pb-10" style="background-image: url('https://www.aideanex.com/assets/frontend/img/vertical-line-bg.svg')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center text-lg-start md-mb-40px">
                    <span class="fs-17 d-inline-block fw-500 text-uppercase ls-1px">Our Projects</span>
                    <h3 class="alt-font text-dark fw-600 ls-minus-1px">Project We Delivered</h3>
                </div>
                <div class="col-lg-6 text-center text-lg-start last-paragraph-no-margin ps-5 lg-ps-3 md-ps-15px">
                    <p data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 100, "easing": "easeOutQuad" }'>We're a team of experienced and passionate professionals who are dedicated to delivering high-quality projects that meet the unique needs of our clients. We have a proven track record of success in a variety of industries, and we're always looking for new challenges.</p>
                </div>
            </div>

            <div class="row position-relative clients-style-08 pt-5">
                <div class="col swiper text-center feather-shadow" data-slider-options='{ "slidesPerView": 2, "spaceBetween":0, "speed": 4000, "loop": true, "pagination": { "el": ".slider-four-slide-pagination-2", "clickable": false }, "allowTouchMove": false, "autoplay": { "delay":0, "disableOnInteraction": false }, "navigation": { "nextEl": ".slider-four-slide-next-2", "prevEl": ".slider-four-slide-prev-2" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 4 }, "768": { "slidesPerView": 3 } }, "effect": "slide" }'>
                    <div class="swiper-wrapper marquee-slide">
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/radio.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->

                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/local.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/vasanth.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/agham.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/ssk.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/dhanam.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->

                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/subha.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/pepper.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/flexo.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/enerdux.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/hnt.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/kavin.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/local1.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/bmg.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                        <!-- start client item -->
                        <div class="swiper-slide">
                            <a href="javascript:void(0)"><img src="https://www.aideanex.com/assets/frontend/img/bhuvi.png" class="h-50px xs-h-30px" alt="" /></a>
                        </div>
                        <!-- end client item -->
                    </div>
                </div>
            </div>
        </div>
    </section>*/?>
    <style>
        .services-box-style-06 .services-text:after {
            content: none !important;
            ;
            display: inline-block;
            font-family: bootstrap-icons;
            vertical-align: middle;
            margin: -2px 2px 0;
            font-size: 22px;
            color: var(--medium-gray);
            opacity: 0.7;
        }

        .product_active_back_ground_color {
            color: var(--dark-gray);
            border-bottom: 2px solid #1c1d1f;
        }

        .product_active_back_ground_color:hover {
            color: var(--medium-gray) !important;
            border-bottom: 2px solid #1c1d1f;
        }

        .product_back_ground_color:hover {
            color: var(--medium-gray) !important;
            border-bottom: 2px solid #1c1d1f;
        }

        .product_back_ground_color {
            color: var(--medium-gray);
            border-bottom: 2px solid transparent;
        }


        .dynamic_pagination {
            display: inline-block;
            padding-left: 0;
            /* margin: 20px 0; */
            border-radius: 0;
            float: right;
        }

        .dynamic_pagination>li {
            display: inline-block;
            color: #6f7071;

        }

        .dynamic_pagination>li:first-child>a,
        .dynamic_pagination>li:first-child>span {
            margin-left: 0;
        }

        .dynamic_pagination>li>a,
        .dynamic_pagination>li>span {
            width: 55px;
            height: 55px;
            text-align: center;
            line-height: 55px;
            background-color: white;
            border: 1px solid white;
            margin: 0 4px;
            transition: all 0.3s;
            display: block;
            color: #6f7071;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer !important;
        }

        a {
            color: #6f7071;
            text-decoration: none;
            background-color: transparent;
        }



        .dynamic_pagination>.active>a,
        .dynamic_pagination>.active>span,
        .dynamic_pagination>.active>a:hover,
        .dynamic_pagination>.active>span:hover,
        .dynamic_pagination>.active>a:focus,
        .dynamic_pagination>.active>span:focus {
            z-index: 2;
            color: white;
            cursor: default;
            background-color: black;
            border-radius: 50%;
        }

        .dynamic_pagination>li>a:hover {
            z-index: 2;
            color: white;
            cursor: default;
            background-color: black;
            border-radius: 50%;
        }
    </style>
</body>