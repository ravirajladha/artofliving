<?php

namespace App\Http\Controllers;

use App\Models\Batche;
use App\Models\Donation;
use App\Models\Events;
use App\Models\Profile;
use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Juspaycontroller extends Controller
{
    public function initiatePayment(Request $request)
    {
        
        $customerPhone = $request->input('mobile_number');
        $category = $request->input('type');
        $multiples = $request->input('multiples');
        $seat_number = $request->input('seat_number');
        $payment_mode = $request->input('payment_mode');
        $event_id = $request->input('event_id');
        $event_name = $request->input('event_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name_p');
        $gender = $request->input('gender_p');
        // $age = $request->input('age');
        $pan = $request->input('pan');
        $aadhaar = $request->input('aadhaar');
        $Description = $request->input('first_name');
        $user_id=$request->input('user_id');
        $amount = $request->input('amount');
        $customerEmail = $request->input('email');
        
        $description =  $Description;
        $orderId = 'sanidhya_' . uniqid();
        $customerId = 'customer_' . uniqid();
        $productId = 'product_' . uniqid();
        $url = 'https://api.juspay.in/session';
        $apiKey = 'E18E82FCAFF4A81882EB590322925D';
        $merchantId = 'artofliving';

        $jsonPayload = [
            "metadata.JUSPAY:gateway_reference_id" => 'Donation PG',
            "order_id" => $orderId,
            "amount" => $amount,
            "customer_id" => $customerId,
            "customer_email" => $customerEmail,
            "customer_phone" => $customerPhone,
            "product_id" => $productId,
            "payment_page_client_id" => "artofliving",
            "action" => "paymentPage",
            "return_url" => "http://127.0.0.1:8000/order/",
            "description" => $description,
            "first_name" => $first_name,
            "last_name" => $last_name, 
            "udf1"=>   $category,
            "udf2"=>  $multiples,
            "udf3"=>  $seat_number,
            "udf4"=> $payment_mode,
            "udf5"=> $event_id,
            "udf6"=>  $gender,
            "udf7"=> $event_name,
            "udf8"=> $first_name,
            "udf9"=>  $last_name, 
            "udf10"=> $user_id,
        ];
 
        $headers = [
            'Authorization' => 'Basic ' . base64_encode($apiKey),
            'x-merchantid' => $merchantId,
            'Content-Type' => 'application/json',
        ];

        
        try {
            $client = new Client();
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $jsonPayload,
            ]);
            $responseData = $response->getBody()->getContents();
            session(['payment_completed' => false]);
            return redirect(json_decode($responseData, true)['payment_links']['web']);
        } catch (\Exception $e) {

            // return redirect()->route('profile_donations', $request->all());
        }
    }

    public function check_phone_details($phone)
    {
        $result = Profile::where('phone', $phone)->first();
        echo $result->type . "," . $result->first_name . "," . $result->last_name . "," . $result->email . "," . $result->age . "," . $result->gender . "," . $result->pan . "," . $result->aadhaar.",".$result->pincode.",".$result->city.",".$result->state.",".$result->address;
        session()->put('success', 'Data Fetching Successfully  ');

    }

    function create_new_donagtions($id)
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
        $categoryValues = []; // Initialize the variable
        foreach ($category_list as $index => $category) {
            $categoryValues[$category] = $value_list[$index];
        }

        $data = [
            'event_id' => $event_id,
            'donation_details' => null,
            'category_list' => $category_list,
            'category_values' => $categoryValues, // Make sure the variable is assigned
            'event_name' => $event_name,
        ];

        return view('add_new_doner', ['data' => $data]);
    }

    public function create_new_donagtion(Request $req)
    {
        $event_id = $req->event_id;
        $event = Events::where('id', $event_id)->first();

        if ($event) {
            $event = $event->toArray();
            $event_name = $event['event_name'];
        } else {
        }
        //  $donationType = Session::get('donation_type');

        $batch = new Batche();
        $batch->event_id = $req->event_id;
        $batch->total = '1';
        $batch->save();

        $batch_id = $batch->id;
        $donation = new Donation();
        $donation->multiples = $req->multiples;
        $donation->amount = $req->amount;
        $donation->phone = $req->phone_number;
        $donation->type = $req->type_donation;
        $donation->email = $req->doner_email;
        $donation->first_name = $req->doner_name;
        $donation->last_name = $req->doner_last;
        $donation->gender = $req->doner_gender;
        $donation->age = $req->doner_age;
        $donation->pan = $req->doner_pan;
        $donation->aadhaar = $req->doner_aadhaar;
        $donation->address = $req->doner_address;
        $donation->pincode = $req->doner_pincode;
        $donation->city = $req->doner_city;
        $donation->state = $req->doner_state;
        $donation->company_name = $req->doner_company_name;
        $donation->company_pan = $req->doner_company_pan;
        $donation->company_address = $req->doner_company_address;
        $donation->company_pincode = $req->pincode;
        $donation->company_city = $req->city;
        $donation->company_state = $req->state;
        $donation->seat_number = $req->seat_number;
        $donation->category = $req->category;
        $donation->event_id = $req->evnet_id;
        $donation->address = $req->doner_company_address;
        $donation->add_line1 = $req->doner_line1;
        $donation->add_line2 = $req->doner_line2;
        $donation->batch = $batch_id;
        $donation->save();
        $profiles = new Profile();
        $profiles->multiples = $req->multiples;
        $profiles->amount = $req->amount;
        $profiles->phone = $req->phone_number;
        $profiles->type = $req->type_donation;
        $profiles->email = $req->doner_email;
        $profiles->first_name = $req->doner_name;
        $profiles->last_name = $req->doner_last;
        $profiles->gender = $req->doner_gender;
        $profiles->age = $req->doner_age;
        $profiles->pan = $req->doner_pan;
        $profiles->aadhaar = $req->doner_aadhaar;
        $profiles->address = $req->doner_address;
        $profiles->pincode = $req->doner_pincode;
        $profiles->city = $req->doner_city;
        $profiles->state = $req->doner_state;
        $profiles->company_name = $req->doner_company_name;
        $profiles->company_pan = $req->doner_company_pan;
        $profiles->company_address = $req->doner_company_address;
        $profiles->company_pincode = $req->pincode;
        $profiles->company_city = $req->city;
        $profiles->company_state = $req->state;
        $profiles->seat_number = $req->seat_number;
        $profiles->category = $req->category;
        $profiles->event_id = $req->evnet_id;
        $profiles->address = $req->doner_company_address;
        $profiles->add_line1 = $req->doner_line1;
        $profiles->add_line2 = $req->doner_line2;
        $profiles->aprex_id = $req->apex_id;
        $profiles->batch = $batch_id;
        //    dd($profiles);
        $profiles->save();
        session()->put('success', 'Donation Added Successfully ');

        return redirect('/all_doner_details')->with('success', 'Doner created successfully.');
    }

    public function process_online_donation(Request $request, $event_id)
    {
     
        $category = $request->input('category');
        $multiples = $request->input('multiples');
        $seat_number = $request->input('seat_number');
        $payment_mode = $request->input('payment_mode');
        $event_id = $request->input('event_id');
        $event_name = $request->input('event_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $gender = $request->input('gender');
        // $age = $request->input('age');
        $pan = $request->input('pan');
        $aadhaar = $request->input('aadhaar');
        $Description = $request->input('description');
        $user_id=$request->input('user_id');
        $amount = $request->input('amount');
        $customerEmail = $request->input('email');
        $customerPhone = $request->input('phone_number');
        $description =  $Description;
        $orderId = 'sanidhya_' . uniqid();
        $customerId = 'customer_' . uniqid();
        $productId = 'product_' . uniqid();
        $url = 'https://api.juspay.in/session';
        $apiKey = 'E18E82FCAFF4A81882EB590322925D';
        $merchantId = 'artofliving';

        $jsonPayload = [
            "metadata.JUSPAY:gateway_reference_id" => 'Donation PG',
            "order_id" => $orderId,
            "amount" => $amount,
            "customer_id" => $customerId,
            "customer_email" => $customerEmail,
            "customer_phone" => $customerPhone,
            "product_id" => $productId,
            "payment_page_client_id" => "artofliving",
            "action" => "paymentPage",
            "return_url" => "http://127.0.0.1:8000/order/",
            "description" => $description,
            "first_name"=>  $first_name,
            "last_name"=> $last_name,
            "udf1"=>   $category,
            "udf2"=>  $multiples,
            "udf3"=>  $seat_number,
            "udf4"=> $payment_mode,
            "udf5"=> $event_id,
            "udf6"=> $gender,
            "udf7"=> $event_name,
            "udf8"=>   $first_name,
            "udf9"=> $last_name,
            "udf10"=> $user_id,
        ];
 
        $headers = [
            'Authorization' => 'Basic ' . base64_encode($apiKey),
            'x-merchantid' => $merchantId,
            'Content-Type' => 'application/json',
        ];

        try {
            $client = new Client();
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $jsonPayload,
            ]);
            $responseData = $response->getBody()->getContents();
            return redirect(json_decode($responseData, true)['payment_links']['web']);
        } catch (\Exception $e) {

            return redirect()->route('aprex_transaction', $request->all());
        }
    }

    public function all_doner()
    {
        $data = Profile::all();
        $data = [
            'data' => $data
        ];
        dd($data);
        return view('doner_details', $data);
    }


    public function create_admin_doner(Request $req)
      
    { 

       
        $phone = $req->input('phone');
        $pan = $req->input('pan');
        $aadhaar = $req->input('aadhaar');
        $email = $req->input('email');

        $checknumber = Profile::where('phone', $phone)->first();
        $pan = Profile::where('pan',  $pan)->first();
        $aadhaar = Profile::where('aadhaar',  $aadhaar)->first();
        $email = Profile::where('email',  $aadhaar)->first();




        if ($checknumber) {
            session()->put('error', 'User Already Present');
            return redirect('profile_details');
        }else if($pan){
            session()->put('error', 'Pan card allready persent');
            return redirect('profile_details');
        }else if($aadhaar){
            session()->put('error', 'Addhar card allready persent');
            return redirect('profile_details');
        }else if( $email){
            session()->put('error', 'Email allready persent');
            return redirect('profile_details');
        }
       
        $donation = new Profile();
        $donation->phone = $req->phone;
        $donation->type = $req->type;
        $donation->first_name = $req->first_name;
        $donation->last_name = $req->last_name;
        $donation->email = $req->email;
        $donation->age = $req->age;
        $donation->gender = $req->gender;
        $donation->pan = $req->pan;
        $donation->aadhaar = $req->aadhaar;
        $donation->pincode = $req->pincode;
        $donation->city = $req->city;
        $donation->state = $req->state;
        $donation->address = $req->address;
        $donation->company_name = $req->company_name;
        $donation->company_pan = $req->company_pan;
        $donation->company_address = $req->company_address;
        $donation->add_line1 = $req->add_line1;
        $donation->add_line2 = $req->add_line2;
        $donation->company_pincode = $req->company_pincode;
        $donation->company_city = $req->company_city;
        $donation->company_state = $req->company_stk;
        $donation->aprex_id = $req->aprex_id;
     
        $donation->save();
        session()->put('success', 'Donor profile Added Successfully  ');

        return redirect('profile_details')->with('success', 'Donor profile Added Successfully  ');
    }

    
    public function showOrderForm()
    {
        return view('order');
    }

    public function fetchOrderData(Request $request)
    {
        // Validate the order ID input
        $request->validate([
            'order_id' => 'required',
        ]);

        // Get the order ID from the form input
        $orderId = $request->input('order_id');
        $apiKey = 'E18E82FCAFF4A81882EB590322925D';

        // Define your API endpoint and headers (same as before)
        $apiUrl = 'https://api.juspay.in/orders/'.$orderId;
        $headers = [
            'x-merchantid' => 'artofliving',
            'version' => now()->format('Y-m-d'),
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode($apiKey),

        ];

        // Make the API request
        $response = Http::withHeaders($headers)->get($apiUrl);
        // Check if the request was successful
        if ($response->successful()) {
            // Parse and return the response data on the same page
            $responseData = $response->json();
            return view('order', ['orderData' => $responseData]);
        } else {
            // Handle the error and pass it to the view
            $error = 'Failed to fetch order data';
            return view('/order', compact('error'));
        }
    }
    public function savePayment(Request $req)
    {
        $transac = $req->input('order_id');
        $paymentAlreadyDone = false;
        DB::transaction(function () use ($transac, $req) {
            // Check if the payment with the same transaction_id already exists
            $checkPayment = Transaction::where('transaction_id', $transac)->first();  
            if ($checkPayment) {
                $paymentAlreadyDone = true;
            }else{
            
       
    
        // Create a new Transaction instance and populate its attributes
        $tran = new Transaction();
        $tran->transaction_id = $req->order_id;
        $tran->amount = $req->amount;
        $tran->transaction_status = $req->transaction_status;
        $tran->phone_number = $req->phone;
        $tran->payment_mode = $req->payment_method_type;
        $tran->date_created = $req->date_created;
        $tran->category = $req->category;
        $tran->multiples = $req->multiples;
        $tran->payment_mode = $req->payment_mode;
        $tran->event_id = $req->event_id;
        $tran->event_name = $req->event_name;
        $tran->arex_id = session()->get('rexkod_admin_user_id');
        $tran->save();

        

        // Find a transaction based on the phone number
     $checkPayment = Transaction::where('transaction_id', $transac)->first();      
        if ($checkPayment) {
            // Debugging: Inspect the $checkPayment object
            // dd($checkPayment);
    
            if ($checkPayment->transaction_status === "CHARGED") {
                // Create a new Donation object and populate its attributes
                $donation = new Donation();
                $donation->transaction_id = $req->order_id;
                $donation->email = $req->email;
                $donation->amount = $req->amount;
                $donation->phone = $req->phone;
                $donation->status = $req->status;
                $donation->category = $req->category;
                $donation->multiples = $req->multiples;
                $donation->seat_number = $req->seat_number;
                $donation->event_id = $req->event_id;
                $donation->gender = $req->gender;
                $donation->pan = $req->pan;
                $donation->aadhaar = $req->aadhaar;
                $donation->first_name = $req->first_name;
                $donation->last_name = $req->last_name;
    
                $donation->save();
            }
        }
    }
    });
    if ($paymentAlreadyDone) {
        return redirect('/order/fetch')->with('error', 'Payment already done');
    }
        return redirect('/order');
    }
    

    public function fetch_profile_date($id){
        $prfile = Profile::where('id', $id)->first();      
        if (session()->get('rexkod_admin_user_id')) {
            $data=[
              'profile'=>$prfile
            ];
            return view('/edit_profile_details', ['data' => $data]);

        }
    }

    
    public function edit_profile_details(Request $request) {
        // Validation rules - customize as needed
       
        $rules = [
            'phone' => 'required|string|max:10',
            'type' => 'required|in:Individual,Corporate',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'age' => 'nullable|integer',
            'gender' => 'nullable|in:Male,Female',
            'pan' => 'nullable|string|max:255',
            'aadhaar' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:6',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_pan' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'add_line1' => 'nullable|string|max:255',
            'add_line2' => 'nullable|string|max:255',
            'company_pincode' => 'nullable|string|max:6',
            'company_city' => 'nullable|string|max:255',
            'company_state' => 'nullable|string|max:255',
        ];
        
        $validatedData = $request->validate($rules);
    
        $profile = Profile::find($request->input('id'));
 
      
        $profile->update($validatedData);
        session()->put('success', 'User Profile Update Successfully ');
        return redirect('profile_details')->with('success','User Profile Update Successfully');
    }

    public function deleteProfile($id) {
       
        $profile = Profile::find($id);
  
        $profile->delete();
    
        session()->put('success', 'Profile Deleted ');
        return redirect('profile_details');
    }


    
    public function checkData(Request $request)
{
    $email = $request->input('email');
    $pan = $request->input('pan');
    $aadhar = $request->input('aadhaar');
    
    // Check if email exists
    $emailExists = Profile::where('email', $email)->exists();
    
    // Check if PAN exists
    $panExists = Profile::where('pan_number', $pan)->exists();
    
    // Check if Aadhar exists
    $aadharExists = Profile::where('aadhar_number', $aadhar)->exists();
    
    // Determine if any data exists
    $dataExists = $emailExists || $panExists || $aadharExists;
    
    return response()->json(['exists' => $dataExists]);
}

public function profileView($id){
    $prfile = Profile::where('id', $id)->first();      
    if (session()->get('rexkod_admin_user_id')) {
        $data=[
          'profile'=>$prfile
        ];
        return view('/profileview', ['data' => $data]);

    }
}

}
