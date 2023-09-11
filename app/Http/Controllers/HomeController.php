<?php

namespace App\Http\Controllers;

use App\Models\videos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $user = auth()->user();
        $data = $user->videos;
        return view('home',compact('data'));
    }
}
