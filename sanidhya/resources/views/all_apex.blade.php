<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
</head>
<header>
  <style>
    .swal2-popup {
      font-size: 10px !important;
      width: 300px;
    }
  </style>
</header>
@include("inc_sanidhya.header")

<body>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3>All Apex</h3>
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
    $url =  "{$_SERVER['REQUEST_URI']}";
    $url = explode('/', $url);
    ?>
    <div class="card">
      <div class="card-body">
        <!-- Give Content That You Want -->
        <div class="container-fluid general-widget">
          <div class="row">
            <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
              <div class="card ongoing-project recent-orders">

                <div class="card-body pt-0">
                  <div class="table-responsive">
                    <table id="myTable" class="datatable table table-hover table-center mb-0">

                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Action</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data['users'] as $user) :

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
                              @if($user->status==1)
                              <div class='col-md-12'>
                                <a title='Edit' style="margin-right: 30px; pointer-events: none; color: red;" class="btn btn-info btn-xs" href="/edit_apex/{{$user->id}}">
                                  <i class='fa fa-pencil'></i>
                                </a>
                              </div>
                              @else
                              <div class='col-md-12'><a title='Edit' style="margin-right:30px;" class="btn btn-info btn-xs" href="/edit_apex/{{$user->id}}"><i class='fa fa-pencil'></i></a></div>
                              @endif
                              <div class='col-md-12'><a title='Delete' style="margin-right:30px;" class="btn btn-danger btn-xs" href="/DeleteApex/{{$user->id}}"><i class='fa fa-trash'></i></a></div>
                              @if($user->status==1)
                              <div class='col-md-12'><a title='Activate' style="margin-right:30px;" class="btn btn-danger btn-xs" href="/ActivateandDeatiaveArex/{{$user->id}}/0"><i class='fa fa-ban'></i></a></div>
                              @else
                              <div class='col-md-12'><a title='Deactivate' style="margin-right:30px;" class="btn btn-success btn-xs" href="/ActivateandDeatiaveArex/{{$user->id}}/1"><i class='fa fa-check'></i></a></div>
                              @endif

                            </td>

                          </tr>

                        <?php endforeach; ?>



                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<footer>
  @include("inc_sanidhya.footer")
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- DataTables Initialization Script -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>

<?php if (!empty(session()->get('success'))) { ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: '{{ session()->get('
      success ') }}',
      showConfirmButton: false,
      timer: 2000,
    })
  </script>
<?php }
session()->forget('success'); ?>

</html>