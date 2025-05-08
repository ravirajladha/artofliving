<?php namespace App\Http\Controllers; 
use App\Models\Subcategory;
use App\Models\Auth;
use App\Models\Locations;
use App\Models\Asset_audit_master;
use App\Models\Assets;
?>   
@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
     
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Audit Reports</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item "> <a  href="/reports">Reports</a></li>
                    <li class="breadcrumb-item active">Audit Reports</li>
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
                    <table class="table cell-border compact strip"  data-order='[[ 0, "desc" ]]' data-page-length='10'>
                        <thead>
                          <tr>
                            
                            <th>ID</th>
                            <th>Asset</th>
                            <th>Sub Category</th>
                            <th>Audited By</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>Remark</th>
                            <th>Document</th>
                            <th>Date Time</th>
                            
                          </tr>
                          
                         </thead>
                          <tbody>
              <?php
               foreach($data['audits'] as $audit): 

              $audit_main = Asset_audit_master::where('id',$audit->audit_id)->first();

              $asset = Assets::where('id',$audit->asset_id)->first();

              $user = Auth::where('id',$asset->user_id)->first();

              $auditor = Auth::where('id',$audit_main->auditor_id)->first();

              $location = Locations::where('id',$audit_main->location_id)->first();

              $subcategory = Subcategory::where('id',$asset->subcategory_id)->first();

              if(($data['user_type'] == "all" || $data['user_type'] == $user->type) && ($data['location'] == "all" || $data['location'] == $user->location_id) && ($data['category'] == "all" || $data['category'] == $asset->category_id) && ($data['subcategory'] == "all" || $data['subcategory'] == $asset->subcategory_id)){
              ?>
              
                <tr>
                          <td><?php if(isset($asset->id)){echo $asset->id;} ?></td>
                           <td><?php if(isset($asset->name)){echo ucwords($asset->name);} ?></td>
                           <td><?php if(isset($subcategory->name)){echo ucwords($subcategory->name);} ?></td>
                           <td><?php if(isset($auditor->name)){echo ucwords($auditor->name);} ?></td>
                            <td><?php if(isset($location->name)){echo ucwords($location->name);} ?></td>
                           <?php $condition =  $audit->initial_condition; ?>

                          <td>  <?php if($condition=='0'){echo "Not Applicable";}elseif($condition=="1"){echo "Scrapable/rundown/writeoff";}elseif($condition=='2'){echo "Poor";}elseif($condition=='3'){echo "Ok";}elseif($condition=='4'){echo "Good";}elseif($condition=='5'){echo "New/Excellent";}?></td>
                            <td><?php if(isset($audit->notes)){echo $audit->notes;} ?></td>
                            <td><?php if($audit->audit_file){ ?><a href="/profiles/<?php echo $audit->audit_file; ?>" target="_blank"><i class="fa fa-eye"></i></a><?php }else{ ?> <i class="fa fa-eye-slash"></i> <?php } ?></td>
                            <td><?php if(isset($audit_main->created_at)){echo date('j-m-Y', strtotime($audit_main->created_at));} ?></td>
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



        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

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