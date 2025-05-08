<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Auth;
use App\Models\Temp;
use App\Models\User;
use App\Models\Assets;
use App\Models\Cabins;
use App\Models\States;
use App\Models\Assigns;
use App\Models\Tickets;
use App\Models\Category;
use App\Models\Pincodes;
use App\Models\Property;
use App\Models\Buildings;
use App\Models\Documents;
use App\Models\Incidents;
use App\Models\Locations;
use App\Models\Compliances;
use App\Models\Subcategory;
use App\Models\Asset_audits;
use App\Models\Dependencies;
use App\Models\Ticket_types;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Document_types;
use App\Models\Incident_types;
use App\Models\Property_audits;
use App\Models\Assign_field;
use App\Models\Privilege;
use App\Models\Asset_audit_master;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Property_audit_master;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

// use RealRashid\SweetAlert\Facades\Alert;
// use Alert;
//use Auth;
class Pages extends Controller
{
    //

    function login()
    {
        return view('login');
    }

    function index()
    {
        $notifications = Notifications::orderBy('id', 'desc')->get();
        $locations = Locations::orderBy('id', 'desc')->get();
        $locations = count($locations);
        $assigns = Assigns::orderBy('id', 'desc')->get();
        $assigns = count($assigns);
        $assets = Assets::orderBy('id', 'desc')->get();
        $users = Auth::orderBy('id', 'desc')->get();
        $users = count($users);
        $unused_assets = 0;
        $used_assets = 0;

        foreach ($assets as $asset) {
            if ($asset->user_id == $asset->owner_id) {
                $unused_assets++;
            } else {
                $used_assets++;
            }
        }

        $assets = count($assets);
        $tickets = Tickets::orderBy('id', 'desc')->get();
        $incidents = Incidents::orderBy('id', 'desc')->get();
        $tickets = count($tickets);
        $incidents = count($incidents);

        $status = 2;

        $asset_audit = Asset_audit_master::where('status', $status)->get();
        $count_of_asset_audit = count($asset_audit);
        $property_audit = Property_audit_master::where('status', $status)->get();
        $count_of_property_audit = count($property_audit);

        $data = [
            'locations' => $locations,
            'assets' => $assets,
            'unused_assets' => $unused_assets,
            'used_assets' => $used_assets,
            'tickets' => $tickets,
            'incidents' => $incidents,
            'users' => $users,
            'assigns' => $assigns,
            'asset_audit' => $count_of_asset_audit,
            'property_audit' => $count_of_property_audit,
            'notifications' => $notifications,
        ];


        if (Session::has('user'))
        {
            if (Session::get('rexkod_apex_user_type') == "hq" || Session::get('rexkod_apex_user_type') == "owner"  || Session::get('rexkod_apex_user_type') == "apex")
            {
                return view('index', ['data' => $data]);
            }
            else
            {
                return redirect('/user/' . Session::get('rexkod_apex_user_id'));
            }
        }
        else
        {
            return redirect('/');
        }

    }

    function add_asset_select()
    {
        // $category = Category::all();

        // $data = [
        //     'category' => $category,

        // ];
        $firstOptions = Category::all();
  return view('add_asset_select', compact('firstOptions'));


            // return view('add_asset_select', ['data' => $data]);


    }
    function add_asset($type, $id)
    {
        $subcategory = Subcategory::where('id', $id)->first();
        $buildings = Buildings::all();
        $users = Auth::all();
        $get_all_compliances = Compliances::all();
        $all_apex = Auth::where('type', 'apex')->get();
        $fields = $subcategory->fields;
        $fields = explode(',', $fields);
        // dd($fields);

        $data = [
            'fields' => $fields,
            'subcategory' => $subcategory,
            'buildings' => $buildings,
            'users' => $users,
            'all_apex' => $all_apex,
            'type' => $type,
            'compliances' => $get_all_compliances,
        ];


            return view('add_asset', ['data' => $data]);

    }

    function edit_asset($type, $id)
    {


        $get_asset = Assets::where('id', $id)->first();
        $subcategory_id = $get_asset->subcategory_id;
        $subcategory = Subcategory::where('id', $subcategory_id)->first();
        $buildings = Buildings::all();
        $users = Auth::all();
        $get_all_compliances = Compliances::all();
        $all_apex = Auth::where('type', 'apex')->get();
        $fields = $subcategory->fields;
        $fields = explode(',', $fields);

        $data = [
            'get_asset' => $get_asset,
            'fields' => $fields,
            'subcategory' => $subcategory,
            'buildings' => $buildings,
            'users' => $users,
            'all_apex' => $all_apex,
            'type' => $type,
            'compliances' => $get_all_compliances,
        ];


            return view('edit_asset', ['data' => $data]);

    }

    function add_user()
    {
        $users = Auth::where('type', 'manager')->get();
        $locations = Locations::all();

        $states = States::all();
        $privilege = Privilege::all();

        $data = [
            'managers' => $users,
            'locations' => $locations,
            'states' => $states,
            'privilege' => $privilege,
        ];
        return view('add_user', ['data' => $data]);
    }

    function all_assets()
    {
        $subcategory = Subcategory::all();
        $assets = Assets::all();
        $users =  Auth::orderBy('id', 'DESC')->get();;

        $buildings = Buildings::all();
        $cabins = Cabins::all();
        $data = [
            'assets' => $assets,
            'subcategory' => $subcategory,
            'users' => $users,
            'buildings' => $buildings,
            'cabins' => $cabins,
        ];

            return view('/all_assets', ['data' => $data]);



    }

    function category()
    {

        $category = Category::all();
        $data = [
            'category' => $category,
        ];


            return view('category', ['data' => $data]);


    }

    function compliances()
    {

        $compliances = Compliances::all();
        $data = [
            'compliances' => $compliances,
        ];

        return view('compliances', ['data' => $data]);
    }
    // function create_compliance(Request $req)
    // {

    //     $comp = new Compliances;
    //     $comp->name = $req->name;
    //     $comp->save();

    //     return view('compliances');
    // }

    function document_types()
    {

        $document_types = Document_types::orderBy('id', 'desc')->get();
        $data = [
            'document_types' => $document_types,
        ];

        return view('document_types', ['data' => $data]);
    }
    function documents()
    {

        $documents =  Documents::all();
        $document_types =  Document_types::all();
        $data = [
            'documents' => $documents,
            'document_types' => $document_types,
        ];

        return view('documents', ['data' => $data]);
    }
    function incident_types()
    {

        $incidents = Incident_types::orderBy('id', 'desc')->get();
        $data = [
            'incident_types' => $incidents,
        ];

        return view('incident_types', ['data' => $data]);
    }
    function incident_response($id)
    {

        $data = [
            'incident_id' => $id,
        ];

        return view('incident_response', ['data' => $data]);
    }
    function incidents()
    {

        $incidents = Incidents::all();

        $data = [
            'incidents' => $incidents,

        ];

        return view('incidents', ['data' => $data]);
    }
    function incident($id)
    {

        $get_incident = Incidents::where('id', $id)->first();

        $data = [
            'incident' => $get_incident,
            'incident_id' => $id,
        ];

        return view('incident', ['data' => $data]);
    }
    function locations()
    {

        $locations = Locations::all();
        $data = [
            'locations' => $locations,
        ];

        return view('locations', ['data' => $data]);
    }
    function location($id)
    {

        $location = Locations::where('id', $id)->first();
        $data = [
            'location' => $location,
        ];

        return view('location', ['data' => $data]);
    }
    function notifications()
    {

        $notifications =  Notifications::where('user_id',Session('rexkod_apex_user_id'))->get();

        $data = [
            'notifications' => $notifications,
        ];

        return view('notifications', ['data' => $data]);
    }
    function properties()
    {

        $property = Property::all();
        $data = [
            'property' => $property,
        ];

        return view('properties', ['data' => $data]);
    }
    function property($id)
    {

        $property = Property::where('id', $id)->first();
        $audits = Asset_audits::where('asset_id', $id)->get();
        $data = [
            'property' => $property,
            'audits' => $audits,
        ];


        return view('property', ['data' => $data]);
    }

    function asset_audits()
    {
        if (Session::get('rexkod_apex_user_type') == "auditor") {
            $audits = Asset_audit_master::where('auditor_id',Session::get('rexkod_apex_user_id'))->get();
        } else {
            $audits = Asset_audit_master::all();
        }

        $data = [
            'audits' => $audits,
        ];
        return view('asset_audits', ['data' => $data]);

    }

    function property_audits()
    {
        if (Session::get('rexkod_apex_user_type') == "auditor") {
            $audits = Property_audit_master::where('auditor_id',Session::get('rexkod_apex_user_id'))->get();
        } else {
            $audits = Property_audit_master::all();
        }

        $data = [
            'audits' => $audits,
        ];
        return view('property_audits', ['data' => $data]);

    }


    function reports()
    {

        $category = Category::all();
        $managers =  Auth::where('type', 'manager')->get();
        $locations = Locations::all();
        $data = [
            'category' => $category,
            'managers' => $managers,
            'locations' => $locations,
        ];

        return view('reports', ['data' => $data]);
    }
    function states()
    {

        $states = States::orderBy('id', 'desc')->get();
        $data = [
            'states' => $states,
        ];

        return view('states', ['data' => $data]);
    }
    function settings()
    {

        $get_user_detail =  Auth::where('id',Session('rexkod_apex_user_id'))->first();
        $data = [
            'get_user_detail' => $get_user_detail,
        ];

        return view('settings', ['data' => $data]);
    }

    function update_settings($id,Request $req)
    {
        $get_user_detail =  Auth::where('id', Session::get('rexkod_apex_user_id'))->first();


        if(isset($req->photo)){
            $extension = $req->file('photo')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'b_'.time().'.'.$extension;
                    $req->file('photo')->move(public_path('profiles'), $filename);
                    $photo = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $photo = $get_user_detail->photo;
            }

        $name = $req->name;
        $email = $req->email;
        $phone = $req->phone;

        if (isset($req->password)) {

            $password =  Hash::make($req->password);


        } else {
            $password = $get_user_detail->password;
        }



        $ip = file_get_contents("http://ipecho.net/plain");

            $auth= Auth::find(Session('rexkod_apex_user_id'));
            $auth->name= $name;
            $auth->email= $email;
            $auth->phone= $phone;
            $auth->photo= $photo;
            $auth->ip_address= $ip;
            $auth->password= $password;
            $auth->save();

            session()->put('success','Settings Updated');
            return redirect('/settings');




    }


    function add_asset_audit($location_id)
    {

        $get_users = Auth::where('type', 'auditor')->get();


        $get_all_assets = DB::table('auth')
            ->join('assets', 'assets.user_id', '=', 'auth.id')
            ->where('auth.location_id', $location_id)
            ->get();

        $locations = Locations::all();

        $data = [
            'get_users' => $get_users,
            'locations' => $locations,
            'get_all_assets' => $get_all_assets,
            'location_id' => $location_id,
        ];

        return view('add_asset_audit', ['data' => $data]);
    }
    function create_asset_audit(Request $req)
    {

        //return $req->input();
        $user = new Asset_audit_master;
        if(isset($req->asset_id)){
           // $asset_id = implode(',', $_POST['asset_id']);
            $user->asset_id = implode(',', $req->asset_id);
        }


        $user->auditor_id = $req->auditor_id;
        $user->start_date = $req->start_date;
        $user->end_date = $req->end_date;
        $user->location_id = $req->location_id;
        $user->save();

        return redirect('/add_asset_audit/0');
    }

