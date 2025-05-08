


  <head>
 
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
 <link rel="icon" href="/assets/images/logo/favicon-icon.png" type="image/x-icon">
 <link rel="shortcut icon" href="/assets/images/logo/favicon-icon.png" type="image/x-icon">
 <title> Asset - AOL </title>
 <!-- Google font-->
 
 

 <link rel="stylesheet" type="text/css" href="/assets/css/vendors/font-awesome.css">


 <!-- Bootstrap css-->
 <link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">
 <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
 

</head>

<style>

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
font-size:20px;
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
 .profile_pic{
  
   height: 112px;
   width: 112px;
   padding: 2px;
   border: 7px solid #f39c12;
   border-radius: 50%;
 }
 .profile_pic img{
   height: 100%;
   width: 100%;
   border-radius: 50%;
 }
 @media (min-width: 900px){
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
   <!-- header start-->
  



<section><br>
<div class="custom-container">
<div class="row">                 
 <div class="col-sm-12"> 
   <div class="title" style="margin-bottom:10px">      
                    <center><img src="/assets/images/logo/small-logo.png" width="150"></center> <br>
     <h1>Samagra</h1>
   </div>
 </div>
 <div class="col-sm-12 framworks"> 
  
 <form method="post" class="login-new" action="/pages/login" autocomplete="off">
            
           <center><h3 style="margin:15px 0px;color:#333">This asset is a property of</h3></center>
           <center><h1 style="margin:15px 0px;color:#333"> THE ART OF LIVING</h1></center>
          
           <br><hr>
             <center><h4 style="color:#333">If found without owner,<a style="color:#333;text-decoration:underline" class="ms-2" href="#">Contact Us.</a></h4></center>
           </form>
 </div>
 <!-- frameworks end-->
</div>
</div>
</section>

<!-- partial -->

</body>
</html>

   <!--footer end-->
 </div>
 <!-- latest jquery-->
 <script src="/assets/js/jquery-3.5.1.min.js"></script>
 <!-- Bootstrap js-->
 <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>

 <script src="/assets/js/script.js"></script>
 <!-- login js-->
 <!-- Plugin used-->
</body>
</html>






<script type="text/javascript" src="/assets/js/jquery-captcha.js"></script>
 <script>
   // step-1
   const captcha = new Captcha($('#canvas'),{
     length: 4
   });

   function check_captcha(val){

     if(val.length == 4){
     const ans = captcha.valid($('input[name="code"]').val());
     if(ans){
       document.getElementById("login_btn").style.display = 'block';
       document.getElementById("valid").style.display = 'none';
     }else {
       captcha.refresh();
     }
    }
   }

   $(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});
</script>
