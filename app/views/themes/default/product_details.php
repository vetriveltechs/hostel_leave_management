<body>
<!--==================================================-->
<!-- Start Consalt Breadcumb Area -->
<!--==================================================-->

<?php 
	$getProductDetails = $this->products_model->getProductDetailsAll($product_url);
?>

<!--==================================================-->
<!-- End Consalt Breadcumb Area -->
<!--==================================================-->
<section class="service_area style_two style_three inner_page pb-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- section title -->
				<div class="section_title style_three style_four text-center ">
					<h4>SERVICES WE PROVIDE</h4>
					<h1><?php echo $getProductDetails[0]['product_name'] ;?></h1>
				</div>
			</div>
		</div>
		
	</div>

	
</section>

<section class="why_choose_us">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<div class="choose_thumb ">
					<?php 
						$url = 'uploads/products/product_details/'.$getProductDetails[0]['product_detail_id'].'.png'
					?>
					<img src="<?php echo base_url() . $url; ?>" alt="No-Image">
					<div class="choose_thumb_shpae bounce-animate">
						<img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_dot.png" alt="">
					</div>
					<div class="choose_thumb_shpae2 bounce-animate2">
						<img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_dot2.png" alt="">
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="choose_right">
					<div class="section_title  pb-13">
						<h1><?php echo $getProductDetails[0]['title'] ;?></h1>
						<p><?php echo $getProductDetails[0]['title_description'] ;?></p>
						
					</div>					
					<div class="row">
			<div class="col-lg-12">
				<!-- section title -->
				<div class="section_title style_three  ">
					<h3><?php echo $getProductDetails[0]['why_choose_title'] ;?></h3>
					<p class="pt-2"><?php echo $getProductDetails[0]['why_choose_jesperapps'] ;?></p>
				</div>
				
				<div class="about_btn style_two">
							<a href="<?php echo base_url() .'contact-us'; ?>"><i class="far fa-thumbs-up"></i>Request Demo<span></span></a>
						</div>						
			</div>
		</div>	
					
				
				</div>			
			</div>
		</div>
	</div>
	
</section>




<?php 
    // Fetch key features data
    $getKeyFeatures = $this->products_model->getKeyFeaturesAll($product_url);

    if (count($getKeyFeatures) > 0) 
    {
		?>
			<section class="service_area style_two style_three inner_page pb-0">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<!-- section title -->
							<div class="section_title style_three style_four text-center ">
								<h1><?php echo $getKeyFeatures[0]['title'] ;?></h1>
							</div>
						</div>
					</div>
					
				</div>

				
			</section>
		<?php
        foreach ($getKeyFeatures as $index => $feature) 
        { 
            $isEven = $index % 2 === 0;
            ?>
            <!--==================================================-->
            <!-- Start Dynamic Feature Section -->
            <section class="why_choose_us">
                <div class="container">
                    <div class="row align-items-center">
                        <?php 
                        if ($isEven) 
                        { 
							$url = 'uploads/products/key_features/'.$feature['line_id'].'.png'
                            ?>
                                <!-- Left Image, Right Content -->
                                <div class="col-lg-7 col-md-12 align-items-center justify-content-center">
                                    <div class="choose_right">
                                        <div class="section_title style_three pb-13">
                                            <h4><?php echo $feature['line_title']; ?></h4>
                                            <h1><?php echo $feature['line_description']; ?></h1>
                                            <p><?php echo $feature['detail_description']; ?></p>
                                        </div>

                                        <!-- Shapes -->
                                        <div class="choose_all_shape">
                                            <div class="choose_one bounce-animate">
                                                <img src="<?php echo base_url();?>assets/frontend/img/home_3/box.png" alt="">
                                            </div>
                                            <div class="choose_two rotate">
                                                <img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_rotete.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12">
                                    <div class="--choose_thumb">
                                        <img src="<?php echo base_url() . $url; ?>" class="key-features-image" alt="No-Image">
                                        <div class="choose_thumb_shpae bounce-animate">
                                            <img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_dot.png" alt="">
                                        </div>
                                        <div class="choose_thumb_shpae2 bounce-animate2">
                                            <img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_dot2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            <?php 
                        } 
                        else 
						{ 
							$url = 'uploads/products/key_features/'.$feature['line_id'].'.png'
							?>
								<!-- Left Image, Right Content (Reversed) -->
								<div class="col-lg-7 col-md-12">
									<div class="choose_thumb">
										<img src="<?php echo base_url() . $url; ?>" class="key-features-image" alt="No-Image">
										<div class="choose_thumb_shpae bounce-animate">
											<img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_dot.png" alt="">
										</div>
										<div class="choose_thumb_shpae2 bounce-animate2">
											<img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_dot2.png" alt="">
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-md-12 align-items-center justify-content-center">
									<div class="choose_right">
										<div class="section_title style_three pb-13">
											<h4><?php echo $feature['line_title']; ?></h4>
											<h1><?php echo $feature['line_description']; ?></h1>
											<p><?php echo $feature['detail_description']; ?></p>
										</div>

										<!-- Shapes -->
										<div class="choose_all_shape">
											<div class="choose_one bounce-animate">
												<img src="<?php echo base_url();?>assets/frontend/img/home_3/box.png" alt="">
											</div>
											<div class="choose_two rotate">
												<img src="<?php echo base_url();?>assets/frontend/img/home_3/choose_rotete.png" alt="">
											</div>
										</div>
									</div>
								</div>
                        		<?php 
							} 
						?>
                    </div>
                </div>
            </section>
            <!--==================================================-->
            <?php 
        } // End foreach loop
    } // End if check 
