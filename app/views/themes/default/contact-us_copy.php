    <!-- start page title -->
    <section class="page-title-big-typography bg-dark-gray ipad-top-space-margin xs-py-0 cover-background background-position-center-top" style="background-image: url(<?php echo base_url();?>assets/frontend/img/demo-startup-contact-title-bg223.png)">
            <div class="opacity-extra-medium bg-gradient-black-green"></div>
            <div class="container">
                <div class="row align-items-center justify-content-center small-screen">
                    <div class="col-xl-6 col-lg-7 col-sm-8 position-relative text-center page-title-extra-small" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 400, "delay": 0, "staggervalue": 100, "easing": "easeOutQuad" }'>
                        <div><h1 class="text-uppercase mb-15px alt-font text-white opacity-6 fw-500 ls-2px" data-fancy-text='{ "opacity": [0, 1], "translateY": [50, 0], "filter": ["blur(20px)", "blur(0px)"], "string": ["Contact us"], "duration": 400, "delay": 0, "speed": 50, "easing": "easeOutQuad" }'></h1></div>
                        <h3 class="m-auto text-white alt-font text-shadow-double-large fw-700 w-90 xl-w-100" data-fancy-text='{ "opacity": [0, 1], "translateY": [50, 0], "filter": ["blur(20px)", "blur(0px)"], "string": ["Let&apos;s discuss your projects now"], "duration": 400, "delay": 0, "speed": 50, "easing": "easeOutQuad" }'></h3>
                    </div>
                    <div class="down-section text-center" data-anime='{ "translateY": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <a href="#contactForm" class="section-link">
                            <div class="text-white">
                                <i class="line-icon-Down icon-medium"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->  
        <!-- start section -->
        <section class="overflow-hidden">
            <div class="container">
                <div class="row justify-content-center align-items-center mb-9 sm-mb-45px"> 
                    <div class="col-xxl-5 col-lg-6 md-mb-50px" data-anime='{ "el": "childs", "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'> 
                        <span class="fs-15 text-uppercase text-color-change fw-600 mb-15px d-block ls-1px">Get in touch with us</span> 
                        <h3 class="fw-700 text-dark-gray ls-minus-1px mb-50px sm-mb-35px">Do you need help? Contact with us now!</h3>
                        <!-- start features box item -->
                        <div class="icon-with-text-style-01 mb-10 md-mb-35px">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                               
                                <div class="feature-box-content last-paragraph-no-margin">
                                    <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">Our Location</span>
                                    <p class="w-60 md-w-100"><?php echo ADDRESS1;?></p>
                                </div>
                            </div>
                        </div>
                        <!-- end features box item -->
                        <!-- start features box item -->
                        <div class="icon-with-text-style-01 mb-10 md-mb-35px">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                               
                                <div class="feature-box-content">
                                    <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">Feel free to get in touch?</span>
                                    <div class="w-100 d-block">
                                        <span class="d-block">Phone: <a class="text-dark-gray text-color-change-hover" href="tel:<?php echo PHONE1;?>"><?php echo PHONE1;?></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end features box item -->
                        <!-- start features box item -->
                        <div class="icon-with-text-style-01">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                               
                                <div class="feature-box-content">
                                    <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">How can we help you?</span>
                                    <div class="w-100 d-block">
                                        <span class="d-block">Email: <a href="mailto:<?php echo CONTACT_EMAIL;?>" class="text-dark-gray text-color-change-hover"><?php echo CONTACT_EMAIL;?></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end features box item -->
                    </div> 
                    <div class="col-lg-6 --offset-xl-1 md-mb-50px sm-mb-0" data-anime='{ "el": "childs", "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <h3 class="text-dark-gray ls-minus-2px fw-700">Looking for any help?</h3>
                        <form action="<?php echo base_url();?>contact-us" method="post" id="contactForm" class="contact-form-style-03">
                           
                            <div class="position-relative form-group mb-0">
                                <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span>
                                <input type="text" class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control required" name="full_name" id="full_name" placeholder="Enter name" />
                                <h6 id="full_name_error" class="error-message" style="text-align:left;color:red;"></h6>
                            </div>
                            
                            <div class="position-relative form-group mb-0">
                                <span class="form-icon"><i class="bi bi-envelope text-dark-gray"></i></span>
                                <input type="email" class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control required" name="email" id="email" placeholder="Enter email address" />
                                <h6 id="email_error" class="error-message" style="text-align:left;color:red;"></h6>
                            </div>
                          
                            <div class="position-relative form-group mb-0">
                                <span class="form-icon"><i class="bi bi-phone text-dark-gray"></i></span>
                                <input type="text" class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control required" name="mobile_number" id="mobile_number" minlength="9" maxlength="10" placeholder="Enter phone number" />
                                <h6 id="mobile_number_error" class="error-message" style="text-align:left;color:red;"></h6>
                            </div>
                          
                            <div class="position-relative form-group mb-0">
                                <span class="form-icon"><i class="bi bi-pen  text-dark-gray"></i></span>
                                <input type="subject" class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control required" name="subject" id="subject" placeholder="Enter Subject" />
                                <!-- <div id="subject_error" class="error-message" style="text-align:left;color:red;"></div> -->
                            </div>
                           
                            
                            <div class="position-relative form-group form-textarea mb-0 mt-4"> 
                                <span class="form-icon"><i class="bi bi-chat-square-dots text-dark-gray"></i></span>
                                <textarea class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control" name="message" id="message" placeholder="Message" rows="2"></textarea>
                                <!-- <div id="message_error" class="error-message" style="text-align:left;color:red;"></div> -->
                            </div>
                            <div class="position-relative form-group form-textarea mb-0"> 
                                <div class="row mt-5">
                                    <!-- <label for="captcha">Captcha:</label> -->
                                    <div class="col-lg-4 col-md-3 col-5 mt-1">
                                        <h6 id="mainCaptcha" style="color:#000; display:inline-block;"></h6>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-4 px-0 mt-1">
                                        <button type="button" id="refresh" onclick="Captcha();" class="refresh-btn" style="border:none; background:none;">
                                            <img src="<?php echo base_url();?>assets/frontend/img/sync.png" alt="Sync Alt Icon" class="icon" style="width:20px;height:20px;">
                                        </button>
                                    </div>
                                    <div class="col-lg-7 col-md-8 col-12 mt-1">
                                        <input class="fs-15 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control required" type="text" name="captcha" id="captcha" placeholder="Captcha" />
                                        <h6 id="captcha_error" class="error-message" style="text-align:left;color:red;"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-25px align-items-center">
                                <div class="col-xl-7 col-lg-12 col-sm-7 lg-mb-30px md-mb-0">
                                    <p class="mb-0 fs-14 lh-22 text-center text-sm-start">We will never collect information about you without your explicit consent.</p>
                                </div>
                                <div class="col-xl-5 col-lg-12 col-sm-5 text-center text-sm-end text-lg-start text-xl-end xs-mt-25px">
                                    <input id="exampleInputEmail3" type="hidden" name="redirect" value="">
                                    <button class="btn submit-bg-solitude-blue btn-medium btn-rounded btn-box-shadow submit" type="submit" onclick="submitForm();">Send message</button> 
                                </div>
                                <div class="col-12 mt-20px mb-0 text-center text-md-start">
                                    <div class="form-results d-none"></div>
                                </div>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function () {
                                // Generate the captcha on page load
                                Captcha();

                                // Input validation events
                                $('#full_name').on('input', function () {
                                    validateName($(this).val());
                                });

                                $('#email').on('input', function () {
                                    validateEmail($(this).val());
                                });

                                $('#mobile_number').on('input', function () {
                                    // Replace any non-numeric characters
                                    this.value = this.value.replace(/\D/g, '');
                                    validateMobileNumber($(this).val());
                                });

                                $('#company_name').on('input', function () {
                                    validateCompanyName($(this).val());
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
                                $('#mainCaptcha').text(captcha); // Display the captcha
                            }

                            // Validation functions
                            function validateName(name) {
                                const namePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
                                if (name === '') {
                                    $('#full_name_error').text('Please enter your name.');
                                    $('#full_name').addClass('is-invalid').removeClass('is-valid');
                                } else if (!namePattern.test(name)) {
                                    $('#full_name_error').text('Invalid name format.');
                                    $('#full_name').addClass('is-invalid').removeClass('is-valid');
                                } else {
                                    $('#full_name_error').text('');
                                    $('#full_name').removeClass('is-invalid').addClass('is-valid');
                                }
                            }

                            function validateEmail(email) {
                                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                if (email === '') {
                                    $('#email_error').text('Please enter your email.');
                                    $('#email').addClass('is-invalid').removeClass('is-valid');
                                } else if (!emailPattern.test(email)) {
                                    $('#email_error').text('Please enter a valid email address.');
                                    $('#email').addClass('is-invalid').removeClass('is-valid');
                                } else {
                                    $('#email_error').text('');
                                    $('#email').removeClass('is-invalid').addClass('is-valid');
                                }
                            }

                            function validateMobileNumber(mobile_number) {
                                const mobileNumberPattern = /^[0-9]{10}$/;
                                if (mobile_number === '') {
                                    $('#mobile_number_error').text('Please enter your phone number.');
                                    $('#mobile_number').addClass('is-invalid').removeClass('is-valid');
                                } else if (!mobileNumberPattern.test(mobile_number)) {
                                    $('#mobile_number_error').text('Phone number must be 10 digits.');
                                    $('#mobile_number').addClass('is-invalid').removeClass('is-valid');
                                } else {
                                    $('#mobile_number_error').text('');
                                    $('#mobile_number').removeClass('is-invalid').addClass('is-valid');
                                }
                            }

                            function validateCompanyName(company_name) {
                                const companyNamePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
                                if (company_name === '') {
                                    $('#company_name_error').text('Please enter your company name.');
                                    $('#company_name').addClass('is-invalid').removeClass('is-valid');
                                } else if (!companyNamePattern.test(company_name)) {
                                    $('#company_name_error').text('Invalid company name format.');
                                    $('#company_name').addClass('is-invalid').removeClass('is-valid');
                                } else {
                                    $('#company_name_error').text('');
                                    $('#company_name').removeClass('is-invalid').addClass('is-valid');
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

                            function submitForm() {
                                event.preventDefault();
                                validateName($('#full_name').val());
                                validateEmail($('#email').val());
                                validateMobileNumber($('#mobile_number').val());
                                validateCompanyName($('#company_name').val());
                                validateCaptcha($('#captcha').val());

                                if ($('.is-invalid').length === 0) {
                                    $('#contactForm')[0].submit();
                                }
                            }

                            

                        </script>
                        
                        <style>
                            .error-message{
                                color: red;
                                font-size: 16px
                            }
                        </style>

                        
                    </div>
                </div> 
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-auto text-center text-md-end sm-mb-20px" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <h6 class="text-dark-gray fw-600 mb-0 ls-minus-1px">Connect with social media </h6>
                    </div>
                    <div class="col-2 d-none d-lg-inline-block" data-anime='{ "translateX": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <span class="w-100 h-1px bg-dark-gray opacity-2 d-flex mx-auto"></span>
                    </div>
                    <div class="col-md-auto elements-social social-icon-style-04 text-center text-md-start ps-lg-0" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <ul class="large-icon dark">
                            <li class="m-0"><a class="facebook" href="https://www.facebook.com/aideanex" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
                            <li class="m-0"><a class="twitter" href="https://x.com/aideanex" target="_blank"><i class="fa-brands fa-twitter"></i><span></span></a></li>      
                            <li class="m-0"><a class="instagram" href="https://www.instagram.com/aideanex/" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
                            <li class="m-0"><a class="linkedin" href="https://www.linkedin.com/company/aideanex" target="_blank"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
                        </ul>                  
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="bg-very-light-gray p-0">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-12 p-0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26276697.93668375!2d57.56888905987639!3d12.325963067925585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae71cda50c9be7%3A0x6886bbd2810614bf!2sJesper%20Apps%20Software%20Services%20Pvt.%20Ltd.!5e1!3m2!1sen!2sin!4v1733808683154!5m2!1sen!2sin" width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"></iframe>></iframe>                  </div> 
                </div> 
            </div>
        </section>
        <!-- end section -->