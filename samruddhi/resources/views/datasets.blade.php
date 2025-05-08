@include('inc.header')
<?php $priviliges = session('rexkod_apex_user_priviliges');
$user_priviliges = explode(',',$priviliges);  ?>

<style>
  .mega-title-badge{
    color:#444;
  }
</style>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Data Sets</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item active"> <a  href="#">Datasets</a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">

              <div class="col-sm-12 box-col-12 col-xl-12 col-xxl-12">
                <div class="card height-equal">

                  <div class="card-body">

                      <div class="row">

                        <?php if(in_array(28, $user_priviliges)) {?>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">

                              <a href="/states">
                                <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Apex</h6>
                                <p>Add Apex to Portal</p>
                              </div>

                              </a>
                            </div>
                          </div>
                        </div>
                    <?php } ?>

<!--
                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/districts">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Districts </h6>
                                <p>Add Districts to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>
-->
<?php if(in_array(29, $user_priviliges)) {?>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/document_types">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Document Types</h6>
                                <p>Add Documents to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(in_array(30, $user_priviliges)) {?>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/incident_types">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Incident Types</h6>
                                <p>Add Incidents to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if(in_array(31, $user_priviliges)) {?>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/ticket_types">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Ticket Types</h6>
                                <p>Add Tickets to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>
                    <?php } ?>

<!--
                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/buildings">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Buildings</h6>
                                <p>Add Buildings to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>



                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/cabins">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Cabins</h6>
                                <p>Add Cabins to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>

-->
<!--
                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/main">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Main</h6>
                                <p>Add Main elements to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div> -->

                        <?php if(in_array(32, $user_priviliges)) {?>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/category_ds">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Category</h6>
                                <p>Add Category elements to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>
                        <?php } ?>


                        <?php if(in_array(33, $user_priviliges)) {?>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/subcategory_ds">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Subcategory</h6>
                                <p>Add Subcategory elements to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>
                        <?php } ?>


                        <?php if(in_array(34, $user_priviliges)) {?>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="media p-20">
                            <a href="/compliance_ds">
                              <div class="media-body">
                                <h6 class="mt-0 mega-title-badge">Compliance</h6>
                                <p>Add Compliance elements to Portal</p>
                              </div>
                            </a>
                            </div>
                          </div>
                        </div>
                        <?php } ?>

                        <!--<div class="col-sm-4">-->
                        <!--  <div class="card">-->
                        <!--    <div class="media p-20">-->
                        <!--    <a href="/assign_fields"> -->
                        <!--      <div class="media-body">-->
                        <!--        <h6 class="mt-0 mega-title-badge">Assign Fields</h6>-->
                        <!--        <p>Add Fields elements to Portal</p>-->
                        <!--      </div>-->
                        <!--    </a>-->
                        <!--    </div>-->
                        <!--  </div>-->
                        <!--</div>-->






                      </div>

                  </div>

                </div>
              </div>

            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @include('inc.footer
        ')