    function get_subcategory($cat_id,Request $req)
    {
        // echo "test";
        // die;
        $cat_id = $req->cat_id;
        $subcategory =  Subcategory::where('category_id', $cat_id)->get();

        $sub = "<option selected disabled>Select a Subcategory</option>";
        foreach ($subcategory as $subcat) {
            $sub = $sub . "<option value='" . $subcat->id . "'>" . $subcat->name . "</option>";
        }
        echo $sub;
    }



public function secondOptions(Request $request)
{

  $secondOptions = Subcategory::where('category_id', $request->cat_id)->get();
  $output = '';
  foreach($secondOptions as $option) {
    $output .= '<option value="' . $option->id . '">' . $option->name . '</option>';
  }
  return $output;
}



    function add_property_audit($location_id)
    {

        $get_users =  Auth::where('type', 'auditor')->get();
        $get_all_properties = DB::table('auth')
            ->join('property', 'property.user_id', '=', 'auth.id')
            ->where('auth.location_id', $location_id)
            ->get();

        $locations = Locations::all();

        $data = [
            'get_users' => $get_users,
            'locations' => $locations,
            'get_all_properties' => $get_all_properties,
            'location_id' => $location_id,
        ];

        return view('add_property_audit', ['data' => $data]);
    }
    function edit_location($id)
    {

        $get_location =  Locations::where('id', $id)->first();
        $data = [
            'get_location' => $get_location,
        ];

        return view('edit_location', ['data' => $data]);
    }

