<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function main()
    {

        return view('welcome');
    }

    public function register()
    {
         $regions = DB::table('location_regions')
            ->where('reg_active', 1)
            ->orderBy('reg_name')
            ->get(['reg_id', 'reg_name']);

        return view('register', compact('regions'));
    }


        public function provinces($region)
    {
        return DB::table('location_provinces')
            ->where('reg_id', $region)
            ->where('prov_active', 1)
            ->orderBy('prov_name')
            ->get(['prov_id', 'prov_name']);
    }

    public function municipalities($province)
    {
        return DB::table('location_municipalities')
            ->where('prov_id', $province)
            ->where('mun_active', 1)
            ->orderBy('mun_name')
            ->get(['mun_id', 'mun_name']);
    }

    public function barangays($municipality)
    {
        return DB::table('location_barangays')
            ->where('mun_id', $municipality)
            ->where('brg_active', 1)
            ->orderBy('brg_name')
            ->get(['brg_id', 'brg_name']);
    }


    public function save_user(Request $request)
    {
        // dd($request->all());

        $usrn = $request->username;
        $pass = $request->password;
        $dob = $request->dob;
        $contact = $request->contact_no;
        $age = $request->age;

        $check_exist = DB::table('users')
            ->where('usr_name', $usrn)
            ->exists();
        // dd(  $check_exist);

        if ($check_exist) {
            return redirect()->back();

        } else {

            $save = DB::table('users')
                ->insert([
                    'usr_name' => $usrn,
                    'usr_password' => Hash::make($pass),
                    'usr_dob' => $dob,
                    'usr_phone' => $contact,
                    'usr_age' => $age,
                ]);

            return view('welcome');
        }
    }

    public function auth_user(Request $request)
    {

        $uname = $request->username;
        $pass = $request->password;

        $check_user = DB::table('users')
            ->join('user_roles','user_roles.role_id','users.role_id')
            ->where('users.usr_name', $uname)
            ->first();
            // dd($check_userd);

        // dd( $check_user);
        if ($check_user) {
            if (Hash::check($pass, $check_user->usr_password)) {

                session()->put('usr_id', $check_user->usr_id);
                session()->put('usr_name', $check_user->usr_name);
                session()->put('usr_dob', $check_user->usr_dob);
                session()->put('role_id', $check_user->role_id);
                session()->put('role_name', $check_user->role_name);

                if ($check_user->role_id == 1) {
                    return redirect()->route('dash');

                } elseif ($check_user->role_id == 1) {
                    return redirect()->route('dash');

                } else {

                    return redirect()->route('dash');

                }
            }

            return redirect()->back();

        } else {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        $ttl_users = DB::table('users')
            ->count();

         $ttl_active = DB::table('users')
            ->where('usr_status', 1)
            ->count();

        return view('dashboard', compact('ttl_users', 'ttl_active'));
    }

    public function widgets()
    {

        return view('widgets');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }
}
