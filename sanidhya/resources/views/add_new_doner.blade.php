<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include("inc_sanidhya.header")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border: none;
            margin-top: 5px !important;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3>New Doner || {{$data['event_name']}} </h3>
                    </div>
                    <div class="col-12 col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">
                                    <i data-feather="home"></i>Home</a></li>
                            <!-- <li class="breadcrumb-item"></li> -->
                            <li class="breadcrumb-item active"> Event Details </li>
                                   
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">

                <form action="/create_new_donagtion" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form theme-form Cubiclecreate">
                                        <h4>Event Information </h4>
                                        <hr>

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="apex_id" value=" {{session('rexkod_admin_user_id')}}">
                                                        <input type="hidden" name="evnet_id" value="{{$data['event_id']}}">
                                                        <label>Phone Number<span style="font-size:10px">(10 digits)</span></label>
                                                        <input class="form-control" name="phone_number" type="text" placeholder="Value *" onkeyup="find_phone_p(this.value)" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Type of Donation</label>
                                                        <select class="form-control" name="type_donation" id="comm_type_p">
                                                            <option value=""></option>
                                                            <option value="Individual">Individual</option>
                                                            <option value="Corporate">Corporate</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>First Name</label>
                                                    <input class="form-control" name="doner_name" type="text" placeholder="Value *" id="comm_first_p">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Last Name</label>
                                                    <input class="form-control" name="doner_last" type="text" placeholder="Value *" id="comm_last_p">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input class="form-control" name="doner_email" type="text" placeholder="Value *" id="comm_email_p">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Phone</label>
                                                    <input class="form-control" name="doner_phone" type="text" placeholder="Value *">
                                                </div>
                                            </div> -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Age</label>
                                                    <input class="form-control" name="doner_age" type="text" placeholder="Value *" id="comm_age_p">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="doner_gender" id="comm_gender_p">
                                                        <option value=""></option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>PAN</label>
                                                    <input class="form-control" name="doner_pan" type="text" placeholder="PAN Value *" id="comm_pan_p">
                                                </div>
                                                <div id="panErrorMessage" style="color: red;"></div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Aadhaar</label>
                                                    <input class="form-control" name="doner_aadhaar" type="text" placeholder="Aadhaar Value *" id="comm_aadhaar_p">
                                                </div>
                                                <div id="aadhaarErrorMessage" style="color: red;"></div>
                                            </div>
                                        <!-- Booking Details -->
                                        <div class="col-md-6">
                                             <div class="mb-3">
                                                <label>Category</label>
                                             <select name="category" class="form-control" onchange="updateAmount(this)">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach ($data['category_values'] as $category => $amount)
                                                    <option value="{{ $category }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Multiples</label>
                                                <input class="form-control" name="multiples" type="number" placeholder="Value *" onchange="updateAmount(this)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Amount</label>
                                                <input id="amount" class="form-control" name="amount" type="number" placeholder="Value *" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Seat Number</label>
                                                <input id="amount" class="form-control" name="seat_number" type="number" placeholder="Value *" >
                                            </div>
                                        </div>
                                    </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12"></div>
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="exampleInputname1">Pincode</label>
                                                    <label for="exampleInputname1"></label>
                                                    <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="doner_pincode" value="" onkeyup="find_pincode_p(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="exampleInputname1">City</label>
                                                    <label for="exampleInputname1"></label>
                                                    <input type="text" placeholder="Enter City " value="" class="form-control" id="comm_block_p" name="doner_city" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="exampleInputname1">State</label>
                                                    <label for="exampleInputname1"></label>
                                                    <input type="text" placeholder="Enter State " value="" class="form-control" name="doner_state" id="comm_state_p" readonly>
                                                </div>
                                            </div>

                                            <!-- Additional fields for Corporate -->
                                            <div id="corporateFields" style="display: none;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Company Name</label>
                                                            <input type="text" class="form-control" name="doner_company_name" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Company PAN</label>
                                                            <input type="text" class="form-control" name="doner_company_pan">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Company Address</label>
                                                            <input type="text" class="form-control" name="doner_company_address" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Line 1</label>
                                                            <input type="text" class="form-control" name="doner_line1" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Line 2</label>
                                                            <input type="text" class="form-control" name="doner_line2" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="exampleInputname1">Company Pincode</label>
                                                            <label for="exampleInputname1"></label>
                                                            <input type="text" placeholder="Enter Pincode" class="form-control"  name="pincode"  type="number" maxlength="6">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="exampleInputname1">Company City</label>
                                                            <label for="exampleInputname1"></label>
                                                            <input type="text" placeholder="Enter City " value="" class="form-control" id="comm_block_p" name="city" >
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="exampleInputname1">Company State</label>
                                                            <label for="exampleInputname1"></label>
                                                            <input type="text" placeholder="Enter State " value="" class="form-control" name="state" id="comm_state_p" >
                                                        </div>
                                                    </div>

                                                    <!-- ... other company fields ... -->
                                                </div>
                                            </div>

                                            <div class="row card-f-end">

                                                <div class="col"><br>
                                                    <hr>
                                                    <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Create</button></div><br><br>
                                                </div>
                                            </div>

                                        </div>
                </form>
            </div>

        </div>
    </div>

    </div>




    @include("inc_sanidhya.footer")

    <script src="/assets/js/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2/select2-custom.js"></script>


    <script>
        function find_pincode_p(pin) {

            if (pin.length == 6) {
                $.ajax({
                    url: '/pincode/' + pin,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        var detail = res.split(',');
                        document.getElementById("comm_block_p").value = detail[0];
                        document.getElementById("comm_state_p").value = detail[1];
                    }
                });
            } else {
                document.getElementById("comm_block_p").value = "";
                document.getElementById("comm_state_p").value = "";
            }
        }

        function find_pincode_c(pin) {

            if (pin.length == 6) {
                $.ajax({
                    url: '/pincode/' + pin,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        var detail = res.split(',');
                        document.getElementById("comm_block").value = detail[0];
                        document.getElementById("comm_state").value = detail[1];
                    }
                });
            } else {
                document.getElementById("comm_block").value = "";
                document.getElementById("comm_state").value = "";
            }
        }
    </script>

    <!--Phone Validation -->
    <script>
        function find_phone_p(phone) {

            if (phone.length == 10) {
                $.ajax({
                    url: '/check_phone_details/' + phone,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        var detail = res.split(',');
                        document.getElementById("comm_type_p").value = detail[0];
                        document.getElementById("comm_first_p").value = detail[1];
                        document.getElementById("comm_last_p").value = detail[2];
                        document.getElementById("comm_email_p").value = detail[3];
                        document.getElementById("comm_age_p").value = detail[4];
                        document.getElementById("comm_gender_p").value = detail[5];
                        document.getElementById("comm_pan_p").value = detail[6];
                        document.getElementById("comm_aadhaar_p").value = detail[7];
                    }
                });
            } else {
                document.getElementById("comm_type_p").value = "";
                document.getElementById("comm_first_p").value = "";
                document.getElementById("comm_last_p").value = "";
                document.getElementById("comm_email_p").value = "";
                document.getElementById("comm_age_p").value = "";
                document.getElementById("comm_gender_p").value = "";
                document.getElementById("comm_pan_p").value = "";
                document.getElementById("comm_aadhaar_p").value = "";

            }
        }

        function find_phone_c(phone) {

            if (phone.length == 10) {
                $.ajax({
                    url: '/check_phone_details/' + phone,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        var detail = res.split(',');
                        document.getElementById("comm_block").value = detail[0];
                        document.getElementById("comm_state").value = detail[1];
                    }
                });
            } else {
                document.getElementById("comm_block").value = "";
                document.getElementById("comm_state").value = "";
            }
        }
    </script>
    <script>
       $(document).ready(function() {
    $('#comm_type_p').change(function() {
        var selectedType = $(this).val();
        console.log('Fetched Value:', selectedType); // Log the fetched value

        if (selectedType === 'Corporate') {
            console.log('Display Corporate Fields');
            $('#corporateFields').css('display', 'block');
        } else {
            console.log('Hide Corporate Fields');
            $('#corporateFields').css('display', 'none');
        }
    });
});


function updateAmount(element) {
    var category = $('select[name="category"]').val();
    var multiples = $('input[name="multiples"]').val();
    
    var categoryValues = {!! json_encode($data['category_values']) !!}; // Add this line
    
    if (category && multiples) {
        var amount = parseInt(multiples) * parseInt(categoryValues[category]);
        $('#amount').val(amount);
    } else {
        $('#amount').val('');
    }
}

    </script>