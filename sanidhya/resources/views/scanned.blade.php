@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="page-header-left">
            <h3></h3>
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">
                <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Passes</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row Assetdetails">

    <div class="container-fluid card">
            <div class="row card-body">
       <table class="display table table-bordernone" id="basic-1">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Seat</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['passes'] as $pass) { 
                          $donation = App\Models\Donation::where('id',$pass->donation_id)->first();
                         ?>
                          <tr>
                            <td><?php echo $pass->id; ?></td>
                            <td><?php echo $donation->first_name." ".$donation->last_name; ?></td>
                            <td><?php echo $donation->category; ?></td>
                            <td><?php echo $donation->seat_number; ?></td>
                            <td><?php 
                            if($pass->status == 2){
                              echo "Checked Out";
                            } else if($pass->status == 1){
                              echo "Checked In";
                            } else {echo "Unused";} 
                            ?></td>
                            
                          </tr>
                        <?php } ?>
                         
                        </tbody>
                      </table>
    </div></div>


      </div>

     

    <!-- <div class="html-content">
      <div class="row Assetmore html-content">
        <div class="col-md-3 col-sm-3">
          <div class="card">
            <div class=" card-header-border">
            </div>
            <div class="collapse show" id="collapseicon12" aria-labelledby="collapseicon12" data-parent="#accordion">
              <div class=" social-status filter-cards-view row">
                <div class="media col-md-12">
                  <div class="media-body">
                    <p> <img src="<?php echo 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . '2' ?>" width="100%" class="mr-4" />
                    </p>
                    <p style="text-align:center;"><a href="#"><span class="f-w-600 ">Name</span></a>: <span class="f-w-600 ">dddd</span></p>
                    <p style="text-align:center;"><a href="#"><span class="f-w-600 ">Name</span></a>: <span class="f-w-600 ">date_add</span></p>
                    <p style="text-align:center;"><a href="#"><span class="f-w-600 ">Name</span></a>: <span class="f-w-600 ">dfdf</span></p>
                    <p style="text-align:center;"><a href="#"><span class="f-w-600 ">Name</span></a>: <span class="f-w-600 ">ddd</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    


  </div>
  <!-- Container-fluid Ends-->
</div>
</div>
@include("inc_sanidhya.footer")


<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatables/datatable.custom.js"></script>