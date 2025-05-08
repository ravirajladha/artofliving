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
          <h3>Add Volunteer</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index"> <i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active"> Add User</li>
            <?php if (session('rexkod_admin_user_type') == "admin" || session('rexkod_admin_user_type')=='apex') { ?>
            <li class="breadcrumb-item"><a href="/csvfile/volunteer_upload.csv" download="volunteer_upload.csv" data-bs-original-title="" title="">Download File</a>
          </li>
            <li class="breadcrumb-item active"><a href="add_volunteer_bulk_upload">
               <i data-feather="add_volunteer_bulk_upload"></i>Bulk upload</a>
               </li>
                <?php } ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
      <form action="create_volunteer" method="POST">
        @csrf
        <div class="row">
                <div class="col-xl-12">
            <div class="card">

              <div class="card-body">

             

               

                  


                <div class="row">



                  <div class="col-md-12">
                    <div class="mb-3">
                      <label>Name</label>
                      <input class="form-control" name="name" type="text" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Email</label>
                      <input class="form-control" name="email" type="email" value="{{ old('email') }}" placeholder="Value *" required data-check-email="/check-email">

                      <span id="emailErrorMessage" style="color: red;"></span>
                    </div>
                  </div>

                  <div class="col-md-6">
                <div class="mb-3">
                    <label>Phone</label>
                    <input class="form-control" name="phone" type="tel" placeholder="Value *" data-check-phone="/check-phone" maxlength="10">
                    <span id="mobileErrorMessage" style="color: red;"></span>
                </div>
            </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12">
            <div class="row card-f-end">
              <div class="col">
               
              <button type="submit" class="btn btn-secondary me-3" id="submitButton">Add</button>
              <!-- <button type="submit" class="btn btn-secondary me-3" href="#">Add</button> -->
            </div><br><br>
            

              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@include("inc_sanidhya.footer")

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

  
</script>
<script>
	// new



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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('input[name="phone"]').blur(function() {
            var input = $(this);
            var url = input.data('check-phone');
            var value = input.val();

            // Validate phone number length first
            if (value.length !== 10) {
                var errorMessage = $('<span>').addClass('ph-length-vali text-danger').text('Phone number should be 10 digits');
                input.parent().find('.ph-length-vali').remove(); // Remove any existing error message
                input.after(errorMessage); // Insert error message after the input element
                return; // Stop further processing if the length is not valid
            } else {
                input.parent().find('.ph-length-vali').remove(); // Remove the error message if length is valid
            }

            // Validate phone number using AJAX request
            $.get(url, { phone: value })
                .done(function(response) {
                    console.log(response);

                    if (response.exists) {
                        var errorMessage = $('<span>').addClass('ph-exists-vali text-danger').text('Phone number already exists');
                        input.parent().find('.ph-exists-vali').remove(); // Remove any existing error message
                        input.after(errorMessage); // Insert error message after the input element
                    } else {
                        input.parent().find('.ph-exists-vali').remove(); // Remove the error message if phone number is not taken
                    }
                })
                .fail(function(error) {
                    console.error(error);
                });
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
      var submitBtn = $('#submitBtn');
        $('input[name="email"]').blur(function() {
            var input = $(this);
            var url = input.data('check-email');
            var value = input.val().trim();

            if (value !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { email: value },
                    success: function(response) {
                        console.log(response);

                        if (response.exists) {
                            $('#emailErrorMessage').text('This email is already taken.');
                           if (emailError.text() !== '') {
                            disableSubmitButton();
                        } 
                        } else {
                            $('#emailErrorMessage').text('');
                            enableSubmitButton();
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    });

    function disableSubmitButton() {
        submitBtn.prop('disabled', true);
    }

    function enableSubmitButton() {
        submitBtn.prop('disabled', false);
    }
</script>

