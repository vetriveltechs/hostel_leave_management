
   
<body data-mobile-nav-style="classic" class="custom-cursor">
    <?php 
        $getBlogCategory 	= $this->categories_model->getBlogCategory();

        if(count($getBlogCategory)>0)
        {
            ?>
            <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(<?php echo base_url(); ?>assets/frontend/img/jesper/blog-banner.png)">
               <div class="container">
                    <div class="row align-items-center extra-small-screen">
                        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <h1 class="mb-20px alt-font text-yellow">Explore stories, tips, and ideas crafted to inspire and inform you.
            
                            </h1>
                            <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Insights, Stories, and Ideas that Inspire
                            </h2>
                        </div>
                    </div>
                </div>
            </section>
              
                <!-- start section -->  
                <section id="blog-records">
                    <div class="--container p-2">
                        <div class="row">
                            <!-- First column: Display on desktop, hide on mobile -->
                            <!-- Second column: Display on mobile, hide on desktop -->
                            <?php /*
                            $getBlogCategory 	= $this->categories_model->getBlogCategory();
                            if(count($getBlogCategory)>0)
                            {
                                ?>
                                    <div class="col-lg-3 --pe-5 order-2 order-lg-1 lg-pe-3 md-pe-15px d-block d-lg-none" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                        <div class="dropdown-container mb-4">
                                            <select class="form-select addedmob btn-secondary select-style d-block mx-auto" id="solutionDropdown" onchange="window.location.href=this.value">
                                                <!-- Default Option for "All" -->
                                                <option value="<?php echo base_url(); ?>blog/all" <?php echo ($list_code == 'ALL') ? 'selected' : ''; ?>>All</option>
                                                <?php 
                                                    foreach ($getBlogCategory as $blogCategory) 
                                                    {
                                                        $category_value_id = $blogCategory['list_code'];
                                                        $is_selected = ($list_code == $category_value_id) ? 'selected' : '';
                                                        ?>
                                                            <option value="<?php echo base_url(); ?>blog/<?php echo strtolower($blogCategory['list_code']); ?>" <?php echo $is_selected; ?>> <?php echo ucfirst($blogCategory['list_value']); ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }
                            */ ?>

                            <!-- First column: Display on desktop, hide on mobile -->
                            <div class="col-lg-3 --pe-5 order-2 order-lg-1 lg-pe-3 md-pe-15px d-none" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                <div class="mb-15 md-mb-50px xs-mb-35px d-none d-md-block">
                                    <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">Blog category</div>
                                        <ul class="category-list-sidebar position-relative">
                                            <li class="d-flex align-items-center h-80px cover-background ps-35px pe-35px" style="background-image: url('(<?php echo base_url(); ?>assets/frontend/img/jesper/demo-magazine-home-23.jpg">
                                                <div class="opacity-medium bg-gradient-dark-transparent"></div>
                                                <a href="<?php echo base_url(); ?>blog/all" class="d-flex align-items-center position-relative w-100 h-100">
                                                    <span class="--text-white mb-0 fs-20 fw-500 fancy-text-style-4 <?php echo ($list_code === '' || $list_code === 'ALL') ? 'blog_active_back_ground_color' : 'blog_back_ground_color'; ?>">All</span>
                                                    <span class="btn text-white position-absolute"><i class="bi bi-arrow-right ms-0 fs-24"></i></span>
                                                </a>
                                            </li>
                                            <?php 
                                                foreach ($getBlogCategory as $blogCategory) 
                                                { 
                                                    $isActive = ($list_code == $blogCategory['list_code']) ? 'blog_active_back_ground_color' : 'blog_back_ground_color';
                                                    ?>
                                                        <li class="d-flex align-items-center h-80px cover-background ps-35px pe-35px" style="background-image: url('<?php echo base_url();?>uploads/industries/<?php echo $blogCategory['industries_id'];?>.png')">
                                                            <div class="opacity-medium bg-gradient-dark-transparent"></div>
                                                            <a href="<?php echo base_url(); ?>blog/<?php echo strtolower($blogCategory['list_code']); ?>" class="d-flex align-items-center position-relative w-100 h-100">
                                                                <span class="--text-white mb-0 fs-20 fw-500 fancy-text-style-4 <?php echo $isActive; ?>"><?php echo ucfirst($blogCategory['list_value']); ?></span>
                                                                <span class="btn text-white position-absolute"><i class="bi bi-arrow-right ms-0 fs-24"></i></span>
                                                            </a>
                                                        </li>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </ul>
                                    </div>
                        

                                    <?php 
                                        $blog_limit     = 3;
                                        $getBestBlogs   = $this->blogs_model->getBestBlogs($blog_limit);
                                        
                                        if(count($getBestBlogs)>0)
                                        {
                                            ?>
                                                <div class="mb-15 md-mb-50px xs-mb-35px d-none d-md-block">
                                                    <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">Popular Blogs</div>
                                                    <ul class="popular-post-sidebar position-relative">
                                                        <?php 
                                                            foreach ($getBestBlogs as $bestBlogs) 
                                                            {
                                                                $best_blog_url = "uploads/blogs/".$bestBlogs['blog_id'].".png";

                                                               ?>
                                                                    <li class="d-flex align-items-center">
                                                                        <figure>
                                                                            <a href="<?php echo base_url() . 'blog-details/' . strtolower($bestBlogs['list_code']) .'/'.$bestBlogs['blog_url']; ?>"><img src="<?php echo base_url().$best_blog_url;?>" alt="" width="auto"></a>
                                                                        </figure>
                                                                        <div class="col media-body">
                                                                            <a href="<?php echo base_url() . 'blog-details/' . strtolower($bestBlogs['list_code']) .'/'.$bestBlogs['blog_url']; ?>" class="fw-600 fs-17 text-dark-gray d-inline-block mb-10px"><?php echo $bestBlogs['blog_title'] ;?></a>
                                                                            <div><a href="javascript:void(0)" class="d-inline-block fs-15"><?php echo isset($bestBlogs['last_updated_date']) ? date("d F Y", strtotime($bestBlogs['last_updated_date'])) : ""; ?></a></div>
                                                                        </div>
                                                                    </li>
                                                               <?php
                                                            }
                                                        ?>
                                                        
                                                        
                                                    </ul>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                    
                                

                                </div>

                                <?php    
                                    if(count($resultData)>0)
                                    {
                                        ?>
                                            <div class="col-lg-12 order-2 order-lg-2 md-mb-50px"  data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                        
                                            
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 filter-content">
                                                            <ul class="portfolio-simple portfolio-wrapper grid-loading grid grid-4col xxl-grid-4col xl-grid-4col lg-grid-4col md-grid-2col sm-grid-2col xs-grid-1col gutter-large text-center">
                                                                <li class="grid-sizer"></li>
                                                                <!-- start portfolio item -->
                                                                <?php 
                                                                    foreach ($resultData as $blogsAll) 
                                                                    {
                                                                        $blog_url	='uploads/blogs/'.$blogsAll['blog_id'].'.png'
                                                                        ?>
                                                                            <li class="grid-item selected digital transition-inner-all">
                                                                                <div class="portfolio-box">
                                                                                    <div class="portfolio-image bg-medium-gray border-radius-4px">
                                                                                        <img src="<?php echo base_url().$blog_url;?>" alt="" />
                                                                                    
                                                                                    </div>
                                                                                    <div class="portfolio-caption pt-30px pb-30px sm-pt-20px sm-pb-20px blog-title-section">
                                                                                        <a href="<?php echo base_url() . 'blog-details/' . strtolower($blogsAll['list_code']) .'/'.$blogsAll['blog_url']; ?>" class="text-dark-gray text-dark-gray-hover fw-600 blog-title-section"><?php echo ucfirst($blogsAll['blog_title']); ?></a>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                <!-- end portfolio item -->
                                                            </ul>
                                                                
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-md-4 showing-count text-dark">
                                                            Showing <?php echo $starting; ?> to <?php echo $ending; ?> of <?php echo $totalRows; ?> entries
                                                        </div>
                                                        <!-- Pagination -->
                                                        <?php if (isset($pagination)) 
                                                            { 
                                                                ?>
                                                                    <div class="col-md-8" style="float:right;padding: 0px 20px 0px 0px;">
                                                                        <?php foreach ($pagination as $link) { echo $link; } ?>
                                                                    </div>
                                                                <?php 
                                                            } 
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                                <!-- <div class="col-12 mt-2 d-flex justify-content-center">
                                                    <ul class="pagination pagination-style-01 fs-13 fw-500 mb-0">
                                                        <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-left fs-18 d-xs-none"></i></a></li>
                                                        <li class="page-item"><a class="page-link" href="#">01</a></li>
                                                        <li class="page-item active"><a class="page-link" href="#">02</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">04</a></li>
                                                        <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-right fs-18 d-xs-none"></i></a></li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                        <?php
                                    }
                                ?>
                        </div>
                    </div>
                </section>
                <style>
                    .blog-title-section {
                        max-height: 100px;
                        min-height: 100px;
                    }
                </style>
                <!-- end section -->
                
                <div class="bg-very-light-gray border-radius-6px p-40px lg-p-25px md-p-35px   d-block d-sm-none">
                    <div class="mb-15 md-mb-50px xs-mb-35px d-none d-md-block">
                        <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">
                            Popular Blogs
                        </div>
                        <ul class="popular-post-sidebar position-relative">
                            <li class="d-flex align-items-center">
                                <figure>
                                    <a href="demo-elearning-blog-single-simple.html">
                                        <img src="https://via.placeholder.com/600x600" alt="">
                                    </a>
                                </figure>
                                <div class="col media-body">
                                    <a href="demo-elearning-blog-single-simple.html" class="fw-600 fs-17 text-dark-gray d-inline-block mb-10px">
                                        Trendy is the last stage before tacky.
                                    </a>
                                    <div>
                                        <a href="blog-grid.html" class="d-inline-block fs-15">
                                            20 February 2023</a>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <figure>
                                    <a href="demo-elearning-blog-single-simple.html"><img src="https://via.placeholder.com/600x600" alt="">
                                    </a>
                                </figure>
                                <div class="col media-body">
                                    <a href="demo-elearning-blog-single-simple.html" class="fw-600 fs-17 text-dark-gray d-inline-block mb-10px">
                                        Believe you can and you're halfway there.
                                    </a>
                                    <div>
                                        <a href="blog-grid.html" class="d-inline-block fs-15">
                                            18 February 2023
                                        </a>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- start scroll progress -->
                <div class="scroll-progress d-none d-xxl-block">
                    <a href="#" class="scroll-top" aria-label="scroll">
                        <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
                    </a>
                </div>
                
            <?php
        }
        else
        {
            ?>
                <div class="text-center pt-5">
                    <img src="<?php echo base_url(); ?>uploads/nodata.png" alt="No data available" style="width: 400px;height:400px">
                </div>
            <?php
        }
    ?>
    <style> 
        .blog_active_back_ground_color
        {
            color: #2eaa31;
            border-color: none!important;
            font-weight: bold;
        }
        .blog_back_ground_color
        {
            color: white;
            border-bottom: none!important;
        }

        .dynamic_pagination 
        {
            display: inline-block;
            padding-left: 0;
            /* margin: 20px 0; */
            border-radius: 0;
            float: right;
        }
        .dynamic_pagination>li 
        {
            display: inline-block;
            color: #6f7071;
            
        }

        .dynamic_pagination>li:first-child>a, .dynamic_pagination>li:first-child>span 
        {
            margin-left: 0;
        }

        .dynamic_pagination>li>a, .dynamic_pagination>li>span 
        {
            width: 55px;
            height: 55px;
            text-align: center;
            line-height: 55px;
            background-color: white;
            border: 1px solid white;
            margin: 0 4px;
            transition: all 0.3s;
            display: block;
            color: #6f7071;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer !important;
        }
        a 
        {
            color: #6f7071;
            text-decoration: none;
            background-color: transparent;
        }



        .dynamic_pagination>.active>a, .dynamic_pagination>.active>span, .dynamic_pagination>.active>a:hover, .dynamic_pagination>.active>span:hover, .dynamic_pagination>.active>a:focus, .dynamic_pagination>.active>span:focus {
            z-index: 2;
            color: white;
            cursor: default;
            background-color: black;
            border-radius: 50%;
        }

        .dynamic_pagination>li>a:hover
        {
            z-index: 2;
            color: white;
            cursor: default;
            background-color: black;
            border-radius: 50%;
        }

        
    </style>
</body>
