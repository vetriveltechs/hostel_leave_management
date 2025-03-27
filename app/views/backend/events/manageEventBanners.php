<?php 
	$active_status			= $this->common_model->lov('ACTIVE-STATUS');

	$activeStatus			= $this->common_model->lov('ACTIVESTATUS');
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

											Overview
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
									
									<a href="<?php echo base_url(); ?>events/manageEventBanners" class="btn btn-default btn-sm">Close</a>
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
														<label class="col-form-label title"><span class="text-danger">*</span> Title</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="title" id="title" placeholder="Title" class="form-control" value="<?php echo isset($headerData[0]['title']) ? $headerData[0]['title'] : NULL;?>"></input>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label description"><span class="text-danger">*</span> Description</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="description" id="description" rows="1" required autocomplete="off" class="form-control" placeholder="Description"><?php echo isset($headerData[0]['description']) ? $headerData[0]['description'] :"";?></textarea>
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
															<th class="action-row" style="width:100px"></th>
															<?php 
														} 
													?>
													<th class="tab-md-130"><span class="text-danger">*</span> Order Sequence</th>
													<th class="tab-md-130"><span class="text-danger">*</span> Image</th>
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
																		<input type="text" class="form-control" name="order_sequence[]" id="order_sequence<?php echo $counter;?>" value="<?php echo isset($lineItems['order_sequence']) ? $lineItems['order_sequence'] : ''; ?>" oninput="validateNumber(this)">
																	</td>

																	
																	<td class="tab-md-85">
																		<input type="file" name="banner_image[]" id="banner_image<?php echo $counter; ?>" class="form-control singleImage" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp'>
																		<?php 
																			if( ($type == "edit" || $type == "view") && isset($lineItems["line_id"]))
																			{
																				$url = "uploads/events/event_banners/".$lineItems["line_id"].".png";
																				if(file_exists($url))
																				{
																					?>
																					<a href="<?php echo base_url(). $url; ?>" target="_blank" class="pull-right" title="View Image">
																						<i class="fa fa-eye text-primary"></i> 
																					</a>
																					
																					<?php 
																				}
																			} 
																		?>
																	</td>
																	
																	<?php 
																		
																			?>
																				<td class='text-center tab-md-100'>
																					<?php 
																						$isDisabled = ($type == "view" || $type == "add") ? "disabled" : ""; 
																						
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
										<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save" class="btn btn-primary btn-sm">Save</button>
										<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm">Submit</button>
										<?php 
									} 
								?>
								<a href="<?php echo base_url(); ?>events/manageEventBanners" class="btn btn-default btn-sm">Close</a>
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
								url: "<?php echo base_url().'events/ajaxAvailableBanner/status/';?>" + id + "/" + status,
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
							var title 					= $("#title").val();
							var description 			= $("#description").val();


							if (title && description) 
							{
								$(".title").removeClass('errorClass');
								$(".description").removeClass('errorClass');

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
									var order_sequence 		= row.find('input[name^="order_sequence[]"]').val();
									var banner_image    	= row.find('input[name^="banner_image[]"]').val();

									if (order_sequence === "" || (banner_image === "" && type !== 'edit')) 
									{
										lineIncomplete = true;
										return false;
									}
								});

								if (lineIncomplete) {
									$('.line-items-error').text('Please fill in all required fields.')
										.animate({ opacity: '0.0' }, 2000)
										.animate({}, 1000)
										.animate({ opacity: '1.0' }, 2000);
									return false;
								}

								return true;
							} else {
								
								if (!title) $(".title").addClass('errorClass');
								else $(".title").removeClass('errorClass');

								if (!description) $(".description").addClass('errorClass');
								else $(".description").removeClass('errorClass');


								return false;
							}
						}

						function addLines(val) {
							if (val == 1) {
								var type 					= '<?php echo $type;?>';
								var title 					= $("#title").val();
								var description 			= $("#description").val();

								if (title && description) 
								{
									$(".title").removeClass('errorClass');
									$(".description").removeClass('errorClass');
									addSOLines();
									return true;
								} 
								else 
								{
									if (!title) $(".title").addClass('errorClass');
									else $(".title").removeClass('errorClass');

									if (!description) $(".description").addClass('errorClass');
									else $(".description").removeClass('errorClass');

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
								url: "<?php echo base_url('admin/getLineActiveStatus'); ?>",
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
										var order_sequence 		= row.find('input[name^="order_sequence[]"]').val();
										var banner_image   	= row.find('input[name^="banner_image[]"]').val();

										if (order_sequence === "" || (banner_image === "" && type !== 'edit')) 
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
											+"<input type='text' class='form-control' name='order_sequence[]' id='order_sequence"+ counter +"' value='' oninput='validateNumber(this)'>"
										+"</td>";

										cols += "<td class='tab-md-150'>" 
											+"<input type='file' class='form-control' name='banner_image[]' id='banner_image"+ counter +"' value='' onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp'></input>"
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

						function validateNumber(inputElement) 
						{
							inputElement.value = inputElement.value.replace(/\D/g, '');
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
							<a href="<?php echo base_url(); ?>events/manageEventBanners/add" class="btn btn-info btn-sm">
								Create Event Banner
							</a>
							
						</div>
					</div>
					<!-- Buttons end here -->
					
					<div class="row mt-1 mb-3">
						<div class="col-md-6" style="font-size:14px;">
							<a href="javascript:void(0);" onclick="showFilter();">
								<i class="fa fa-filter" aria-hidden="true"></i> <b>Search</b>
							</a>
						</div>
					</div>

					<?php
						if( isset($_GET) && !empty($_GET))
						{
							$displaySearch = 'style="display:block;"';
						}
						else
						{
							$displaySearch = 'style="display:none;"';
						}
					?>
					<div class="search-form" <?php #echo $displaySearch;?>>
						<!-- Filters start here -->
						<form action="" class="form-validate-jquery" method="get">
							<div class="row mt-3">
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
								<div class="col-md-2">
									<button type="submit" class="btn btn-info">Search <i class="fa fa-search" aria-hidden="true"></i></button>
									<a href="<?php echo base_url(); ?>events/manageEventBanners" title="Clear" class="btn btn-default">Clear</a>
								</div>
							</div>

							
							
						</form>
					</div>
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
									<table --id="myTable" class="table table-bordered table-hover tbl_height">
										<thead>
											<tr>
												<th class="text-center">Controls</th>
												<th class="tab-md-200">Title</th>
												<th class="tab-md-100 text-center">Description</th>
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
																		<a href="<?php echo base_url(); ?>events/manageEventBanners/edit/<?php echo $row['header_id'];?>">
																			<i class="fa fa-pencil"></i> Edit
																		</a>
																	</li>
																	
																	<li>
																		<a href="<?php echo base_url(); ?>events/manageEventBanners/view/<?php echo $row['header_id'];?>">
																			<i class="fa fa-eye"></i> View
																		</a>
																	</li>

																	<li>
																		<?php 
																			if($row['active_flag'] == $this->active_flag)
																			{
																				?>
																				<a class="unblock" href="<?php echo base_url(); ?>events/manageEventBanners/status/<?php echo $row['header_id'];?>/N" title="Inactive">
																					<i class="fa fa-ban"></i> Inactive
																				</a>
																				<?php 
																			} 
																			else
																			{  ?>
																				<a class="block" href="<?php echo base_url(); ?>events/manageEventBanners/status/<?php echo $row['header_id'];?>/Y" title="Active">
																					<i class="fa fa-check"></i> Active
																				</a>
																				<?php 
																			} 
																		?>
																	</li>
																</ul>
															</div>
														</td>
														<td><?php echo ucfirst($row['title']);?></td>
														<td class="text-center">
															<?php echo ucfirst($row['description']);?>
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