
<!--==================================================-->
<!-- Start Consalt Breadcumb Area -->
<!--==================================================-->
<div class="breadcumb-area d-flex">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 text-center">
				<div class="breadcumb-content">
					<div class="breadcumb-title">
						<h4>News</h4>
					</div>
					<ul>
						<li><a href="<?php echo base_url() .'home'; ?>"><i class="bi bi-house-door-fill"></i> Home </a></li>
						<li class="rotates"><i class="bi bi-slash-lg"></i>News</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--==================================================-->
<!-- End Consalt Breadcumb Area -->
<!--==================================================-->
<!--==================================================-->
<!-- Start Consalt Blog Area style Two-->
<!--==================================================-->

<?php 
	
	if(count($resultData)>0)
	{
		?>
			<section class="blog_area style_two">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="section_title style_three style_four text-center">
								<h4>TRENDY NEWS</h4>
								<h1>Read Our Latest News</h1>
							
							</div>
						</div>		
					</div>
					<div class="row">
						<?php 
							foreach ($resultData as $active_news) 
							{
								$news_url = "uploads/news/".$active_news['news_id'].".png";
								?>
									<div class="col-lg-4 col-md-6">
										<div class="single-blog-box style_three">
											<div class="single-blog-thumb">
												<img src="<?php echo base_url().$news_url;?>" alt="">
											</div>
											<div class="blog-content">						
												<div class="blog-title">
													<h3><a href="<?php echo base_url() .'news-details.html/'.encode($active_news['news_id']); ?>"><?php echo ucfirst($active_news['news_title']);?></a></h3>
												</div>
												<p class="blog_text"><?php echo ucfirst($active_news['short_description']);?></p>
												<div class="meta-blog style_two">
													<p><?php echo isset($active_news['last_updated_date']) ? date("d M, Y", strtotime($active_news['last_updated_date'])) : NULL;?></p>
												</div>
											</div>
										</div>
									</div>
								<?php
							}
						?>
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
			</section>
		<?php
	}
?>

<!--==================================================-->
<!-- End Consalt Blog Area style Two-->
<!--==================================================-->
<style>
	section.blog_area.style_two {
		background: url('<?php echo base_url();?>assets/frontend/img/home_two/blod_bg.png');
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center center;
		padding: 85px 0 90px;
	}
		
	.dynamic_pagination {
		display: inline-block;
		padding-left: 0;
		/* margin: 20px 0; */
		border-radius: 0;
		float: right;
	}
	.dynamic_pagination>li {
		display: inline-block;
		color: var(--ztc-bg-color-w);
	}

	.dynamic_pagination>li:first-child>a, .dynamic_pagination>li:first-child>span {
		margin-left: 0;
	}

	.dynamic_pagination>li>a, .dynamic_pagination>li>span {
		width: 55px;
		height: 55px;
		text-align: center;
		line-height: 55px;
		background-color: var(--ztc-bg-bg-4);
		border: 1px solid var(--ztc-bg-bg-5);
		margin: 0 4px;
		transition: all 0.3s;
		display: block;
		color: var(--ztc-bg-color-w);
		border-radius: 7px;
		font-weight: var(--f-fw-blod);
	}
	a {
		color: var(--ztc-bg-main-bg-4);;
		text-decoration: none;
		background-color: transparent;
	}

	.dynamic_pagination>.active>a, .dynamic_pagination>.active>span, .dynamic_pagination>.active>a:hover, .dynamic_pagination>.active>span:hover, .dynamic_pagination>.active>a:focus, .dynamic_pagination>.active>span:focus {
		z-index: 2;
		color: #ffffff;
		cursor: default;
		background-color: #0c6e6d;
	}

	.dynamic_pagination>li>a:hover, .dynamic_pagination>li>span:hover, .dynamic_pagination>li>a:focus, .dynamic_pagination>li>span:focus {
		background-color: #0c6e6d;
		color: #ffffff;
	}
</style>