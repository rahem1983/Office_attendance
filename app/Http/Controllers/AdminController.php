<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

use Carbon\Carbon;

class AdminController extends Controller
{
    public function setUser(Request $req)
    {
        if ($req) {
            $user = new User;
            $user->email = $req->email;
            $user->password = $req->password;
            $user->save();

            $response = [
                'user_id' => $user->id,
                'message' => "Saved successfull"
            ];
            return response()->json($response);
            
        } else {
            return response()->json(['message' => "Saved not successfull",]);
            
        }
        
    }

    // public function giveAttendance(Request $req)
    // {
    //     if ($req) {
    //         $user = User::where($req->);
    //         $user->email = $req->email;
    //         $user->password = $req->password;
    //         $user->save();

    //         $response = [
    //             'user_id' => $user->id,
    //             'message' => "Saved successfull"
    //         ];
    //         return response()->json($response);
            
    //     } else {
    //         return response()->json(['message' => "Saved not successfull",]);
            
    //     }
    // }

    //for web use 
    public function getTodayAttendance()
    {
       $attendance = Attendance::join('users', 'users.id', '=', 'attendances.user_id')->whereDate('attendances.created_at', Carbon::today())->get();
       return response()->json($attendance);

    }
}
