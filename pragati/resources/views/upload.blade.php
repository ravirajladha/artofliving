@include('inc.header')


<style>
  .mega-title-badge{
    color:#444;
  }
</style>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Upload Users</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Upload</li>
                  </ol>
                  <br>
                  <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="/assets/pragati_upload_user.csv" download="pragati_upload_user.csv">Download File</a></li>
                    {{-- <li class="breadcrumb-item"><a href="/add_user_upload"> Upload Users</a></li> --}}
                </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">

              <div class="col-sm-12 box-col-12 col-xl-12 col-xxl-6">
                <div class="card height-equal">

                <div class="card-body">
                                <div class="basic-form custom_file_input">
                                    <form action="/upload_users" enctype="multipart/form-data" method="POST">
                                      @csrf
                                        <div class="input-group mb-3">
                                            <div class="form-file">
                                                <input type="file" name="upload" class="form-file-input form-control">
                                            </div>
											<!-- <span class="input-group-text">Upload</span> -->
                                            <button class="btn btn-primary btn-sm" type="submit" name="importSubmit">Upload</button>
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




