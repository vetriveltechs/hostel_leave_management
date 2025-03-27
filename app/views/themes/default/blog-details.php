<body data-mobile-nav-style="classic">  
    <!-- start page title -->
    <?php
	    $getBlogDetails	= $this->blogs_model->getBlogDetails($list_code,$blog_url);

        if(count($getBlogDetails)>0)
	    {
		    $blog_banner_url    = "uploads/blogs/banner/".$getBlogDetails[0]['blog_id'].".png";
		    $client_url         = "uploads/blogs/client_image/".$getBlogDetails[0]['blog_id'].".png";

            ?>
                <section class="ipad-top-space-margin bg-dark-gray cover-background one-fifth-screen d-flex align-items-center" style="background-image: url(<?php echo base_url().$blog_banner_url;?>)">
                    <div class="opacity-light bg-dark-gray"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 position-relative" data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [50, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
                                <div class="d-inline-block mb-20px sm-mb-25px">
                                    <span class="text-white fs-18 opacity-5">
                                        <a href="javascript:void(0)" class="text-white"><?php echo isset($getBlogDetails[0]['last_updated_date']) ? date("d F Y", strtotime($getBlogDetails[0]['last_updated_date'])) : "";?></a>
                                        <span class="d-inline-block fs-24 align-top ms-10px me-10px">•</span>
                                        <a href="<?php echo base_url(); ?>blog/<?php echo strtolower($getBlogDetails[0]['list_code']); ?>" class="text-white"><?php echo ucfirst($getBlogDetails[0]['list_value']); ?></a>
                                    </span>
                                </div>
                                <h1 class="text-white fs-55 w-80 lg-w-80 md-w-70 sm-w-100 fw-500 ls-minus-2px text-white alt-font mb-30px overflow-hidden mb-0"><?php echo ucfirst($getBlogDetails[0]['blog_title']); ?></h1>
                                <div class="text-white fs-18 mt-40px">
                                    <img class="w-80px h-80px rounded-circle me-15px" src="<?php echo base_url().$client_url; ?>" alt="No-Image">
                                    <a href="javascript:void(0)" class="text-white text-decoration-line-bottom"><?php echo ucfirst($getBlogDetails[0]['client_name']); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
        }
    ?>
    
    <!-- end page title -->

    <!-- start section -->
    <?php 
        $description = $getBlogDetails[0]['description'];
        if($description!=NULL)
        {
            ?>
                <section class="pb-0"> 
                    <div class="container">
                        <div class="row justify-content-center">
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
                </section> 
            <?php
        }
    ?>
    <!-- end section -->
     
    <!-- start section -->
    <?php 
        $blog_limit		=3;
        $getRelatedBlog = $this->blogs_model->getRelatedBlog($list_code,$blog_url,$blog_limit);
    
        if(count($getRelatedBlog)>0)
        {
            ?>
                <section class="bg-tranquil"> 
                    <div class="container">
                        <div class="row justify-content-center mb-1">
                            <div class="col-lg-7 text-center">
                                <span class="alt-font text-dark-gray fs-19 fw-500 mb-5px d-inline-block ls-minus-05p">You may also like</span>
                                <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px">Related posts</h2>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-12 px-0 xs-ps-15px xs-pe-15px">
                                <ul class="blog-masonry blog-wrapper grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-1col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                    <li class="grid-sizer"></li>
                                    <!-- start blog item -->
                                    <?php 
                                        foreach ($getRelatedBlog as $relatedBlog) 
                                        {
								            $related_blog_url   = "uploads/blogs/".$relatedBlog['blog_id'].".png";
								            $related_client_url = "uploads/blogs/client_image/".$relatedBlog['blog_id'].".png";

                                            ?>
                                                <li class="grid-item">
                                                    <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                                        <div class="card-top d-flex align-items-center">
                                                            <a href="javascript:void(0)">
                                                                <img src="<?php echo base_url().$related_client_url;?>" class="avtar" alt="">
                                                            </a>
                                                            <span class="fs-16">By 
                                                                <a href="javascript:void(0)" class="text-dark-gray fw-600">
                                                                    <?php echo ucfirst($relatedBlog['client_name']);?>
                                                                </a>
                                                            </span>
                                                        </div>
                                                        <div class="blog-image position-relative overflow-hidden">
                                                            <a href="<?php echo base_url() . 'blog-details.html/' . strtolower($relatedBlog['list_code']) .'/'.$relatedBlog['blog_url']; ?>">
                                                                <img src="<?php echo base_url().$related_blog_url;?>" alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <div class="post-content p-11 md-p-9">
                                                                <a href="<?php echo base_url() . 'blog-details.html/' . strtolower($relatedBlog['list_code']) .'/'.$relatedBlog['blog_url']; ?>" 
                                                                class="card-title related-blog-title mb-10px fw-600 fs-19 lh-28 text-dark-gray d-inline-block">
                                                                    <?php echo ucfirst($relatedBlog['blog_title']);?>
                                                                </a>
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
    <style>
        .related-blog-title {
            min-height: 80px; 
            max-height: 80px; 
            white-space: nowrap; 
            overflow: hidden; 
            text-overflow: ellipsis; 
            width: 100%; 
            display: block;
        }

    </style>
    
    <!-- end section -->
    <!-- start section -->
    <?php /*
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 text-center mb-2"> 
                    <h5 class="alt-font text-dark-gray fw-600 ls-minus-05px">4 Comments</h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <ul class="blog-comment">
                        <li>
                            <div class="d-block d-md-flex w-100 align-items-center align-items-md-start ">
                                <div class="w-90px sm-w-65px sm-mb-10px">
                                    <img src="<?php echo base_url(); ?>assets/frontend/img/avtar-05.jpg" class="rounded-circle" alt="">
                                </div>
                                <div class="w-100 ps-30px last-paragraph-no-margin sm-ps-0">
                                    <a href="#" class="text-dark-gray fw-600">Herman Miller</a>
                                    <a href="#comments" class="btn-reply text-uppercase section-link">Reply</a>
                                    <div class="fs-14 lh-24 mb-10px">17 July 2020, 6:05 PM</div>
                                    <p class="w-85 sm-w-100">Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the make book.</p>
                                </div>
                            </div>
                            <ul class="child-comment">
                                <li>
                                    <div class="d-block d-md-flex w-100 align-items-center align-items-md-start ">
                                        <div class="w-90px sm-w-65px sm-mb-10px">
                                            <img src="<?php echo base_url(); ?>assets/frontend/img/avtar-05.jpg" class="rounded-circle" alt="">
                                        </div>
                                        <div class="w-100 ps-30px last-paragraph-no-margin sm-ps-0">
                                            <a href="#" class="text-dark-gray fw-600">Wilbur Haddock</a>
                                            <a href="#comments" class="btn-reply text-uppercase section-link">Reply</a>
                                            <div class="fs-14 lh-24 mb-10px">18 July 2020, 10:19 PM</div>
                                            <p class="w-85 sm-w-100">Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-block d-md-flex w-100 align-items-center align-items-md-start border-radius-5px p-50px md-p-30px sm-p-20px bg-very-light-gray">
                                        <div class="w-90px sm-w-65px sm-mb-10px">
                                            <img src="<?php echo base_url(); ?>assets/frontend/img/avtar-05.jpg" class="rounded-circle" alt="">
                                        </div>
                                        <div class="w-100 ps-30px last-paragraph-no-margin sm-ps-0">
                                            <a href="#" class="text-dark-gray fw-600">Colene Landin</a>
                                            <a href="#comments" class="btn-reply text-uppercase section-link">Reply</a>
                                            <div class="fs-14 lh-24 mb-10px">18 July 2020, 12:39 PM</div>
                                            <p class="w-85 sm-w-100">Lorem ipsum is simply dummy text of the printing and typesetting industry. Ipsum has been the industry's standard dummy text.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="d-block d-md-flex w-100 align-items-center align-items-md-start ">
                                <div class="w-90px sm-w-65px sm-mb-10px">
                                    <img src="<?php echo base_url(); ?>assets/frontend/img/avtar-05.jpg" class="rounded-circle" alt="">
                                </div>
                                <div class="w-100 ps-30px last-paragraph-no-margin sm-ps-0">
                                    <a href="#" class="text-dark-gray fw-600">Jennifer Freeman</a>
                                    <a href="#comments" class="btn-reply text-uppercase section-link">Reply</a>
                                    <div class="fs-14 lh-24 mb-10px">19 July 2020, 8:25 PM</div>
                                    <p class="w-85 sm-w-100">Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the make a type specimen book.</p>
                                </div>
                            </div>
                        </li>
                    </ul> 
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    
        <section id="comments" class="pt-0 overflow-hidden position-relative overlap-height">
            <div class="container overlap-gap-section">
                <div class="row justify-content-center">
                    <div class="col-lg-9 mb-3">
                        <h6 class="alt-font text-dark-gray fw-600 ls-minus-05p mb-5px">Write a comment</h6>
                        <div class="mb-5px">Your email address will not be published. Required fields are marked *</div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <form action="email-templates/contact-form.php" method="post" class="row contact-form-style-02">
                            <div class="col-md-6 mb-30px">
                                <input class="input-name border-radius-4px form-control required" type="text" name="name" placeholder="Enter your name*">
                            </div> 
                            <div class="col-md-6 mb-30px">
                                <input class="border-radius-4px form-control required" type="email" name="email" placeholder="Enter your email address*">
                            </div> 
                            <div class="col-md-12 mb-30px">
                                <textarea class="border-radius-4px form-control" cols="40" rows="4" name="comment" placeholder="Your message"></textarea>
                            </div> 
                            <div class="col-12">
                                <input type="hidden" name="redirect" value="">
                                <button class="btn btn-dark-gray btn-small btn-round-edge submit" type="submit">Post Comment</button>
                                <div class="form-results mt-20px d-none"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    */ ?>
    <!-- end section -->

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
  
</body>