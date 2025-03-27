<?php 
	$system_manager = array();

	$category_type=$this->common_model->lov('PRODUCT-TYPE')
?>


<div class="content"><!-- Content start-->
	<div class="card"><!-- Card start-->
		<div class="card-body">
			<?php
				if(isset($type) && $type == "add" || $type == "edit" || $type == "view")
				{
					if($type == "view"){
						$fieldSetDisabled = "disabled";
						#$dropdownDisabled = "style='pointer-events: none;'";
						$searchDropdown = "";
					}else{
						$fieldSetDisabled = "";
						#$dropdownDisabled = "";
						$searchDropdown = "searchDropdown";
					}
					?>

					<form action="" class="form-validate-jquery" enctype="multipart/form-data" method="post">
						<div class="header-lines">
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
											Category
										</b>
									</h3>
								</div>
								<div class="col-md-6 text-right">

								</div>
							</div>
							<fieldset class="mb-3" <?php echo $fieldSetDisabled;?>>
								<!-- <legend class="text-uppercase font-size-sm font-weight-bold"><?php //echo $type;?> Category</legend> -->
								<div class="row">
									
									<div class="form-group col-md-3 category_name">
										<label class="col-form-label category_name"><span class="text-danger">*</span> Category Name </label>
										<input type="text" name="category_name" id="category_name" class="form-control" required value="<?php echo isset($edit_data[0]['category_name'])?$edit_data[0]['category_name']:"";?>" placeholder="Category Name">
									</div>

									<div class="form-group col-lg-3">
										<label class="col-form-label">Category Description</label>
										<textarea name="category_description" <?php echo $this->validation;?> rows="1" id="category_description" class="form-control" placeholder="Category Description"><?php echo isset($edit_data[0]['category_description']) ? $edit_data[0]['category_description']:NULL;?></textarea>
									</div>

									<div class="form-group col-lg-3">
										<label class="col-form-label">Display Seq Num</label>
										<input type="text" name="disp_seq_num" class="form-control"<?php echo $this->validation;?> value="<?php echo isset($edit_data[0]['disp_seq_num'])?$edit_data[0]['disp_seq_num']:"";?>" placeholder="Display Seq Num" oninput="validateNumber(this)">
									</div>
									<script>
										function validateNumber(input) {
											input.value = input.value.replace(/\D/g, '');
										}
										$(document).ready(function() {
										var type = '<?php echo $type; ?>'
										$(".form_submit_valid").prop('disabled', true);

										function validateForm() {
											var category_name 		= $("#category_name").val();
											var cat_level_1 		= $("#cat_level_1").val();

											if (category_name.trim() !== "" && cat_level_1 !== "" && cat_level_1 !== "0") {
												$(".form_submit_valid").prop('disabled', false); 
											} else {
												$(".form_submit_valid").prop('disabled', true); 
											}
										}

										// Add event listeners for input and select elements
										$("input, select").on('keyup change', function() { 
											validateForm();
										});

										validateForm(); // Initial check on page load

										function saveBtn(val) {
											
											$(".form_submit_valid").prop('disabled', true);

											var category_name 		= $("#category_name").val();
											var cat_level_1 		= $("#cat_level_1").val();

											if (category_name.trim() !== "" && cat_level_1 !== "" && cat_level_1 !== "0") {
												$(".category_name").removeClass('errorClass');
												$(".cat_level_1").removeClass('errorClass');

												return true;
											} else {
												$(".form_submit_valid").prop('disabled', false); // Re-enable buttons

												if (category_name.trim() === "") {
													$(".category_name").addClass('errorClass');
												}
												if (cat_level_1 === "" || cat_level_1 === "0") {
													$(".cat_level_1").addClass('errorClass');
												}
												
												return false;
											}
										}
									});


									</script>
								</div>
							
								<div class="row">
									<div class="form-group col-md-3">
										<label class="col-form-label cat_level_1"><span class="text-danger">*</span> Category Level 1</label>
										<?php 
											$ChildCategory1 = $this->common_model->lov($this->category_level1_name);
										?>
										<select name="cat_level_1" id="cat_level_1" <?php #echo $dropdownDisabled;?> class="form-control <?php echo $searchDropdown;?>">
											<option value="">- Select -</option>
											<?php 
												foreach($ChildCategory1 as $row)
												{
													$selected="";
													if(isset($edit_data[0]['cat_level_1']) && ($edit_data[0]['cat_level_1'] == $row['list_type_value_id']) )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $row['list_type_value_id']; ?>" <?php echo $selected;?>><?php #echo $row['list_code']; ?><!-- &nbsp;&nbsp; | &nbsp;&nbsp;  --><?php echo $row['list_value']; ?></option>
													<?php 
												} 
											?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label class="col-form-label">Category Level 2 </label>
										<?php 
											$ChildCategory2 = $this->common_model->lov($this->category_level2_name); 
										?>
										<select name="cat_level_2" id="cat_level_2" <?php #echo $dropdownDisabled;?> class="form-control <?php echo $searchDropdown;?>">
											<option value="">- Select -</option>
											<?php 
												foreach($ChildCategory2 as $row)
												{
													$selected="";
													if(isset($edit_data[0]['cat_level_2']) && ($edit_data[0]['cat_level_2'] == $row['list_type_value_id']) )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $row['list_type_value_id']; ?>" <?php echo $selected;?>><?php #echo $row['list_code']; ?><!-- &nbsp;&nbsp; | &nbsp;&nbsp;  --><?php echo $row['list_value']; ?></option>
													<?php 
												} 
											?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label class="col-form-label">Category Level 3</label>
										<?php 
											$ChildCategory3 = $this->common_model->lov($this->category_level3_name); 
										?>
										<select name="cat_level_3" id="cat_level_3" <?php #echo $dropdownDisabled;?> class="form-control <?php echo $searchDropdown;?>">
											<option value="">- Select -</option>
											<?php 
												foreach($ChildCategory3 as $row)
												{
													$selected="";
													if(isset($edit_data[0]['cat_level_3']) && ($edit_data[0]['cat_level_3'] == $row['list_type_value_id']) )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $row['list_type_value_id']; ?>" <?php echo $selected;?>><?php #echo $row['list_code']; ?><!-- &nbsp;&nbsp; | &nbsp;&nbsp;  --><?php echo $row['list_value']; ?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
								
								<div class="row">
									<div class="form-group col-md-3">
										<label class="col-form-label">Start Date </label>
										
										<input type="text" name="start_date" id="start_date" readonly class="form-control" value="<?php echo isset($edit_data[0]['start_date']) ? date("d-M-Y",strtotime($edit_data[0]['start_date'])) : NULL;?>" placeholder="">
									</div>

									<div class="form-group col-md-3">
										<label class="col-form-label">End Date</label>
										
										<input type="text" name="end_date" id="end_date" readonly class="form-control" value="<?php echo isset($edit_data[0]['end_date']) ? date("d-M-Y",strtotime($edit_data[0]['end_date'])) : NULL;?>" placeholder="">
									</div>	
									
									<div class="form-group col-lg-3">
										<label class="col-form-label">Category Logo</label>
										<input type="file" name="category_images" onchange="return validateSingleFileExtension(this)" accept="image/*" class="form-control singleImage">
											<span class="note-class"><b>Note</b> : Upload size is 1 [MB] and image format is (png,gif,jpg,jpeg and bmp).</span>
												<script>
													/** Single Image Type & Size Validation **/
													function validateSingleFileExtension(fld) 
													{
														var fileUpload = fld;
														
														if (typeof (fileUpload.files) != "undefined")
														{
															var size = parseFloat( fileUpload.files[0].size / 1024 ).toFixed(2);
															var validSize = 1024 * 1; //1024 - 1Mb multiply 4mb
															
															if( size > validSize )
															{
																alert("Upload size is 1 MB");
																$('.singleImage').val('');
																var value = 1;
																return false;
															}
															else if(!/(\.png|\.bmp|\.gif|\.jpg|\.jpeg)$/i.test(fld.value))
															{
																alert("Invalid file type. Please select one of the following: .png, .bmp, .gif, .jpg, .jpeg, .webp");
																$('.singleImage').val('');
																return false;   
															}
															
															if(value != 1)	
																return true; 
														}
													}
												</script>
										<?php 
											if(isset($edit_data[0]['category_id']))
											{
												$url = "uploads/category_image/".$edit_data[0]['category_id'].".png";
												if(file_exists($url))
												{
													?><br>
													<div class="form-group view-form row">
														<div class="col-lg-8"><br>
															<img src="<?php echo base_url().$url;?>" style="width:200px !important; height:100px !important;" alt="...">
														</div>
													</div>
													<?php 
												}
											} 
										?>
									</div>
								</div>

								
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
								<a href="<?php echo base_url(); ?>categories/manage_category" class="btn btn-default btn-sm">Close</a>
							</div>
						</div>

					</form>
					
					<?php
				}
				else
				{
					?>
					<style>
						.dropdown-menu.dropdown-menu.show{
						    position: absolute;
							/* transform: translate3d(9px, -50px, -1px) !important;
							top: 0px;
							left: 0px;
							will-change: transform; */
						}
					</style>
					<div class="row mb-2">
						<div class="col-md-6"><h3><b><?php echo $page_title;?></b></h3></div>
						<div class="col-md-6 float-right text-right">
							<a href="<?php echo base_url();?>setup/settings" class="btn btn-info btn-sm">
								<i class="icon-arrow-left16"></i> 
								Back
							</a>
							<a href="<?php echo base_url(); ?>categories/manage_category/add" class="btn btn-info btn-sm">
								Create Category
							</a>
						</div>
					</div>

					<form action="" method="get">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-4 text-right">Category Name</label>
									<div class="form-group col-md-7">
										<?php 
											$getCategory = $this->categories_model->getCategoryAll();
										?>
										
										<select name="category_id" id="category_id" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getCategory as $categoryList)
												{
													$selected="";
													if(isset($_GET['category_id']) && $_GET['category_id'] == $categoryList["category_id"] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $categoryList["category_id"];?>" <?php echo $selected;?>><?php echo ucfirst($categoryList["category_name"]);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>	
							</div>	

							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-4">Status</label>
									<div class="form-group col-md-7">
										<?php 
											$activeStatus = $this->common_model->lov('ACTIVESTATUS');
										?>
										
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
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="<?php echo base_url(); ?>categories/manage_category" title="Clear" class="btn btn-default">Clear</a>
							</div>
						</div>
						
					</form>

					<?php 
						if(isset($_GET) &&  !empty($_GET))
						{
							if(count($category)>0){
								?>
									<div class="row">
										<div class="col-md-6">
											
										</div>
										<div class="col-md-6 text-right">
											<?php 
												$redirect_url = substr($_SERVER['REQUEST_URI'],'1');
											?>
											<input type="hidden" id="redirect_url" value="<?php echo $redirect_url; ?>"/>
																	
											<div class="filter_page">
												<label>
													<span>Show :</span> 
													<select name="filter" onchange="location.href='<?php echo base_url(); ?>admin/sort_itemper_page/'+$(this).val()+'?redirect=<?php echo $redirect_url; ?>'">
														<?php 
															$pageLimit = $_SESSION['PAGE'];
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
							<div class="new-scroller">
								<table class="table --datatable-responsive table-hover table-bordered tbl_height">
									<thead>
										<tr>
											<th class="text-center tab-md-100">Controls</th>
											<th class="tab-md-140">Category Name</th>
											<th class="tab-md-140">Category Description</th>
											<th class="text-center tab-md-100">Category Image</th>
											<th class="text-center tab-md-100">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php 	
											$i=1;
											foreach($category as $row)
											{
												?>
												<tr>
													<td class="text-center">
														<div class="dropdown" style="display: inline-block;padding-right: 10px!important;width:92px;">
															<button type="button" class="btn btn-outline-primary gropdown-toggle waves-effect waves-light btn-sm" data-toggle="dropdown" aria-expanded="false">
																Action <i class="fa fa-angle-down"></i>
															</button>
															<ul class="dropdown-menu dropdown-menu">
																<li>
																	<a title="View" href="<?php echo base_url(); ?>categories/manage_category/view/<?php echo $row['category_id'];?>">
																		<i class="fa fa-eye"></i> View
																	</a>
																</li>
																
																<li>
																	<a title="Edit" href="<?php echo base_url(); ?>categories/manage_category/edit/<?php echo $row['category_id'];?>">
																		<i class="fa fa-pencil"></i> Edit
																	</a>
																</li>
																
																<li>
																	<?php 
																		if($row['active_flag'] == $this->active_flag)
																		{
																			?>
																			<a href="<?php echo base_url(); ?>categories/manage_category/status/<?php echo $row['category_id'];?>/N" title="Inactive">
																				<i class="fa fa-ban"></i> Inactive
																			</a>
																			<?php 
																		} 
																		else
																		{  ?>
																			<a href="<?php echo base_url(); ?>categories/manage_category/status/<?php echo $row['category_id'];?>/Y" title="Active">
																				<i class="fa fa-check"></i> Active
																			</a>
																			<?php 
																		} 
																	?>
																</li>
																
															</ul>
														</div>
														
													</td>
													<td><?php echo ucfirst($row['category_name']);?></td>
													<td><?php echo ucfirst($row['category_description']);?></td>
													<td class="text-center">
														<?php 
															if(isset($row['category_id']))
															{
																$url = "uploads/category_image/".$row['category_id'].".png";
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
													
													<td style="text-align:center;">
														<?php 
															if($row['active_flag'] == $this->active_flag)
															{
																?>
																<span class="btn btn-outline-success btn-sm" title="Active">Active</span>
																<?php 
															} 
															else
															{  ?>
																<span class="btn btn-outline-warning btn-sm" title="Inactive">Inactive</span>
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
									if(count($category) == 0)
									{
										?>
										<div class="text-center">
											<img src="<?php echo base_url();?>uploads/nodata.png">
										</div>
										<?php 
									} 
								?>
							</div>	

							<?php
								if (count($category) > 0) 
								{
									?>
									<div class="row mt-3">
										<div class="col-md-6 showing-count">
											Showing <?php echo $starting;?> to <?php echo $ending;?> of <?php echo $totalRows;?> entries
										</div>
										<!-- pagination start here -->
										<?php 
											if( isset($pagination) )
											{
												?>	
												<div class="col-md-6">
													<?php foreach ($pagination as $link){echo $link;} ?>
												</div>
												<?php
											}
										?>
										<!-- pagination end here -->
									</div>
									<?php 
								} 
							?>

							<?php 
						} 
					?>

					<?php 
				} 
			?>
		</div>
	</div><!-- Card end-->
</div><!-- Content end-->

