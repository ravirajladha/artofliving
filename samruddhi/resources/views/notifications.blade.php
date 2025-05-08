<?php namespace App\Http\Controllers; 
use Illuminate\Support\Facades\DB;
use App\Models\Assigns;
use App\Models\Assets;
use App\Models\Notifications;
?>
@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Notifications</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item active"> <a  href="#">Notifications</a></li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">


              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-request recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    {{-- <table class="display" id="basic-1"> --}}
                        <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>Asset ID</th>
                          <th>Type</th>
                            <th>Notification</th>
                            <!-- <th>Remark</th> -->
                            <th>Date Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach($data['notifications'] as $notification){
                        //    $remark = DB::table('notifications')
                        //  ->join('assigns', 'assigns.user_id', '=', 'notifications.user_id')
                        //  ->where('assigns.assign_remark', $notification->id)
                        //  ->first();

                              $assign = Assigns::where('user_id',Session('rexkod_apex_user_id'))
                              ->where('status',0)
                              ->get();
                              foreach($assign as $assign){
                              // echo $assign->user_id;
                              $asset_info= Assets::where('id',$assign->asset_id)->get();
                              // echo $asset_info->id;
                              }
                          ?>
                          <tr>
                          <td><?php echo $notification->id; ?></td>
                          <td><?php echo $notification->asset_id; ?></td>
                           <td><?php echo ucfirst($notification->type); ?></td>
                            <td><?php echo $notification->notification; ?></td>

                            <!-- <td><?php //echo $remark->assign_remark; ?></td> -->
                            <td><?php //echo date('M jS Y - h:m A', strtotime($notification->datetime)); ?>
                              <?php echo date('M jS Y', strtotime($notification->datetime)); ?> -
                              <?php echo date('h.i.s A', strtotime($notification->datetime)); ?>
                            
                            </td>
                            <td>
                                <?php
                                if($notification->type == "assign" && $notification->action == "0"){ 

                                      $qr= Assets::where('id',$notification->asset_id)->first();
                                      ?>
                                    <select class="form-select" onchange="check_aid(<?php echo $notification->id; ?>,'<?php echo $qr->qr; ?>',this.value)" id="1">
                                     
                                                    <option value="">Select QR Code </option>
                                                   <?php $assign = Assigns::where('user_id',Session('rexkod_apex_user_id'))
                                                    // ->where('status',0)
                                                    // ->where('status',2)
                                                    ->whereIn('status', ['0', '2'])
                                                    ->get();
                                                    
                                                     foreach ($assign as $asset_info) {
                                                      $code = Assets::where('id',$asset_info->asset_id)->first();
                                                      ?>
                                                  
                                                    <option value="<?php echo $code->qr ?>" ><?php echo $code->qr ?></option>
                                                    <?php } ?>
                                    </select>
                                    {{-- <input onKeyup="check_aid(<?php //echo $notification->id; ?>,<?php //echo $notification->asset_id; ?>,this.value)" type="text" class="forn-control" placeholder="Enter Asset ID" style="margin-bottom:5px"> --}}
                                    <div class="row">
                                      <div class="col-md-6"></div>
                                      <div class="col-md-2">

                                    <a style="display:none" id="<?php echo $notification->id ?>" href="/assign_response/<?php echo $notification->id; ?>/<?php echo $notification->asset_id; ?>/1"><button class="btn btn-sm btn-success" style="padding:2px 5px;font-size:11px"><i class="fa fa-check"></i></button></a>
                                    </div>

                                    <div class="col-md-3"> 
                                       <a href="/assign_response/<?php echo $notification->id; ?>/<?php echo $notification->asset_id; ?>/3"><button class="btn btn-sm btn-warning" style="padding:2px 5px;font-size:11px"><i class="fa fa-times"></i></button></a></div>
                                    </div>
                                <?php } ?>
                            </td>



                          </tr>
                        <?php } ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="text-end">
                <a href="/index" class="btn btn-secondary me-3">Cancel</a>
                </div>

              </div>

            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @include('inc.footer')


<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>

    <script>
      function check_aid(id,aid,val){
        // alert(1);
      // val = val.substring(2);
      // val = parseInt(val);
      if(aid == val){
        document.getElementById(id).style.display = "block";
      }
      }
    </script>

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
