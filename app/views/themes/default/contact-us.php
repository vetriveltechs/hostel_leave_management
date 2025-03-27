<body data-mobile-nav-style="classic">

    <!-- start page title -->
    <section class="cover-background page-title-big-typography ipad-top-space-margin">
        <div class="container">
            <div class="row align-items-center align-items-lg-end justify-content-center extra-very-small-screen g-0">
                <div class="col-xxl-5 col-xl-6 col-lg-7 position-relative page-title-extra-small md-mb-30px md-mt-auto" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h1 class="text-base-color">Get in Touch with JesperApps
                    </h1>
                    <h2 class="alt-font text-dark-gray fw-500 mb-0 ls-minus-1px shadow-none" data-shadow-animation="true" data-animation-delay="700">Have questions? <span class="fw-700 text-highlight d-inline-block">Ready to help!</span></h2>
                </div>
                <div class="col-lg-5 offset-xxl-2 offset-xl-1 border-start border-2 border-color-base-color ps-40px sm-ps-25px md-mb-auto">
                    <span class="d-block w-85 lg-w-100" data-anime='{ "el": "lines", "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Have a question or need expert guidance? We’re here to help! Whether you're looking for business solutions, technology consulting, or strategic insights, our team is ready to assist you. Let’s collaborate and create impactful solutions together!</span>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- start section -->
    <section class="overflow-hidden p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0 position-relative">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/demo-real-estate-contact-01.jpg" alt="" class="w-100">
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="pt-0" id="contact">
        <div class="container">
            <div class="row justify-content-center align-items-center" data-anime='{ "el": "childs", "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="col-lg-6 pt-8 pb-8 text-center text-sm-start" data-anime='{ "el": "childs", "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <span class="fs-15 text-uppercase text-base-color fw-600 mb-15px d-block ls-1px">Get in touch with us</span>
                    <h3 class="fw-700 text-dark-gray ls-minus-1px mb-50px sm-mb-35px"> Connect with us now!</h3>
                    <!-- start features box item -->
                    <div class="icon-with-text-style-01 mb-10 md-mb-35px">
                        <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                            <div class="feature-box-icon me-25px">
                                <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/loctinon.png" class="h-80px" alt="">
                            </div>
                            <div class="feature-box-content last-paragraph-no-margin">
                                <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">Our Locations</span>
                                <p class="w-60 md-w-100 text-dark">Door No. 4/C KM Towers, Second Floor, Vasanth Nagar, Krishnagiri Bypass Road, Hosur - 635109</p>
                            </div>
                        </div>
                    </div>
                    <!-- end features box item -->
                    <!-- start features box item -->
                    <div class="icon-with-text-style-01 mb-10 md-mb-35px">
                        <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                            <div class="feature-box-icon me-25px">
                                <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/phone.png" class="h-80px" alt="">
                            </div>
                            <div class="feature-box-content">
                                <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">Feel free to get in touch?</span>
                                <div class="w-100 d-block text-dark">
                                    <span class="d-block ">Phone: <a href="tel:9900017401" class="text-dark">+91 9900017401 </a></span>
                                    <!-- <span class="d-block">Fax: 1-800-222-002</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end features box item -->
                    <!-- start features box item -->
                    <div class="icon-with-text-style-01">
                        <div class="feature-box feature-box-left-icon last-paragraph-no-margin">
                            <div class="feature-box-icon me-25px">
                                <img src="<?php echo base_url(); ?>assets/frontend/img/jesper/email.png" class="h-80px" alt="">
                            </div>
                            <div class="feature-box-content">
                                <span class="d-block text-dark-gray fw-600 fs-18 ls-minus-05px mb-5px">How can we help you?</span>
                                <div class="w-100 d-block">
                                    <a href="mailto:sales@jesperapps.com" class="text-dark">sales@jesperapps.com  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end features box item -->
                </div>
                <div class="col-lg-6 align-self-start contact-form-style-03 position-relative">
                    <div class="bg-white box-shadow-double-large p-12 lg-p-9 border-radius-10px">
                        <h3 class="fw-700 alt-font text-dark-gray mb-30px sm-mb-20px">How can we help you?</h3>
                        <!-- start contact form -->
                        <form action="<?php echo base_url(); ?>contact-us" method="post" id="contactForm" onsubmit="return submitForm(event);">
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
                                <input class="ps-0 border-radius-0px medium-gray bg-transparent border-color-extra-medium-gray form-control pt-0 pb-0" type="text" name="company_email" id="company_email" placeholder="Email *" />
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
                            <div class="position-relative form-group form-textarea mt-15px mb-0 text-end">
                                <button class="btn btn-medium btn-base-color btn-round-edge mt-35px submit fw-600" type="submit">Send message</button>
                                <div class="form-results mt-20px d-none"></div>
                            </div>
                        </form>
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

                            // function validateMessage(message) {
                            //     if (message.trim() === '') {
                            //         $('#message_error').text('Please enter your message.');
                            //         $('#message').addClass('is-invalid').removeClass('is-valid');
                            //     } else {
                            //         $('#message_error').text('');
                            //         $('#message').removeClass('is-invalid').addClass('is-valid');
                            //     }
                            // }

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
                                // validateMessage($('#message').val());
                                validateCaptcha($('#captcha').val());

                                // Check if any field has errors
                                if ($('.is-invalid').length === 0) {
                                    $('#contactForm')[0].submit(); // Submit form if valid
                                }
                                return false; // Prevent default submission
                            }
                        </script>
                        <!-- end contact form -->
                    </div>
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3891.6722122634133!2d77.82883647426688!3d12.734794070027515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae710036c3a8dd%3A0xd0c052b3bcbcc1dd!2sJESPER%20APPS%20SOFTWARE%20SERVICES!5e0!3m2!1sen!2sin!4v1739429315091!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->


</body>