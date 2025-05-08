<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Donation 2</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="assets2/css/nunito-font.css">
	<link rel="stylesheet" type="text/css" href="assets2/fonts/material-design-iconic-font/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
	<!-- Main Style Css -->
    <link rel="stylesheet" href="assets2/css/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>
		#l1{
			color: rgb(0, 238, 255);
			text-align: center;
			font-weight: bolder;
			font-size: 40px;
			font-family: Arial, Helvetica, sans-serif;
		}
		#l2{
			color: rgb(255, 255, 255);
			text-align: center;
			font-weight: bolder;
			font-size: 30px;
		}
		#l3{
			color: rgb(0, 238, 255);
			text-align: center;
			font-size:20px;
			font-weight: bolder;

		}
		#l4{
			color: rgb(0, 238, 255);
			text-align: center;
			font-size: 20px;
			font-weight: bolder;

		}
		img {
    		width: 160px;
    		
			}
		#img2 {
    		width: 140px;
    		
			}

	</style>
</head>

	<!-- partial:index.partial.html -->
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<div id='stars'></div>
	<div id='stars2'></div>
	<div id='stars3'></div>
	<div id='title'>
	 
	</div> 	
	
	<!-- partial -->
	  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>
	<?php $otp_new = str_pad(rand(1111,9999), 4, "0", STR_PAD_LEFT);?>
	<div class="page-content" style="min-height:800px">
		<div class="wizard-v5-content">
			<div class="wizard-form">
		        <form class="form-register" id="form-register" action="{{route('paytm.payment')}}" method="post">
					@csrf
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-check"></i></span>
			            	<span class="step-text">Donation Details </span>
			            </h2>
			            <section>
			                <div class="inner">
								

								<div class="wrapper">
									<?php $event = $data['event']; 
									if($event->type== 1){ ?>
										<center><img src="assets/aol.png"  alt="" width="300">
										<img src="assets/unveiling.png" id="img2" alt="" width="300"> <br>
										<label for="" id="l1"> <?php echo strtoupper($event->event_name_pass1); ?> </label> <br>
										<label for="" id="l2"> <?php echo strtoupper($event->event_name_pass2) ;?> </label><br>
										<label for="" id="l3"> <?php echo strtoupper($event->location_pass) ;?> </label><br>
										<label for="" id="l4"> <?php echo strtoupper($event->date_pass) ;?> </label>
										<br><br>

									</center>
										
										<?php }
										else{ ?>
										<center><img src="assets/aol.png" class="img-fluid" alt="" width="100"> <br>
										<label for="" id="l1"> <?php echo strtoupper($event->event_name_pass1); ?> </label> <br>
										<label for="" id="l2"> <?php echo strtoupper($event->event_name_pass2) ;?> </label><br>
										<label for="" id="l3"> <?php echo strtoupper($event->location_pass) ;?> </label><br>
										<label for="" id="l4"> <?php echo strtoupper($event->date_pass) ;?> </label>
										
									</center>
										<?php } ?>
										
										
										<?php  
										$categories = explode(',', $event->cat_name);
										$amounts = explode(',', $event->cat_value);
										// $cat_value= explode(',', $event->cat_value);
										?>
									<br><br>
									
								<div class="form-row">
									<div class="form-holder">
										<label for="first_name">Donation</label>
										<select onchange="remove_multiple()" name="type" id="donation" class="form-control">

										<?php $count = 0;  foreach ($categories as $category) {
										  ?>
        											
											<option value="{{$amounts[$count]}}"><?php echo $category ; ?> </option>
											<?php $count++; }?>
										</select>
									</div>
									<div class="form-holder">
										<label for="last_name">Multiples</label>
										<input onkeyup="donation_check()" type="number" placeholder="Enter Multiples" class="form-control" id="multiple" name="multiples">
									</div>
									<div class="form-holder">
										<label for="last_name">Total</label>
										<input readonly type="text" class="form-control" id="total" name="amount">
										
									</div>
									
								</div>
							
								
							</div>
			            </section>
						<!-- SECTION 2 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-check"></i></span>
			            	<span class="step-text">Donor Details</span>
			            </h2>
						
			            <section>
							
                        <div>



							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
								  <!-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Personal </button> -->
								  <!-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Corporate </button> -->
								 
								</div>
							  </nav>


							  <div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
									<div class="inner"><br><br>
										<div class="form-row">
											<div class="form-holder form-holder-3">
												<label for="phone">Phone Number</label>
												<input onkeyup="checkphn(this.value);" type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone">
											</div>
											
											
                                            <div class="form-holder">
                                            <label for="code">Enter OTP</label>
                                            <div class="row">
                                                <div class="col-8" style="padding-right: 0px !important;">
                                                <input type="password" class="inputo" />
                                                </div>
                                                
                                                <div class="col-md-4">
                                                
                                                <input onclick="valid()" id="validate" style="margin-top:0px;padding:10px 0px" class="btn btn-warning" type="button" value="Validate">                                                </div>
                                            </div>
                                            
                                            </div>
										</div>
										<div id="personal_info">
										<div class="form-row">
											
										
											<div class="form-holder">
												<label for="last_name">First Name</label>
												<input onchange="$('#firstname-va').text(this.value);" type="text" placeholder="Enter First Name" class="form-control" id="last_name" name="first_name">
											</div>
											<div class="form-holder">
												<label for="last_name">Last Name</label>
												<input  type="text" placeholder="Enter Last Name"  class="form-control" id="last_name" name="last_name">
											</div>
										</div>
										<div class="form-row">
											<div id="radio">
												<label for="gender">Gender:</label>
												<input type="radio" name="gender" value="male" checked> Male
												  <input type="radio" name="gender" value="female"> Female
											</div>
										</div>
										<div class="form-row">
											<div class="form-holder">
												<label for="last_name">Email</label>
												<input onchange="$('#email-va').text(this.value);" type="text" placeholder="Enter Email" class="form-control" id="last_name" name="email">
											</div>
											<div class="form-holder">
												<label for="last_name">PAN / Aadhaar</label>
												<input onchange="$('#pan-va').text(this.value);" type="text" placeholder="Enter PAN / Aadhaar" class="form-control" id="last_name" name="pan">
											</div>
										</div>
										<div class="form-row">
											<div class="form-holder form-holder-2">
												<label for="last_name">Address</label>
												<input onchange="$('#address-va').text(this.value);" type="text" type="text" placeholder="Enter Name" class="form-control" id="last_name" name="address">
											</div>
											
										</div>
										<div class="form-row">
											<div class="form-holder">
												<label for="last_name">Pincode</label>
												<input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="pincode" onkeyup="find_pincode_p(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" >
											</div>
											<div class="form-holder">
												<label for="last_name">City </label>
												<input type="text" placeholder="Enter City " class="form-control" id="comm_block_p"  name="city" readonly>
											</div>
											<div class="form-holder">
												<label for="last_name">State</label>
												<input type="text" placeholder="Enter State " class="form-control"  name="state" id="comm_state_p" readonly>
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
												<input type="text" placeholder="Enter Phone Number" class="form-control" id="company_phone" name="cphone">
											</div>
											<div class="form-holder" style="display:none"; id="validate">
												<label for="code">Enter OTP</label>
												<input type="text" class="form-control" id="code" name="code">
											</div>
											<div class="form-holder" id="validate_btn">
												<label for="code">.</label>
												<button class="btn btn-warning">Validate</button>
											</div>
										</div>
										<div class="form-row">
											<div class="form-holder form-holder-2">
												<label for="last_name">Company Name</label>
												<input type="text" placeholder="Enter Name" class="form-control" id="last_name" name="company_name">
											</div>
											
										</div>
										<div class="form-row">
											
										
											<div class="form-holder">
												<label for="last_name">First Name</label>
												<input type="text" placeholder="Enter First Name" class="form-control" id="last_name" name="company_first_name">
											</div>
											<div class="form-holder">
												<label for="last_name">Last Name</label>
												<input  type="text" placeholder="Enter Last Name"  class="form-control" id="total" name="company_last_name">
											</div>
										</div>
										<div class="form-row">
											<div id="radio">
												<label for="gender">Gender:</label>
												<input type="radio" name="company_gender" value="male" checked> Male
												  <input type="radio" name="company_gender" value="female"> Female
											</div>
										</div>
										<div class="form-row">
											<div class="form-holder">
												<label for="last_name">Email</label>
												<input type="text" placeholder="Enter Email" class="form-control" id="last_name" name="company_email">
											</div>
											<div class="form-holder">
												<label for="last_name">Company PAN </label>
												<input type="text" placeholder="Enter PAN " class="form-control" id="last_name" name="company_pan">
											</div>
										</div>
										
										<div class="form-row">
											<div class="form-holder form-holder-2">
												<label for="last_name">Address</label>
												<input type="text" placeholder="Enter Name" class="form-control" id="last_name" name="company_address">
											</div>
											
										</div>
										<div class="form-row">
											<div class="form-holder">
												<label for="last_name">Pincode</label>
												<input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="company_pincode" onkeyup="find_pincode_c(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" >
											</div>
											<div class="form-holder">
												<label for="last_name">City </label>
												<input type="text" placeholder="Enter City " class="form-control" id="comm_block"  name="company_city" readonly>
											</div>
											<div class="form-holder">
												<label for="last_name">State</label>
												<input type="text" placeholder="Enter State " class="form-control"  name="company_state" id="comm_state" readonly>
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
			                	<h3>Comfirm Details</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th>Name:</th>
												<td id="firstname-va"></td>
											</tr>
											<tr class="space-row">
												<th>Pan / Aadhaar</th>
												<td id="pan-va"></td>
											</tr>
											<tr class="space-row">
												<th>Gender:</th>
												<td id="gender-val"></td>
											</tr>
											<tr class="space-row">
												<th>Address:</th>
												<td id="address-va"></td>
											</tr>
											<tr class="space-row">
												<th>Email Address:</th>
												<td id="email-va"></td>
											</tr>
											
											<tr class="space-row">
												<th>Program</th>
												<td> <?php echo $event->event_name_pass1.','.$event->event_name_pass2.','.$event->location_pass.','.$event->date_pass; ?>
													</td>
											</tr>
											<tr class="space-row">
												<th>Donation</th>
												<td id="donation-va"> </td>
											</tr>
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
	<script src="assets2/js/jquery-3.3.1.min.js"></script>
	<script src="assets2/js/jquery.steps.js"></script>
	<script src="assets2/js/main.js"></script>
