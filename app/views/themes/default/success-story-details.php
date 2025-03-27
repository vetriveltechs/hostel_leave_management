<?php 
	$getCaseStudiesDetails  = $this->casestudies_model->getCaseStudyDetails($list_code,$casestudy_url);
	$caseStudyUrl 			= "uploads/case_studies/banner/".$getCaseStudiesDetails[0]['casestudies_id'].".png";
	$client_url 			= "uploads/case_studies/client_images/".$getCaseStudiesDetails[0]['casestudies_id'].".png";
   
?>

<section class="ipad-top-space-margin bg-dark-gray cover-background one-fifth-screen d-flex align-items-center" style="background-image: url(<?php echo base_url().$caseStudyUrl;?>)">
	<div class="opacity-light bg-dark-gray"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10 position-relative" data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [50, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
				<div class="d-inline-block mb-20px sm-mb-25px">
					<span class="text-white fs-18 opacity-5">
						<a href="javascript:void(0)" class="text-white"><?php echo isset($getCaseStudiesDetails[0]['last_updated_date']) ? date("d F Y", strtotime($getCaseStudiesDetails[0]['last_updated_date'])) : "";?></a>
						<span class="d-inline-block fs-24 align-top ms-10px me-10px">•</span>
						<a href="<?php echo base_url(); ?>success-story/<?php echo strtolower($getCaseStudiesDetails[0]['list_code']); ?>" class="text-white"><?php echo ucfirst($getCaseStudiesDetails[0]['list_value']); ?></a>
					</span>
				</div>
				<h1 class="text-white fs-55 w-80 lg-w-80 md-w-70 sm-w-100 fw-500 ls-minus-2px text-white alt-font mb-30px overflow-hidden mb-0"><?php echo ucfirst($getCaseStudiesDetails[0]['title']); ?></h1>
				<div class="text-white fs-18 mt-40px">
					<img class="w-80px h-80px rounded-circle me-15px" src="<?php echo base_url().$client_url; ?>" alt="No-Image">
					<a href="javascript:void(0)" class="text-white text-decoration-line-bottom"><?php echo ucfirst($getCaseStudiesDetails[0]['client_name']); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- end page title -->
<!-- end section -->
<!-- start section -->
<?php 
	$description = $getCaseStudiesDetails[0]['description'];
	if($description!=NULL)
	{
		?>
			<section class="pb-0">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-10">
							<?php
                                $dom = new DOMDocument();
                                libxml_use_internal_errors(true);
                                $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));
                                libxml_clear_errors();

                                $headings = $dom->getElementsByTagName('h1');
                                foreach ($headings as $heading) 
                                {
                                    $id = 'section_' . strtolower(str_replace(' ', '_', $heading->textContent));
                                    $heading->setAttribute('id', $id);
                                    $heading->setAttribute('class', 'heading-editor-class');
                                }

                                $headings = $dom->getElementsByTagName('h2');
                                foreach ($headings as $heading) 
                                {
                                    $id = 'section_' . strtolower(str_replace(' ', '_', $heading->textContent));
                                    $heading->setAttribute('id', $id);
                                    $heading->setAttribute('class', 'heading-editor-class');
                                }

                                $headings = $dom->getElementsByTagName('h3');
                                foreach ($headings as $heading) 
                                {
                                    $id = 'section_' . strtolower(str_replace(' ', '_', $heading->textContent));
                                    $heading->setAttribute('id', $id);
                                    $heading->setAttribute('class', 'heading-editor-class');
                                }

                                $lists = $dom->getElementsByTagName('li');
                                foreach ($lists as $li) 
                                {
                                    $li->setAttribute('class', 'para-heading-editor-class');
                                }

                                $orderedLists = $dom->getElementsByTagName('ol');
                                foreach ($orderedLists as $ol) 
                                {
                                    $ol->setAttribute('class', 'para-heading-editor-class');
                                }

                                $paragraphs = $dom->getElementsByTagName('p');
                                foreach ($paragraphs as $p) 
                                {
                                    $p->setAttribute('class', 'para-heading-editor-class');
                                }

                                $spans = $dom->getElementsByTagName('span');
                                foreach ($spans as $span) 
                                {
                                    $span->setAttribute('class', 'para-heading-editor-class');
                                }

                                $images = $dom->getElementsByTagName('img');
                                foreach ($images as $img) 
                                {
                                    $existingClass = $img->getAttribute('class');
                                    $newClass = trim($existingClass . ' blog_detail_banner');
                                    $img->setAttribute('class', $newClass); 
                                }
                                echo $dom->saveHTML();
                            ?>
						</div>
					</div>
				</div>
			</section>
		<?php
	}
