<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


use DB;


use Illuminate\Http\Request;

class StudentController extends Controller
{
public function main()
{
    $usr_list = DB::table('users')
        ->join('user_roles','user_roles.role_id','users.role_id')
        ->select('users.*','user_roles.role_name as role')
        ->where('usr_status',1)
        ->get();

    // One query, reused for all charts
    $studentsByDate = DB::table('users')
        ->select(
            DB::raw("DATE_FORMAT(created_at, '%b %Y') as month_label"), //%b = short month name (Jan, Feb, Mar)
                                                                        // %Y = full year (2024, 2025)
            DB::raw('COUNT(*) as total'), //Extracts the year number.
            DB::raw('YEAR(created_at) as year'), //Chart.js is frontend (browser) and can’t talk to your database.
                                                // So the controller has to get the data from the DB, then pass it to the view so the chart can use it.
            DB::raw('MONTH(created_at) as month_num') //Extracts the month number (1–12).
        )
        ->groupBy('year', 'month_num', 'month_label') //2024 + 1 → January 2024
        ->orderBy('year')
        ->orderBy('month_num')
        ->get();

    return view('students.main', compact('usr_list', 'studentsByDate'));
}


      public function profile(){
        return view('students.profile');
    }

    public function add(Request $request){

        // dd($request->all());

        // $filepath = null;
        // if($request->hasFile('profile')){
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $filepath = $file->storeAs('/upload/profiles', $filename, 'public');
        // }

        DB::table('users')->insert([
            'usr_name' => $request->usr_name,
            'usr_password' => Hash::make($request->usr_password),
            'role_id' => 2,
            'usr_status' => 1,
            'usr_profile' => $filepath
        ]);

        return redirect()->back();
    }

    public function save_course(Request $request){

        $check_exist = DB::table('courses')
                        ->where('crsName',$request->course_name)
                        ->where('crsStatus',1)
                        ->exists();

                        if($check_exist){
                             return redirect()->back();

                        }else{

                             DB::table('courses')->insert([
                            'crsName' => $request->course_name,
                            'crsStatus' => 1,
                        ]);

                        return redirect()->back();
                        }
    }

        public function deact_user($usr_id){

                            DB::table('users')
                            ->where('usr_id',$usr_id)
                            ->update([
                            'usr_status' => 0,
                        ]);

                        session()->flash('successMessage', 'User Deactivated Successfully!');
                        return redirect()->back();

    }
}
