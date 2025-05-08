<?php namespace App\Http\Controllers; 
use Illuminate\Support\Facades\Session;
use App\Models\Asset_audits;
use App\Models\Assets;
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
          Update Asset Audits</h3>
        </div>
        <div class="col-12 col-sm-6">
        <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/asset_audits">Audit Master</a></li>
                        <li class="breadcrumb-item active"><a href="#">Update Asset Audit</a></li>
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
          <a href="/unassigned_asset/<?php echo $data['audit_id']; ?>" class="btn btn-danger align-right"  style="float: right !important; width: 200px;">
            Unassigned Asset
          </a><br>
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
                    <th scope="col-md-3">Asset Name </th> 
                    <th scope="col-md-3">Asset Current Condition <span>*</span></th>
                    <th scope="col-md-3">Document Upload </th>
                    <th scope="col-md-3">Notes </th>

                    <th scope="col-md-3">Action</th>

                  </tr>
                </thead>
                
                <tbody>
                  
                  <br>


                  <?php
                  $audit_detail = $data['audits'];
                  $asset_id = $audit_detail->asset_id;
                  $all_asset_id = explode(',', $asset_id);
                  $pending_audit = 0;
                  foreach ($all_asset_id as $asset_id) {
                    $get_from_audits = Asset_audits::where('audit_id',$audit_detail->id)
                    ->where('asset_id',$asset_id)
                    ->first();
                    $get_not_found = Asset_audits::all();
                    
                    if (empty($get_from_audits)) {
                      $pending_audit = 1;
                  ?>
                      <form action="/create_single_asset_audit/<?php echo $data['audit_id']; ?>/<?php echo $asset_id; ?>" method="POST" enctype="multipart/form-data">
                      @csrf
                        <tr> 
                          <?php  $get_asset = Assets::where('id',$asset_id)->first();
                           ?>

                          <td> <?php if(isset($get_asset->name)){
                            echo ucwords($get_asset->name);
                           
                            } ?>
                             <input type="hidden" value="<?php echo $get_asset->id ?>"> 
                             <br>

                            <?php  
                            $unassigned=$audit_detail->unassigned_asset;
                            $u = explode(',', $unassigned);

                            $not_found=$audit_detail->not_found;
                            $n = explode(',', $not_found);


                            // print_r($u);
                            foreach ($u as $u) {
                            if($get_asset->id == $u){
                            ?>
                            <label class="btn btn-xs btn-warning"
                            style="padding:2px;font-size:11px">Unassigned</label>
                            <?php }} ?>

                             <?php foreach ($n as $n1) {
                            if($get_asset->id == $n1){
                            ?>
                            <label class="btn btn-xs btn-warning"
                            style="padding:2px;font-size:11px">Not Found</label>
                            <?php }} ?>
                          
                          </td>
                          <td>
                             <?php 
                            //  $not_found=$audit_detail->not_found;
                            // $n = explode(',', $not_found);
                            // foreach ($n as $n) {
                            //   if($get_asset->id != $n){
                              ?> 
                            <select name="initial_condition" class="form-control" required> 
                              <option readonly value="">Select Condition (Scale)</option>
                              <option value="0">0-Not Applicable</option>
                              <option value="1">1-Scrapable/rundown/writeoff</option>
                              <option value="2">2-Poor</option>
                              <option value="3">3-Ok</option>
                              <option value="4">4-Good</option>
                              <option value="5">5-New/Excellent</option>
                            </select>
                           <?php 
                          // }}
                           ?> 
                          </td>

                          <td> 
                            <input class="form-control" type="file" name="file" ></td>
                          <td> <textarea class="form-control" name="notes" type="text" placeholder="Enter Notes for reference " ></textarea></td>
                          <td>
                          
                             <?php 
                              // if($get_from_audits->not_found == 0){
                              ?> 
                            
                            <button type="submit" class="btn btn-success">
                              Update
                            </button>
                            <?php 
                          // } 
                          ?>
                              

                            <a href="/not_found/<?php echo $data['audit_id']; ?>/<?php echo $get_asset->id ?>" class="btn btn-danger">
                              Not Found
                            </a>
                          </td>

                        </tr>
                    </form>
                    <?php }
                  }
                    ?>
                    <?php
                    $audit_detail = $data['audits'];
                    $asset_id = $audit_detail->asset_id;
                    $all_asset_id = explode(',', $asset_id);
                    foreach ($all_asset_id as $asset_id) {
                        $audits = Asset_audits::where('audit_id',$audit_detail->id)
                        ->where('asset_id',$asset_id)
                        ->first();
                        // print_r($audits);
                     
                      if (!empty($audits)) {  
                        ?>
                        <form action="/update_single_asset_audit/<?php echo $data['audit_id']; ?>/<?php echo $asset_id; ?>" method="POST" enctype="multipart/form-data">
                        @csrf
                          <tr>
                            <?php $get_asset = Assets::where('id',$asset_id)->first();
                            ?>

                            <td> <?php echo ucwords($get_asset->name); ?><?php if (!empty($audits->audit_file)) { ?>
                              <a href="/profiles/<?php echo $audits->audit_file; ?>" target="_blank" style="display:inline-block;"><i class="fa fa-eye"></i></a><?php  } ?>
                              <br>
                            <?php  
                            $unassigned=$audit_detail->unassigned_asset;
                            $u = explode(',', $unassigned);

                            $not_found=$audit_detail->not_found;
                            $n = explode(',', $not_found);


                            // print_r($u);
                            foreach ($u as $u) {
                            if($get_asset->id == $u){
                            ?>
                            <button class="btn btn-xs btn-warning"
                            style="padding:2px;font-size:11px">Unassigned</button>
                            <?php }} ?>

                             <?php foreach ($n as $n) {
                            if($get_asset->id == $n){
                            ?>
                            <button class="btn btn-xs btn-danger"
                            style="padding:2px;font-size:11px;">Not Found</button>
                            <?php }} ?>
                          
                            </td>
                            
                            <td> 
                              <?php if($audits->not_found!=1){ ?>
                              <select name="initial_condition" class="form-control" required>
                                <option readonly value="">Select Condition (Scale)</option>
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
                              </select>
                              <?php } ?>
                            
                            </td>

                            <td> <?php if($audits->not_found!=1){ ?>
                              
                              <input class="form-control" type="file" name="file" style="display:inline-block;">
                              <?php } ?>
                              
                            </td>
                            <td> 
                              <?php if($audits->not_found!=1){ ?>
                              <textarea class="form-control" name="notes" type="text" placeholder="Enter Notes for reference "><?php echo $audits->notes; ?></textarea>
                              <?php } ?>
                                
                            </td>

                            <td>
                              <?php if($audits->not_found!=1){ ?>
                              <button type="submit" class="btn btn-warning">
                                Edit
                              </button>
                              <?php } 
                              
                                ?>
                                   
                                  
                            
                            </td>
                          </tr>
                        </form>
                    <?php 
                    }
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
    <a href="/change_asset_audit_final_status/<?php echo $audit_detail->id; ?>/0"><button class="btn btn-lg btn-success" style="font-size:15px;">Finalize</button></a>

    <a href="/asset_audits"><button class="btn btn-lg btn-warning" style="font-size:15px;">Cancel</button></a>
      </div>

    <?php }else{ ?>
      <div class="text-end">
      <a href="/change_asset_audit_final_status/<?php echo $audit_detail->id; ?>/1"><button class="btn btn-lg btn-success" style="font-size:15px;">Finalize</button></a>

      <a href="/asset_audits"><button class="btn btn-lg btn-warning" style="font-size:15px;">Cancel</button></a>
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