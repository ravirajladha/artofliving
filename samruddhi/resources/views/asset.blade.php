<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Auth;
use App\Models\Assets;
use App\Models\Locations;
use App\Models\Compliances;
?>
@include('inc.header')
<?php
$asset = $data['asset'];

$owner = Auth::where('id', $asset->owner_id)->first();

$cur_user = Auth::where('id', $asset->user_id)->first();
$transfer = 0;
foreach ($data['assigns'] as $assign) {
  $user = Auth::where('id', $assign->user_id)->first();
  if ($user->type == "manager") {
    $transfer++;
  }
}

?>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="page-header-left">

            <h3>

            <?php 
              $owner = Auth::where('id', $asset->owner_id)->first();
              echo $data['asset']->name;?> Owner : <?php echo $owner->name;  
              ?></h3>

          </div>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">


          <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="/all_assets">All Assets</a></li>
                        <li class="breadcrumb-item active"><a href="#">Asset Details</a></li>

          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row Assetdetails">

      <div class="col-xl-2 col-sm-6">

        <img src="/profiles/<?php echo $asset->image; ?>" width="125" class="mr-4" /></a>
      </div>

      <div class="col-xl-2 col-sm-6">
         <a href="<?php echo 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $asset->qr; ?>" width="125" target="_blank" class="mr-4"> 

          <img src="<?php echo 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $asset->qr; ?>" width="125" class="mr-4" />
        </a>  
      

        
      </div>


      <div class="col-xl-2 col-sm-6">
        <div class="card">
          <div class="card-body">

            <div class="Asset-widgets text-center">
              <h1 class="font-primary counter">1</h1>
              <h6 class="mb-0">Days Old</h6>
            </div>
          </div>

        </div>
      </div>

      <div class="col-xl-2 col-sm-6">
        <div class="card">
          <div class="card-body">

            <div class="Asset-widgets text-center">
              <h1 class="font-primary counter"><?php echo count($data['assigns']); ?></h1>
              <h6 class="mb-0">Assigns</h6>
            </div>
          </div>

        </div>
      </div>


      <div class="col-xl-2 col-sm-6">
        <div class="card">
          <div class="card-body">

            <div class="Asset-widgets text-center">
              <h1 class="font-primary counter"><?php echo count($data['tickets']); ?></h1>
              <h6 class="mb-0">Tickets</h6>
            </div>
          </div>

        </div>
      </div>
      <div class="col-xl-2 col-sm-6">
        <div class="card">
          <div class="card-body">

            <div class="Asset-widgets text-center">
              <h1 class="font-primary counter"><?php echo count($data['incidents']); ?></h1>
              <h6 class="mb-0">Incidents</h6>
            </div>
          </div>

        </div>
      </div>


    </div>

    <div class="col-sm-12 box-col-12">
      <div class="card">
        <div class="social-tab">
          <ul class="nav nav-tabs" id="top-tab" role="tablist">

            {{-- <li class="nav-item"><img src="/profiles/<?php //echo $asset->image; ?>" alt=""></li> --}}

            <li class="nav-item"><a style="margin-left:100px" class="navlink" id="top-about" data-bs-toggle="modal" href="#" data-bs-target="#reportmodal"> </a></li>




            <li class="nav-item"><a class="nav-link btn btn-success" style='color:#fff' id="top-timeline" data-bs-toggle="modal" href="#" data-bs-target="#transfermodal"><i style="color:#fff" data-feather="clock"></i>Transfer Asset</a></li>

            <li class="nav-item"><a class="nav-link btn btn-info" style='color:#fff' id="top-friends" data-bs-toggle="modal" href="#" data-bs-target="#ticketmodal"><i style="color:#fff" data-feather="image"></i>Service Ticket</a></li>
            <li class="nav-item"><a class="nav-link btn btn-warning" style='color:#fff' id="top-about" data-bs-toggle="modal" href="#" data-bs-target="#reportmodal"><i style="color:#fff" data-feather="alert-circle"></i>Report Incident </a></li>



          </ul>

        </div>
      </div>
    </div>



    <div class="row Assetmore">

      <div class="col-md-12 col-sm-12">
        <div class="card">
          <div class="card-header card-header-border">
            <h5>Information</h5>
          </div>
          <div class="collapse show" id="collapseicon12" aria-labelledby="collapseicon12" data-parent="#accordion">
            <div class="card-body social-status filter-cards-view row">

              <?php foreach ($data['fields'] as $field) {
                $field_name = str_replace('_', ' ', $field);
                $field_name  = ucwords($field_name);
              ?>



                <div class="media col-md-6">
                  <div class="media-body"><a href="#"><span class="f-w-600 d-block"><?php echo $field_name; ?></span></a>
                    <p><?php echo $asset->$field; ?></p>
                  </div>
                </div>

              <?php } ?>




            </div>
          </div>
        </div>
      </div>
    </div>




    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-border">
          <h5>Assigns</h5>
        </div>
        <div class="card-body">
          {{-- <table class="table table-bordernone"> --}}
            <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

            <thead>
              <tr>
                <th> <span>User</span></th>
              
                <th> <span>Date & Time</span></th>
                <th> <span>Status</span></th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($data['assigns'] as $assign) {


                $user = Auth::where('id', $assign->user_id)->first();
                $asset = Assets::where('id', $assign->asset_id)->first();
                $building = Locations::where('id', $assign->location_id)->first();

              ?>
                <tr>

                  <td class="img-content-box">
                    <h6><?php if(isset($user->name)){echo $user->name;} ?></h6><span><?php if(isset($building->name)){echo $building->name;} ?></span>
                  </td>
                  
                  <td>
                    <h6><?php echo date('M jS Y', strtotime($assign->assign_datetime)); ?> -
                      <?php echo date('h.i.s A', strtotime($assign->assign_datetime)); ?></h6>
                  </td>
                  <td>

                    <?php if ($assign->status == "0") { ?>
                      <div class="badge badge-light-info">Pending</div>
                    <?php } else if ($assign->status == "1") { ?>
                      <div class="badge badge-light-success">Accepted</div>
                    <?php } else if ($assign->status == "2") { ?>
                      <div class="badge badge-light-warning">Pending</div>
                    <?php } else { ?>
                      <div class="badge badge-light-danger">Completed & Reassigned</div>
                    <?php } ?>

                  </td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-border">
            <h5>Transfers</h5>
          </div>
          <div class="card-body">
            {{-- <table class="table table-bordernone"> --}}
                <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

              <thead>
                <tr>
                  <th> <span>Asset</span></th>
                  <th> <span>Asset ID</span></th>
                  <th> <span>User</span></th>
                  <th> <span>Remark</span></th>
                  <th> <span>Date & Time</span></th>

                  <th> <span>Status</span></th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($data['assigns'] as $assign) { ?>


                <tr>
                  <td>
                    <div class="media">
                      <div class="square-box me-2"><img class="img-fluid b-r-5" src="/profiles/<?php echo $asset->image; ?>" alt=""></div>
                      <div class="media-body ps-2">
                        <div class="avatar-details"><a href="product-page.html">
                            <a href="/asset/<?php echo $asset->id; ?>">
                              <h6><?php echo $asset->name; ?></h6>
                            </a></div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h6><?php echo $asset->code."".$asset->id ?></h6>
                  </td>
                  <td class="img-content-box">
                    <h6><?php if(isset($user->name)){echo $user->name;} ?></h6><span><?php if(isset($building->name)){echo $building->name;} ?></span>
                  </td>
                  <td>
                    <h6><?php if(isset($assign->assign_remark)){echo $assign->assign_remark;} ?></h6>
                  </td>
                  <td>
                    <h6><?php echo date('M jS Y', strtotime($assign->assign_datetime)); ?> -
                      <?php echo date('h.i.s A', strtotime($assign->assign_datetime)); ?></h6>
                  </td>
                  <td>
                  <?php if(isset($assign->status)){
                     if ($assign->status == "0") { ?>
                      <div class="badge badge-light-info">Pending </div>
                    <?php } else if ($assign->status == 1) { ?>
                      <div class="badge badge-light-success">Completed </div>
                    <?php } elseif ($assign->status == 2){ ?>
                      <div class="badge badge-light-warning">Pending </div>
                    <?php } else {  ?>
                      <div class="badge badge-light-warning">Completed & Reassigned </div>

                    
                      <?php }} ?>

                  </td>
                </tr>
              <?php } ?>

              </tbody>
            </table>
          </div>
        </div>


        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-border">
              <h5>Tickets</h5>
            </div>
            <div class="card-body">
              {{-- <table class="table table-bordernone"> --}}
                <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                <thead>
                  <tr>
                    <th> <span>Item</span></th>
                    <th> <span>User</span></th>
                    <th> <span>Remark</span></th>
                    <th> <span>Date</span></th>
                    <th> <span>Document</span></th>

                    <th> <span>Action</span></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data['tickets'] as $ticket) {
                   
                    $user = Auth::where('id', $ticket->user_id)->first();
                    $asset = Assets::where('id', $ticket->asset_id)->first();
                    $building = Locations::where('id', $user->location_id)->first();
                    if ($user->id == Session('rexkod_apex_user_id') || Session('rexkod_apex_user_type') == "hq" 
                    || Session('rexkod_apex_user_type') == "itadmin" ||
                     Session('rexkod_apex_user_id') == $asset->owner_id  ) {
                  ?>
                  
                      <tr>
                        <td>
                          <div class="media">
                            <div class="square-box me-2"><img class="img-fluid b-r-5" src="/profiles/<?php echo $asset->image; ?>" alt=""></div>
                            <div class="media-body ps-2">
                              <div class="avatar-details"><a href="product-page.html">
                                  <a href="/asset/<?php echo $asset->id; ?>">
                                    <h6><?php echo $asset->name; ?></h6>
                                  </a></div>
                            </div>
                          </div>
                        </td>
                        <td class="img-content-box">
                          <h6><?php if(isset($user->name)){ echo $user->name;} ?></h6><span><?php if(isset($building->name)){echo $building->name;} ?></span>
                        </td>
                        <td>
                          <h6><?php if(isset($ticket->request_remark)){ echo $ticket->request_remark;} ?></h6>
                        </td>
                        <td>
                          <h6>
                            <?php //if(isset($ticket->request_datetime)){ echo date('M jS Y - h:m A', strtotime($ticket->request_datetime));} 
                            ?>
                            <?php echo date('M jS Y', strtotime($ticket->request_datetime)); ?> -
                            <?php echo date('h.i.s A', strtotime($ticket->request_datetime)); ?>
                          </h6>
                        </td>
                        <td>
                          <?php if ($ticket->document) { ?>
                            <h6><a href="/profiles/<?php echo $ticket->document; ?>" target="_BLANK">View</a></h6>
                          <?php  } ?>
                        </td>
                        <td>
                          <?php if ($ticket->status == 2) { ?>
                            <div class="badge badge-light-success">Completed </div>
                          <?php  } else { ?>
                            <div class="badge badge-light-primary">Pending </div>
                          <?php } ?>
                        </td>
                      </tr>
                  <?php }
                  } ?>

                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-border">
                <h5>Tickets Response</h5>
              </div>
              <div class="card-body">

                {{-- <table class="table table-bordernone"> --}}
                    <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>


                  <thead>
                    <tr>
                      <th> <span>Item</span></th>
                      <th> <span>User</span></th>
                      <th> <span>Response Remark</span></th>
                      <th> <span>Date</span></th>
                      <th><span>Response Document</span></th>
                    <th> <span>Action</span></th>


                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data['tickets'] as $ticket) {

                      $user = Auth::where('id', $ticket->user_id)->first();
                      $asset = Assets::where('id', $ticket->asset_id)->first();
                      $building = Locations::where('id', $user->location_id)->first();
                      if ($user->id == Session('rexkod_apex_user_id') || Session('rexkod_apex_user_type') == "hq" || Session('rexkod_apex_user_type') == "itadmin" || Session('rexkod_apex_user_id') == $asset->owner_id) {
                    ?>
                        <tr>
                          <td>
                            <div class="media">
                              <div class="square-box me-2"><img class="img-fluid b-r-5" src="/profiles/<?php echo $asset->image; ?>" alt=""></div>
                              <div class="media-body ps-2">
                                <div class="avatar-details"><a href="product-page.html">
                                    <a href="/asset/<?php echo $asset->id; ?>">
                                      <h6><?php echo $asset->name; ?></h6>
                                    </a></div>
                              </div>
                            </div>
                          </td>
                          <td class="img-content-box">
                            <h6><?php if(isset($user->name)){ echo $user->name;} ?></h6><span><?php if(isset($building->name)){echo $building->name;} ?></span>
                          </td>
                          <td>
                            <h6><?php if(isset($ticket->response_remark)){ echo $ticket->response_remark;} ?></h6>
                          </td>
                          <td>
                            <h6><?php //if(isset($ticket->request_datetime)){ echo date('M jS Y - h:m A', strtotime($ticket->request_datetime));} ?>
                              <?php echo date('M jS Y', strtotime($ticket->request_datetime)); ?> -
                              <?php echo date('h.i.s A', strtotime($ticket->request_datetime)); ?></h6>

                          </td>
                          <td>
                            <?php if ($ticket->response_document) { ?>
                              <h6><a href="/profiles/<?php echo $ticket->response_document; ?>" target="_BLANK">View</a></h6>
                            <?php  } ?>
                          </td>
                          <td>
                            <?php if ($ticket->status == 2) { ?>
                              <div class="badge badge-light-success">Completed </div>
                            <?php  } else { ?>
                              <div class="badge badge-light-primary">Pending </div>
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




          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-border">
                <h5>Incidents</h5>
              </div>
              <div class="card-body">

                {{-- <table class="table table-bordernone"> --}}
                    <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                  <thead>
                    <tr>
                      <th> <span>Item</span></th>
                      <th> <span>User</span></th>
                      <th> <span>Remark</span></th>
                      <th> <span>Date</span></th>
                      <th><span>Document</span></th>
                      <th> <span>Action</span></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data['incidents'] as $incident) {
                      $user = Auth::where('id', $incident->user_id)->first();
                      $asset = Assets::where('id', $incident->asset_id)->first();
                      $building = Locations::where('id', $user->location_id)->first();

                      if ($user->id == Session('rexkod_apex_user_id') || Session('rexkod_apex_user_type') == "hq" || Session('rexkod_apex_user_type') == "itadmin" || Session('rexkod_apex_user_id') == $asset->owner_id) {
                    ?>
                        <tr>
                          <td>
                            <div class="media">
                              <div class="square-box me-2"><img class="img-fluid b-r-5" src="/profiles/<?php echo $asset->image; ?>" alt=""></div>
                              <div class="media-body ps-2">
                                <div class="avatar-details"><a href="product-page.html">
                                    <a href="/asset/<?php echo $asset->id; ?>">
                                      <h6><?php echo $asset->name; ?></h6>
                                    </a></div>
                              </div>
                            </div>
                          </td>
                          <td class="img-content-box">
                            <h6><?php if(isset($user->name)){echo $user->name;} ?></h6><span><?php if(isset($building->name)){echo $building->name;} ?></span>
                          </td>
                          <td>
                            <h6><?php if(isset($incident->request_remark)){echo $incident->request_remark;} ?></h6>
                          </td>
                          <td>
                            <h6><?php //if(isset($incident->request_datetime)){echo date('M jS Y - h:m A', strtotime($incident->request_datetime));} ?>
                              <?php echo date('M jS Y', strtotime($incident->request_datetime)); ?> -
                              <?php echo date('h.i.s A', strtotime($incident->request_datetime)); ?></h6>

                          </td>
                          <td>
                            <?php if ($incident->document) { ?>
                              <h6><a href="/profiles/<?php echo $incident->document; ?>" target="_BLANK">View</a></h6>
                            <?php } ?>
                          </td>
                          <td>
                            <?php if ($incident->status == 2) { ?>
                              <div class="badge badge-light-success">Completed </div>
                            <?php } else { ?>
                              <div class="badge badge-light-primary">Pending </div>
                            <?php  } ?>
                          </td>
                        </tr>

                    <?php }
                    } ?>

                  </tbody>
                </table>
              </div>
            </div>


          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-border">
                <h5>Compliances</h5>
              </div>
              <div class="card-body">

                {{-- <table class="table table-bordernone"> --}}
                    <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                  <thead>
                    <tr>
                      <th> <span>Name</span></th>
                      <th> <span>Start Date</span></th>
                      <th> <span>End Date</span></th>
                      <th> <span>Document</span></th>
                      <th> <span>Status</span></th>

                      <!-- <th> <span>Action</span></th> -->
                    </tr>
                  </thead>
                  <tbody>



                    <?php foreach ($data['dependencies'] as $dependency) {
                      $compliance_detail = Compliances::where('id', $dependency->compliance_id)->first();
                      $asset =  Assets::where('id', $dependency->asset_id)->first(); ?>

 
                      <tr> 
                        <td>
                          <h6><?php echo $compliance_detail->name; ?></h6>
                        </td>


                        <td>
                          <h6><?php echo date('M jS Y', strtotime($dependency->start_date)); ?></h6>
                        </td>
                        <td>
                          <h6><?php echo date('M jS Y', strtotime($dependency->end_date)); ?></h6>
                        </td>
                        <td>
                          <?php if ($dependency->file) { ?>
                            <h6><a href="/profiles/<?php echo $dependency->file; ?>" target="_BLANK"><i class="fa fa-eye"></i></a></h6>
                          <?php } else { ?>
                            <h6>No File Present</h6>
                          <?php  } ?>

                        </td>
                        <td>
                          <?php if ($dependency->status == 1) { ?>
                            <div class="badge badge-light-success">Completed </div>
                          <?php } else { ?>
                            <div class="badge badge-light-primary">Active </div>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
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
                      <th> <span>Current Conidition </span></th>
                      <th> <span>View Document </span></th>
                      <th> <span>Date</span></th>
                      <th> <span>Time</span></th>


                      <!-- <th> <span>Action</span></th> -->
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data['audits'] as $audit) {
                    ?>
                      <tr>
                        <td>
                          <h6><?php echo $audit->audit_id; ?></h6>
                        </td>
                        <td>
                          <h6><?php echo $audit->notes; ?></h6>
                        </td>

                        <?php $condition  = $audit->initial_condition; ?>
                        <td>
                          <h6><?php
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
                              }
                              ?> </h6>
                        </td>
                        <td>
                          <?php if ($audit->audit_file) { ?>
                            <h6><a href="/profiles/<?php echo $audit->audit_file; ?>" target="_BLANK"><i class="fa fa-eye"></i></a></h6>
                          <?php } else { ?>
                            <h6><i class="fa fa-eye-slash"></i></h6>
                          <?php } ?>

                        </td>

                        <td>
                          <h6><?php echo date('M jS Y', strtotime($audit->created_at)); ?></h6>

                        </td>
                        <td>
                          <h6><?php echo date('h.i.s A', strtotime($audit->created_at)); ?></h6>
                        </td>



                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>


        </div>




      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@include('inc.footer')


<div class="modal fade modal-bookmark" id="transfermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transfer Asset</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/transfer_asset/<?php echo $data['asset']->id; ?>" method="POST">
        @csrf
          <div class="row g-2">

            <div class="col-md-12">
              <label for="exampleInputname1">Asset Owner</label><br>
              <input type="text" name="user_id" class="form-control" value="<?php echo $owner->id; ?>" style="display:none">
              <input type="text" class="form-control" value="<?php echo $owner->name; ?>" readonly>
              <br>
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
      <button class="btn btn-secondary">Transfer</button>

      </form>
    </div>
  </div>
</div>
</div>



<div class="modal fade modal-bookmark" id="ticketmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Raise Ticket</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/create_ticket/<?php echo $asset->id; ?>" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="row g-2">

            <div class="col-md-4">
              <label for="exampleInputname1">Ticket Type</label>
              <select name="type" class="form-select">
                <option selected disabled>Select a Ticket Type</option>
                <?php foreach ($data['ticket_types'] as $ticket_type) { ?>
                  <option value="<?php echo $ticket_type->id; ?>"><?php echo $ticket_type->name; ?></option>
                <?php  } ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="exampleInputname1">Document Type</label>
              <select name="document_type" class="form-select">
                <option selected disabled>Select a Document Type</option>
                <?php foreach ($data['document_types'] as $document_type) { ?>
                  <option value="<?php echo $document_type->id; ?>"><?php echo $document_type->name; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-4">
              <label for="exampleInputname1">Upload Document</label>
              <input type="file" name="document" class="form-select">
            </div>

            <div class="col-md-12 mt-0 m-b-20">
              <label for="con-mail">Enter Remark</label>
              <input name="remark" class="form-control" id="con-mail" type="text" required="" autocomplete="off">
            </div>
            <div class="col-md-12 mt-0 m-b-20" style="display:none">
              <input class="form-control" id="asset_id_val" name="asset_id" type="text" autocomplete="off">
            </div>

          </div>
          <input id="index_var" type="hidden" value="5">
          <button class="btn btn-secondary">Create</button>

        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade modal-bookmark" id="reportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Incident</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/create_incident/<?php echo $asset->id; ?>" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="row g-2">

            <div class="col-md-4">
              <label for="exampleInputname1">Incident Type</label>
              <select name="type" class="form-select">
                <option selected disabled>Select an Incident Type</option>
                <?php foreach ($data['incident_types'] as $incident_type) { ?>
                  <option value="<?php echo $incident_type->id; ?>"><?php echo $incident_type->name; ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="col-md-4">
              <label for="exampleInputname1">Document Type</label>
              <select name="document_type" class="form-select">
                <option selected disabled>Select a Document Type</option>
                <?php foreach ($data['document_types'] as $document_type) { ?>
                  <option value="<?php echo $document_type->id; ?>"><?php echo $document_type->name; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-4">
              <label for="exampleInputname1">Upload Document</label>
              <input type="file" name="document" class="form-select">
            </div>

            <div class="col-md-12 mt-0 m-b-20">
              <label for="con-mail">Enter Remark</label>
              <input name="remark" class="form-control" id="con-mail" type="text" required="" autocomplete="off">
            </div>
            <div class="col-md-12 mt-0 m-b-20" style="display:none">
              <input class="form-control" id="asset_id_val" name="asset_id" type="text" autocomplete="off">
            </div>

          </div>
          <input id="index_var" type="hidden" value="5">
          <button class="btn btn-secondary">Create</button>

        </form>
      </div>
    </div>
  </div>
</div>



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
