<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="assets/images/logo/favicon-icon.png" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/logo/favicon-icon.png" type="image/x-icon">
  <title>Sanidhya - The Art of Living </title>
  <!-- Google font-->

  <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<style>
  .swal2-popup {
    font-size: 10px !important;
    width: 300px;
  }

  .landing-page .title h1 {
    color: #eea710;
  }

  .landing-page .title h1:before {
    background-color: #fd7e14;
  }

  .landing-page .title h1:after {
    background-color: #fd7e14;
  }

  h6 {
    color: #333;
    font-size: 20px;
  }

  body {
    color: #FFF;
    background-color: #FD940A;
    background-image: radial-gradient(circle, #f8f3ed 0%, #fcd498 60%, #f5ae42 100%);
  }

  .landing-page .framework ul.framworks-list li {
    background-color: rgba(0%, 0%, 0%, 0);
    border: none;
  }

  .profile_pic {

    height: 112px;
    width: 112px;
    padding: 2px;
    border: 7px solid #f39c12;
    border-radius: 50%;
  }

  .profile_pic img {
    height: 100%;
    width: 100%;
    border-radius: 50%;
  }

  @media (min-width: 900px) {
    .login-new {
      padding: 30px;
      width: 450px;
      margin-left: auto;
      margin-right: auto;
    }
  }

  .landing-page .framework ul.framworks-list li {
    margin: 0px;
  }
</style>

<body class="landing-wrraper">

  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->

  <!-- page-wrapper Start-->
  <div class="page-wrapper landing-page">

    <?php //$otp_new = str_pad(rand(1111, 9999), 4, "0", STR_PAD_LEFT);
    ?>
    <?php $otp_new = "5555" ?>

    <!-- header start-->
    <section>
      <br>

      <div class="custom-container">

        <div class="row">

          <div class="col-sm-12">

            <div class="title" style="margin-bottom:10px">
              <center><img src="assets/images/logo/small-logo.png" width="150"></center>
              <br>
              <h1>Samagra</h1>
            </div>

          </div>

          <div class="col-sm-12 framworks">

            <form method="post" class="login-new" action="{{url('profile_login')}}" autocomplete="off">
              @csrf
              <center>
                <h3 style="margin:15px 0px;color:#333">Sanidhya | Profile Login</h3>
              </center>
              <hr>

              <div class="form-group">
                <div class="input-group">
                  <input style="border-radius:25%;border-radius: 25px;padding: 15px;" onkeyup="checkphn(this.value);" type="tel" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone" maxlength="10" required>
                </div>
              </div>

              <br>

              <div class="form-group" id="otp_div" style="display:none">
                <label style="color:#333" for="">Enter OTP sent to your phone.</label>
                <div class="input-group">
                  <input onkeyup="checkotp(this.value);" style="border-radius:25%;border-radius: 25px;padding: 15px;" class="form-control" type="password" name="otp" placeholder="OTP" required>
                </div>
              </div>

              <br><br>

              <center>
                <button style="border-radius:25%;border-radius: 25px;padding: 15px;font-size:15px;color:#333;font-weight:bolder;display:none" id="login_btn" class="btn btn-primary btn-block" type="submit">LOGIN</button>
              </center>

              <br>

              <div class="form-group">
                <div class="captcha-box">
                  <div class="login-social-title"><br></div>
                  <br>
                  <!-- <center>
                    <h4 style="color:#333">Not yet registered,<a style="color:#333;text-decoration:underline" class="ms-2" href="/login">Contact Admin.</a></h4>
                  </center> -->
                </div>
              </div>
          </div>
          </form>
          <center>
            <div class="form-group">
             <a href="/register"> <button class="btn btn-primary btn-block" type="submit">
                Sign Up
              </button></a>
            </div>
          </center>
    </section>
    <!--header end-->

    <!-- partial -->

  </div>
  <!-- latest jquery-->
  <script src="assets/js/jquery-3.5.1.min.js"></script>

  <!-- Bootstrap js-->
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

  <!-- Script for the Captcha -->
  <script type="text/javascript" src="assets/js/jquery-captcha.js"></script>

  <!-- SweetAlert2 library -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Your custom JavaScript -->
  <script src="assets/js/script.js"></script>

  <script>
    function checkphn(phn) {
      if (phn.length == 10) {
        $.ajax({
          url: '/profile_sms_otp/' + phn + '/{{$otp_new}}',
          type: 'GET',
          success: function(res) {
            if (res == "true") {
              document.getElementById("otp_div").style.display = "block";
            } else {
              Swal.fire({
                icon: 'warning',
                title: 'Number not registered!',
                showConfirmButton: false,
                timer: 2000
              })
              window.location.href = '/register';
            }
          }
        });
      }
    }

    function checkotp(val) {
      if (val.length == 4 && val == "{{$otp_new}}") {
        document.getElementById("login_btn").style.display = "block";
      }
    }

    // step-1
    const captcha = new Captcha($('#canvas'), {
      length: 4
    });

    function check_captcha(val) {
      if (val.length == 4) {
        const ans = captcha.valid($('input[name="code"]').val());
        if (ans) {
          document.getElementById("login_btn").style.display = 'block';
          document.getElementById("valid").style.display = 'none';
        } else {
          captcha.refresh();
        }
      }
    }

    $(document).keypress(
      function(event) {
        if (event.which == '13') {
          event.preventDefault();
        }
      });

    <?php if (!empty(session()->get('failed'))) { ?>
      Swal.fire({
        icon: 'warning',
        title: '<?php echo session()->get('failed'); ?>',
        showConfirmButton: false,
        timer: 2000
      })
    <?php }
    session()->forget('failed'); ?>
  </script>

</body>
@if (session('success'))
<script>
  Swal.fire('Success', '{{ session('
    success ') }}', 'success');
</script>
@endif

@if (session('error'))
<script>
  Swal.fire('Error', '{{ session('
    error ') }}', 'error');
</script>
@endif

@if (session('warning'))
<script>
  Swal.fire('Warning', '{{ session('
    warning ') }}', 'warning');
</script>
@endif

</html>