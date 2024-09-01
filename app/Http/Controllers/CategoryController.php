<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category_data = DB::table('categories')
                ->leftJoin('blogs', 'categories.id', '=', 'blogs.category')
                ->select('categories.*', DB::raw('count(blogs.id) as no_of_post'))
                ->groupBy('categories.id')->orderBy('categories.id', 'desc')
                ->get();
        return view('admin.category.index',compact('category_data'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'name' => 'required|unique:categories,name',
            'type' => 'required',
            'url' => 'required|unique:categories,url',
            'description' => 'required',
            // 'image' => 'required|max:10240|mimes:jpeg,jpg,png,gif,svg',
            'status' => 'required',
        ]);
        if ($request->input('type') == 'blog') {
            $this->validate($request, [
                'image' => 'required|max:10240|mimes:jpeg,jpg,png,gif,svg',
            ]);
        }
        $data['url'] = strtolower(str_replace(" ", '-', preg_replace('/[^A-Za-z0-9 -\-]/', '', $request->url)));

        if($files = $request->file('image'))
        {
            $path = public_path('assets/images/category/');
            $name = strtolower($files->getClientOriginalName());
            $ext = strtolower($files->getClientOriginalExtension());
            $img_name = Str::random(5);
            $img_name = $img_name . '-' . $name;
            $files->move($path, $img_name);

            $data['image'] = 'public/assets/images/category/' . $img_name;
        }

        // echo "<pre>";
        // print_r($data);
        // die;

        Category::create($data);
        return redirect()->route('category.index')->with('success','Category Created Successfully!');
    }

    public function show($id)
    {
        $category_data = Category::where('id', $id)->first();
        return view('admin.category.view',compact('category_data'));
    }

    public function edit($id)
    {
        $category_data = Category::where('id', $id)->first();
        return view('admin.category.edit',compact('category_data'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id',$id)->first();

        $data = $this->validate($request,[
            'name' => 'required',
            'type' => 'required',
            'url' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        if ($request->input('type') == 'blog' && $category->image == "") {
            $this->validate($request, [
                'image' => 'required|max:10240|mimes:jpeg,jpg,png,gif,svg',
            ]);
        }
        $data['url'] = strtolower(str_replace(" ", '-', preg_replace('/[^A-Za-z0-9 -\-]/', '', $request->url)));

        if($files = $request->file('image'))
        {
            $path = public_path();
            $path = $category->image;
            File::delete($path);

            $path = 'public/assets/images/category/';
            $name = strtolower($files->getClientOriginalName());
            $img_name = Str::random(5).'-'.$name;
            $files->move($path, $img_name);

            $data['image'] = $path.$img_name;
        }
        
        Category::where('id',$id)->update($data);
        return redirect()->route('category.index')->with('success','Category Updated Successfully!');
    }

    public function destroy($id)
    {
        $data = [
            'status' => 'Deleted',
        ];
        Category::where('id', $id)->update($data);
        return redirect()->route('category.index')->with('success','Category Deleted Successfully!');

        $data = DB::table("categories")->where("id", $id)->first();
        $path = $data->image;
        File::delete($path);

        Category::where('id', $id)->delete();
        return redirect()->route('category.index')->with('success','Category Deleted Successfully!');
    }
}