?>

<!-- end section -->

<!-- start section -->
<?php /*
	<section class="half-section pt-0">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">


					<div class="row justify-content-center">
						<div class="col-12 text-center elements-social social-icon-style-04">
							<ul class="large-icon dark">
								<li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
								<li><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
								<li><a class="linkedin" href="http://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
								<li><a class="behance" href="http://www.behance.com/" target="_blank"><i class="fa-brands fa-behance"></i><span></span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	*/ ?>
<!-- end section -->
<!-- start section -->
<?php 
	$casestudy_limit	= 3;
	$getRelatedCaseStudies	= $this->casestudies_model->getRelatedCaseStudies($list_code,$casestudy_url,$casestudy_limit);
	
	if(count($getRelatedCaseStudies)>0)
	{
		?>
			<section class="bg-very-light-gray border-radius-6px">
				<div class="container">
					<div class="row justify-content-center mb-1">
						<div class="col-12 col-md-5 text-center">
							<span class="ls-2px text-uppercase text-dark-gray fw-500 lh-22 mb-10px d-block">You may also <span class="d-inline-block border-2 border-bottom border-color-transparent-base-color fw-800">like</span></span>
							<h4 class="fw-600 text-dark-gray alt-font ls-minus-1px w-100 mx-auto">Related Case Studies</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-12 px-0">
							<ul class="blog-grid blog-wrapper grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-double-extra-large">
								<li class="grid-sizer"></li>
								<!-- start blog item -->
								<?php 
									foreach ($getRelatedCaseStudies as $relatedCaseStudies ) 
									{
										$casestudy_url= "uploads/case_studies/".$relatedCaseStudies['casestudies_id'].".png";
										?>
											<li class="grid-item">
												<div class="card border-radius-6px border-0 box-shadow-medium-bottom box-shadow-medium-bottom-hover">
													<div class="blog-image">
														<a href="<?php echo base_url() . 'success-story-details/' . strtolower($relatedCaseStudies['list_code']) .'/'.$relatedCaseStudies['casestudy_url']; ?>" class="d-block"><img src="<?php echo base_url().$casestudy_url;?>" alt="" /></a>
														<div class="blog-categories">
															<!-- <a href="#" class="categories-btn bg-dark-gray-transparent text-white text-uppercase fw-600">Fashion</a> -->
														</div>
													</div>
													<div class="card-body p-11">
														<a href="<?php echo base_url() . 'success-story-details/' . strtolower($relatedCaseStudies['list_code']) .'/'.$relatedCaseStudies['casestudy_url']; ?>" class="card-title mb-15px fw-600 fs-18 lh-26 text-dark-gray d-inline-block"><?php echo ucfirst($relatedCaseStudies['list_value']) ?></a>
														<p><?php echo ucfirst($relatedCaseStudies['title']) ?></p>
														<div class="author d-flex justify-content-center align-items-center position-relative overflow-hidden fs-15 text-uppercase">
															<div class="me-auto">
																<span class="text-dark-gray blog-date d-inline-block fw-600 text-transform-none"><?php echo isset($relatedCaseStudies[0]['last_updated_date']) ? date("d F Y", strtotime($relatedCaseStudies[0]['last_updated_date'])) : '30 December 2023'; ?></span>
																<div class="text-dark-gray d-inline-block author-name text-transform-none">By <a href="#" class="text-dark-gray text-decoration-line-bottom fw-600"><?php echo ucfirst($relatedCaseStudies['client_name']) ?></a></div>
															</div>
															<!-- <div class="like-count fs-14">
																<a href="#"><i class="fa-regular fa-heart text-red d-inline-block"></i><span class="text-dark-gray align-middle fw-700">45</span></a>
															</div> -->
														</div>
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