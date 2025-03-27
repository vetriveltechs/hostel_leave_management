<!--==================================================-->
<!-- Start Consalt Breadcumb Area -->
<!--==================================================-->

<style>
	.breadcumb-content {
		position: relative;
		background: rgba(255, 255, 255, 0.3); /* Semi-transparent white */
		backdrop-filter: blur(10px); /* Glass effect */
		padding: 20px 40px; /* Add spacing inside the box */
		border-radius: 10px; /* Smooth corners */
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
		color: #333; /* Text color */
		}
</style>

<?php 
	$getNewsDetails	= $this->news_model->getNewsDetails($news_id);

	if(count($getNewsDetails)>0)
	{
		$news_banner_url    = "uploads/news/background_banner/".$getNewsDetails[0]['news_id'].".png";
		?>
			<div class="breadcumb-area d-flex" style="background: url(<?php echo base_url().$news_banner_url;?>);background-repeat: no-repeat;background-size: cover;background-position: center;padding: 182px 0 202px;position: relative;">
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-lg-8  text-center">
							<div class="breadcumb-content">
								<div class="breadcumb-title">
									<h4><?php echo $getNewsDetails[0]['news_title']; ?></h4>
								</div>
								<ul>
									<li><a href="<?php echo base_url() .'home'; ?>"><i class="bi bi-house-door-fill"></i> Home </a></li>
									<li class="rotates"><i class="bi bi-slash-lg"></i>News</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php
			$description = $getNewsDetails[0]['description'];

			$news_url    = "uploads/news/banner/".$getNewsDetails[0]['news_id'].".png";

				?>
					<section class="portfolio_details">
						<div class="container">
							<div class="port_main style_two">
								
								<div class="row">
									<div class="col-lg-6 item-center">
										<div class="port_details_content style_two item-center">
										<img src="<?php echo base_url().$news_url;?>" alt="">
										<div class="meta-blog pt-3">
												<p><span class="solution"><?php echo $getNewsDetails[0]['client_name'] ;?></span><?php echo isset($getNewsDetails[0]['last_updated_date']) ? date("d M, Y", strtotime($getNewsDetails[0]['last_updated_date'])) : "";?></p>
											</div>
						
										</div>
									</div>
									
								</div>
								<?php
									if($description!=NULL)
									{
										?>
											<div class="row">
												<div class="col-lg-12">
													<div class="port_details_content style_two">
														<!-- <p class="quote">The food and beverage industry, long considered a cornerstone of global commerce, is undergoing a paradigm shift thanks to artificial intelligence (AI). This technological marvel is reimagining how food is grown, processed, packaged, and delivered, driving efficiency and innovation at every stage. From smart farming practices to personalized nutrition, AI has become a critical ingredient in the recipe for a sustainable, efficient, and consumer-centric industry. </p> -->
														<?php
															$description = $getNewsDetails[0]['description'];

															$dom = new DOMDocument();
															libxml_use_internal_errors(true);
															$dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));
															libxml_clear_errors();

															// Apply styles for heading tags (h1, h2, h3) with the 'heading-editor-class'
															$headings = $dom->getElementsByTagName('h1');
															foreach ($headings as $heading) {
																// Remove any <strong> tags surrounding the heading
																$strongs = $heading->getElementsByTagName('strong');
																foreach ($strongs as $strong) {
																	$strong->parentNode->replaceChild($strong->firstChild, $strong);
																}

																$heading->setAttribute('class', 'heading-editor-class');
															}

															$headings = $dom->getElementsByTagName('h2');
															foreach ($headings as $heading) {
																// Remove any <strong> tags surrounding the heading
																$strongs = $heading->getElementsByTagName('strong');
																foreach ($strongs as $strong) {
																	$strong->parentNode->replaceChild($strong->firstChild, $strong);
																}

																$heading->setAttribute('class', 'heading-editor-class');
															}

															$headings = $dom->getElementsByTagName('h3');
															foreach ($headings as $heading) {
																// Remove any <strong> tags surrounding the heading
																$strongs = $heading->getElementsByTagName('strong');
																foreach ($strongs as $strong) {
																	$strong->parentNode->replaceChild($strong->firstChild, $strong);
																}

																$heading->setAttribute('class', 'heading-editor-class');
															}

															// Apply styles for other tags (li, ol, p, span) with the 'para-heading-editor-class'
															$lists = $dom->getElementsByTagName('li');
															foreach ($lists as $li) {
																$li->setAttribute('class', 'para-heading-editor-class');
															}

															$orderedLists = $dom->getElementsByTagName('ol');
															foreach ($orderedLists as $ol) {
																$ol->setAttribute('class', 'para-heading-editor-class');
															}

															$paragraphs = $dom->getElementsByTagName('p');
															foreach ($paragraphs as $p) {
																$p->setAttribute('class', 'para-heading-editor-class');
															}

															$spans = $dom->getElementsByTagName('span');
															foreach ($spans as $span) {
																$span->setAttribute('class', 'para-heading-editor-class');
															}

															// Apply styles for <img> tags
															$images = $dom->getElementsByTagName('img');
															foreach ($images as $img) {
																$existingClass = $img->getAttribute('class');
																$newClass = trim($existingClass . ' blog_detail_banner');
																$img->setAttribute('class', $newClass);
															}

															// Output the modified HTML
															echo $dom->saveHTML();
														?>



													</div>
												</div>
											</div>
										<?php
									}
								?>
								

								
								<div class="row">
									<div class="col-lg-12">
										
										<div class="pagination_container">
											<!-- pagination item -->
											<div class="pagination_item">
												<div class="pagination_btn">
													<a href="#"><img src="<?php echo base_url();?>assets/frontend/img/inner-img/pagination_icon1.png" alt="">Previous News</a>
												</div>
											</div>
											<!-- pagination item -->
											<div class="pagination_item">
												<div class="pagination_btn style_right">
													<a href="#">Next News <img src="<?php echo base_url();?>assets/frontend/img/inner-img/pagination_icon2.png" alt=""></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</section>
				<?php
			

		?>
			
		<?php
	}

