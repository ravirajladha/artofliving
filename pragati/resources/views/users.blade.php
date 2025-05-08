<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Auth;
use App\Models\User;
use App\Models\Apex_bodie;
?>
@include("inc.header")

<style>
  .swal2-popup {
  font-size: 10px !important;
  width:300px;
}
</style>

<style>


  /* Modal Content */
  .modal-content {
    position: relative;

    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
  }

  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }

  @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }

  .modal-header {
    background-color: #f8a218;
    color: white;
  }

  </style>

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>All {{$data['type']}}</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">All {{$data['type']}}</li>
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
                      <table class="table table-striped"  data-order='[[ 0, "desc" ]]' data-page-length='10'>
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>ID</th>
                            <th>Apex Body</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>

                          </tr>
                         </thead>
                          <tbody>
                          <?php foreach($data['users'] as $user){
                            if($user->status=="1"){$status="Active";} else if($user->status=="2"){$status="Inactive";} else if($user->status=="3"){$status="On Hold";} else if($user->status=="4"){$status="Retired";} else {$status="Deactive";}
                            // $apexbodies = $user->apexbody;
                            // print_r($apexbodies);
                            // $apexbodies = explode(',',$apexbodies);

                            if (!empty($user->apexbody)) {
                                $apexbodies = explode(',', $user->apexbody);
                                }else {
                                    $apexbodies = [];
                                }
                            ?>

                          <tr>

                            <td><?php if(isset($user->name)){echo $user->name;} ?></td>

                            <td><a target="_BLANK" href="/id/<?php echo $user->id; ?>"> View ID</a></td>

                            <td><?php foreach($apexbodies as $apexbody){
                                $apex =Apex_bodie::where('id',$apexbody)->first();

                                  echo $apex->name.'<br>';
                                } ?>
                            </td>

                            <td><?php if(isset($user->email)){echo $user->email;} ?></td>

                            <td><?php if(isset($user->phone)){echo $user->phone;} ?> <br> <?php if(isset($user->alternate_phone)){echo $user->alternate_phone;} ?></td>

                            <td><?php if(isset($status)){echo $status;} ?></td>

                            <td>


                              <?php if(!$user->status){ ?>
                                <span style="font-size:10px" class="pull-right"><button data-bs-toggle="modal" data-bs-target="#activate" style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-success" onclick="document.getElementById('activate_name').value = '{{$user->name}}'; document.getElementById('activate_id').value = {{$user->id}}"><i class="fa fa-check"></i></button></span>
                              <?php } else { ?>
                                <span style="font-size:10px" class="pull-right"><button data-bs-toggle="modal" data-bs-target="#deactivate" style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-danger" onclick="document.getElementById('deactivate_name').value = '{{$user->name}}'; document.getElementById('deactivate_id').value = {{$user->id}}"><i class="fa fa-times"></i></button></span>
                              <?php } ?>



                            <a href="/user/<?php echo $user->id; ?>"><span style="font-size:10px" class="pull-right"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></button></span></a>


                            <?php if($user->type == 'trustee' || $user->type == 'director'
                            || $user->type == 'coordinator'){ ?>

                              <a href="/edit_backoffice/<?php echo $user->id; ?>"><span style="font-size:10px" class="pull-right"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-info"><i class="fa fa-pencil"> </i></button></span></a>

                            <?php }
                            else{ ?>
                              <a href="/edit_frontoffice/<?php echo $user->id; ?>"><span style="font-size:10px" class="pull-right"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-info"><i class="fa fa-pencil"> </i></button></span></a>
                            <?php } ?>
                            <!-- <a href="/edit_user/<?php echo $user->id; ?>"><span style="font-size:10px" class="pull-right"><button style="font-size:12px;margin:2px; padding:2px 5px" class="btn btn-xs btn-info"><i class="fa fa-pencil"> </i></button></span></a> -->


                          </td>

                          </tr>

              <?php }  ?>

              </tbody>
              </table>

                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        @include("inc.footer")



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
        $('.table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        } );
    } );

    </script>


<!-- The Modal -->
<div class="modal" id="activate">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Activate Member</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="/activate_user" method="post">
          @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label>User Name</label>
                <input type="text" class="form-control" id="activate_name" readonly>
                 <input type="text" class="form-control" name="user_id" id="activate_id" hidden>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label>Status</label>
                <select class="form-select" name="status">
                  <option value="1">Active</option>
                  <option value="2">In Active</option>
                  <option value="3">On Hold</option>
                  <option value="4">Retired</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label>Tenure From</label>
                <input type="date" class="form-control" name="from">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label>Tenure To</label>
                <input type="date" class="form-control" name="to">
              </div>
            </div>

          </div><br>
          <button class="btn btn-success btn-sm float-right" style="float:right">Activate</button>

        </form>
      </div>


    </div>
  </div>
</div>


<div class="modal" id="deactivate">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Deactivate Member</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="/deactivate_user" method="post">
          @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label>User Name</label>
                <input type="text" class="form-control" id="deactivate_name" readonly>
                 <input type="text" name="user_id" class="form-control" id="deactivate_id" hidden>
              </div>
              <br>
            </div>
            <div class="col-md-9"> <h4 style="float:right;margin-top:6px">Are you Sure?</h4></div>
            <div class="col-md-3"><button class="btn btn-warning btn-sm float-right" style="float:right">Deactivate</button></div>


          </div>


        </form>
      </div>


    </div>
  </div>
</div>



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


<?php if(!empty(session()->get('failed'))) { ?>
  <script type="text/javascript">
  Swal.fire({
   icon: 'warning',
   title: '{{ session()->get('failed') }}',
   showConfirmButton: false,
   timer: 2000
 })
  </script>
 <?php } session()->forget('failed'); ?>
