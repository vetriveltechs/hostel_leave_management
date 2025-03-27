<?php 
    $getEventDetail = $this->events_model->getEventDetail($event_url);

    if(count($getEventDetail)>0)
    {
        ?>
            <section class="cover-background page-title-big-typography ipad-top-space-margin">
                <div class="container">
                    <div class="row align-items-center align-items-lg-end justify-content-center extra-very-small-screen g-0">
                        <div class="col-xxl-5 col-xl-6 col-lg-7 position-relative page-title-extra-small md-mb-30px md-mt-auto" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <h3 class="alt-font text-dark-gray fw-500 mb-0 ls-minus-1px shadow-none" data-shadow-animation="true" data-animation-delay="700"  style="background: linear-gradient(to right, rgb(0, 87, 183), rgb(0, 150, 136), rgb(2, 109, 26)); 
                                                        -webkit-background-clip: text; 
                                                        -webkit-text-fill-color: transparent; 
                                                        display: inline-block;"><?php echo ucfirst($getEventDetail[0]['title']);?>
                            </h3>
                        </div>
                        <div class="col-lg-5 offset-xxl-2 offset-xl-1 border-start border-2 border-color-base-color ps-40px sm-ps-25px md-mb-auto">
                            <span class="d-block w-85 lg-w-100" data-anime='{ "el": "lines", "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><?php echo ucfirst($getEventDetail[0]['description']);?></span>
                        </div>
                    </div>
                </div>
            </section>
            <?php 
				$event_detail_url = "uploads/events/details/banner/".$getEventDetail[0]['event_detail_id'].".png";
                
                if(file_exists($event_detail_url))
                {
                    ?>
                        <section class="overflow-hidden p-0 pb-4">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 p-0 position-relative">
                                        <img src="<?php echo base_url().$event_detail_url;?>" alt="" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php 
                }
            ?>
            
        <?php
    }
?>
        
        
        <!-- start section -->
        <section class="position-relative pt-50px md-pt-0">
            <div class="container">
                <div class="row align-items-center mb-6">
                    <div class="col-md-6 col-xl-4" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <span class="fs-15 alt-font fw-600 text-base-color text-uppercase mb-10px d-block ls-3px">Studio gallery</span>
                        <h2 class="alt-font text-dark-gray ls-minus-2px">Explore the yoga lifestyle.</h2>
                        <p class="mb-40px w-90 lg-w-100">Amet minim mollit non deserunt ullamco est aliqua dolor do amet sint velit officia consequat duis enim.</p>
                        <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/event-4.png" class="border-radius-6px md-mb-35px" alt="">
                    </div>
                    <div class="col-md-6 col-xl-7 offset-xl-1">
                        <div class="position-relative z-index-1">
                            <div class="atropos" data-atropos data-atropos-perspective="2450">
                                <div class="atropos-scale">
                                    <div class="atropos-rotate">
                                        <div class="atropos-inner">
                                            <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/event1.jpg" alt="" class="border-radius-6px"/>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                           
                        </div>
                        <div class="row mt-8">
                            <div class="col">
                                <div class="blockquote-style-01 ps-9 md-ps-0" data-anime='{ "el": "childs", "translateX": [-20, 0], "opacity": [0,1], "duration": 600, "delay": 300, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <!-- start blockquote -->
                                    <i class="bi bi-chat-quote float-start me-20px icon-extra-large text-base-color d-inline-block md-icon-large"></i>
                                    <blockquote class="mb-0 d-table last-paragraph-no-margin">
                                        <h6 class="alt-font text-dark-gray w-85 md-w-100 mb-10px ls-0px">The body benefits from movement and the mind benefits from stillness.</h6>
                                        <div class="mt-10px fs-15 ls-1px text-uppercase">Herman miller, ThemeZaa</div>
                                    </blockquote>
                                    <!-- end blockquote -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
     
      
    <?php 
        $getEventGalleryList    = $this->events_model->getEventGalleryList($event_url);

        if(count($getEventGalleryList)>0)
        {
            ?>
                <section class="bg-solitude-blue">
                    <div class="container">
                        <div class="row justify-content-center align-items-center mb-5 text-center text-lg-start">
                            <div class="col-xxl-7 col-lg-7 md-mb-20px">
                                <h2 class="text-dark-gray fw-600 ls-minus-2px mb-0"><span class="w-20px h-4px d-inline-block bg-base-color me-10px"></span>Explore portfolio</h2>
                            </div>
                            <div class="col-xxl-5 col-lg-5 col-md-8 col-sm-10 last-paragraph-no-margin">
                                <p>Our skilled developers and designers make sure to deliver tried-tested efficient, scalable, and robust designs.</p>
                            </div>
                        </div> 
                    </div>
                </section>
                <section class="ps-5 pe-5 lg-ps-2 lg-pe-2">
                    <div class="container-fluid"> 
                        <div class="row">
                            <div class="col">
                                <ul class="image-gallery-style-02 gallery-wrapper grid grid-4col xxl-grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-large">
                                    <li class="grid-sizer"></li>
                                    <!-- start gallery item -->
                                    <?php 
                                        foreach ($getEventGalleryList as $eventGalleryList) 
                                        {
                                            $gallery_url    ="uploads/events/gallery/".$eventGalleryList["line_id"].".png";
                                            
                                            ?>
                                                <li class="grid-item transition-inner-all atropos" data-atropos data-atropos-perspective="1150">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner" data-atropos-offset="3"> 
                                                                <div class="gallery-box">
                                                                    <a href="<?php echo base_url(). $gallery_url; ?>" data-group="lightbox-group-gallery-item-2" title="Lightbox gallery image title">
                                                                        <div class="position-relative gallery-image bg-slate-blue">
                                                                            <img src="<?php echo base_url(). $gallery_url; ?>" alt="" />
                                                                            <div class="d-flex align-items-center justify-content-center position-absolute top-0px left-0px w-100 h-100 gallery-hover move-bottom-top">
                                                                                <i class="bi bi-camera icon-medium text-white"></i>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                        }
                                    ?>
                                    <!-- end gallery item -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
        }
    ?>
    
    