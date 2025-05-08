@include('inc.header')
@php
use App\Models\Apex_bodie;
use App\Models\Qualification;
use App\Models\Profession;
use App\Models\Post;

@endphp

<?php $user=$data['user']; ?>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="page-header-left">
                    <h3></h3>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">User Details</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">


            <div class="col-sm-12 box-col-12">
                  <div class="card">
                    <div class="social-tab row ">

                            <div class="Asset-widgets text-center col-md-3">
                                <img src="/profiles/<?php echo $user->photo ?>" alt="" width="100">
                              </div>


                      <div class="col-md-3">
                       <a class="nav-link btn btn-default" style='color:#333'><i  style="color:#333" class="fa fa-user"></i><?php echo " ".$user->name ?></a>
                    </div>
                    <div class="col-md-3">
                       <a class="nav-link btn btn-default" style='color:#333'><i  style="color:#333" class="fa fa-envelope"></i><?php echo " ".$user->email ?></a>
                    </div>  <div class="col-md-3">
                       <a class="nav-link btn btn-default" style='color:#333'><i  style="color:#333" class="fa fa-phone"></i><?php echo " ".$user->phone ?></a>
                    </div>







                      </ul>

                    </div>
                  </div>
                </div>


<!--
            <div class="row Assetmore">

            <div class="col-md-12 col-sm-12">
                            <div class="card">
                            <div class="card-header card-header-border">
                    <h5> Basic Information</h5>
                  </div>
                              <div class="collapse show" id="collapseicon12" aria-labelledby="collapseicon12" data-parent="#accordion">
                                <div class="card-body social-status filter-cards-view row">




                                  <div class="media col-md-6">
                                    <div class="media-body"><a href="#"><span class="f-w-600 d-block"></span></a>
                                      <p></p>
                                    </div>
                                  </div>






                                </div>
                              </div>
                            </div>
                          </div>
                </div> -->

                <div class="row">

               <div class="col-xl-12">
                   <div class="card">

                     <div class="card-body">
                     <h4>Basic Information</h4><hr>

                        <div class="row">

                         <div class="col-md-6">
                           <div class="mb-3">
                             <label>Alternate Phone</label>
                             <h5><?php echo $user->alternate_phone ?></h5>
                           </div>
                         </div>


                         <div class="col-sm-6">
                         <div class="mb-3">
                         <label>Date of Birth</label>
                         <h5><?php echo $user->birth_date ?></h5>
                         </div>
                       </div>

                     </div>
                         <div class="row">
                         <div class="col-md-6">
                           <div class="mb-3">
                             <label>Address</label>
                             <h5><?php echo $user->address ?></h5>
                           </div>
                         </div>


                         <div class="col-sm-6">
                          <div class="mb-3">
                          <label>Pincode</label>
                          <h5><?php echo $user->pincode ?></h5>
                          </div>
                        </div>

                         <div class="col-sm-6">
                           <div class="mb-3">
                           <label>District</label>
                           <h5><?php echo $user->district ?></h5>
                           </div>
                         </div>

                         <div class="col-sm-6">
                           <div class="mb-3">
                           <label>State</label>
                           <h5><?php echo $user->state ?></h5>
                           </div>
                         </div>

                         <?php if($user->type == 'apex' || $user->type == 'administrator' || $user->type == 'accountant' || $user->type == 'ddc' || $user->type == 'tdc' || $user->type == 'vdc'){
                          $other_post = explode(',', $user->other_post); ?>
                         <div class="col-sm-6">
                           <div class="mb-3">
                           <label>Art Of Living Teacher?</label>
                           <h5><?php echo $user->is_teacher ?></h5>
                           </div>
                         </div>

                         <div class="col-sm-6">
                           <div class="mb-3">
                           <label>Other Post</label>
                           <h5><?php foreach($other_post as $other_post){
                                  echo $other_post." ";
                                  } ?></h5>
                           </div>
                         </div>
                         <?php } ?>

                       </div>







                    </div>




                     </div>
                   </div>

                   <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h4>Professional Information</h4><hr>

                    @if (!empty($user->apexbody))

                    <div class="row">
                        <div class="col">
                        <div class="mb-3">
                        <label for="exampleInputname1">Apex Bodies</label>

                        <?php $apexbody = explode(',', $user->apexbody); ?>

                        <h5>
                            <?php foreach($apexbody as $apexb){
                                // echo $apexb." ";
                                echo Apex_bodie::where("id", $apexb)->first()->value('name');
                              }?>
                      </h5>


                          </div>
                        </div>
                      </div>
                      @endif


                      <div class="row">
                      @if (!empty($user->qualification))

                      <div class="col-md-6 mt-3">
                           <div class="mb-3">
                             <label>Qualification</label>
                             <h5><?php
                            //   echo $user->qualification
                                echo Qualification::where("id", $user->qualification)->first()->value('name');
                             ?></h5>
                           </div>
                         </div>
                         @endif
                         @if (!empty($user->qualification))

                         <div class="col-md-6 mt-3">
                           <div class="mb-3">
                             <label>Profession</label>
                             <h5><?php
                            //  echo $user->profession
                            echo Profession::where("id", $user->profession)->first()->value('name');

                             ?></h5>
                           </div>
                         </div>
