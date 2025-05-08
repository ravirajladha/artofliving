<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\Bank;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\State;
use App\Models\Pincode;
use App\Models\Project;
use App\Models\Visitor;
use App\Models\District;
use App\Models\Document;
use App\Models\Proposal;
use App\Models\Requests;
use App\Models\Apex_bodie;
use App\Models\Other_post;
use App\Models\Profession;
use App\Models\Requesting;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;


use Barryvdh\Snappy\Facades\SnappyImage;



class Pragati extends Controller
{
    function login(){
        if(Session::has('rexkod_apex_user_id')){
            return redirect('/index');
        }
        return view('login');
    }


    function index(){

      if(!Session::has('rexkod_apex_user_id')){
         return redirect('/');
      }
      else{
                $projects =Project::all();
                $trustee =  User::where('type', 'trustee')->get();
                $all_trustee = count($trustee);
                $apex = User::where('type', 'apex')->get();
                $all_apex = count($apex);
                $ddc = User::where('type', 'ddc')->get();

                $all_ddc = count($ddc);
                // dd($all_ddc);
                $vdc = User::where('type', 'vdc')->get();
                $all_vdc = count($vdc);
                $tdc = User::where('type', 'tdc')->get();
                $all_tdc = count($tdc);
                $accountants = User::where('type', 'accountants')->get();
                $all_accountants = count($accountants);

                $requests = Requests::where('request_user_id', session('rexkod_apex_user_id'))->get();

                $data = [
                        'projects' => $projects,
                        'all_trustee' => $all_trustee,
                        'all_apex' => $all_apex,
                        'all_ddc' => $all_ddc,
                        'all_vdc' => $all_vdc,
                        'all_tdc' => $all_tdc,
                        'requests' => $requests,
                ];
                return view('index',['data' => $data]);
    }

   }


    function upload(){
        return view('upload');
    }
    function upload_banks(){
        return view('upload_banks');
    }




    function registerUser(Request $req){
         // return $req->input();
         // die;
         $result = User::where('email', $req->user_email)->orWhere('phone', $req->user_phone)->first();
        //  $result2 = User::where('phone', $req->user_phone)->first();
         if($result){
             return 'phone or email already exists';
         }else{
            $user=new User;
            $user->name=$req->user_name;
            $user->type=$req->user_type;
            $user->phone = $req->user_phone;
            $user->email=$req->user_email;
            $user->status='0';

            // $uppercase = preg_match('@[A-Z]@', $req->password);
            // $lowercase = preg_match('@[a-z]@', $req->password);
            // $number    = preg_match('@[0-9]@', $req->password);
            // $specialChars = preg_match('@[^\w]@', $req->password);

            // if (!$uppercase || !$lowercase || !$number || !$specialChars ||
            //  strlen($req->password) < 8)  {

            //    return 'Password should be at least 8 characters in length and should include at least
            //        one upper case letter, one number, and one special character."';
            //    return redirect('/add_frontoffice');
            //     die;
            // }
            //$user->password=Hash::make($req->password);
            $user->save();

            $user= User::where('email', $req->user_email)->first();

            Session::put('user',$user);
            Session::put('rexkod_apex_user_name',$user->name);
            Session::put('rexkod_apex_user_id',$user->id);
            Session::put('rexkod_apex_user_email',$user->email);
            Session::put('rexkod_apex_user_type',$user->type);
            Session::put('rexkod_apex_user_status',$user->status);
            Session::put('rexkod_apex_user_phone',$user->phone);


            return redirect('/add_profile');
         }

    }

    function search(){

       $states = State::all();
       $apex_bodies = Apex_bodie::all();
       $professions =Profession::all();
       $posts =Post::all();
       $qualifications =Qualification::all();
       $visitors =Page::where('pc_id', 1)->first();
       $apex = User::where('type', "apex")->get();

       $data = [
        'states' => $states,
        'apex_bodies' => $apex_bodies,
        'professions' => $professions,
        'posts' => $posts,
        'qualifications' => $qualifications,
        'visitors' => $visitors,
        'apex' => $apex,

       ];

       return view('search',['data' => $data]);

    }

    function result(Request $req){
      $state = $req->state;
      // dd($state);
      $apex_body = $req->apex_body;
      $apex = $req->apex;
      $user_type = $req->user_type;
      $status = $req->status;
      $profession = $req->profession;
      $post = $req->post;
      $qualification = $req->qualification;


      $apex_body = Apex_bodie::where('name',$req->apex_body)->first();
      $qualification = Qualification::where('name',$req->qualification)->first();
      $profession = Profession::where('name',$req->profession)->first();
      $post = Post::where('name',$req->post)->first();
      // $prof_val = "";
      // $post_val = "";
      // $qual_val = "";
      // $pro =0;
      // $pos =0;
      // $qua =0;

      //   if($profession != "all"){
      //       $prof_val = "profession = ".$profession;
      //       $pro = 1;
      //   }
      //   if($post != "all"){
      //       $post_val = "post = ".$post;
      //       $pos =1;
      //       if($pro){
      //           $post_val = " AND ".$post_val;
      //       }
      //   }
      //   if($qualification != "all"){
      //       $qual_val = "qualification = ".$qualification;
      //       $qua =1;
      //       if($pos){
      //           $qual_val = " AND ".$qual_val;
      //       }
      //   }


      //   if(!$pro && !$pos && !$qua) {
            $results =User::all();
      //   }
     // else {
      //       $results =User::where('type', '$prof_val.''.$post_val.''.$qual_val')->get();

      //       $this->db->query('SELECT * FROM users WHERE '.$prof_val.''.$post_val.''.$qual_val.' ORDER BY user_id DESC');
      //   }


      $data = [
              'results' => $results,
              'apex_body' => $apex_body,
              'apex' => $apex,
              'user_type' => $user_type,
              'status' => $status,
              'profession' => $profession,
              'qualification' => $qualification,
              'post' => $post,
      ];
      return view('/result',['data' => $data]);


    }


    function users($type){
        $users = User::where('type', $type)->get();
        $data = [
         'users' => $users,
         'type' => $type,
        ];
        return view('users',['data' => $data]);
    }

    function activate_user(Request $req){
        $user = User::where("id",$req->user_id)->first();
        $user->status = $req->status;
        $user->tenure_from = $req->from;
        $user->tenure_to = $req->to;
        $user->save();
        session()->put('success','Activated');
        return redirect()->back();
    }

    function deactivate_user(Request $req){
        $user = User::where("id",$req->user_id)->first();
        $user->status = '0';
        $user->save();
        session()->put('failed','Deactivated');
        return redirect()->back();
    }


