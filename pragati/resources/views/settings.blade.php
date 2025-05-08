@include('inc.header')
<?php 
$user = $data['get_user_detail'];
?>
<style>
  .field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
  }


</style>
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
          <h3>Settings</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active"> Settings</li>
          </ol>
        </div>
      </div>
    </div>
  </div> <form action="/update_settings/<?php echo $user->id; ?> " method="POST" enctype="multipart/form-data">
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">
     
        <div class="row">

          
            <div class="col-xl-12">


            <div class="card">

            <div class="card">

<div class="card-body">

<div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label>Name</label>
        <input class="form-control" name="name" type="text" value="<?php echo $user->name; ?>" placeholder="Value *">
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label>Email</label>
        <input class="form-control" name="email" type="email" value="<?php echo $user->email; ?>" placeholder="Value *">
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label>Phone</label>
        <input class="form-control" name="phone" type="number" value="<?php echo $user->phone; ?>" placeholder="Value *">
      </div>
    </div>


    <div class="col-md-6">
      <div class="mb-3">
        <label>Password
        </label>
        <input id="password-field" type="password" class="form-control" name="password" placeholder="Enter New Password">
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

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
                <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Update</button></div><br><br>
              </div>
            </div>
          </div>

                </div>
              </div>
            </div>
          </div>
       

        

        
      </form>
    </div>

    @include('inc.footer')

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

  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
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