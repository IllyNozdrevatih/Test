<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function checkEmail(Request $request){

        $user = User::all()->where('email',$request->email);
        if (count($user) == 0){
            return response()->json(['response' => 'not exit']);
        }
        return response()->json($user);

        }
    public function index(){
        $users = User::all();
        return view('users.index',compact('users'));
    }
}
