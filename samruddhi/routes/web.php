<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Samruddhi;
use Illuminate\Support\Facades\Session;



/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/sms_otp/{phone}/{pin}',[Samruddhi::class,'sms_otp']); 

Route::get('/', function () {
    return view('login');
});
Route::get("/login",[Samruddhi::class,"login"]);

Route::post('/login',[Samruddhi::class,'user_login']);

Route::view('/register','register');
Route::post('/register',[Samruddhi::class,'user_register']);

Route::get('/logout', function () {
    // Session::forget('key');
    Session::flush();
    return redirect('/');

});



Route::get('/second-options', 'Samruddhi@secondOptions');

//======================================================

Route::group(['middleware' => ['protectedPage']], function(){


Route::view('/temp','temp');
Route::post("/add_file",[Samruddhi::class,"add_file"]);
Route::view('/index','index');
Route::get('/add_user',[Samruddhi::class,'add_user']);
Route::get("/index",[Samruddhi::class,"index"]);
Route::get("/subcategory/{id}",[Samruddhi::class,"subcategory"]);

Route::get('/add_asset_select',[Samruddhi::class,'add_asset_select']);
//Route::post('/add_asset_select',[Samruddhi::class,'create_asset_select']);


Route::view('/access_denied','access_denied');


Route::get('/add_asset_audit/{location_id}',[Samruddhi::class,'add_asset_audit']);
Route::post('/add_asset_audit',[Samruddhi::class,'create_asset_audit']);

Route::get('/add_asset/{type}/{location_id}',[Samruddhi::class,'add_asset']);
Route::post('/add_asset',[Samruddhi::class,'create_asset']);
Route::post('/update_asset/{asset_id}',[Samruddhi::class,'update_asset']);



Route::view('/add_audit','add_audit');
Route::view('/unassigned_asset','unassigned_asset');

Route::view('/add_property','add_property');
Route::post('/add_property',[Samruddhi::class,'create_property']);


Route::view('/add_location','add_location');
Route::post('/add_location',[Samruddhi::class,'create_location']);



Route::get('/add_property_audit/{location_id}',[Samruddhi::class,'add_property_audit']);
Route::post('/add_property_audit',[Samruddhi::class,'create_property_audit']);
 

Route::view('/add_property','add_property');

Route::post('/add_user',[Samruddhi::class,'create_user']);


Route::get('/asset_audits',[Samruddhi::class,'asset_audits']);
Route::get('/property_audits',[Samruddhi::class,'property_audits']);



Route::get('/asset/{id}',[Samruddhi::class,'asset']);


Route::get('/all_assets',[Samruddhi::class,'all_assets']); //not found on server


Route::view('/auditor_audits','auditor_audits');
Route::view('/audits','audits');
Route::get('/category',[Samruddhi::class,'category']);

Route::get('/compliances',[Samruddhi::class,'compliances']);
Route::post('/compliances',[Samruddhi::class,'create_compliance']);


Route::view('/datasets','datasets');

Route::get('/documents',[Samruddhi::class,'documents']);

                                Route::view('/download_qr','download_qr'); //site cant be reached
Route::get('/edit_asset/{type}/{id}',[Samruddhi::class,'edit_asset']);


Route::post('/edit_user',[Samruddhi::class,'update_user']);

Route::get('/edit_user/{id}',[Samruddhi::class,'edit_user']);
Route::get('/incident_response/{id}',[Samruddhi::class,'incident_response']);
Route::get('/edit_property/{id}',[Samruddhi::class,'edit_property']);
Route::post('/edit_property',[Samruddhi::class,'update_property']);
Route::get('/edit_location/{id}',[Samruddhi::class,'edit_location']);
Route::post('/edit_location',[Samruddhi::class,'update_location']);

Route::get('/incidents',[Samruddhi::class,'incidents']);
Route::get('/locations',[Samruddhi::class,'locations']);
Route::get('/notifications',[Samruddhi::class,'notifications']);

Route::get('/incident/{id}',[Samruddhi::class,'incident']);


Route::get('/location/{id}',[Samruddhi::class,'location']);
Route::get('/pending_asset_audits/{id}',[Samruddhi::class,'pending_asset_audits']);
Route::get('/pending_property_audits/{id}',[Samruddhi::class,'pending_property_audits']);
Route::get('/processing_asset_audits/{id}',[Samruddhi::class,'processing_asset_audits']);

Route::view('/pending_audits','pending_audits');
Route::view('/processing_audits','processing_audits');
Route::view('/processing_property_audits','processing_property_audits');
Route::get('/properties',[Samruddhi::class,'properties']);


Route::get('/property/{id}',[Samruddhi::class,'property']);
Route::view('/qr','qr');


Route::get('/report_assets/{id}',[Samruddhi::class,'report_assets']); 

Route::get('/report_audits/{id}',[Samruddhi::class,'report_audits']);
Route::get('/report_incidents/{id}',[Samruddhi::class,'report_incidents']);
Route::get('/report_tickets/{id}',[Samruddhi::class,'report_tickets']);

Route::get('/report_transfers/{id}',[Samruddhi::class,'report_transfers']);





Route::view('/report','report');
Route::get('/reports',[Samruddhi::class,'reports']);
Route::post('/reports_search',[Samruddhi::class,'reports_search']);


Route::view('/result','result');
Route::post('/results',[Samruddhi::class,'results']);

Route::view('/search','search');
Route::get('/settings',[Samruddhi::class,'settings']);


Route::get('/team_assigns',[Samruddhi::class,'team_assigns']);
Route::get('/ticket_response/{id}',[Samruddhi::class,'ticket_response']);
Route::get('/ticket/{id}',[Samruddhi::class,'ticket']);
Route::get('/tickets',[Samruddhi::class,'tickets']);
Route::get('/transfers',[Samruddhi::class,'transfers']);

Route::get('/user/{id}',[Samruddhi::class,'user']);
Route::get('/users',[Samruddhi::class,'users']);
Route::get('/view_asset_audit/{id}',[Samruddhi::class,'view_asset_audit']);
Route::get('/view_property_audit/{id}',[Samruddhi::class,'view_property_audit']);

Route::get("pincode/{id}",[Samruddhi::class,"pincode"]);



Route::get('/test',[Samruddhi::class,'test']);

Route::get('/states',[Samruddhi::class,'states']);
Route::post('/create_state',[Samruddhi::class,'create_state']);

Route::get('/document_types',[Samruddhi::class,'document_types']);
Route::post('/create_document_type',[Samruddhi::class,'create_document_type']);

Route::get('/incident_types',[Samruddhi::class,'incident_types']);
Route::post('/create_incident_types',[Samruddhi::class,'create_incident_types']);

Route::get('/ticket_types',[Samruddhi::class,'ticket_types']);
Route::post('/create_ticket_types',[Samruddhi::class,'create_ticket_types']);

Route::view('/main','main');
Route::get('/main',[Samruddhi::class,'main']);

Route::get('/category_ds',[Samruddhi::class,'category_ds']);
Route::post('/create_category',[Samruddhi::class,'create_category']);

Route::get('/assign_fields',[Samruddhi::class,'assign_fields']);
Route::post('/create_fields',[Samruddhi::class,'create_fields']);

Route::get('/subcategory_ds',[Samruddhi::class,'subcategory_ds']);
Route::post('/create_subcategory',[Samruddhi::class,'create_subcategory']);
Route::post('/update_subcategory',[Samruddhi::class,'update_subcategory']);
Route::get('/delete_subcategory/{id}',[Samruddhi::class,'delete_subcategory']);


Route::get('/compliance_ds',[Samruddhi::class,'compliance_ds']);
Route::post('/create_compliance',[Samruddhi::class,'create_compliance']);


Route::get("get_subcategory/{id}",[Samruddhi::class,"get_subcategory"]);

Route::post("/assign_asset",[Samruddhi::class,"assign_asset"]);
Route::post("/transfer_asset/{id}",[Samruddhi::class,"transfer_asset"]);
Route::post("/create_ticket/{id}",[Samruddhi::class,"create_ticket"]);
Route::post("/create_incident/{id}",[Samruddhi::class,"create_incident"]);

Route::post("/create_single_asset_audit/{audit_id}/{asset_id}",[Samruddhi::class,"create_single_asset_audit"]);
Route::post("/create_unassigned_asset",[Samruddhi::class,"create_unassigned_asset"]);


Route::get("/not_found/{audit_id}/{asset_id}",[Samruddhi::class,"not_found"]);


Route::get("/update_asset_audits/{id}",[Samruddhi::class,"update_asset_audits"]);
Route::get("/unassigned_asset/{id}",[Samruddhi::class,"unassigned_asset"]);

Route::post("/update_single_asset_audit/{audit_id}/{asset_id}",[Samruddhi::class,"update_single_asset_audit"]);
Route::get("/change_asset_audit_final_status/{id}/{pending_audit}",[Samruddhi::class,"change_asset_audit_final_status"]);
Route::get("/change_asset_audit_status/{id}",[Samruddhi::class,"change_asset_audit_status"]);


Route::get('getCategory', [Samruddhi::class, 'getCategory'])->name('getCategory');

Route::get("/change_property_audit_status/{id}",[Samruddhi::class,"change_property_audit_status"]);
Route::get("/update_property_audits/{id}",[Samruddhi::class,"update_property_audits"]);

Route::post("/create_single_property_audit/{audit_id}/{property_id}",[Samruddhi::class,"create_single_property_audit"]);
Route::post("/update_single_property_audit/{audit_id}/{property_id}",[Samruddhi::class,"update_single_property_audit"]);
Route::get("/change_property_audit_final_status/{id}/{pending_audit}",[Samruddhi::class,"change_property_audit_final_status"]);


Route::post("/create_ticket_response/{ticket_id}",[Samruddhi::class,"create_ticket_response"]);
Route::post("/create_incident_response/{incident_id}",[Samruddhi::class,"create_incident_response"]);


Route::get("/assign_response/{nid}/{aid}/{status}",[Samruddhi::class,"assign_response"]);
Route::get("/update_notification/{notification_id}/{status}",[Samruddhi::class,"update_notification"]);

Route::post("/update_settings/{id}",[Samruddhi::class,"update_settings"]);

Route::get('/edit_compliance/{id}',[Samruddhi::class,'edit_compliance']);
Route::post('/update_compliance',[Samruddhi::class,'update_compliance']);
Route::get('/delete_compliance/{id}',[Samruddhi::class,'delete_compliance']);


Route::get('/edit_category/{id}',[Samruddhi::class,'edit_category']);
Route::post('/update_category',[Samruddhi::class,'update_category']);
Route::get('/delete_category/{id}',[Samruddhi::class,'delete_category']);
Route::post('/update_category',[Samruddhi::class,'update_category']);
Route::get('/delete_category/{id}',[Samruddhi::class,'delete_category']);

Route::post('/update_ticket',[Samruddhi::class,'update_ticket']);
Route::get('/delete_ticket/{id}',[Samruddhi::class,'delete_ticket']);

Route::post('/update_state',[Samruddhi::class,'update_state']);
Route::get('/delete_state/{id}',[Samruddhi::class,'delete_state']);

Route::post('/update_document',[Samruddhi::class,'update_document']);
Route::get('/delete_document/{id}',[Samruddhi::class,'delete_document']);

Route::post('/update_incident',[Samruddhi::class,'update_incident']);
Route::get('/delete_incident/{id}',[Samruddhi::class,'delete_incident']);


Route::get('/add_user_upload',[Samruddhi::class,'add_user_upload']);
Route::get('/add_asset_upload',[Samruddhi::class,'add_asset_upload']);
Route::get('/add_property_upload',[Samruddhi::class,'add_property_upload']);
Route::get('/audit_upload',[Samruddhi::class,'audit_upload']);

Route::post('/upload_users',[Samruddhi::class,'upload_users']);
Route::post('/upload_asset',[Samruddhi::class,'upload_asset']);
Route::post('/upload_property',[Samruddhi::class,'upload_property']);
Route::post('/upload_audit',[Samruddhi::class,'upload_audit']);

Route::get("/change_status/{id}/{status}",[Samruddhi::class,"change_status"]);
Route::get("/change_status_cat/{id}/{status}",[Samruddhi::class,"change_status_cat"]);
Route::get("/change_status_subcat/{id}/{status}",[Samruddhi::class,"change_status_subcat"]);
Route::get("/change_status_state/{id}/{status}",[Samruddhi::class,"change_status_state"]);
Route::get("/change_status_document/{id}/{status}",[Samruddhi::class,"change_status_document"]);
Route::get("/change_status_incident/{id}/{status}",[Samruddhi::class,"change_status_incident"]);
Route::get("/change_status_ticket/{id}/{status}",[Samruddhi::class,"change_status_ticket"]);
Route::get("/change_status_compliance/{id}/{status}",[Samruddhi::class,"change_status_compliance"]);

Route::get('/edit_subcategory_ds/{id}',[Samruddhi::class,'edit_subcategory_ds']);




});
