<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Question;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $question_data = Question::all();
        $question_data = DB::table('questions')
                ->join('categories', 'questions.category', '=', 'categories.id')
                ->select('questions.*','categories.name as category')
                ->orderBy('questions.id', 'desc')->get();
        return view('admin.question.index', compact('question_data'));
    }

    public function create()
    {
        $category_data = Category::where('status', 'Active')->where('type', 'question')->get();
        return view('admin.question.create', compact('category_data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $this->validate($request,[
            'title' => 'required|unique:questions,title',
            'url' => 'required|unique:questions,url',
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

        Question::create($data);
        return redirect()->route('questions.index')->with('success','Question Created Successfully!');
    }

    public function show($id)
    {
        $question_data =DB::table('questions')
                ->join('categories', 'questions.category', '=', 'categories.id')
                ->select('questions.*','categories.name as category')
                ->where('questions.id', $id)
                ->first();
        return view('admin.question.view',compact('question_data'));
    }

    public function edit($id)
    {
        $category_data = Category::where('status', 'Active')->where('type', 'question')->get();
        $question_data = Question::where('id', $id)->first();
        return view('admin.question.edit',compact('category_data', 'question_data'));
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
        
        Question::where('id',$id)->update($data);
        return redirect()->route('questions.index')->with('success','Question Updated Successfully!');
    }

    public function destroy($id)
    {
        $data = [
            'status' => 'Deleted',
        ];
        Question::where('id', $id)->update($data);
        return redirect()->route('questions.index')->with('success','Question Deleted Successfully!');

        $data = DB::table("questions")->where("id", $id)->first();
        
        Question::where('id', $id)->delete();
        return redirect()->route('questions.index')->with('success','Question Deleted Successfully!');
    }
}
