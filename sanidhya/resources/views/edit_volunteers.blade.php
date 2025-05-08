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
            <li class="breadcrumb-item"><a href="index">Home</a></li>
            <li class="breadcrumb-item active"> Add User</li>
            <?php if (session('rexkod_admin_user_type') == "admin") { ?>
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
      @foreach($edit as $edits)



      <form action="/Update_volunteer" method="POST">
        @csrf
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label>Name</label>
                      <input class="form-control" name="name" value="{{$edits->name}}" type="text" placeholder="Value *">
                      <input type="hidden" name="volunteers_id" value="{{$edits->id}}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Email</label>
                      <input class="form-control" name="email" value="{{$edits->email}}" type="email" placeholder="Value *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label>Phone</label>
                      <input class="form-control" name="phone" value="{{$edits->phone}}" type="number" placeholder="Value *">
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
      </form>
      @endforeach
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