?>
<!--==================================================-->
<!-- Start Consalt Service Details Area -->
<!--==================================================-->
<?php 
	$getBenefits = $this->products_model->getBenefitsAll($product_url);


	if(count($getBenefits)>0)
	{
		$url = "uploads/products/benefits/banner/".$getBenefits[0]['header_id'].".png";
		?>
			<section class="service_details pt-5 pb-5">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="service_details_img">
								<img src="<?php echo base_url().$url;?>" alt="No-Image">
							</div>
						</div>
					</div>
					<div class="row pt-60">
						<div class="">
							<div class="service_details_content">
								<h2><?php echo $getBenefits[0]['title'] ?></h2>
								
							</div>
							<div class="row pt-32">
								<?php 
									foreach ($getBenefits as $benefits) 
									{
										$url = 'uploads/products/benefits/'.$benefits['line_id'].'.png'
										?>
											<div class="col-lg-6 col-md-12">
												<div class="service_details_item">
													<div class="service_detls_icon">
														<img src="<?php echo base_url() . $url; ?>" alt="No-Image">
													</div>
													<div class="service_dtls_content">							
														<h3><?php echo $benefits['line_title'] ;?></h3>
														<p><?php echo $benefits['line_description'] ;?></p>
													</div>				
												</div>
											</div>
										<?php
									}
								?>
								
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
		<?php
	}
?>

<!--==================================================-->
<!-- End Consalt Service Details Area -->
<!--==================================================-->


<!--==================================================-->
<!-- Start Consalt About Area Style Two-->
<!--==================================================-->
<?php 
	$getDetails = $this->products_model->getDetailsAll($product_url);

	if(count($getDetails)>0)
	{
		$url = 'uploads/products/details/header_img/'.$getDetails[0]['header_id'].'.png'
		?>
			<section class="about_area style_two pt-5 pb-5">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 col-md-12">
							<div class="about_thumb">
								<img src="<?php echo base_url() . $url; ?>" alt="">
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="section_title">
								<h4><?php echo $getDetails[0]['product_name'];?></h4>
								<h2><?php echo $getDetails[0]['title'];?></h2>
							</div>
								
							<div>
								<?php 
									foreach ($getDetails as $details) 
									{
										$url = 'uploads/products/details/'.$details['line_id'].'.png'

										?>
											<div class="about-icon_box">
												<div class="about_icon">
													<img src="<?php echo base_url() . $url; ?>" alt="No-Image">
												</div>
												<div class="about_content style_two">
													<h3><?php echo $details['line_title'];?></h3>
													<p><?php echo $details['line_description'];?></p>
												</div>
											</div>
										<?php
									}
								?>
								
							</div>
								
								
						</div>
					</div>
				</div>
				
			</section>
		<?php
	}
?>

<!--==================================================-->
<!-- End Consalt About Area Style Two-->
<!--==================================================-->




<!--==================================================-->
<!-- Start Consalt  Faq Area-->
<!--==================================================-->
<section class="faq_area pt-5 ">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section_title text-center">
					<h4><?php echo $getProductDetails[0]['product_name'] ;?></h4>
					<h2><?php echo $getProductDetails[0]['remarks_title'] ;?></h2>
					<p><?php echo $getProductDetails[0]['remarks'] ;?></p>
				</div>
			</div>
		</div>
		
	</div>
</section>
<!--==================================================-->
<!-- End Consalt  Faq Area-->
<!--==================================================-->

