<?php

use App\Http\Controllers\Juspaycontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sanidhya;
//create by mk//
//payment part
Route::post('/makePayment', [Juspaycontroller::class, 'initiatePayment']);
Route::view("paymentsfail", "paymentsfail"); // demo
Route::get('/paymentsfail', [Juspaycontroller::class, 'paymentFail'])->name('payment.fail'); // demo
Route::view('/profiledetails', 'profiledetails');
Route::get('/profiledetails', [Sanidhya::class, 'fetchprofiledata']);
Route::post('/userpayment', [Sanidhya::class, 'show_evnet']);
Route::view('/userpayment', 'userpayment');
Route::view('/aprex_transaction', '/aprex_transaction');
Route::view('/add_new_doner', '/add_new_doner');
Route::view('all_doner_details', 'all_doner_details');
Route::get('/check_phone_details/{phone}/', [Juspaycontroller::class, 'check_phone_details']);
Route::get('/aprex_transaction', [Sanidhya::class, 'aprex_alltransactions']);
//--------------------------------------------------------------------------------
Route::get('/order', [Juspaycontroller::class, 'showOrderForm'])->name('order-form');
Route::post('/order/fetch', [Juspaycontroller::class, 'fetchOrderData'])->name('fetch-order');
Route::post('/order/save', [Juspaycontroller::class, 'savePayment'])->name('save-payment');

Route::post('/fetchOrderData', [Juspaycontroller::class, 'fetchOrderData'])->name('fetchOrderData');
// Route::get('/userpayment', [Juspaycontroller::class, 'showallevent']);
// Route::post('/save-payment-data', [Juspaycontroller::class, 'savepaymentData'])->name('save-payment-data');
Route::match(['get', 'post'], '/save-payment-data', [Juspaycontroller::class, 'savepaymentData'])->name('save-payment-data');
Route::get('/create_new_donagtions/{id}', [Juspaycontroller::class, 'create_new_donagtions']);
Route::post('/create_new_donagtion', [Juspaycontroller::class, 'create_new_donagtion']);
Route::get('/add_new_d/{event_id}', [Juspaycontroller::class, 'add_new_d']);
// Route::get('/onlinepayment', function () {
//     return view('onlinepayment');
// });
Route::get('/create_online_donation/{event_id}', [Juspaycontroller::class, 'create_online_donation']);
Route::post('/create_online_donation/{event_id}', [Juspaycontroller::class, 'process_online_donation']);
// all doner
Route::view('/doner_details', '/doner_details');
// Route::get('/all_doner', [Juspaycontroller::class, 'all_doner']);
Route::get('/all_doner', [Juspaycontroller::class, 'all_doner'])->name('all_doner');
Route::view('add_doners', '/add_doners');
Route::post('create_admin_doner', [Juspaycontroller::class, 'create_admin_doner'])->name('all_create_admin_donerdoner');
Route::view('profile_details','profile_details');
Route::get('fetch_profile_date/{id}',[Juspaycontroller::class,'fetch_profile_date'])->name('fetch_profile_date');
Route::post('edit_profile_details',[Juspaycontroller::class,'edit_profile_details'])->name('edit_profile_details');
Route::get('deleteProfile/{id}',[Juspaycontroller::class,'deleteProfile']);
Route::post('/check-data', [Juspaycontroller::class,'checkData'])->name('check-data');
Route::get('profileView/{id}',[Juspaycontroller::class,'profileView']);

// Route::get('/eventcheckout/{id}', [Juspaycontroller::class, 'fetchIdCheckOutPage']);
//create by mk//

//pages not protected by middleware
Route::get("/login", [Sanidhya::class, "login"]);
Route::post('/user_login', [Sanidhya::class, 'user_login']);
Route::get('/sms_otp/{phone}/{pin}', [Sanidhya::class, 'sms_otp']);
Route::view('/vb5', 'vb5');
Route::get("/test", [Sanidhya::class, "test"]);

Route::view("/register", 'register');
Route::post("/profile_register", [Sanidhya::class, "profile_register"]);
Route::get("/profile_checkphone", [Sanidhya::class, "profile_checkphone"]);
Route::view("/add_profile", "add_profile");

Route::get("/profilelogin", [Sanidhya::class, "profilelogin"]);
Route::post('/profile_login', [Sanidhya::class, 'profile_login']);
Route::get("/profilelogout", [Sanidhya::class, "profilelogout"]);
Route::get('/profile_sms_otp/{phone}/{pin}', [Sanidhya::class, 'profile_sms_otp']);
Route::get("/profile", [Sanidhya::class, 'profile']);
Route::get("/profile_passes", [Sanidhya::class, 'profile_passes']);
Route::get("/profile_donations", [Sanidhya::class, 'profile_donations']);
Route::get('/check-user-email', [Sanidhya::class, 'checkProfileEmail'])->name('check.user.email');


Route::view('/profiletransaction','/profiletransaction');