    public function sms_otp($phone,$otp){

        $user = User::where("phone",$phone)->first();
        if (!$user) {
            $user = User::where('alternate_phone', $phone)->first();
        }

        $user->last_otp = $otp;
        $user->save();

        if($user){
        $user = 'VVKICRM'; //your username
        $password = 'pass@1981'; //your password
        $mobilenumbers = $phone;//['To']; //enter Mobile numbers comma seperated
        $message = "OTP for mobile verification is: ".$otp." The Art of Living, India, support@artofliving.online"; //enter Your Message // It should be DLT approved.
        $senderid = 'VVKICRM'; //Your senderid
        $messagetype = "N"; //Type Of Your Message
        $DReports = "Y"; //Delivery Reports
        $murl = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
        $message = urlencode($message);
        $ch = curl_init();
        if (!$ch){die("Couldn't initialize a cURL handle");}
        $ret = curl_setopt($ch, CURLOPT_URL,$murl);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt ($ch, CURLOPT_POSTFIELDS,
        "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $curlresponse = curl_exec($ch); // execute

        if(curl_errno($ch))
        echo 'curl error : '. curl_error($ch);

        if (empty($ret)) {
        // some kind of an error happened
        die(curl_error($ch));
        curl_close($ch); // close cURL handler
        } else {
        $info = curl_getinfo($ch);
        curl_close($ch); // close cURL handler
            $send = explode(":", $curlresponse);
            $curlresponse; //echo "Message Sent Succesfully" ;
        }
           echo "true";
        }
        else {
            echo "false";
        }
    }

    function request_document()
        {
                $users = User::where('type', 'trustee')->get();
                $documents = Document::all();
                $data = [
                        'users' => $users,
                        'documents' => $documents,
                ];

      return view('/request_document',['data' => $data]);

        }

        function create_request(Request $req)
        {       $request= new Requests;
                $request->trustee_id = $req->trustee;
                $request->document_type = $req->document_type;
                $request->request_remark = $req->request_remark;
                $request->request_user_id =  Session::get('rexkod_apex_user_id');
                $request->save();
                //$result = $this->send_mail("Request", "process.audit@in.artofliving.org");


                 $requests =Requests::where('request_user_id', Session::get('rexkod_apex_user_id'))->get();

                $data = [
                        'requests' => $requests,
                ];

                if (session('rexkod_apex_user_type') == "hq" || session('rexkod_apex_user_type') == "trustee" || session('rexkod_apex_user_type') == "coordinator" || session('rexkod_apex_user_type') == "director") {
                  return redirect('/all_requests');

                }else{
                  return view('/requests',['data' => $data]);
                }



        }

      function requests()
        {
                $requests =Requests::where('request_user_id', Session::get('rexkod_apex_user_id'))->get();

                $data = [
                        'requests' => $requests,
                ];
                return view('requests',['data' => $data]);

        }


        function request($id)
        {
                $request = Requests::where('id', $id)->first();
                //echo $request->id;die;

                $trustees = User::where('type', 'trustee')->get();
                $data = [
                        'request' => $request,
                        'trustees' => $trustees,
                ];
                return view('request',['data' => $data]);

        }

        function create_state(Request $req)
        {
                $states = new State;
                if (Session::get('rexkod_apex_user_type') == "hq") {

                        $state = strpos($req->state, 'script');
                        if ($state === false) {
                           // tag not found
                           $states->name=$req->state;

                        } else {
                           // tag found
                           $states->name="Wrong data";
                        }

                           $states->save();
                        return redirect('/states');
                } else {
                        return redirect('/access_denied');
                }
        }



        function create_profession(Request $req)
        {
                $state = new Profession;
                if (Session::get('rexkod_apex_user_type') == "hq") {

                  $profession = strpos($req->profession, 'script');
                  if ($profession === false) {
                     // tag not found
                     $profession = Profession::where('name', $req->profession)->first();


                     if($profession)
                     {
                      session()->put('failed',$req->profession. ' name already exist');
                      return redirect()->back();

                     }else
                     {
                        $state->name = $req->profession;

                     }

                  } else {
                     // tag found
                     $state->name="Wrong data";
                  }


                       $state->save();
                       return redirect('/professions');
                } else {
                        return redirect('/access_denied');
                }
        }

        function professions()
        {
                $professions = Profession::orderBy('id', 'desc')->get();
                $data = [
                        'professions' => $professions,
                ];
                return view('professions',['data' => $data]);

        }

        function create_qualification(Request $req)
        {
                $state = new Qualification;
                if (Session::get('rexkod_apex_user_type') == "hq") {

                        $qualification = strpos($req->qualification, 'script');
                        if ($qualification === false) {
                           // tag not found
                           $qualification = Qualification::where('name', $req->qualification)->first();


                           if($qualification)
                           {
                            session()->put('failed', $req->qualification. ' name already exist');
                            return redirect()->back();

                           }else
                           {
                            $state->name = $req->qualification;


                           }

                        } else {
                           // tag found
                           $state->name="Wrong data";
                        }

                       $state->save();
                       return redirect('/qualifications');
                } else {
                        return redirect('/access_denied');
                }
        }

        function qualifications()
        {
                $qualifications = Qualification::orderBy('id', 'desc')->get();
                $data = [
                        'qualifications' => $qualifications,
                ];
                return view('qualifications',['data' => $data]);

        }

        function create_post(Request $req)
        {
                $state = new POst;
                if (Session::get('rexkod_apex_user_type') == "hq") {

                  $post = strpos($req->post, 'script');
                  if ($post === false) {
                     // tag not found
                      $post = POst::where('name', $req->post)->first();
                      if($post)
                      {
                       session()->put('failed',$req->post. ' name already exist');
                       return redirect()->back();

                      }else
                      {
                        $state->name = $req->post;

                      }


                  } else {
                     // tag found
                     $state->name="Wrong data";
                  }

                       $state->save();
                       return redirect('/posts');
                } else {
                        return redirect('/access_denied');
                }
        }

        function posts()
        {
                $posts = POst::orderBy('id', 'desc')->get();
                $data = [
                        'posts' => $posts,
                ];
                return view('posts',['data' => $data]);

        }

        function create_document(Request $req)
        {
                $state = new Document;
               //  if (Session::get('rexkod_apex_user_type') == "hq") {

                           $document = strpos($req->document, 'script');
                           if ($document === false) {
                              // tag not found
                              $document = Document::where('name', $req->document)->first();
                      if($document)
                      {
                       session()->put('failed',$req->document. ' name already exist');
                       return redirect()->back();

                      }else
                      {
                        $state->name=$req->document;

                      }

                           } else {
                              // tag found
                              $state->name="Wrong data";
                           }

                       $state->save();
                       return redirect('/documents');
               //  } else {
                        // return redirect('/access_denied');
               //  }
        }

        function documents()
        {
                $documents = Document::orderBy('id', 'desc')->get();
                $data = [
                        'documents' => $documents,
                ];
                return view('documents',['data' => $data]);

        }

         function create_other_post(Request $req)
        {
                $other_post = new Other_post;
                if (Session::get('rexkod_apex_user_type') == "hq") {

                  $post = strpos($req->post, 'script');
                  if ($post === false) {
                     // tag not found
                     $isExist = Other_post::where('name', $req->post)->first();

                     if($isExist)
                     {
                      session()->put('failed',$req->post. ' name already exist');
                      return redirect()->back();

                     }else
                     {
                        $other_post->name = $req->post;
                     }

                  } else {
                     // tag found
                     $other_post->name="Wrong data";
                  }

                       $other_post->save();
                       return redirect('/other_posts');
                } else {
                        return redirect('/access_denied');
                }
        }

        function other_posts()
        {
                $other_posts = Other_post::orderBy('id', 'desc')->get();
                $data = [
                        'other_posts' => $other_posts,
                ];
                return view('other_posts',['data' => $data]);

        }



        function create_apex_bodies(Request $req)
        {
                $apex_bodiess = new apex_bodie;
                if (Session::get('rexkod_apex_user_type') == "hq") {

                  $apex_bodies = strpos($req->apex_body, 'script');
                  if ($apex_bodies === false) {
                     // tag not found
                    $apex_bodies = apex_bodie::where('name', $req->apex_body)->first();


                    if($apex_bodies)
                    {
                     session()->put('failed', $req->apex_body. ' name already exist');
                     return redirect()->back();

                    }else
                    {
                     $apex_bodiess->name = $req->apex_body;

                    }


                  } else {
                     // tag found
                     $apex_bodiess->name="Wrong data";
                  }

                       $state= $req->state;
                       $state = implode(',', $state);
                       $apex_bodiess->state_id = $state;

                       $apex_bodiess->save();
                       return redirect('/apex_bodies');
                } else {
                        return redirect('/access_denied');
                }
        }

        function apex_bodies()
        {
                $apex_bodies = apex_bodie::orderBy('id', 'desc')->get();
                //$districts = district::orderBy('id', 'desc')->get();
                $states = state::orderBy('id', 'desc')->get();
                $data = [
                        'apex_bodies' => $apex_bodies,
                        //'districts' => $districts,
                        'states' => $states,
                ];
                return view('apex_bodies',['data' => $data]);

        }


        function add_user(){
        $apex_bodies = Apex_bodie::all();
        $professions =Profession::all();
        $posts =Post::all();
        $qualifications =Qualification::all();
        $other_posts =Other_post::all();
        $data = [
            'apex_bodies' => $apex_bodies,
            'professions' => $professions,
            'posts' => $posts,
            'qualifications' => $qualifications,
            'other_posts' => $other_posts,
        ];
        return view('add_user',['data' => $data]);
        }




    function create_user(Request $req){

        $email_check = User::where('email', $req->email)->first();
        if($email_check){
            session()->put('failed','Email already exist');
            return redirect()->back();
        }

        $phone_check = User::where('phone', $req->phone)->first();
        if($phone_check){
            session()->put('failed','Phone number already exist');
            return redirect()->back();
        }

        $user=new User;
        $user->type=$req->type;
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        $user->name=$req->name;
        if (str_contains($req->email, 'script')) { session()->flush(); return redirect('login');}
        $user->email=$req->email;
        $user->status=$req->status;
        $user->phone=$req->phone;
        $user->alternate_phone =  $req->alternate_phone;
        if (str_contains($req->address, 'script')) { session()->flush(); return redirect('login');}
        $user->address=$req->address;
        $user->pincode = $req->pincode;
        $user->district = $req->district;
        $user->state =  $req->state;
        $user->post =  $req->post;
        $user->qualification =  $req->qualification;
        $user->profession =  $req->profession;


        if(isset($req->photo)){
        $extension = $req->file('photo')->extension();
        if(isset($extension)){

            if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                $filename = 'b_'.time().'.'.$extension;
                $req->file('photo')->move(public_path('profiles'), $filename);
                $user->photo = $filename;
            } else {
                session()->put('failed','Invalid Image File');
                return redirect()->back();
            }


        }}
        else {
            $user->photo = NULL;
        }




        $user->birth_date = $req->birth_date;

        if($req->type == "trustee" || $req->type == "coordinator" || $req->type == "director"){
        if(isset($req->apexbodies)){
        $user->apexbody = implode(',', $req->apexbodies);
        } else {
        $user->apexbody = NULL;
        }}
        else {
        $user->apexbody = $req->apexbody;
        }

        $user->tenure_from = implode(',', $req->from);
        $user->tenure_to = implode(',', $req->to);

        if (str_contains($req->additional_information, 'script')) { session()->flush(); return redirect('login');}
        $user->additional_information =  $req->additional_information;


        if(isset($req->kyc_document1)){
            $extension = $req->file('kyc_document1')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename2 = 'k1_'.time().'.'.$extension;
                    $req->file('kyc_document1')->move(public_path('profiles'), $filename2);
                    $user->kyc_document1 = $filename2;
                    $user->kyc_type1 =  $req->kyc_type1;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $user->kyc_document1 = NULL;
                $user->kyc_type1 =  NULL;
        }

        if(isset($req->kyc_document2)){
            $extension = $req->file('kyc_document2')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename3 = 'k2_'.time().'.'.$extension;
                    $req->file('kyc_document2')->move(public_path('profiles'), $filename3);
                    $user->kyc_document2 = $filename3;
                    $user->kyc_type2 =  $req->kyc_type2;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $user->kyc_document2 = NULL;
                $user->kyc_type2 =  NULL;
        }

        if ($req->is_teacher == "on") {
            $is_teacher = 1;
        } else {
            $is_teacher = 0;
        }
        $user->is_teacher = $is_teacher;


        if ($req->is_other_post == "on") {
            if(isset($req->other_post)){
            $other_post = implode(',', $req->other_post);
            }
            else {
            $other_post = NULL;
            }
        } else {
            $other_post = NULL;
        }
        $user->other_post = $other_post;

        $user->save();
        return redirect('users/'.$req->type);

    }



