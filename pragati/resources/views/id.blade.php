<?php namespace App\Http\Controllers;
use App\Models\State;
use App\Models\Apex_bodie;
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>body {
    margin:0;
    padding:0;
    font-family:sans-serif;
    background-image: url(/assets/images/bg.png);
    height: 100%;
    top:0px


/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: contain;


}
.card {
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    /* width:300px;
    min-height:400px; */
    background:#fff;
    box-shadow:0 20px 50px rgba(0,0,0,.1);
    border-radius:10px;
    transition:0.5s;
}
.card:hover {
    box-shadow:0 30px 70px rgba(0,0,0,.2);
}
.card .box {
    position:absolute;
    top:50%;
    left:0;
    transform:translateY(-50%);
    text-align:center;
    padding:20px;
    box-sizing:border-box;
    width:100%;
}
.card .box .img {
    width:200px;
    height:100px;
    margin:0 auto;
    border-radius:50%;
    /* overflow:hidden; */
}
​
.card .box h2 {
    font-size:20px;
    color:#262626;
    margin:20px auto;
}
.card .box h2 span {
    font-size:14px;
    background:#e91e63;
    color:#fff;
    display:inline-block;
    padding:4px 10px;
    border-radius:15px;
}
.card .box p {
    color:#262626;
}
.card .box span {
    display:inline-flex;
}
.card .box ul {
    margin:0;
    padding:0;
}
.card .box ul li {
    list-style:none;
    float:left;
}
.card .box ul li a {
    display:block;
    color:#aaa;
    margin:0 10px;
    font-size:20px;
    transition:0.5s;
    text-align:center;
}
.card .box ul li:hover a {
    color:#e91e63;
    transform:rotateY(360deg);
}
.card {
   border: 0px !important;

}
</style>
<?php
if(isset($data['user']->state)){
  $state_cur = State::where('name',$data['user']->state)->first();
  if(isset($state_cur->codes)){
  $state_code = $state_cur->codes;
  }
}


?>

<?php
                    if(isset($data['user']->type)){
                          if($data['user']->type == "apex"){
                            $type_new = "AM";
                          } else if($data['user']->type == "accountant"){
                            $type_new = "AC";
                          } else if($data['user']->type == "administrator"){
                            $type_new = "AD";
                          } else if($data['user']->type == "ddc"){
                            $type_new = "DM";
                          } else if($data['user']->type == "vdc"){
                            $type_new = "VM";
                          } else if($data['user']->type == "tdc"){
                            $type_new = "TM";
                          } else if($data['user']->type == "hq"){
                            $type_new = "HQ";
                          }
                          else{
                            $type_new = NULL;
                          }
                    }


                    if(isset($data['user']->type)){
                          if($data['user']->type == "apex"){
                            $states = explode(',', $data['user']->apex_states);
                            foreach($states as $state){
                              break;
                            }
                            $type_val = State::where('id',$state)->first();
                          } }
                          else {
                            if(isset($data['user']->apex_body_id)){
                            $type_val = Apex_bodie::where('id',$data['user']->apex_body_id)->first();
                            }

                          }



                        if(!empty($data['user']->tenure_from) && !empty($data['user']->tenure_to)){
                          $flag_tenure = 1;
                         $froms = explode(',', $data['user']->tenure_from);
                            foreach($froms as $from){
                         }

                         $tos = explode(',', $data['user']->tenure_to);
                            foreach($tos as $to){
                         }

                         $from = date("d-m-Y", strtotime($from));
                         $to = date("d-m-Y", strtotime($to));

                        }else{
                          $flag_tenure = 0;
                        }


                      if(isset($data['user']->type)){
                          if($data['user']->type == "apex"){
                            $type_new = "AM";
                            $type_name = "Apex Member";
                          } else if($data['user']->type == "accountant"){
                            $type_new = "AC";
                            $type_name = "Accountant";
                          } else if($data['user']->type == "administrator"){
                            $type_new = "AD";
                            $type_name = "Administrator";
                          } else if($data['user']->type == "ddc"){
                            $type_new = "DM";
                            $type_name = "DDC Member";
                          } else if($data['user']->type == "vdc"){
                            $type_new = "VM";
                            $type_name = "VDC Member";
                          } else if($data['user']->type == "tdc"){
                            $type_new = "TM";
                            $type_name = "TDC  Member";
                          } else if($data['user']->type == "hq"){
                            $type_new = "HQ";
                            $type_name = "Admin";
                          }
                      }

                       ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="box">
        <div class="img">
            <img img width="150" class="img-fluid mt-5" src="/assets/images/logo/small-logo.png">
        </div>
        <h5><?php if(isset($type_name))
        {
          echo $type_name;
        }
        ?></h5><br>
        <div class="img-wraper">
                            <div class="avatar">
                            <?php if(isset($data['user']->photo)){ ?>
                              <img style="border-radius: 75px;" width='80' class="img-fluid" alt="Image not available" src="/profiles/<?php echo $data['user']->photo ?>">
                           <?php } ?>
                        </div><br>
        <h3><?php
            if(isset($data['user']->name))
              {
                echo $data['user']->name;
              }

        ?><br></h3>
        <h5> <?php
        if(isset($state_code) && ($type_new.$data['user']->id))
              {
                echo "UID: TAOL".$state_code."".$type_new.$data['user']->id;
              }
         ?>
        </h5>
  <br>
        <h6> <?php
        if(isset($data['userO']->tenure_from))
              {
                $date_array = explode(',', $data['userO']->tenure_from);
                $last_from_date = end($date_array);
                echo "Tenure From: ". $last_from_date . '<br>';

              }
         ?>
        </h6>
        <h6> <?php
        if(isset($data['userO']->tenure_to))
              {
                $date_array = explode(',', $data['userO']->tenure_to);
                $last_to_date = end($date_array);
                echo "Tenure To: ". $last_to_date . '<br>';
              }
         ?>
        </h6>
  <br>
        <h5><?php
              if(isset($data['user']->district) && ($data['user']->state))
              {
                echo $data['user']->district.",".$data['user']->state;
              }

        ?></h5>

        <h5><?php
       if(isset($data['user']->apex_body_id)){
        $apex_body =  Apex_bodie::where('id',$data['user']->apex_body_id)->first();
       }

            if(isset($apex_body->name))
            {
              echo $apex_body->name;
            }
            ?> Apex Body
        </h5>

        <p style="color:#333 !important; font-size:12px !important;margin:10px;margin-bottom: 35%"><br>
This ID is sole property of the Art Of Living Trust. Terms & Conditions apply. This ID issued only in Digital form. It is not a substitute to KYC requirements for any financial purposes.</p>
        <span>


        </span>
        {{-- <a href="{{ route('download-id-card', ['id' => $data['userO']->id]) }}">Download ID Card</a> --}}



    </div>
</div>