Route::get("/event_page/{eventid?}", [Sanidhya::class, "event_page"]);
Route::get("/eventcheckout/{eventid?}", [Sanidhya::class, "eventcheckout"]);
Route::get('/profile_load_details', [Sanidhya::class, 'profile_load_details']);
Route::get('/corporate_load_details', [Sanidhya::class, 'corporate_load_details']);
// Route::post('/makePayment', [Sanidhya::class, 'makePayment']);
Route::get('/off_payment/{event_id}', [Sanidhya::class, 'off_payment']);
Route::post('/off_transaction/{event_id}', [Sanidhya::class, 'off_transaction']);
Route::get('/checkPhoneNumber', [Sanidhya::class, 'checkPhoneNumber']);
Route::get('/transactionDetails/{event_id}', [Sanidhya::class, 'transactionDetails']);
Route::get('/alltransactions', [Sanidhya::class, 'alltransactions']);
Route::get('/pincode/{pin}', [Sanidhya::class, 'pincode']);
Route::post('/create_profile', [Sanidhya::class, 'create_profile']);

Route::group(['middleware' => ['protectedPage']], function () {
    //pages protected by middleware

    Route::post('paytm-payment', [Sanidhya::class, 'paytmPayment'])->name('paytm.payment');
    Route::post('paytm-callback', [Sanidhya::class, 'paytmCallback'])->name('paytm.callback');
    Route::get('paytm-purchase', [Sanidhya::class, 'paytmPurchase'])->name('paytm.purchase');

    Route::view('paytm-success-page', 'paytm-success-page');
    Route::view('paytm-fail', 'paytm-fail');

    Route::get("/", [Sanidhya::class, "login"]);
    Route::get("logout", [Sanidhya::class, "logout"]);
    Route::get("/evs", [Sanidhya::class, "login"]);
    Route::get("/qrs", [Sanidhya::class, "login"]);
    Route::get("/index", [Sanidhya::class, "index"]);
    Route::get("/apex", [Sanidhya::class, "apex"]);
    Route::get("/user", [Sanidhya::class, "user_login"]);

    Route::get('/add_property_audit/{location_id}', [Sanidhya::class, 'add_property_audit']);
    Route::view('/asset_audits', '/asset_audits');

    Route::get('/asset/{id}', [Sanidhya::class, 'asset']);
    Route::get('/add_event', [Sanidhya::class, 'add_event']);
    Route::post('/add_event', [Sanidhya::class, 'create_event']);

    Route::view('/add_proposal', '/add_proposal');
    Route::post('/add_proposal', [Sanidhya::class, 'create_proposal']);

    Route::post('/create_volunteer', [Sanidhya::class, 'create_volunteer']);
    Route::get('/donation', [Sanidhya::class, 'donation']);

    Route::get("/add_volunteer", [Sanidhya::class, "add_volunteer"]);
    Route::get("/test_mail", [Sanidhya::class, "test_mail"]);

    Route::get("/all_events", [Sanidhya::class, "all_events"]);
    Route::get("/events", [Sanidhya::class, "events"]);
    Route::get("/all_proposals", [Sanidhya::class, "all_proposals"]);
    Route::get("/all_passes", [Sanidhya::class, "all_passes"]);
    Route::get("/create_pass", [Sanidhya::class, "create_pass"]);
    Route::get("/proposal/{id}", [Sanidhya::class, "proposal"]);
    Route::get("/volunteers", [Sanidhya::class, "volunteers"]);
    Route::get("/all_donations", [Sanidhya::class, "all_donations"]);

    // Route::get("/checkout/{{eventid}}", [Sanidhya::class, "checkout"]);

    Route::get("/scan", [Sanidhya::class, "scan"]);
    Route::get("/scanned", [Sanidhya::class, "scanned"]);
    Route::get("/whatsapp_pass", [Sanidhya::class, "whatsapp_pass"]);
    Route::get("/my_pass", [Sanidhya::class, "my_pass"]);

    // Route::get("/event_page/{event_name}", [Sanidhya::class, "event_page"]);

    Route::view('/thankyou', 'thankyou');
    Route::get("/whatsapp_pass", [Sanidhya::class, "whatsapp_pass"]);
    // pass Genrate 
    // Route::post("/create_passes/{id}", [Sanidhya::class, "create_passes"]);
    // Route::get("/create_passes/{id}", [Sanidhya::class, "create_passes"]);
    Route::match(['get', 'post'], "/create_passes/{id}", [Sanidhya::class, "create_passes"]);


    Route::get("/send_passes/{id}", [Sanidhya::class, "send_passes"]);
    Route::get("/send_pass/{id}", [Sanidhya::class, "send_passes"]);
    Route::get("/sms_passes/{id}", [Sanidhya::class, "sms_passes"]);
    Route::get("/mail_passes/{id}", [Sanidhya::class, "mail_passes"]);
 // pass Genrate 
    Route::get("/reports", [Sanidhya::class, "reports"]);
    Route::post('/results', [Sanidhya::class, 'results']);
    Route::post('/update_donation/{id}', [Sanidhya::class, 'update_donation']);
    Route::post('/update_event', [Sanidhya::class, 'update_event']);
    Route::post('/send_passes_selected', [Sanidhya::class, 'send_passes_selected']);

    Route::view('/venue', 'venue');
    Route::view('/vb3', 'vb3');
    Route::view('/pdf', 'pdf');
    Route::view('/samagra', 'samagra');
    Route::post('/upload_file', [Sanidhya::class, 'upload_file']);
    Route::post('/verify_pass', [Sanidhya::class, 'verify_pass']);

    Route::get('/scan_pass/{val}', [Sanidhya::class, 'scan_pass']);
    Route::get('/upload', [Sanidhya::class, 'upload']);
    Route::get('/verify/{id}', [Sanidhya::class, 'verify']);
    Route::get('/event_summary/{id}', [Sanidhya::class, 'event_summary']);
    Route::get('/event_report/{id}', [Sanidhya::class, 'event_report']);
    Route::get('/verified/{id}', [Sanidhya::class, 'verified']);
    Route::get('/passes/{id}', [Sanidhya::class, 'passes']);
    Route::get('/donations/{id}', [Sanidhya::class, 'donations']);
    Route::get('/recheckin/{id}', [Sanidhya::class, 'recheckin']);
    Route::get('/renew_passes/{id}', [Sanidhya::class, 'renew_passes']);
    Route::get('/checkout/{id}', [Sanidhya::class, 'checkout']);
    Route::get('/edit_apex/{id}', [Sanidhya::class, 'edit_apex']);
    Route::post('/update_apex', [Sanidhya::class, 'update_apex']);
    Route::get('/add_donation/{id}', [Sanidhya::class, 'add_donation']);
    Route::get('/new_donation/{id}/{type}', [Sanidhya::class, 'new_donation']);
    Route::get('/donation/{id}/{phone}/{type}', [Sanidhya::class, 'old_donation']);
    Route::get('/check_profile', function () {
        return view('check_profile');
    });

    Route::post('/check_phone', [Sanidhya::class, 'check_phone']);
    Route::get('/batches/{id}', [Sanidhya::class, 'batches']);
    Route::get('/edit_donation/{id}', [Sanidhya::class, 'edit_donation']);
    Route::get('/edit_event/{id}', [Sanidhya::class, 'edit_event']);
    Route::get('/delete_donation/{id}', [Sanidhya::class, 'delete_donation']);
    Route::get('/block_donation/{id}', [Sanidhya::class, 'block_donation']);
    Route::get('/event/{id}', [Sanidhya::class, 'event']);
    Route::get('/delete_batch/{id}/{remark}', [Sanidhya::class, 'delete_batch']);
    Route::get('/add_apex', [Sanidhya::class, 'add_apex']);
    Route::get('/all_apex', [Sanidhya::class, 'all_apex']);
    Route::view('/volunteer', 'volunteer');
    Route::get('/pay', [Sanidhya::class, 'pay']);
    Route::post('/volunteer_login', [Sanidhya::class, 'volunteer_login']);
    Route::post('/create_apex', [Sanidhya::class, 'create_apex']);
    Route::post('/create_donation', [Sanidhya::class, 'create_donation']);

    Route::view('user_bulk_upload','user_bulk_upload');

    Route::get('add_aprex_bulk_upload',[Sanidhya::class,'add_aprex_bulk_upload']);
    Route::post('/bulk_upload_aprex',[Sanidhya::class,'bulk_upload_aprex']);
    Route::view('/add_volunteer_bulk_upload','/add_volunteer_bulk_upload');
    Route::post('/bulk_create_volunteer',[Sanidhya::class,'bulk_create_volunteer']);
    Route::post('/bulk_create_user',[Sanidhya::class,'bulk_create_user']);
    Route::get('/transactions_bulk_upload',[Sanidhya::class,'transactions_bulk_upload']);
    Route::post('/transactions_bulk_upload_data',[Sanidhya::class,'transactions_bulk_upload_data']);
    Route::get('/delete_Volunteers/{id}',[Sanidhya::class,'delete_Volunteers']);
    Route::get('/edit_volunteers/{id}',[Sanidhya::class,'edit_volunteers']);
    Route::post('/Update_volunteer',[Sanidhya::class,'Update_volunteer']);
    Route::get('/ActivateandDeatiaveUser/{id}/{status}', [Sanidhya::class, 'ActivateandDeatiaveUser']);
    Route::get('/DeleteApex/{id}', [Sanidhya::class, 'DeleteApex']);
    Route::get('/ActivateandDeatiaveArex/{id}/{status}',[Sanidhya::class,'ActivateandDeatiaveArex']);
    Route::get('/ActivateandDeatiaveVol/{id}/{status}',[Sanidhya::class,'ActivateandDeatiaveVol']);
    Route::get('/check-email', [Sanidhya::class,'check_email']);
    Route::get('/check-phone', [Sanidhya::class,'checkPhone']);
    Route::get('/check-pan',[Sanidhya::class,'check_pan']);
    Route::get('/check-aadhar',[Sanidhya::class,'check_aadhar']);
    Route::get('/check-cpan',[Sanidhya::class,'check_company_pan']);

    Route::get('/check-user-pan', [Sanidhya::class, 'check_pan'])->name('check.user.pan');


    


});
