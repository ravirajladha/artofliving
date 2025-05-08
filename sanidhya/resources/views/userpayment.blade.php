
@include("inc_sanidhya.profileheader")
<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Add Donation | event</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Add Donation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid general-widget">
       
          
                   

                                <?php
                                use App\Models\Events;
                                $passes = Events::all();
                               
                                ?>
                                
        <div class="row">
            <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                    <br>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                        <form action="eventcheckout" method="post">
                            <fieldset>
                                
                                <legend>All Passes</legend>
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Pass Id</th>
                                           
                                            <th>Event Name</th>
                                            <th>event_name_pass1</th>
                                            <th>location_pass</th>
                                            <th>date_pass</th>
                                            <th>event_start_date</th>
                                            <th>event_end_date</th>
                                            <th>Pay</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($passes as $pass)
                                        <tr>
                                            <td>{{$pass->id}}</td>             
                                            <td>{{$pass->event_name}}</td>
                                            <td>{{$pass->event_name_pass1}}</td>
                                            <td>{{$pass->location_pass}}</td>
                                            <td>{{$pass->date_pass}}</td>
                                            <td>{{$pass->event_start_date}}</td>
                                            <td>{{$pass->event_end_date}}</td>
                                            <td>
                                            <a href="/eventcheckout/{{$pass->id}}" type="submit" class="btn btn-primary">Pay</a>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </fieldset>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                   
                       
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    @include("inc_sanidhya.footer")
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script>
        $(document).ready(function () {
    $('#basic-1').DataTable();
    $('#basic-2').DataTable();
});

    </script>