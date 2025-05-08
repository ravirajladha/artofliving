@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border: none;
        margin-top: 5px !important;
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
                    <h3>Add User</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/index"><i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="/add_user"> Add User</a></li>
                    </ol>
                    <br>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="/assets/user_upload.csv" download="user_upload.csv">Download File</a></li>

                        <li class="breadcrumb-item"><a href="/add_user_upload"> Upload Users</a></li>
                    </ol>

                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <form action="/add_user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="profile-title" style="margin-bottom:0px;padding-bottom:0px;">
                                        <div class="media-body">
                                            <center><img src="/assets/images/user/7.jpg" class="avatar img-circle img-thumbnail img-100 rounded-circle" alt="avatar" style="height:100px; width:100px"><br>
                                                <h5 class="mb-1 f-14 txt-primary">Upload Profile Image</h5>
                                            </center>
                                            <input class="form-control file-upload" name="photo" type="file" placeholder="Value *">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Select Apex</label>
                                                <select class="form-select" name="state_id"  required>
                                                    <option readonly value="">Select Apex</option>
                                                    <?php foreach ($data['states'] as $state) {
                          ?>
                                                    <option value="<?php echo $state->id; ?>" {{ old('state_id') == <?php echo $state->id; ?> ? 'selected' : '' }}><?php echo $state->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Select Location</label>
                                                <select class="form-select" name="location_id" required>
                                                    <option readonly value="">Select a location</option>
                                                    <?php foreach ($data['locations'] as $location) {
                          ?>
                                                    <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>User Type</label>
                                            <select class="form-select" name="type" id="user_type" required>
                                                <option readonly value="">Select User Type</option>
                                                <option value="itadmin">IT Admin</option>
                                                <option value="apex">Apex Admin</option>
                                                <option value="manager">Manager</option>
                                                <option value="owner">Stock Owner</option>
                                                <option value="auditor">Auditor</option>
                                                <option value="employee">User / Employee</option>
                                                <option value="teacher">Teacher / Project Guide</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6"> 
                                        <div class="mb-3">
                                            <label>Employee ID</label>
                                            <input class="form-control" name="user_id" type="text"
                                            value="{{ old('user_id') }}"
                                                placeholder="Value " >
                                        </div>
                                    </div>

                                    <div class="col-sm-12" id="manager" style="display:none;">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Select Manager</label>
                                                <select class="form-select" name="manager_id" > 
                                                    <option value="" readonly >Select a Manager</option>
                                                    <?php foreach ($data['managers'] as $manager) {
                          ?>
                                                    <option value="<?php echo $manager->id; ?>"><?php echo $manager->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input class="form-control" name="name" type="text"
                                                placeholder="Value *"  value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email" value="{{ old('email') }} "
                                                placeholder="Value *" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Phone</label>
                                            <input class="form-control" name="phone" value="{{ old('phone') }} " id="phone_otp"
                                                onkeyup="checkphn(this.value);" oninput="numberOnly(this.id);"
                                                maxlength="10" type="number" placeholder="Value *" required>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input class="form-control" name="password" type="password" id="password"
                                                placeholder="Value *" required>
                                            <div id="password-strength-status"></div>
                                        </div>
                                    </div> --}}


                                    {{-- <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>User Permission</label>
                                            <select class="form-select" name="permission" id="permission">
                                                <option selected value="0">Restricted</option>
                                                <option value="1">Unrestricted</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                </div>




                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3"></div>

                    <div class="col-xl-9">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="table-responsive">
                                        <table class="display table table-bordernone" >
                                        <thead>
                                        <tr>
                                            
                                            <th>ID</th>
                                            <th>Permissions</th>
                                            <th>Selection
                                            <span><input type="checkbox" name="sample" class="selectall"/></span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach($data['privilege'] as $privilege){ ?>
                                            <tr>
                                                <th><?php echo ucfirst($privilege->id); ?></th>
                                                <th><?php echo ucfirst($privilege->name); ?></th>
                                                <th><input class="form-check-input p-2" type="checkbox" value="<?php echo $privilege->id ?>" name="privilege[]"></th>
                                            </tr>

                                            <?php } ?>

                                            <div>
                                                <h5>Note : Only IT Admin can Create User</h5> <br>
                                                <h5>Note : Only IT Admin & Auditor can Audit Assets</h5> <br>
                                            </div>
                                        </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="row card-f-end"> 
                            <div class="col">

                                 <br><br>
                                <div class="text-end">
                                    <a href="/index" class="btn btn-secondary me-3">Cancel</a>
                                <button type="submit" class="btn btn-secondary me-3"
                                        >Add</button></div><br><br>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@include('inc.footer')

<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>


<script>
    $('#user_type').on('change', function() {
        if (this.value == "employee" || this.value == "teacher") {
            document.getElementById("manager").style.display = "block";
        } else {
            document.getElementById("manager").style.display = "none";
        }
    });

    function readURL(input1) {
        if (input1.files && input1.files[0]) {
            var reader1 = new FileReader();

            reader1.onload = function(e) {
                $('#blah').attr('src', e.target.result).width(100).height(100);
            };

            reader1.readAsDataURL(input1.files[0]);
        }
    }
</script>
<script>
    // avatar pic display on uplaod
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
    }
</script>


<script>

    $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('div input').attr('checked', true);
        } else {
            $('div input').attr('checked', false);
        }
    });
    </script>
