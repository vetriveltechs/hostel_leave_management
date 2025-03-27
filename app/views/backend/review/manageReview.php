<?php 
	$item_details 	= accessMenu(item_creation);
	$active_status	= $this->common_model->lov('ACTIVE-STATUS');
	$getReviewType	= $this->common_model->lov('REVIEW-TYPE');
	$getServiceType	= $this->common_model->lov('SERVICE-CONTACT-TYPE');


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
													echo ucfirst($type)." ";
												}
												else if($type == "view")
												{
													echo ucfirst($type)." ";
												}  

												
											?>
										Review </b>
									</h3>
								</div>
								<div class="col-md-6 text-right">
									
								</div>
							</div>
							<!-- Buttons end here -->
							
							<fieldset <?php echo $fieldSetDisabled;?>>

								<div class="row">
									<div class="col-md-12 header-filters">
										<a href="javascript:void(0)" class="filter-icons first_sec_hide" onclick="sectionShow('FIRST_SECTION','SHOW');">
											<i class="fa fa-chevron-circle-down"></i>
										</a>
										<a href="javascript:void(0)" class="filter-icons first_sec_show" onclick="sectionShow('FIRST_SECTION','HIDE');" style="display:none;">
											<i class="fa fa-chevron-circle-right"></i>
										</a>
										<h4 class="pl-1"><b>Header</b></h4>
									</div>
								</div>
								<!-- Header Section Start Here-->

								<section class="header-section first_section">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label review_type"><span class="text-danger">*</span> Review Type</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<?php 
														
														if ($type == 'edit') 
														{ 
															$review_type = 'pointer-events: none;';
															$searchDropdown = '';
														} else {
															$review_type = '';
														}
														?>
														<select name="review_type" id="review_type" class="form-control <?php echo $searchDropdown; ?>" style="<?php echo $review_type; ?>">
															<option value="">- Select -</option>
															<?php 
															foreach ($getReviewType as $reviewType) {
																$selected = '';
																// Set the selected attribute if the value matches
																if (isset($editData[0]['review_type']) && $editData[0]['review_type'] == $reviewType["list_code"]) {
																	$selected = "selected='selected'";
																}
																?>
																<option value="<?php echo $reviewType["list_code"]; ?>" <?php echo $selected; ?>>
																	<?php echo ucfirst($reviewType["list_value"]); ?>
																</option>
																<?php 
															}
															?>
														</select>

													</div>				
												</div>
											</div>
											<?php 
												if(isset($type) && $type=='edit' || $type=='view')
												{
													if($editData[0]['review_type']==='SERVICE-REVIEW')
													{
														$display ='show';
													}
													else
													{
														$display ='none';
													}
														
												}
												else{
													$display ='none';
												}
											?>
											
										</div>

										<div class="col-md-6">
											<div class="row service-type-row" style="display: <?php echo $display;?>;">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label service_type">Service Type </label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<select name="service_type" id="service_type" class="form-control <?php echo $searchDropdown; ?>">
															<option value="">- Select -</option>
															<?php 
															foreach ($getServiceType as $serviceType) {
																$selected = '';
																if (isset($editData[0]['service_type']) && $editData[0]['service_type'] == $serviceType["list_code"]) 
																{
																	$selected = "selected='selected'";
																}
																?>
																<option value="<?php echo $serviceType["list_code"]; ?>" <?php echo $selected; ?>>
																	<?php echo ucfirst($serviceType["list_value"]); ?>
																</option>
																<?php 
															}
															?>
														</select>
													</div>
												</div>
											</div>
										</div>

										

										
									</div>	
									
									
								</section>
								<!-- Header Section End Here-->
								
								<div class="row mb-3">
									<div class="col-md-6 header-filters">
										<a href="javascript:void(0)" class="filter-icons sec_sec_hide" onclick="sectionShow('SECOND_SECTION','SHOW');">
											<i class="fa fa-chevron-circle-down"></i>
										</a>
										<a href="javascript:void(0)" class="filter-icons sec_sec_show" onclick="sectionShow('SECOND_SECTION','HIDE');" style="display:none;">
											<i class="fa fa-chevron-circle-right"></i>
										</a>
										<h4 class="pl-1"><b>Lines</b></h4>
									</div>
									<div class="col-md-6 text-right float-right">
										
									</div>
								</div>

								<!-- Line level start here -->
								<!-- Line level start here -->
								<section class="line-section sec_section mt-2">
								
									<?php /*
										if($type == "add" || $type == "edit")
										{
											?>
											<div class="row mt-2 mb-3">
												<div class="col-md-6">
													<a href="javascript:void(0);" onclick="addLines(1);" class="btn btn-primary btn-sm">Add</a>
												</div>
											</div>
											<?php 
										} 
									*/ ?>
									<?php
									?>
									<div class="line-section-overflow">
										<table class="table table-bordered table-hover line_items" id="line_items">
											<thead>
												<tr>
													<?php 
														if($type == "add" || $type == "edit")
														{
															?>
															<th class="action-row tab-md-30"></th>
															<?php 
														} 
													?>
													<th class="tab-md-130"><span class="text-danger">*</span> Customer Name</th>
													<th class="tab-md-130"><span class="text-danger">*</span> Designation</th>
													<th class="tab-md-130"><span class="text-danger">*</span> Desription</th>
													<th class="tab-md-130" id="review_heading"><span class="text-danger">*</span> Review</th>
													<th class="tab-md-130" id="image_heading"><span class="text-danger">*</span> Image</th>
													<?php 
														if($type == "edit" && $editData[0]['review_type']=='SERVICE-REVIEW')
														{
															?>
																<th class="tab-md-130" ><span class="text-danger">*</span> Review</th>
															<?php 
														}
														if($type == "edit" && $editData[0]['review_type']=='COMMON-REVIEW')
														{
															?>
																<th class="tab-md-130" ><span class="text-danger">*</span> Image</th>
															<?php 
														}
													?>
													<th class="tab-md-150"><span class="text-danger">*</span> Status</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													if($type == "edit" || $type == "view")
													{
														if( count($lineData) > 0)
														{
															$counter = 1;
															$dropdownReadonly = "style='pointer-events: none'";
															foreach($lineData as $lineItems)
															{
																?>
																<tr class="remove_tr tabRow<?php echo $counter;?>" >
																	<?php 
																		if($type == "add" || $type == "edit")
																		{
																			?>
																				<td class="tab-md-30 text-center">
																					<input type="hidden" name="line_id[]" value="<?php echo isset($lineItems["line_id"]) ? $lineItems["line_id"] : 0;?>" id="line_id<?php echo $counter; ?>">
																					<input type="hidden" name="counter[]" id="counter<?php echo $counter; ?>" value="<?php echo $counter; ?>">
																				</td>
																			<?php 
																		} 
																	?>
																	<td class="tab-md-85">
																		<textarea class="form-control" name="customer_name[]" id="customer_name<?php echo $counter;?>"><?php echo isset($lineItems["customer_name"]) ? $lineItems["customer_name"] : "";?></textarea>
																	</td>
																	<td class="tab-md-85">
																		<textarea class="form-control" name="designation[]" id="designation<?php echo $counter;?>"><?php echo isset($lineItems["designation"]) ? $lineItems["designation"] : "";?></textarea>
																	</td>

																	<td class="tab-md-85">
																		<textarea class="form-control" name="description[]" id="description<?php echo $counter;?>"><?php echo isset($lineItems["description"]) ? $lineItems["description"] : "";?></textarea>
																	</td>
																	<?php 
																		if($type == "edit" && $editData[0]['review_type']=='SERVICE-REVIEW')
																		{
																			?>
																				<td class="tab-md-85">
																					<input type="text" class="form-control" name="review[]" id="review<?php echo $counter;?>" value="<?php echo isset($lineItems["review"]) ? $lineItems["review"] : "";?>">
																				</td>
																			<?php
																		}
																	?>
																	<?php 
																		if($type == "edit" && $editData[0]['review_type']=='COMMON-REVIEW')
																		{
																			?>
																				<td class="tab-md-85 text-center">
																					<input type="file" class="form-control" name="review_image[]" id="review_image<?php echo $counter;?>" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' --onchange='validateFileExtension(this,<?php echo $counter;?>)' value="<?php echo isset($lineItems["image_path"]) ? $lineItems["image_path"] : "";?>">
																					<span class='text-muted' ></span>
																					<?php
																						$url = "uploads/reviews/".$lineItems['image_path'];
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
																					?>

																				</td>
																			<?php
																		}
																	?>
																	
																	<td class='tab-md-50'>
																		<select class='form-control searchDropdown' name='active_flag[]' id='active_flag<?php echo $counter?>'>
																			<?php
																				foreach($active_status as $row)
																				{
																					$selected="";
																					if(isset($lineItems['active_flag']) && $lineItems['active_flag'] == $row["list_code"] )
																					{
																						$selected="selected='selected'";
																					}
																					?>
																					<option value="<?php echo $row["list_code"];?>" <?php echo $selected;?>><?php echo ucfirst($row["list_value"]);?></option>
																					<?php 
																				} 
																			?>
																		</select>
																	</td>
																</tr>
																
																<?php
																$counter++;
															} 
														} 
													}
												?>
											</tbody>
										</table>
									</div>
									
									<div class="row mt-2 mb-2">
										<div class="col-md-12">
											<div class="line-items-error"></div>
										</div>
									</div>

									<?php 
										if($type !== "view")
										{
											?>
											<div class="add-btns">
												<div class="row">
													<div class="col-md-6">
														<a href="javascript:void(0);" onclick="addLines(1);" class="btn btn-primary btn-sm">Add</a>
													</div>
													<div class="col-md-6 text-right">
														<a href="javascript:void(0);" onclick="addLines(1);" class="btn btn-primary btn-sm">Add</a>
													</div>
												</div>
											</div>
											<?php
										}
									?>


								</section>
								<!-- Line level end here -->
							</fieldset>
							<div class="col-md-12 mt-3 pr-0 text-right">
								<?php 
									if($type == "add" || $type == "edit")
									{
										?>
										<!-- <a href="javascript:void(0)" id="save_btn" onclick="return saveBtn('save_btn','save');" class="btn btn-primary btn-sm submit_btn_bottom">Save Bottom</a> -->
										<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save & Continue" class="btn btn-primary btn-sm">Save</button>
										<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm">Submit</button>
										<?php 
									} 
								?>
								<a href="<?php echo base_url(); ?>review/manageReview" class="btn btn-default btn-sm">Close</a>
							</div>

						</div>
					</form>
				   
					<script>
						$(document).ready(function () {
							$('#review_heading').hide();
							$('#image_heading').hide();

							$('#review_type').change(function (e) 
							{
								const reviewTypeValue = $('#review_type').val()
								if (reviewTypeValue === 'SERVICE-REVIEW') 
								{
									$('.service-type-row').show();
								} 
								else {
									$('.service-type-row').hide();
								}

								$('.remove_tr').remove();
								$('.line-items-error').text('');
								$('#review_heading').hide();
								$('#image_heading').hide();
							});
						});
						function saveBtn(val) 
						{
							var type = '<?php echo $type;?>';

                            if ($("#line_items tbody tr").length === 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Please add at least one line level record.'
                                });
                                return false;
                            }

                            var lineIncomplete = false;
                            var quantityError = false;
                            $("table.line_items").find('tr').each(function () 
                            {
								
								var row 			= $(this);
								var customer_name  	= row.find('input[name^="customer_name[]"]').val();
								var designation    	= row.find('textarea[name^="designation[]"]').val();
								var description    	= row.find('textarea[name^="description[]"]').val();
								var review_image   	= row.find('input[name^="review_image[]"]').val();
								var review   		= row.find('input[name^="review[]"]').val();


								var review_type = $('#review_type').val();

								if (customer_name === "" || designation === "" || description === "") {
									lineIncomplete = true;
								}

								if (review_type === 'COMMON-REVIEW' && review_image === "" && type!='edit') 
								{
									lineIncomplete = true;
								} 
								else if (review_type === 'SERVICE-REVIEW' && review === "") 
								{
									var service_type = $("#service_type").val();

									if (service_type !== "") {
										$(".service_type").removeClass('errorClass');
									} else {
										$(".service_type").addClass('errorClass');
										return false;
									}

									lineIncomplete = true;
								}

                            });

                            if (lineIncomplete) {
                                $('.line-items-error').text('Please fill the all required fields.').animate({opacity: '0.0'}, 2000).animate({}, 1000).animate({opacity: '1.0'}, 2000);

                                return false;
                            }
                            return true;
						}
						
						
						
						var counter = 1;

						var type = '<?php echo $type;?>';

						if(type == 'add')
						{
							var counter = 1;
							var i=1;
						}
						else if(type == 'edit')
						{
							var counter = '<?php echo isset($lineData) ? count($lineData) + 1 : 1; ?>';
							var i = '<?php echo isset($lineData) ? count($lineData) + 1 : 1; ?>';
						}

						function addLines(val) 
						{
							if (val === 1) 
							{
								var review_type = $("#review_type").val();

								if (review_type) 
								{
									$(".review_type").removeClass('errorClass');

									if (review_type === 'COMMON-REVIEW') 
									{
										if(type==='add'){
											$('#review_heading').hide();
											$('#image_heading').show();
										}
										else{
											$('#review_heading').hide();
											$('#image_heading').hide();
										}
										addSOLines();
										return true;
									} 
									if (review_type === 'SERVICE-REVIEW')
									{
										if(type==='add'){
											$('#review_heading').show();
											$('#image_heading').hide();
										}
										addSOLines();
										return false;
									}
								}
								else
								{
									$(".review_type").addClass('errorClass');
								}
							} 
							else {
								$(".review_type").addClass('errorClass');
								return false;
							}
						}



						// Function to add new rows
						function addSOLines() {
							$('.line-items-error').text('');
							var flag = 0;

							var reviewType = $('#review_type').val();
							
							$("table.line_items").find('tr').each(function () {
								var row = $(this);
								var customer_name = row.find('input[name^="customer_name[]"]').val();
								var designation = row.find('textarea[name^="designation[]"]').val();
								var description = row.find('textarea[name^="description[]"]').val();
								var review_image = row.find('input[name^="review_image[]"]').val();
								var review   		= row.find('input[name^="review[]"]').val();


								var review_type = $('#review_type').val();

								if (customer_name === "" || designation === "" || description === "") {
									flag = 1;
								}

								if (review_type === 'COMMON-REVIEW' && review_image === "" && type!='edit') 
								{
									flag = 1;
								} 
								else if (review_type === 'SERVICE-REVIEW' && review === "") 
								{
									var service_type = $("#service_type").val();

									if (service_type !== "") {
										$(".service_type").removeClass('errorClass');
									} else {
										$(".service_type").addClass('errorClass');
										flag = 1;
									}

									flag = 1;
								}
								
							});

							if (flag === 0) {
								$.ajax({
									url: "<?php echo base_url('review/getReviewLines'); ?>",
									type: "GET",
									data: {
										'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
									},
									dataType: "JSON",
									success: function (data) {
										var activeStatus = data['activeStatus'];
										var newRow = $("<tr class='remove_tr tabRow" + counter + "'>");
										var cols = "";

										cols += "<td class='tab-md-30 text-center'><a class='deleteRow'><i class='fa fa-times-circle-o' style='color:#fb1b1b61;font-size:16px;'></i></a>" +
											"<input type='hidden' name='line_id[]' value='0' id='line_id" + counter + "'>" +
											"<input type='hidden' name='counter' id='counter" + counter + "' value='" + counter + "'></td>";

										cols += "<td class='tab-md-150'>" +
											"<input type='text' class='form-control' name='customer_name[]' id='customer_name" + counter + "' value=''>" +
											"</td>";

										cols += "<td class='tab-md-150'>" +
											"<textarea class='form-control' rows='1' name='designation[]' id='designation" + counter + "'></textarea>" +
											"</td>";

										cols += "<td class='tab-md-150'>" +
											"<textarea class='form-control' rows='1' name='description[]' id='description" + counter + "'></textarea>" +
											"</td>";

										if(reviewType=='SERVICE-REVIEW')
										{
											cols += "<td class='tab-md-150'>" +
											"<input type='text' class='form-control review' name='review[]' id='review" + counter + "' value='' oninput='limitValue(this.value, " + counter + ")'>" +
											"</td>";

										}

										if(reviewType=='COMMON-REVIEW')
										{
											cols += "<td class='tab-md-150'>" +
											"<input type='file' class='form-control' name='review_image[]' id='review_image" + counter + "' onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp'>" +
											"<span class='text-muted'></span>" +
											"</td>";
										}
										

										cols += "<td class='tab-md-150'>" +
											"<select class='form-control searchDropdown' id='active_flag" + counter + "' name='active_flag[]'>" +
											activeStatus +
											"</select>" +
											"</td>";

										newRow.html(cols);
										$("table.line_items").append(newRow);

										$(".searchDropdown").select2(); // Initialize dropdown
										counter++;
										i++;
									},
									error: function () {
										$('.line-items-error').text('Error while fetching review lines.');
									}
								});
							} else {
								$('.line-items-error').text('Please fill the all required fields.').animate({ opacity: '0.0' }, 2000).animate({}, 1000).animate({ opacity: '1.0' }, 2000);
							}
						}
						$("table.line_items").on("click", "a.deleteRow,a.deleteRow1", function(event) 
						{
							$(this).closest("tr").remove();
						});

                        function limitValue(val, counter) {
							val = val.replace(/\D/g, '');

							var numValue = Number(val);

							if (numValue > 5) 
							{
								$('#review' + counter).val('5');
							} 
							else 
							{
								$('#review' + counter).val(numValue);
							}
						}

						function validateFileExtension(fld, count) {
							
							var fileUpload = fld;

							if (typeof (fileUpload.files) !== "undefined") {
								var file = fileUpload.files[0];
								var size = parseFloat(file.size / 1024).toFixed(2);  // Convert size to KB
								var validSize = 1024 * 2;  // 2MB limit
								var maxWidth = 426;
								var maxHeight = 425;

								// Check file size
								if (size > validSize) {
									alert("Image upload size is 2 MB");
									$('#review_image' + count).val('');  // Clear the input if invalid
									return false;
								}

								// Check file type
								if (!/(\.png|\.bmp|\.gif|\.jpg|\.jpeg)$/i.test(fileUpload.value)) {
									alert("Invalid image file type.");
									$('#review_image' + count).val('');  // Clear the input if invalid
									return false;
								}

								// Create an image object to check dimensions
								var img = new Image();
								img.onload = function () {
									// var width = this.width;
									// var height = this.height;

									// // Validate dimensions
									// if (width !== maxWidth || height !== maxHeight) {
									// 	alert('Image dimensions should be exactly ' + maxWidth + 'x' + maxHeight + ' pixels.');
									// 	$('#review_image' + count).val('');  // Clear the input if invalid
									// 	return false;
									// }

									// If all validations pass, you can proceed
									return true;
								};

								// Set the source of the image to the uploaded file to trigger the onload event
								img.src = URL.createObjectURL(file);
							}

							return true;  // Assume validation passes unless caught by the above checks
						}

                                                
					</script>
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
								if($item_details['create_edit_only'] == 1 || $this->user_id == 1)
								{
									?>
									<a href="<?php echo base_url(); ?>review/manageReview/add" class="btn btn-info btn-sm">
										Create Review
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
									<label class="col-form-label col-md-5">Review Type</label>
									<div class="form-group col-md-7">
										<select name="review_type" id="review_type" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getReviewType as $reviewType)
												{
													$selected="";
													if(isset($_GET['review_type']) && $_GET['review_type'] == $reviewType["list_code"] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $reviewType["list_code"];?>" <?php echo $selected;?>><?php echo ucfirst($reviewType["list_value"]);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5"><span class="text-danger">*</span> Status</label>
									<div class="form-group col-md-7">
										<?php 
											$activeStatus = $this->common_model->lov('ACTIVESTATUS');
										?>
										
										<select name="active_flag" id="active_flag" class="form-control searchDropdown">
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
						</div>

						<div class="row">
							<div class="col-md-12 text-right float-right">
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="<?php echo base_url(); ?>review/manageReview" title="Clear" class="btn btn-default">Clear</a>
							</div>
						</div>

						<!-- <div class="row my-3">
							<div class="col-md-12 text-right">
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="<?php echo base_url(); ?>review/manageReview" title="Clear" class="btn btn-default">Clear</a>
							</div>

						</div> -->
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
												<div class="col-md-10">
											
												</div>
		
												<div class="col-md-2 float-right text-right">
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
												<th class="text-center">Controls</th>
												<th class="tab-md-140">Review Type</th>
												<th class="tab-md-100 text-center">Image</th>
												<th class="tab-md-140 text-center">Review</th>
												<th class="tab-md-140 text-center">Status</th>
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
														<td  class='text-center' style="width:90px;">
															<?php
																if($item_details['create_edit_only'] == 1 || $item_details['read_only'] == 1 || $this->user_id == 1)
																{
																	?>
																	<div class="dropdown" style="width:90px;">
																		<button type="button" class="btn btn-outline-info gropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
																			Action&nbsp;<i class="fa fa-chevron-down"></i>
																		</button>
																		<ul class="dropdown-menu dropdown-menu-right dropdown-menu-new">
																			
																			<?php
																				if($item_details['create_edit_only'] == 1 || $this->user_id == 1)
																				{
																					?>
																					<li>
																						<a href="<?php echo base_url(); ?>review/manageReview/edit/<?php echo $row['header_id'];?>">
																							<i class="fa fa-pencil"></i> Edit
																						</a>
																					</li>
																					<?php 
																				} 
																			?>

																			<?php
																				if($item_details['read_only'] == 1 || $this->user_id == 1)
																				{
																					?>
																					<li>
																						<a href="<?php echo base_url(); ?>review/manageReview/view/<?php echo $row['header_id'];?>">
																							<i class="fa fa-eye"></i> View
																						</a>
																					</li>

																					<?php 
																				} 
																			?>	
                                                                            <?php
																			if($item_details['create_edit_only'] == 1 || $this->user_id == 1)
																			{
																				?>
																				<li>
																					<?php 
																						if($row['active_flag'] == $this->active_flag)
																						{
																							?>
																							<a class="unblock" href="<?php echo base_url(); ?>review/manageReview/status/<?php echo $row['header_id'];?>/N" title="Active">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>review/manageReview/status/<?php echo $row['header_id'];?>/Y" title="InActive">
																								<i class="fa fa-check"></i> Active
																							</a>
																							<?php 
																						} 
																					?>
																				<li>
																				<?php 
																			} 
																		?>		
																		</ul>
																	</div>
																	<?php 
																}else{
																	?>
																	--
																	<?php
																} 
															?>
														</td>
														<td><?php echo $row['review_type']; ?></td>

														<?php 
															if($review_type=='COMMON-REVIEW')
															{
																?>
																	<td class="text-center">
																		<?php 
																			if(isset($row['image_path']))
																			{
																				$url = "uploads/reviews/".$row['image_path'];
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
																<?php
															}
															else{
																?>
																	<td class="text-center">--</td>
																<?php
															}
														?>
														<?php 
															if($review_type=='SERVICE-REVIEW')
															{
																?>
																	<td class="text-center"><?php echo $row['review']; ?></td>
																<?php
															}
															else{
																?>
																	<td class="text-center">--</td>
																<?php
															}
														?>

														
														
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