</body>
</html>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script>
	function donation_check(){
        var donation = $('#donation').val();
        donation = parseInt(donation);
		var multiple = $('#multiple').val();
        var total = (donation * multiple);
        document.getElementById("total").value = total;
		$('#donation-va').text( "₹" + total);
    }

	function remove_multiple(){
        document.getElementById("multiple").value = "";
		document.getElementById("total").value = "";
    }




	function valid(){
		document.getElementById("validate").value = "Validated";
		$('#validate').addClass('btn-success').removeClass('btn-warning');
		$('#validate').css('color','#fff');

	}

	function find_pincode_p(pin) {

				if (pin.length == 6) {
				$.ajax({
				url: '/pincode/'+pin,
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
		url: '/pincode/'+pin,
		type: 'GET',


		success: function(res) {
			console.log(res);
			var detail = res.split(',');
			document.getElementById("comm_block").value = detail[0];
			document.getElementById("comm_state").value = detail[1];
		}

		});
		} else {
		document.getElementById("comm_block").value = "";
		document.getElementById("comm_state").value = "";
		}
	}



function donation() {
	$('#form-register').submit();
}


function checkphn(phn){
		if(phn.length == 10){
		$.ajax({
		url: '/sms_otp/'+phn+'/{{$otp_new}}',
		type: 'GET',


		success: function(res) {
			
		}

		});
		}}
</script>