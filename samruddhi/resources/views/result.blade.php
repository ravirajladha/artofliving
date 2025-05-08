@include('inc.header')
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
                    <li class="breadcrumb-item"><a href="/pages/index">                                      
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
                            <th>State Apexbody</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                         <?php foreach($data['results'] as $user){
                          if($curuser->status=="1"){$status="Active";}else if($curuser->status=="2"){$status="Inactive";} else {$status="On Hold";} 
                          $curuser = $pageMod->get_user_main($user->user_id);


                          if($data['user_type'] == "trustee" ){
                            
                            $states = $user->trustee_states;
                            $states=explode(',', $states);

                            if(($data['state'] == "all" && $curuser->type=="trustee") OR (in_array($data['state'],$states) && $curuser->type=="trustee")){ ?> 

                          <tr>
                            
                            <td><?php echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php  echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                              <?php 
                              $count = 0;
                              foreach($states as $state){
                                if($count){
                                  echo " , ";
                                }
                                $state_val = $pageMod->get_state($state);
                                echo $state_val->name;
                                $count ++;
                              }
                              ?>
                            
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>

                          <?php }} 
                          else if($data['user_type'] == "apex" ){
                            
                             $states = $user->apex_states;
                             $states=explode(',', $states);

                            if(($data['state'] == "all" && $curuser->type=="apex") OR (in_array($data['state'],$states) && $curuser->type=="apex")){?>

                            <tr>
                            
                            <td><?php echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                              <?php 
                               $count = 0;
                               foreach($states as $state){
                                 if($count){
                                   echo " , ";
                                 }
                                 $state_val = $pageMod->get_state($state);
                                 echo $state_val->name;
                                 $count ++;
                               }
                              ?>
                            
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php  echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>
                              
                            <?php }} else if($data['user_type'] == "ddc" ){
                            if(($data['apex_body'] == "all" && $curuser->type=="ddc") OR ($user->apex_body_id == $data['apex_body'] && $curuser->type=="ddc")){ ?>

                            <tr>
                            
                            <td><?php echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                              <?php 
                               $apex_body = $pageMod->get_apex_body($user->apex_body_id);
                               echo $apex_body->name;
                              ?>
                            
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>

                          <?php }} else if($data['user_type'] == "tdc" ){
                            if(($data['apex_body'] == "all" && $curuser->type=="tdc") OR ($user->apex_body_id == $data['apex_body'] && $curuser->type=="tdc")){ ?>

                            <tr>
                            
                            <td><?php echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                              <?php 
                               $apex_body = $pageMod->get_apex_body($user->apex_body_id);
                               echo $apex_body->name;
                              ?>
                            
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>

                          <?php }} else if($data['user_type'] == "vdc" ){
                            if(($data['apex_body'] == "all" && $curuser->type=="vdc") OR ($user->apex_body_id == $data['apex_body'] && $curuser->type=="vdc")){ ?>

                            <tr>
                            
                            <td><?php  echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                              <?php 
                               $apex_body = $pageMod->get_apex_body($user->apex_body_id);
                               echo $apex_body->name;
                              ?>
                            
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>

                          <?php }} else if($data['user_type'] == "accountant" ){
                            if(($data['apex_body'] == "all" && $curuser->type=="accountant") OR ($user->apex_body_id == $data['apex_body'] && $curuser->type=="accountant")){ ?>

                            <tr>
                            
                            <td><?php echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                              <?php 
                               $apex_body = $pageMod->get_apex_body($user->apex_body_id);
                               echo $apex_body->name;
                              ?>
                            
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>


                           <?php }} else if($data['user_type'] == "administrator" ){
                            if(($data['apex_body'] == "all" && $curuser->type=="administrator") OR ($user->apex_body_id == $data['apex_body'] && $curuser->type=="administrator")){ ?>

                            <tr>
                            
                            <td><?php echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                              <?php 
                               $apex_body = $pageMod->get_apex_body($user->apex_body_id);
                               echo $apex_body->name;
                              ?>
                            
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>

                         
                           <?php }} else if($data['user_type'] == "director"){
                            if($curuser->type=="director"){ ?>

                          <tr>
                            
                            <td><?php echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php  echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                          
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>

                          <?php }} else if($data['user_type'] == "coordinator"){
                            if($curuser->type=="coordinator"){ ?>

                          <tr>
                            
                            <td><?php  echo $curuser->name; ?></td>
                            <td><a target="_BLANK" href="/pages/user/<?php  echo $curuser->id; ?>"> View Profile</a></td>
                            <td><a target="_BLANK" href="/pages/id/<?php echo $curuser->id; ?>"> View ID</a></td>
                            <td><?php echo $curuser->type; ?></td>
                            <td>
                          
                            </td>
                            <td><?php echo $curuser->email; ?></td>
                            <td><?php echo $curuser->phone; ?></td>
                            <td><?php echo $status; ?></td>
                            
                          </tr>

                           <?php }} ?>

                        
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
  

        @include('inc.footer')


<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>