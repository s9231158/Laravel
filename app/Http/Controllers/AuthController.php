<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationEmail as SendVerificationEmailMail;



use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
    // public function registerPost(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users', // 确保邮箱在 users 表中是唯一的
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);

    //     if ($user->save()) {
    //         // 注册成功，重定向到成功页面
    //             return redirect('/home')->with('成功', '成功註冊請登入');
            
    //     } else {
    //         // 注册失败，重定向到注册失败页面
    //         return redirect()->route('register')->withErrors('电子邮件地址已被使用，请使用其他地址。');
    //     }
    // }
    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', // 确保邮箱在 users 表中是唯一的
            'password' => 'required|min:6',
        ]);

        $token = Str::random(60);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_token = $token;
        $user->save();

        event(new Registered($user));
        \Log::info('註冊事件已觸發');
        Mail::to($user->email)->send(new SendVerificationEmailMail($user));

        return '成功註冊，請查收郵件進行驗證';

    }
    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', '驗證連結無效');
        }

        // $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        return redirect('/login')->with('success', '郵件驗證成功');
    }
// \\\\\\\\\\\\\\\
    public function login()
    {
        return view('login');
    }
    public function loginPost(Request $request1)
    {
        $credetials = [
            'email' => $request1->email,
            'password' => $request1->password
        ];
        
        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('成功', '成功登入');
        }
        return back()->with('失敗', '白癡');
    }
    public function loginPost1(Request $request21)
    {
        $credetials = [
            'email' => $request21->email,
            'password' => $request21->password
        ];
        
        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('成功', '成功登入');
        }
        return back() ->withInput($request21->except('password'))
        ->withErrors(['失敗' => '登入失敗，請檢查您的帳號和密碼']);;
        // return back()->with('失敗', $request21->email);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}