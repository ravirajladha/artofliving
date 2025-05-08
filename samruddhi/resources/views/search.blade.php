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
                  <h3>
                    Generate Report</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/pages/index">                                      
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Report                        </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="/pages/result" method="POST">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <div class="row">
                      
                     
                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">User Type</label>
                        <select name="user_type" class="form-select" id="user_type">
                        <option value="trustee">Trustee</option>
                        <option value="director">Directors</option>
                        <option value="coordinator">Coordinators</option>
                        <option value="apex">Apex Members</option>
                        <option value="administrator">Administrators</option>
                        <option value="accountant">Accountants</option>
                        <option value="ddc">DDC</option>
                        <option value="tdc">TDC</option>
                        <option value="vdc">VDC</option>
                        </select> 
                        </div>
                      </div>


                      <div class="col-sm-6" id="state">
                        <div class="mb-3">
                        <label for="exampleInputname1">Manager</label>
                        <select name="state" class="form-select">
                        <option value="all">All</option>
                        <?php foreach($data['states'] as $state){?>
                        <option value="<?php  echo $state->id;?>"><?php echo $state->name; ?></option>
                        <?php } ?>
                        </select> 
                        </div>
                      </div>

                      <div class="col-sm-6" id="apex_body" style="display:none">
                        <div class="mb-3">
                        <label for="exampleInputname1">Apex Body</label>
                        <select name="apex_body" class="form-select">
                        <option value="all">All</option>
                        <?php foreach($data['apex_bodies'] as $apex_body){?>
                        <option value="<?php echo $apex_body->id;?>"><?php echo $apex_body->name; ?></option>
                        <?php } ?>
                        </select> 
                        </div>
                      </div>

                      <div class="col-sm-6" id="apex" style="display:none">
                        <div class="mb-3">
                        <label for="exampleInputname1">Apex</label>
                        <select name="apex" class="form-select">
                        <option value="all">All</option>
                        <?php foreach($data['apex'] as $apex){?>
                        <option value="<?php echo $apex->id;?>"><?php echo $apex->name; ?></option>
                        <?php } ?>
                        </select> 
                        </div>
                      </div>

                    </div>

                    


                    <div class="row">
                      
                     
                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">Sub Category</label>
                        <select name="profession" class="form-select">
                          <option value="all">All</option>
                        <?php foreach($data['professions'] as $profession){?>
                        <option value="<?php echo $profession->id;?>"><?php echo $profession->name; ?></option>
                        <?php } ?>
                        </select> 
                        </div>
                      </div>
                   
                      
                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">Assets</label>
                        <select name="post" class="form-select">
                        <option value="all">All</option>
                        <?php foreach($data['posts'] as $post){?>
                        <option value="<?php echo $post->id;?>"><?php echo $post->name; ?></option>
                        <?php } ?>
                        </select> 
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">Qualification</label>
                        <select name="qualification" class="form-select">
                        <option value="all">All</option>
                        <?php foreach($data['qualifications'] as $qualification){?>
                        <option value="<?php echo $qualification->id;?>"><?php echo $qualification->name; ?></option>
                        <?php } ?>
                        </select> 
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                        <div class="col"><br><br>
                          <div class="text-end"><button class="btn btn-secondary me-3" type="submit">Generate</button></div>
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

        $('#user_type').on('change', function()
        {
            if(this.value == "trustee" || this.value == "apex"){
            document.getElementById("state").style.display = "block";
            document.getElementById("apex_body").style.display = "none";
            } else if(this.value == "ddc" || this.value == "tdc" || this.value == "vdc" || this.value == "accountant" || this.value == "administrator"){
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "block";
            }else {
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "none";
            }
        });
    
    </script>