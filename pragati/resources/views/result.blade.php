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
                  <h3>Report</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Results</li>

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

                          <th>User Name</th>
                          <th>Profile</th>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>


                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['results'] as $user){
                           $curuser = User::where('id', $user->id)->first();

                          if(isset($curuser->status)){
                            if($curuser->status=="1"){$status="Active";}else if($curuser->status=="2"){$status="Inactive";} else {$status="On Hold";}
                          }



                          if($data['user_type'] == "trustee" ){
                            // echo "hi";
                            $states = $user->apex_states;
                            $states=explode(',', $states);
                            // if(($data['state'] == "all" && $curuser->type=="apex") OR (in_array($data['state'],$states) && $curuser->type=="apex")){


                            if(isset($curuser->type) && ($curuser->type=="trustee")){
                              // echo "hi";
                              ?>

                          <tr>

                            <td><?php  if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>">  View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>

                          <?php
                                  }
                             // }
                          } else if($data['user_type'] == "apex" ){

                            $states = $user->apex_states;
                            $states=explode(',', $states);

                            if(isset($curuser->type) && ($curuser->type=="apex")){?>

                            <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;} ?></td>

                          </tr>

                            <?php }} else if($data['user_type'] == "ddc" ){
                            if(isset($curuser->type) && ($curuser->type=="ddc")){ ?>

                            <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>

                          <?php }} else if($data['user_type'] == "tdc" ){
                            if(isset($curuser->type) && ($curuser->type=="tdc")){ ?>

                            <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>

                          <?php }} else if($data['user_type'] == "vdc" ){
                            if(isset($curuser->type) && ($curuser->type=="vdc")){ ?>

                            <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>

                          <?php }} else if($data['user_type'] == "accountant" ){
                            if(isset($curuser->type) && ($curuser->type=="accountant")){ ?>

                            <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>


                          <?php }
                          } else if($data['user_type'] == "administrator" ){
                            if(isset($curuser->type) && ($curuser->type=="administrator")){ ?>

                            <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>


                           <?php }
                           } else if($data['user_type'] == "director"){
                            if( isset($curuser->type) && ($curuser->type=="director")){ ?>

                          <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>

                          <?php }
                          }
                          else if($data['user_type'] == "coordinator"){
                            if(isset($curuser->type) && ($curuser->type=="coordinator")){ ?>

                          <tr>

                            <td><?php if(isset($curuser->name)){ echo $curuser->name;} ?></td>
                            <td><a target="_BLANK" href="/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php if(isset($curuser->type)){ echo $curuser->type;} ?></td>

                            <td><?php if(isset($curuser->email)){ echo $curuser->email;} ?></td>
                            <td><?php if(isset($curuser->phone)){ echo $curuser->phone;} ?></td>
                            <td><?php if(isset($status)){echo $status;}  ?></td>

                          </tr>

                           <?php }
                          } ?>


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
