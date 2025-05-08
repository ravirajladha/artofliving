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
                     Add Property Audit</h3>
                </div>
                <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Add Property Audit</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="/add_property_audit" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <div class="row">
                    <div class="col-md-3">
                        <div class="col">
                        <div class="mb-3">
                        <label>Select Location</label>
                        <?php  $location_id = $data['location_id']; ?>
                        <select class="form-select" name="location_id" class="form-control" id="location_id" oninput="location_url(this.value)" required>
                          <option readonly value="">Select a location</option>
                          <?php foreach ($data['locations'] as $location) {
                          ?>
                            <option value="<?php echo $location->id; ?>" <?php if($location_id==$location->id){echo "selected";} ?>><?php echo $location->name; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                        </div>
                        </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                        <label for="exampleInputname1">Assign Auditor</label>
												<select name="auditor_id" class="form-select" required>
                          <option readonly value="">Select an Auditor</option>
                          <?php foreach($data['get_users'] as $all_auditor){ ?>
												  <option value="<?php echo $all_auditor->id; ?>"><?php echo ucwords($all_auditor->name); ?></option>
                          <?php } ?>
												</select> 
                        </div>
                      </div>
                  
                        <div class="col-md-3">
                        <div class="col">
                          <div class="mb-3">
                            <label>Start Date</label>
                            <input class="form-control" type="date" name="start_date"  required>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="col">
                          <div class="mb-3">
                            <label>End Date</label>
                            <input class="form-control" type="date" name="end_date"  required>
                          </div>
                        </div>
                        </div>
                    
                    
                      </div>
</div>
                  
                    </div>
                  </div>
                </div>
              </div>

              <div class="container-fluid card">
              <div class="row card-body">
           
              <div class="col-xl-12 xl-100 box-col-7">
                <div class="row">

                <table class="table table-striped" id="basic-1">
                <thead> 
                  <tr> 
                    <th> <span><input type="checkbox" name="sample" class="selectall"/> </span></th>
                    <th> <span>ID</span></th>
                    <th> <span>Name</span></th>
                    <th> <span>Category</span></th>
                    <th> <span>State</span></th>
                
                  
                  </tr>
                </thead>
                <tbody> 
                <?php 
                // $pageMod = new Page;

                 foreach($data['get_all_properties'] as $property){ 
              
                ?>
                   <tr>
                          <td>
                          <input  type="checkbox" name="property_id[]"  value="<?php echo $property->id; ?>">
                            </td>
                          <td>
                            <?php echo $property->id?>
                            </td>
                            <td class="img-content-box">
                            
                              <h6><?php echo ucwords($property->name); ?></h6>
                            </td>
                            <td>
                              <h6><?php echo $property->category; ?></h6>
                            </td>
                            <td> 
                              <h6><?php echo $property->state; ?></h6>
                            </td>
                        
                            
                           
                          </tr>




                <?php }  ?> 
                  </tbody>
                  </table>
                </div>
              </div>
              
            </div>
            
            </div>
    
            <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <a href="/index" class="btn btn-secondary me-3">Cancel</a>
                            <button class="btn btn-secondary me-3" type="submit">Create Audit</button></div>
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
					url  : '/check_pincode',
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

<script>
	function location_url(location_id){
		window.location.href = '/add_property_audit/' + location_id;
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