?>

<!--==================================================-->
<!-- End Consalt Service Details Area -->
<!--==================================================-->
<!--==================================================-->
<!-- Start Consalt Contact form  -->
<!--==================================================-->
<section class="contact_form pt-0">
	<div class="container">
		<div class="row form_bg align-items-center">
			<div class="col-lg-6">
				<div class="form_content">
					<h3>Let's talk about your next project.</h3>
					<h5>READY TO DOWNLOAD</h5>
					<p>No Coding required for build your page. <span style="color: #0c6e6d;">JesperApps</span> delivers everything.</p>
				</div>
				<div class="pagination_container style_two">
												
						<!-- pagination item -->
						<div class="pagination_item">
							<div class="call_social_icon">
								<ul>
									<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
									<li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
									<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li><a class="top-social-icon-left" href="#"><i class="fab fa-twitter"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
			
			</div>
			<div class="col-lg-6">
				<div class="consalt_btn home_five">
					<a href="<?php echo base_url();?>contact-us">Start A Project <span></span></a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					
			</div>
		</div>
		
	</div>
</section>
<!--==================================================-->
<!-- End Consalt Contact form   -->
<!--==================================================-->

<!--==================================================-->
<!-- Start Consalt Blog Area -->
<!--==================================================-->
<section class="blog_area inner_page two">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section_title text-center">
					<h1>Related News</h1>
				</div>
			</div>		
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="single-blog-box">
					<div class="single-blog-thumb">
						<img src="<?php echo base_url();?>assets/frontend/img/inner-img/blog1.png" alt="">							
					</div>
					<div class="blog-content">
						<div class="meta-blog">
							<p><span class="solution">business</span>20 Jan, 2024</p>
						</div>
						<div class="blog-title">
							<h3><a href="blog-details.html">Sustainability Consulting for Business Planning</a></h3>
						</div>
						<div class="blog_btn">
							<a href="blog-details.html">Read More <i class="flaticon flaticon-right-arrow"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single-blog-box">
					<div class="single-blog-thumb">
						<img src="<?php echo base_url();?>assets/frontend/img/inner-img/blog2.png" alt="">							
					</div>
					<div class="blog-content">
						<div class="meta-blog">
							<p><span class="solution">TECHNOLOGY</span>20 Jan, 2024</p>
						</div>
						<div class="blog-title">
							<h3><a href="blog-details.html">Consulting Industry changing Business Landscape</a></h3>
						</div>
						<div class="blog_btn">
							<a href="blog-details.html">Read More <i class="flaticon flaticon-right-arrow"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single-blog-box">
					<div class="single-blog-thumb">
						<img src="<?php echo base_url();?>assets/frontend/img/inner-img/blog3.png" alt="">								
					</div>
					<div class="blog-content">
						<div class="meta-blog">
							<p><span class="solution">business</span>20 Jan, 2024</p>
						</div>
						<div class="blog-title">
							<h3><a href="blog-details.html">Globally disintermediate exten services home_one</a></h3>
						</div>
						<div class="blog_btn">
							<a href="blog-details.html">Read More <i class="flaticon flaticon-right-arrow"></i></a>
						</div>
					</div>
				</div>
			</div>					
		</div>
	</div>
</section>
<!--==================================================-->
<!-- End Consalt Blog Area -->
<!--==================================================-->
<style>
	.heading-editor-class {
		color: #063232;
		font-family: "Fira Sans";
		font-style: normal;
		margin-bottom: 0;
		margin-top: 11px;
		line-height: 1.2;
		font-weight: 600;
		-webkit-transition: .5s;
		transition: .5s;
		/* font-size: 42px; */
	}

	/* Styles for other elements like li, ol, p, span */
	.para-heading-editor-class {
		font-size: 16px;
		line-height: 26px;
		color: #6b7a7a;
		font-weight: 400;
		font-family: "Fira Sans";
		transition: .5s;
	}
</style>