<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Document;
use Storage;

?>
@include("inc.header")
<?php


$request = $data['request'];

if(isset($request->status)){
$status = $request->status;

if($status == "0"){
$stat = "Requested";
} else if($status == "1"){
$stat = "Processed by Coordinator";
} else if($status == "2"){
$stat = "Not Processed by Coordinator";
} else if($status == "11"){
$stat = "Further Approval Required";
} else if($status == "3"){
$stat = "Processed by Director";
} else if($status == "4"){
$stat = "Not Processed by Director";
} else if($status == "5"){
$stat = "Assigned to Trust Office";
} else if($status == "6"){
$stat = "Processed by Trust Office";
} else if($status == "7"){
$stat = "Not Processed by Trust Office";
} else if($status == "8"){
$stat = "Assigned to Trustee";
} else if($status == "9"){
$stat = "Processed by Trustee";
} else if($status == "10"){
$stat = "Not Processed by Trustee";
}

}


if(isset($request->request_user_id)){
$user = User::where('id', $request->request_user_id)->first();
}
if(isset($request->document_type)){
$document = Document::where('id', $request->document_type)->first();
}
?>

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Request <span style="font-size:12px"> ( <?php if(isset($stat)){echo $stat;} ?> )</span></h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Request</li>
                  </ol>
                </div>
              </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
              <div class="email-wrap">
                <div class="row">

                  <div class="col-xl-12 box-col-12 col-md-12 xl-100">
                    <div class="email-right-aside">
                    <?php if(isset($request->document)){ if($request->document){ ?>
                      <div class="card email-body">
                        <div class="email-profile">
                          <div class="email-body">
                            <div class="email-compose">

                              <div class="email-wrapper">

                                  <div class="form-group">
                                  <label class="col-form-label pt-0" for="exampleInputEmail1">Document</label>
                                   <br><h3>

                                      <a target="_blank" href="/profiles/<?php echo $request->document ?>" >View Document
                                        </a>


                                  </h3>



                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } }?>
                      <div class="card email-body">
                        <div class="email-profile">
                          <div class="email-body">
                            <div class="email-compose">

                              <div class="email-wrapper">

                                  <div class="form-group">

                                   <label class="col-form-label pt-0" for="exampleInputEmail1">Request From</label>
                                   <br><h3> <?php if(isset($user->name)){echo $user->name;} ?></h3>

                                   <label class="col-form-label pt-0" for="exampleInputEmail1">Request Remark</label>
                                   <br><h3> <?php if(isset($request->request_remark)){echo $request->request_remark;} ?></h3>


                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                      <?php if(isset($request->response_remark)){
                        if($request->response_remark){ ?>
                      <div class="card email-body">
                        <div class="email-profile">
                          <div class="email-body">
                            <div class="email-compose">

                              <div class="email-wrapper">

                                  <div class="form-group">

                                   <label class="col-form-label pt-0" for="exampleInputEmail1">Coordinator Remark</label>
                                   <br><h3> <?php echo $request->response_remark; ?></h3>



                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php }} ?>
                      <?php if(isset($request->response_remark2)){
                        if($request->response_remark2){ ?>
                      <div class="card email-body">
                        <div class="email-profile">
                          <div class="email-body">
                            <div class="email-compose">

                              <div class="email-wrapper">

                                  <div class="form-group">

                                   <label class="col-form-label pt-0" for="exampleInputEmail1">Director Remark</label>
                                   <br><h3> <?php echo $request->response_remark2; ?></h3>



                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php }} ?>
                      <?php if(isset($request->response_remark3)){
                        if($request->response_remark3){ ?>
                      <div class="card email-body">
                        <div class="email-profile">
                          <div class="email-body">
                            <div class="email-compose">

                              <div class="email-wrapper">

                                  <div class="form-group">

                                   <label class="col-form-label pt-0" for="exampleInputEmail1">Head Office Remark</label>
                                   <br><h3> <?php echo $request->response_remark3; ?></h3>



                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } } ?>
                      <?php if(isset($request->response_remark4)){
                        if($request->response_remark4){ ?>
                      <div class="card email-body">
                        <div class="email-profile">
                          <div class="email-body">
                            <div class="email-compose">

                              <div class="email-wrapper">

                                  <div class="form-group">

                                   <label class="col-form-label pt-0" for="exampleInputEmail1">Trustee Remark</label>
                                   <br><h3> <?php echo $request->response_remark4; ?></h3>



                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php }} ?>

                      <div class="card email-body">
                        <div class="email-profile">
                          <div class="email-body">
                            <div class="email-compose">

                              <div class="email-wrapper">
                                <form class="theme-form" action="/update_request/<?php echo $data['request']->id; ?>" method="POST" enctype="multipart/form-data">
                                  @csrf

                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Upload Document</label>
                                    <input class="form-control" id="exampleInputPassword1" type="file" name="document">
                                  </div>

                                  <?php if(session('rexkod_apex_user_type') == "hq"){ ?>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Trustee</label>
                                    <select name='trustee_id' class='form-control'>
                                      <option selected disabled>Select a trustee ( if further approval required )</option>
                                      <?php foreach($data['trustees'] as $trustee){ ?>
                                      <option value="<?php echo $trustee->id; ?>"> <?php echo $trustee->name; ?> </option>
                                      <?php } ?>
                                      </select>
                                  </div>
                                  <?php } ?>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Remark</label>
                                    <input class="form-control" id="exampleInputPassword1" type="text" name="remark">
                                  </div>

                                  <div class="action-wrapper">
                                  <ul class="actins">
                                    <li><input required type="radio" name="action" value="1"> Processed</li>
                                    <li><input required type="radio" name="action" value="2"> Not Processed</li>
                                    <?php if(Session::get('rexkod_apex_user_type') != "trustee"){ ?>
                                    <li><input required type="radio" name="action" value="3"> Further Approval</li>
                                    <?php } ?>
                                  </ul>
                                  <ul class="actions">
                                    <li><li><button class="btn btn-warning" type="submit">Submit </button></li></li>

                                  </ul>

                                </div>
                                </form>



                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>
        </div>

        @include("inc.footer")


