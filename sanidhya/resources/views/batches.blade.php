@include("inc_sanidhya.header")
<?php use App\Models\Events; ?>
<?php use App\Models\Passe; ?>
<?php use App\Models\Donation; ?>
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
     
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>All Batches</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Batches</li>
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
                
              <style>
                table {
                    table-layout:fixed;
                }
                td{
                    overflow:hidden;
                    text-overflow: ellipsis;
                }
                </style>
              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Batch</th>
                             <th>Event Name</th>
                            <th>Total</th>
                            <th>Date & Time</th>
                            <th>Whatsapp</th>
                            <th>Mail</th>
                            <th>SMS</th>
                            <th>Action</th>
                            
                            
                          </tr>
                         </thead>
                          <tbody>
                          <?php foreach($data['batches'] as $batch) { 
                            $cur_batch = Donation::where("batch",$batch->id)->first();
                            if(isset($cur_batch->batch_name)){
                              $batch_name = $cur_batch->batch_name;
                            } else {
                              $batch_name = "Batch";
                            }
                            $event = Events::where("id",$batch->event_id)->first();
                            $pass_total = 0;
                            $whatsapp_total = 0;
                            $mail_total = 0;
                            $sms_total = 0;
                            $passes = Passe::where("batch_id",$batch->id)->get();
                            $whatsapp = Passe::where("batch_id",$batch->id)->where("whatsapp",1)->get();
                            $mail = Passe::where("batch_id",$batch->id)->where("email",1)->get();
                            $sms = Passe::where("batch_id",$batch->id)->where("sms",1)->get();

                            if(isset($passes)){
                              $passes_total = count($passes);
                            }
                            
                            if(isset($whatsapp)){
                              $whatsapp_total = count($whatsapp);
                            }

                            if(isset($mail)){
                              $mail_total = count($mail);
                            }

                            if(isset($sms)){
                              $sms_total = count($sms);
                            }
                          ?>
                           
                          <tr>
                            <td><center>{{$batch->id}}</center></td>
                            <td><center>{{$batch_name}} ({{$batch->id}})</center></td>
                            <td><?php echo $event->event_name; ?></td>
                            <td>{{$passes_total}}</td>
                            <td><?php echo date('M jS Y, h:m A', strtotime($batch->created_at)); ?></td>

                             <td><center><?php if($batch->whatsapp){ echo "<i class='fa fa-check btn btn-success btn-xs'></i>"; } else { echo "<i class='fa fa-times btn btn-warning btn-xs'></i>"; } ?><br>({{$whatsapp_total}}/{{$passes_total}})</td>

                             <td><center><?php if($batch->mail){ echo "<i class='fa fa-check btn btn-success btn-xs'></i>"; } else { echo "<i class='fa fa-times btn btn-warning btn-xs'></i>"; } ?><br>({{$mail_total}}/{{$passes_total}})</td>

                              <td><center><?php if($batch->sms){ echo "<i class='fa fa-check btn btn-success btn-xs'></i>"; } else { echo "<i class='fa fa-times btn btn-warning btn-xs'></i>"; } ?><br>({{$sms_total}}/{{$passes_total}})</td>



                             <td style="padding:0 20px">
                            

                              <a class="btn btn-danger btn-xs" onclick="delete_batch({{$batch->id}});"><i class='fa fa-trash'></i></a>
                        
                             
                            </td>
                         
                          </tr>
                          <?php } ?>
                         
              </tbody>
              </table>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
        </div>
        @include("inc_sanidhya.footer")


<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>


    <script>
      function copy(that){
var inp =document.createElement('input');
document.body.appendChild(inp)
inp.value =that.textContent
inp.select();
document.execCommand('copy',false);
inp.remove();
}
    </script>



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


<script>
  function delete_batch(id){
  Swal.fire({
  title: "Delete Batch?",
  text: "Please Enter Remark.",
  input: 'text',
  showCancelButton: true   
  }).then((result) => {
    if (result.isConfirmed) {
      if(result.value){
        remark = result.value;
      } else {
        remark = "NIL";
      }
      window.location = "/delete_batch/"+id+"/"+remark; 
    }
  })
  }
</script>
