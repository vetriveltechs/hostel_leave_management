<?php 
	$physical_stock_adjustment = accessMenu(physical_stock_adjustment);

	$getProducts 	= $this->products_model->getProductsAll();
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
											Industry
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
									<a href="<?php echo base_url(); ?>industries/manageIndustries" class="btn btn-default btn-sm">Close</a>
									
								</div>
							</div>
							<!-- Buttons end here -->
							
							<fieldset <?php echo $fieldSetDisabled;?>>
								
								<!-- Header Section Start Here-->
								<section class="header-section">
									<div class="row">
										<div class="col-md-6">
											<input type="hidden" name="industries_code" id="industries_code" class="form-control" value="">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label industries_name"><span class="text-danger">*</span> Industries Name</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="industries_name" id="industries_name" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['industries_name']) ? $editData[0]['industries_name'] : NULL;?>" placeholder="Industries Name">
													</div>				
												</div>
											</div>
											<?php /*
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label industries_code"><span class="text-danger">*</span> Industries Code</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="industries_code" id="industries_code" <?php echo $this->validation;?> autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['industries_code']) ? $editData[0]['industries_code'] : NULL;?>" placeholder="Industries Code">
													</div>				
												</div>
												<script>
													$(document).ready(function() {
														$('#industries_code').on('input', function () 
														{
															let value = $(this).val();

															value = value.toUpperCase().replace(/^\s+/, '').replace(/\s+/g, ' ');

															$(this).val(value);
														});
													});
												</script>
											</div>
											*/ ?>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label banner_title"><span class="text-danger">*</span> Banner Title</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="banner_title" id="banner_title" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['banner_title']) ? $editData[0]['banner_title'] : NULL;?>" placeholder="Banner Title">
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label overview"><span class="text-danger">*</span> Overview</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="overview" id="overview" autocomplete="off" class="form-control" rows="1" placeholder="Overview"><?php echo isset($editData[0]['overview']) ? $editData[0]['overview'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label video_link"><span class="text-danger">*</span> video_link</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="video_link" id="video_link" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['video_link']) ? $editData[0]['video_link'] : NULL;?>" placeholder="Video Link">
													</div>				
												</div>
											</div>
										</div>
										<div class="col-md-6">
											
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label description"><span class="text-danger">*</span> Banner Description</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="description" id="description" autocomplete="off" class="form-control" rows="1" placeholder="Description"><?php echo isset($editData[0]['description']) ? $editData[0]['description'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
											
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label industries_image"><span class="text-danger">*</span> Banner Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="industries_image" id="industries_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/industries/".$id.".png";
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
														<label class="col-form-label overview_image"><span class="text-danger">*</span> Overview Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="overview_image" id="overview_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/industries/overview_image/".$id.".png";
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
									</div>	
								</section>
								<!-- Header Section End Here-->
								
								<script>
									$(document).ready(function() {
										var type = '<?php echo $type; ?>';

										$(".form_submit_valid").prop('disabled', true);

										function validateForm() 
										{
											var industries_name 	= $("#industries_name").val();
											var banner_title 		= $("#banner_title").val();
											var description			= $("#description").val();
											var industries_image	= $("#industries_image").val();
											var overview			= $("#overview").val();
											var overview_image		= $("#overview_image").val();
											var video_link			= $("#video_link").val();
											
											if (industries_name.trim() !== "" && description.trim() !== "" && banner_title.trim() !== "" && (type !== 'add' || industries_image) && overview.trim() !== "" && (type !== 'add' || overview_image) && video_link.trim() !== "") 
											{
												$(".form_submit_valid").prop('disabled', false); 
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', true); 
											}
										}

										$("input,textarea").on('keyup change', function() { 
											validateForm();
										});

										validateForm();

										function saveBtn(val) 
										{
											$(".form_submit_valid").prop('disabled', true);

											var industries_name 	= $("#industries_name").val();
											var banner_title 		= $("#banner_title").val();
											var description			= $("#description").val();
											var industries_image	= $("#industries_image").val();
											var overview			= $("#overview").val();
											var overview_image		= $("#overview_image").val();
											var video_link			= $("#video_link").val();
											
											if (industries_name.trim() !== "" && description.trim() !== "" && banner_title.trim() !== "" && (type !== 'add' || industries_image) && overview.trim() !== "" && (type !== 'add' || overview_image) && video_link.trim() !== "") 
											{
												$(".industries_name").removeClass('errorClass');
												$(".banner_title").removeClass('errorClass');
												$(".description").removeClass('errorClass');
												$(".industries_image").removeClass('errorClass');
												$(".overview").removeClass('errorClass');
												$(".overview_image").removeClass('errorClass');
												$(".video_link").removeClass('errorClass');
												return true;
											} 
											else {
												$(".form_submit_valid").prop('disabled', false); // Re-enable the button if validation fails

												// if (industries_code.trim() === "") 
												// {
												// 	$(".industries_code").addClass('errorClass');
												// }
												if (industries_name.trim() === "") 
												{
													$(".industries_name").addClass('errorClass');
												}
												if (banner_title.trim() === "") 
												{
													$(".banner_title").addClass('errorClass');
												}
												if (description.trim() === "") 
												{
													$(".description").addClass('errorClass');
												}
												if (type === 'add' && !industries_image) 
												{
													$(".industries_image").addClass('errorClass');
												} 
												if (overview.trim() === "") 
												{
													$(".overview").addClass('errorClass');
												}
												if (type === 'add' && !overview_image) 
												{
													$(".overview_image").addClass('errorClass');
												}
												if (video_link.trim() === "") 
												{
													$(".video_link").addClass('errorClass');
												} 
												
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
								<a href="<?php echo base_url(); ?>industries/manageIndustries" class="btn btn-default btn-sm">Close</a>
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
									<a href="<?php echo base_url(); ?>industries/manageIndustries/add" class="btn btn-info btn-sm">
										Create Industries
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
									<label class="col-form-label col-md-6 text-right">Industries Name</label>
									<div class="form-group col-md-6">
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
								<a href="<?php echo base_url(); ?>industries/manageIndustries" title="Clear" class="btn btn-default">Clear</a>
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
											<th class="tab-md-140">Industries Name</th>
											<th class="tab-md-160">Title</th>
											<th class="tab-md-160">Overview</th>
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
																						<a title="Edit" href="<?php echo base_url(); ?>industries/manageIndustries/edit/<?php echo $row['industries_id'];?>/">
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
																					<a title="View" href="<?php echo base_url(); ?>industries/manageIndustries/view/<?php echo $row['industries_id'];?>/">
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
																							<a class="unblock" href="<?php echo base_url(); ?>industries/manageIndustries/status/<?php echo $row['industries_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>industries/manageIndustries/status/<?php echo $row['industries_id'];?>/Y" title="Active">
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
													<td class="text-center">
														<?php 
															echo ucfirst($row['banner_title']);
														?>
													</td>
													<td class="text-center">
														<?php 
															echo ucfirst($row['overview']);
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











