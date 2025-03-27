
<!--==================================================-->
<!-- Start Consalt Breadcumb Area -->
<!--==================================================-->
<div class="breadcumb-area d-flex">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 text-center">
				<div class="breadcumb-content">
					<div class="breadcumb-title">
						<h4>Blogs</h4>
					</div>
					<ul>
						<li><a href="home.html"><i class="bi bi-house-door-fill"></i> Home </a></li>
						<li class="rotates"><i class="bi bi-slash-lg"></i>Blogs</li>
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
<!-- Start Consalt Case study Area-->
<!--==================================================-->
<?php
	$getBlogCategory 	= $this->categories_model->getBlogCategory();

	if(count($getBlogCategory)>0)
	{
		?>
			<div class="case-study-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="section_title text-center">
								<h1>Blogs</h1>
							</div>
						</div>
					</div>
					
						
					<div class="row align-items-center first-section">							
						<div class="col-12">
							<div class="portfolio_nav">
								<div class="portfolio_menu pb-4">
									<select name="blog_id" id="blog_id" onchange="selectBlogs(this.value)" class="form-select">
										<option value="all">All</option>
										<?php
											foreach ($getBlogCategory as $blogCategory) 
											{
												?>
												<option value="<?php echo $blogCategory['list_type_value_id']; ?>">
													<?php echo ucfirst($blogCategory['list_value']); ?>
												</option>
												<?php
											}
										?>
									</select>

									

								</div>
							</div>
						</div>
					</div>
							
					

			<!-- Optional Custom Styling -->
			<style>
				.portfolio_nav {
					text-align: center; /* Centers the dropdown inside its container */
				}
				.form-select.custom-dropdown option {
				width: 100%;
			}


				/* Optional: Add custom margin/padding adjustments for mobile */
				@media (max-width: 767px) {
					.portfolio_menu select.form-select {
						padding: 12px; /* Increase padding for better touch targets */
					}
				}

				/* Optional: You can add styles for larger screens too */
				@media (min-width: 768px) {
					.portfolio_menu select.form-select {
						width: 50%; /* Dropdown takes 50% width on larger screens */
						margin: 0 auto; /* Centers the dropdown */
					}
				}
			</style>


			<div class="row align-items-center second-section">
				<div class="col-lg-12">
					<div class="portfolio_nav">
						<div class="portfolio_menu">
							<ul class="menu-filtering">
								<li class="current_menu_item" data-filter="*"> All Item</li>
								<?php 
									foreach ($getBlogCategory as $blogCategory) 
									{
										?>
											<li data-filter=".blog_category_<?php echo $blogCategory['list_type_value_id']; ?>" class=""> <?php echo ucfirst($blogCategory['list_value']); ?></li>
										<?php
									}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>



			<script>
				// Check if the number of menu items exceeds 7
				var menuItems = document.querySelectorAll('.menu-filtering li');
				if(menuItems.length > 7) {
					// Add a CSS class to apply the wrapping styles
					document.querySelector('.menu-filtering').classList.add('wrap-menu');
				}
			</script>

			<!-- CSS -->
			<style>
				.portfolio_menu {
					width: 100%;
				}

				.menu-filtering {
					display: flex;
					flex-wrap: wrap; /* Allows the menu items to wrap into multiple rows */
					padding-left: 0;
					list-style-type: none;
					gap: 10px; /* Adds space between items */
				}

				.menu-filtering li {
					display: inline-block;
					padding: 10px;
					background-color: #f1f1f1;
					border: 1px solid #ddd;
					margin-bottom: 10px;
					border-radius: 5px;
					width: auto;
					white-space: nowrap; /* Prevents text wrapping within the items */
				}

				/* Optional: to control the width of the items */
				.menu-filtering li {
					flex: 0 0 auto;
				}

				/* Ensure the items in the wrap-menu class behave correctly */
				.menu-filtering.wrap-menu {
					display: flex;
					flex-wrap: wrap;
					gap: 10px;
				}

				/* Mobile - Hide first section on desktop */
				@media (min-width: 992px) {
					.first-section {
						display: none;
					}
				}

				/* Desktop - Hide second section on mobile */
				@media (max-width: 991px) {
					.second-section {
						display: none;
					}
				}
			</style>

					<?php
						$getBlogsAll		= $this->blogs_model->getBlogsAll();
					
					?>
					<script>
						function selectBlogs(list_type_value_id) 
						{
							$.ajax(
							{
								url: '<?php echo base_url();?>blogs/ajaxBlogList/' + list_type_value_id,
								type: 'GET',
								success: function(response) 
								{
									$("#blog-list").html(response); // Update the blog list dynamically
								},
								error: function() {
									alert("Failed to fetch data. Please try again.");
								}
							});
						}

					</script>


					<div class="row image_load" id="blog-list">
						<?php
							if(count($getBlogsAll)>0)
							{
								foreach ($getBlogsAll as $blogsAll) 
								{
									$blog_url	='uploads/blogs/'.$blogsAll['blog_id'].'.png'
									?>	
										<div class="col-lg-4 col-md-6  grid-item blog_category_<?php echo $blogsAll['list_type_value_id'];?>">
											<div class="single-blog-box">
												<div class="single-blog-thumb">
													<img src="<?php echo base_url().$blog_url;?>" alt="">							
												</div>
												<div class="blog-content">
													<div class="meta-blog">
														<p><span class="solution"><?php echo ucfirst($blogsAll['list_value']); ?></span><?php echo isset($blogsAll['created_date']) ? date("d M, Y",strtotime($blogsAll['created_date'])) : "";?></p>
													</div>
													<div class="blog-title">
														<h3><a href="javascript:void(0)"><?php echo ucfirst($blogsAll['blog_title']); ?></a></h3>
													</div>
													<div class="blog_btn">
														<a href="javascript:void(0)">Read More <i class="flaticon flaticon-right-arrow"></i></a>
													</div>
												</div>
											</div>
										</div>
									<?php
								}
							}
						?>
						
					</div>
				</div>
			</div>
		<?php
	}
		
?>

<!--==================================================-->
<!-- End Hosting  Pricing Area Style Two -->
<!--==================================================-->
