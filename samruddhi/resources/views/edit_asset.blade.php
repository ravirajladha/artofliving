<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Compliances;
?>
@include('inc.header')
<?php
$fields = $data['fields'];
$get_asset = $data['get_asset'];
?>
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
					
					Update Asset - <?php   echo $data['subcategory']->name; ?></h3>
				</div>
				<div class="col-12 col-sm-6">
					<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item "><a href="/all_assets">All Assets</a></li>
                        <li class="breadcrumb-item active"><a href="#">Update Asset</a></li>
					</ol>
				</div>
			</div>
		</div> 
	</div>
	<!-- Container-fluid starts-->
	<div class="container-fluid">
		<div class="edit-profile">
			<!-- start fields form -->
			<form action="/update_asset/<?php   echo $get_asset->id; ?>" method="POST" enctype="multipart/form-data">
			@csrf
				<div class="row">

				<div class="col-xl-12">
            <div class="card">

              <div class="card-body" style="padding:18px;">

                <div class="row mb-2">
                  <div class="profile-title" style="margin-bottom:0px;padding-bottom:0px;">
                    <!-- <div class="media">                        
                              <center><img class="img-70 rounded-circle" alt="" src="/assets/images/user/7.jpg" ></center>
                              <div class="media-body">
                               <center> <h5 class="mb-1 f-14 txt-primary">Profile Image</h5></center>
                                <input class="form-control" name="photo" type="file" placeholder="Value *">
                              </div>
                            </div> -->

                            <div class="media-body">       <center>
							<?php  if (empty($get_asset->image)) {  ?>
                      <img src="/assets/images/user/7.jpg" class="avatar img-circle img-thumbnail img-100 rounded-circle" alt="avatar" style="height:100px; width:100px">
							<?php  }else{ ?>
								<img src="/profiles/<?php  echo $get_asset->image; ?>" class="avatar img-circle img-thumbnail img-100 rounded-circle" alt="avatar" style="height:100px; width:100px">
								
								<?php  } ?>
								</center></div><br>
                            <h5 class="mb-1 f-14 txt-primary text-center">Update Asset Image</h5>
                           <!-- <input type="file" class="text-center center-block file-upload" name="photo" required> -->
                           <input class="form-control file-upload" name="image" type="file" placeholder="Value *">
                    </div>


                  </div>
                </div>
                </div>
                </div>
             
			
				<?php  if(!empty($data['subcategory']->fields)){ ?>
					<div class="col-xl-12">
						<div class="card">

							<div class="card-body">

						

							
							




								<div class="row">
									<input type="text" style="display:none;" value="<?php  echo $data['subcategory']->id; ?>" name="subcategory_id">
									<input type="text" style="display:none;" value="<?php  echo $data['type']; ?>" name="type">
								</div>

								<div class="row">


								
										<div class="col-md-6">
											<div class="mb-3">
												<label>Asset Type</label>
												<select class="form-select" name="type" id="asset_type" required>

												<option value="1" <?php  if ($get_asset->type == 1) {
																			echo "selected";
																		} ?>>Movable Asset</option>
												<option value="2" <?php  if ($get_asset->type == 2) {
																			echo "selected";
																		} ?>>Immovable Asset</option>


												</select>
											</div>
										</div>
								
									<?php  if (in_array("name", $fields) && isset($get_asset->name)) { ?>
										<div class="col-md-6">
											<div class="mb-3">
												<label>Name</label>
												<input class="form-control" name="name" type="text" value="<?php  echo $get_asset->name; ?>" placeholder="Enter Name *">
											</div>
										</div>
									<?php  } ?>
									<?php  if ((in_array("contact_1", $fields) && isset($get_asset->contact_1))  && isset($get_asset->bank_ifsc_code)) { ?>
										<div class="col-md-6">
											<div class="mb-3">
												<label>Contact 1</label>
												<input class="form-control" name="contact_1" type="tel" placeholder="Enter Contact Details(1) *" value="<?php  echo $get_asset->contact_1; ?>">
											</div>
										</div>
									<?php  } ?>
									<?php  if ((in_array("contact_2", $fields) && isset($get_asset->contact_2)) && isset($get_asset->bank_ifsc_code)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Contact 2</label>
												<input class="form-control" name="contact_2" type="tel" placeholder="Enter Contact Details(2) " value="<?php  echo $get_asset->contact_2; ?>">
											</div>
										</div>

									<?php  } ?> <?php  if (in_array("email", $fields) && isset($get_asset->email)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Email</label>
												<input class="form-control" name="email" type="email" placeholder="Enter Email Address *" value="<?php  echo $get_asset->email; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("address", $fields) && isset($get_asset->address)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Address</label>
												<input class="form-control" name="address" type="text" placeholder="Enter Address *" value="<?php  echo $get_asset->address; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("city", $fields) && isset($get_asset->city)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>City</label>
												<input class="form-control" name="city" type="text" placeholder="Enter City Name *" value="<?php  echo $get_asset->city; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("district", $fields) && isset($get_asset->district)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>District</label>
												<input class="form-control" name="district" type="text" placeholder="Enter District *" value="<?php  echo $get_asset->district; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("state", $fields) && isset($get_asset->state)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>State</label>
												<input class="form-control" name="state" type="text" placeholder="Enter State *" value="<?php  echo $get_asset->state; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("pincode", $fields) && isset($get_asset->pincode)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Pincode</label>
												<input class="form-control" name="pincode" type="number" maxlength="6" placeholder="Enter Pincode *" value="<?php  echo $get_asset->pincode; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("reporting_manager", $fields) && isset($get_asset->reporting_manager)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label for="exampleInputname1">Select Reporting Manager</label>
												<select name="reporting_manager" class="form-select">
													<?php  foreach ($data['users'] as $user) { ?>
														<option value="<?php  echo $user->id; ?>"><?php  echo $user->reporting_manager; ?></option>
													<?php  } ?>
												</select>

											</div>
										</div>


									<?php  } ?> <?php  if (in_array("reporting_apex", $fields) && isset($get_asset->reporting_apex)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label for="exampleInputname1">Select Reporting Apex</label>
												<select name="reporting_apex" class="form-select">
													<?php  foreach ($data['all_apex'] as $apex) { ?>
														<option value="<?php  echo $apex->id; ?>"><?php  echo $apex->reporting_apex; ?></option>
													<?php  } ?>
												</select>
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("document_type", $fields) && isset($get_asset->document_type)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Document Type</label>
												<input class="form-control" name="document_type" type="text" placeholder="Enter Document Type " value="<?php  echo $get_asset->document_type; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("registration_number", $fields) && isset($get_asset->registration_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Registration Number</label>
												<input class="form-control" name="registration_number" type="text" placeholder="Enter Registration Number *" value="<?php  echo $get_asset->registration_number; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("registration_date", $fields) && isset($get_asset->registration_date)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Registration Date</label>
												<input class="form-control" name="registration_date" type="date" placeholder="Enter Registration Date *" value="<?php  echo $get_asset->registration_date; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("insurance_policy_number", $fields) && isset($get_asset->insurance_policy_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Insurance Policy Number</label>
												<input class="form-control" name="insurance_policy_number" type="text" placeholder="Enter Insurance Policy Number *" value="<?php  echo $get_asset->insurance_policy_number; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("license_number", $fields) && isset($get_asset->license_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Licence Number</label>
												<input class="form-control" name="license_number" type="text" placeholder="Enter Licence Number *" value="<?php  echo $get_asset->license_number; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("certificate_number", $fields) && isset($get_asset->certificate_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Certificate Number</label>
												<input class="form-control" name="certificate_number" type="text" placeholder="Enter Certificate Number *" value="<?php  echo $get_asset->certificate_number; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("document_reference_number", $fields) && isset($get_asset->document_reference_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Document Reference Number</label>
												<input class="form-control" name="document_reference_number" type="text" placeholder="Enter Document Reference Number *" value="<?php  echo $get_asset->document_reference_number; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("asset_number", $fields) && isset($get_asset->asset_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Asset Number</label>
												<input class="form-control" name="asset_number" type="text" placeholder="Enter Asset Number" value="<?php  echo $get_asset->asset_number; ?>">
											</div>
										</div>




									<?php  } ?> <?php  if (in_array("bank_account_number", $fields) && isset($get_asset->bank_account_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Bank Account Number</label>
												<input class="form-control" name="bank_account_number" type="text" placeholder="Enter Bank Account Number *" value="<?php  echo $get_asset->bank_account_number; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if ((in_array("bank_ifsc_code", $fields) && isset($get_asset->bank_ifsc_code)) && isset($get_asset->bank_ifsc_code)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Bank IFSC Code</label>
												<input class="form-control" name="bank_ifsc_code" type="text" placeholder="Enter Bank IFSC Code *" value="<?php  echo $get_asset->bank_ifsc_code; ?>">
											</div>
										</div> 



									<?php  } ?> <?php  if (in_array("bank_address", $fields) && isset($get_asset->bank_address)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Bank Address</label>
												<input class="form-control" name="bank_address" type="text" placeholder="Enter Bank Adress *" value="<?php  echo $get_asset->bank_address; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("account_name", $fields) && isset($get_asset->account_name)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Account Name</label>
												<input class="form-control" name="account_name" type="text" placeholder="Enter Account Name *" value="<?php  echo $get_asset->account_name; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("invoice_number", $fields) && !empty($get_asset->invoice_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Invoice Number</label>
												<input class="form-control" name="invoice_number" type="text" placeholder="Enter Invoice Number *" value="<?php  echo $get_asset->invoice_number; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("po_number", $fields) && isset($get_asset->po_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>PO Number</label>
												<input class="form-control" name="po_number" type="text" placeholder="Enter PO Number *" value="<?php  echo $get_asset->po_number; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("cheque_number", $fields) && isset($get_asset->cheque_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Cheque Number</label>
												<input class="form-control" name="cheque_number" type="text" placeholder="Enter Cheque Number *" value="<?php  echo $get_asset->cheque_number; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("receipt_number", $fields) && isset($get_asset->receipt_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Reciept Number</label>
												<input class="form-control" name="receipt_number" type="text" placeholder="Enter Reciept Number *" value="<?php  echo $get_asset->receipt_number; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("challan_number", $fields) && isset($get_asset->challan_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Challan Number</label>
												<input class="form-control" name="challan_number" type="text" placeholder="Enter Challan Number *" value="<?php  echo $get_asset->challan_number; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("donation_mode", $fields) && isset($get_asset->donation_mode)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Donation Number</label>
												<input class="form-control" name="donation_mode" type="number" placeholder="Enter Donation Number *" value="<?php  echo $get_asset->donation_mode; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("transaction_number", $fields) && isset($get_asset->transaction_number)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Transaction Number</label>
												<input class="form-control" name="transaction_number" type="text" placeholder="Enter Transaction Number *" value="<?php  echo $get_asset->transaction_number; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("donation_in_rupees", $fields) && isset($get_asset->donation_in_rupees)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Donation (Rs)</label>
												<input class="form-control" name="donation_in_rupees" type="text" placeholder="Enter Donation (in rupees) *" value="<?php  echo $get_asset->donation_in_rupees; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("event_id", $fields) && isset($get_asset->event_id)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Event ID</label>
												<input class="form-control" name="event_id" type="text" placeholder="Enter Event ID *" value="<?php  echo $get_asset->event_id; ?>">
											</div>

										</div>


									<?php  } ?> <?php  if (in_array("project", $fields) && isset($get_asset->project)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Project/Campaign ID</label>
												<input class="form-control" name="project" type="text" placeholder="Enter Project/Campaign ID " value="<?php  echo $get_asset->project; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("type_of_property", $fields) && isset($get_asset->type_of_property)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Type of Property</label>
												<input class="form-control" name="type_of_property" type="text" placeholder="Enter Type of Property " value="<?php  echo $get_asset->type_of_property; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("type_of_acquisition", $fields) && isset($get_asset->type_of_acquisition)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Type of Acquisition</label>
												<input class="form-control" name="type_of_acquisition" type="text" placeholder="Enter Type of Acquisition *" value="<?php  echo $get_asset->type_of_acquisition; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("upload", $fields) && isset($get_asset->upload)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Upload</label>
												<input class="form-control" name="upload" type="file" placeholder="Upload File">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("qr", $fields) && isset($get_asset->qr)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>QR</label>
												<input class="form-control" name="qr" type="text" placeholder="Enter QR Code *" value="<?php  echo $get_asset->qr; ?>">
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("validity", $fields) && isset($get_asset->validity)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Validity</label>
												<input class="form-control" name="validity" type="date" placeholder="Value " value=<?php  echo $get_asset->validity; ?>>
											</div>
										</div>



									<?php  } ?> <?php  if (in_array("tenure", $fields) && isset($get_asset->tenure)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Tenure/Duration</label>
												<input class="form-control" name="tenure" type="text" placeholder="Enter Tenure/Duration *" value="<?php  echo $get_asset->tenure; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("land_area", $fields) && isset($get_asset->land_area)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Land Area</label>
												<input class="form-control" name="land_area" type="text" placeholder="Enter Land Area *" value="<?php  echo $get_asset->land_area; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("cost_to_trust", $fields) && isset($get_asset->cost_to_trust)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Cost to Trust(Rs.)</label>
												<input class="form-control" name="cost_to_trust" type="number" placeholder="Enter Cost to Trust (in rupees) *" value="<?php  echo $get_asset->cost_to_trust; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("buildings", $fields) && isset($get_asset->buildings)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Buildings (Cost to Trust)</label>
												<input class="form-control" name="buildings" type="text" placeholder="Value *" value="<?php  echo $get_asset->buildings; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("wdv", $fields) && isset($get_asset->wdv)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>W.D.V. (FY - )</label>
												<input class="form-control" name="wdv" type="text" placeholder="Enter WDV *" value="<?php  echo $get_asset->wdv; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("original_documents", $fields) && isset($get_asset->original_documents)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Oriiginal Documents at Trust Office</label>
												<select name="original_documents" class="form-control">
													<option>Select</option>
													<option value="1" <?php  if ($get_asset->original_documents == 1) {
																			echo "selected";
																		} ?>>Yes</option>
													<option value="2" <?php  if ($get_asset->original_documents == 2) {
																			echo "selected";
																		} ?>>No</option>
												</select>
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("receipt_date", $fields) && isset($get_asset->receipt_date)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Reciept Data</label>
												<input class="form-control" name="receipt_date" type="date" placeholder="Enter Receipt Date *" value="<?php  echo $get_asset->receipt_date; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("receipt_via", $fields) && isset($get_asset->receipt_via)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Reciept Via</label>
												<input class="form-control" name="receipt_via" type="text" placeholder="Enter Receipt Via" value="<?php  echo $get_asset->receipt_via; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("file_no", $fields) && isset($get_asset->file_no)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>File Number</label>
												<input class="form-control" name="file_no" type="text" placeholder="Enter File Number *" value="<?php  echo $get_asset->file_no; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("purpose", $fields) && isset($get_asset->purpose)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Purpose/Project</label>
												<input class="form-control" name="purpose" type="text" placeholder="Enter Purpose/Project " value=<?php  echo $get_asset->purpose; ?>>
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("comments_remarks", $fields) && isset($get_asset->comments_remarks)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Comments / Remarks</label>
												<input class="form-control" name="comments_remarks" type="text" placeholder="Enter Comments/Remarks " value="<?php  echo $get_asset->comments_remarks; ?>">
											</div>
										</div>


									<?php  } ?>


									<?php  if (in_array("remarks", $fields) && isset($get_asset->remarks)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Remarks</label>
												<input class="form-control" name="comments_remarks" type="text" placeholder="Enter Remarks " value="<?php  echo $get_asset->remarks; ?>">
											</div>
										</div>


									<?php  } ?>

									<?php  if (in_array("assigned_staff", $fields) && isset($get_asset->assigned_staff)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Assigned Staff</label>
												<input class="form-control" name="assigned_staff" type="text" placeholder="Enter Assigned Staff" value="<?php  echo $get_asset->assigned_staff; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("transferred_on", $fields) && isset($get_asset->transferred_on)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Transffered On</label>
												<input class="form-control" name="transferred_on" type="date" placeholder="Value *" value="<?php  echo $get_asset->transferred_on; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("transferred_for", $fields) && isset($get_asset->transferred_for)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Transffered For</label>
												<input class="form-control" name="transferred_for" type="text" placeholder="Enter Transferred Details" value="<?php  echo $get_asset->transferred_for; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("incident_type", $fields) && isset($get_asset->incident_type)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Incident Type</label>
												<input class="form-control" name="incident_type" type="text" placeholder="Enter Incident Type" value="<?php  echo $get_asset->incident_type; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("incident_date", $fields) && isset($get_asset->bank_ifsc_code)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Incident Date</label>
												<input class="form-control" name="incident_date" type="date" value="<?php  echo $get_asset->incident_date; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("reported_to_hq", $fields) && isset($get_asset->reported_to_hq)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Reported to HQ</label>
												<select name="reported_to_hq" class="form-control">
													<option>Select</option>
													<option value="1" <?php  if ($get_asset->reported_to_hq == 1) {
																			echo "selected";
																		} ?>>Yes</option>
													<option value="2" <?php  if ($get_asset->reported_to_hq == 2) {
																			echo "selected";
																		} ?>>No</option>
												</select>
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("police_fir", $fields) && isset($get_asset->police_fir)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Police FIR</label>
												<input class="form-control" name="police_fir" type="text" placeholder="Enter Police FIR status " value="<?php  echo $get_asset->police_fir; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("asset_condition_as_on_date", $fields) && isset($get_asset->asset_condition_as_on_date)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Asset Condition on date(Scale)</label>
												<input class="form-control" name="asset_condition_as_on_date" type="text" placeholder="Value *" value="<?php  echo $get_asset->asset_condition_as_on_date; ?>">
											</div>
										</div>


									<?php  } ?> <?php  if (in_array("last_physical_audit", $fields) && isset($get_asset->last_physical_audit)) { ?><div class="col-md-6">
											<div class="mb-3">
												<label>Last Physical Audit</label>
												<input class="form-control" name="last_physical_audit" type="date" value="<?php  echo $get_asset->last_physical_audit; ?>">
											</div>
										</div>
									<?php  } ?>
								</div>

							</div>
						</div>
					</div>
			<?php  } ?>



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
                                    <a href="/all_assets" class="btn btn-secondary me-3">Cancel</a>
									
									<button type="submit" class="btn btn-secondary me-3" href="#">Update</button></div><br><br>
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