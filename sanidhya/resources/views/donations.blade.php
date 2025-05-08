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
    width: 300px;
  }
</style>

<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-9">
          <div class="page-header-left">
            <h3 style="font-size:20px">All Visitors | {{$data['event']->event_name}} </h3>
          </div>
        </div>
        <div class="col-12 col-sm-3">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">
                <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Visitors</li>
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
            <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
              <thead>
                <tr>

                  <th>ID</th>
                  <th>Name</th>
                  <th>Batch</th>
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
                    <td style="max-width:10px;">
                      <h6 style="margin-left:10px"><?php check_isset($donation->id); ?></h6>
                    </td>
                    <td> <?php check_isset($donation->first_name); ?>&ensp;<?php echo check_isset($donation->last_name); ?></td>
                    <td><?php check_isset($donation->batch_name); ?> (<?php check_isset($donation->batch); ?>)</td>
                    <td><?php check_isset($donation->event_id); ?></td>
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
                    <td>
                      <div class='row'>
                        <?php if ($donation->status != '2') { ?>
                          <div class='col-md-12'><a title='Edit' style="margin-right:30px;" class="btn btn-info btn-xs" href="/edit_donation/{{$donation->id}}"><i class='fa fa-pencil'></i></a> </div>
                          <div class='col-md-12'><a title='Block' style="margin-right:30px;" class="btn btn-warning btn-xs" onclick="ban_donor({{$donation->id}});"><i class='fa fa-ban'></i></a> </div>
                          <div class='col-md-12'><a title='Delete' style="margin-right:30px;" class="btn btn-danger btn-xs" onclick="delete_donor({{$donation->id}});"><i class='fa fa-trash'></i></a></div>
                        <?php } else {
                          echo "<div style='color:red;text-align:center'>Blocked</div>";
                        } ?>
                      </div>
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
  <!-- Container-fluid Ends-->
</div>
</div>
@include("inc_sanidhya.footer")
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/datatable/datatables/datatable.custom.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session()->has('success'))
  <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: '{{ session('success') }}',
      showConfirmButton: false,
      timer: 2000
    });
  </script>
@endif



<script>
  function delete_donor(id) {
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
        window.location = "/delete_donation/" + id;
      }
    })
  }
</script>


<script>
  function ban_donor(id) {
    Swal.fire({
      title: 'Blocking - Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, block it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/block_donation/" + id;
      }
    })
  }
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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