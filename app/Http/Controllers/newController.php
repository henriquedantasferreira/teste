<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class newController extends Controller
{
    public function registeredusers(){
        $users = DB::select('select * from user');
        dd($users);
        //return view('usersview', ['users' => $users]);
    }
}
