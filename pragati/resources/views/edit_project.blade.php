@include("inc.header")

<?php $project = $data['project']; ?>
<link rel="stylesheet" type="text/css" href="extension()/assets/css/vendors/select2.css">

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
                     Edit Project</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Add Project                           </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="/update_project" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <div class="row">

                      <div class="col-sm-12">
                        <div class="mb-3">

                            <label>Select Apex</label>
                            <select class="form-select" name="apex_body">
                            <option selected disabled>Select an Apex</option>
                            <?php foreach($data['apex_bodies'] as $apex_body){ ?>
                            <option value="<?php echo $apex_body->id;?>" {{$apex_body->id === $project->apex_body_id ? 'selected' : '';}}><?php echo $apex_body->name; ?></option>
                            <?php } ?>
                            </select>





                                                {{-- <label for="exampleInputname1">State</label>
												<select name="state" class="form-select">
												<?php foreach($data['states'] as $state){?>
												<option value="<?php echo $state->id;?>" <?php if($state->id == $project->state_id){echo "selected";}?>><?php echo $state->name; ?></option>
												<?php } ?>
												</select> --}}
                        </div>
                      </div>
                    </div>



                      <div class="row">
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Project Name</label>
                            <input class="form-control" type="text" name="project_name" value="<?php echo $project->project_name;?>"  placeholder="Enter Project Name">
                            <input class="form-control" name="id" value="<?php echo $project->id; ?>" type="hidden" placeholder="Value *" readonly>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Project Address</label>
                            <input class="form-control" type="text" name="project_address" value="<?php echo $project->project_address;?>" placeholder="Enter Address">
                          </div>
                        </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Project Start Date</label>
                            <input class="form-control" type="date" name="project_start_date"  value="<?php echo $project->project_start_date;?>" placeholder="">
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Project End Date</label>
                            <input class="form-control" type="date" name="project_end_date" value="<?php echo $project->project_end_date;?>" placeholder="">
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Remarks</label>
                            <input class="form-control" type="text" name="remarks" placeholder="Enter Remarks" value="<?php echo $project->remarks;?>">
                          </div>
                        </div>
                        </div>




                      <div class="row">
                        <div class="col">
                          <div class="text-end"><button class="btn btn-secondary me-3" type="submit">Update</button></div>
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

        @include("inc.footer")

        <script src="extension()/assets/js/select2/select2.full.min.js"></script>
    <script src="extension()/assets/js/select2/select2-custom.js"></script>



    <script>
       $(".tenure2").hide();
       function find_pincode(pin) {
                if (pin.length == 6) {
                $.ajax({
                url: '/pincode/'+pin,
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




          function valueChanged()
          {
              if($('#tenure1_check').is(":checked"))
                  $(".tenure2").show();
              else
                  $(".tenure2").hide();
          }

    </script>
