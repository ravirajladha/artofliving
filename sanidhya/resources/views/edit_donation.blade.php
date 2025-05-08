<?php
$donations = $data['donation'];
$donation = $donations->toArray();
$event_id = $donation['event_id'];
$donation_id = $donation['id'];
$multiples = $donation['multiples'];
$type = $donation['type'];
$amount = $donation['amount'];
$phone = $donation['phone'];
$email = $donation['email'];
$first_name = $donation['first_name'];
$last_name = $donation['last_name'];
$age = $donation['age'];
$gender = $donation['gender'];
$gender_value = $donation['gender'];
$pan = $donation['pan'];
$aadhaar = $donation['aadhaar'];
$seat_number = $donation['seat_number'];
$pincode = $donation['pincode'];
$address = $donation['address'];
$city = $donation['city'];
$state = $donation['state'];
$selected_category = $donation['category'];
$company_name = $donation['company_name'];
$company_pan = $donation['company_pan'];
$company_aadhaar = $donation['company_aadhaar'];
$company_address = $donation['company_address'];
$company_pincode = $donation['company_pincode'];
$company_city = $donation['company_city'];
$company_state = $donation['company_state'];

$event = $data['event'];
$event_name = $event['event_name'];
$categories = explode(",", $event['cat_name']);
$category_values = explode(",", $event['cat_value']);
$category_list = [];

foreach ($categories as $index => $value) {
  $category_list[$value] = $category_values[$index];
}
// print_r($categories);
// echo "<br>";
// print_r($category_values);
// echo "<br>";
// print_r($category_list);
// die();
?>
@include("inc_sanidhya.header")

<style>
  .table-wrapper {
    overflow-x: visible;
    overflow-y: hidden;
  }
</style>

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
          <h3>{{$event_name}} | Update Donor Details</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active"> Update Donor</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
      <form action="/update_donation/{{$data['donation']->id}}" method="POST">
        @csrf
        <!-- <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Name</label>
                      <input readonly class="form-control" value="{{$data['donation']->first_name.' '.$data['donation']->last_name}}" name="name" type="text" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Email</label>
                      <input class="form-control" name="email" value={{$data['donation']->email}} type="email" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Phone</label>
                      <input class="form-control" name="phone" value={{$data['donation']->phone}} type="number" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>PAN/Aadhaar</label>
                      <input class="form-control" name="pan" value="{{$data['donation']->pan}}" type="text" placeholder="Value *">
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-12">
            <div class="row card-f-end">
              <div class="col">
                <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Update</button></div><br><br>
              </div>
            </div>
          </div>

        </div> -->

        <div class="form-group">
          <h3><label for="type">Type of Donation</label></h3>
          <select class="form-select" id="type" name="type" onchange="toggleDiv()">
            <option value="">Select an Option</option>
            <option value="Individual" {{ $type == 'Individual' ? 'selected' : '' }}>Individual</option>
            <option value="Corporate" {{ $type == 'Corporate' ? 'selected' : '' }}>Corporate</option>
          </select>
        </div>

        <br>

        <div id="personal" style="display: none;">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="form theme-form Cubiclecreate">
                  <h4>Basic Information</h4>
                  <hr>
                  <div class="row">
                    <input class="form-control" name="event_id" type="number" hidden>

                    <div class="row">

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Multiples</label>
                          <input class="form-control" name="multiples" type="text" value="{{$multiples}}" placeholder="Value *" oninput="calculateAmount()">
                          <input class="form-control" name="event_id" value="{{$event_id}}" type="hidden" placeholder="Value *">
                          <input class="form-control" name="type" value="{{$type}}" type="hidden" placeholder="Value *">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="category">Category</label>
                          <select class="form-control" name="category" id="categories" placeholder="Value *" onchange="calculateAmount()">
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

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>PAN</label>
                          <input class="form-control" name="pan" id="panNumber" type="text" placeholder="PAN Value *" value="{{$pan}}" onblur="validatePan()" oninput="clearPanErrorMessage()" readonly>
                        </div>
                        <div id="panErrorMessage" style="color: red;"></div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Aadhaar</label>
                          <input class="form-control" name="aadhaar" id="aadhaarNumber" type="text" placeholder="Aadhaar Value *" value="{{$aadhaar}}" onblur="validateAadhaar()" oninput="clearAadhaarErrorMessage()" readonly>
                        </div>
                        <div id="aadhaarErrorMessage" style="color: red;"></div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Address</label>
                          <textarea class="form-control" name="address" id="" cols="10" rows="1" placeholder="Value *">{{$address}}</textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Seat Number</label>
                          <input class="form-control" name="seat_number" type="text" value="{{$seat_number}}" placeholder="Value *">
                        </div>
                      </div>

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
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="corporate" style="display: none;">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <h4>Company Information</h4>
                <hr>

                <div class="row">

                  <div class="col-md-12"></div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Multiples</label>
                      <input class="form-control" name="multiples_c" type="text" value="{{$multiples}}" placeholder="Value *" oninput="calculateAmount_c()">
                      <input class="form-control" name="event_id" value="{{$event_id}}" type="hidden" placeholder="Value *">
                      <input class="form-control" name="type" value="{{$type}}" type="hidden" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="category">Category</label>
                      <select class="form-control" name="category" id="categories_c" placeholder="Value *" onchange="calculateAmount_c()">
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

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company Name</label>
                      <input class="form-control" name="company_name" type="text" placeholder="Value *" value="{{$company_name}}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company PAN</label>
                      <input class="form-control" id="companyPanNumber" name="company_pan" type="text" placeholder="Value *" value="{{$company_pan}}" onblur="validateCompanyPan()" oninput="clearCompanyPanErrorMessage()">
                    </div>
                    <div id="companyPanErrorMessage" style="color: red;"></div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company Aadhaar</label>
                      <input class="form-control" id="companyAadhaarNumber" name="company_aadhaar" type="text" placeholder="Value *" value="{{$company_aadhaar}}" onblur="validateCompanyAadhaar()" oninput="clearCompanyAadhaarErrorMessage()">
                    </div>
                    <div id="companyAadhaarErrorMessage" style="color: red;"></div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company Address</label>
                      <input class="form-control" name="company_address" type="text" placeholder="Value *" value="{{$company_address}}">
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
                      <label>Company Pincode</label>
                      <input type="text" placeholder="Enter Pincode" class="form-control" id="last_name" name="company_pincode" onkeyup="find_pincode_c(this.value)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" value="{{$company_pincode}}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company City</label>
                      <input type="text" placeholder="Enter City " class="form-control" id="comm_block" name="company_city" readonly value="{{$company_city}}" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Company State</label>
                      <input type="text" placeholder="Enter State " class="form-control" name="company_state" id="comm_state" readonly value="{{$company_state}}" required>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-12">
          <div class="row card-f-end">
            <div class="col">
              <div class="text-end">
                <!-- <button type="submit" class="btn btn-secondary me-3" href="#">Update</button> -->
                <input type="submit" class="btn btn-secondary me-3" value="Update">
                <br>
                <br>
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@include("inc_sanidhya.footer")
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>

