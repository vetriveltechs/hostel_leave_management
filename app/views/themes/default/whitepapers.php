
<!--==================================================-->
<!-- Start Consalt Breadcumb Area -->
<!--==================================================-->
<div class="breadcumb-area d-flex">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 text-center">
				<div class="breadcumb-content">
					<div class="breadcumb-title">
						<h4>Whitepapers</h4>
					</div>
					<ul>
						<li><a href="<?php echo base_url() .'home'; ?>"><i class="bi bi-house-door-fill"></i> Home </a></li>
						<li class="rotates"><i class="bi bi-slash-lg"></i>Whitepapers</li>
						<li class="rotates"><i class="bi bi-slash-lg"></i> Whitepapers Details</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--==================================================-->
<!-- End Consalt Breadcumb Area -->
<!--==================================================-->

<!--==================================================-->
<!-- Start Consalt Service Area-->
<!--==================================================-->
<?php 
	$getWhitepapersAll	= $this->whitepapers_model->getWhitepapersAll();

	if(count($getWhitepapersAll)>0)
	{
		?>
			<section class="service_area bst boxed mt-5 mb-0">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<!-- section title -->
							<div class="section_title text-center style_two">
								<h4>Whitepapers</h4>
								<h1>Explore Our Whitepapers</h1>
								<p class="text-white">Welcome to the JesperApps Whitepapers hub! Our whitepapers are packed with in-depth analysis, expert insights, and actionable strategies that address the latest trends and challenges in the business and technology sectors. Whether you're looking for guidance on digital transformation, AI, cloud solutions, or industry-specific innovations, our whitepapers offer valuable knowledge that can help drive your business forward.</p>
							</div>
						</div>
					</div>
					<div class="row">
						<h2 class="text-white text-center mb-5">Latest Whitepapers</h2>
						<?php 
							foreach ($getWhitepapersAll as $whitepappers) 
							{
								$whitepaperUrl	= "uploads/whitepapers/".$whitepappers['header_id'].".png";
								
								?>
									<div class="col-lg-4 col-md-6">
										<!-- feature item -->
										<div class="service_single_item">
											<div class="service_thumb">
												<img src="<?php echo base_url().$whitepaperUrl;?>" alt="">
											</div>
											<div class="service_content">
												<h3><?php echo $whitepappers['title'] ;?></h3>
												<div class="service_btn">
													<a href="<?php echo base_url();?>whitepapers-details/<?php echo $whitepappers['whitepaper_url'] ;?>">Read More <i class="flaticon flaticon-right-arrow"></i></a>
												</div>
											</div>
										</div>
									</div>
								<?php
							}
						?>
						
						
					</div>
					<div class="row pb-0">
						<div class="col-lg-12">
							<!-- section title -->
							<div class="section_title text-center style_two">
								<h3 class="text-white">Ready to Dive Deeper?</h3>
								<p class="text-white">Explore our range of whitepapers below to access the knowledge you need to transform your business. Whether you’re in the healthcare, manufacturing, or tech industry, we have valuable content to help you navigate the complexities of digital change.</p>
								<div class="consalt_btn home_five item-center text-center mt-3">
								<a href="#whitepaper">View More<span></span></a>
							</div>
							</div>
						</div>
					</div>
				</div>
				<div class="service_shape pt-0">
					<img src="<?php echo base_url();?>assets/frontend/img/home_one/service-bg.png" alt="">
				</div>
				
			</section>
		<?php
	}
?>

<!--==================================================-->
<!-- End Consalt Service Area-->
<!--==================================================-->
<style>
	section.service_area.bst {
    border-radius: 22px 22px 0px 0px;
    background: #063232;
    padding: 60px 0 89px;
    position: relative;
    top: -75px;
    z-index: 1;
}
</style>