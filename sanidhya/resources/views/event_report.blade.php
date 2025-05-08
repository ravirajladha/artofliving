@include("inc_sanidhya.header")
<?php use App\Models\Donation; ?>
<?php use App\Models\Checkin; ?>
<?php use App\Models\User; ?>
<style>
    .ongoing-project.recent-orders table tr th, .ongoing-project.recent-orders table tr td{
            text-align: center;
        }

</style>

<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-9">
          <div class="page-header-left">
            <h3 style="font-size:20px">Event Report | {{$data['event']->event_name}} </h3>
          </div>
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
    
 
 <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped"  data-order='[[ 0, "asc" ]]' data-page-length='10'>
                            <thead>
                                <tr>
                                  <th>UID</th>
                                  <th>First Name</th>
                                   <th>Last Name</th>
                                  <th>Phone Number</th>
                                  <th>Email ID</th>
                                  <th>Category</th>
                                  <th>Seat Number</th>
                                  <?php if($data['event']->session1){ ?>
                                  <th>First Check In</th>
                                  <th>Scanned By</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <?php } if($data['event']->session2){ ?>
                                  <th>Second Check In</th>
                                  <th>Scanned By</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <?php } if($data['event']->session3){ ?>
                                  <th>Third Check In</th>
                                  <th>Scanned By</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <?php } ?>
                                  <th>Scan Count</th>
                                  <th>Check Out</th>
                                </tr>
                               </thead>
                                <tbody>
                               
                                <?php 
                             

                                    foreach($data['passes'] as $pass){
                                    $donation = Donation::where('id',$pass->donation_id)->first();
                                    $checkins = Checkin::where('pass_id',$pass->id)->get();
                                    $checkinsss = Checkin::where('pass_id',$pass->id)->first();
                                   
                                    $checkin_count = count($checkins);
                                    if($checkin_count >= 1){
                                        $checkin1 = "Yes";
                                    } else { $checkin1 = "No"; }

                                    if($checkin_count >= 2){
                                        $checkin2 = "Yes";
                                    } else { $checkin2 = "No"; }

                                    if($checkin_count >= 3){
                                        $checkin3 = "Yes";
                                    } else { $checkin3 = "No"; }
                                   
                                ?>
                                <tr>
                                    
                                    <td>{{$pass->id}}</td>
                                     <td>{{$donation->first_name}}</td>
                                    <td>{{$donation->last_name}}</td>
                                    <td>{{$donation->phone}}</td>
                                    <td>{{$donation->email}}</td>
                                    <td>{{$donation->category}}</td>
                                    <td>{{$donation->seat_number}}</td>

                                    <?php $count = 0; foreach($checkins as $checkin) { $count++; ?>
                                    <th>Yes</th>
                                    <th><?php  $scanner = User::where("id",$checkin->scanned_by)->first(); echo $scanner->name; ?></th>
                                    <th>{{date('d/m/Y', strtotime($checkin->created_at))}}</th>
                                    <th>{{date('h:i:s A', strtotime($checkin->created_at))}}</th>
                                    <?php if($count == '2'){break;}} ?>
                                    <?php if($count == 0){ ?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
                                    <?php if($count == 1){ ?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$checkin_count}}</td>
                                 
                                    @if($pass->status==1)
                                    <td>NO</td>
                                    @elseif($pass->status==2)
                                    <td>Yes</td>
                                    @endif
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