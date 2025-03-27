<body data-mobile-nav-style="classic"> 
 <!-- start page title -->

 <?php
    $getJobDetail = $this->jobs_model->getJobDetails($job_id,$job_category_id);

    if(count($getJobDetail)>0)
    {
        ?>
            <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(images/demo-elearning-about-title-bg.jpg)">
                        <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
                        <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true" data-particle-options='{"particles": {"number": {"value": 8,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'></div>
                        <div class="container">
                            <div class="row align-items-center extra-small-screen">
                                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                    <h1 class="mb-20px alt-font text-yellow">Job Detail</h1>
                                    <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font"><?php echo $getJobDetail[0]['job_name']?></h2>
                                </div>
                            </div>
                            
                        </div>
                    </section>
                    <!-- end page title -->
                    <!-- start section -->
                
                    <!-- end section -->
                    <!-- start section -->
                    <section class="position-relative">
                        <div class="container">
                            <div class="row justify-content-center" data-anime='{ "el": "childs", "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div class="col-lg-8 md-mb-50px">
                                    <!-- start details  -->
                                    <div class="col-12">
                                        <img src="<?php echo base_url();?>assets/frontend/img/demo-elearning-courses-details-01.png" alt="" class="w-100 border-radius-6px mb-7">
                                        <!-- <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> -->
                                       
                                        <!-- <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.</p> -->
                                        <div class="row align-items-center justify-content-center">
                                                        <div class="col-12 last-paragraph-no-margin">
                                                            <span class="fs-18 text-dark-gray fw-600 ls-minus-05px d-inline-block mb-5px">Job Description</span>
                                                            <p><?php echo $getJobDetail[0]['job_description']?></p>
                                                            <div class="mt-20px mb-30px md-mt-10px d-inline-block w-100">
                                                                <span class="fs-18 text-dark-gray fw-600 ls-minus-05px d-inline-block mb-10px">Responsibilities</span>
                                                                <?php echo $getJobDetail[0]['roles_and_response']?>
                                                            </div>
                                                            <span class="fs-18 text-dark-gray fw-600 ls-minus-05px d-inline-block mb-5px">Qualifications</span>
                                                            <p><?php echo $getJobDetail[0]['qualification_name']?></p>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="row align-items-center justify-content-center pt-4">
                                                        <div class="col-xl-12">
                                                            <div class="row border-bottom border-2 border-color-dark-gray pb-15px mb-25px sm-pb-35px sm-mb-35px align-items-center">
                                                            <div class="col-md-3 text-center text-md-end md-mb-15px">
                                                                    <div class="fs-16 fw-600 text-dark-gray text-start">Role</div>
                                                                </div>
                                                                <div class="col-md-8 offset-lg-1 icon-with-text-style-01 md-mb-25px">
                                                                    <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                                                                        
                                                                        <div class="feature-box-content">
                                                                            <p class="w-90 md-w-100">
                                                                            <?php echo $getJobDetail[0]['role_name']?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row border-bottom border-2 border-color-dark-gray pb-15px mb-25px sm-pb-35px sm-mb-35px align-items-center">
                                                                <div class="col-md-3 text-center text-md-end md-mb-15px">
                                                                    <div class="fs-16 fw-600 text-dark-gray text-start">Industry Type</div>
                                                                </div>
                                                                <div class="col-md-8 offset-lg-1 icon-with-text-style-01 md-mb-25px">
                                                                    <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                                                                        
                                                                        <div class="feature-box-content">
                                                                            <p class="w-90 md-w-100"><?php echo $getJobDetail[0]['industry_type']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                            </div>
                                                            <div class="row border-bottom border-2 border-color-dark-gray pb-15px mb-25px sm-pb-35px sm-mb-35px align-items-center">
                                                                <div class="col-md-3 text-center text-md-end md-mb-15px">
                                                                    <div class="fs-16 fw-600 text-dark-gray text-start">Functional Area</div>
                                                                </div>
                                                                <div class="col-md-8 offset-lg-1 icon-with-text-style-01 md-mb-25px">
                                                                    <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                                                                        
                                                                        <div class="feature-box-content">
                                                                            <p class="w-90 md-w-100"><?php echo $getJobDetail[0]['functional_area']?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                            </div>
                                                            <div class="row align-items-center justify-content-center">
                                                               <div class="col-12">
                                                                     <div class="mt-20px mb-30px md-mt-10px d-inline-block w-100">
                                                                        <span class="fs-18 text-dark-gray fw-600 ls-minus-05px d-inline-block mb-10px">The following are the skillset for digital marketing : </span>
                                                                        <?php echo $getJobDetail[0]['key_skills']?>
                                                                        
                                                                    </div>
                                                                 </div>
                                                            </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-12">
                                                            <div class="p-7 lg-p-5 sm-p-7 bg-very-light-gray border-radius-6px">
                                                                <div class="row justify-content-center mb-40px sm-mb-25px">
                                                                    <div class="col-md-9 text-center">
                                                                        <h3 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Apply Now</h3>
                                                                    </div>
                                                                </div>
                                                                <form action="<?php echo base_url();?>job-details.html/<?php echo $job_id; ?>/<?php echo $job_category_id; ?>" id="jobDetailsForm" method="post" enctype="multipart/form-data" class="row contact-form-style-02">    
                                                                    <div class="col-md-6 mb-30px">
                                                                        <input class="input-name border-radius-4px border-color-white box-shadow-double-large form-control" type="text" name="full_name" id="full_name" placeholder="Full Name *" />
                                                                        <h6 id="full_name_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="email" name="email" id="email" placeholder="Email *" />
                                                                        <h6 id="email_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="text" name="mobile_number" id="mobile_number" minlength="9" maxlength="10" placeholder="Phone No *" oninput="validateNumber(this)"/>
                                                                        <h6 id="mobile_number_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="text" name="experience" id="experience" placeholder="Experience *" />
                                                                        <h6 id="experience_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="text" name="location" id="location" placeholder="Location *" />
                                                                        <h6 id="location_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="text" name="current_company" id="current_company" placeholder="Current Company *" />
                                                                        <h6 id="current_company_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="text" name="expected_salary" id="expected_salary" placeholder="Expected Salary *" oninput="validateNumber(this)"/>
                                                                        <h6 id="expected_salary_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <div class="select">
                                                                            <select class="form-control border-radius-4px border-color-white box-shadow-double-large" name="notice_period" id="notice_period" aria-label="select-doctor">
                                                                                <option value="">Select Notice Period *</option>
                                                                                <?php 
                                                                                    $getNoticePeriod = $this->common_model->lov('NOTICE-PERIOD');
                                                                                    foreach($getNoticePeriod as $noticePeriod) {
                                                                                        ?>
                                                                                        <option value="<?php echo $noticePeriod['list_code']; ?>"><?php echo $noticePeriod['list_value']; ?></option>
                                                                                        <?php 
                                                                                    } 
                                                                                ?>
                                                                            </select>
                                                                            <h6 id="notice_period_error" class="error-message"></h6>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <label>Upload Resume *</label>
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="file" name="resume" id="resume" accept=".pdf, .doc, .docx" placeholder="Upload Resume *" />
                                                                        <h6 id="resume_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-6 mb-30px">
                                                                        <label>Upload Photo *</label>
                                                                        <input class="border-radius-4px border-color-white box-shadow-double-large form-control" type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png" placeholder="Upload Photo *" />
                                                                        <h6 id="photo_error" class="error-message"></h6>
                                                                    </div>

                                                                    <div class="col-md-12 mb-3">
                                                                        <textarea class="border-radius-4px border-color-white box-shadow-double-large form-control" cols="40" rows="4" name="message" id="message" placeholder="Your message"></textarea>
                                                                    </div>
                                                                    <div class="col-md-12 mb-30px captcha-section mt-0" style="padding: 10px;background-color: #f0f8ff;margin: 10px 0;border-radius: 5px;">
                                                                        <div class="row">
                                                                            <label for="captcha">Captcha *:</label>
                                                                            <div class="col-lg-3 col-md-3 col-5 mt-1">
                                                                                <h6 id="mainCaptcha" style="color:#000; display:inline-block;"></h6>
                                                                            </div>
                                                                            <div class="col-lg-1 col-md-1 col-4 px-0 mt-1">
                                                                                <button type="button" id="refresh" onclick="Captcha();" class="refresh-btn" style="border:none; background:none;">
                                                                                    <img src="<?php echo base_url();?>assets/frontend/img/sync.png" alt="Sync Alt Icon" class="icon" style="width:20px;height:20px;">
                                                                                </button>
                                                                            </div>
                                                                            <div class="col-lg-8 col-md-8 col-12 mt-1">
                                                                                <input class="form-control required" type="text" name="captcha" id="captcha" placeholder="Captcha" />
                                                                                <h6 id="captcha_error" class="error-message"></h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-6 col-md-7">
                                                                        <p class="mb-0 fs-14 lh-26 text-center text-md-start w-90 md-w-100">We are committed to protecting your privacy. We will never collect information about you without your explicit consent.</p>
                                                                    </div>

                                                                    <div class="col-xl-6 col-md-5 text-center text-md-end sm-mt-20px">
                                                                        <input type="hidden" name="redirect" value="">
                                                                        <button class="btn btn-gradient-fast-blue-purple btn-switch-text btn-large left-icon btn-round-edge submit text-transform-none" type="submit">
                                                                            <span>
                                                                                <span><i class="bi bi-calendar-check"></i></span>
                                                                                <span class="btn-double-text" data-text="Apply Now">Apply Now</span> 
                                                                            </span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-results mt-20px d-none"></div>
                                                                    </div>
                                                                </form>


                                                                <script>
                                                                   
                                                                    $(document).ready(function () {
                                                                        Captcha(); // Generate initial captcha

                                                                        // Input validation events
                                                                        $('#full_name').on('input', function () {
                                                                            validateName($(this).val());
                                                                        });

                                                                        $('#email').on('input', function () {
                                                                            validateEmail($(this).val());
                                                                        });

                                                                        $('#mobile_number').on('input', function () {
                                                                            // Only allow numeric values
                                                                            this.value = this.value.replace(/\D/g, '');
                                                                            validatePhoneNumber($(this).val());
                                                                        });

                                                                        $('#experience').on('input', function () {
                                                                            validateExperience($(this).val());
                                                                        });

                                                                        $('#location').on('input', function () {
                                                                            validateLocation($(this).val());
                                                                        });

                                                                        $('#current_company').on('input', function () {
                                                                            validateCompanyName($(this).val());
                                                                        });

                                                                        $('#expected_salary').on('input', function () {
                                                                            validateSalary($(this).val());
                                                                        });

                                                                        $('#notice_period').on('change', function () {
                                                                            validateNoticePeriod($(this).val());
                                                                        });

                                                                        $('#resume').on('change', function () {
                                                                            validateResume($(this));
                                                                        });

                                                                        $('#photo').on('change', function () {
                                                                            validatePhoto($(this));
                                                                        });

                                                                        $('#captcha').on('input', function () {
                                                                            validateCaptcha($(this).val());
                                                                        });

                                                                        $('#refresh').click(function () {
                                                                            Captcha(); // Regenerate Captcha
                                                                        });

                                                                        // Submit form
                                                                        $('#jobDetailsForm').on('submit', function (e) {
                                                                            e.preventDefault();
                                                                            if (validateAllInputs()) {
                                                                                
                                                                                this.submit(); // Submit the form
                                                                            }
                                                                        });
                                                                    });

                                                                    function Captcha() {
                                                                        var alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                                                                        var captcha = '';
                                                                        for (var i = 0; i < 6; i++) {
                                                                            captcha += alpha.charAt(Math.floor(Math.random() * alpha.length));
                                                                        }
                                                                        $('#mainCaptcha').text(captcha); // Display Captcha
                                                                    }

                                                                    // Validation functions
                                                                    function validateName(name) {
                                                                        const namePattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
                                                                        if (name === '') {
                                                                            $('#full_name_error').text('Please enter your full name.');
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

                                                                    function validatePhoneNumber(phone) {
                                                                        const phonePattern = /^[0-9]{10}$/;
                                                                        if (phone === '') {
                                                                            $('#mobile_number_error').text('Please enter your mobile number.');
                                                                            $('#mobile_number').addClass('is-invalid').removeClass('is-valid');
                                                                        } else if (!phonePattern.test(phone)) {
                                                                            $('#mobile_number_error').text('Mobile number must be 10 digits.');
                                                                            $('#mobile_number').addClass('is-invalid').removeClass('is-valid');
                                                                        } else {
                                                                            $('#mobile_number_error').text('');
                                                                            $('#mobile_number').removeClass('is-invalid').addClass('is-valid');
                                                                        }
                                                                    }

                                                                    function validateExperience(experience) {
                                                                        if (experience === '') {
                                                                            $('#experience_error').text('Please enter your experience.');
                                                                            $('#experience').addClass('is-invalid').removeClass('is-valid');
                                                                        } else {
                                                                            $('#experience_error').text('');
                                                                            $('#experience').removeClass('is-invalid').addClass('is-valid');
                                                                        }
                                                                    }

                                                                    function validateLocation(location) {
                                                                        const locationPattern = /^[a-zA-Z]+(\s[a-zA-Z]+)*$/;
                                                                        if (location === '') {
                                                                            $('#location_error').text('Please enter your location.');
                                                                            $('#location').addClass('is-invalid').removeClass('is-valid');
                                                                        } else if (!locationPattern.test(location)) {
                                                                            $('#location_error').text('Invalid location format.');
                                                                            $('#location').addClass('is-invalid').removeClass('is-valid');
                                                                        } else {
                                                                            $('#location_error').text('');
                                                                            $('#location').removeClass('is-invalid').addClass('is-valid');
                                                                        }
                                                                    }

                                                                    function validateCompanyName(company) {
                                                                        if (company === '') {
                                                                            $('#current_company_error').text('Please enter your current company.');
                                                                            $('#current_company').addClass('is-invalid').removeClass('is-valid');
                                                                        } else {
                                                                            $('#current_company_error').text('');
                                                                            $('#current_company').removeClass('is-invalid').addClass('is-valid');
                                                                        }
                                                                    }

                                                                    function validateSalary(salary) {
                                                                        const salaryPattern = /^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*$/;;
                                                                        if (salary === '') {
                                                                            $('#expected_salary_error').text('Please enter your expected salary.');
                                                                            $('#expected_salary').addClass('is-invalid').removeClass('is-valid');
                                                                        } else if (!salaryPattern.test(salary)) {
                                                                            $('#expected_salary_error').text('Salary must be a number.');
                                                                            $('#expected_salary').addClass('is-invalid').removeClass('is-valid');
                                                                        } else {
                                                                            $('#expected_salary_error').text('');
                                                                            $('#expected_salary').removeClass('is-invalid').addClass('is-valid');
                                                                        }
                                                                    }

                                                                    function validateNoticePeriod(notice) {
                                                                        if (notice === '') {
                                                                            $('#notice_period_error').text('Please select your notice period.');
                                                                            $('#notice_period').addClass('is-invalid').removeClass('is-valid');
                                                                        } else {
                                                                            $('#notice_period_error').text('');
                                                                            $('#notice_period').removeClass('is-invalid').addClass('is-valid');
                                                                        }
                                                                    }

                                                                    function validateResume(resumeInput) {
                                                                        const file = resumeInput[0].files[0];
                                                                        const fileTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                                                                        const errorMessage = $('#resume_error');

                                                                        // Clear any previous messages
                                                                        errorMessage.text('');
                                                                        resumeInput.removeClass('is-invalid is-valid');

                                                                        if (file) {
                                                                            if (file.size > 2000000) {
                                                                                errorMessage.text('Resume must be less than 2MB.');
                                                                                resumeInput.addClass('is-invalid').removeClass('is-valid');
                                                                                resumeInput.val(''); // Clear file input
                                                                            } else if (!fileTypes.includes(file.type)) {
                                                                                errorMessage.text('Invalid file type. Only PDF and Word documents are allowed.');
                                                                                resumeInput.addClass('is-invalid').removeClass('is-valid');
                                                                                resumeInput.val(''); // Clear file input
                                                                            } else {
                                                                                resumeInput.removeClass('is-invalid').addClass('is-valid');
                                                                            }
                                                                        } else {
                                                                            errorMessage.text('Please upload your resume.');
                                                                            resumeInput.addClass('is-invalid').removeClass('is-valid');
                                                                        }
                                                                    }


                                                                    function validatePhoto(photoInput) {
                                                                        const file = photoInput[0].files[0];
                                                                        const errorMessage = $('#photo_error');

                                                                        // Clear any previous messages
                                                                        errorMessage.text('');
                                                                        photoInput.removeClass('is-invalid is-valid');

                                                                        if (file) {
                                                                            const fileTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                                                            
                                                                            if (file.size > 2000000) { // Check file size
                                                                                errorMessage.text('Photo must be less than 2MB.');
                                                                                photoInput.addClass('is-invalid').removeClass('is-valid');
                                                                                photoInput.val(''); // Clear file input
                                                                            } else if (!fileTypes.includes(file.type)) { // Check file type
                                                                                errorMessage.text('Invalid file type. Only JPG, PNG, and GIF images are allowed.');
                                                                                photoInput.addClass('is-invalid').removeClass('is-valid');
                                                                                photoInput.val(''); // Clear file input
                                                                            } else { // Valid file
                                                                                photoInput.removeClass('is-invalid').addClass('is-valid');
                                                                            }
                                                                        } else {
                                                                            errorMessage.text('Please upload your photo.');
                                                                            photoInput.addClass('is-invalid').removeClass('is-valid');
                                                                        }
                                                                    }


                                                                    function validateCaptcha(userInput) {
                                                                        const captchaText = $('#mainCaptcha').text();
                                                                        if (userInput === '') {
                                                                            $('#captcha_error').text('Please enter the captcha.');
                                                                            $('#captcha').addClass('is-invalid').removeClass('is-valid');
                                                                        }
                                                                        else if (userInput !== captchaText) {
                                                                            $('#captcha_error').text('Incorrect captcha. Please try again.');
                                                                            $('#captcha').addClass('is-invalid').removeClass('is-valid');
                                                                        } else {
                                                                            $('#captcha_error').text('');
                                                                            $('#captcha').removeClass('is-invalid').addClass('is-valid');
                                                                        }
                                                                    }

                                                                    function validateAllInputs() {
                                                                        // Validate all inputs
                                                                        validateName($('#full_name').val());
                                                                        validateEmail($('#email').val());
                                                                        validatePhoneNumber($('#mobile_number').val());
                                                                        validateExperience($('#experience').val());
                                                                        validateLocation($('#location').val());
                                                                        validateCompanyName($('#current_company').val());
                                                                        validateSalary($('#expected_salary').val());
                                                                        validateNoticePeriod($('#notice_period').val());
                                                                        validateResume($('#resume'));
                                                                        validatePhoto($('#photo'));
                                                                        validateCaptcha($('#captcha').val());

                                                                        // Check if there are any validation errors
                                                                        return $('.is-invalid').length === 0;
                                                                    }
                                                                </script>
                                                                <style>
                                                                    .error-message{
                                                                        color: red;
                                                                        font-size: 16px;
                                                                        text-align: left;
                                                                    }
                                                                </style>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        </div>
                                                    </div>      
                                    
                                    </div>
                                    <!-- end details -->
                                </div>
                                <!-- start sidebar -->
                                <aside class="col-lg-4 ps-60px lg-ps-30px md-ps-15px d-none d-lg-block">
                                    <div class="position-sticky top-150px lg-position-relative lg-top-0px">
                                        <div class="border-radius-6px overflow-hidden bg-tranquil">
                                        
                                            <div class="p-35px lg-p-25px">
                                                <ul class="p-0 mb-20px list-style-02">
                                                    <li class="border-bottom border-color-extra-medium-gray pb-15px">
                                                        <span class="text-dark-gray">
                                                            <span class="fw-600">Role</span>
                                                        </span>
                                                        <span class="ms-auto">
                                                        <?php echo $getJobDetail[0]['role_name']?></span>
                                                    </li>
                                                    <li class="border-bottom border-color-extra-medium-gray pt-15px pb-15px">
                                                        <span class="text-dark-gray">
                                                            <span class="fw-600">Experience</span>
                                                        </span>
                                                        <span class="ms-auto"><?php echo $getJobDetail[0]['experience']?></span>
                                                    </li>
                                                
                                                    <li class="border-bottom border-color-extra-medium-gray pt-15px pb-15px">
                                                        <span class="text-dark-gray">
                                                            <span class="fw-600">Employment Type</span>
                                                        </span>
                                                        <span class="ms-auto">
                                                        <?php echo $getJobDetail[0]['employment_type']?></span>
                                                    </li>
                                                    
                                                </ul>
                                            <!-- #region 
                                                
                                                
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            -->
                                                
            
                                                <?php /*
                                                <div class="elements-social social-icon-style-02 mt-20px">
                                                    <ul class="small-icon dark text-center">
                                                        <li class="sm-mb-0"><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                                        <li class="sm-mb-0"><a class="dribbble" href="http://www.dribbble.com" target="_blank"><i class="fa-brands fa-dribbble"></i></a></li>
                                                        <li class="sm-mb-0"><a class="twitter" href="https://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                                                        <li class="sm-mb-0"><a class="instagram" href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a></li> 
                                                    </ul>
                                                </div>
                                                */ ?>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                                <!-- end sidebar -->
                            </div>
                        </div>
                    </section>
                    <!-- end section -->
                    <!-- start section -->
                
                    <!-- end section -->
                
                    <!-- start scroll progress -->
                    <div class="scroll-progress d-none d-xxl-block">

                        <a href="#" class="scroll-top" aria-label="scroll">
                            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
                        </a>


                    </div>
            <!-- end scroll progress -->
            <?php
    }
    ?>
        
    </body>