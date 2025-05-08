<?php

namespace App\Http\Controllers;
use App\Models\Auth;
use App\Models\Assets;
?>
@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Manager Asset</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/pages/index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Manager Asset </li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">
      <?php foreach($data['user'] as $user){ ?>
              <h4> Name : <?php echo $user->name; ?>  </h4>
              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-request recent-orders">
                  <br>
                 
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    {{-- <table class="display" id="basic-1"> --}}
                        <table class="table table-bordernone" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                        <thead>
                          <tr>
                          <th>Asset ID</th>
                          <th>Asset Name</th>
                           
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          //  foreach($data['user'] as $user){ 

                        //  $user = Auth::where('id',$user->user_id)->first();

                        $asset = Assets::where('user_id',$user->id)->get();
                       
                            // if($asset->user_id == $user->id){
                        
foreach($asset as $all_asset){ ?>
                          <tr>
                          <td><?php if((isset($all_asset->id))){echo $all_asset->id;} ?></td>
                           <td><?php if(isset($all_asset->name)){echo $all_asset->name;} ?></td>
                           
                            <td>
                              <h6> 
                                <?php if(isset($all_asset->id)){ ?>
                                <a href="/asset/<?php echo $all_asset->id; ?>"><button
                                style="font-size:12px;padding:2px 5px" title="View" class="btn btn-xs btn-success">View Asset</button></a> 
                                <?php } ?>
                                
                                </h6>
                            </td>



                          </tr>
                          <?php } ?>
                        <?php
                      //  }
                      //  }
                        ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
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
