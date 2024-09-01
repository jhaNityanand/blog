<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Blog;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $comment_data = DB::table('comments')
        ->join('blogs', 'comments.blog_id', '=', 'blogs.id')
        ->select('comments.*','blogs.title as blog')
        ->orderBy('comments.id', 'desc')->get();
        return view('admin.comment.index',compact('comment_data'));
    }

    public function create()
    {
        $blog_data = Blog::where('status', 'Active')->get();
        return view('admin.comment.create', compact('blog_data'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'created_by' => 'required',
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'blog_id' => 'required',
            'status' => 'required',
        ]);
        $data['message'] = str_replace("'", '', preg_replace('/[^A-Za-z0-9 -.\-]/', '', $request->message));
        $data['ip_address'] = \Request::ip();

        Comment::create($data);

        if($request->status == 'Active')
        {
            $first_blog = Blog::where('id', $request->blog_id)->first();
            
            $data = [
                'comment' => ($first_blog->comment + 1),
            ];
            Blog::where('id', $first_blog->id)->update($data);
        }
        
        return redirect()->route('comment.index')->with('success','Comment Created Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blog_data = Blog::where('status', 'Active')->get();
        $comment_data = Comment::where('id', $id)->first();
        return view('admin.comment.edit',compact('blog_data', 'comment_data'));
    }

    public function update(Request $request, $id)
    {
        if($request->verify == 'verify')
        {
            $first_comment = Comment::where('id', $id)->first();
            $first_blog = Blog::where('id', $first_comment->blog_id)->first();
            
            $data = [
                'comment' => ($first_blog->comment + 1),
            ];
            Blog::where('id', $first_blog->id)->update($data);
            
            $data = [
                'status' => 'Active',
            ];
            Comment::where('id', $id)->update($data);
            return redirect()->route('comment.index')->with('success','Comment Activeted Successfully!');
        }

        $data = $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'blog_id' => 'required',
            'status' => 'required',
        ]);
        
        Comment::where('id',$id)->update($data);
        return redirect()->route('comment.index')->with('success','Comment Updated Successfully!');
    }

    public function destroy($id)
    {
        $data = [
            'status' => 'Deleted',
        ];
        Comment::where('id', $id)->update($data);
        return redirect()->route('comment.index')->with('success','Comment Deleted Successfully!');

        Comment::where('id', $id)->delete();
        return redirect()->route('comment.index')->with('success','Comment Deleted Successfully!');
    }
}
