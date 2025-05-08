@include("inc_sanidhya.registerheader")

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
                    <h3>1Register</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"></li>
                        <a href="index">
                            <i data-feather="home">Home</i>
                        </a>
                        </li>
                        <!-- <li class="breadcrumb-item"></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <form action="/create_profile" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Navigation -->
                <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Basic Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Company Information</button>
                    </li>
                </ul> -->
                <?php
                $firstname = $data['first_name'];
                $lastname = $data['last_name'];
                $email = $data['email'];
                $phone = $data['phone'];
                $type = $data['type'];
                ?>
                <!-- <div class="tab-content" id="myTabContent"> -->
                @if($type == 'Individual')
                <!-- <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"> -->
                <div id="personal">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form theme-form Cubiclecreate">
                                    <h4>Basic Information</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="row">
                                            <input type="hidden" name="type" value="{{$type}}">

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Phone</label>
                                                    <input class="form-control" name="phone" type="number" value="{{$phone}}" placeholder="Value *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input class="form-control" name="email" type="email" value="{{$email}}" placeholder="Value *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>First Name</label>
                                                    <input class="form-control" name="first_name" type="text" value="{{$firstname}}" placeholder="Value *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Last Name</label>
                                                    <input class="form-control" name="last_name" type="text" value="{{$lastname}}" placeholder="Value *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Age</label>
                                                    <input class="form-control" name="age" type="number" value="" placeholder="Value *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value=""></option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>PAN</label>
                                                    <input class="form-control" name="pan" id="panNumber" type="text" placeholder="PAN Value *" value="" maxlength="10">
                                                </div>
                                                <div id="panErrorMessage" style="color: red;"></div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Aadhaar</label>
                                                    <input class="form-control" name="aadhaar" id="aadhaarNumber" type="tel" placeholder="Aadhaar Value *" value="" maxlength="12">
                                                </div>
                                                <div id="aadhaarErrorMessage" style="color: red;"></div>
                                            </div>
                                 

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Address</label>
                                                    <textarea class="form-control" name="address" id="" cols="10" rows="1" placeholder="Value *"></textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12"></div>
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="exampleInputname1">Pincode</label>
                                                        <label for="exampleInputname1"></label>
                                                        <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="pincode" value="" onkeyup="find_pincode_p(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
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

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                @endif

                @if($type == 'Corporate')
                <!-- <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0"> -->
                <div id="corporate">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Company Information</h4>
                                <hr>

                                <div class="row">

                                    <div class="col-md-12"></div>

                                    <input type="hidden" name="type" value="{{$type}}">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Phone</label>
                                            <input class="form-control" name="phone" type="number" value="{{$phone}}" placeholder="Value *">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email" value="{{$email}}" placeholder="Value *">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>First Name</label>
                                            <input class="form-control" name="first_name" type="text" value="{{$firstname}}" placeholder="Value *">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Last Name</label>
                                            <input class="form-control" name="last_name" type="text" value="{{$lastname}}" placeholder="Value *">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Age</label>
                                            <input class="form-control" name="age" type="number" value="" placeholder="Value *">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value=""></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>PAN</label>
                                                <input class="form-control" name="pan" type="text" placeholder="PAN Value *" id="comm_pan_p" onblur="validatePAN()" maxlength="10" data-check-pan="/check-user-pan">
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



                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Company Name</label>
                                            <input class="form-control" name="company_name" type="text" placeholder="Value *" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Company PAN</label>
                                            <input class="form-control" name="company_pan" id="companyPanNumber" type="text" placeholder="Company PAN Value *" value="" maxlength="10"  data-check-cpan="/check-user-cpan" required>
                                        </div>
                                      
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Company Aadhaar</label>
                                            <input class="form-control" name="company_aadhaar" id="companyAadhaarNumber" type="text" placeholder="Company Aadhaar Value *" value="" required>
                                        </div>
                                        <div id="companyAadhaarErrorMessage" style="color: red;"></div>
                                    </div> -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Company Address</label>
                                            <input class="form-control" name="company_address" type="text" placeholder="Value *" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Company Pincode</label>
                                            <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="company_pincode" onkeyup="find_pincode_c(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Company City</label>
                                            <input type="text" placeholder="Enter City " class="form-control" id="comm_block" name="company_city" readonly value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Company State</label>
                                            <input type="text" placeholder="Enter State " class="form-control" name="company_state" id="comm_state" readonly value="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                @endif
                <!-- </div> -->

                <div class="row card-f-end">
                    <div class="col"><br>
                        <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Create New Entry</button></div><br><br>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
<!-- </div> -->


</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
@include("inc_sanidhya.footer")
<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            // Dynamic Rows Code

            // Get max row id and set new id
            var newid = 0;
            $.each($("#tab_logic tr"), function() {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;

            var tr = $("<tr></tr>", {
                id: "addr" + newid,
                "data-id": newid
            });

            // loop through each td and create new elements with name of newid
            $.each($("#tab_logic tbody tr:nth(0) td"), function() {
                var td;
                var cur_td = $(this);

                var children = cur_td.children();

                // add new td and element if it has a nane
                if ($(this).data("name") !== undefined) {
                    td = $("<td></td>", {
                        "data-name": $(cur_td).data("name")
                    });

                    var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");

                    c.appendTo($(td));
                    td.appendTo($(tr));
                } else {
                    td = $("<td></td>", {
                        'text': $('#tab_logic tr').length
                    }).appendTo($(tr));
                }
            });
            $(tr).appendTo($('#tab_logic'));

            $(tr).find("td button.row-remove").on("click", function() {
                $(this).closest("tr").remove();
            });
        });

        // Sortable Code
        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();

            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });

            return $helper;
        };

        $(".table-sortable tbody").sortable({
            helper: fixHelperModified
        }).disableSelection();

        $(".table-sortable thead").disableSelection();



        $("#add_row").trigger("click");
    });

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
    // avatar pic display on upload
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function() {
            readURL(this);
        });
    });


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
        var cpan = $('input[name="cpan"]');
        var signUpButton = $('button[type="submit"]');

       cpan.blur(function() {
            var input = $(this);
            var url = '{{ route("check.user.cpan") }}'; // Use the named route
            var value = input.val().trim();

            if (value !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { cpan: value },
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

