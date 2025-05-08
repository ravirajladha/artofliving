@include('inc.header')

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Send Response</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/pages/index">                                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Send Response</li>
                  </ol>
                </div>
              </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
              <div class="email-wrap">
                <div class="row">
                
                  <div class="col-xl-12 box-col-12 col-md-12 xl-100">
                    <div class="email-right-aside">
                      <div class="card email-body">
                        <div class="email-profile">                                  
                          <div class="email-body">                                        
                            <div class="email-compose">
                             
                              <div class="email-wrapper">
                                <form class="theme-form" action="/pages/create_ticket_response/<?php echo $data['ticket_id']; ?>" method="POST" enctype="multipart/form-data">
                               
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Upload Document</label>
                                    <input class="form-control" id="exampleInputPassword1" type="file" name="document">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Remark</label>
                                    <input class="form-control" id="exampleInputPassword1" type="text" name="response_remark">
                                  </div>
                                
                                  <div class="action-wrapper">
                                  <ul class="actions">
                                    <li><button class="btn btn-secondary" type="submit"><i class="fa fa-paper-plane me-2"></i>send                                                   </button></li>
                                    
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
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>
        </div>
        @include('inc.footer')
