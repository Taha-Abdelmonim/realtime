<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
//      $chats = Chat::where("send_user_id", auth()->user()->id)->get()->groupBy("received_user_id");
      $users = User::where("id", "!=", auth()->user()->id)->get();
        return view('home', compact("users"));
    }
}
