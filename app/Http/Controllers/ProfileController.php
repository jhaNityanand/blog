<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
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

        $profile_data = Profile::where('profile.user_id', $user_id)
            ->join('users', 'profile.user_id', '=', 'users.id')
            ->select('profile.*', 'users.*', 'profile.id as p_id')
            ->first();

        return view('admin.profile.index',compact('profile_data'));
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        // 
    }

    public function show($id)
    {
        // 
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
            'message' => 'required',
        ]);

        $u_data = [
            'name' => $request->name,
        ];
        $user_id = Auth::User()->id;
        User::where('id', $user_id)->update($u_data);

        $data = [
            'message' => $request->message,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'linkdin' => $request->linkdin,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'gmail' => $request->gmail,
            'telegram' => $request->telegram,
        ];
        $data['url'] = strtolower(str_replace(" ", '-', preg_replace('/[^A-Za-z0-9 -\-]/', '', $request->url)));

        if($files = $request->file('image'))
        {
            $first = DB::table("profile")->where("id", $id)->first();
            $path = $first->image;
            if($path != 'public\assets\images\users\user.png') {
                File::delete($path);
            }

            $path = 'public/assets/images/users/';
            $name = strtolower($files->getClientOriginalName());
            $img_name = Str::random(5).'-'.$name;
            $files->move($path, $img_name);

            $data['image'] = $path.$img_name;
        }
        
        Profile::where('id',$id)->update($data);
        return redirect()->back()->with('success','Profile Updated Successfully!');
    }

    public function destroy($id)
    {
        // 
    }
}
