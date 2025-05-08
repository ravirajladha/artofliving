<?php namespace App\Http\Controllers; 
use Illuminate\Support\Facades\Session;
use App\Models\Compliances;
use App\Models\Category;
?>
@include('inc.header') 

<?php
$fields = $data['fields']; ?>
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">

<style>
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		border: none;
		margin-top: 5px !important;
	}
</style>
<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-sm-6">
					<h3>

						<?php $cat = Category::where('id',$data['subcategory']->category_id)->first(); ?>
					<!-- <a href="/add_asset_select" class="icon-back-right" style="align-items: left; font-size: medium;"> Back </a> <br><br> -->
					Category : <?php echo $cat->name; ?> <br>
					 Subcategory : <?php echo $data['subcategory']->name; ?> </h3>
				</div>
				<div class="col-12 col-sm-6">
					<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/add_asset_select">Select</a></li>
                        <li class="breadcrumb-item active"><a href="#">Add Asset</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div> 
	<!-- Container-fluid starts-->
	<div class="container-fluid">
		<div class="edit-profile">
			<!-- start fields form -->
			<form action="/add_asset" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row">

					<div class="col-xl-12">
						<div class="card">

							<div class="card-body">

								<div class="row mb-2">
									<div class="profile-title" style="margin-bottom:0px;padding-bottom:0px;">
										<!-- <div class="media">
                              <center><img class="img-70 rounded-circle" alt="" src="/assets/images/user/7.jpg" ></center>
                              <div class="media-body">
                               <center> <h5 class="mb-1 f-14 txt-primary">Profile Image</h5></center>
                                <input class="form-control" name="photo" type="file" placeholder="Value *">
                              </div>
                            </div> -->

										<div class="media-body">
											<center><img src="/assets/images/user/7.jpg" class="avatar img-circle img-thumbnail img-100 rounded-circle" alt="avatar" style="height:100px; width:100px"><br>
												<h5 class="mb-1 f-14 txt-primary">Upload Asset Image</h5>
											</center>
											<!-- <input type="file" class="text-center center-block file-upload" name="photo" required> -->
											<input class="form-control file-upload" name="image" type="file" placeholder="Value *">
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

					<?php if (!empty($data['subcategory']->fields)) { ?> 

						<div class="col-xl-12">
							<div class="card">

								<div class="card-body">

									<div class="row">
										<input type="text" style="display:none;" value="<?php echo $data['subcategory']->id; ?>" name="subcategory_id">
										<input type="text" style="display:none;" value="<?php echo $data['type']; ?>" name="type">
									</div>

									<div class="row">



										<div class="col-md-6">
											<div class="mb-3">
												<label>Name</label>
												<input class="form-control" name="name" type="text" placeholder="Enter Name *" required>
											</div>
										</div>

										<div class="col-md-6">
											<div class="mb-3">
												<label>Unique QR</label>
												<input class="form-control" name="qr" type="text" placeholder="Scan QR Code" required>
											</div>
										</div>


										<?php if (in_array("contact_1", $fields)) { ?>
											<div class="col-md-6">
												<div class="mb-3">
													<label>Contact 1</label>
													<input class="form-control" name="contact_1" type="tel" placeholder="Enter Contact Details(1) *">
												</div>
											</div>
										<?php } ?>
										<?php if (in_array("contact_2", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Contact 2</label>
													<input class="form-control" name="contact_2" type="tel" placeholder="Enter Contact Details(2) ">
												</div>
											</div>

										<?php } ?> <?php if (in_array("email", $fields)) { ?><div class="col-md-6"> 
												<div class="mb-3">
													<label>Email</label>
													<input class="form-control" name="email" type="email" placeholder="Enter Email Address *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("address", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Address</label>
													<input class="form-control" name="address" type="text" placeholder="Enter Address *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("city", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>City</label>
													<input class="form-control" name="city" type="text" placeholder="Enter City Name *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("district", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>District</label>
													<input class="form-control" name="district" type="text" placeholder="Enter District *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("state", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>State</label>
													<input class="form-control" name="state" type="text" placeholder="Enter State *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("pincode", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Pincode</label>
													<input class="form-control" name="pincode" type="number" maxlength="6" placeholder="Enter Pincode *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("reporting_manager", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label for="exampleInputname1">Select Reporting Manager</label>
													<select name="reporting_manager" class="form-select">
														<?php foreach ($data['users'] as $user) { ?>
															<option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
														<?php } ?>
													</select>

												</div>
											</div>


										<?php } ?> <?php if (in_array("reporting_apex", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label for="exampleInputname1">Select Reporting Apex</label>
													<select name="reporting_apex" class="form-select">
														<?php foreach ($data['all_apex'] as $apex) { ?>
															<option value="<?php echo $apex->id; ?>"><?php echo $apex->name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>


										<?php } ?> <?php if (in_array("document_type", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Document Type</label>
													<input class="form-control" name="document_type" type="text" placeholder="Enter Document Type ">
												</div>
											</div>


										<?php } ?> <?php if (in_array("registration_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Registration Number</label>
													<input class="form-control" name="registration_number" type="text" placeholder="Enter Registration Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("serial_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Serial Number</label>
													<input class="form-control" name="serial_number" type="text" placeholder="Enter Serial Number *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("registration_date", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Registration Date</label>
													<input class="form-control" name="registration_date" type="date" placeholder="Enter Registration Date *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("insurance_policy_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Insurance Policy Number</label>
													<input class="form-control" name="insurance_policy_number" type="text" placeholder="Enter Insurance Policy Number *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("license_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Licence Number</label>
													<input class="form-control" name="license_number" type="text" placeholder="Enter Licence Number *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("certificate_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Certificate Number</label>
													<input class="form-control" name="certificate_number" type="text" placeholder="Enter Certificate Number *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("document_reference_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Document Reference Number</label>
													<input class="form-control" name="document_reference_number" type="text" placeholder="Enter Document Reference Number *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("asset_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Asset Number</label>
													<input class="form-control" name="asset_number" type="text" placeholder="Enter Asset Number">
												</div>
											</div>




										<?php } ?> <?php if (in_array("bank_account_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Bank Account Number</label>
													<input class="form-control" name="bank_account_number" type="text" placeholder="Enter Bank Account Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("bank_ifsc_code", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Bank IFSC Code</label>
													<input class="form-control" name="bank_ifsc_code" type="text" placeholder="Enter Bank IFSC Code *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("bank_address", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Bank Address</label>
													<input class="form-control" name="bank_address" type="text" placeholder="Enter Bank Adress *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("account_name", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Account Name</label>
													<input class="form-control" name="account_name" type="text" placeholder="Enter Account Name *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("invoice_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Invoice Number</label>
													<input class="form-control" name="invoice_number" type="text" placeholder="Enter Invoice Number *">
												</div>
											</div>



										<?php } ?>
										<?php if (in_array("po_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>PO Number</label>
													<input class="form-control" name="po_number" type="text" placeholder="Enter PO Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("cheque_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Cheque Number</label>
													<input class="form-control" name="cheque_number" type="text" placeholder="Enter Cheque Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("receipt_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Reciept Number</label>
													<input class="form-control" name="receipt_number" type="text" placeholder="Enter Reciept Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("challan_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Challan Number</label>
													<input class="form-control" name="challan_number" type="text" placeholder="Enter Challan Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("donation_mode", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Donation Number</label>
													<input class="form-control" name="donation_mode" type="number" placeholder="Enter Donation Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("transaction_number", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Transaction Number</label>
													<input class="form-control" name="transaction_number" type="text" placeholder="Enter Transaction Number *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("donation_in_rupees", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Donation (Rs)</label>
													<input class="form-control" name="donation_in_rupees" type="text" placeholder="Enter Donation (in rupees) *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("event_id", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Event ID</label>
													<input class="form-control" name="event_id" type="text" placeholder="Enter Event ID *">
												</div>

											</div>


										<?php } ?> <?php if (in_array("project", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Project/Campaign ID</label>
													<input class="form-control" name="project" type="text" placeholder="Enter Project/Campaign ID ">
												</div>
											</div>



										<?php } ?> <?php if (in_array("type_of_property", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Type of Property</label>
													<input class="form-control" name="type_of_property" type="text" placeholder="Enter Type of Property ">
												</div>
											</div>



										<?php } ?> <?php if (in_array("type_of_acquisition", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Type of Acquisition</label>
													<input class="form-control" name="type_of_acquisition" type="text" placeholder="Enter Type of Acquisition *">
												</div>
											</div>



										<?php } ?> <?php if (in_array("upload", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Upload</label>
													<input class="form-control" name="upload" type="file" placeholder="Upload File">
												</div>
											</div>



										<?php } ?> <?php if (in_array("validity", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Validity</label>
													<input class="form-control" name="validity" type="date" placeholder="Value ">
												</div>
											</div>



										<?php } ?> <?php if (in_array("tenure", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Tenure/Duration</label>
													<input class="form-control" name="tenure" type="text" placeholder="Enter Tenure/Duration *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("land_area", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Land Area</label>
													<input class="form-control" name="land_area" type="text" placeholder="Enter Land Area *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("cost_to_trust", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Cost to Trust(Rs.)</label>
													<input class="form-control" name="cost_to_trust" type="number" placeholder="Enter Cost to Trust (in rupees) *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("buildings", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Buildings (Cost to Trust)</label>
													<input class="form-control" name="buildings" type="text" placeholder="Value *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("wdv", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>W.D.V. (FY - )</label>
													<input class="form-control" name="wdv" type="text" placeholder="Enter WDV *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("original_documents", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Original Documents at Trust Office</label>
													<select name="original_documents" class="form-control">
														<option>Select</option>
														<option value="1">Yes</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>


										<?php } ?> <?php if (in_array("receipt_date", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Reciept Data</label>
													<input class="form-control" name="receipt_date" type="date" placeholder="Enter Receipt Date *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("receipt_via", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Reciept Via</label>
													<input class="form-control" name="receipt_via" type="text" placeholder="Enter Receipt Via">
												</div>
											</div>


										<?php } ?> <?php if (in_array("file_no", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>File Number</label>
													<input class="form-control" name="file_no" type="text" placeholder="Enter File Number *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("purpose", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Purpose/Project</label>
													<input class="form-control" name="purpose" type="text" placeholder="Enter Purpose/Project ">
												</div>
											</div>


										<?php } ?> <?php if (in_array("comments_remarks", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Comments / Remarks</label>
													<input class="form-control" name="comments_remarks" type="text" placeholder="Enter Comments/Remarks ">
												</div>
											</div>


										<?php } ?>


										<?php if (in_array("remarks", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Remarks</label>
													<input class="form-control" name="remarks" type="text" placeholder="Enter Remarks ">
												</div>
											</div>


										<?php } ?>

										<?php if (in_array("assigned_staff", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Assigned Staff</label>
													<input class="form-control" name="assigned_staff" type="text" placeholder="Enter Assigned Staff">
												</div>
											</div>


										<?php } ?> <?php if (in_array("transferred_on", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Transffered On</label>
													<input class="form-control" name="transferred_on" type="date" placeholder="Value *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("transferred_for", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Transffered For</label>
													<input class="form-control" name="transferred_for" type="text" placeholder="Enter Transferred Details">
												</div>
											</div>


										<?php } ?> <?php if (in_array("incident_type", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Incident Type</label>
													<input class="form-control" name="incident_type" type="text" placeholder="Enter Incident Type">
												</div>
											</div>


										<?php } ?> <?php if (in_array("incident_date", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Incident Date</label>
													<input class="form-control" name="incident_date" type="date">
												</div>
											</div>


										<?php } ?> <?php if (in_array("reported_to_hq", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Reported to HQ</label>
													<select name="reported_to_hq" class="form-control">
														<option>Select</option>
														<option value="1">Yes</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>


										<?php } ?> <?php if (in_array("police_fir", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Police FIR</label>
													<input class="form-control" name="police_fir" type="text" placeholder="Enter Police FIR status ">
												</div>
											</div>


										<?php } ?> <?php if (in_array("asset_condition_as_on_date", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Asset Condition on date(Scale)</label>
													<input class="form-control" name="asset_condition_as_on_date" type="text" placeholder="Value *">
												</div>
											</div>


										<?php } ?> <?php if (in_array("initial_condition", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Asset intial Condition</label>
													<select name="initial_condition" class="form-control">
														<option disabled selected>Select Condition (Scale)</option>
														<option value="0">0-Not Applicable</option>
														<option value="1">1-Scrapable/rundown/writeoff</option>
														<option value="2">2-Poor</option>
														<option value="3">3-Ok</option>
														<option value="4">4-Good</option>
														<option value="5">5-New/Excellent</option>
													</select>
												</div>
											</div>



										<?php } ?> <?php if (in_array("last_physical_audit", $fields)) { ?><div class="col-md-6">
												<div class="mb-3">
													<label>Last Physical Audit</label>
													<input class="form-control" name="last_physical_audit" type="date">
												</div>
											</div>
										<?php } ?>
									</div>

								</div>
							</div>
						</div>
					<?php } ?>

					<?php if ($data['subcategory']->compliances) { ?>
						<div class="col-xl-12">
							<div class="card">

								<div class="card-body">
									<h5>Compliances</h5>
									<hr>


									<div class="row">

										<div class="col-sm-3">
											<div class="mb-3">
												<label>Compliance Name</label>

											</div>
										</div>

										<div class="col-sm-3">
											<div class="mb-3">
												<label>Start Date</label>
											</div>
										</div>

										<div class="col-sm-3">
											<div class="mb-3">
												<label>End Date</label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="mb-3">
												<label>File</label>
											</div>
										</div>
									</div>

									<?php
									$compliances = $data['subcategory']->compliances;
									$compliances = explode(',', $compliances);
									foreach ($compliances as $compliance_cur) {
										$compliance = Compliances::where('id',$compliance_cur)->first();
										

									?>
										<div class="row">
											<div class="col-sm-3">
												<div class="mb-3">
													<label><?php echo $compliance->name; ?></label>

												</div>
											</div>

											<div class="col-sm-3">
												<div class="mb-3">
													<input class="form-control" type="date" name="s_<?php echo $compliance->id; ?>" placeholder="">
												</div>
											</div>

											<div class="col-sm-3">
												<div class="mb-3">
													<input class="form-control" type="date" name="e_<?php echo $compliance->id; ?>">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="mb-3">
													<input class="form-control" type="file" name="f_<?php echo $compliance->id; ?>">
												</div>
											</div>
										</div>
									<?php  } ?>

								</div>
							</div>


						</div>
					<?php } ?>



					<div class="col-xl-12">
						<div class="row card-f-end">
							<div class="col">
								<div class="text-end">
									<a href="/add_asset_select" class="btn btn-secondary me-3">Cancel</a>
									<button type="submit" class="btn btn-secondary me-3" href="#">Add</button></div><br><br>
							</div>
						</div>
					</div>

				</div>


		</div>
	</div>
</div>
@include('inc.footer')

<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>



<script>
	$(".tenure2").hide();

	function find_pincode(pin) {
        if (pin.length == 6) { 
            $.ajax({
                url: '/pincode/' + pin,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    var detail = res.split(',');
                    document.getElementById("district").value = detail[0];
                    document.getElementById("state").value = detail[1];
                }
            });
        } else {
            document.getElementById("comm_block_p").value = "";
            document.getElementById("comm_state_p").value = "";
        }
    }




	function valueChanged() {
		if ($('#tenure1_check').is(":checked"))
			$(".tenure2").show();
		else
			$(".tenure2").hide();
	}
</script>


<script>
	function get_cabins(build_id) {

		$.ajax({
			url: '/pages/get_cabins',
			type: 'POST',
			data: {
				build_id
			},

			success: function(res) {
				$('#cabs').html($(res));
			}

		});
	}
</script>
<script>
	new



	$(document).ready(function() {


		var readURL = function(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('.avatar').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}


		$(".file-upload").on('change', function() {
			readURL(this);
		});
	});
</script>
