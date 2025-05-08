<?php namespace App\Http\Controllers; 
use Illuminate\Support\Facades\DB;
use App\Models\Compliances;
?>

@include('inc.header')
<?php $subcategory = $data['subcategory']; ?>
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
                     Edit Subcategory</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="/datasets">Datasets</a></li>
                        <li class="breadcrumb-item"><a href="/subcategory_ds">Subcategory</a></li>
                        <li class="breadcrumb-item active"><a href="#">Edit Subcategory</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="/update_subcategory" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <div class="row">

                      <div class="col-md-12">
                        <div class="col">
                          <div class="mb-3">
                            <label>Category Name</label>
                          <input class="form-control" type="text" name="category_name" value=" <?php echo $data['cat']->name ?>" readonly>
                          </div>
                        </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col">
                          <div class="mb-3">
                            <label>Subcategory Name</label>
                            <input class="form-control" type="text" name="name" value="<?php echo $subcategory->name;?>" placeholder="Enter Compliance Name">
                            <input class="form-control" name="id" value="<?php echo $subcategory->id; ?>" type="hidden" placeholder="Value *" readonly>
                          </div>
                        </div>
                        </div>


                        <div class="row">
                          <div class="col">
                          <div class="mb-3">
                          <label for="exampleInutname1">Assign Fields<?php ($data['fields']);?></label>
                          <select name="fields[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
                          <?php foreach($data['fields'] as $field){
                           if($field->COLUMN_NAME != "id" && $field->COLUMN_NAME != "type" && $field->COLUMN_NAME != "category_id" && $field->COLUMN_NAME != "subcategory_id" && $field->COLUMN_NAME != "image" && $field->COLUMN_NAME != "user_id" && $field->COLUMN_NAME != "owner_id" && $field->COLUMN_NAME != "temp_id" && $field->COLUMN_NAME != "datetime" && $field->COLUMN_NAME != "code" && $field->COLUMN_NAME != "code" && $field->COLUMN_NAME != "name" && $field->COLUMN_NAME != "qr"){
                       
                            $check_flag =0;
                      $selected_fields = explode(',', $subcategory->fields);
                      foreach($selected_fields as $selected_fields){
                        if($selected_fields==$field->COLUMN_NAME){
                          $check_flag = 1;
                        }
                      }
                      ?>
                          <option <?php if($check_flag==1){  echo "selected"; }?> value="<?php echo $field->COLUMN_NAME;?>"><?php echo $field->COLUMN_NAME; ?></option>
                          <?php }
                        } ?>
                          </select>
                            </div>
                          </div>
                        </div>



                          <div class="col">
                            <div class="mb-3">
                            <label for="">Assign Compliances <?php //print_r($data['compliances']); ?> </label> 
                            <select name="compliances[]" multiple class="js-example-placeholder-multiple col-sm-12">
                            <?php foreach($data['compliances'] as $compliance){
                              // 1,2,3,4,5,6,7,8,9
                            $comp = explode(',', $subcategory->compliances);
                            $flag = 0;
                            foreach($comp as $comp){
                              // 4,5,6
                              if($comp==$compliance->id){
                                $flag =1;
                              }
                            }
                            
                           
                              $c = Compliances::where('id',$compliance->id)->first();
                              ?>
                            <option <?php if($flag==1){  echo "selected"; }?> value="<?php echo $c->id;?>"><?php echo $c->name; ?></option>
                            <?php  
                                } ?>
                            </select>

                            <?php 
                            // print_r($comp);
                            // print_r($c);
                            ?>
                            
                              </div>
                            </div>
                          
                        
                       

                      </div>
                </div>
 




                      <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <a href="/subcategory_ds" class="btn btn-secondary me-3">Cancel</a>
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
