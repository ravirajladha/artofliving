@include("inc_sanidhya.header")
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
<style>
    .table-wrapper {
        overflow-x: visible;
        overflow-y: hidden;
    }
</style>
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
                <div class="col-12 col-sm-6">
                    <h3>All Transactions </h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item"><a href="transactions_bulk_upload">Bulk Upload</a></li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Online Transactions</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Offline Transactions</button>
        </li>
    </ul>
    <!-- Nav Contents -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="card">
                <div class="card-body">
                    <!-- Give Content That You Want -->
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
                                                        <th class="text-center">ID</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Event Id</th>
                                                        <th class="text-center">Event Name</th>
                                                        <th class="text-center">Phone Number</th>
                                                        <th class="text-center">Category</th>
                                                        <th class="text-center">Multiples</th>
                                                        <th class="text-center">Amount</th>
                                                        <th class="text-center">Transaction Id</th>
                                                        <th class="text-center">Payment Mode</th>
                                                        <th class="text-center">Transactions Details</th>
                                                        <th class="text-center">Created By</th>
                                                        <th class="text-center">Created Date</th>


                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach( $data['transactions'] as $transaction)
                                                    @if ($transaction['payment_mode'] === 'Online')
                                                    <tr>
                                                        <td class="text-center">{{ $transaction['id'] }}</td>
                                                        <td class="text-center">{{ $transaction['first_name'] }}</td>
                                                        <td class="text-center">{{ $transaction['event_id'] }}</td>
                                                        <td class="text-center">{{ $transaction['event_name'] }}</td>
                                                        <td class="text-center">{{ $transaction['phone_number'] }}</td>
                                                        <td class="text-center">{{ $transaction['category'] }}</td>
                                                        <td class="text-center">{{ $transaction['multiples'] }}</td>
                                                        <td class="text-center">{{ $transaction['amount'] }}</td>
                                                        <td class="text-center">{{ $transaction['transaction_id'] }}</td>
                                                        <td class="text-center">{{ $transaction['payment_mode'] }}</td>

                                                        @if($transaction['transaction_status']== 'CHARGED')
                                                        <td class="text-center">SUCCESS</td>
                                                        @else
                                                        <td class="text-center">PAYMENT FAIL</td>
                                                        @endif
                                                        <td class="text-center">
                                                            @php
                                                            $user = \App\Models\User::find($transaction['arex_id']);
                                                            @endphp

                                                            {{ $user ? $user->name : 'User not found' }}
                                                        </td>


                                                        <td class="text-center">{{ $transaction['date_created'] }}</td>
                                                    </tr>
                                                    @endif

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
            </div>
        </div>


        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="card">
                <div class="card-body">
                    <!-- Container-fluid starts-->
                    <div class="container-fluid general-widget">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                                <div class="card ongoing-project recent-orders">
                                    <br>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">

                                            <table id="myTable" class="datatable table table-hover table-center mb-2">

                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Event Id</th>
                                                        <th>Event Name</th>
                                                        <th>Phone Number</th>
                                                        <th>Category</th>
                                                        <th>Multiples</th>
                                                        <th>Amount</th>
                                                        <th>Transaction Id</th>
                                                        <th>Payment Mode</th>
                                                        <th>Payment Status</th>
                                                        <th>Create By</th>
                                                        <th>Description</th>
                                                        <th>Transaction Img</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($data['transactions'] as $transaction)
                                                    @if ($transaction['payment_mode'] === 'Cheque' || $transaction['payment_mode'] === 'Other')
                                                    <tr>
                                                        <td class="text-center">{{ $transaction['id'] }}</td>
                                                        <td class="text-center">{{ $transaction['first_name'] }}</td>
                                                        <td class="text-center">{{ $transaction['event_id'] }}</td>
                                                        <td class="text-center">{{ $transaction['event_name'] }}</td>
                                                        <td class="text-center">{{ $transaction['phone_number'] }}</td>
                                                        <td class="text-center">{{ $transaction['category'] }}</td>
                                                        <td class="text-center">{{ $transaction['multiples'] }}</td>
                                                        <td class="text-center">{{ $transaction['amount'] }}</td>
                                                        <td class="text-center">{{ $transaction['transaction_id'] }}</td>
                                                        <td class="text-center">{{ $transaction['payment_mode'] }}</td>
                                                        @if($transaction['transaction_status'] == 'CHARGED')
                                                        <td class="text-center">SUCCESS</td>
                                                        @else
                                                        <td class="text-center">PAYMENT FAIL</td>
                                                        @endif
                                                        <td class="text-center">
                                                            @php
                                                            $user = \App\Models\User::find($transaction['arex_id']);
                                                            @endphp

                                                            {{ $user ? $user->name : 'User not found' }}
                                                        </td>

                                                        <td class="text-center">{{ $transaction['description'] }}</td>
                                                        @if($transaction['transaction_img'] != 'null')
                                                        <td class="text-center">
                                                            <a href="/assets/{{ $transaction['transaction_img'] }}" target="_blank">View</a>
                                                        </td>
                                                        @else
                                                        <td class="text-center">
                                                            Receipt Not Uploaded
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endif
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
            </div>
        </div>
    </div>
    @include("inc_sanidhya.footer")
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
    <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#basic-1').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>