    function edit_user($id){

      $posts = Post::all();
      $apex_bodies = Apex_bodie::all();
      $qualifications = Qualification::all();
      $professions = Profession::all();
      $other_posts =Other_Post::all();
      $states =State::all();
      $all_apex = User::where('type','apex')->get();
      $user = User::where("id",$id)->first();


      $data = [
              'apex_bodies' => $apex_bodies,
              'posts' => $posts,
              'qualifications' => $qualifications,
              'professions' => $professions,
              'other_posts' => $other_posts,
              'user' => $user,
              'apex_bodies' => $apex_bodies,
              'all_apex' => $all_apex,
              'states' => $states,
      ];
      return view('/edit_user',['data'=>$data]);

     }

    function edit_frontoffice($id){

      $posts = Post::all();
      $apex_bodies = Apex_bodie::all();
      $qualifications = Qualification::all();
      $professions = Profession::all();
      $other_posts =Other_Post::all();
      $states =State::all();
      $all_apex = User::where('type','apex')->get();
      $user = User::where("id",$id)->first();

      $data = [
              'apex_bodies' => $apex_bodies,
              'posts' => $posts,
              'qualifications' => $qualifications,
              'professions' => $professions,
              'other_posts' => $other_posts,
              'user' => $user,
              'apex_bodies' => $apex_bodies,
              'all_apex' => $all_apex,
              'states' => $states,
      ];
      return view('/edit_frontoffice',['data'=>$data]);

     }



    function edit_backoffice($id){

      $posts = Post::all();
      $apex_bodies = Apex_bodie::all();
      $qualifications = Qualification::all();
      $professions = Profession::all();
      $other_posts =Other_Post::all();
      $states =State::all();
      $all_apex = User::where('type','apex')->get();
      $user = User::where("id",$id)->first();

      $data = [
              'apex_bodies' => $apex_bodies,
              'posts' => $posts,
              'qualifications' => $qualifications,
              'professions' => $professions,
              'other_posts' => $other_posts,
              'user' => $user,
              'apex_bodies' => $apex_bodies,
              'all_apex' => $all_apex,
              'states' => $states,
      ];
      return view('/edit_backoffice',['data'=>$data]);

     }

