<?php namespace App\Http\Controllers;
use App\Models\Auth;
use App\Models\Assets;
use App\Models\Locations;
?>
@include('inc.header')
<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges);  ?>


<?php
$pending =0;
$completed =0;
$total =0;
foreach($data['incidents'] as $incident){
$total++;
if($incident->status == "1"){$pending++;}
else if($incident->status == "2"){$completed++;}}

  ?>
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>incidents</h3>
                </div>
                <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item active"> <a  href="#">Incidents</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">

                  <div class="card-body">
                    <div class="row">
                      <div class="col-xl-4 col-sm-6 box-col-4">
                        <div class="card ecommerce-widget">
                          <div class="card-body support-incident-font">
                            <div class="row">
                              <div class="col-5"><span>Pending</span>
                                <h3 class="total-num counter"><?php echo $pending; ?></h3>
                              </div>
                              <div class="col-7">
                                <div class="text-end">

                                </div>
                              </div>
                            </div>
                            <div class="progress-showcase">
                              <div class="progress sm-progress-bar">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-sm-6 box-col-4">
                        <div class="card ecommerce-widget">
                          <div class="card-body support-incident-font">
                            <div class="row">
                              <div class="col-5"><span>Completed</span>
                                <h3 class="total-num counter"><?php echo $completed; ?></h3>
                              </div>
                              <div class="col-7">
                                <div class="text-end">

                                </div>
                              </div>
                            </div>
                            <div class="progress-showcase">
                              <div class="progress sm-progress-bar">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-sm-6 box-col-4">
                        <div class="card ecommerce-widget">
                          <div class="card-body support-incident-font">
                            <div class="row">
                              <div class="col-5"><span>Total</span>
                                <h3 class="total-num counter"><?php echo $total; ?></h3>
                              </div>
                              <div class="col-7">
                                <div class="text-end">

                                </div>
                              </div>
                            </div>
                            <div class="progress-showcase mt-4">
                              <div class="progress sm-progress-bar">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="table-resposive">




                 {{-- <table class="display table table-bordernone" id="basic-1"> --}}
                    <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                          <tr>
                          <th> <span>ID</span></th>
                          <th> <span>Item</span></th>
                            <th> <span>User</span></th>
                            <!-- <th> <span>Remark</span></th>
                            <th> <span>Date</span></th>
                            <th> <span>Document</span></th>
                            <th> <span>Response</span></th>
                            <th> <span>Response Document</span></th> -->
                            <?php if(in_array(26, $user_priviliges)) {?>

                            <th> <span>Action</span></th>
                    <?php } ?>

                          </tr>
                        </thead>
                        <tbody>

                          <?php
                           foreach($data['incidents'] as $incident){

                          $user = Auth::find($incident->user_id);
                          $asset = Assets::find($incident->asset_id);
                          $owner = Auth::find($asset->owner_id);
                          if(isset($user->location_id)){
                          $building = Locations::find($user->location_id);

                          }

                        //   if($owner->id == Session('rexkod_apex_user_id') || Session('rexkod_apex_user_type') == "hq"){
                          ?>
                          <tr>
                          <td>
                              <h6><?php echo $incident->id; ?></h6>
                            </td>
                          <td>
                              <div class="media">
                                <div class="square-box me-2"><img class="img-fluid b-r-5" src="/profiles/<?php echo $asset->image; ?>" alt=""></div>
                                <div class="media-body ps-2">
                                  <div class="avatar-details"><a href="product-page.html">
                                      <a href="/asset/<?php echo $asset->id; ?>"><h6><?php echo $asset->name; ?></h6></a></div>
                                </div>
                              </div>
                            </td>
                            <td class="img-content-box">
                              <h6><?php if(isset($user->name)){echo $user->name;} ?></h6><span><?php if(isset($building->name)){echo $building->name;} ?></span>
                            </td>

                            <?php if(in_array(26, $user_priviliges)) {?>

                            <td>

                            <a href="/incident/<?php echo $incident->id; ?>"><button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-success"><i class='fa fa-eye'></i></button></a>

                            </td>

                    <?php } ?>

                          </tr>
                            <?php } //}
                            ?>

                        </tbody>
                      </table>
                    </div>

                  </div>
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
