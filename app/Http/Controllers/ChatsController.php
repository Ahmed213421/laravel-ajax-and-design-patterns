<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{

    public function index(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin.chat.index',compact('user'));
    }
       
}
