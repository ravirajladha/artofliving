@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
     
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>All Proposals</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Proposals</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <?php
          $url =  "{$_SERVER['REQUEST_URI']}";
          $url = explode('/', $url);
          ?>
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
                          <th>Event Name</th>
                            <th>State</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                            
                          </tr>
                         </thead>
                          <tbody>
                          <?php foreach($data['proposal'] as $proposal) { 
                            if($proposal->status=="1")
                            {$status="Active";}
                            else { $status="Inactive"; } ?>
                           
                          <tr>
                     
                            <td style="padding:0px 20px"><?php echo $proposal->program_name; ?></td>
                            <td><?php echo $proposal->state; ?></td>
                             <td><?php echo $proposal->location; ?></td>
                             <td><?php echo $status; ?></td>
                             <td style="padding:0px 20px"> 

                             <a href="proposal/<?php echo $proposal->id; ?>"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></button></a> 
                             <a target="_BLANK" href="/qr/vb"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-success"><i class="fa fa-globe"></i></button></a> 
                             <a href="/qr/venue"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-info"><i class="fa fa-building"></i></button></a> 
                            
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
        @include("inc_sanidhya.footer")


<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
