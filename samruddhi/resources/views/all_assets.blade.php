<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Assigns;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Auth;
?>
@include('inc.header')

<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges); 
$asset= $data['assets'] ;
// print_r($asset);
?>


<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Assets</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/">All Assets</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts         -->
    <div class="container-fluid card">
        <div class="row card-body">

            <div class="col-xl-12 xl-100 box-col-7">
                <div class="row">

                    {{-- <table class="table table-striped" id="basic-1"> --}}
                        <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                            <tr>
                                <th> <span>ID</span></th>
                                <th> <span>Name</span></th>
                                <th> <span>Type</span></th>
                                <th> <span>Category</span></th>
                                <th> <span>Sub Category</span></th>
                                <th> <span>Owner</span></th>
                                <th> <span>Status</span></th>
                                <th> <span>Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                foreach($data['assets'] as $asset){
                   $asset_id= $asset->id;



                //  $assign = Assigns::where('asset_id', $asset->id)
                //  ->whereIn('status', ['0', '1', '2'])
                //  ->first();

                //  $assign = DB::table('assigns')
                // ->select('*')
                // ->where('asset_id', '=', $asset->id)
                // ->limit(1)
                // ->get();

                 $assign = Assigns::where('asset_id', $asset_id)
                //  ->whereIn('status', ['0', '1', '2'])
                //  ->latest()
                    ->first();
                    // echo $assign->status;
                //  $latestAssign = Assigns::where('asset_id', $asset->id)
                //  ->latest('custom_timestamp_column')
                //  ->first();

                $assign =  Assigns::where('asset_id', $asset_id)->orderBy('id', 'desc')->first();
                



                 $subcategory = Subcategory::where('id',$asset->subcategory_id)->first();
                 $category = Category::where('id',$subcategory->category_id)->first();


                 if(Session('rexkod_apex_user_type') == "itadmin" || Session('rexkod_apex_user_type') == "admin" || $asset->owner_id == Session('rexkod_apex_user_id')){
                ?>


                            <tr>
                                <td>
                                    <?php echo $asset->code."".$asset->id; 
                                    // print_r($assign);
                                    // echo $asset_id;
                                    // echo $assign->status;
                                    ?>
                                </td>
                                <td class="img-content-box">

                                    <h6><?php echo $asset->name; ?></h6>
                                </td>
                                <td>
                                    <h6><?php 
                                        if($asset->type==1){
                                            echo 'Movable';
                                        }
                                        else{
                                            echo 'Immovable';
                                        }
                                        
                                        ?></h6>
                                </td>
                                <td>
                                    <h6><?php echo $category->name; ?></h6>
                                </td>
                                <td>
                                    <h6><?php echo $subcategory->name; ?></h6>
                                </td>
                                <td>
                                    <h6><?php $owner= Auth::where('id',$asset->owner_id)->first();
                                        if(isset($owner->name)){echo $owner->name;} ?></h6>
                                </td>
                                <td>
                                    <?php if($asset->type == "1"){ ?>
                                    <?php if($assign){

                                    if(isset($assign->status)){
                                        
                                        if(($assign->status == "1" && ($assign->user_id!= $asset->owner_id) )){
                                            ?>
                                            <h6 class="font-roboto"><button class="btn btn-xs btn-success"
                                                    style="padding:2px;font-size:11px">Assigned</button></h6>
                                   <?php } else if($assign->status == "0" || $assign->status == "2"){ ?>
                                    <h6 class="font-roboto"><button class="btn btn-xs btn-info"
                                            style="padding:2px;font-size:11px">Pending</button></h6>
                                    <?php } else { ?>
                                    <h6 class="font-roboto"><button class="btn btn-xs btn-primary"
                                            data-bs-toggle="modal" onclick="assign_asset(<?php echo $asset->id; ?>)"
                                            data-bs-target="#exampleModal" style="padding:2px;font-size:11px">
                                            <?php 
                                            //if(isset($assign->user_id)){echo $asset->owner_id;} 
                                            ?>
                                             Assign
                                            Asset</button></h6> 
                                            
                                    <?php } } } else { ?>
                                    <h6 class="font-roboto"><button class="btn btn-xs btn-primary"
                                            data-bs-toggle="modal" onclick="assign_asset(<?php echo $asset->id; ?>)"
                                            data-bs-target="#exampleModal" style="padding:2px;font-size:11px"><?php if(isset($assign->status)){echo $assign->status;} ?> Assign
                                            Asset</button></h6> 
                                    <?php }} else { ?>
                                    <h6 class="font-roboto"><button class="btn btn-xs btn-danger"
                                            style="padding:2px;font-size:11px">Immovable Asset</button></h6>
                                    <?php } ?>
                                </td>
                                <td>
                            <?php if(in_array(9, $user_priviliges)) {?>

                                    <h6> <a href="/asset/<?php echo $asset->id; ?>"><button
                                                style="font-size:12px;padding:2px 5px" title="View" class="btn btn-xs btn-success"><i
                                                    class='fa fa-eye'></i></button></a>
                            <?php } ?>


                            <?php if(in_array(10, $user_priviliges)) {?>

                                        <a href="/edit_asset/<?php echo $asset->type; ?>/<?php echo $asset->id; ?>"><button
                                                style="font-size:12px;padding:2px 5px" title="Edit" class="btn btn-xs btn-info"><i
                                                    class='fa fa-pencil'></i></button></a>
                            <?php } ?>

                                    </h6>
                                </td>

                            </tr>




                            <?php 
                            }
                         }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@include('inc.footer')



<script>
$('input[type="checkbox"]').on('change', function() {
    $('input[type="checkbox"]').not(this).prop('checked', false);
});
</script>










<div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Asset</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/assign_asset" method="POST">
                    @csrf
                    <div class="row g-2">

                        <div class="col-md-12">
                            <label for="exampleInputname1">Select User</label>
                            <select name="user_id" class="form-select">
                                <?php foreach($data['users'] as $user){
                                    if($user->active_status==0){
                                    ?>
                                <option value="<?php echo $user->id;?>"><?php echo $user->name; ?></option>
                                <?php } } ?>
                            </select>
                        </div>

                    </div>

                    <div class="col-md-12 mt-0 m-b-20">
                        <label for="con-mail">Enter Remark</label>
                        <input name="remark" class="form-control" id="con-mail" type="text" required=""
                            autocomplete="off">
                    </div>
                    <div class="col-md-12 mt-0 m-b-20" style="display:none">
                        <label for="con-mail">Asset ID</label>
                        <input class="form-control" id="asset_id_val" name="asset_id" type="text" autocomplete="off">
                    </div>

            </div>
            <input id="index_var" type="hidden" value="5">
            <button class="btn btn-secondary">Assign</button>

            </form>
        </div>
    </div>
</div>
</div>



<script>
function assign_asset(id) {

    $('#asset_id_val').val(id);
}
</script>



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
