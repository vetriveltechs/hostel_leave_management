<?php 
	$physical_stock_adjustment 	= accessMenu(physical_stock_adjustment);
	$getProductCategory 		= $this->common_model->lov('PRODUCT-CATEGORY');
	$getProducts 				= $this->products_model->getProductsAll();
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
											Product
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
											<?php /*
												<div class="row">
													<div class="col-md-3">
														<div class="form-group text-right">
															<label class="col-form-label product_category"><span class="text-danger">*</span> Category</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<select name="product_category" id="product_category" class="form-control <?php echo $searchDropdown;?>">
																<option value="">- Select -</option>
																<?php
																	foreach($getProductCategory as $productCategory)
																	{
																		$selected="";
																		if(isset($editData[0]['product_category']) && $editData[0]['product_category'] == $productCategory["list_code"] )
																		{
																			$selected="selected='selected'";
																		}
																		?>
																		<option value="<?php echo $productCategory["list_code"];?>" <?php echo $selected;?>><?php echo ucfirst($productCategory["list_value"]);?></option>
																		<?php
																	}
																?>
															</select>
														</div>
													</div>
												</div>
											*/ ?>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label product_name"><span class="text-danger">*</span> Product Name</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="product_name" id="product_name" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['product_name']) ? $editData[0]['product_name'] : NULL;?>" placeholder="Product Name">
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label description">Description</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<textarea name="description" id="description" autocomplete="off" class="form-control" placeholder="Description"><?php echo isset($editData[0]['description']) ? $editData[0]['description'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label order_sequence">Order Sequence</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="order_sequence" id="order_sequence" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['order_sequence']) ? $editData[0]['order_sequence'] : NULL;?>" placeholder="Order Sequence" oninput="validateNumber(this)">
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group text-right">
														<label class="col-form-label product_image"><span class="text-danger">*</span> Product Image</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="product_image" id="product_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<!-- <span class="text-muted" >Note : Upload image size less than 100kb and less than 100x100 pixels</span> -->
														<span class="exist_error text-warning"></span>
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/products/".$id.".png";
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
											// var product_category	= $("#product_category").val();
											var product_name 		= $("#product_name").val();
											// var description			= $("#description").val();
											var product_image 		= $("#product_image").val();

											if (product_name.trim() !== "" && (type !== 'add' || product_image)) 
											{
												$(".form_submit_valid").prop('disabled', false); 
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', true); 
											}
										}

										$("input,select,textarea").on('keyup change', function() { 
											validateForm();
										});

										validateForm();

										function saveBtn(val) 
										{
											$(".form_submit_valid").prop('disabled', true);

											// var product_category	= $("#product_category").val();
											var product_name 		= $("#product_name").val();
											// var description			= $("#description").val();
											var product_image 		= $("#product_image").val();

											if (product_name.trim() !== "" && (type !== 'add' || product_image)) 
											{
												// $(".product_category").removeClass('errorClass');
												$(".product_name").removeClass('errorClass');
												// $(".description").removeClass('errorClass');
												$(".product_image").removeClass('errorClass');
												return true;
											} 
											else {
												$(".form_submit_valid").prop('disabled', false); // Re-enable the button if validation fails

												// if (product_category.trim() === "") 
												// {
												// 	$(".product_category").addClass('errorClass');
												// }
												if (product_name.trim() === "") 
												{
													$(".product_name").addClass('errorClass');
												}
												// if (description.trim() === "") 
												// {
												// 	$(".description").addClass('errorClass');
												// }
												if (type === 'add' && !product_image) 
												{
													$(".product_image").addClass('errorClass');
												} 
												else 
												{
													$(".product_image").removeClass('errorClass');
												}

												return false;
											}
										}
									});

									function validateNumber(input) {
										input.value = input.value.replace(/\D/g, '');
									}
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
								<a href="<?php echo base_url(); ?>products/manageProducts" class="btn btn-default btn-sm">Close</a>
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
									<a href="<?php echo base_url(); ?>products/manageProducts/add" class="btn btn-info btn-sm">
										Create Product
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
									<label class="col-form-label col-md-5 text-right">Category</label>
									<div class="form-group col-md-7">
										<select name="product_category" id="product_category" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getProductCategory as $productCategory)
												{
													$selected="";
													if(isset($_GET["product_category"]) && $_GET["product_category"] == $productCategory['list_code'] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $productCategory['list_code'];?>" <?php echo $selected;?>><?php echo ucfirst($productCategory['list_value']);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
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
							<div class="col-md-3">
								<div class="row">
									<label class="col-form-label col-md-4 text-right">Status</label>
									<div class="form-group col-md-8">
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
						</div>
						<div class="row">
							<div class="col-md-12 text-right float-right">
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search"></i></button>
								<a href="<?php echo base_url(); ?>products/manageProducts" title="Clear" class="btn btn-default">Clear</a>
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
											<!-- <th class="text-left tab-md-140">Category</th> -->
											<th class="text-left tab-md-140">Product Name</th>
											<th class="text-center tab-md-100">Product Image</th>
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
																						<a title="Edit" href="<?php echo base_url(); ?>products/manageProducts/edit/<?php echo $row['product_id'];?>/">
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
																					<a title="View" href="<?php echo base_url(); ?>products/manageProducts/view/<?php echo $row['product_id'];?>/">
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
																							<a class="unblock" href="<?php echo base_url(); ?>products/manageProducts/status/<?php echo $row['product_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>products/manageProducts/status/<?php echo $row['product_id'];?>/Y" title="Active">
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
													<?php /*
														<td><?php echo ucfirst($row['list_value']);?></td>
													*/ ?>
													<td><?php echo ucfirst($row['product_name']);?></td>
													<td class="text-center">
														<?php 
															if(isset($row['product_id']))
															{
																$url = "uploads/products/".$row['product_id'].".png";
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











