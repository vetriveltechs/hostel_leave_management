<?php 
	$physical_stock_adjustment = accessMenu(physical_stock_adjustment);
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
											Event
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
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label event_title"><span class="text-danger">*</span> Event Title</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="event_title" id="event_title" placeholder="Event Title" class="form-control" value="<?php echo isset($editData[0]['event_title']) ? $editData[0]['event_title'] : NULL;?>"></input>
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
														<textarea name="description" id="description" rows="1" placeholder="Description" class="form-control"><?php echo isset($editData[0]['description']) ? $editData[0]['description'] : NULL;?></textarea>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label event_image"><span class="text-danger">*</span> Event Image </label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="file" name="event_image" id="event_image" onchange='validateImage(this)' accept='.png, .gif, .jpg, .jpeg, .bmp' class="form-control singleImage">
														<!-- <span class="text-muted" >Note : Upload image size less than 100kb and less than 100x100 pixels</span> -->
														<span class="exist_error text-warning"></span>
														

														<?php 
															if( ($type == "edit" || $type == "view") && isset($id))
															{
																$event_url = "uploads/events/".$id.".png";
																if(file_exists($event_url))
																{
																	?><br>
																	<div class="form-group view-form row">
																		<div class="col-lg-8"><br>
																			<img src="<?php echo base_url().$event_url;?>" style="width:100px !important; height:75px !important;" alt="...">
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
														<label class="col-form-label location_name">Location Name</label>
													</div>				
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="location_name" id="location_name" placeholder="Location Name" class="form-control" value="<?php echo isset($editData[0]['location_name']) ? $editData[0]['location_name'] : NULL;?>"></input>
													</div>				
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label start_date"><span class="text-danger">*</span> Start Date</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="start_date" id="start_date" class="form-control default_date" value="<?php echo isset($editData[0]['start_date']) ? date("d-M-Y",strtotime($editData[0]['start_date'])) : date("d-M-Y");?>" readonly placeholder="">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label end_date"><span class="text-danger">*</span> End Date</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="end_date" id="end_date" class="form-control previous_date" value="<?php echo isset($editData[0]['end_date']) ? date("d-M-Y",strtotime($editData[0]['end_date'])) : date("d-M-Y");?>" readonly>
													</div>
												</div>
											</div>
										</div>
									</div>	
								</section>
								<!-- Header Section End Here-->
								
								<script>
									$(document).ready(function() {
										$("#start_date").datepicker({
											changeMonth: true,
											changeYear: true,
											yearRange: "1950:<?php echo date('Y') + 10; ?>",
											dateFormat: "dd-M-yy",
											// minDate: 0,
											onSelect: function(selectedDate) {
												// Set the minDate of end_date based on selected start_date
												$("#end_date").datepicker("option", "minDate", selectedDate);
											}
										});

										// Initialize the end_date (Valid To Date) datepicker
										$("#end_date").datepicker({
											changeMonth: true,
											changeYear: true,
											yearRange: "1950:<?php echo date('Y') + 10; ?>",
											dateFormat: "dd-M-yy",
											minDate: $("#start_date").val() // Set minDate initially based on start_date value
										});

										var type = '<?php echo $type; ?>';

										$(".form_submit_valid").prop('disabled', true);

										function validateForm() {
											var event_title 	= $("#event_title").val();
											var description 	= $("#description").val();
											var event_image 	= $("#event_image").val();
											var start_date   	= $("#start_date").val();
											var end_date  		= $("#end_date").val();

											if (event_title.trim() !== "" && description.trim() !== "" && (type !== 'add' || event_image) && start_date !== "" && end_date !== "") 
											{
												$(".form_submit_valid").prop('disabled', false); 
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', true); 
											}
										}

										$("input").on('keyup change', function() { 
											validateForm();
										});

										validateForm();

										function saveBtn(val) 
										{
											$(".form_submit_valid").prop('disabled', true);

											var event_title 	= $("#event_title").val();
											var description 	= $("#description").val();
											var event_image 	= $("#event_image").val();
											var start_date   	= $("#start_date").val();
											var end_date  		= $("#end_date").val();

											if (event_title.trim() !== "" && description.trim() !== "" && (type !== 'add' || event_image) && start_date !== "" && end_date !== "") 
											{
												$(".event_title").removeClass('errorClass');
												$(".description").removeClass('errorClass');
												$(".event_image").removeClass('errorClass');
												$(".start_date").removeClass('errorClass');
												$(".end_date").removeClass('errorClass');
												return true;
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', false);

												if (event_title.trim() === "") 
												{
													$(".event_title").addClass('errorClass');
												}
												if (description.trim() === "") 
												{
													$(".description").addClass('errorClass');
												}

												if (type === 'add' && !event_image) 
												{
													$(".event_image").addClass('errorClass');
												} 
												else 
												{
													$(".event_image").removeClass('errorClass');
												}
												if (start_date === "") {
													$(".start_date").addClass('errorClass');
												}
												if (end_date === "") {
													$(".end_date").addClass('errorClass');
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
								<a href="<?php echo base_url(); ?>events/manageEvents" class="btn btn-default btn-sm">Close</a>
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
									<a href="<?php echo base_url(); ?>events/manageEvents/add" class="btn btn-info btn-sm">
										Create Event
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
									<label class="col-form-label col-md-5 text-right">Event Title</label>
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
									<label class="col-form-label col-md-5 text-right"><span class="text-danger">*</span> From Date</label>
									<div class="form-group col-md-7">
										<input type="text" name="from_date" id="from_date" class="form-control" required readonly value="<?php echo !empty($_GET['from_date']) ? $_GET['from_date'] : ""; ?>" placeholder="From Date">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right"><span class="text-danger">*</span> To Date</label>
									<div class="form-group col-md-7">
										<input type="text" name="to_date" id="to_date" class="form-control" required readonly value="<?php echo !empty($_GET['to_date']) ? $_GET['to_date'] :""; ?>" placeholder="To Date">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Status</label>
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
							<div class="col-md-2">
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search"></i></button>
								<a href="<?php echo base_url(); ?>events/manageEvents" title="Clear" class="btn btn-default">Clear</a>
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
											<th class="text-left tab-md-140">Event Name</th>
											<th class="tab-md-140">Location Name</th>
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
																						<a title="Edit" href="<?php echo base_url(); ?>events/manageEvents/edit/<?php echo $row['event_id'];?>/">
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
																					<a title="View" href="<?php echo base_url(); ?>events/manageEvents/view/<?php echo $row['event_id'];?>/">
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
																							<a class="unblock" href="<?php echo base_url(); ?>events/manageEvents/status/<?php echo $row['event_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>events/manageEvents/status/<?php echo $row['event_id'];?>/Y" title="Active">
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
													<td><?php echo ucfirst($row['event_title']);?></td>
													<td><?php echo ucfirst($row['location_name']);?></td>
													<td class="text-center">
														<?php 
															if(isset($row['event_id']))
															{
																$event_url = "uploads/events/".$row['event_id'].".png";
																if(file_exists($event_url))
																{
																	?>
																	<img src="<?php echo base_url().$event_url;?>" style="width:50px !important; height:40px !important;" alt="...">
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











