@include("inc_sanidhya.header")
<style>
  .table-wrapper {
    overflow-x: visible;
    overflow-y: hidden;
  }
</style>
<style>
  .swal2-popup {
  font-size: 10px !important;
  width:300px;
}
</style>
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Create User Profile</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Events</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <?php

use App\Models\Profile;
use App\Models\User;

  $url =  "{$_SERVER['REQUEST_URI']}";
  $url = explode('/', $url);
  ?>
  <div class="container-fluid general-widget">
    <div class="row">
        <?php 
             $data= Profile::all();
        ?>

              <div class="card">
                <div class="card-body">
                    <!-- Give Content That You Want -->
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
                    <th>ID</th>
                    <th>User Type</th>
                    <th>First name </th>
                    <th >Last name</th>
                    <th>Phone no</th>
                    <th>Email ID</th>
                    <th>PAN</th>
                    <th>Aadhaar</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Company name</th>
                    <th>Company PAN</th>
                    <th>Company Address</th>
                    <th>Company Pincode</th>
                    <th>Company City</th>
                    <th>Company state</th>
                
                    <th>Created by</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
            
                   @foreach($data as $datas)
                    <tr>

                      <td style="padding:0 20px">{{$datas->id}}</td>
                      <td style="padding:0 20px">{{$datas->type}}</td>
                      <td style="padding:0 20px">{{$datas->first_name}}</td>
                      <td style="padding:0 20px">{{$datas->last_name}}</td>
                      <td style="padding:0 20px">{{$datas->phone}}</td>
                      <td>{{$datas->email}}</td>
                      <td>{{$datas->pan}}</td>
                      <td>{{$datas->aadhaar}}</td>
                      <td>{{$datas->state}}</td>
                      <td>{{$datas->city}}</td>
                      <th>{{$datas->company_name	}}</th>
                    <th>{{$datas->company_pan}}</th>
                    <th>{{$datas->company_address}}</th>
                    <th>{{$datas->company_pincode}}</th>
                    <th>{{$datas->company_city}}</th>
                    <th>{{$datas->company_state}}</th>
                    <th>
                      <?php
                      $find = User::where('id', $datas->aprex_id)->first();
                      
                      if ($find) {
                          echo $find->name;
                      } else {
                          echo "User not found";
                      }
                      ?>
                  </th>

                    
                    <th>
                    
                      <div class='row'>
                      @if($datas->status==1)
                          <div class='col-md-12'><a title='Edit' style="margin-right: 30px; pointer-events: none; color: red;" class="btn btn-info btn-xs" href="/fetch_profile_date/{{$datas->id}}"><i class='fa fa-pencil'></i></a> </div>
                          @else
                          <div class='col-md-12'><a title='Edit' style="margin-right:30px;" class="btn btn-info btn-xs" href="/fetch_profile_date/{{$datas->id}}"><i class='fa fa-pencil'></i></a> </div>

                          @endif
                          <div class='col-md-12'><a title='View' style="margin-right:30px;" class="btn btn-warning btn-xs"href="/profileView/{{$datas->id}}"><i class='fa fa-eye'></i></a> </div>
                          <div class='col-md-12'><a title='Delete' style="margin-right:30px;" class="btn btn-danger btn-xs" href="/deleteProfile/{{$datas->id}}"><i class='fa fa-trash'></i></a></div>
                          @if($datas->status==1)
                          <div class='col-md-12'><a title='Activate' style="margin-right:30px;" class="btn btn-danger btn-xs" href="/ActivateandDeatiaveUser/{{$datas->id}}/0"><i class='fa fa-ban'></i></a></div>
                          @else
                          <div class='col-md-12'><a title='Deactivate' style="margin-right:30px;" class="btn btn-success btn-xs" href="/ActivateandDeatiaveUser/{{$datas->id}}/1"><i class='fa fa-check'></i></a></div>
                         @endif
                      </div>
                  
                    </th>  
              @endforeach
                        

                </tbody>
              </table>
              </div>
                </div>
                               
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@include("inc_sanidhya.footer")


<script>
  function copy(that) {
    var inp = document.createElement('input');
    document.body.appendChild(inp)
    inp.value = that.textContent
    inp.select();
    document.execCommand('copy', false);
    inp.remove();
  }
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session()->has('success'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    {{ session()->forget('success') }}
@endif

@if(session()->has('error'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    {{ session()->forget('error') }}
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to validate input data with AJAX
    function validateData() {
        var email = $('#comm_email_p').val();
        var pan = $('#comm_pan_p').val();
        var aadhaar = $('#comm_aadhaar_p').val();

        $.ajax({
            url: '/check-data', // Change this to your Laravel route
            method: 'POST',
            data: { email: email, pan: pan, aadhaar: aadhaar },
            success: function(response) {
                if (response.exists) {
                    $('#alertMessage').text('Data already exists in the database.');
                } else {
                    $('#alertMessage').text('Data not found in the database.');
                }
            },
            error: function() {
                $('#alertMessage').text('Error occurred while checking data.');
            }
        });
    }

    // Attach the validateData function to the button click event
    $('#checkDataButton').click(validateData);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
      
        $(document).ready(function () {
    $('#basic-1').DataTable();
   
});
    </script>
    