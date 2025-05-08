@include('inc.header')

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
          <h3>Properties</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Add Property</a></li>
          </ol>
          <br>
          <ol class="breadcrumb">  
            <li class="breadcrumb-item"><a href="/assets/property_upload.csv" download="property_upload.csv">Download File</a></li>


            <li class="breadcrumb-item"><a href="/add_property_upload"> Upload Property</a></li>
        </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
         @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        <span style="color: red">{{$error}}</span>
        <br>
        @endforeach
        @endif
      <form action="/add_property" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

          <div class="col-xl-12">
            <div class="card">

              <div class="card-body">
                <h4>Section A</h4>
                <hr>
                <div class="row mb-2">
                  <div class="profile-title">
                    <div class="media">
                      <!-- <center><img class="img-70 rounded-circle" alt="" src="/assets/images/user/7.jpg"></center>
                              <div class="media-body">
                               <center> <h4 class="mb-1 f-14 txt-primary">Profile Image</h4></center> -->
                      <!-- <input class="form-control" name="photo" type="file" placeholder="Value *"> -->
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Land/Project Name</label>
                      <input class="form-control" name="name" type="text" placeholder="Value *" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputname1">Property Category</label>

                      <select name="category" class="form-control" id="" required>
                        <option value="land">Land</option>
                        <option value="building">Building</option>


                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Agreement Type</label>
                      <select class="form-control" name="agreement_type" id="" required>
                        <option value="gift">Gift</option>
                        <option value="purchase">Purchase</option>
                        <option value="lease">Lease</option>
                        <option value="other">Other</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Other Assests on the property</label>
                      <input class="form-control" name="other_assests_on_property" type="text" placeholder="Value *" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Purpose of this property</label>
                      <input class="form-control" name="purpose_of_this_property" type="text" placeholder="Value *" required>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label>Address</label>
                      <input class="form-control" name="address" type="text" placeholder="Value *" required>
                    </div>
                  </div>

                </div>
                <div class="row">

                  <div class="col-sm-4"> 
                    <div class="mb-3">
                      <label>Pincode</label>
                      <input type="number" class="form-control" placeholder="Enter Pincode" name="pincode" id="pincode" onkeyup="find_pincode(this.value)">
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label>District</label>
                      <input class="form-control" type="text" name="district" id="district" placeholder="" readonly>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label>State</label>
                      <input class="form-control" type="text" name="state" id="state" placeholder="" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Google Coordinates</label>
                      <input class="form-control" name="coordinates" type="text" placeholder="Value *" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Dimensions</label>
                      <input class="form-control" name="dimensions" type="text" placeholder="Value *" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Area</label>
                      <input class="form-control" name="area" type="text" placeholder="Value *" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Metrics</label>
                      <input class="form-control" name="metrics" type="text" placeholder="Value *" required>
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
                  <h4>Section B</h4>
                  <hr>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Purchase / Contract Start Date</label>
                        <input class="form-control" name="purchase" type="date" placeholder="Value *" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Renewal Date</label>
                        <input class="form-control" name="renew_date" type="date" placeholder="Value *" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Cost/Rental (Annual)/Lease (Amount)</label>
                        <input class="form-control" name="cost" type="number" placeholder="Value *" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>FMV (Fair Market Value)</label>
                        <input class="form-control" name="fmv" type="number" placeholder="Value *" required>
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
                  <h4>Section C</h4>
                  <hr>



                  <div class="row">

                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label>Previous Owner/Landlord Name</label>
                        <input class="form-control" name="previous_owner" type="text" placeholder="Value *" required>
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label>Previous Owner/Landlord Contact</label>
                        <input class="form-control" name="previous_owner_phn" type="number" placeholder="Value *" required>
                      </div>
                    </div>


                  </div>

                  <div class="row">

                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label>Laising Advocate Name</label>
                        <input class="form-control" name="laising_advocate_name" type="text" placeholder="Value *" required>
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label>Laising Advocate Contact</label>
                        <input class="form-control" name="laising_advocate_phn" type="number" placeholder="Value *"  required>
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
                  <h4>Section D</h4>
                  <hr>



                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Registeration Number</label>
                        <input class="form-control" name="reg_number" type="text" placeholder="Value *" required>
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

                          <td><b>TVC - Title Verification Certificate & Due Deligience <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_tvc" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_tvc" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_tvc"></td>



                        </tr>

                        <tr>

                          <td><b>Khata <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_khata" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_khata" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_khata"></td>



                        </tr>

                        <tr>

                          <td><b>Patta <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_patta" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_patta" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_patta"></td>



                        </tr>

                        <tr>

                          <td><b>Encumburance <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_encumburance" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_encumburance" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_encumburance"></td>


                        </tr>

                        <tr>

                          <td><b>Survey Sketch <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_survy_sketch" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_survy_sketch" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_survy_sketch"></td>


                        </tr>

                        <tr>
                          <td><b>Soil Test <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_soiltest" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_soiltest" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_soiltest"></td>



                        </tr>

                        <tr>

                          <td><b>Electricity Clearance <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_ele_cls" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_ele_cls" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_ele_cls"></td>



                        </tr>

                        <tr>

                          <td><b>Construction Approval <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_constr_appro" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_constr_appro" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_constr_appro"></td>



                        </tr>

                        <tr>

                          <td><b>Taxation Clearnace <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_tax_cls" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_tax_cls" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_tax_cls"></td>



                        </tr>

                        <tr>

                          <td><b>Forest Clearnance <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_forest_cls" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_forest_cls" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_forest_cls"></td>



                        </tr>

                        <tr>

                          <td><b>Court Documents <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_court_docs" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_court_docs" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_court_docs"></td>



                        </tr>

                        <tr>

                          <td><b>Overall Legal Clearnace <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_overall_legal_cls" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_overall_legal_cls" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_overall_legal_cls"></td>



                        </tr>


                        <tr>

                          <td><b>Trust Resolutions/SPOA <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_trust_resol" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_trust_resol" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_trust_resol"></td>



                        </tr>

                        <tr>

                          <td><b>Original Recevied at HO <span>*</span></b></td>
                          <td><select class="form-control" name="applicable_orig_rec_at_ho" id="">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                              <option value="yes">TBA</option>
                              <option value="no">N/A</option>
                            </select> </td>

                          <td><input class="form-control" type="text" name="notes_orig_recho" placeholder="Enter Notes"></td>
                          <td><input class="form-control" type="file" name="file_orig_recho"></td>


                        </tr>





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
                    <h4>Section E</h4>
                    <hr>


                    <div class="col-md-6"> 

                      <div class="mb-3">
                        <label>Photo/Videos Notes <span>*</span></label>
                        <input class="form-control" name="photos_and_video_notes" type="text" placeholder="Value *">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Photo/Videos <span>*</span></label>
                        <input class="form-control" name="photos_and_videos" type="file" placeholder="Value *">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Others Notes <span>*</span></label>
                        <input class="form-control" name="other_notes" type="text" placeholder="Value *">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Others </label>
                        <input class="form-control" name="other_files" type="file" placeholder="Value *">
                      </div>
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                      <h4>Additional Information</h4>
                      <hr>



                      <div class="row">

                        <div class="col-sm-12">
                          <div class="mb-3">

                            <textarea name="additional_information" id="" cols="30" rows="3" class='form-control' placeholder="Enter Information"></textarea>
                          </div>
                        </div>



                      </div>





                    </div>
                  </div>







                  <div class="col-xl-12">
                    <div class="crd">

                      <div class="row card-f-end">
                        <div class="col">
                          <div class="text-end">
                            <a href="/index" class="btn btn-secondary me-3">Cancel</a>
                            <button type="submit" class="btn btn-secondary me-3" href="#">Add</button></div><br><br>
                        </div>
                      </div>
                    </div>


                  </div>
      </form>
    </div>
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


  function valueChanged() {
    if ($('#tenure1_check').is(":checked"))
      $(".tenure2").show();
    else
      $(".tenure2").hide();
  }
</script>
