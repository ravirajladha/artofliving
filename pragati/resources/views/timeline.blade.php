@include('inc.header')


<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Asset Timeline</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Asset Timeline</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">

                  <div class="card-body">
                    <!-- cd-timeline Start-->
                    <section class="cd-container" id="cd-timeline">
                      <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture bg-primary"><i class="icon-pencil-alt"></i></div>
                        <div class="cd-timeline-content">
                          <h4>Action Name<span class="digits"> </span></h4>
                          <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p><span class="cd-date">Jan <span class="counter digits"> 14</span></span>
                        </div>
                      </div>
                      <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-movie bg-secondary"><i class="icon-video-camera"></i></div>
                        <div class="cd-timeline-content">
                          <h4>Action Name<span class="digits"> </span></h4>
                          <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p><span class="cd-date">Jan <span class="counter digits"> 14</span></span>
                        </div>
                      </div>
                      <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture bg-success"><i class="icon-image"></i></div>
                        <div class="cd-timeline-content">
                          <h4>Action Name<span class="digits"> </span></h4><img class="img-fluid p-t-20" src="../assets/images/banner/1.jpg" alt=""><span class="cd-date">Jan <span class="counter digits">24</span></span>
                        </div>
                      </div>
                      <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-location bg-info"><i class="icon-pulse"></i></div>
                        <div class="cd-timeline-content">
                          <h4>Action Name<span class="digits"> </span></h4>
                          <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p><span class="cd-date">Jan <span class="counter digits"> 14</span></span>
                        </div>
                      </div>
                      <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-location bg-warning"><i class="icon-image"></i></div>
                        <div class="cd-timeline-content">
                          <h4>Action Name<span class="digits"> </span></h4><img class="img-fluid p-t-20" src="../assets/images/banner/3.jpg" alt=""><span class="cd-date">Feb <span class="counter digits">18</span></span>
                        </div>
                      </div>
                      <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                        <div class="cd-timeline-content">
                          <h4>Action Name</h4>
                          <p class="m-0">This is the content of the last section</p><span class="cd-date">Feb <span class="counter digits">26</span></span>
                        </div>
                      </div>
                    </section>
                    <!-- cd-timeline Ends-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid ends                    -->
        </div>
        @include('inc.footer')
