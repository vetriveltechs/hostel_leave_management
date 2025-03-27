<?php 
	$getEnquiryType	= $this->common_model->lov('ENQUIRY-TYPE')
?>
<div class="content"><!-- Content start-->
	<div class="card"><!-- Card start-->
		<div class="card-body">
			<!-- Buttons start here -->
			<div class="row">
				<div class="col-md-6"><h3><b><?php echo $page_title;?></b></h3></div>
				<div class="col-md-6 float-right text-right">
					
				</div>
			</div>
			
			<div class="row mt-1 mb-3">
				<div class="col-md-6" style="font-size:14px;">
					<a href="javascript:void(0);" onclick="showFilter();">
						<i class="fa fa-filter" aria-hidden="true"></i> <b>Search</b>
					</a>
				</div>
			</div>

			<?php
				if( isset($_GET) && !empty($_GET))
				{
					$displaySearch = 'style="display:block;"';
				}
				else
				{
					$displaySearch = 'style="display:none;"';
				}
			?>
			
			<!-- Filters start here -->
			<div class="search-form" <?php #echo $displaySearch;?>>
				<form action="" class="form-validate-jquery summary_form" method="get">
					<div class="row">
						<div class="col-md-4">
							<div class="row">
								<label class="col-form-label col-md-5">Enquiry Type</label>
								<div class="form-group col-md-7">
									<select name="enquiry_type" id="enquiry_type" class="form-control searchDropdown">
										<option value="">- Select -</option>
										<?php 
											foreach($getEnquiryType as $enquiryType)
											{
												$selected="";
												if(isset($_GET["enquiry_type"]) && $_GET["enquiry_type"] == $enquiryType['list_code'] )
												{
													$selected="selected='selected'";
												}
												?>
												<option value="<?php echo $enquiryType['list_code'];?>" <?php echo $selected;?>><?php echo ucfirst($enquiryType['list_value']);?></option>
												<?php 
											} 
										?>
									</select>
								</div>
							</div>
							<!-- <span class="search_required"></span> -->
						</div>
						<div class="col-md-4">
							<div class="row">
								<label class="col-form-label col-md-5">Keywords</label>
								<div class="form-group col-md-7">
								<input type="saerch" name="keywords" autocomplete="off" id="keywords" value="<?php echo isset($_GET['keywords']) ? $_GET['keywords'] : NULL; ?>" placeholder="First Name / Company Name / Company Email" class="form-control">
								</div>
							</div>
							<!-- <span class="search_required"></span> -->
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-info">Search <i class="fa fa-search"></i></button>
							<a href="<?php echo base_url(); ?>contactus/manageEnquiry" title="Clear" class="btn btn-default">Clear</a>
						</div>
						
					</div>
					
						
				</form>
			</div>
			
			<style>
				span.search_required {
					color: red;
				}
			</style>
			

			<?php 
				if(isset($_GET) &&  !empty($_GET))
				{
					?>
					<?php 
						if(count($resultData)>0)
						{
							?>
							<!-- Page Item Show start -->
							<div class="row">
								<div class="col-md-10 mt-3">
									<a href="<?php echo base_url().$this->redirectURL.'&download_excel=download_excel'; ?>" title="Download to Excel" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download to Excel</a>
								</div>

								<div class="col-md-2 float-right text-right">
									<?php 
										$redirect_url = substr($_SERVER['REQUEST_URI'],'1');
									?>
									<input type="hidden" id="redirect_url" value="<?php echo $redirect_url; ?>"/>
									
									<?php 
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
									?>
									
								</div>
							</div>
							
							<?php
						}	
					?>
						
					<div class="new-scroller">
						<table id="myTable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="tab-md-150">Service Name</th>
									<th class="tab-md-150">Industry Name</th>
									<th class="tab-md-150">Product Name</th>
									<th class="tab-md-150">First Name</th>
									<th class="tab-md-150">Last Name</th>
									<th class="tab-md-150">Company Name</th>
									<th class="tab-md-150">Company Email</th>
									<th class="tab-md-150">Message</th>
									<th class="tab-md-150">Created Date</th>
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
											<td><?php echo isset($row['service_name']) ? ucfirst($row['service_name']):'-';?></td>
											<td><?php echo isset($row['industries_name']) ? ucfirst($row['industries_name']):'-';?></td>
											<td><?php echo isset($row['product_name']) ? ucfirst($row['product_name']):'-';?></td>
											<td><?php echo ucfirst($row['first_name']);?></td>
											<td><?php echo ucfirst($row['last_name']);?></td>
											<td><?php echo $row['company_name'];?></td>
											<td><?php echo $row['company_email'];?></td>
											<td><?php echo $row['message'];?></td>
											<td><?php echo date('d-M-Y', strtotime($row['created_date'])); ?></td>
											
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
		</div>
	</div><!-- Card end-->
</div><!-- Content end-->
