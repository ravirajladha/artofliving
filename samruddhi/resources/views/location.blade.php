
        @include('inc.header')
       
       {{-- <?php 
        $project  = $data['project'];
        ?> --}}
        
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3><?php echo $data['project']->project_name; ?></h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/pages/index">                                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Project</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="user-profile social-app-profile">
              <div class="row"> 
              
                <!--  user profile first-style start-->
                <div class="col-sm-12 box-col-12">
                  <div class="card">                            
                    <div class="social-tab">
                      <ul class="nav nav-tabs" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-timeline" data-bs-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true"><i data-feather="clock"></i>Timline</a></li>
                        <li class="nav-item"><a class="nav-link" id="top-about" data-bs-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false"><i data-feather="alert-circle"></i>Assets                               </a></li>
                        <li class="nav-item"><a class="nav-link" id="top-friends" data-bs-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false"><i data-feather="users"></i>Users</a></li>
                        <li class="nav-item"><a class="nav-link" id="top-photos" data-bs-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false"><i data-feather="image"></i>Tickets</a></li>
                      </ul>
                     
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-content" id="top-tabContent">
                <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline">
                  <div class="row">
                    <div class="col-xl-12 xl-100 col-md-12 box-col-5">
                      <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc4">
                        <div class="row">
                        
                        <div class="col-xl-3 xl-100 box-col-12">
                      <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc1">
                        <div class="row">
                          <div class="col-xl-12 col-md-12 xl-100 box-col-12">
                            <div class="card">
                              <div class="card-header">
                                <h5 class="p-0">
                                  <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">About Project</button>
                                </h5>
                              </div>
                              <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                                <div class="card-body filter-cards-view">
                                  <div class="filter-view-group"><span class="f-w-600">Field Name:</span>
                                    <p>
                                      In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content
                                    </p>
                                  </div>
                                  <div class="filter-view-group"><span class="f-w-600">Field Name:</span>
                                    <p>
                                      In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content
                                    </p>
                                  </div>
                                  <div class="filter-view-group"><span class="f-w-600">Field Name:</span>
                                    <p>
                                      In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content
                                    </p>
                                  </div>
                                  <div class="filter-view-group"><span class="f-w-600">Field Name:</span>
                                    <p>
                                      In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                         
                        </div>
                      </div>
                    </div>

                          <div class="col-md-12 col-sm-12">
                            <div class="card">
                              <div class="card-header">
                                <h5 class="p-0">
                                  <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon12" aria-expanded="true" aria-controls="collapseicon12">Activity Feed</button>
                                </h5>
                              </div>
                              <div class="collapse show" id="collapseicon12" aria-labelledby="collapseicon12" data-parent="#accordion">
                                <div class="card-body social-status filter-cards-view">
                                  <div class="media"><img class="img-50 rounded-circle m-r-15" src="/assets/images/user/10.jpg" alt="">
                                    <div class="media-body"><a href="user-profile.html"><span class="f-w-600 d-block">Ramesh Kumar</span></a>
                                      <p>Assigned Macbook Pro 2022<a href="javascript:void(0)"> File</a></p><span class="light-span">20 min Ago</span>
                                    </div>
                                  </div>


                                  <div class="media"><img class="img-50 rounded-circle m-r-15" src="/assets/images/user/10.jpg" alt="">
                                    <div class="media-body"><a href="user-profile.html"><span class="f-w-600 d-block">Ramesh Kumar</span></a>
                                      <p>Assigned Macbook Pro 2022<a href="javascript:void(0)"> File</a></p><span class="light-span">20 min Ago</span>
                                    </div>
                                  </div>

                                  <div class="media"><img class="img-50 rounded-circle m-r-15" src="/assets/images/user/10.jpg" alt="">
                                    <div class="media-body"><a href="user-profile.html"><span class="f-w-600 d-block">Ramesh Kumar</span></a>
                                      <p>Assigned Macbook Pro 2022<a href="javascript:void(0)"> File</a></p><span class="light-span">20 min Ago</span>
                                    </div>
                                  </div>

                                  <div class="media"><img class="img-50 rounded-circle m-r-15" src="/assets/images/user/10.jpg" alt="">
                                    <div class="media-body"><a href="user-profile.html"><span class="f-w-600 d-block">Ramesh Kumar</span></a>
                                      <p>Assigned Macbook Pro 2022<a href="javascript:void(0)"> File</a></p><span class="light-span">20 min Ago</span>
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
                <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about">
                  <div class="row">
                   
                    <div class="col-xl-12 xl-100 col-lg-12 col-md-12 box-col-12">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card">
                            <div class="card-header">
                              <h5>Assets</h5>
                            </div>
                            <div class="card-body avatar-showcase pt-0">
                              <div class="pepole-knows">
                                <ul>
                                  <li>
                                    <div class="add-friend text-center"><img class="img-60 img-fluid rounded-circle" alt="" src="/assets/images/user/2.png"><span class="d-block f-w-600">Asset Name</span>
                                      <button class="btn btn-primary btn-xs">View Asset</button>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="add-friend text-center"><img class="img-60 img-fluid rounded-circle" alt="" src="/assets/images/user/3.png"><span class="d-block f-w-600">Asset Name</span>
                                      <button class="btn btn-primary btn-xs">View Asset</button>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="add-friend text-center"><img class="img-60 img-fluid rounded-circle" alt="" src="/assets/images/user/3.jpg"><span class="d-block f-w-600">Asset Name</span>
                                      <button class="btn btn-primary btn-xs">View Asset</button>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="add-friend text-center"><img class="img-60 img-fluid rounded-circle" alt="" src="/assets/images/user/4.jpg"><span class="d-block f-w-600">Asset Name</span>
                                      <button class="btn btn-primary btn-xs">View Asset</button>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="add-friend text-center"><img class="img-60 img-fluid rounded-circle" alt="" src="/assets/images/user/8.jpg"><span class="d-block f-w-600">Asset Name</span>
                                      <button class="btn btn-primary btn-xs">View Asset</button>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="add-friend text-center"><img class="img-60 img-fluid rounded-circle" alt="" src="/assets/images/user/10.jpg"><span class="d-block f-w-600">Asset Name</span>
                                      <button class="btn btn-primary btn-xs">View Asset                                           </button>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  
                  </div>
                </div>
                <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends">
                <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                <div class="card custom-card">
                  <div class="card-header"><img class="img-fluid" src="/assets/images/user-card/1.jpg" alt=""></div>
                  <div class="card-profile"><img class="rounded-circle" src="/assets/images/avtar/3.jpg" alt=""></div>
                  <div class="text-center profile-details"><a href="/pages/user">
                      <h4>Prakash Kumar</h4></a>
                    <h6>Sales Team</h6><br>
                  </div>
                 
                  <div class="card-footer row">
                    <div class="col-6 col-sm-6">
                      <h6>Assets</h6>
                      <h3 class="counter">66</h3>
                    </div>
                    <div class="col-6 col-sm-6">
                      <h6>Tickets</h6>
                      <h3><span class="counter">6</span></h3>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                <div class="card custom-card">
                  <div class="card-header"><img class="img-fluid" src="/assets/images/user-card/1.jpg" alt=""></div>
                  <div class="card-profile"><img class="rounded-circle" src="/assets/images/avtar/3.jpg" alt=""></div>
                  <div class="text-center profile-details"><a href="/pages/user">
                      <h4>Prakash Kumar</h4></a>
                    <h6>Sales Team</h6><br>
                  </div>
                 
                  <div class="card-footer row">
                    <div class="col-6 col-sm-6">
                      <h6>Assets</h6>
                      <h3 class="counter">66</h3>
                    </div>
                    <div class="col-6 col-sm-6">
                      <h6>Tickets</h6>
                      <h3><span class="counter">6</span></h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                <div class="card custom-card">
                  <div class="card-header"><img class="img-fluid" src="/assets/images/user-card/1.jpg" alt=""></div>
                  <div class="card-profile"><img class="rounded-circle" src="/assets/images/avtar/3.jpg" alt=""></div>
                  <div class="text-center profile-details"><a href="/pages/user">
                      <h4>Prakash Kumar</h4></a>
                    <h6>Sales Team</h6><br>
                  </div>
                 
                  <div class="card-footer row">
                    <div class="col-6 col-sm-6">
                      <h6>Assets</h6>
                      <h3 class="counter">66</h3>
                    </div>
                    <div class="col-6 col-sm-6">
                      <h6>Tickets</h6>
                      <h3><span class="counter">6</span></h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                <div class="card custom-card">
                  <div class="card-header"><img class="img-fluid" src="/assets/images/user-card/1.jpg" alt=""></div>
                  <div class="card-profile"><img class="rounded-circle" src="/assets/images/avtar/3.jpg" alt=""></div>
                  <div class="text-center profile-details"><a href="/pages/user">
                      <h4>Prakash Kumar</h4></a>
                    <h6>Sales Team</h6><br>
                  </div>
                 
                  <div class="card-footer row">
                    <div class="col-6 col-sm-6">
                      <h6>Assets</h6>
                      <h3 class="counter">66</h3>
                    </div>
                    <div class="col-6 col-sm-6">
                      <h6>Tickets</h6>
                      <h3><span class="counter">6</span></h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                <div class="card custom-card">
                  <div class="card-header"><img class="img-fluid" src="/assets/images/user-card/1.jpg" alt=""></div>
                  <div class="card-profile"><img class="rounded-circle" src="/assets/images/avtar/3.jpg" alt=""></div>
                  <div class="text-center profile-details"><a href="/pages/user">
                      <h4>Prakash Kumar</h4></a>
                    <h6>Sales Team</h6><br>
                  </div>
                 
                  <div class="card-footer row">
                    <div class="col-6 col-sm-6">
                      <h6>Assets</h6>
                      <h3 class="counter">66</h3>
                    </div>
                    <div class="col-6 col-sm-6">
                      <h6>Tickets</h6>
                      <h3><span class="counter">6</span></h3>
                    </div>
                  </div>
                </div>
              </div>
           
            </div>
                </div>
                <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos">
                  <div class="row">
                  <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body"> 
                        <h5 class="mb-0">Recent Tickets</h5>
                      </div>
                   
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table table-bordernone">
                        <thead> 
                          <tr> 
                            <th> <span>Item</span></th>
                            <th> <span>User</span></th>
                            <th> <span>ID                                     </span></th>
                            <th> <span>Units</span></th>
                            <th> <span>Status</span></th>
                          </tr>
                        </thead>
                        <tbody> 
                          <tr>
                          <td>
                              <div class="media">
                                <div class="square-box me-2"><img class="img-fluid b-r-5" src="/assets/images/dashboard-2/hand-bag.png" alt=""></div>
                                <div class="media-body ps-2">
                                  <div class="avatar-details"><a href="product-page.html">
                                      <h6>Item Name</h6></a><span> Item Type</span></div>
                                </div>
                              </div>
                            </td>
                            <td class="img-content-box">
                              <h6>Ramesh Kumar</h6><span>Bangalore</span>
                            </td>
                            <td>
                              <h6>99</h6>
                            </td>
                            <td> 
                              <h6>10</h6>
                            </td>
                            <td>
                              <div class="badge badge-light-primary">Completed</div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="media">
                                <div class="square-box me-2"><img class="img-fluid b-r-5" src="/assets/images/dashboard-2/hand-bag.png" alt=""></div>
                                <div class="media-body ps-2">
                                  <div class="avatar-details"><a href="product-page.html">
                                      <h6>Item Name</h6></a><span> Item Type</span></div>
                                </div>
                              </div>
                            </td>
                            <td class="img-content-box">
                              <h6>Ramesh Kumar</h6><span>Bangalore</span>
                            </td>
                            <td>
                              <h6>99</h6>
                            </td>
                            <td> 
                              <h6>10</h6>
                            </td>
                            <td>
                              <div class="badge badge-light-secondary">Pending</div>
                            </td>
                          </tr>
                          <tr>
                          <td>
                              <div class="media">
                                <div class="square-box me-2"><img class="img-fluid b-r-5" src="/assets/images/dashboard-2/hand-bag.png" alt=""></div>
                                <div class="media-body ps-2">
                                  <div class="avatar-details"><a href="product-page.html">
                                      <h6>Item Name</h6></a><span> Item Type</span></div>
                                </div>
                              </div>
                            </td>
                            <td class="img-content-box">
                              <h6>Ramesh Kumar</h6><span>Bangalore</span>
                            </td>
                            <td>
                              <h6>99</h6>
                            </td>
                            <td> 
                              <h6>10</h6>
                            </td>
                            <td>
                              <div class="badge badge-light-danger">Rejected</div>
                            </td>
                          </tr>
                          <tr>
                          <td>
                              <div class="media">
                                <div class="square-box me-2"><img class="img-fluid b-r-5" src="/assets/images/dashboard-2/hand-bag.png" alt=""></div>
                                <div class="media-body ps-2">
                                  <div class="avatar-details"><a href="product-page.html">
                                      <h6>Item Name</h6></a><span> Item Type</span></div>
                                </div>
                              </div>
                            </td>
                            <td class="img-content-box">
                              <h6>Ramesh Kumar</h6><span>Bangalore</span>
                            </td>
                            <td>
                              <h6>99</h6>
                            </td>
                            <td> 
                              <h6>10</h6>
                            </td>
                            <td>
                              <div class="badge badge-light-info">In Progress</div>
                            </td>
                          </tr>
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
            <!-- Container-fluid Ends-->
          </div>
        </div>


        @include('inc.footer')
