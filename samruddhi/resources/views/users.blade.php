<?php namespace App\Http\Controllers; 
use Illuminate\Support\Facades\DB;
use App\Models\Auth;
?>
@include('inc.header')
<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges);  ?>

<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>All Users</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/index"><i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="/users"> All Users</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    <?php
    $url = "{$_SERVER['REQUEST_URI']}";
    $url = explode('/', $url);
    ?>

    <div class="container-fluid card">


        <br>
        <div class="row card-body">
            <div class="table-responsive">
                <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Manager Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <?php if(in_array(2, $user_priviliges) || in_array(3, $user_priviliges)) {?>

                            <th>Action</th>
                            <?php } ?>
                            <?php if(in_array(2, $user_priviliges) || in_array(3, $user_priviliges)) {?>

                            <th>Active Status</th>
                            <?php } ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($data['users'] as $user):
                            if($user->status=="1"){$status="Active";}else if($user->status=="2"){$status="Inactive";} else {$status="On Hold";}
                            ?>

                        <tr>
                            <td><?php echo $user->id; ?></td>
                            <td><?php if($user->photo){ ?>
                                <img width="20" class="rounded-circle"
                                    src="/profiles/<?php echo $user->photo; ?>" alt="">
                                <?php } else { ?>
                                <img width="20" class="rounded-circle" src="/assets/user.webp" alt="">
                                <?php } ?>
                                <?php echo $user->name; ?>
                            </td>
                            <td>
                                <?php  if(isset($user->manager_id)){
                                    $m = Auth::where('id',$user->manager_id)->first();

                                    if(isset($m->name)){
                                    echo $m->name;
                                    }
                                    
                                    } 
                                    
                                    
                                    ?>
                            </td>
                            <td><?php if($user->type=='itadmin'){
                                        echo 'IT Admin';
                                    } elseif($user->type=='admin'){
                                        echo 'Admin';
                                    }
                                    elseif($user->type=='owner'){
                                        echo 'Stock Owner';
                                    }
                                    elseif($user->type=='apex'){
                                        echo 'Apex Admin';
                                    }
                                    elseif($user->type=='auditor'){
                                        echo 'Auditor';
                                    }
                                    elseif($user->type=='manager'){
                                        echo 'Manager';
                                    }
                                    elseif($user->type=='employee'){
                                        echo 'User/Employee';
                                    }
                                    else{
                                        echo 'Teacher/Project Guide';
                                    }
                                    ?>
                            </td>

                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->phone; ?></td>
                            <?php if(in_array(2, $user_priviliges) || in_array(3, $user_priviliges)) {?>

                            <td>

                            <?php if(in_array(2, $user_priviliges)){?>

                                <a href="/user/<?php echo $user->id; ?>">
                                    <button title="View" style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-success">
                                        <i class='fa fa-eye'></i>
                                    </button>
                                </a>
                            <?php } ?>

                            <?php if(in_array(3, $user_priviliges)){?>

                                <a href="/edit_user/<?php echo $user->id; ?>">
                                    <span style="font-size:10px">

                                        <button title="Edit" style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-info"><i
                                                class='fa fa-pencil'></i></button>
                                    </span>
                                </a>

                               
                            <?php } ?>

                          



                            </td>
                            <?php } ?>

                            <?php if(in_array(3, $user_priviliges)){?>
                            <td>
                                <?php if ($user->active_status == 0) { ?>
                                <a href="/change_status/<?php echo $user->id; ?>/1">
                                    <span style="font-size:10px" >

                                        <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-warning">Deactivate</button>
                                    </span>
                                </a>
                                <?php } else { ?>
                                <a href="/change_status/<?php echo $user->id; ?>/0">
                                    <span style="font-size:10px" >

                                        <button style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-warning">Activate</button>
                                    </span>
                                </a>
                                <?php } ?>

                            

                            </td> 
                            <?php } ?>
                            


                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- Container-fluid Ends-->
</div>






@include('inc.footer')

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

