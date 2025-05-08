@include("inc_sanidhya.header")

<style>
  .table-wrapper {
    overflow-x: visible;
    overflow-y: hidden;
  }
</style>
<style>
  .swal2-popup {
  font-size: 10px !important;
  width:300px;
}
</style>
<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="page-header-left">
            <h3>All Donations</h3>
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">
                <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Donations</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row Assetdetails">
      <div class="col-xl-2 col-sm-6">
      </div>
      
    </div>
    <?php
    function check_isset($var)
    {
      if (!isset($var) || empty($var)) {
        echo "N/A";
      } else {
        echo $var;
      }
    }
    ?>
 
 <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="display table-wrapper" id="basic-1">
            <thead>
              <tr>
                
                <th>Name</th>
                <th>Event ID</th>
                <th>Type</th>
                <th>Multiples</th>
                <th>Amount</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Email Id</th>
                <th>PAN</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>City</th>
                <th>State</th>
                <th>Company Phone</th>
                <th>Company Email</th>
                <th> Company Pan</th>
                <th> Company Address</th>
                <th> Company Pincode</th>
                <th> Company City</th>
                <th> Category</th>
                <th> Seat</th>
                <th> Created At </th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data['all_donations'] as $donation) { ?>
                <tr>
                 
                  <td><?php check_isset($donation->first_name); ?>&ensp;<?php echo check_isset($donation->last_name); ?></td>
                  <td><?php check_isset($donation->id); ?></td>
                  <td><?php check_isset($donation->type); ?></td>
                  <td><?php check_isset($donation->multiples); ?></td>
                  <td><?php check_isset($donation->amount); ?></td>
                  <td><?php check_isset($donation->phone); ?></td>
                  <td><?php check_isset($donation->gender); ?></td>
                  <td><?php check_isset($donation->email); ?></td>
                  <td><?php check_isset($donation->pan); ?></td>
                  <td><?php check_isset($donation->address); ?></td>
                  <td><?php check_isset($donation->pincode); ?></td>
                  <td><?php check_isset($donation->city); ?></td>
                  <td><?php check_isset($donation->state); ?></td>
                  <td><?php check_isset($donation->company_phone); ?></td>
                  <td><?php check_isset($donation->company_email); ?></td>
                  <td><?php check_isset($donation->company_pan); ?></td>
                  <td><?php check_isset($donation->company_address); ?></td>
                  <td><?php check_isset($donation->company_pincode); ?></td>
                  <td><?php check_isset($donation->company_city); ?></td>
                  <td><?php check_isset($donation->category); ?></td>
                  <td><?php check_isset($donation->seat_number); ?></td>
                  <td><?php check_isset($donation->created_at); ?></td>
                  <td><center><a href="/edit_donation/{{$donation->id}}"><i class='fa fa-pencil'></i></a> <a style="margin-left:10px; color:red;" onclick="delete_donor({{$donation->id}});"><i class='fa fa-trash'></i></a></center></td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
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


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(!empty(session()->get('success'))) { ?>
 <script type="text/javascript">
 Swal.fire({
  icon: 'success',
  title: '{{ session()->get('success') }}',
  showConfirmButton: false,
  timer: 2000,
  
})
 </script>
<?php } session()->forget('success'); ?>


<script>
  function delete_donor(id){
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "/delete_donation/"+id;
    }
  })
  }
</script>