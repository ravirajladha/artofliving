@include('inc.header')

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
                    <h3>Generate Report</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item active"> <a  href="/reports">Reports</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <form action="/reports_search" method="POST">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form projectcreate">

                                <div class="row">


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Report Type</label>
                                            <select name="type" class="form-select">
                                                <option value="1">Asset Registry Report</option>
                                                <option value="2">Asset Transfer Report</option>
                                                <option value="3">Asset Ticket Report</option>
                                                <option value="4">Asset Incident Report</option>
                                                <option value="5">Asset Audit Report</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Category</label>
                                            <select name="category" class="form-select">
                                                <option value="all">All</option>
                                                <?php foreach($data['category'] as $category){?>
                                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Subcategory</label>
                                            <select name="subcategory" class="form-select">
                                                <option value="all">All</option>
                                                <?php foreach($data['subcategory'] as $subcategory){?>
                                                <option value="<?php echo $subcategory->id; ?>"><?php echo $subcategory->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                {{-- 
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Manager</label>
                                            <select name="manager" class="form-select">
                                                <option value="all">All</option>
                                                <?php //foreach($data['managers'] as $manager){?>
                                                <option value="<?php //echo $manager->id; ?>"><?php //echo $manager->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> --}}

                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>User Type</label>
                                            <select class="form-select" name="user_type" id="user_type" required>
                                                <option value="all">All</option>
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

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Location</label>
                                            <select name="location" class="form-select">
                                                <option value="all">All</option>
                                                <?php foreach($data['locations'] as $location){?>
                                                <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Start Date</label>
                                            <input class="form-control" type="date" required name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">End Date</label>
                                            <input class="form-control" type="date" required name="end_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <div class="col"><br><br>
                                                <div class="text-end">
                                                    <a href="/index" class="btn btn-secondary me-3">Cancel</a>
                                                    <button class="btn btn-secondary me-3" type="submit">Search</button></div>
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
    </form>
    <!-- Container-fluid Ends-->
</div>

@include('inc.footer')

<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>



<script>
    $(".tenure2").hide();

    function find_pincode(pin) {
        if (pin.length == 6) {
            $.ajax({
                url: '/pages/check_pincode',
                type: 'POST',
                data: {
                    pin
                },

                success: function(res) {
                    var detail = res.split(',');
                    document.getElementById("district").value = detail[0];
                    document.getElementById("state").value = detail[1];
                }

            });
        } else {
            document.getElementById("from_city").value = "";
            document.getElementById("from_state").value = "";
        }
    }




    function valueChanged() {
        if ($('#tenure1_check').is(":checked"))
            $(".tenure2").show();
        else
            $(".tenure2").hide();
    }

    $('#user_type').on('change', function() {
        if (this.value == "trustee" || this.value == "apex") {
            document.getElementById("state").style.display = "block";
            document.getElementById("apex_body").style.display = "none";
        } else if (this.value == "ddc" || this.value == "tdc" || this.value == "vdc" || this.value ==
            "accountant" || this.value == "administrator") {
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "block";
        } else {
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "none";
        }
    });
</script>
