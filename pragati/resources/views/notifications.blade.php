<?php namespace App\Http\Controllers;
use App\Models\User;
?>
@include("inc.header")
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
                    <li class="breadcrumb-item"><a href="index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Notifications</li>

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
                    <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>From</th>
                            <th>Notification</th>
                            <th>Datetime</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data['notifications'] as $notification){

                          $user= User::where('id',$notification->from_id)->first(); ?>
                          <tr>
                          <td><?php echo $notification->id; ?></td>
                           <td><?php echo $user->name; ?></td>
                            <td><?php echo $notification->notification; ?></td>
                            <td><?php echo date('M jS Y - h:m A', strtotime($notification->datetime)); ?></td>



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
          <!-- Container-fluid Ends-->
        </div>

        @include("inc.footer")

<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
