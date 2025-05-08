<!DOCTYPE html>
<html lang="en">
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

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3> </h3>
                    </div>
                    <div class="col-12 col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">
                                    <i data-feather="home"></i>Home</a></li>
                            <!-- <li class="breadcrumb-item"></li> -->
                           
                            
                            <li class="breadcrumb-item active"><a href="user_bulk_upload">
                                    <i data-feather="user_bulk_upload"></i>Bulk upload</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">

                <form action="/create_admin_doner" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form theme-form Cubiclecreate">
                                        <h4>Create User Profile </h4>
                                        <hr>

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="aprex_id" value=" {{session('rexkod_admin_user_id')}}">
                                                        <label>Phone Number<span style="font-size:10px">(10 digits)</span></label>
                                                        <input class="form-control" name="phone" type="text" placeholder="Value *" onkeyup="handlePhoneNumberInput(this.value)" maxlength="10" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Type of Donor</label>
                                                        <select class="form-control" name="type" id="comm_type_p">
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
                                                    <input class="form-control" name="first_name" type="text" placeholder="Value *" id="comm_first_p">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Last Name</label>
                                                    <input class="form-control" name="last_name" type="text" placeholder="Value *" id="comm_last_p">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input class="form-control" name="email" type="text" placeholder="Value *" id="comm_email_p" data-check-email="/check-user-email">
                                                </div>
                                                <span id="emailErrorMessage" style="color: red;"></span>
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
                                                    <input class="form-control" name="age" type="text" placeholder="Value *" id="comm_age_p">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender" id="comm_gender_p">
                                                        <option value=""></option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>PAN</label>
                                                <input class="form-control" name="pan" type="text" placeholder="PAN Value *" id="comm_pan_p" onblur="validatePAN()" maxlength="10">
                                            </div>
                                            <div id="panErrorMessage" style="color: red;"></div>
                                        </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Aadhaar</label>
                                                    <input class="form-control" name="aadhaar" type="text" placeholder="Aadhaar Value *" id="comm_aadhaar_p" onblur="validateAadhaar()" maxlength="12">

                                                    <!-- <input class="form-control" name="aadhaar" type="text" placeholder="Aadhaar Value *" id="comm_aadhaar_p"> -->
                                                </div>
                                                <div id="aadhaarErrorMessage" style="color: red;"></div>
                                            </div>
                                            <!-- aadhaar Details -->


                                        </div>

                                        <div class="row">
                                            <div class="col-md-12"></div>
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="exampleInputname1">Pincode</label>
                                                    <label for="exampleInputname1"></label>
                                                    <input type="text" placeholder="Enter Pincode" class="form-control" id="comm_pin_p" name="pincode" onkeyup="find_pincode_p(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="exampleInputname1">City</label>
                                                    <label for="exampleInputname1"></label>
                                                    <input type="text" placeholder="Enter City " value="" class="form-control" id="comm_block_p" name="city" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="exampleInputname1">State</label>
                                                    <label for="exampleInputname1"></label>
                                                    <input type="text" placeholder="Enter State " value="" class="form-control" name="state" id="comm_state_p" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="exampleInputname1">Address</label>
                                                    <label for="exampleInputname1"></label>
                                                    <input type="text" placeholder="Enter Address " id="comm_address_p" class="form-control" name="address">
                                                </div>
                                            </div>

                                            <!-- Additional fields for Corporate -->
                                            <div id="corporateFields" style="display: none;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Company Name</label>
                                                            <input type="text" class="form-control" name="company_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                <div class="mb-6">
                                                    <label>Company PAN</label>
                                                    <input type="text" class="form-control" name="company_pan" onblur="validatePANC()" maxlength="10" id="company_pan_validate">
                                                </div>
                                                <div id="cpanErrorMessage" style="color: red;"></div>
                                                <div id="ccpanErrorMessage" style="color: red;"></div>
                                            </div>

                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Company Address</label>
                                                            <input type="text" class="form-control" name="company_address">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Line 1</label>
                                                            <input type="text" class="form-control" name="add_line1">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-6">
                                                            <label>Line 2</label>
                                                            <input type="text" class="form-control" name="add_line2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="exampleInputname1">Company Pincode</label>
                                                            <label for="exampleInputname1"></label>
                                                            <input type="text" placeholder="Enter Pincode" class="form-control" id="comm_pin_p1" name="company_pincode" onkeyup="find_pincode_p1(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="exampleInputname1">Company City</label>
                                                            <label for="exampleInputname1"></label>
                                                            <input type="text" placeholder="Enter City " class="form-control" id="comm_block_p1" name="company_city">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="exampleInputname1">Company State</label>
                                                            <label for="exampleInputname1"></label>
                                                            <input type="text" placeholder="Enter State " class="form-control" name="company_stk" id="comm_state_p1">
                                                        </div>
                                                    </div>

                                                    <!-- ... other company fields ... -->
                                                </div>
                                            </div>

                                            <div class="row card-f-end">

                                                <div class="col"><br>
                                                    <hr>
                                                        <div class="text-end">
                                                                <button type="submit" id="submitBtn" class="btn btn-secondary me-3">Create</button>
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


    @include("inc_sanidhya.footer")

    <script src="/assets/js/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2/select2-custom.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
 <script>
        function find_pincode_p1(pin) {

            if (pin.length == 6) {
                $.ajax({
                    url: '/pincode/' + pin,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        var detail = res.split(',');
                        document.getElementById("comm_block_p1").value = detail[0];
                        document.getElementById("comm_state_p1").value = detail[1];
                    }
                });
            } else {
                document.getElementById("comm_block_p1").value = "";
                document.getElementById("comm_state_p1").value = "";
            }
        }

        function find_pincode_c1(pin) {

            if (pin.length == 6) {
                $.ajax({
                    url: '/pincode/' + pin,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        var detail = res.split(',');
                        document.getElementById("comm_block1").value = detail[0];
                        document.getElementById("comm_state1").value = detail[1];
                    }
                });
            } else {
                document.getElementById("comm_block1").value = "";
                document.getElementById("comm_state1").value = "";
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
    </script>

    <script>
        function handlePhoneNumberInput(phone) {
            Promise.all([checkPhoneNumber(phone), find_phone_p(phone)])
                .then(([checkPhoneNumberResponse, findPhonePResponse]) => {})
                .catch((error) => {});
        }

        function find_phone_p(phone) {
            return new Promise((resolve, reject) => {
                if (phone.length === 10) {
                    $.ajax({
                        url: '/check_phone_details/' + phone,
                        type: 'GET',

                             success: function(res) {
                                Swal.fire({
                            icon: 'success',
                            title: 'User Already Register',  // Provide a static success message here
                            showConfirmButton: false,
                            timer: 2000,
                        });

                        
                            
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
                            document.getElementById("comm_pin_p").value = detail[8];
                            document.getElementById("comm_block_p").value = detail[9];
                            document.getElementById("comm_state_p").value = detail[10];
                            document.getElementById("comm_address_p").value = detail[11];
                            resolve(res);
                        },
                        error: function(err) {
                            reject(err);
                        }
                    });
                } else {
                    // Reset fields and resolve with empty response
                    resetFieldsP();
                    resolve('');
                }
            });
        }

        function checkPhoneNumber(phn) {
    return new Promise((resolve, reject) => {
        if (phn.length === 10) {
            $.ajax({
                url: '/checkPhoneNumbers',
                type: 'GET',
                data: {
                    phone_number: phn
                },
                success: function(response) {
                    if (response) {
                        // Set input field values using response data
                        Swal.fire({
                            icon: 'success',
                            title: 'Your number is registered',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#phone').val(response.phone);
                        // Set other input field values similarly

                        // Disable the submit button
                        $('#submitBtn').prop('disabled', true);

                        resolve(response);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Number not registered!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '/create_new_donagtions/';
                        });
                        // Enable the submit button
                        $('#submitBtn').prop('disabled', false);

                        reject(new Error('Number not registered'));
                    }
                },
                error: function(err) {
                    // Enable the submit button
                    $('#submitBtn').prop('disabled', false);

                    reject(err);
                }
            });
        } else {
            // Reset fields and resolve with empty response
            resetFieldsP();

            // Enable the submit button
            $('#submitBtn').prop('disabled', false);

            resolve('');
        }
    });
}


        function resetFieldsP() {
            document.getElementById("comm_type_p").value = "";
            document.getElementById("comm_first_p").value = "";
            document.getElementById("comm_last_p").value = "";
            document.getElementById("comm_email_p").value = "";
            document.getElementById("comm_age_p").value = "";
            document.getElementById("comm_gender_p").value = "";
            document.getElementById("comm_pan_p").value = "";
            document.getElementById("comm_aadhaar_p").value = "";
            document.getElementById("comm_pin_p").value = "";
            document.getElementById("comm_block_p").value = "";

            document.getElementById("comm_state_p").value = "";
            document.getElementById("comm_address_p").value = "";
        }
    </script>

    </script>
    <script type="text/javascript">
        <?php if (!empty(session()->get('success'))) { ?>
            Swal.fire({
                icon: 'success',
                title: '{{ session()->get('
                success ') }}',
                showConfirmButton: false,
                timer: 2000,
            });
        <?php } ?>
    </script>
    
    <script>
        // Function to validate input data with AJAX
        function validateData() {
            var email = $('#comm_email_p').val();
            var pan = $('#comm_pan_p').val();
            var aadhaar = $('#comm_aadhaar_p').val();

            $.ajax({
                url: '/check-data', // Change this to your Laravel route
                method: 'POST',
                data: {
                    email: email,
                    pan: pan,
                    aadhaar: aadhaar
                },
                success: function(response) {
                    if (response.exists) {
                        $('#alertMessage').text('Data already exists in the database.');
                    } else {
                        $('#alertMessage').text('Data not found in the database.');
                    }
                },
                error: function() {
                    $('#alertMessage').text('Error occurred while checking data.');
                }
            });
        }

        // Attach the validateData function to the button click event
        $('#checkDataButton').click(validateData);
    </script>


    <script>
        function validatePAN() {
            var panRegex = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
            var panValue = document.getElementById('comm_pan_p').value;
            var panErrorMessage = document.getElementById('panErrorMessage');

            if (!panRegex.test(panValue)) {
                panErrorMessage.textContent = 'Invalid PAN format';
                return false;
            } else {
                panErrorMessage.textContent = '';
                return true;
            }
        }

        function validatePANC() {
            var panRegex = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
            var panValue = document.getElementById('company_pan_validate').value;
            var panErrorMessage = document.getElementById('ccpanErrorMessage');

            if (!panRegex.test(panValue)) {
                panErrorMessage.textContent = 'Invalid PAN format';
                return false;
            } else {
                panErrorMessage.textContent = '';
                return true;
            }
        }

        function validateAadhaar() {
            var aadhaarRegex = /^\d{12}$/;
            var aadhaarValue = document.getElementById('comm_aadhaar_p').value;
            var aadhaarErrorMessage = document.getElementById('aadhaarErrorMessage');

            if (!aadhaarRegex.test(aadhaarValue)) {
                aadhaarErrorMessage.textContent = 'Invalid Aadhaar format';
                return false;
            } else {
                aadhaarErrorMessage.textContent = '';
                return true;
            }
        }

        function validateForm() {
            var isPANValid = validatePAN();
            var isAadhaarValid = validateAadhaar();
            var isvalidatePANC=validatePANC();

            return isPANValid && isAadhaarValid;
        }
    </script>




<script>
    $(document).ready(function() {
        $('input[name="pan"]').blur(function() {
            var input = $(this);
            var url = '/check-pan'; // Assuming the route is available at this URL.
            var value = input.val().trim();

            if (value !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { pan: value },
                    success: function(response) {
                        console.log(response);

                        if (response.exists) {
                            $('#panErrorMessage').text('This PAN is already taken.');
                        } else {
                            // $('#panErrorMessage').text('');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('input[name="aadhaar"]').blur(function() {
            var input = $(this);
            var url = '/check-aadhar'; // Assuming the route is available at this URL.
            var value = input.val().trim();

            if (value !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { aadhaar: value },
                    success: function(response) {
                        console.log(response);

                        if (response.exists) {
                            $('#aadhaarErrorMessage').text('This Addhar is already taken.');
                        } else {
                        //   $('#panErrorMessage').text('');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    });
</script>
<script>

    $(document).ready(function() {
       
        var company_pan = $('input[name="company_pan"]').eq(0);

        var signUpButton = $('button[type="submit"]');
        console.log(signUpButton);
        company_pan.blur(function() {
          
            var input = $(this);
            var url = '/check-cpan'; // Assuming the route is available at this URL.
            var value = input.val().trim();

            if (value !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { company_pan: value },
                    success: function(response) {
                        console.log(response);

                        if (response.exists) {
                            $('#cpanErrorMessage').text('This PAN is already taken.');
                            signUpButton.prop('disabled', true);
                        } else {
                            $('#cpanErrorMessage').text(''); // Clear the error message when the PAN is not taken.
                            signUpButton.prop('disabled', false);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        // Handle the error here (e.g., display a generic error message).
                    }
                });
            }
        });
        console.log(signUpButton);
    });
</script>


<script>
    $(document).ready(function() {
        var emailInput = $('input[name="email"]');
        var signUpButton = $('button[type="submit"]');

        emailInput.blur(function() {
            var input = $(this);
            var url = '{{ route("check.user.email") }}'; // Use the named route
            var value = input.val().trim();

            if (value !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { user_email: value },
                    success: function(response) {
                        console.log(response);

                        if (response.exists) {
                            $('#emailErrorMessage').text('This email is already taken.');
                            signUpButton.prop('disabled', true); // Disable the button
                        } else {
                            $('#emailErrorMessage').text('');
                            signUpButton.prop('disabled', false); // Enable the button
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        // Handle the error appropriately
                    }
                });
            }
        });
    });
</script>
