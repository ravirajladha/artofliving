<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Donation</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="/assets2/css/nunito-font.css">
	<link rel="stylesheet" type="text/css" href="/assets2/fonts/material-design-iconic-font/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- Main Style Css -->
	<link rel="stylesheet" href="/assets2/css/style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- partial:index.partial.html -->
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<!-- Swal fire -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
	<!-- partial -->
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="./script.js"></script>
</head>

<body>
	<div id='stars'></div>
	<div id='stars2'></div>
	<div id='stars3'></div>
	<div id='title'></div>

	<?php //$otp_new = str_pad(rand(1111, 9999), 4, "0", STR_PAD_LEFT); 
	?>
	<?php $otp_new = 5555; ?>

	<div class="page-content" style="min-height:800px">
		<div class="wizard-v5-content">
			<div class="wizard-form">
				<form class="form-register" id="form-register" action="/makePayment" method="post">
					@csrf
					<div id="form-total">
						<!-- SECTION 1 -->
						<h2>
							<span class="step-icon"><i class="zmdi zmdi-check"></i></span>
							<span class="step-text">Donation Details</span>
						</h2>

						<input type="hidden" name="user_id" value="{{session('rexkod_user_id', null)}}">
						<section>
							<div class="inner">
								<div class="wrapper">
									<center><img src="/assets/donation2.png" class="img-fluid" alt="" width="450"></center>
									<br>
									<style>
										@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');
									</style>

									<?php
								
								if (!empty($data['events'])) {
									$event_name = $data['events']['event_name'];
									$venue = $data['events']['venue_name'];
									$date = $data['events']['event_start_date'];
									 $location_pass= $data['events']['location_pass'];
									$newDate = date("d-M-Y", strtotime($date));
								} else {
									$event_name = "Vigyan Bhairav";
									$venue = "PUNE";
									$location_pass="";
									$date = date("Y-m-d");
									$newDate = date_create($date)->modify("+1 day")->format("d-M-Y");
								}
								
								// Output the event_name variable
								

									?>
									<p class="text-center" style="color: #5cfffd;font-family: 'Roboto Condensed', sans-serif;font-weight: 900;font-size: 2rem;">{{$event_name}}</p>
									<p class="text-center" style="color: #fff;font-family: 'Roboto Condensed', sans-serif;font-weight: 900;font-size: 2rem;">With Gurudev</p>
									<p class="text-center" style="color: #5cfffd;font-family: 'Roboto Condensed', sans-serif;font-weight: 900;font-size: 2rem;">{{$venue}}&nbsp;,&nbsp;{{$newDate}}</p>
									<br>
									<div class="form-row">

										<div class="form-holder">
											<label for="donation">Donation</label>
											<select onchange="remove_multiple()" name="type" id="donation" class="form-control">
												<!-- <option value="1">Premium (₹5000)</option>
												<option value="2">Gold (₹3000)</option>
												<option value="3">Silver (₹2000)</option>
												<option value="4">General (₹1000)</option> -->
												<?php
												echo '<pre>';
												for ($i = 0; $i < count($data['categories']); $i++) { ?>
													<option value="<?php echo $data['values'][$i]; ?>">
														<?php echo $data['categories'][$i]; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-holder">
											<label for="multiple">Multiples</label>
											<input onkeyup="donation_check()" type="number" placeholder="Enter Multiples" class="form-control" id="multiple" name="multiples">
										</div>

										<div class="form-holder">
											<label for="total ">Total</label>
											<input readonly type="text" class="form-control" id="total" name="amount">
										</div>

									</div>

								</div>
						</section>

						<!-- SECTION 2 -->
						<h2>
							<span class="step-icon"><i class="zmdi zmdi-check"></i></span>
							<span class="step-text">Donor Details</span>
							<input type="hidden" value="<?php echo $event_name;  ?>" name="event_name">
							
							<input type="hidden" name="event_id" value="{{ $data['event_id'] ?? 'null' }}">

						</h2>

						<section>
							<div>
								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Personal </button>
										<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Corporate </button>
									</div>
								</nav>

								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
										<div class="inner"><br><br>
											<div class="form-row">

												<div class="form-holder form-holder-3">
													<label for="phone">Phone Number</label>
													@if(session('phone')!='null')
													<input onkeyup="checkphn(this.value);" type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="mobile_number" value="{{session('phone')}}" >
												    @else
													<input onkeyup="checkphn(this.value);" type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="mobile_number" >
                                                   @endif
												</div>

												<div class="form-holder">
													<label for="code">Enter OTP</label>
													<div class="row">
														<div class="col-8" style="padding-right: 0px !important;">
															<input type="password" class="inputo" />
														</div>

														<div class="col-md-4">
															<input onclick="valid()" id="validate" style="margin-top:0px;padding:10px 0px" class="btn btn-warning" type="button" value="Validate">
														</div>
													</div>

												</div>
											</div>

											<div id="personal_info">
												<div class="form-row">
													<div class="form-holder">
														<label for="first_name_p">First Name</label>
														<input type="text" placeholder="Enter First Name" class="form-control" id="first_name_p" name="first_name">
														<input type="hidden" name="payment_mode" value="Online">
													</div>
													<div class="form-holder">
														<label for="last_name_p">Last Name</label>
														<input type="text" placeholder="Enter Last Name" class="form-control" id="last_name_p" name="last_name_p">
													</div>
												</div>
												<div class="form-row">
													<div id="radio">
														<label for="gender_p">Gender:</label>
														<input type="radio" name="gender_p" value="male" checked> Male
														<input type="radio" name="gender_p" value="female"> Female
													</div>
												</div>
												<div class="form-row">
													<div class="form-holder">
														<label for="email_p">Email</label>
														<input type="text" placeholder="Enter Email" class="form-control" id="email_p" name="email">
													</div>
													<div class="form-holder">
														<label for="pan_card">PAN</label>
														<div class="input-error-container">
															<input oninput="clearPANErrorMessage();" onblur="validatePANCardDetails();" type="text" placeholder="Enter PAN Card Details" class="form-control" id="pan_card" name="pan_card">
															<small id="panErrorMessage" class="error" style="color: red;"></small>
														</div>
													</div>
												</div>
												<div class="form-row">
													<div class="form-holder">
														<label for="aadhaar_card">Aadhaar</label>
														<div class="input-error-container">
															<input oninput="clearAadhaarErrorMessage();" onblur="validateAadhaarCardDetails();" type="text" placeholder="Enter Aadhaar Card Details" class="form-control" id="aadhaar_card" name="aadhaar_card">
															<small id="aadhaarErrorMessage" class="error" style="color: red;"></small>
														</div>
													</div>
												</div>
												<div class="form-row">
													<div class="form-holder form-holder-2">
														<label for="address_p">Address</label>
														<input type="text" placeholder="Enter Name" class="form-control" id="address_p" name="address">
													</div>
												</div>
												<div class="form-row">
													<div class="form-holder">
														<label for="pincode_p">Pincode</label>
														<input type="text" placeholder="Enter Pincode" class="form-control" id="pincode_p" name="pincode" onkeyup="find_pincode_p(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
													</div>
													<div class="form-holder">
														<label for="comm_block_p">City </label>
														<input type="text" placeholder="Enter City " class="form-control" id="comm_block_p" name="city" readonly>
													</div>
													<div class="form-holder">
														<label for="comm_state_p">State</label>
														<input type="text" placeholder="Enter State " class="form-control" name="state" id="comm_state_p" readonly>
													</div>
												</div>
											</div>

										</div>
									</div>

									<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
										<div class="inner"><br><br>
											<div class="form-row">
												<div class="form-holder form-holder-3">
													<label for="phone">Phone Number</label>
													<input onkeyup="checkphn(this.value);" type="text" placeholder="Enter Phone Number" class="form-control" id="phone_c" name="phone">
												</div>
												<div class="form-holder">
													<label for="code">Enter OTP</label>
													<div class="row">
														<div class="col-8" style="padding-right: 0px !important;">
															<input type="password" class="inputo_c" />
														</div>
														<div class="col-md-4">
															<input onclick="valid_c()" id="validate_c" style="margin-top:0px;padding:10px 0px" class="btn btn-warning" type="button" value="Validate">
														</div>
													</div>
												</div>
											</div>

											<div id="corporate_info">
												<div class="form-row">
													<div class="form-holder form-holder-2">
														<label for="company_name_c">Company Name</label>
														<input type="text" placeholder="Enter Name" class="form-control" id="company_name_c" name="company_name">
													</div>
												</div>

												<div class="form-row">
													<div class="form-holder">
														<label for="first_name_c">First Name</label>
														<input type="text" placeholder="Enter First Name" class="form-control" id="first_name_c" name="company_first_name">
													</div>
													<div class="form-holder">
														<label for="last_name_c">Last Name</label>
														<input type="text" placeholder="Enter Last Name" class="form-control" id="last_name_c" name="company_last_name">
													</div>
												</div>

												<div class="form-row">
													<div id="radio">
														<label for="company_gender_c" id="company_gender_c">Gender:</label>
														<input type="radio" id="male_radio" name="company_gender" value="male"> Male
														<input type="radio" id="female_radio" name="company_gender" value="female"> Female
													</div>
												</div>
												<div class="form-row">
													<div class="form-holder">
														<label for="email_c">Email</label>
														<input type="text" placeholder="Enter Email" class="form-control" id="email_c" name="company_email">
													</div>
													<div class="form-holder">
														<label for="company_pan">Company PAN</label>
														<div class="input-error-container">
															<input onchange="validateCompanyPAN();" oninput="clearCompanyPANErrorMessage();" type="text" placeholder="Enter Company PAN" class="form-control" id="company_pan" pattern="[A-Z]{5}\d{4}[A-Z]{1}" name="company_pan">
															<small id="companyPANErrorMessage" class="error text-danger"></small>
														</div>
													</div>
												</div>

												<div class="form-row">
													<div class="form-holder">
														<label for="company_aadhaar">Company Aadhaar</label>
														<div class="input-error-container">
															<input onchange="validateCompanyAadhaar();" oninput="clearCompanyAadhaarErrorMessage();" type="text" placeholder="Enter Company Aadhaar" class="form-control" id="company_aadhaar" pattern="[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}" name="company_aadhaar">
															<small id="companyAadhaarErrorMessage" class="error text-danger"></small>
														</div>
													</div>
												</div>

												<div class="form-row">
													<div class="form-holder form-holder-2">
														<label for="address_c">Address</label>
														<input type="text" placeholder="Enter Name" class="form-control" id="address_c" name="company_address">
													</div>

												</div>
												<div class="form-row">
													<div class="form-holder">
														<label for="pincode_c">Pincode</label>
														<input type="text" placeholder="Enter Pincode" class="form-control" id="pincode_c" name="company_pincode" onkeyup="find_pincode_c(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
													</div>
													<div class="form-holder">
														<label for="comm_block_c">City </label>
														<input type="text" placeholder="Enter City " class="form-control" id="comm_block_c" name="company_city" readonly>
													</div>
													<div class="form-holder">
														<label for="comm_state_c">State</label>
														<input type="text" placeholder="Enter State " class="form-control" name="company_state" id="comm_state_c" readonly>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>

						</section>
						<!-- SECTION 3 -->
						<h2>
							<span class="step-icon"><i class="zmdi zmdi-check"></i></span>
							<span class="step-text">Confirm Details</span>
						</h2>
						<section>
							<div class="inner">
								<h3>Confirm Details</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th>Name:</th>
												<td id="firstname-val"></td>
											</tr>
											<tr class="space-row">
												<th>Pan / Aadhaar</th>
												<td id="pan-val"></td>
											</tr>
											<tr class="space-row">
												<th>Gender:</th>
												<td id="gender-val"></td>
											</tr>
											<tr class="space-row">
												<th>Address:</th>
												<td id="address-val"></td>
											</tr>
											<tr class="space-row">
												<th>Email Address:</th>
												<td id="email-val"></td>
											</tr>

											<tr class="space-row">
												<th>Program</th>
												<td>{{$date}} , {{$event_name}} , {{ $venue}} , {{$location_pass}} </td>
											</tr>
											<tr class="space-row">
												<th>Donation</th>
												<td id="donation-val"></td>
											</tr>
                    
											<!-- <tr class="table-borderless">
												<td></td>
												<td class="text-end"><a href="/juspay" class="btn btn-light text-dark">Payment</a></td>
											</tr> -->
										


										</tbody>
									</table>

								</div>
								<button style="display:none" type="submit" class="form-control">Submit</button>
							</div>
						</section>
					</div>

				</form>
			</div>
		</div>
	</div>
	</form>
	<script src="/assets2/js/jquery-3.3.1.min.js"></script>
	<script src="/assets2/js/jquery.steps.js"></script>
	<script src="/assets2/js/main.js"></script>
</body>

</html>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
	function donation_check() {
		var donation_val = $('#donation').val();
		var donation = parseInt(donation_val); // Convert donation_val to integer
		var multiple_val = $('#multiple').val();
		var multiple = parseInt(multiple_val); // Convert multiple_val to integer
		var total = (donation * multiple);
		document.getElementById("total").value = total;
		$('#donation-va').text("₹" + total);
		document.getElementById('donation-val').innerText = "₹ " + total;
	}

	function remove_multiple() {
		document.getElementById("multiple").value = "";
		document.getElementById("total").value = "";
	}

	function valid() {
		var val = $('.inputo').val();
		var otpNew = "{{$otp_new}}";
		var phoneNumber = $('#phone').val();

		if (val.length == 4 && val == otpNew) {
			document.getElementById("validate").value = "Validated";
			$('#validate').addClass('btn-success').removeClass('btn-warning');
			$('#validate').css('color', '#fff');

			$.ajax({
				url: '/profile_load_details',
				type: 'GET',
				data: {
					phone: phoneNumber
				},
				success: function(response) {
					if (response.success) {
						console.log(response);
						var first_name = response.profileData[0].first_name;
						var last_name = response.profileData[0].last_name;
						var email = response.profileData[0].email;
						var gender = response.profileData[0].gender;
						var pan = response.profileData[0].pan;
						var aadhaar = response.profileData[0].aadhaar;
						var address = response.profileData[0].address;
						var pincode = response.profileData[0].pincode;
						var city = response.profileData[0].city;
						var state = response.profileData[0].state;
						var amount = response.profileData[0].amount;

						// Check the contents of profileData in the console

						// Update the UI with the profile data
						document.getElementById('first_name_p').value = first_name;
						document.getElementById('last_name_p').value = last_name;
						document.getElementById('email_p').value = email;

						// Update the gender radio button
						if (gender.trim() === 'male') {
							document.getElementById('male_radio').checked = true;
						} else if (gender.trim() === 'female') {
							document.getElementById('female_radio').checked = true;
						}

						document.getElementById('pan_card').value = pan;
						document.getElementById('aadhaar_card').value = aadhaar;
						document.getElementById('address_p').value = address;
						document.getElementById('pincode_p').value = pincode;
						document.getElementById('comm_block_p').value = city;
						document.getElementById('comm_state_p').value = state;

						//Confirm Details
						document.getElementById('firstname-val').innerText = first_name;
						document.getElementById('pan-val').innerText = pan;
						document.getElementById('gender-val').innerText = gender;
						document.getElementById('address-val').innerText = address;
						document.getElementById('email-val').innerText = email;
						// document.getElementById('donation-val').innerText = amount;

					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Unable to Load data!!',
							showConfirmButton: false,
							timer: 2000
						});
					}
				}
			});
		} else {
			// Handle invalid OTP case
			Swal.fire({
				icon: 'warning',
				title: 'Invalid Otp!',
				showConfirmButton: false,
				timer: 2000
			});
		}
	}

	function valid_c() {
		var val = $('.inputo_c').val();
		var otpNew = "{{$otp_new}}";
		var phoneNumber = $('#phone_c').val();
		if (val.length == 4 && val == otpNew) {
			document.getElementById("validate_c").value = "Validated";
			$('#validate_c').addClass('btn-success').removeClass('btn-warning');
			$('#validate_c').css('color', '#fff');

			$.ajax({
				url: '/corporate_load_details',
				type: 'GET',
				data: {
					phone: phoneNumber
				},
				success: function(response) {
					if (response.success) {
						var company_name = response.profileData[0].company_name;
						var first_name = response.profileData[0].first_name;
						var last_name = response.profileData[0].last_name;
						var email = response.profileData[0].email;
						var gender = response.profileData[0].gender;
						var pan = response.profileData[0].pan;
						var aadhaar = response.profileData[0].aadhaar;
						var address = response.profileData[0].address;
						var pincode = response.profileData[0].pincode;
						var city = response.profileData[0].city;
						var state = response.profileData[0].state;
						var amount = response.profileData[0].amount;

						document.getElementById('company_name_c').value = company_name;
						document.getElementById('first_name_c').value = first_name;
						document.getElementById('last_name_c').value = last_name;
						document.getElementById('email_c').value = email;
						document.getElementById('company_gender_c').value = gender;
						document.getElementById('company_pan').value = pan;
						document.getElementById('company_aadhaar').value = aadhaar;
						document.getElementById('address_c').value = address;
						document.getElementById('pincode_c').value = pincode;
						document.getElementById('comm_block_c').value = city;
						document.getElementById('comm_state_c').value = state;
						// Alternatively, you can use jQuery to set the value:
						// $('#company_name_c').val(company_name);

						document.getElementById('firstname-val').innerText = first_name;
						document.getElementById('pan-val').innerText = pan;
						document.getElementById('gender-val').innerText = gender;
						document.getElementById('address-val').innerText = address;
						document.getElementById('email-val').innerText = email;
						// document.getElementById('donation-val').innerText = amount;
					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Invalid Otp!',
							showConfirmButton: false,
							timer: 2000
						});
					}
				}
			});
		} else {
			// Handle invalid OTP case
			Swal.fire({
				icon: 'warning',
				title: 'Invalid Otp!',
				showConfirmButton: false,
				timer: 2000
			});
		}
	}

	function find_pincode_p(pin) {
		if (pin.length == 6) {
			$.ajax({
				url: '/pincode/' + pin,
				type: 'GET',
				success: function(res) {
					console.log(res);
					var detail = res.split(',');
					document.getElementById("comm_block_p").value = detail[0];
					document.getElementById("comm_state_p").value = detail[1];
				}
			});
		} else {
			document.getElementById("comm_block_p").value = "";
			document.getElementById("comm_state_p").value = "";
		}
	}

	function find_pincode_c(pin) {
		if (pin.length == 6) {
			$.ajax({
				url: '/pincode/' + pin,
				type: 'GET',
				success: function(res) {
					console.log(res);
					var detail = res.split(',');
					document.getElementById("comm_block_c").value = detail[0];
					document.getElementById("comm_state_c").value = detail[1];
				}
			});
		} else {
			document.getElementById("comm_block_c").value = "";
			document.getElementById("comm_state_c").value = "";
		}
	}

	function donation() {
		$('#form-register').submit();
	}


	function checkphn(phn) {
		if (phn.length == 10) {
			$.ajax({
				url: '/profile_sms_otp/' + phn + '/{{$otp_new}}',
				type: 'GET',
				success: function(res) {
					if (res == "true") {
						// Continue as it is
					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Number not registered!',
							showConfirmButton: false,
							timer: 2000
						});
						// Redirect to the registration page
						window.location.href = '/register';
					}
				},
				error: function() {
					Swal.fire({
						icon: 'error',
						title: 'Error occurred!',
						text: 'There was an error checking the phone number.',
						showConfirmButton: false,
						timer: 2000
					});
				}
			});
		}
	}
