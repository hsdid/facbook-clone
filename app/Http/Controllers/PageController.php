<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){

        return view('home');
    }

    public function userProfil(){
        return view('user');
    }

    public function searchFriend(){
        return view('searchFriend');
    }
}
