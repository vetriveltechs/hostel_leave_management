<style>
	.section-new-1 {
		padding: 17px 10px;
	}

	span.users-section.purchase {
		color: #007de9;
		font-size: 18px;
	}
	span.users-section.expenses {
		color: #ff7600;
		font-size: 18px;
	}	
	span.users-section-count.purchase{
		color: #007de9;
		font-family: roboto !important;
	}
	span.users-section-count.expenses{
		color: #ff7600;
	}
	.new-icons {
		/* background: #f58d17; */
		position: relative;
		left: 7px;
		top: 1px;
		border-radius: 6px;
		color: #fff;
		width: auto;
		text-align: center;
	}
	.count-name {
		position: relative;
		left: 10px;
	}
	i.products {
		position: relative;
		color: #fff;
		background: #df3434;
		font-size: 20px;
		padding: 10px;
		border-radius: 5px;
	}
	i.suppilers {
		position: relative;
		color: #fff;
		background: #77773c;
		font-size: 20px;
		padding: 10px;
		border-radius: 5px;
	}
	i.employee {
		color: #fff;
		position: relative;
		color: #fff;
		background: #ffa64d;
		font-size: 20px;
		padding: 10px;
		border-radius: 5px;
	}
	i.customer {
		color: #fff;
		position: relative;
		color: #fff;
		background: #29a329;
		font-size: 20px;
		padding: 10px;
		border-radius: 5px;
	}
	i.users
	{
		color: #fff;
		position: relative;
		color: #fff;
		background: #1ac6ff;
		font-size: 20px;
		padding: 10px;
		border-radius: 5px;
	}
	.chart {
		background: #fff;
		/* box-shadow: 0px 0px 8px 0px #cfcfcf; */
	}
	.section-new-1.mb-3.dashboard-gradients {
		/* box-shadow: 0px 0px 8px 0px #cfcfcf; */
	}
	span.sales-text {
		position: relative;
		top: 20px;
		left: 2px;
		font-weight: 700;
		border: 1px solid #409bdc;
		padding: 10px;
		border-radius: 50px;
		color: #409bdc;
		background-color: #e8f5ff;
	}
	@media (max-width: 667px){
	  .right-side-down {
		 padding-left:0px!important;
	  }}
	select.newselectList {
		padding: 6px 10px;
		border: 1px solid #d3caca;
		border-radius: 3px;
	}
	select.newselectList:focus {
		outline:none!important;
	}
	select.newselectList option.newselectListoption {
	
	}

.new-card {
    float: left;
    width: 100%;
    background: #fff;
    padding: 15px 10px;
    color: #000;
}

.new-card span.icon {
    color: #fff;
    padding: 8px 12px;
    border-radius: 6px;
    float: left;
}

.new-card span.card-count {
    font-size: 30px;
    font-weight: bold;
    position: relative;
    left: 30px;
    top: -5px;
}

span.card-count-category {
    position: relative;
    top: 16px;
    left: -12%;
}
span.icon.customers {
    background: #46bf87;
}

span.icon.users {
    background: #a146bf;
}

span.icon.suppliers {
    background: #4676bf!important;
    margin: 0;
}

span.icon.employees {
    background: #bf4678!important;
    margin: 0;
}
span.icon.purchase {
    background: #7b68c4!important;
    margin: 0;
}span.icon.sales {
    background: #4aacb8!important;
    margin: 0;
}
span.icon.products {
    background: #acbf46;
}
span.icon.invoice {
    background: #aa83de;
}
span.icon.consumer {
    background: #9aa1b6;
}

</style>
<script src="<?php echo base_url();?>assets/backend/assets/js/Chart.min.js"></script>	

<!-- Content area -->
	<div class="content">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box2">
					<?php
						if($this->reg_user_type=='STUDENT')
						{
							$loginName		= $this->student_name;
						}
						else if($this->reg_user_type=='STAFF')
						{
							$loginName		= $this->staff_name;
						}
						else
						{
							$loginName		= "Admin";
						}
					?>
					<h4 class="page-title page-title-dashboard">Welcome <?php echo $loginName;?> !</h4>
					
					
				</div>
			</div>
			<?php 
					if($this->reg_user_type=='STUDENT')
					{
						$getLeaveHistory	= $this->leave_request_model->getLeaveHistory($this->student_id);

						$leaveVariable		= "Leave History";
					}
					else
					{
						$getLeaveHistory	= $this->leave_request_model->getLeaveHistory('ALL');

						$leaveVariable		= "Leave Request";

					}
					?>
						<div class="col-md-12 mt-3">
							<div class="customer-cards">
								<div class="card p-3" style='overflow-x:auto !important;'>
									<h4><b><?php echo $leaveVariable;?></b></h4>
									<table id="myTable" class="table table-bordered" style='overflow-x:auto !important;'> 
										<thead>
											<tr>
												<?php 
													if(strtolower($this->role_code)=='warden' || $this->user_id == 1)
													{
														?>
															<th class='tab-md-150'>Action</th>
														<?php
													}
												?>
												<th class='tab-md-120'>Student Name</th>
												<th class='tab-md-120'>Leave Days</th>
												<th class='tab-md-170'>Reason</th>
												<th class='tab-md-170'>Room Number</th>
												<th class='tab-md-170'>From Date</th>
												<th class='tab-md-120'>To Date</th>
												<th class='tab-md-140'>Requested Date</th>
												<th class='tab-md-140'>Approved Status</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($getLeaveHistory as $row) 
												{ 
													?>
													<tr>
														<?php 
															if(strtolower($this->role_code)=='warden' || $this->user_id == 1)
															{
																?>
																<td>
																	<?php
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
																		
																	?>
																</td>
																<?php
															}
														?>
														<td><?php echo ucfirst($row['student_name']); ?></td>
														<td><?php echo $row['leave_days']; ?></td>
														<td><?php echo ucfirst($row['reason']); ?></td>
														<td><?php echo ucfirst($row['room_number']); ?></td>
														<td><?php echo date('d-M-Y', strtotime($row['from_date'])); ?></td>
														<td>
															<?php 
																if($row['to_date'] != NULL)
																{
																	echo date('d-M-Y', strtotime($row['to_date'])); 
																}
															?>
														</td>
														<td>
															<?php 
																if($row['created_date'] != NULL)
																{
																	echo date('d-M-Y', strtotime($row['created_date'])); 
																}
															?>
														</td>
														<td>
															<?php 
																if($row['leave_approved_status'] == 'PENDING' )
																{
																	?>
																	<span class="btn btn-outline-in-progress btn-sm"><?php echo ucfirst(strtolower($row['leave_approved_status'])); ?></span>
																	<?php
																}
																else if($row['leave_approved_status'] == 'REJECT')
																{
																	?>
																		<span class="btn btn-outline-pending btn-sm"><?php echo ucfirst(strtolower($row['leave_approved_status'])); ?></span>
																	<?php
																}
																else if($row['leave_approved_status'] == 'APPROVED')
																{
																	?>
																	<span class="btn btn-outline-success btn-sm"><?php echo ucfirst(strtolower($row['leave_approved_status'])); ?></span>
																	<?php
																}
															?>
														</td>
														
														
													</tr>
													<?php 
												} 
												
											?>
										</tbody>
										<?php
											if(count($getLeaveHistory) == 0)
											{
												?>
												<div class="text-center">
													<img src="<?php echo base_url();?>uploads/nodata.png">
												</div>
												<?php
											}
										?>
									</table>
								</div>
							</div>
						</div>
					<?php
				
				
			?>
		</div>

		
	</div>

	
