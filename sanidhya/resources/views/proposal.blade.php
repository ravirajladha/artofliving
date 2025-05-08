@include("inc_sanidhya.header")


<style>
    .footer {
    background-color: #fff;
    -webkit-box-shadow: 0 0 20px rgb(95 94 231 / 7%);
    box-shadow: 0 0 20px rgb(95 94 231 / 7%);
    padding: 15px;
    bottom: 0;
    left: 0;
    margin-left: 0px;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}
</style>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3 style="font-size:20px">Proposal Detail</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Proposal Detail</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="email-wrap">
        <div class="row">

       



        <div class="col-md-12 col-sm-12">
                            <div class="card">
                            <div class="card-header card-header-border">
                    <h6>Basic Information</h6><hr>
                  
                                <div class="card-body social-status filter-cards-view row">
                                <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Program Name</span>
                                      <p><?php echo $data['proposal']->program_name; ?> </p>
                                    </div>
                                  </div>
                                  
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">State</span>
                                      <p><?php echo $data['proposal']->state; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Total Number of Programs within the State</span></a>
                                      <p><?php echo $data['proposal']->no_of_prg_state; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Location</span></a>
                                      <p><?php echo $data['proposal']->location; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600  d-block">Expense Sheet</span></a>
                                      <p><?php echo $data['proposal']->expense_sheet; ?></p>
                                    </div>
                                  </div>

                                  <!-- <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Ticket Document</span></a>
                                     
                                        <a href="" target="_BLANK">View Document</a>
                                      
                                    
                                    </div>
                                  </div> -->

                                  
                                  
                                 
                                </div>
                              </div>
                            </div>
                          </div>


         
         
                          <div class="col-md-12 col-sm-12">
                            <div class="card">
                            <div class="card-header card-header-border">
                            <h6>Invite Information</h6><hr>
                  
                                <div class="card-body social-status filter-cards-view row">
                                

                                  
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">No of Entry Points</span></a>
                                      <p><?php echo $data['proposal']->expense_sheet; ?></p>
                                    </div>
                                  </div>

                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">No of Entry Points</span></a>
                                      <p><?php echo $data['proposal']->expense_sheet; ?></p>
                                    </div>
                                  </div>

                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Platinum</span></a>
                                      <p><?php echo $data['proposal']->platinum; ?></p>
                                    </div>
                                  </div>

                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Gold</span></a>
                                      <p><?php echo $data['proposal']->gold; ?></p>
                                    </div>
                                  </div>

                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Silver</span></a>
                                      <p><?php echo $data['proposal']->silver; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">General</span></a>
                                      <p><?php echo $data['proposal']->general; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Reserved Seats for Special Invitees</span></a>
                                      <p><?php echo $data['proposal']->reserved_seats; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Are seat number pre-decided?</span></a>
                                      <p><?php echo $data['proposal']->predecided_seat; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Number of Teachers & Volunteers Participating in Organising Committee</span></a>
                                      <p><?php echo $data['proposal']->no_of_teachers; ?></p>
                                    </div>
                                  </div>
                                
                                  <!-- <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Response Document</span></a>
                                      <p>
                                        <a href="" target="_BLANK">View Document</a>
                                  
                                     
                                    </div>
                                  </div> -->
                                 
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12 col-sm-12">
                            <div class="card">
                            <div class="card-header card-header-border">
                            <h6>Contact Information</h6><hr>
                  
                                <div class="card-body social-status filter-cards-view row">
                                <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Phone Number 1</span>
                                      <p><?php echo $data['proposal']->phone1; ?> </p>
                                    </div>
                                  </div>
                                  
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Phone Number 2</span>
                                      <p><?php echo $data['proposal']->phone2; ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Phone Number 3</span></a>
                                      <p><?php echo $data['proposal']->phone3; ?></p>
                                    </div>
                                  </div>
                                 
                                  
                                </div>
                              </div>
                            </div>
                          </div>
<?php //if($_SESSION['rexkod_apex_user_type']=="director"){ ?>
                          <div class="col-xl-12 box-col-12 col-md-12 xl-100">
            <div class="email-right-aside">
              <div class="card email-body">
                <div class="email-profile">
                  <div class="email-body">
                    <div class="email-compose">
                    
                      <div class="email-wrapper">  <h4>Event Action</h4><hr>
                      
                          <div class="form-group">
                            <label for="exampleInputPassword1">Upload Document</label>
                            <input class="form-control" id="exampleInputPassword1" type="file" name="document">
                          </div>
                          <div class="form-group"><br>
                            <label for="exampleInputPassword1">Remark</label>
                            <input class="form-control" id="exampleInputPassword1" type="text" name="response_remark">
                          </div>
<br>
                          <div class="action-wrapper">
                            <ul class="actions">
                              <li><a href="add_event"><button class="btn btn-success" type="submit"><i class="fa fa-paper-plane me-2"></i>Approve </button></a></li>
                              <li><a href="all_proposals"><button class="btn btn-warning" type="submit"><i class="fa fa-times me-2"></i>Reject </button></a></li>

                            </ul>
                          </div>
                      

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php //} ?>
        </div>
      </div>
    </div>
  </div>
</div>


@include("inc_sanidhya.footer")