     function update_frontoffice(Request $req){

        $user=User::find($req->id);

        //$user->type='apex';
        $user->name=$req->name;
        $user->status=$req->status;
        $user->phone=$req->phone;
        $user->email=$req->email;
        //$user->password=Hash::make($req->password);

      //   $user->save();

      //   $user=User::where('id', $req->id)->first();

        //$user->id = $id->id;
        //$user->trustee_states = implode(',', $req->states);

        $user->pincode = $req->pincode;
        $user->district = $req->district;
        //$user->states = $req->states;
        $user->state =  $req->state;
        $user->post =  $req->post;
        $user->qualification =  $req->qualification;
        $user->profession =  $req->profession;

        $user->alternate_phone =  $req->alternate_phone;

        if(isset($req->apex_body)){
         $user->apexbody = $req->apex_body;
         }
         else {
         $user->apexbody = $user->apex_body;
         }
        if(isset($req->other_post)){
         $user->other_post = $req->other_post;
         }
         else {
         $user->other_post = $user->other_post;
         }

        $address = strpos($req->address, 'script');
        if ($address === false) {
           // tag not found
           $user->address=$req->address;

        } else {
           // tag found
           $user->address="Wrong data";
        }

        $additional_information = strpos($req->additional_information, 'script');
        if ($additional_information === false) {
           // tag not found
           $user->additional_information=$req->additional_information;

        } else {
           // tag found
           $user->additional_information="Wrong data";
        }
        $user->alternate_phone =  $req->alternate_phone;

        if(isset($req->photo)){
         $extension = $req->file('photo')->extension();
         if(isset($extension)){

             if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                 $filename = 'b_'.time().'.'.$extension;
                 $req->file('photo')->move(public_path('profiles'), $filename);
                 $user->photo = $filename;
             } else {
                 session()->put('failed','Invalid Image File');
                 return redirect()->back();
             }


         }}
         else {
             $user->photo = $user->photo;
         }


