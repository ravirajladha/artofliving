@include('inc.header')
<?php
$user = $data['get_user_detail'];
?>
<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }
</style>
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
                    <h3>
                    <!-- <a href="/users" class="icon-back-right" style="align-items: left; font-size: medium;"> Back </a> <br><br> -->
                    Edit User</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="/users">All Users</a></li>
                        <li class="breadcrumb-item active"><a href="#">Edit User</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <form action="/edit_user" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">

                <div class="row">

                    <div class="col-xl-3">
                        <div class="card">

                            <div class="card-body">

                                <div class="row ">
                                    <div class="profile-title" style="margin-bottom:0px;padding-bottom:0px;">
                                        <div class="media">
                                            <center>
                                                <div class="media-body">
                                                    <?php if (!empty($user->photo)) { ?>
                                                    <center> <img class="img-75 rounded-circle" alt=""
                                                            src="/profiles/<?php echo $user->photo; ?>"
                                                            style="height:90px; width:100px"> </center>
                                                    <?php } else { ?>
                                                    <center> <img class="img-75 rounded-circle" alt=""
                                                            src="/assets/images/user/7.jpg"
                                                            style="height:100px; width:90px"> </center>
                                                    <?php   } ?>

                                                </div>
                                                <br>
                                                <div class="media-body">
                                                    <center>
                                                        <h5 class="mb-1 f-14 txt-primary">Update Profile Image</h5>
                                                    </center>
                                                    <input class="form-control" name="photo" type="file"
                                                        placeholder="Value *">
                                                </div>

                                                <input type="hidden" name="id" value="{{$user->id}}">
                                        </div>


                                    </div>
                                </div>
                                <?php
                                 $type = Session('rexkod_apex_user_type');
                                 $id = Session('rexkod_apex_user_id');
                                ?>

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
                                                <select class="form-select" name="state_id" required>
                                                    <option selected disabled>Select Apex</option>
                                                    <?php foreach ($data['states'] as $state) {
                          ?>
                                                    <option value="<?php echo $state->id; ?>" <?php if ($user->state_id == $state->id) {
                                                        echo 'selected';
                                                    } ?>>
                                                        <?php echo $state->name; ?></option>
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
                                                    <option selected disabled>Select a location</option>
                                                    <?php foreach ($data['locations'] as $location) {
                          ?>
                                                    <option value="<?php echo $location->id; ?>" <?php if ($user->location_id == $location->id) {
                                                        echo 'selected';
                                                    } ?>>
                                                        <?php echo $location->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <?php //if ($user->type == 'hq'){?>
                                        <div class="col-md-6">
                                        <label>User Type</label>
                                        <input class="form-control" name="name" type="text"
                                        value="<?php //echo $user->type; ?>" placeholder="Value *" required>
                                        </div>
                                    <?php //} else { ?> --}}


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>User Type</label>
                                            <select class="form-select" name="type" id="user_type" required>
                                                <option selected disabled>Select User Type</option>
                                                <option value="apex" <?php if ($user->type == 'apex') {
                                                    echo 'selected';
                                                } ?>>Apex Admin</option>
                                                <option value="itadmin" <?php if ($user->type == 'itadmin') {
                                                    echo 'selected';
                                                } ?>>IT Admin</option>
                                                <option value="manager" <?php if ($user->type == 'manager') {
                                                    echo 'selected';
                                                } ?>>Manager</option>
                                                <option value="owner" <?php if ($user->type == 'owner') {
                                                    echo 'selected';
                                                } ?>>Stock Owner</option>
                                                <option value="auditor" <?php if ($user->type == 'auditor') {
                                                    echo 'selected';
                                                } ?>>Auditor</option>
                                                <option value="employee" <?php if ($user->type == 'employee') {
                                                    echo 'selected';
                                                } ?>>User / Employee</option>
                                                <option value="teacher" <?php if ($user->type == 'teacher') {
                                                    echo 'selected';
                                                } ?>>Teacher / Project Guide
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <?php // } ?>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Employee ID</label>
                                            <input class="form-control" name="user_id" type="text"
                                            value="<?php echo $user->user_id; ?>"
                                                placeholder="Value " >
                                        </div>
                                    </div>

                                   <?php if(($user->type == 'employee') ||($user->type == 'teacher')){ ?> 
                                    <div class="col-sm-6" id="manager" >
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Select Manager</label>
                                                <select class="form-select" name="manager_id" required>
                                                    <option selected disabled>Select a Manager</option>
                                                    <?php foreach ($data['managers'] as $manager) {
                          ?>
                                                    <option value="<?php echo $manager->id; ?>" <?php if ($manager->id == $user->manager_id) {
                                                        echo 'selected';
                                                    } ?>>
                                                        <?php echo $manager->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   <?php } ?> 


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input class="form-control" name="name" type="text"
                                                value="<?php echo $user->name; ?>" placeholder="Value *" required>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email"
                                                value="<?php echo $user->email; ?>" placeholder="Value *" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Phone</label>
                                            <input class="form-control" name="phone" type="number"
                                                value="<?php echo $user->phone; ?>" placeholder="Value *" required>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>User Permission</label>
                                            <select class="form-select" name="permission" id="user_type" required>
                                                <option selected value="0" <?php if ($user->permission == '0') {
                                                   // echo 'selected';
                                                } ?>>Restricted</option>
                                                <option value="1" <?php if ($user->permission == '1') {
                                                   // echo 'selected';
                                                } ?>>Unrestricted</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        




                        <div class="card">

                            <div class="card-body">


                                <?php
                                 $type =Session('rexkod_apex_user_type');
                                ?>



                                <div class="row">
                                    



                                     <!-- <div class="col-md-6">
                    <div class="mb-3">
                      <label>Password
                      </label>
                      <input id="password-field" type="password" class="form-control" name="password" placeholder="Avoid filling password, if need not be changed!" readonly>
                      <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                    </div>
                  </div>  -->

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
                                            {{-- <th>Selection</th> --}}

                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $priviliges = $user->privilege;
                                            $user_priviliges = explode(',',$priviliges);  ?>

                                            <?php foreach($data['privilege'] as $privilege){ ?>
                                            <tr>
                                                <th><?php echo ucfirst($privilege->id); ?></th>
                                                <th><?php echo ucfirst($privilege->name); ?></th>
                                                <th><input class="form-check-input p-2" type="checkbox" value="<?php echo $privilege->id ?>" name="privilege[]" <?php  echo (in_array($privilege->id, $user_priviliges)) ? 'checked' : '' ?>></th>



                                            </tr>

                                            <?php } ?>


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
                                <div class="text-end">
                                    <a href="/users" class="btn btn-secondary me-3">Cancel</a>
                                    <button type="submit" class="btn btn-secondary me-3"

                                        href="#">Update</button></div><br><br>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>



</form>
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

    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
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

    $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('div input').attr('checked', true);
        } else {
            $('div input').attr('checked', false);
        }
    });
    </script>
    
