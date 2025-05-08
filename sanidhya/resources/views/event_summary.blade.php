@include("inc_sanidhya.header")

<style>
  .ongoing-project.recent-orders table tr th,
  .ongoing-project.recent-orders table tr td {
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
            <h3 style="font-size: 20px">Event Summary | {{ $data['event']['event_name'] }}</h3>
          </div>
        </div>
        <div class="col-12 col-sm-3">
          <a href="/event_report/{{ $data['event']['id'] }}" style="float: right">
            <button class="btn btn-sm btn-primary">Detailed Report</button>
          </a>
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
            <table class="table table-striped" data-order='[[ 0, "asc" ]]' data-page-length='10'>
              <thead>
                <tr>
                  <th>Sr</th>
                  <th>Category</th>
                  <th>Total Ticket Issued</th>
                  <th>Checked In</th>
                  <th>Percentage</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php $index = 1; @endphp
                @foreach($data as $category => $value)
                  @if (strpos($category, '_used') === false && $category !== 'event' && $category !== 'total' && $category !== 'total_used')
                    <tr>
                      <td>{{ $index++ }}</td>
                      <td>{{ $category }}</td>
                      <td>{{ $value }}</td>
                      <td>{{ $data[$category . '_used'] }}</td>
                      <td>
                        <?php
                          if ($value != 0) {
                            $perc = ($data[$category . '_used'] / $value) * 100;
                            echo number_format($perc, 1) . "%";
                          } else {
                            echo "0%";
                          }
                        ?>
                      </td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                <tr style="background-color: #ffefd6">
                  <td>{{ $index++ }}</td>
                  <td>Total</td>
                  <td>{{ $data['total'] }}</td>
                  <td>{{ $data['total_used'] }}</td>
                  <td>
                    <?php
                      if ($data['total'] != 0) {
                        $perc = ($data['total_used'] / $data['total']) * 100;
                        echo number_format($perc, 1) . "%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td></td>
                </tr>
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