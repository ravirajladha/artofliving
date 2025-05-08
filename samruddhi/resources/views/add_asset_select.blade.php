@include('inc.header')
<script src="jquery-3.6.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>
                  
                  Add Asset</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/index"> <i data-feather="home"></i> Home</a></li>
                      <li class="breadcrumb-item"><a href="#">Add Asset</a></li>
                  </ol><br>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/assets/asset_new.csv" download="asset_new.csv">Download File</a></li>

                    <li class="breadcrumb-item"><a href="/add_asset_upload"> Upload Assets</a></li>
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
                      <div class="row"> 
                      <div class="col-md-4">

                       

                          <div class="mb-3">
                            <label>Asset Type</label>
                            <select class="form-select" name="type" id="asset_type">
                            <option selected disabled>Select Asset Type</option>
                            <option value="1">Movable Asset</option>
                            <option value="2">Immovable Asset</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label>Select Category</label>
                            <select class="form-select" name="category"   id="category">
                            <option >Select a Category</option>
                            @foreach($firstOptions as $option)
                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label>Select Sub Category</label>
                            <select class="form-select" name="subcategory" id="subcategory" onchange="select_subcategory(this.value);">
                              {{-- <option value=""></option> --}}
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-9"></div>
                        <div class="col-md-3">
                          <div class="text-end pull-right"><a style="display:none" href="#" id="submit_btn" class="btn btn-secondary me-3">Continue</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-end pull-right">
            <a href="/index" class="btn btn-secondary me-3">Cancel</a>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        @include('inc.footer')
        <script type="text/javascript">
          $(document).ready(function () {
              $('#category').on('change', function () {
                  var category_id = this.value;
                  $('#subcategory').html('');
                  $.ajax({
                      url: '{{ route('getCategory') }}?category_id='+category_id,
                      type: 'get',
                      success: function (res) {
                          $('#subcategory').html('<option value="">Select Subcategory</option>');
                          $.each(res, function (key, value) {
                              $('#subcategory').append('<option value="' + value
                                  .id + '">' + value.name + '</option>');
                          });
                          // $('#city').html('<option value="">Select City</option>');
               

                      }
                     
                  });
              });
            
              });

         function select_subcategory(subcat_id){
         $("#submit_btn").css("display", "block");
         var type = $("#asset_type").find(":selected").val();
         $("#submit_btn").attr("href", "/add_asset/"+type+"/"+subcat_id);
          }
</script>