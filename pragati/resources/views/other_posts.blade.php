@include("inc.header")



<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Other Posts</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Other Posts</li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->





          <div class="container-fluid general-widget">



          <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <form action="other_posts" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Post Name</label>
                            <input class="form-control" type="text" name="post" placeholder="Enter Post Name *" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3">Add</button></div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <div class="row">


              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <div class="card-header card-no-border">
                    <div class="media media-dashboard">
                      <div class="media-body">
                        <h5 class="mb-0">All Posts</h5>
                      </div>

                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table table-bordernone">
                        <thead>
                          <tr>
                            <th> <span>ID</span></th>
                            <th> <span>Name</span></th>
                            <th> <span>Action</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data['other_posts'] as $post){?>
                          <tr>
                            <td> <h6><?php echo $post->id; ?></h6> </td>
                            <td> <h6><?php echo $post->name; ?></h6> </td>
                            <td> </td>
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
          <!-- Container-fluid Ends-->
        </div>


        @include("inc.footer")