        if(isset($req->kyc_document1)){
         $extension = $req->file('kyc_document1')->extension();
         if(isset($extension)){

             if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                 $filename2 = 'k1_'.time().'.'.$extension;
                 $req->file('kyc_document1')->move(public_path('profiles'), $filename2);
                 $user->kyc_document1 = $filename2;
                 $user->kyc_type1 =  $req->kyc_type1;
             } else {
                 session()->put('failed','Invalid Image File');
                 return redirect()->back();
             }
         }}
         else {
             $user->kyc_document1 = $user->kyc_document1;
             $user->kyc_type1 =  $user->kyc_type1;
     }

     if(isset($req->kyc_document2)){
         $extension = $req->file('kyc_document2')->extension();
         if(isset($extension)){

             if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                 $filename3 = 'k2_'.time().'.'.$extension;
                 $req->file('kyc_document2')->move(public_path('profiles'), $filename3);
                 $user->kyc_document2 = $filename3;
                 $user->kyc_type2 =  $req->kyc_type2;
             } else {
                 session()->put('failed','Invalid Image File');
                 return redirect()->back();
             }
         }}
         else {
             $user->kyc_document2 = $user->kyc_document2;
             $user->kyc_type2 =  $user->kyc_type2;
     }

        $user->birth_date = $req->birth_date;

        if(isset($req->from)){
         $user->tenure_from = implode(',', $req->from);
         } else {
         $user->tenure_from = $user->tenure_from;
         }

        if(isset($req->to)){
         $user->tenure_to = implode(',', $req->to);
         } else {
         $user->tenure_to = $user->tenure_to;
         }


        $user->save();
        session()->put('success','Updated');

        return redirect('/users/'.$user->type);

      }

      function update_backoffice(Request $req){

        $user=User::find($req->id);

        //$user->type='apex';
        $user->name=$req->name;
        $user->status=$req->status;
        $user->phone=$req->phone;
        $user->email=$req->email;
        if(isset($req->apexbodies)){
         $user->apexbody = implode(',', $req->apexbodies);
         } else {
         $user->apexbody = $user->apexbody;
         }
        //$user->password=Hash::make($req->password);

      //   $user->save();

      //   $user=User::where('id', $req->id)->first();

        //$user->id = $id->id;
        //$user->trustee_states = implode(',', $req->states);

        $user->pincode = $req->pincode;
        $user->district = $req->district;
        //$user->states = $req->states;
        $user->state =  $req->state;
        $user->post =  $req->post;
        $user->qualification =  $req->qualification;
        $user->profession =  $req->profession;

        $user->alternate_phone =  $req->alternate_phone;

        $address = strpos($req->address, 'script');
        if ($address === false) {
           // tag not found
           $user->address=$req->address;

        } else {
           // tag found
           $user->address="Wrong data";
        }

        $additional_information = strpos($req->additional_information, 'script');
        if ($additional_information === false) {
           // tag not found
           $user->additional_information=$req->additional_information;

        } else {
           // tag found
           $user->additional_information="Wrong data";
        }
        $user->alternate_phone =  $req->alternate_phone;

        if(isset($req->photo)){
         $extension = $req->file('photo')->extension();
         if(isset($extension)){

             if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                 $filename = 'b_'.time().'.'.$extension;
                 $req->file('photo')->move(public_path('profiles'), $filename);
                 $user->photo = $filename;
             } else {
                 session()->put('failed','Invalid Image File');
                 return redirect()->back();
             }


         }}
         else {
             $user->photo = $user->photo;
         }

        $user->birth_date = $req->birth_date;

        // $user->tenure_from = $req->from;
         $user->tenure_from = implode(',', $req->from);
        // $user->tenure_to = $req->to;
         $user->tenure_to = implode(',', $req->to);


        $user->save();
        session()->put('success','Updated');

        return redirect('/users/'.$user->type);

      }


     function update_apex(Request $req){

      $user=User::find($req->id);

      //$user->type='apex';
      $user->name=$req->name;
      $user->status=$req->status;
      $user->phone=$req->phone;
      $user->email=$req->email;
      //$user->password=Hash::make($req->password);

      $user->save();

      $user=User::where('id', $req->id)->first();

      //$user->id = $id->id;
      //$user->trustee_states = implode(',', $req->states);

      $user->pincode = $req->pincode;
      $user->district = $req->district;
      //$user->states = $req->states;
      $user->state =  $req->state;
      $user->post =  $req->post;
      $user->qualification =  $req->qualification;
      $user->profession =  $req->profession;

      $user->alternate_phone =  $req->alternate_phone;

      $address = strpos($req->address, 'script');
      if ($address === false) {
         // tag not found
         $user->address=$req->address;

      } else {
         // tag found
         $user->address="Wrong data";
      }

      $additional_information = strpos($req->additional_information, 'script');
      if ($additional_information === false) {
         // tag not found
         $user->additional_information=$req->additional_information;

      } else {
         // tag found
         $user->additional_information="Wrong data";
      }
      $user->alternate_phone =  $req->alternate_phone;

      $extension1 = $req->file('photo')->extension();
      if($extension1 == "png" || $extension1 == "jpeg" || $extension1 == "jpg"){
            $filename = time()."1".'.'.$extension1;
            $user->photo = $req->file('photo')->storeAs('uploads', $filename);
      }
      else{
         return 'Extension must be png/jpg/jpeg/pdf';
          return redirect('/add_frontoffice');
      }

      $extension2 = $req->file('kyc_document1')->extension();
      if($extension2 == "png" || $extension2 == "jpeg" || $extension2 == "jpg"  || $extension2 == "pdf"){
            $filename = time()."2".'.'.$extension2;
            $user->kyc_document1 = $req->file('kyc_document1')->storeAs('uploads', $filename);
      }
      else{
         return 'Extension must be png/jpg/jpeg/pdf';
          return redirect('/add_frontoffice');
      }

      $extension3 = $req->file('kyc_document2')->extension();
      if($extension3 == "png" || $extension3 == "jpeg" || $extension3 == "jpg"  || $extension3 == "pdf"){
            $filename = time()."3".'.'.$extension3;
            $user->kyc_document2 = $req->file('kyc_document2')->storeAs('uploads', $filename);
      }
      else{
         return 'Extension must be png/jpg/jpeg/pdf';
          return redirect('/add_frontoffice');
      }
      $user->birth_date = $req->birth_date;

      // $user->tenure_from = $req->from;
       $user->tenure_from = implode(',', $req->from);
      // $user->tenure_to = $req->to;
       $user->tenure_to = implode(',', $req->to);


      $user->save();
      session()->put('success','Updated');

      return redirect('/all_apex');

    }


    function create_profile(Request $req){

      $user=User::find(Session::get('rexkod_apex_user_id'));

      $user->address = $req->address;
      $user->pincode = $req->pincode;
      $user->district = $req->district;
      $user->state =  $req->state;
      $user->post =  $req->post;
      $user->qualification =  $req->qualification;
      $user->profession =  $req->profession;
      $user->additional_information =  $req->additional_information;
      $user->alternate_phone =  $req->alternate_phone;

      $user->apexbody =  $req->apexbody;

      $user->kyc_type1 =  $req->kyc_type1;
      $user->kyc_type2 =  $req->kyc_type2;

      if ($req->is_teacher == "on") {
         $is_teacher = 1;
      } else {
         $is_teacher = 0;
      }
      $user->is_teacher = $is_teacher;


      if ($req->is_other_post == "on") {
        // $other_post = $req->other_post;
         $other_post = implode(',', $req->other_post);
      } else {
         $other_post = NULL;
      }
      $user->other_post = $other_post;

      if ($req->birth_date) {
         $birth_date = $req->birth_date;
      } else {
         $birth_date = NULL;
      }
       $user->birth_date = $birth_date;

       if(isset($req->photo)){
         $extension = $req->file('photo')->extension();
         if(isset($extension)){

             if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                 $filename = 'b_'.time().'.'.$extension;
                 $req->file('photo')->move(public_path('profiles'), $filename);
                 $user->photo = $filename;
             } else {
                 session()->put('failed','Invalid Image File');
                 return redirect()->back();
             }

         }}
         else {
             $user->photo = NULL;
         }

         if(isset($req->kyc_document1)){
            $extension = $req->file('kyc_document1')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename2 = 'k1_'.time().'.'.$extension;
                    $req->file('kyc_document1')->move(public_path('profiles'), $filename2);
                    $user->kyc_document1 = $filename2;
                    $user->kyc_type1 =  $req->kyc_type1;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $user->kyc_document1 = NULL;
                $user->kyc_type1 =  NULL;
        }

        if(isset($req->kyc_document2)){
            $extension = $req->file('kyc_document2')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename3 = 'k2_'.time().'.'.$extension;
                    $req->file('kyc_document2')->move(public_path('profiles'), $filename3);
                    $user->kyc_document2 = $filename3;
                    $user->kyc_type2 =  $req->kyc_type2;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $user->kyc_document2 = NULL;
                $user->kyc_type2 =  NULL;
        }

      // $user->tenure_from = $req->from;
      // $user->tenure_from = implode(',', $req->from);
      // $user->tenure_to = $req->to;
      // $user->tenure_to = implode(',', $req->to);


      $user->save();

      $name = Session::get('rexkod_apex_user_name');
      $notify = new Notification;

      $notify->from_id = Session::get('rexkod_apex_user_id');
      $notify->to_id = '1';
      $notify->notification = "A new user ".$name." is registered.";
      $notify->status='0';
      $notify->save();

      return redirect('/index');

    }
    function create_bank(Request $req){

        // dd($req->signature_card);
      $bank=new Bank;
      $bank->apex_body_id =  $req->apex_body;
      $bank->members =  $req->accountant;

      $account_name = strpos($req->account_name, 'script');
      if ($account_name === false) {
         // tag not found
         $bank->account_name=$req->account_name;

      } else {
         // tag found
         $bank->account_name="Wrong data";
      }

      $account_number = strpos($req->account_number, 'script');
      if ($account_number === false) {
         // tag not found
         $bank->account_number=$req->account_number;

      } else {
         // tag found
         $bank->account_number="Wrong data";
      }

      $ifsc_code = strpos($req->ifsc_code, 'script');
      if ($ifsc_code === false) {
         // tag not found
         $bank->ifsc_code=$req->ifsc_code;

      } else {
         // tag found
         $bank->ifsc_code="Wrong data";
      }


      $customer_id = strpos($req->customer_id, 'script');
      if ($customer_id === false) {
         // tag not found
         $bank->customer_id=$req->customer_id;

      } else {
         // tag found
         $bank->customer_id="Wrong data";
      }


      $home_branch_address = strpos($req->home_branch_address, 'script');
      if ($home_branch_address === false) {
         // tag not found
         $bank->home_branch_address=$req->home_branch_address;

      } else {
         // tag found
         $bank->home_branch_address="Wrong data";
      }

      $authorized_signatory = strpos($req->authorized_signatory, 'script');
      if ($authorized_signatory === false) {
         // tag not found
         $bank->authorized_signatory = $req->authorized_signatory;

      } else {
         // tag found
         $bank->authorized_signatory="Wrong data";
      }

      $bank->account_opening_date = $req->account_opening_date;



      if(isset($req->signature_card)){
         $extension = $req->file('signature_card')->extension();
         if(isset($extension)){

             if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                 $filename = 's_'.time().'.'.$extension;
                 $req->file('signature_card')->move(public_path('profiles'), $filename);
                 $bank->signature_card = $filename;
             } else {
                 session()->put('failed','Invalid Image File');
                 return redirect()->back();
             }
         }}
         else {
            $bank->signature_card = NULL;
         }


      $bank->save();
      return redirect('/banks');



    }

    function edit_project($id)
    {
            $project = Project::where('id', $id)->first();
            $states = State::all();
            $apex_bodies = Apex_bodie::all();

            $data = [
                    'project' => $project,
                    'states' => $states,
                    'apex_bodies' => $apex_bodies,

            ];
            return view('/edit_project',['data'=>$data]);

    }

    function update_project(Request $req){

      $project=Project::find($req->id);

      $project->apex_body_id =  $req->apex_body;
      $project->remarks =  $req->remarks;

      $project->state_id = $req->state;
      $project_name = strpos($req->project_name, 'script');
      if ($project_name === false) {
         // tag not found
         $project->project_name=$req->project_name;

      } else {
         // tag found
         $project->project_name="Wrong data";
      }

      $project_address = strpos($req->project_address, 'script');
      if ($project_address === false) {
         // tag not found
         $project->project_address=$req->project_address;

      } else {
         // tag found
         $project->project_address="Wrong data";
      }
      $project->project_start_date = $req->project_start_date;
      $project->project_end_date = $req->project_end_date;
      $project->save();
      session()->put('success','Updated');

      return redirect('/projects');



    }

    function edit_bank($id)
        {


                $banks = Bank::where('id', $id)->first();
                $states = State::all();
                $all_apex = User::where('type', "apex")->get();
                $apex_bodies = Apex_bodie::all();
                $data = [
                        'banks' => $banks,
                        'states' => $states,
                        'all_apex' => $all_apex,
                        'apex_bodies' => $apex_bodies,
                ];
                return view('/edit_bank',['data'=>$data]);

        }

    function update_bank(Request $req){

      $bank=Bank::find($req->id);
      $bank->apex_body_id =  $req->apex_body;

      $bank->members =  $req->accountant;

      $account_name = strpos($req->account_name, 'script');
      if ($account_name === false) {
         // tag not found
         $bank->account_name=$req->account_name;

      } else {
         // tag found
         $bank->account_name="Wrong data";
      }

      $account_number = strpos($req->account_number, 'script');
      if ($account_number === false) {
         // tag not found
         $bank->account_number=$req->account_number;

      } else {
         // tag found
         $bank->account_number="Wrong data";
      }

      $ifsc_code = strpos($req->ifsc_code, 'script');
      if ($ifsc_code === false) {
         // tag not found
         $bank->ifsc_code=$req->ifsc_code;

      } else {
         // tag found
         $bank->ifsc_code="Wrong data";
      }


      $customer_id = strpos($req->customer_id, 'script');
      if ($customer_id === false) {
         // tag not found
         $bank->customer_id=$req->customer_id;

      } else {
         // tag found
         $bank->customer_id="Wrong data";
      }


      $home_branch_address = strpos($req->home_branch_address, 'script');
      if ($home_branch_address === false) {
         // tag not found
         $bank->home_branch_address=$req->home_branch_address;

      } else {
         // tag found
         $bank->home_branch_address="Wrong data";
      }
      $bank->account_opening_date = $req->account_opening_date;

      if(isset($req->signature_card)){
         $extension = $req->file('signature_card')->extension();
         if(isset($extension)){

             if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                 $filename = 's_'.time().'.'.$extension;
                 $req->file('signature_card')->move(public_path('profiles'), $filename);
                 $bank->signature_card = $filename;
             } else {
                 session()->put('failed','Invalid Image File');
                 return redirect()->back();
             }
         }}
         else {
            $bank->signature_card =  $bank->signature_card;
         }
      $bank->save();
      session()->put('success','Updated');

      return redirect('/banks');



    }

    function create_notification(Request $req)
    {
        // dd($req->document);
         $note= new Notification;

            $user_type = $req->user_type;
            $notification = $req->notification;


            $users = User::where('type',$user_type)->get();

            foreach ($users as $user) {
              // echo  $req->notification;die;

                    $note->from_id = Session::get('rexkod_apex_user_id');
                    $note->to_id = $user->id;

                    $notification = strpos($req->notification, 'script');
                    if ($notification === false) {
                       // tag not found
                       $note->notification=$req->notification;

                    } else {
                       // tag found
                       $note->notification="Wrong data";
                    }

                //     if (!empty($req->file('document'))) {
                //      $extension1 = $req->file('document')->extension();
                //      if ($extension1 == "png" || $extension1 == "jpeg" || $extension1 == "jpg" || $extension1 == "pdf") {
                //     //  dd($extension1);

                //          $filename = Str::random(4) . time() . '.' . $extension1;
                //         //  dd($filename);
                //          $note->document = $req->file('document')->move(('uploads'), $filename);
                //         //  dd( $note->document);
                //      }
                //  } else {
                //      $note->document = null;
                //  }

                 if(isset($req->document)){
                    $extension = $req->file('document')->extension();
                    if(isset($extension)){

                        if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                            $filename = 'b_'.time().'.'.$extension;
                            $req->file('document')->move(public_path('profiles'), $filename);
                            $note->document = $filename;
                        } else {
                            session()->put('failed','Invalid Image File');
                            return redirect()->back();
                        }


                    }}
                    else {
                        $note->document = NULL;
                    }

                    // if ($req->hasFile('document') && in_array($req->file('document')->extension(), ['png', 'jpg', 'jpeg', 'pdf'])) {
                    //     $filename = 's_'.time().'.'.$req->file('document')->extension();
                    //     $req->file('document')->move(public_path('uploads'), $filename);
                    //     $note->document = $filename;
                    // } else {
                    //     session()->put('failed', 'Invalid Image File');
                    //     return redirect()->back();
                    // }


            }

           $note->save();


            return redirect('/all_notifications');

    }

    function add_notification()
        {
                $states = State::all();
                $apex_bodies = Apex_bodie::all();
                $users = User::where('type',"apex")
                ->orWhere('type',"administrator")
                ->orWhere('type',"accountant")
                ->orWhere('type',"ddc")
                ->orWhere('type',"vdc")
                ->orWhere('type',"tdc")
                ->get();

                $data = [
                        'users' => $users,
                        'states' => $states,
                        'apex_bodies' => $apex_bodies,
                ];
                return view('/add_notification',['data'=>$data]);

        }


    function create_project(Request $req){

      $project=new Project;
      $project->apex_body_id =  $req->apex_body;

      $project->state_id = $req->state;
      $project->remarks =  $req->remarks;

      $project_name = strpos($req->project_name, 'script');
      if ($project_name === false) {
         // tag not found
         $project->project_name=$req->project_name;

      } else {
         // tag found
         $project->project_name="Wrong data";
      }

      $project_address = strpos($req->project_address, 'script');
      if ($project_address === false) {
         // tag not found
         $project->project_address=$req->project_address;

      } else {
         // tag found
         $project->project_address="Wrong data";
      }

      $project->project_start_date = $req->project_start_date;
      $project->project_end_date = $req->project_end_date;
      $project->save();
      return redirect('/projects');



    }

    function all_notifications()
    {
            $notifications = Notification::where('from_id',Session::get('rexkod_apex_user_id'))->get();

            $data = [
                    'notifications' => $notifications,
            ];
            return view('/all_notifications',['data' => $data]);

    }


   function notifications(){
      $notifications = Notification::where('to_id',Session::get('rexkod_apex_user_id'))->get();

      $data = [
         'notifications' => $notifications,
        ];
      return view('/notifications',['data' => $data]);
   }








   function add_profile(){
      $states = State::all();
      $professions =Profession::all();
      $posts =Post::all();
      $qualifications =Qualification::all();
      $other_posts =Other_post::all();
      $apex_bodies =Apex_bodie::all();
      $data = [
       'states' => $states,
       'professions' => $professions,
       'posts' => $posts,
       'qualifications' => $qualifications,
       'other_posts' => $other_posts,
       'apex_bodies' => $apex_bodies,
      ];
      return view('add_profile',['data' => $data]);
   }


   function add_bank(){
      $apex_bodies =Apex_bodie::all();
      $all_apex = User::where('type',"accountant")->get();
      $states = State::all();

      $data = [
       'apex_bodies' => $apex_bodies,
       'all_apex' => $all_apex,
       'apex_bodies' => $apex_bodies,

      ];
      return view('add_bank',['data' => $data]);

   }

   function banks(){
      $banks = Bank::all();
      $data = [
       'banks' => $banks,
      ];
      return view('banks',['data' => $data]);
   }


   function add_project(){
      $apex_bodies =Apex_bodie::all();
      $data = [
       'apex_bodies' => $apex_bodies,
      ];
      return view('add_project',['data' => $data]);
   }

   function projects(){
      $projects = Project::all();
      $data = [
       'projects' => $projects,
      ];
      return view('projects',['data' => $data]);
   }


   function all_requests(){
      $requests = Requests::orderBy('id','desc')->get();
      $trustees = User::where('type','trustee')->get();
      $data = [
       'requests' => $requests,
       'trustees' => $trustees,
      ];
      return view('all_requests',['data' => $data]);
   }

   function datasets(){
      return view('datasets');
   }


   function id($id){

//       $user= DB::table('users')
//       ->join('auth','users.id','=','auth.id')
//       ->where('users.id', $id)
//       ->first();
      $user= User::where('id',$id)->first();

      $data = [
         'user' => $user,
         'userO' => $user,
        ];
      return view('id',['data' => $data]);
   }



   function user($id){
        $user= User::where("id",$id)->first();
        $posts =Post::all();

        $data = [
                'user' => $user,
                'posts' => $posts,
        ];
        return view('user',['data' => $data]);
    }



    function upload_users(Request $req){
      // echo "test";die;

      // Allowed mime types
      $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
       if(!empty($req->file('upload')) && $csvMimes){
        // echo "test";die;
       if(is_uploaded_file($req->file('upload'))){
         // echo "test";die;
        $csvFile = fopen($req->file('upload'), 'r');
        fgetcsv($csvFile);
        while(($line = fgetcsv($csvFile)) !== FALSE){
         // echo "test";die;
                  // Get row line

              $valid = 1;
              $type = $line[0];
            //   echo $type;
            //   die();
              $name = $line[1];
              $email = $line[2];

              $phone = $line[3];


              $birth_date = $line[4];
              $address = $line[5];
              $pincode = $line[6];
              $district = $line[7];
              $state = $line[8];

              $apexbody = $line[9];
              $qualification = $line[10];
              $profession = $line[11];
              $post = $line[12];

              $status = $line[13];
              $alternate_number = $line[14];
              $tenure_from = $line[15];
              $tenure_to = $line[16];
              $additional_information = $line[17];
              $is_teacher = $line[18];
              $other_post = $line[19];
              $kyc_type1 = $line[20];
              $kyc_type2 = $line[21];


            //   $birth_date = date("Y-m-d", strtotime($birth_date));

              $user=new User;
              $user->name=$name;
              $user->type=$type;
              $user->phone=$phone;
              $user->email=$email;
              $user->status=$status;
              //$user->change_password= '1';
              $user->apexbody= $apexbody;
              $user->address= $address;
              $user->district= $district;
              $user->state= $state;
              $user->pincode= $pincode;
              $user->post= $post;
              $user->qualification= $qualification;
              $user->profession= $profession;
              $user->birth_date = $birth_date;

              $user->alternate_phone= $alternate_number;
              $user->tenure_from= $tenure_from;
              $user->tenure_to= $tenure_to;
              $user->additional_information= $additional_information;
              $user->is_teacher= $is_teacher;
              $user->other_post= $other_post;
              $user->kyc_type1= $kyc_type1;
              $user->kyc_type2= $kyc_type2;
              //$user->alternate_phone= $alternate_phone;
              $user->save();


          }
               fclose($csvFile);

         }
      }
        session()->put('success','File Uploaded');
               return redirect('/datasets');
    }



