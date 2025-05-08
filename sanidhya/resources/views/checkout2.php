<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Donation</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="assets2/css/nunito-font.css">
	<link rel="stylesheet" type="text/css" href="assets2/fonts/material-design-iconic-font/assets2/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
	<!-- Main Style Css -->
    <link rel="stylesheet" href="assets2/css/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/assets2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/assets2/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="./style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	
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
	
	<div class="page-content">
		<div class="wizard-v5-content">
			<div class="wizard-form">
		        <form class="form-register" id="form-register" action="#" method="post">
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-check"></i></span>
			            	<span class="step-text">Donation Details</span>
			            </h2>
			            <section>
			                <div class="inner">
								

								<div class="wrapper">
									
									<center><img src="assets/donation.png" class="img-fluid" alt="" width="450"></center>
<br><br>
								<div class="form-row">
									<div class="form-holder">
										<label for="first_name">Donation</label>
										<select onchange="remove_multiple()" name="donation" id="donation" class="form-control">
											<option value="5000">Premium (₹5000)</option>
											<option value="3000">Gold (₹3000)</option>
											<option value="2000">Silver (₹2000)</option>
											<option value="1000">General (₹1000)</option>
										</select>
									</div>
									<div class="form-holder">
										<label for="last_name">Multiples</label>
										<input onkeyup="donation_check()" type="number" placeholder="Enter Multiples" class="form-control" id="multiple" name="multiples">
									</div>
									<div class="form-holder">
										<label for="last_name">Total</label>
										<input readonly type="text" class="form-control" id="total" name="multiples">
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
												<input onkeyup="checkphn(this.value);" type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone">
											</div>
											
											
                                            <div class="form-holder">
                                            <label for="code">Enter OTP</label>
                                            <div class="row">
                                                <div class="col-2" style="padding-right: 0px !important;">
                                                <input type="password" class="inputo" />
                                                </div>
                                                <div class="col-2" style="padding-right: 0px !important;">
                                                <input type="password" class="inputo" />
                                                </div>
                                                <div class="col-2" style="padding-right: 0px !important;">
                                                <input type="password" class="inputo" maxlength="1" />
                                                </div>
                                                <div class="col-2" style="padding-right: 0px !important;">
                                                <input type="password" class="inputo" maxlength="1" />
                                                </div>
                                                <div class="col-md-4">
                                                
                                                <input onclick="valid()" id="validate" style="margin-top:0px;padding:10px 0px" class="btn btn-warning" type="button" value="Validate">                                                </div>
                                            </div>
                                            
                                            </div>
										</div>
										<div class="form-row">
											
										
											<div class="form-holder">
												<label for="last_name">First Name</label>
												<input type="text" placeholder="Enter First Name" class="form-control" id="last_name" name="multiples">
											</div>
											<div class="form-holder">
												<label for="last_name">Last Name</label>
												<input readonly type="text" placeholder="Enter Last Name"  class="form-control" id="total" name="total">
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
												<input type="text" placeholder="Enter Email" class="form-control" id="last_name" name="multiples">
											</div>
											<div class="form-holder">
												<label for="last_name">PAN / Aadhaar</label>
												<input type="text" placeholder="Enter PAN / Aadhaar" class="form-control" id="last_name" name="multiples">
											</div>
										</div>
										
										
										
									</div>
								</div>
								<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="inner"><br><br>
										<div class="form-row">
											<div class="form-holder form-holder-3">
												<label for="phone">Phone Number</label>
												<input type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone">
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
												<input type="text" placeholder="Enter Name" class="form-control" id="last_name" name="multiples">
											</div>
											
										</div>
										<div class="form-row">
											
										
											<div class="form-holder">
												<label for="last_name">First Name</label>
												<input type="text" placeholder="Enter First Name" class="form-control" id="last_name" name="multiples">
											</div>
											<div class="form-holder">
												<label for="last_name">Last Name</label>
												<input readonly type="text" placeholder="Enter Last Name"  class="form-control" id="total" name="total">
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
												<input type="text" placeholder="Enter Email" class="form-control" id="last_name" name="multiples">
											</div>
											<div class="form-holder">
												<label for="last_name">Company PAN </label>
												<input type="text" placeholder="Enter PAN " class="form-control" id="last_name" name="multiples">
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
												<td id="firstname-va"> Ramesh Kumar</td>
											</tr>
											<tr class="space-row">
												<th>Pan / Aadhaar</th>
												<td id="lastname-va"> BSBSBS1234BS</td>
											</tr>
											<tr class="space-row">
												<th>Gender:</th>
												<td id="gender-val"></td>
											</tr>
											<tr class="space-row">
												<th>Phone Number:</th>
												<td id="phone-va">9066669966</td>
											</tr>
											<tr class="space-row">
												<th>Email Address:</th>
												<td id="email-va">ramesh@gmail.com</td>
											</tr>
											
											<tr class="space-row">
												<th>Program</th>
												<td> Vigyan Bhairav 3, Mumbai - 26th Feb 2022</td>
											</tr>
											<tr class="space-row">
												<th>Donation</th>
												<td id="donation-va"><i class="fa fa-inr"></i> 15000</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
			            </section>
		        	</div>
		        </form>
			</div>
		</div>
	</div>
	<script src="assets2/js/jquery-3.3.1.min.js"></script>
	<script src="assets2/js/jquery.steps.js"></script>
	<script src="assets2/js/main.js"></script>
</body>
</html>

<script>
	function donation_check(){
        var donation = $('#donation').val();
		
		var multiple = $('#multiple').val();
        var total = (donation * multiple);
        document.getElementById("total").value = "₹" + total;
    }

	function remove_multiple(){
        document.getElementById("multiple").value = "";
		document.getElementById("total").value = "";
    }



function checkphn(phn){
if(phn.length == 10){
    $.ajax({
    url  : "qr/sms",
    type : 'POST',
}); 
}
}

function valid(){
    document.getElementById("validate").value = "Validated";
    $('#validate').addClass('btn-success').removeClass('btn-warning');
    $('#validate').css('color','#fff');

}


</script>



