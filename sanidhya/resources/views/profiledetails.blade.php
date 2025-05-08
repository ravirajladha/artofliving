<!--  -->

@include("inc_sanidhya.profileheader")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Profile Details</h3>
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
                                <legend>Profile Details</legend>

                                <table class="display" id="basic-1">
                                <div class="card-body pt-0">
                        <div class="table-responsive">
                            <fieldset>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Type</th>
                                            <th>Mobile</th>
                                            <th>Email Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Pancard</th>
                                            <th>Adhar Card</th>
                                            <th>Updated At</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Company Name</th>
                                            <th>Company Pan</th>
                                            <th>Company Pincode</th>
                                            <th>Company city</th>
                                            <th>Company state</th>
                                        
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            @foreach ($data as $dt)
                                           
                                            <th>{{$dt->id}}</th>
                                            <th>{{$dt->type}}</th>
                                            <th>{{$dt->phone}}</th>
                                            <th>{{$dt->email}}</th>
                                            <th>{{$dt->first_name}}</th>
                                            <th>{{$dt->last_name}}</th>
                                            <th>{{$dt->gender}}</th>
                                            <th>{{$dt->age}}</th>
                                            <th>{{$dt->pan}}</th>
                                            <th>{{$dt->aadhaar}}</th>
                                            <th>{{$dt->address}}</th>
                                            <th>{{$dt->city}}</th>
                                            <th>{{$dt->state }}</th>
                                            <th>{{$dt->company_name }}</th>
                                            <th>{{$dt->company_pan}}</th>
                                            <th>{{$dt->company_pincode}}</th>
                                            <th>{{$dt->company_city}}</th>
                                            <th>{{$dt->company_state}}</th>
                                           
                                        </tr>
                                        @endforeach
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>

                            </fieldset>
                        </div>
                    </div>
                                    
                                </table>

                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                    <br>
                   
                </div>
            </div>
        </div>
    </div>

</div>
@include("inc_sanidhya.footer")


<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>