<?php namespace App\Http\Controllers; 
use App\Models\Assigns;
use App\Models\Subcategory;
?>
@include('inc.header')

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Search Assets</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active"> Assets</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts         -->
          <div class="container-fluid card">
            <div class="row card-body">
           
              <div class="col-xl-12 xl-100 box-col-7">
                <div class="row">

                <table class="table table-striped" id="basic-1">
                <thead> 
                  <tr> 
                    <th> <span>ID</span></th>
                    <th> <span>Name</span></th>
                    <th> <span>Type</span></th>
                    <th> <span>Sub Category</span></th>
                    <th> <span>Details</span></th>
                    <th> <span>Status</span></th>
                  </tr>
                </thead>
                <tbody> 
                <?php 
                 foreach($data['assets'] as $asset){ 
                 
                 $assign = Assigns::where('asset_id', $asset->id)
                 ->whereIn('status', ['0', '1'])
                 ->first();

                  $subcategory =  Subcategory::where('id',$asset->subcategory_id)->first();

                  if(Session('rexkod_apex_user_type') == "hq" || $asset->owner_id == Session('rexkod_apex_user_id')){
                ?>


                   <tr>
                          <td>
                            <?php echo $asset->id?>
                            </td>
                            <td class="img-content-box">
                            
                              <h6><?php echo $asset->name; ?></h6>
                            </td>
                            <td>
                              <h6><?php echo $asset->type; ?></h6>
                            </td>
                            <td> 
                              <h6><?php echo $subcategory->name; ?></h6>
                            </td>
                            <td>
                              <h6><a class='btn btn-xs btn-success' href="/asset/<?php echo $asset->id; ?>">View</a></h6>
                              <h6><a class='btn btn-xs btn-default' style="background-color:#fff" href="/edit_asset/<?php echo $asset->type; ?>/<?php echo $asset->id; ?>">Edit</a></h6>
                            </td>
                            <td>
                            <?php if($asset->type == "1"){ ?>
                           <?php
                             if($assign){
                             if($assign->status == "1"){
                            ?>
                            <h6 class="font-roboto"><button class="btn btn-xs btn-success" style="padding:2px;font-size:11px" >Assigned</button></h6>
                            <?php } else { ?>
                              <h6 class="font-roboto"><button class="btn btn-xs btn-info" style="padding:2px;font-size:11px" >Pending</button></h6>
                            <?php } } else { ?>
                              <h6 class="font-roboto"><button class="btn btn-xs btn-primary" data-bs-toggle="modal" onclick="assign_asset(<?php echo $asset->id; ?>)" data-bs-target="#exampleModal" style="padding:2px;font-size:11px" >Assign Asset</button></h6>
                            <?php }} else { ?>
                              <h6 class="font-roboto"><button class="btn btn-xs btn-danger" style="padding:2px;font-size:11px" >Immovable Asset</button></h6>
                            <?php } ?>
                            </td>
                          </tr>




                <?php } 
              }  ?> 
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        
        @include('inc.footer')



        <script>
          $('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
});
        </script>










                                <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Assign Asset</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" action="/assign_asset" method="POST">
                                          @csrf
                                          <div class="row g-2">
                                           
                                              <div class="col-md-12">
                                              <label for="exampleInputname1">Select User</label>
                                              <select name="user_id" class="form-select">
                                              <?php foreach($data['users'] as $user){?>
                                              <option value="<?php echo $user->id;?>"><?php echo $user->name; ?></option>
                                              <?php } ?>
                                              </select> 
                                                </div>
                                                
                                              </div>
                                          
                                            <div class="col-md-12 mt-0 m-b-20">
                                              <label for="con-mail">Enter Remark</label>
                                              <input name="remark" class="form-control" id="con-mail" type="text" required="" autocomplete="off">
                                            </div>
                                            <div class="col-md-12 mt-0 m-b-20" style="display:none">
                                              <label for="con-mail">Enter Remark</label>
                                              <input class="form-control" id="asset_id_val" name="asset_id" type="text" autocomplete="off">
                                            </div>
                                          
                                          </div>
                                          <input id="index_var" type="hidden" value="5">
                                          <button class="btn btn-secondary">Assign</button>
                                          
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>



                                <script>
                                  function assign_asset(id){
                                 
                                    $('#asset_id_val').val(id);
                                  }
                                </script>



<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>