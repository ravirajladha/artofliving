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
                    <h3>Apex Bodies</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"><a href="datasets">Datasets </a></li>
                        <li class="breadcrumb-item">Apex Bodies</li>

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
                            <form action="/apex_bodies" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Apex Body Name</label>
                                            <input class="form-control" type="text" name="apex_body"
                                                placeholder="Enter Apex Body Name *" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Select State</label>
                                            <select name="state[]" multiple
                                                class="js-example-placeholder-multiple col-sm-12"
                                                style="border:none;height:200px !important">
                                                <?php foreach($data['states'] as $state){?>
                                                <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                          <div class="mb-3">
                            <label>Select Districts</label>
                            <select name="districts[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
                            <?php //foreach($data['districts'] as $district){
                            ?>
                            <option value="<?php //echo $district->id;
                            ?>"><?php //echo $district->name;
                            ?></option>
                            <?php //}
                            ?>
                            </select>
                          </div>
                        </div> -->
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit"
                                                class="btn btn-secondary me-3">Add</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">


            <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                    <div class="card-header card-no-border">
                        <div class="media media-dashboard">
                            <div class="media-body">
                                <h5 class="mb-0">All Apex Bodies</h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th> <span>ID</span></th>
                                        <th> <span>Name</span></th>
                                        <th> <span>States</span></th>
                                        <!-- <th> <span>Districts</span></th> -->
                                        <th> <span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['apex_bodies'] as $apex_body){
                        // $curdistricts = explode(',', $apex_body->districts);
                        $curstates = explode(',', $apex_body->state_id);
                        // $state = $pageMod->get_state($apex_body->state_id);
                        ?>
                                    <tr>
                                        <td>
                                            <h6><?php echo $apex_body->id; ?></h6>
                                        </td>
                                        <td>
                                            <h6><?php if (isset($apex_body->name)) {
                                                echo $apex_body->name;
                                            } ?></h6>
                                        </td>

                                        <td>
                                            <h6>
                                                <?php

                                                $count = 0;
                                                foreach ($curstates as $curstate) {
                                                    $count++;
                                                    $state_name = State::where('id', $curstate)->first();

                                                    if (isset($state_name->name)) {
                                                        if ($count == 1) {
                                                            echo $state_name->name;
                                                        } else {
                                                            echo ', ' . $state_name->name;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </h6>
                                        </td>
                                        <!-- <td> <h6> -->
                                        <?php

                                        // $count = 0;
                                        // foreach($curdistricts as $curdistrict){
                                        // $count++;
                                        // $dist = $pageMod->get_district($curdistrict);
                                        // if($count == 1){
                                        //     echo $dist->name;
                                        // }else {
                                        //     echo ", ".$dist->name;
                                        // }

                                        // }
                                        ?>
                                        <!-- </h6> </td> -->
                                        <td> </td>

                                        <td>

                                            {{-- <?php //if($apex_body->type == 'trustee' || $apex_body->type == 'director' || $apex_body->type == 'coordinator'){ ?> --}}
                                            <?php if(true){ ?>

                                            <a href="/edit_apex/<?php echo $apex_body->id; ?>"><span style="font-size:10px"
                                                    class="pull-right"><button
                                                        style="font-size:12px;margin:2px; padding:2px 5px"
                                                        class="btn btn-xs btn-info"><i class="fa fa-pencil">
                                                        </i></button></span></a>

                                            <?php } ?>


                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
