@include("inc_sanidhya.header")
<?php

use App\Models\Donation; ?>
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
        <div class="col-12 col-sm-12">

          <div class="page-header-left">
          <form action="/create_passes/{{$data['event']->id}}" method="post">

              @csrf
            <input type="date" name="pass_date" class="form-control" style="width: 140px; height: 34px; float: left; margin-left: 10px;"  min="{{ $data['event']->event_start_date }}"  >

            <input type="date" name="pass_date" class="form-control" style="width: 140px; height: 34px; float: left; margin-left: 10px;"  min="{{ $data['event']->event_start_date }}" max="{{ $data['event']->event_end_date }}" >

            <button onclick="Swal.fire({icon: 'info',title: 'Please Wait, Creating Passes',showConfirmButton: false,timer: 500000})" class="btn btn-success btn-sm" style="float: left; margin-left: 10px;">Generate Passes</button>
            </form>
            <a href="/send_passes/{{$data['event']->id}}"><button onclick="Swal.fire({icon: 'info',title: 'Please Wait, Sending Passes',showConfirmButton: false,timer: 500000})" class="btn btn-warning btn-sm">Send Passes (WhatsApp)</button></a>
            <a href="/mail_passes/{{$data['event']->id}}"><button onclick="Swal.fire({icon: 'info',title: 'Please Wait, Sending Passes',showConfirmButton: false,timer: 500000})" class="btn btn-primary btn-sm">Send Passes (Mail)</button></a>
            <a href="/sms_passes/{{$data['event']->id}}"><button onclick="Swal.fire({icon: 'info',title: 'Please Wait, Sending Passes',showConfirmButton: false,timer: 500000})" class="btn btn-secondary btn-sm">Send Passes (SMS)</button></a>
            <a style="float:right" href="#"><button onclick="renew_passes()" class="btn btn-default btn-sm" style="border:1px solid black">Renew Passes</button></a>

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

      <div class="col-xl-2 col-sm-6">

        <!-- <img src="<?php //echo 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $asset->qr; 
                        ?>" width="125" class="mr-4" /></a> -->
      </div>



    </div>
    <div class="row Assetmore">

      <div class="container-fluid card">
        <div class="row card-body">
          <form action="/send_passes_selected" method="POST">
            @csrf
            <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>
              <div class="row">
                <div class="col-6">
                  <h4>All Passes | {{$data['event']->event_name}}</h4>
                </div>
                <div class="col-6">
                  <span style="float:right">
                    <select name="options">
                      <option value="0">Selected</option>
                      <option value="all">All</option>
                      <?php
                      foreach ($data['batches'] as $batch) {
                        $cur_batch = Donation::where("batch", $batch->id)->first();
                        if (isset($cur_batch->batch_name)) {
                          $batch_name = $cur_batch->batch_name;
                        } else {
                          $batch_name = "Batch";
                        }
                      ?>
                        <option value="{{$batch->id}}">{{$batch_name}} ({{$batch->id}})</option>
                      <?php } ?>
                    </select>
                    <input type="number" value="{{ $data['event']->id }}" name="event_id" hidden>
                    <input type="checkbox" value="w" name="sender[]"> WhatsApp
                    <input type="checkbox" value="m" name="sender[]"> Mail
                    <input type="checkbox" value="s" name="sender[]"> SMS
                    <button onclick="Swal.fire({icon: 'info',title: 'Please Wait, Sending Passes',showConfirmButton: false,timer: 500000})" style="float:right;margin-bottom:5px;margin-left:10px" class="btn btn-success btn-xs">Send </button>
                  </span>
                </div>
                <hr>
              </div>

              <thead>
                <tr>
                  <th style="min-width:100px"> UID</th>
                  <th style="min-width:100px">User</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Amount</th>
                  <th>Category</th>
                  <th>Seat</th>
                  <th>Status</th>
                  <th>Pass Data</th>
                  <th>Download</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['all_passes'] as $pass) {
                  $donation = App\Models\Donation::where('id', $pass->donation_id)->first();

                ?>
                  <tr>
                    <td>
                      <div class="row">
                        <div class="col-sm-3"><input style="margin-top:-7px" value="{{$pass->id}}" name="passes[]" type="checkbox"></div>
                        <div class="col-sm-8"><?php echo $pass->id; ?></div>
                      </div>
                    </td>
                    <td><?php if (isset($donation->first_name)) {
                          echo $donation->first_name;
                        }
                        if (isset($donation->last_name)) {
                          echo " " . $donation->last_name;
                        } ?></td>
                    <td><?php if (isset($donation->phone)) {
                          echo $donation->phone;
                        } ?></td>
                    <td><?php if (isset($donation->email)) {
                          echo $donation->email;
                        } ?></td>

                    <td><?php if (isset($donation->amount)) {
                          echo $donation->amount;
                        } ?></td>
                    <td><?php if (isset($donation->category)) {
                          echo $donation->category;
                        } ?></td>
                    <td><?php if (isset($donation->seat_number)) {
                          echo $donation->seat_number;
                        } ?></td>

                    <td><?php
                        if ($pass->status == 2) {
                          echo "Checked Out";
                        } else if ($pass->status == 1) {
                          echo "Checked In";
                        } else {
                          echo "Unused";
                        }
                        ?></td>
                        <td><?php if (isset($pass->pass_date)) {
                          echo $pass->pass_date;
                        } ?></td>
                    <td>
                      <center><a target="_BLANK" href="/pass/<?php echo $pass->pass_file; ?>">
                          <i style="margin-left:5px" class="fa fa-download"></i></a></center>
                    </td>

                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>






  </div>
  <!-- Container-fluid Ends-->
</div>
</div>
@include("inc_sanidhya.footer")




<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


<?php if (!empty(session()->get('failed'))) { ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'warning',
      title: '{{ session()->get('
      failed ') }}',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
<?php }
session()->forget('failed'); ?>

<script>
  function checkAll(ele) {
    var checkboxes = document.getElementsByTagName('input');
    if (ele.checked) {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].name == 'passes[]') {
          checkboxes[i].checked = true;
        }
      }
    } else {
      for (var i = 0; i < checkboxes.length; i++) {
        console.log(i)
        if (checkboxes[i].name == 'passes[]') {
          checkboxes[i].checked = false;
        }
      }
    }
  }



  function renew_passes() {
    Swal.fire({
      title: 'Renew Passes?',
      text: "All passes will be made unused!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Renew!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/renew_passes/{{$data['event']->id}}";
      }
    })
  }
</script>