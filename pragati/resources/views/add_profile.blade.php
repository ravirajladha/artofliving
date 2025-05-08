@include('inc.header')
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
    <title>Apex Admin - TAOL </title>
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
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
  </head>

<style>
    .logo-wrapper img, .logo-icon-wrapper img {
    height: 55px !important;
    padding-top:20px !important;
    text-align:center
}
.logo-wrapper, .logo-icon-wrapper {
    padding: 0px 35px !important;
}
.loader-bar{
  background:#bbb;
}
</style>

  <body>

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

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index"><img class="img-fluid" src="/assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar">
              <div class="status_toggle sidebar-toggle d-flex">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g>
                    <g>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                  </g>
                </svg>
              </div>
            </div>
          </div>
          <div class="left-side-header col ps-0 d-none d-md-block">

          </div>
          <div class="nav-right col-10 col-sm-6 pull-right right-header p-0">
            <ul class="nav-menus">

<!--
              <li class="onhover-dropdown">
                <div class="notification-box">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9961 2.51416C7.56185 2.51416 5.63519 6.5294 5.63519 9.18368C5.63519 11.1675 5.92281 10.5837 4.82471 13.0037C3.48376 16.4523 8.87614 17.8618 11.9961 17.8618C15.1152 17.8618 20.5076 16.4523 19.1676 13.0037C18.0695 10.5837 18.3571 11.1675 18.3571 9.18368C18.3571 6.5294 16.4295 2.51416 11.9961 2.51416Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M14.306 20.5122C13.0117 21.9579 10.9927 21.9751 9.68604 20.5122" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span class="badge rounded-pill badge-warning">4 </span>
                </div>

                <div class="onhover-show-div notification-dropdown">
                  <div class="dropdown-title">
                    <h3>Notifications</h3><a class="f-right" href="cart.html"> <i data-feather="bell">                           </i></a>
                  </div>
                  <ul class="custom-scrollbar">
                    <li>
                      <div class="media">
                        <div class="notification-img bg-light-primary"><img src="/assets/images/avtar/man.png" alt=""></div>
                        <div class="media-body">
                          <h5> <a class="f-14 m-0" href="user-profile.html">Apple Laptop</a></h5>
                          <p>Transffered</p><span>10:20</span>
                        </div>
                        <div class="notification-right"><a href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li>
                      <div class="media">
                        <div class="notification-img bg-light-secondary"><img src="/assets/images/avtar/teacher.png" alt=""></div>
                        <div class="media-body">
                          <h5> <a class="f-14 m-0" href="user-profile.html">Mahesh Kumar</a></h5>
                          <p>Requested Service</p><span>09:20</span>
                        </div>
                        <div class="notification-right"><a href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li>
                      <div class="media">
                        <div class="notification-img bg-light-info"><img src="/assets/images/avtar/teenager.png" alt=""></div>
                        <div class="media-body">
                          <h5> <a class="f-14 m-0" href="user-profile.html">Ramesh Kumar</a></h5>
                          <p>Raised Service Tickets</p><span>07:20</span>
                        </div>
                        <div class="notification-right"><a href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>

                    <li class="p-0"><a class="btn btn-primary" href="#">Check all</a></li>
                  </ul>
                </div>
              </li>
