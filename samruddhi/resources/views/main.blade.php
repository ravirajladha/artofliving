@include('inc.header')


<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
​
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
                  <h3>Asset Main</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index">                                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Asset Main</li>
                  
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
​
​
 
            
      
          <div class="container-fluid general-widget">
​
​
​
          <div class="row">


          <div class="col-sm-12">
                <div class="card">
                  <div class="card-body"><h5 style="font-weight:bold;font-size:16px">Add Category</h5><hr>
                    <div class="form theme-form projectcreate">
                    <form action="/create_category" method="POST"> 
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Category Name</label> 
                            <input class="form-control" type="text" name="name" placeholder="Enter Category Name *" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3">Add</button></div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>


            


              <div class="col-sm-12">
                <div class="card">
                <div class="card-body"><h5 style="font-weight:bold;font-size:16px">Add Sub-Category</h5><hr>
                    <div class="form theme-form projectcreate">
                    <form action="/create_subcategory" method="POST">
                      @csrf
                      <div class="row">
​
                      <div class="col-md-6">
                          <div class="mb-3">
                            <label>Select Category</label>
                            <select class="form-select" name="category_id">
                            <?php foreach($data['category'] as $category){?>
                            <option value="<?php echo $category->id;?>"><?php echo $category->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
​
                        
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Sub-Category Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Sub Category Name *" required>
                          </div>
                        </div>
                       
							          </div>
                        <div class="row">
                                    <div class="col">
                                    <div class="mb-3">
                                    <label for="exampleInutname1">Assign Fields</label>
                                    <select name="fields[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
                                    <?php foreach($data['fields'] as $field){
                                     if($field->COLUMN_NAME != "id" && $field->COLUMN_NAME != "type" && $field->COLUMN_NAME != "category_id" && $field->COLUMN_NAME != "subcategory_id" && $field->COLUMN_NAME != "image" && $field->COLUMN_NAME != "user_id" && $field->COLUMN_NAME != "owner_id" && $field->COLUMN_NAME != "temp_id" && $field->COLUMN_NAME != "datetime" && $field->COLUMN_NAME != "code" && $field->COLUMN_NAME != "code" && $field->COLUMN_NAME != "name" && $field->COLUMN_NAME != "qr"){
                                    ?>
                                    <option value="<?php echo $field->COLUMN_NAME;?>"><?php echo $field->COLUMN_NAME; ?></option>
                                    <?php }} ?>
                                    </select> 
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col">
                                    <div class="mb-3">
                                    <label for="">Assign Compliances</label>
                                    <select name="compliances[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
                                    <?php foreach($data['compliances'] as $compliance){?>
                                    <option value="<?php echo $compliance->id;?>"><?php echo $compliance->name; ?></option>
                                    <?php } ?>
                                    </select> 
                                      </div>
                                    </div>
                                  </div>
                        <div class="col-md-12">
                                      <div class="mb-3" style="text-align:right">
                                      <label><span style="color:#fff">.</span></label>
                          <button type="submit" class="btn btn-secondary me-3">Add</button>
                                      </div>
                                    </div>
                                
                                
            ​
​
                    </form>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-sm-12">
                <div class="card">
                <div class="card-body"><h5 style="font-weight:bold;font-size:16px">Add Compliance</h5><hr>
                    <div class="form theme-form projectcreate">
                    <form action="/create_compliance" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Compliance Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Compliance Name *" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3">Add</button></div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
           
                                  
                                  
                             
​<!--
​
            <div class="row">
                
        
              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body"> 
                        <h5 class="mb-0">Details</h5>
                      </div>
                   
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table table-bordernone">
                        <thead> 
                          <tr> 
                            <th> <span>Category</span></th>
                            <th> <span>Sub Category</span></th>
                            <th style="max-width:60px"> <span>Compliances</span></th>
                          </tr>
                        </thead>
                        <tbody> 
                        {{-- <?php // foreach($data['category'] as $category){
                       // $subcategory = $pageMod->get_cat_subcategory($category->id);
                        // $count = 0;
                       // foreach($subcategory as $subcat){
                          //$count ++;
                        ?> --}}
                          <tr>
                            <td> <h4><?php //if($count == 1){echo $category->name;} ?></h4> </td>
                            <td> <h5><?php //echo $subcat->name; ?></h5> </td>
                            <td> 
                              
                            <div class="">
                        <div class="card-header pb-0">
                          <h5 class="mb-0">
                            <button class="btn btn-xs btn-primary" data-bs-toggle="collapse" data-bs-target="#s<?php //echo $subcat->id; ?>" aria-expanded="false" aria-controls="s<?php //echo $subcat->id; ?>">View Compliances</button>
                          </h5>
                        </div>
                        <div class="collapse" id="s<?php //echo $subcat->id; ?>" data-bs-parent="#accordion">
                          
                          <div class="card-body">
                             <ul>
                              {{-- <?php 
                              //$compliances = explode(',',$subcat->compliances);
                              //foreach($compliances as $compliance){ 
                             /// $comp = $pageMod->get_compliance($compliance);
                              ?> --}}
                              <li><?php //echo $comp->name; ?></li>
                              <?php //} ?>
                             </ul>
                          </div>
                        </div>
                      </div> 
                    
                    </td>
                         
                          </tr>
                       <?php //}} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
                              -->
          
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @include('inc.footer')
​
<script src="/assets/js/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2/select2-custom.js"></script>
   
​
 
    <script>
       $(".tenure2").hide();
      function find_pincode(pin){
				if(pin.length==6){
					$.ajax({
					url  : '/check_pincode',
					type : 'POST',
					data : {pin},
​
					success : function(res)
					{
						var detail = res.split(',');
						document.getElementById("district").value = detail[0];
						document.getElementById("state").value = detail[1];
					}
​
				});
				}else {
					document.getElementById("from_city").value = "";
						document.getElementById("from_state").value = "";
				}
			}
​
​
    
​
          function valueChanged()
          {
              if($('#tenure1_check').is(":checked"))   
                  $(".tenure2").show();
              else
                  $(".tenure2").hide();
          }
    
    </script>