<section class="contact_area inner_section pt-0">
	<div class="container" id="demo-request">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="section_title">
					<h4>GET IN TOUCH</h4>
					<h1>Request Demo </h1>
					<p>Need help or want to explore our Products? Contact JesperApps Consulting, and our team will provide the guidance you need to move forward.</p>
				</div>

			</div>
			<div class="col-lg-6">
				<!-- contact form box -->
				<div class="contact-form-box style_two">
					<!-- section title -->
					<div class="section_title style_three style_four text-center ">
						<h4>CONTACT US</h4>
						<h1>Connect for Innovation, Stay for Results</h1>
					</div>
					<form action="<?php echo base_url(); ?>product-details.html/<?php echo $product_url; ?>" method="POST" id="productForm" onsubmit="return submitForm(event);">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" name="first_name" id="first_name" placeholder="First Name *">
                                    <h6 id="first_name_error" class="error-message"></h6>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" name="last_name" id="last_name" placeholder="Last Name *">
                                    <h6 id="last_name_error" class="error-message"></h6>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" name="company_name" id="company_name" placeholder="Company Name *">
                                    <h6 id="company_name_error" class="error-message"></h6>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-box">
									<input type="text" name="company_email" id="company_email" placeholder="Company Email *">
                                    <h6 id="company_email_error" class="error-message"></h6>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-box message">
									<textarea name="message" id="message" cols="30" rows="10" placeholder="Write to Us"></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
                                <div class="row mt-5">
                                    <div class="col-lg-4 col-md-3 col-5 mt-1">
                                        <h6 id="mainCaptcha" style="color:#000; display:inline-block;"></h6>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-4 px-0 mt-1">
                                        <button type="button" id="refresh" onclick="Captcha();" class="refresh-btn" style="border:none; background:none;">
                                            <img src="<?php echo base_url();?>assets/frontend/img/sync.png" alt="Sync Alt Icon" class="icon" style="width:20px;height:20px;">
                                        </button>
                                    </div>
                                    <div class="col-lg-7 col-md-8 col-12 mt-1">
                                        <input type="text" name="captcha" id="captcha" class="captcha-input" placeholder="Captcha" />
                                        <h6 id="captcha_error" class="error-message" style="text-align:left;color:red;"></h6>
                                    </div>
                                </div>
                            </div>
							<div class="contact-form">
								<button type="submit"><i class="far fa-thumbs-up"></i> Request Us </button>
							</div>
						</div>
					</form>
				</div> 
			</div>
		</div>

	</div>

	<div class="contact_shape2 dance2">
		<img src="<?php echo base_url();?>assets/frontend/img/home_3/service_shpe2.png" alt="">
	</div>
</section>
<script>
    $(document).ready(function () {
        // Generate Captcha on page load
        Captcha();

        // Input event listeners for validation
        $('#first_name').on('input', function () {
            this.value = this.value.replace(/\d/g, ''); // Remove numbers
            validateName($(this).val(), 'first_name','First Name');
        });

        $('#last_name').on('input', function () {
            this.value = this.value.replace(/\d/g, ''); // Remove numbers
            validateName($(this).val(), 'last_name','Last Name');
        });

        $('#company_name').on('input', function () {
            validateCompanyName($(this).val());
        });

        $('#company_email').on('input', function () {
            validateEmail($(this).val());
        });

        $('#captcha').on('input', function () {
            validateCaptcha($(this).val());
        });

        $('#refresh').click(function () {
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
    function validateName(name, fieldId,fieldError) {
        const namePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
        if (name === '') {
            $('#' + fieldId + '_error').text('Please enter your ' + fieldError +'.');
            $('#' + fieldId).addClass('is-invalid').removeClass('is-valid');
        } else if (!namePattern.test(name)) {
            $('#' + fieldId + '_error').text('Invalid name format.');
            $('#' + fieldId).addClass('is-invalid').removeClass('is-valid');
        } else {
            $('#' + fieldId + '_error').text('');
            $('#' + fieldId).removeClass('is-invalid').addClass('is-valid');
        }
    }

    function validateCompanyName(company_name) {
        const companyNamePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
        if (company_name === '') {
            $('#company_name_error').text('Please enter your company name.');
            $('#company_name').addClass('is-invalid').removeClass('is-valid');
        } 
		else if (!companyNamePattern.test(company_name)) {
            $('#company_name_error').text('Invalid company name format.');
            $('#company_name').addClass('is-invalid').removeClass('is-valid');
		}
		else {
            $('#company_name_error').text('');
            $('#company_name').removeClass('is-invalid').addClass('is-valid');
        }
    }

    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            $('#company_email_error').text('Please enter your email.');
            $('#company_email').addClass('is-invalid').removeClass('is-valid');
        } else if (!emailPattern.test(email)) {
            $('#company_email_error').text('Please enter a valid email address.');
            $('#company_email').addClass('is-invalid').removeClass('is-valid');
        } else {
            $('#company_email_error').text('');
            $('#company_email').removeClass('is-invalid').addClass('is-valid');
        }
    }

    function validateCaptcha(captchaValue) {
        const generatedCaptcha = $('#mainCaptcha').text().trim();
        if (captchaValue === '') {
            $('#captcha_error').text('Please enter the captcha.');
            $('#captcha').addClass('is-invalid').removeClass('is-valid');
        } else if (captchaValue !== generatedCaptcha) {
            $('#captcha_error').text('Captcha is incorrect.');
            $('#captcha').addClass('is-invalid').removeClass('is-valid');
        } else {
            $('#captcha_error').text('');
            $('#captcha').removeClass('is-invalid').addClass('is-valid');
        }
    }

    // Form Submission Validation
    function submitForm(event) {
        event.preventDefault(); // Prevent default form submission

        validateName($('#first_name').val(), 'first_name','First Name');
        validateName($('#last_name').val(), 'last_name','Last Name');
        validateCompanyName($('#company_name').val());
        validateEmail($('#company_email').val());
        validateCaptcha($('#captcha').val());

        // Check if any field has errors
        if ($('.is-invalid').length === 0) {
            $('#productForm')[0].submit(); // Submit form if valid
        }
        return false; // Prevent default submission
    }

</script>
</body>