@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
<?php $property = $data['property'];?>

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
                  <a href="/properties" class="icon-back-right" style="align-items: left; font-size: medium;"> Back </a> <br><br>
                  Properties</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/pages/index">                                      <i data-feather="home"></i></a></li>
                    <!-- <li class="breadcrumb-item">Home</li> -->
                    <li class="breadcrumb-item active"> Add Properties</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
            <form action="/edit_property" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row">

              <div class="col-xl-12">
                  <div class="card">

                    <div class="card-body">
                    <h5>Section A</h5><hr>
                        <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media">
                              <!-- <center><img class="img-70 rounded-circle" alt="" src="/assets/images/user/7.jpg"></center>
                              <div class="media-body">
                               <center> <h5 class="mb-1 f-14 txt-primary">Profile Image</h5></center> -->
                                <!-- <input class="form-control" name="photo" type="file" placeholder="Value *"> -->
                              </div>
                            </div>
                          </div>

                       <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Land/Project Name</label>
                            <input class="form-control" name="name" value="<?php echo $property->name;?>" type="text" placeholder="Value *">
                            <input class="form-control" name="id" value="<?php echo $property->id;?>" type="number" hidden placeholder="Value *">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                           <label for="exampleInputname1">Property Category</label>

                        <select name="category"  class="form-control form-select" placeholder="Select" id="">

                          <option <?php  if($property->category == "land"){echo "selected";} ?>   value="land"> Land</option>
                          <option  value="building" <?php  if($property->category == "building"){echo "selected";} ?>>Building</option></select>

                          <!-- <option selected   <?php  if($property->category == "land"){echo "selected";} ?> value="land"><?php  echo $property->land;?></option>
                          <option selected <?php  if($property->category == "building"){echo "selected";} ?> value="building"><?php  echo $property->building;?></option>
												 -->
												    <!-- <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Profession</label>
                            <select class="form-select" name="profession">
                            <option selected disabled>Select a Profession</option>
                            <?php // foreach($data['professions'] as $profession){?>
                            <option <?php  //if($user->profession == $profession->id){echo "selected";} ?> value="<?php  //echo $profession->id;?>"><?php  //echo $profession->name; ?></option>
                            <?php  //} ?>
                            </select>
                          </div>
                        </div> -->
												</select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Agreement Type</label>
                             <select  class="form-control form-select" name="agreement_type" id="">
                          <option  value="gift"  <?php  if($property->agreement_type == "gift"){echo "selected";} ?>>Gift</option>
                          <option value="purchase" <?php  if($property->agreement_type == "purchase"){echo "selected";}?>>Purchase</option>
                          <option value="lease" <?php  if($property->agreement_type == "lease"){echo "selected";}?>>Lease</option>
                          <option value="other" <?php  if($property->agreement_type == "other"){echo "selected";}?>>Other</option>
												</select>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Other Assests on the property</label>
                            <input class="form-control" value="<?php  echo $property->other_assests_on_property;?>" name="other_assests_on_property" type="text" placeholder="Value">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Purpose of this property</label>
                            <input class="form-control" value="<?php  echo $property->purpose_of_this_property;?>" name="purpose_of_this_property" type="text" placeholder="Value *">
                          </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label>Address</label>
                        <input class="form-control" value="<?php  echo $property->address;?>" name="address" type="text"  placeholder="Enter Address" >
                        </div>
                      </div>

                    </div>
                        <div class="row">

                         <div class="col-sm-4">
                          <div class="mb-3">
                          <label>Pincode</label>
                          <input type="number" class="form-control" value="<?php  echo $property->pincode;?>" placeholder="Enter Pincode" name="pincode" id="pincode" onkeyup="find_pincode(this.value)">
                          </div>
                          </div>

                          <div class="col-sm-4">
                          <div class="mb-3">
                          <label>District</label>
                            <input class="form-control" value="<?php  echo $property->district;?>" type="text" name="district" id="district" placeholder="" readonly>
                          </div>
                          </div>

                          <div class="col-sm-4">
                          <div class="mb-3">
                          <label>State</label>
                            <input class="form-control" value="<?php  echo $property->state;?>" type="text" name="state" id="state" placeholder="" readonly>
                          </div>
                         </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Google Coordinates</label>
                            <input class="form-control" value="<?php  echo $property->coordinates;?>" name="coordinates" type="text" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Dimensions</label>
                            <input class="form-control" value="<?php  echo $property->dimensions;?>" name="dimensions" type="text" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Area</label>
                            <input class="form-control" value="<?php  echo $property->area;?>" name="area" type="text" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Metrics</label>
                            <input class="form-control" value="<?php  echo $property->metrics;?>" name="metrics" type="text" placeholder="Value *">
                          </div>
                        </div>
                        </div>









                    </div>
                  </div>
                </div>

              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h5>Section B</h5><hr>

                     <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Purchase / Contract Start Date</label>
                            <input class="form-control" value="<?php  echo $property->purchase;?>" name="purchase" type="date" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Renewal Date</label>
                            <input class="form-control" value="<?php  echo $property->renew_date;?>" name="renew_date" type="date" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Cost/Rental (Annual)/Lease (Amount)</label>
                            <input class="form-control" value="<?php  echo $property->cost;?>" name="cost" type="number" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>FMV (Fair Market Value)</label>
                            <input class="form-control" value="<?php  echo $property->fmv;?>" name="fmv" type="number" placeholder="Value *">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                            </div>

              </div>


              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h5>Section C</h5><hr>



                      <div class="row">

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Previous Owner/Landlord Name</label>
                            <input class="form-control" value="<?php  echo $property->previous_owner;?>" name="previous_owner" type="text" placeholder="Value *">
                          </div>
                        </div>


                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Previous Owner/Landlord Contact</label>
                            <input class="form-control" value="<?php  echo $property->previous_owner_phn;?>" name="previous_owner_phn" type="text" placeholder="Value *">
                          </div>
                        </div>


                    </div>

                     <div class="row">

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Laising Advocate Name</label>
                            <input class="form-control" value="<?php  echo $property->laising_advocate_name;?>" name="laising_advocate_name" type="text" placeholder="Value *">
                          </div>
                        </div>


                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Laising Advocate Contact</label>
                            <input class="form-control" value="<?php  echo $property->laising_advocate_phn;?>" name="laising_advocate_phn" type="text" placeholder="Value *">
                          </div>
                        </div>


                        </div>




                    </div>
                  </div>
                </div>
              </div>


              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h5>Section D</h5><hr>



                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Registeration Number</label>
                            <input class="form-control" value="<?php  echo $property->reg_number;?>" name="reg_number" type="text" placeholder="Value *">
                          </div>
                        </div>



                         <!-- Container-fluid starts-->
                       <!-- <div class="container-fluid card">
                    <div class="table-responsive card-body"> -->
									<table class="table">
										<thead>
								<style>
                  /* th{
                    width:100%;
                  } */

                  /* td{
                    width:100%;
                  } */
                </style>

											<tr>
												<th scope="col-md-3">Name of the Report</th>
												<th scope="col-md-3">Applicable</th>
												<th scope="col-md-3">Notes</th>

												<th scope="col-md-3">File</th>

											</tr>
										</thead>

										<tbody>


											<tr>

												<td><b>TVC - Title Verification Certificate & Due Deligience</b>
                        <?php if(!empty($property->file_tvc)){ ?> <a href="/profiles/<?php echo $property->file_tvc ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_tvc" id="">
                                               <option  value="yes" <?php  if($property->applicable_tvc == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_tvc == "no"){echo "selected";} ?>>No</option></select> </td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_tvc;?>" type="text" name="notes_tvc" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_tvc;?>" type="file" name="file_tvc" ></td>



											</tr>

                      <tr>

												<td><b>Khata</b>
                        <?php if(!empty($property->file_khata)){ ?> <a href="/profiles/<?php echo $property->file_khata ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?>
                      </td>
                                                <td><select class="form-control form-select" name="applicable_khata" id="">
                                                <option  value="yes"<?php  if($property->applicable_khata == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_khata == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_khata;?>" type="text" name="notes_khata" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_khata;?>" type="file" name="file_khata" ></td>



											</tr>

                      <tr>

												<td><b>Patta</b>
                        <?php if(!empty($property->file_patta)){ ?> <a href="/profiles/<?php echo $property->file_patta ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_patta" id="">
                                               <option  value="yes" <?php  if($property->applicable_patta == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_patta == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_patta;?>" type="text" name="notes_patta" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_patta;?>" type="file" name="file_patta" ></td>



											  </tr>

                          <tr>

												<td><b>Encumburance</b>
                        <?php if(!empty($property->file_encumburance)){ ?> <a href="/profiles/<?php echo $property->file_encumburance ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control" name="applicable_encumburance" id="">
                                               <option  value="yes" <?php  if($property->applicable_encumburance == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_encumburance == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_encumburance;?>" type="text" name="notes_encumburance" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_encumburance;?>" type="file" name="file_encumburance" ></td>


											    </tr>

                            <tr>

												<td><b>Survey Sketch</b>
                        <?php if(!empty($property->file_survy_sketch)){ ?> <a href="/profiles/<?php echo $property->file_survy_sketch ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_survy_sketch" id="">
                                                 <option  value="yes" <?php  if($property->applicable_survy_sketch == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_survy_sketch == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_survy_sketch;?>" type="text" name="notes_survy_sketch" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_survy_sketch;?>" type="file" name="file_survy_sketch" ></td>


											</tr>

                                  <tr>
												<td><b>Soil Test</b>
                        <?php if(!empty($property->file_soiltest)){ ?> <a href="/profiles/<?php echo $property->file_soiltest ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_soiltest" id="">
                                               <option  value="yes" <?php  if($property->applicable_soiltest == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_soiltest == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_soiltest;?>" type="text" name="notes_soiltest" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_soiltest;?>" type="file" name="file_soiltest" ></td>



											</tr>

                              <tr>

												<td><b>Electricity Clearance </b>
                        <?php if(!empty($property->file_ele_cls)){ ?> <a href="/profiles/<?php echo $property->file_ele_cls ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_ele_cls" id="">
                                                <option  value="yes" <?php  if($property->applicable_ele_cls == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_ele_cls == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_ele_cls;?>" type="text" name="notes_ele_cls" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_ele_cls;?>" type="file" name="file_ele_cls" ></td>



											</tr>

                        <tr>

												<td><b>Construction Approval</b>
                        <?php if(!empty($property->file_constr_appro)){ ?> <a href="/profiles/<?php echo $property->file_constr_appro ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_constr_appro" id="">
                                               <option  value="yes" <?php  if($property->applicable_constr_appro == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_constr_appro == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_constr_appro;?>" type="text" name="notes_constr_appro" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_constr_appro;?>" type="file" name="file_constr_appro" ></td>



											</tr>

                        <tr>

												<td><b>Taxation Clearnace </b>
                        <?php if(!empty($property->file_tax_cls)){ ?> <a href="/profiles/<?php echo $property->file_tax_cls ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_tax_cls" id="">
                                                   <option  value="yes" <?php  if($property->applicable_tax_cls == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_tax_cls == "no"){echo "selected";} ?>>No</option></select></td>


                                                <td><input class="form-control" value="<?php  echo $property->notes_tax_cls;?>" type="text" name="notes_tax_cls" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_tax_cls;?>" type="file" name="file_tax_cls" ></td>



											</tr>

                        <tr>

												<td><b>Forest Clearnance </b>
                        <?php if(!empty($property->file_forest_cls)){ ?> <a href="/profiles/<?php echo $property->file_forest_cls ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_forest_cls" id="">
                                                <option  value="yes" <?php  if($property->applicable_forest_cls == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_forest_cls == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_forest_cls;?>" type="text" name="notes_forest_cls" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_forest_cls;?>" type="file" name="file_forest_cls" ></td>



											</tr>

                          <tr>

												<td><b>Court Documents</b>
                        <?php if(!empty($property->file_court_docs)){ ?> <a href="/profiles/<?php echo $property->file_court_docs ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_court_docs" id="">
                                             <option  value="yes" <?php  if($property->applicable_court_docs == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_court_docs == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_court_docs;?>" type="text" name="notes_court_docs" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_court_docs;?>" type="file" name="file_court_docs" ></td>



											</tr>

                        <tr>

												<td><b>Overall Legal Clearnace</b>
                        <?php if(!empty($property->file_overall_legal_cls)){ ?> <a href="/profiles/<?php echo $property->file_overall_legal_cls ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_overall_legal_cls" id="">
                                               <option  value="yes" <?php  if($property->applicable_overall_legal_cls == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_overall_legal_cls == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_overall_legal_cls;?>" type="text" name="notes_overall_legal_cls" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_overall_legal_cls;?>" type="file" name="file_overall_legal_cls" ></td>



											</tr>


                      <tr>

												<td><b>Trust Resolutions/SPOA</b>
                        <?php if(!empty($property->file_trust_resol)){ ?> <a href="/profiles/<?php echo $property->file_trust_resol ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_trust_resol" id="">
                                                 <option value="no" <?php  if($property->applicable_trust_resol == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_trust_resol;?>" type="text" name="notes_trust_resol" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_trust_resol
                                                ;?>" type="file" name="file_trust_resol" ></td>



											</tr>

                      <tr>

												<td><b>Original Recevied at HO</b>
                        <?php if(!empty($property->file_orig_recho)){ ?> <a href="/profiles/<?php echo $property->file_orig_recho ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?></td>
                                                <td><select class="form-control form-select" name="applicable_orig_rec_at_ho" id="">
                                               <option selected value="yes" <?php  if($property->applicable_orig_rec_at_ho == "yes"){echo "selected";} ?>>Yes</option>
                                                 <option value="no"<?php  if($property->applicable_orig_rec_at_ho == "no"){echo "selected";} ?>>No</option></select></td>

                                                <td><input class="form-control" value="<?php  echo $property->notes_orig_recho;?>" type="text" name="notes_orig_recho" placeholder="Enter Notes" ></td>
                                                <td><input class="form-control" value="<?php  echo $property->file_orig_recho;?>" type="file" name="file_orig_recho" ></td>


											</tr>

                      <!-- <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Profession</label>
                            <select class="form-select" name="profession">
                            <option selected disabled>Select a Profession</option>
                            <?php  //foreach($data['professions'] as $profession){?>
                            <option //<?php // if($user->profession == $profession->id){echo "selected";} ?> value="<?php  //echo $profession->id;?>"><?php  //echo $profession->name; ?></option>
                            <?php  //} ?>
                            </select>
                          </div>
                        </div> -->





										</tbody>

									</table>
								</div>
                </div>

          	      </div>
                  </div>

                <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h5>Section E</h5><hr>


                        <div class="col-md-6">

                          <div class="mb-3">
                            <label>Photo/Videos notes
                              
                            </label>
                            <input class="form-control" value="<?php  echo $property->photos_and_video_notes;?>" name="photos_and_video_notes" type="text" placeholder="Value *">
                          </div>
                        </div>

                         <div class="col-md-6">
                          <div class="mb-3">
                            <label>Photo/Videos 
                            <?php if(!empty($property->photos_and_videos)){ ?> <a href="/profiles/<?php echo $property->photos_and_videos ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?>
                            </label>
                            <input class="form-control" value="<?php  echo $property->photos_and_videos;?>" name="photos_and_videos" type="file" placeholder="Value *">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Others notes</label>
                            <input class="form-control" value="<?php  echo $property->other_notes;?>" name="other_notes" type="text" placeholder="Value *">
                          </div>
                        </div>

                         <div class="col-md-6">
                          <div class="mb-3">
                            <label>Others 
                            <?php if(!empty($property->other_files)){ ?> <a href="/profiles/<?php echo $property->other_files ?>" target="_blank"><i class="fa fa-eye"></i> <?php } else { ?> <i class="fa fa-slash-eye"></i> <?php } ?>
                            </label>
                            <input class="form-control" value="<?php  echo $property->other_files;?>" name="other_files" type="file" placeholder="Value *">
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h5>Additional Information</h5><hr>



                      <div class="row">

                        <div class="col-sm-12">
                          <div class="mb-3">

                           <!-- <textarea class="form-control" value="<?php  echo $property->additional_information;?>"  name="additional_information" id="" cols="30" rows="3"  ></textarea> -->
                           <input class="form-control" value="<?php  echo $property->additional_information;?>" name="additional_information" type="text" placeholder="Value *">
                          </div>
                        </div>



                    </div>





                    </div>
                  </div>







                  <div class="col-xl-12">
                <div class="card">

                <div class="row card-f-end">
                        <div class="col">
                          <div class="text-end">
                            <a href="/properties" class="btn btn-secondary me-3">Cancel</a>
                            <button type="submit" class="btn btn-secondary me-3" href="#">Update</button></div><br><br>
                        </div>
                      </div>
              </div>

              </div>
                  </div>
                  </div>
                  </div>
                  </div>


              </div>
     </form>
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
                url: '/pincode/'+pin,
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




          function valueChanged()
          {
              if($('#tenure1_check').is(":checked"))
                  $(".tenure2").show();
              else
                  $(".tenure2").hide();
          }

    </script>
