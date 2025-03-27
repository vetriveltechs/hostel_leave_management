<?php /*
    
    $segment = $this->uri->segment(1);

    if ($segment !== "thankyou" && $segment !== "subscribes")
    {
        ?>
            <section class="bg-very-light-gray position-relative" >
                <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true" data-particle-options='{"particles": {"number": {"value": 45,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#8f76f5", "#a65cef", "#c74ad2", "#e754a4", "#ff6472"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 0.8,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":0.4,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'></div>
                <div class="container">
                    <!-- start subscribe item -->
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-8 col-md-10 text-center">
                            <h4 class="text-dark-gray alt-font fw-700 ls-minus-1px mb-6">Subscribe for the updates!</h4>
                            <div class="d-inline-block w-100 newsletter-style-03 position-relative">
                                <form action="<?php echo base_url(); ?>subscribes" id="subscribForm" method="post" class="position-relative w-100">
                                    <div class="position-relative">
                                        <input class="input-large bg-white border-color-transparent w-100 border-radius-100px box-shadow-extra-large form-control required" name="subscribe_email" id="subscribe_email" placeholder="Enter Your Email *" />
                                        <input type="hidden" name="redirect" value="">
                                        <h6 id="subscribe_email_error" class="error-message text-center"></h6>
                                        <button class="btn btn-extra-large text-dark-gray ls-0px left-icon submit text-uppercase-inherit fw-600" aria-label="submit"><i class="icon feather icon-feather-mail icon-small text-dark-gray"></i><span>Subscribe</span></button>
                                    </div>
                                    <div class="form-results border-radius-100px mt-15px p-15px fs-15 w-100 text-center d-none"></div>
                                </form>
                                <script>
                                    $(document).ready(function() 
                                            {
                                            $('#subscribe_email').on('input', function() {
                                                validateFooterEmail($(this).val());
                                            });

                                            // Handle form submission
                                            $('#subscribForm').on('submit', function(event) {
                                                event.preventDefault(); // Prevent the form from submitting immediately
                                                if (validateFooterForm()) {
                                                    $('.subscribe_submit_button').prop('disabled', true);
                                                    this.submit(); // Submit the form manually if valid
                                                }
                                            });
                                    });

                                    function validateFooterEmail(footer_email) {
                                            const footerEmailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                            if (footer_email === '') {
                                                $('#subscribe_email_error').text('Please enter your email.');
                                                $('#subscribe_email').addClass('is-invalid').removeClass('is-valid');
                                            } else if (!footerEmailPattern.test(footer_email)) {
                                                $('#subscribe_email_error').text('Please enter a valid email address.');
                                                $('#subscribe_email').addClass('is-invalid').removeClass('is-valid');
                                            } else {
                                                $('#subscribe_email_error').text('');
                                                $('#subscribe_email').removeClass('is-invalid').addClass('is-valid');
                                            }
                                    }

                                    function validateFooterForm() {
                                            validateFooterEmail($('#subscribe_email').val());

                                            // Check if there are any invalid fields
                                            if ($('.is-invalid').length === 0) {
                                                return true; // Allow form submission
                                            } else {
                                                return false; // Prevent form submission
                                            }
                                    }

                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- end subscribe item -->
                </div>
            </section>
        <?php
    }
*/ ?>

