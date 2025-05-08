<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Events;
use App\Models\Passe;
use App\Models\Donation;
use App\Models\Pincode;
use App\Models\Test;
use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class Sanidhya extends Controller
{

    function login(){
        return view ('login');
    }

    function results(){
        if(session()->get('rexkod_admin_user_id')){
        $result = Donation::all();
        $data = [
        'all_donations' => $result,
        ];
        return view('/all_donations',['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function index(){
        if(session()->get('rexkod_admin_user_id')){
        return view('index');
        } else {
            return redirect('login');
        }
    }

    function reports(){
        if(session()->get('rexkod_admin_user_id')){
        return view('reports');
        } else {
            return redirect('login');
        }
    }

    function scan(){
        if(session()->get('rexkod_admin_user_id')){
        return view('scan');
        } else {
            return redirect('login');
        }
    }

    function scanned(){
        if(session()->get('rexkod_admin_user_id')){
        $passes = Passe::where("scanned_by",session()->get('rexkod_admin_user_id'))->get();
        $data = ["passes" => $passes];
        return view('scanned',['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function checkout(){
        return view('checkout');
    }
    function vb(){
        return view('vb');
    }

    public function paytmPayment(Request $request)
    {
        
        $donation_user = [
            "type"=>$request->type,
            "multiples" => $request->multiples,
            "amount" => $request->amount,
            "phone" => $request->phone,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "gender" => $request->gender,
            "email" => $request->email,
            "pan" => $request->pan,
            "address" => $request->address,
            "pincode" => $request->pincode,
            "city" => $request->city,
            "state" => $request->state,
            "company_phone" => $request->company_phone,
            "company_first_name" => $request->company_first_name,
            "company_last_name" => $request->company_last_name,
            "company_gender" => $request->company_gender,
            "company_email" => $request->company_email,
            "company_pan" => $request->company_pan,
            "company_address" => $request->company_address,
            "company_pincode" => $request->company_pincode,
            "company_city" => $request->company_city,
            "company_state" => $request->company_state,
            "company_name" => $request->company_name,
        ];

        $request->session()->put('donation_user',$donation_user);

        


        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => rand(),
          'user' => rand(10,1000),
          'mobile_number' => '123456789',
          'email' => 'paytmtest@gmail.com',
          'amount' => 100,
          'callback_url' => route('paytm.callback'),
        ]);
        return $payment->receive();
    }

    public function paytmCallback()
    {
        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        
        if($transaction->isSuccessful()){

            return redirect('donation'); 

        }else if($transaction->isFailed()){
          //Transaction Failed
          return view('paytm.paytm-fail');
        }else if($transaction->isOpen()){
          //Transaction Open/Processing
          return view('paytm.paytm-fail');
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId(); // Get transaction id
    }

    public function paytmPurchase()
    {
        return view('paytm.payment-page');
    } 

     function user_register(Request $req){

        $auth=new User;
        die;
        
        $result = User::where('email', $req->user_email)->first();
        if($result){
            return 'Email already exists';
        }else{
              
        $auth->name = $req->user_name;
        $auth->type = $req->user_type;
        $auth->phone = $req->user_phone;
        $auth->email = $req->user_email;
        $auth->status = '2';
        $auth->password=Hash::make('$req->password');

        $auth->save();
        $user = User::where('email', $req->user_email)->first();

       // $req->session()->put('user',$user);

        return redirect('/login'); 
        }
       
     }

    
    function user_login(Request $req){
    
        $user = User::where('email', $req->username)->first();

        if($user && Hash::check($req->password,$user->password))
        {
            $req->session()->put('rexkod_admin_user_id',$user->id);
            $req->session()->put('rexkod_admin_user_type',$user->type);
            $req->session()->put('rexkod_admin_user_name',$user->name);

            if($user->type == "user"){
            return redirect('/scan');
            }

            return redirect('/index');
        }
        else
        {
            session()->put('failed','Invalid Credentials');
            return redirect('/login');
        }
    }

    function create_event(Request $req){
        if(session()->get('rexkod_admin_user_id')){
die;
        $event = new Events;
        $event->program_name = $req->program_name;
        $event->state = $req->state;
        $event->no_of_prg_state = $req->no_of_prg_state;
        $event->location = $req->location;
        $event->expense_sheet = $req->expense_sheet->store('uploads');
        $event->reg_start_date = $req->reg_start_date;
        $event->reg_end_date = $req->reg_end_date;
        $event->event_date = $req->event_date;
        $event->total_strength = $req->total_strength;
        $event->entry_points = $req->entry_points;
        $event->exit_points = $req->exit_points;
        $event->event_img = $req->event_img->store('uploads');
        $event->event_state = $req->event_state;
        $event->event_apex = $req->event_apex;
        $event->event_desc = $req->event_desc;
        $event->unravel = $req->unravel;
        $event->why_attend = $req->why_attend;
        $event->prerequisites = $req->prerequisites;
        $event->phone1 = $req->phone1;
        $event->phone2 = $req->phone2;
        $event->phone3 = $req->phone3;
        $event->email = $req->email;
        $event->address = $req->address;
        $event->venue_name = $req->venue_name;
        $event->venue_strength = $req->venue_strength;
        $event->platinum = $req->platinum;
        $event->platinum_donation = $req->platinum_donation;
        $event->gold = $req->gold;
        $event->gold_donation = $req->gold_donation;
        $event->silver = $req->silver;
        $event->silver_donation = $req->silver_donation;
        $event->general = $req->general;
        $event->general_donation = $req->general_donation;
        $event->platinum_seats = $req->platinum_seats;
        $event->gold_seats = $req->gold_seats;
        $event->silver_seats = $req->silver_seats;
        $event->general_seats = $req->general_seats;
        $event->predecided_seat = $req->predecided_seat;
        $event->no_of_teachers = $req->no_of_teachers;
        //echo $event->no_of_teachers;die;
        $event->save();

    } else {
        return redirect('login');
    }

        

        return redirect('/index');

    }
    function create_proposal(Request $req){
        $event = new Events;
        die;
        $event->reserved_seats = $req->reserved_seats;
        $event->program_name = $req->program_name;
        $event->state = $req->state;
        $event->no_of_prg_state = $req->no_of_prg_state;
        $event->location = $req->location;
        $event->expense_sheet = $req->expense_sheet->store('uploads');
        $event->reg_start_date = $req->reg_start_date;
        $event->reg_end_date = $req->reg_end_date;
        $event->event_date = $req->event_date;
        $event->total_strength = $req->total_strength;
        $event->entry_points = $req->entry_points;
        $event->exit_points = $req->exit_points;
        //$event->event_img = $req->event_img->store('uploads');
        $event->event_state = $req->event_state;
        $event->event_apex = $req->event_apex;
        $event->event_desc = $req->event_desc;
        $event->unravel = $req->unravel;
        $event->why_attend = $req->why_attend;
        $event->prerequisites = $req->prerequisites;
        $event->phone1 = $req->phone1;
        $event->phone2 = $req->phone2;
        $event->phone3 = $req->phone3;
        $event->email = $req->email;
        $event->address = $req->address;
        $event->venue_name = $req->venue_name;
        $event->venue_strength = $req->venue_strength;
        $event->platinum = $req->platinum;
        $event->platinum_donation = $req->platinum_donation;
        $event->gold = $req->gold;
        $event->gold_donation = $req->gold_donation;
        $event->silver = $req->silver;
        $event->silver_donation = $req->silver_donation;
        $event->general = $req->general;
        $event->general_donation = $req->general_donation;
        $event->platinum_seats = $req->platinum_seats;
        $event->gold_seats = $req->gold_seats;
        $event->silver_seats = $req->silver_seats;
        $event->general_seats = $req->general_seats;
        $event->predecided_seat = $req->predecided_seat;
        $event->no_of_teachers = $req->no_of_teachers;
        //echo $event->no_of_teachers;die;
        $event->save();

        

        return redirect('/index');

    }

    function add_user(){

        if(session()->get('rexkod_admin_user_id')){
        $result = Events::all();
        $data = [
            'events' => $result,
           ];
           return view('/add_user',['data' => $data]);
        } else {
            return redirect('login');
        }

    }

    function create_user(Request $req){
        if(session()->get('rexkod_admin_user_id')){
        $user= new User;
        $user->type = "user";
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        $user->name = $req->name;
        if (str_contains($req->email, 'script')) { session()->flush(); return redirect('login');}
        $user->email = $req->email;
        if (str_contains($req->phone, 'script')) { session()->flush(); return redirect('login');}
        $user->phone = $req->phone;
        if (str_contains($req->password, 'script')) { session()->flush(); return redirect('login');}
        $user->password = $req->password;
        $user->event_id = $req->event_id;
        $user->save();

        session()->put('success','Volunteer Added');
        return redirect('/users');
        } else {
            return redirect('login');
        }
        

    }

    function all_events(){
        if(session()->get('rexkod_admin_user_id')){
        $result = Events::all();
        $data = [
            'event' => $result,
           ];
           return view('/all_events',['data' => $data]);
        } else {
            return redirect('login');
        }

    }
    function all_proposals(){
        $result = Events::all();
        $data = [
            'proposal' => $result,
           ];
           return view('/all_proposals',['data' => $data]);

    }

    function all_passes(){
        if(session()->get('rexkod_admin_user_id')){
        $result = Passe::all();
        $data = [
            'all_passes' => $result,
           ];
           return view('/all_passes',['data' => $data]);

        } else {
            return redirect('login');
        }
    }


    function all_donations(){
        if(session()->get('rexkod_admin_user_id')){
        $result = Donation::all();
        $data = [
            'all_donations' => $result,
           ];
           return view('/all_donations',['data' => $data]);
        } else {
            return redirect('login');
        }

    }

    function logout(){
        session()->flush();
        return redirect('login');
    }


    function proposal($id){
        if(session()->get('rexkod_admin_user_id')){
        $result = Events::where('id', $id)->first();

        $data = [
            'proposal' => $result,
           ];
           return view('/proposal',['data' => $data]);
        } else {
            return redirect('login');
        }

    }
    function users(){
        if(session()->get('rexkod_admin_user_id')){
        $result = User::where('type','user')->get();
        $data = [
            'users' => $result,
           ];
           return view('/users',['data' => $data]);
        } else {
            return redirect('login');
        }

    }

 
   

    public function donation()
    {
            if(!session()->get('donation_user'))
            { 
                return redirect('/vb');
            }

            $donation_user = session()->get('donation_user'); 
            $req = (object) $donation_user;
            
            $donation= new Donation;
        
            $donation->type = $req->type;
            $donation->multiples = $req->multiples;
            $donation->amount = $req->amount;
            $donation->phone = $req->phone;
            $donation->first_name = $req->first_name;
            $donation->last_name = $req->last_name;
            $donation->gender = $req->gender;
            $donation->email = $req->email;
            $donation->pan = $req->pan;
            $donation->address = $req->address;
            $donation->pincode = $req->pincode;
            $donation->city = $req->city;
            $donation->state = $req->state;
            $donation->company_phone = $req->company_phone;
            $donation->company_first_name = $req->company_first_name;
            $donation->company_last_name = $req->company_last_name;
            $donation->company_gender = $req->company_gender;
            $donation->company_email = $req->company_email;
            $donation->company_pan = $req->company_pan;
            $donation->company_address = $req->company_address;
            $donation->company_pincode = $req->company_pincode;
            $donation->company_city = $req->company_city;
            $donation->company_state = $req->company_state;
            $donation->company_name = $req->company_name;

            $donation->save();
            $donation_id = $donation->id;

                for($i = 1; $i <= $req->multiples; $i++){
    
                header("Content-type: image/jpg");
    
                $seat_number = "N/A"; 
                $valid_from = "05/02/2023";
                $valid_to = "06/02/2023";
                $timing_from = "08:59:59"; // Text to be written on Image. 
                $timing_to = "20:59:59"; // Text to be written on Image. 
                $phone = "xxxxxxxxxxx"; //phone
                $uid = "xxxxxxxxxxx"; //phone
                $name = $req->first_name." ".$req->last_name;
                
                $x = 220; 
                $y = 525; 
                $file_name ='passes/entry_pass.jpg'; 
                $unqdate = date("Ymd");
                $unqtime = time();
                $new_file_name = $donation->id."-".$i."-".$unqdate . "" . $unqtime.".jpg"; 
                $pass_val = $donation->id."-".$i."-".$unqdate . "" . $unqtime; 
    
                $img_source = imagecreatefromjpeg($file_name);
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
    
                ImageString($img_source, 5, $x, $y, $name, $text_color); //  
    
                $qr_code = imagecreatefromstring(file_get_contents('https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl='));
                imagecopymerge($img_source, $qr_code, 320, 365, 0, 0, 100, 100, 100);
    
                
                $str_date = "05-02-2023";
    
                $x = 206; // X - Postion of text. 
                $y = 564; // Y- Postion of text . 
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
                ImageString($img_source, 4, $x, $y, $seat_number, $text_color);
    
                $x = 226; // X - Postion of text. 
                $y = 604; // Y- Postion of text . 
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
                ImageString($img_source, 4, $x, $y, $valid_from, $text_color);
    
                $x = 479; // X - Postion of text. 
                $y = 604; // Y- Postion of text . 
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
                ImageString($img_source, 4, $x, $y, $valid_to, $text_color);
    
    
                $x = 248; // X - Postion of text. 
                $y = 643; // Y- Postion of text . 
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
                ImageString($img_source, 4, $x, $y, $timing_from, $text_color);
                $x = 496; // X - Postion of text. 
                $y = 643; // Y- Postion of text . 
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
                ImageString($img_source, 4, $x, $y, $timing_to, $text_color);
    
    
                $x = 441; // X - Postion of text. 
                $y = 564; // Y- Postion of text . 
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
                ImageString($img_source, 4, $x, $y, $uid, $text_color);
                $x = 269; // X - Postion of text. 
                $y = 897; // Y- Postion of text .
                $text_color = imagecolorallocate($img_source, 255, 255, 255);
                ImageString($img_source, 4, $x, $y, $phone, $text_color);
                ImageJpeg($img_source,'passes/'.$new_file_name); 
    
                $pass = new Passe;
                $pass->donation_id = $donation_id;
                $pass->pass_id = $new_file_name;
                $pass->save();
            }
            

            $passes = Passe::where('donation_id',$donation_id)->get();
            $url = "https://gateway.konverse.ai/ironman/api/v1/whatsApp/whatsappHSM";
            foreach($passes as $pass){
            $curl = curl_init();
            $stime = time();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 40,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    'x-app-id: 4012e1ed611140488a40b510ec2b0459',
                    'x-api-key: ce5793f7-3c06-4faa-a53b-d1dce6115338',
                    'Content-Type: application/json', 
                    
                ),
            ));

            $data = '{
                
                "message": {
                    "to": "'.$req->phone.'",
                    "templateName": "vigyan_bhairav_invite",
                    "parameters": [
                       "'.$req->first_name.'",
                       "2"
                    ],
                    "file": {
                        "type": "image",
                        "url": "https://sanidhya.kods.app/passes/'.$pass->pass_id.'"
                    }
                  
                }

            }';

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                $response = curl_exec($curl);
                curl_close($curl);

            }

            $result = Events::all();
            
            /* $donated = [
            'donation_id' => $donation_id,
            'pass_id' => $pass->pass_id,
            'amount' => $req->amount,
           ]; */

          session()->forget('donation_user');
          return redirect('/thankyou');
        
      
    }

    public function pincode($pin)
    {
        $result = Pincode::where('pincode', $pin)->first();
        echo $result->district.",".$result->state;
    }


    public function verify($id)
    {
        if(session()->get('rexkod_admin_user_id')){
        $pass = Passe::where('id', $id)->first();
        $user = Donation::where('id', $pass->donation_id)->first();
        $data = [
            "pass" => $pass,
            "user" => $user,
        ];
        return view('/verify',['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    public function verified($id)
    {
        if(session()->get('rexkod_admin_user_id')){
        $pass = Passe::where('id', $id)->first();
        if($pass->status == '0'){
        session()->put('success','Entered');
        $user_id = session()->get('rexkod_admin_user_id');
        Passe::where('id',$id)->update(['status'=>'1','scanned_by'=>$user_id]);
        } else {
        Passe::where('id',$id)->update(['status'=>'2']);
        session()->put('success','Exited');
        }

        return redirect('/scan');
        } else {
            return redirect('login');
        }
        
    }

    public function scan_pass($val)
    {
        //$result = Pincode::where('pincode', $pin)->first();
        echo $val;
    }


    public function sms_otp($phone,$otp)
    {
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
    }


    

    public function upload_image(Request $req){

        $extension = $req->file('upload')->extension();
        if($extension == "png" || $extension == "jpeg" || $extension == "jpg"){
            $filename = time().'.'.$extension;
            return $req->file('upload')->storeAs('uploads', $filename);
        }
        
    }

    public function upload_file(Request $req)
    {
      
       $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
       
       if(!empty($req->file('upload')) && $csvMimes){
     

       if(is_uploaded_file($req->file('upload'))){
        
        
        $csvFile = fopen($req->file('upload'), 'r');

        fgetcsv($csvFile);

        while(($line = fgetcsv($csvFile)) !== FALSE){
        
            for($i=0;$i<22;$i++){
              if (str_contains($line[$i], 'script')) { session()->flush(); return redirect('login');}
            }

            $donation= new Donation;
            $donation->type = $line[0];
            $donation->multiples = $line[1];
            $donation->amount = $line[2];
            $donation->phone = $line[3];
            $donation->first_name = $line[4];
            $donation->last_name = $line[5];
            $donation->gender = $line[6];
            $donation->email = $line[7];
            $donation->pan = $line[8];
            $donation->address = $line[9];
            $donation->pincode = $line[10];
            $donation->city = $line[11];
            $donation->state = $line[12];
            $donation->company_name = $line[13];
            $donation->company_pan = $line[14];
            $donation->company_address = $line[15];
            $donation->company_pincode = $line[16];
            $donation->company_city = $line[17];
            $donation->company_state = $line[18];
            $donation->pass_image = $line[19];
            $donation->status = $line[20];
            $donation->seat_number = $line[21];
            $donation->event_id = 1;
            $donation->category = $line[22];
            $donation->save();
        }
         fclose($csvFile);
                    
          
        } } 
        session()->put('success','Data Uploaded');
        return redirect('all_donations');
    }


    function create_passes(){

        session()->put('success','Passes Created');

        $donations = Donation::where('pass_generated', 0)->get();
        foreach($donations as $donation){

            for($i = 1; $i <= $donation->multiples; $i++){

            header("Content-type: image/jpg");


            $unqdate = date("Ymd");
            $unqtime = time();
            $new_file_name = $donation->id."-".$i."-".$unqdate . "" . $unqtime.".jpg"; 

            $pass = new Passe;
            $pass->donation_id = $donation->id;
            $pass->pass_file = $new_file_name;
            $pass->save();
            Donation::where('id',$donation->id)->update(['pass_generated'=>'1']);


            if(isset($donation->seat_number))
            { $seat_number = $donation->seat_number; } 
            else { $seat_number = "N/A"; }

            if(isset($donation->category))
            { $category = $donation->category; } 
            else { $category = "N/A"; }

            
            $uid = $pass->id;
            $assistance = "9145174920, 9637787734"; // Text to be written on Image. 
            $name = $donation->first_name." ".$donation->last_name;
            
           
            $file_name ='passes/entry_pass.jpg'; 
            $font = 'fonts/ARIBL0.ttf';
            

            $img_source = imagecreatefromjpeg($file_name);
            $text_color = imagecolorallocate($img_source, 255, 255, 255);

            $x = 210; // X - Postion of text. 
            $y = 540; // Y- Postion of text .  
            imagettftext($img_source, 14, 0, $x, $y, $text_color, $font , $name );

            $qr_code = imagecreatefromstring(file_get_contents('https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl='.$uid));
            imagecopymerge($img_source, $qr_code, 318, 385, 10, 10, 100, 100, 100);

            // uid
            $x = 529; // X - Postion of text. 
            $y = 540; // Y- Postion of text . 
            imagettftext($img_source, 14, 0, $x, $y, $text_color, $font , $uid );
    
            $x = 250; // X - Postion of text. 
            $y = 580; // Y- Postion of text . 
            imagettftext($img_source, 14, 0, $x, $y, $text_color, $font , $category );

            $x = 567; // X - Postion of text. 
            $y = 580; // Y- Postion of text . 
            imagettftext($img_source, 14, 0, $x, $y, $text_color, $font , $seat_number );

            $x = 327; 
            $y = 743; 
            imagettftext($img_source, 12, 0, $x, $y, $text_color, $font , $assistance );


            ImageJpeg($img_source,'passes/'.$new_file_name); 

            
        }
        }
        
        return redirect('all_passes');

    }


    public function create_pass($id)
    {
        header("Content-type: image/jpg");

        // Text to be written on Image. 
        $seat_number = "N/A";
        $valid_from = "18/01/2023";
        $valid_to = "24/01/2023";
        $timing_from = "08:59:59"; // Text to be written on Image. 
        $timing_to = "08:59:59"; // Text to be written on Image. 
        $phone = "xxxxxxxxxxx"; //phone
        $uid = "xxxxxxxxxxx"; //phone
        $name = "Ho Bhai";
        
        $x = 196; 
        $y = 525; 
        $file_name ='passes/entry_pass.jpg'; 
        $img_source = imagecreatefromjpeg($file_name);
        $text_color = imagecolorallocate($img_source, 255, 255, 255);

        ImageString($img_source, 5, $x, $y, $name, $text_color); //  

        $qr_code = imagecreatefromstring(file_get_contents('https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=4'));
        imagecopymerge($img_source, $qr_code, 305, 365, 0, 0, 100, 100, 100);

        
        $str_date = "abc";

        $x = 206; // X - Postion of text. 
        $y = 564; // Y- Postion of text . 
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $seat_number, $text_color);

        $x = 226; // X - Postion of text. 
        $y = 604; // Y- Postion of text . 
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $valid_from, $text_color);

        $x = 479; // X - Postion of text. 
        $y = 604; // Y- Postion of text . 
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $valid_to, $text_color);


        $x = 248; // X - Postion of text. 
        $y = 643; // Y- Postion of text . 
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $timing_from, $text_color);
        $x = 496; // X - Postion of text. 
        $y = 643; // Y- Postion of text . 
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $timing_to, $text_color);


        $x = 441; // X - Postion of text. 
        $y = 564; // Y- Postion of text . 
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $uid, $text_color);
        $x = 269; // X - Postion of text. 
        $y = 897; // Y- Postion of text .
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $phone, $text_color);

       
        ImageJpeg($img_source,'passes/hello.png'); 
        ImageJpeg($img_source); 
    
    }


    public function send_pass($id)
    {
       
            $pass = Passe::where('pass_id',$id);
            $donation = Donation::where('id',$pass->donation_id)->first();
            $url = "https://gateway.konverse.ai/ironman/api/v1/whatsApp/whatsappHSM";

            $curl = curl_init();
            $stime = time();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 40,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    'x-app-id: 4012e1ed611140488a40b510ec2b0459',
                    'x-api-key: ce5793f7-3c06-4faa-a53b-d1dce6115338',
                    'Content-Type: application/json', 
                    
                ),
            ));

            $data = '{
                
                "message": {
                    "to": "'.$donation->phone.'",
                    "templateName": "vigyan_bhairav_invite",
                    "parameters": [
                       "'.$donation->first_name.'",
                       "3"
                    ],
                    "file": {
                        "type": "image",
                        "url": "https://sanidhya.kods.app/passes/'.$pass->pass_id.'"
                    }
                  
                }

            }';

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                function url2($url)
                {
                    $result = parse_url($url);
                    print_r($result);
                }
                $response = curl_exec($curl);
                curl_close($curl);

               
        
                return redirect('all_passes');

           
    }


    function send_passes(){

        session()->put('success','Passes Sent on WhatsApp');

        $passes = Passe::where('whatsapp',0)->get();
        foreach($passes as $pass){
            $donation = Donation::where('id',$pass->donation_id)->first();
            $url = "https://gateway.konverse.ai/ironman/api/v1/whatsApp/whatsappHSM";

            $curl = curl_init();
            $stime = time();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 40,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    'x-app-id: 4012e1ed611140488a40b510ec2b0459',
                    'x-api-key: ce5793f7-3c06-4faa-a53b-d1dce6115338',
                    'Content-Type: application/json', 
                    
                ),
            ));

            $data = '{
                
                "message": {
                    "to": "'.$donation->phone.'",
                    "templateName": "vigyan_bhairav_invite",
                    "parameters": [
                       "'.$donation->first_name.'",
                       "2"
                    ],
                    "file": {
                        "type": "image",
                        "url": "https://sanidhya.kods.app/passes/'.$pass->pass_file.'"
                    }
                  
                }

            }';

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                
                $response = curl_exec($curl);
                curl_close($curl);

               
            Passe::where('id',$pass->id)->update(['whatsapp'=>'1']);
    
        }
       
        return redirect('all_passes');

    }


    function send_passes_selected(Request $req){

        $passes = $req->passes;
        $sender = $req->sender;
        if(!$passes){
            session()->put('failed','Please select at least 1 pass');
            return redirect('all_passes');
        }else if(!$sender){
                session()->put('failed','Please select at least 1 Sender');
                return redirect('all_passes');
        } else {

        session()->put('success','Passes Sent on WhatsApp');
        
        foreach($passes as $cur_pass){
            $pass = Passe::where('id',$cur_pass)->first();
            $donation = Donation::where('id',$pass->donation_id)->first();
           
            $url = "https://gateway.konverse.ai/ironman/api/v1/whatsApp/whatsappHSM";

            $curl = curl_init();
            $stime = time();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 40,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    'x-app-id: 4012e1ed611140488a40b510ec2b0459',
                    'x-api-key: ce5793f7-3c06-4faa-a53b-d1dce6115338',
                    'Content-Type: application/json', 
                    
                ),
            ));

            $data = '{
                
                "message": {
                    "to": "'.$donation->phone.'",
                    "templateName": "vigyan_bhairav_invite",
                    "parameters": [
                       "'.$donation->first_name.'",
                       "2"
                    ],
                    "file": {
                        "type": "image",
                        "url": "https://sanidhya.kods.app/passes/'.$pass->pass_file.'"
                    }
                  
                }

            }';

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                
                $response = curl_exec($curl);
                curl_close($curl);

               
    
        }
        }
        
        return redirect('all_passes');

        
    }



    function sms_passes(){

        session()->put('success','Passes Sent on SMS');

        $passes = Passe::all();
        foreach($passes as $pass){
            $donation = Donation::where('id',$pass->donation_id)->first();
        
            $url = 'http://api.pinnacle.in/index.php/sms/send/91'.$donation->phone.'/Jai+Guru+Dev%2C+'.$donation->first_name.'+Ji+Thank+you+for+your+donation.+The+Your+event+e-pass+for+the+Program+has+been+sent+on+your+email+or+click+here+sanidhiya.artofliving.com/passes/'.$pass->pass_id.'+to+download/TXT?apikey=”c7bb3b-af2623-2dc976-e3a11a-c959ec”&
            dltentityid=12345678901&dlttempid=12345678901';

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 40,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
            ));

        
            curl_exec($curl);
            curl_close($curl);

        }
        
        return redirect('all_passes');

    }


    function mail_passes(){

        session()->put('success','Passes Sent on Mail');

        $passes = Passe::all();
        foreach($passes as $pass){
            $donation = Donation::where('id',$pass->donation_id)->first();
        
                        
            $url = "https://api.sendgrid.com/v3/mail/send";

            $curl = curl_init();
            $stime = time();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 40,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                 'Authorization: Bearer ' . env('SENDGRID_API_KEY')
                    
                ),
            ));
            $data = '{"personalizations":[{"to":[{"email":"'.$donation->email.'","name":"'.$donation->first_name.'"}],"subject":"Vigyan Bhairav - Pune"}],"content": [{"type": "text/plain", 
            "value": "
            
            <p>Jai Guru Dev '.$donation->first_name.' Ji,</p><p><br></p><p><br></p><p>We would like to invite you for the Vigyan Bhairav Program Event happening in presence of Gurudev Sri Sri Ravi Shankar ji.</p><p>Date : 5th Feb 2023</p><p>Time: 10 AM Onwards</p><p>Venue: Pune</p><p><br></p><p>Please find your Pass below for the Program which is required at Entry Point of the Venue or upon request by organisers.</p><p><a href="https://sanidhya.artofliving.com/passes/'.$pass->pass_file.'">Click here to access pass</a></p><p><br></p><p>And Yes, Also please go through important guidelines below.</p><p><br></p><h4>Guidelines of Vigyan Bhairav&nbsp;</h4><p><br></p><p>Welcome to&nbsp;&apos;Unveiling Infinity : Vigyaan Bhairav - (..)&apos;&nbsp;with Gurudev !</p><p><br></p><p>Please find attached your e-invite, in pdf format, for the Programevent as per your donation(s) made. In case of multiple donations, this will be a multi-page pdf file, with one pass per page. A consolidated file will be mailed for For your convenience., we will be emailing you in a day, these as jpeg images, one pass per image.</p><p><br></p><p>Please note few points for a smooth experience:</p><p><br></p><p>Dates &amp; Timings : &nbsp;All 3 sessions are mandatory</p><p><br></p><ul><li><p>All participants are requested to be seated 30 minutes before the session start time. Entry gates of the hall open 90 minutes before session time.&nbsp;</p></li></ul><p><br></p><ul><li><p>Entry gates will be closed once Gurudev starts the session.</p></li></ul><p><br></p><p>Venue :&nbsp;</p><p>(map: google co-ordinates)</p><p><br></p><p>Seating :</p><ul><li><p>Seating is according to the Section/Block Number &amp; Seat Number printed on your e-invite.</p></li></ul><p><br></p><ul><li><p>Seating is on chairs, so yoga mats are not required.</p></li></ul><p><br></p><p>Event Entry Guidelines :</p><ul><li><p>Your entry e-invite should be displayed on your phone for scanning at entry for all sessions.</p></li></ul><p><br></p><ul><li><p>Please download this now (data/internet may not work at the venue).</p></li></ul><p><br></p><ul><li><p>Use your designated Entry Gate, as printed on your e-invite pass.</p></li></ul><p><br></p><ul><li><p>Entry only to those over 18 years.</p></li></ul><p><br></p><p>Please consider the environment before printing your e-invite. It is not necessary to carry a print copy of the pass, just displaying it on your phone screen for scanning is enough. Only if needed for some reason, you may carry a print-out of your entry pass.</p><p><br></p><p>Event Guidelines :</p><p><br></p><ul><li><p>Please wear masks at all times. Personality safety is your responsibility too.</p></li><li><p>Please take care of your belongings and valuables.at your own responsibility.</p></li><li><p>Switch off your mobile phones during sessions.</p></li><li><p>Photography, Audio &amp; Video recording is not allowed during the sessions.</p></li><li><p>Packaged drinking water will be provided.</p></li><li><p>Keep the venue clean.</p></li><li><p>There is no specific dress code, but please wear comfortable clothing.</p></li></ul><p><br></p><p>Lunch :</p><ul><li><p>Consumption of eatables is not allowed inside the Event Hall.</p></li></ul><p><br></p><ul><li><p>Lunch will be available for sale in the food court at the venue.</p></li></ul><p><br></p><p>Translation :</p><ul><li><p>If you require translation from Hindi / English, please carry a mobile phone along with a headset.</p></li></ul><p><br></p><p>Transportation &amp; Parking :</p><ul><li><p>Parking has been arranged for 4-wheelers &amp; 2-wheelers at the venue, please park in allotted areas only.</p></li></ul><p><br></p><p><br></p><p>Assistance :</p><ul><li><p>There will be help-desks at the venue for any assistance if needed.&nbsp;</p></li></ul><p><br></p><ul><li><p>Our dedicated Tteachers and volunteers will be at your assistance, do not hesitate to reach out to them.</p></li></ul><p><br></p><p>For any other information, please feel free to call &nbsp;at<span style="text-align:inherit">9145174920 or &nbsp;9637787734</span></p><p><br></p><p><br></p><p><br></p><p><br></p><p>Thank you,</p><p><br></p><p>We wish you a blissful Program!</p><p><br></p><p>Maharashtra Apex</p><p>The Art Of Living!</p>

            "}],"from":{"email":"noreply@artofliving.org","name":"The Art of Living"},"reply_to":{"email":"noreply@artofliving.org","name":"The Art of Living"}}';

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $delivery = json_decode($response, TRUE);
            print_r($delivery);
            

        }
        
        return redirect('all_passes');

    }

}