</script>

<script>
	function validatePANCardDetails() {
		var panInput = document.getElementById("pan_card");
		var panErrorDiv = document.getElementById("panErrorMessage");

		var panNumber = panInput.value.trim();
		var panErrorMessage = "";

		// PAN card validation logic
		var isValidPAN = validatePAN(panNumber);
		if (!isValidPAN) {
			panErrorMessage = "Please enter a valid PAN card number.";
		}

		// Display the PAN card error message in the panErrorMessage element
		panErrorDiv.textContent = panErrorMessage;
	}

	function validateAadhaarCardDetails() {
		var aadhaarInput = document.getElementById("aadhaar_card");
		var aadhaarErrorDiv = document.getElementById("aadhaarErrorMessage");

		var aadhaarNumber = aadhaarInput.value.trim();
		var aadhaarErrorMessage = "";

		// Aadhaar card validation logic
		var isValidAadhaar = validateAadhaar(aadhaarNumber);
		if (!isValidAadhaar) {
			aadhaarErrorMessage = "Please enter a valid Aadhaar card number.";
		}

		// Display the Aadhaar card error message in the aadhaarErrorMessage element
		aadhaarErrorDiv.textContent = aadhaarErrorMessage;
	}

	function validatePAN(cardNumber) {
		// PAN card validation logic
		var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
		return cardNumber.match(panRegex);
	}

	function validateAadhaar(cardNumber) {
		// Aadhaar card validation logic
		var aadhaarRegex = /^[0-9]{4} [0-9]{4} [0-9]{4}$/;
		return cardNumber.match(aadhaarRegex);
	}

	function clearPANErrorMessage() {
		var panErrorDiv = document.getElementById("panErrorMessage");
		panErrorDiv.textContent = "";
	}

	function clearAadhaarErrorMessage() {
		var aadhaarErrorDiv = document.getElementById("aadhaarErrorMessage");
		aadhaarErrorDiv.textContent = "";
	}

	function updatePANValue(value) {
		var panInput = document.getElementById("pan_card");
		panInput.value = value;
	}

	function updateAadhaarValue(value) {
		var aadhaarInput = document.getElementById("aadhaar_card");
		aadhaarInput.value = value;
	}
