@include('inc.header')


     
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Add Property</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item "> <a  href="/add_property">Add Property</a></li>
                  <li class="breadcrumb-item active"> <a  href="#">Property Bulk Upload</a></li>
                  
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
                    <form action="/upload_property" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Property Upload</label>
                            <input class="form-control" type="file" name="upload"  required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <a href="/add_property" class="btn btn-secondary me-3">Cancel</a>
                            
                            <button type="submit" class="btn btn-secondary me-3">Upload</button></div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <!-- Container-fluid Ends-->

       
        </div>


@include('inc.footer')
