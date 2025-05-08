<?php namespace App\Http\Controllers; 
use App\Models\Subcategory;
use App\Models\Auth;
use App\Models\Locations;
use App\Models\Category;
?>  
@include('inc.header')
 
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Asset Reports</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item "> <a  href="/reports">Reports</a></li>
                        <li class="breadcrumb-item active">Asset Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <?php
    // $url =  "{$_SERVER['REQUEST_URI']}";
    // $url = explode('/', $url);
    ?>
    <div class="container-fluid general-widget"> 
        <div class="row">


            <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                    <br>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table cell-border compact strip" data-order='[[ 0, "desc" ]]'
                                data-page-length='10'>
                                <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>User</th>
                                        <th>Location</th>
                                        <th>Entry Date</th>
                                        {{-- <th>Type of Asset</th> --}}
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Particulars of Asset</th>
                                        <th>Supplier Name</th>
                                        <th>Invoice No.</th>
                                        <th>Invoice Date</th>
                                        <th>Purchase Value</th>
                                        <th>Rate of Depn.</th>
                                        <th>Date of Disposal</th>
                                        <th>Disposal Value</th>
                                        <th>Gross Value as on 31-3-2022.</th>
                                        <th>Depreciation upto 31-3-2022</th>
                                        <th>Net Value as on 31-03-2022</th>
                                        <th>Additions During the Year</th>
                                        <th>Gross Value as on 31-3-2023.</th>
                                        <th>Depreciation for the Year</th>
                                        <th>Depreciation upto 31-03-2023</th>
                                        <th>Net Value as on 31-03-2023</th>
                                        <th>Net Loss/Profit on disposal</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    
               foreach($data['assets'] as $asset):
               $user = Auth::where('id',$asset->user_id)->first();
               $location = Locations::where('id',$user->location_id)->first();
               $subcategory = Subcategory::where('id',$asset->subcategory_id)->first();
               $category = Category::where('id',$asset->category_id)->first();

               if(($data['user_type'] == "all" || $data['user_type'] == $user->type) && ($data['location'] == "all" || $data['location'] == $user->location_id) && ($data['category'] == "all" || $data['category'] == $asset->category_id) && ($data['subcategory'] == "all" || $data['subcategory'] == $asset->subcategory_id)){
              ?>







                                    <tr>

                                        <td><?php if(isset($asset->id)){echo $asset->id;} ?></td>
                                        <td><?php if(isset($asset->name)){echo $asset->name;} ?></td>
                                        <td><?php if(isset($user->name)){echo $user->name;} ?></td>
                                        <td><?php if(isset($location->name)){echo $location->name;} ?></td>
                                        <td><?php if(isset($asset->datetime)){echo date('j-m-Y', strtotime($asset->datetime));} ?></td>
                                        {{-- <td></td> --}}
                                        <td><?php if(isset($category->name)){echo $category->name;} ?></td>
                                        <td><?php if(isset($subcategory->name)){echo $subcategory->name;} ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>


                                    </tr>

                                    <?php } endforeach; ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('inc.footer')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