    function update_location(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->latlon, 'script')) { session()->flush(); return redirect('login');}

        $user=Locations::find($req->id);

        $user->type = $req->type;
        $user->name = $req->name;
        $user->address = $req->address;
        $user->latlon = $req->latlon;
        $user->pincode = $req->pincode;
        $user->district = $req->district;
        $user->state = $req->state;




            $user->save();
            session()->put('success','Location Updated');
            return redirect('/locations');

     }


    function edit_property($id)
    {

        $property =  Property::where('id', $id)->first();

        $data = [
            'property' => $property
        ];

        return view('edit_property', ['data' => $data]);
    }
    function edit_user($id)
    {

        $get_user_detail = Auth::where('id', $id)->first();
        $states =  States::all();
        $locations = Locations::all();
        $managers = Auth::where('type', 'manager')->get();

        $privilege = Privilege::all();

        $data = [
            'get_user_detail' => $get_user_detail,
            'states' => $states,
            'managers' => $managers,
            'locations' => $locations,
            'privilege' => $privilege,

        ];

        return view('edit_user', ['data' => $data]);
    }

    function ticket_response($id)
    {

        $data = [
            'ticket_id' => $id,
        ];

        return view('ticket_response', ['data' => $data]);
    }
    function ticket_types()
    {

        $tickets = Ticket_types::orderBy('id', 'desc')->get();
        $data = [
            'ticket_types' => $tickets,
        ];

        return view('ticket_types', ['data' => $data]);
    }


    function ticket($id)
    {

        $get_ticket = Tickets::where('id', $id)->first();
        $data = [
            'ticket' => $get_ticket,
            'ticket_id' => $id,
        ];

        return view('ticket', ['data' => $data]);
    }

    function tickets()
    {

        $tickets = Tickets::all();
        $data = [
            'tickets' => $tickets,
        ];

        return view('tickets', ['data' => $data]);
    }

    function transfers()
    {

        $assigns = Assigns::all();
        $data = [
            'assigns' => $assigns,
        ];

        return view('transfers', ['data' => $data]);
    }

    function users()
    {

        $users = Auth::orderBy('id', 'DESC')->get();


        $data = [
            'users' => $users,
        ];

        return view('/users', ['data' => $data]);
    }
    function user($id)
    {

        $user = Auth::where('id', $id)->first();
        $assets = Assets::where('user_id', $id)->get();
        $assetsc = Assets::where('user_id', $id)->orderBy('id','desc')->get();

        $assetscount = count($assetsc);

        $data = [
            'user' => $user,
            'assets' => $assets,
            'assetscount' => $assetscount
        ];

        return view('user', ['data' => $data]);

    }

    function view_asset_audit($id)
    {

        $get_audit_master = Asset_audit_master::where('id', $id)->first();
        $data = [
            'audits' => $get_audit_master,
            'audit_id' => $id,
        ];

        return view('view_asset_audit', ['data' => $data]);
    }
    function view_property_audit($id)
    {


        $get_audit_master = Property_audit_master::where('id', $id)->first();
        $data = [
            'audits' => $get_audit_master,
            'audit_id' => $id,
        ];

        return view('view_property_audit', ['data' => $data]);
    }
    function pending_asset_audits($id)
    {


        $get_audit_master = Asset_audit_master::where('id', $id)->first();
        $data = [
            'audits' => $get_audit_master,
            'audit_id' => $id,
        ];

        return view('pending_asset_audits', ['data' => $data]);
    }
    function processing_asset_audits($id)
    {


        $get_audit_master = Asset_audit_master::where('id', $id)->first();
        $data = [
            'audits' => $get_audit_master,
            'audit_id' => $id,
        ];

        return view('processing_asset_audits', ['data' => $data]);
    }
    function pending_property_audits($id)
    {

        $get_audit_master =  Property_audit_master::where('id', $id)->first();
        $data = [
            'audits' => $get_audit_master,
            'audit_id' => $id,
        ];

        return view('pending_property_audits', ['data' => $data]);
    }

    function results(Request $req)
    {
        $search = $req->search;
        // dd($search);

        $subcategory = Subcategory::orderBy('id', 'desc')->get();
        $assets = Assets::where('name', 'LIKE', '%'.$search.'%')->get(); //like clause
        $users = Auth::orderBy('id', 'desc')->get();
        $buildings = Buildings::orderBy('id', 'desc')->get();
        $cabins = Cabins::orderBy('id', 'desc')->get();
        $data = [
            'assets' => $assets,
            'subcategory' => $subcategory,
            'users' => $users,
            'buildings' => $buildings,
            'cabins' => $cabins,
        ];

        return view('results', ['data' => $data]);
    }

    function team_assigns()
    {
        $notifications = Notifications::where('manager_id',Session('rexkod_apex_user_id'))
        ->where('type','assign')
        ->get();


        $data = [
            'notifications' => $notifications,
        ];

            return view('/team_assigns', ['data' => $data]);

    }



    function asset($id)
    {
        $users = Auth::where('type', 'manager')->get();
        $buildings = Buildings::all();
        $cabins = Cabins::all();
        $ticket_types = Ticket_types::all();
        $document_types = Document_types::all();
        $incident_types = Incident_types::all();
        $asset =  Assets::where('id', $id)->first();
        $assigns =  Assigns::where('asset_id', $id)->get();
        $tickets = Tickets::where('asset_id', $id)->get();
        $incidents = Incidents::where('asset_id', $id)->get();
        $subcategory = Subcategory::where('id', $asset->subcategory_id)->first();
        $dependencies = Dependencies::where('asset_id', $id)->get();
        $audits =  Asset_audits::where('asset_id', $id)->get();
        $fields = explode(',', $subcategory->fields);
        $data = [
            'asset' => $asset,
            'assigns' => $assigns,
            'tickets' => $tickets,
            'incidents' => $incidents,
            'fields' => $fields,
            'users' => $users,
            'buildings' => $buildings,
            'cabins' => $cabins,
            'ticket_types' => $ticket_types,
            'incident_types' => $incident_types,
            'document_types' => $document_types,
            'dependencies' => $dependencies,
            'audits' => $audits
        ];
        return view('asset', ['data' => $data]);
    }


    function create_location(Request $req)
    {
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->latlon, 'script')) { session()->flush(); return redirect('login');}

        $locations = new Locations;
        $locations->type = $req->type;
        $locations->name = $req->name;
        $locations->address = $req->address;
        $locations->latlon = $req->latlon;
        $locations->pincode = $req->pincode;
        $locations->state = $req->state;
        $locations->district = $req->district;


            $locations->save();
            session()->put('success','Location Added');
            return redirect('/locations');

    }

    function create_user(Request $req)
    {
    //    dd($req->privilege);
    //    die;

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->email, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->password, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->user_id, 'script')) { session()->flush(); return redirect('login');}

        $email = $req->email;
        $phone = $req->phone;
        $user_id = $req->user_id;

        $check_phone = Auth::where('phone',$phone)->first();
        if ($check_phone) {

            session()->put('failed','Phone already exists');
            return redirect()->back();

        }
        $check_email = Auth::where('email',$email)->first();
        if ($check_email) {

            session()->put('failed','Email already exists');
            return redirect()->back();
        }
        $check_user_id = Auth::where('user_id',$user_id)->first();
        if ($check_user_id) {

            session()->put('failed','Employee ID already exists');
            return redirect()->back();
        }

        $auth = new Auth;
        $auth->type = $req->type;
        $auth->name = $req->name;
        $auth->email = $req->email;
        $auth->phone = $req->phone;
        $auth->user_id = $req->user_id;

        if(!empty($req->privilege))
        {
            $auth->privilege = implode(',', $req->privilege);
        }
        else{
            $auth->privilege = NULL;
        }

        $auth->password = Hash::make($req->password);

        $uppercase = preg_match('@[A-Z]@', $req->password);
        $lowercase = preg_match('@[a-z]@', $req->password);
        $number    = preg_match('@[0-9]@', $req->password);
        $specialChars = preg_match('@[^\w]@', $req->password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($req->password) < 8) {

            session()->put('failed','Password should be atleast 8 characters & must include atleast one upper case letter, one number, and one special character');
            return redirect()->back();

        //  "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        //     redirect('pages/add_user');
            // die;
        }


        $auth->state_id = $req->state_id;
        $auth->location_id = $req->location_id;
        $auth->manager_id = $req->manager_id;
        $auth->permission = $req->permission;
        $auth->status = '1';

        if(isset($req->photo)){
        $extension = $req->file('photo')->extension();
        if(isset($extension)){

            if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                $filename = 'b_'.time().'.'.$extension;
                $req->file('photo')->move(public_path('profiles'), $filename);
                $auth->photo = $filename;
            } else {
                session()->put('failed','Invalid Image File');
                return redirect()->back();
            }


        }}
        else {
            $auth->photo = NULL;
        }



            $auth->save();
            session()->put('success','User Added');
            return redirect('/users');

    }

    function create_property(Request $req)
    {
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->other_assests_on_property, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->purpose_of_this_property, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->coordinates, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->dimensions, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->area, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->metrics, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->previous_owner, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->laising_advocate_name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->reg_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_tvc, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_khata, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_patta, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_encumburance, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_survy_sketch, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_soiltest, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_ele_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_constr_appro, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_tax_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_forest_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_court_docs, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_overall_legal_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_trust_resol, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_orig_recho, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->photos_and_video_notes, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->other_notes, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->additional_information, 'script')) { session()->flush(); return redirect('login');}


        $req->validate([
            'other_files' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_tvc' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_khata' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_patta' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_encumburance' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_survy_sketch' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_soiltest' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_ele_cls' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_constr_appro' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_tax_cls' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_forest_cls' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_court_docs' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_overall_legal_cls' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_trust_resol' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_orig_recho' => 'required|mimes:jpg,png,jpeg,pdf|max:4000000',
            'photos_and_videos' => 'required|mimes:jpg,png,jpeg,pdf,mp4,mkv|max:4000000'
            ]);

        $property = new Property;

        $property->name = $req->name;
        $property->category = $req->category;
        $property->reg_number = $req->reg_number;
        $property->agreement_type = $req->agreement_type;
        $property->other_assests_on_property = $req->other_assests_on_property;
        $property->purpose_of_this_property = $req->purpose_of_this_property;
        $property->address = $req->address;
        $property->pincode = $req->pincode;
        $property->district = $req->district;
        $property->state = $req->state;
        $property->coordinates = $req->coordinates;
        $property->dimensions = $req->dimensions;
        $property->area = $req->area;
        $property->metrics = $req->metrics;
        $property->purchase = $req->purchase;
        $property->renew_date = $req->renew_date;
        $property->cost = $req->cost;
        $property->fmv = $req->fmv;
        $property->previous_owner = $req->previous_owner;
        $property->previous_owner_phn = $req->previous_owner_phn;
        $property->laising_advocate_name = $req->laising_advocate_name;
        $property->laising_advocate_phn = $req->laising_advocate_phn;
        $property->applicable_tvc = $req->applicable_tvc;
        $property->notes_tvc = $req->notes_tvc;
        $property->applicable_khata = $req->applicable_khata;
        $property->notes_khata = $req->notes_khata;
        $property->applicable_patta = $req->applicable_patta;
        $property->notes_patta = $req->notes_patta;
        $property->applicable_encumburance = $req->applicable_encumburance;
        $property->notes_encumburance = $req->notes_encumburance;
        $property->applicable_survy_sketch = $req->applicable_survy_sketch;
        $property->notes_survy_sketch = $req->notes_survy_sketch;
        $property->applicable_soiltest = $req->applicable_soiltest;
        $property->notes_soiltest = $req->notes_soiltest;
        $property->applicable_ele_cls = $req->applicable_ele_cls;
        $property->notes_ele_cls = $req->notes_ele_cls;
        $property->applicable_constr_appro = $req->applicable_constr_appro;
        $property->notes_constr_appro = $req->notes_constr_appro;
        $property->applicable_tax_cls = $req->applicable_tax_cls;
        $property->notes_tax_cls = $req->notes_tax_cls;
        $property->applicable_forest_cls = $req->applicable_forest_cls;
        $property->notes_forest_cls = $req->notes_forest_cls;
        $property->applicable_court_docs = $req->applicable_court_docs;
        $property->notes_court_docs = $req->notes_court_docs;
        $property->applicable_overall_legal_cls = $req->applicable_overall_legal_cls;
        $property->notes_overall_legal_cls = $req->notes_overall_legal_cls;
        $property->applicable_trust_resol = $req->applicable_trust_resol;
        $property->notes_trust_resol = $req->notes_trust_resol;
        $property->applicable_orig_rec_at_ho = $req->applicable_orig_rec_at_ho;
        $property->notes_orig_recho = $req->notes_orig_recho;
        $property->photos_and_video_notes = $req->photos_and_video_notes;
        $property->photos_and_videos = $req->and_vide;
        $property->other_notes = $req->other_notes;
        $property->additional_information = $req->additional_information;
        $property->user_id = Session('rexkod_apex_user_id');

        //====================================================================


        if ($req->file('other_files')) {
            $extension = $req->file('other_files')->extension();
            $filename = 'p1_'.time().'.'.$extension;
            $req->file('other_files')->move(public_path('profiles'), $filename);
            $property->other_files = $filename;

        } else {
            $property->other_files = 'dummy.png';
        }

        if ($req->file('file_tvc')) {
            $extension = $req->file('file_tvc')->extension();
            $filename = 'p2_'.time().'.'.$extension;
            $req->file('file_tvc')->move(public_path('profiles'), $filename);
            $property->file_tvc = $filename;
        } else {
            $property->file_tvc = 'dummy.png';
        }

        if ($req->file('file_khata')) {
            $extension = $req->file('file_khata')->extension();
            $filename = 'p3_'.time().'.'.$extension;
            $req->file('file_khata')->move(public_path('profiles'), $filename);
            $property->file_khata = $filename;

        } else {
            $property->file_khata = 'dummy.png';
        }

        if ($req->file('file_patta')) {
            $extension = $req->file('file_patta')->extension();
            $filename = 'p4_'.time().'.'.$extension;
            $req->file('file_patta')->move(public_path('profiles'), $filename);
            $property->file_patta = $filename;
        } else {
            $property->file_patta = 'dummy.png';
        }

        if ($req->file('file_encumburance')) {
            $extension = $req->file('file_encumburance')->extension();
            $filename = 'p5_'.time().'.'.$extension;
            $req->file('file_encumburance')->move(public_path('profiles'), $filename);
            $property->file_encumburance = $filename;
        } else {
            $property->file_encumburance = 'dummy.png';
        }

        if ($req->file('file_survy_sketch')) {
            $extension = $req->file('file_survy_sketch')->extension();
            $filename = 'p6_'.time().'.'.$extension;
            $req->file('file_survy_sketch')->move(public_path('profiles'), $filename);
            $property->file_survy_sketch = $filename;
        } else {
            $property->file_survy_sketch = 'dummy.png';
        }

        if ($req->file('file_soiltest')) {
            $extension = $req->file('file_soiltest')->extension();
            $filename = 'p7_'.time().'.'.$extension;
            $req->file('file_soiltest')->move(public_path('profiles'), $filename);
            $property->file_soiltest = $filename;
        } else {
            $property->file_soiltest = 'dummy.png';
        }

        if ($req->file('file_ele_cls')) {
            $extension = $req->file('file_ele_cls')->extension();
            $filename = 'p8_'.time().'.'.$extension;
            $req->file('file_ele_cls')->move(public_path('profiles'), $filename);
            $property->file_ele_cls = $filename;
        } else {
            $property->file_ele_cls = 'dummy.png';
        }

        if ($req->file('file_constr_appro')) {
            $extension = $req->file('file_constr_appro')->extension();
            $filename = 'p9_'.time().'.'.$extension;
            $req->file('file_constr_appro')->move(public_path('profiles'), $filename);
            $property->file_constr_appro = $filename;
        } else {
            $property->file_constr_appro = 'dummy.png';
        }

        if ($req->file('file_tax_cls')) {
            $extension = $req->file('file_tax_cls')->extension();
            $filename = 'p10_'.time().'.'.$extension;
            $req->file('file_tax_cls')->move(public_path('profiles'), $filename);
            $property->file_tax_cls = $filename;
        } else {
            $property->file_tax_cls = 'dummy.png';
        }

        if ($req->file('file_forest_cls')) {
            $extension = $req->file('file_forest_cls')->extension();
            $filename = 'p11_'.time().'.'.$extension;
            $req->file('file_forest_cls')->move(public_path('profiles'), $filename);
            $property->file_forest_cls = $filename;
        } else {
            $property->file_forest_cls = 'dummy.png';
        }

        if ($req->file('file_court_docs')) {
            $extension = $req->file('file_court_docs')->extension();
            $filename = 'p12_'.time().'.'.$extension;
            $req->file('file_court_docs')->move(public_path('profiles'), $filename);
            $property->file_court_docs = $filename;
        } else {
            $property->file_court_docs = 'dummy.png';
        }

        if ($req->file('file_overall_legal_cls')) {
            $extension = $req->file('file_overall_legal_cls')->extension();
            $filename = 'p13_'.time().'.'.$extension;
            $req->file('file_overall_legal_cls')->move(public_path('profiles'), $filename);
            $property->file_overall_legal_cls = $filename;
        } else {
            $property->file_overall_legal_cls = 'dummy.png';
        }

        if ($req->file('file_trust_resol')) {
            $extension = $req->file('file_trust_resol')->extension();
            $filename = 'p14_'.time().'.'.$extension;
            $req->file('file_trust_resol')->move(public_path('profiles'), $filename);
            $property->file_trust_resol = $filename;
        } else {
            $property->file_trust_resol = 'dummy.png';
        }

        if ($req->file('file_orig_recho')) {
            $extension = $req->file('file_orig_recho')->extension();
            $filename = 'p15_'.time().'.'.$extension;
            $req->file('file_orig_recho')->move(public_path('profiles'), $filename);
            $property->file_orig_recho = $filename;
        } else {
            $property->file_orig_recho = 'dummy.png';
        }

        if ($req->file('photos_and_videos')) {
            $extension = $req->file('photos_and_videos')->extension();
            $filename = 'p16_'.time().'.'.$extension;
            $req->file('photos_and_videos')->move(public_path('profiles'), $filename);
            $property->photos_and_videos = $filename;
        } else {
            $property->photos_and_videos = 'dummy.png';
        }


        $property->save();
        session()->put('success','Property Added');
        return redirect('/properties');


    }


    public function upload_file(Request $req)
    {
        $extension = $req->file('demo')->extension();
        if ($extension == "png" || $extension == "jpeg" || $extension == "jpg") {
            $filename = time() . '.' . $extension;
            return $req->file('demo')->storeAs('uploads', $filename);
        }
    }

    function create_property_audit(Request $req)
    {


        if(isset($req->property_id)){
            $property_id = implode(',', $req->property_id);


        }

        $property = new Property_audit_master;

        $property->auditor_id = $req->auditor_id;
        $property->start_date = $req->start_date;
        $property->end_date = $req->end_date;
        $property->property_id = $property_id;
        $property->location_id = $req->location_id;

        $property->save();
        return redirect('/add_property_audit/0');
    }

    function user_register(Request $req)
    {
        //    return $req->input();
        //     die();
        $phone = $req->user_phone;
        $email = $req->user_email;



        $check_phone = Auth::where('phone',$phone)->first();
        if ($check_phone) {

            session()->put('failed','Phone already exists');
            return redirect()->back();

        }
        $check_email = Auth::where('email',$email)->first();
        if ($check_email) {

            session()->put('failed','Email already exists');
            return redirect()->back();
        }

            $auth = new Auth;
            $auth->name = $req->user_name;
            $auth->type = $req->user_type;
            $auth->phone = $req->user_phone;
            $auth->email = $req->user_email;
            $auth->status = '2';
            $auth->password = Hash::make($req->password);

            $auth->save();
            $user = Auth::where('email', $req->user_email)->first();

            // $req->session()->put('user',$user);

            return redirect('/login');

    }


    function user_login(Request $req)
    {
        $user = Auth::where('email', $req->username)->first();

        if ($user && Hash::check($req->password, $user->password))
        {
            // Session::put('key', 'value');

            $auth_token = md5(uniqid(rand(), true));
            $update_auth_token=Auth::find($user->id);
            $update_auth_token->auth_token= $auth_token;
            $update_auth_token->save();

            Session::put('user', $user);
            Session::put('rexkod_apex_user_token', $auth_token);
            Session::put('rexkod_apex_user_id', $user->id);
            Session::put('rexkod_apex_user_name', $user->name);
            Session::put('rexkod_apex_user_email', $user->email);
            Session::put('rexkod_apex_user_state_id', $user->state_id);
            Session::put('rexkod_apex_user_type', $user->type);
            Session::put('rexkod_apex_user_phone', $user->phone);
            Session::put('rexkod_apex_user_status', $user->status);
            Session::put('rexkod_apex_user_permission', $user->permission);
            Session::put('rexkod_apex_user_priviliges', $user->privilege);

            return redirect('/index');
        }
        else
        {
            session()->put('failed','Invalid Credentials');
            return redirect()->back();
        }
    }

        //  function user_login(Request $req){

    //     $user = Auth::where('phone', $req->phone)->first();

    //     if($user && $user->last_otp == $req->otp){
    //     $date = date('Y-m-d H:i:s');
    //     Session::put('user', $user);
    //         Session::put('rexkod_apex_user_id', $user->id);
    //         Session::put('rexkod_apex_user_name', $user->name);
    //         Session::put('rexkod_apex_user_email', $user->email);
    //         Session::put('rexkod_apex_user_state_id', $user->state_id);
    //         Session::put('rexkod_apex_user_type', $user->type);
    //         Session::put('rexkod_apex_user_phone', $user->phone);
    //         Session::put('rexkod_apex_user_status', $user->status);
    //         Session::put('rexkod_apex_user_permission', $user->permission);
    //     Auth::where('id',$user->id)->update(['last_login'=>$date]);

    //     return redirect('/index');
    //     } else {
    //         session()->put('failed','Invalid Phone');
    //         return redirect('/login');
    //     }
    // }



    function test(Request $req)
    {

        $name = "ishwari_test";
        $file_new_name = 'test.jpg';
        header("Content-type: image/jpg");
        // Text to be written on Image.
        $seat_number = "N/A";
        $valid_from = "18/01/2023";
        $valid_to = "24/01/2023";
        $timing = "08:59:59"; // Text to be written on Image.
        // $qr_code = createimage2();
        // $qr_code = "<img src='https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=40'>";
        $x = 153; // X - Postion of text.
        $y = 351; // Y- Postion of text .
        ///// Add Name to the image ////////
        // $file_name = $_SERVER['DOCUMENT_ROOT']  . '/upload_pass/entry_pass.jpg'; // Image collected
        $file_name = 'entry_pass.jpg'; // Image collected
        $img_source = imagecreatefromjpeg($file_name); // Image created
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 5, $x, $y, $name, $text_color); //
        $qr_code = imagecreatefromstring(file_get_contents('https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=4'));
        imagecopymerge($img_source, $qr_code, 257, 264, 0, 0, 100, 100, 100);
        /// add date ////
        $today   = new DateTime;
        $str_date = $today->format('Y-M-d H:i:s');
        $x = 164; // X - Postion of text.
        $y = 376; // Y- Postion of text .
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $seat_number, $text_color);
        $x = 187; // X - Postion of text.
        $y = 402; // Y- Postion of text .
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $valid_from, $text_color);
        $x = 397; // X - Postion of text.
        $y = 402; // Y- Postion of text .
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $valid_to, $text_color);
        $x = 398; // X - Postion of text.
        $y = 376; // Y- Postion of text .
        $text_color = imagecolorallocate($img_source, 255, 255, 255);
        ImageString($img_source, 4, $x, $y, $timing, $text_color);
        // $x=257;
        // $y=265;
        // $text_color = imagecolorallocate($img_source, 0, 0, 0);
        // ImageString($img_source,4,$x,$y,$qr_code,$text_color);
        $new_image_source = $file_new_name;
        ImageJpeg($img_source, $new_image_source); // image saved
        ImageJpeg($img_source); // image saved
        // return true;
        return redirect('/test');
    }
    //==============================================================
    public function add_file(Request $req)
    {

        $req->validate([
            'file1' => 'required|mimes:jpg,png,jpeg|max:5120000',
            'file2' => 'required|mimes:jpg,png,jpeg|max:5120000'
            ]);

        $file = new Temp;

        if ($req->file('file1')) {
            $file1 = $req->file('file1')->store('public/uploads');
        } else {
            $file1 = 'dummy.png';
        }
        if ($req->file('file2')) {
            $file2 = $req->file('file2')->store('public/uploads');
        } else {
            $file2 = 'dummy.png';
        }


        $file->file2 = $file2;
        $file->file1 = $file1;
        $file->save();


        Alert::success('Success Title', 'Success Message');

        return "DONE";


    }
