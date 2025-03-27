<body class="grocino-home home2 grocino-contact-us">
<div class="account-setting">
	<div class="container">
		<div class="row">
			<div class="col-md-3 mb-3 pe-xl-5">
				<h2>Account</h2>	
				<ul class="nav flex-column nav-pills" id="settingTab" role="tablist" aria-orientation="vertical">
					<li class="nav-item">
						<a class="nav-link active" id="profile_setting_tab" data-bs-toggle="pill" data-bs-target="#profile_setting" role="tab" aria-controls="profile_setting" aria-selected="true"> <i class="fa fa-user"></i> Profile</a>
					</li>
			
					<li class="nav-item">
						<a class="nav-link" id="orderlist_tab" data-bs-toggle="pill" data-bs-target="#orderlist" role="tab" aria-controls="orderlist" aria-selected="true"> <i class="fa fa-shopping-bag"></i> My Order</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" id="my_wishlist_tab" data-bs-toggle="pill" data-bs-target="#my_wishlist" role="tab" aria-controls="my_wishlist" aria-selected="true"> <i class="fa fa-heart"></i> wishlist</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" id="my_address_tab" data-bs-toggle="pill" data-bs-target="#my_address" role="tab" aria-controls="my_address" aria-selected="true"> <i class="fa fa-map-marker-alt"></i>  Address</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" id="my_Logout_tab" href="logout.html" target="blank"> <i class="fa fa-sign-out"> </i> Logout</a>
					</li>
				</ul>
			</div>
			
			<div class="col-md-9">
				<div class="tab-content" id="settingTabContent">
					<div class="tab-pane fade show active" id="profile_setting" role="tabpanel" aria-labelledby="profile_setting_tab">
						<h2>Profile setting</h2>
						<div class="profile_settingright">
							<!-- form section here -->
							<div class="ui equal width form">
								<form method="post">
									<div class="fields">
										<div class="one wide field">
											<div class="profile-upload">
												<div class="profile-edit">
													<input type='file' id="imgUpload" accept=".png, .jpg, .jpeg" />
													<label for="imgUpload"></label>
												</div>
												<div class="profile-preview">
													<div id="imgPreview">
														<img src="img/profile-pic.png" alt="Profile" />
													</div>
												</div>
											</div>
										</div>
										<div class="eleven wide field mb-0">
											<div class="fields">
												<div class="field">
													<label for="input_username"> Username</label>
													<input type="text" name="username" id="input_username" placeholder="Username" />
												</div>
												
												<div class="field">
													<label for="input_emailid"> Email id</label>
													<input type="email" name="email-id" id="input_emailid" placeholder="Email id" />
												</div>
											</div>
											<div class="fields">
												<div class="field">
													<label for="input_pwd"> Password</label>
													<input type="password" name="password" id="input_pwd" placeholder="Password" />
												</div>
												
												<div class="field">
													<label for="input_cpwd">Confirm Password</label>
													<input type="password" name="cpassword" id="input_cpwd" placeholder="Confirm Password" />
												</div>
											</div>
											<div class="fields">
												<div class="field">
													<label for="input_number"> Mobile Number</label>
													<input type="tel" name="number" id="input_number" placeholder="Mobile Number" />
												</div>
												
												<div class="field">
													<label for="input_landline">Landline (option)</label>
													<input type="tel" name="landline" id="input_landline" placeholder="Landline (option)" />
												</div>
											</div>
										</div>		
									</div>
								
									<div class="field mb-0">
										<div class="fields">
											<div class="field">
												<label for="input_fname"> First name</label>
												<input type="text" name="fname" id="input_fname" placeholder="First name" />
											</div>
											<div class="field">
												<label for="input_lname"> Last name</label>
												<input type="text" name="lname" id="input_lname" placeholder="Last name" />
											</div>
										</div>
										
										<div class="fields">
											<div class="field">
												<label for="input_company"> Company name</label>
												<input type="text" name="company" id="input_company" placeholder="Company name" />
											</div>
											<div class="field">
												<label for="input_website"> Website</label>
												<input type="text" name="website" id="input_website" placeholder="Website" />
											</div>
										</div>
										
										<div class="fields">
											<div class="field">
												<label for="input_altnumber"> Alternate Mobile Number</label>
												<input type="tel" name="altnumber" id="input_altnumber" placeholder="Alternate Mobile Number" />
											</div>
											<div class="field">
												<label for="input_gender"> Gender</label>
												<span class="custom-dropdown">
													<select name="gender" id="input_gender">
													<option value="gender">Gender</option>
													<option value="male">Male</option>
													<option value="female">Female</option>
												</select>
												</span>
											</div>
										</div>
									</div>
									
									<div class="fields">
										<div class="field">
											<label for="input_bio"> Your Bio</label>
											<textarea rows="5" id="input_bio" placeholder="Your Bio"></textarea>
										</div>
									</div>
									<button type="submit" class="btn btn-orange w-100"> Update </button>
								</form>
							</div>
							<!-- form section here -->
						</div>
					</div>
					
					<div class="tab-pane fade" id="orderlist" role="tabpanel" aria-labelledby="orderlist_tab">
						<h2>My Order List</h2>
						<div class="order-setting">
							<div class="order-main">
								<div class="order-list btm-border">
									<ul class="order-img pt-0">
										<li class="img-product">
											<a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">
												<img src="img/p1.png" alt="Product image">
											</a>
										</li>
										<li>
											<p> <strong><a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">Kashmiri Tomato /2kg</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<p> <i class="fa fa-circle" aria-hidden="true"></i>
												<strong> Delivery date 26 sept 2021</strong>
											</p> 
											<p> Your order has delivered </p> 
											<p class="order-review"> 
												<i class="fa fa-star" aria-hidden="true"></i> Rate & Review Product
											</p> 
										</li>
									</ul>
								</div>
								<div class="order-list btm-border">
									<ul class="order-img">
										<li class="img-product">
											<a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">
												<img src="img/p2.png" alt="Product image">
											</a>
										</li>
										<li>
											<p> <strong><a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">Himachal Apple</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<p> <i class="fa fa-circle" aria-hidden="true"></i>
												<strong> Delivery date 30 sept 2021</strong>
											</p> 
											<p> Your order has delivered </p> 
											<p class="order-review"> 
												<i class="fa fa-star" aria-hidden="true"></i> Rate & Review Product
											</p> 
										</li>
									</ul>
								</div>
								<div class="order-list btm-border">
									<ul class="order-img">
										<li class="img-product">
											<a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">
												<img src="img/p1.png" alt="Product image">
											</a>
										</li>
										<li>
											<p> <strong><a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">Kashmiri Tomato /2kg </a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<p> <i class="fa fa-circle" aria-hidden="true"></i>
												<strong> Delivery date 22 sept 2021</strong>
											</p> 
											<p> Your order has delivered </p> 
											<p> 
												<i class="fa fa-star" aria-hidden="true"></i> You have given review
											</p> 
										</li>
									</ul>
								</div>
								<div class="order-list btm-border">
									<ul class="order-img">
										<li class="img-product">
											<a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">
												<img src="img/p2.png" alt="Product image">
											</a>
										</li>
										<li>
											<p> <strong><a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">Himachal Apple</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<p> <i class="fa fa-circle" aria-hidden="true"></i>
												<strong> Delivery date 26 sept 2021</strong>
											</p> 
											<p> Your order has delivered </p> 
											<p> 
												<i class="fa fa-star" aria-hidden="true"></i> You have given review
											</p> 
										</li>
									</ul>
								</div>
								<div class="order-list">
									<ul class="order-img">
										<li class="img-product">
											<a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">
												<img src="img/p1.png" alt="Product image">
											</a>
										</li>
										<li>
											<p> <strong><a id="my_Order_tab" data-toggle="tab" href="#my_Order" role="tab">Kashmiri Tomato /2kg</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<p> <i class="fa fa-circle" aria-hidden="true"></i>
												<strong> Delivery date 26 sept 2021</strong>
											</p> 
											<p> Your order has delivered </p> 
											<p class="order-review"> 
												<i class="fa fa-star" aria-hidden="true"></i> Rate & Review Product
											</p> 
										</li>
									</ul>
								</div>
							</div>
						</div>
						
						<ul class="pagination">
							<li class="page-item active"><a class="page-link" href="customer-account.html">1</a></li>
							<li class="page-item">
								<a class="page-link" href="customer-account.html">2 <span class="sr-only">(current)</span></a>
							</li>
							<li class="page-item">
								<a class="page-link" href="customer-account.html"><i class="fa fa-angle-right"></i></a>
							</li>
						</ul>
					</div>
					
					<div class="tab-pane fade" id="my_Order" role="tabpanel" aria-labelledby="my_Order_tab">
						<h2>My Order</h2>
						<div class="order-setting">
							<div class="btm-border">
								<div class="order-heading pt-0">
									Delivery Time 10 Feb 2020, 8.00AM - 6.00PM
								</div>
							</div>
							<div class="order-main">
								<div class="order-list btm-border">
									<ul class="order-img">
										<li class="img-product"><img src="img/p1.png" alt="Product image" /> </li>
										<li>
											<p> <strong>Kashmiri Tomato /2kg</strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
									</ul>
								</div>
								<div class="order-list btm-border">
									<ul class="order-img">
										<li class="img-product"><img src="img/p2.png" alt="Product image" /> </li>
										<li>
											<p> <strong>Himachal Apple</strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
									</ul>
								</div>
								<div class="order-list">
									<div class="total-order">
										<div class="row mb-3">
											<div class="col">
												<p>Sub Total</p>
											</div>
											<div class="col">
												<p class="text-end"> $277</p>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col">
												<p>Delivery Charges</p>
											</div>
											<div class="col">
												<p class="text-end"> $5</p>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col">
												<p>Service Tax</p>
											</div>
											<div class="col">
												<p class="text-end"> $10</p>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<p> <strong> Total </strong></p>
											</div>
											<div class="col">
												<p class="text-end"> <strong> $292 </strong></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
							
					<div class="tab-pane fade" id="my_wishlist" role="tabpanel" aria-labelledby="my_wishlist_tab">
						<h2>Wishlist</h2>
						<div class="order-setting">
							<div class="order-main">
								<div class="order-main-top btm-border">
									<ul class="order-img pt-0">
										<li class="img-product">
											<a href="#"><img src="img/p1.png" alt="Product image"></a>
										</li>
										<li>
											<p> <strong><a href="#">Kashmiri Tomato /2kg</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<button class="btn btn-del">
												<i class="uil uil-trash-alt"> </i> 
											</button>
										</li>
									</ul>
								</div>
								<div class="order-main-top btm-border">
									<ul class="order-img">
										<li class="img-product">
											<a href="#"><img src="img/p2.png" alt="Product image"></a>
										</li>
										<li>
											<p> <strong><a href="#"> Himachal Apple</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<button class="btn btn-del">
												<i class="uil uil-trash-alt"> </i> 
											</button>
										</li>
									</ul>
								</div>
								<div class="order-main-top btm-border">
									<ul class="order-img">
										<li class="img-product">
											<a href="#"><img src="img/p1.png" alt="Product image"></a>
										</li>
										<li>
											<p> <strong><a href="#">Kashmiri Tomato /2kg</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<button class="btn btn-del">
												<i class="uil uil-trash-alt"> </i> 
											</button>
										</li>
									</ul>
								</div>
								
								<div class="order-main-top">
									<ul class="order-img">
										<li class="img-product">
											<a href="#"><img src="img/p2.png" alt="Product image"></a>
										</li>
										<li>
											<p> <strong><a href="#"> Himachal Apple</a></strong></p> 
											<p> Green vegetables </p> 
											<p> Delivered by supermarket</p> 
											<p> Price:- $65 </p> 
										</li>
										<li class="right-order">
											<button class="btn btn-del">
												<i class="uil uil-trash-alt"> </i> 
											</button>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="tab-pane fade" id="my_address" role="tabpanel" aria-labelledby="my_address_tab">
						<h2> My Address</h2>
						<div class="order-setting">
							<div class="btm-border">
								<div class="order-heading">
									<button class="btn btn-left"><i class="uil uil-home-alt"></i></button>
									8/33 Hemlaton road manchester 25 
								</div>
							</div>
							<div class="btm-border">
								<div class="order-heading">
									<button class="btn btn-left"><i class="uil uil-globe"></i> </button>
									Ludhiana, Punjab, India
								</div>
							</div>
							<div class="order-heading">
								<button class="btn btn-left"><i class="uil uil-phone-alt"></i></button> 
								+44 0161-88559944
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Account setting end here -->

<!-- Newsletter area start here -->
<div class="grocino-newsletter">
	<img src="img/home/newsletter-bg.png" alt="image" title="image" class="img-fluid"/>
	<div class="newsletter-inner">
		<div class="container">
			<div class="row">
				<div class="col-12 col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto">
					<div class="grocino-heading">
						<h2 class="heading_text">Subscribe Our <span>Newsletter</span></h2> 
					</div>
					<form method="post">
						<div class="position-relative">
							<input type="email" name="email" id="e_mail" class="form-control" placeholder="Enter Your email address" required />
							<input type="submit" class="btn btn-subscriber" value="Subscriber" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>