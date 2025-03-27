<?php 
	$physical_stock_adjustment = accessMenu(physical_stock_adjustment);

	$getNews 		= $this->news_model->getNewsAll();
	$activeStatus 	= $this->common_model->lov('ACTIVESTATUS');
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
											News
										</b>
									</h3>
								</div>
								<div class="col-md-6 text-right">
									
									
								</div>
							</div>
							<!-- Buttons end here -->
							
							<fieldset <?php echo $fieldSetDisabled;?>>
								
								<!-- Header Section Start Here-->
								<section class="header-section">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label news_title"><span class="text-danger">*</span>Title</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="news_title" id="news_title" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['news_title']) ? $editData[0]['news_title'] : NULL;?>" placeholder="Title">
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label short_description"><span class="text-danger">*</span> short_description</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="short_description" id="short_description" autocomplete="off" class="form-control" placeholder="short_description"><?php echo isset($editData[0]['short_description']) ? $editData[0]['short_description'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label client_name"><span class="text-danger">*</span>Client Name</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="client_name" id="client_name" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['client_name']) ? $editData[0]['client_name'] : NULL;?>" placeholder="Client Name">
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label background_banner_image"><span class="text-danger">*</span> Background Banner</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="background_banner_image" id="background_banner_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<!-- <span class="text-muted" >Note : Upload image size less than 100kb and less than 100x100 pixels</span> -->
														<span class="exist_error text-warning"></span>
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/news/background_banner/".$id.".png";
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
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label banner_image"><span class="text-danger">*</span> Banner Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="banner_image" id="banner_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<!-- <span class="text-muted" >Note : Upload image size less than 100kb and less than 100x100 pixels</span> -->
														<span class="exist_error text-warning"></span>
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/news/banner/".$id.".png";
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
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label news_image"><span class="text-danger">*</span> Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="news_image" id="news_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<!-- <span class="text-muted" >Note : Upload image size less than 100kb and less than 100x100 pixels</span> -->
														<span class="exist_error text-warning"></span>
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/news/".$id.".png";
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
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label start_date"><span class="text-danger">*</span> From Date</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" name="from_date" id="start_date" class="form-control" value="<?php echo isset($editData[0]['from_date']) ? date("d-M-Y",strtotime($editData[0]['from_date'])) : date("d-M-Y");?>" readonly placeholder="From Date">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label end_date">To Date</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" name="to_date" id="end_date" class="form-control previous_date" value="<?php echo isset($editData[0]['to_date']) ? date("d-M-Y",strtotime($editData[0]['to_date'])) : NULL;?>" readonly placeholder="To Date">
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
								<!-- Header Section End Here-->
								
								<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
								<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
								
								<script>
									$(document).ready(function() 
									{
										
										$("#start_date").datepicker({
											changeMonth: true,
											changeYear: true,
											yearRange: "1950:<?php echo date('Y') + 10; ?>",
											dateFormat: "dd-M-yy",
											onSelect: function(selectedDate) 
											{
												$("#end_date").datepicker("option", "minDate", selectedDate);
											}
										});

										$("#end_date").datepicker({
											changeMonth: true,
											changeYear: true,
											yearRange: "1950:<?php echo date('Y') + 10; ?>",
											dateFormat: "dd-M-yy",
											minDate: $("#start_date").val()
										});

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
											var news_title 				= $("#news_title").val();
											var short_description		= $("#short_description").val();
											var client_name				= $("#client_name").val();
											var news_image 				= $("#news_image").val();
											var background_banner_image	= $("#background_banner_image").val();
											var banner_image			= $("#banner_image").val();
											var start_date 				= $("#start_date").val();
											// var end_date     		= $("#end_date").val();
											var description 			= quill.root.innerHTML.trim();
											var sanitizedDescription 	= description.replace(/(<([^>]+)>|\s)+/g, "").trim();

											$("#description").val(description);

											var editor_images = [];
											$(quill.root).find('img').each(function () 
											{
												editor_images.push($(this).attr('src'));
											});

											$("#editor_images").val(JSON.stringify(editor_images)); 

											if (news_title.trim() !== "" && short_description.trim() !== "" && client_name.trim() !== "" && (type !== 'add' || news_image) && (type !== 'add' || background_banner_image) && (type !== 'add' || banner_image) && start_date !== "" && sanitizedDescription !== "") 
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

											var news_title 				= $("#news_title").val();
											var short_description		= $("#short_description").val();
											var client_name				= $("#client_name").val();
											var news_image 				= $("#news_image").val();
											var background_banner_image	= $("#background_banner_image").val();
											var banner_image			= $("#banner_image").val();
											var start_date  			= $("#start_date").val();
											// var end_date    			= $("#end_date").val();
											var description 			= quill.root.innerHTML.trim();
											var sanitizedDescription 	= description.replace(/(<([^>]+)>|\s)+/g, "").trim();

											$("#description").val(description);

											var editor_images = [];
											$(quill.root).find('img').each(function () 
											{
												editor_images.push($(this).attr('src'));
											});

											$("#editor_images").val(JSON.stringify(editor_images));

											if (news_title.trim() !== "" && short_description.trim() !== "" && client_name.trim() !== "" && (type !== 'add' || news_image) && (type !== 'add' || background_banner_image) && (type !== 'add' || banner_image) && start_date !== "" && sanitizedDescription !== "") 
											{
												$(".news_title").removeClass('errorClass');
												$(".short_description").removeClass('errorClass');
												$(".client_name").removeClass('errorClass');
												$(".news_image").removeClass('errorClass');
												$(".background_banner_image").removeClass('errorClass');
												$(".banner_image").removeClass('errorClass');
												$(".start_date").removeClass('errorClass');
												// $(".end_date").removeClass('errorClass');
												$(".description").removeClass('errorClass');
												return true;
											} 
											else {
												$(".form_submit_valid").prop('disabled', false); // Re-enable the button if validation fails

												if (news_title.trim() === "") 
												{
													$(".news_title").addClass('errorClass');
												}
												if (short_description.trim() === "") 
												{
													$(".short_description").addClass('errorClass');
												}
												if (client_name.trim() === "") 
												{
													$(".client_name").addClass('errorClass');
												}
												if (type === 'add' && !news_image) 
												{
													$(".news_image").addClass('errorClass');
												} 
												else 
												{
													$(".news_image").removeClass('errorClass');
												}
												if (type === 'add' && !background_banner_image) 
												{
													$(".background_banner_image").addClass('errorClass');
												} 
												else 
												{
													$(".background_banner_image").removeClass('errorClass');
												}
												if (type === 'add' && !banner_image) 
												{
													$(".banner_image").addClass('errorClass');
												} 
												else 
												{
													$(".banner_image").removeClass('errorClass');
												}

												if (start_date === "") {
													$(".start_date").addClass('errorClass');
												}
												// if (end_date === "") {
												// 	$(".end_date").addClass('errorClass');
												// }

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
											<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save & Continue" class="btn btn-primary btn-sm form_submit_valid">Save</button>
											<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm form_submit_valid">Submit</button>
										<?php 
									} 
								?>
								<a href="<?php echo base_url(); ?>news/manageNews" class="btn btn-default btn-sm">Close</a>
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
									<a href="<?php echo base_url(); ?>news/manageNews/add" class="btn btn-info btn-sm">
										Create News
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
							<div class="col-md-3">
								<div class="row">
									<label class="col-form-label col-md-4 text-right">News Title</label>
									<div class="form-group col-md-8">
										<select name="news_title" id="news_title" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getNews as $news)
												{
													$selected="";
													if(isset($_GET['news_title']) && $_GET['news_title'] == $news["news_title"] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $news["news_id"];?>" <?php echo $selected;?>><?php echo ucfirst($news["news_title"]);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-4 text-right">Status</label>
									<div class="form-group col-md-6">
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
								<a href="<?php echo base_url(); ?>news/manageNews" title="Clear" class="btn btn-default">Clear</a>
							</div>
						</div>
					</form>
					<!-- Filters end here -->
					
					<?php 
						if(isset($_GET) &&  !empty($_GET))
						{
							?>
							<!-- Page Item Show start -->
							<div class="row mt-3">
								<?php
									if( isset($resultData) && count($resultData) > 0 )
									{
										?>
											<div class="col-md-6">
												<?php /*
														<a href="<?php echo base_url().$this->redirectURL;?>&export=export" class="btn btn-primary btn-sm">Download Excel</a>
													*/
												?>
											</div>

											<div class="col-md-6 float-right text-right">
												<?php 
													$redirect_url = substr($_SERVER['REQUEST_URI'],'1');
												?>
												<input type="hidden" id="redirect_url" value="<?php echo $redirect_url; ?>"/>
																		
												<div class="filter_page">
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
										<?php
									}
								?>
							</div>
						    <!-- Page Item Show start -->

							<!-- Table start here -->
							<div class="new-scroller">
								<table id="myTable" class="table table-bordered table-hover tbl_height">
									<thead>
										<tr>
											<th class="text-center tab-md-100">control</th>
											<th class="text-left tab-md-140">Title</th>
											<th class="text-center tab-md-100">Image</th>
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
																						<a title="Edit" href="<?php echo base_url(); ?>news/manageNews/edit/<?php echo $row['news_id'];?>/">
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
																					<a title="View" href="<?php echo base_url(); ?>news/manageNews/view/<?php echo $row['news_id'];?>/">
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
																							<a class="unblock" href="<?php echo base_url(); ?>news/manageNews/status/<?php echo $row['news_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>news/manageNews/status/<?php echo $row['news_id'];?>/Y" title="Active">
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
													<td><?php echo $row['news_title'];?></td>
													<td class="text-center">
														<?php 
															if(isset($row['news_id']))
															{
																$url = "uploads/news/".$row['news_id'].".png";
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











