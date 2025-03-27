<div class="content"><!-- Content start-->
	<div class="card"><!-- Card start-->
		<div class="card-body">

			<div class="row">
				<div class="col-md-6">
					<h3><b><?php echo $page_title;?></b></h3>
				</div>

				<div class="col-md-6 text-right">
					<h5><b>Currency : <?php echo CURRENCY_CODE;?> </b></h5>
				</div>									
			</div>

			<!-- Filters start here -->
			<div class="search-form">
				<form action="" class="form-validate-jquery" method="get" >
					
					<div class="row mt-2">
						<div class="col-md-4">
							<div class="row">
								<label class="col-form-label col-md-5 text-right">Captain Name</label>
								<div class="form-group col-md-7">
									<?php
										
										$getCaptain = $this->employee_model->getCaptainAll();
									?>
									
									<select id="user_id" name="user_id" class="form-control searchDropdown">
										<option value="">- Select -</option>
										<?php 
											foreach($getCaptain as $captain)
											{
												$selected="";
												if(isset($_GET["user_id"]) && $_GET["user_id"] == $captain['user_id'] )
												{
													$selected="selected='selected'";
												}
												?>
												<option value="<?php echo $captain['user_id'];?>" <?php echo $selected;?>><?php echo ucfirst($captain['user_name']);?></option>
												<?php 
											} 
										?>
									</select>
								</div>
							</div>
						</div>
		

						<div class="col-md-3">
							<div class="row">
								<label class="col-form-label col-md-5 text-right"><span class="text-danger">*</span> From Date</label>
								<div class="form-group col-md-7">
									<input type="text" name="from_date" placeholder="From Date" readonly required id="from_date" autocomplete="off" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ""; ?>" class="form-control">
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="row">
								<label class="col-form-label col-md-5 text-right"><span class="text-danger">*</span> To Date</label>
								<div class="form-group col-md-7">
									<input type="text" name="to_date" placeholder="To Date" readonly required id="to_date" autocomplete="off" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : "" ;?>" class="form-control">
								</div>
							</div>
						</div>
						
						<div class="col-md-2">
							<button type="submit" id="filter_search" class="btn btn-info">Search <i class="fa fa-search" aria-hidden="true"></i></button>
							<a href="<?php echo base_url(); ?>summary/captainWiseSalesReport" title="Clear" class="btn btn-default">Clear</a>
						</div>
					</div>

				</form>
			</div>
			<!-- Filters end here -->

			<?php 
				if(isset($_GET) && !empty($_GET))
				{
					?>
						<?php 
							if(count($resultData) > 0)
							{
								?>
									<!-- Page Item Show start -->
									<div class="row">
										<div class="col-md-8 mt-3">
											<a href="<?php echo base_url().$this->redirectURL.'&download_excel=download_excel'; ?>" title="Download to Excel" class="btn btn-primary btn-sm">Download to Excel</a>	
										</div>

										<div class="col-md-4 text-right">
											<?php 
												$redirect_url = substr($_SERVER['REQUEST_URI'],'1');
											?>
											<input type="hidden" id="redirect_url" value="<?php echo $redirect_url; ?>"/>
																	
											<?php /*
												?>
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
												<?php
											*/ ?>
										</div>
									</div>
									<!-- Page Item end start -->
								<?php 
							} 
							
							if(count($resultData) == 0)
							{
								?>
								<div class="col-md-12 float-left text-center"> 
									<img src="<?php echo base_url();?>uploads/nodata.png">
								</div>
								<?php 
							} 
						?>
						
						<?php /*
							?>
								<div class="new-scroller">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th class="tab-md-150">Branch</th>
												<th class="tab-md-120">Order Number</th>
												<th class="tab-md-120">Captain Name</th>
												<th class="tab-md-120">Customer Name</th>
												<th class="tab-md-120">Mobile Number</th>
												<th class="tab-md-120">Order Status</th>
												<th class="tab-md-150 text-right">Total Order Amount</th>
												<th class="tab-md-120 text-right">Offer Amount</th>
												<th class="tab-md-120 text-right">Tax Amount</th>
												<th class="tab-md-120 text-right">Payment Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach($resultData as $row)
												{
													?>
													<tr>
														<td>
															<?php echo $row['branch_name'];?>
														</td>

														<td>
															<?php echo $row['order_number'];?>
														</td>

														<td>
															<?php echo $row['captain_name'];?>
														</td>
														<td>
															<?php echo $row['customer_name'];?>
														</td>
														<td>
															<?php echo $row['mobile_number'];?>
														</td>
														<td>
															<?php echo $row['order_status'];?>
														</td>

														<td class="text-right">
															<?php echo number_format($row['total_order_amount'],DECIMAL_VALUE,'.','');?>
														</td>

														<td class="text-right">
															<?php echo number_format($row['offer_amount'],DECIMAL_VALUE,'.','');?>
														</td>

														<td class="text-right">
															<?php echo number_format($row['tax_amount'],DECIMAL_VALUE,'.','');?>
														</td>

														<td class="text-right">
															<?php echo number_format($row['payment_amount'],DECIMAL_VALUE,'.','');?>
														</td>
													</tr>
													<?php
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
							<?php
						?>
					
						<?php 
							if(count($resultData) > 0)
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
						*/ ?>
					<?php 
				} 
			?>

		</div><!-- Card body end-->
	</div><!-- Card end-->