<script>
  $('#user_type').on('change', function() {
    if (this.value == "employee" || this.value == "teacher") {
      document.getElementById("manager").style.display = "block";
    } else {
      document.getElementById("manager").style.display = "none";
    }
  });

  function readURL(input1) {
    if (input1.files && input1.files[0]) {
      var reader1 = new FileReader();

      reader1.onload = function(e) {
        $('#blah').attr('src', e.target.result).width(100).height(100);
      };

      reader1.readAsDataURL(input1.files[0]);
    }
  }

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
</script>


<?php if (!empty(session()->get('success'))) { ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: '{{ session()->get('
      success ') }}',
      showConfirmButton: false,
      timer: 2000,

    })
  </script>
<?php }
session()->forget('success'); ?>

<script>
  function toggleDiv() {

    var type = document.getElementById('type').value;
    var personalDiv = document.getElementById('personal');
    var corporateDiv = document.getElementById('corporate');

    if (type === 'Individual') {
      personalDiv.style.display = 'block';
      corporateDiv.style.display = 'none';
    } else if (type === 'Corporate') {
      personalDiv.style.display = 'none';
      corporateDiv.style.display = 'block';
    } else {
      personalDiv.style.display = 'none';
      corporateDiv.style.display = 'none';
    }
  }

  // Add the following line to call the toggleDiv() function initially when the page loads
  toggleDiv();

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

  var category_list = <?php echo json_encode($category_list); ?>;

  function calculateAmount() {

    var selectedCategory = document.getElementById('categories').value;

    var multiples = parseInt(document.getElementsByName('multiples')[0].value);

    var categoryValue = parseInt(category_list[selectedCategory]);

    if (!isNaN(categoryValue)) {
      categoryValue = parseInt(categoryValue);
    } else {
      categoryValue = 0;
    }

    var amount = multiples * categoryValue;

    document.getElementsByName('amount')[0].value = amount;
  }

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
      } else {
        // Invalid Aadhaar card number
        errorMessage = "Please enter a valid Company Aadhaar card number.";
      }
    }

    // Display the error message in the companyAadhaarErrorDiv element
    companyAadhaarErrorDiv.textContent = errorMessage;
  }

  function clearCompanyPanErrorMessage() {
    var companyPanErrorDiv = document.getElementById("companyPanErrorMessage");
    companyPanErrorDiv.textContent = "";
  }

  function clearCompanyAadhaarErrorMessage() {
    var companyAadhaarErrorDiv = document.getElementById("companyAadhaarErrorMessage");
    companyAadhaarErrorDiv.textContent = "";
  }

  var category_list = <?php echo json_encode($category_list); ?>;

  function calculateAmount_c() {

    var selectedCategory = document.getElementById('categories_c').value;

    var multiples = parseInt(document.getElementsByName('multiples_c')[0].value);

    var categoryValue = parseInt(category_list[selectedCategory]);

    if (!isNaN(categoryValue)) {
      categoryValue = parseInt(categoryValue);
    } else {
      categoryValue = 0;
    }

    var amount = multiples * categoryValue;

    document.getElementsByName('amount')[1].value = amount;
  }
</script>