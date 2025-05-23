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
          <h3>Event Details</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">
                <i data-feather="home"></i>Home</a></li>
            <!-- <li class="breadcrumb-item"></li> -->
            <li class="breadcrumb-item active"> Event Details</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="edit-profile">

      <form action="add_event" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="form theme-form Cubiclecreate">
                  <h4>Event Information</h4>
                  <hr>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Name of the Event</label>
                        <input class="form-control" name="event_name" type="text" placeholder="Value *">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Event Type</label>
                        <select name="event_type" class="form-control" onchange="type_change(this.value)">
                          <option value="0" selected disabled>Select Event Type</option>
                          <option value="1">Vigyan Bhairav</option>
                          <option value="2">Other</option>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Event Name to be on Pass (Line 1) <span style="font-size:10px">(Max 30 Characters)</span></label>
                        <input class="form-control" name="event_name_pass1" type="text" placeholder="Value *">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Event Name to be on Pass (Line 2) <span style="font-size:10px">(Max 30 Characters)</span></label>
                        <input id="eventname2" class="form-control" name="event_name_pass2" type="text" placeholder="Value *">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Location to be on Pass <span style="font-size:10px">(Max 30 Characters)</span></label>
                        <input class="form-control" name="location_pass" type="text" placeholder="Value *">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label>Date to be on Pass <span style="font-size:10px">(Max 30 Characters)</span></label>
                        <input class="form-control" name="date_pass" type="text" placeholder="Value *">
                      </div>
                    </div>


                    <div class="row">

                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label for="exampleInputname1">Event Start Date</label>
                          <input class="form-control" name="event_start_date" type="date" placeholder="Value *">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label for="exampleInputname1">Event End Date</label>
                          <input class="form-control" name="event_end_date" type="date" placeholder="Value *">
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label for="img">Upload Event Image</label>
                          <input class="form-control" type="file" name="event_image" id="img" accept=".png, .jpeg, .jpg, .webp">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <hr>
                      <div class="col-md-12">
                        <label for="exampleInputname1">Contacts (To be published on e-passes)</label>
                      </div>

                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="phone1" type="tel" placeholder="Contact 1" maxlength="10">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="phone2" type="tel" placeholder="Contact 2" maxlength="10">
                        </div>

                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="phone3" type="tel" placeholder="Contact 3" maxlength="10">
                        </div>

                      </div>

                    </div>


                    <div class="row">
                      <hr>
                      <div class="col-md-12"> <label for="exampleInputname1">More Information (To be published on e-passes)</label></div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="session1" type="text" placeholder="Line 1">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="session2" type="text" placeholder="Line 2">
                        </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="session3" type="text" placeholder="Line 3">
                        </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="session4" type="text" placeholder="Line 4">
                        </div>

                      </div>

                    </div>

                    <div class="row">
                      <hr>
                      <div class="col-md-12"> <label for="exampleInputname1">Team Name (To be mentioned on WhatsApp message)</label></div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label for="exampleInputname1"></label>
                          <input class="form-control" name="team_name" type="text" placeholder=" Enter team name">
                        </div>
                      </div>


                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <!-- <div class="form theme-form Cubiclecreate"> -->
                <h4>Venue Information</h4>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="exampleInputname1">Venue Name</label>
                      <input class="form-control" name="venue_name" type="text" placeholder="Value *">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="exampleInputname1">Venue Strength</label>
                      <input class="form-control" name="venue_strength" type="number" placeholder="Value *">
                    </div>

                  </div>

                </div>


                <div class="row">

                  <div class="container"><br>
                    <h6><b>Categories</b></h6>
                    <hr>
                    <div class="row clearfix">
                      <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                          <thead>
                            <tr>
                              <th class="text-center">
                                Name
                              </th>
                              <th class="text-center">
                                Donation Value
                              </th>
                              <th class="text-center">
                                Strength
                              </th>
                              <th class="text-center">
                                Reserved
                              </th>

                              <th class="text-center">

                              </th>

                            </tr>
                          </thead>
                          <tbody>
                            <tr id='addr0' data-id="0" class="hidden">
                              <td data-name="cat_name">
                                <input type="text" name='cat_name[]' placeholder='Name' class="form-control" />
                              </td>
                              <td data-name="cat_value">
                                <input type="number" name='cat_value[]' placeholder='Value' class="form-control" />
                              </td>
                              <td data-name="cat_strength">
                                <input type="number" name='cat_strength[]' placeholder='Total' class="form-control" />
                              </td>
                              <td data-name="cat_reserved">
                                <input type="number" name='cat_reserved[]' placeholder='Reserved' class="form-control" />
                              </td>


                              <td data-name="del">
                                <button type="button" name="del0" class='btn btn-xs btn-warning row-remove'><span aria-hidden="true">×</span></button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <a id="add_row" style="float:right;margin-top:10px;padding:5px 10px" class="btn btn-xs btn-success float-right">Add More</a>

                  </div>


                </div>








              </div>
            </div>


            <div class="col-xl-12">
              <div class="card">
                <div class="card-body">
                  <!-- <div class="form theme-form Cubiclecreate"> -->
                  <h4>Apex Admin</h4>
                  <hr>


                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label for="exampleInputname1">Assign Apex Admins</label>
                        <select required name="apex_admins[]" multiple class="form-control select2">
                          <?php foreach ($data['apex_admins'] as $apex) {
                          ?>
                            <option value="<?php echo $apex->id; ?>"><?php echo $apex->name; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>











                  <div class="row card-f-end">

                    <div class="col"><br>
                      <hr>
                      <div class="text-end"><button type="submit" class="btn btn-secondary me-3" href="#">Create</button></div><br><br>
                    </div>
                  </div>
                </div>



              </div>
            </div>

      </form>

    </div>
    <!-- </div> -->


  </div>
</div>
</div>
</div>
</div>

@include("inc_sanidhya.footer")

<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>



<script>
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
        id: "addr" + newid,
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

  function find_pincode(pin) {
    if (pin.length == 6) {
      $.ajax({
        url: 'check_pincode',
        type: 'POST',
        data: {
          pin
        },

        success: function(res) {
          var detail = res.split(',');
          document.getElementById("district").value = detail[0];
          document.getElementById("state").value = detail[1];
        }

      });
    } else {
      document.getElementById("from_city").value = "";
      document.getElementById("from_state").value = "";
    }
  }
</script>
<script>
  // avatar pic display on upload
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

<script>
  function type_change($type) {
    if ($type == "1") {
      $("#eventname2").val("");
      $("#eventname2").css('background-color', '#eee');
      $("#eventname2").prop('disabled', true);
    }
    if ($type == "2") {
      $("#eventname2").css('background-color', '#fff');
      $("#eventname2").prop('disabled', false);
    }
  }
</script>


<script>
  $(document).ready(function() {
    $('.select2').select2({
      closeOnSelect: false,
      allowClear: false
    });
  });
</script>