function user_login(Request $req){


        $user = User::where('phone', $req->phone)->first();
        if (!$user) {
            $user = User::where('alternate_phone', $req->phone)->first();

        }

    if($user && $user->last_otp == $req->otp){
    $date = date('Y-m-d H:i:s');
    Session::put('rexkod_apex_user_id',$user->id);
    Session::put('rexkod_apex_user_status',$user->status);

    Session::put('rexkod_apex_user_type',$user->type);
    Session::put('rexkod_apex_user_name',$user->name);
    User::where('id',$user->id)->update(['last_login'=>$date]);

    return redirect('/index');
    } else {
        session()->put('failed','Invalid Phone');
        return redirect('/login');
    }
}



  function update_password(Request $req)
  {
          $user=User::find(Session::get('rexkod_apex_user_id'));
          die;
          //dd(Session::get('rexkod_apex_user_id'));
          //dd($num);
          $user->password=Hash::make($req->password);
          $user->change_password='0';
          $user->save();

          return redirect('/index');
  }


  function pincode($pin)
  {
      $result = Pincode::where('pincode', $pin)->first();
      echo $result->district.",".$result->state;
  }

  function update_status($user_id, $status, $url){
               //echo $user_id;die;
                $user=User::find($user_id);
                $user->status= $status;
                $user->save();

                if ($status == "1") {
                        $user = User::where('id',$user_id)->first();
                        //$this->mail_account_activated($user->email);
                }
                return redirect($url);
    }

   function update_request($id,Request $req){
                $request = Requests::find($id);
              // echo $request->request_remark;die;

               //  if ($req->file('document')) {
               //       $extension = $req->file('document')->extension();
               //       if($extension == "png" || $extension == "jpeg" || $extension == "jpg"){
               //             $filename = time()."1".'.'.$extension;
               //             $request->document = $req->file('document')->storeAs('uploads', $filename);
               //       }
               //       else{
               //          return 'Extension must be png/jpg/jpeg/pdf';
               //       }
               //  }
               //  else {
               //    $request->document = $request->document;
               // }

               if(isset($req->document)){
                  $extension = $req->file('document')->extension();
                  if(isset($extension)){

                      if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                          $filename = 'd_'.time().'.'.$extension;
                          $req->file('document')->move(public_path('profiles'), $filename);
                          $request->document = $filename;
                      } else {
                          session()->put('failed','Invalid Image File');
                          return redirect()->back();
                      }
                  }}
                  else {
                     $request->document = $request->document;
                  }


                $response_remark = $request->response_remark;
                //echo $request->response_remark;die;

                $response_remark2 = $request->response_remark2;
                $response_remark3 = $request->response_remark3;
                $response_remark4 = $request->response_remark4;
                $status = $request->status;

                $action = $req->action;

                if ($req->trustee_id) {
                        $trustee_id = $req->trustee_id;
                } else {
                        $trustee_id = $request->trustee_id;
                }

                if (Session::get('rexkod_apex_user_type') == "coordinator") {
                        $response_remark = $req->remark;
                        if ($action == 1) {
                                $status = 1;
                        } else if ($action == 2) {
                                $status = 2;
                        } else if ($action == 3) {
                                $status = 11;
                        }
                } else if (Session::get('rexkod_apex_user_type') == "director") {
                        $response_remark2 = $req->remark;
                        if ($action == 1) {
                                $status = 3;
                        } else if ($action == 2) {
                                $status = 4;
                        } else if ($action == 3) {
                                $status = 5;
                        }
                } else if (Session::get('rexkod_apex_user_type') == "hq") {
                        $response_remark3 = $req->remark;
                        if ($action == 1) {
                                $status = 6;
                        } else if ($action == 2) {
                                $status = 7;
                        } else if ($action == 3) {
                                $status = 8;
                        }
                } else if (Session::get('rexkod_apex_user_type') == "trustee") {
                        $response_remark4 = $req->remark;
                        if ($action == 1) {
                                $status = 9;
                        } else if ($action == 2) {
                                $status = 10;
                        }
                }

                $request->response_remark = $response_remark;
                $request->response_remark2 = $response_remark2;
                $request->response_remark3 = $response_remark3;
                $request->response_remark4 = $response_remark4;
                $request->trustee_id = $trustee_id;
                $request->status = $status;
                $request->save();

                return redirect('/request/'.$id);
        }

        function send_document($id)
        {
                $request = Requests::where('id',$id)->first();

                if(isset($request->request_user_id)){

                }
               // Calling request_user_id on null
               //  if(isset($request->request_user_id)){
               //  }
                $user = User::where('id',$request->request_user_id)->first();

                $data = [
                        'request' => $request,
                        'user' => $user,
                ];

                return view('/send_document',['data' => $data]);

        }

        function settings()
        {
                $get_user_detail = User::where('id',Session::get('rexkod_apex_user_id'))->first();


                $data = [
                        'get_user_detail' => $get_user_detail,
                ];

                return view('/settings',['data' => $data]);

        }


        function update_settings(Request $req)
        {
               $user=User::find();

                $user->name = $req->name;
                $user->email = $req->email;
                $user->phone = $req->phone;

                if (!empty($req->password)) {

                        $password = $_POST['password'];
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $user->password=Hash::make($req->password);
                        $user->save();
                        return redirect('/settings');


                } else {
                        $password = $req->password;

                        return redirect('/settings');


                }


        }

        function create_response($id,Request $req)
        {


                $response_remark = $req->response_remark;
                $request = Requests::where('id',$id)->first();

                $user = User::where('id',$request->request_user_id)->first();

               //  print_r($user);
               //  die;

                $request->response_remark = $response_remark;
                $request->status = '1';


                $extension = $req->file('document')->extension();
                if($extension == "png" || $extension == "jpeg" || $extension == "jpg" || $extension == "pdf"){
                      $filename = time()."1".'.'.$extension;
                      $request->document = $req->file('document')->storeAs('uploads', $filename);
                }
                else{
                   return 'Extension must be png/jpg/jpeg/pdf';
                    return redirect('/send_document');
                }


                $request->save();


                //$result = $this->send_mail("Response", $user->email);

                return redirect('/all_requests');
        }

        function update_notification($notification_id, $status)
        {
              //dd($status);
                $user=Notification::find($notification_id);
                $user->status= $status;
                $user->save();


                return redirect('/index');

        }
