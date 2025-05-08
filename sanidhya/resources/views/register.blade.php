<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Art of Living">
    <meta name="keywords" content="AOL">
    <meta name="author" content="kods">
    <link rel="icon" href="/assets/images/logo/favicon-icon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/logo/favicon-icon.ico" type="image/x-icon">
    <title>Sanidhya - The Art of Living </title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/prism.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
</head>

<style>
    .logo-wrapper img,
    .logo-icon-wrapper img {
        height: 55px !important;
        padding-top: 20px !important;
        text-align: center
    }

    .logo-wrapper,
    .logo-icon-wrapper {
        padding: 0px 35px !important;
    }
</style>

<body>
    <!-- Loader starts -->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-ball"></div>
        </div>
    </div>
    <!-- Loader ends-->

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <section></section>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">

                        <form method="post" class="theme-form login-form" action="/profile_register" autocomplete="off">
                            @csrf
                            <center>
                                <img src="/assets/images/logo/small-logo.png" width="150" />
                                <h3 style="margin: 15px 0px">SANIDHYA</h3>
                            </center>

                            <hr />

                            <h4>Sign Up</h4>
                            <h6>Create your account by filling details below</h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                            <input class="form-control" type="text" name="first_name" placeholder="Enter First Name" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                            <input class="form-control" type="text" name="last_name" placeholder="Enter Last Name" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <div class="input-group">
                                    <select class="form-select" name="user_type">
                                        <option value="Individual">Individual</option>
                                        <option value="Corporate">Corporate</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    <input class="form-control" type="tel" name="user_phone" placeholder="Enter Phone" onblur="checkphone()" required maxlength="10" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="email" name="user_email" placeholder="Enter Email" data-check-email="/check-user-email" required />
                                </div>
                                <span id="emailErrorMessage" style="color: red;"></span>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Sign Up
                                </button>
                            </div>

                            <div class="login-social-title">
                                <br />
                                <p>
                                    Already have an account?<a class="ms-2" href="/profilelogin">Log In</a>
                                </p>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-wrapper end-->

    <!-- latest jquery-->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <script>
        function checkphone() {
            const phoneNumber = document.querySelector('input[name="user_phone"]').value;

            // Check if the entered phone number has 10 digits
            if (phoneNumber.length !== 10 || isNaN(phoneNumber)) {
                // Display an error message using SweetAlert
                Swal.fire({
                    icon: 'warning',
                    title: 'Please enter a 10-digit phone number.',
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }

            // If the phone number is valid, send an AJAX request
            $.ajax({
                url: '/profile_checkphone',
                method: 'GET',
                data: {
                    phone: phoneNumber
                },
                dataType: 'json', // Expecting JSON response from the server
                success: function(response) {
                    if (response.exists === true) {
                        // User already registered
                        Swal.fire({
                            icon: 'warning',
                            title: 'User Already Registered',
                            text: 'The user has already registered.',
                        }).then(() => {
                            window.location.href = '/profilelogin';
                        });
                    } else {
                        // New User - You can add further handling for new users if required
                    }
                },
                error: function(error) {
                    console.error('AJAX Error:', error);
                },
            });
        }
    </script>
</body>

<script>
    $(document).ready(function() {
        var emailInput = $('input[name="user_email"]');
        var signUpButton = $('button[type="submit"]');

        emailInput.blur(function() {
            var input = $(this);
            var url = '{{ route("check.user.email") }}'; // Use the named route
            var value = input.val().trim();

            if (value !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: { user_email: value },
                    success: function(response) {
                        console.log(response);

                        if (response.exists) {
                            $('#emailErrorMessage').text('This email is already taken.');
                            signUpButton.prop('disabled', true); // Disable the button
                        } else {
                            $('#emailErrorMessage').text('');
                            signUpButton.prop('disabled', false); // Enable the button
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        // Handle the error appropriately
                    }
                });
            }
        });
    });
</script>


</html>