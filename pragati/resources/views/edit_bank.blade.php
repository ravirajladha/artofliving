@include("inc.header")

<?php $bank = $data['banks']; ?>
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
                     Edit Bank</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index">
                      <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Edit Bank </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <form action="/update_bank" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form theme-form projectcreate">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="col">
                          <div class="mb-3">
                            <label>Apex Body</label>
                            <select class="form-select" name="apex_body">
                            <option selected disabled>Select an Apex Body</option>
                            <?php foreach($data['apex_bodies'] as $apex_body){
                            ?>
                            <option value="<?php echo $apex_body->id;?>" <?php if($apex_body->id == $bank->apex_body_id){echo "selected";}?>><?php echo $apex_body->name; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      </div>

                      <!-- <div class="row">
                        <div class="col">
                        <div class="mb-3">
                        <label for="exampleInputname1">Assign Members</label>
												<select name="members[]" multiple class="js-example-placeholder-multiple col-sm-12" style="height:200px !important">
												<?php
                        // $members1 = explode(', ', $bank->members);

                       // foreach($data['all_apex'] as $apex){?>

												<option <?php //if(in_array($apex->id,$members1)){echo "selected";}?> value="<?php //echo $apex->id;?>" ><?php //echo $apex->name; ?></option>
												<?php //} ?>
												</select>
                          </div>
                        </div>
                      </div> -->
                      <!-- style="height:200px !important" -->
                      <div class="row">
                        <div class="col">
                        <div class="mb-3">
                        <label for="exampleInputname2">Assign Accountant</label>
												<select name="accountant" class="form-select">
												<?php foreach($data['all_apex'] as $apex){?>
												<option value="<?php echo $apex->id;?>" ><?php echo $apex->name; ?></option>
												<?php } ?>
												</select>


                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Account Name</label>
                            <input class="form-control" type="text" name="account_name" value="<?php echo $bank->account_name;?>"  placeholder="Enter Account Name">
                            <input class="form-control" name="id" value="<?php echo $bank->id; ?>" type="hidden" placeholder="Value *" readonly>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Account Number</label>
                            <input class="form-control" type="text" name="account_number" value="<?php echo $bank->account_number;?>" placeholder="Enter Account Number">
                          </div>
                        </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>IFSC Code</label>
                            <input class="form-control" type="text" name="ifsc_code" placeholder="Enter IFSC Code" value="<?php echo $bank->ifsc_code;?>">
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Customer ID</label>
                            <input class="form-control" type="text" name="customer_id" placeholder="Enter Customer ID" value="<?php echo $bank->customer_id;?>">
                          </div>
                        </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Home Branch Address</label>
                            <input class="form-control" type="text" name="home_branch_address" placeholder="Enter Branch Address" value="<?php echo $bank->home_branch_address;?>">
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Account Opening Date</label>
                            <input required class="form-control" type="date" name="account_opening_date" value="<?php echo $bank->account_opening_date;?>" placeholder="">
                          </div>
                        </div>
                        </div>
                      </div>
                      {{-- C:\xampp\htdocs\pragati\public\profiles\s_1681200772.jpg --}}
                      <div class="row">
                        <div class="col-md-6">
                            <div class="col">
                              <div class="mb-3">
                                <label>Authorized Signatory</label>
                                <input class="form-control" type="text" name="authorized_signatory" value="<?php echo $bank->authorized_signatory;?>" placeholder="Enter Authorized Signatory">
                              </div>
                            </div>
                            </div>

                        <div class="col-md-6">
                        <div class="col">
                          <div class="mb-3">
                            <label>Upload Signature Card
                              <?php if(!empty( $bank->signature_card)){ ?>
                              <a href="/profiles/<?php echo $bank->signature_card;?>" target="_blank" ><i class="fa fa-eye"></i></a>
                              <?php } ?>
                            </label>
                            <input class="form-control" type="file" name="signature_card">
                          </div>
                        </div>
                        </div>
                      </div>




                      <div class="row">
                        <div class="col">
                          <div class="text-end"><button class="btn btn-secondary me-3" type="submit">Update</button></div>
                        </div>
                      </div>
                    </div>
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
       $(".tenure2").hide();
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




          function valueChanged()
          {
              if($('#tenure1_check').is(":checked"))
                  $(".tenure2").show();
              else
                  $(".tenure2").hide();
          }

    </script>
