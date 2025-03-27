<?php
	$physical_stock_adjustment 	= accessMenu(physical_stock_adjustment);
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
											Success Story
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
									<a href="<?php echo base_url(); ?>successStories/manageSuccessStories" class="btn btn-default btn-sm">Close</a>

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
														<label class="col-form-label industries_id"><span class="text-danger">*</span> Industry Name</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<div class="input-wrapper">
															<input type="text" name="industries_name" autocomplete="off" id="industries_name" value="<?php echo isset($editData[0]['industries_name']) ? $editData[0]['industries_name'] : NULL; ?>" placeholder="Industries Name" class="form-control">
															<input type="hidden" name="industries_id" autocomplete="off" id="industries_id" value="<?php echo isset($editData[0]['industries_id']) ? $editData[0]['industries_id'] : NULL; ?>" >
															<div id="IndustriesNameList"></div><!-- Clear icon start -->
																<?php 
																	if(isset($editData[0]["industries_id"]) && $editData[0]["industries_id"] !== '')
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
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label title"><span class="text-danger">*</span>Title</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group role_id">
														<input type="text" name="title" id="title" autocomplete="off" class="form-control" value="<?php echo isset($editData[0]['title']) ? $editData[0]['title'] :"";?>" placeholder="Title">
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group text-right">
														<label class="col-form-label successstories_image"><span class="text-danger">*</span> Image</label>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="file" name="successstories_image" id="successstories_image" onchange='validateImage(this)' accept="image/*" class="form-control singleImage">
															<span class="text-muted" ></span>
															<span class="exist_error text-warning"></span>
															
															<?php 
																if( ($type == "edit" || $type == "view") && isset($id))
																{
																	$url = "uploads/successstories_image/".$id.".png";
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
								
								<script>
									$(document).ready(function () 
									{
										var type = '<?php echo $type; ?>';

										$("input, select, textarea").on('keyup change', function () {
											validateForm();
										});


										validateForm(); // Initial validation

										function validateForm() {
											var title					= $("#title").val();
											var industries_id 			= $("#industries_id").val();
											var successstories_image	= $("#successstories_image").val();

											if (title.trim() !== "" && industries_id !== "" && (type !== 'add' || successstories_image)) 
											{
												$(".form_submit_valid").prop('disabled', false);
											} 
											else 
											{
												$(".form_submit_valid").prop('disabled', true);
											}
										}


										// Save button handler
										function saveBtn(val) {
											$(".form_submit_valid").prop('disabled', true);

											var title					= $("#title").val();
											var industries_id 			= $("#industries_id").val();
											var successstories_image 	= $("#successstories_image").val();

											if (title.trim() !== "" && industries_id !== "" && (type !== 'add' || successstories_image)) 
											{

												$(".title, .industries_id,.successstories_image").removeClass('errorClass');
												return true;
											} else {
												$(".form_submit_valid").prop('disabled', false);

												if (title.trim() === "") $(".title").addClass('errorClass');
												if (industries_id === "") $(".industries_id").addClass('errorClass');
												if (type === 'add' && !successstories_image) $(".successstories_image").addClass('errorClass');

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
										<!-- <a href="javascript:void(0)" id="save_btn" onclick="return saveBtn('save_btn','save');" class="btn btn-primary btn-sm submit_btn_bottom">Save Bottom</a> -->
										<button type="submit" name="save_btn" id="save_btn" onclick="return saveBtn('save_btn');" title="Save & Continue" class="btn btn-primary btn-sm form_submit_valid">Save</button>
										<button type="submit" name="submit_btn" id="submit_btn" onclick="return saveBtn('submit_btn');" title="Submit" class="btn btn-primary btn-sm form_submit_valid">Submit</button>
										<?php
									}
								?>
								<a href="<?php echo base_url(); ?>successStories/manageSuccessStories" class="btn btn-default btn-sm">Close</a>
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
									<a href="<?php echo base_url(); ?>successStories/manageSuccessStories/add" class="btn btn-info btn-sm">
										Create Success Story
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
									<label class="col-form-label col-md-5 text-right industries_id">Industry Name</label>
									<div class="form-group col-md-7">
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
									<label class="col-form-label col-md-5 text-right">Title</label>
									<div class="form-group col-md-7">
										<input type="search" class="form-control" name="keywords" value="<?php echo !empty($_GET['keywords']) ? $_GET['keywords'] :""; ?>" placeholder="Title" autocomplete="off">
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
						</div>
						<div class="row mb-3">
							<div class="col-md-12 text-right float-right">
								<button type="submit" class="btn btn-info">Search <i class="fa fa-search"></i></button>
								<a href="<?php echo base_url(); ?>successStories/manageSuccessStories" title="Clear" class="btn btn-default">Clear</a>
							</div>
						</div>
					</form>
					<!-- Filters end here -->

					<?php
						if(isset($_GET) &&  !empty($_GET))
						{
							if( isset($resultData) && count($resultData) > 0 )
							{
								?>
									<!-- Page Item Show start -->
									<div class="row mt-3">
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
									</div>
								<?php
							
							}
						?>
							
						<!-- Page Item Show start -->

							<!-- Table start here -->
							<div class="new-scroller">
								<table id="myTable" class="table table-bordered table-hover tbl_height">
									<thead>
										<tr>
											<th class="text-center tab-md-100">Controls</th>
											<th class="text-left tab-md-140">Industry Name</th>
											<th class="text-left tab-md-140">Title</th>
											<th class="text-center tab-md-120">Image</th>
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
																						<a title="Edit" href="<?php echo base_url(); ?>successStories/manageSuccessStories/edit/<?php echo $row['successstories_id'];?>/">
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
																					<a title="View" href="<?php echo base_url(); ?>successStories/manageSuccessStories/view/<?php echo $row['successstories_id'];?>/">
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
																							<a class="unblock" href="<?php echo base_url(); ?>successStories/manageSuccessStories/status/<?php echo $row['successstories_id'];?>/N" title="Inactive">
																								<i class="fa fa-ban"></i> Inactive
																							</a>
																							<?php 
																						} 
																						else
																						{  ?>
																							<a class="block" href="<?php echo base_url(); ?>successStories/manageSuccessStories/status/<?php echo $row['successstories_id'];?>/Y" title="Active">
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
													<td><?php echo ucfirst($row['title']);?></td>
													<td class="text-center">
														<?php 
															if(isset($row['successstories_id']))
															{
																$url = "uploads/case_studies/".$row['successstories_id'].".png";
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











