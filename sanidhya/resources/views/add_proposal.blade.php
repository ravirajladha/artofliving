@include("inc_sanidhya.header")

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
                  <h3>Add Proposal</h3> 
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active"> Add Proposal</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
            <form action="add_proposal" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
               
              <div class="col-xl-12">
                  <div class="card">
                  
                    <div class="card-body">
                    <h4>Basic Information</h4><hr> 
                        <!-- <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media">                        
                              <center><img src  ="/assets/images/user/7.jpg" class="avatar img-circle img-thumbnail img-100 rounded-circle" alt="avatar" style="height:100px; width:100px"></center>
                              <div class="media-body">
                               <center> <h5 class="mb-1 f-14 txt-primary">Profile Image</h4></center>
                                <input class="form-control file-upload" name="photo" type="file" placeholder="Value *">
                              </div>
                            </div>
                          </div>
                        </div> -->
                       <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Name of the Program</label>
                            <input class="form-control" name="program_name" type="text" placeholder="Value *">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>State</label>
                            <select class="form-select" name="state">
                            <option selected disabled>Select a State</option>
                           
                            <option value="Karnataka">Karnataka</option>
                            
                           
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Total Number of Programs within the State</label>
                            <input class="form-control" name="no_of_prg_state" type="number" placeholder="Value *">
                          </div>
                        </div>

                       
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Locations</label>
                            <select class="form-select" name="location">
                            <option selected disabled>Select a Location</option>
                           
                            <option value="City">City</option>
                            <option value="Town">Town</option>
                            <option value="Village">Village</option>
                            <option value="Taluka">Taluka</option>
                           
                            </select>
                          </div>
                        </div>

                    </div>
                        <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Upload Budget/Expense Sheet</label>
                            <input class="form-control file-upload" name="expense_sheet" type="file" placeholder="Value">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <!-- <div class="form theme-form Cubiclecreate"> -->
                    <h4>Invite Information</h4><hr> 

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">No of Entry Points</label>
                        <input class="form-control" name="entry_points" type="number" placeholder="Value *"> 
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">No of Exit Points</label>
                        <input class="form-control" name="exit_points" type="number" placeholder="Value *">
                          </div>
                        </div>
                      </div>
                    

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">Platinum</label>
                        <input class="form-control" name="platinum" type="number" placeholder="Value *"> 
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">Gold</label>
                        <input class="form-control" name="gold" type="number" placeholder="Value *">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">Silver</label>
                        <input class="form-control" name="silver" type="number" placeholder="Value *"> 
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">General</label>
                        <input class="form-control" name="general" type="number" placeholder="Value *">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">Reserved Seats for Special Invitees  <br></label>
                        <input class="form-control" name="reserved_seats" type="number" placeholder="Value *"> 
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label>Are seat number pre-decided?</label>
                            <select class="form-select" name="predecided_seat">
                            <option selected disabled>Select an Option</option>
                           
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          
                            </select>
                          </div>
                        </div>
                      </div>

                       

                      <div class="row">
                      <div class="col">
                          <div class="mb-3">
                            <label>Number of Teachers & Volunteers Participating in Organising Committee</label>
                        <input class="form-control" name="no_of_teachers" type="number" placeholder="Value *"> 

                          </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-4">
                        <div class="mb-3">
                        <label for="exampleInputname1">Contacts</label>
                        <input class="form-control" name="phone1" type="number" placeholder="Value *">
                          </div>
                          </div>
                        <div class="col-sm-4">
                        <div class="mb-3">
                        <label for="exampleInputname1"><br></label>
                        <input class="form-control" name="phone2" type="number" placeholder="Value *">
                          </div>
                        
                        </div>
                        <div class="col-sm-4">
                        <div class="mb-3">
                        <label for="exampleInputname1"><br></label>
                        <input class="form-control" name="phone3" type="number" placeholder="Value *">
                          </div>
                        
                        </div>
                        
                  </div>



                        </div>
                    </div>

                    <div class="row card-f-end">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Add</button></div><br><br>
                        </div>
                      </div>
                </div>     
            <!-- </div> -->


            
              </div>  </form>
            </div>
          </div>
        </div>
        @include("inc_sanidhya.footer")
   
<script src="/assets/js/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2/select2-custom.js"></script>
   

 
    <script>
   
   $(document).ready(function() {
    $("#add_row").on("click", function() {
   // Dynamic Rows Code
   
   // Get max row id and set new id
   var newid = 0;
   $.each($("#tab_logic tr"), function() {
       if (parseInt($(this).data("id")) > newid) {
           newid = parseInt($(this).data("id"));
       }
   });
   newid++;
   
   var tr = $("<tr></tr>", {
       id: "addr"+newid,
       "data-id": newid
   });
   
   // loop through each td and create new elements with name of newid
   $.each($("#tab_logic tbody tr:nth(0) td"), function() {
       var td;
       var cur_td = $(this);
       
       var children = cur_td.children();
       
       // add new td and element if it has a nane
       if ($(this).data("name") !== undefined) {
           td = $("<td></td>", {
               "data-name": $(cur_td).data("name")
           });
           
           var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
         
           c.appendTo($(td));
           td.appendTo($(tr));
       } else {
           td = $("<td></td>", {
               'text': $('#tab_logic tr').length
           }).appendTo($(tr));
       }
   });
   
   // add delete button and td
   /*
   $("<td></td>").append(
       $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
           .click(function() {
               $(this).closest("tr").remove();
           })
   ).appendTo($(tr));
   */
   
   // add the new row
   $(tr).appendTo($('#tab_logic'));
   
   $(tr).find("td button.row-remove").on("click", function() {
        $(this).closest("tr").remove();
   });
   });

   // Sortable Code
   var fixHelperModified = function(e, tr) {
       var $originals = tr.children();
       var $helper = tr.clone();
   
       $helper.children().each(function(index) {
           $(this).width($originals.eq(index).width())
       });
       
       return $helper;
   };

   $(".table-sortable tbody").sortable({
       helper: fixHelperModified      
   }).disableSelection();

   $(".table-sortable thead").disableSelection();



   $("#add_row").trigger("click");
   });

   function find_pincode(pin){
				if(pin.length==6){
					$.ajax({
					url  : 'check_pincode',
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
</script>
<script>
  // avatar pic display on uplaod
	$(document).ready(function() {


		var readURL = function(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('.avatar').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}


		$(".file-upload").on('change', function() {
			readURL(this);
		});
	});
</script>