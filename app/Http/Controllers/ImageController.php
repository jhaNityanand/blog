<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $image_data = Image::orderBy('id', 'DESC')->get();
        return view('admin.image.index',compact('image_data'));
    }

    public function create()
    {
        return view('admin.image.create');
    }

    public function store(Request $request)
    {
        if($files = $request->file('file'))
        {
            $path = 'public/assets/images/content/';
            $name = strtolower($files->getClientOriginalName());
            $img_name = Str::random(5) . '-' . $name;
            $files->move($path, $img_name);

            $data = [
                'image_name' => $name,
                'image_url' => $path . $img_name,
                'status' => 'Active',
            ];
            Image::create($data);
        }

        // echo "<pre>";
        // print_r($data);
        // die;

        return redirect()->route('image.index')->with('success','Image Uploaded Successfully!');
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
        //
    }

    public function destroy($id)
    {
        $data = DB::table("content_image")->where("id", $id)->first();
        $path = $data->image_url;
        File::delete($path);

        Image::where('id', $id)->delete();
        return redirect()->route('image.index')->with('success','File Deleted Successfully!');
    }
}
