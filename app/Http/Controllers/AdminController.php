<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ip;
use App\Models\Attendance;
use App\Models\Qr_Codes;

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

    public function getUserId(Request $req)
    {
        $user = User::select('id')->where('id',1)->first();
        return response()->json($user);
    }

    public function setIpHost(Request $req)
    {
        $ip = new Ip;
        $ip->ip = $req->ip;
        $ip->host_name = $req->host_name;
        $ip->save();
        return response()->json([
            'message' => "Saved successfull",
            'IpHost' => $ip
        ]);
    }
    
    public function getIpHost(Request $req)
    {
        $ip = Ip::where('id', $req->id)->first();
        return response()->json($ip);
    }
    public function giveAttendance(Request $req)
    {
        if ($req) {
            $qr = Qr_Codes::where('text',$req->qr_text)->first();
            if ($qr) {
                $user = new Attendance;
                $user->user_id = $req->user_id;
                $user->save();
                return response()->json(['message' => "Attendance given",]);
            } else {
                return response()->json(['message' => "Qr code not match",]);
            }

        } else {
            return response()->json(['message' => "input error",]);
        }
    }

    //for web use 
    public function getTodayAttendance()
    {
       $attendance = Attendance::join('users', 'users.id', '=', 'attendances.user_id')->whereDate('attendances.created_at', Carbon::today())->get();
       return response()->json($attendance);

    }
}
