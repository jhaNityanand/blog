<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::User()->role;
        $user_id = Auth::User()->id;
        $first = Profile::where('user_id', $user_id)->first();

        if(empty($first->id))
        {
            $data = [
                'user_id' => $user_id,
                'image' => 'public\assets\images\users\user.png',
                'message' => 'Hi, I\'m (enter name), a (enter city name) native, who left my career in corporate wealth management six years ago to embark on a summer of soul searching that would change the course of my life forever.',
                'status' => 'Active',
            ];
            Profile::create($data);
        }

        if ($role == "admin") {
            return view('admin.home');
        }
        else if($role == "user") {
            return view('user.home');
        } 
        else {
            return redirect()->route('logout');
        }
    }
}
