@include("inc.header")


<?php $user = $data['user'];?>

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
                  <h3>Edit Front Office</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/apex/index">                                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active"> Edit Front Office</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
            <form action="/update_frontoffice" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">

              <div class="col-xl-12">
                  <div class="card">

                    <div class="card-body">
                    <h4>Personal Information</h4><hr>
                        <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media">
                              <center><img class="img-70 rounded-circle" alt="" src="/uploads/<?php echo $user->photo; ?>" ></center>
                              <div class="media-body">
                               <center> <h5 class="mb-1 f-14 txt-primary">Profile Image</h4></center>
                                <input class="form-control" name="photo" type="file" placeholder="Value *">
                              </div>
                            </div>
                          </div>
                        </div>
                       <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Name</label>
                            <input class="form-control" name="name" value="<?php echo $user->name; ?>" type="text" placeholder="Value *" @if (!in_array(Session::get('rexkod_apex_user_type'), ['hq', 'director', 'coordinator'])) readonly @endif>
                            <input class="form-control" name="id" value="<?php echo $user->id; ?>" type="hidden" placeholder="Value *" readonly>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" value="<?php echo $user->email; ?>" placeholder="Value *" @if (!in_array(Session::get('rexkod_apex_user_type'), ['hq', 'director', 'coordinator'])) readonly @endif>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Phone</label>
                            <input class="form-control" name="phone" type="number" placeholder="Value *" value="<?php echo $user->phone; ?>" @if (!in_array(Session::get('rexkod_apex_user_type'), ['hq', 'director', 'coordinator'])) readonly @endif >
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Alternate Phone</label>
                            <input class="form-control" name="alternate_phone" id="phone1_otp" onkeyup="checkphn(this.value);" oninput="numberOnly(this.id);" maxlength="10" type="number" placeholder="Value *" value="<?php echo $user->alternate_phone; ?>">
                          </div>
                        </div>

                        <!-- <div class="col-md-6">
                          <div class="mb-3">
                            <label>Password</label>
                            <input class="form-control" name="password" type="password" placeholder="Value *">
                          </div>
                        </div> -->

                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" name="birth_date" value="<?php echo $user->birth_date; ?>" placeholder="Select Date" name="pincode">
                        </div>
                      </div>

                    </div>


                        <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Address</label>
                            <input class="form-control" name="address" type="text" value="<?php echo $user->address; ?>" placeholder="Enter Address">
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-sm-4">
                          <div class="mb-3">
                          <label>Pincode</label>
                          <input type="number" class="form-control" value="<?php echo $user->pincode; ?>" placeholder="Enter Pincode" name="pincode" id="pincode" onkeyup="find_pincode(this.value)">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="mb-3">
                          <label>District</label>
                            <input class="form-control" type="text" name="district" id="district" value="<?php echo $user->district; ?>" placeholder="" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="mb-3">
                          <label>State</label>
                            <input class="form-control" type="text" name="state" id="state"  value="<?php echo $user->state; ?>" placeholder="" readonly>
                          </div>
                        </div>

                      </div>
                        <hr>
                        <div class="row">

                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label>Are you Art Of Living Teacher?</label><br>
                          Yes <input onclick="otherpost(1)" class="form-conrol" <?php if($user->is_teacher==1){ echo "checked"; } ?> name="is_teacher" type="radio" value="on" placeholder="Value *">
                          No <input onclick="otherpost(0)" class="form-conrol" name="is_teacher" <?php if($user->is_teacher==0){ echo "checked"; } ?>  type="radio" value="off" placeholder="Value *">
                        </div>
                      </div>

                      <script>
                        function otherpost(val){
                          if(val){
                            document.getElementById( 'other_post' ).style.display = 'block';
                          } else {
                            document.getElementById( 'other_post' ).style.display = 'none';
                          }
                        }
                      </script>


                    <div class="col-md-8" id="other_post" style="display:none">
                        <div class="mb-3">
                          <label>Are you currently holding a responsible post in any of our affiliated entities apart from <br>The Art of Living Trust within the AOL ecosystem?</label>
                          <select class="form-select" name="other_post">
                          <option  disabled>Select Other Post</option>
                            <?php foreach($data['other_posts'] as $other_post){?>
                            <option <?php if($user->other_post == $other_post->id){echo "selected";} ?> value="<?php echo $other_post->id;?>"><?php echo $other_post->name; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>


                   </div>




                    </div>
                  </div>
                </div>

              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h4>Professional Information</h4><hr>
                     <div class="row">
                      <div class="col-sm-12">
                        <div class="col">
                          <div class="mb-3">
                            <label>Apex Body</label>
                            <select class="form-select" name="apex_body">
                            <option selected disabled>Select an Apex Body</option>
                            <?php foreach($data['apex_bodies'] as $apex_body){
                            ?>
                            <option value="<?php echo $apex_body->id;?>" <?php if($apex_body->id == $user->apexbody){echo "selected";}?>><?php echo $apex_body->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      </div>




                      <div class="row">


                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Qualification</label>
                            <select class="form-select" name="qualification">
                            <option selected disabled>Select a Qualification</option>
                            <?php foreach($data['qualifications'] as $qualification){?>
                              <option  <?php if($user->qualification == $qualification->id){echo "selected";} ?> value="<?php echo $qualification->id;?>"><?php echo $qualification->name; ?>
                            <?php } ?>
                            </select>
                          </div>
                        </div>




                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Profession</label>
                            <select class="form-select" name="profession">
                            <option selected disabled>Select a Profession</option>
                            <?php foreach($data['professions'] as $profession){?>
                            <option <?php if($user->profession == $profession->id){echo "selected";} ?> value="<?php echo $profession->id;?>"><?php echo $profession->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>




                    </div>






                    </div>
                  </div>
                            </div>

              </div>


              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h4>Official Information</h4><hr>



                      <div class="row">

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Post</label>
                            <select class="form-select" name="post">
                            <option selected disabled>Select a Post</option>
                            <?php foreach($data['posts'] as $post){?>
                            <option <?php if($user->post == $post->id){echo "selected";} ?> value="<?php echo $post->id;?>"><?php echo $post->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>


                      <div class="col-md-6">
                          <div class="mb-3">
                            <label>Status</label>
                            <select class="form-select" name="status">
                            <option <?php if($user->status == 1){echo "selected";} ?> value="1">Active</option>
                              <option <?php if($user->status == 2){echo "selected";} ?> value="2">In Active</option>
                              <option <?php if($user->status == 3){echo "selected";} ?> value="3">On Hold</option>
                              <option <?php if($user->status == 4){echo "selected";} ?> value="4">Retired</option>
                            </select>
                          </div>
                        </div>


                    </div>

                  <hr>
                               <h6>Tenure</h6>
                    <div class="row">
                        <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                                    <thead>
                                        <tr >
                                            <th class="text-center">
                                                From
                                            </th>
                                            <th class="text-center">
                                                To
                                            </th>
                                            <th class="text-center">

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $tenure_from = explode(', ',$user->tenure_from); ?>
                                    <?php $tenure_to = explode(', ',$user->tenure_to);
                                          ?>
                                          <?php foreach(array_combine($tenure_from,$tenure_to) as $element1=>$element2){ ?>
                                        <tr id='addr0' data-id="0" class="hidden">

                                            <td data-name="from">
                                                <input type="date" name='from[]'  placeholder='From' class="form-control" value="<?php echo $element1;?>"/>
                                            </td>



                                            <td data-name="to">
                                                <input type="date" name='to[]' placeholder='To' class="form-control" value="<?php echo $element2;?>"/>
                                            </td>


                                            <td data-name="del">
                                                <button type="button" name="del0" class='btn btn-xs btn-warning row-remove'><span aria-hidden="true">×</span></button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a id="add_row" style="float:right;margin-top:5px;padding:5px 10px" class="btn btn-xs btn-success float-right">Add Tenure</a>
                        </div>


                    </div>



                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h4>KYC Information</h4><hr>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>1. KYC Document Type</label>
                            <select class="form-select" name="kyc_type1">
                              <option selected disabled>Select a Type</option>
                              <option value="Aadhaar Card" <?php if($user->kyc_type1=="Aadhar Card"){echo "selected";} ?>>Aadhaar Card</option>
                              <option value="Pan Card" <?php if($user->kyc_type1=="Pan Card"){echo "selected";} ?>>Pan Card</option>
                              <option value="Passport" <?php if($user->kyc_type1=="Passport"){echo "selected";} ?>>Passport</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="mb-3">
                            <label>Upload Document
                              <?php if(!empty($user->kyc_document1)){ ?>
                              <a href="/profiles/<?php echo $user->kyc_document1;?>" target="_blank"><i class="fa fa-eye"></i></a>
                              <?php } ?>
                            </label>
                            <input class="form-control" name="kyc_document1" type="file">
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>2. KYC Document Type</label>
                            <select class="form-select" name="kyc_type2">
                              <option selected disabled>Select a Type</option>
                              <option value="Aadhaar Card" <?php if($user->kyc_type2=="Aadhar Card"){echo "selected";} ?>>Aadhaar Card</option>
                              <option value="Pan Card" <?php if($user->kyc_type2=="Pan Card"){echo "selected";} ?>>Pan Card</option>
                              <option value="Passport" <?php if($user->kyc_type2=="Passport"){echo "selected";} ?>>Passport</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="mb-3">
                            <label>Upload Document
                            <?php if(!empty($user->kyc_document2)){ ?>
                              <a href="/profiles/<?php echo $user->kyc_document2;?>" target="_blank"><i class="fa fa-eye"></i></a>

                              <?php } ?>

                            </label>
                            <input class="form-control" name="kyc_document2" type="file">
                          </div>
                        </div>

                    </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h4>Additional Information</h4><hr>



                      <div class="row">

                        <div class="col-sm-12">
                          <div class="mb-3">

                           <textarea name="additional_information" id="" cols="30" rows="3" class='form-control' placeholder="Enter Information"><?php echo $user->additional_information; ?></textarea>
                          </div>
                        </div>



                    </div>





                    </div>
                  </div>
                </div><div class="row card-f-end">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Update</button></div><br><br>
                        </div>
                      </div>
              </div>


              </div>  </form>
            </div>
          </div>
        </div>
        @include("inc.footer")

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

    function numberOnly(id) {
    let input = document.getElementById(id);
    let value = input.value;
    if (value.length > input.maxLength) {
      input.value = value.substring(0, input.maxLength);
    }
  }
</script>
