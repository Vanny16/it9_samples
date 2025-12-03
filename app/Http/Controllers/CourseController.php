<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function main(Request $request)
    {

        $course_list = DB::table('courses')
            ->join('status', 'status.status_id', 'courses.crsStatus')
        // ->whereIn('crsStatus',[1,2])
            ->where('crsStatus', 1)
            ->get();

        return view('courses.main', compact('course_list'));
    }

    public function save_course(Request $request)
    {

        $check_exist = DB::table('courses')
            ->where('crsName', $request->course_name)
            ->where('crsStatus', 1)
            ->exists();

        if ($check_exist) {
            session()->flash('test', 'Already Exist');

            return redirect()->back();

        } else {

            DB::table('courses')->insert([
                'crsName' => $request->course_name,
                'crsStatus' => 1,
            ]);

            session()->flash('success', 'Success');

            return redirect()->back();
        }
    }
}