@endif

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
                            <h5><?php if(!empty($user->post)){
echo Post::where("id",$user->post)->first()->value('name'); 
                            }
                              ?>
                            
                            </h5>

                          </div>
                        </div>


                      <div class="col-md-6">
                          <div class="mb-3">
                            <label>Status</label>
                            <h5><?php //echo $user->status ?> 
                              @if ($user->status == 1)Active
                            @elseif ($user->status == 2)In Active 
                            @elseif ($user->status == 3)On Hold
                            @elseif ($user->status == 4)Retired 
                                
                            @endif</h5>

                          </div>
                        </div>


                    </div>

                  <hr>
                               <h6>Tenure</h6>
                    {{-- <div class="row">
                        <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                                    <thead>
                                        <tr >
                                        <?php $tenure_from = explode(', ',$user->tenure_from); ?>
                                        <?php $tenure_to = explode(', ',$user->tenure_to); ?>

                                            <th class="text-center">
                                                From <br>
                                                <h5><?php foreach($tenure_from as $tenure_from){
                                                      echo $tenure_from." ";
                                                      }?></h5>
                                            </th>
                                            <th class="text-center">
                                                To <br>
                                                <h5><?php foreach($tenure_to as $tenure_to){
                                                      echo $tenure_to." ";
                                                      }?></h5>
                                            </th>
                                            <th class="text-center">

                                            </th>

                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>

                        </div>


                    </div> --}}
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

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tenure_from = explode(', ',$user->tenure_from);
                                        $elements = explode(',', $tenure_from[0]);
                                        $date_array = array_map('trim', $elements);

                                        $tenure_to = explode(', ',$user->tenure_to);
                                        $elements2 = explode(',', $tenure_to[0]);
                                        $date_array2 = array_map('trim', $elements2);

                                        // print_r($tenure_to);
                                        $tenure_map = array();
                                        foreach ($date_array as $i => $start_date) {
                                            $end_date = $date_array2[$i];
                                            $tenure_map[$start_date] = $end_date;
                                        }
                                        ?>

                                            <?php foreach ($tenure_map as $start_date => $end_date) { ?>
                                        <tr id='addr0' data-id="0" class="hidden">

                                            <td data-name="from">
                                                <input type="date" readonly name='from[]'  placeholder='From' class="form-control" value="<?php echo $start_date;?>"/>
                                            </td>
                                            <td data-name="to">
                                                <input type="date" readonly name='to[]' placeholder='To' class="form-control" value="<?php echo $end_date;?>"/>
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
                </div>
              </div>


              <?php if($user->type == 'apex' || $user->type == 'administrator' || $user->type == 'accountant' || $user->type == 'ddc' || $user->type == 'tdc' || $user->type == 'vdc'){ ?>
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h4>KYC Information</h4><hr>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>1. KYC Document Type</label>
                            <h5><?php echo $user->kyc_type1 ?></h5>

                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="mb-3">
                            <label>
                              <?php if(!empty($user->kyc_document1)){ ?>
                                <a href="/profiles/<?php echo $user->kyc_document1;?>" target="_blank">View Document <i class="fa fa-eye"></i></a>
                              <?php } ?>
                            </label>

                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>2. KYC Document Type</label>

                            <h5><?php echo $user->kyc_type2 ?></h5>

                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="mb-3">
                            <label>
                            <?php if(!empty($user->kyc_document2)){ ?>
                              <a href="/profiles/<?php echo $user->kyc_document2;?>" target="_blank">View Document <i class="fa fa-eye"></i></a>

                              <?php } ?>

                            </label>

                          </div>
                        </div>

                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>

              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                    <h4>Additional Information</h4><hr>



                      <div class="row">

                        <div class="col-sm-12">
                          <div class="mb-3">

                          <h5><?php echo $user->additional_information ?></h5>
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

              </div>


              </div>




          </div>
          </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @include('inc.footer')
        <script>
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





