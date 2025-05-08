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
          <h3>Processing Asset Audits</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pages/index"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Processing Asset Audits</li>

          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  ​
  ​



  <div class="container-fluid general-widget">
    ​
    ​
    ​
    <div class="row">

      <?php
       $audit_detail = $data['audits'];
       $asset_id = $audit_detail->asset_id;
       $all_asset_id = explode(',', $asset_id);
       foreach ($all_asset_id as $asset_id) { 
         $audits = App\Models\Asset_audits::where('audit_id',$audit_detail->id)
         ->where('asset_id',$asset_id)
         ->first();
       if(!empty($audits)){ 

        ?>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 style="font-weight:bold;font-size:16px">
              <?php $get_asset =  App\Models\Assets::where('id',$asset_id) ->first();?>
              <?php echo ucwords($get_asset->name); ?></h5>
              <hr>
              <div class="form theme-form projectcreate">
                <form action="/pages/update_single_asset_audit/<?php echo $data['audit_id']; ?>/<?php echo $asset_id; ?>" method="POST" enctype="multipart/form-data">
                  <div class="row">
             
                      <div class="col-md-4">
												<label>Asset Cuurent Condition</label>
												<select name="initial_condition" class="form-control" >
													<option disabled selected>Select Condition (Scale)</option>
													<option value="0" <?php if($audits->initial_condition=="0"){ echo "selected";} ?>>0-Not Applicable</option>
													<option value="1" <?php if($audits->initial_condition=="1"){ echo "selected";} ?>>1-Scrapable/rundown/writeoff</option>
													<option value="2" <?php if($audits->initial_condition=="2"){ echo "selected";} ?>>2-Poor</option>
													<option value="3" <?php if($audits->initial_condition=="3"){ echo "selected";} ?>>3-Ok</option>
													<option value="4" <?php if($audits->initial_condition=="4"){ echo "selected";} ?>>4-Good</option>
													<option value="5" <?php if($audits->initial_condition=="5"){ echo "selected";} ?>>5-New/Excellent</option>
												</select>
                      </div>
                    
                      <div class="col-md-4">
                        <label>Document Upload<span>*</span>&nbsp;<?php if(!empty($audits->audit_file)){ ?><a href="/uploads/<?php  echo $audits->audit_file; ?>" target="_blank"><i class="fa fa-eye"></i></a><?php  } ?></label>
                        <input class="form-control" type="file" name="file" >
                      </div>
                      
                      <div class="col-md-4">
                        <label>Notes</label>
                       <textarea class="form-control" name="notes" type="text" placeholder="Enter Notes for reference *"><?php echo $audits->notes;?></textarea>
                      </div>
                      </div>
               <br>
                  <div class="row">
                    <div class="col">
                      <div class="text-end"><button type="submit" class="btn btn-secondary me-3">Update</button></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      <?php }
    } ?>
    </div>

    ​
    <!--
​
            <div class="row">
                
        
              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body"> 
                        <h5 class="mb-0">Details</h5>
                      </div>
                   
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table table-bordernone">
                        <thead> 
                          <tr> 
                            <th> <span>Category</span></th>
                            <th> <span>Sub Category</span></th>
                            <th style="max-width:60px"> <span>Compliances</span></th>
                          </tr>
                        </thead>
                        <tbody> 
                        <?php 
                         //foreach ($data['category'] as $category) {
                           //$subcategory =App\Models\Subcategory::where('category_id',$category->id)->get();
                          // $count = 0;
                          //foreach ($subcategory as $subcat) {
                            // $count++;
                        ?>
                          <tr>
                            <td> <h4><?php 
                             //if ($count == 1) {
                                      // echo $category->name;
                                       //} 
                                      ?></h4> </td>
                            <td> <h5><?php //echo $subcat->name; ?></h5> </td>
                            <td> 
                              
                            <div class="">
                        <div class="card-header pb-0">
                          <h5 class="mb-0">
                            <button class="btn btn-xs btn-primary" data-bs-toggle="collapse" data-bs-target="#s<?php //echo $subcat->id; ?>" aria-expanded="false" aria-controls="s<?php //echo $subcat->id; ?>">View Compliances</button>
                          </h5>
                        </div>
                        <div class="collapse" id="s<?php //echo $subcat->id; ?>" data-bs-parent="#accordion">
                          
                          <div class="card-body">
                             <ul>
                              <?php
                               //$compliances = explode(',', $subcat->compliances);
                               //foreach ($compliances as $compliance) {
                                // $comp = $pageMod->get_compliance($compliance);App\Models\Compliances::where('id',$compliance)->first();
                              ?>
                              <li><?php //echo $comp->name; ?></li>
                              <?php //} ?>
                             </ul>
                          </div>
                        </div>
                      </div> 
                    
                    </td>
                         
                          </tr>
                       <?php //}
                        //} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
                              -->

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
        url: '/pages/check_pincode',
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