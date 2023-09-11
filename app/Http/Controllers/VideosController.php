<?php

namespace App\Http\Controllers;

use App\Models\videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideosController extends Controller
{
    public function insert(Request $request)
    {
       $request->validate([
           'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm'
       ]);

       $file=$request->file('video');
       $file->move('upload',$file->getClientOriginalName());
       $file_name=$file->getClientOriginalName();
       $userId = Auth::id();

       $insert=new videos();
       $insert->video = $file_name;
       $insert->title=$file_name;
       $insert->user_id = $userId; // 设置用户ID
       $insert->save();

       return redirect('/home');
}
public function show(){
    return view('videoshow');
}
}
