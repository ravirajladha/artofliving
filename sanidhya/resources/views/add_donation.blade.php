@include("inc_sanidhya.header")

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    border: none;
    margin-top: 5px !important;
  }
</style>

<?php
$donation_details = $data['donation_details'];
if (is_array($donation_details) && count($donation_details) > 0) {
  $multiples = $donation_details['multiples'];
  $amount = $donation_details['amount'];
  $phone = $donation_details['phone'];
  $email = $donation_details['email'];
  $first_name = $donation_details['first_name'];
  $last_name = $donation_details['last_name'];
  $gender = $donation_details['gender'];
  $gender_value = $donation_details['gender'];
  $age = $donation_details['age'];
  $aadhaar = $donation_details['aadhaar'];
  $pan = $donation_details['pan'];
  $address = $donation_details['address'];
  $pincode = $donation_details['pincode'];
  $city = $donation_details['city'];
  $state = $donation_details['state'];
  $company_name = $donation_details['company_name'];
  $company_pan = $donation_details['company_pan'];
  $company_aadhaar = $donation_details['company_aadhaar'];
  $company_address = $donation_details['company_address'];
  $company_pincode = $donation_details['company_pincode'];
  $company_city = $donation_details['company_city'];
  $company_state = $donation_details['company_state'];
  $seat_number = $donation_details['seat_number'];
  $category = $donation_details['category'];
  $event_id = $donation_details['event_id'];
} else {
  $multiples = '';
  $amount = '';
  $phone = '';
  $email = '';
  $first_name = '';
  $last_name = '';
  $gender = 'Select Gender';
  $gender_value = '';
  $age = '';
  $aadhaar = '';
  $pan = '';
  $address = '';
  $pincode = '';
  $city = '';
  $state = '';
  $company_name = '';
  $company_pan = '';
  $company_aadhaar = '';
  $company_address = '';
  $company_pincode = '';
  $company_city = '';
  $company_state = '';
  $seat_number = '';
  $category = '';
  $event_id = '';
}
?>