</script>

<script>
	function validateCompanyPAN() {
		var companyPANInput = document.getElementById("company_pan");
		var errorDiv = document.getElementById("companyPANErrorMessage");

		var companyPAN = companyPANInput.value;
		var errorMessage = "";

		// Check if company PAN number is provided
		if (companyPAN.trim() === "") {
			errorMessage = "Please enter a valid Company PAN number.";
		} else {
			// Check if it is a valid company PAN number
			var isValidCompanyPAN = validateCompanyPANFormat(companyPAN);

			// Invalid company PAN number
			if (!isValidCompanyPAN) {
				errorMessage = "Please enter a valid Company PAN number.";
			}
		}

		// Display the error message in the errorDiv element
		errorDiv.textContent = errorMessage;
	}

	function validateCompanyPANFormat(companyPAN) {
		// Company PAN validation logic
		var panRegex = /^[A-Z]{5}\d{4}[A-Z]{1}$/;
		return companyPAN.match(panRegex);
	}

	function clearCompanyPANErrorMessage() {
		var errorDiv = document.getElementById("companyPANErrorMessage");
		errorDiv.textContent = "";
	}

	function validateCompanyAadhaar() {
		var companyAadhaarInput = document.getElementById("company_aadhaar");
		var errorDiv = document.getElementById("companyAadhaarErrorMessage");

		var companyAadhaar = companyAadhaarInput.value;
		var errorMessage = "";

		// Check if company Aadhaar number is provided
		if (companyAadhaar.trim() === "") {
			errorMessage = "Please enter a valid Company Aadhaar number.";
		} else {
			// Check if it is a valid company Aadhaar number
			var isValidCompanyAadhaar = validateCompanyAadhaarFormat(companyAadhaar);

			// Invalid company Aadhaar number
			if (!isValidCompanyAadhaar) {
				errorMessage = "Please enter a valid Company Aadhaar number.";
			}
		}

		// Display the error message in the errorDiv element
		errorDiv.textContent = errorMessage;
	}

	function validateCompanyAadhaarFormat(companyAadhaar) {
		// Company Aadhaar validation logic
		var aadhaarRegex = /^[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}$/;
		return companyAadhaar.match(aadhaarRegex);
	}

	function clearCompanyAadhaarErrorMessage() {
		var errorDiv = document.getElementById("companyAadhaarErrorMessage");
		errorDiv.textContent = "";
	}
</script>