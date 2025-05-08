<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Donation</title>
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
</head>

	

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
		       
		        	<div id="form-total">
		        	
			            <section style="padding:50px 25px">
			                <div class="inner">
								

								<div class="wrapper">
									
									<center><img src="assets/donation.png" class="img-fluid" alt="" width="450"></center>
									<br><br>
								<div class="row">
                                    <div class="col-12" style="text-align:center">
                                    <img src="assets/success.gif" width="150" alt="">
                                    <p style="color:#fff;margin-top:5px"><b>Your payment was successful. </b></p>
                                    </div>
                                    <div class="col-12" style="text-align:left">
									<p style="color:#fff;">
<span style="font-weight:lighter;line-height:30px">
We thank you for your valuable contribution.
<br>
We will share the program details shortly on your registered email and Whatsapp.
<br>
For any further donation related queries write to us at <a style="color:#fff" href="mailto:donations@in.artofliving.org">donations@in.artofliving.org</a>
<br> Thank you!</span></p>
                                    </div>

									</div>
									
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script>
	function donation_check(){
        var donation_val = $('#donation').val();
		var donation = 0;

		if(donation_val == "1"){ donation = 5000; }
		else if(donation_val == "2"){ donation = 3000; }
		else if(donation_val == "3"){ donation = 2000; }
		else if(donation_val == "4"){ donation = 1000; }
		else { donation = 1000; }

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






</script>




<script>




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