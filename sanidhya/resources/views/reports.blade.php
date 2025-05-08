@include("inc_sanidhya.header")
<link rel="stylesheet" type="text/css" href="assets/css/vendors/select2.css">

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
                  <h3>
                    Generate Report</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Search                        </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="results" method="POST">
            @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <div class="row">
                      
                   

                      <div class="col-sm-6" id="pstate">
                        <div class="mb-3">
                        <label for="">Event</label>
                        <select name="state" class="form-select">
                        <option value="all">VB 2 - Pune</option>
                     
                     
                        </select> 
                        </div>
                      </div>
                   
                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="">Attended</label>
                        <select name="district" class="form-select" id="pdistrict">
                        <option value="all">All</option>
                 
                        </select> 
                        </div>
                      </div>
                      
                      <!--
                      <div class="col-sm-3">
                        <div class="mb-3">
                        <label for="">Reserved</label>
                        <select name="district" class="form-select" id="pdistrict">
                        <option value="all">All</option>
                        <option value="all">Yes</option>
                        <option value="all">No</option>
                 
                        </select> 
                        </div>
                      </div>
                    -->

                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="">PAN / Aadhaar</label>
                       <input type="text" class="form-control" placeholder="All" name="" id="">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="">Date</label>
                       <input type="date" value="2023-02-05" class="form-control" placeholder="All" name="" id="" readonly>
                        </div>
                      </div>

                    

                      <div class="col-sm-12">
                        <div class="mb-3">
                        <div class="col"><br><br>
                          <div class="text-end"><button class="btn btn-secondary me-3" type="submit">Search</button></div>
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
          </form>
          <!-- Container-fluid Ends-->
        </div>

        @include("inc_sanidhya.footer")
        <script src="assets/js/select2/select2.full.min.js"></script>
    <script src="assets/js/select2/select2-custom.js"></script>
   

 
    <script>
      
 
    

    </script>