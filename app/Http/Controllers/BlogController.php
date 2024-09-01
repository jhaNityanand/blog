<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $blog_data = Blog::all();
        $blog_data = DB::table('blogs')
                ->join('categories', 'blogs.category', '=', 'categories.id')
                ->select('blogs.*','categories.name as category')
                ->orderBy('blogs.id', 'desc')->get();
        return view('admin.blog.index', compact('blog_data'));
    }

    public function create()
    {
        $category_data = Category::where('status', 'Active')->where('type', 'blog')->get();
        return view('admin.blog.create', compact('category_data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $this->validate($request,[
            'title' => 'required|unique:blogs,title',
            'url' => 'required|unique:blogs,url',
            'category' => 'required',
            'image' => 'required|max:10240|mimes:jpeg,jpg,png,gif,svg',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'author' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_author' => 'required',
        ]);
        $data['url'] = strtolower(str_replace(" ", '-', preg_replace('/[^A-Za-z0-9 -\-]/', '', $request->url)));

        /* $content = $request->content;
        $con_name = Str::random(5).'-'.$request->url.'.txt';
        $path = 'public/assets/images/content/'.$con_name;
        File::put($path, $content);
        $data['content'] = $path; */

        if($files = $request->file('image'))
        {
            $name = strtolower($files->getClientOriginalName());
            $img_name = Str::random(5).'-'.$name;
            $path = 'public/assets/images/blog/';
            $files->move($path, $img_name);
            $data['image'] = $path.$img_name;
        }

        // echo "<pre>";
        // print_r($data);
        // die;

        Blog::create($data);
        return redirect()->route('blog.index')->with('success','Blog Post Created Successfully!');
    }

    public function show($id)
    {
        $blog_data =DB::table('blogs')
                ->join('categories', 'blogs.category', '=', 'categories.id')
                ->select('blogs.*','categories.name as category')
                ->where('blogs.id', $id)
                ->first();
        return view('admin.blog.view',compact('blog_data'));
    }

    public function edit($id)
    {
        $category_data = Category::where('status', 'Active')->where('type', 'blog')->get();
        $blog_data = Blog::where('id', $id)->first();
        return view('admin.blog.edit',compact('category_data', 'blog_data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'title' => 'required',
            'url' => 'required',
            'category' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'author' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_author' => 'required',
        ]);
        $data['url'] = strtolower(str_replace(" ", '-', preg_replace('/[^A-Za-z0-9 -\-]/', '', $request->url)));

        if($files = $request->file('image'))
        {
            $first = DB::table("blogs")->where("id", $id)->first();
            $path = $first->image;
            File::delete($path);

            $path = 'public/assets/images/blog/';
            $name = strtolower($files->getClientOriginalName());
            $img_name = Str::random(5).'-'.$name;
            $files->move($path, $img_name);

            $data['image'] = $path.$img_name;
        }
        
        Blog::where('id',$id)->update($data);
        return redirect()->route('blog.index')->with('success','Blog Post Updated Successfully!');
    }

    public function destroy($id)
    {
        $data = [
            'status' => 'Deleted',
        ];
        Blog::where('id', $id)->update($data);
        return redirect()->route('blog.index')->with('success','Blog Post Deleted Successfully!');

        $data = DB::table("blogs")->where("id", $id)->first();
        $path = public_path();
        $path = $data->image;
        File::delete($path);

        Blog::where('id', $id)->delete();
        return redirect()->route('blog.index')->with('success','Blog Post Deleted Successfully!');
    }
}
