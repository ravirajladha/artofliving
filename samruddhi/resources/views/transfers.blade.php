<?php namespace App\Http\Controllers;
use App\Models\Auth;
use App\Models\Assets;
use App\Models\Locations;
use Illuminate\Support\Facades\Session;
?>
@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Transfers</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>

                    <li class="breadcrumb-item active"> <a  href="#">Transfers</a></li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">



                  <div class="container-fluid card">
            <div class="row card-body">
            {{-- <table class="display table table-bordernone" id="basic-1"> --}}
                <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                          <tr>
                          <th> <span>ID</span></th>
                          <th> <span>Item</span></th>
                            <th> <span>User</span></th>
                            <th> <span>Remark</span></th>
                            <th> <span>Date</span></th>

                            <th> <span>Status</span></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($data['assigns'] as $assign){

                                $user = Auth::find($assign->user_id);

                                $asset = Assets::find($assign->asset_id);
                                $owner = Auth::find($asset->owner_id);
                                $building = Locations::find($user->location_id);

                            if($user->id == Session::get('rexkod_apex_user_id') || Session::get('rexkod_apex_user_type') == "admin" || Session::get('rexkod_apex_user_type') == "itadmin"){

                            ?>
                          <tr>
                          <td>
                              <h6>{{$assign->id}}</h6>
                            </td>
                          <td>
                              <div class="media">
                                <div class="square-box me-2"><img class="img-fluid b-r-5" src="/projects/public/profiles<?php echo $asset->image; ?>" alt=""></div>
                                <div class="media-body ps-2">
                                  <div class="avatar-details"><a href="#">
                                      <a href="/asset/<?php echo $asset->id; ?>"><h6><?php echo $asset->name; ?></h6></a></div>
                                </div>
                              </div>
                            </td>
                            <td class="img-content-box">
                              <h6><?php if(isset($user->name)){echo $user->name;} ?></h6><span><?php if(isset($building->name)){echo $building->name;} ?></span>
                            </td>
                            <td>
                              <h6><?php if(isset($assign->assign_remark)){echo $assign->assign_remark;} ?></h6>
                            </td>
                            <td>
                              <h6><?php if(isset($assign->assign_datetime)){echo date('M jS Y - h:m A', strtotime($assign->assign_datetime));} ?></h6>
                            </td>
                            <td>
                            <?php if($assign->status == 0 || $assign->status == 2){ ?>
                              <div class="badge badge-light-info">Pending </div>
                            <?php } else if($assign->status == 1 ){ ?>
                              <div class="badge badge-light-success">Completed </div>
                            <?php } else { ?>
                              <div class="badge badge-light-warning">Cancelled </div>
                            <?php } ?>
                            </td>
                          </tr>
                            <?php }
                          } ?>

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
