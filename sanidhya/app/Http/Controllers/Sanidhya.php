<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Events;
use App\Models\Profile;
use App\Models\Passe;
use App\Models\Donation;
use App\Models\Pincode;
use App\Models\Batche;
use App\Models\Checkin;
use App\Models\Transaction;
use App\Models\Test;
use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Payment_details;
use App\Models\Payment_process;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class Sanidhya extends Controller
{

    // function show_evnet()
    // {
    //     $result = Events::all();
    //     $data = [
    //         'events' => $result,
    //     ];
    //     return view('userpayment', ['data' => $data]);
    // }
   


    function login()
    {
        return view('login');
    }

    function results()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $result = Donation::all();
            $data = [
                'all_donations' => $result,
            ];
            return view('/all_donations', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function index()
    {
        if (session()->get('rexkod_admin_user_id') && session()->get('rexkod_admin_user_type') == "admin") {
            $all_passes = Passe::all();
            $all_passes = $all_passes->count();
            $all_events = Events::all();
            $all_events = $all_events->count();
            $unused_passes = Passe::where("status", 0)->get();
            $unused_passes = $unused_passes->count();
            $used_passes = Passe::where('status', '!=', 0)->get();
            $used_passes = $used_passes->count();
            $entered_passes = Passe::where("status", 1)->get();
            $entered_passes = $entered_passes->count();
            $exited_passes = Passe::where("status", 2)->get();
            $exited_passes = $exited_passes->count();
            $data = [
                "passes" => $all_passes,
                "events" => $all_events,
                "used" => $used_passes,
                "unused" => $unused_passes,
                "entered" => $entered_passes,
                "exited" => $exited_passes,
            ];

            return view('index', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function apex()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $all_events = Events::all();
            $pass_total = 0;
            $pass_used = 0;
            $events_total = 0;
            foreach ($all_events as $event) {
                $event_apex = explode(",", $event->apex_admins);
                if (in_array(session()->get('rexkod_admin_user_id'), $event_apex)) {
                    $events_total++;
                    $passes = Passe::where("event_id", $event->id)->get();
                    $passes = $passes->count();
                    $pass_total = $pass_total + $passes;
                    $passes_used = Passe::where("event_id", $event->id)->where("status", "!=", 0)->get();
                    $passes_used = $passes_used->count();
                    $passes_used = $passes_used + $pass_used;
                }
            }
            $pass_unused = $pass_total - $pass_used;

            $data = [
                "events_total" => $events_total,
                "pass_total" => $pass_total,
                "pass_used" => $pass_used,
                "pass_unused" => $pass_unused,
            ];

            return view('apex', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function event_summary($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $event = Events::where('id', $id)->first();
            $event = $event->toArray();
            $cat = $event['cat_name'];
            $cat_array = explode(',', $cat);
            $val = $event['cat_value'];
            $val_array = explode(',', $val);

            // Associative array to store category values (as values) and category names (as keys)
            $categoryValues = [];

            // Get category name and category values
            foreach ($cat_array as $index => $category) {
                $categoryValues[$category] = $val_array[$index];
            }

            // Store categories in $categoryValue(index+1) variable Ex: $categoryValue1 = "AOL Gold";
            foreach ($cat_array as $index => $category) {
                ${"categoryValue" . ($index + 1)} = $cat_array[$index];
            }

            // Get the count of categories for which donations have been done
            for ($i = 0; $i < count($cat_array); $i++) {
                ${"categoryCount" . ($i + 1)} = count(Donation::where('event_id', $id)
                    ->where('category', ${"categoryValue" . ($i + 1)})
                    ->get());
            }

            // Total Donations for all categories
            $total = 0; // Initialize the total

            for ($i = 0; $i < count($cat_array); $i++) {
                $total += ${"categoryCount" . ($i + 1)};
            }
            // Total Used Passes for individual Category Ex- $categoryUsedPassAOLGold = 1;$categoryUsedPassAOLSilver = 4;
            for ($i = 0; $i < count($cat_array); $i++) {
                ${"categoryUsedPass" . ${"categoryValue" . ($i + 1)}} = Donation::select('donations.id')
                    ->join('passes', 'passes.donation_id', '=', 'donations.id')
                    ->where('donations.category', ${"categoryValue" . ($i + 1)})
                    ->where('donations.event_id', $id)
                    ->where('passes.status', '!=', 0)
                    ->get()
                    ->count();
            }

            // Total Used Passes for all categories
            $total_used = 0; // Initialize the total used passes

            for ($i = 0; $i < count($cat_array); $i++) {
                $total_used += ${"categoryUsedPass" . ${"categoryValue" . ($i + 1)}};
            }

            $data = [
                "event" => $event,
                "total" => $total,
                "total_used" => $total_used,
            ];

            // Assign dynamic category count values to $data
            for ($i = 0; $i < count($cat_array); $i++) {
                $category = ${"categoryValue" . ($i + 1)};
                $categoryCount = ${"categoryCount" . ($i + 1)};
                $data[$category] = $categoryCount;
            }

            // Assign dynamic category used pass values to $data
            for ($i = 0; $i < count($cat_array); $i++) {
                $category = ${"categoryValue" . ($i + 1)};
                $categoryUsedPass = ${"categoryUsedPass" . $category};
                $data[$category . "_used"] = $categoryUsedPass;
            }

            // echo '<pre>';
            // print_r($data);
            // die();

            return view('event_summary', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }




    function event_report($id)
    {

        if (session()->get('rexkod_admin_user_id')) {

            $event = Events::where('id', $id)->first();
            $passes = Passe::where('event_id', $id)->get();
            $data = [
                "passes" => $passes,
                "event" => $event,
            ];

            return view('event_report', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }



    function event($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $event = Events::where('id', $id)->first();
            $all_passes = Passe::where('event_id', $id);
            $all_passes = $all_passes->count();
            $unused_passes = Passe::where("status", 0)->where('event_id', $id)->get();
            $unused_passes = $unused_passes->count();
            $used_passes = Passe::where('status', '!=', 0)->where('event_id', $id)->get();
            $used_passes = $used_passes->count();
            $entered_passes = Passe::where("status", 1)->where('event_id', $id)->get();
            $entered_passes = $entered_passes->count();
            $exited_passes = Passe::where("status", 2)->where('event_id', $id)->get();
            $exited_passes = $exited_passes->count();


            $data = [
                "event" => $event,
                "passes" => $all_passes,
                "used" => $used_passes,
                "unused" => $unused_passes,
                "entered" => $entered_passes,
                "exited" => $exited_passes,
            ];

            return view('event', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function reports()
    {
        if (session()->get('rexkod_admin_user_id')) {
            return view('reports');
        } else {
            return redirect('login');
        }
    }

    function scan()
    {
        if (session()->get('rexkod_admin_user_id')) {
            return view('scan');
        } else {
            return redirect('login');
        }
    }

    function scanned()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $passes = Passe::where("scanned_by", session()->get('rexkod_admin_user_id'))->get();
            $data = ["passes" => $passes];
            return view('scanned', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    function event_page($eventid = null)
    {
        if ($eventid === null) {
            $data = [
                'eventid' => null,
                'eventname' => 'Vigyan Bhairav',
                'venuename' => 'Bangalore',
                'eventimage' => 'h_h2.jpg',
                'eventcontact1' => 9876544332,
                'eventcontact2' => 9876544332,
                'eventcontact3' => 9876544332,
            ];
            return view('event_page', ['data' => $data]);
        } else {
            $events = Events::where('id', $eventid)->get();
            if ($events->isEmpty()) {
                // No event found
                return redirect()->back();
            } else {
                //Event in db
                foreach ($events as $event) {
                    $eventid = $event->id;
                    $eventname = $event->event_name;
                    $venuename = $event->venue_name;
                    $eventimage = $event->event_img;
                    $eventdate =  $event->event_start_date;
                    $eventcontact1 = $event->phone1;
                    $eventcontact2 = $event->phone2;
                    $eventcontact3 = $event->phone3;
                }
                $data = [
                    'eventid' => $eventid,
                    'eventname' => $eventname,
                    'venuename' => $venuename,
                    'eventimage' => $eventimage,
                    'eventdate' => $eventdate,
                    'eventcontact1' => $eventcontact1,
                    'eventcontact2' => $eventcontact2,
                    'eventcontact3' => $eventcontact3,
                ];
                return view('event_page', ['data' => $data]);
            }
        }
    }



    public function paytmPayment(Request $request)
    {
        $donation_user = [
            "type" => $request->type,
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

        $request->session()->put('donation_user', $donation_user);




        $payment = PaytmWallet::with('receive');
        $payment->prepare([
            'order' => rand(),
            'user' => rand(10, 1000),
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

        if ($transaction->isSuccessful()) {

            return redirect('donation');
        } else if ($transaction->isFailed()) {
            //Transaction Failed
            return view('paytm.paytm-fail');
        } else if ($transaction->isOpen()) {
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

    function user_register(Request $req)
    {

        $auth = new User;
        die;

        $result = User::where('email', $req->user_email)->first();
        if ($result) {
            return 'Email already exists';
        } else {

            $auth->name = $req->user_name;
            $auth->type = $req->user_type;
            $auth->phone = $req->user_phone;
            $auth->email = $req->user_email;
            $auth->status = '2';
            $auth->password = Hash::make('$req->password');

            $auth->save();
            $user = User::where('email', $req->user_email)->first();

            // $req->session()->put('user',$user);

            return redirect('/login');
        }
    }


    function user_login(Request $req)
    {

        $user = User::where('phone', $req->phone)->first();

        if ($user && $user->last_otp == $req->otp) {
            $check = User::where(['phone' => $req->phone, 'status' => 1])->first();
            if ($check) {
            
                return redirect('/login')->with('warning', 'User Deactivated');
            }

            $date = date('Y-m-d H:i:s');
            Session::put('rexkod_admin_user_id', $user->id);
            Session::put('rexkod_admin_user_id', $user->id);
            Session::put('rexkod_admin_user_type', $user->type);
            Session::put('rexkod_admin_user_name', $user->name);
            User::where('id', $user->id)->update(['last_login' => $date]);

            if ($user->type == "apex") {
                return redirect('/apex');
            } else if ($user->type == "volunteer") {
                return redirect('/scan');
            } else if ($user->type == "admin") {
                return redirect('/index');
            }
        } else {
            session()->put('failed', 'Invalid Phone');
            return redirect('/login');
        }
    }

    function profilelogin()
    {
        return view('profilelogin');
    }

    function profile_login(Request $req)
    {
        $profile = Profile::where('phone', $req->phone)->first();
        if ($profile && $profile->last_otp == $req->otp) {
            $check = Profile::where(['phone' => $req->phone, 'status' => 1])->first();
            if ($check) {
            
                return redirect('/profilelogin')->with('warning', 'User Deactivated');
            }
    
            $date = date('Y-m-d H:i:s');
            Session::put('rexkod_user_id', $profile->id);
            Session::put('first_name', $profile->first_name);
            Session::put('phone', $profile->phone);
    
          
            return redirect('/profile')->with('success', 'Login successful');
        } else {
   
            return redirect('/login')->with('error', 'Invalid Phone');
        }
    }
    


    function create_event(Request $req)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $event = new Events;

            if ($req->hasFile('event_image')) {
                $validExtensions = ['png', 'jpeg', 'jpg', 'webp'];
                $file = $req->file('event_image');

                if ($file->isValid() && in_array($file->extension(), $validExtensions)) {
                    $filename = Str::random(4) . time() . '.' . $file->extension();
                    $file->move(public_path('assets'), $filename);
                    $event->event_img = $filename;
                } else {
                    // Handle invalid file
                    return redirect()->back()->with('error', 'Invalid file. Please upload an image in PNG, JPEG, JPG, or WEBP format.');
                }
            } else {
                $event->event_img = "h_h2.jpeg";
            }

            $event->type = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_type);
            $event->event_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_name);
            $event->event_name_pass1 = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_name_pass1);
            $event->event_name_pass2 = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_name_pass2);
            $event->location_pass =preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '', $req->location_pass);
            $event->date_pass = $req->date_pass;
            $event->event_start_date = $req->event_start_date;
            $event->event_end_date = $req->event_end_date;
            $event->phone1 = $req->phone1;
            $event->phone2 = $req->phone2;
            $event->phone3 = $req->phone3;
            $event->session1 = $req->session1;
            $event->session2 = $req->session2;
            $event->session3 = $req->session3;
            $event->session4 = $req->session4;
            $event->team_name =preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '', $req->team_name);
            $event->venue_name = $req->venue_name;
            $event->venue_strength = $req->venue_strength;
            $cat_name = implode(',', $req->cat_name);
            $event->cat_name = $cat_name;
            $cat_value = implode(',', $req->cat_value);
            $event->cat_value = $cat_value;
            $cat_strength = implode(',', $req->cat_strength);
            $event->cat_strength = $cat_strength;
            $cat_reserved = implode(',', $req->cat_reserved);
            $event->cat_reserved = $cat_reserved;
            $apex_admins = implode(',', $req->apex_admins);
            $event->apex_admins = $apex_admins;
            $event->status = 1;
            $event->save();

            return redirect('/all_events')->with('success', 'Event created successfully.');
        } else {
            return redirect('login');
        }
    }

    function update_event(Request $req)
    {
        if (session()->get('rexkod_admin_user_id')) {

            $event = Events::where("id", $req->event_id)->first();

            if ($req->hasFile('event_image')) {
                $validExtensions = ['png', 'jpeg', 'jpg', 'webp'];
                $file = $req->file('event_image');

                if ($file->isValid() && in_array($file->extension(), $validExtensions)) {
                    $filename = Str::random(4) . time() . '.' . $file->extension();
                    $file->move(public_path('assets'), $filename);
                    $event->event_img = $filename;
                } else {
                    // Handle invalid file
                    return redirect()->back()->with('error', 'Invalid file. Please upload an image in PNG, JPEG, JPG, or WEBP format.');
                }
            } else {
                $event->event_img = "h_h2.jpeg";
            }

            $event->event_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_name);
            $event->event_name_pass1 = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_name_pass1);
            $event->event_name_pass2 = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_name_pass2);
            $event->location_pass = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->location_pass);
            $event->date_pass = $req->date_pass;
            $event->event_start_date = $req->event_start_date;
            $event->event_end_date = $req->event_end_date;
            $event->phone1 = $req->phone1;
            $event->phone2 = $req->phone2;
            $event->phone3 = $req->phone3;
            $event->session1 = $req->session1;
            $event->session2 = $req->session2;
            $event->session3 = $req->session3;
            $event->session4 = $req->session4;
            $event->venue_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->venue_name);
            $event->team_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->team_name);
            $event->venue_strength = $req->venue_strength;
            $cat_name = implode(',', $req->cat_name);
            $event->cat_name = $cat_name;
            $cat_value = implode(',', $req->cat_value);
            $event->cat_value = $cat_value;
            $cat_strength = implode(',', $req->cat_strength);
            $event->cat_strength = $cat_strength;
            $cat_reserved = implode(',', $req->cat_reserved);
            $event->cat_reserved = $cat_reserved;
            $apex_admins = implode(',', $req->apex_admins);
            $event->apex_admins = $apex_admins;
            $event->status = 1;

            $event->save();
            if (session()->get('rexkod_admin_user_type') == 'admin') {
                return redirect('/all_events')->with('success', 'Event update successfully.');
            } else if (session()->get('rexkod_admin_user_type') == 'apex') {
                return redirect('/events')->with('error', 'Please Check Data.');;
            }
        } else {
            return redirect('login');
        }
    }

    function create_proposal(Request $req)
    {
        $event = new Events;
        die;
        $event->reserved_seats = $req->reserved_seats;
        $event->program_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->program_name);
        $event->state = $req->state;
        $event->no_of_prg_state = $req->no_of_prg_state;
        $event->location = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->location);
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
        $event->venue_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->venue_name);
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

    function add_volunteer()
    {

        if (session()->get('rexkod_admin_user_id')) {
            $result = Events::all();
            $data = [
                'events' => $result,
            ];
            return view('/add_volunteer', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    function add_event()
    {
        if (session()->get('rexkod_admin_user_type') == "admin") {
            $result = User::where('type', 'apex')->where('status', 0)->get();
            $data = [
                'apex_admins' => $result,
            ];
            return view('/add_event', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    function add_apex()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $result = Events::all();
            $data = [
                'events' => $result,
            ];
            return view('/add_apex', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function create_volunteer(Request $req)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $duplicate = User::where("phone", $req->phone)->first();
            $duplicateemail = User::where("email", $req->email)->first();
            if($duplicateemail){
                session()->put('failed', ' Email already taken');
                return redirect('/add_volunteer');
            }
            $duplicate2 = Profile::where("phone", $req->phone)->first();
            if($duplicate2){

                session()->put('failed', 'Phone already Present in Profile');
                return redirect('/add_volunteer');
            }

            if (!$duplicate) {
                $user = new User;
                $user->type = "volunteer";
                if (str_contains($req->name, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->name = $req->name;
                if (str_contains($req->email, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->email = $req->email;
                if (str_contains($req->phone, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->phone = $req->phone;
                $user->apex = session()->get('rexkod_admin_user_id');
                $user->save();

                session()->put('success', 'Volunteer Added');
                return redirect('/volunteers');
            } else {
                session()->put('failed', 'Phone  already taken');
                return redirect('/add_volunteer');
            }
        } else {
            return redirect('login');
        }
    }


    function create_apex(Request $req)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $duplicate = User::where("phone", $req->phone)->first();
            if (!$duplicate) {
                $user = new User;
                $user->type = "apex";
                if (str_contains($req->name, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->name = $req->name;
                if (str_contains($req->email, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->email = $req->email;
                if (str_contains($req->phone, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->phone = $req->phone;
                if (str_contains($req->apex, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->apex = $req->apex;

                $user->save();

                session()->put('success', 'Apex Added');
                return redirect('/all_apex');
            } else {
                session()->put('failed', 'Phone already taken');
                return redirect('/add_apex');
            }
        } else {
            return redirect('login');
        }
    }

    public function test()
    {

        $user = User::where("phone", "9066669966")->first();

        print_r($user);
    }


    public function sms_otp($phone, $otp)
    {
        $user = User::where("phone", $phone)->first();
        // $profile = Profile::where("phone", $phone)->first();

        if (isset($user)) {

            $user->last_otp = $otp;
            $user->save();
            // $profile->last_otp = $otp;
            // $profile->save();

            $user = 'VVKICRM'; //your username
            $password = 'pass@1981'; //your password
            $mobilenumbers = $phone; //['To']; //enter Mobile numbers comma seperated
            $message = "OTP for mobile verification is: " . $otp . " The Art of Living, India, support@artofliving.online"; //enter Your Message // It should be DLT approved. 
            $senderid = 'VVKICRM'; //Your senderid
            $messagetype = "N"; //Type Of Your Message
            $DReports = "Y"; //Delivery Reports
            $murl = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
            $message = urlencode($message);
            $ch = curl_init();
            if (!$ch) {
                die("Couldn't initialize a cURL handle");
            }
            $ret = curl_setopt($ch, CURLOPT_URL, $murl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports"
            );
            $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $curlresponse = curl_exec($ch); // execute

            if (curl_errno($ch))
                echo 'curl error : ' . curl_error($ch);

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
            $ttr = User::where("last_otp", 5555)->first();
            if( $ttr){
                echo "true";
            }
           
        } else {
            echo "false";
        }
    }

    public function profile_sms_otp($phone, $otp)
    {

        $profile = Profile::where("phone", $phone)->first();
          session()->put('phone');

        if (isset($profile)) {
            Session::put('phone', $phone);


            $profile->last_otp = $otp;
            $profile->save();

            $user = 'VVKICRM'; //your username
            $password = 'pass@1981'; //your password
            $mobilenumbers = $phone; //['To']; //enter Mobile numbers comma seperated
            $message = "OTP for mobile verification is: " . $otp . " The Art of Living, India, support@artofliving.online"; //enter Your Message // It should be DLT approved. 
            $senderid = 'VVKICRM'; //Your senderid
            $messagetype = "N"; //Type Of Your Message
            $DReports = "Y"; //Delivery Reports
            $murl = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
            $message = urlencode($message);
            $ch = curl_init();
            if (!$ch) {
                die("Couldn't initialize a cURL handle");
            }
            $ret = curl_setopt($ch, CURLOPT_URL, $murl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports"
            );
            $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $curlresponse = curl_exec($ch); // execute

            if (curl_errno($ch))
                echo 'curl error : ' . curl_error($ch);

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
        } else {
            echo "false";
        }
    }

    //
    public function showStoredPhoneNumber()
    {
        $storedPhoneNumber = session('phone');

        return view('paymentsfail', ['storedPhoneNumber' => $storedPhoneNumber]);
    }
    //



    public function profile_load_details(Request $request)
    {
        $phoneNumber = $request->phone;
        $profileData = Profile::where('phone', $phoneNumber)->get();
        $profile = $profileData->first();
        $response = [
            'success' => true,
            'profileData' => $profileData,
        ];
        return response()->json($response);
    }



    public function corporate_load_details(Request $request)
    {
        $phoneNumber = $request->phone;
        $profileData = Profile::where('phone', $phoneNumber)->get();
        $profile = $profileData->first();
        $response = [
            'success' => true,
            'profileData' => $profileData,
        ];
        return response()->json($response);
    }

    public function makePayment(Request $request)
    {
        dd($request);
        die();
        // Retrieve the payment details from the request
        $amount = $request->input('amount');
        $customerEmail = $request->input('email');
        $customerPhone = $request->input('phone');
        $description = 'Description';

        // Generate a unique order ID, customer ID, and product ID
        $orderId = 'ord_' . uniqid();
        $customerId = 'customer_' . uniqid();
        $productId = 'product_' . uniqid();

        // Juspay API endpoint
        $url = 'https://api.juspay.in/orders';

        // Juspay credentials
        $merchantId = 'artofliving';
        $apiKey = 'E18E82FCAFF4A81882EB590322925D';

        // Prepare the request data
        $requestData = [
            'amount' => $amount,
            'order_id' => $orderId,
            'customer_id' => $customerId,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'product_id' => $productId,
            'description' => $description,
        ];

        // Create cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic ' . base64_encode($apiKey),
        ]);

        // Execute the request
        $response = curl_exec($ch);

        // Close the cURL session
        curl_close($ch);

        // Check for errors
        if ($response !== false && !empty($response)) {
            // Process the response
            $responseData = json_decode($response, true);

            // Handle the response data as needed

            // return redirect($responseData['payment_links']['iframe']);
            return redirect($responseData['payment_links']['web']);
            // return redirect($responseData['payment_links']['mobile']);
        } else {
            $error = curl_error($ch);
            // Handle the error as needed
            return redirect()->back()->with('error', 'Payment failed: ' . $error);
        }
    }

    function all_events()
    {
        if (session()->get('rexkod_admin_user_type') == "admin") {
            $result = Events::all();
            $data = [
                'event' => $result,
            ];
            return view('/all_events', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    function events()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $result = Events::all();
            $events = array();
            foreach ($result as $event) {
                $event_apex = explode(",", $event->apex_admins);
                if (in_array(session()->get('rexkod_admin_user_id'), $event_apex)) {
                    $events[] = $event;
                }
            }

            $data = [
                'event' => $events,
            ];
            return view('/events', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function pay()
    {
        $event = Events::where('id', 3)->first();
        $data = [
            'event' => $event,
        ];
        return view('/pay', ['data' => $data]);
    }

    function all_proposals()
    {
        $result = Events::all();
        $data = [
            'proposal' => $result,
        ];
        return view('/all_proposals', ['data' => $data]);
    }

    function all_passes()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $result = Passe::all();
            $data = [
                'all_passes' => $result,
            ];
            return view('/all_passes', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }

    function renew_passes($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $passes = Passe::where('event_id', $id)->get();
            foreach ($passes as $pass) {
                Passe::where('id', $pass->id)->update(['status' => '0', 'scanned_by' => NULL]);
            }
            session()->put('success', 'Passes Renewed!');
            return redirect('passes/' . $id);
        } else {
            return redirect('login');
        }
    }

    function passes($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $event = Events::where("id", $id)->first();
            if (isset($event)) {
                $result = Passe::where("event_id", $id)->get();
                $batches = Batche::where("event_id", $id)->get();
                $data = [
                    'all_passes' => $result,
                    'batches' => $batches,
                    'event' => $event,
                ];
                return view('/passes', ['data' => $data]);
            } else {
                return redirect('events');
            }
        } else {
            return redirect('login');
        }
    }


    function batches($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $event = Events::where("id", $id)->first();
            if (isset($event)) {
                $result = Batche::where("event_id", $id)->get();
                $data = [
                    'batches' => $result,
                    'event' => $event,
                ];
                return view('/batches', ['data' => $data]);
            } else {
                return redirect('events');
            }
        } else {
            return redirect('login');
        }
    }


    function donations($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $event = Events::where("id", $id)->first();
            
            if (isset($event)) {
                $result = Donation::where("event_id", $id)->get();
                $data = [
                    'all_donations' => $result,
                    'event' => $event,
                ];
                return view('/donations', ['data' => $data]);
            } else {
                return redirect('events');
            }
        } else {
            return redirect('login');
        }
    }

    function logout()
    {
        User::where('id', session()->get('rexkod_admin_user_id'))->update(['logged_in' => '0']);
        session()->flush();
        return redirect('login');
    }

    public function profilelogout()
    {
        session()->forget('rexkod_user_id');
        session()->forget('phone');
        session()->flush();
        return redirect('profilelogin');
    }






    function proposal($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $result = Events::where('id', $id)->first();

            $data = [
                'proposal' => $result,
            ];
            return view('/proposal', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }



    function edit_donation($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $donation = Donation::where('id', $id)->first();
            $event_id = $donation['event_id'];
            $event = Events::where('id', $event_id)->first();
            $event = $event->toArray();
            $data = [
                'donation' => $donation,
                'event' => $event,
            ];
            return view('/edit_donation', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    function edit_apex($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $apex = User::where('id', $id)->first();
            $data = [
                'user' => $apex,
            ];
            return view('/edit_apex', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    function edit_event($id)
    {
        if (session()->get('rexkod_admin_user_id') && (session()->get('rexkod_admin_user_type') == "admin") || session()->get('rexkod_admin_user_type') == "apex") {
            $event = Events::where('id', $id)->first();
            $result = User::where("type", "apex")->get();
            $data = [
                'event' => $event,
                'apex_admins' => $result,
            ];
            return view('/edit_event', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }


    function volunteers()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $checkusertype = User::where('id', session('rexkod_admin_user_id'))->first();
    
            if ($checkusertype && $checkusertype->type == "apex") {
                $result = User::where('type', 'volunteer')->where('apex', session()->get('rexkod_admin_user_id'))->get();
                $data = [
                    'users' => $result,
                ];
                return view('/volunteers', ['data' => $data]);
            } else if ($checkusertype && $checkusertype->type == "admin") {
                $result = User::where('type', 'volunteer')->get();
    
                $data = [
                    'users' => $result,
                ];
    
                return view('/volunteers', ['data' => $data]);
            }
        } else {
            return redirect('login');
        }
    }
    


    function all_apex()
    {
        if (session()->get('rexkod_admin_user_id')) {
            $result = User::where('type', 'apex')->get();
            $data = [
                'users' => $result,
            ];
            return view('/all_apex', ['data' => $data]);
        } else {
            return redirect('login');
        }
    }




    public function donation()
    {
        if (!session()->get('donation_user')) {
            return redirect('/vb');
        }

        $donation_user = session()->get('donation_user');
        $req = (object) $donation_user;

        $donation = new Donation;

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

        for ($i = 1; $i <= $req->multiples; $i++) {

            header("Content-type: image/jpg");

            $seat_number = "N/A";
            $valid_from = "05/02/2023";
            $valid_to = "06/02/2023";
            $timing_from = "08:59:59"; // Text to be written on Image. 
            $timing_to = "20:59:59"; // Text to be written on Image. 
            $phone = "xxxxxxxxxxx"; //phone
            $uid = "xxxxxxxxxxx"; //phone
            $name = $req->first_name . " " . $req->last_name;

            $x = 220;
            $y = 525;
            $file_name = 'passes/entry_pass.jpg';
            $unqdate = date("Ymd");
            $unqtime = time();
            $new_file_name = $donation->id . "-" . $i . "-" . $unqdate . "" . $unqtime . ".jpg";
            $pass_val = $donation->id . "-" . $i . "-" . $unqdate . "" . $unqtime;

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
            ImageJpeg($img_source, 'passes/' . $new_file_name);

            $pass = new Passe;
            $pass->donation_id = $donation_id;
            $pass->pass_file = $new_file_name;
            $pass->save();
        }


        $passes = Passe::where('donation_id', $donation_id)->get();
        $url = "https://gateway.konverse.ai/ironman/api/v1/whatsApp/whatsappHSM";
        foreach ($passes as $pass) {
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
                    "to": "' . $req->phone . '",
                    "templateName": "vigyan_bhairav_invite",
                    "parameters": [
                       "' . $req->first_name . '",
                       "2"
                    ],
                    "file": {
                        "type": "image",
                        "url": "https://uat-sanidhya.artofliving.online/pass/' . $pass->pass_file . '"
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
            'pass_id' => $pass->pass_file,
            'amount' => $req->amount,
           ]; */

        session()->forget('donation_user');
        return redirect('/thankyou');
    }

    public function pincode($pin)
    {
        $result = Pincode::where('pincode', $pin)->first();
        echo $result->district . "," . $result->state;
    }


    public function upload()
    {
        if (session()->get('rexkod_admin_user_type') == "apex") {
            return view('/upload');
        } else {
            return redirect('login');
        }
    }


    function add_donation($id)
    {
        $event_id = $id;
        $event = Events::where('id', $event_id)->first();
        $event = $event->toArray();
        $data = [
            'event_id' => $event_id,
            'event_name' => $event['event_name'],
        ];
        return view('check_profile', ['data' => $data]);
    }

    public function check_phone(Request $req)
    {
        $phone = $req->input('phone');
        $type = $req->input('type');
        $event_id = $req->event_id;

        if (strlen($phone) === 10) {
            // Phone number is valid
            $check_phone = Profile::where('phone', $phone)->get();

            if (!$check_phone->isEmpty()) {
                // Old Donation
                Session::put('donation_type', 'old');
                return redirect('/donation/' . $event_id . '/' . $phone . '/' . $type);
            } else {
                // New Donation
                Session::put('donation_type', 'new');
                return redirect('/new_donation/' . $event_id . '/' . $type);
            }
        } else {
            // Phone number is not valid
            return redirect()->back()->with('error', 'Invalid phone number. Please enter a 10-digit phone number.');
        }
    }


    function new_donation($id, $type)
    {
        $event_id = $id;
        $event = Events::where('id', $event_id)->find($event_id);
        $event = $event->toArray();
        $event_name = $event['event_name'];
        $categories = $event['cat_name'];
        $category_list = explode(',', $categories);
        $values = $event['cat_value'];
        $value_list = explode(',', $values);

        // Associative array to store category values (as values) and category names (as keys)
        $categoryValues = [];

        // Get category name and category values
        foreach ($category_list as $index => $category) {
            $categoryValues[$category] = $value_list[$index];
        }

        $data = [
            'event_id' => $event_id,
            'donation_details' => null,
            'category_list' => $category_list,
            'category_values' => $categoryValues,
            'event_name' => $event_name,
            'type' => $type,
        ];
        return view('add_donation', ['data' => $data]);
    }

    public function old_donation($id, $phone, $type)
    {
        $check_phone = session('phone');
        $donation_details = Donation::where('phone', $phone)->first();
        $event_id = $id;
        $event = Events::where('id', $event_id)->find($event_id);
        $event = $event->toArray();

        $event_name = $event['event_name'];
        $categories = $event['cat_name'];
        $category_list = explode(',', $categories);
        $values = $event['cat_value'];
        $value_list = explode(',', $values);

        // Associative array to store category values (as values) and category names (as keys)
        $categoryValues = [];

        // Get category name and category values
        foreach ($category_list as $index => $category) {
            $categoryValues[$category] = $value_list[$index];
        }

        $data = [
            'event_id' => $event_id,
            'donation_details' => $donation_details ? $donation_details->toArray() : null,
            'category_list' => $category_list,
            'category_values' => $categoryValues,
            'event_name' => $event_name,
            'type' => $type,
        ];
        return view('add_donation', ['data' => $data]);
    }

    public function profile_checkphone(Request $request): JsonResponse
    {
        $phonenumber = $request->get('phone');
        $profile = Profile::where('phone', '=', $phonenumber)->first();

        // Check if the profile exists with the provided phone number
        if ($profile) {
            // User with the phone number exists
            return response()->json(['exists' => true]);
        } else {
            // User with the phone number does not exist
            return response()->json(['exists' => false]);
        }
    }

    function profile_register(Request $request)
    {
        $first_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->first_name);
        $last_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->last_name);
        $user_type = $request->user_type;
        $user_phone = $request->user_phone;
        $user_email = $request->user_email;

        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'type' => $user_type,
            'phone' => $user_phone,
            'email' => $user_email,
        ];

        return view('add_profile', ['data' => $data]);
    }

    function create_donation(Request $req)
    {
        $type = $req->type;
        $event_id = $req->event_id;
        $event = Events::where('id', $event_id)->first();
        $event = $event->toArray();
        $event_name = $event['event_name'];
        $donationType = Session::get('donation_type');

        $batch = new Batche();
        $batch->event_id = $req->event_id;
        $batch->total = '1';
        $batch->save();
        $batch_id = $batch->id;

        if ($donationType === 'new') {
            $profiles = new Profile();
            $profiles->type = $type;
            $profiles->multiples = $req->multiples;
            $profiles->amount = $req->amount;
            $profiles->phone = $req->phone;
            $profiles->email = $req->email;
            $profiles->first_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->first_name);
            $profiles->last_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->last_name);
            $profiles->gender = $req->gender;
            $profiles->age = $req->age;
            $profiles->pan = $req->pan;
            $profiles->aadhaar = $req->aadhaar;
            $profiles->address = $req->address;
            $profiles->pincode = $req->pincode;
            $profiles->city = $req->city;
            $profiles->state = $req->state;
            $profiles->company_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->company_name);
            $profiles->company_pan = $req->company_pan;
            $profiles->company_aadhaar = $req->company_aadhaar;
            $profiles->company_address = $req->company_address;
            $profiles->company_pincode = $req->company_pincode;
            $profiles->company_city = $req->company_city;
            $profiles->company_state = $req->company_state;
            $profiles->seat_number = $req->seat_number;
            $profiles->category = $req->category;
            $profiles->event_id = $req->event_id;
            $profiles->add_line1 = $req->add_line1;
            $profiles->add_line2 = $req->add_line2;


            $profiles->batch = $batch_id;
           
            $profiles->save();

            $donation = new Donation;
            $donation->type = $type;
            $donation->multiples = $req->multiples;
            $donation->amount = $req->amount;
            $donation->phone = $req->phone;
            $donation->email = $req->email;
            $donation->first_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->first_name);
            $donation->last_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->last_name);
            $donation->gender = $req->gender;
            $donation->age = $req->age;
            $donation->pan = $req->pan;
            $donation->aadhaar = $req->aadhaar;
            $donation->address = $req->address;
            $donation->pincode = $req->pincode;
            $donation->city = $req->city;
            $donation->state = $req->state;
            $donation->company_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->company_name);
            $donation->company_pan = $req->company_pan;
            $donation->company_aadhaar = $req->company_aadhaar;
            $donation->company_address = $req->company_address;
            $donation->company_pincode = $req->company_pincode;
            $donation->company_city = $req->company_city;
            $donation->company_state = $req->company_state;
            $donation->seat_number = $req->seat_number;
            $donation->category = $req->category;
            $donation->event_id = $req->event_id;
            $donation->add_line1 = $req->add_line1;
            $donation->add_line2 = $req->add_line2;
            $donation->batch = $batch_id;
           
            $donation->save();
        } else {
            $phone = $req->phone;

            // Check if the donation exists based on the phone number
            $donation = Donation::where('phone', $phone)->first();
            $phone = $req->phone;

            // Check if the profile exists based on the phone number
            $profile = Profile::where('phone', $phone)->first();

            if ($profile) {
                $profile->update([
                    'type' => $type,
                    'multiples' => $req->multiples,
                    'amount' => $req->amount,
                    'email' => $req->email,
                    'first_name' => $req->first_name,
                    'last_name' => $req->last_name,
                    'gender' => $req->gender,
                    'age' => $req->age,
                    'pan' => $req->pan,
                    'aadhaar' => $req->aadhaar,
                    'address' => $req->address,
                    'pincode' => $req->pincode,
                    'city' => $req->city,
                    'state' => $req->state,
                    'company_name' => $req->company_name,
                    'company_pan' => $req->company_pan,
                    'company_aadhaar' => $req->company_aadhaar,
                    'company_address' => $req->company_address,
                    'company_pincode' => $req->company_pincode,
                    'company_city' => $req->company_city,
                    'company_state' => $req->company_state,
                    'seat_number' => $req->seat_number,
                    'category' => $req->category,
                    'event_id' => $req->event_id,
                    'batch' => $batch_id,
                ]);
            } else {
                // Handle the case when the profile record does not exist
            }

            if ($donation) {
                $donation->update([
                    'type' => $type,
                    'multiples' => $req->multiples,
                    'amount' => $req->amount,
                    'email' => $req->email,
                    'first_name' => $req->first_name,
                    'last_name' => $req->last_name,
                    'gender' => $req->gender,
                    'age' => $req->age,
                    'pan' => $req->pan,
                    'aadhaar' => $req->aadhaar,
                    'address' => $req->address,
                    'pincode' => $req->pincode,
                    'city' => $req->city,
                    'state' => $req->state,
                    'company_name' => $req->company_name,
                    'company_pan' => $req->company_pan,
                    'company_aadhaar' => $req->company_aadhaar,
                    'company_address' => $req->company_address,
                    'company_pincode' => $req->company_pincode,
                    'company_city' => $req->company_city,
                    'company_state' => $req->company_state,
                    'seat_number' => $req->seat_number,
                    'category' => $req->category,
                    'event_id' => $req->event_id,
                    'batch' => $batch_id,
                ]);
            } else {
                // Handle the case when the donation record does not exist
            }
        }
        session()->put('success', 'Donation Added Successfully for ' . $event_name . ' Event');
        return redirect('donations/' . $event_id);
    }

    public function profile()
    {
        if (session()->get('rexkod_user_id')) {
            $profiles = Profile::where('id', session('rexkod_user_id'))->get();
            foreach ($profiles as $profile) {
                $phone = $profile->phone;
            }
            $donations = Donation::where('phone', $phone)->get();
            $passes = Passe::join('donations', 'donations.id', '=', 'passes.donation_id')
                ->where('donations.phone', $phone)
                ->get();

            $data = [
                "profiles" => $profiles,
                "passes" => $passes,
                "donations" => $donations,
            ];
            return view('profile', ['data' => $data]);
        }
    }

    function create_profile(Request $request)
    {
        $profile = new Profile();
        $profile->type = $request->type;
        $profile->phone = $request->phone;
        $profile->email = $request->email;
        $profile->first_name =preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '', $request->first_name);
        $profile->last_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->last_name);
        $profile->age = $request->age;
        $profile->gender = $request->gender;
        $profile->pan = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->pan);
        $profile->aadhaar = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->aadhaar);
        $profile->address = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->address);
        $profile->pincode = $request->pincode;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->company_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->company_name ?? null);
        $profile->company_pan = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->company_pan ?? null);
        // $profile->company_aadhaar = $request->company_aadhaar ?? null;
        $profile->company_address = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$request->company_address ?? null);
        $profile->company_pincode = $request->company_pincode ?? null;
        $profile->company_city = $request->company_city ?? null;
        $profile->company_state = $request->company_state ?? null;
        $profile->status = 0;
        $profile->save();

        Session::put('rexkod_user_id', $profile->id);
        $profiles = Profile::where('id', session('rexkod_user_id'))->get();
        foreach ($profiles as $profile) {
            $phone = $profile->phone;
        }
        $donations = Donation::where('phone', $phone)->get();
        $passes = Passe::join('donations', 'donations.id', '=', 'passes.donation_id')
            ->where('donations.phone', $phone)
            ->get();

        $data = [
            "profiles" => $profiles,
            "passes" => $passes,
            "donations" => $donations,
        ];
        return view('profile', ['data' => $data]);
    }

    public function profile_passes()
    {
        if (session()->get('rexkod_user_id')) {
            $profiles = Profile::where('id', session('rexkod_user_id'))->get();
            foreach ($profiles as $profile) {
                $phone = $profile->phone;
            }
            $passes = Passe::join('donations', 'donations.id', '=', 'passes.donation_id')
                ->where('donations.phone', $phone)
                ->get();
            $data = [
                "profiles" => $profiles,
                "passes" => $passes,
            ];
            return view('profile_passes', ['data' => $data]);
        }
    }

    public function profile_donations()
    {
        if (session()->get('rexkod_user_id')) {
            $profiles = Profile::where('id', session('rexkod_user_id'))->get();
            foreach ($profiles as $profile) {
                $phone = $profile->phone;
            }
            $donations = Donation::where('phone', $phone)->get();
            $onlinedonations = Transaction::where('phone_number', $phone)->get();


            $data = [
                "profiles" => $profiles,
                "donations" => $donations,
                 "onlinedonations" =>$onlinedonations
            ];
            return view('profile_donations', ['data' => $data]);
        }
    }

    public function verify($id)
    {

        if (session()->get('rexkod_admin_user_id')) {
            $pass = Passe::where('id', $id)->first();
            if (isset($pass)) {
                $donation = Donation::where('id', $pass->donation_id)->first();
                if ($pass->status == '0') {
                    $event = Events::where('id', $pass->event_id)->first();
                    session()->put('success', 'Checked In');
                    session()->put('success2', 'Name:' . $donation->first_name . ', Age:' . $donation->age . ', Gender:' . $donation->gender);
                    session()->put('success3', 'Category:' . $donation->category . ', Seat:' . $donation->seat_number);
                    $user_id = session()->get('rexkod_admin_user_id');
                    Passe::where('id', $id)->update(['status' => '1', 'scanned_by' => $user_id]);
                    $checkin = new Checkin;
                    $checkin->pass_id = $pass->id;
                    $checkin->scanned_by = session()->get('rexkod_admin_user_id');
                    $checkin->save();


                    $user = 'VVKICRM'; //your username
                    $password = 'pass@1981'; //your password
                    $mobilenumbers = $donation->phone; //['To']; //enter Mobile numbers comma seperated
                    $message = "
                    You have been successfully checked in to Vigyan Bhairav 3 at Mumbai Please take your seat. Please keep your phones on silent mode & take safety precautions as necessary."; //enter Your Message // It should be DLT approved. 
                    $senderid = 'VVKICRM'; //Your senderid
                    $messagetype = "N"; //Type Of Your Message
                    $DReports = "Y"; //Delivery Reports
                    $murl = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
                    $message = urlencode($message);
                    $ch = curl_init();
                    if (!$ch) {
                        die("Couldn't initialize a cURL handle");
                    }
                    $ret = curl_setopt($ch, CURLOPT_URL, $murl);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                    curl_setopt(
                        $ch,
                        CURLOPT_POSTFIELDS,
                        "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports"
                    );
                    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    $curlresponse = curl_exec($ch); // execute

                    if (curl_errno($ch))
                        echo 'curl error : ' . curl_error($ch);

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
                    return redirect('/scan');
                } else {
                    return redirect('verified/' . $id);
                }
            } else {
                session()->put('failed', 'Invalid');
                return redirect('/scan');
            }
        } else {
            return redirect('login');
        }
    }

    public function verified($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $pass = Passe::where('id', $id)->first();
            if (isset($pass)) {
                $user = Donation::where('id', $pass->donation_id)->first();
                Passe::where('id', $id)->update(['status' => '1', 'scanned_by' => session()->get('rexkod_admin_user_id')]);
                $checkins = Checkin::where('pass_id', $pass->id)->get();
                $checkins = $checkins->count();
                $data = [
                    "pass" => $pass,
                    "user" => $user,
                    "checkins" => $checkins,
                ];
                return view('/verified', ['data' => $data]);
            } else {
                session()->put('failed', 'Invalid');
                return redirect('scan');
            }
        } else {
            return redirect('login');
        }
    }

    public function checkout($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $pass = Passe::where('id', $id)->first();
            if (isset($pass)) {
                $donation = Donation::where('id', $pass->donation_id)->first();
                Passe::where('id', $id)->update(['status' => '2']);
                session()->put('success', 'Checked Out');

                $checkin = new Checkin;
                $checkin->pass_id = $pass->id;
                $checkin->scanned_by = session()->get('rexkod_admin_user_id');
                $checkin->save();

                /*
        $user = 'VVKICRM'; //your username
        $password = 'pass@1981'; //your password
        $mobilenumbers = $donation->phone;//['To']; //enter Mobile numbers comma seperated
        $message = "
        Dear ".$donation->first_name." Ji, We hope you truly enjoyed this graceful session. We look forward to meeting you again on the spiritual journey under the guidance of Gurudev Sri Sri Ravi Shankar. Have a safe & pleasant journey ahead! - The Art Of Living"; //enter Your Message // It should be DLT approved. 
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
            echo $curlresponse; //echo "Message Sent Succesfully" ;
        }
        */
            } else {
                session()->put('failed', 'Invalid');
            }

            return redirect('/scan');
        } else {
            return redirect('login');
        }
    }
    public function eventcheckout($eventid = null)
{
    if ($eventid != null) {
        $event = Events::where('id', $eventid)->first();  
        
        if (!$event) {
            return redirect('eventcheckout'); // Redirect to login if event not found
        }
        
        $eventArray = $event->toArray();
         $event_name =$event->event_name;
         $location_pass =$event->location_pass;
        
        $event_id = $eventArray['id'];
        $categories = $eventArray['cat_name'];
        $values = $eventArray['cat_value'];
        $categoryarr = explode(',', $categories);
        $valuearr = explode(',', $values);
        $data = ['events' => $eventArray, 'categories' => $categoryarr, 'values' => $valuearr, 'event_id' => $event_id,'evnet_name'=> $event_name,' location_pass'=> $location_pass];

        // You can remove these lines as they are not doing anything useful
        // session()->put('id');
        // session()->put('cat_name');
        // session()->put('cat_value');

        return view('checkout', ['data' => $data]);
    } else {
        $categoryarr = ['Premium', 'Gold', 'Silver', 'General'];
        $valuearr = [5000, 3000, 2000, 1000];
        $data = [
            'categories' => $categoryarr,
            'values' => $valuearr
        ];

        return view('checkout', ['data' => $data]);
    }
}

    

    public function off_payment($event_id)
{
    $event = Events::where('id', $event_id)->first();

    if ($event) {
        $eventArray = $event->toArray();
        $cat_arr = explode(',', $eventArray['cat_name']);
        $val_arr = explode(',', $eventArray['cat_value']);
        $categories = [];
        foreach ($cat_arr as $key => $val) {
            $categories[$val] = $val_arr[$key];
        }

        $data = [
            'events' => $eventArray,
            'categories' => $categories,
        ];
        return view('off_payment', ['data' => $data]);
    } else {
        // Handle the case where the event is not found, e.g., show an error message or redirect.
        // You may also want to consider returning a 404 response.
    }
}


    public function off_transaction(Request $req, $event_id)
    {
       
        $transaction = new Transaction;
        $transaction->event_id = $req->event_id;
        $transaction->event_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$req->event_name);
        $transaction->phone_number = $req->phone_number;
        $transaction->category = $req->category;
        $transaction->multiples = $req->multiples;
        $transaction->amount = $req->amount;
        $transaction->amount = $req->amount;
        $transaction->transaction_status=$req->transaction_status;
        $transaction->transaction_id = $req->transaction_id;
        $transaction->payment_mode = $req->payment_mode;
        $transaction->cheque_details = $req->cheque_details;
        $transaction->description = $req->description;
        $transaction->arex_id=session()->get('rexkod_admin_user_id');
     
        if ($req->hasFile('transaction_img')) {
            $validExtensions = ['png', 'jpeg', 'jpg'];
            $transaction_img = $req->file('transaction_img');

            $originalExtension = $transaction_img->getClientOriginalExtension();

            if ($transaction_img->isValid() && in_array($originalExtension, $validExtensions)) {
                $filename = Str::random(4) . time() . '.' . $originalExtension;
                $transaction_img->move(public_path('assets'), $filename);
                $transaction->transaction_img = $filename;
            } else {
                // Handle invalid file
                return redirect()->back()->with('error', 'Invalid file. Please upload an image in PNG, JPEG, JPG format.');
            }
        } else {
            return redirect()->back()->with('error', 'No image was uploaded');
        }
         $transaction->save();
         
        $transactions = new Donation();
        $transactions->event_id = $req->event_id;
        $transaction->type=$req->type;
        $transaction->transaction_status=$req->transaction_status;
        $transactions->phone = $req->phone_number;
        $transactions->category = $req->category;
        $transactions->multiples = $req->multiples;
        $transactions->amount = $req->amount;
        $transactions->transaction_id = $req->transaction_id;
        $transactions->first_name = $req->first_name;
        $transactions->last_name = $req->last_name;
        $transactions->email = $req->email;
        $transactions->gender = $req->gender;
        $transactions->age = $req->age;
        $transactions->pan = $req->pan;
        $transactions->aadhaar = $req->aadhaar;
        $transactions->seat_number=$req->seat_number;
     
        $transactions->save();
        session()->put('success', 'Payment Complete');

        return redirect('/aprex_transaction');
    }

    public function transactionDetails($eventid)
    {
        // $transactions = Transaction::where('event_id', $eventid)->get();
        $transactions = Transaction::where('transactions.event_id', $eventid)
        ->join('profiles', 'transactions.phone_number', '=', 'profiles.phone')
        ->select('transactions.*', 'profiles.first_name as first_name')
        ->get();

        $transactions = $transactions->toArray();
        $data = [
            'transactions' => $transactions,
        ];
        return view('viewtransactions', ['data' => $data]);
    }

    public function checkPhoneNumber(Request $request)
    {
        $phone_number = $request->input('phone_number');

        $data = Profile::where('phone', $phone_number)->first();

        if ($data) {
            $data = $data->toArray();
            return response()->json($data);
        } else {
            return response()->json(false);
        }
    }

    public function alltransactions()
    {
        $transactions = Transaction::join('profiles', 'transactions.phone_number', '=', 'profiles.phone')
        ->select('transactions.*', 'profiles.first_name as first_name')
        ->get();       
         $transactions = $transactions->toArray();
        $data = [
            'transactions' => $transactions,
        ];
        return view('viewtransactions', ['data' => $data]);
    }

    public function aprex_alltransactions()
    {
        $transactions = Transaction::join('profiles', 'transactions.phone_number', '=', 'profiles.phone')
            ->where('transactions.arex_id', '=',session()->get('rexkod_admin_user_id'))  // Add this line to filter by apex_id
            ->select('transactions.*', 'profiles.first_name as first_name')
            ->get();       
    
        $transactions = $transactions->toArray();
        
        $data = [
            'transactions' => $transactions,
        ];
    
        return view('aprex_transaction', ['data' => $data]);
    }
    

    public function recheckin($id)
    {
        if (session()->get('rexkod_admin_user_id')) {
            $pass = Passe::where('id', $id)->first();
            if (isset($pass)) {
                $donation = Donation::where('id', $pass->donation_id)->first();
                session()->put('success', 'Checked In');

                $checkin = new Checkin;
                $checkin->pass_id = $pass->id;
                $checkin->scanned_by = session()->get('rexkod_admin_user_id');
                $checkin->save();
            } else {
                session()->put('failed', 'Invalid');
            }

            return redirect('/scan');
        } else {
            return redirect('login');
        }
    }

    public function update_donation($id, Request $req)
    {
        $donation = Donation::where('id', $id)->first();

        $email = $req->email;
        if (str_contains($req->email, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $phone = $req->phone;
        if (str_contains($req->phone, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $pan = $req->pan;
        if (str_contains($req->pan, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $aadhaar = $req->aadhaar;
        if (str_contains($req->aadhaar, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $company_aadhaar = $req->company_aadhaar;
        if (str_contains($req->company_aadhaar, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $type =  $req->type;
        $first_name = $req->first_name;
        $last_name = $req->last_name;
        $email = $req->email;
        $age = $req->age;
        $gender = $req->gender;
        $seat_number = $req->seat_number;
        if ($type == 'Individual') {
            $multiples = $req->multiples;
        } else {
            $multiples = $req->multiples_c;
        }
        $category = $req->category;
        $amount = $req->amount;
        $company_name = $req->company_name;
        $company_pan = $req->company_pan;
        $company_address = $req->company_address;
        $company_pincode = $req->company_pincode;
        $company_city = $req->company_city;
        $company_state = $req->company_state;

        if (session()->get('rexkod_admin_user_id')) {
            $donation->update([
                'type' => $type,
                'amount' => $amount,
                'category' => $category,
                'phone' => $phone,
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'age' => $age,
                'gender' => $gender,
                'aadhaar' => $aadhaar,
                'seat_number' => $seat_number,
                'multiples' => $multiples,
                'company_name' => $company_name,
                'company_pan' => $company_pan,
                'company_aadhaar' => $company_aadhaar,
                'company_address' => $company_address,
                'company_pincode' => $company_pincode,
                'company_city' => $company_city,
                'company_state' => $company_state,
            ]);
            session()->put('success', 'Details Updated');
            return redirect('donations/' . $donation->event_id);
        } else {
            return redirect('login');
        }
    }


    public function update_apex(Request $req)
    {
        $id = $req->id;
        $user = User::where('id', $id)->first();
        if (str_contains($req->name, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $user->name = $req->name;
        if (str_contains($req->email, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $user->email = $req->email;
        if (str_contains($req->phone, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $duplicate = User::where("phone", $req->phone)->first();
        if (!$duplicate) {
            $user->phone = $req->phone;
        }
        if (str_contains($req->pan, 'script')) {
            session()->flush();
            return redirect('login');
        }
        $user->apex = $req->apex;
        if (session()->get('rexkod_admin_user_id')) {
            $user->save();
            session()->put('success', 'Details Updated');
            return redirect('all_apex/');
        } else {
            return redirect('login');
        }
    }

    public function delete_donation($id)
    {
        $donation = Donation::where('id', $id)->first();

        if (session()->get('rexkod_admin_user_id')) {
            Donation::where('id', $id)->delete();
            Passe::where('donation_id', $id)->delete();
            session()->put('success', 'Donation Deleted');
            return redirect('donations/' . $donation->event_id);
        } else {
            return redirect('login');
        }
    }


    public function block_donation($id)
    {
        $donation = Donation::where('id', $id)->first();

        if (session()->get('rexkod_admin_user_id')) {
            Donation::where('id', $id)->update(['status' => '2', 'seat_number' => NULL]);
            Passe::where('donation_id', $id)->delete();
            session()->put('success', 'Visitor Blocked');
            return redirect('donations/' . $donation->event_id);
        } else {
            return redirect('login');
        }
    }

    public function scan_pass($val)
    {
        //$result = Pincode::where('pincode', $pin)->first();
        echo $val;
    }


    public function delete_batch($id, $remark = NULL)
    {

        if (session()->get('rexkod_admin_user_id')) {
            $batch = Batche::where("id", $id)->first();
            $event = Events::where("id", $batch->event_id)->first();
            $donations = Donation::where("batch", $batch->id)->get();
            if ($event->apex_admin_id == session()->get('rexkod_admin_user_id') || session()->get('rexkod_admin_user_type') == "admin") {
                Batche::where("id", $id)->delete();
                Donation::where("batch", $batch->id)->delete();
                Passe::where("batch_id", $batch->id)->delete();

                session()->put('success', "Batch Deleted");
                return redirect('batches/' . $event->id);
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }



    public function upload_file(Request $req)
    {

        if (session()->get('rexkod_admin_user_type') == "apex") {

            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

            if (!empty($req->file('upload')) && $csvMimes) {
                $batch_name = rtrim($req->file('upload')->getClientOriginalName(), ".csv");

                if (is_uploaded_file($req->file('upload'))) {

                    $csvFile = fopen($req->file('upload'), 'r');
                    $csvFile_main = fopen($req->file('upload'), 'r');

                    $row_count = 0;
                    $cur_events = array();

                    while (($line_check = fgetcsv($csvFile)) !== FALSE) {

                        for ($i = 0; $i < 21; $i++) {
                            if (str_contains($line_check[$i], 'script')) {
                                session()->flush();
                                return redirect('login');
                            }
                        }

                        if ($row_count) {

                            if (!$line_check[0]) {
                                session()->put('failed', "'Multiple' missing at Line " . $row_count);
                                return redirect('upload/');
                            }

                            if (!$line_check[2]) {
                                session()->put('failed', "'Phone' missing at Line " . $row_count);
                                return redirect('upload/');
                            }

                            if (!$line_check[4]) {
                                session()->put('failed', "'First Name' missing at Line " . $row_count);
                                return redirect('upload/');
                            }

                            if ($line_check[19]) {
                                $seat_number = Donation::where("event_id", $line_check[21])->where("seat_number", $line_check[19])->first();
                                if ($seat_number) {
                                    session()->put('failed', "'Seat Number' duplicate at line " . $row_count);
                                    return redirect('upload/');
                                }
                            }

                            if (!$line_check[21]) {
                                session()->put('failed', "'Event ID' missing at Line " . $row_count);
                                return redirect('upload/');
                            } else {
                                array_push($cur_events, $line_check[21]);
                                $event = Events::where("id", $line_check[21])->first();
                                if (isset($event)) {
                                    $event_apex = explode(",", $event->apex_admins);
                                    if (!in_array(session()->get('rexkod_admin_user_id'), $event_apex)) {
                                        session()->put('failed', "'Event ID' invalid at line " . $row_count);
                                        return redirect('upload/');
                                    }
                                } else {
                                    session()->put('failed', "'Event ID' invalid at line " . $row_count);
                                    return redirect('upload/');
                                }
                            }
                        }
                        $row_count++;
                    }

                    if (count(array_unique($cur_events)) != 1) {
                        session()->put('failed', "Multiple Event IDs found");
                        return redirect('upload/');
                    }

                    $count = 0;
                    $total = 0;
                    $batch_id = NUll;
                    while (($line = fgetcsv($csvFile_main)) !== FALSE) {
                        if ($count) {
                            $donation = new Donation;
                            $donation->multiples = $line[0];
                            $donation->amount = $line[1];
                            $donation->phone = $line[2];
                            $donation->email = $line[3];
                            $donation->first_name = $line[4];
                            $donation->last_name = $line[5];
                            $donation->gender = $line[6];
                            $donation->age = $line[7];
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
                            $donation->seat_number = $line[19];
                            $donation->category = $line[20];
                            $donation->event_id = $line[21];
                            $donation->batch_name = $batch_name;
                            $donation->batch = $batch_id;
                            $donation->save();
                            $event_id = $line[21];
                        } else {
                            $batch = new Batche();
                            $batch->event_id = $event->id;
                            $batch->name = $batch_name;
                            $batch->save();
                            $batch_id = $batch->id;
                        }
                        $count++;
                    }
                    $batch = Batche::where("id", $batch_id)->first();
                    $batch->total = $count - 1;
                    $batch->save();
                    fclose($csvFile);

                    session()->put('success', 'Data Uploaded');
                    return redirect('donations/' . $event_id);
                }
            }
        } else {
            session()->put('failed', "Not Permitted");
            return redirect('upload/');
        }
    }


    function create_passes($id,Request $req)
    {
         
       

        $donations = Donation::where('pass_generated', 0)->where('event_id', $id)->get();
        $profiles = Profile::where('pass_generated', 0)->where('event_id', $id)->get();
        $event = Event::find($id);
    
        if ($event->type == "1" || $event->type == "2") {
            foreach ($donations as $donation) {
                
                // Check if there's a transaction with CHARGED status for this donation
                $transaction = Transaction::where('transaction_id', $donation->transaction_id)
                ->where('transaction_status', 'CHARGED')
                ->first();  
              
                if ($transaction ) {
                 
                    for ($i = 1; $i <= $donation->multiples; $i++) {

                    // echo '<pre>';
                    // print_r($donation);
                    // $pro = Profile::where('phone', $donation->phone)->get();
                    // print_r($pro);
                    // print_r($donation->phone);
                    // die();
                   
                    header("Content-type: image/jpg");


                    $unqdate = date("Ymd");
                    $unqtime = time();
                    $new_file_name = $donation->id . "-" . $i . "-" . $unqdate . "" . $unqtime . ".jpg";
                   

                    $pass = new Passe;
                    $pass->donation_id = $donation->id;
                    $pass->event_id = $id;
                    $pass->batch_id = $donation->batch;
                    $pass->pass_file = $new_file_name;
                    $pass->pass_date= $req->input('pass_date');
                    
                    $pass->save();

                    Donation::where('id', $donation->id)->update(['pass_generated' => '1']);
                    Profile::where('phone', $donation->phone)->update(['pass_generated' => '1']);

                    if (isset($donation->seat_number)) {
                        $seat_number = $donation->seat_number;
                    } else {
                        $seat_number = "N/A";
                    }

                    if (isset($donation->category)) {
                        $category = $donation->category;
                    } else {
                        $category = "N/A";
                    }

                    $uid = $pass->id;

                    if (isset($event->phone2)) {
                        $phone2 = ", " . $event->phone2;
                    } else {
                        $phone2 = NULL;
                    }
                    if (isset($event->phone3)) {
                        $phone3 = ", " . $event->phone3;
                    } else {
                        $phone3 = NULL;
                    }

                    $assistance = $event->phone1 . "" . $phone2 . "" . $phone3;
                    $name = $donation->first_name . " " . $donation->last_name;
                    $session1  = $event->session1;
                    $session2  = $event->session2;
                    $session3  = $event->session3;
                    $session4  = $event->session4;

                    $event_name1 = $event->event_name_pass1;
                    $event_name2 = $event->event_name_pass2;
                    $event_location = $event->location_pass;
                    $event_date = $event->date_pass;

                    $file_name = 'pass/vbpass.jpg';
                    $img_source = imagecreatefromjpeg($file_name);


                    $font = 'fonts/ARIBL0.ttf';
                    $text_color = imagecolorallocate($img_source, 87, 250, 250);

                    $ev_name = imagettfbbox(30, 0, $font, $event_name1);
                    imagettftext($img_source, 30, 0, (750 - $ev_name[2]) / 2, 250, $text_color, $font, $event_name1);

                    $font = 'fonts/ARIBL0.ttf';
                    $text_color = imagecolorallocate($img_source, 255, 255, 255);

                    $ev_location = imagettfbbox(20, 0, $font, $event_location);
                    imagettftext($img_source, 20, 0, (750 - $ev_location[2]) / 2, 295, $text_color, $font, $event_location);

                    $font = 'fonts/ARIBL0.ttf';
                    $text_color = imagecolorallocate($img_source, 87, 250, 250);

                    $ev_date = imagettfbbox(20, 0, $font, $event_date);
                    imagettftext($img_source, 20, 0, (750 - $ev_date[2]) / 2, 340, $text_color, $font, $event_date);

                    $qr_code = imagecreatefromstring(file_get_contents('https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=' . $uid));
                    imagecopymerge($img_source, $qr_code, 327, 367, 10, 10, 100, 100, 100);

                    $font = 'fonts/ARIBL0.ttf';
                    $text_color = imagecolorallocate($img_source, 255, 255, 255);

                    $x = 215; // X - Postion of text.
                    $y = 540; // Y- Postion of text .
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $name);

                    $x = 529; // X - Postion of text.
                    $y = 540; // Y- Postion of text .
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $uid);
                    $x = 250; // X - Postion of text.
                    $y = 580; // Y- Postion of text .
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $category);
                    $x = 567; // X - Postion of text.
                    $y = 580; // Y- Postion of text .
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $seat_number);

                    if (isset($event->session1)) {
                        $x = 150;
                        $y = 617;
                        imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $session1);
                    }

                    if (isset($event->session2)) {
                        $x = 150;
                        $y = 647;
                        imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $session2);
                    }

                    if (isset($event->session3)) {
                        $x = 150;
                        $y = 677;
                        imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $session3);
                    }

                    if (isset($event->session4)) {
                        $x = 150;
                        $y = 710;
                        imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $session4);
                    }

                    $x = 318;
                    $y = 791;
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $assistance);

                    ImageJpeg($img_source, 'pass/' . $new_file_name);
                }
               
               
             }
              session()->put('success', 'Passes Created');
            }
            session()->put('success', 'Passes Created');
        return redirect('passes/' . $id);
    }


    function create_passes_main($id)
    {
        
        // dd($id);

        session()->put('success', 'Passes Created');

        $donations = Donation::where('pass_generated', 0)->where('event_id', $id)->get();
        $event = Events::where('id', $id)->first();
        foreach ($donations as $donation) {
            $transaction = Transaction::where('transaction_id', $donation->transaction_id)
            ->where('transaction_status', 'CHARGED')
            ->first(); 
            if ($transaction ) {

            for ($i = 1; $i <= $donation->multiples; $i++) {

                header("Content-type: image/jpg");


                $unqdate = date("Ymd");
                $unqtime = time();
                $new_file_name = $donation->id . "-" . $i . "-" . $unqdate . "" . $unqtime . ".jpg";

                $pass = new Passe;
                $pass->donation_id = $donation->id;
                $pass->event_id = $id;
                $pass->batch_id = $donation->batch;
                $pass->pass_file = $new_file_name;
                $pass->save();
                Donation::where('id', $donation->id)->update(['pass_generated' => '1']);

                if (isset($donation->seat_number)) {
                    $seat_number = $donation->seat_number;
                } else {
                    $seat_number = "N/A";
                }

                if (isset($donation->category)) {
                    $category = $donation->category;
                } else {
                    $category = "N/A";
                }


                $uid = $pass->id;

                if (isset($event->phone2)) {
                    $phone2 = ", " . $event->phone2;
                } else {
                    $phone2 = NULL;
                }
                if (isset($event->phone3)) {
                    $phone3 = ", " . $event->phone3;
                } else {
                    $phone3 = NULL;
                }

                $assistance = $event->phone1 . "" . $phone2 . "" . $phone3;
                $name = $donation->first_name . " " . $donation->last_name;
                $session1  = "Session 1: " . $event->session1;
                $session2  = "Session 2: " . $event->session2;
                $session3  = "Session 3: " . $event->session3;

                $event_name1 = $event->event_name_pass1;
                $event_name2 = $event->event_name_pass2;
                $event_location = $event->location_pass;
                $event_date = $event->date_pass;

                $file_name = 'pass/pass.jpg';
                $img_source = imagecreatefromjpeg($file_name);


                $font = 'fonts/ARIBL0.ttf';
                $text_color = imagecolorallocate($img_source, 87, 250, 250);

                $ev_name = imagettfbbox(30, 0, $font, $event_name1);
                imagettftext($img_source, 30, 0, (750 - $ev_name[2]) / 2, 200, $text_color, $font, $event_name1);


                $font = 'fonts/ARIBL0.ttf';
                $text_color = imagecolorallocate($img_source, 87, 250, 250);

                $ev_name = imagettfbbox(20, 0, $font, $event_name2);
                imagettftext($img_source, 20, 0, (750 - $ev_name[2]) / 2, 240, $text_color, $font, $event_name2);


                $font = 'fonts/ARIBL0.ttf';
                $text_color = imagecolorallocate($img_source, 255, 255, 255);

                $ev_location = imagettfbbox(20, 0, $font, $event_location);
                imagettftext($img_source, 20, 0, (750 - $ev_location[2]) / 2, 285, $text_color, $font, $event_location);


                $font = 'fonts/ARIBL0.ttf';
                $text_color = imagecolorallocate($img_source, 87, 250, 250);

                $ev_date = imagettfbbox(20, 0, $font, $event_date);
                imagettftext($img_source, 20, 0, (750 - $ev_date[2]) / 2, 330, $text_color, $font, $event_date);



                $qr_code = imagecreatefromstring(file_get_contents('https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=' . $uid));
                imagecopymerge($img_source, $qr_code, 327, 367, 10, 10, 100, 100, 100);


                $font = 'fonts/ARIBL0.ttf';
                $text_color = imagecolorallocate($img_source, 255, 255, 255);


                $x = 215; // X - Postion of text.
                $y = 540; // Y- Postion of text .
                imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $name);

                $x = 529; // X - Postion of text.
                $y = 540; // Y- Postion of text .
                imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $uid);
                $x = 250; // X - Postion of text.
                $y = 580; // Y- Postion of text .
                imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $category);
                $x = 567; // X - Postion of text.
                $y = 580; // Y- Postion of text .
                imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $seat_number);

                if (isset($event->session1)) {
                    $x = 150;
                    $y = 620;
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $session1);
                }

                if (isset($event->session2)) {
                    $x = 150;
                    $y = 660;
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $session2);
                }

                if (isset($event->session3)) {
                    $x = 150;
                    $y = 707;
                    imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $session3);
                }

                $x = 318;
                $y = 791;
                imagettftext($img_source, 13, 0, $x, $y, $text_color, $font, $assistance);


                ImageJpeg($img_source, 'pass/' . $new_file_name);
            }
        }
        }
    }
        return redirect('passes/' . $id);
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
        $file_name = 'passes/entry_pass.jpg';
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


        ImageJpeg($img_source, 'passes/hello.png');
        ImageJpeg($img_source);
    }


    public function send_pass($id)
    {

        $pass = Passe::where('pass_id', $id);
        $donation = Donation::where('id', $pass->donation_id)->first();
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
                    "to": "' . $donation->phone . '",
                    "templateName": "vigyan_bhairav_invite",
                    "parameters": [
                       "' . $donation->first_name . '",
                       "3"
                    ],
                    "file": {
                        "type": "image",
                        "url": "https://uat-sanidhya.artofliving.online/pass/' . $pass->pass_file . '"
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


    function send_passes($id)
    {

        echo "<h3>It is taking longer than usual, Please dont refresh or reload page.</h3>";

        session()->put('success', 'Passes Sent on WhatsApp');

        $passes = Passe::where('whatsapp', 0)->get();
        foreach ($passes as $pass) {
            $donation = Donation::where('id', $pass->donation_id)->first();
            $event = Events::where('id', $donation->event_id)->first();
            $batch = Batche::where('id', $donation->batch)->where('whatsapp', 0)->first();
            if (isset($batch)) {
                Batche::where('id', $donation->batch)->update(['whatsapp' => '1']);
            }
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
            "to": "91' . $donation->phone . '",
            "templateName": "event_invite_general",
		    "parameters": [
		    "Jai Gurudev",
		    "' . $donation->first_name . '",
		    "' . $event->event_name . '",
		    "Gurudev Sri Sri Ravi Shankar", 
		    "' . $pass->id . '", 
		    "' . $event->team_name . '"
		    ],
                    "file": {
                        "type": "image",
                        "url": "https://uat-sanidhya.artofliving.online/pass/' . $pass->pass_file . '"
                    }
                  
                }

            }';

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


            $response = curl_exec($curl);
            curl_close($curl);
            Passe::where('id', $pass->id)->update(['whatsapp' => '1']);
        }

        return redirect('passes/' . $id);
    }







    function mail_passes($id)
    {

        session()->put('success', 'Passes Sent on Mail');

        $passes = Passe::where('email', 0)->get();
        foreach ($passes as $pass) {
            $donation = Donation::where('id', $pass->donation_id)->first();
            $batch = Batche::where('id', $donation->batch)->where('mail', 0)->first();
            if (isset($batch)) {
                Batche::where('id', $donation->batch)->update(['mail' => '1']);
            }
            $event = Events::where('id', $donation->event_id)->first();

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


            $pass_file = base64_encode(file_get_contents('pass/' . $pass->pass_file));
            $guideline_file = base64_encode(file_get_contents('documents/guidelines.pdf'));
            $data = '{"personalizations": [{"to": [{"email": "' . $donation->email . '"}]}],"from": {"email": "noreply@artofliving.org"},"subject":"' . $event->event_name . ' Invitation","content": [{"type": "text/html","value": "Dear ' . $donation->first_name . ' Ji,<br><br>We would like to invite you for the ' . $event->event_name . ' event happening in presence of Gurudev Sri Sri Ravi Shankar ji.<br>Your registered UID for these session is <b>' . $pass->id . '</b> <br><br>Please find your e-pass and guidelines in attachments.<br><br>We wish you a blissful Program!<br><br>Thank You,<br><br>Jai Gurudev!<br><b>The Art Of Living</b>."}], "attachments": [{"content": "' . $pass_file . '", "type": "image/jpeg", "filename": "pass.jpg"},{"content": "' . $guideline_file . '", "type": "plain/pdf", "filename": "guidelines.pdf"}]}';

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $delivery = json_decode($response, TRUE);
            //print_r($delivery);

            Passe::where('id', $pass->id)->update(['email' => '1']);
        }

        return redirect('passes/' . $id);
    }

    function send_passes_selected(Request $req)
    {

        $id = $req->event_id;
        $options = $req->options;
        $sender = $req->sender;

        if (!$options) {
            $passes = $req->passes;
        } else if ($options == 'all') {
            $passes = Passe::all()->pluck('id')->toArray();
        } else {
            $passes = Passe::where("batch_id", $options)->pluck('id')->toArray();
        }

        if (!$passes) {
            session()->put('failed', 'Please select at least 1 pass');
            return redirect('passes/' . $id);
        } else if (!$sender) {
            session()->put('failed', 'Please select at least 1 Sender');
            return redirect('passes/' . $id);
        } else {


            if (in_array("w", $sender)) {
                foreach ($passes as $cur_pass) {
                    $pass = Passe::where('id', $cur_pass)->first();
                    $donation = Donation::where('id', $pass->donation_id)->first();
                    $event = Events::where('id', $donation->event_id)->first();

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
                    "to": "91' . $donation->phone . '",
                    "templateName": "event_invite_general",
                    "parameters": [
                    "Jai Gurudev",
                    "' . $donation->first_name . '",
                    "' . $event->event_name . '",
                    "Gurudev Sri Sri Ravi Shankar", 
                    "' . $pass->id . '", 
                    "' . $event->team_name . '"
                    ],
                    "file": {
                        "type": "image",
                        "url": "https://uat-sanidhya.artofliving.online/pass/' . $pass->pass_file . '"
                    }
                  
                }

            }';

                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


                    $response = curl_exec($curl);
                    curl_close($curl);
                }
            }

            if (in_array("m", $sender)) {
                foreach ($passes as $cur_pass) {
                    $pass = Passe::where('id', $cur_pass)->first();
                    $donation = Donation::where('id', $pass->donation_id)->first();
                    $event = Events::where('id', $donation->event_id)->first();

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
                    $pass_file = base64_encode(file_get_contents('pass/' . $pass->pass_file));
                    $guideline_file = base64_encode(file_get_contents('documents/guidelines.pdf'));
                    $data = '{"personalizations": [{"to": [{"email": "' . $donation->email . '"}]}],"from": {"email": "noreply@artofliving.org"},"subject":"' . $event->event_name . ' Invitation","content": [{"type": "text/html","value": "Dear ' . $donation->first_name . ' Ji,<br><br>We would like to invite you for the ' . $event->event_name . ' event happening in presence of Gurudev Sri Sri Ravi Shankar ji.<br>Your registered UID for these session is <b>' . $pass->id . '</b> <br><br>Please find your e-pass and guidelines in attachments.<br><br>We wish you a blissful Program!<br><br>Thank You,<br><br>Jai Gurudev!<br><b>The Art Of Living</b>."}], "attachments": [{"content": "' . $pass_file . '", "type": "image/jpeg", "filename": "pass.jpg"},{"content": "' . $guideline_file . '", "type": "plain/pdf", "filename": "guidelines.pdf"}]}';

                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                    $response = curl_exec($curl);
                    curl_close($curl);

                    $delivery = json_decode($response, TRUE);
                    //print_r($delivery);


                }
            }

            if (in_array("s", $sender)) {
                foreach ($passes as $cur_pass) {
                    $pass = Passe::where('id', $cur_pass)->first();
                    $donation = Donation::where('id', $pass->donation_id)->first();
                    $event = Events::where('id', $donation->event_id)->first();

                    $user = 'VVKICRM'; //your username
                    $password = 'pass@1981'; //your password
                    $mobilenumbers = $donation->phone; //['To']; //enter Mobile numbers comma seperated


                    $message = "Dear " . $donation->first_name . " " . $donation->last_name . " Ji, Thank you for your registration. The e-pass with UID " . $pass->id . " for the Program " . $event->event_name . " has been sent on your email or click here uat-sanidhya.artofliving.online/pass/" . $pass->pass_file . " to download. The Art Of Living";

                    $senderid = 'VVKICRM'; //Your senderid
                    $messagetype = "N"; //Type Of Your Message
                    $DReports = "Y"; //Delivery Reports
                    $murl = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
                    $message = urlencode($message);
                    $ch = curl_init();
                    if (!$ch) {
                        die("Couldn't initialize a cURL handle");
                    }
                    $ret = curl_setopt($ch, CURLOPT_URL, $murl);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                    curl_setopt(
                        $ch,
                        CURLOPT_POSTFIELDS,
                        "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports"
                    );
                    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    $curlresponse = curl_exec($ch); // execute

                    if (curl_errno($ch))
                        echo 'curl error : ' . curl_error($ch);

                    if (empty($ret)) {
                        // some kind of an error happened
                        die(curl_error($ch));
                        curl_close($ch); // close cURL handler
                    } else {
                        $info = curl_getinfo($ch);
                        curl_close($ch); // close cURL handler
                        $send = explode(":", $curlresponse);
                        echo $curlresponse; //echo "Message Sent Succesfully" ;
                    }
                }
            }


            session()->put('success', 'Passes Sent');
            return redirect('/passes/' . $id);
        }
    }







    function sms_passes($id)
    {

        session()->put('success', 'Passes Sent on SMS');

        $passes = Passe::where('sms', 0)->get();
        foreach ($passes as $pass) {

            $donation = Donation::where('id', $pass->donation_id)->first();
            $event = Events::where('id', $donation->event_id)->first();
            $batch = Batche::where('id', $donation->batch)->where('sms', 0)->first();
            if (isset($batch)) {
                Batche::where('id', $donation->batch)->update(['sms' => '1']);
            }
            $user = 'VVKICRM'; //your username
            $password = 'pass@1981'; //your password
            $mobilenumbers = $donation->phone; //['To']; //enter Mobile numbers comma seperated


            $message = "Dear " . $donation->first_name . " " . $donation->last_name . " Ji, Thank you for your registration. The e-pass with UID " . $pass->id . " for the Program " . $event->event_name . " has been sent on your email or click here uat-sanidhya.artofliving.online/pass/" . $pass->pass_file . " to download. The Art Of Living";

            $senderid = 'VVKICRM'; //Your senderid
            $messagetype = "N"; //Type Of Your Message
            $DReports = "Y"; //Delivery Reports
            $murl = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
            $message = urlencode($message);
            $ch = curl_init();
            if (!$ch) {
                die("Couldn't initialize a cURL handle");
            }
            $ret = curl_setopt($ch, CURLOPT_URL, $murl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports"
            );
            $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $curlresponse = curl_exec($ch); // execute

            if (curl_errno($ch))
                echo 'curl error : ' . curl_error($ch);

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
            Passe::where('id', $pass->id)->update(['sms' => '1']);
        }
        return redirect('passes/' . $id);
    }


    function volunteer_login(Request $req)
    {

        $user = User::where('phone', $req->phone)->first();
        if ($user && $user->type == "volunteer") {
            if (2 > 1) {
                $date = date('Y-m-d H:i:s');
                $req->session()->put('rexkod_admin_user_id', $user->id);
                $req->session()->put('rexkod_admin_user_type', $user->type);
                $req->session()->put('rexkod_admin_user_name', $user->name);
                User::where('phone', $req->phone)->update(['logged_in' => '1', 'last_logged_in' => $date]);
                return redirect('/scan');
            } else {
                session()->put('failed', 'Already Logged In');
                return redirect('/volunteer');
            }
        } else {
            session()->put('failed', 'Invalid Phone');
            return redirect('/volunteer');
        }
    }





    function test_mail()
    {

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
        $file = base64_encode(file_get_contents('passes/pass.jpg'));
        $data = '{"personalizations": [{"to": [{"email": "arunjithc@gmail.com"}]}],"from": {"email": "noreply@artofliving.org"},"subject":"Hello, World!","content": [{"type": "text/html","value": "Jai Guru Dev ( Name ) Ji,<br>We would like to invite you for the event happening in presence of Gurudev Sri Sri Ravi Shankar ji.<br>Your registered UID for these session is <number><br>Please find your e-pass and guidelines in attachments.<br>We wish you a blissful Program!<br>Thank You,<br><b>Jai Gurudev!</b>The Art Of Living."}], "attachments": [{"content": "' . $file . '", "type": "image/jpeg", "filename": "pass.jpg"},{"content": "' . $file . '", "type": "image/jpeg", "filename": "pass2.jpg"}]}';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($curl);
        curl_close($curl);

        $delivery = json_decode($response, TRUE);
        print_r($delivery);
    }

    public function fetchprofiledata()
    {
        if (session()->get('rexkod_user_id')) {
            $data = Profile::where('id', session('rexkod_user_id'))->get();
        }
        return view('profiledetails', ['data' => $data]);
    }
    public function fetchprofiledatadonation()
    {
        if (session()->get('rexkod_user_id')) {
            $data = Profile::where('id', session('rexkod_user_id'))->get();
        }
        return view('profiledetails', ['data' => $data]);
    }
 //--------------max---------------
    public function add_aprex_bulk_upload(){
        return view('add_aprex_bulk_upload');
    }

    public function bulk_upload_aprex(Request $req)
    { 
        if (!$req->hasFile('upload')) {
            return redirect()->back()->with('failed', 'No file uploaded');
        }
    
        $file = $req->file('upload');
    
        $allowedMimeTypes = [
            'text/csv',
            'application/csv',
            'text/plain',
            'application/vnd.ms-excel',
            // Add other allowed MIME types if needed
        ];
    
        if (!in_array($file->getClientMimeType(), $allowedMimeTypes)) {
            return redirect()->back()->with('failed', 'Invalid file type');
        }
    
        $csvFile = fopen($file->getPathname(), 'r');
        $rowCount = 0;
        $rowInserted = 0;
        $aprex_names = [];
        $aprex_emails = [];
        $aprex_phones = [];
        $aprex_aprexes = [];
    
        while (($line = fgetcsv($csvFile)) !== false) {
            // Validation for malicious data
            foreach ($line as $data) {
                if (str_contains($data, 'script') || str_contains($data, 'SCRIPT')) {
                    session()->flush();
                    return redirect('login');
                }
            }
    
            if ($rowCount === 0) {
                // Skip the first row (header row)
                $rowCount++;
                continue;
            }
    
            if (count($line) !== 4) {
                return redirect()->back()->with('failed', "No rows were uploaded due to invalid rows");
            }
    
            // Extract and validate data from each column
            $aprex_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '', $line[0]);
            $aprex_email = preg_replace('/[^a-zA-Z0-9\s@._-]/', '', $line[2]);
            $aprex_phone = preg_replace('/[^0-9]/', '', $line[1]);
            $aprex_aprex = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '', $line[3]);
    
            if (empty($aprex_name) || empty($aprex_email) || empty($aprex_phone) || empty($aprex_aprex)) {
                $chh[]=[$aprex_name, $aprex_email, $aprex_phone,$aprex_aprex];
                print_r($chh);
                die();
                return redirect()->back()->with('failed', "Missing data at Line " . $rowCount);
            }
    
            // if (in_array($aprex_name, $aprex_names) || in_array($aprex_email, $aprex_emails) || in_array($aprex_aprex, $aprex_aprexes)) {
            //     return redirect()->back()->with('failed', "No rows were uploaded due to duplicate data at Line " . $rowCount);
            // }
    
            if (User::where('email', $aprex_email)->exists()) {
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Email ID' or 'Phone Number' at Line " . $rowCount);
            }
            if( User::where('phone', $aprex_phone)->exists()){
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Phone Number' or 'Phone Number' at Line " . $rowCount);

            }
    
            $user = new User([
                'type' => 'apex',
                'name' => $aprex_name,
                'email' => $aprex_email,
                'phone' => $aprex_phone,
                'aprex' => $aprex_aprex, // Add this field if needed
            ]);
    
            if ($user->save()) {
                $rowInserted++;
                $aprex_names[] = $aprex_name;
                $aprex_emails[] = $aprex_email;
                $aprex_phones[] = $aprex_phone;
                $aprex_aprexes[] = $aprex_aprex;
            } else {
                return redirect()->back()->with('failed', 'Error saving data in row ' . $rowCount);
            }
    
            $rowCount++;
        }
    
        fclose($csvFile);
    
        if ($rowInserted > 0) {
            return redirect()->back()->with('success', 'File uploaded successfully');
        } else {
            return redirect()->back()->with('failed', 'File not uploaded');
        }
    }
    
   //=======================================================================
    public function bulk_create_volunteer (Request $req)
    { 
        if (!$req->hasFile('upload')) {
            return redirect()->back()->with('failed', 'No file uploaded');
        }
    
        $file = $req->file('upload');
    
        $allowedMimeTypes = [
            'text/csv',
            'application/csv',
            'text/plain',
            'application/vnd.ms-excel',
            // Add other allowed MIME types if needed
        ];
    
        if (!in_array($file->getClientMimeType(), $allowedMimeTypes)) {
            return redirect()->back()->with('failed', 'Invalid file type');
        }
    
        $csvFile = fopen($file->getPathname(), 'r');
        $rowCount = 0;
        $rowInserted = 0;
        $aprex_names = [];
        $aprex_emails = [];
        $aprex_phones = [];
      
    
        while (($line = fgetcsv($csvFile)) !== false) {
            // Validation for malicious data
            foreach ($line as $data) {
                if (str_contains($data, 'script') || str_contains($data, 'SCRIPT')) {
                    session()->flush();
                    return redirect('login');
                }
            }
    
            if ($rowCount === 0) {
                // Skip the first row (header row)
                $rowCount++;
                continue;
            }
    
            if (count($line) !== 3) {
                return redirect()->back()->with('failed', "No rows were uploaded due to invalid rows");
            }
    
            // Extract and validate data from each column
            $aprex_name = preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '', $line[0]);
            $aprex_email = preg_replace('/[^a-zA-Z0-9\s@._-]/', '', $line[1]);
            $aprex_phone = preg_replace('/[^0-9]/', '', $line[2]);
          
    
            if (empty($aprex_name) || empty($aprex_email) || empty($aprex_phone)) {
                // $chh[]=[$aprex_name, $aprex_email, $aprex_phone,$aprex_aprex];
                // print_r($chh);
                // die();
                return redirect()->back()->with('failed', "Missing data at Line " . $rowCount);
            }
    
            // if (in_array($aprex_name, $aprex_names) || in_array($aprex_email, $aprex_emails) || in_array($aprex_aprex, $aprex_aprexes)) {
            //     return redirect()->back()->with('failed', "No rows were uploaded due to duplicate data at Line " . $rowCount);
            // }
    
            if (User::where('email', $aprex_email)->exists()) {
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Email ID'  at Line " . $rowCount);
            }
            if( User::where('phone', $aprex_phone)->exists()){
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Phone Number' at Line " . $rowCount);

            }
            $apx=session('rexkod_admin_user_id');
           
            $user = new User([
                'type' => 'volunteer',
                'name' => $aprex_name,
                'email' => $aprex_email,
                'phone' => $aprex_phone,
                'apex' =>  $apx,
               
            ]);
    
            if ($user->save()) {
                $rowInserted++;
                $aprex_names[] = $aprex_name;
                $aprex_emails[] = $aprex_email;
                $aprex_phones[] = $aprex_phone;
               
            } else {
                return redirect()->back()->with('failed', 'Error saving data in row ' . $rowCount);
            }
    
            $rowCount++;
        }
    
        fclose($csvFile);
    
        if ($rowInserted > 0) {
            return redirect()->back()->with('success', 'File uploaded successfully');
        } else {
            return redirect()->back()->with('failed', 'File not uploaded');
        }
    }


    public function bulk_create_user(Request $req)
    { 
        if (!$req->hasFile('upload')) {
            return redirect()->back()->with('failed', 'No file uploaded');
        }
    
        $file = $req->file('upload');
    
        $allowedMimeTypes = [
            'text/csv',
            'application/csv',
            'text/plain',
            'application/vnd.ms-excel',
            // Add other allowed MIME types if needed
        ];
    
        if (!in_array($file->getClientMimeType(), $allowedMimeTypes)) {
            return redirect()->back()->with('failed', 'Invalid file type');
        }
    
        $csvFile = fopen($file->getPathname(), 'r');
        $rowCount = 0;
        $rowInserted = 0;
        $user_phones = [];
        $type_of_donor = [];
        $first_name = [];
        $last_name = [];
        $user_emails = [];
        $age = [];
        $gender=[];
        $pan = [];
        $aadhar = [];
        $pincode = [];
        $address=[];
        $company_name=[];
        $company_pan=[];
        $company_address=[];
        $line1=[];
        $line2=[];
        $comapny_pincode=[];

    
        while (($line = fgetcsv($csvFile)) !== false) {
            // Validation for malicious data
            foreach ($line as $data) {
                if (str_contains($data, 'script') || str_contains($data, 'SCRIPT')) {
                    session()->flush();
                    return redirect('login');
                }
            }
    
            if ($rowCount === 0) {
                // Skip the first row (header row)
                $rowCount++;
                continue;
            }
    
            if (count($line) !== 17) { 
                return redirect()->back()->with('failed', "No rows were uploaded due to invalid rows");
            }
            $user_phone = preg_replace('/[^0-9]/', '', $line[0]);
            $type_of_donor=preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$line[1]);
            $first_name=preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$line[2]);
            $last_name=preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$line[3]);
            $user_email = preg_replace('/[^a-zA-Z0-9\s@._-]/', '', $line[4]);
            $age=$line[5];
            $gender = $line[6];

            $pan_card=preg_replace('/[^a-zA-Z0-9]/', '',$line[7]);
            $aadhaar_card=preg_replace('/[^0-9]/', '',$line[8]);
            $pincode=$line[9];
            $address=$line[10];
            $company_name=preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$line[11]);
            $company_pan=$line[12];
            $company_address=$line[13];
            $line1=preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$line[14]);
            $line2=preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$line[15]);
            $company_pincode=preg_replace('/[^a-zA-Z0-9,.:;@#\\|*_\-()\? $&!\'₹\/\\\\]/', '',$line[16]);
           
          
            if (empty($type_of_donor) || !($type_of_donor == "Individual" || $type_of_donor == 1 || $type_of_donor == "Corporate" || $type_of_donor == 2)) {
                return redirect()->back()->with('failed', "Type Of Donor: 1. Individual and 2. Corporate at Line " . $rowCount);
            }
            
            if (empty($user_email)) {
                return redirect()->back()->with('failed', "Missing data at Line Email " . $rowCount);
            }
            if( empty($user_phone)){
                return redirect()->back()->with('failed', "Missing data at Line Phone " . $rowCount);

            }
            if( empty($type_of_donor)){
                return redirect()->back()->with('failed', "Missing data at Line Type of Doner " . $rowCount);

            }
            if( empty($first_name)){
                return redirect()->back()->with('failed', "Missing data at Line First Name " . $rowCount);

            }
            if( empty($last_name)){
                return redirect()->back()->with('failed', "Missing data at Line Last Name " . $rowCount);

            }
           
            // if (strlen(trim($pan_card)) < 10) {
              
            //     return redirect()->back()->with('failed', "Invalid Pan Card format at Line " . $rowCount);
            // }
        
            // If Phone Number length is less than 10, redirect
            if (strlen($user_phone) < 10) {
                return redirect()->back()->with('failed', "Invalid Phone Number format at Line " . $rowCount);
            }
          
            // if (strlen($aadhaar_card) < 12) {
            //     return redirect()->back()->with('failed', "Invalid Aadhar Number format at Line " . $rowCount);
            // }
    
            if (Profile::where('email', $user_email)->exists()) {
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Email ID'  at Line " . $rowCount);
            }
            if (Profile::where('pan',  $pan_card)->exists()) {
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Pan'  at Line " . $rowCount);
            }
            if (Profile::where('aadhaar',  $aadhaar_card)->exists()) {
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Aadhar'  at Line " . $rowCount);
            }
            if(Profile::where('phone', $user_phone)->exists()){
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Phone Numbar' at Line " . $rowCount);

            }
             $checkpincode= Pincode::where('pincode',$pincode)->first();
              
             $city = $checkpincode->city;
             $state =$checkpincode->state;

             if ($company_pincode != null) {
               
                $checkpincode = Pincode::where('pincode', $company_pincode)->first();
                if ($checkpincode != null) { 
                    $ccity = $checkpincode->city;
                    $cstate = $checkpincode->state;
                } else {  
                    $ccity = $cstate = null;
                }
            } else {
                $company_pincode = $ccity = $cstate = null;
            }
        
            $user = new Profile([
                'phone' =>  $line[0],
                'type'=>$type_of_donor == "Individual" || $type_of_donor == 1 ? "Individual" : "Corporate",
                'first_name' => $line[2], 
                'last_name' => $line[3],
                'email' => $user_email,
                'phone' => $user_phone,
                'gender'=>$line[6],
                'age'=>$line[5],
                'pan'=>$pan_card,
                'aadhaar'=>$aadhaar_card,
                '$pincode'=>$line[7],
                 'city'=> $city,
                 'state'=> $state,

                'address'=>$line[8],
                'company_name'=>$line[11],
                'company_pan'=>$line[12],
                'company_address'=>$line[13],
                'line1'=>$line[14],
                'line2'=>$line[15],
                'company_pincode'=>$line[16],
                'company_city'=> $ccity,
                'company_state'=> $cstate,
                // Add other fields as needed
            ]);
  
            if ($user->save()) {
                $rowInserted++;
               

            } else {
                return redirect()->back()->with('failed', 'Error saving data in row ' . $rowCount);
            }
    
            $rowCount++;
        }
    
        fclose($csvFile);
    
        if ($rowInserted > 0) {
            return redirect()->back()->with('success', 'File uploaded successfully');
        } else {
            return redirect()->back()->with('failed', 'File not uploaded');
        }
    }
    
    public function transactions_bulk_upload(){
        return view('/transactions_bulk_upload');
    }
    



    public function transactions_bulk_upload_data(Request $req)
    { 
        if (!$req->hasFile('upload')) {
            return redirect()->back()->with('failed', 'No file uploaded');
        }
    
        $file = $req->file('upload');
    
        $allowedMimeTypes = [
            'text/csv',
            'application/csv',
            'text/plain',
            'application/vnd.ms-excel',
            // Add other allowed MIME types if needed
        ];
    
        if (!in_array($file->getClientMimeType(), $allowedMimeTypes)) {
            return redirect()->back()->with('failed', 'Invalid file type');
        }
    
        $csvFile = fopen($file->getPathname(), 'r');
        $rowCount = 0;
        $rowInserted = 0;
    
        while (($line = fgetcsv($csvFile)) !== false) {
            
    
            if ($rowCount === 0) {
                $rowCount++;
                continue;
            }
    
            if (count($line) !== 12) {
                return redirect()->back()->with('failed', "No rows were uploaded due to invalid rows");
            }
    
            // Extract and validate data from each column
            $tran_evnet_id = $line[0];
            $tran_event_name = $line[1];
            $tran_phones = preg_replace('/[^0-9]/', '', $line[2]);
            $tran_category = $line[3];
            $tran_Multiples = $line[4];
            $tran_amount = $line[5];
            $tran_id = $line[6];
            $tran_status = $line[7];
            $tran_payment_mode = $line[8];
            $Cheque_details = $line[9];
            $Description = isset($line[10]) ? $line[10] : null;
            $seats =$line[11];
    
            // Validation for missing data
            if (empty($tran_evnet_id) || empty($tran_event_name) || empty($tran_phones) || empty($tran_id)) {
                return redirect()->back()->with('failed', "Missing data at Line " . $rowCount);
            }
            if (Event::where('event_name',  $tran_event_name)->exists()) {
            }else{
                return redirect()->back()->with('failed', "Due to 'Event Name  is not Persent" . $rowCount);

            }
            if (Event::where('id',  $tran_evnet_id)->exists()) {
            }else{
                return redirect()->back()->with('failed', "Due to 'Event ID  is not Persent" . $rowCount);

            }
            // Check for duplicate transaction_id 
            if (Transaction::where('transaction_id', $tran_id)->exists()) {
                return redirect()->back()->with('failed', "No rows were uploaded due to duplicate 'Transaction Number' at Line " . $rowCount);
            }
            if (Profile::where('phone', $tran_phones)->exists()) {
            }else{

                return redirect()->back()->with('failed', "Plese Create a Profile  Number is not Register" . $rowCount);

            }
                $event_value = Event::where('id', $tran_evnet_id)->first();

                // Assuming cat_name and cat_value are comma-separated strings
                $catNames = explode(',', $event_value->cat_name);
                $catValues = explode(',', $event_value->cat_value);

                // Combine catNames and catValues into an associative array
                $categories = array_combine($catValues, $catNames);

                $tran_category1 = null;

                // Check if $tran_category exists in the associative array
                if (isset($categories[$tran_category])) {
                    $tran_category1 = $categories[$tran_category];
                }

// $tran_category1 now contains the corresponding category name, or it's null if not found

// dd( $tran_category1);
            $apx=session('rexkod_admin_user_id');
            // Create a new Transaction instance and save to the database
            $user = new Transaction([
                'event_id' => (int)$tran_evnet_id,
                'event_name' => $tran_event_name,
                'phone_number' => $tran_phones,
                'category' => $tran_category1,
                'multiples' => $tran_Multiples,
                'amount' => $tran_amount,
                'transaction_id' => $tran_id,
                'transaction_status' => $tran_status,  
                'payment_mode' => $tran_payment_mode,
                'cheque_details' => $Cheque_details,
                'description' => $Description,
                'seats' => $seats,
                'arex_id' =>  $apx
            ]);
           
             $ftech = Profile::where('phone',$tran_phones)->first();
             $first_name=$ftech->first_name;
             $last_name=$ftech->last_name;
             $email=$ftech->email;

             $saveDonation = new Donation();
             $saveDonation ->first_name= $first_name;
             $saveDonation ->last_name= $last_name;
             $saveDonation ->email= $email;
             $saveDonation ->phone=$tran_phones;
             $saveDonation->multiples=$tran_Multiples;
             $saveDonation->amount =$tran_amount;
             $saveDonation->status =$tran_status;
             $saveDonation->transaction_id =$tran_id;
             $saveDonation->category =$tran_category;
             $saveDonation->event_id =(int)$tran_evnet_id;
             $saveDonation->seat_number=$seats;
           
           

            if ($user->save()) {
                $saveDonation->save();
                $rowInserted++;
               
            }
    
            $rowCount++;
        }
    
        fclose($csvFile);
    
        if ($rowInserted > 0) {
            return redirect()->back()->with('success', 'File uploaded successfully');
        } else {
            return redirect()->back()->with('failed', 'File not uploaded');
        }
    }
    
    

    public function delete_Volunteers($id){
        $delete = User::where('id', $id)->where('type', 'volunteer')->first();
    
        if ($delete) {
            $delete->delete();
            return redirect()->back()->with('success', 'Volunteers Delete successfully');
        } else {
            return redirect()->back()->with('error', '');

        }
    }



    public function edit_volunteers($id){
     $edit=User::where('id',$id)->get();
     $data=[
        'edit'=>$edit
     ];
      return view('/edit_volunteers',$data);
    }
    


    public function Update_volunteer(Request $req)
    {
        if (session()->get('rexkod_admin_user_id')) {
                $user =User::find($req->volunteers_id);
                $user->type = "volunteer";
                if (str_contains($req->name, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->name = $req->name;
                if (str_contains($req->email, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->email = $req->email;
                if (str_contains($req->phone, 'script')) {
                    session()->flush();
                    return redirect('login');
                }
                $user->phone = $req->phone;
                $user->apex = session()->get('rexkod_admin_user_id');
                $user->save();

                session()->put('success', 'Volunteer Updateded');
                return redirect('/volunteers');
            
        } else {
            return redirect('login');
        }
    }

    public function ActivateandDeatiaveUser($id, $status){
        $update = Profile::find($id);
       
        if ($update) {
            $update->status = $status;
          
            $update->save();
    
            session()->put('success', 'Status Updated');
        } else {
            session()->put('error', 'User not found');
        }
    
        return redirect('/profile_details');
    }
    
    public function DeleteApex($id){
       
        try {
            $user = User::findOrFail($id);
            $user->delete();
            
            session()->put('success', 'Apex Deleted');
        } catch (ModelNotFoundException $e) {
            session()->put('error', 'Apex not found');
        }
    
        return redirect('/all_apex');
    }
    
    public function ActivateandDeatiaveArex($id, $status){
        $update = User::find($id);
       
        if ($update) {
            $update->status = $status;
          
            $update->save();
    
            session()->put('success', 'Status Updated');
        } else {
            session()->put('error', 'Apex not found');
        }
    
        return redirect('/all_apex');
    }
    public function ActivateandDeatiaveVol($id, $status){
        $update = User::find($id);
       
        if ($update) {
            $update->status = $status;
          
            $update->save();
    
            session()->put('success', 'Status Updated');
        } else {
            session()->put('error', 'Volunteers not found');
        }
    
        return redirect('/volunteers');
    }


    public function checkPhone(Request $request)
    {
        $phone = $request->input('phone');

        $phoneExists = User::where('phone', $phone)->exists();

        return response()->json(['exists' => $phoneExists]);
    }

    public function check_Email(Request $request)
    {
        $email = $request->input('email');

        $userExists = User::where('email', $email)->exists();

        return response()->json(['exists' => $userExists]);
    }

    public function check_pan(Request $request)
    {
        $pan = $request->input('pan');
        $userExists= Profile::where('pan', $pan)
        ->orWhere('company_pan', $pan)
        ->exists();
    
        // $userExists = Profile::where('pan', $pan)->exists();

        return response()->json(['exists' => $userExists]);
    }
    public function check_aadhar(Request $request)
    {
        $aadhaar = $request->input('aadhaar');

        $aadhaar = Profile::where('aadhaar', $aadhaar)->exists();

        return response()->json(['exists' => $aadhaar]);
    }
    
    public function check_company_pan(Request $request)
    {
        $company_pan = $request->input('company_pan');
        $aadhaar= Profile::where('company_pan',  $company_pan)
        ->orWhere('pan',  $company_pan)
        ->exists();

        // $aadhaar = Profile::where('company_pan', $company_pan)->exists();

        return response()->json(['exists' => $aadhaar]);
    }
    
    public function checkProfileEmail(Request $request)
    {
        $email = $request->input('user_email');
    
        // Validate the email format
        $request->validate([
            'user_email' => 'required|email',
        ]);
    
        // Sanitize the input if needed
    
        $userExists = Profile::where('email', $email)->exists();
    
        return response()->json(['exists' => $userExists]);
    }
    
    
     //--------------max---------------check-company_pan
}
