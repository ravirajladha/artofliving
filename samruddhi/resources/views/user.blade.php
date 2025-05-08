<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Subcategory;
use App\Models\Assigns;
?>
@include('inc.header')

<?php

$user = $data['user'];
?>

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">


                    <h3>
<!--
                    <a href="/users" class="icon-back-right" style="align-items: left; font-size: medium;"> Back </a> <br><br>

                         -->
                        <?php if($user->photo){
                    ?>
                        <img width="40" class="rounded-circle" src="/profiles/<?php echo $user->photo;
                        ?>" alt="">
                        <?php } else {
                        ?>
                        <img width="40" class="rounded-circle" src="/assets/user.webp" alt="">
                        <?php }
                        ?>
                        <?php if(Session::get('rexkod_apex_user_type') == 'user'){
                        ?>
                        Welcome <?php echo $user->name;
                        ?>, User
                        <?php }else{
                         echo $user->name;
                        ?>
                        <?php }
                        ?>
                    </h3>
                </div>
                <div class="col-12 col-sm-6">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/users">All Users</a></li>
                        <li class="breadcrumb-item active"><a href="#">User</a></li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 box-col-4">
                                <div class="card ecommerce-widget">
                                    <div class="card-body support-ticket-font">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="total-nuunter"><?php echo $user->email;
                                                ?><br><?php echo $user->phone; ?>
                                                <br> Employee ID : <?php echo $user->user_id; ?>
                                               
                                                </h4>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 box-col-4">
                                <div class="card ecommerce-widget">
                                    <div class="card-body support-ticket-font">
                                        <div class="row">
                                            <div class="col-5"><span>Status</span>
                                                <h3 class="total-nuunter">
                                                    <?php if($user->active_status==0){
                                                        echo 'Active';
                                                    }else{
                                                        echo 'Inactive';
                                                    }
                                                    ?>
                                                    </h3>
                                            </div>
                                            <div class="col-7">
                                                <div class="text-end">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 box-col-4"> 
                                <div class="card ecommerce-widget">
                                    <div class="card-body support-ticket-font">
                                        <div class="row">
                                            <div class="col-5"><span>Your Assets</span>
                                                <h3 class="total-num counter"><?php echo $data['assetscount'];
                                                ?></h3>
                                            </div>
                                            <div class="col-7">
                                                <div class="text-end">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive">




                            {{-- <table class="table table-striped" id="basic-1"> --}}
                                <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                                <thead>
                                    <tr>
                                        <th> <span>ID</span></th>
                                        <th> <span>Name</span></th>
                                        <th> <span>Type</span></th>
                                        <th> <span>Sub Category</span></th>
                                        <th> <span>Details</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                      foreach($data['assets'] as $asset){
                                      $subcategory = Subcategory::where('id',$asset->subcategory_id)->first();

                                      $assign = Assigns::where('asset_id',$asset->id)
                                                ->where('status','1')
                                                ->first();
                                      if($assign){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $asset->id
                                            ?>
                                        </td>
                                        <td class="img-content-box">
                                            <?php if($asset->image){
                                            ?>
                                            <img class="user-img" src="/uploads/<?php echo $asset->image;
                                            ?>" width="75"
                                                alt="" width="100">
                                            <?php } else {
                                            ?>
                                            <img class="rounded-circle" src="/assets/asset.png" alt=""
                                                width="75">
                                            <?php }
                                            ?><br>
                                            <h6><?php echo $asset->name;
                                            ?></h6>
                                        </td>
                                        <td>
                                            <h6><?php echo $asset->type;
                                            ?></h6>
                                        </td>
                                        <td>
                                            <h6><?php echo $subcategory->name;
                                            ?></h6>
                                        </td>
                                        <td>
                                            <h6><a href="/asset/<?php echo $asset->id;
                                            ?>">View</a></h6>
                                        </td>

                                    </tr>




                                    <?php }
                                        }
                                    ?>
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


{{-- =================================== import and export table data =================================== --}}
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
{{-- =================================== import and export table data =================================== --}}
