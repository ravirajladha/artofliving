@include("inc_sanidhya.header")

<style>
  .swal2-popup {
    font-size: 10px !important;
    width: 300px;
  }
</style>

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>All Volunteers</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <?php

use App\Models\User;

  $url =  "{$_SERVER['REQUEST_URI']}";
  $url = explode('/', $url);
  ?>
  <div class="container-fluid card">
    <div class="row card-body">


      <table class="display table table-bordernone" id="basic-1">
        <thead>
          <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created by</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['users'] as $user) :
            if ($user->status == "1") {
              $status = "Active";
            } else if ($user->status == "2") {
              $status = "Inactive";
            } else {
              $status = "On Hold";
            }
            //$event = $pageMod->event($user->event_id);
            $event = App\Models\Events::where('id', $user->event_id)->first();
          ?>

            <tr>
              <td><?php echo $user->id; ?></td>
              <td>
                <img width="20" class="rounded-circle" src="/assets/user.webp" alt="">
                <?php echo $user->name; ?>
              </td>
              <td><?php echo $user->email; ?></td>
              <td><?php echo $user->phone; ?></td>
              <td>
              <?php
                      $find = User::where('id', $user->apex)->first();
                      
                      if ($find) {
                          echo $find->name;
                      } else {
                          echo "User not found";
                      }
                      ?>
        

              </td>
           <td >
      
           @if($user->status==1)
              <a href="edit_volunteers/{{$user->id}}" style="pointer-events: none; color: red;"><button title="Edit" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px; " class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a>
              @else
              <a href="edit_volunteers/{{$user->id}}"><button title="Edit" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></a>

              @endif
              <a href="delete_Volunteers/{{$user->id}}"><button title="Delete" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
                           @if($user->status==1)
                             <a title='Activate' style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-danger btn-xs" href="/ActivateandDeatiaveVol/{{$user->id}}/0"><i class='fa fa-ban'></i></a>
                              @else
                              <a title='Deactivate' style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-success btn-xs" href="/ActivateandDeatiaveVol/{{$user->id}}/1"><i class='fa fa-check'></i></a>
                            @endif
              </td>
             
            </tr>

          <?php endforeach; ?>



        </tbody>
      </table>





    </div>
  </div>
</div>
@include("inc_sanidhya.footer")



<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (!empty(session()->get('success'))) { ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: '<?php echo session()->get('success'); ?>',
      showConfirmButton: false,
      timer: 2000
    });
  </script>
<?php } ?>

<?php if (!empty(session()->get('error'))) { ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      title: '<?php echo session()->get('error'); ?>',
      showConfirmButton: false,
      timer: 2000
    });
  </script>
<?php } ?>

session()->forget('success'); ?>