<?php $type = $data['type']; ?>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Donation | {{$data['event_name']}} event</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
      <form action="/create_donation" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Basic Information</button>
          </li>
          @if($type == 'Corporate')
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Company Information</button>
          </li>
          @endif
        </ul> -->

        <!-- <div class="tab-content" id="myTabContent"> -->
        @if($type == 'Individual')
        <!-- <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"> -->

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Basic Information</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">User Information</button>
          </li>
        </ul>
        <!-- Nav Contents -->
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div id="personal">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">
                      <h4>Basic Information</h4>
                      <hr>
                      <div class="row">
                        <input class="form-control" type="hidden" name="event_id" type="number">

                        <div class="row">

                          <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label>Multiples</label>
                          <input class="form-control" name="multiples" type="text" value="{{$multiples}}" placeholder="Value *" oninput="calculateAmount()">
                          <input class="form-control" name="event_id" value="<?php echo $data['event_id'] ?>" type="hidden" placeholder="Value *">
                          <input class="form-control" name="type" value="{{$type}}" type="hidden" placeholder="Value *">
                        </div>
                      </div> -->

                          <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label for="category">Category</label>
                          <select class="form-control" name="category" id="categories" placeholder="Value *" onchange="calculateAmount()">
                            <?php $categories = $data['category_list']; ?>
                            @foreach($categories as $category)
                            <option value="{{$category}}">{{$category}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div> -->

                          <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label>Amount</label>
                          <input class="form-control" name="amount" type="number" value="{{$amount}}" placeholder="Value *" readonly>
                        </div>
                      </div> -->

                          <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label>Phone</label>
                          <input class="form-control" name="phone" type="number" value="{{$phone}}" placeholder="Value *">
                        </div>
                      </div> -->
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>First Name</label>
                              <input class="form-control" name="first_name" type="text" value="{{$first_name}}" placeholder="Value *">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Last Name</label>
                              <input class="form-control" name="last_name" type="text" value="{{$last_name}}" placeholder="Value *">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Email</label>
                              <input class="form-control" name="email" type="email" value="{{$email}}" placeholder="Value *">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Phone</label>
                              <input class="form-control" name="phone" type="number" value="{{$phone}}" placeholder="Value *">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Age</label>
                              <input class="form-control" name="age" type="number" value="{{$age}}" placeholder="Value *">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Gender</label>
                              <select class="form-control" name="gender" id="gender">
                                <option value="{{$gender_value}}">{{$gender}}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>PAN</label>
                              <input class="form-control" name="pan" id="panNumber" type="text" placeholder="PAN Value *" value="{{$pan}}">
                            </div>
                            <div id="panErrorMessage" style="color: red;"></div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Aadhaar</label>
                              <input class="form-control" name="aadhaar" id="aadhaarNumber" type="text" placeholder="Aadhaar Value *" value="{{$aadhaar}}" required>
                            </div>
                            <div id="aadhaarErrorMessage" style="color: red;"></div>
                          </div>


                          <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label>Address</label>
                          <textarea class="form-control" name="address" id="" cols="10" rows="1" placeholder="Value *">{{$address}}</textarea>
                        </div>
                      </div> -->
                          <!-- 
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Seat Number</label>
                          <input class="form-control" name="seat_number" type="text" value="{{$seat_number}}" placeholder="Value *">
                        </div>
                      </div> -->

                          <!-- <div class="row">
                        <div class="col-md-12"></div>
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label for="exampleInputname1">Pincode</label>
                            <label for="exampleInputname1"></label>
                            <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="pincode" value="{{$pincode}}" onkeyup="find_pincode_p(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label for="exampleInputname1">City</label>
                            <label for="exampleInputname1"></label>
                            <input type="text" placeholder="Enter City " value="{{$city}}" class="form-control" id="comm_block_p" name="city" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label for="exampleInputname1">State</label>
                            <label for="exampleInputname1"></label>
                            <input type="text" placeholder="Enter State " value="{{$state}}" class="form-control" name="state" id="comm_state_p" readonly>
                          </div>
                        </div>

                      </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
          <div id="personal">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body">
                  <div class="form theme-form Cubiclecreate">
                    <h4>User Information</h4>
                    <hr>
                    <div class="row">
                      <input class="form-control" name="event_id" type="number" hidden>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="categories" placeholder="Value *" onchange="calculateAmount()">
                              <?php $categories = $data['category_list']; ?>
                              @foreach($categories as $category)
                              <option value="{{$category}}">{{$category}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Multiples</label>
                            <input class="form-control" name="multiples" type="text" value="{{$multiples}}" placeholder="Value *" oninput="calculateAmount()">
                            <input class="form-control" name="event_id" value="<?php echo $data['event_id'] ?>" type="hidden" placeholder="Value *">
                            <input class="form-control" name="type" value="{{$type}}" type="hidden" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Seat Number</label>
                            <input class="form-control" name="seat_number" type="text" value="{{$seat_number}}" placeholder="Value *">
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Amount</label>
                            <input class="form-control" name="amount" type="number" value="{{$amount}}" placeholder="Value *" readonly>
                          </div>
                        </div>

                        <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label>Phone</label>
                          <input class="form-control" name="phone" type="number" value="{{$phone}}" placeholder="Value *">
                        </div>
                      </div> -->

                        <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label>Email</label>
                          <input class="form-control" name="email" type="email" value="{{$email}}" placeholder="Value *">
                        </div>
                      </div> -->

                        <!-- <div class="col-md-6">
                          <div class="mb-3">
                            <label>First Name</label>
                            <input class="form-control" name="first_name" type="text" value="{{$first_name}}" placeholder="Value *">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Last Name</label>
                            <input class="form-control" name="last_name" type="text" value="{{$last_name}}" placeholder="Value *">
                          </div>
                        </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Age</label>
                          <input class="form-control" name="age" type="number" value="{{$age}}" placeholder="Value *">
                        </div>
                      </div> -->

                        <!-- <div class="col-md-6">
                        <div class="mb-3">
                          <label>Gender</label>
                          <select class="form-control" name="gender" id="gender">
                            <option value="{{$gender_value}}">{{$gender}}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div> -->
                        <div class="row">
                          <div class="col-md-12"></div>
                          <div class="col-sm-4">
                            <div class="mb-3">
                              <label for="exampleInputname1">Pincode</label>
                              <label for="exampleInputname1"></label>
                              <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="pincode" value="{{$pincode}}" onkeyup="find_pincode_p(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="mb-3">
                              <label for="exampleInputname1">City</label>
                              <label for="exampleInputname1"></label>
                              <input type="text" placeholder="Enter City " value="{{$city}}" class="form-control" id="comm_block_p" name="city" readonly>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="mb-3">
                              <label for="exampleInputname1">State</label>
                              <label for="exampleInputname1"></label>
                              <input type="text" placeholder="Enter State " value="{{$state}}" class="form-control" name="state" id="comm_state_p" readonly>
                            </div>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Address</label>
                            <input class="form-control" name="address" id="" value="{{$address}}" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Line 1</label>
                            <input class="form-control" name="add_line1" id="" value="" placeholder="Value *">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label>Line 2</label>
                            <input class="form-control" name="add_line2" id="" value="" placeholder="Value *">
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
    </div>

  </div>
  <!-- </div> -->
  @endif

  @if($type == 'Corporate')
  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Basic Information</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Company Information</button>
    </li>
  </ul>
  <!-- Nav Contents -->
  <!-- <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0"> -->
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

      <div id="corporate">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <h4>User Information</h4>
              <hr>

              <div class="row">

                <div class="col-md-12"></div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Multiples</label>
                    <input class="form-control" name="multiples" type="text" value="{{$multiples}}" placeholder="Value *" oninput="calculateAmount()">
                    <input class="form-control" name="event_id" value="<?php echo $data['event_id'] ?>" type="hidden" placeholder="Value *">
                    <input class="form-control" name="type" value="{{$type}}" type="hidden" placeholder="Value *">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="categories" placeholder="Value *" onchange="calculateAmount()">
                      <?php $categories = $data['category_list']; ?>
                      @foreach($categories as $category)
                      <option value="{{$category}}">{{$category}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Amount</label>
                    <input class="form-control" name="amount" type="number" value="{{$amount}}" placeholder="Value *" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Phone</label>
                    <input class="form-control" name="phone" type="number" value="{{$phone}}" placeholder="Value *">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Email</label>
                    <input class="form-control" name="email" type="email" value="{{$email}}" placeholder="Value *">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>First Name</label>
                    <input class="form-control" name="first_name" type="text" value="{{$first_name}}" placeholder="Value *">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Last Name</label>
                    <input class="form-control" name="last_name" type="text" value="{{$last_name}}" placeholder="Value *">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Age</label>
                    <input class="form-control" name="age" type="number" value="{{$age}}" placeholder="Value *">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Gender</label>
                    <select class="form-control" name="gender" id="gender">
                      <option value="{{$gender_value}}">{{$gender}}</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>



                <!-- <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company Pincode</label>
                      <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="company_pincode" onkeyup="find_pincode_c(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" value="{{$company_pincode}}" >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company City</label>
                      <input type="text" placeholder="Enter City " class="form-control" id="comm_block" name="company_city" readonly value="{{$company_city}}" >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company State</label>
                      <input type="text" placeholder="Enter State " class="form-control" name="company_state" id="comm_state" readonly value="{{$company_state}}" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company Name</label>
                      <input class="form-control" name="company_name" type="text" placeholder="Value *" value="{{$company_name}}" >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company PAN</label>
                      <input class="form-control" name="company_pan" id="companyPanNumber" type="text" placeholder="Company PAN Value *" value="{{$company_pan}}" >
                    </div>
                    <div id="companyPanErrorMessage" style="color: red;"></div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company Aadhaar</label>
                      <input class="form-control" name="company_aadhaar" id="companyAadhaarNumber" type="text" placeholder="Company Aadhaar Value *" value="{{$company_aadhaar}}" >
                    </div>
                    <div id="companyAadhaarErrorMessage" style="color: red;"></div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company Address</label>
                      <input class="form-control" name="company_address" type="text" placeholder="Value *" value="{{$company_address}}" >
                    </div>
                  </div>
                   -->
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- </div> -->
      @endif
      <div class="row card-f-end">
        <div class="col"><br>
          <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Create New Entry</button></div><br><br>
        </div>
      </div>



    </div>
  </div>


  <!-- <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0"> -->
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
      <div id="corporate">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <h4>Company Information</h4>
              <hr>

              <div class="row">

                <div class="col-md-12"></div>

                <!-- <div class="col-md-6">
                    <div class="mb-3">
                      <label>Multiples</label>
                      <input class="form-control" name="multiples" type="text" value="{{$multiples}}" placeholder="Value *" oninput="calculateAmount()">
                      <input class="form-control" name="event_id" value="<?php echo $data['event_id'] ?>" type="hidden" placeholder="Value *">
                      <input class="form-control" name="type" value="{{$type}}" type="hidden" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="category">Category</label>
                      <select class="form-control" name="category" id="categories" placeholder="Value *" onchange="calculateAmount()">
                        <?php $categories = $data['category_list']; ?>
                        @foreach($categories as $category)
                        <option value="{{$category}}">{{$category}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Amount</label>
                      <input class="form-control" name="amount" type="number" value="{{$amount}}" placeholder="Value *" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Phone</label>
                      <input class="form-control" name="phone" type="number" value="{{$phone}}" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Email</label>
                      <input class="form-control" name="email" type="email" value="{{$email}}" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>First Name</label>
                      <input class="form-control" name="first_name" type="text" value="{{$first_name}}" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Last Name</label>
                      <input class="form-control" name="last_name" type="text" value="{{$last_name}}" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Age</label>
                      <input class="form-control" name="age" type="number" value="{{$age}}" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Gender</label>
                      <select class="form-control" name="gender" id="gender">
                        <option value="{{$gender_value}}">{{$gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>

                   -->

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Company Pincode</label>
                    <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="company_pincode" onkeyup="find_pincode_c(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" value="{{$company_pincode}}">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Company City</label>
                    <input type="text" placeholder="Enter City " class="form-control" id="comm_block" name="company_city" readonly value="{{$company_city}}">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Company State</label>
                    <input type="text" placeholder="Enter State " class="form-control" name="company_state" id="comm_state" readonly value="{{$company_state}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Company Name</label>
                    <input class="form-control" name="company_name" type="text" placeholder="Value *" value="{{$company_name}}">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Company PAN</label>
                    <input class="form-control" name="company_pan" id="companyPanNumber" type="text" placeholder="Company PAN Value *" value="{{$company_pan}}">
                  </div>
                  <div id="companyPanErrorMessage" style="color: red;"></div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Company Aadhaar</label>
                    <input class="form-control" name="company_aadhaar" id="companyAadhaarNumber" type="text" placeholder="Company Aadhaar Value *" value="{{$company_aadhaar}}">
                  </div>
                  <div id="companyAadhaarErrorMessage" style="color: red;"></div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label>Company Address</label>
                    <input class="form-control" name="company_address" type="text" placeholder="Value *" value="{{$company_address}}">
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      </ </div>
    </div>
  </div>
</div>
</form>

<!-- </div> -->


</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
@include("inc_sanidhya.footer")
<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    $("#add_row").on("click", function() {
      // Dynamic Rows Code

      // Get max row id and set new id
      var newid = 0;
      $.each($("#tab_logic tr"), function() {
        if (parseInt($(this).data("id")) > newid) {
          newid = parseInt($(this).data("id"));
        }
      });
      newid++;

      var tr = $("<tr></tr>", {
        id: "addr" + newid,
        "data-id": newid
      });

      // loop through each td and create new elements with name of newid
      $.each($("#tab_logic tbody tr:nth(0) td"), function() {
        var td;
        var cur_td = $(this);

        var children = cur_td.children();

        // add new td and element if it has a nane
        if ($(this).data("name") !== undefined) {
          td = $("<td></td>", {
            "data-name": $(cur_td).data("name")
          });

          var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");

          c.appendTo($(td));
          td.appendTo($(tr));
        } else {
          td = $("<td></td>", {
            'text': $('#tab_logic tr').length
          }).appendTo($(tr));
        }
      });
      $(tr).appendTo($('#tab_logic'));

      $(tr).find("td button.row-remove").on("click", function() {
        $(this).closest("tr").remove();
      });
    });

    // Sortable Code
    var fixHelperModified = function(e, tr) {
      var $originals = tr.children();
      var $helper = tr.clone();

      $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
      });

      return $helper;
    };

    $(".table-sortable tbody").sortable({
      helper: fixHelperModified
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row").trigger("click");
  });

  function find_pincode_p(pin) {

    if (pin.length == 6) {
      $.ajax({
        url: '/pincode/' + pin,
        type: 'GET',
        success: function(res) {
          console.log(res);
          var detail = res.split(',');
          document.getElementById("comm_block_p").value = detail[0];
          document.getElementById("comm_state_p").value = detail[1];
        }
      });
    } else {
      document.getElementById("comm_block_p").value = "";
      document.getElementById("comm_state_p").value = "";
    }
  }

  function find_pincode_c(pin) {

    if (pin.length == 6) {
      $.ajax({
        url: '/pincode/' + pin,
        type: 'GET',
        success: function(res) {
          console.log(res);
          var detail = res.split(',');
          document.getElementById("comm_block").value = detail[0];
          document.getElementById("comm_state").value = detail[1];
        }
      });
    } else {
      document.getElementById("comm_block").value = "";
      document.getElementById("comm_state").value = "";
    }
  }

  function calculateAmount() {
    var multiples = parseInt($('input[name="multiples"]').val());
    var category = $('select[name="category"]').val();
    var categoryValues = <?php echo json_encode($data['category_values']); ?>;

    if (multiples && categoryValues.hasOwnProperty(category)) {
      var categoryValue = parseInt(categoryValues[category]);
      var amount = multiples * categoryValue;
      $('input[name="amount"]').val(amount);
    }
  }
</script>
<script>
  // avatar pic display on upload
  $(document).ready(function() {


    var readURL = function(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('.avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }


    $(".file-upload").on('change', function() {
      readURL(this);
    });
  });


  function validatePan() {
    var panInput = document.getElementById("panNumber");
    var panErrorDiv = document.getElementById("panErrorMessage");

    var panNumber = panInput.value;
    var errorMessage = "";

    // Check if PAN card number is provided
    if (panNumber.trim() === "") {
      errorMessage = "Please enter a valid PAN card number.";
    } else {
      // Check if it is a valid PAN card number
      var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
      if (panRegex.test(panNumber)) {
        // It is a valid PAN card number, no need to check further
        panErrorDiv.textContent = "";
        return;
      }

      // Invalid PAN card number
      errorMessage = "Please enter a valid PAN card number.";
    }

    // Display the error message in the panErrorDiv element
    panErrorDiv.textContent = errorMessage;
  }

  function validateAadhaar() {
    var aadhaarInput = document.getElementById("aadhaarNumber");
    var aadhaarErrorDiv = document.getElementById("aadhaarErrorMessage");

    var aadhaarNumber = aadhaarInput.value;
    var errorMessage = "";

    // Check if Aadhaar card number is provided
    if (aadhaarNumber.trim() === "") {
      errorMessage = "Please enter a valid Aadhaar card number.";
    } else {
      // Check if it is a valid Aadhaar card number
      var aadhaarRegex = /^[2-9]\d{3}\s\d{4}\s\d{4}$/;
      if (aadhaarRegex.test(aadhaarNumber)) {
        // It is a valid Aadhaar card number, no need to check further
        aadhaarErrorDiv.textContent = "";
        return;
      }

      // Invalid Aadhaar card number
      errorMessage = "Please enter a valid Aadhaar card number.";
    }

    // Display the error message in the aadhaarErrorDiv element
    aadhaarErrorDiv.textContent = errorMessage;
  }

  var panInput = document.getElementById("panNumber");
  panInput.addEventListener("blur", validatePan);
  panInput.addEventListener("input", clearPanErrorMessage);

  var aadhaarInput = document.getElementById("aadhaarNumber");
  aadhaarInput.addEventListener("blur", validateAadhaar);
  aadhaarInput.addEventListener("input", clearAadhaarErrorMessage);

  function clearPanErrorMessage() {
    var panErrorDiv = document.getElementById("panErrorMessage");
    panErrorDiv.textContent = "";
  }

  function clearAadhaarErrorMessage() {
    var aadhaarErrorDiv = document.getElementById("aadhaarErrorMessage");
    aadhaarErrorDiv.textContent = "";
  }


  function validateCompanyPan() {
    var companyPanInput = document.getElementById("companyPanNumber");
    var companyPanErrorDiv = document.getElementById("companyPanErrorMessage");

    var companyPanNumber = companyPanInput.value;
    var errorMessage = "";

    // Check if Company PAN card number is provided
    if (companyPanNumber.trim() === "") {
      errorMessage = "Please enter a valid Company PAN card number.";
    } else {
      // Check if it is a valid PAN card number
      var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
      if (panRegex.test(companyPanNumber)) {
        // It is a valid PAN card number, no need to check further
        companyPanErrorDiv.textContent = "";
        return;
      }

      // Invalid PAN card number
      errorMessage = "Please enter a valid Company PAN card number.";
    }

    // Display the error message in the companyPanErrorDiv element
    companyPanErrorDiv.textContent = errorMessage;
  }

  function validateCompanyAadhaar() {
    var companyAadhaarInput = document.getElementById("companyAadhaarNumber");
    var companyAadhaarErrorDiv = document.getElementById("companyAadhaarErrorMessage");

    var companyAadhaarNumber = companyAadhaarInput.value;
    var errorMessage = "";

    // Check if Company Aadhaar card number is provided
    if (companyAadhaarNumber.trim() === "") {
      errorMessage = "Please enter a valid Company Aadhaar card number.";
    } else {
      // Check if it is a valid Aadhaar card number
      var aadhaarRegex = /^[2-9]\d{3}\s\d{4}\s\d{4}$/;
      if (aadhaarRegex.test(companyAadhaarNumber)) {
        // It is a valid Aadhaar card number, no need to check further
        companyAadhaarErrorDiv.textContent = "";
        return;
      }

      // Invalid Aadhaar card number
      errorMessage = "Please enter a valid Company Aadhaar card number.";
    }

    // Display the error message in the companyAadhaarErrorDiv element
    companyAadhaarErrorDiv.textContent = errorMessage;
  }

  var companyPanInput = document.getElementById("companyPanNumber");
  companyPanInput.addEventListener("blur", validateCompanyPan);
  companyPanInput.addEventListener("input", clearCompanyPanErrorMessage);

  var companyAadhaarInput = document.getElementById("companyAadhaarNumber");
  companyAadhaarInput.addEventListener("blur", validateCompanyAadhaar);
  companyAadhaarInput.addEventListener("input", clearCompanyAadhaarErrorMessage);

  function clearCompanyPanErrorMessage() {
    var companyPanErrorDiv = document.getElementById("companyPanErrorMessage");
    companyPanErrorDiv.textContent = "";
  }

  function clearCompanyAadhaarErrorMessage() {
    var companyAadhaarErrorDiv = document.getElementById("companyAadhaarErrorMessage");
    companyAadhaarErrorDiv.textContent = "";
  }
  console.log("confirm");
</script>