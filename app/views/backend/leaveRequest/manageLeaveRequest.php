<?php
	$leave_request 				= accessMenu(leave_request);
	$leaveStatus 				= $this->common_model->lov('LEAVE-APPROVED-STATUS'); 
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
											Leave Request
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
									<a href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest" class="btn btn-default btn-sm">Close</a>

								</div>
							</div>
							<!-- Buttons end here -->

							<fieldset <?php echo $fieldSetDisabled;?>>

								<section class="header-section">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label leave_days"><span class="text-danger">*</span> Leave Days</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group role_id">
														<input type="text" id="leave_days" name="leave_days" required autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['leave_days']) ? $editData[0]['leave_days'] :"";?>" placeholder="Leave Days">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label reason"><span class="text-danger">*</span> Reason</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<textarea name="reason" id="reason" rows="1" autocomplete="off" class="form-control" placeholder="Reason"><?php echo isset($editData[0]['reason']) ? $editData[0]['reason'] :"";?></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label room_number"><span class="text-danger">*</span> Room Number</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<textarea name="room_number" id="room_number" rows="1" autocomplete="off" class="form-control" placeholder="Room Number"><?php echo isset($editData[0]['room_number']) ? $editData[0]['room_number'] :"";?></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label start_date"><span class="text-danger">*</span> From Date</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" id="start_date" name="from_date" required autocomplete="off" readonly class="form-control default_date" value="<?php echo isset($editData[0]['from_date']) ? $editData[0]['from_date'] :date("d-M-Y");;?>" placeholder="From Date">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label end_date"><span class="text-danger">*</span> To Date</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" id="end_date" name="end_date" required autocomplete="off" readonly class="form-control previous_date" value="<?php echo isset($editData[0]['end_date']) ? $editData[0]['end_date'] :date("d-M-Y");;?>" placeholder="To Date">
													</div>
												</div>
											</div>
											<script>
												$(document).ready(function() {
													// Initialize the start_date (Valid From Date) datepicker
													$("#start_date").datepicker({
														changeMonth: true,
														changeYear: true,
														yearRange: "1950:<?php echo date('Y') + 10; ?>",
														dateFormat: "dd-M-yy",
														minDate: 0, // Disable backdates
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
												});
											</script>
										</div>
										
									</div>
									

								</section>

								<script>
									$(document).ready(function() {
										var type = '<?php echo $type; ?>';
										$(".form_submit_valid").prop('disabled', true);

										function validateForm() 
										{
											var leave_days             	= $("#leave_days").val();
											var room_number    			= $("#room_number").val();
											var reason              	= $("#reason").val(); 
											var start_date    			= $("#start_date").val();
											var end_date    			= $("#end_date").val();

											if (leave_days.trim() !== "" && room_number.trim() !== "" && reason.trim() !== "" && start_date.trim() !== "" &&  end_date.trim() !== "") 
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

											var leave_days             	= $("#leave_days").val();
											var room_number    			= $("#room_number").val();
											var reason              	= $("#reason").val(); 
											var start_date    			= $("#start_date").val();
											var end_date    			= $("#end_date").val();

											if (leave_days.trim() !== "" && room_number.trim() !== "" && reason.trim() !== "" && start_date.trim() !== "" &&  end_date.trim() !== "") 
											{
												$(".leave_days").removeClass('errorClass');
												$(".room_number").removeClass('errorClass');
												$(".reason").removeClass('errorClass');
												$(".start_date").removeClass('errorClass');
												$(".end_date").removeClass('errorClass');
												return true;
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', false);
												
												if (leave_days.trim() === "") {
													$(".leave_days").addClass('errorClass');
												}
												if (room_number.trim() === "") {
													$(".room_number").addClass('errorClass');
												}
												if (reason.trim() === "") {
													$(".reason").addClass('errorClass');
												}
												
												if (start_date.trim() === "") {
													$(".start_date").addClass('errorClass');
												}
												if (end_date.trim() === "") {
													$(".end_date").addClass('errorClass');
												}
												
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
								<a href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest" class="btn btn-default btn-sm">Close</a>
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
								if($leave_request['create_edit_only'] == 1 || $this->user_id == 1)
								{
									?>
									<a href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest/add" class="btn btn-info btn-sm">
										Create Leave Request
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
									<label class="col-form-label col-md-5 text-right">Room Number</label>
									<div class="form-group col-md-7">
										<input type="search" class="form-control" name="keywords" value="<?php echo !empty($_GET['keywords']) ? $_GET['keywords'] :""; ?>" placeholder="Room Number" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<label class="col-form-label col-md-5 text-right">Status</label>
									<div class="form-group col-md-7">
										<select name="leave_approved_status" id="leave_approved_status" class="form-control searchDropdown">
											<!-- <option value="">- Select -</option> -->
											<?php 
												foreach($leaveStatus as $row)
												{
													$selected="";
													if(isset($_GET['leave_approved_status']) && $_GET['leave_approved_status'] == $row["list_code"] )
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
								<a href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest" title="Clear" class="btn btn-default">Clear</a>
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
											<th class="text-left tab-md-140">Room Number</th>
											<th class="text-left tab-md-140">Leave Days</th>
											<th class="text-left tab-md-140">From Date</th>
											<th class="text-left tab-md-140">To Date</th>
											<th class="text-left tab-md-140">Leave Requested Date</th>
											<th class="text-left tab-md-140">Reason</th>
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
																	if($leave_request['create_edit_only'] == 1 || $leave_request['read_only'] == 1 || $this->user_id == 1)
																	{ 
																		?>
																		<?php
																			if($leave_request['create_edit_only'] == 1 || $this->user_id == 1)
																			{
																				?>
																					<li>
																						<a title="Edit" href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest/edit/<?php echo $row['leave_request_id'];?>/">
																							<i class="fa fa-edit"></i> Edit
																						</a>
																					</li>
																				<?php 
																			} 
																		?>

																		<?php
																			if($leave_request['read_only'] == 1 || $this->user_id == 1)
																			{
																				
																				?>
																				<li>
																					<a title="View" href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest/view/<?php echo $row['leave_request_id'];?>/">
																						<i class="fa fa-eye"></i> View
																					</a>
																				</li>
																				<?php 
																			} 
																		?>

																		<?php
																			if(strtolower($this->role_code)=='warden' || $this->user_id == 1)
																			{
																				if($row['leave_approved_status'] == 'PENDING')
																				{
																					?>
																						<a class="unblock" href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest/leaveapprovedstatus/<?php echo $row['leave_request_id'];?>/APPROVED" title="Approved">
																							<i class="fa fa-check"></i> Approved
																						</a>
																						<a class="unblock" href="<?php echo base_url(); ?>leaveRequest/manageLeaveRequest/leaveapprovedstatus/<?php echo $row['leave_request_id'];?>/REJECT" title="Reject">
																							<i class="fa fa-check"></i> Reject
																						</a>
																					<?php 
																				} 
																				
																				else
																				{
																					?>
																					<span class='text-success'>Approved</span>
																					<?php
																				} 
																			} 
																		?>
																		<?php 
																	} 
																?>
															</ul>
														</div>
													</td>
													<td><?php echo $row['room_number'];?></td>
													<td><?php echo $row['leave_days'];?></td>
													<td><?php echo date('d-M-Y', strtotime($row['from_date'])); ?></td>
													<td><?php echo date('d-M-Y', strtotime($row['to_date'])); ?></td>
													<td><?php echo date('d-M-Y', strtotime($row['created_date'])); ?></td>
													<td><?php echo $row['reason'];?></td>

													<td class="text-center">
														<?php 
															if($row['leave_approved_status'] == 'PENDING')
															{
																?>
																<span class="btn btn-outline-in-progress btn-sm" title="Pending">
																	Pending 
																</span>
																<?php 
															} 
															else if($row['leave_approved_status'] == 'REJECT')
															{
																?>
																<span class="btn btn-outline-pending btn-sm" title="Pending">
																	Reject 
																</span>
																<?php 
															} 
															else
															{  ?>
																<span class="btn btn-outline-success btn-sm" title="Approved">
																	Approved 
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











