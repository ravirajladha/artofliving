@include('inc.header')
<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges);  ?>
<?php

$pending = 0;
$completed = 0;
$total = 0;
foreach ($data['property'] as $property) {
    $total++;
    if ($property->status == '1') {
        $pending++;
    } elseif ($property->status == '2') {
        $completed++;
    }
}

?>
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Properties</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">All Properties</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <!-- <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">

                  <div class="card-body">
                    <div class="row">
                      <div class="col-xl-4 col-sm-6 box-col-4">
                        <div class="card ecommerce-widget">
                          <div class="card-body support-ticket-font">
                            <div class="row">
                              <div class="col-5"><span>Pending</span>
                                <h3 class="total-num counter"><?php echo $pending; ?></h3>
                              </div>
                              <div class="col-7">
                                <div class="text-end">

                                </div>
                              </div>
                            </div>
                            <div class="progress-showcase">
                              <div class="progress sm-progress-bar">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-sm-6 box-col-4">
                        <div class="card ecommerce-widget">
                          <div class="card-body support-ticket-font">
                            <div class="row">
                              <div class="col-5"><span>Completed</span>
                                <h3 class="total-num counter"><?php echo $completed; ?></h3>
                              </div>
                              <div class="col-7">
                                <div class="text-end">

                                </div>
                              </div>
                            </div>
                            <div class="progress-showcase">
                              <div class="progress sm-progress-bar">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-sm-6 box-col-4">
                        <div class="card ecommerce-widget">
                          <div class="card-body support-ticket-font">
                            <div class="row">
                              <div class="col-5"><span>Total</span>
                                <h3 class="total-num counter"><?php echo $total; ?></h3>
                              </div>
                              <div class="col-7">
                                <div class="text-end">

                                </div>
                              </div>
                            </div>
                            <div class="progress-showcase mt-4">
                              <div class="progress sm-progress-bar">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>-->

    <div class="table-responsive card">

        <style>
            div.scrollmenu {

                overflow: auto;
                white-space: nowrap;
            }

            div.scrollmenu a {

                /* color: white; */
                text-align: center;
                padding: 14px;
                /* text-decoration: none; */
            }

            div.scrollmenu a:hover {
                /* background-color: #777; */
            }
        </style>


        <div class="scrollmenu card-body">
            {{-- <table class="table table-bordernone" id="basic-1" style="width:2000px"> --}}
                <table class="table table-striped" data-order='[[ 0, "desc" ]]' data-page-length='10'>

                <thead>
                    <tr>

                        <th> <span>Id</span></th>
                        <th> <span>Land/Project Name</span></th>
                        <th> <span>Property Category</span></th>
                        <th> <span>Agreement Type</span></th>
                        <th> <span>Other Assests on the property</span></th>
                        <th> <span>Purpose of this property</span></th>
                    <?php if(in_array(12, $user_priviliges) || in_array(13, $user_priviliges)) {?>

                        <th> <span>Action</span></th>
                    <?php } ?>


                        <!-- <th> <span>Google Coordinates</span></th>
                            <th> <span>Dimensions</span></th>
                            <th> <span>Area</span></th>
                            <th> <span>Metrics</span></th>
                            <th> <span>Purchase / Contract Start Date</span></th>
                            <th> <span>Renewal Date</span></th>
                            <th> <span>Cost/Rental (Annual)/Lease (Amount)</span></th>
                            <th> <span>FMV (Fair Market Value)</span></th>
                            <th> <span>Previous Owner/Landlord Name</span></th>
                            <th> <span>Previous Owner/Landlord Contact</span></th>
                            <th> <span>Laising Advocate Name</span></th>
                            <th> <span>Laising Advocate Contact</span></th>
                            <th> <span>Registeration Number</span></th>
                            <th> <span>TVC - Title Verification Certificate & Due Deligience </span></th>
                            <th> <span>Khata</span></th>
                            <th> <span>Patta</span></th>
                            <th> <span>Encumburance</span></th>
                            <th> <span>Survey Sketch</span></th>
                            <th> <span>Soil Test</span></th>
                            <th> <span>Electricity Clearance</span></th>
                            <th> <span>Construction Approval</span></th>
                            <th> <span>Taxation Clearnace</span></th>
                            <th> <span>Forest Clearnance</span></th>
                            <th> <span>Court Documents </span></th>
                            <th> <span>>Overall Legal Clearnace</span></th>
                            <th> <span>Trust Resolutions/SPOA</span></th>
                            <th> <span>Original Recevied at HO</span></th>
                            <th> <span>Photo/Videos notes</span></th>
                            <th> <span>Photo/Videos</span></th>
                            <th> <span>Others notes</span></th>
                            <th> <span>Others</span></th>
                            -->
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($data['property'] as $property){

                           $user = App\Models\Auth::where('id',$property->user_id)->first();
                           $asset = App\Models\Assets::where('id',$property->asset_id)->first();
                           //$building = App\Models\Assets::where('id',$user->location_id)->first();
                           //if($user->type == "manager" || $_SESSION['rexkod_apex_user_type'] == "hq"){
                          ?>
                    <tr>
                        <td style="text-align:center;">

                            <h6><?php echo $property->id; ?></h6>

                        </td>
                        <td style="text-align:center;">

                            <h6><?php echo $property->name; ?></h6>

                        </td>
                        <td style="text-align:center;">

                            <h6><?php echo $property->category; ?></h6>

                        </td>
                        <td style="text-align:center;">

                            <h6><?php echo $property->agreement_type; ?></h6>

                        </td>
                        <td style="text-align:center;">

                            <h6><?php echo $property->other_assests_on_property; ?></h6>

                        </td>
                        <td style="text-align:center;">

                            <h6><?php echo $property->purpose_of_this_property; ?></h6>

                        </td>

                    <?php if(in_array(12, $user_priviliges) || in_array(13, $user_priviliges)) {?>

                        <td style="text-align:center;">

                            <div class="row card-f-end">
                                <div class="col">
                                    <div class="text-end">

                                        <?php if(in_array(12, $user_priviliges)) {?>


                                        <a href="/property/<?php echo $property->id; ?>">
                                        <button title="View" style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-success">
                                            <i class='fa fa-eye'></i></button></a>
                    <?php } ?>


                                            <?php if(in_array(13, $user_priviliges)) {?>

                                        <a href="/edit_property/<?php echo $property->id; ?>"><button title="Edit"
                                                style="font-size:12px;padding:2px 5px" class="btn btn-xs btn-info"><i
                                                    class='fa fa-pencil'></i></button></a>
                    <?php } ?>



                                    </div><br><br>
                                </div>
                            </div>
                        </td>

                        <?php } ?>



        {{-- </div> --}}


        <!--     <td style="text-align:center;">

                                <h6 ><?php echo $property->pincode; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->district; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->state; ?></h6>

                            </td> -->
        <!-- <td style="text-align:center;">

                                <h6 ><?php echo $property->coordinates; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->dimensions; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->area; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->metrics; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->purchase; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->renew_date; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->cost; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->fmv; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->previous_owner; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->previous_owner_phn; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->laising_advocate_name; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->laising_advocate_phn; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->reg_number; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->tvc; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->khata; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->patta; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->encumburance; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->survey_sketch; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->soil_test; ?>" target="_BLANK">View</a></h6>

                            </td>

                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->electrical_cls; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6> <a href="/uploads/<?php echo $property->construction_approval; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->tax_cls; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->forest_cls; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->overall_legal_cls; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->trust_resolution; ?>" target="_BLANK">View</a></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->original_received_at_ho; ?>" target="_BLANK">View</a></h6>

                            </td>

                            <td style="text-align:center;">

                                <h6 ><?php echo $property->photos_and_video_notes; ?></h6>

                            </td>


                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->photos_and_videos; ?>" target="_BLANK">View</a></h6>

                            </td>

                            <td style="text-align:center;">

                                <h6 ><?php echo $property->other_notes; ?></h6>

                            </td>

                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->other_files; ?>" target="_BLANK">View</a></h6>
                              -->
        <!-- </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->name; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->name; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->name; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><?php echo $property->name; ?></h6>

                            </td>
                             <td style="text-align:center;">

                                <h6 ><a href="/uploads/<?php echo $property->document; ?>" target="_BLANK">View</a> </h6>

                            </td>






                            <td class="img-content-box">
                              <h6><?php //echo $user->name;
                              ?></h6><span><?php //echo $building->name;
                              ?></span>
                            </td>
                            <td>
                              <h6><?php echo $property->request_remark; ?></h6>
                            </td>
                            <td>
                              <h6><?php echo date('M jS Y - h:m A', strtotime($property->request_datetime)); ?></h6>
                            </td>
                            <td>
                              <?php if($property->document){ ?>
                              <h6><a href="/uploads/<?php echo $property->document; ?>" target="_BLANK">View</a></h6>
                              <?php } ?>
                            </td>
                            <td>
                              <h6><?php echo $property->response_remark; ?></h6>
                            </td>
                            <td>
                              <?php if($property->response_document){ ?>
                              <h6><a href="/uploads/<?php echo $property->response_document; ?>" target="_BLANK">View</a></h6>
                              <?php } ?>
                            </td>
                            <td>
                            <?php if($property->status == 1){ ?>
                            <a href="/pages/ticket_response/<?php echo $property->id; ?>"><div class="badge badge-light-success">Send Response</div></a>
                            <?php } else { ?>
                             <div class="badge badge-light-info">Responded</div>
                            <?php } ?>
                            </td> -->
        </tr>
        <?php }?>

        </tbody>
        </table>
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


<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
{{-- =================================== import and export table data =================================== --}}
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.12.1/css/dataTables.responsive.css">
<script type="text/javascript" src="//cdn.datatables.net/responsive/1.12.1/js/dataTables.responsive.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
{{-- =================================== import and export table data =================================== --}}
