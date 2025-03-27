<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menu = document.querySelector(".category-slider");
        const leftArrow = document.querySelector(".scroll-arrow.left");
        const rightArrow = document.querySelector(".scroll-arrow.right");

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
    .service_button_back_ground_color {
        flex: 0 0 auto;
        padding: 10px 20px;
        background: #f5f5f5;
        border-radius: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
    }

    .service_active_button_back_ground_color {
        flex: 0 0 auto;
        padding: 10px 20px;
        background: #27ac25;
        border-radius: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
    }

    .service_tag_back_ground_color {
       color: #333333;
    }


    .service_active_tag_back_ground_color {
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
 
<?php 
	$getCategoryListing = $this->categories_model->getCategoryListing();
?>
 
<!-- start page title -->
<section class="mt-5 --ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(<?php echo base_url(); ?>assets/frontend/img/jesper/services.png)">
   
    <div class="container">
        <div class="row align-items-center extra-small-screen">
            <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h1 class="mb-20px alt-font text-yellow">Personalized services designed to help you succeed.
                </h1>
                <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Tailored Solutions for Your Unique Needs
				</h2>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->


 <!-- start section -->
 <section class="position-relative">
 	<div class="container">
 		<div class="row align-items-center mb-4" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
 			<div class="col-xl-5 lg-mb-30px text-center text-xl-start">
 				<h3 class="text-dark-gray fw-700 mb-0 ls-minus-2px">Services</h3>
 			</div>
			 <div class="col-xl-7 text-center text-xl-end category-slider-container">
 		
 					<!-- Left Arrow -->
 				<button class="scroll-arrow left" onclick="scrollMenu(-200)">&#10094;</button>
				 <?php 
					if(count($getCategoryListing)>0)
					{
						?>
							<ul class="category-slider">
								<li class="nav <?php echo ($list_code === '' || $list_code === 'ALL') ? 'service_active_button_back_ground_color' : 'service_button_back_ground_color'; ?>"><a href="<?php echo base_url(); ?>service/all" class="<?php echo ($list_code === '' || $list_code === 'ALL') ? 'service_active_tag_back_ground_color' : 'service_tag_back_ground_color'; ?>">All</a></li>
								<?php 
									foreach ($getCategoryListing as $caseStudyCategory) 
									{
										$isButtonActive     = ($list_code == $caseStudyCategory['list_code']) ? 'service_active_button_back_ground_color' : 'service_button_back_ground_color';
                                        $isTagActive        = ($list_code == $caseStudyCategory['list_code']) ? 'service_active_tag_back_ground_color' : 'service_tag_back_ground_color';

										?>
											<li class="nav <?php echo $isButtonActive; ?>"><a href="<?php echo base_url(); ?>service/<?php echo strtolower($caseStudyCategory['list_code']); ?>" class="<?php echo $isTagActive ;?>"><?php echo $caseStudyCategory['list_value'];?></a></li>
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
					<div class="row" data-anime='{  "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
						<div class="col-12 filter-content p-md-0">
							<ul class="portfolio-modern portfolio-wrapper grid-loading grid grid-3col xxl-grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
								<li class="grid-sizer"></li>
								<!-- start portfolio item -->
								<?php 
									foreach ($resultData as $serviceData) 
									{
                                        if ($serviceData['list_code_2'] != NULL) 
                                        {
                                            $serviceUrl = base_url() . 'services-details/' . strtolower($serviceData['list_code_1']) . '/' . strtolower($serviceData['list_code_2']);
                                        } 
                                        else 
                                        {
                                            $serviceUrl = base_url() . 'services-detail/' . strtolower($serviceData['list_code_1']);
                                        }
                                        
										$service_image_url = "uploads/services/service_images/".$serviceData['header_id'].".png";
										?>
											<li class="grid-item selected digital transition-inner-all">
												<a href="<?php echo $serviceUrl ; ?>">
													<div class="portfolio-box">
														<div class="portfolio-image border-radius-4px">
															<img src="<?php echo base_url().$service_image_url;?>" alt="" />
														</div>
														<div class="portfolio-hover box-shadow-extra-large">
															<div class="bg-white d-flex align-items-center align-self-end text-start border-radius-4px ps-30px pe-30px pt-20px pb-20px lg-p-20px w-100">
																<div class="me-auto">
																	<div class="fs-12 fw-500 text-medium-gray text-uppercase lh-24"><?php echo ucfirst($serviceData['list_value']) ;?></div>
																	<div class="fw-700 text-dark-gray text-uppercase lh-initial"><?php echo ucfirst($serviceData['service_name']) ;?></div>
																</div>
																<div class="ms-auto"><i class="feather icon-feather-plus icon-extra-medium text-dark-gray lh-36"></i></div>
															</div>
														</div>
													</div>
												</a>
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
			else
			{
				?>
                    <div class="row mt-5 pt-5">
                        <div class="text-center">
                            <img src="<?php echo base_url(); ?>uploads/nodata.png" alt="No data available" style="width: 300px;height:300px">
                        </div>
                    </div>
					
				<?php
			}
		?>
 		
		 
 	</div>
 </section>
 <!-- end section -->

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