// ==================== som ================================

        function bulk_upload_banks(Request $req){

            if (!$req->hasFile('upload')) {
               return redirect()->back()->with('failed', 'No file uploaded');
           }

           $file = $req->file('upload');

           $allowedMimeTypes = [
               'text/x-comma-separated-values',
               'text/comma-separated-values',
               'application/octet-stream',
               'application/vnd.ms-excel',
               'application/x-csv',
               'text/x-csv',
               'text/csv',
               'application/csv',
               'application/excel',
               'application/vnd.msexcel',
               'text/plain',
           ];

           if (!in_array($file->getClientMimeType(), $allowedMimeTypes))
           {
               return redirect()->back()->with('failed', 'Invalid file type');
           }

           $csvFile = fopen($file->getPathname(), 'r');
           $rowCount = 0;
           $validRows = true;

           while (($line = fgetcsv($csvFile)) !== false)
           {

               if ($rowCount === 0) {
                   $rowCount++;
                   continue;
               }

               if (count($line) !== 10) {
                   // Invalid number of fields in row
                   $validRows = false;
                   return redirect()->back()->with('failed', 'no rows were uploaded due to invalid data at row ' . $rowCount);
               }

               $rowCount++;
           }

           // If all rows are valid, insert data into the database
           if ($validRows)
           {
               rewind($csvFile); // reset the file pointer to the beginning of the file
               $rowCount = 0;

               while (($line = fgetcsv($csvFile)) !== false)
               {
                   if ($rowCount === 0) {
                       $rowCount++;
                       continue;
                   }

                   $bank = new Bank([
                       'serial_number' => $line[0],
                       'apex_body_id' => $line[1],
                       'members' => $line[2],
                       'account_name' => $line[3],
                       'account_number' => $line[4],
                       'ifsc_code' => $line[5],
                       'customer_id' => $line[6],
                       'home_branch_address' => $line[7],
                       'account_opening_date' => $line[8],
                       'authorized_signatory' => $line[9],

                   ]);

                   if ($bank->save()) {
                       $rowCount++;
                   } else {
                       return redirect()->back()->with('failed', 'Error saving data in row ' . $rowCount);
                   }
               }

               fclose($csvFile);

               return redirect()->back()->with('success', 'File uploaded successfully');
           }
       }


       function edit_apex($id){
        $apex_bodies= Apex_bodie::where("id",$id)->first();

        $states = state::orderBy('id', 'desc')->get();
        $data = [
                'apex_bodies' => $apex_bodies,
                'states' => $states,
        ];

        return view('edit_apex',['data' => $data]);
    }

    function update_apex_bodies(Request $req, $id)
    {
          //dd($status);
            $apex_bodiess = Apex_bodie::find($id);
                if (Session::get('rexkod_apex_user_type') == "hq") {

                  $apex_bodies = strpos($req->apex_body, 'script');
                  if ($apex_bodies === false) {

                     $apex_bodiess->name = $req->apex_body;

                  } else {
                     // tag found
                     $apex_bodiess->name="Wrong data";
                  }

                       $state= $req->state;
                       $state = implode(',', $state);
                       $apex_bodiess->state_id = $state;

                       $apex_bodiess->save();
                       return redirect('/apex_bodies');
                } else {
                        return redirect('/access_denied');
                }

    }
//=========================================  som ==========================================================

// public function downloadImage($id)
// {
//     $html = view("id.".$id)->render();
//     $image = SnappyImage::loadHTML($html)->setOption('width', 1024)->setOption('height', 768)->setOption('encoding', 'utf-8')->output();

//     return response($image, 200)
//         ->header('Content-Type', 'image/png')
//         ->header('Content-Disposition', 'attachment; filename="id-card.png"');
// }








}

