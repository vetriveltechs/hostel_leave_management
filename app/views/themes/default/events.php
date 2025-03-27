
 <!-- start banner -->
    <?php 
        $getEventBannersList     = $this->events_model->getEventBannersList();

        if(count($getEventBannersList)>0)
        {
            ?>
                <section class="p-0 full-screen ipad-top-space-margin position-relative overflow-hidden md-h-auto">
                    <div class="container-fluid p-0 h-100 position-relative">
                        <div class="row h-100 g-0">
                            <div class="col-xl-6 col-lg-6 d-flex justify-content-center flex-column ps-10 xxl-ps-5 xl-ps-2 md-ps-0 position-relative order-2 order-lg-1">
                                
                                <div class="border-start border-color-extra-medium-gray ps-60px ms-100px lg-ps-30px lg-ms-70px position-relative z-index-9 sm-ps-30px sm-pe-30px sm-ms-0 border-0" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <h3 class="text-dark-gray fw-600 alt-font --outside-box-right-10 --xl-outside-box-right-15 ls-minus-4px sm-ls-minus-2px md-me-0"style="background: linear-gradient(to right, rgb(0, 87, 183), rgb(0, 150, 136), rgb(2, 109, 26)); 
                                                            -webkit-background-clip: text; 
                                                            -webkit-text-fill-color: transparent; 
                                                            display: inline-block;"><?php echo ucfirst($getEventBannersList[0]['title']) ;?></h3>
                                    <p class="w-75 mb-35px lg-w-90 sm-w-100"><?php echo ucfirst($getEventBannersList[0]['description']) ;?></p>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 position-relative swiper-number-pagination-progress md-h-500px order-1 order-lg-2 md-mb-50px"> 
                                <div class="swiper h-100 banner-slider --magic-cursor drag-cursor" data-slider-options='{ "slidesPerView": 1, "loop": true, "pagination": { "el": ".swiper-number-line-pagination", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "stopOnLastSlide": true, "disableOnInteraction": false },"keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "fade" }' data-swiper-number-pagination-progress="true">
                                    <div class="swiper-wrapper">
                                        <!-- start slider item -->
                                        <?php 
                                            foreach ($getEventBannersList as $eventBanner) 
                                            {
	                                            $eventBannerUrl 			= "uploads/events/event_banners/".$eventBanner['line_id'].".png";

                                                ?>
                                                    <div class="swiper-slide">
                                                        <div class="position-absolute left-0px top-0px w-100 h-100 cover-background background-position-center-top" style="background-image:url('<?php echo base_url().$eventBannerUrl;?>');"></div>
                                                    </div>
                                                <?php
                                            }
                                            
                                        ?>
                                        <!-- end slider item -->
                                          
                                    </div>
                                    <!-- start slider pagination -->
                                    <div  class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets d-block d-sm-none"></div>
                                    <!-- end slider pagination --> 
                                    <!-- start slider navigation -->
                                    <!-- <div class="slider-one-slide-prev-1 icon-very-small text-white swiper-button-prev slider-navigation-style-06 d-none d-sm-inline-block"><i class="line-icon-Arrow-OutLeft icon-extra-large"></i></div>
                                        <div class="slider-one-slide-next-1 icon-very-small text-white swiper-button-next slider-navigation-style-06 d-none d-sm-inline-block"><i class="line-icon-Arrow-OutRight icon-extra-large"></i></div> -->
                                    <!-- end slider navigation -->
                                </div>
                                <!-- start slider pagination -->
                                <div class="swiper-pagination-wrapper d-none d-lg-flex align-items-center justify-content-center position-absolute bottom-40px md-bottom-30px sm-bottom-20px left-minus-45 md-left-30px sm-left-20px z-index-9">
                                    <div class="number-prev fs-14 fw-600 text-dark-gray"></div>
                                    <div class="swiper-pagination-progress bg-extra-medium-gray">
                                        <span class="swiper-progress"></span>
                                    </div>
                                    <div class="number-next fs-14 fw-600 text-dark-gray"></div>    
                                </div>
                                <!-- end slider pagination -->
                            </div>
                        </div>
                    </div>
                </section>
            <?php
        }
    ?>
    
        <!-- end banner --> 
	<section class="cover-background  pb-0" style="background-image:url('<?php echo base_url(); ?>assets/frontend/img/event/eb-1.jpg');">
            <div class="opacity-extra-medium bg-dark-gray"></div> 
            <div class="container h-100"> 
                <div class="row align-items-start align-items-md-center justify-content-center h-100">
                    <div class="col-xxl-8 col-lg-10 mb-9 md-mb-15 sm-mb-0 position-relative z-index-1 text-center d-flex flex-wrap align-items-center justify-content-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>   
                        <span class="ps-25px pe-25px pt-5px pb-5px mb-25px text-uppercase text-white fs-12 ls-1px fw-600 border-radius-100px bg-black-transparent-medium d-flex align-items-center text-start sm-lh-20"><i class="bi bi-megaphone text-white d-inline-block align-middle icon-small me-10px"></i> Let's make something great work together.</span>
                        <h1 class="text-white fw-600 ls-minus-2px mb-45px">JesperApps Events <span class="fw-600" data-fancy-text='{ "effect": "rotate", "string": ["Driving !", "Innovation!", "Together!"] }'></span></h1> 
                        <!-- <a href="#" class="btn btn-extra-large btn-switch-text bg-base-color btn-rounded">
                            <span>
                                <span class="btn-double-text" data-text="Register Now">Register Now</span>
                                <span><i class="fa-solid fa-arrow-down"></i></span>
                            </span>
                        </a>  -->
                    </div>  
                </div> 
            </div>
	</section>
    <?php 
        $getUpcomingEvents  = $this->events_model->getUpcomingEvents();

        if(count($getUpcomingEvents)>0)
        {
            ?>
                <section class="pt-5 ps-4 pe-4 xl-ps-2 xl-pe-2 lg-px-0">
                    <div class="container-fluid">
                        <div class="row">
                        <h2 class="text-dark text-center fw-600 ls-minus-2px mb-45px" >Upcoming Event </h2> 
                            <div class="col-12">
                                <ul class="blog-side-image blog-wrapper grid-loading grid grid-3col xxl-grid-2col xl-grid-2col lg-grid-2col md-grid-1col sm-grid-1col xs-grid-1col gutter-extra-large">
                                    <li class="grid-sizer"></li>
                                    <!-- start blog item -->
                                    <?php
                                        foreach ($getUpcomingEvents as $upcomingEvents) 
                                        {
                                            $upcomingEventUrl 			= "uploads/events/".$upcomingEvents['event_id'].".png";

                                            ?>
                                                <li class="grid-item">
                                                    <div class="blog-box d-md-flex d-block flex-row h-100 border-radius-6px overflow-hidden box-shadow-extra-large">
                                                        <div class="blog-image w-50 sm-w-100 cover-background" style="background-image: url('<?php echo base_url().$upcomingEventUrl;?>')">
                                                            <a href="<?php echo base_url(); ?>events-details/<?php echo $upcomingEvents['event_url']; ?>" class="blog-post-image-overlay"></a>
                                                        </div>
                                                        <div class="blog-content w-50 sm-w-100 pt-50px pb-40px ps-40px pe-40px xl-p-30px bg-white d-flex flex-column justify-content-center align-items-start last-paragraph-no-margin">
                                                            <a href="<?php echo base_url(); ?>events-details/<?php echo $upcomingEvents['event_url']; ?>" class="categories-btn bg-dark-gray text-white text-uppercase fw-500 mb-30px">
                                                            <?php
                                                                if (!empty($upcomingEvents['end_date'])) {
                                                                    echo (isset($upcomingEvents['start_date']) ? date("d", strtotime($upcomingEvents['start_date'])) . " - " : "") . date("d M Y", strtotime($upcomingEvents['end_date']));
                                                                } else {
                                                                    echo isset($upcomingEvents['start_date']) ? date("d M Y", strtotime($upcomingEvents['start_date'])) : "";
                                                                }
                                                            ?>
                                                            </a>
                                                            <a href="<?php echo base_url(); ?>events-details/<?php echo $upcomingEvents['event_url']; ?>"  class="card-title --text-dark-gray text-dark-gray-hover mb-5px fw-600 fs-18 lh-28" 
                                                                style="background: linear-gradient(to right, rgb(0, 87, 183), rgb(0, 150, 136), rgb(2, 109, 26)); 
                                                                        -webkit-background-clip: text; 
                                                                        -webkit-text-fill-color: transparent; 
                                                                        display: inline-block;">
                                                                    <?php echo ucfirst($upcomingEvents['event_title']) ;?>
                                                                </a>

                                                            <p>
                                                            <?php echo ucfirst($upcomingEvents['description']) ;?></p>
                                                            <div class="mt-15px"><span class="separator bg-dark-gray"></span><a href="<?php echo base_url(); ?>events-details" target="_blank" class="text-dark-gray text-dark-gray-hover d-inline-block fs-15 fw-500 fw-500">Explore More</a></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                        }
                                        
                                    ?>
                                    
                                    <!-- end blog item -->
                                </ul>
                            </div>   
                                
                        </div>
                    </div>
                </section>
            <?php
        }
    ?>
    <?php 
        $getPastEvents  = $this->events_model->getPastEvents();

        if(count($getPastEvents)>0)
        {
            ?>
                <section class="pt-5 ps-4 pe-4 xl-ps-2 xl-pe-2 lg-px-0">
                    <div class="container-fluid">
                        <div class="row">
                        <h2 class="text-dark text-center fw-600 ls-minus-2px mb-45px" >Past Event </h2> 
                            <div class="col-12">
                                <ul class="blog-side-image blog-wrapper grid-loading grid grid-3col xxl-grid-2col xl-grid-2col lg-grid-2col md-grid-1col sm-grid-1col xs-grid-1col gutter-extra-large">
                                    <li class="grid-sizer"></li>
                                    <!-- start blog item -->
                                    <?php
                                        foreach ($getPastEvents as $pastEvents) 
                                        {
                                            $pastEventUrl 			= "uploads/events/".$pastEvents['event_id'].".png";

                                            ?>
                                                <li class="grid-item">
                                                    <div class="blog-box d-md-flex d-block flex-row h-100 border-radius-6px overflow-hidden box-shadow-extra-large">
                                                        <div class="blog-image w-50 sm-w-100 cover-background" style="background-image: url('<?php echo base_url().$pastEventUrl;?>')">
                                                            <a href="<?php echo base_url(); ?>events-details/<?php echo $pastEvents['event_url']; ?>"  class="blog-post-image-overlay"></a>
                                                        </div>
                                                        <div class="blog-content w-50 sm-w-100 pt-50px pb-40px ps-40px pe-40px xl-p-30px bg-white d-flex flex-column justify-content-center align-items-start last-paragraph-no-margin">
                                                            <a href="<?php echo base_url(); ?>events-details/<?php echo $pastEvents['event_url']; ?>" class="categories-btn bg-dark-gray text-white text-uppercase fw-500 mb-30px">
                                                                <?php
                                                                    if (!empty($pastEvents['end_date'])) {
                                                                        echo (isset($pastEvents['start_date']) ? date("d", strtotime($pastEvents['start_date'])) . " - " : "") . date("d M Y", strtotime($pastEvents['end_date']));
                                                                    } else {
                                                                        echo isset($pastEvents['start_date']) ? date("d M Y", strtotime($pastEvents['start_date'])) : "";
                                                                    }
                                                                ?>
                                                            </a>
                                                            <a href="<?php echo base_url(); ?>events-details/<?php echo $pastEvents['event_url']; ?>"  class="card-title --text-dark-gray text-dark-gray-hover mb-5px fw-600 fs-18 lh-28" 
                                                                style="background: linear-gradient(to right, rgb(0, 87, 183), rgb(0, 150, 136), rgb(2, 109, 26)); 
                                                                        -webkit-background-clip: text; 
                                                                        -webkit-text-fill-color: transparent; 
                                                                        display: inline-block;">
                                                                    <?php echo ucfirst($pastEvents['event_title']) ;?>
                                                                </a>

                                                            <p>
                                                            <?php echo ucfirst($pastEvents['description']) ;?></p>
                                                            <div class="mt-15px"><span class="separator bg-dark-gray"></span><a href="<?php echo base_url(); ?>events-details/<?php echo $pastEvents['event_url']; ?>" class="text-dark-gray text-dark-gray-hover d-inline-block fs-15 fw-500 fw-500">Explore More</a></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                        }
                                        
                                    ?>
                                    
                                    <!-- end blog item -->
                                </ul>
                            </div>   
                                
                        </div>
                    </div>
                </section>
            <?php
        }
    ?>
	
        <!-- end section -->