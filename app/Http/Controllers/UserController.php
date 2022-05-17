<?php

namespace App\Http\Controllers;

use App\Models\Qr_Codes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getQr()
    {
        $qr = Qr_Codes::select('text')->first();
        return response()->json($qr);
    }
}
