<body data-mobile-nav-style="classic" class="custom-cursor">
    <?php 
        $getProductDetails = $this->products_model->getProductDetailsAll($product_url);

        if(count($getProductDetails)>0)
        {
            $product_image_url        = "uploads/products/product_details/banner/".$getProductDetails[0]['product_detail_id'].".png";
            $product_detail_url         = "uploads/products/product_details/".$getProductDetails[0]['product_detail_id'].".png"
            ?>
                <!-- start banner -->
                <section class="full-screen ipad-top-space-margin position-relative overflow-hidden sm-h-auto">
                    <div class="container-fluid p-0 h-100 position-relative">
                        <div class="row h-auto g-0">
                            <div class="col-12 col-md-6 bg-base-color bg-sliding-line d-flex justify-content-center flex-column p-10 position-relative xl-p-6 md-p-5 sm-ps-30px sm-pe-30px  sm-pt-50px sm-pb-50px order-2 order-md-1">
                                <div class="vertical-title-center align-items-end w-75px sm-w-60px justify-content-center position-absolute pb-50px sm-pb-30px right-3px">
                                    <!-- <div class="title fs-16 text-dark-gray fw-700 text-uppercase ls-1px text-uppercase" data-fancy-text='{ "opacity": [0, 1], "translateY": [50, 0], "filter": ["blur(20px)", "blur(0px)"], "string": ["Smart. Seamless. Secure."], "duration": 400, "delay": 0, "speed": 50, "easing": "easeOutQuad" }'></div> -->
                                </div>
                                <!-- <div class="separator-line h-120px w-2px bg-base-color position-absolute bottom-0px right-80px sm-right-60px"></div> -->
                                <div class="fs-45 sm-fs-40 lh-65 --fw-600 text-dark-gray mb-30px sm-mb-30px alt-font --ls-minus-8px sm-ls-minus-2px" data-anime='{ "el": "childs", "translateX": [80, 0], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <div class="d-inline-block position-relative z-index-9">
                                        <h1 class="highlight-separator fs-55 mb-0" data-shadow-animation="true" data-animation-delay="1000"><?php echo ucfirst($getProductDetails[0]['product_name']) ;?></h1> 
                                    </div>
                                </div>
                                <div class="fs-18 sm-fs-18 text-dark-gray mb-20px w-70 xxl-w-100 lg-w-100 sm-w-90 d-block" data-anime='{ "el": "childs", "translateX": [110, 0], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <span class="d-inline-block opacity-8"><?php echo ucfirst($getProductDetails[0]['title_description']) ;?></span>
                                </div>
                                <div class="icon-with-text-style-08" data-anime='{ "el": "childs", "translateX": [140, 0], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <div class="feature-box feature-box-left-icon-middle">
                                        <div class="feature-box-icon feature-box-icon-rounded w-55px h-55px rounded-circle bg-base-color me-15px rounded-box">
                                            <a href="#contact"> <i class="feather icon-feather-arrow-down text-dark icon-small"></i></a>
                                        </div>
                                        <div class="feature-box-content">
                                            <a href="#contact" class="d-inline-block fs-20 ls-minus-05px alt-font fw-600 text-dark-gray text-dark-gray-hover">Book a Demo</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 position-relative order-1 order-md-2">

                                <div class="swiper h-100 banner-slider sm-h-450px swiper-light-pagination" data-slider-options='{ "slidesPerView": 1, "loop": true, "pagination": { "el": ".swiper-pagination-bullets", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "stopOnLastSlide": true, "disableOnInteraction": false },"keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "fade" }'>
                                    <div class="swiper-wrapper">
                                        <!-- start slider item -->
                                        <div class="swiper-slide">
                                            <div class="position-absolute left-0px top-0px w-100 h-100 cover-background"
                                                style="background-image:url('<?php echo base_url().$product_image_url;?>');"></div>
                                        </div>
                                        >
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end banner -->

                <!-- start section -->
                <section>
                    <div class="container">
                        <div class="row align-items-center justify-content-center" data-anime='{ " perspective": 1200 }'>
                            <div class="col-lg-6 md-mb-40px" data-anime='{ "translateY": [0, 0], "zoom": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <figure class="position-relative m-0">
                                    <img src="<?php echo base_url().$product_detail_url;?>" alt="" class="w-100 border-radius-5px">

                                </figure>
                            </div>
                            <div class="col-xl-5 offset-xl-1 col-lg-6 col-md-12" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div class="mb-10px">
                                    <span class="w-30px h-2px fs-15 d-inline-block bg-base-color me-5px align-middle"></span>
                                    <span class="text-uppercase text-green fs-16 fw-600 d-inline-block"><?php echo ucfirst($getProductDetails[0]['product_name']) ;?></span>
                                </div>
                                <h3 class="text-dark-gray fw-700 ls-minus-2px"><?php echo ucfirst($getProductDetails[0]['why_choose_title']) ;?></h3>
                                <p class="w-90 md-w-100 mb-35px"><?php echo ucfirst($getProductDetails[0]['why_choose_jesperapps']) ;?></p>

                            </div>
                        </div>
                    </div>
                </section>
               
                <!-- end section -->
                <?php 
                    $getKeyFeatures = $this->products_model->getKeyFeaturesAll($product_url);

                    if (count($getKeyFeatures) > 0) 
                    {
                        ?>
                            <section class="pt-0" style="background-image: url('<?php echo base_url(); ?>assets/frontend/img/jesper/demo-it-business-testimonial-bg.png')">
                               
                            <div class="container pt-0">
                                    <div class="row justify-content-center  ">
                                        <div class="col-xxl-4 col-lg-5 col-md-6 col-sm-7 text-center">
                                            <!-- <span class="fs-15 mb-5px text-green fw-500 d-block text-uppercase ls-2px">What we offer</span> -->
                                            <h3 class="fw-700 text-dark-gray"><?php echo $getKeyFeatures[0]['title'] ;?></h3>
                                        </div>
                                    </div>
                                    <?php 
                                        foreach ($getKeyFeatures as $index => $feature) 
                                        { 
                                            $isEven = $index % 2 === 0;

                                            if ($isEven) 
                                            { 
                                                $url = 'uploads/products/key_features/'.$feature['line_id'].'.png';
                                                ?> 
                                                 <div class="row mt-5 align-items-center justify-content-center"> 
                                                <div class="col-lg-6 md-mb-50px position-relative" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 50, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                                    <div class="atropos" data-atropos data-atropos-perspective="2450">
                                                        <div class="atropos-scale">
                                                            <div class="atropos-rotate">
                                                                <div class="atropos-inner">
                                                                    <img src="<?php echo base_url() . $url; ?>" alt="" class="border-radius-6px"/>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div> 
                                                   
                                                </div>
                                                <div class="col-xl-5 offset-xl-1 col-lg-6" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 1200, "delay": 150, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                                <span class="fs-18 fw-600 text-dark-gray mb-20px d-flex align-items-center"><span class="text-center w-60px h-60px d-flex justify-content-center align-items-center rounded-circle bg-light-sea-green-transparent-light align-middle me-15px"><i class="bi bi-layout-text-sidebar-reverse text-base-color fs-20"></i></span>Key Features</span> 

                                                    <h3 class="--fw-800 text-dark-gray ls-minus-2px"><?php echo ucfirst($feature['line_title']); ?></h3> 
                                                    <p class="mb-35px md-mb-30px w-90 lg-w-100"><?php echo ucfirst($feature['detail_description']); ?></p> 
                                                    
                                                </div>  
                                            </div>

                                                  
                                                <?php
                                            }
                                            else 
                                            { 
                                                $url = 'uploads/products/key_features/'.$feature['line_id'].'.png';

                                                ?>
                                                    <div class="row mt-5 g-0  align-items-center justify-content-center border-radius-6px overflow-hidden d-flex flex-column-reverse flex-md-row" id="luxury"
                                                        data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                                        <div class="col-xl-5 --offset-xl-1 col-lg-6" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 1200, "delay": 150, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                                    <span class="fs-18 fw-600 text-dark-gray mb-20px d-flex align-items-center"><span class="text-center w-60px h-60px d-flex justify-content-center align-items-center rounded-circle bg-light-sea-green-transparent-light align-middle me-15px"><i class="bi bi-layout-text-sidebar-reverse text-base-color fs-20"></i></span>Key Features</span> 
                                                    <h3 class="--fw-800 text-dark-gray ls-minus-2px"><?php echo ucfirst($feature['line_title']); ?></h3> 
                                                    <p class="mb-35px md-mb-30px w-90 lg-w-100"><?php echo ucfirst($feature['detail_description']); ?></p> 
                                                    
                                                </div>  
                                                        <div class="col-lg-6 md-mb-50px position-relative" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 50, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                                    <div class="atropos" data-atropos data-atropos-perspective="2450">
                                                        <div class="atropos-scale">
                                                            <div class="atropos-rotate">
                                                                <div class="atropos-inner">
                                                                    <img src="<?php echo base_url() . $url; ?>" alt="" class="border-radius-6px"/>
                                                                </div>
                                                            </div> 
                                                        </div>
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

	                $getBenefits = $this->products_model->getBenefitsAll($product_url);

                    if(count($getBenefits)>0)
                    {
                        $url = "uploads/products/benefits/banner/".$getBenefits[0]['header_id'].".png";

                        ?>
                            <section class="bg-very-light-green pb-0 background-no-repeat background-position-left-top position-relative" style="background-image: url('images/demo-it-business-about-bg2.jpg')">
                                <div class="container">
                                    <div class="row align-items-center justify-content-center mb-7">
                                        <div class="col-xl-5 col-lg-6 mb-30px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                            <h3 class=" fs-32 text-dark-gray fw-700 ls-minus-2px mb-50px"><?php echo $getBenefits[0]['title'] ?></h3>
                                            <div class="row row-cols-1">
                                                <!-- start process step item -->
                                                <?php 
                                                    $benefitsSno=1;
                                                    foreach ($getBenefits as $benefits) 
                                                    {
                                                        // $url = 'uploads/products/benefits/'.$benefits['line_id'].'.png'
                                                        ?>
                                                            <div class="col-12 process-step-style-05 position-relative hover-box">
                                                                <div class="process-step-item d-flex">
                                                                    <div class="process-step-icon-wrap position-relative">
                                                                        <div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px fs-14 bg-white position-relative box-shadow-bottom will-change-transform">
                                                                            <span class="number position-relative z-index-1 text-dark-gray fw-600"><?php echo $benefitsSno ;?></span>
                                                                            <div class="box-overlay bg-base-color rounded-circle"></div>
                                                                        </div>
                                                                        <span class="progress-step-separator bg-base-color opacity-1"></span>
                                                                    </div>
                                                                    <div class="process-content ps-35px sm-ps-25px last-paragraph-no-margin mb-40px">
                                                                        <span class="d-block fw-600 text-dark-gray fs-17 mb-5px"><?php echo ucfirst($benefits['line_title']) ;?></span>
                                                                        <p class="w-100 sm-w-100"><?php echo ucfirst($benefits['line_description']) ;?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        $benefitsSno++;
                                                    }
                                                    
                                                ?>
                                                <!-- end process step item -->
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 text-center md-mb-20px offset-xl-1">
                                            <figure class="position-relative mb-0 overflow-hidden" data-shadow-animation="true" data-bottom-top="transform: translateY(70px)" data-top-bottom="transform: translateY(-70px)">
                                                <img src="<?php echo base_url().$url;?>" class="w-100 border-radius-6px" alt="">

                                            </figure>
                                        </div>
                                    </div>

                                </div>

                            </section>
                        <?php
                    }

                    $getDetails = $this->products_model->getDetailsAll($product_url);

                    if(count($getDetails)>0)
                    {
                        $url = 'uploads/products/details/header_img/'.$getDetails[0]['header_id'].'.png'
                        ?>
                            <section class="position-relative pt-0 overflow-hidden">
                                <div class="container position-relative">
                                    <div class="row align-items-center justify-content-center d-flex flex-column-reverse flex-md-row">
                                        <div class="col-lg-6 text-center text-lg-start md-mb-30px">
                                            <img src="<?php echo base_url() . $url; ?>" class="md-w-70 sm-w-100" data-bottom-top="transform: translateY(-20px)" data-top-bottom="transform: translateY(20px)" alt="">
                                        </div>
                                        <div class="col-xl-5 col-lg-6 offset-xl-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                            <h4 class="fw-700 --alt-font text-dark-gray ls-minus-1px mb-30px sm-mb-30px"><?php echo ucfirst($getDetails[0]['title']);?><span class="bg-base-color opacity-3 h-10px bottom-10px"></span></span></h4>
                                            <div class="row row-cols-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 800, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                                <!-- start process step item -->
                                                <?php 
                                                    $detailSno=1;
                                                    foreach ($getDetails as $details) 
                                                    {
                                                       ?>
                                                            <div class="col-12 process-step-style-05 position-relative hover-box">
                                                                <div class="process-step-item d-flex">
                                                                    <div class="process-step-icon-wrap position-relative">
                                                                        <div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-65px w-65px fs-16 bg-very-light-gray fw-700 alt-font position-relative">
                                                                            <span class="number position-relative z-index-1 text-dark-gray"><?php echo $detailSno; ?></span>
                                                                            <div class="box-overlay bg-base-color rounded-circle"></div>
                                                                        </div>
                                                                        <span class="progress-step-separator bg-base-color opacity-1"></span>
                                                                    </div>
                                                                    <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                                                        <span class="d-block fw-600 text-dark-gray mb-5px fs-18 alt-font"><?php echo ucfirst($details['line_title']);?></span>
                                                                        <p class="w-100 xl-w-90 xs-w-100"><?php echo ucfirst($details['line_description']);?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       <?php
                                                       $detailSno++;
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
               

                <section class="pt-0">
                    <div class="container">
                        <div class="row align-items-center" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <div class="col-12">
                                <div class="bg-very-light-green p-5 md-p-6 xs-p-9 border-radius-6px overflow-hidden position-relative">
                                    <div class="position-absolute right-70px lg-right-20px top-minus-20px w-250px sm-w-180px xs-w-150px opacity-1"><img src="https://via.placeholder.com/237x236" alt=""></div>
                                    <span class="text-uppercase text-green fs-16 fw-600 d-inline-block"><?php echo ucfirst($getProductDetails[0]['product_name']) ;?></span>
                                    <h3 class="fw-700 text-dark-gray ls-minus-2px"><?php echo ucfirst($getProductDetails[0]['remarks_title']) ;?></h3>
                                    <p><?php echo ucfirst($getProductDetails[0]['remarks']) ;?></p>

                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- end section -->

                <!-- start section -->
                <section class="overflow-hidden pt-0" id="contact">
                    <div class="container">
                        <div class="row justify-content-center align-items-center mb-9 sm-mb-45px">
                            <div class="col-xxl-5 col-lg-6 md-mb-50px" data-anime='{ "el": "childs", "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Get in touch with us</span>
                                <h3 class="fw-700 text-dark-gray ls-minus-1px mb-20px sm-mb-35px">Ready to transform your business?</h3>
                                <p class="w-80 xl-w-90 xs-w-100">Contact us today to discuss how JesperApps can empower your organization.</p>
                            </div>
                            <div class="col-lg-6 offset-xxl-1" data-anime='{ "el": "childs", "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                <div class="contact-form-style-03 position-relative border-radius-10px bg-white p-14 lg-p-10 box-shadow-double-large overflow-hidden last-paragraph-no-margin">
                                    <h5 class="fw-700 text-dark-gray mb-30px sm-mb-20px fancy-text-style-4 ls-minus-2px">Take the next step!
                                        <span data-fancy-text='{ "effect": "rotate", "string": ["professional !", "customized solutions!"] }'></span>
                                    </h5>
                                    <form action="<?php echo base_url(); ?>product-details/<?php echo $product_url; ?>" method="post" id="productForm" onsubmit="return submitForm(event);">
                                        <div class="position-relative form-group mb-0px">
                                            <!-- <span class="form-icon text-dark-gray"><i class="bi bi-person icon-extra-medium"></i></span> -->
                                            <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="text" name="first_name" id="first_name" placeholder="First Name *" />
                                            <h6 id="first_name_error" class="error-message"></h6>
                                        </div>
                                        <div class="position-relative form-group mb-0px">
                                            <!-- <span class="form-icon text-dark-gray"><i class="bi bi-person icon-extra-medium"></i></span> -->
                                            <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="text" name="last_name" id="last_name" placeholder="Last Name *" />
                                            <h6 id="last_name_error" class="error-message"></h6>
                                        </div>
                                        <div class="position-relative form-group mb-0px">
                                            <!-- <span class="form-icon text-dark-gray"><i class="bi bi-person icon-extra-medium"></i></span> -->
                                            <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="text" name="company_name" id="company_name" placeholder="Company Name *" />
                                            <h6 id="company_name_error" class="error-message"></h6>
                                        </div>
                                        <div class="position-relative form-group mb-0px">
                                            <!-- <span class="form-icon text-dark-gray"><i class="bi bi-person icon-extra-medium"></i></span> -->
                                            <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="text" name="company_email" id="company_email" placeholder="Email *" />
                                            <h6 id="company_email_error" class="error-message"></h6>
                                        </div>
                                        <div class="position-relative z-index-1 form-group form-textarea mt-15px mb-0">
                                            <textarea class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" name="message" id="message" placeholder="Message" rows="3"></textarea>
                                            <!-- <span class="form-icon text-dark-gray"><i class="bi bi-chat-square-dots icon-extra-medium"></i></span> -->
                                            <input type="hidden" name="redirect" value="">
                                        </div>
                                        <div class="position-relative z-index-1 form-group form-textarea mt-15px mb-0"> 
                                            <div class="row mt-5">
                                                <div class="col-lg-5 col-md-3 col-5 mt-1">
                                                    <h6 id="mainCaptcha" style="color:#000; display:inline-block;"></h6>
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-4 px-0 mt-1">
                                                    <button type="button" id="refresh" onclick="Captcha();" class="refresh-btn" style="border:none; background:none;">
                                                        <img src="<?php echo base_url();?>assets/frontend/img/jesper/sync.png" alt="Sync Alt Icon" class="icon" style="width:20px;height:20px;">
                                                    </button>
                                                </div>
                                                <div class="col-lg-6 col-md-8 col-12 mt-1">
                                                    <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="text" name="captcha" id="captcha" placeholder="Captcha *" />
                                                    <h6 id="captcha_error" class="error-message" style="text-align:left;color:red;"></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-relative z-index-1 form-group form-textarea mt-15px mb-0">
                                            <button class="btn btn-large btn-dark-gray btn-round-edge btn-box-shadow mb-20px mt-25px submit w-100" type="submit">Send message</button>
                                            <div class="form-results mt-20px d-none"></div>
                                        </div>
                                    </form>
                                    
                                    <div class="position-absolute bottom-0px right-minus-30px fs-350 lh-100 fw-900 text-yellow">&lt;</div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </section>
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
                    function validateName(name, fieldId,fieldError) {
                        const namePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
                        if (name === '') {
                            $('#' + fieldId + '_error').text('Please enter your ' + fieldError +'.');
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
                            $('#productForm')[0].submit(); // Submit form if valid
                        }
                        return false; // Prevent default submission
                    }

                </script>
                <!-- end section -->
            <?php
        }
    ?>
    
</body><style>
    @media (max-width: 991px) {
    .ipad-top-space-margin {
    
        margin-top: 35px !important;
    }
}
</style>