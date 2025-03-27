

    <body data-mobile-nav-style="classic">  
        <!-- start header -->
      
        <!-- end header --> 
        <!-- start section -->
    <section class="section-dark p-0 bg-dark-gray">
        <div class="swiper lg-no-parallax --magic-cursor full-screen md-h-600px sm-h-500px ipad-top-space-margin swiper-light-pagination" data-slider-options='{ "slidesPerView": 1, "loop": true, "parallax": true, "speed": 1000, "pagination": { "el": ".swiper-pagination-bullets", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
            <div class="swiper-wrapper">
                <!-- start slider item -->
                <div class="swiper-slide overflow-hidden">
                    <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url('<?php echo base_url(); ?>assets/frontend/img/h1.jpg');">
                        <!-- Full image overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to right, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9)); z-index: 1;"></div>

                        <!-- Content -->
                        <div class="container h-100" data-swiper-parallax="-500" style="position: relative; z-index: 2;">
                            <div class="row align-items-center h-100">

                                <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-dark text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <div class="container h-100" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)">
                                        <div class="row align-items-center justify-content-center one-half-screen sm-h-350px">
                                            <div class="col-12">
                                                <span class="fancy-text-style-4">
                                                    <span class="fs-75 xl-fs-110 lg-fs-90 md-fs-80 xs-fs-60 fs-500 mb-0 text-dark-gray fw-300 ls-minus-4px d-block">Great design made <span class="fw-600" data-fancy-text='{ "effect": "wave", "direction": "up", "speed": 20, "string": ["affordable", "simple", "creative"], "duration": 2500 }'></span> for you.</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-absolute left-0px top-0px h-100 w-130px d-none d-xl-inline-block" data-anime='{ "translateX": [-30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>

                                    </div>
                                    <a href="home.html" target="_blank" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Get started now<span class="bg-white text-base-color"><i class="fas fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>

                        <!-- Three boxes on the right side -->
                        <div
                            style="position: absolute; top: 50%; right: 50px; transform: translateY(-50%); z-index: 3; display: flex; flex-direction: column; gap: 20px;">
                            <!-- Blue Box -->
                            <div
                                class="hover-box"
                                style="width: 250px; height: 250px; background-color: rgba(0, 0, 255, 0.3); border-radius: 10px; position: absolute; left: -155px; overflow: hidden;"
                                data-bg="<?php echo base_url(); ?>assets/frontend/img/h1.jpg">
                            </div>

                            <!-- Green Box 1 -->
                            <div
                                class="hover-box"
                                style="width: 120px; height: 120px; background-color: rgba(0, 255, 0, 0.3); border-radius: 10px; position: absolute; left: -250px; top: -55px; overflow: hidden;"
                                data-bg="<?php echo base_url(); ?>assets/frontend/img/h1.jpg">
                            </div>

                            <!-- Green Box 2 -->
                            <div
                                class="hover-box"
                                style="width: 200px; height: 200px; background-color: rgba(0, 255, 0, 0.3); border-radius: 10px; position: relative; top: 150px; right: 280px; overflow: hidden;"
                                data-bg="<?php echo base_url(); ?>assets/frontend/img/h1.jpg">
                            </div>
                        </div>

                        <style>
                            .hover-box {
                                background-size: cover;
                                background-position: center;
                                background-repeat: no-repeat;
                                transition: transform 0.3s ease, background 0.3s ease;
                            }

                            .hover-box:hover {
                                background-color: transparent;
                                /* Remove initial color */
                                transform: scale(1.1);
                                /* Zoom effect */
                            }
                        </style>

                        <script>
                            // Dynamically set the background image for each hover box using data-bg attribute
                            document.querySelectorAll('.hover-box').forEach((box) => {
                                box.addEventListener('mouseenter', () => {
                                    box.style.backgroundImage = `url(${box.getAttribute('data-bg')})`;
                                });
                            });
                        </script>


                    </div>
                </div>
                <!-- end slider item -->
            </div>
            <!-- start slider pagination -->
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
            <!-- end slider pagination -->
        </div>
    </section>

     
        <!-- start section -->
        <section class="pb-8 md-pb-17 xs-pb-28">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-9 md-mb-50px text-center text-lg-start" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">Get to Know Us</span>
                        <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px mb-20px sm-w-85 xs-w-100 mx-auto">We Make IT Happen</h3>
                        <p>Our mission is simple yet impactful: to empower businesses worldwide with exceptional consultation and technology solutions that fuel growth and success. As your trusted partner, we ignite innovation, tackle challenges head-on, and pave the way for your long-term success.</p>
                       
						<div class="mb-40px sm-mb-30px">
                            <!-- start features box item -->
                            <div class="icon-with-text-style-08 mb-25px">
                                <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                                    <div class="feature-box-icon feature-box-icon-rounded w-50px h-50px rounded-circle bg-very-light-gray me-20px text-center"><i class="fa-solid fa-check fs-16 text-base-color"></i></div>
                                    <div class="feature-box-content last-paragraph-no-margin">
                                        <span class="fs-17 fw-600 text-dark-gray">Innovative Solutions</span>
                                        <p>We deliver cutting-edge technology tailored to your needs.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end features box item -->
                            <!-- start features box item -->
                            <div class="icon-with-text-style-08">
                                <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                                    <div class="feature-box-icon feature-box-icon-rounded w-50px h-50px rounded-circle bg-very-light-gray me-20px text-center"><i class="fa-solid fa-check fs-16 text-base-color"></i></div>
                                    <div class="feature-box-content last-paragraph-no-margin">
                                        <span class="fs-17 fw-600 text-dark-gray">
										Problem Solvers</span>
                                        <p>We tackle your unique business challenges with precision.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end features box item -->
                        </div>
                        <a href="about-us.html" class="btn btn-extra-large btn-gradient-purple-pink btn-hover-animation-switch btn-rounded btn-box-shadow btn-icon-left me-30px">
                            <span> 
                                <span class="btn-text">Explore More</span>
                                <span class="btn-icon"><i class="feather icon-feather-briefcase"></i></span>
                                <span class="btn-icon"><i class="feather icon-feather-briefcase"></i></span>
                            </span>
                        </a>
                    </div>
                    <div class="col-xl-6 col-lg-6 offset-xl-1 position-relative">
                        <div class="text-end w-80 md-w-75 ms-auto" data-animation-delay="500" data-shadow-animation="true" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)">
                            <img src="<?php echo base_url();?>assets/frontend/img/demo-business-company-02.jpg" alt="" class="border-radius-5px">
                        </div>
                        <div class="w-60 md-w-50 xs-w-55 overflow-hidden position-absolute left-15px bottom-minus-50px" data-shadow-animation="true" data-animation-delay="500" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
                            <img src="<?php echo base_url();?>assets/frontend/img/demo-business-company-01.jpg" alt="" class="border-radius-5px box-shadow-quadruple-large" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="bg-gradient-tranquil-white overflow-hidden position-relative overlap-height pb-5 md-pb-7 xs-pb-50px">
            <div class="container overlap-gap-section">
                <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                    <div class="col-xxl-8 col-md-7 sm-mb-10px">
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Service we offered</h2>
						<p>Unlock the Full Potential of
						Your Business with Our Expertise</p>
                    </div>
                    <div class="col-xxl-4 col-md-5 text-center text-md-end" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                       
                    </div>
                </div>
                <div class="row">  
                    <div class="col-12">
                        <ul class="blog-masonry blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-4col md-grid-2col sm-grid-1col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                            <li class="grid-sizer"></li>
                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                   
                                    <div class="blog-image position-relative overflow-hidden">
                                        <a href="demo-elearning-blog-single-simple.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-elearning-07.jpg" alt="" /></a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="post-content p-11 md-p-9">
                                            <a href="demo-elearning-blog-single-simple.html" class="card-title mb-10px fw-600 fs-17 lh-28 text-dark-gray d-inline-block">Consulting Services</a>
                                            <p class="mb-0" style="max-height: 180px;min-height: 180px;">Oracle Solutions Streamline your enterprise systems with our expert Oracle consulting services.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                   
                                    <div class="blog-image position-relative overflow-hidden">
                                        <a href="demo-elearning-blog-single-simple.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-elearning-07.jpg" alt="" /></a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="post-content p-11 md-p-9">
                                            <a href="demo-elearning-blog-single-simple.html" class="card-title mb-10px fw-600 fs-17 lh-28 text-dark-gray d-inline-block">Digital Transformation</a>
                                            <p class="mb-0" style="max-height: 180px;min-height: 180px;">Redefine your business processes with our end-to-end digital transformation solutions.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                   
                                    <div class="blog-image position-relative overflow-hidden">
                                        <a href="demo-elearning-blog-single-simple.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-elearning-07.jpg" alt="" /></a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="post-content p-11 md-p-9">
                                            <a href="demo-elearning-blog-single-simple.html" class="card-title mb-10px fw-600 fs-17lh-28 text-dark-gray d-inline-block">Cloud Integration</a>
                                            <p class="mb-0" style="max-height: 180px;min-height: 180px;">Seamless integration with AWS, Azure, and Google Cloud for robust infrastructure and scalability.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
							<li class="grid-item">
                                <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                   
                                    <div class="blog-image position-relative overflow-hidden">
                                        <a href="demo-elearning-blog-single-simple.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-elearning-07.jpg" alt="" /></a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="post-content p-11 md-p-9">
                                            <a href="demo-elearning-blog-single-simple.html" class="card-title mb-10px fw-600 fs-17 lh-28 text-dark-gray d-inline-block">Data Science & Analytics</a>
                                            <p class="mb-0" style="max-height: 180px;min-height: 180px;">Unlock insights with tools like Power BI, Tableau, Databricks, and Snowflake.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                        </ul>
                    </div>
                </div>
              
            </div>
        </section>
        <!-- end section -->
		<section class="background-position-center-top overflow-hidden" style="background-image: url('images/demo-architecture-dotted-pattern.svg');background-color:#edf9fa">
        <img src="<?php echo base_url();?>assets/frontend/img/demo-corporate-bg-01.png" class="position-absolute top-minus-150px left-minus-30px z-index-minus-1 skrollable skrollable-between" data-bottom-top="transform: rotate(0deg) translateY(0)" data-top-bottom="transform:rotate(-20deg) translateY(0)" alt="" data-no-retina="" style="transform: rotate(-9.43057deg) translateY(0px);">   
        <div class="container">
                <div class="row align-items-end mb-6">
                    <div class="col-md-6 sm-mb-20px" data-anime='{ "el": "childs", "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <span class="--text-base-color fs-12 fw-600 ls-3px text-uppercase mb-5px d-block">Industries Served</span>
                        <h4 class="text-dark fw-600 mb-0">We specialize in providing tailored
						solutions to industries such as</h4>
                    </div>
                    <div class="col-md-5 offset-md-1 last-paragraph-no-margin" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    </div>
                </div>
                <div class="row align-items-center mb-9">
                    <div class="col-md-12 position-relative" data-anime='{ "translateX": [150, 0], "opacity": [0,1], "duration": 1200, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <div class="outside-box-right-30 sm-outside-box-right-0">
                            <div class="swiper slider-three-slide --magic-cursor drag-cursor" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 35, "loop": true, "autoplay": { "delay": 4000, "disableOnInteraction": false }, "pagination": { "el": ".slider-four-slide-pagination-1", "clickable": true, "dynamicBullets": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1200": { "slidesPerView": 4 }, "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 3 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                                <div class="swiper-wrapper">
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide"> 
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
                                                <img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
                                                <div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon text-white icon-hover-base-color position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Structure icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Architecture</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide">
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
                                                <img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
                                                <div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon text-white icon-hover-base-color position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Cursor-Select icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Residential space</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide">
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
											<img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
											<div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon icon-hover-base-color text-white position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Full-View icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Interior design</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide">
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
											<img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
											<div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon icon-hover-base-color text-white position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Duplicate-Layer icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Exterior planning</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide"> 
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
											<img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
											<div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon text-white icon-hover-base-color position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Structure icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Architecture</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide">
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
											<img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
											<div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon text-white icon-hover-base-color position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Cursor-Select icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Residential space</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide">
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
											<img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
											<div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon icon-hover-base-color text-white position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Full-View icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Interior design</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                    <!-- start content carousal item --> 
                                    <div class="swiper-slide">
                                        <div class="interactive-banner-style-06">                                    
                                            <div class="interactive-banners-image">
											<img src="<?php echo base_url();?>assets/frontend/img/demo-architecture-home-06.jpg" alt="" />
											<div class="overlay-bg bg-gradient-dark-transparent opacity-light"></div>
                                                <a href="demo-architecture-services.html" class="banners-icon icon-hover-base-color text-white position-absolute top-60px left-60px lg-top-30px lg-left-30px">
                                                    <i class="line-icon-Duplicate-Layer icon-large"></i>
                                                </a>
                                            </div>
                                            <div class="interactive-banners-content p-60px lg-p-30px"> 
                                                <div class="h-100 w-100 last-paragraph-no-margin"> 
                                                    <a href="demo-architecture-services.html" class="fs-22 d-block text-white mb-10px fw-500">Exterior planning</a>
                                                    <p class="interactive-banners-content-text w-95 lg-w-100">Lorem ipsum consectetur elit do eiusmod tempor incididunt.</p>
                                                </div> 
                                            </div>
                                            <div class="box-overlay bg-gradient-dark-transparent"></div>
                                        </div>
                                    </div>
                                    <!-- end content carousal item -->
                                </div>
                            </div>
                        </div>
                        <!-- start slider pagination -->
                        <!--<div class="swiper-pagination slider-four-slide-pagination-1 swiper-pagination-style-2 swiper-pagination-clickable swiper-pagination-bullets"></div>-->
                        <!-- end slider pagination --> 
                    </div>
                </div>
             
            </div>
        </section>
       
    
       
            <!-- end page title -->
            <section class="half-section page-title-center-alignment top-space-margin"> 
                <div class="container">
                    <div class="row pt-20px pb-20px md-pt-0 md-pb-0">
                        <div class="col-12 text-center position-relative page-title-large" data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 300, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
                            <h1 class="alt-font d-block fw-700 text-dark-gray mb-0 ls-minus-1px">Insights </h1>
                            <h2 class="d-inline-block fw-500 ls-3px text-uppercase mb-0">Latest Works</h2> 
                        </div> 
                    </div>
                </div>
            </section>
            <!-- end page title -->
            <!-- start section -->  
            <section class="pb-0 pt-30px md-pt-0" style="overflow-x: hidden;">
                <div class="container ">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-12">
                            <div class="outside-box-right-50 lg-outside-box-right-65 sm-me-0">
                                <div class="swiper --magic-cursor text-slider-style-02" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "autoplay": { "delay": 4000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1400": { "slidesPerView": 2, "spaceBetween": 130 }, "992": { "slidesPerView": 2, "spaceBetween": 80 }, "768": { "slidesPerView": 2, "spaceBetween": 50 } }, "effect": "slide" }'>
                                    <div class="swiper-wrapper">
                                        <!-- start content carousal item --> 
                                        <div class="swiper-slide"> 
                                            <div class="row">
                                                <div class="col-12 col-lg-4 pt-8 order-lg-1 order-2">
                                                    <div class="d-flex align-items-center mb-20px">  
                                                        <span class="d-inline-block fw-700 text-dark-gray">Jan 20, 2023</span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-message-circle text-dark-gray d-inline-block fs-14"></i>
                                                            <span>13</span>
                                                        </span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-thumbs-up text-dark-gray d-inline-block fs-14"></i>
                                                            <span>45</span>
                                                        </span>
                                                    </div>
                                                    <div class="outside-box-right-10 xl-outside-box-right-15 lg-outside-box-right-30 md-me-0 position-relative">
                                                        <h3 class="alt-font ls-minus-1px fw-600 word-break-normal mb-40px sm-mb-20px"><a href="demo-blogger-blog-single-classic.html" class="text-dark-gray text-dark-gray-hover">I love seeing fashion from the past making a comeback.</a></h2>
                                                    </div>
                                                    <div>
                                                        <img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="rounded-circle w-70px me-15px" alt="">
                                                        <div class="d-inline-block align-middle"> 
                                                            <a href="#" class="text-dark-gray fs-18 fw-600 text-decoration-line-bottom">Walton smith</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-8 order-lg-2 order-1">
                                                    <a href="demo-blogger-blog-single-classic.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="border-radius-6px" alt=""/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end content carousal item -->
                                        <!-- start content carousal item --> 
                                        <div class="swiper-slide"> 
                                        <div class="row">
                                                <div class="col-12 col-lg-4 pt-8 order-lg-1 order-2">
                                                    <div class="d-flex align-items-center mb-20px">  
                                                        <span class="d-inline-block fw-700 text-dark-gray">Jan 20, 2023</span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-message-circle text-dark-gray d-inline-block fs-14"></i>
                                                            <span>13</span>
                                                        </span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-thumbs-up text-dark-gray d-inline-block fs-14"></i>
                                                            <span>45</span>
                                                        </span>
                                                    </div>
                                                    <div class="outside-box-right-10 xl-outside-box-right-15 lg-outside-box-right-30 md-me-0 position-relative">
                                                        <h3 class="alt-font ls-minus-1px fw-600 word-break-normal mb-40px sm-mb-20px"><a href="demo-blogger-blog-single-classic.html" class="text-dark-gray text-dark-gray-hover">I love seeing fashion from the past making a comeback.</a></h2>
                                                    </div>
                                                    <div>
                                                        <img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="rounded-circle w-70px me-15px" alt="">
                                                        <div class="d-inline-block align-middle"> 
                                                            <a href="#" class="text-dark-gray fs-18 fw-600 text-decoration-line-bottom">Walton smith</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-8 order-lg-2 order-1">
                                                    <a href="demo-blogger-blog-single-classic.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="border-radius-6px" alt=""/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end content carousal item -->
                                        <!-- start content carousal item --> 
                                        <div class="swiper-slide"> 
                                        <div class="row">
                                                <div class="col-12 col-lg-4 pt-8 order-lg-1 order-2">
                                                    <div class="d-flex align-items-center mb-20px">  
                                                        <span class="d-inline-block fw-700 text-dark-gray">Jan 20, 2023</span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-message-circle text-dark-gray d-inline-block fs-14"></i>
                                                            <span>13</span>
                                                        </span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-thumbs-up text-dark-gray d-inline-block fs-14"></i>
                                                            <span>45</span>
                                                        </span>
                                                    </div>
                                                    <div class="outside-box-right-10 xl-outside-box-right-15 lg-outside-box-right-30 md-me-0 position-relative">
                                                        <h3 class="alt-font ls-minus-1px fw-600 word-break-normal mb-40px sm-mb-20px"><a href="demo-blogger-blog-single-classic.html" class="text-dark-gray text-dark-gray-hover">I love seeing fashion from the past making a comeback.</a></h2>
                                                    </div>
                                                    <div>
                                                        <img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="rounded-circle w-70px me-15px" alt="">
                                                        <div class="d-inline-block align-middle"> 
                                                            <a href="#" class="text-dark-gray fs-18 fw-600 text-decoration-line-bottom">Walton smith</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-8 order-lg-2 order-1">
                                                    <a href="demo-blogger-blog-single-classic.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="border-radius-6px" alt=""/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end content carousal item -->
                                        <!-- start content carousal item --> 
                                        <div class="swiper-slide"> 
                                        <div class="row">
                                                <div class="col-12 col-lg-4 pt-8 order-lg-1 order-2">
                                                    <div class="d-flex align-items-center mb-20px">  
                                                        <span class="d-inline-block fw-700 text-dark-gray">Jan 20, 2023</span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-message-circle text-dark-gray d-inline-block fs-14"></i>
                                                            <span>13</span>
                                                        </span>
                                                        <span class="d-inline-block fs-18 alt-font text-base-color ms-10px me-10px">•</span>
                                                        <span class="d-inline-block fs-15 fw-500 text-dark-gray">
                                                            <i class="feather icon-feather-thumbs-up text-dark-gray d-inline-block fs-14"></i>
                                                            <span>45</span>
                                                        </span>
                                                    </div>
                                                    <div class="outside-box-right-10 xl-outside-box-right-15 lg-outside-box-right-30 md-me-0 position-relative">
                                                        <h3 class="alt-font ls-minus-1px fw-600 word-break-normal mb-40px sm-mb-20px"><a href="demo-blogger-blog-single-classic.html" class="text-dark-gray text-dark-gray-hover">I love seeing fashion from the past making a comeback.</a></h2>
                                                    </div>
                                                    <div>
                                                        <img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="rounded-circle w-70px me-15px" alt="">
                                                        <div class="d-inline-block align-middle"> 
                                                            <a href="#" class="text-dark-gray fs-18 fw-600 text-decoration-line-bottom">Walton smith</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-8 order-lg-2 order-1">
                                                    <a href="demo-blogger-blog-single-classic.html"><img src="<?php echo base_url();?>assets/frontend/img/demo-blogger-blog-listing-02.jpg" class="border-radius-6px" alt=""/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end content carousal item -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
            <!-- start section -->  
     
		<section id="chapter" class="bg-very-light-gray overflow-hidden half-section pt-40px md-pt-50px md-pb-50px sm-pb-30px"> 
            <div class="container"> 
                <div class="row align-items-center"> 
                    <div class="col-lg-5 col-md-7 sm-mb-30px" data-anime='{ "el": "childs", "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="d-block text-uppercase mb-10px text-base-color fw-500">Freequently Asked Questions
						Portable Services</span>
                        <h2 class="fw-500 alt-font text-dark-gray text-uppercase ls-minus-2px">FAQ's</h2>
                        <div class="accordion accordion-style-02" id="accordion-style-02" data-active-icon="icon-feather-minus" data-inactive-icon="icon-feather-plus">
                            <!-- start accordion item -->
                            <div class="accordion-item active-accordion">
                                <div class="accordion-header border-bottom border-color-extra-medium-gray">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-01" aria-expanded="true" data-bs-parent="#accordion-style-02">
                                        <div class="accordion-title mb-0 position-relative text-dark-gray">
                                            <i class="feather icon-feather-minus text-dark-gray"></i><span class="fw-500 fs-18">What services does JesperApps offer?</span>
                                        </div>
                                    </a>
                                </div>
                                <div id="accordion-style-02-01" class="accordion-collapse collapse show" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-body last-paragraph-no-margin border-bottom border-color-extra-medium-gray">
                                        <p class="w-90 md-w-100">JesperApps offers a comprehensive range of services, including expert consulting for Oracle and Salesforce solutions, as well as digital transformation services to help businesses innovate and streamline their operations.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                            <!-- start accordion item -->
                            <div class="accordion-item">
                                <div class="accordion-header border-bottom border-color-extra-medium-gray">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-02" aria-expanded="false" data-bs-parent="#accordion-style-02">
                                        <div class="accordion-title mb-0 position-relative text-dark-gray">
                                            <i class="feather icon-feather-plus"></i><span class="fw-500 fs-18">What makes JesperApps unique compared to other service providers?</span>
                                        </div>
                                    </a>
                                </div>
                                <div id="accordion-style-02-02" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-body last-paragraph-no-margin border-bottom border-color-extra-medium-gray">
                                        <p class="w-90 md-w-100">Our experience in advanced technology, customer-centric attitude, and bespoke solutions make us a top choice for organizations looking for innovation and efficiency.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                            <!-- start accordion item -->
                            <div class="accordion-item">
                                <div class="accordion-header border-bottom border-color-transparent">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-03" aria-expanded="false" data-bs-parent="#accordion-style-02">
                                        <div class="accordion-title mb-0 position-relative text-dark-gray">
                                            <i class="feather icon-feather-plus"></i><span class="fw-500 fs-18">How long has JesperApps been in business?</span>
                                        </div>
                                    </a>
                                </div>
                                <div id="accordion-style-02-03" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                        <p class="w-90 md-w-100">JesperApps has over 7 years of experience delivering innovation and transforming businesses.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                        </div>
                     
                    </div>
                    <div class="col-lg-6 offset-lg-1 col-md-5" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="outside-box-right-50">
                            <img src="<?php echo base_url();?>assets/frontend/img/demo-ebook-02.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<section>
            <div class="container">
                <div class="row text-center justify-content-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="col-xxl-6 col-lg-8 mb-4 xs-mb-30px">
                        <span class="fs-16 text-uppercase text-base-color fw-600 mb-5px d-block">world wide </span>
                        <h3 class="fw-700 mb-0 text-dark-gray ls-minus-1px">Our customers </h3>
                    </div>
                    <div class="col-12">
                        <img src="<?php echo base_url();?>assets/frontend/img/demo-green-energy-home-img-04.jpg" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </section>
	      <!-- start section -->
		  <section class="big-section position-relative" style="background-image: url('<?php echo base_url();?>assets/frontend/img/demo-it-business-testimonial-bg.png')">
            <div id="particles-01" data-particle="true" data-particle-options='{"particles": {"number": {"value": 10,"density": {"enable": true,"value_area": 1000}},"color":{"value":["#ff5b74", "#820f89"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 0.7,"random": false,"anim": {"enable": false,"speed": 2,"sync": false}},"size": {"value": 7,"random": true,"anim": {"enable": false,"sync": true}},"move": {"enable": true,"speed":2,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}' class="position-absolute top-0px left-0px w-100 z-index-minus-1"></div>
            <div class="container">
              
                <div class="row justify-content-center">
                    <div class="col-xxl-7 col-xl-8 col-lg-10 col-md-11 text-center">
                        <h2 class="fw-700 text-dark-gray ls-minus-1px">What Our Clients Say
						</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center" data-anime='{ "rotateX": [-40, 0], "opacity": [0,1], "duration": 1200, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <div class="swiper swiper-horizontal-3d pt-8 pb-5 lg-pt-10 lg-pb-10 md-pt-12 sm-pt-15 sm-pb-11 swiper-pagination-bottom testimonials-style-04 magic-cursor" data-slider-options='{ "loop": true, "slidesPerView": 1,"centeredSlides":true,"effect":"coverflow","coverflowEffect":{"rotate":0,"stretch":100,"depth":150,"modifier":1.5,"slideShadows":true}, "navigation": { "nextEl": ".swiper-button-next-nav.slider-navigation-style-04", "prevEl": ".swiper-button-previous-nav.slider-navigation-style-04" }, "autoplay": { "delay": 5000, "disableOnInteraction": false }, "pagination": { "el": ".swiper-pagination-04", "clickable": true, "dynamicBullets": true }, "breakpoints": { "768": { "slidesPerView": 2 } } }'>
                            <div class="swiper-wrapper">
                                <!-- start testimonial item -->
                                <div class="swiper-slide bg-white border-radius-4px">
                                    <div class="position-relative ps-13 pe-13 md-ps-10 md-pe-10 sm-ps-7 sm-pe-7 pt-20 pb-10 lg-pt-22 md-pt-30 sm-pt-20">
                                        <img alt="" src="<?php echo base_url();?>assets/frontend/img/avtar-25.jpg" class="absolute-middle-center top-0px rounded-circle w-150px xs-w-100px border border-color-white box-shadow-extra-large border-8">
                                        <div class="testimonials-content">
                                            <span class="text-dark-gray fs-18 lh-30 fw-600 mb-5px d-block">Just love their design for all stunning details!</span>
                                            <p class="mb-25px">These sounded far better than expected for the price. The cord is a tad shorter than others I have purchased so take note. Great for a good value.</p>
                                        </div>
                                        <div class="testimonials-author fs-18 mb-5px text-gradient-fast-blue-purple fw-600 d-inline-block">Alexander Harvard</div>
                                        <div class="testimonials-position fs-15 lh-20">Themezaa Design</div> 
                                    </div>
                                </div>
                                <!-- end testimonial item -->
                                <!-- start testimonial item -->
                                <div class="swiper-slide bg-white border-radius-4px">
                                    <div class="position-relative ps-13 pe-13 md-ps-10 md-pe-10 sm-ps-7 sm-pe-7 pt-20 pb-10 lg-pt-22 md-pt-30 sm-pt-20">
                                        <img alt="" src="<?php echo base_url();?>assets/frontend/img/avtar-25.jpg" class="absolute-middle-center top-0px rounded-circle w-150px xs-w-100px border border-color-white box-shadow-extra-large border-8">
                                        <div class="testimonials-content">
                                            <span class="text-dark-gray fs-18 lh-30 fw-600 mb-5px d-block">Every element is designed beautifully and perfect!</span>
                                            <p class="mb-25px">These are great headphones for music and movies for the price. I have never owned a big-money pair of headphones. It's a good pair of headphones.</p>
                                        </div>
                                        <div class="testimonials-author fs-18 mb-5px text-gradient-fast-blue-purple fw-600 d-inline-block">Shoko Mugikura</div>
                                        <div class="testimonials-position fs-15 lh-20">Google Design</div> 
                                    </div>
                                </div>
                                <!-- end testimonial item -->
                                <!-- start testimonial item -->
                                <div class="swiper-slide bg-white border-radius-4px">
                                    <div class="position-relative ps-13 pe-13 md-ps-10 md-pe-10 sm-ps-7 sm-pe-7 pt-20 pb-10 lg-pt-22 md-pt-30 sm-pt-20">
                                        <img alt="" src="<?php echo base_url();?>assets/frontend/img/avtar-25.jpg" class="absolute-middle-center top-0px rounded-circle w-150px xs-w-100px border border-color-white box-shadow-extra-large border-8">
                                        <div class="testimonials-content">
                                            <span class="text-dark-gray fs-18 lh-30 fw-600 mb-5px d-block">Simple and easy to integrate the website!</span>
                                            <p class="mb-25px">I was surprised at the sound quality from these phones right out of the box. I'm a fan of the sound and normally use with my home equipment.</p>
                                        </div>
                                        <div class="testimonials-author fs-18 mb-5px text-gradient-fast-blue-purple fw-600 d-inline-block">Herman Miller</div>
                                        <div class="testimonials-position fs-15 lh-20">Apple Design</div> 
                                    </div>
                                </div>
                                <!-- end testimonial item -->
                                <!-- start testimonial item -->
                                <div class="swiper-slide bg-white border-radius-4px">
                                    <div class="position-relative ps-13 pe-13 md-ps-10 md-pe-10 sm-ps-7 sm-pe-7 pt-20 pb-10 lg-pt-22 md-pt-30 sm-pt-20">
                                        <img alt="" src="<?php echo base_url();?>assets/frontend/img/avtar-25.jpg" class="absolute-middle-center top-0px rounded-circle w-150px xs-w-100px border border-color-white box-shadow-extra-large border-8">
                                        <div class="testimonials-content">
                                            <span class="text-dark-gray fs-18 lh-30 fw-600 mb-5px d-block">Every element is designed beautifully and perfect!</span>
                                            <p class="mb-25px">These are great headphones for music and movies for the price. I have never owned a big-money pair of headphones. It's a good pair of headphones.</p>
                                        </div>
                                        <div class="testimonials-author fs-18 mb-5px text-gradient-fast-blue-purple fw-600 d-inline-block">Shoko Mugikura</div>
                                        <div class="testimonials-position fs-15 lh-20">Google Design</div> 
                                    </div>
                                </div>
                                <!-- end testimonial item -->
                            </div>
                            <!-- start slider pagination -->
                            <!-- <div class="swiper-pagination slider-four-slide-pagination-1 swiper-pagination-style-4 swiper-pagination-clickable swiper-pagination-bullets"></div>-->
                            <!-- end slider pagination -->
                            <!-- start slider navigation --> 
                            <!-- <div class="swiper-button-previous-nav swiper-button-prev icon-extra-medium slider-navigation-style-04 rounded-circle"><i class="icon feather icon-feather-arrow-left"></i></div>
                                 <div class="swiper-button-next-nav swiper-button-next icon-extra-medium slider-navigation-style-04 rounded-circle"><i class="icon feather icon-feather-arrow-right"></i></div>-->
                            <!-- end slider navigation -->
                        </div>
                    </div>
                </div>
                <!-- start reviews -->
             
                <!-- end reviews -->
            </div>
        </section>
      
        <!-- start footer -->
		<section class="cover-background big-section" style="background-image: url(<?php echo base_url();?>assets/frontend/img/demo-interactive-portfolio-slider-05.jpg')">
            <div class="opacity-extra-medium bg-dark-gray"></div>
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 md-mb-40px">
                        <h3 class="text-white fw-500 ls-minus-1px">Project in mind? Get in touch!</h3>
                        <p class="text-white opacity-7">We're here to help and answer any question you might have. Any need help you please contact us or meet to office with coffee.</p>
                        <div class="row row-cols-1 justify-content-center mt-30px">                 
                            <!-- start features box item -->
                            <div class="col icon-with-text-style-08">
                                <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                                    <div class="feature-box-icon feature-box-icon-rounded bg-orange w-80px h-80px rounded-circle me-20px">
                                        <i class="bi bi-envelope text-white icon-very-medium"></i>
                                    </div>
                                    <div class="feature-box-content last-paragraph-no-margin">
                                        <span class="text-white opacity-7 d-block">Join our growing team?</span>
                                        <span class="d-block fs-22 text-white"><a href="mailto:careers@domain.com" class="text-white text-decoration-line-bottom">careers@domain.com</a></span>
                                    </div>
                                </div>
                            </div>
                            <!-- end features box item -->
                        </div>
                    </div>                
                    <div class="col-lg-7 offset-xl-1">
                        <form  action="email-templates/contact-form.php" method="post" class="row row-cols-1 row-cols-md-2 justify-content-center">
                            <div class="col mb-30px">
                                <input class="border-color-transparent-white-very-light bg-transparent placeholder-light form-control required" type="text" name="name" placeholder="Your name*" />
                            </div>
                            <div class="col mb-30px">
                                <input class="border-color-transparent-white-very-light bg-transparent placeholder-light form-control" type="tel" name="phone" placeholder="Your phone" />
                            </div>
                            <div class="col mb-30px">
                                <input class="border-color-transparent-white-very-light bg-transparent placeholder-light form-control required" type="email" name="email" placeholder="Your email address*" />
                            </div>
                            <div class="col sm-mb-30px">
                                <input class="border-color-transparent-white-very-light bg-transparent placeholder-light form-control" type="text" name="subject" placeholder="Your subject" />
                            </div>
                            <div class="col-md-12">
                                <textarea class="border-color-transparent-white-very-light bg-transparent placeholder-light form-control" cols="40" rows="4" name="comment" placeholder="Your message"></textarea>
                                <input type="hidden" name="redirect" value="">
                                <button class="btn btn-medium btn-white mt-30px btn-round-edge submit fw-700">Send message</button>
                                <div class="form-results mt-20px d-none"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end footer -->
        <!-- start sticky column -->
       
        <!-- end sticky column -->
         <!-- start scroll progress -->
        <div class="scroll-progress d-none d-xxl-block">
          <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
          </a>
        </div>
        <!-- end scroll progress -->
        <!-- javascript libraries -->
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/vendors.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
