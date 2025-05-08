<?php
$donations = $data['donations'];
?>

@include("inc_sanidhya.profileheader")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Profile Dashboard</h3>
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
                            <fieldset>
                                <legend>All Donations</legend>
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Donation id</th>
                                            <th>type</th>
                                            <th>multiples</th>
                                            <th>amount</th>
                                            <th>phone</th>
                                            <th>email</th>
                                            <th>first_name</th>
                                            <th>last_name</th>
                                            <th>gender</th>
                                            <th>age</th>
                                            <th>pan</th>
                                            <th>address</th>
                                            <th>pincode</th>
                                            <th>city</th>
                                            <th>state</th>
                                            <th>company_name</th>
                                            <th>company_pan</th>
                                            <th>company_address</th>
                                            <th>company_pincode</th>
                                            <th>company_city</th>
                                            <th>company_state</th>
                                            <th>status</th>
                                            <th>created_at</th>
                                            <th>updated_at</th>
                                            <th>pass_generated</th>
                                            <th>seat_number</th>
                                            <th>event_id</th>
                                            <th>category</th>
                                            <th>batch</th>
                                            <th>batch_name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donations as $donation)
                                        <tr>
                                            <td>{{$donation->id}}</td>
                                            <td>{{$donation->type}}</td>
                                            <td>{{$donation->multiples}}</td>
                                            <td>{{$donation->amount}}</td>
                                            <td>{{$donation->phone}}</td>
                                            <td>{{$donation->email}}</td>
                                            <td>{{$donation->first_name}}</td>
                                            <td>{{$donation->last_name}}</td>
                                            <td>{{$donation->gender}}</td>
                                            <td>{{$donation->age}}</td>
                                            <td>{{$donation->pan}}</td>
                                            <td>{{$donation->address}}</td>
                                            <td>{{$donation->pincode}}</td>
                                            <td>{{$donation->city}}</td>
                                            <td>{{$donation->state}}</td>
                                            <td>{{$donation->company_name}}</td>
                                            <td>{{$donation->company_pan}}</td>
                                            <td>{{$donation->company_address}}</td>
                                            <td>{{$donation->company_pincode}}</td>
                                            <td>{{$donation->company_city}}</td>
                                            <td>{{$donation->company_state}}</td>
                                            <td>{{$donation->status}}</td>
                                            <td>{{$donation->created_at}}</td>
                                            <td>{{$donation->updated_at}}</td>
                                            <td>{{$donation->pass_generated}}</td>
                                            <td>{{$donation->seat_number}}</td>
                                            <td>{{$donation->event_id}}</td>
                                            <td>{{$donation->category}}</td>
                                            <td>{{$donation->batch}}</td>
                                            <td>{{$donation->batch_name}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </fieldset>
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