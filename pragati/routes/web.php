<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pragati;
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



Route::get('/', [Pragati::class,"login"]);
Route::post('/user_login',[Pragati::class,'user_login']);
Route::view('/register','register');
Route::view('/login',[Pragati::class,"login"]);

Route::view('/password','password');
Route::post('/update_password',[Pragati::class,'update_password']);



Route::view('/register','register');
Route::post('/register',[Pragati::class,'registerUser']);



Route::get('/sms_otp/{phone}/{pin}',[Pragati::class,'sms_otp']);

// ========================

// Route::get('/download-id-card/{id}', [Pragati::class,'downloadImage'])->name('download-id-card');


// ========================


//====================================================================
Route::group(['middleware' => ['protectedPage']], function(){


    Route::get("/add_user",[Pragati::class,"add_user"]);
    Route::get("/add_frontoffice",[Pragati::class,"add_frontoffice"]);

    Route::get("/index",[Pragati::class,"index"]);

    Route::get("search",[Pragati::class,"search"]);

    Route::get("users/{type}",[Pragati::class,"users"]);
    Route::get("user/{id}",[Pragati::class,"user"]);

    Route::get("coordinators",[Pragati::class,"coordinators"]);



    Route::post('/create_user',[Pragati::class,'create_user']);

    Route::post('/activate_user',[Pragati::class,'activate_user']);

    Route::post('/deactivate_user',[Pragati::class,'deactivate_user']);

    Route::post('/create_backoffice',[Pragati::class,'create_backoffice']);

    Route::get("add_bank",[Pragati::class,"add_bank"]);
    Route::post('/create_bank',[Pragati::class,'create_bank']);
    Route::post('/update_bank',[Pragati::class,'update_bank']);
    Route::get("banks",[Pragati::class,"banks"]);

    Route::get("add_project",[Pragati::class,"add_project"]);
    Route::post('/create_project',[Pragati::class,'create_project']);
    Route::post('/update_project',[Pragati::class,'update_project']);

    Route::get('/update_notification/{id}/{status}',[Pragati::class,'update_notification']);

    Route::get("projects",[Pragati::class,"projects"]);


    Route::get("all_requests",[Pragati::class,"all_requests"]);

    Route::get("/request_document",[Pragati::class,"request_document"]);
    Route::post("/create_document",[Pragati::class,"create_request"]);

    Route::get("/request/{id}",[Pragati::class,"request"]);
    Route::get("/update_request",[Pragati::class,"update_request"]);

    Route::get("/result",[Pragati::class,"result"]);
    Route::post("/result",[Pragati::class,"result"]);

    Route::get("requests",[Pragati::class,"requests"]);

    Route::get("datasets",[Pragati::class,"datasets"]);

    Route::get("id/{id}",[Pragati::class,"id"]);

    Route::get("notifications",[Pragati::class,"notifications"]);
    Route::get("all_notifications",[Pragati::class,"all_notifications"]);


    Route::get("upload",[Pragati::class,"upload"]);
    Route::post('/upload_users',[Pragati::class,'upload_users']);

    Route::get("upload_banks",[Pragati::class,"upload_banks"]);
    Route::post('/bulk_upload_banks',[Pragati::class,'bulk_upload_banks']);


    Route::view('/project','project');



    Route::get('/edit_user/{id}',[Pragati::class,'edit_user']);
    Route::get('/edit_bank/{id}',[Pragati::class,'edit_bank']);
    Route::get('/edit_project/{id}',[Pragati::class,'edit_project']);

    Route::get('/edit_frontoffice/{id}',[Pragati::class,'edit_frontoffice']);
    Route::post('/update_frontoffice',[Pragati::class,'update_frontoffice']);

    Route::get('/edit_backoffice/{id}',[Pragati::class,'edit_backoffice']);
    Route::post('/update_backoffice',[Pragati::class,'update_backoffice']);


    Route::get("add_notification",[Pragati::class,"add_notification"]);
    Route::post('/add_notification',[Pragati::class,'create_notification']);
    Route::get("notifications",[Pragati::class,"notifications"]);

    Route::get("apex_bodies",[Pragati::class,"apex_bodies"]);
    Route::post('/apex_bodies',[Pragati::class,'create_apex_bodies']);

    Route::get("qualifications",[Pragati::class,"qualifications"]);
    Route::post('/qualifications',[Pragati::class,'create_qualification']);

    Route::get("professions",[Pragati::class,"professions"]);
    Route::post('/professions',[Pragati::class,'create_profession']);

    Route::get("posts",[Pragati::class,"posts"]);
    Route::post('/posts',[Pragati::class,'create_post']);

    Route::get("other_posts",[Pragati::class,"other_posts"]);
    Route::post('/other_posts',[Pragati::class,'create_other_post']);

    Route::get("documents",[Pragati::class,"documents"]);
    Route::post('/documents',[Pragati::class,'create_document']);

    Route::view('/access_denied','access_denied');

    Route::get("update_status/{id}/{status}/{url}",[Pragati::class,"update_status"]);
    Route::get("pincode/{id}",[Pragati::class,"pincode"]);

    Route::get("add_profile",[Pragati::class,"add_profile"]);
    Route::post('/add_profile',[Pragati::class,'create_profile']);

    Route::post('/update_request/{id}',[Pragati::class,'update_request']);

    Route::post('/create_response/{id}',[Pragati::class,'create_response']);

    Route::get('/settings',[Pragati::class,'settings']);

    Route::get('/update_settings',[Pragati::class,'update_settings']);

    Route::get('/send_document/{id}',[Pragati::class,'send_document']);



    Route::get('/logout', function () {
        Session::flush();
        return redirect('/');
    });

    Route::get("edit_apex/{id}",[Pragati::class,"edit_apex"]);
    Route::post('/update_apex_bodies/{id}',[Pragati::class,'update_apex_bodies']);







});

