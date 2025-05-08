<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="/assets/images/logo/favicon-icon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/logo/favicon-icon.ico" type="image/x-icon">
    <title>Apex Admin - TAOL</title>
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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">

    <style>
    #password-strength-status {
        padding: 5px 10px;
        color: #FFFFFF;
        border-radius: 4px;
        margin-top: 5px;
    }

    .medium-password {
        background-color: #b7d60a;
        border: #BBB418 1px solid;
    }

    .weak-password {
        background-color: #ce1d14;
        border: #AA4502 1px solid;
    }

    .strong-password {
        background-color: #12CC1A;
        border: #0FA015 1px solid;
    }
</style>

  </head>
  <body>
    <!-- login page start-->
    <section>         </section>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12">
          <div class="login-card">
          
              <form method="post" class="theme-form login-form" action="/register" autocomplete="off">
                @csrf
          <center><img src="/assets/images/logo/small-logo.png" width="150">
        <h3 style="margin:15px 0px">PRAGATI</h3></center><hr>
                <h4>Sign Up</h4>
                
                <h6>Create your account by filling details below</h6>
                <div class="form-group">
                  <label>Name</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                    <input class="form-control" type="text" name="user_name" placeholder="Enter Name" required>
                  </div>
                </div>
               <div class="row">
                <div class="col-md-6"> <div class="form-group">
                  <label>You are ?</label>
                  <div class="input-group">
                  <select class="form-select" name="user_type">
                   <option value="apex">Apex Member</option>
                   <option value="administrator">State Administrator</option>
                    <option value="accountant">Accountant</option>
                    <option value="ddc">DDC</option>
                    <option value="vdc">VDC</option>
                    <option value="tdc">TDC</option>
                   </select>
                  </div>
                </div></div>
                <div class="col-md-6"> <div class="form-group">
                  <label>Phone</label>
                  <div class="input-group"><span class="input-group-text"><i class="fa fa-phone"></i></span>
                    
                    <input class="form-control" name="user_phone" id="phone_otp" onkeyup="checkphn(this.value);" oninput="numberOnly(this.id);" maxlength="10" type="number" placeholder="Enter Phone" required>
                  </div>
                </div></div>
               </div>
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input class="form-control" type="email" name="user_email" placeholder="Enter Email" required>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label>Password</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    
                    <input class="form-control" name="password" type="password" id="password" placeholder="Enter Password" required>
                      <div id="password-strength-status"></div>
                   
                  </div>
                </div> -->
               
                <div class="form-group">
                  <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                </div>
                <div class="login-social-title">                
                 <br>

                <p>Already have an account?<a class="ms-2" href="/">Log In</a></p>
                </div>
              
              </form>
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
  </body>
</html>


<script>
  $(document).ready(function() {
    $("#password").on('keyup', function() {
      var number = /([0-9])/;
      var alphabets = /([a-zA-Z])/;
      var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
      if ($('#password').val().length < 8) {
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('weak-password');
        $('#password-strength-status').html("Weak (should be atleast 8 characters.)");
      } else {
        if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
          $('#password-strength-status').removeClass();
          $('#password-strength-status').addClass('strong-password');
          $('#password-strength-status').html("Strong");
        } else {
          $('#password-strength-status').removeClass();
          $('#password-strength-status').addClass('medium-password');
          $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters or some combination.)");
        }
      }
    });
  });

  function numberOnly(id) {
    let input = document.getElementById(id);
    let value = input.value;
    if (value.length > input.maxLength) {
      input.value = value.substring(0, input.maxLength);
    }
  }
</script>