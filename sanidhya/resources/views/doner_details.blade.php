@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>All Donor</h3>
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

use App\Models\Donation;


  $url =  "{$_SERVER['REQUEST_URI']}";
  $url = explode('/', $url);
  ?>
  <div class="container-fluid general-widget">
    <div class="row">
        <?php 
        $data = Donation::join('transactions', 'donations.transaction_id', '=', 'transactions.transaction_id')
        ->where('transactions.transaction_status', 'CHARGED')
        ->get();
        ?>

      <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
        <div class="card ongoing-project recent-orders">
          <br>
          <div class="card-body pt-0">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>ID</th>
                    <!-- <th>Donor Type</th> -->
                    <th>First name </th>
                    <th>Last name</th>
                    <th>Phone no</th>
                    <th>Email ID</th>
                    <th>Payment Mode</th>
                    <th>Event Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Multiples</th>
                    <th>payment Mode</th>
                    <th>transaction_id</th>
                    <th>transaction Status</th>
                    <th>date_created</th>
                   
                  </tr>
                </thead>
                <tbody>
            
                   @foreach($data as $datas)
                    <tr>

                      <td style="padding:0 20px">{{$datas->id}}</td>
                      <!-- <td style="padding:0 20px">{{$datas->type}}</td> -->
                      <td>{{$datas->first_name}}</td>
                      <td>{{$datas->last_name}}</td>
                      <td>{{$datas->phone}}</td>
                      <td>{{$datas->email}}</td>
                      <td>{{$datas->payment_mode}}</td>
                      <td>{{$datas->event_name}}</td>
                      <td>{{$datas->category}}</td>
                      <td>{{$datas->amount}}</td>
                      <td>{{$datas->multiples}}</td>
                      <td>{{$datas->payment_mode}}</td>
                      <td>{{$datas->transaction_id}}</td>
                      @if($datas->transaction_status==='CHARGED')
                      <td>SUCCESS</td>
                      @else
                        <td>FAILED</td>
                      @endif
                  
                     
                      <td>{{$datas->date_created}}</td>
                         
              @endforeach
                        

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