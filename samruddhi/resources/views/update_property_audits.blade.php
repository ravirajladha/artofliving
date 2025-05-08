<?php namespace App\Http\Controllers; 
use App\Models\Property_audits;
use App\Models\Property;
use App\Models\Locations;
?> 

@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
​
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
        
          Update Property Audits</h3>
        </div>
        <div class="col-12 col-sm-6">
        <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/property_audits">Audit Master</a></li>
                        <li class="breadcrumb-item active"><a href="#">Update Property Audit</a></li>
                  </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  ​
  ​

  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <div class="form theme-form Cubiclecreate">
          <!-- <h4></h4> -->
          <hr>
          <div class="container-fluid general-widget">
            ​
            ​
            ​
            <div class="row">
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
                    <th scope="col-md-3">Property Name </th>
                    <th scope="col-md-3">Property Current Condition<span>*</span> </th>
                    <th scope="col-md-3">Document Upload<span>*</span></th>
                    <th scope="col-md-3">Notes<span>*</span></th>

                    <th scope="col-md-3">Action</th>

                  </tr>
                </thead>

                <tbody>


                  <?php
                  $audit_detail = $data['audits'];
                  $property_id = $audit_detail->property_id;
                  $all_property_id = explode(',', $property_id);
                  $pending_audit = 0;
                  foreach ($all_property_id as $property_id) {
                    $get_from_audits = Property_audits::where('audit_id',$audit_detail->id) 
                    ->where('property_id',$property_id)
                    ->first();
                    
                    if (empty($get_from_audits)) {
                      $pending_audit = 1;
                  ?>
                      <form action="/create_single_property_audit/<?php echo $data['audit_id']; ?>/<?php echo $property_id; ?>" method="POST" enctype="multipart/form-data">
                      @csrf
                        <tr>
                          <?php $get_property = Property::where('id',$property_id)->first();
                          ?>

                          <td> <?php echo ucwords($get_property->name); ?></td>
                          <td><select name="initial_condition" class="form-control" required>
                              <option readonly value="">Select Condition (Scale)</option>
                              <option value="0">0-Not Applicable</option>
                              <option value="1">1-Scrapable/rundown/writeoff</option>
                              <option value="2">2-Poor</option>
                              <option value="3">3-Ok</option>
                              <option value="4">4-Good</option>
                              <option value="5">5-New/Excellent</option>
                            </select></td>
                          <td> <input class="form-control" type="file" name="file" required></td>
                          <td> <textarea class="form-control" name="notes" type="text" placeholder="Enter Notes for reference *" required></textarea></td>
                          <td><button type="submit" class="btn btn-success">
                             Update
                            </button></td>

                        </tr>
                    </form>
                    <?php }
                  }
                    ?>
                    <?php
                    $audit_detail = $data['audits'];
                    $property_id = $audit_detail->property_id;
                    $all_property_id = explode(',', $property_id);
                    foreach ($all_property_id as $property_id) {
                      $audits = Property_audits::where('audit_id',$audit_detail->id) 
                      ->where('property_id',$property_id)
                      ->first();
                    
                      if (!empty($audits)) {  ?>
                        <form action="/update_single_property_audit/<?php echo $data['audit_id']; ?>/<?php echo $property_id; ?>" method="POST" enctype="multipart/form-data">
                            @csrf
                          <tr>
                            <?php $get_property =  $get_property = Property::where('id',$property_id)->first();
                            ?>

                            <td> <?php echo ucwords($get_property->name); ?><?php if (!empty($audits->audit_file)) { ?><a href="/profiles/<?php echo $audits->audit_file; ?>" target="_blank" style="display:inline-block;"><i class="fa fa-eye"></i></a><?php  } ?></td>

                            <td> <select name="initial_condition" class="form-control">
                                <option disabled selected>Select Condition (Scale)</option>
                                <option value="0" <?php if ($audits->initial_condition == "0") {
                                                    echo "selected";
                                                  } ?>>0-Not Applicable</option>
                                <option value="1" <?php if ($audits->initial_condition == "1") {
                                                    echo "selected";
                                                  } ?>>1-Scrapable/rundown/writeoff</option>
                                <option value="2" <?php if ($audits->initial_condition == "2") {
                                                    echo "selected";
                                                  } ?>>2-Poor</option>
                                <option value="3" <?php if ($audits->initial_condition == "3") {
                                                    echo "selected";
                                                  } ?>>3-Ok</option>
                                <option value="4" <?php if ($audits->initial_condition == "4") {
                                                    echo "selected";
                                                  } ?>>4-Good</option>
                                <option value="5" <?php if ($audits->initial_condition == "5") {
                                                    echo "selected";
                                                  } ?>>5-New/Excellent</option>
                              </select></td>

                            <td> <input class="form-control" type="file" name="file" style="display:inline-block;"></td>
                            <td> <textarea class="form-control" name="notes" type="text" placeholder="Enter Notes for reference *"><?php echo $audits->notes; ?></textarea></td>

                            <td><button type="submit" class="btn btn-warning">
                                Edit
                              </button></td>
                          </tr>
                        </form>
                    <?php }
                    } ?>
                </tbody>
              </table>
            </div>
          </div>
        
        </div>
      </div>
    <!-- <button type="button" class="btn btn-success lg-100 text-center"  style="float:right;">Finalize</button> -->
    <?php if($pending_audit==0){?>
      <div class="text-end">

    <a href="/change_property_audit_final_status/<?php echo $audit_detail->id; ?>/0"><button class="btn btn-lg btn-success" style="font-size:15px;">Finalize</button></a>
    <a href="/property_audits"><button class="btn btn-lg btn-warning" style="font-size:15px;">Cancel</button></a>
      </div>

    <?php }else{ ?>
      <div class="text-end">
      <a href="/change_property_audit_final_status/<?php echo $audit_detail->id; ?>/1"><button class="btn btn-lg btn-success" style="font-size:15px;">Finalize</button></a>
      <a href="/property_audits"><button class="btn btn-lg btn-warning" style="font-size:15px;">Cancel</button></a>
    </div>
    <?php } ?>
    </div>

  </div>
</div>
<!-- Container-fluid Ends-->
</div>

​
@include('inc.footer')

​
​
<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>

​

<script>
  $(".tenure2").hide();

  function find_pincode(pin) {
    if (pin.length == 6) {
      $.ajax({
        url: '/check_pincode',
        type: 'POST',
        data: {
          pin
        },
        ​
        success: function(res) {
          var detail = res.split(',');
          document.getElementById("district").value = detail[0];
          document.getElementById("state").value = detail[1];
        }​
      });
    } else {
      document.getElementById("from_city").value = "";
      document.getElementById("from_state").value = "";
    }
  }​​

  ​
  function valueChanged() {
    if ($('#tenure1_check').is(":checked"))
      $(".tenure2").show();
    else
      $(".tenure2").hide();
  }
</script>