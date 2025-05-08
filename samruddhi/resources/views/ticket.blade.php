<?php namespace App\Http\Controllers; 
use App\Models\Auth;
?>  @include('inc.header')


<?php $ticket = $data['ticket']; 

 $user = Auth::where('id',$ticket->user_id)->first();
?>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Ticket Detail</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
          <li class="breadcrumb-item"> <a href="/tickets">Tickets</a></li>
          <li class="breadcrumb-item active"> <a  href="#">Ticket Detail</a></li>
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
                    <h5>Request</h5><hr>
                  
                                <div class="card-body social-status filter-cards-view row">
                                <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">User</span>
                                      <p><?php if(!empty($ticket->user_id)) { ?> <?php echo $user->name; ?> <?php } ?></p>
                                    </div>
                                  </div>
                                  
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Remark</span>
                                      <p><?php if(!empty($ticket->request_remark)) { ?> <?php echo $ticket->request_remark; ?> <?php } else { ?> No Response Remark Present <?php } ?></p>
                                    </div>
                                  </div>
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Date</span></a>
                                      <p><?php echo date('M jS Y', strtotime($ticket->request_datetime));?></p>
                                    </div>
                                  </div>

                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Ticket Document</span></a>
                                      <?php if (!empty($ticket->document)) { ?>
                                        <a href="/profiles/<?php echo $ticket->document; ?>" target="_BLANK">View Document</a>
                                      <?php } else { ?>
                                        No File Present.
                                      <?php } ?>
                                    </div>
                                  </div>

                                  
                                  
                                 
                                </div>
                              </div>
                            </div>
                          </div>


         
         
                          <div class="col-md-12 col-sm-12">
                            <div class="card">
                            <div class="card-header card-header-border">
                    <h5>Response</h5><hr>
                  
                                <div class="card-body social-status filter-cards-view row">
                                

                                  
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Response</span></a>
                                      <p><?php if (!empty($ticket->response_remark)) { ?> <?php  echo $ticket->response_remark; ?> <?php } else { ?> No Response Remark Present" <?php } ?></p>
                                    </div>
                                  </div>
                                
                                  <div class="media col-md-6">
                                    <div class="media-body"><span class="f-w-600 d-block">Response Document</span></a>
                                      <p> <?php if (!empty($ticket->response_document)) { ?>
                                        <a href="/profiles/<?php echo $ticket->response_document; ?>" target="_BLANK">View Document</a>
                                      <?php } else { ?>
                                        No File Present.
                                      <?php  } ?></p>
                                    </div>
                                  </div>
                                 
                                </div>
                              </div>
                            </div>
                          </div>


         
         
         <?php if(Session('rexkod_apex_user_type')=='admin' || Session('rexkod_apex_user_type')=='owner') { ?>
          <div class="col-xl-12 box-col-12 col-md-12 xl-100">
            <div class="email-right-aside">
              <div class="card email-body">
                <div class="email-profile">
                  <div class="email-body">
                    <div class="email-compose">
                     
                      <div class="email-wrapper">
                      <h4>Send Response</h4><hr>
                        <form class="theme-form" action="/create_ticket_response/<?php echo $data['ticket_id']; ?>" method="POST" enctype="multipart/form-data">
                        @csrf

                          <div class="form-group">
                            <label for="exampleInputPassword1">Upload Document</label>
                            <input class="form-control" id="exampleInputPassword1" type="file" name="document" required>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Remark</label>
                            <input class="form-control" id="exampleInputPassword1" type="text" name="response_remark" required>
                          </div>

                          <div class="action-wrapper">
                            <ul class="actions">
                              <li><button class="btn btn-secondary" type="submit"><i class="fa fa-paper-plane me-2"></i>send </button></li>

                            </ul>
                          </div>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php  } ?>


        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
</div>

@include('inc.footer')
