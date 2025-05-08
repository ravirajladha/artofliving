<?php namespace App\Http\Controllers;
use App\Models\Property_audits;
use App\Models\Auth;
use App\Models\Locations;
?>
@include('inc.header')
<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges);  ?>


<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Property Audit Master</h3>
        </div>
        <div class="col-12 col-sm-6">
        <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Property Audit Master</a></li>
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
                <th> <span>ID</span></th>
                <th> <span>Auditor Id</span></th>
                <th> <span>Start Date</span></th>
                <th> <span>End Date</span></th>
                <th> <span>Location</span></th>
                <?php if(in_array(19, $user_priviliges) || in_array(20, $user_priviliges) || in_array(21, $user_priviliges)) {?>

                <th> <span>Status</span></th>
                <?php } ?>

              </tr>
            </thead>
            <tbody>
              <?php

               foreach ($data['audits'] as $audit) {
                 $count_pending = 0;
                 $property_id = $audit->property_id;
                 $ind_property_id = explode(',', $property_id);
                 foreach ($ind_property_id as $single_property_id) {


                 $get_from_audits =  Property_audits::where('audit_id',$audit->id)
                 ->where('property_id',$single_property_id)
                 ->first();

                  if (empty($get_from_audits)) {
                     $count_pending++;
                   }
                 }
              ?>


                <tr>
                  <td>
                    <?php echo $audit->id ?>
                  </td>
                  <td class="img-content-box">
                    <?php $get_user = Auth::where('id',$audit->auditor_id)->first(); ?>
                    <h6><?php echo ucwords($get_user->name); ?></h6>
                  </td>
                  <td>
                    <h6><?php echo date("d-m-Y", strtotime($audit->start_date));  ?></h6>
                  </td>
                  <td>
                    <h6><?php echo date("d-m-Y", strtotime($audit->end_date));  ?></h6>

                  </td>
                  <td>
                    <h6><?php
                        $get_location = Locations::where('id',$audit->location_id)->first();
                        echo ucwords($get_location->name); ?></h6>
                  </td>
                <?php if(in_array(19, $user_priviliges) || in_array(20, $user_priviliges) || in_array(21, $user_priviliges)) {?>

                  <td>
                  <?php if (($audit->status == "0") && in_array(19, $user_priviliges)) { ?>
                      <h6 class="font-roboto">
                        <a href="/change_property_audit_status/<?php echo $audit->id; ?>"><button class="btn btn-xs btn-success" style="padding:2px;font-size:11px">Start</button></a>
                    </h6>
                    <?php } elseif (($audit->status == "1") && in_array(20, $user_priviliges)) { ?>
                      <h6 class="font-roboto">
                        <a href="/update_property_audits/<?php echo $audit->id; ?>"><button class="btn btn-xs btn-primary" style="padding:2px;font-size:11px">Edit</button></a>
                      </h6>

                    <?php } elseif (($audit->status == "2") && in_array(21, $user_priviliges)) { ?>
                      <h6 class="font-roboto">
                        <a href="/view_property_audit/<?php echo $audit->id; ?>"><button class="btn btn-xs btn-success" style="padding:2px;font-size:11px">View <?php //echo $audit->id; ?></button></a>
                      <?php } ?>
                  </td>
                  <?php } ?>


                </tr>




              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@include('inc.footer')



<script>
  $('input[type="checkbox"]').on('change', function() {
    $('input[type="checkbox"]').not(this).prop('checked', false);
  });
</script>










<div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Asset</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/assign_asset" method="POST">
          <div class="row g-2">

            <div class="col-md-12">
              <label for="exampleInputname1">Select User</label>
              <select name="user_id" class="form-select">
                <?php
                  //foreach ($data['users'] as $user) { ?>
                  <option value="<?php // echo $user->id; ?>"><?php // echo $user->name; ?></option>
                <?php //} ?>
              </select>
            </div>

          </div>

          <div class="col-md-12 mt-0 m-b-20">
            <label for="con-mail">Enter Remark</label>
            <input name="remark" class="form-control" id="con-mail" type="text" required="" autocomplete="off">
          </div>
          <div class="col-md-12 mt-0 m-b-20" style="display:none">
            <label for="con-mail">Enter Remark</label>
            <input class="form-control" id="asset_id_val" name="asset_id" type="text" autocomplete="off">
          </div>

      </div>
      <input id="index_var" type="hidden" value="5">
      <button class="btn btn-secondary">Assign</button>

      </form>
    </div>
  </div>
</div>
</div>



<script>
  function assign_asset(id) {

    $('#asset_id_val').val(id);
  }
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
