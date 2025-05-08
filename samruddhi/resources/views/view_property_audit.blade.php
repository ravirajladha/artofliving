<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Property_audits;
use App\Models\Property;
?>
@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>

          Property Audits</h3>
        </div>
        <div class="col-12 col-sm-6">
        <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/property_audits">Property Audits</a></li>
                        <li class="breadcrumb-item active"><a href="#"> Audit</a></li>
                  </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts         -->
  <div class="container-fluid card">
    <div class="row card-body">

      <div class="col-xl-12 xl-100 box-col-7">
        <div class="row">

          {{-- <table class="table table-striped" id="basic-1"> --}}
            <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>

            <thead>
              <tr>
                <th> <span>Property ID</span></th>
                <th> <span> Name</span></th>
                <th> <span>Current Condition</span></th>
                <th> <span>Documents</span></th>
                <th> <span>Notes</span></th>
                <th> <span>Date</span></th>
                <th> <span>Time</span></th>

              </tr>
            </thead>
            <tbody>
              <?php


               $audit_detail = $data['audits']; 
               $property_id = $audit_detail->property_id;
               $all_property_id = explode(',', $property_id);
               foreach ($all_property_id as $property_id) {

                 $audits =Property_audits::where('audit_id',$audit_detail->id)
                 ->where('property_id',$property_id)
                 ->first();


              ?>
                <tr>
                  <td class="img-content-box">
                    <h6><?php
                     $get_asset = Property::where('id',$audits->property_id)->first();

                        if(isset($get_asset->name)){echo $get_asset->id;} ?></h6>
                  </td>
                  <td class="img-content-box">
                    <h6><?php
                     $get_asset = Property::where('id',$audits->property_id)->first();

                        if(isset($get_asset->name)){echo $get_asset->name;} ?></h6>
                  </td>
                  <td class="img-content-box">
                    <h6><?php
                         $condition = $audits->initial_condition;
                         if ($condition == '0') {
                           echo "Not Applicable";
                         } elseif ($condition == "1") {
                           echo "Scrapable/rundown/writeoff";
                         } elseif ($condition == '2') {
                           echo "Poor";
                         } elseif ($condition == '3') {
                           echo "Ok";
                         } elseif ($condition == '4') {
                           echo "Good";
                         } elseif ($condition == '5') {
                           echo "New/Excellent";
                         } ?>
                    </h6>
                  </td>
                  <td class="img-content-box">

                    <h6><?php if(!empty($audits->audit_file)){ ?><a href="/profiles/<?php echo $audits->audit_file;?>" target="_blank"><i class="fa fa-eye"></i></a><?php }else{ ?> <i class="fa fa-eye-slash"></i><?php } ?></h6>
                  </td>
                  <td class="img-content-box">
                    <h6><?php if(isset($audits->notes)){echo $audits->notes;} ?></h6>
                  </td>

                  <td>
                              <h6><?php if(isset($audits->created_at)){echo date('M jS Y', strtotime($audits->created_at)); } ?></h6>

                            </td>
                            <td> <h6><?php if(isset($audits->created_at)){echo date('h.i.s A', strtotime($audits->created_at));} ?></h6></td>



                </tr>




              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="text-end">
    <a href="/property_audits" class="btn btn-secondary me-3">Back</a>
    </div>
  <!-- Container-fluid Ends-->
</div>
@include('inc.footer')







</script>



<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>


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