//===============================================

function reports_search(Request $req)
    {
        $type = $req->type;

        $data = [
            'category' => $req->category,
            'manager' => $req->manager,
            'location' => $req->location,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ];

        $data = json_encode($data);

        // dd($data);



            if ($type == 1) {

                return  redirect('report_assets/' . $data);

            } else if ($type == 2) {

                return redirect('report_transfers/' .$data);

            } else if ($type == 3) {

                return redirect('report_tickets/' .$data);

            } else if ($type == 4) {

                return redirect('report_incidents/' .$data);

            } else if ($type == 5) {

                return redirect('report_audits/' .$data);

            }

    }

    function report_assets($filters)
    {
        $filters = json_decode($filters, true);

        $sdate = $filters['start_date'];
        $edate = $filters['end_date'];
        $assets = Assets::whereBetween('datetime', [$sdate, $edate])->get();

        $data = [
            'assets' => $assets,
            'manager' => $filters['manager'],
            'location' => $filters['location'],
            'category' => $filters['category'],
        ];

        return view('/report_assets', ['data' => $data]);

    }

    function report_transfers($filters)
    {
        $filters = json_decode($filters, true);
        $sdate =$filters['start_date'];
        $edate =$filters['end_date'];
        $assigns = Assigns::whereBetween('assign_datetime', [$sdate, $edate])->get();


        $data = [
            'assigns' => $assigns,
            'manager' => $filters['manager'],
            'location' => $filters['location'],
            'category' => $filters['category'],
        ];

        return view('/report_transfers', ['data' => $data]);

    }

    public function report_tickets($filters)
    {
        $filters = json_decode($filters, true);
        $sdate =$filters['start_date'];
        $edate =$filters['end_date'];
        $tickets = Tickets::whereBetween('request_datetime', [$sdate, $edate])->get();

        $data = [
            'tickets' => $tickets,
            'manager' => $filters['manager'],
            'location' => $filters['location'],
            'category' => $filters['category'],
        ];
        return view('/report_tickets', ['data' => $data]);

    }


    public function report_incidents($filters)
    {
        $filters = json_decode($filters, true);
        $sdate =$filters['start_date'];
        $edate =$filters['end_date'];
        $incidents = Incidents::whereBetween('request_datetime', [$sdate, $edate])->get();

        $data = [
            'incidents' => $incidents,
            'manager' => $filters['manager'],
            'location' => $filters['location'],
            'category' => $filters['category'],
        ];
        return view('/report_incidents', ['data' => $data]);

    }

    public function report_audits($filters)
    {
        $filters = json_decode($filters, true);
        $sdate =$filters['start_date'];
        $edate =$filters['end_date'];
        $audits = Asset_audits::whereBetween('created_at', [$sdate, $edate])->get();


        $data = [
            'audits' => $audits,
            'manager' => $filters['manager'],
            'location' => $filters['location'],
            'category' => $filters['category'],
        ];
        return view('/report_audits', ['data' => $data]);

    }


    function subcategory($pin)
    {
        $result = Subcategory::where('category_id', $pin)->get();
        $sub = "<option selected disabled>Select a Subcategory</option>";
        foreach ($result as $subcat) {
            $sub = $sub . "<option value='" . $subcat->id . "'>" . $subcat->name . "</option>";
        }
        echo $sub;
    }
    function change_asset_audit_status($id)
    {
        $update=Asset_audit_master::where('id', $id)->first();
        $update->status='1';
        $update->save();


        session()->put('success','Audit Status Changed to Proccessing!');
        return redirect('/update_asset_audits/' . $id);



    }


