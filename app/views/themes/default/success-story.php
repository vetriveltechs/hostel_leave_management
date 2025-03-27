<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menu      = document.querySelector(".category-slider");
        const leftArrow     = document.querySelector(".scroll-arrow.left");
        const rightArrow    = document.querySelector(".scroll-arrow.right");

        function scrollMenu(amount) {
            menu.scrollBy({ left: amount, behavior: "smooth" });
        }

        function checkArrows() {
            if (menu.scrollLeft <= 0) {
                leftArrow.style.display = "none";
            } else {
                leftArrow.style.display = "flex";
            }

            if (menu.scrollLeft + menu.clientWidth >= menu.scrollWidth - 1) {
                rightArrow.style.display = "none";
            } else {
                rightArrow.style.display = "flex";
            }
        }

        menu.addEventListener("scroll", checkArrows);
        leftArrow.addEventListener("click", () => scrollMenu(-200));
        rightArrow.addEventListener("click", () => scrollMenu(200));

        // Enable scrolling with mouse wheel
        menu.addEventListener("wheel", (event) => {
            event.preventDefault();
            menu.scrollBy({ left: event.deltaY > 0 ? 100 : -100, behavior: "smooth" });
        });

        checkArrows();
    });
</script>

<style>
    /* Container for scrolling */
    .category-slider-container {
        position: relative;
        display: flex;
        align-items: center;
    }

    /* The scrollable menu */
    .category-slider {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        white-space: nowrap;
        scroll-behavior: smooth;
        padding: 10px 0;
        flex: 1;
        scroll-snap-type: x mandatory;
        margin-right: 25px;
        margin-left: 25px;
    }

    /* Hide scrollbar */
    .category-slider::-webkit-scrollbar {
        display: none;
    }

    /* Menu items */
    .casestudies_button_back_ground_color {
        flex: 0 0 auto;
        padding: 10px 20px;
        background: #f5f5f5;
        border-radius: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
    }

    .casestudies_active_button_back_ground_color {
        flex: 0 0 auto;
        padding: 10px 20px;
        background: #27ac25;
        border-radius: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
    }

    .casestudies_tag_back_ground_color {
       color: #333333;
    }


    .casestudies_active_tag_back_ground_color {
       color: #fff !important;
    }

    .category-slider .nav a {
        text-decoration: none;
        color: #333;
    }

    .category-slider .nav:hover {
        background: #27ac25;
    }

    .category-slider .nav:hover a {
        color: white;
    }

    /* Navigation arrows */
    .scroll-arrow {
        background: rgb(134 207 128);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .scroll-arrow:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    /* Left and Right positioning */
    .scroll-arrow.left {
        left: 0;
        display: none; /* Initially hidden */
    }

    .scroll-arrow.right {
        right: 0;
    }
</style>


<!-- start page title -->
<section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(<?php echo base_url(); ?>assets/frontend/img/jesper/case-studies-bg.png)">
      <div class="container">
        <div class="row align-items-center extra-small-screen">
            <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h1 class="mb-20px alt-font text-yellow">Boost productivity. Overcome challenges. Grow with JesperApps! 
                </h1>
                <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Unlock Success with Smart Solutions</h2>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<section class="bg-tranquil position-relative overlap-height">
    <div class="position-absolute left-minus-200px top-25" data-bottom-top="transform: translateY(-80px)" data-top-bottom="transform: translateY(80px)">
        <img src="images/demo-elearning-bg-04.png" alt="">
    </div>
    <div class="container overlap-gap-section">
        <div class="row align-items-center mb-4">
            <div class="col-xl-5 lg-mb-30px text-center text-xl-start">
                <h3 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Our Success story</h3>
            </div>
            <div class="col-xl-7 text-center text-xl-end category-slider-container">
                <!-- Left Arrow -->
                <button class="scroll-arrow left" onclick="scrollMenu(-200)">&#10094;</button>

                <!-- Scrollable Category Menu -->

                <?php 
                    $getCaseStudyCategory 	= $this->categories_model->getCaseStudyCategory();

                    if(count($getCaseStudyCategory)>0)
                    {
                        ?>
                            <ul class="category-slider">
                                <li class="nav <?php echo ($list_code === '' || $list_code === 'ALL') ? 'casestudies_active_button_back_ground_color' : 'casestudies_button_back_ground_color'; ?>"><a href="<?php echo base_url(); ?>success-story/all" class="<?php echo ($list_code === '' || $list_code === 'ALL') ? 'casestudies_active_tag_back_ground_color' : 'casestudies_tag_back_ground_color'; ?>">All</a></li>
                                <?php 
                                    foreach ($getCaseStudyCategory as $caseStudyCategory) 
                                    { 
                                        $isButtonActive     = ($list_code == $caseStudyCategory['list_code']) ? 'casestudies_active_button_back_ground_color' : 'casestudies_button_back_ground_color';
                                        $isTagActive        = ($list_code == $caseStudyCategory['list_code']) ? 'casestudies_active_tag_back_ground_color' : 'casestudies_tag_back_ground_color';

                                        ?>
                                            <li class="nav <?php echo $isButtonActive; ?>"><a href="<?php echo base_url(); ?>success-story/<?php echo strtolower($caseStudyCategory['list_code']); ?>" class="<?php echo $isTagActive ;?>"><?php echo ucfirst($caseStudyCategory['list_value']); ?></a></li>
                                        <?php
                                    }
                                ?>  
                            </ul>
                        <?php 
                    }
                ?>

                

                <!-- Right Arrow -->
                <button class="scroll-arrow right" onclick="scrollMenu(200)">&#10095;</button>
            </div>
        </div>

        <?php 
            if(count($resultData)>0)
            {
                ?>
                    <div class="row blog-metro">
                        <div class="col-12 filter-content">
                            <ul class="portfolio-attractive portfolio-wrapper grid-loading grid grid-4col xxl-grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-large text-center">
                                <li class="grid-sizer"></li>
                                <!-- start portfolio item -->
                                <?php 
                                    foreach ($resultData as $caseStudyCategory) 
                                    {
                                        $casestudy_blog_url = "uploads/case_studies/".$caseStudyCategory['casestudies_id'].".png";

                                        ?>
                                            <li class="grid-item selected transition-inner-all atropos" data-atropos data-atropos-perspective="1450">
                                                <div class="position-relative">
                                                    <a href="<?php echo base_url() . 'success-story-details/' . strtolower($caseStudyCategory['list_code']) .'/'.$caseStudyCategory['casestudy_url']; ?>" class="portfolio-link"></a>
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner" data-atropos-offset="3"> 
                                                                <div class="portfolio-box bg-gradient-sky-blue-pink">
                                                                    <div class="portfolio-image">
                                                                        <img src="<?php echo base_url().$casestudy_blog_url;?>" alt="" />
                                                                    </div>
                                                                    <div class="portfolio-hover justify-content-end align-items-center d-flex flex-column pt-40px pb-40px sm-pt-30px sm-pb-30px">
                                                                        <span class="icon-box z-index-1 mb-auto ms-auto me-30px"><i class="bi bi-arrow-up-right icon-very-medium text-white" aria-hidden="true"></i></span>
                                                                        <div class="text-white fs-19 move-top-bottom-self"><span><?php echo ucfirst($caseStudyCategory['list_value']) ;?></span></div>
                                                                        <div class="fs-15 lh-22 text-white opacity-6 move-bottom-top-self"><span><?php echo ucfirst($caseStudyCategory['title']) ;?></span></div>
                                                                    </div>
                                                                </div> 
                                                            </div>
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
                    <div class="row mt-5">
                        <div class="col-md-4 showing-count text-dark">
                            Showing <?php echo $starting; ?> to <?php echo $ending; ?> of <?php echo $totalRows; ?> entries
                        </div>
                        <!-- Pagination -->
                        <?php if (isset($pagination)) 
                            { 
                                ?>
                                    <div class="col-md-8" style="float:right;padding: 0px 20px 0px 0px;">
                                        <?php foreach ($pagination as $link) { echo $link; } ?>
                                    </div>
                                <?php 
                            } 
                        ?>
                    </div>
                <?php

            }
        ?>
            

        
    </div>
</section>

<style>
    .dynamic_pagination 
        {
            display: inline-block;
            padding-left: 0;
            /* margin: 20px 0; */
            border-radius: 0;
            float: right;
        }
        .dynamic_pagination>li 
        {
            display: inline-block;
            color: #6f7071;
            
        }

        .dynamic_pagination>li:first-child>a, .dynamic_pagination>li:first-child>span 
        {
            margin-left: 0;
        }

        .dynamic_pagination>li>a, .dynamic_pagination>li>span 
        {
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
        a 
        {
            color: #6f7071;
            text-decoration: none;
            background-color: transparent;
        }

        .dynamic_pagination>.active>a, .dynamic_pagination>.active>span, .dynamic_pagination>.active>a:hover, .dynamic_pagination>.active>span:hover, .dynamic_pagination>.active>a:focus, .dynamic_pagination>.active>span:focus {
            z-index: 2;
            color: white;
            cursor: default;
            background-color: black;
            border-radius: 50%;
        }

        .dynamic_pagination>li>a:hover
        {
            z-index: 2;
            color: white;
            cursor: default;
            background-color: black;
            border-radius: 50%;
        }
</style>

<!-- end section -->