<?php namespace App\Http\Controllers;
use App\Models\State;
?>
@include('inc.header')
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
                    <h3>Apex Body Updae</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"><a href="datasets">Datasets </a></li>
                        <li class="breadcrumb-item">Apex Body Update</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form projectcreate">
                            <form action="/update_apex_bodies/{{$data['apex_bodies']->id}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Apex Body Name</label>
                                            <input class="form-control" type="text" name="apex_body"
                                                placeholder="Enter Apex Body Name *" value="{{$data['apex_bodies']->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Select State</label>
                                            <select name="state[]" multiple
                                                class="js-example-placeholder-multiple col-sm-12"
                                                style="border:none;height:200px !important">
                                                <?php foreach($data['states'] as $state){?>
                                                <option value="<?php echo $state->id; ?>" @if ($state->id == $data['apex_bodies']->state_id) selected
                                                @endif><?php echo $state->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit"
                                                class="btn btn-secondary me-3">Update</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Container-fluid Ends-->
</div>


@include('inc.footer')


<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">


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