function returnUser($id)
{
    return Auth::where('id', $id)->get();
}

 function update_user(Request $req)
 {
    if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
    if (str_contains($req->email, 'script')) { session()->flush(); return redirect('login');}
    if (str_contains($req->password, 'script')) { session()->flush(); return redirect('login');}

        $auth=Auth::find($req->id);

        $auth->type = $req->type;
        $auth->name = $req->name;
        $auth->email = $req->email;
        $auth->phone = $req->phone;


        $auth->state_id = $req->state_id;
        $auth->location_id = $req->location_id;
        $auth->manager_id = NULL;
        $auth->permission = $req->permission;
        $auth->status = $auth->status;

        if(!empty($auth->privilege))
        {
            $auth->privilege = implode(',', $req->privilege);
        }
        else{
            $auth->privilege = NULL;
        }


        if(isset($req->photo)){
            $extension = $req->file('photo')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'b_'.time().'.'.$extension;
                    $req->file('photo')->move(public_path('profiles'), $filename);
                    $auth->photo = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $auth->photo = $auth->photo;
            }

        $auth->save();
        session()->put('success','User Updated');

        // return redirect('/edit_user');
        return redirect()->back();

     }



     function pincode($pin)
     {
         $result = Pincodes::where('pincode', $pin)->first();
         echo $result->district.",".$result->state;
     }


     function update_property(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->other_assests_on_property, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->purpose_of_this_property, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->coordinates, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->dimensions, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->area, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->metrics, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->previous_owner, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->laising_advocate_name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->reg_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_tvc, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_khata, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_patta, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_encumburance, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_survy_sketch, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_soiltest, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_ele_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_constr_appro, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_tax_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_forest_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_court_docs, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_overall_legal_cls, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_trust_resol, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->notes_orig_recho, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->photos_and_video_notes, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->other_notes, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->additional_information, 'script')) { session()->flush(); return redirect('login');}
        // dd($req->file('file_khata'));
        // dd($req->id);

        $req->validate([
            'other_files' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_tvc' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_khata' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_patta' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_encumburance' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_survy_sketch' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_soiltest' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_ele_cls' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_constr_appro' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_tax_cls' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_forest_cls' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_court_docs' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_overall_legal_cls' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_trust_resol' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'file_orig_recho' => 'mimes:jpg,png,jpeg,pdf|max:4000000',
            'photos_and_videos' => 'mimes:jpg,png,jpeg,pdf,mp4,mkv|max:4000000',
            ]);
            // dd($req->id);
        $property = Property::find($req->id);


        // dd($req->file('file_khata'));

        $property->name = $req->name;
        $property->category = $req->category;
        $property->reg_number = $req->reg_number;
        $property->agreement_type = $req->agreement_type;
        $property->other_assests_on_property = $req->other_assests_on_property;
        $property->purpose_of_this_property = $req->purpose_of_this_property;
        $property->address = $req->address;
        $property->pincode = $req->pincode;
        $property->district = $req->district;
        $property->state = $req->state;
        $property->coordinates = $req->coordinates;
        $property->dimensions = $req->dimensions;
        $property->area = $req->area;
        $property->metrics = $req->metrics;
        $property->purchase = $req->purchase;
        $property->renew_date = $req->renew_date;
        $property->cost = $req->cost;
        $property->fmv = $req->fmv;
        $property->previous_owner = $req->previous_owner;
        $property->previous_owner_phn = $req->previous_owner_phn;
        $property->laising_advocate_name = $req->laising_advocate_name;
        $property->laising_advocate_phn = $req->laising_advocate_phn;
        $property->applicable_tvc = $req->applicable_tvc;
        $property->notes_tvc = $req->notes_tvc;
        $property->applicable_khata = $req->applicable_khata;
        $property->notes_khata = $req->notes_khata;
        $property->applicable_patta = $req->applicable_patta;
        $property->notes_patta = $req->notes_patta;
        $property->applicable_encumburance = $req->applicable_encumburance;
        $property->notes_encumburance = $req->notes_encumburance;
        $property->applicable_survy_sketch = $req->applicable_survy_sketch;
        $property->notes_survy_sketch = $req->notes_survy_sketch;
        $property->applicable_soiltest = $req->applicable_soiltest;
        $property->notes_soiltest = $req->notes_soiltest;
        $property->applicable_ele_cls = $req->applicable_ele_cls;
        $property->notes_ele_cls = $req->notes_ele_cls;
        $property->applicable_constr_appro = $req->applicable_constr_appro;
        $property->notes_constr_appro = $req->notes_constr_appro;
        $property->applicable_tax_cls = $req->applicable_tax_cls;
        $property->notes_tax_cls = $req->notes_tax_cls;
        $property->applicable_forest_cls = $req->applicable_forest_cls;
        $property->notes_forest_cls = $req->notes_forest_cls;
        $property->applicable_court_docs = $req->applicable_court_docs;
        $property->notes_court_docs = $req->notes_court_docs;
        $property->applicable_overall_legal_cls = $req->applicable_overall_legal_cls;
        $property->notes_overall_legal_cls = $req->notes_overall_legal_cls;
        $property->applicable_trust_resol = $req->applicable_trust_resol;
        $property->notes_trust_resol = $req->notes_trust_resol;
        $property->applicable_orig_rec_at_ho = $req->applicable_orig_rec_at_ho;
        $property->notes_orig_recho = $req->notes_orig_recho;
        $property->photos_and_video_notes = $req->photos_and_video_notes;
        $property->other_notes = $req->other_notes;
        $property->additional_information = $req->additional_information;


         if ($req->file('other_files')) {
            $extension = $req->file('other_files')->extension();
            $filename = 'p1_'.time().'.'.$extension;
            $req->file('other_files')->move(public_path('profiles'), $filename);
            $property->other_files = $filename;

        } else {
            $property->other_files = $property->other_files;
        }

        if ($req->file('file_tvc')) {
            $extension = $req->file('file_tvc')->extension();
            $filename = 'p2_'.time().'.'.$extension;
            $req->file('file_tvc')->move(public_path('profiles'), $filename);
            $property->file_tvc = $filename;
        } else {
            $property->file_tvc = $property->file_tvc;
        }

        if ($req->file('file_khata')) {
            // dd($req->file('file_khata'));
            $extension = $req->file('file_khata')->extension();
            $filename = 'p3_'.time().'.'.$extension;
            $req->file('file_khata')->move(public_path('profiles'), $filename);
            $property->file_khata = $filename;

        } else {
            $property->file_khata = $property->file_khata;
        }

        if ($req->file('file_patta')) {
            $extension = $req->file('file_patta')->extension();
            $filename = 'p4_'.time().'.'.$extension;
            $req->file('file_patta')->move(public_path('profiles'), $filename);
            $property->file_patta = $filename;
        } else {
            $property->file_patta =  $property->file_patta;
        }

        if ($req->file('file_encumburance')) {
            $extension = $req->file('file_encumburance')->extension();
            $filename = 'p5_'.time().'.'.$extension;
            $req->file('file_encumburance')->move(public_path('profiles'), $filename);
            $property->file_encumburance = $filename;
        } else {
            $property->file_encumburance = $property->file_encumburance;
        }

        if ($req->file('file_survy_sketch')) {
            $extension = $req->file('file_survy_sketch')->extension();
            $filename = 'p6_'.time().'.'.$extension;
            $req->file('file_survy_sketch')->move(public_path('profiles'), $filename);
            $property->file_survy_sketch = $filename;
        } else {
            $property->file_survy_sketch =  $property->file_survy_sketch;
        }

        if ($req->file('file_soiltest')) {
            $extension = $req->file('file_soiltest')->extension();
            $filename = 'p7_'.time().'.'.$extension;
            $req->file('file_soiltest')->move(public_path('profiles'), $filename);
            $property->file_soiltest = $filename;
        } else {
            $property->file_soiltest = $property->file_soiltest;
        }

        if ($req->file('file_ele_cls')) {
            $extension = $req->file('file_ele_cls')->extension();
            $filename = 'p8_'.time().'.'.$extension;
            $req->file('file_ele_cls')->move(public_path('profiles'), $filename);
            $property->file_ele_cls = $filename;
        } else {
            $property->file_ele_cls = $property->file_ele_cls;
        }

        if ($req->file('file_constr_appro')) {
            $extension = $req->file('file_constr_appro')->extension();
            $filename = 'p9_'.time().'.'.$extension;
            $req->file('file_constr_appro')->move(public_path('profiles'), $filename);
            $property->file_constr_appro = $filename;
        } else {
            $property->file_constr_appro = $property->file_constr_appro;
        }

        if ($req->file('file_tax_cls')) {
            $extension = $req->file('file_tax_cls')->extension();
            $filename = 'p10_'.time().'.'.$extension;
            $req->file('file_tax_cls')->move(public_path('profiles'), $filename);
            $property->file_tax_cls = $filename;
        } else {
            $property->file_tax_cls = $property->file_tax_cls;
        }

        if ($req->file('file_forest_cls')) {
            $extension = $req->file('file_forest_cls')->extension();
            $filename = 'p11_'.time().'.'.$extension;
            $req->file('file_forest_cls')->move(public_path('profiles'), $filename);
            $property->file_forest_cls = $filename;
        } else {
            $property->file_forest_cls = $property->file_forest_cls;
        }

        if ($req->file('file_court_docs')) {
            $extension = $req->file('file_court_docs')->extension();
            $filename = 'p12_'.time().'.'.$extension;
            $req->file('file_court_docs')->move(public_path('profiles'), $filename);
            $property->file_court_docs = $filename;
        } else {
            $property->file_court_docs = $property->file_court_docs;
        }

        if ($req->file('file_overall_legal_cls')) {
            $extension = $req->file('file_overall_legal_cls')->extension();
            $filename = 'p13_'.time().'.'.$extension;
            $req->file('file_overall_legal_cls')->move(public_path('profiles'), $filename);
            $property->file_overall_legal_cls = $filename;
        } else {
            $property->file_overall_legal_cls =  $property->file_overall_legal_cls;
        }

        if ($req->file('file_trust_resol')) {
            $extension = $req->file('file_trust_resol')->extension();
            $filename = 'p14_'.time().'.'.$extension;
            $req->file('file_trust_resol')->move(public_path('profiles'), $filename);
            $property->file_trust_resol = $filename;
        } else {
            $property->file_trust_resol =  $property->file_trust_resol;
        }

        if ($req->file('file_orig_recho')) {
            $extension = $req->file('file_orig_recho')->extension();
            $filename = 'p15_'.time().'.'.$extension;
            $req->file('file_orig_recho')->move(public_path('profiles'), $filename);
            $property->file_orig_recho = $filename;
        } else {
            $property->file_orig_recho = $property->file_orig_recho;
        }

        if ($req->file('photos_and_videos')) {
            $extension = $req->file('photos_and_videos')->extension();
            $filename = 'p16_'.time().'.'.$extension;
            $req->file('photos_and_videos')->move(public_path('profiles'), $filename);
            $property->photos_and_videos = $filename;
        } else {
            $property->photos_and_videos = $property->photos_and_videos;
        }



        $property->save();
        session()->put('success','Property Updated');

        return redirect('/properties');
     }

     function create_state(Request $req)
     {
        if (str_contains($req->state, 'script')) { session()->flush(); return redirect('login');}

        $check_name = States::where('name',$req->name)->first();
        if ($check_name) {

            session()->put('failed','Apex already exists');
            return redirect()->back();
        }

         $state = new States;
                 if (Session::get('rexkod_apex_user_type') == "hq") {
                        $state->name= $req->state;
                        $state->save();
                        return redirect('/states');
                        session()->put('success','Apex Added');

                 } else {
                        return redirect('/access_denied');
                 }
     }


     function create_document_type(Request $req)
     {
        if (str_contains($req->document, 'script')) { session()->flush(); return redirect('login');}

        $check_name = Document_types::where('name',$req->name)->first();
        if ($check_name) {

            session()->put('failed','Document type already exists');
            return redirect()->back();
        }

         $dc = new Document_types;
          if (Session::get('rexkod_apex_user_type') == "hq") {
             $dc->name= $req->document;
             $dc->save();
            session()->put('success','Document Added');

             return redirect('/document_types');
      } else {
              return redirect('/access_denied');
      }

     }

     function create_incident_types(Request $req)
     {
        if (str_contains($req->incident_type, 'script')) { session()->flush(); return redirect('login');}

        $check_name = Incident_types::where('name',$req->name)->first();
        if ($check_name) {

            session()->put('failed','Incident type already exists');
            return redirect()->back();
        }

         $it = new Incident_types;


         if (Session::get('rexkod_apex_user_type') == "hq") {
             $it->name= $req->incident_type;
             $it->save();
             return redirect('/incident_types');
            session()->put('success','Incident Added');

      } else {
             return redirect('/access_denied');
      }
     }

     function create_ticket_types(Request $req)
     {
        if (str_contains($req->ticket_type, 'script')) { session()->flush(); return redirect('login');}

        $check_name = Ticket_types::where('name',$req->name)->first();
        if ($check_name) {

            session()->put('failed','Ticket type already exists');
            return redirect()->back();
        }

         $tt = new Ticket_types;
         if (Session::get('rexkod_apex_user_type') == "hq") {
             $tt->name= $req->ticket_type;
             $tt->save();
             return redirect('/ticket_types');
            session()->put('success','Ticket Added');

      } else {
              return redirect('/access_denied');
      }

     }

     function main()
     {
         $subcategory = Subcategory::all();
         $compliances = Compliances::all();
         $category = Category::all();
        // $fields = DB::select("SELECT DISTINCT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = 'assets'"); //som

         $fields = DB::table('information_schema.COLUMNS')
                ->select('COLUMN_NAME')
                ->distinct()
                ->where('TABLE_NAME', 'assets')
                ->get();


        //  $fields = $this->pageModel->get_asset_fields();

         $data = [
             'subcategory' => $subcategory,
             'category' => $category,
             'fields' => $fields,
             'compliances' => $compliances,
         ];
         return view('main',['data' => $data]);

     }

    function create_category(Request $req)
    {
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $check_name = Category::where('name',$req->name)->first();
        if ($check_name) {

            session()->put('failed','Category already exists');
            return redirect()->back();
        }

        $name= $req->name;


            $cat = new Category;
            $cat->name= $name;
            $cat->save();
            session()->put('success','Category Added');

            return redirect('/category_ds');


    }

    function create_subcategory(Request $req)
    {
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

            $name = $req->name;
            $category_id = $req->category_id;
            if(isset($req->fields)){
            $fields = $req->fields;
            $fields = implode(',', $fields);
            }
            else{
                $fields = NULL;
            }
            if(isset($req->compliances)){
            $compliances = $req->compliances;
            $compliances = implode(',', $compliances);
            }
            else{
                $compliances = NULL;
            }


            // $fields = DB::table('assign_fields')->select($fields)->get();


            $subcategory=new Subcategory;
            $subcategory->name=$name;
            $subcategory->category_id=$category_id;
            $subcategory->fields=$fields;
            $subcategory->compliances=$compliances;
            $subcategory->save();
            session()->put('success','Subcategory Added');


            return redirect('/subcategory_ds');


    }

    function create_compliance(Request $req)
    {
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        $check_name = Compliances::where('name',$req->name)->first();
        if ($check_name) {

            session()->put('failed','Compliance already exists');
            return redirect()->back();
        }

        $name = $req->name;

            $comp = new Compliances;
            $comp->name = $name;
            $comp->save();
            session()->put('success','Compliance Added');

            return redirect('/compliance_ds');


    }

    function assign_asset(Request $req)
    {
        $user_id = $req->user_id;
        // $building_id = $_POST['building_id'];
        // $cabin_id = $_POST['cabin_id'];

        $remark = $req->remark;
        $asset_id = $req->asset_id;
        // dd($req->asset_id);


            $asset = Assets::where('id',$asset_id)->first();

            $from_user_id = $asset->user_id;



            $asset->user_id=$user_id;
            $asset->save();

            $user = Auth::where('id',$user_id)->first();

            $new_assign= new Assigns;
            $new_assign->asset_id =$asset_id;
            $new_assign->user_id =$user_id;
            $new_assign->from_user_id =$from_user_id;
            $new_assign->location_id =$user->location_id;
            $new_assign->assign_remark =$remark;
            $new_assign->save();

            $assign = Assigns::where('asset_id',$asset_id)->first();
            $assign->status=0;
            $assign->save();

            $type = "assign";
            $manager_id = $user->manager_id;
            $notification = $asset->name . " is assigned to you. Did you receive it?";
            $notify= new Notifications;

            $notify->type= $type;
            $notify->user_id= $user_id;
            $notify->manager_id= $manager_id;
            $notify->asset_id= $asset_id;
            $notify->notification= $notification;
            $notify->save();

            session()->put('success','Asset Assigned');

            return redirect('/all_assets');

    }

    function transfer_asset($id,Request $req)
    {
        $user_id = $req->user_id;
        $remark = $req->remark;
        $asset_id = $id;

            $asset = Assets::where('id',$asset_id)->first();

            $from_user_id = $asset->user_id;
            $assign = Assigns::where('asset_id',$id)->first();
            $assign->status=$assign->id;
            $assign->save();

            $asset->user_id=$user_id;
            $asset->save();


            $user = Assets::where('user_id',$user_id)->first();


            $new_assign= new Assigns;
            $new_assign->asset_id =$asset_id;
            $new_assign->user_id =$user_id;
            $new_assign->from_user_id =$from_user_id;
            if(isset($new_assign->location_id)){$new_assign->location_id =$user->location_id;}
            $new_assign->assign_remark =$remark;
            $new_assign->save();

            $type = "assign";
            $notification = $asset->name . " is trasffered to you. Did you receive it?";

            $notify= new Notifications;

            $notify->type= $type;
            $notify->user_id= $user_id;
            $notify->manager_id= NULL;
            $notify->asset_id= $asset_id;
            $notify->notification= $notification;
            $notify->save();


            session()->put('success','Asset Assigned');

            return redirect('asset/' . $id);

    }

    function create_ticket($id,Request $req)
    {

        if(isset($req->document)){
            $extension = $req->file('document')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'c_'.time().'.'.$extension;
                    $req->file('document')->move(public_path('profiles'), $filename);
                    $document = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $document = NULL;
            }

        $asset_id = $id;
        $type = $req->type;
        $user_id = Session('rexkod_apex_user_id');
        $document_type = $req->document_type;
        $request_remark = $req->remark;


            $tickets= new Tickets;

            $tickets->type = $type;
            $tickets->asset_id = $asset_id;
            $tickets->user_id = $user_id;
            $tickets->document_type = $document_type;
            $tickets->document =  $document;
            $tickets->request_remark = $request_remark;
            $tickets->save();


            $asset = Assets::where('id',$asset_id)->first();

            $ntype = "ticket";
            $nuser_id = $asset->owner_id;
            $notification = $asset->name . " has a ticket. Check Tickets Page for details.";

            $notify= new Notifications;

            $notify->type= $ntype;
            $notify->user_id= $nuser_id;
            $notify->manager_id= NULL;
            $notify->asset_id= $asset_id;
            $notify->notification= $notification;
            $notify->save();



            session()->put('success','Ticket Created');

            return redirect('asset/' . $asset_id);

    }

    function create_incident($id,Request $req)
    {
        if(isset($req->document)){
            $extension = $req->file('document')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('document')->move(public_path('profiles'), $filename);
                    $document = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $document = NULL;
            }

        $asset_id = $id;
        $type = $req->type;
        $user_id = Session('rexkod_apex_user_id');
        $document_type = $req->document_type;
        $request_remark = $req->remark;


            $incident=new Incidents;
            $incident->type=$type;
            $incident->asset_id=$asset_id;
            $incident->user_id=$user_id;
            $incident->document_type=$document_type;
            $incident->document=$document;
            $incident->request_remark=$request_remark;
            $incident->save();


            $asset = Assets::where('id',$asset_id)->first();

            $ntype = "incident";
            $nuser_id = $asset->owner_id;
            $notification = $asset->name . " has an Incident. Check Tickets Page for details.";

            $notify= new Notifications;
            $notify->type= $ntype;
            $notify->user_id= $nuser_id;
            $notify->manager_id= NULL;
            $notify->asset_id= $asset_id;
            $notify->notification= $notification;
            $notify->save();


            session()->put('success','Incident Reported');

            return redirect('asset/' . $asset_id);

    }

    function create_single_asset_audit($audit_id, $asset_id,Request $req)
    {
        if (str_contains($req->notes, 'script')) { session()->flush(); return redirect('login');}


        if(isset($req->file)){
            $extension = $req->file('file')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('file')->move(public_path('profiles'), $filename);
                    $audit_file = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $audit_file = NULL;
            }


            $audit_file =  $audit_file;
            $notes = $req->notes;
            $initial_condition = $req->initial_condition;
            $audit_id = $audit_id;
            $asset_id = $asset_id;

            $add_single_audit_progress = new Asset_audits;
            $add_single_audit_progress->audit_file = $audit_file;
            $add_single_audit_progress->notes = $notes;
            $add_single_audit_progress->initial_condition = $initial_condition;
            $add_single_audit_progress->audit_id = $audit_id;
            $add_single_audit_progress->asset_id = $asset_id;
            $add_single_audit_progress->save();



            session()->put('success','Assets Audit has been added successfully!');
            return redirect('update_asset_audits/' . $audit_id);

    }

    function update_asset_audits($id,Request $req)
    {
        if (str_contains($req->notes, 'script')) { session()->flush(); return redirect('login');}

        $get_audit_master = Asset_audit_master::where('id',$id)->first();

        $data = [
            'audits' => $get_audit_master,
            'audit_id' => $id,
        ];

        return view('/update_asset_audits',['data' => $data]);
    }

    function update_single_asset_audit($audit_id, $asset_id,Request $req)
    {
        if (str_contains($req->notes, 'script')) { session()->flush(); return redirect('login');}

        $get_from_audits =  Property_audits::where('audit_id',$audit_id)
        ->where('property_id',$asset_id)
        ->first();


        if(isset($req->file)){
            $extension = $req->file('file')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('file')->move(public_path('profiles'), $filename);
                    $audit_file = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                if(isset($get_from_audits->audit_file)){
                    $audit_file = $get_from_audits->audit_file;
                }
                else{
                    $audit_file = NULL;
                }
            }


                $audit_file =  $audit_file;
                $notes = $req->notes;
                $initial_condition = $req->initial_condition;
                $audit_id = $audit_id;
                $asset_id = $asset_id;


                $update_single_audit_progress =  Asset_audits::where('audit_id',$audit_id)
                ->where('asset_id',$asset_id)
                ->first();

                $update_single_audit_progress->audit_id= $audit_id;
                $update_single_audit_progress->asset_id= $asset_id;
                $update_single_audit_progress->notes= $notes;
                $update_single_audit_progress->audit_file =$audit_file ;
                $update_single_audit_progress->initial_condition =$initial_condition ;
                $update_single_audit_progress->save();


                session()->put('success','Assets Audit has been updated successfully!');

                return redirect('update_asset_audits/' . $audit_id);

    }

    function change_asset_audit_final_status($id, $pending_audit)
    {
        // echo $pending_audit;
        // die();
        if ($pending_audit == 1) {
            session()->put('failed','Please update all the remaining audits above before Finalizing the audits!');

            return redirect('update_asset_audits/' . $id);
            die();
        }

            $change_audit_status = Asset_audit_master::find($id);
            $change_audit_status->status='2';
            $change_audit_status->save();



            session()->put('success','Audit Status changed to Completed!');

            return redirect('/asset_audits');


    }

    public function getCategory(Request $request)
    {
        $subcategory = DB::table('subcategory')
            ->where('category_id', $request->category_id)
            ->get();
        if (count($subcategory) > 0) {
            return response()->json($subcategory);
        }
    }

    function create_asset(Request $req)
    {
        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->qr, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->email, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->city, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->district, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->state, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->document_type, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->registration_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->serial_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->insurance_policy_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->license_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->certificate_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->document_reference_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->asset_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->bank_account_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->bank_ifsc_code, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->bank_address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->account_name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->invoice_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->po_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->cheque_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->receipt_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->challan_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->transaction_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->donation_in_rupees, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->event_id, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->project, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->type_of_property, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->type_of_acquisition, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->tenure, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->land_area, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->buildings, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->wdv, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->receipt_via, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->file_no, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->purpose, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->comments_remarks, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->remarks, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->assigned_staff, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->transferred_for, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->incident_type, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->police_fir, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->asset_condition_as_on_date, 'script')) { session()->flush(); return redirect('login');}

        $start_compliance_date = '';
        $end_compliance_date = '';
        $prefix = $prefix1 = $start_compliance_date = $end_compliance_date = '';
        $get_all_compliances = Compliances::all();

        // foreach ($get_all_compliances as $compliances) {
        //     $compliance_id = $compliances->id;
        //     if (isset($_POST['s_' . $compliance_id])) {
        //         $start_compliance_date .= $prefix . '"' . $_POST['s_' . $compliance_id] . '"';
        //         $prefix = ', ';
        //         $end_compliance_date .= $prefix1 . '"' . $_POST['e_' . $compliance_id] . '"';
        //         $prefix1 = ', ';
        //     }
        // }


        if(isset($req->image)){
            $extension = $req->file('image')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('image')->move(public_path('profiles'), $filename);
                    $image = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $image = NULL;
            }


        if(isset($req->upload)){
            $extension = $req->file('upload')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('upload')->move(public_path('profiles'), $filename);
                    $upload = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $upload = NULL;
            }


        $subcat = $req->subcategory_id;
        $subcategory = Subcategory::where('id',$subcat)->first();

        function check_isset($var)
        {
            if (isset($var)) {
                return $var;
            } else {
                return Null;
            }
        }
            $asset_new= new Assets;
            $temp_id = md5(uniqid(rand(), true));
            $category_cur = Category::where('id',$subcategory->category_id)->first();
            $code = strtoupper(substr($category_cur->name, 0, 2));


            $asset_new->temp_id = $temp_id;
            $asset_new->code = $code;
            $asset_new->subcategory_id = $subcategory->id;
            $asset_new->category_id = $subcategory->category_id;
            $asset_new->image = $image;
            $asset_new->owner_id = Session('rexkod_apex_user_id');
            $asset_new->user_id = Session('rexkod_apex_user_id');
            $asset_new->type = check_isset($req->type);
            $asset_new->name = check_isset($req->name);
            $asset_new->document_type = check_isset($req->document_type);
            $asset_new->registration_number = check_isset($req->registration_number);
            $asset_new->registration_date = check_isset($req->registration_date);
            $asset_new->insurance_policy_number = check_isset($req->insurance_policy_number);
            $asset_new->license_number = check_isset($req->license_number);
            $asset_new->certificate_number = check_isset($req->certificate_number);
            $asset_new->document_reference_number = check_isset($req->document_reference_number);
            $asset_new->asset_number = check_isset($req->asset_number);
            $asset_new->bank_account_number = check_isset($req->bank_account_number);
            $asset_new->bank_ifsc_code = check_isset($req->bank_ifsc_code);
            $asset_new->bank_address = check_isset($req->bank_address);
            $asset_new->account_name = check_isset($req->account_name);
            $asset_new->invoice_number = check_isset($req->invoice_number);
            $asset_new->po_number = check_isset($req->po_number);
            $asset_new->receipt_number = check_isset($req->receipt_number);
            $asset_new->donation_mode = check_isset($req->donation_mode);
            $asset_new->transaction_number = check_isset($req->transaction_number);
            $asset_new->donation_in_rupees = check_isset($req->donation_in_rupees);
            $asset_new->event_id = check_isset($req->event_id);
            $asset_new->type_of_property = check_isset($req->type_of_property);
            $asset_new->type_of_acquisition = check_isset($req->type_of_acquisition);
            $asset_new->qr = check_isset($req->qr);
            $asset_new->validity = check_isset($req->validity);
            $asset_new->tenure = check_isset($req->tenure);
            $asset_new->land_area = check_isset($req->land_area);
            $asset_new->cost_to_trust = check_isset($req->cost_to_trust);
            $asset_new->buildings = check_isset($req->buildings);
            $asset_new->wdv = check_isset($req->wdv);
            $asset_new->original_documents = check_isset($req->original_documents);
            $asset_new->receipt_date = check_isset($req->receipt_date);
            $asset_new->receipt_via = check_isset($req->receipt_via);
            $asset_new->file_no = check_isset($req->file_no);
            $asset_new->purpose = check_isset($req->purpose);
            $asset_new->remark = check_isset($req->remark);
            $asset_new->initial_condition = check_isset($req->initial_condition);
            $asset_new->challan_number = check_isset($req->challan_number);
            $asset_new->cheque_number = check_isset($req->cheque_number);
            //$asset_new->start_compliance_date = $start_compliance_date;
            //$asset_new->end_compliance_date = $end_compliance_date;
            $asset_new->upload = $upload;
            $asset_new->address = $req->address;
            $asset_new->city = $req->city;
            $asset_new->state = $req->state;
            $asset_new->pincode = $req->pincode;
            $asset_new->serial_number = $req->serial_number;


            $asset_new->save();
            $asset_id_temp = Assets::where('temp_id',$temp_id)->first();
            $asset_id= $asset_id_temp->id;

            $flag = 0;
            foreach ($get_all_compliances as $compliances) {
                // $count++;
                $flag = 1;

                $variable=$req->input('s_' . $compliances->id);

                if (!empty($variable)) {


                    $compliance_file=$req->input('f_' . $compliances->id);
                    if(isset($compliance_file)){
                        $extension = $req->file($compliance_file)->extension();
                        if(isset($extension)){

                            if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                                $filename = '_'.time().'.'.$extension;
                                $req->file('upload')->move(public_path('profiles'), $filename);
                                $compliance_file = $filename;
                            } else {
                                session()->put('failed','Invalid Image File');
                                return redirect()->back();
                            }
                        }}
                        else {
                            $compliance_file = NULL;
                        }


                    $start_date = $req->input('s_' . $compliances->id);


                    $end_date  = $req->input('e_' . $compliances->id);

                    $add_dependency  = new Dependencies;
                    $add_dependency->asset_id  = $asset_id;
                    $add_dependency->start_date  = $start_date;
                    $add_dependency->end_date  = $end_date;
                    $add_dependency->compliance_id  = $compliances->id;
                    $add_dependency->file  = $compliance_file;
                    $add_dependency->save();


                }
                // if ($flag == 1) {
                //     $add_dependency  = true;
                // } else {
                //     $add_dependency = true;
                // }
            }



            session()->put('success','Asset Created');

            return redirect('/all_assets');

    }

    public function update_asset($asset_id,Request $req)
    {

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->qr, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->email, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->city, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->district, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->state, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->document_type, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->registration_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->serial_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->insurance_policy_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->license_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->certificate_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->document_reference_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->asset_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->bank_account_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->bank_ifsc_code, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->bank_address, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->account_name, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->invoice_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->po_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->cheque_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->receipt_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->challan_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->transaction_number, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->donation_in_rupees, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->event_id, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->project, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->type_of_property, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->type_of_acquisition, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->tenure, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->land_area, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->buildings, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->wdv, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->receipt_via, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->file_no, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->purpose, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->comments_remarks, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->remarks, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->assigned_staff, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->transferred_for, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->incident_type, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->police_fir, 'script')) { session()->flush(); return redirect('login');}
        if (str_contains($req->asset_condition_as_on_date, 'script')) { session()->flush(); return redirect('login');}

        $get_asset = Assets::where('id',$asset_id)->first();

        $get_all_compliances = Compliances::all();
        // foreach ($get_all_compliances as $compliances) {
        //     $compliance_id = $compliances->id;
        //     if (isset($_POST['s_' . $compliance_id])) {
        //         $start_compliance_date .= $prefix . '"' . $_POST['s_' . $compliance_id] . '"';
        //         $prefix = ', ';
        //         $end_compliance_date .= $prefix1 . '"' . $_POST['e_' . $compliance_id] . '"';
        //         $prefix1 = ', ';
        //     }
        // }


        if(isset($req->image)){
            $extension = $req->file('image')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('image')->move(public_path('profiles'), $filename);
                    $image = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $image =  $get_asset->image;
            }


        $subcat =$req->subcategory_id;
        $subcategory =  Subcategory::where('id',$subcat)->first();
        $type = $req->type;


        function check_isset1($var)
        {
            if (isset($var)) {
                return $var;
            } else {
                return Null;
            }
        }



            $asset_update = Assets::find($asset_id);
            // dd($asset_id);
            $asset_update->subcategory_id = $subcategory->id;
            $asset_update->category_id = $subcategory->category_id;
            $asset_update->image = $image;
            $asset_update->type = $req->type;
            $asset_update->name = check_isset1($req->name);
            $asset_update->document_type = check_isset1($req->document_type);
            $asset_update->registration_number = check_isset1($req->registration_number);
            $asset_update->registration_date = check_isset1($req->registration_date);
            $asset_update->insurance_policy_number = check_isset1($req->insurance_policy_number);
            $asset_update->license_number = check_isset1($req->license_number);
            $asset_update->certificate_number = check_isset1($req->certificate_number);
            $asset_update->document_reference_number = check_isset1($req->document_reference_number);
            $asset_update->asset_number = check_isset1($req->asset_number);
            $asset_update->bank_account_number = check_isset1($req->bank_account_number);
            $asset_update->bank_ifsc_code = check_isset1($req->bank_ifsc_code);
            $asset_update->bank_address = check_isset1($req->bank_address);
            $asset_update->account_name = check_isset1($req->account_name);
            $asset_update->invoice_number = check_isset1($req->invoice_number);
            $asset_update->po_number = check_isset1($req->po_number);
            $asset_update->receipt_number = check_isset1($req->receipt_number);
            $asset_update->donation_mode = check_isset1($req->donation_mode);
            $asset_update->transaction_number = check_isset1($req->transaction_number);
            $asset_update->donation_in_rupees = check_isset1($req->donation_in_rupees);
            $asset_update->event_id = check_isset1($req->event_id);
            $asset_update->type_of_property = check_isset1($req->type_of_property);
            $asset_update->type_of_acquisition = check_isset1($req->type_of_acquisition);
            $asset_update->qr = check_isset1($req->qr);
            $asset_update->validity = check_isset1($req->validity);
            $asset_update->tenure = check_isset1($req->tenure);
            $asset_update->land_area = check_isset1($req->land_area);
            $asset_update->cost_to_trust = check_isset1($req->cost_to_trust);
            $asset_update->buildings = check_isset1($req->buildings);
            $asset_update->wdv = check_isset1($req->wdv);
            $asset_update->original_documents = check_isset1($req->original_documents);
            $asset_update->receipt_date = check_isset1($req->receipt_date);
            $asset_update->receipt_via = check_isset1($req->receipt_via);
            $asset_update->file_no = check_isset1($req->file_no);
            $asset_update->purpose = check_isset1($req->purpose);
            $asset_update->remark = check_isset1($req->remark);
            $asset_update->initial_condition = check_isset1($req->initial_condition);

            $asset_update->address = $req->address;
            $asset_update->city = $req->city;
            $asset_update->state = $req->state;
            $asset_update->pincode = $req->pincode;
            $asset_update->save();

            $flag = 0;
            foreach ($get_all_compliances as $compliances) {
                // $count++;
                $flag = 1;
               $variable=$req->input('s_' . $compliances->id);

                if (!empty($variable)) {


                    $compliance_file=$req->input('f_' . $compliances->id);
                    if(isset($compliance_file)){
                        $extension = $req->file($compliance_file)->extension();
                        if(isset($extension)){

                            if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                                $filename = '_'.time().'.'.$extension;
                                $req->file('upload')->move(public_path('profiles'), $filename);
                                $compliance_file = $filename;
                            } else {
                                session()->put('failed','Invalid Image File');
                                return redirect()->back();
                            }
                        }}
                        else {
                            $compliance_file = NULL;
                        }

                    $start_date = $req->input('s_' . $compliances->id);

                    $end_date  = $req->input('e_' . $compliances->id);

                    $add_dependency  = new Dependencies;
                    $add_dependency->asset_id  = $asset_id;
                    $add_dependency->start_date  = $start_date;
                    $add_dependency->end_date  = $end_date;
                    $add_dependency->compliance_id  = $compliances->id;
                    $add_dependency->file  = $compliance_file;
                    $add_dependency->save();


                    // $flag = 1;
                }
            }

            session()->put('success','Asset Updated');
            return redirect('/edit_asset/' . $type . '/' . $asset_id);

    }

    function change_property_audit_status($id)
    {
        Property_audit_master::where('id', $id)->update(['status' => 1]);



            session()->put('success','Audit Status Changed to Proccessing!');

            return redirect('/update_property_audits/' . $id);

    }

    function update_property_audits($id)
    {
        $get_audit_master = Property_audit_master::where('id',$id)->first();

        $data = [
            'audits' => $get_audit_master,
            'audit_id' => $id,
        ];

        return view('/update_property_audits',['data' => $data]);

    }


    function create_single_property_audit($audit_id, $property_id,Request $req)
    {
        if (str_contains($req->notes, 'script')) { session()->flush(); return redirect('login');}


        if(isset($req->file)){
            $extension = $req->file('file')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('file')->move(public_path('profiles'), $filename);
                    $audit_file = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $audit_file = NULL;
            }


            $audit_file =  $audit_file;
            $notes = $req->notes;
            $initial_condition = $req->initial_condition;
            $audit_id = $audit_id;
            $property_id = $property_id;


            $add_single_audit_progress = new Property_audits;
            $add_single_audit_progress->audit_file = $audit_file;
            $add_single_audit_progress->notes = $notes;
            $add_single_audit_progress->initial_condition = $initial_condition;
            $add_single_audit_progress->audit_id = $audit_id;
            $add_single_audit_progress->property_id = $property_id;
            $add_single_audit_progress->save();



            session()->put('success','Property Audit has been added successfully!');
            return redirect('/update_property_audits/' . $audit_id);


    }

    public function access_denied()
    {

        return view('/access_denied');

    }


    function update_single_property_audit($audit_id, $property_id,Request $req)
    {
        if (str_contains($req->notes, 'script')) { session()->flush(); return redirect('login');}

        $get_from_audits =  Property_audits::where('audit_id',$audit_id)
        ->where('property_id',$property_id)
        ->first();


        if(isset($req->file)){
            $extension = $req->file('file')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'i_'.time().'.'.$extension;
                    $req->file('file')->move(public_path('profiles'), $filename);
                    $audit_file = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                if(isset($get_from_audits->audit_file)){
                    $audit_file = $get_from_audits->audit_file;
                }
                else{
                    $audit_file = NULL;
                }
            }


                $audit_file =  $audit_file;
                $notes = $req->notes;
                $initial_condition = $req->initial_condition;
                $audit_id = $audit_id;
                $property_id = $property_id;

                $update_single_audit_progress =  Property_audits::where('audit_id',$audit_id)
                ->where('property_id',$property_id)
                ->first();

                $update_single_audit_progress->audit_id= $audit_id;
                $update_single_audit_progress->property_id= $property_id;
                $update_single_audit_progress->notes= $notes;
                $update_single_audit_progress->audit_file =$audit_file ;
                $update_single_audit_progress->initial_condition =$initial_condition ;
                $update_single_audit_progress->save();


                session()->put('success','Property Audit has been updated successfully!');

                return redirect('/update_property_audits/' . $audit_id);


    }


    function change_property_audit_final_status($id, $pending_audit)
    {
        // echo $pending_audit;
        // die();
        if ($pending_audit == 1) {
            session()->put('failed','Please update all the remaining audits above before Finalizing the audits!');

            return redirect('update_property_audits/' . $id);
            die();
        }
            $change_audit_status = Property_audit_master::find($id);
            $change_audit_status->status='2';
            $change_audit_status->save();

            session()->put('success','Property Status changed to Completed!');

            return redirect('/property_audits');


    }

     function create_ticket_response($id,Request $req)
    {
        if (str_contains($req->response_remark, 'script')) { session()->flush(); return redirect('login');}

        if(isset($req->document)){
            $extension = $req->file('document')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'b_'.time().'.'.$extension;
                    $req->file('document')->move(public_path('profiles'), $filename);
                    $document = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $document = NULL;
            }

            $response_remark = $req->response_remark;

            $create_ticket_response = Tickets::find($id);
            $create_ticket_response->response_user_id = Session('rexkod_apex_user_id');
            $create_ticket_response->response_document = $document;
            $create_ticket_response->response_remark = $response_remark;
            $create_ticket_response->status = '2';
            $create_ticket_response->response_datetime = date('Y-m-d H:i:s');
            $create_ticket_response->save();



            $ticket = Tickets::find($id);

            $asset = Assets::find($ticket->asset_id);

            $ntype = "ticket_response";
            $nuser_id = $ticket->user_id;
            $notification = "You have a response on your ticket for " . $asset->name . ". Check Asset Page for details.";


            $notify = new Notifications;
            $notify->type = $ntype;
            $notify->user_id = $nuser_id;
            $notify->manager_id = NULL;
            $notify->asset_id = $asset->id;
            $notify->notification = $notification;
            $notify->save();
            session()->put('success','Response Added');

            return redirect('/ticket/'. $id);


    }


    function create_incident_response($id,Request $req)
    {
        if (str_contains($req->response_remark, 'script')) { session()->flush(); return redirect('login');}


        if(isset($req->document)){
            $extension = $req->file('document')->extension();
            if(isset($extension)){

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                    $filename = 'b_'.time().'.'.$extension;
                    $req->file('document')->move(public_path('profiles'), $filename);
                    $document = $filename;
                } else {
                    session()->put('failed','Invalid Image File');
                    return redirect()->back();
                }
            }}
            else {
                $document = NULL;
            }

            $response_remark = $req->response_remark;


            $create_incident_response = Incidents::find($id);
            $create_incident_response->response_user_id = Session('rexkod_apex_user_id');
            $create_incident_response->response_document = $document;
            $create_incident_response->response_remark = $response_remark;
            $create_incident_response->status = '2';
            $create_incident_response->response_datetime = date('Y-m-d H:i:s');
            $create_incident_response->save();


            $incident =  Incidents::find($id);

            $asset = Assets::find($incident->asset_id);


            $ntype = "incident_response";
            $nuser_id = $incident->user_id;
            $notification = "You have a response on your Incident for " . $asset->name . ". Check Asset Page for details.";

            $notify = new Notifications;
            $notify->type = $ntype;
            $notify->user_id = $nuser_id;
            $notify->manager_id = NULL;
            $notify->asset_id = $asset->id;
            $notify->notification = $notification;
            $notify->save();

            session()->put('success','Response Added');

            return redirect('/incident/' . $id);

    }


    public function assign_response($nid, $aid, $status)
    {

            $assigns = Assigns::where('asset_id',$aid)->first();
            $assigns->status =$status;
            $assigns->save();



            $notifications = Notifications::where('id',$nid)->first();
            $notifications->action = '1';
            $notifications->save();

            session()->put('success','Response Updated');

            return redirect('/notifications');

    }

    function update_notification($notification_id, $status)
    {
        $notify = Notifications::find($notification_id);
        $notify->status=$status;
        $notify->save();

        return redirect('/index');
    }


    function category_ds()
    {

        $category = Category::orderBy('id', 'desc')->get();

        $data = [
            'category' => $category,
        ];

        return view('category_ds', ['data' => $data]);
    }

    function compliance_ds()
    {

        $compliance = Compliances::orderBy('id', 'desc')->get();

        $data = [
            'compliance' => $compliance,
        ];

        return view('compliance_ds', ['data' => $data]);
    }

    function assign_fields()
    {

        $assign_fields = Assign_field::orderBy('id', 'desc')->get();

        $data = [
            'assign_fields' => $assign_fields,
        ];

        return view('assign_fields', ['data' => $data]);
    }

    function create_fields(Request $req)
    {

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $name= $req->name;


            $cat = new Assign_field;
            $cat->fields= $name;
            $cat->save();
            return redirect('/assign_fields');
    }

    function subcategory_ds()
    {
       $fields = DB::table('information_schema.COLUMNS')
                ->select('COLUMN_NAME')
                ->distinct()
                ->where('TABLE_NAME', 'assets')
                ->get();

        $subcategory = Subcategory::orderBy('id', 'desc')->get();
        $category = Category::orderBy('id', 'desc')->get();
        $compliances = Compliances::orderBy('id', 'desc')->get();

        $data = [
            'subcategory' => $subcategory,
            'fields' => $fields,
            'category' => $category,
            'compliances' => $compliances,
        ];

        return view('subcategory_ds', ['data' => $data]);
    }

    function edit_compliance($id)
    {

        $compliance = Compliances::where('id', $id)->first();

        $data = [
            'compliance' => $compliance,

        ];

        return view('/edit_compliance', ['data' => $data]);
    }

    function update_compliance(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $user=Compliances::find($req->id);

        $user->name = $req->name;

        $user->save();
        session()->put('success','Compliance Updated');
        return redirect('/compliance_ds');

     }

     function edit_category($id)
     {

         $category = Category::where('id', $id)->first();

         $data = [
             'category' => $category,

         ];

         return view('/edit_category', ['data' => $data]);
     }

     function update_category(Request $req){

         if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

         $user=Category::find($req->id);

         $user->name = $req->name;

         $user->save();
         session()->put('success','Category Updated');
         return redirect('/category_ds');

      }
     function delete_category(Request $req){

         Category::destroy($req->id);
         session()->put('success','Category Deleted');
         return redirect('/category_ds');

      }
     function delete_compliance(Request $req){

         Compliances::destroy($req->id);
         session()->put('success','Compliance Deleted');
         return redirect('/compliance_ds');

      }
     function delete_subcategory(Request $req){

         Subcategory::destroy($req->id);
         session()->put('success','Subcategory Deleted');
         return redirect('/subcategory_ds');

      }

      function update_subcategory(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $user=Subcategory::find($req->id);

        $user->name = $req->name;

        $user->save();
        session()->put('success','Subcategory Updated');
        return redirect('/subcategory_ds');

     }


     function update_ticket(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $user=Ticket_types::find($req->id);

        $user->name = $req->name;

        $user->save();
        session()->put('success','Ticket Updated');
        return redirect('/ticket_types');

     }
    function delete_ticket(Request $req){

        Ticket_types::destroy($req->id);
        session()->put('success','Ticket Deleted');
        return redirect('/ticket_types');

     }

     function update_document(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $user=Document_types::find($req->id);

        $user->name = $req->name;

        $user->save();
        session()->put('success','Document Updated');
        return redirect('/document_types');

     }
    function delete_document(Request $req){

        Document_types::destroy($req->id);
        session()->put('success','Document Deleted');
        return redirect('/document_types');

     }
     function update_incident(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $user=Incident_types::find($req->id);

        $user->name = $req->name;

        $user->save();
        session()->put('success','Incident Updated');
        return redirect('/incident_types');

     }
    function delete_incident(Request $req){

        Incident_types::destroy($req->id);
        session()->put('success','Incident Deleted');
        return redirect('/incident_types');

     }
     function update_state(Request $req){

        if (str_contains($req->name, 'script')) { session()->flush(); return redirect('login');}

        $user=States::find($req->id);

        $user->name = $req->name;

        $user->save();
        session()->put('success','Apex Updated');
        return redirect('/states');

     }
    function delete_state(Request $req){

        States::destroy($req->id);
        session()->put('success','Apex Deleted');
        return redirect('/states');

     }




    public function sms_otp($phone,$otp){
    //    echo "hi"; die;

        $user = Auth::where("phone",$phone)->first();
        dd( $user->phone);
        if(isset($user)){
            dd( $user->phone);
        $user->last_otp = $otp;
        $user->save();
        }

        if(isset($user)){
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

    function add_user_upload()
    {
        return view('/add_user_upload');
    }
    function add_asset_upload()
    {
        return view('/add_asset_upload');
    }




    function upload_users(Request $req){
        // dd(empty($req->file('upload')));
        // echo "test";die;
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
         if(!empty($req->file('upload')) && $csvMimes){
        //   echo "test";die;
         if(is_uploaded_file($req->file('upload'))){
        //    echo "test";die;
          $csvFile = fopen($req->file('upload'), 'r');
          fgetcsv($csvFile);
          while(($line = fgetcsv($csvFile)) !== FALSE){
        //    echo "test";die;
                    // Get row line

                $valid = 1;
                $user_id = $line[0];
              //   echo $type;
              //   die();
                $name = $line[1];
                $email = $line[2];
                $type = $line[3];
                $phone = $line[4];
                $state_id = $line[6];
                $location_id = $line[7];
                $manager_id = $line[8];
                $permission = $line[9];
                $status = $line[10];


                $password="admin";

                $user=new Auth;
                $user->user_id=$user_id;
                $user->name=$name;
                $user->email=$email;
                $user->type=$type;
                $user->phone=$phone;
                $user->password= $password;
                $user->state_id= $state_id;
                $user->location_id= $location_id;
                $user->manager_id= $manager_id;
                $user->status=$status;
                $user->permission=$permission;

                $user->save();


            }
                 fclose($csvFile);

           }
        }

                 return redirect('index');
      }


      function upload_asset(Request $req){
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
                $code = $line[1];
                $category_id = $line[2];
                $subcategory_id = $line[3];
                $name = $line[4];
                $document_type = $line[5];
                $registration_number = $line[6];
                $registration_date = $line[7];
                $insurance_policy_number = $line[8];
                $license_number = $line[9];
                $certificate_number = $line[10];
                $document_reference_number = $line[11];
                $asset_number = $line[12];
                $bank_account_number = $line[13];
                $bank_ifsc_code = $line[14];
                $bank_address = $line[15];
                $account_name = $line[16]; // invoice_numer =  $line[17]; missing
                $po_number = $line[17];
                $cheque_number = $line[18];
                $receipt_number = $line[19];
                $challan_number = $line[20];
                $donation_mode = $line[21];
                $transaction_number = $line[22];
                $donation_in_rupees = $line[23];
                $event_id = $line[24];
                $type_of_property = $line[25];
                $type_of_acquisition = $line[26];



                $password="admin";

                $user=new Assets;
                $user->type =$type ;
                $user->code =$code ;
                $user->category_id =$category_id ;
                $user->subcategory_id =$subcategory_id ;
                $user->name =$name ;
                $user->document_type = $document_type ;
                $user->registration_number = $registration_number ;
                $user->registration_date = $registration_date ;
                $user->insurance_policy_number = $insurance_policy_number ;
                $user->license_number =$license_number ;
                $user->certificate_number = $certificate_number ;

                $user->document_reference_number = $document_reference_number;
                $user->asset_number = $asset_number;
                $user->bank_account_number = $bank_account_number;
                $user->bank_ifsc_code = $bank_ifsc_code;
                $user->bank_address = $bank_address;
                $user->account_name = $account_name;
                $user->po_number = $po_number;
                $user->cheque_number = $cheque_number;
                $user->receipt_number = $receipt_number;
                $user->challan_number = $challan_number;
                $user->donation_mode = $donation_mode;
                $user->transaction_number = $transaction_number;
                $user->donation_in_rupees = $donation_in_rupees;
                $user->event_id = $event_id;
                $user->type_of_property = $type_of_property;
                $user->type_of_acquisition = $type_of_acquisition;

                $user->save();


            }
                 fclose($csvFile);

           }
        }

                 return redirect('index');
      }





}
