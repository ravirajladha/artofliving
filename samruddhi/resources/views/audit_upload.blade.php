@include('inc.header')


     
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Add Audits</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item "> <a  href="/asset_audits">Asset Audits</a></li>
                  <li class="breadcrumb-item active"> <a  href="#">Audit Bulk Upload</a></li>
                  
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
                    <form action="/upload_audit" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Audit Upload</label>
                            <input class="form-control" type="file" name="upload"  required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <a href="/asset_audits" class="btn btn-secondary me-3">Cancel</a>
                            
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
