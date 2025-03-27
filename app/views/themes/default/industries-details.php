<body data-mobile-nav-style="classic">
    <!-- start page title -->
    <?php 
        $getIndustries = $this->industries_model->getIndustriesRecords($industries_url);


        if(count($getIndustries)>0)
        {
            $overview	= 'uploads/industries/overview_image/'.$getIndustries[0]['industries_id'].'.png';
            ?>
                <section class="--top-space-margin position-relative overflow-hidden --bg-very-light-green pb-0 page-title-big-typography">
                    <div class="container-fluid  ">
                        <div class="row h-100 ">
                            <div class=" pt-5 pb-5 col-xxl-5 col-lg-6 text-white bg-very-light-green cover-background ps-6 xxl-ps-4 sm-ps-15px order-2 order-lg-1 md-pt-50px md-pb-15 xs-pb-20" style="background-image:url('<?php echo base_url(); ?>assets/frontend/img/jesper/industrie.jpg');">
                                <span class="fs-15 fw-500 ls-05px mb-20px d-inline-block border-bottom border-2 border-color-transparent-white-very-light text-uppercase"><?php echo $getIndustries[0]['industries_name'];?></span>
                                <div class="fs-55 lg-fs-35 fw-600 ls-minus-2px md-w-80 sm-w-100 xs-w-90">
                                    <h1 class="fs-55"><?php echo ucfirst($getIndustries[0]['banner_title']);?></h1>
                                   
                                </div>
                                <div class="d-inline-block mt-15px sm-mt-30px">
                                    <p><?php echo ucfirst($getIndustries[0]['description']);?></p>

                                    <a href="#contactform" class="btn btn-link btn-hover-animation-switch fw-500 btn-extra-large text-white btn-icon-left xs-mt-15px">
                                        <span>
                                            <span class="btn-text">Get Started </span>
                                            <span class="btn-icon"><i class="feather icon-feather-box"></i></span>
                                            <span class="btn-icon"><i class="feather icon-feather-box"></i></span>
                                        </span>
                                    </a>

                                </div>
                            </div>
                            <div class="col-xxl-7 col-lg-6 cover-background sm-background-position-top-center order-1 order-lg-2 md-h-500px sm-h-400px" style="background-image:url('<?php echo base_url();?>uploads/industries/<?php echo $getIndustries[0]['industries_id'];?>.png');"></div>
                        </div>
                    </div>
                </section>
                <section class="cover-background  lg-pt-15 md-pt-5 --ipad-top-space-margin" style="background-image: url('<?php echo base_url(); ?>assets/frontend/img/jesper/bg.jpg')">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-12 col-lg-5 col-md-6">
                                <img class="border-radius-8px" src="<?php echo base_url().$overview;?>" alt="">
                            </div>
                            <div class="col-12 col-lg-7 col-md-6 sm-mb-40px sm-mt-30px text-center text-md-start">
                                <span class="alt-font fs-50 lh-80 d-block text-dark-gray fw-700 ls-minus-3px mb-15px w-80 lg-w-100">Overview </span>
                                <p class="w-100 lg-w-100"><?php echo ucfirst($getIndustries[0]['overview']);?></p>

                            </div>

                        </div>
                    </div>
                </section>
            <?php
        

            $getOurSolutionsRecords	= $this->industries_model->getOurSolutionsHeaders($industries_url);

            if(count($getOurSolutionsRecords)>0)
            {
                ?>
                    <section class="pt-0">
                        <div class="container background-no-repeat background-position-top">
                            <div class="row justify-content-center mb-2">
                                <div class="col-xxl-6 col-lg-8 col-md-9 text-center" data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <h2 class="text-dark-gray fw-700 ls-minus-2px">Our Solutions</h2>
                                </div>
                            </div>
                            <?php 
                                foreach ($getOurSolutionsRecords as $index => $feature) 
                                { 
                                    $isEven = $index % 2 === 0;
                                    if ($isEven) 
                                    {
                                        $solution_image= 'uploads/industries/solution_image/'.$feature['header_id'].'.png';
                                        ?>
                                            <div class="row align-items-center p-3 bg-very-light-green border-radius-8px mt-5 d-flex flex-column-reverse flex-md-row">
                                                <div class="col-xl-6 col-lg-6" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                                    <h5 class="text-dark-gray fw-700 ls-minus-1px md-w-80 sm-w-100"><?php echo ucfirst($feature['solution_title']);?></h5>
                                                    <p><?php echo ucfirst($feature['description']);?></p>
                                                    <div class="mb-40px sm-mb-30px">
                                                        <!-- start features box item -->
                                                        <?php 
                                                            $getOurSolutions	= $this->industries_model->getOurSolutionsLines($feature['header_id']);
                                                            foreach ($getOurSolutions as $ourSolutions) 
                                                            {   
                                                                ?>
                                                                    <div class="icon-with-text-style-08 mb-15px">
                                                                        <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                                                                            <div class="feature-box-icon feature-box-icon-rounded w-50px h-50px rounded-circle bg-very-light-green me-20px text-center"><i class="fa-solid fa-check fs-16  text-green"></i></div>
                                                                            <div class="feature-box-content last-paragraph-no-margin">
                                                                                <span class="fs-17 fw-600 text-dark-gray"><?php echo ucfirst($ourSolutions['line_description']);?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }				
                                                        ?>
                                                        <!-- end features box item -->
                                                        
                                                    </div>

                                                </div>
                                                <div class="col-lg-6 md-mb-50px">
                                                    <img class="border-radius-8px" src="<?php echo base_url().$solution_image;?>" alt="">
                                                </div>
                                            </div>
                                        <?php
                                    }
                                    else
                                    {
                                        $solution_image = 'uploads/industries/solution_image/'.$feature['header_id'].'.png';

                                        ?>
                                            <div class="row align-items-center p-3 bg-very-light-green border-radius-8px mt-5 d-flex flex-column-reverse flex-md-row" data-aos="fade-right">
                                                <div class="col-lg-6 md-mb-50px">
                                                    <img class="border-radius-8px" src="<?php echo base_url().$solution_image;?>" alt="">
                                                </div>
                                                <div class="col-xl-6 col-lg-6" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                                    <h5 class="text-dark-gray fw-700 ls-minus-1px md-w-80 sm-w-100"><?php echo ucfirst($feature['solution_title']);?></h5>
                                                    <p><?php echo ucfirst($feature['description']);?></p>
                                                    <div class="mb-40px sm-mb-30px">
                                                        <!-- start features box item -->
                                                        <?php
                                                            $getOurSolutions	= $this->industries_model->getOurSolutionsLines($feature['header_id']);
                                                                                
                                                            foreach ($getOurSolutions as $ourSolutions) 
                                                            {
                                                                ?>
                                                                    <div class="icon-with-text-style-08 mb-15px">
                                                                        <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                                                                            <div class="feature-box-icon feature-box-icon-rounded w-50px h-50px rounded-circle bg-very-light-green me-20px text-center"><i class="fa-solid fa-check fs-16 text-green"></i></div>
                                                                            <div class="feature-box-content last-paragraph-no-margin">
                                                                                <span class="fs-17 fw-600 text-dark-gray"><?php echo ucfirst($ourSolutions['line_description']);?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }
                                                        ?>
                                                        <!-- end features box item -->
                                                    </div>

                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                            
                            
                        </div>
                    </section>
                <?php
            }
            /*
            $blog_limit             = 3;
            $getIndustryBlogs		= $this->blogs_model->getIndustryBlogs($industries_url,$blog_limit);

            if(count($getIndustryBlogs)>0)
            {
                ?>
                    <section class="pt-0">
                        <div class="container">
                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div class="mb-10px">
                                                <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                                                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">
                                                </span>
                                            </div>
                                    <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px shadow-none" data-shadow-animation="true" data-animation-delay="1000">Insights & <span class="text-highlight fw-800">Resources</span></h3>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-lg-3 row-cols-sm-2 justify-content-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 200, "easing": "easeOutQuad" }'>
                                <?php 
                                    $blogIds = [];
                                    foreach ($getIndustryBlogs as $industryBlogs) 
                                    {
                                        if (in_array($industryBlogs['blog_id'], $blogIds)) 
                                        {
                                            continue;
                                        }
                                    
                                        $blogIds[] = $industryBlogs['blog_id'];

                                        $blog_url = "uploads/blogs/".$industryBlogs['blog_id'].".png";

                                        ?>
                                            <!-- start fancy text box item -->
                                            <div class="col md-mb-30px mt-2">
                                                <div class="border-radius-8px overflow-hidden box-shadow-quadruple-large services-box-style-03 last-paragraph-no-margin">
                                                    <div class="position-relative box-image">
                                                        <a href="<?php echo base_url(); ?>blog/<?php echo strtolower($industryBlogs['list_code']).'#blog-records'; ?>"><img src="<?php echo base_url().$blog_url;?>" alt=""></a>
                                                    </div>
                                                    <div class="bg-white">
                                                    
                                                            <div class="ps-65px pe-65px xl-ps-50px xl-pe-50px lg-ps-30px lg-pe-30px pt-30px pb-30px text-center">
                                                                <a href="<?php echo base_url(); ?>blog/<?php echo strtolower($industryBlogs['list_code']).'#blog-records'; ?>" class="d-inline-block fs-18 alt-font fw-700 text-dark-gray mb-5px blog-title-scroll"><?php echo ucfirst($industryBlogs['blog_title']);?></a>
                                                                <?php /*
                                                                    <p><?php echo ucfirst($industryBlogs['short_description']);?></p>
                                                                                                                            </div>
                                                        
                                                        <div class="d-flex justify-content-center border-top border-color-extra-medium-gray pt-20px pb-20px ps-50px pe-50px position-relative text-center">
                                                            <a href="<?php echo base_url(); ?>blog/<?php echo strtolower($industryBlogs['list_code']).'#blog-records'; ?>" class="btn btn-link btn-hover-animation-switch btn-very-small fw-700 text-dark-gray text-uppercase">
                                                                <span>
                                                                    <span class="btn-text fs-16">Explore Blogs</span>
                                                                    <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                                    <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end fancy text box item -->
                                        <?php 
                                    }
                                ?>
                                
                            </div>
                            <div class="row justify-content-center" data-anime='{ "opacity": [0, 1], "translate": [0, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
                                <div class="col-12 text-center mt-5"> 
                                    <span class="fs-20 text-dark-gray fw-500 ls-minus-05px">We craft insightful blogs on topics like <a href="<?php echo base_url();?>blog/all" class="fw-600 text-dark-gray">Explore all Blogs<i class="fa-solid fa-arrow-right ms-5px icon-very-small"></i></a></span>
                                </div>
                            </div>

                            
                        </div>
                    </section>
                <?php
            }

            $getCaseStudies		= $this->casestudies_model->getIndustryCaseStudies($industries_url);
            if(count($getCaseStudies)>0)
            {
                ?>
                    <section class="overflow-hidden bg-very-light-gray position-relative">
                        <div class="container">
                            <div class="row align-items-center mb-5 sm-mb-30px text-center text-lg-start" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div class="col-lg-5 md-mb-30px"> 
                                    <h3 class="text-dark-gray fw-700 ls-minus-2px mb-0">Innovation That Delivers Results.</h3>
                                </div> 
                                <div class="col-lg-4 offset-xl-1 last-paragraph-no-margin md-mb-30px"> 
                                    <p>Success isn’t just about technology—it’s about real impact. At JesperApps, we help businesses streamline processes, increase productivity, and drive measurable results. Explore our success stories and see the transformation in action.</p>
                                </div> 
                                <div class="col-xl-2 col-lg-3 d-flex justify-content-center">
                                    <!-- start slider navigation -->
                                    <div class="slider-one-slide-prev-1 icon-small text-dark-gray swiper-button-prev slider-navigation-style-04 bg-white box-shadow-large"><i class="fa-solid fa-arrow-left"></i></div>
                                    <div class="slider-one-slide-next-1 icon-small text-dark-gray swiper-button-next slider-navigation-style-04 bg-white box-shadow-large"><i class="fa-solid fa-arrow-right"></i></div> 
                                    <!-- end slider navigation -->
                                </div>
                            </div>
                            <div class="row align-items-center" data-anime='{ "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div class="col-12">
                                    <div class="outside-box-right-20 sm-outside-box-right-0">
                                        <div class="swiper --magic-cursor slider-one-slide" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1200": { "slidesPerView": 4 }, "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                                            <div class="swiper-wrapper">
                                                <!-- start slider item --> 
                                                <?php 
                                                    foreach ($getCaseStudies as $caseStudies) 
                                                    {
                                                        $caseStudies_url = "uploads/case_studies/".$caseStudies['casestudies_id'].".png";
                                                        ?>
                                                            <div class="swiper-slide">
                                                                <!-- Start services box style -->
                                                                <div class="services-box-style-03 last-paragraph-no-margin border-radius-6px overflow-hidden">
                                                                    <div class="position-relative">
                                                                        <a href="javascript:void(0);">
                                                                            <img src="<?php echo base_url().$caseStudies_url;?>" alt="">
                                                                        </a>
                                                                    </div>
                                                                    <div class="bg-white">
                                                                        <div class="ps-65px pe-65px pt-30px pb-30px text-center">
                                                                            <a href="javascript:void(0);" class="d-inline-block fs-18 fw-700 text-dark-gray mb-5px case-study-title-scroll">
                                                                                <?php echo ucfirst($caseStudies['title']);?>
                                                                            </a>
                                                                        </div>
                                                                        <div class="d-flex justify-content-center border-top border-color-extra-medium-gray pt-20px pb-20px ps-50px pe-50px position-relative text-center">
                                                                            <a href="javascript:void(0);" class="btn btn-link btn-hover-animation-switch btn-medium fw-700 text-dark-gray text-uppercase">
                                                                                <span>
                                                                                    <span class="btn-text">Explore Now</span>
                                                                                    <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                                                    <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End services box style -->
                                                            </div>

                                                        <?php
                                                    }                
                                                ?>
                                                
                                                <!-- end slider item -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </section>
                    
                <?php
            }
            */
            $getBenefits	= $this->industries_model->getIndustriesBenefits($industries_url);
            if(count($getBenefits)>0)
            {
                $benefits_url = "uploads/industries/benefits/".$getBenefits[0]['header_id'].".png";

                ?>
                    <section class="position-relative  overflow-hidden">
                        <div class="container position-relative">
                            <div class="row align-items-center justify-content-center flex-column-reverse flex-md-row">
                                <div class="col-lg-6 text-center text-lg-start md-mb-30px">
                                    <img src="<?php echo base_url().$benefits_url;?>" class="md-w-70 sm-w-100" data-bottom-top="transform: translateY(-20px)" data-top-bottom="transform: translateY(20px)" alt="">
                                </div>
                                <div class="col-xl-5 col-lg-6 offset-xl-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    
                                <h4 class="text-dark-gray fw-700 mb-0 ls-minus-1px pb-5">Benefits </h4>
                                    <div class="row row-cols-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 800, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                        <!-- start process step item -->
                                        <?php 
                                            $Sno=1;
                                            foreach ($getBenefits as $benefits) 
                                            {
                                            ?>
                                                    <div class="col-12 process-step-style-05 position-relative hover-box">
                                                        <div class="process-step-item d-flex">
                                                            <div class="process-step-icon-wrap position-relative">
                                                                <div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-35px w-35px fs-12 bg-very-light-gray fw-700 alt-font position-relative">
                                                                    <span class="number position-relative z-index-1 text-dark-gray"><?php echo $Sno;?></span>
                                                                    <div class="box-overlay bg-base-color rounded-circle"></div>
                                                                </div>
                                                                <span class="progress-step-separator bg-dark-gray opacity-1"></span>
                                                            </div>
                                                            <div class="process-content ps-30px last-paragraph-no-margin mb-10px">
                                                                <span class="d-block fw-600 text-dark-gray mb-5px fs-19 alt-font"><?php echo ucfirst($benefits['line_title']) ;?></span>
                                                                <p class="w-100 xl-w-90 xs-w-100"><?php echo ucfirst($benefits['line_description']) ;?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                            $Sno++;
                                            }
                                        ?>
                                        
                                        <!-- end process step item -->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
            }

            ?>
                <section class="bg-very-light-green position-relative "  id="contactform">     
                    <div class="container">
                        <div class="row mb-8">
                            <div class="col-xl-5 col-lg-6 md-mb-50px" data-anime='{ "el": "childs", "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>  
                                <div class="bg-white border-radius-6px box-shadow-quadruple-large p-10 ps-12 pe-12 lg-ps-8 lg-pe-8 h-100 d-flex flex-wrap flex-column justify-content-center" data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                    <span class="ps-25px pe-25px mb-20px text-uppercase text-base-color fs-12 lh-40 fw-700 border-radius-100px bg-gradient-very-light-gray-transparent d-inline-flex align-self-start"><i class="bi bi-chat-square-dots fs-16 me-5px"></i>Lets's work together</span>
                                    <h5 class="text-dark-gray ls-minus-1px fw-700 mb-15px">Ready to accelerate your business success?</h5>
                                    <p class="w-100 sm-w-100">Connect with our experts to discuss how <?php echo ucfirst(SITE_NAME);?> can custom-made solutions to meet your specific needs.</p>

                                    <figure class="position-relative mb-0 overflow-hidden" data-shadow-animation="true" data-bottom-top="transform: translateY(70px)" data-top-bottom="transform: translateY(-70px)"> 
                                        <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/transform-ideas.png" class="w-100 border-radius-6px" alt=""> 
                                    
                                    </figure>
                                </div>
                            
                            </div>
                            <div class="col-lg-6 offset-xl-1 md-mb-50px sm-mb-0" data-anime='{ "el": "childs", "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                <h3 class="text-dark-gray ls-minus-2px fw-700">Looking for any help?</h3>
                                <form action="<?php echo base_url(); ?>industries-details/<?php echo $industries_url; ?>" method="post" class="contact-form-style-03" id="industriesForm" onsubmit="return submitForm(event);">
                                    <div class="position-relative form-group mb-0px">
                                        <!-- <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span> -->
                                        <input class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control pt-0 pb-0" id="first_name" type="text" name="first_name" placeholder="First Name *" />
                                        <h6 id="first_name_error" class="error-message"></h6>
                                    </div>
                                    <div class="position-relative form-group mb-0px">
                                        <!-- <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span> -->
                                        <input class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control pt-0 pb-0" id="last_name" type="text" name="last_name" placeholder="Last Name *" />
                                        <h6 id="last_name_error" class="error-message"></h6>
                                    </div>
                                    <div class="position-relative form-group mb-0px">
                                        <!-- <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span> -->
                                        <input class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control pt-0 pb-0" id="company_name" type="text" name="company_name" placeholder="Company Name *" />
                                        <h6 id="company_name_error" class="error-message"></h6>
                                    </div>
                                    <div class="position-relative form-group mb-0px">
                                        <input class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control pt-0 pb-0" id="company_email" type="email" name="company_email" placeholder="Email *" />
                                        <h6 id="company_email_error" class="error-message"></h6>
                                    </div>
                                    <div class="position-relative form-group mb-0px">
                                        <!-- <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span> -->
                                        <input class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control pt-0 pb-0" type="text" name="mobile_number" id="mobile_number" maxlength="10" minlength="10" placeholder="Mobile Number" oninput="validateNumber(this)" />
                                        <h6 class="error-message"></h6>
                                    </div>
                                    <div class="position-relative form-group form-textarea mb-0"> 
                                        <textarea class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control pt-0 pb-0" name="message" id="message" placeholder="Message" rows="3"></textarea>
                                        <!-- <span class="form-icon"><i class="bi bi-chat-square-dots text-dark-gray"></i></span> -->
                                    </div>
                                    <div class="position-relative form-group mb-0"> 
                                        <div class="row mt-5">
                                            <div class="col-lg-4 col-md-3 col-5 mt-1">
                                                <h6 id="mainCaptcha" style="color:#000; display:inline-block;"></h6>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-4 px-0 mt-1">
                                                <button type="button" id="refresh" onclick="Captcha();" class="refresh-btn" style="border:none; background:none;">
                                                    <img src="<?php echo base_url();?>assets/frontend/img/jesper/sync.png" alt="Sync Alt Icon" class="icon" style="width:20px;height:20px;">
                                                </button>
                                            </div>
                                            <div class="col-lg-7 col-md-8 col-12 mt-1">
                                                <input class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control pt-0 pb-0" id="captcha" type="text" name="captcha" placeholder="Captcha *" />
                                                <h6 id="captcha_error" class="error-message"></h6>
                                            </div>
                                        </div>
                                        <!-- <span class="form-icon"><i class="bi bi-chat-square-dots text-dark-gray"></i></span> -->
                                    </div>
                                    <div class="row mt-25px align-items-center">
                                        <div class="col-xl-7 col-lg-12 col-sm-7 lg-mb-30px md-mb-0">
                                            <p class="mb-0 fs-14 lh-22 text-center text-sm-start">We will never collect information about you without your explicit consent.</p>
                                        </div>
                                        <div class="col-xl-5 col-lg-12 col-sm-5 text-center text-sm-end text-lg-start text-xl-end xs-mt-25px">
                                            <input id="exampleInputEmail3" type="hidden" name="redirect" value="">
                                            <button class="btn bg-base-color btn-medium btn-round-edge btn-box-shadow submit" type="submit">Send message</button> 
                                        </div>
                                        <div class="col-12 mt-20px mb-0 text-center text-md-start">
                                            <div class="form-results d-none"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                </section>

            <?php
        }
        else
		{
			?>
				<div class="row mt-5 pt-5">
					<div class="col-md-12 text-center">
						<img src="<?php echo base_url(); ?>uploads/nodata.png" alt="No data available" style="width: 400px;height:400px">
					</div>
				</div>
			<?php
		}
    ?>

    
    
    <?php /*
        $succesStoriesLimit = 1;
        $getSuccessStories  = $this->successstories_model->getIndustrySuccessStories($industries_url,$succesStoriesLimit);

        if(count($getSuccessStories)>0)
        {
            ?>
                <section class="pt-0">
                    <div class="container">
                        <div class="row align-items-center border-radius-8px mt-0 ">
                            <div class="col-lg-6 md-mb-50px">
                                <div class="row --justify-content-center " data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <h4 class="fw-600 text-dark-gray mb-10px --text-center">Success stories</h4>
                                    <p class="w-80">Positive stories of change that will make your day, you've come to the right place!</p>
                                        <a href="<?php echo base_url();?>success-stories" class="btn btn-small bg-base-color btn-switch-text btn-box-shadow fw-400 ms-3">
                                            <span>
                                                <span class="btn-double-text" data-text="Explore Our Stories">Explore Our Stories</span>
                                                <span><i class="feather icon-feather-arrow-right"></i></span>
                                            </span>
                                        </a>
                                </div>
                            </div>
                            <div class="col-lg-6 md-mb-50px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <!-- start slider item -->
                                <!-- start blog item -->
                                <div class="blog-box d-sm-flex d-block flex-row h-100 border-radius-6px overflow-hidden box-shadow-extra-large">
                                    <div class="blog-image w-50 xs-w-100 cover-background" style="background-image: url('<?php echo base_url();?>uploads/successstories_image/<?php echo $getSuccessStories[0]['successstories_id'];?>.png')">
                                        <a href="#" class="blog-post-image-overlay"></a>
                                    </div>
                                    <div class="blog-content w-50 xs-w-100 pt-50px pb-40px ps-40px pe-40px xl-p-20px md-p-20px bg-white d-flex flex-column justify-content-center align-items-start last-paragraph-no-margin">
                                        <div class="mb-10px">
                                            <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                                            <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle"><?php echo ucfirst($getSuccessStories[0]['industries_name']) ;?>
                                            </span>
                                        </div>
                                        <a href="#l" class="card-title text-dark-gray text-dark-gray-hover fw-500 mb-10px fs-19 md-fs-18 alt-font ws-minus-3px"><?php echo ucfirst($getSuccessStories[0]['title']) ;?></a>
                                        <!-- <p>Inefficient supply chain processes leading to delays and increased costs...</p> -->
                                    </div>
                                    <!-- end blog item -->
                                </div>
                                <!-- end slider item -->
                                <!-- start slider item -->
                            </div>
                        </div>
                    </div>
                </section>
            <?php
        }
    */ ?>
    <!-- end section -->

    <!-- start section --> 
    
    <style>
        .blog-title-scroll {
            max-height: 80px;
            min-height: 80px;
        }
        .case-study-title-scroll {
            max-height: 150px;
            min-height: 150px;
        }

    </style>
    <script>
        $(document).ready(function () {
            // Generate Captcha on page load
            Captcha();

            // Input event listeners for validation
            $('#first_name').on('input', function () {
                this.value = this.value.replace(/\d/g, ''); // Remove numbers
                validateName($(this).val(), 'first_name','First Name');
            });

            $('#last_name').on('input', function () {
                this.value = this.value.replace(/\d/g, ''); // Remove numbers
                validateName($(this).val(), 'last_name','Last Name');
            });

            $('#company_name').on('input', function () {
                validateCompanyName($(this).val());
            });

            $('#company_email').on('input', function () {
                validateEmail($(this).val());
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
        function validateName(name, fieldId, fieldError) {
            const namePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
            if (name === '') {
                $('#' + fieldId + '_error').text('Please enter your ' + fieldError + '.');
                $('#' + fieldId).addClass('is-invalid');
            } else if (!namePattern.test(name)) {
                $('#' + fieldId + '_error').text('Invalid name format.');
                $('#' + fieldId).addClass('is-invalid');
            } else {
                $('#' + fieldId + '_error').text('');
                $('#' + fieldId).removeClass('is-invalid');
            }
        }

        function validateCompanyName(company_name) {
            const companyNamePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
            if (company_name === '') {
                $('#company_name_error').text('Please enter your company name.');
                $('#company_name').addClass('is-invalid');
            } 
            else if (!companyNamePattern.test(company_name)) {
                $('#company_name_error').text('Invalid company name format.');
                $('#company_name').addClass('is-invalid');
            }
            else {
                $('#company_name_error').text('');
                $('#company_name').removeClass('is-invalid');
            }
        }

        function validateEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '') {
                $('#company_email_error').text('Please enter your email.');
                $('#company_email').addClass('is-invalid');
            } else if (!emailPattern.test(email)) {
                $('#company_email_error').text('Please enter a valid email address.');
                $('#company_email').addClass('is-invalid');
            } else {
                $('#company_email_error').text('');
                $('#company_email').removeClass('is-invalid');
            }
        }

        function validateCaptcha(captchaValue) {
            const generatedCaptcha = $('#mainCaptcha').text().trim();
            if (captchaValue === '') {
                $('#captcha_error').text('Please enter the captcha.');
                $('#captcha').addClass('is-invalid');
            } else if (captchaValue !== generatedCaptcha) {
                $('#captcha_error').text('Captcha is incorrect.');
                $('#captcha').addClass('is-invalid');
            } else {
                $('#captcha_error').text('');
                $('#captcha').removeClass('is-invalid');
            }
        }

        // Form Submission Validation
        function submitForm(event) {
            event.preventDefault(); // Prevent default form submission

            validateName($('#first_name').val(), 'first_name','First Name');
            validateName($('#last_name').val(), 'last_name','Last Name');
            validateCompanyName($('#company_name').val());
            validateEmail($('#company_email').val());
            validateCaptcha($('#captcha').val());

            // Check if any field has errors
            if ($('.is-invalid').length === 0) {
                $('#industriesForm')[0].submit(); // Submit form if valid
            }
            return false; // Prevent default submission
        }

    </script>
        <!-- end section -->
</body>