<footer class="bg-charcoal-blue pb-0 sm-pb-50px" style="background-image: url('<?php echo base_url(); ?>assets/frontend/img/jesper/footer-pattern.svg');">
    <div class="container">
        <div class="row justify-content-center mb-4 sm-mb-35px">
            <!-- start footer column -->
            <div class="col-12 col-lg-4 last-paragraph-no-margin order-sm-1 md-mb-50px xs-mb-30px">
                <a href="<?php echo base_url(); ?>" class="footer-logo d-inline-block mb-20px"><img src="<?php echo base_url(); ?>assets/frontend/img/j-logo.png" data-at2x="<?php echo base_url(); ?>assets/frontend/img/jesper/jesper-logo.png" alt=""></a>
                <p class="text-white">Door No. 4/C KM Towers, Second Floor, Vasanth Nagar, Krishnagiri Bypass Road, Hosur - 635109</p>
                </span>
                <div class="elements-social social-icon-style-09 pt-2 d-none d-md-block">
                    <ul class="small-icon dark mb-20px">
                        <li><a class="facebook" href="https://www.facebook.com/jesperappss" target="_blank"><i class="fa-brands fa-facebook-f text-white"></i><span></span></a></li>
                        <li><a class="instagram" href="https://www.instagram.com/jesperapps/" target="_blank"><i class="fa-brands fa-instagram text-white"></i><span></span></a></li>
                        <li><a class="x-twitter" href="https://x.com/JesperApps" target="_blank"><i class="fa-brands fa-x-twitter text-white"></i><span></span></a></li>
                        <li><a class="linkedin" href="https://www.linkedin.com/in/jesperapps/" target="_blank"><i class="fa-brands fa-linkedin-in text-white"></i><span></span></a></li>
                        <li><a class="youtube" href="https://www.youtube.com/channel/UCnfYKOjduFMYk-xX8Zt8bMg" target="_blank"><i class="fa-brands fa-youtube text-white"></i><span></span></a></li>
                    </ul>
                </div>


            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-6 col-lg-3 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                <span class="alt-font fw-800 text-white d-block mb-5px">Quick Links</span>
                <ul class="fs-16 ">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
                    <li><a href="<?php echo base_url(); ?>success-story/all">Case Studies</a></li>
                    <li><a href="<?php echo base_url(); ?>blog/all">Blogs</a></li>

                </ul>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-6 col-lg-2 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                <span class="alt-font fw-800 text-white d-block mb-5px">Menus</span>
                <ul class="fs-16">
                    <?php /*
                        <li><a href="<?php echo base_url(); ?>events">Events</a></li>
                    */ ?>
                    <li><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                    <?php /*
                        <li><a href="<?php echo base_url(); ?>news">News</a></li>
                        <li><a href="<?php echo base_url(); ?>careers">Careers</a></li>
                    */ ?>
                    <li><a href="<?php echo base_url(); ?>location">Location</a></li>

                </ul>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-12 col-lg-3 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                <span class="alt-font fw-800 text-white d-block mb-5px">Contact Us</span>
                <div class="fs-16 text-brown"><i class="feather icon-feather-phone-call icon-small me-10px xs-me-5px text-white"></i><a href="tel:+91 9900017401" class="text-white">+91 9900017401</a></div>
                <div class="fs-16">
                    <i class="feather icon-feather-mail icon-small me-10px xs-me-5px text-white"></i>
                    <a href="mailto:sales@jesperapps.com" class="text-white">sales@jesperapps.com</a>
                </div>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <!-- <div class="col-lg-2 col-sm-6 ps-30px sm-ps-15px md-mb-50px xs-mb-0 order-sm-2 order-lg-5 text-center text-sm-start">
                <span class="alt-font fw-800 text-dark-gray d-block mb-10px">Follow Us</span>
                <div class="elements-social social-icon-style-09">
                    <ul class="small-icon dark mb-20px">
                        <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
                        <li><a class="instagram" href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
                        <li><a class="twitter" href="https://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i><span></span></a></li>
                    </ul>
                </div>

            </div> -->
            <!-- end footer column -->
        </div>
        <div class="row justify-content-center align-items-center">
            <!-- start divider -->
            <div class="col-12">
                <div class="divider-style-03 divider-style-03-01 --border-color-transparent-dark-very-light"></div>
            </div>
            <!-- end divider -->
            <!-- start copyright -->
            <div class="elements-social social-icon-style-09 pt-2 text-center d-block d-md-none">
                    <ul class="small-icon --dark mb-20px">
                        <li><a class="facebook" href="https://www.facebook.com/jesperappss" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
                        <li><a class="instagram" href="https://www.instagram.com/jesperapps/" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
                        <li><a class="x-twitter" href="https://x.com/JesperApps" target="_blank"><i class="fa-brands fa-x-twitter"></i><span></span></a></li>
                        <li><a class="linkedin" href="https://www.linkedin.com/in/jesperapps/" target="_blank"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
                        <li><a class="youtube" href="https://www.youtube.com/channel/UCnfYKOjduFMYk-xX8Zt8bMg" target="_blank"><i class="fa-brands fa-youtube"></i><span></span></a></li>
                    </ul>
                </div>
            <div class="col-md-4 pt-20px pb-20px sm-pt-0  fs-16 order-2 order-md-1 text-center text-md-start last-paragraph-no-margin">
                <p class="text-white">&copy; 2025<strong> JesperApps</strong> . All rights reserved.</p>
            </div>
            <!-- end copyright -->
            <!-- start footer menu -->
            <div class="col-md-8 pt-20px pb-20px sm-pb-10px fs-16 order-1 order-md-2 text-center text-md-end">
                <ul class="footer-navbar list-unstyled d-flex flex-wrap justify-content-center justify-content-md-end xs-lh-normal">
                    <li class="me-3 me-md-0"><a href="<?php echo base_url(); ?>privacy-policy" class="nav-link text-white">Privacy policy</a></li>
                    <li class="me-3 me-md-0"><a href="<?php echo base_url(); ?>terms-and-conditions" class="nav-link text-white">Terms & Conditions</a></li>
                    <?php /*
                    <li class="me-3 me-md-0"><a href="<?php echo base_url(); ?>refund-policy" class="nav-link text-white">Refund Policy</a></li>
                    <li><a href="<?php echo base_url(); ?>cancellation-policy" class="nav-link text-white">Cancellation Policy</a></li>
                    */ ?>
                </ul>
            </div>

            <!-- end footer menu -->
        </div>
    </div>
</footer>
<style> 
    a {
    color: #fff;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    text-decoration: none;
}
</style>