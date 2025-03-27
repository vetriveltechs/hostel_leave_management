<body data-mobile-nav-style="classic" class="custom-cursor">
	
	<?php
		$blog_limit             = 3;
		$getServicesBlogs		= $this->blogs_model->getServicesBlogs($list_code_1,$list_code_2);

		if(count($getServicesBlogs)>0)
		{
			?>
				<section class="pt-0">
					<div class="container">
						<div class="row justify-content-center mb-3">
							<div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
							<div class="mb-10px">
											<span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
											<span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">
											</span>
										</div>
								<h3 class="alt-font text-dark-gray fw-600 ls-minus-1px shadow-none" data-shadow-animation="true" data-animation-delay="1000">Insights & <span class="text-highlight fw-800">Resources</span></h3>
							</div>
						</div>
						<div class="row row-cols-1 row-cols-lg-3 row-cols-sm-2 justify-content-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 200, "easing": "easeOutQuad" }'>
							<?php 
								$blogIds = [];
								foreach ($getServicesBlogs as $industryBlogs) 
								{
									if (in_array($industryBlogs['blog_id'], $blogIds)) 
									{
										continue;
									}
								
									$blogIds[] = $industryBlogs['blog_id'];

									$blog_url = "uploads/blogs/".$industryBlogs['blog_id'].".png";

									?>
										<!-- start fancy text box item -->
										<div class="col md-mb-30px mt-2">
											<div class="border-radius-8px overflow-hidden box-shadow-quadruple-large services-box-style-03 last-paragraph-no-margin">
												<div class="position-relative box-image">
													<a href="<?php echo base_url(); ?>blog/<?php echo strtolower($industryBlogs['list_code']).'#blog-records'; ?>"><img src="<?php echo base_url().$blog_url;?>" alt=""></a>
												</div>
												<div class="bg-white">
												
														<div class="ps-65px pe-65px xl-ps-50px xl-pe-50px lg-ps-30px lg-pe-30px pt-30px pb-30px text-center">
															<a href="<?php echo base_url(); ?>blog/<?php echo strtolower($industryBlogs['list_code']).'#blog-records'; ?>" class="d-inline-block fs-18 alt-font fw-700 text-dark-gray mb-5px blog-title-scroll"><?php echo ucfirst($industryBlogs['blog_title']);?></a>
															<?php /*
																<p><?php echo ucfirst($industryBlogs['short_description']);?></p>
															*/ ?>
														</div>
													
													<div class="d-flex justify-content-center border-top border-color-extra-medium-gray pt-20px pb-20px ps-50px pe-50px position-relative text-center">
														<a href="<?php echo base_url(); ?>blog/<?php echo strtolower($industryBlogs['list_code']).'#blog-records'; ?>" class="btn btn-link btn-hover-animation-switch btn-very-small fw-700 text-dark-gray text-uppercase">
															<span>
																<span class="btn-text fs-16">Explore Blogs</span>
																<span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
																<span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
															</span>
														</a>
													</div>
												</div>
											</div>
										</div>
										<!-- end fancy text box item -->
									<?php 
								}
							?>
							
						</div>
						<div class="row justify-content-center" data-anime='{ "opacity": [0, 1], "translate": [0, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
							<div class="col-12 text-center mt-5"> 
								<span class="fs-20 text-dark-gray fw-500 ls-minus-05px">We craft insightful blogs on topics like <a href="<?php echo base_url();?>blog/all" class="fw-600 text-dark-gray">Explore all Blogs<i class="fa-solid fa-arrow-right ms-5px icon-very-small"></i></a></span>
							</div>
						</div>
					</div>
				</section>
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