<?php
	$physical_stock_adjustment 	= accessMenu(physical_stock_adjustment);
	$getActiveDepartment 		= $this->department_model->getActiveDepartment('ACTIVE'); 
	$getStaffName 				= $this->staff_details_model->getStaffName('ALL'); 
	$getPositionList			= $this->common_model->lov('POSITION'); 
	$getActiveYear 				= $this->common_model->lov('ACADEMIC-YEAR'); 
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
											Staff Detail
										</b>
									</h3>
								</div>
								<div class="col-md-6 text-right">
									<?php
										if($type == "add" || $type == "edit")
										{
											?>
											<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save" class="btn btn-primary btn-sm form_submit_valid">Save</button>
											<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm form_submit_valid">Submit</button>
											<?php
										}
									?>
									<a href="<?php echo base_url(); ?>staffDetails/manageStaffDetails" class="btn btn-default btn-sm">Close</a>

								</div>
							</div>
							<!-- Buttons end here -->

							<fieldset <?php echo $fieldSetDisabled;?>>

								<section class="header-section">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<?php 
													if($type == "add")
													{
														$getDocumentData=$this->common_model->documentNumber('STAFF');
							
														$prefixName 		= isset($getDocumentData[0]['prefix_name']) ? $getDocumentData[0]['prefix_name'] : NULL;
														$startingNumber 	= isset($getDocumentData[0]['next_number']) ? $getDocumentData[0]['next_number'] : NULL;
														$suffixName 		= isset($getDocumentData[0]['suffix_name']) ? $getDocumentData[0]['suffix_name'] : NULL;

														$staffROllNumber 	= $prefixName.''.$startingNumber.''.$suffixName;
													}
													else if($type == "edit")
													{
														$staffROllNumber	= isset($editData[0]['staff_roll_number']) ? $editData[0]['staff_roll_number'] :"";
													}
												?>
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label staff_roll_number"><span class="text-danger">*</span> Staff Id</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group role_id">
														<input type="text" id="staff_roll_number" name="staff_roll_number" required readonly autocomplete="off" class="form-control --no-outline" value="<?php echo $staffROllNumber;?>" placeholder="Staff ID">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label department_id"><span class="text-danger">*</span> Department</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<select name="department_id" id="department_id" class="form-control <?php echo $searchDropdown;?>" required>
															<option value="">- Select  -</option>
															<?php 
																foreach($getActiveDepartment as $activeDepartment)
																{
																	$selected="";
																	if(isset($editData[0]['department_id']) && ($editData[0]['department_id'] == $activeDepartment['department_id']) )
																	{
																		$selected="selected='selected'";
																	}
																	?>
																	<option value="<?php echo $activeDepartment['department_id'];?>" <?php echo $selected;?>><?php echo ucfirst($activeDepartment['department_name']); ?></option>
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
														<label class="col-form-label email_id"><span class="text-danger">*</span> Email Id</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group role_id">
														<input type="text" id="email_id" name="email_id" required autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['email_id']) ? $editData[0]['email_id'] :"";?>" placeholder="Email Id">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label position_name"><span class="text-danger">*</span> Position Name</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group position_name">
														<select name="position_name" id="position_name" class="form-control <?php echo $searchDropdown;?>">
															<option value="">- Select  -</option>
															<?php 
																foreach($getPositionList as $positionList)
																{
																	$selected="";
																	if(isset($editData[0]['position_name']) && ($editData[0]['position_name'] == $positionList['list_code']) )
																	{
																		$selected="selected='selected'";
																	}
																	?>
																	<option value="<?php echo $positionList['list_code'];?>" <?php echo $selected;?>><?php echo ucfirst($positionList['list_value']); ?></option>
																	<?php 
																} 
															?>
														</select>
													</div>
												</div>
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label staff_name"><span class="text-danger">*</span> Staff Name</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group role_id">
														<input type="text" id="staff_name" name="staff_name" required autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['staff_name']) ? $editData[0]['staff_name'] :"";?>" placeholder="Staff Name">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label academic_year"><span class="text-danger">*</span> Year</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<select name="academic_year" id="academic_year" class="form-control <?php echo $searchDropdown;?>" required>
															<option value="">- Select  -</option>
															<?php 
																foreach($getActiveYear as $activeYear)
																{
																	$selected="";
																	if(isset($editData[0]['academic_year']) && ($editData[0]['academic_year'] == $activeYear['list_code']) )
																	{
																		$selected="selected='selected'";
																	}
																	?>
																	<option value="<?php echo $activeYear['list_code'];?>" <?php echo $selected;?>><?php echo $activeYear['list_value']; ?></option>
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
														<label class="col-form-label contact_number"><span class="text-danger">*</span> Contact Number</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group role_id">
														<input type="text" id="contact_number" name="contact_number" required autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['contact_number']) ? $editData[0]['contact_number'] :"";?>" placeholder="Contact Number">
													</div>
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label staff_image"><span class="text-danger">*</span> Staff Photo</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group role_id">
														<input type="file" name="staff_image" id="staff_image" onchange='validateFileImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<span class="text-muted" ></span>
														<span class="exist_error text-warning"></span>
														
														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$url = "uploads/staff_images/".$id.".png";
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

								<script>
									$(document).ready(function() {
										var type = '<?php echo $type; ?>';
										$(".form_submit_valid").prop('disabled', true);

										function validateForm() 
										{
											var staff_name       		= $("#staff_name").val();
											var department_id    		= $("#department_id").val();
											var academic_year         	= $("#academic_year").val(); 
											var email_id    			= $("#email_id").val();
											var contact_number    		= $("#contact_number").val();
											var position_name    		= $("#position_name").val();
											var staff_image    			= $("#staff_image").val();

											if (staff_name.trim() !== "" && department_id!== "" && academic_year.trim() !== "" && email_id.trim() !== "" &&  contact_number.trim() !== "" && (type !== 'add' || staff_image)) 
											{
												$(".form_submit_valid").prop('disabled', false);
											} else {
												$(".form_submit_valid").prop('disabled', true);
											}
										}

										$("input, select, textarea").on('keyup change', function() {
											validateForm();
										});

										validateForm();

										function saveBtn(val) {
											$(".form_submit_valid").prop('disabled', true);

											var staff_name       		= $("#staff_name").val();
											var department_id    		= $("#department_id").val();
											var academic_year       	= $("#academic_year").val(); 
											var email_id    			= $("#email_id").val();
											var contact_number    		= $("#contact_number").val();
											var position_name    		= $("#position_name").val();
											var staff_image    			= $("#staff_image").val();

											if (staff_name.trim() !== "" && department_id!== "" && academic_year.trim() !== "" && email_id.trim() !== "" &&  contact_number.trim() !== "" &&  position_name.trim() !== "" && (type !== 'add' || staff_image)) 
											{
												$(".staff_name").removeClass('errorClass');
												$(".department_id").removeClass('errorClass');
												$(".academic_year").removeClass('errorClass');
												$(".email_id").removeClass('errorClass');
												$(".contact_number").removeClass('errorClass');
												$(".position_name").removeClass('errorClass');
												$(".staff_image").removeClass('errorClass');
												return true;
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', false);
												
												if (staff_name.trim() === "") {
													$(".staff_name").addClass('errorClass');
												}
												if (department_id.trim() === "") {
													$(".department_id").addClass('errorClass');
												}
												if (academic_year.trim() === "") {
													$(".academic_year").addClass('errorClass');
												}
												
												if (email_id.trim() === "") {
													$(".email_id").addClass('errorClass');
												}
												if (contact_number.trim() === "") {
													$(".contact_number").addClass('errorClass');
												}
												if (position_name.trim() === "") {
													$(".position_name").addClass('errorClass');
												}
												
												if (type === 'add' && !staff_image) $(".staff_image").addClass('errorClass');
												return false;
											}
										}
									});

								</script>

							</fieldset>
							<div class="col-md-12 mt-3 pr-0 text-right">
								<?php
									if($type == "add" || $type == "edit")
									{
										?>
										<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save" class="btn btn-primary btn-sm form_submit_valid">Save</button>
										<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm form_submit_valid">Submit</button>
										<?php
									}
								?>
								<a href="<?php echo base_url(); ?>staffDetails/manageStaffDetails" class="btn btn-default btn-sm">Close</a>
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
									<a href="<?php echo base_url(); ?>staffDetails/manageStaffDetails/add" class="btn btn-info btn-sm">
										Create Staff Detail
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
									<label class="col-form-label col-md-5 text-right">Staff Name</label>
									<div class="form-group col-md-7">
										<select name="staff_id" id="staff_id" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getStaffName as $StaffName)
												{
													$selected="";
													if(isset($_GET["staff_id"]) && $_GET["staff_id"] == $StaffName['staff_id'] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $StaffName['staff_id'];?>" <?php echo $selected;?>><?php echo ucfirst($StaffName['staff_name']);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Department Name</label>
									<div class="form-group col-md-7">
										<select name="department_id" id="department_id" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getActiveDepartment as $activeDepartment)
												{
													$selected="";
													if(isset($_GET["department_id"]) && $_GET["department_id"] == $activeDepartment['department_id'] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $activeDepartment['department_id'];?>" <?php echo $selected;?>><?php echo ucfirst($activeDepartment['department_name']);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Year</label>
									<div class="form-group col-md-7">
										<select name="position_name" id="position_name" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getPositionList as $positionList)
												{
													$selected="";
													if(isset($_GET["position_name"]) && $_GET["position_name"] == $positionList['list_code'] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $positionList['list_code'];?>" <?php echo $selected;?>><?php echo ucfirst($positionList['list_value']);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Year</label>
									<div class="form-group col-md-7">
										<select name="year" id="year" class="form-control searchDropdown">
											<option value="">- Select -</option>
											<?php 
												foreach($getActiveYear as $activeYear)
												{
													$selected="";
													if(isset($_GET["academic_year"]) && $_GET["academic_year"] == $activeYear['list_code'] )
													{
														$selected="selected='selected'";
													}
													?>
													<option value="<?php echo $activeYear['list_code'];?>" <?php echo $selected;?>><?php echo ucfirst($activeYear['list_value']);?></option>
													<?php 
												} 
											?>
										</select>
									</div>
								</div>
							</div>
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
								<a href="<?php echo base_url(); ?>staffDetails/manageStaffDetails" title="Clear" class="btn btn-default">Clear</a>
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
											<th class="text-center tab-md-100">Controls</th>
											<th class="text-left tab-md-140">ROll Number</th>
											<th class="text-left tab-md-140">Staff Name</th>
											<th class="text-left tab-md-140">Department</th>
											<th class="text-left tab-md-140">Position</th>
											<th class="text-left tab-md-140">Year</th>
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
																						<a title="Edit" href="<?php echo base_url(); ?>staffDetails/manageStaffDetails/edit/<?php echo $row['staff_id'];?>/">
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
																					<a title="View" href="<?php echo base_url(); ?>staffDetails/manageStaffDetails/view/<?php echo $row['staff_id'];?>/">
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
																							<a class="unblock" href="<?php echo base_url(); ?>staffDetails/manageStaffDetails/status/<?php echo $row['staff_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>staffDetails/manageStaffDetails/status/<?php echo $row['staff_id'];?>/Y" title="Active">
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
													<td><?php echo $row['staff_roll_number'];?></td>
													<td><?php echo ucfirst($row['staff_name']);?></td>
													<td><?php echo ucfirst($row['department_name']); ?></td>
													<td><?php echo ucfirst($row['position_name']); ?></td>
													<td><?php echo $row['list_value']; ?></td>

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











