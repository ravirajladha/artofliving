@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>All Events</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Events</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <?php

  use App\Models\Transaction;

  $url =  "{$_SERVER['REQUEST_URI']}";
  $url = explode('/', $url);
  ?>
  <div class="container-fluid general-widget">
    <div class="row">


      <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
        <div class="card ongoing-project recent-orders">
          <br>
          <div class="card-body pt-0">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Venue</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data['event'] as $event) { ?>

                    <tr>

                      <td style="padding:0 20px"><?php echo $event->id; ?></td>
                      <td style="padding:0 20px"><?php echo $event->event_name; ?></td>
                      <td><?php echo date('jS M Y', strtotime($event->event_start_date)); ?></td>
                      <td><?php echo date('jS M Y', strtotime($event->event_end_date)); ?></td>
                      <td><?php echo $event->venue_name; ?></td>
                      <td style="display: flex; align-items: center; justify-content: flex-end;">

                        <a href="donations/{{$event->id}}"><button title="Donations" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-info"><i class="fa fa-users"></i></button></a>
                        <!-- 
                         <?php
                          $checkpayment = Transaction::where('event_id', $event->id)->exists();
                          ?>

                        @if ($checkpayment)
                            <a href="add_donation/{{$event->id}}">
                                <button title="Add" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-info">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </a>
                        @endif -->
                        <a href="passes/{{$event->id}}"><button title="Passes" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-success"><i class="fa fa-ticket"></i></button></a>

                        <a href="batches/{{$event->id}}"><button title="Batches" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-warning"><i class="fa fa-bars"></i></button></a>

                        <a href="event/{{$event->id}}"><button title="View" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></button></a>

                        <a href="edit_event/{{$event->id}}"><button title="Edit" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-secondary"><i class="fa fa-pencil"></i></button></a>

                        <!-- <a href="create_new_donagtions/{{$event->id}}"><button title="Add" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-info"><i class="fa fa-plus"></i></button></a> -->

                        <a href="event_summary/{{$event->id}}"><button title="Reports" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-info"><i class="fa fa-line-chart"></i></button></a>


                        <a href="/transactionDetails/{{$event->id}}"><button title="Transactions" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-info"><i class="fa fa-inr"></i></button></a>

                        <a href="off_payment/{{$event->id}}"><button title="Payments" style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-success"><i class="fa fa-credit-card-alt"></i></button></a>


                        <?php if ($event->id == 0) { ?>
                          <a target="_BLANK" href="vb"><button style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px;" class="btn btn-xs btn-warning"><i class="fa fa-globe"></i></button></a>
                          <button style="font-size: 12px; margin: 2px; padding: 2px 5px; width: 24px; color: #333; border: 1px solid;" class="btn btn-xs btn-default" onclick="copy(this)"><i class="fa fa-copy"></i>
                            <p style="display:none;">vb</p>
                          </button>
                        <?php } ?>
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
  function copy(that) {
    var inp = document.createElement('input');
    document.body.appendChild(inp)
    inp.value = that.textContent
    inp.select();
    document.execCommand('copy', false);
    inp.remove();
  }
</script>