@include("inc.header")

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Send Notification</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Send Notification</li>
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
                                <form class="theme-form" action="/add_notification" method="POST" enctype="multipart/form-data" >
                                  @csrf
                        <div class="row">
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="exampleInputname1">User Type</label>
                        <select name="user_type" class="form-select" id="user_type">
                        <option value="apex">Apex Members</option>
                        <option value="administrator">Administrators</option>
                        <option value="accountant">Accountants</option>
                        <option value="ddc">DDC</option>
                        <option value="tdc">TDC</option>
                        <option value="vdc">VDC</option>
                        </select>
                        </div>
                      </div>


                      <div class="col-sm-6" id="state">
                        <div class="mb-3">
                        <label for="exampleInputname1">State</label>
                        <select name="state" class="form-select">
                        <option value="all">All</option>
                        <?php foreach($data['states'] as $state){?>
                        <option value="<?php echo $state->id;?>"><?php echo $state->name; ?></option>
                        <?php } ?>
                        </select>
                        </div>
                      </div>

                      <div class="col-sm-6" id="apex_body" style="display:none">
                        <div class="mb-3">
                        <label for="exampleInputname1">Apex Body</label>
                        <select name="apex_body" class="form-select">
                        <option value="all">All</option>
                        <?php foreach($data['apex_bodies'] as $apex_body){?>
                        <option value="<?php echo $apex_body->id;?>"><?php echo $apex_body->name; ?></option>
                        <?php } ?>
                        </select>
                        </div>
                      </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Notification</label>
                                    <input class="form-control" placeholder="Enter Information" id="exampleInputPassword1" type="text" name="notification">
                                  </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Notification document</label>
                                    <input class="form-control" type="file" name="document">
                                  </div>

                            </div>
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

        @include("inc.footer")



    <script>
      $('#user_type').on('change', function()
        {
            if(this.value == "trustee" || this.value == "apex"){
            document.getElementById("state").style.display = "block";
            document.getElementById("apex_body").style.display = "none";
            } else if(this.value == "ddc" || this.value == "tdc" || this.value == "vdc" || this.value == "accountant" || this.value == "administrator"){
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "block";
            }else {
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "none";
            }
        });
    </script>
