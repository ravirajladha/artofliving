@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">

<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    border: none;
    margin-top: 5px !important;
  }


</style>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Uploads Transaction Details</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index"> <i data-feather="home"></i></a></li>
            
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="/csvfile/transactions_bulk_upload.csv" download="transactions_bulk_upload.csv" data-bs-original-title="" title="">Download File</a>

            <!-- <li class="breadcrumb-item active"> Add User</li> -->
          
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <form action="/transactions_bulk_upload_data" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>User Upload</label>
                            <input class="form-control" type="file" name="upload"  required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <a href="/" class="btn btn-secondary me-3">Cancel</a>
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
  </div>
</div>
@include("inc_sanidhya.footer")