</div><!-- Content end-->

<script>
	function askConfirm(id,val) 
	{ 
		var status_array = {
			<?php 
				foreach ($this->order_status as $key => $status) 
				{ 
					?>
						"<?php echo $key?>":"<?php echo $status?>",
					<?php
				}
			?>
		};
		var confrim = confirm(`Do you Want to change the Status to ${status_array[val]} ?`);

		if (confrim) {
			$.ajax({
				url: '<?php echo base_url();?>orders/ManageOrders/status/'+id+'/'+val,
				type: 'GET',
				data: {},
				success: function(response)
				{   
					location.reload();
				}
			});	
		}
	}
	/*
	setInterval(function()
		{
			//order_dashboard();
			
			$.ajax({
				url: '<?php //  echo base_url();?>orders/checkNewOrders',
				type: 'GET',
				data: {},
				success: function(result)
				{   
                    if (result > 0) 
                    {
                        AjaxappendTable();
                    }
				}
			});
			
			getcount(); 
		},
	);
	*/

	function AjaxappendTable() 
	{
		$.ajax({
			url: '<?php echo base_url();?>orders/AjaxappendTable',
			type: 'GET',
			data: {},
			success: function(result)
			{   
				data = JSON.parse(result);
				
				//$("#table_body").prependTo(data['newOrders']);
				
				$("#table_body").html(data['newOrders']);

				$.ajax({
					url: '<?php echo base_url();?>orders/AjaxNotification',
					type: 'post',
					data: {},
					success: function(result)
					{
						
					}
				});
			}
		});	
	}
</script>


<script type="text/javascript">  
	$('#select_all_1').on('click', function(e) 
	{
		if($(this).is(':checked',true)) 
		{
			$(".emp_checkbox_1").prop('checked', true);
		}
		else 
		{
			$(".emp_checkbox_1").prop('checked',false);
		}
		/* set all checked checkbox count
		$("#select_count").html($("input.emp_checkbox:checked").length+" Selected"); */
	});
	
	
	//Select all checkbox
	$('#select_all').on('click', function(e) 
	{
		if($(this).is(':checked',true)) 
		{
			$(".un-delete-btn").addClass('delete-btn');
			$('.delete-btn').removeClass('un-delete-btn');
			
			$(".emp_checkbox").prop('checked', true);
		}
		else 
		{
			$('.delete-btn').addClass('un-delete-btn');
			$(".un-delete-btn").removeClass('delete-btn');
			
			$(".emp_checkbox").prop('checked',false);
		}
		/* set all checked checkbox count
		$("#select_count").html($("input.emp_checkbox:checked").length+" Selected"); */
	});
	
	$('.emp_checkbox').on('click', function(e) 
	{
		//alert("sd");
		if($(this).is(':checked',true)) 
		{
			$(".un-delete-btn").addClass('delete-btn');
			$('.delete-btn').removeClass('un-delete-btn');
		}
		else 
		{
			$('.delete-btn').addClass('un-delete-btn');
			$(".un-delete-btn").removeClass('delete-btn');
		}
	});	
</script>
