@include('inc.header')

 <?php $property = $data['property']; ?>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="page-header-left">
                    <h3>

                    <?php echo $data['property']->name; ?></h3>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item "><a href="/properties">All Properties</a></li>
                        <li class="breadcrumb-item active"><a href="#">Property Details</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
           <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
            <form action="/update_property/<?php echo $property->id;?>" method="POST" enctype="multipart/form-data">
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
                        <div class="media col-md-6">
                          <div class="media-body">
                          <!-- <div class="mb-3 ">
                            <a href=""><span class="f-w-600 d-block">Land/Project Name</span></a>
                            <p><?php echo $property->name;?></p>
                          </div> -->
                        </div>

                        <div class="media col-md-6">
                          <div class="mb-3">
                           <a href=""><a href=""><label class="f-w-600 d-block" class="f-w-600 d-block" for="exampleInputname1">Property Category</label></a></a>

                       <?php echo $property->category ;?>

                          <!-- <option selected   <?php if($property->category == "land"){echo "selected";} ?> value="land"><?php echo $property->land;?></option>
                          <option selected <?php if($property->category == "building"){echo "selected";} ?> value="building"><?php echo $property->building;?></option>
												 -->
												    <!-- <div class="col-sm-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Profession</label></a>
                            <select class="form-select" name="profession">
                            <option selected disabled>Select a Profession</option>
                            <?php //foreach($data['professions'] as $profession){?>
                            <option //<?php //if($user->profession == $profession->id){echo "selected";//} ?> value="<?php //echo $profession->id;?>"><?php //echo $profession->name; ?></option>
                            <?php //} ?>
                            </select>
                          </div>
                        </div> -->
												</select>
                          </div>
                        </div>

                        <div class="media col-md-8">
                          <div class="mb-3">
                            <a href=""><a href=""><label class="f-w-600 d-block">Agreement Type</label class="f-w-600 d-block"></a>
                           <?php echo $property->agreement_type ;?>
                          </div>
                        </div>
                            </div>

                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block" class="f-w-600 d-block">Other Assests on the property</label></a>
                           <?php echo $property->other_assests_on_property;?>
                          </div>
                        </div>

                        <div class="media col-md-3">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block" class="f-w-600 d-block">Purpose of this property</label></a>
                           <?php echo $property->purpose_of_this_property;?>
                          </div>
                        </div>

                        <div class="col-md-9">
                        <div class="mb-3">
                        <a href=""><label class="f-w-600 d-block" class="f-w-600 d-block">Address</label></a>
                        <?php echo $property->address;?>
                        </div>
                      </div>

                    </div>
                        <div class="row">

                         <div class="col-md-3">
                          <div class="mb-3">
                          <a href=""><label class="f-w-600 d-block" class="f-w-600 d-block">Pincode</label></a>
                          <?php echo $property->pincode;?>
                          </div>
                          </div>

                          <div class="col-md-3">
                          <div class="mb-3">
                          <a href=""><label class="f-w-600 d-block" class="f-w-600 d-block">District</label></a>
                           <?php echo $property->district;?>
                          </div>
                          </div>

                          <div class="col-sm-4">
                          <div class="mb-3">
                          <a href=""><label class="f-w-600 d-block" class="f-w-600 d-block">State</label></a>
                            <?php echo $property->state;?>
                          </div>
                         </div>
                      </div>

                      <div class="row">
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Google Coordinates</label></a>
                           <?php echo $property->coordinates;?>
                          </div>
                        </div>
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Dimensions</label></a>
                        <?php echo $property->dimensions;?>
                          </div>
                        </div>
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Area</label></a>
                           <?php echo $property->area;?>
                          </div>
                        </div>
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Metrics</label></a>
                           <?php echo $property->metrics;?>
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
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Purchase / Contract Start Date</label></a>
                        <?php echo $property->purchase;?>
                          </div>
                        </div>
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Renewal Date</label></a>
                        <?php echo $property->renew_date;?>
                          </div>
                        </div>
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Cost/Rental (Annual)/Lease (Amount)</label></a>
                        <?php echo $property->cost;?>
                          </div>
                        </div>
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">FMV (Fair Market Value)</label></a>
                        <?php echo $property->fmv;?>
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
                            <a href=""><label class="f-w-600 d-block">Previous Owner/Landlord Name</label></a>
                        <?php echo $property->previous_owner;?>
                          </div>
                        </div>


                      <div class="col-sm-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Previous Owner/Landlord Contact</label></a>
                        <?php echo $property->previous_owner_phn;?>
                          </div>
                        </div>


                    </div>

                     <div class="row">

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Laising Advocate Name</label></a>
                        <?php echo $property->laising_advocate_name;?>
                          </div>
                        </div>


                      <div class="col-sm-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Laising Advocate Contact</label></a>
                        <?php echo $property->laising_advocate_phn;?>
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
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Registeration Number</label></a>
                        <?php echo $property->reg_number;?>
                          </div>
                        </div>



                         <!-- Container-fluid starts-->
                       <!-- <div class="container-fluid card">
                    <div class="table-responsive card-body"> -->
									{{-- <table class="table"> --}}
                                        <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

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

												<td><b>TVC - Title Verification Certificate & Due Deligience</b></td>
                                                <td><?php echo $property->applicable_tvc;?></td>

                                                <td><?php if(!empty($property->notes_tvc)){ ?><?php echo $property->notes_tvc;?><?php }else{ echo "None";} ?></td>
                                                <td> <?php if(!empty($property->file_tvc)){ ?>
                              <h6><a href="/profiles/<?php echo $property->file_tvc; ?>" target="_BLANK">View</a></h6> <?php }else{ echo "No file Present";} ?>
                             </td>



											</tr>

                      <tr>

												<td><b>Khata</b></td>

                                                <td><?php  echo $property->applicable_khata;?></td>

                                                 <td><?php  if(!empty($property->notes_khata)){ ?><?php  echo $property->notes_khata;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_khata)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_khata; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>




											</tr>

                      <tr>

												<td><b>Patta</b></td>
                                                  <td><?php  echo $property->applicable_patta;?></td>


                                                  <td><?php  if(!empty($property->notes_patta)){ ?><?php  echo $property->notes_patta;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_patta)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_patta; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>






											  </tr>

                          <tr>

												<td><b>Encumburance</b></td>

                                                <td><?php  echo $property->applicable_encumburance;?></td>


                                                  <td><?php  if(!empty($property->notes_encumburance)){ ?><?php  echo $property->notes_encumburance;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_encumburance)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_encumburance; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>

											    </tr>

                            <tr>

												<td><b>Survey Sketch</b></td>


                                                <td><?php  echo $property->applicable_survy_sketch;?></td>


                                                  <td><?php  if(!empty($property->notes_survy_sketch)){ ?><?php  echo $property->notes_survy_sketch;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_survy_sketch)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_survy_sketch; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>





											</tr>

                                  <tr>
												<td><b>Soil Test</b></td>

                                                <td><?php  echo $property->applicable_soiltest;?></td>


                                                  <td><?php  if(!empty($property->notes_soiltest)){ ?><?php  echo $property->notes_soiltest;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_soiltest)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_soiltest; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>

											</tr>

                              <tr>

												<td><b>Electricity Clearance </b></td>


                                                   <td><?php  echo $property->applicable_ele_cls;?></td>


                                                  <td><?php  if(!empty($property->notes_ele_cls)){ ?><?php  echo $property->notes_ele_cls;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_ele_cls)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_ele_cls; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>


											</tr>

                        <tr>

												<td><b>Construction Approval</b></td>



                                                   <td><?php  echo $property->applicable_ele_cls;?></td>


                                                  <td><?php  if(!empty($property->notes_constr_appro)){ ?><?php  echo $property->notes_constr_appro;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_constr_appro)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_constr_appro; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>


											</tr>

                        <tr>

												<td><b>Taxation Clearnace </b></td>



                                                 <td><?php  echo $property->applicable_tax_cls;?></td>


                                                  <td><?php  if(!empty($property->notes_tax_cls)){ ?><?php  echo $property->notes_tax_cls;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_tax_cls)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_tax_cls; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>


											</tr>

                        <tr>

												<td><b>Forest Clearnance </b></td>



                                                 <td><?php  echo $property->applicable_forest_cls;?></td>


                                                  <td><?php  if(!empty($property->notes_forest_cls)){ ?><?php  echo $property->notes_forest_cls;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_forest_cls)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_forest_cls; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>



											</tr>

                          <tr>

												<td><b>Court Documents</b></td>

                                                     <td><?php  echo $property->applicable_court_docs;?></td>


                                                  <td><?php  if(!empty($property->notes_court_docs)){ ?><?php  echo $property->notes_court_docs;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_court_docs)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_court_docs; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>





											</tr>

                        <tr>

												<td><b>Overall Legal Clearnace</b></td>

                                                   <td><?php  echo $property->applicable_overall_legal_cls;?></td>


                                                  <td><?php  if(!empty($property->notes_overall_legal_cls)){ ?><?php  echo $property->notes_overall_legal_cls;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_overall_legal_cls)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_overall_legal_cls; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>




											</tr>


                      <tr>

												<td><b>Trust Resolutions/SPOA</b></td>

                                                  <td><?php  echo $property->applicable_trust_resol;?></td>


                                                  <td><?php  if(!empty($property->notes_trust_resol)){ ?><?php  echo $property->notes_trust_resol;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_trust_resol)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_trust_resol; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>





											</tr>

                      <tr>

												<td><b>Original Recevied at HO</b></td>

                                                    <td><?php  echo $property->applicable_orig_rec_at_ho;?></td>


                                                  <td><?php  if(!empty($property->notes_orig_recho)){ ?><?php  echo $property->notes_orig_recho;?><?php  }else{ echo "None";} ?></td>

                                              <td> <?php  if(!empty($property->file_orig_recho)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->file_orig_recho; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                             </td>




											</tr>

                      <!-- <div class="col-sm-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Profession</label></a>
                            <select class="form-select" name="profession">
                            <option selected disabled>Select a Profession</option>
                            <?php // foreach($data['professions'] as $profession){?>
                            <option <?php  //if($user->profession == $profession->id){echo "selected";} ?> value="<?php  //echo $profession->id;?>"><?php  //echo $profession->name; ?></option>
                            <?php //} ?>
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


                        <div class="media col-md-6">

                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Photo/Videos notes</label></a>
                        <?php  echo $property->photos_and_video_notes;?>
                          </div>
                        </div>

                         <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Photo/Videos </label></a>
                          <?php  if(!empty($property->photos_and_videos)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->photos_and_videos; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Others notes</label></a>
                        <?php  echo $property->other_notes;?>
                          </div>
                        </div>

                         <div class="media col-md-6">
                          <div class="mb-3">
                            <a href=""><label class="f-w-600 d-block">Others </label></a>
                        <?php  if(!empty($property->other_files)){ ?>
                              <h6><a href="/profiles/<?php  echo $property->other_files; ?>" target="_BLANK">View</a></h6> <?php  }else{ echo "No file Present";} ?>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h5>Additional Information</h5><hr>



                      <div class="row">

                        <div class="col-sm-12">
                          <div class="mb-3">

                      <?php echo $property->additional_information;?>
                          </div>
                        </div>



                    </div>





                    </div>
                  </div>






<!--
                  <div class="col-xl-12">
                <div class="card">

                <div class="row card-f-end">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Submit</button></div><br><br>
                        </div>
                      </div>
              </div> -->


              </div>
              </div>
              </div>

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-border">
                    <h5>Audits</h5>
                  </div>
                  <div class="card-body">

                  {{-- <table class="table table-bordernone"> --}}
                    <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                          <tr>
                            <th> <span>Audit Id</span></th>
                            <th> <span>Notes</span></span></th>
                            <th> <span>Current Condition </span></th>
                            <th> <span>View Document </span></th>
                            <th> <span>Date</span></th>
                            <th> <span>Time</span></th>


                            <!-- <th> <span>Action</span></th> -->
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach($data['audits'] as $audit){
                          ?>
                          <tr>
                          <td><h6><?php echo $audit->audit_id; ?></h6></td>
                          <td><h6><?php echo $audit->notes; ?></h6></td>

                          <?php $condition  = $audit->initial_condition; ?>
                          <td><h6><?php if($condition=='0'){echo "Not Applicable";}elseif($condition=="1"){echo "Scrapable/rundown/writeoff";}elseif($condition=='2'){echo "Poor";}elseif($condition=='3'){echo "Ok";}elseif($condition=='4'){echo "Good";}elseif($condition=='5'){echo "New/Excellent";}?> </h6></td>
                          <td>
                              <?php if($audit->audit_file){ ?>
                              <h6><a href="/profiles/<?php  echo $audit->audit_file; ?>" target="_BLANK"><i class="fa fa-eye"></i></a></h6>
                              <?php } else { ?>
                                <h6><i class="fa fa-eye-slash"></i></h6>
                            <?php } ?>

                            </td>

                            <td>
                              <h6><?php echo date('M jS Y', strtotime($audit->created_at)); ?></h6>

                            </td>
                            <td> <h6><?php echo date('h.i.s A', strtotime($audit->created_at)); ?></h6></td>



                          </tr>
                            <?php } ?>

                        </tbody>
                      </table>
                </div>
              </div>
              </div>


     </form>
            </div>
          </div> </div>
          </div>
        </div>
                   <!-- Container-fluid Ends-->
        </div>
            </div>

            @include('inc.footer')




{{-- =================================== import and export table data =================================== --}}
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.12.1/css/dataTables.responsive.css">
<script type="text/javascript" src="//cdn.datatables.net/responsive/1.12.1/js/dataTables.responsive.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
{{-- =================================== import and export table data =================================== --}}