-->
              <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path d="M2.99609 8.71995C3.56609 5.23995 5.28609 3.51995 8.76609 2.94995" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M8.76616 20.99C5.28616 20.41 3.56616 18.7 2.99616 15.22L2.99516 15.224C2.87416 14.504 2.80516 13.694 2.78516 12.804" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M21.2446 12.804C21.2246 13.694 21.1546 14.504 21.0346 15.224L21.0366 15.22C20.4656 18.7 18.7456 20.41 15.2656 20.99" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.2661 2.94995C18.7461 3.51995 20.4661 5.23995 21.0361 8.71995" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg></a></li>
              <li class="profile-nav onhover-dropdown pe-0 py-0 me-0">
                <div class="media profile-media">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a href="/logout"><i data-feather="log-in"> </i><span>Log Out</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"> </div>
            </div>
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>


      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->


        <style>
    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .simplebar-offset {
    height: calc(100vh - 0px) !important;
}
</style>

 <div class="sidebar-wrapper">

            <div class="logo-wrapper">
                <center><a href="index"><img class="img-fluid for-light" src="/assets/images/logo/small-logo.png" alt=""><img class="img-fluid for-dark" src="/assets/images/logo/small-white-logo.png" alt=""></a></center>

              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            </div>

          <hr>


        </div>












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
                  <h3>Add Profile</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active"> Add Profile</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
            <form action="/add_profile" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">



              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form Cubiclecreate">


                    <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media">
                              <center><img class="img-70 rounded-circle" alt="" src="/assets/images/user/7.jpg"></center>
                              <div class="media-body">
                               <center> <h5 class="mb-1 f-14 txt-primary">Profile Image</h5></center>
                                <input class="form-control" name="photo" type="file" placeholder="Value *">
                              </div>
                            </div>
                          </div>
                        </div>

                      <!-- <?php //if(Session::get('rexkod_apex_user_type') == "apex") { ?>
                      <div class="row">
                        <div class="col">
                        <div class="mb-3">
                        <label for="exampleInputname1">Assign States</label>
												<select name="states[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
												<?php //foreach($data['states'] as $state){?>
												<option value="<?php //echo $state->id;?>"><?php //echo $state->name; ?></option>
												<?php //} ?>
												</select>
                          </div>
                        </div>
                      </div>
                    <?php //} else { ?>
                      <div class="row">
                      <div class="col-sm-12">
                        <div class="col">
                          <div class="mb-3">
                            <label>Apex Body</label>
                            <select class="form-select" name="apex_body">
                            <option selected disabled>Select an Apex Body</option>
                            <?php //foreach($data['apex_bodies'] as $apex_body){
                            ?>
                            <option value="<?php //echo $apex_body->id;?>"><?php //echo $apex_body->name; ?></option>
                            <?php //} ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      </div>

                      <?php //} ?> -->

                      <div class="row" id="fo2">
                        <div class="col">
                        <div class="mb-3">
                        <label for="exampleInputname1">Select an Apex Body</label>
												<select name="apexbody" id="apexbody" class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
                        <option selected disabled>Select an Apex Body</option>
												@foreach($data['apex_bodies'] as $apex_body)
												<option value="{{$apex_body->id}}">{{$apex_body->name}}</option>
												@endforeach
												</select>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label>Address</label>
                            <input class="form-control" name="address" type="text" placeholder="Enter Address">
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-sm-4">
                          <div class="mb-3">
                          <label>Pincode</label>
                          <input type="number" class="form-control" placeholder="Enter Pincode" name="pincode" id="pincode" onkeyup="find_pincode(this.value)">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="mb-3">
                          <label>District</label>
                            <input class="form-control" type="text" name="district" id="district" placeholder="" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="mb-3">
                          <label>State</label>
                            <input class="form-control" type="text" name="state" id="state" placeholder="" readonly>
                          </div>
                        </div>

                      </div>

                      <div class="row">


                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Qualification</label>
                            <select class="form-select" name="qualification">
                            <option selected disabled>Select a Qualification</option>
                            <?php foreach($data['qualifications'] as $qualification){?>
                            <option value="<?php echo $qualification->id;?>"><?php echo $qualification->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>




                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label>Profession</label>
                            <select class="form-select" name="profession">
                            <option selected disabled>Select a Profession</option>
                            <?php foreach($data['professions'] as $profession){?>
                            <option value="<?php echo $profession->id;?>"><?php echo $profession->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>

                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" name="birth_date" placeholder="Select Date" >
                        </div>
                      </div>

                      <div class="row">

                      <hr>

                      <div class="row">


<div class="col-sm-12">
 <div class="mb-3">
   <label>Are you Art Of Living Teacher?</label><br>
   Yes <input class="form-conrol" name="is_teacher" type="radio" value="on" placeholder="Value *">
   No <input class="form-conrol" name="is_teacher" type="radio" value="0" placeholder="Value *">
 </div>
</div>

<hr>
<div class="col-sm-12">
 <div class="mb-3">
   <label>Are you currently holding a responsible post in any of our affiliated entities apart from The Art of Living Trust within the AOL ecosystem?</label><br>
   Yes <input onclick="otherpost(1)" class="form-conrol" name="is_other_post" type="radio" value="on" placeholder="Value *">
   No <input onclick="otherpost(0)" class="form-conrol" name="is_other_post" type="radio" value="0" placeholder="Value *">
 </div>
</div>

<script>
 function otherpost(val){
   if(val){
     document.getElementById( 'other_post' ).style.display = 'block';
   } else {
     document.getElementById( 'other_post' ).style.display = 'none';
   }
 }
</script>


<div class="col-md-12" id="other_post" style="display:none">
 <div class="mb-3">
 <label>Select Posts</label><br>
   <select name="other_post[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
     <?php foreach($data['other_posts'] as $other_post){?>
     <option value="<?php echo $other_post->id;?>"><?php echo $other_post->name; ?></option>
     <?php } ?>
   </select>
 </div>
</div>


</div>





</div>

<hr>
<h6 style="margin:10px 0px 20px 0px; font-weight:bolder">Upload KYC Document</h6>
<div class="row">



                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>1. KYC Document Type</label>
                          <select class="form-select" name="kyc_type1">
                            <option selected disabled>Select a Type</option>
                            <option value="Aadhaar Card">Aadhaar Card</option>
                            <option value="Pan Card">Pan Card</option>
                            <option value="Passport">Passport</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                       <div class="mb-3">
                          <label>Upload Document</label>
                          <input class="form-control" name="kyc_document1" type="file">
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>2. KYC Document Type</label>
                          <select class="form-select" name="kyc_type2">
                            <option selected disabled>Select a Type</option>
                            <option value="Aadhaar Card">Aadhaar Card</option>
                            <option value="Pan Card">Pan Card</option>
                            <option value="Passport">Passport</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                       <div class="mb-3">
                          <label>Upload Document</label>
                          <input class="form-control" name="kyc_document2" type="file">
                        </div>
                      </div>










                  </div>

                      <div class="col-sm-12"><hr>
                        <div class="col"><br><br>
                          <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Add</button></div><br><br>
                        </div>
                      </div>
                    </div>


                  </div>  </div>
                </div>


              </div>  </form>
            </div>  </div>
          </div>
        </div>
        @include('inc.footer')

<script src="/assets/js/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2/select2-custom.js"></script>



    <script>

function find_pincode(pin) {

                if (pin.length == 6) {
                $.ajax({
                url: '/pincode/'+pin,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    var detail = res.split(',');
                    document.getElementById("district").value = detail[0];
                    document.getElementById("state").value = detail[1];
                }
            });
        } else {
            document.getElementById("comm_block_p").value = "";
            document.getElementById("comm_state_p").value = "";
        }
    }

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
       id: "addr"+newid,
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

   // add delete button and td
   /*
   $("<td></td>").append(
       $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
           .click(function() {
               $(this).closest("tr").remove();
           })
   ).appendTo($(tr));
   */

   // add the new row
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


</script>
