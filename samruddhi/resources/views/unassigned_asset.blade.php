@include('inc.header')



<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Unassigned Asset</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                  <li class="breadcrumb-item "> <a  href="/asset_audits">Asset Audits</a></li>
                  {{-- <li class="breadcrumb-item "> <a  href="/update_asset_audit">Update Asset Audit</a></li> --}}
                  <li class="breadcrumb-item active"> <a  href="#">Unassigned Asset</a></li>

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
                    <form action="/create_unassigned_asset" method="POST"> 
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                  
                  <label>Enter QR Code  </label>
                            <input class="form-control" type="text" name="qr" placeholder="QR Code *" required>
                        <input type="hidden" value="<?php echo $data['audit_id']; ?>" name="audit_id">

                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3">Add</button>
                        </div>

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

<script>

</script>
@include('inc.footer')
