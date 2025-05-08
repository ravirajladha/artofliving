@include('inc_sanidhya.header')


<style>
  .mega-title-badge {
    color: #444;
  }
</style>
<style>
  .swal2-popup {
    font-size: 10px !important;
    width: 300px;
  }
</style>
<style>
  .swal2-popup {
    font-size: 10px !important;
    width: 300px;
  }
</style>
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Upload Records</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Upload</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-12 box-col-12 col-xl-12 ">
        <div class="card height-equal">

          <div class="card-body">
            <div class="row">
              <div class="col-md-9">
                <div class="basic-form custom_file_input">
                  <form action="/upload_file" enctype="multipart/form-data" method="POST">
                    @csrf


                    <div class="input-group mb-3">
                      <div class="form-file">
                        <input required type="file" name="upload" class="form-file-input form-control">
                      </div>

                      <button onclick="Swal.fire({icon: 'info',title: 'Please Wait, Uploading',showConfirmButton: false,timer: 500000})" class="btn btn-success btn-sm" type="submit" name="importSubmit">Upload</button>
                    </div>

                  </form>
                </div>

              </div>
              <div class="col-md-3">
                <center>
                  <p>Format Restrictions:</p>
                  <a href="/documents/upload.csv" target="_BLANK"><button class="btn btn-xs btn-primary">Download Format</button></a>
                </center>
              </div>
            </div>
          </div>


        </div>
      </div>



    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
@include('inc_sanidhya.footer')


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (!empty(session()->get('failed'))) { ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'warning',
      title: '{{ session()->get('
      failed ') }}',
      text: 'Error: Data Missing',
    })
  </script>
<?php }
session()->forget('failed'); ?>