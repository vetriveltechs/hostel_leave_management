<body data-mobile-nav-style="classic" class="custom-cursor">
	<?php
		$getServicesHeaderList 	= $this->services_model->getServicesHeaderList($list_code_1, $list_code_2);
	
		if (count($getServicesHeaderList) > 0) 
		{
			$header_banner_url 	= "uploads/services/banner/" . $getServicesHeaderList[0]['header_id'] . ".png";
			$overview_url 		= "uploads/services/overviews/" . $getServicesHeaderList[0]['header_id'] . ".png";

			?>
				<!-- start page title -->
				<section class="mt-5 --top-space-margin page-title-big-typography cover-background --magic-cursor --round-cursor" style="background-image: url('<?php echo base_url() . $header_banner_url; ?>')">
					<div class="container">
						<div class="row extra-very-small-screen align-items-center">
							<div class="col-lg-5 col-sm-8 position-relative --page-title-extra-small" data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [-30, 0], "duration": 800, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
								<h5 class="mb-20px xs-mb-20px text-white fs-19 text-shadow-medium"><span class="w-30px h-2px bg-yellow d-inline-block align-middle position-relative top-minus-2px me-10px"></span><?php echo ucfirst($getServicesHeaderList[0]['main_category']); ?></h5>
								<h1 class="text-white text-shadow-medium fs-50 fw-500 ls-minus-2px mb-0"><?php echo ucfirst($getServicesHeaderList[0]['list_value']); ?></h1>
							</div>
						</div>
					</div>
				</section>
				<!-- end page title -->

				<!-- start section -->
				<section id="down-section" class="">
					<div class="container">
						<div class="row align-items-center justify-content-center" data-anime='{ " perspective": 1200 }'>
							<div class="col-lg-6 md-mb-40px" data-anime='{ "translateY": [0, 0], "zoom": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
								<figure class="position-relative m-0">
									<img src="<?php echo base_url() . $overview_url; ?>" alt="No-image" class="w-100 border-radius-5px">


								</figure>
							</div>
							<div class="col-xl-5 offset-xl-1 col-lg-6 col-md-10" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
								<div class="mb-10px">
									<span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
									<span class="text-dark fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Overview</span>
								</div>
								<h5 class="fw-600 text-dark-gray mb-20px ls-minus-2px alt-font"></h5>
								<p class="w-95 md-w-100 mb-35px"><?php echo $getServicesHeaderList[0]['overview']; ?></p>
								<h3 class="fw-600 text-dark-gray mb-20px ls-minus-2px alt-font">Why <?php echo ucfirst(SITE_NAME); ?>?</h3>
								<p class="w-95 md-w-100 mb-35px"><?php echo $getServicesHeaderList[0]['why_jesperapps']; ?></p>

							</div>
						</div>
					</div>
				</section>
				<!-- end section -->
			<?php

				$getServicesLineList 	= $this->services_model->getServicesLineList($list_code_1, $list_code_2);
					
				if (count($getServicesLineList) > 0) 
				{
					?>
						<!-- start section -->
						<section class="py-0 pt-0">
							<div class="container">
								<div class="row align-items-center">
									<div class="col-xl-5 col-lg-6 md-mb-50px" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
										<h3 class="fw-700 text-dark-gray ls-minus-1px">Why Choose Us?</h3>
										<div class="row row-cols-1 mt-40px">
											<!-- start process step item -->
											<?php
											$Sno = 1;
											foreach ($getServicesLineList as $servicesList) {
												$why_choose_image_url 			= "uploads/services/why_choose_images/" . $getServicesLineList[0]['header_id'] . ".png";
												$why_choose_icon_image_url 		= "uploads/services/why_choose_images/why_choose_icon_images/" . $getServicesLineList[0]['header_id'] . ".png";
											?>
												<div class="col-12 process-step-style-05 position-relative hover-box">
													<div class="process-step-item d-flex">
														<div class="process-step-icon-wrap position-relative">
															<div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 position-relative">
																<span class="number position-relative z-index-1 text-dark-gray"><?php echo $Sno; ?></span>
																<div class="box-overlay bg-base-color rounded-circle"></div>
															</div>
														<span class="progress-step-separator bg-extra-medium-gray"></span>
													</div>
													<div class="process-content ps-30px last-paragraph-no-margin mb-40px">
														<span class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px"><?php echo ucfirst($servicesList['line_title']); ?></span>
														<p class="w-85 lg-w-100"><?php echo ucfirst($servicesList['line_description']); ?></p>
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
								<div class="col-lg-6 col-md-11 position-relative offset-xl-1">
									<figure class="position-relative m-0 text-center" data-anime='{ "effect": "slide", "color": "#fff2ef", "direction":"rl", "easing": "easeOutQuad", "delay":50}'>
										<img src="<?php echo base_url() . $why_choose_image_url; ?>" alt="">
										<?php /*
										<figcaption class="position-absolute bottom-90px right-0px" data-anime='{ "translateY": [-50, 0], "opacity": [0,1], "duration": 800, "delay": 1000, "staggervalue": 300, "easing": "easeOutQuad" }'>
											<img src="<?php echo base_url() . $why_choose_icon_image_url; ?>" class="animation-float box-shadow-quadruple-large border-radius-6px" alt="">
										</figcaption>
										*/ ?>
									</figure>
								</div>
							</div>

						</div>
					</section>
					<!-- end section -->

				<?php
			}
			$getDetails = $this->services_model->getDetailsAll($list_code_1, $list_code_2);

			if (count($getDetails) > 0) 
			{
				?>
					<section class="overflow-hidden bg-gradient-very-light-gray xs-pb-30px pt-5">
						<div class="container-fluid">
							<div class="row justify-content-center mb-1">
								<div class=" col-lg-12  text-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
									<!-- <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">-- Recent News</span> -->
									<h3 class="fw-700 text-dark-gray ls-minus-1px"><?php echo ucfirst($getDetails[0]['title']); ?></h3>
									<p class="w-100"><?php echo ucfirst($getDetails[0]['description']); ?></p>

								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="outside-box-right-20 sm-outside-box-right-0">
										<div class="swiper magic-cursor slider-one-slide"
											data-slider-options='{
							"slidesPerView": 1,
							"spaceBetween": 30,
							"loop": true,
							"navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" },
							"autoplay": { "delay": 4000, "disableOnInteraction": false },
							"keyboard": { "enabled": true, "onlyInViewport": true },
							"breakpoints": {
								"1200": { "slidesPerView": 3 },
								"992": { "slidesPerView": 2 },
								"768": { "slidesPerView": 2 },
								"320": { "slidesPerView": 1 }
							},
							"effect": "slide"
						}'>
											<div class="swiper-wrapper">
												<?php
												$count = 0;
												foreach ($getDetails as $detail) {
													if ($count >= 4) break; // Stop after 4 records
													$detail_url = "uploads/services/details/" . $detail["line_id"] . ".png";
												?>
													<div class="swiper-slide">
														<!-- Start services box style -->
														<div class="services-box-style-03 last-paragraph-no-margin border-radius-6px overflow-hidden">
															<div class="position-relative box-image">
																<img src="<?php echo base_url() . $detail_url; ?>" alt="No-Image" class="w-100">
															</div>
															<div class="bg-white text-center p-4">
																<a href="javascript:void(0);" class="d-inline-block fs-18 fw-700 text-dark-gray mb-5px">
																	<?php echo ucfirst($detail['line_title']); ?>
																</a>
																<p class="detail-description"><?php echo ucfirst($detail['line_description']); ?></p>
															</div>
														</div>
														<!-- End services box style -->
													</div>
												<?php
													$count++;
												}
												?>
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>
					</section>
					
				<?php
			}

			$getBenefits = $this->services_model->getBenefitsAll($list_code_1, $list_code_2);

			if (count($getBenefits) > 0) 
			{
				$banner_url = "uploads/services/benefits/banner/" . $getBenefits[0]['header_id'] . ".png";

				?>

					<section class="position-relative pt-0 overflow-hidden">
						<img src="images/demo-data-analysis-bg-06.png" class="position-absolute top-20 left-0px" data-bottom-top="transform: translateY(150px)" data-top-bottom="transform: translateY(-150px)" alt="" />
						
						<div class="container position-relative">
							<div class="row align-items-center justify-content-center">
								<div class="col-lg-6 text-center text-lg-start md-mb-30px">
									
									<img src="<?php echo base_url() . $banner_url; ?>" alt="No-Image" class="md-w-70 sm-w-100" data-bottom-top="transform: translateY(-20px)" data-top-bottom="transform: translateY(20px)">
								</div>
								<div class="col-xl-5 col-lg-6 offset-xl-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
									<div class="bg-base-color fw-600 text-white text-uppercase ps-20px pe-20px fs-12 border-radius-100px d-inline-block mb-25px">benefits</div>
									<h3 class="fw-700 fs-42 alt-font text-dark-gray ls-minus-1px mb-50px sm-mb-30px">Problems We <span class="text-highlight">Solve.<span class="bg-base-color opacity-3 h-10px bottom-10px"></span></span></h3>
									<div class="row row-cols-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 800, "staggervalue": 300, "easing": "easeOutQuad" }'>
										<!-- start process step item -->
										<?php
										$benefitSNo = 1;
										foreach ($getBenefits as $benefits) {

										?>
											<div class="col-12 process-step-style-05 position-relative hover-box">
												<div class="process-step-item d-flex">
													<div class="process-step-icon-wrap position-relative">
														<div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-65px w-65px fs-16 bg-very-light-gray fw-700 alt-font position-relative">
															<span class="number position-relative z-index-1 text-dark-gray"><?php echo $benefitSNo; ?></span>
															<div class="box-overlay bg-dark-gray rounded-circle"></div>
														</div>
														<span class="progress-step-separator bg-dark-gray opacity-1"></span>
													</div>
													<div class="process-content ps-30px last-paragraph-no-margin mb-40px">
														<span class="d-block fw-600 text-dark-gray mb-5px fs-19 alt-font"><?php echo ucfirst($benefits['line_title']); ?></span>
														<p class="w-80 xl-w-90 xs-w-100"><?php echo ucfirst($benefits['line_description']); ?></p>
													</div>
												</div>
											</div>
										<?php
											$benefitSNo++;
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
			<section class="overflow-hidden pt-0">
				<div class="container">
					<div class="row justify-content-center align-items-center mb-9 sm-mb-45px">
						<div class="col-xxl-5 col-lg-6 md-mb-50px" data-anime='{ "el": "childs", "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
							<span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Get in touch with us</span>
							<h3 class="fw-700 text-dark-gray ls-minus-1px mb-20px sm-mb-35px"><?php echo ucfirst($getServicesHeaderList[0]['contact_title']); ?></h3>
							<p class="w-80 xl-w-90 xs-w-100"><?php echo ucfirst($getServicesHeaderList[0]['contact_description']); ?></p>
						</div>
						<div class="col-lg-6 offset-xxl-1" data-anime='{ "el": "childs", "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
							<div class="contact-form-style-03 position-relative border-radius-10px bg-white p-14 lg-p-10 box-shadow-double-large overflow-hidden last-paragraph-no-margin">
								<h5 class="fw-700 text-dark-gray mb-30px sm-mb-20px fancy-text-style-4 ls-minus-2px">Reach out to us for
									<span data-fancy-text='{ "effect": "rotate", "string": ["professional support!", "customized solutions!"] }'></span>
								</h5>
								<form action="<?php echo base_url(); ?>services-details/<?php echo strtolower($list_code_1); ?>/<?php echo strtolower($list_code_2); ?>" method="post" id="serviceForm" onsubmit="return submitForm(event);">
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
										<input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="email" name="company_email" id="company_email" placeholder="Email *" />
										<h6 id="company_email_error" class="error-message"></h6>
									</div>
									<div class="position-relative form-group mb-0px">
										<!-- <span class="form-icon text-dark-gray"><i class="bi bi-person icon-extra-medium"></i></span> -->
										<input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="text" name="mobile_number" id="mobile_number" maxlength="10" minlength="10" placeholder="Mobile Number" oninput="validateNumber(this)" />
										<h6 class="error-message"></h6>
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
													<img src="<?php echo base_url(); ?>assets/frontend/img/jesper/sync.png" alt="Sync Alt Icon" class="icon" style="width:20px;height:20px;">
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
	
	
	<style>
		.detail-description {
			min-height: 120px;
			/* Adjust as needed */
			max-height: 120px;
			/* Adjust based on content */
			overflow: hidden;
			/* Prevent scrolling */
			text-overflow: ellipsis;
			/* Add "..." for overflow text */
			white-space: normal;
			/* Allow wrapping */
			display: block;
			/* Ensure it respects height */
		}
	</style>
	<script>
		$(document).ready(function() {
			// Generate Captcha on page load
			Captcha();

			// Input event listeners for validation
			$('#first_name').on('input', function() {
				this.value = this.value.replace(/\d/g, ''); // Remove numbers
				validateName($(this).val(), 'first_name', 'First Name');
			});

			$('#last_name').on('input', function() {
				this.value = this.value.replace(/\d/g, ''); // Remove numbers
				validateName($(this).val(), 'last_name', 'Last Name');
			});

			$('#company_name').on('input', function() {
				validateCompanyName($(this).val());
			});

			$('#company_email').on('input', function() {
				validateEmail($(this).val());
			});

			$('#captcha').on('input', function() {
				validateCaptcha($(this).val());
			});

			$('#refresh').click(function() {
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
			} else if (!companyNamePattern.test(company_name)) {
				$('#company_name_error').text('Invalid company name format.');
				$('#company_name').addClass('is-invalid');
			} else {
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

			validateName($('#first_name').val(), 'first_name', 'First Name');
			validateName($('#last_name').val(), 'last_name', 'Last Name');
			validateCompanyName($('#company_name').val());
			validateEmail($('#company_email').val());
			validateCaptcha($('#captcha').val());

			// Check if any field has errors
			if ($('.is-invalid').length === 0) {
				$('#serviceForm')[0].submit(); // Submit form if valid
			}
			return false; // Prevent default submission
		}
	</script>
</body>