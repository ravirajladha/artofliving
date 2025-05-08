@include('inc.header')
<?php $location = $data['get_location']; ?>
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
                     Edit Location</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/locations">All Locations</a></li>
                        <li class="breadcrumb-item active"><a href="#">Edit Location</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="/edit_location" method="POST" enctype="multipart/form-data">
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
                        <label for="exampleInputname1">Location Type</label>
												<select name="type" class="form-select">
                          <option selected disabled>Select a Location Type</option>
												  <option value="project" <?php if($location->type=="project"){echo "selected";}?>>Project</option>
                          <option value="building" <?php if($location->type=="building"){echo "selected";}?>>Building</option>
												</select>
                        </div>
                      </div>

                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Location Name</label>
                            <input class="form-control" type="text" name="name" value="<?php echo $location->name;?>" placeholder="Enter Location Name">
                            <input class="form-control" name="id" value="<?php echo $location->id; ?>" type="hidden" placeholder="Value *" readonly>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Location Address</label>
                            <input class="form-control" type="text" name="address" value="<?php  echo $location->address;?>"  placeholder="Enter Address">
                          </div>
                        </div>
                        </div>

                      <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Location Lat Lon</label>
                            <input class="form-control" type="text" name="latlon" value="<?php echo $location->latlon;?>"  placeholder="Enter Lat Lon">
                          </div>
                        </div>
                        </div>
                      </div>
</div>

<div class="row">

                      <div class="col-sm-4">
                        <div class="mb-3">
                        <label>Pincode</label>
                        <input type="number" class="form-control" placeholder="Enter Pincode" name="pincode" id="pincode"  value="<?php echo $location->pincode;?>"  onkeyup="find_pincode(this.value)">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3">
                        <label>District</label>
                          <input class="form-control" type="text" name="district" id="district" placeholder="" value="<?php echo $location->district;?>"  readonly>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="mb-3">
                        <label>State</label>
                          <input class="form-control" type="text" name="state" id="state"  value="<?php echo $location->state;?>"  placeholder="" readonly>
                        </div>
                      </div>

                    </div>





                      <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <a href="/locations" class="btn btn-secondary me-3">Cancel</a>
                            <button class="btn btn-secondary me-3" type="submit">Update</button></div>
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
      function find_pincode(pin){
				if(pin.length==6){
					$.ajax({
					url  : '/pages/check_pincode',
					type : 'POST',
					data : {pin},

					success : function(res)
					{
						var detail = res.split(',');
						document.getElementById("district").value = detail[0];
						document.getElementById("state").value = detail[1];
					}

				});
				}else {
					document.getElementById("from_city").value = "";
						document.getElementById("from_state").value = "";
				}
			}




          function valueChanged()
          {
              if($('#tenure1_check').is(":checked"))
                  $(".tenure2").show();
              else
                  $(".tenure2").hide();
          }

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
    </script>
