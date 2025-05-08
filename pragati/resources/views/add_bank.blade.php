@include('inc.header')
<link rel="stylesheet" type="text/css" href="assets/css/vendors/select2.css">

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
                        Add Bank</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Add Bank</li>
                    </ol>
                    <br>
                    <ol class="breadcrumb">

                        {{-- <li class="breadcrumb-item"><a href="/assets/pragati_upload_user.csv" download="pragati_upload_user.csv">Download File</a></li> --}}

                        <li class="breadcrumb-item"><a href="/upload_banks"> Upload Banks</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <form action="/create_bank" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form theme-form projectcreate">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Select Apex Body</label>
                                                <select class="form-select" name="apex_body">
                                                    <option selected disabled>Select an Apex Body</option>
                                                    <?php foreach($data['apex_bodies'] as $apex_body){
                            ?>
                                                    <option value="<?php echo $apex_body->id; ?>"><?php echo $apex_body->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputname1">Assign Accountant</label>
                                            <select name="accountant" class="js-example-placeholder-multiple col-sm-12"
                                                style="height:200px !important">
                                                <option selected disabled>Select an Accountant</option>
                                                <?php foreach($data['all_apex'] as $apex){?>
                                                <option value="<?php echo $apex->id; ?>"><?php echo $apex->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Account Name</label>
                                                <input class="form-control" type="text" name="account_name"
                                                    placeholder="Enter Account Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Account Number</label>
                                                <input class="form-control" type="number" name="account_number"
                                                    placeholder="Enter Account Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>IFSC Code</label>
                                                <input class="form-control" type="text" name="ifsc_code"
                                                    placeholder="Enter IFSC Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Customer ID</label>
                                                <input class="form-control" type="text" name="customer_id"
                                                    placeholder="Enter Customer ID">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Home Branch Address</label>
                                                <input class="form-control" type="text" name="home_branch_address"
                                                    placeholder="Enter Branch Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Account Opening Date</label>
                                                <input required class="form-control" type="date"
                                                    name="account_opening_date" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Authorized Signatory</label>
                                                <input class="form-control" type="text" name="authorized_signatory"
                                                    placeholder="Enter Authorized Signatory">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Upload Signature Card</label>
                                                <input class="form-control" type="file" placeholder=""
                                                    name="signature_card">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button class="btn btn-secondary me-3"
                                                type="submit">Add</button></div>
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




<script>
    $(".tenure2").hide();

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




    function valueChanged() {
        if ($('#tenure1_check').is(":checked"))
            $(".tenure2").show();
        else
            $(".tenure2").hide();
    }
</script>
