<?php
	$physical_stock_adjustment 	= accessMenu(physical_stock_adjustment);
	$getBlogCategory 			= $this->common_model->lov('BLOG-CATEGORY');
	$getBlogType 				= $this->common_model->lov('BLOG-TYPE');
	$activeStatus 				= $this->common_model->lov('ACTIVESTATUS');

?>
<div class="content"><!-- Content start-->
	<div class="card"><!-- Card start-->
		<div class="card-body">
			<?php
				if(isset($type) && $type == "add" || $type == "edit" || $type == "view")
				{
					if($type == "view")
					{
						$fieldSetDisabled = "disabled";
						$searchDropdown = "";
						$this->fieldDisabled = $fieldDisabled = "";
						$this->fieldReadonly = $fieldReadonly = "";
					}
					else
					{
						if($type == "add" || $type == "edit")
						{
							$this->fieldDisabled = $fieldDisabled = "";
							$this->fieldReadonly = $fieldReadonly = "";
						}

						$fieldSetDisabled = "";
						$searchDropdown = "searchDropdown";
					}
					?>
					<form action="" --class="form-validate-jquery" enctype="multipart/form-data" method="post">
						<div class="header-lines">
							<!-- Buttons start here -->
							<div class="row mb-3">
								<div class="col-md-6">
									<h3>
										<b>
											<?php
												if($type == "add")
												{
													?>
													Create
													<?php
												}
												else if($type == "edit")
												{
													echo ucfirst($type);
												}
												else if($type == "view")
												{
													echo ucfirst($type);
												}
											?>
											Blog
										</b>
									</h3>
								</div>
								<div class="col-md-6 text-right">
									<?php
										if($type == "add" || $type == "edit")
										{
											?>
											<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save & Continue" class="btn btn-primary btn-sm form_submit_valid">Save</button>
											<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm form_submit_valid">Submit</button>
											<?php
										}
									?>
									<a href="<?php echo base_url(); ?>blogs/manageBlogs" class="btn btn-default btn-sm">Close</a>

								</div>
							</div>
							<!-- Buttons end here -->

							<fieldset <?php echo $fieldSetDisabled;?>>

								<section class="header-section">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label blog_type"><span class="text-danger">*</span> Blog Type</label>
													</div>				
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<select name="blog_type" id="blog_type" class="form-control <?php echo $searchDropdown;?>" required>
															<option value="">- Select  -</option>
															<?php 
																
																foreach($getBlogType as $blogType)
																{
																	$selected="";
																	if(isset($editData[0]['blog_type']) && ($editData[0]['blog_type'] == $blogType['list_code']) )
																	{
																		$selected="selected='selected'";
																	}
																	?>
																	<option value="<?php echo $blogType['list_code'];?>" <?php echo $selected;?>><?php echo $blogType['list_value']; ?></option>
																	<?php 
																} 
															?>
														</select>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label category_id"><span class="text-danger">*</span> Service Name</label>
													</div>				
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<select name="category_id" id="category_id" class="form-control <?php echo $searchDropdown;?>" required>
															<option value="">- Select  -</option>
															<?php 
																$categoryList = $this->categories_model->getCategoryAll();
																foreach($categoryList as $category)
																{
																	$selected="";
																	if(isset($editData[0]['category_id']) && ($editData[0]['category_id'] == $category['category_id']) )
																	{
																		$selected="selected='selected'";
																	}
																	?>
																	<option value="<?php echo $category['category_id'];?>" <?php echo $selected;?>><?php echo $category['category_name']; ?></option>
																	<?php 
																} 
															?>
														</select>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label industries_id">Industry Name</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<div class="input-wrapper">
															<input type="text" name="industries_name" autocomplete="off" id="industries_name" value="<?php echo isset($editData[0]['industries_name']) ? $editData[0]['industries_name'] : NULL; ?>" placeholder="Industries Name" class="form-control">
															<input type="hidden" name="industries_id" autocomplete="off" id="industries_id" value="<?php echo isset($editData[0]['industries_id']) ? $editData[0]['industries_id'] : NULL; ?>" >
															<div id="IndustriesNameList"></div><!-- Clear icon start -->
																<?php 
																	if(isset($editData[0]["industries_id"]) && $editData[0]["industries_id"] !== '')
																	{
																		$styleDisplay = "display:block;";
																	}
																	else{
																		$styleDisplay = "display:none";
																	}
																	
																?>
															<span class="industries_name_clear_icon" title="Clear" onclick="clearIndustriesNameSearchKeyword();" style="<?php echo $styleDisplay;?>">
																<i class="fa fa-times" aria-hidden="true"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label blog_category"><span class="text-danger">*</span> Category</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<select name="blog_category" id="blog_category" class="form-control <?php echo $searchDropdown;?>">
															<option value="">- Select -</option>
															<?php
																foreach($getBlogCategory as $blogCategory)
																{
																	$selected="";
																	if(isset($editData[0]['blog_category']) && $editData[0]['blog_category'] == $blogCategory["list_code"] )
																	{
																		$selected="selected='selected'";
																	}
																	?>
																	<option value="<?php echo $blogCategory["list_code"];?>" <?php echo $selected;?>><?php echo ucfirst($blogCategory["list_value"]);?></option>
																	<?php
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label blog_title"><span class="text-danger">*</span> Blog Title</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group role_id">
														<input type="text" name="blog_title" id="blog_title" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['blog_title']) ? $editData[0]['blog_title'] :"";?>" placeholder="Blog Title">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label blog_image"><span class="text-danger">*</span> Image</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="file" name="blog_image" id="blog_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
															<span class="text-muted" ></span>
															<span class="exist_error text-warning"></span>
															
															<?php 
																if( ($type == "edit" || $type == "view") && isset($id))
																{
																	$url = "uploads/blogs/".$id.".png";
																	if(file_exists($url))
																	{
																		?><br>
																		<div class="form-group view-form row">
																			<div class="col-lg-8"><br>
																				<img src="<?php echo base_url().$url;?>" style="width:100px !important; height:75px !important;" alt="...">
																			</div>
																		</div>
																		<?php 
																	}
																} 
															?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label client_name"><span class="text-danger">*</span> Client Name</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="text" name="client_name" id="client_name" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['client_name']) ? $editData[0]['client_name'] :"";?>" placeholder="Client Name">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label client_image"><span class="text-danger">*</span> Client Image</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="file" name="client_image" id="client_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
															<span class="text-muted" ></span>
															<span class="exist_error text-warning"></span>
															
															<?php 
																if( ($type == "edit" || $type == "view") && isset($id))
																{
																	$url = "uploads/blogs/client_image/".$id.".png";
																	if(file_exists($url))
																	{
																		?><br>
																		<div class="form-group view-form row">
																			<div class="col-lg-8"><br>
																				<img src="<?php echo base_url().$url;?>" style="width:100px !important; height:75px !important;" alt="...">
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
											
												if($type!=='add'){
													if($editData[0]["best_blog"] == "Y")
													{
														$best_blogChecked = 'checked="checked"';
														
													}
													else if($editData[0]["best_blog"] == "N")
													{
														$best_blogChecked = '';
													}
												}
												else
												{
													$best_blogChecked 	= '';
												}

												if($type == "view")
												{
													$disabledchk		= 'disabled';
												}else{
													$disabledchk		= '';
												}	
												
												?>
													<div class="row align-items-center">
														<div class="col-md-4">
															<div class="form-group text-right">
																<label class="col-form-label best_blog">Best Blog</label>
															</div>
														</div>
														<div class="col-md-6 d-flex align-items-center">
															<div class="form-group">
																<input type="checkbox" name="best_blog" class="best_blog" <?php echo $disabledchk;?> id="" <?php echo $best_blogChecked;?> value="Y">
															</div>
														</div>
													</div>

												<?php
												
											?>
											
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label banner_image"><span class="text-danger">*</span> Banner Image</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="file" name="banner_image" id="banner_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
															<span class="text-muted" ></span>
															<span class="exist_error text-warning"></span>
															
															<?php 
																if( ($type == "edit" || $type == "view") && isset($id))
																{
																	$url = "uploads/blogs/banner/".$id.".png";
																	if(file_exists($url))
																	{
																		?><br>
																		<div class="form-group view-form row">
																			<div class="col-lg-8"><br>
																				<img src="<?php echo base_url().$url;?>" style="width:100px !important; height:75px !important;" alt="...">
																			</div>
																		</div>
																		<?php 
																	}
																} 
															?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right short_description">
														<label class="col-form-label short_description"><span class="text-danger">*</span> Short Description</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group role_id">
														<input type="text" name="short_description" id="short_description" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['short_description']) ? $editData[0]['short_description'] :"";?>" placeholder="Short Description">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label">
															<span class="text-danger">*</span> Description
														</label>
													</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<!-- Add this div to define the editor container -->
														<div id="editor-container" style="height: 300px; border: 1px solid #ccc;"></div>
														<input type="hidden" name="description" id="description">
														<input type="hidden" name="editor_images" id="editor_images" />
													</div>
												</div>
											</div>
										
										</div>
									</div>

								</section>

								<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
								<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
								
								<script>
									$(document).ready(function () 
									{
										var type = '<?php echo $type; ?>';

										$(".form_submit_valid").prop('disabled', true);

										var quill = new Quill('#editor-container', 
										{
											theme: 'snow',
											modules: 
											{
												toolbar: 
												{
													container: [
														[{ 'header': [1, 2, 3, false] }],
														['bold', 'italic', 'underline'],
														[{ 'list': 'ordered' }, { 'list': 'bullet' }],
														['link', 'image'],
														['clean']
													],
													handlers: 
													{
														image: imageHandler
													}
												}
											}
										});

										if (type === 'edit') 
										{
											var existingDescription = `<?php echo isset($editData[0]['description']) ? $editData[0]['description'] : ''; ?>`;
											quill.root.innerHTML = existingDescription;
											$("#description").val(existingDescription);
										}

										function imageHandler() 
										{
											const input = document.createElement('input');
											input.setAttribute('type', 'file');
											input.setAttribute('accept', 'image/*');
											input.click();

											input.onchange = async () => {
												const file = input.files[0];
												const formData = new FormData();
												formData.append('image', file);

												try {
													const response = await fetch('<?php echo base_url(); ?>blogs/upload_editor_image', {
														method: 'POST',
														body: formData
													});
													const data = await response.json();

													if (data.status === 'success') {
														const range = quill.getSelection();
														quill.insertEmbed(range.index, 'image', data.url);
													} else {
														alert(data.message || 'Image upload failed.');
													}
												} catch (error) {
													console.error('Image upload error:', error);
													alert('Failed to upload the image. Please try again.');
												}
											};
										}

										$("input, select, textarea").on('keyup change', function () 
										{
											validateForm();
										});

										quill.on('text-change', function () 
										{
											validateForm();
										});

										validateForm();

										function validateForm() 
										{
											var category_id 			= $("#category_id").val();
											var blog_title 				= $("#blog_title").val();
											var blog_category 			= $("#blog_category").val();
											var client_name 			= $("#client_name").val();
											var blog_image 				= $("#blog_image").val();
											var banner_image 			= $("#banner_image").val();
											var client_image 			= $("#client_image").val();
											var short_description 		= $("#short_description").val();
											var description 			= quill.root.innerHTML.trim();
											var sanitizedDescription 	= description.replace(/(<([^>]+)>|\s)+/g, "").trim();

											$("#description").val(description);

											var editor_images = [];
											$(quill.root).find('img').each(function () 
											{
												editor_images.push($(this).attr('src'));
											});

											$("#editor_images").val(JSON.stringify(editor_images)); 

											if (category_id !== "" && blog_title.trim() !== "" && blog_category !== "" && client_name.trim() !== "" && short_description.trim() !== "" && (type !== 'add' || blog_image) && (type !== 'add' || banner_image) && (type !== 'add' || client_image) && sanitizedDescription !== "") 
											{
												$(".form_submit_valid").prop('disabled', false);
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', true);
											}
										}

										function saveBtn(val) 
										{
											$(".form_submit_valid").prop('disabled', true);

											var category_id 			= $("#category_id").val();
											var blog_title 				= $("#blog_title").val();
											var blog_category 			= $("#blog_category").val();
											var short_description 		= $("#short_description").val();
											var client_name 			= $("#client_name").val();
											var blog_image 				= $("#blog_image").val();
											var banner_image 			= $("#banner_image").val();
											var client_image 			= $("#client_image").val();
											var description 			= quill.root.innerHTML.trim();
											var sanitizedDescription 	= description.replace(/(<([^>]+)>|\s)+/g, "").trim();

											$("#description").val(description);

											var editor_images = [];
											$(quill.root).find('img').each(function () 
											{
												editor_images.push($(this).attr('src'));
											});

											$("#editor_images").val(JSON.stringify(editor_images));

											if (category_id.trim() !== "" && blog_title.trim() !== "" && blog_category !== "" && short_description.trim() !== "" && client_name.trim() !== "" && (type !== 'add' || blog_image) && (type !== 'add' || banner_image) && (type !== 'add' || client_image) && sanitizedDescription !== "") {

												$(".category_id,.blog_title, .blog_category, .short_description,.client_name, .blog_image,.client_image, .description").removeClass('errorClass');
												return true;
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', false);

												if (category_id === "") $(".category_id").addClass('errorClass');
												if (blog_title.trim() === "") $(".blog_title").addClass('errorClass');
												if (blog_category === "") $(".blog_category").addClass('errorClass');
												if (short_description.trim() === "") $(".short_description").addClass('errorClass');
												if (client_name.trim() === "") $(".client_name").addClass('errorClass');
												if (type === 'add' && !blog_image) $(".blog_image").addClass('errorClass');
												if (type === 'add' && !banner_image) $(".banner_image").addClass('errorClass');
												if (type === 'add' && !client_image) $(".client_image").addClass('errorClass');
												if (sanitizedDescription === "") $(".description").addClass('errorClass');

												return false;
											}
										}
									});

								</script>

								<!-- Line level end here -->
							</fieldset>
							<div class="col-md-12 mt-3 pr-0 text-right">
								<?php
									if($type == "add" || $type == "edit")
									{
										?>
										<!-- <a href="javascript:void(0)" id="save_btn" onclick="return saveBtn('save_btn','save');" class="btn btn-primary btn-sm submit_btn_bottom">Save Bottom</a> -->
										<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save & Continue" class="btn btn-primary btn-sm form_submit_valid">Save</button>
										<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm form_submit_valid">Submit</button>
										<?php
									}
								?>
								<a href="<?php echo base_url(); ?>blogs/manageBlogs" class="btn btn-default btn-sm">Close</a>
							</div>
						</div>
					</form>

					
					<?php
				}
				else
				{
					?>
					<!-- Buttons start here -->
					<div class="row">
						<div class="col-md-6"><h3><b><?php echo $page_title;?></b></h3></div>
						<div class="col-md-6 float-right text-right">
							<?php
								if($physical_stock_adjustment['create_edit_only'] == 1 || $this->user_id == 1)
								{
									?>
									<a href="<?php echo base_url(); ?>blogs/manageBlogs/add" class="btn btn-info btn-sm">
										Create Blog
									</a>
									<?php
								}
							?>
						</div>
					</div>
					<!-- Buttons end here -->

					<!-- Filters start here -->
					<form action="" class="form-validate-jquery" method="get">
						<div class="row mt-3">
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right category_id">Service Name</label>
									<div class="form-group col-md-7">
										<select name="category_id" id="category_id" class="form-control <?php echo $searchDropdown;?>" required>
											<option value="">- Select  -</option>
											<?php 
												$categoryList = $this->categories_model->getCategoryAll();
												foreach($categoryList as $category)
												{
													$selected="";
													if(isset($_GET['category_id']) && ($_GET['category_id'] == $category['category_id']) )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $category['category_id'];?>" <?php echo $selected;?>><?php echo $category['category_name']; ?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
								<?php /*
								<div class="row">
									<label class="col-form-label col-md-5 text-right industries_id">Industry Name</label>
									<div class="form-group col-md-7">
										<div class="input-wrapper">
											<input type="text" name="industries_name" autocomplete="off" id="industries_name" value="<?php echo isset($_GET['industries_name']) ? $_GET['industries_name'] : NULL; ?>" placeholder="Industries Name" class="form-control">
											<input type="hidden" name="industries_id" autocomplete="off" id="industries_id" value="<?php echo isset($_GET['industries_id']) ? $_GET['industries_id'] : NULL; ?>" >
											<div id="IndustriesNameList"></div><!-- Clear icon start -->
												<?php 
													if(isset($_GET["industries_id"]) && $_GET["industries_id"] !== '')
													{
														$styleDisplay = "display:block;";
													}
													else{
														$styleDisplay = "display:none";
													}
													
												?>
											<span class="industries_name_clear_icon" title="Clear" onclick="clearIndustriesNameSearchKeyword();" style="<?php echo $styleDisplay;?>">
												<i class="fa fa-times" aria-hidden="true"></i>
											</span>
										</div>
									</div>
								</div>
								*/ ?>
							</div>
							
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Category</label>
									<div class="form-group col-md-7">
										<select name="blog_category" id="blog_category" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getBlogCategory as $blogCategory)
												{
													$selected="";
													if(isset($_GET["blog_category"]) && $_GET["blog_category"] == $blogCategory['list_code'] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $blogCategory['list_code'];?>" <?php echo $selected;?>><?php echo $blogCategory['list_value'];?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Blog Title</label>
									<div class="form-group col-md-7">
										<input type="search" class="form-control" name="keywords" value="<?php echo !empty($_GET['keywords']) ? $_GET['keywords'] :""; ?>" placeholder="Blog Title" autocomplete="off">
									</div>
								</div>
							</div>
							
						</div>
						<div class="row mb-3">
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Status</label>
									<div class="form-group col-md-7">
										
										<select name="active_flag" id="active_flag" class="form-control searchDropdown">
											<!-- <option value="">- Select -</option> -->
											<?php 
												foreach($activeStatus as $row)
												{
													$selected="";
													if(isset($_GET['active_flag']) && $_GET['active_flag'] == $row["list_code"] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $row["list_code"];?>" <?php echo $selected;?>><?php echo ucfirst($row["list_value"]);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search"></i></button>
								<a href="<?php echo base_url(); ?>blogs/manageBlogs" title="Clear" class="btn btn-default">Clear</a>
							</div>
						</div>
					</form>
					<!-- Filters end here -->

					<?php
						if(isset($_GET) &&  !empty($_GET))
						{
							if( isset($resultData) && count($resultData) > 0 )
							{
								?>
									<!-- Page Item Show start -->
									<div class="row mt-3">
										<div class="col-md-6">
											<?php /*
												<a href="<?php echo base_url().$this->redirectURL;?>&export=export" class="btn btn-primary btn-sm">Download Excel</a>
											*/ ?>
										</div>

										<div class="col-md-6 float-right text-right">
											<?php
												$redirect_url = substr($_SERVER['REQUEST_URI'],'1');
											?>
											<input type="hidden" id="redirect_url" value="<?php echo $redirect_url; ?>"/>

											<div class="filter_page pt-0">
												<label>
													<span>Show :</span>
													<select name="filter" onchange="location.href='<?php echo base_url(); ?>admin/sort_itemper_page/'+$(this).val()+'?redirect=<?php echo $redirect_url; ?>'">
														<?php
															$pageLimit = isset($_SESSION['PAGE']) ? $_SESSION['PAGE'] : NULL;
															foreach($this->items_per_page as $key => $value)
															{
																$selected="";
																if($key == $pageLimit){
																	$selected="selected=selected";
																}
																?>
																<option value="<?php echo $key; ?>" <?php echo $selected;?>><?php echo $value; ?></option>
																<?php
															}
														?>
													</select>
												</label>
											</div>
										</div>
									</div>
								<?php
							
							}
						?>
							
						<!-- Page Item Show start -->

							<!-- Table start here -->
							<div class="new-scroller">
								<table id="myTable" class="table table-bordered table-hover tbl_height">
									<thead>
										<tr>
											<th class="text-center tab-md-100">Controls</th>
											<th class="text-left tab-md-140">Industry Name</th>
											<th class="text-left tab-md-140">Category</th>
											<th class="text-left tab-md-140">Blog Title</th>
											<th class="text-center tab-md-120">Image</th>
											<th class="text-center tab-md-100">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=0;
											$firstItem = $first_item;
											$totalValue = 0;
											foreach($resultData as $row)
											{
												?>
												<tr>
												<td class="text-center">
														<div class="dropdown" >
															<button type="button" class="btn btn-outline-info gropdown-toggle btn-sm"  data-toggle="dropdown" aria-expanded="false">
																Action&nbsp;<i class="fa fa-chevron-down"></i>
															</button>
															<ul class="table-dropdown dropdown-menu dropdown-menu-right">
																<?php
																	if($physical_stock_adjustment['create_edit_only'] == 1 || $physical_stock_adjustment['read_only'] == 1 || $this->user_id == 1)
																	{ 
																		?>
																		<?php
																			if($physical_stock_adjustment['create_edit_only'] == 1 || $this->user_id == 1)
																			{
																				?>
																					<li>
																						<a title="Edit" href="<?php echo base_url(); ?>blogs/manageBlogs/edit/<?php echo $row['blog_id'];?>/">
																							<i class="fa fa-edit"></i> Edit
																						</a>
																					</li>
																				<?php 
																			} 
																		?>

																		<?php
																			if($physical_stock_adjustment['read_only'] == 1 || $this->user_id == 1)
																			{
																				
																				?>
																				<li>
																					<a title="View" href="<?php echo base_url(); ?>blogs/manageBlogs/view/<?php echo $row['blog_id'];?>/">
																						<i class="fa fa-eye"></i> View
																					</a>
																				</li>
																				<?php 
																			} 
																		?>

																		<?php
																			if($physical_stock_adjustment['create_edit_only'] == 1 || $this->user_id == 1)
																			{
																				?>
																				<li>
																					<?php 
																						if($row['active_flag'] == $this->active_flag)
																						{
																							?>
																							<a class="unblock" href="<?php echo base_url(); ?>blogs/manageBlogs/status/<?php echo $row['blog_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>blogs/manageBlogs/status/<?php echo $row['blog_id'];?>/Y" title="Active">
																								<i class="fa fa-check"></i> Active
																							</a>
																							<?php 
																						} 
																					?>
																				<li>
																				<?php 
																			} 
																		?>
																		<?php 
																	} 
																?>
															</ul>
														</div>
													</td>
													<td><?php echo ucfirst($row['industries_name']);?></td>
													<td><?php echo ucfirst($row['list_value']);?></td>
													<td><?php echo ucfirst($row['blog_title']);?></td>
													<td class="text-center">
														<?php 
															if(isset($row['blog_id']))
															{
																$url = "uploads/blogs/".$row['blog_id'].".png";
																if(file_exists($url))
																{
																	?>
																	<img src="<?php echo base_url().$url;?>" style="width:50px !important; height:40px !important;" alt="...">
																	<?php 
																}else{
																	?>
																	<img src="<?php echo base_url()?>uploads/no-image.png" style="width:50px !important; height:40px !important;" alt="...">
																	<?php 
																}
															} 
														?>
													</td>
													<td class="text-center">
														<?php 
															if($row['active_flag'] == $this->active_flag)
															{
																?>
																<span class="btn btn-outline-success btn-sm" title="Active">
																	Active 
																</span>
																<?php 
															} 
															else
															{  ?>
																<span class="btn btn-outline-warning btn-sm" title="Inactive">
																	Inactive 
																</span>
																<?php 
															} 
														?>
													</td>		
												</tr>
												<?php
												$i++;
											}
										?>
									</tbody>
								</table>
								<?php
									if(count($resultData) == 0)
									{
										?>
										<div class="text-center">
											<img src="<?php echo base_url();?>uploads/nodata.png">
										</div>
										<?php
									}
								?>
							</div>
							<!-- Table end here -->

							<!-- Pagination start here -->
							<?php
								if (count($resultData) > 0)
								{
									?>
									<div class="row">
										<div class="col-md-4 showing-count">
											Showing <?php echo $starting;?> to <?php echo $ending;?> of <?php echo $totalRows;?> entries
										</div>
										<!-- pagination start here -->
										<?php
											if( isset($pagination) )
											{
												?>
												<div class="col-md-8" class="admin_pagination" style="float:right;padding: 0px 20px 0px 0px;"><?php foreach ($pagination as $link){echo $link;} ?></div>
												<?php
											}
										?>
										<!-- pagination end here -->

									</div>
									<?php
								}
							?>
							<!-- Pagination end here -->
							<?php
						}
					?>
					<?php
				}
			?>
		</div>
	</div><!-- Card end-->
</div><!-- Content end-->











