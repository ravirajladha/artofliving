@include("inc.header")
@php
use App\Models\Apex_bodie;

@endphp
<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Banks</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Result</li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">


              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                          <tr>

                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>IFSC Code</th>
                            <th>Customer ID</th>
                            <th>Branch Address</th>
                            <th>Apex Body</th>
                            <th>Accountant</th>

                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['banks'] as $bank){

// echo $bank->apex_body_id;
if (!empty($bank->apex_body_id)) {
    $apex_body = Apex_bodie::where('id',$bank->apex_body_id)->first();
}

                          ?>
                          <tr>

                            <td><?php echo $bank->account_name; ?></td>
                            <td><?php echo $bank->account_number; ?></td>
                            <td><?php echo $bank->ifsc_code; ?></td>
                            <td><?php echo $bank->customer_id; ?></td>
                            <td><?php echo $bank->home_branch_address; ?></td>
                            <td>
                                <?php
                                        if (!empty($bank->apex_body_id)) { echo $apex_body->name; }
                                ?>
                            </td>

                            <td><?php

                            //  echo $bank->members;
                                $user = App\Models\User::where('id',$bank->members)->first();
                                // print_r($user);
                                if(isset($user->name)){echo $user->name;}


                            ?></td>


                            <td>   <a target="_BLANK" href="/edit_bank/<?php echo $bank->id; ?>"><span style="font-size:10px" class="pull-right"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></button></span></a></td>
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

<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatables/datatable.custom.js"></script>
