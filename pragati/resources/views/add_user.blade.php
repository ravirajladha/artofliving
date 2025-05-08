@include('inc.header')
<link rel="stylesheet" type="text/css" href="assets/css/vendors/select2.css">

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border: none;
        margin-top: 5px !important;
    }
</style>
<style>
    .swal2-popup {
        font-size: 10px !important;
        width: 300px;
    }
</style>
<style>
    #password-strength-status {
        padding: 5px 10px;
        color: #FFFFFF;
        border-radius: 4px;
        margin-top: 5px;
    }

    .medium-password {
        background-color: #b7d60a;
        border: #BBB418 1px solid;
    }

    .weak-password {
        background-color: #ce1d14;
        border: #AA4502 1px solid;
    }

    .strong-password {
        background-color: #12CC1A;
        border: #0FA015 1px solid;
    }
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Add User </h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active"> Add User</li>
                    </ol>
                    <br>
                    <ol class="breadcrumb">

                        {{-- <li class="breadcrumb-item"><a href="/assets/pragati_upload_user.csv" download="pragati_upload_user.csv">Download File</a></li> --}}

                        <li class="breadcrumb-item"><a href="/upload"> Upload Users</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <form action="/create_user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">

                            <div class="card-body">
                                <h4>Personal Information</h4>
                                <hr>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Profile Image</label>
                                            <input class="form-control" name="photo" type="file" placeholder="Value *">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Select Type</label>
                                            <select class="form-select" name="type"
                                                onchange="check_office(this.value)" required>
                                                <option selected disabled>Select a Type</option>
                                                <option value="trustee">Trustee</option>
                                                <option value="coordinator">Coordinator</option>
                                                <option value="director">Director</option>
                                                <option value="apex">Apex Member</option>
                                                <option value="administrator">State Administrator</option>
                                                <option value="accountant">Accountant</option>
                                                <option value="ddc">DDC</option>
                                                <option value="tdc">TDC</option>
                                                <option value="vdc">VDC</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input class="form-control" name="name" type="text"
                                                placeholder="Value *" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email"
                                                placeholder="Value *" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Phone</label>
                                            <input class="form-control" name="phone" id="phone_otp"
                                                onkeyup="checkphn(this.value);" oninput="numberOnly(this.id);"
                                                maxlength="10" type="number" placeholder="Value *" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Alternate Phone</label>
                                            <input class="form-control" name="alternate_phone" id="phone1_otp"
                                                onkeyup="checkphn(this.value);" oninput="numberOnly(this.id);"
                                                maxlength="10" type="number" placeholder="Value *">
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" name="birth_date"
                                                placeholder="Select Date" name="pincode">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Address</label>
                                            <input class="form-control" name="address" type="text"
                                                placeholder="Enter Address">
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label>Pincode</label>
                                            <input type="number" class="form-control" placeholder="Enter Pincode"
                                                name="pincode" id="pincode" onkeyup="find_pincode(this.value)">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label>District</label>
                                            <input class="form-control" type="text" name="district"
                                                id="district" placeholder="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label>State</label>
                                            <input class="form-control" type="text" name="state" id="state"
                                                placeholder="" readonly>
                                        </div>
                                    </div>

                                </div>


                                <div class="row" style="display:none" id="fo1">


                                    <div class="col-sm-12">
                                        <hr>
                                        <div class="mb-3">
                                            <label>Are you Art Of Living Teacher?</label><br>
                                            Yes <input class="form-conrol" name="is_teacher" type="radio"
                                                value="on" placeholder="Value *">
                                            No <input class="form-conrol" name="is_teacher" type="radio"
                                                value="0" placeholder="Value *">
                                        </div>
                                        <hr>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label>Are you currently holding a responsible post in any of our affiliated
                                                entities apart from The Art of Living Trust within the AOL
                                                ecosystem?</label><br>
                                            Yes <input onclick="otherpost(1)" class="form-conrol"
                                                name="is_other_post" type="radio" value="on"
                                                placeholder="Value *">
                                            No <input onclick="otherpost(0)" class="form-conrol" name="is_other_post"
                                                type="radio" value="0" placeholder="Value *">
                                        </div>
                                    </div>

                                    <script>
                                        function otherpost(val) {
                                            if (val) {
                                                document.getElementById('other_post').style.display = 'block';
                                            } else {
                                                document.getElementById('other_post').style.display = 'none';
                                            }
                                        }
                                    </script>


                                    <div class="col-md-12" id="other_post" style="display:none">
                                        <div class="mb-3">
                                            <label>Select Posts</label><br>
                                            <select name="other_post[]" multiple
                                                class="js-example-placeholder-multiple col-sm-12"
                                                style="height:200px !important">
                                                <?php foreach($data['other_posts'] as $other_post){?>
                                                <option value="<?php echo $other_post->id; ?>"><?php echo $other_post->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>





                            </div>




                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form Cubiclecreate">
                                <h4>Professional Information</h4>
                                <hr>

                                <div class="row" id="bo1" style="display:none">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputname1">Assign Apex Bodies</label>
                                            <select name="apexbodies[]" multiple id="apexbody"
                                                class="js-example-placeholder-multiple col-sm-12"
                                                style="height:200px !important">
                                                @foreach ($data['apex_bodies'] as $apex_body)
                                                    <option value="{{ $apex_body->id }}">{{ $apex_body->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="fo2" style="display:none">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputname1">Select an Apex Body</label>
                                            <select name="apexbody" id="apexbody"
                                                class="js-example-placeholder-multiple col-sm-12"
                                                style="height:200px !important">
                                                <option selected disabled>Select an Apex Body</option>
                                                @foreach ($data['apex_bodies'] as $apex_body)
                                                    <option value="{{ $apex_body->id }}">{{ $apex_body->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label>Qualification</label>
                                            <select class="form-select" name="qualification">
                                                <option selected disabled>Select a Qualification</option>
                                                <?php foreach($data['qualifications'] as $qualification){?>
                                                <option value="<?php echo $qualification->id; ?>"><?php echo $qualification->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label>Profession</label>
                                            <select class="form-select" name="profession">
                                                <option selected disabled>Select a Profession</option>
                                                <?php foreach($data['professions'] as $profession){?>
                                                <option value="<?php echo $profession->id; ?>"><?php echo $profession->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>




                                </div>






                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form Cubiclecreate">
                                <h4>Official Information</h4>
                                <hr>



                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label>Post</label>
                                            <select class="form-select" name="post">
                                                <option selected disabled>Select a Post</option>
                                                <?php foreach($data['posts'] as $post){?>
                                                <option value="<?php echo $post->id; ?>"><?php echo $post->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select class="form-select" name="status">
                                                <option value="1">Active</option>
                                                <option value="2">In Active</option>
                                                <option value="3">On Hold</option>
                                                <option value="4">Retired</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <hr>
                                <h6>Tenure</h6>
                                <div class="row">
                                    <div class="container">
                                        <div class="row clearfix">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-bordered table-hover table-sortable"
                                                    id="tab_logic">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                From
                                                            </th>
                                                            <th class="text-center">
                                                                To
                                                            </th>
                                                            <th class="text-center">

                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id='addr0' data-id="0" class="hidden">
                                                            <td data-name="from">
                                                                <input type="date" name='from[]'
                                                                    placeholder='From' class="form-control" />
                                                            </td>
                                                            <td data-name="to">
                                                                <input type="date" name='to[]' placeholder='To'
                                                                    class="form-control" />
                                                            </td>


                                                            <td data-name="del">
                                                                <button type="button" name="del0"
                                                                    class='btn btn-xs btn-warning row-remove'><span
                                                                        aria-hidden="true">×</span></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <a id="add_row" style="float:right;margin-top:5px;padding:5px 10px"
                                            class="btn btn-xs btn-success float-right">Add Tenure</a>
                                    </div>


                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12" style="display:none" id="fo3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form Cubiclecreate">
                                <h4>KYC Information</h4>
                                <hr>



                                <div class="row">



                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>1. KYC Document Type</label>
                                            <select class="form-select" name="kyc_type1">
                                                <option selected disabled>Select a Type</option>
                                                <option value="Aadhaar Card">Aadhaar Card</option>
                                                <option value="Pan Card">Pan Card</option>
                                                <option value="Passport">Passport</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Upload Document</label>
                                            <input class="form-control" name="kyc_document1" type="file">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>2. KYC Document Type</label>
                                            <select class="form-select" name="kyc_type2">
                                                <option selected disabled>Select a Type</option>
                                                <option value="Aadhaar Card">Aadhaar Card</option>
                                                <option value="Pan Card">Pan Card</option>
                                                <option value="Passport">Passport</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Upload Document</label>
                                            <input class="form-control" name="kyc_document2" type="file">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form Cubiclecreate">
                                <h4>Additional Information</h4>
                                <hr>



                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="mb-3">

                                            <textarea name="additional_information" id="" cols="30" rows="3" class='form-control'
                                                placeholder="Enter Information"></textarea>
                                        </div>
                                    </div>



                                </div>





                            </div>
                        </div>
                    </div>
                    <div class="row card-f-end">
                        <div class="col">
                            <div class="text-end"><button type="submit" class="btn btn-secondary me-3"
                                    href="#">Add</button></div><br><br>
                        </div>
                    </div>
                </div>


        </div>
        </form>
    </div>
</div>
</div>
@include('inc.footer')
<script src="assets/js/select2/select2.full.min.js"></script>
<script src="assets/js/select2/select2-custom.js"></script>



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

            // add delete button and td
            /*
            $("<td></td>").append(
                $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                    .click(function() {
                        $(this).closest("tr").remove();
                    })
            ).appendTo($(tr));
            */

            // add the new row
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


    function find_pincode(pin) {
        if (pin.length == 6) {
            $.ajax({
                url: '/pincode/' + pin,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    var detail = res.split(',');
                    document.getElementById("district").value = detail[0];
                    document.getElementById("state").value = detail[1];
                }
            });
        } else {
            document.getElementById("comm_block_p").value = "";
            document.getElementById("comm_state_p").value = "";
        }
    }
</script>

<script>
    $(document).ready(function() {
        $("#password").on('keyup', function() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if ($('#password').val().length < 8) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak (should be atleast 8 characters.)");
            } else {
                if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $(
                        '#password').val().match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html(
                        "Medium (should include alphabets, numbers and special characters or some combination.)"
                        );
                }
            }
        });
    });

    function numberOnly(id) {
        let input = document.getElementById(id);
        let value = input.value;
        if (value.length > input.maxLength) {
            input.value = value.substring(0, input.maxLength);
        }


        // Check if the values are the same
        var phone = $('#phone_otp').val();
        var alternatePhone = $('#phone1_otp').val();

        if (phone.length == 10 && phone === alternatePhone) {
            // Clear the alternate phone input field
            $('#phone1_otp').val('');

            // Show a SweetAlert with a message
            Swal.fire({
                title: 'Alert!',
                text: 'The alternate phone number cannot be the same as the primary phone number.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }

    }
</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(!empty(session()->get('success'))) { ?>
<script type="text/javascript">
    Swal.fire({
        icon: 'success',
        title: '{{ session()->get('success') }}',
        showConfirmButton: false,
        timer: 2000,

    })
</script>
<?php } session()->forget('success'); ?>


<?php if(!empty(session()->get('failed'))) { ?>
<script type="text/javascript">
    Swal.fire({
        icon: 'warning',
        title: '{{ session()->get('failed') }}',
        showConfirmButton: false,
        timer: 2000
    })
</script>
<?php } session()->forget('failed'); ?>


<script>
    function check_office(val) {
        if (val == "trustee" || val == "coordinator" || val == "director") {
            document.getElementById("bo1").style.display = "block";
            document.getElementById("fo1").style.display = "none";
            document.getElementById("fo2").style.display = "none";
            document.getElementById("fo3").style.display = "none";
        } else {
            document.getElementById("bo1").style.display = "none";
            document.getElementById("fo1").style.display = "block";
            document.getElementById("fo2").style.display = "block";
            document.getElementById("fo3").style.display = "block";
        }
    }
</script>
