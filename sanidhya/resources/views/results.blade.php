@include("inc_sanidhya.header")
<link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
     
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Result</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Proposals</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <?php
          $url =  "{$_SERVER['REQUEST_URI']}";
          $url = explode('/', $url);
          ?>
            <div class="container-fluid general-widget">
            <div class="row">
                
        
              <div class="col-xl-12 col-md-12 dash-xl-100 dash-lg-100 dash-39">
                <div class="card ongoing-project recent-orders">
                  <br>
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>Name</th>	<th>Contact</th>	<th>Email</th>	<th>Address</th>	<th>PAN</th>	<th>Aadhar</th>	<th>Amt</th>	<th>Location</th>	<th>Attended</th>
                            
                          </tr>
                         </thead>
                          <tbody>
                         
                           
                          <tr>
                            <td>Ramesh</td>
                            <td>987654321</td>
                            <td>ramesh@gmail.com</td>
                            <td>12, Sirsi, Nagavara, Bengaluru</td>
                            <td>BSKA1234KK</td>
                            <td>456745674567</td>
                            <td>5000</td>
                            <td>Mumbai</td>
                            <td>Yes</td>
                            
                          </tr>

                           
                          <tr>
                            <td>Suresh</td>
                            <td>987654321</td>
                            <td>ramesh@gmail.com</td>
                            <td>12, Sirsi, Nagavara, Bengaluru</td>
                            <td>BSKA1234KK</td>
                            <td>456745674567</td>
                            <td>5000</td>
                            <td>Mumbai</td>
                            <td>Yes</td>
                            
                          </tr>

                           
                          <tr>
                            <td>Mahesh</td>
                            <td>987654321</td>
                            <td>ramesh@gmail.com</td>
                            <td>12, Sirsi, Nagavara, Bengaluru</td>
                            <td>BSKA1234KK</td>
                            <td>456745674567</td>
                            <td>5000</td>
                            <td>Mumbai</td>
                            <td>Yes</td>
                            
                          </tr>
                         
              </tbody>
              </table>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
        </div>
        @include("inc_sanidhya.footer")
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatables/datatable.custom.js"></script>
