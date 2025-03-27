
    <body data-mobile-nav-style="classic">
	
<!-- start page title -->
<section class="mt-5 --ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(<?php echo base_url(); ?>assets/frontend/img/jesper/industries_banner.png)">
    <div class="container">
        <div class="row align-items-center extra-small-screen">
            <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h1 class="mb-20px alt-font text-yellow">We understand your unique challenges and provide solutions that drive growth and impact.

                </h1>
                <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Empowering Industries with Smart Solutions

				</h2>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->
        <!-- start page title -->
       
        <!-- end page title -->
        <!-- start section -->
		<?php 
			$getIndustriesList	= $this->industries_model->getIndustriesList();

			if(count($getIndustriesList)>0)
			{
				?>
					<section class="pt-4 ps-6 pe-6 xxl-ps-4 xxl-pe-4 lg-px-0">
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 filter-content">
									<ul class="portfolio-clean portfolio-wrapper grid-loading grid grid-4col xxl-grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-large">
										<li class="grid-sizer"></li>
										<!-- start portfolio item -->
										<?php 
											foreach ($getIndustriesList as $industriesList) 
											{
												$industriesUrl= 'uploads/industries/'.$industriesList['industries_id'].'.png';
												?>
													<li class="grid-item branding selected digital transition-inner-all">
														<a href="<?php echo base_url(); ?>industries-details/<?php echo $industriesList['industries_url']; ?>">
															<div class="portfolio-box">
																<div class="portfolio-image">
																	<img src="<?php echo base_url().$industriesUrl;?>" alt="" />
																</div>
																<div class="portfolio-hover d-flex justify-content-end align-items-end flex-column ps-35px pe-35px pt-5px pb-5px lg-ps-15px lg-pe-15px">
																	<div class="d-flex align-items-center justify-content-start flex-wrap text-left w-100">
																		<div class="fs-17 alt-font fw-600 text-dark-gray portfolio-title"><?php echo ucfirst($industriesList['industries_name']) ;?></div>
																		<i class="line-icon-Arrow-OutRight icon-large align-middle text-dark-gray"></i>
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
        
        <!-- end section -->
      
    
    </body>
</html>