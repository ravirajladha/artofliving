<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include("inc_sanidhya.header")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border: none;
            margin-top: 5px !important;
        }
    </style>
    <style>
        .form-control {
            width: 100%;
        }
        input {
    pointer-events: none;
}




    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3> </h3>
                    </div>
                    <div class="col-12 col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active"> Event Details </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">

                <form id="myForm">
                    @csrf
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form theme-form Cubiclecreate">
                                        <h4> User Profile Details </h4>
                                        <hr>

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="id" value="{{ $data['profile']->id }}">
                                                        <label>Phone Number<span style="font-size:10px">(10 digits)</span></label>
                                                        <input class="form-control" name="phone" type="text" value="{{$data['profile']->phone}}" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Type of Donor</label>
                                                        <select class="form-control" name="type" id="comm_type_p">

                                                            <option value="Individual" @if($data['profile']->type === 'Individual') selected @endif>Individual</option>
                                                            <option value="Corporate" @if($data['profile']->type === 'Corporate') selected @endif>Corporate</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>First Name</label>
                                                    <input class="form-control" name="first_name" type="text" value="{{$data['profile']->first_name}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Last Name</label>
                                                    <input class="form-control" name="last_name" type="text" value="{{$data['profile']->last_name}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input class="form-control" name="email" type="text" value="{{$data['profile']->email}}">
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
                                                    <input class="form-control" name="age" type="text" value="{{$data['profile']->age}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender">
                                                        <option value=""></option>
                                                        <option value="Male" @if($data['profile']->gender === 'Male') selected @endif>Male</option>
                                                        <option value="Female" @if($data['profile']->gender === 'Female') selected @endif>Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>PAN</label>
                                                    <input class="form-control" name="pan" type="text" value="{{$data['profile']->pan}}">
                                                </div>
                                                <div id="panErrorMessage" style="color: red;"></div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Aadhaar</label>
                                                    <input class="form-control" name="aadhaar" type="text" value="{{$data['profile']->aadhaar}}">
                                                </div>
                                                <div id="aadhaarErrorMessage" style="color: red;"></div>
                                            </div>
                                            <!-- Booking Details -->



                                            <div class="row">
                                                <div class="col-md-12"></div>
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputname1">Pincode</label>
                                                        <label for="exampleInputname1"></label>
                                                        <input type="text" placeholder="Enter Pincode" class="form-control" name="pincode" value="{{$data['profile']->pincode}}" maxlength="6">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputname1">City</label>
                                                        <label for="exampleInputname1"></label>
                                                        <input type="text" placeholder="Enter City " name="city" class="form-control" value="{{$data['profile']->city}}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputname1">State</label>
                                                        <label for="exampleInputname1"></label>
                                                        <input type="text" placeholder="Enter State " name="state" class="form-control" value="{{$data['profile']->state}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputname1">Address</label>
                                                        <label for="exampleInputname1"></label>
                                                        <input type="text" placeholder="Enter State " value="{{$data['profile']->address}}" class="form-control" name="address">
                                                    </div>
                                                </div>

                                                <!-- Additional fields for Corporate -->
                                                <div id="corporateFields" style="display: none;">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-6">
                                                                <label>Company Name</label>
                                                                <input type="text" class="form-control" name="company_name" value="{{$data['profile']->company_name}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-6">
                                                                <label>Company PAN</label>
                                                                <input type="text" class="form-control" name="company_pan" value="{{$data['profile']->company_pan}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-6">
                                                                <label>Company Address</label>
                                                                <input type="text" class="form-control" name="company_address" value="{{$data['profile']->company_address}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-6">
                                                                <label>Line 1</label>
                                                                <input type="text" class="form-control" name="add_line1" value="{{$data['profile']->add_line1}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-6">
                                                                <label>Line 2</label>
                                                                <input type="text" class="form-control" name="add_line2" value="{{$data['profile']->add_line2}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="exampleInputname1">Company Pincode</label>
                                                                <label for="exampleInputname1"></label>
                                                                <input type="text" value="{{$data['profile']->company_pincode}}" class="form-control" name="company_pincode" type="number" maxlength="6">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="exampleInputname1">Company City</label>
                                                                <label for="exampleInputname1"></label>
                                                                <input type="text" placeholder="Enter City " value="{{$data['profile']->company_city}}" class="form-control" name="company_city">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="mb-3">
                                                                <label for="exampleInputname1">Company State</label>
                                                                <label for="exampleInputname1"></label>
                                                                <input type="text" class="form-control" name="company_state" value="{{$data['profile']->company_state}}">
                                                            </div>
                                                        </div>

                                                        <!-- ... other company fields ... -->
                                                    </div>
                                                </div>

                                                <div class="row card-f-end">

                                                    <div class="col"><br>
                                                        <hr>
                                                        <!-- <div class="text-end">
                                                            <button type="button" class="btn btn-secondary me-3" onclick="printFormContent()">Print</button>
                                                        </div> -->
                                                    </div>
                                                </div>

                                            </div>
                </form>
            </div>
        </div>

    </div>





    @include("inc_sanidhya.footer")

    <script src="/assets/js/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2/select2-custom.js"></script>




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

       

    </script>