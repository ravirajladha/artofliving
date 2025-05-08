<?php
$passes = $data['passes'];
?>

@include("inc_sanidhya.profileheader")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>All Passes</h3>
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
                                        <th>Donation ID</th>
                                        <th>Event ID</th>
                                        <th>Batch ID</th>
                                        <th>Pass File</th>
                                        <th>Status</th>
                                        <th>Scanned By</th>
                                        <th>Scanned At</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>WhatsApp</th>
                                        <th>SMS</th>
                                        <th>Email</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($passes as $pass)
                                    <tr>
                                        <td>{{$pass->id}}</td>
                                        <td>{{$pass->donation_id}}</td>
                                        <td>{{$pass->event_id}}</td>
                                        <td>{{$pass->batch_id}}</td>
                                        <td>{{$pass->pass_file}}</td>
                                        <td>{{$pass->status}}</td>
                                        <td>{{$pass->scanned_by}}</td>
                                        <td>{{$pass->scanned_at}}</td>
                                        <td>{{$pass->created_at}}</td>
                                        <td>{{$pass->updated_at}}</td>
                                        <td>{{$pass->whatsapp}}</td>
                                        <td>{{$pass->sms}}</td>
                                        <td>{{$pass->email}}</td>
                                        <td>
                                            <center><a target="_BLANK" href="pass/<?php echo $pass->pass_file; ?>"><i style="margin-left:5px" class="fa fa-download"></i></a></center>
                                        </td>
                                    </tr>
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