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
											Product
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
									<a href="<?php echo base_url(); ?>products/manageProductDetails" class="btn btn-default btn-sm">Close</a>
									
								</div>
							</div>
							<!-- Buttons end here -->
							
							<fieldset <?php echo $fieldSetDisabled;?>>
								
								<!-- Header Section Start Here-->
								<section class="header-section">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label product_name"><span class="text-danger">*</span> Product Name</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<div class="input-wrapper">
															<input type="text" name="product_name" autocomplete="off" id="product_name" value="<?php echo isset($editData[0]['product_name']) ? $editData[0]['product_name'] : NULL; ?>" placeholder="Product Name" class="form-control">
															<input type="hidden" name="product_id" autocomplete="off" id="product_id" value="<?php echo isset($editData[0]['product_id']) ? $editData[0]['product_id'] : NULL; ?>" >
															<div id="ProductNameList"></div><!-- Clear icon start -->
																<?php 
																	if(isset($editData[0]["product_id"]) && !empty($editData[0]["product_id"]))
																	{
																		$styleDisplay = "display:block;";
																	}
																	else{
																		$styleDisplay = "display:none";
																	}

																	if(isset($type) && $type !== "view")
																	{
																		?>
																			<span class="product_name_clear_icon" title="Clear" onclick="clearProductNameSearchKeyword();" style="<?php echo $styleDisplay;?>">
																				<i class="fa fa-times" aria-hidden="true"></i>
																			</span>
																		<?php
																	}
																?>
															
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
														<input type="text" name="title" id="title" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['title']) ? $editData[0]['title'] : NULL;?>" placeholder="Title">
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label"><span class="text-danger">*</span> Description</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="title_description" id="title_description" rows="1" autocomplete="off" class="form-control" placeholder="Description"><?php echo isset($editData[0]['title_description']) ? $editData[0]['title_description'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label"><span class="text-danger">*</span> Why Choose Title</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="why_choose_title" id="why_choose_title" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['why_choose_title']) ? $editData[0]['why_choose_title'] : NULL;?>" placeholder="Why Choose Title">
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label"><span class="text-danger">*</span> Why Choose Jesperapps ?</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="why_choose_jesperapps" id="why_choose_jesperapps" rows="1" autocomplete="off" class="form-control" placeholder="Why Choose Jesperapps"><?php echo isset($editData[0]['why_choose_jesperapps']) ? $editData[0]['why_choose_jesperapps'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
											
											
										</div>
										<div class="col-md-6">
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label banner_image"><span class="text-danger">*</span> Banner Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="banner_image" id="banner_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/products/product_details/banner/".$id.".png";
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
														<label class="col-form-label product_details_image"><span class="text-danger">*</span> why Choose Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="product_details_image" id="product_details_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/products/product_details/".$id.".png";
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
														<label class="col-form-label remarks_title">Remarks Title</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="remarks_title" id="remarks_title" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['remarks_title']) ? $editData[0]['remarks_title'] : NULL;?>" placeholder="Remarks Title">
													</div>				
												</div>
											</div>	
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label">Remarks</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="remarks" id="remarks" rows="1" autocomplete="off" class="form-control" placeholder="Remarks"><?php echo isset($editData[0]['remarks']) ? $editData[0]['remarks'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
										</div>
									</div>	
								</section>
								<!-- Header Section End Here-->
								<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
								
								<script>
									$(document).ready(function () 
									{
										var type = '<?php echo $type; ?>';
										$(".form_submit_valid").prop('disabled', true);

										function validateForm() 
										{
											var product_id 					= $("#product_id").val();
											var title 						= $("#title").val();
											var title_description 			= $("#title_description").val();
											var banner_image 				= $("#banner_image").val();
											var why_choose_title 			= $("#why_choose_title").val();
											var why_choose_jesperapps 		= $("#why_choose_jesperapps").val();
											var banner_image 				= $("#banner_image").val();
											var product_details_image 		= $("#product_details_image").val();
											
											if (product_id.trim() !== "" && title.trim() !== "" && title_description.trim() !== "" && (type !== 'add' || banner_image) && why_choose_title.trim() !== "" && why_choose_jesperapps.trim() !== "" && (type !== 'add' || product_details_image)) 
											{
												$(".form_submit_valid").prop('disabled', false);
											} else {
												$(".form_submit_valid").prop('disabled', true);
											}
										}

										$("input, select, textarea").on('keyup change', function () {
											validateForm();
										});

										validateForm();

										function saveBtn(val) {
											$(".form_submit_valid").prop('disabled', true);

											var product_id 					= $("#product_id").val();
											var title 						= $("#title").val();
											var title_description 			= $("#title_description").val();
											var banner_image 				= $("#banner_image").val();
											var why_choose_title 			= $("#why_choose_title").val();
											var why_choose_jesperapps 		= $("#why_choose_jesperapps").val();
											var banner_image 				= $("#banner_image").val();
											var product_details_image 		= $("#product_details_image").val();
											
											if (product_id.trim() !== "" && title.trim() !== "" && title_description.trim() !== "" && (type !== 'add' || banner_image) && why_choose_title.trim() !== "" && why_choose_jesperapps.trim() !== "" && (type !== 'add' || product_details_image)) 
											{
												$(".form_submit_valid").prop('disabled', false);
												$(".product_id").removeClass('errorClass');
												$(".title").removeClass('errorClass');
												$(".title_description").removeClass('errorClass');
												$(".banner_image").removeClass('errorClass');
												$(".why_choose_title").removeClass('errorClass');
												$(".why_choose_jesperapps").removeClass('errorClass');
												$(".product_details_image").removeClass('errorClass');
												return true;
											} 
											else 
											{
												if (product_id.trim() === "") 
												{
													$(".product_name").addClass('errorClass');
												}

												if (title.trim() === "") 
												{
													$(".title").addClass('errorClass');
												}
											
												if (title_description.trim() === "") 
												{
													$(".title_description").addClass('errorClass');
												}

												if (type === 'add' && !banner_image) 
												{
													$(".banner_image").addClass('errorClass');
												} 

												if (why_choose_title.trim() === "") 
												{
													$(".why_choose_title").addClass('errorClass');
												}

												if (why_choose_jesperapps.trim() === "") 
												{
													$(".why_choose_jesperapps").addClass('errorClass');
												}
												if (type === 'add' && !product_details_image) 
												{
													$(".product_details_image").addClass('errorClass');
												} 
												else 
												{
													$(".product_details_image").removeClass('errorClass');
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
								<a href="<?php echo base_url(); ?>products/manageProductDetails" class="btn btn-default btn-sm">Close</a>
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
									<a href="<?php echo base_url(); ?>products/manageProductDetails/add" class="btn btn-info btn-sm">
										Create Product Detail
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
									<label class="col-form-label col-md-4 text-right">Product</label>
									<div class="form-group col-md-8">
										<div class="input-wrapper">
											<input type="text" name="product_name" autocomplete="off" id="product_name" value="<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : NULL; ?>" placeholder="Product Name" class="form-control">
											<input type="hidden" name="product_id" autocomplete="off" id="product_id" value="<?php echo isset($_GET['product_id']) ? $_GET['product_id'] : NULL; ?>" >
											<div id="ProductNameList"></div><!-- Clear icon start -->
												<?php 
													if(isset($_GET["product_id"]) && $_GET["product_id"] !== '')
													{
														$styleDisplay = "display:block;";
													}
													else{
														$styleDisplay = "display:none";
													}
													
												?>
											<span class="product_name_clear_icon" title="Clear" onclick="clearProductNameSearchKeyword();" style="<?php echo $styleDisplay;?>">
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


							<div class="col-md-2 text-left float-left">
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search"></i></button>
								<a href="<?php echo base_url(); ?>products/manageProductDetails" title="Clear" class="btn btn-default">Clear</a>
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
											<th class="tab-md-140">Product Name</th>
											<th class="tab-md-140">Title</th>
											<th class="tab-md-140">Title Description</th>
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
																						<a title="Edit" href="<?php echo base_url(); ?>products/manageProductDetails/edit/<?php echo $row['product_detail_id'];?>/">
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
																					<a title="View" href="<?php echo base_url(); ?>products/manageProductDetails/view/<?php echo $row['product_detail_id'];?>/">
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
																							<a class="unblock" href="<?php echo base_url(); ?>products/manageProductDetails/status/<?php echo $row['product_detail_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>products/manageProductDetails/status/<?php echo $row['product_detail_id'];?>/Y" title="Active">
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
													<td><?php echo ucfirst($row['product_name']);?></td>
													<td><?php echo ucfirst($row['title']);?></td>
													<td><?php echo ucfirst($row['title_description']);?></td>
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











