<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Empolees;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AppleController extends Controller
{
    public function index(Request $request){
        $query = Empolees::query();
        $dateFilter = $request->date_filter;
        // $employees=Empolees::all();

        switch($dateFilter){
            case 'today':
                $query->whereDate('created_at',Carbon::today());
                break;
                case 'yesterday':
                    $query->wheredate('created_at',Carbon::yesterday());
                break;
            case 'this_week':
                $query->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('created_at',[Carbon::now()->subWeek(),Carbon::now()]);
                break;
            case 'this_month':
                $query->whereMonth('created_at',Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('created_at',Carbon::now()->subMonth()->month);
                break;
            case 'this_year':
                $query->whereYear('created_at',Carbon::now()->year);
                break;
            case 'last_year':
                $query->whereYear('created_at',Carbon::now()->subYear()->year);
                break;                       
        }
        // $query->where('name','like','%'.'Clydey'. '%');
        // $query->orderBy('created_at','desc');
        $employees = $query->get();

        return view('Employee',compact('employees','dateFilter'));
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->input('ids');
        Empolees::whereIn('id', $ids)->delete();

        return redirect()->route('Employee')->with('success', 'Users successfully removed.');
    }

    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        $SocialUser = Socialite::driver($provider)->user();
        $user =User::updateOrCreate(
        //     [
        //     'provider_id' => $SocialUser->id,
        //     'provider' => ($provider)
        // ], 
        [
            'name' => $SocialUser->nickname,
            'email' => $SocialUser->email,
            // 'provider_token' => $SocialUser->token,
        ]);
     
        Auth::login($user);
        return redirect('home');
    }
}
