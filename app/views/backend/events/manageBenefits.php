<?php 
	$active_status	= $this->common_model->lov('ACTIVE-STATUS');
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

											Benefit
										</b>
									</h3>
								</div>
								<div class="col-md-6 text-right">
									<?php 
										if($type == "add" || $type == "edit")
										{
											?>
												<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save" class="btn btn-primary btn-sm">Save</button>
												<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm">Submit</button>
											<?php 
										} 
										
									?>
									
									<a href="<?php echo base_url(); ?>events/manageBenefits" class="btn btn-default btn-sm">Close</a>
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
														<label class="col-form-label event_id"><span class="text-danger">*</span> Category</label>
													</div>				
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<div class="input-wrapper">
															<input type="text" name="event_title" autocomplete="off" id="event_title" value="<?php echo isset($headerData[0]['event_title']) ? $headerData[0]['event_title'] : NULL; ?>" placeholder="Event Name" class="form-control">
															<input type="hidden" name="event_id" autocomplete="off" id="event_id" value="<?php echo isset($headerData[0]['event_id']) ? $headerData[0]['event_id'] : NULL; ?>" >
															<div id="EventTitleList"></div><!-- Clear icon start -->
																<?php 
																	if(isset($headerData[0]["event_id"]) && $headerData[0]["event_id"] !== '')
																	{
																		$styleDisplay = "display:block;";
																	}
																	else{
																		$styleDisplay = "display:none";
																	}
																	
																?>
															<span class="event_title_clear_icon" title="Clear" onclick="clearEventTitleSearchKeyword();" style="<?php echo $styleDisplay;?>">
																<i class="fa fa-times" aria-hidden="true"></i>
															</span>
														</div>
													</div>				
												</div>
											</div>
											
												<div class="row">
													<div class="col-md-4">
														<div class="form-group text-right">
															<label class="col-form-label title"><span class="text-danger">*</span> Title</label>
														</div>				
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<input type="text" name="title" id="title" placeholder="Title" class="form-control" value="<?php echo isset($headerData[0]['title']) ? $headerData[0]['title'] : NULL;?>">
														</div>				
													</div>
												</div>
											
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label benefit_image"><span class="text-danger">*</span> Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="benefit_image" id="benefit_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<span class="exist_error text-warning"></span>
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/events/benefits/".$id.".png";
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
										<!-- <span style="color:blue;">Currency : <?php //echo CURRENCY_CODE;?></span> -->
									</div>
								</div>
								<!-- Line level start here -->
								<section class="line-section sec_section mt-2">
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
													<th class="tab-md-130"><span class="text-danger">*</span> Line Title</th>
													<th class="tab-md-130">Line Description</th>
													<th class="tab-md-150 text-center"><span class="text-danger">*</span> Status</th>
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
																<tr class="remove_tr tabRow<?php echo $counter;?>">
																	<?php 
																		if($type == "add" || $type == "edit")
																		{
																			?>
																			<td class="tab-md-30 text-center">
																				
																				<input type="hidden" name="line_id[]" value="<?php echo isset($lineItems["line_id"]) ? $lineItems["line_id"] : 0;?>" id="line_id<?php echo $counter; ?>">
																				<input type="hidden" name="counter" value="<?php echo $counter; ?>">
																			</td>
																			<?php 
																		} 
																	?>
																	<td class="tab-md-85">
																		<input type="text" class="form-control" name="line_title[]" id="line_title<?php echo $counter;?>" value="<?php echo isset($lineItems["line_title"]) ? $lineItems["line_title"] : "";?>"></input>
																	</td>
																	<td class="tab-md-85">
																		<textarea class="form-control" name="line_description[]" id="line_description<?php echo $counter;?>"><?php echo isset($lineItems["line_description"]) ? $lineItems["line_description"] : "";?></textarea>
																	</td>
																	
																	
																	
																	<?php 
																		$isDisabled = ($type == "view" || $type == "add") ? "disabled" : ""; 
	
																		?>
																			<td class='text-center tab-md-100'>
																				<?php 
																					
																					if ($lineItems["active_flag"] == 'Y') 
																					{
																						?>
																							<label class="switch">
																								<input class="active_flag" name="active_flag[]" type="checkbox" checked <?php echo $isDisabled; ?> onclick="updateStatus(this, <?php echo $lineItems['line_id']; ?>)" id="active_status<?php echo $lineItems["line_id"]; ?>">
																								<div class="slider round"></div>
																							</label>
																						<?php 
																					} 
																					else 
																					{
																						?>
																							<label class="switch">
																								<input class="active_flag" name="active_flag[]" type="checkbox" <?php echo $isDisabled; ?> onclick="updateStatus(this, <?php echo $lineItems['line_id']; ?>)" id="active_status<?php echo $lineItems["line_id"]; ?>">
																								<div class="slider round"></div>
																							</label>
																						<?php 
																					}
																				?>
																				<!-- Hidden input for the status value -->
																				<input type="hidden" name="active_status[]" class="form-control" id="active_status<?php echo $lineItems['line_id']; ?>" value="<?php echo isset($lineItems['active_flag']) ? $lineItems['active_flag'] : 'Y'; ?>">

																			</td>
																		<?php
																		
																	?>
																	
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
										if($type != "view")
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
								<a href="<?php echo base_url(); ?>events/manageBenefits" class="btn btn-default btn-sm">Close</a>
							</div>

						</div>
					</form>
				   
					<script>
						
						function updateStatus(checkbox, id) 
						{
							let status = checkbox.checked ? 1 : 2; 
							
							let currentStatus = $('#active_status' + id).val();

							if (status === 1) 
							{
								$('#active_status' + id).val('Y');
							} 
							else 
							{
								if (currentStatus !== 'Y') {
									$('#active_status' + id).val(currentStatus + 'N');
								} else {
									$('#active_status' + id).val('N');
								}
							}

							$.ajax({
								type: "GET",
								url: "<?php echo base_url().'events/ajaxAvailableBenefits/status/';?>" + id + "/" + status,
								data: {}
							}).done(function(msg) 
							{
								toastr.success(msg);
							});
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

						function saveBtn(val) {
							var type 					= '<?php echo $type;?>';
							var event_id 				= $("#event_id").val();
							var title 					= $("#title").val();
							var benefit_image 			= $("#benefit_image").val();


							if (event_id && title && (type !== 'add' || benefit_image)) 
							{

								$(".event_id").removeClass('errorClass');
								$(".title").removeClass('errorClass');
								$(".benefit_image").removeClass('errorClass');

								// Check if line items are added
								if ($("#line_items tbody tr").length === 0) {
									Swal.fire({
										icon: 'error',
										title: 'Oops...',
										text: 'Please add at least one line level record.'
									});
									return false;
								}
								
								var lineIncomplete = false;
								$("table.line_items").find('tr').each(function () {
									var row 				= $(this);
									var line_title 			= row.find('input[name^="line_title[]"]').val();

									if (line_title === "") 
									{
										lineIncomplete = true;
										return false;
									}
								});

								if (lineIncomplete) {
									$('.line-items-error').text('Please fill the all required fields.')
										.animate({ opacity: '0.0' }, 2000)
										.animate({}, 1000)
										.animate({ opacity: '1.0' }, 2000);
									return false;
								}

								return true;
							} 
							else 
							{
								if (!event_id) $(".event_id").addClass('errorClass');
								else $(".event_id").removeClass('errorClass');

								if (!title) $(".title").addClass('errorClass');
								else $(".title").removeClass('errorClass');

								if (type === 'add' && !benefit_image) {
									$(".benefit_image").addClass('errorClass');
								} else {
									$(".benefit_image").removeClass('errorClass');
								}

								return false;
							}
						}

						function addLines(val) {
							if (val == 1) {
								var type 					= '<?php echo $type;?>';
								var event_id 				= $("#event_id").val();
								var title 					= $("#title").val();
								var benefit_image 			= $("#benefit_image").val();


								if (event_id && title && (type !== 'add' || benefit_image)) 
								{
									$(".event_id").removeClass('errorClass');
									$(".title").removeClass('errorClass');
									$(".benefit_image").removeClass('errorClass');
									addSOLines();
									return true;
								} 
								else 
								{
									
									if (!event_id) $(".event_id").addClass('errorClass');
									else $(".event_id").removeClass('errorClass');

									if (!title) $(".title").addClass('errorClass');
									else $(".title").removeClass('errorClass');

									if (type === 'add' && !benefit_image) {
										$(".benefit_image").addClass('errorClass');
									} else {
										$(".benefit_image").removeClass('errorClass');
									}

									return false;
								}
							}
						}

						function addSOLines()
						{
							$('.line-items-error').text('');
							//$('.line-items-error').hide();
							var flag = 0;
							
							$.ajax({
								url: "<?php echo base_url('products/keyFeaturesLineData'); ?>",
								type: "GET",
								data:{
									'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
								
								},
								datatype: "JSON",
								success: function(d)
								{
									data = JSON.parse(d);

									$("table.line_items").find('tr').each(function () 
									{
										var row 				= $(this);
										var line_title 			= row.find('input[name^="line_title[]"]').val();

										if (line_title === "") 
										{
											flag = 1;
										}
									});
								
									if(flag == 0)
									{
										var activeStatus 	= data['activeStatus'];

										var select_active_status = '';
										select_active_status += "<label class='switch'>";
										select_active_status += "<input type='checkbox' checked disabled name='active_flag[]' id='active_flag"+ counter +"' class='active_flag'>";
										select_active_status += "<div class='slider round'></div></label>";


										var newRow = $("<tr class='remove_tr tabRow"+counter+"'>");
										var cols = "";
										cols += "<td class='tab-md-30 text-center'><a class='deleteRow'><i class='fa fa-times-circle-o' style='color:#fb1b1b61;font-size:16px;'></i></a>"+
										"<input type='hidden' name='line_id[]' value='0' id='line_id"+counter+"'>"+
										"<input type='hidden' name='counter' id='counter"+counter+"' value='"+counter+"'></td>";
										
										cols += "<td class='tab-md-150'>" 
												+"<input type='text' class='form-control' name='line_title[]' id='line_title"+ counter +"' value=''></input>"
											+"</td>";

										cols += "<td class='tab-md-150'>" 
												+"<textarea class='form-control' rows='1' name='line_description[]' id='line_description"+ counter +"' value=''></textarea>"
											+"</td>";

									
									
										cols += '<td class="text-center tab-md-85">'+select_active_status+'<input type="hidden" name="active_status[]" id="active_status'+counter+'" value="Y"></td>';
										
										cols += "</tr>";

										newRow.html(cols);
										$("table.line_items").append(newRow);

										$(document).ready(function()
										{ 
											$(".searchDropdown").select2();
											
										});

										$(document).ready(function() {
        
											$('input[type="text"],input[type="search"],input[type="number"], textarea').on('input', function() 
											{
												const value = $(this).val();

												if (value.length > 0 && value[0] === ' ') 
												{
													$(this).val(value.trimStart());
												}
											});
										})

										i++;
										counter++;
									}
									else 
									{
										$('.line-items-error').text('Please fill the all required fields.').animate({opacity: '0.0'}, 2000).animate({}, 1000).animate({opacity: '1.0'}, 2000);
									}
								},
								error: function(xhr, status, error) {
									$('#err_product').text('Enter Product Code / Name').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
								}
							});
						}
						
						$("table.line_items").on("click", "a.deleteRow,a.deleteRow1", function(event) 
						{
							$(this).closest("tr").remove();
						});
						
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
							<a href="<?php echo base_url(); ?>events/manageBenefits/add" class="btn btn-info btn-sm">
								Create Benefit
							</a>
							
						</div>
					</div>
					<!-- Buttons end here -->
					
					<!-- Filters start here -->
					<form action="" class="form-validate-jquery" method="get">
						<div class="row mt-3">
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5">Event Name</label>
									<div class="form-group col-md-7">
										<div class="input-wrapper">
											<input type="text" name="event_title" autocomplete="off" id="event_title" value="<?php echo isset($_GET['event_title']) ? $_GET['event_title'] : NULL; ?>" placeholder="Event Title" class="form-control">
											<input type="hidden" name="event_id" autocomplete="off" id="event_id" value="<?php echo isset($_GET['event_id']) ? $_GET['event_id'] : NULL; ?>" >
											<div id="EventTitleList"></div><!-- Clear icon start -->
												<?php 
													if(isset($_GET["event_id"]) && $_GET["event_id"] !== '')
													{
														$styleDisplay = "display:block;";
													}
													else{
														$styleDisplay = "display:none";
													}
													
												?>
											<span class="event_title_clear_icon" title="Clear" onclick="clearEventNameSearchKeyword();" style="<?php echo $styleDisplay;?>">
												<i class="fa fa-times" aria-hidden="true"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5">Title</label>
									<div class="form-group col-md-7">
										<input type="text" name="title" autocomplete="off" id="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : NULL; ?>" placeholder="Title" class="form-control">
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
								<a href="<?php echo base_url(); ?>events/manageBenefits" title="Clear" class="btn btn-default">Clear</a>
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
												<th class="tab-md-140">Event Title</th>
												<th class="tab-md-140">Title</th>
												<th class="tab-md-100 text-center">Image</th>
												<th class="tab-md-100 text-center">Status</th>
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
															<div class="dropdown" style="width:90px;">
																<button type="button" class="btn btn-outline-info gropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
																	Action&nbsp;<i class="fa fa-chevron-down"></i>
																</button>
																<ul class="dropdown-menu dropdown-menu-right dropdown-menu-new">
																	<li>
																		<a href="<?php echo base_url(); ?>events/manageBenefits/edit/<?php echo $row['header_id'];?>" title="Edit">
																			<i class="fa fa-pencil"></i> Edit
																		</a>
																	</li>
																	
																	<li>
																		<a href="<?php echo base_url(); ?>events/manageBenefits/view/<?php echo $row['header_id'];?>" title="View">
																			<i class="fa fa-eye"></i> View
																		</a>
																	</li>
																	<li>
																		<?php 
																			if($row['active_flag'] == $this->active_flag)
																			{
																				?>
																				<a class="unblock" href="<?php echo base_url(); ?>events/manageBenefits/status/<?php echo $row['header_id'];?>/N" title="Inactive">
																					<i class="fa fa-ban"></i> Inactive
																				</a>
																				<?php 
																			} 
																			else
																			{  ?>
																				<a class="block" href="<?php echo base_url(); ?>events/manageBenefits/status/<?php echo $row['header_id'];?>/Y" title="Active">
																					<i class="fa fa-check"></i> Active
																				</a>
																				<?php 
																			} 
																		?>
																	</li>
																</ul>
															</div>
														</td>

														<td><?php echo ucfirst($row['event_title']);?></td>
														
														<td><?php echo ucfirst($row['title']);?></td>
													
														<td class="text-center">
															<?php 
																if(isset($row['header_id']))
																{
																	$url = "uploads/events/benefits/".$row['header_id'].".png";
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