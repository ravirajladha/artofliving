@include("inc.header")
<link rel="stylesheet" type="text/css" href="assets/css/vendors/select2.css">

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
                  <h3>
                    Generate Report</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Search </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="/result" method="POST">
            @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <div class="row">


                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="">User Type</label>
                        <select name="user_type" class="form-select">
                        <option value="trustee">Trustee</option>
                        <option value="director">Directors</option>
                        <option value="coordinator">Coordinators</option>
                        <option value="apex">Apex Members</option>
                        <option value="administrator">Administrators</option>
                        <option value="accountant">Accountants</option>
                        <option value="ddc">DDC</option>
                        <option value="tdc">TDC</option>
                        <option value="vdc">VDC</option>
                        </select>
                        </div>
                      </div>



                      <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="">Apex Body</label>
                        <select name="apex_body" class="form-select">
                          <option value="all">All</option>
                          @foreach($data['apex_bodies'] as $apex_body)
                          <option value="{{$apex_body->id}}">{{$apex_body->name}}</option>
                          @endforeach
                        </select>
                        </div>
                      </div>

                    </div>




                    <div class="row">


                      <div class="col-sm-3">
                        <div class="mb-3">
                        <label for="">Profession</label>
                        <select name="profession" class="form-select">
                          <option value="all">All</option>
                        @foreach($data['professions'] as $profession)
                        <option value="{{$profession->id}}">{{$profession->name}}</option>
                        @endforeach
                        </select>
                        </div>
                      </div>



                      <div class="col-sm-3">
                        <div class="mb-3">
                        <label for="">Post</label>
                        <select name="post" class="form-select">
                        <option value="all">All</option>
                        @foreach($data['posts'] as $post)
                        <option value="{{$post->id}}">{{$post->name}}</option>
                        @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3">
                        <label for="">Qualification</label>
                        <select name="qualification" class="form-select">
                        <option value="all">All</option>
                        @foreach($data['qualifications'] as $qualification)
                        <option value="{{$qualification->id}}">{{$qualification->name}}</option>
                       @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3">
                        <div class="col">
                          <label for="">.</label>
                          <div class="text-end"><button class="btn btn-secondary me-3" type="submit">Search</button></div>
                        </div>
                        </div>
                      </div>
                    </div>





                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                   <h4>Visitors: <span style="font-size:20px">{{$data['visitors']->pc_val}}</span></h4>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          </form>
          <!-- Container-fluid Ends-->
        </div>

        @include("inc.footer")
        <script src="assets/js/select2/select2.full.min.js"></script>
    <script src="assets/js/select2/select2-custom.js"></script>



    <script>

      function find_district(state){
				$.ajax({
					url  : 'pages/get_district',
					type : 'POST',
					data : {state},

					success : function(res)
					{
            $('#pdistrict').html($(res));
					}

				});

			}




          function valueChanged()
          {
              if($('#tenure1_check').is(":checked"))
                  $(".tenure2").show();
              else
                  $(".tenure2").hide();
          }

        $('#user_type').on('change', function()
        {
            if(this.value == "trustee" || this.value == "apex"){
            document.getElementById("state").style.display = "block";
            document.getElementById("apex_body").style.display = "none";
            } else if(this.value == "ddc" || this.value == "tdc" || this.value == "vdc" || this.value == "accountant" || this.value == "administrator"){
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "block";
            }else {
            document.getElementById("state").style.display = "none";
            document.getElementById("apex_body").style.display = "none";
            }
        });

    </script>
