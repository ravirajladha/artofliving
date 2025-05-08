<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Document;
use Storage;
?>
@include("inc.header")
<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Requests</h3>
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
                <div class="card ongoing-request recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>Request ID</th>
                            <th>Requested By</th>
                            <th>Document Type</th>
                            <th>Request Remark</th>
                            <th>Document</th>
                            <th>Status</th>
                            <th style="min-width:75px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['requests'] as $request){
                          $status = $request->status;

                          if($status == "0"){
                            $stat = "Requested";
                          } else if($status == "1"){
                            $stat = "Processed by Coordinator";
                          } else if($status == "2"){
                            $stat = "Not Processed by Coordinator";
                          } else if($status == "3"){
                            $stat = "Processed by Director";
                          } else if($status == "4"){
                            $stat = "Not Processed by Director";
                          } else if($status == "5"){
                            $stat = "Assigned to Trust Office";
                          } else if($status == "6"){
                            $stat = "Processed by Trust Office";
                          } else if($status == "7"){
                            $stat = "Not Processed by Trust Office";
                          } else if($status == "8"){
                            $stat = "Assigned to Trustee";
                          } else if($status == "9"){
                            $stat = "Processed by Trustee";
                          } else if($status == "10"){
                            $stat = "Not Processed by Trustee";
                          }

                          $user= User::where('id',$request->request_user_id)->first();

                          $document = Document::where('id',$request->document_type)->first();

                          ?>
                          <tr>
                            <td><?php echo $request->id; ?></td>
                            <td><?php if(isset($user->name)){echo $user->name;}  ?></td>
                            <td><?php if(isset($document->name)){echo $document->name;} ?></td>
                            <td><?php if(isset($request->request_remark)){ echo $request->request_remark;} ?></td>
                            <td><?php
                            if($request->document){
                              ?>

                              <!-- <a href="{{asset('storage/' .  $request->document)}}" ><i class='fa fa-pencil'></i></a>  -->
                              <a target="_blank" href="/profiles/<?php echo $request->document ?>" >
                              <i class='fa fa-pencil'></i>
                              </a>


                           <?php
                            } else {echo "Pending"; }
                             ?>
                             </td>


                            <td><?php echo $stat; ?></td>

                            <td>
                            <?php
                            // if(Session::get('rexkod_apex_user_type') == "trustee"){
                            //   if(Session::get('rexkod_apex_user_id') == $request->trustee_id){
                            ?>
                              <a href="/request/<?php echo $request->id; ?>">View Details</a>
                            <?php //} } else { ?>
                              {{-- <a href="/request/<?php //echo $request->id; ?>">View Details</a> --}}
                            <?php //} ?>
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
          <!-- Container-fluid Ends-->
        </div>


@include("inc.footer")

<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatables/datatable.custom.js"></script>
