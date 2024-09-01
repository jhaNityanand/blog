<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\Question;
use App\Models\Email;
use App\Models\Profile;

class FrontEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blog_data = Blog::where('blogs.status', 'Active')
                ->leftJoin('categories', 'blogs.category', '=', 'categories.id')
                ->select('categories.name as c_name', 'categories.url as c_url', 'blogs.*')
                ->inRandomOrder()->get();

        $blog_single = Blog::where('blogs.status', 'Active')
                ->leftJoin('categories', 'blogs.category', '=', 'categories.id')
                ->select('categories.name as c_name', 'categories.url as c_url', 'blogs.*')
                ->inRandomOrder()->first();
        
        $category_data = DB::table('categories')
                ->leftJoin('blogs', 'categories.id', '=', 'blogs.category')
                ->select('categories.*', DB::raw('count(blogs.id) as no_of_post'))
                ->where('categories.status', 'Active')
                ->groupBy('categories.id')->orderBy('no_of_post', 'desc')
                ->get();

        $profile_data = Profile::where('profile.id', '1')
                ->join('users', 'profile.user_id', '=', 'users.id')
                ->select('users.*', 'profile.*')
                ->first();

        return view('frontend.index',compact('blog_data', 'blog_single', 'category_data', 'profile_data'));
    }

    public function search(Request $request)
    {
        $search_text = $request->search_text;
        $blog_data = Blog::where('blogs.status', 'Active')
                ->where('blogs.title', 'like', '%'.$search_text.'%')
                ->orWhere('blogs.tags', 'like', '%'.$search_text.'%')
                ->leftJoin('categories', 'blogs.category', '=', 'categories.id')
                ->select('categories.name as c_name', 'categories.url as c_url', 'blogs.*')
                ->inRandomOrder()->get();

        return view('frontend.search',compact('blog_data', 'search_text'));
    }

    public function subscribe(Request $request)
    {
        $data = $this->validate($request,[
            'email' => 'required|unique:email,email',
        ]);

        Email::create($data);
        return redirect()->back()->with('success','Thanks for Subscribe our Website!');
    }

    public function blog($url)
    {
        $blog_data = Blog::where('url', $url)->first();
        if(empty($blog_data->id))
        {
            return redirect()->back()->with('error','Something Went Wrong!');
        }
        $category_data = Category::where('id', $blog_data->category)->first();
        
        $profile_data = Profile::where('profile.id', '1')
                ->join('users', 'profile.user_id', '=', 'users.id')
                ->select('users.*', 'profile.*')
                ->first();

        $comment_data = Comment::where('blog_id', $blog_data->id)
                    ->where('status', 'Active')->where('type', 'blog')->where('reply', null)
                    ->orderBy('id', 'desc')->get();

        $blog_side = Blog::where('url', '!=', $url)->where('status', 'Active')
                    ->limit(12)->inRandomOrder()->get();

        $blog_popup = Blog::where('url', '!=', $url)->where('status', 'Active')
                    ->limit(2)->inRandomOrder()->get();

        $type = 'blog';

        $data = ['view' => ($blog_data->view + 1)];
        Blog::where('id', $blog_data->id)->update($data);
                
        return view('frontend.single', compact('blog_popup', 'blog_side', 'comment_data', 'profile_data', 'category_data', 'blog_data', 'type'));
    }

    public function author($url)
    {
        $profile_data = Profile::where('profile.id', '1')
                ->join('users', 'profile.user_id', '=', 'users.id')
                ->select('users.*', 'profile.*')
                ->first();
        
        return view('frontend.author', compact('profile_data'));
    }

    public function category($url)
    {
        $category_data = Category::where('url', $url)->where('status', 'Active')->first();
        if(empty($category_data->id)) {
            return redirect()->back()->with('error','Something Went Wrong!');
        }

        if($category_data->type == 'blog') {
            $blog_data = Blog::where('category', $category_data->id)->where('status', 'Active')->orderBy('view', 'desc')->get();
        } else if($category_data->type == 'question') {
            $blog_data = Question::where('category', $category_data->id)->where('status', 'Active')->orderBy('view', 'desc')->get();
        } else {
            return redirect()->back()->with('error','Something Went Wrong!');
        }
        
        $data = ['view' => ($category_data->view + 1)];
        Category::where('id', $category_data->id)->update($data);

        return view('frontend.category', compact('category_data', 'blog_data'));
    }

    public function questions()
    {
        $question_data = Category::where('type', 'question')->where('status', 'Active')->get();
        return view('frontend.questions', compact('question_data'));
    }

    public function question($url)
    {
        $blog_data = Question::where('url', $url)->first();
        if(empty($blog_data->id))
        {
            return redirect()->back()->with('error','Something Went Wrong!');
        }
        $category_data = Category::where('id', $blog_data->category)->first();
        
        $profile_data = Profile::where('profile.id', '1')
                ->join('users', 'profile.user_id', '=', 'users.id')
                ->select('users.*', 'profile.*')
                ->first();

        $comment_data = Comment::where('blog_id', $blog_data->id)
                    ->where('status', 'Active')->where('type', 'question')->where('reply', null)
                    ->orderBy('id', 'desc')->get();

        $blog_side = Blog::where('url', '!=', $url)->where('status', 'Active')
                    ->limit(12)->inRandomOrder()->get();

        $blog_popup = Blog::where('url', '!=', $url)->where('status', 'Active')
                    ->limit(2)->inRandomOrder()->get();

        $type = 'question';

        $data = ['view' => ($blog_data->view + 1)];
        Question::where('id', $blog_data->id)->update($data);
                
        return view('frontend.single', compact('blog_popup', 'blog_side', 'comment_data', 'profile_data', 'category_data', 'blog_data', 'type'));
    }

    public function comment(Request $request)
    {
        $data = $this->validate($request,[
            'name' => 'required',
            'type' => 'required',
            'email' => 'required',
            'message' => 'required',
            'blog_id' => 'required',
        ]);
        $data['message'] = str_replace("'", '', preg_replace('/[^A-Za-z0-9 -.\-]/', '', $request->message));
        $data['reply'] = $request->reply;
        $data['ip_address'] = \Request::ip();
        $data['created_by'] = 'user';
        $data['status'] = 'Pending';

        Comment::create($data);
        return redirect()->back()->with('success','Thanks for sending comments!');
    }

    public function feed_rss()
    {
        header("Content-type: text/xml");
        $content = '';
        $content .= '<?xml version="1.0" encoding="UTF-8" ?>';
        $content .= " \r\n \r\n ";
        $content .= '<rss version="2.0">';
        $content .= " \r\n ";
        $content .= '<channel>';
        $content .= " \r\n \r\n ";

        $content .= '<title>';
        $content .= 'MicroShorts';
        $content .= '</title>';
        $content .= " \r\n ";
        // $content .= '<atom:link href="'.route('feed').'" rel="self" type="application/rss+xml" />';
        $content .= '<atomlink href="'.route('feed').'" rel="self" type="application/rss+xml" />';
        $content .= " \r\n ";
        $content .= '<link>';
        $content .= url('/');
        $content .= '</link>';
        $content .= " \r\n ";
        $content .= '<description>';
        $content .= 'Microshorts is an educational niche website related to biology, useful for High School, B.Sc, M.Sc., M.Phil., and Ph.D.';
        $content .= '</description>';
        $content .= " \r\n ";
        $content .= '<lastBuildDate>';
        $content .= date('D, d M Y h:i:s');
        $content .= '</lastBuildDate>';
        $content .= " \r\n ";
        $content .= '<language> en-US </language>';
        $content .= " \r\n ";
        // $content .= '<sy:updatePeriod> hourly </sy:updatePeriod>';
        // $content .= " \r\n ";
        // $content .= '<sy:updateFrequency> 1 </sy:updateFrequency>';
        // $content .= " \r\n ";
        $content .= '<updatePeriod> hourly </updatePeriod>';
        $content .= " \r\n ";
        $content .= '<updateFrequency> 1 </updateFrequency>';
        $content .= " \r\n ";
        $content .= '<generator>';
        $content .= url('/');
        $content .= '</generator>';
        $content .= " \r\n \r\n ";

        $content .= '<image>';
        $content .= " \r\n ";
        $content .= '<url>';
        $content .= url('/') . '/public/assets/images/theme/favicon.svg';
        $content .= '</url>';
        $content .= " \r\n ";
        $content .= '<title>MicroShorts</title>';
        $content .= " \r\n ";
        $content .= '<link>';
        $content .= url('/');
        $content .= '</link>';
        $content .= " \r\n ";
        $content .= '<width>32</width>';
        $content .= " \r\n ";
        $content .= '<height>32</height>';
        $content .= " \r\n ";
        $content .= '</image>';
        $content .= " \r\n \r\n ";
       
        $blog_data = Blog::with('category')->where('status', 'Active')->orderBy('id', 'DESC')->get()->toArray();
        foreach ($blog_data as $key => $value) {
            $content .= '<item>';
            $content .= " \r\n ";
            $content .= '<title>';
            $content .= $value['title'];
            $content .= '</title>';
            $content .= " \r\n ";
            $content .= '<link>';
            $content .= url('/') . '/post/' . $value['url'];
            $content .= '</link>';
            $content .= " \r\n ";
            $content .= '<comments>';
            $content .= url('/') . '/post/' . $value['url'] . '#comment';
            $content .= '</comments>';
            $content .= " \r\n ";
            // $content .= '<dc:creator>';
            // $content .= $value['author'];
            // $content .= '</dc:creator>';
            // $content .= " \r\n ";
            $content .= '<creator>';
            $content .= $value['author'];
            $content .= '</creator>';
            $content .= " \r\n ";
            $content .= '<pubDate>';
            $content .= date('D, d M Y h:i:s', strtotime($value['created_at']));
            $content .= '</pubDate>';
            $content .= " \r\n ";
            $content .= '<category>';
            $content .= $value['category']['name'];
            $content .= '</category>';
            $content .= " \r\n ";
            $content .= '<description>';
            $content .= $value['meta_description'];
            $content .= '</description>';
            $content .= " \r\n ";
            $content .= '</item>';
            $content .= " \r\n \r\n ";
        }

        $question_data = Question::with('category')->where('status', 'Active')->orderBy('id', 'DESC')->get()->toArray();
        foreach ($question_data as $key => $value) {
            $content .= '<item>';
            $content .= " \r\n ";
            $content .= '<title>';
            $content .= $value['title'];
            $content .= '</title>';
            $content .= " \r\n ";
            $content .= '<link>';
            $content .= url('/') . '/post/' . $value['url'];
            $content .= '</link>';
            $content .= " \r\n ";
            $content .= '<comments>';
            $content .= url('/') . '/post/' . $value['url'] . '#comment';
            $content .= '</comments>';
            $content .= " \r\n ";
            // $content .= '<dc:creator>';
            // $content .= $value['author'];
            // $content .= '</dc:creator>';
            // $content .= " \r\n ";
            $content .= '<creator>';
            $content .= $value['author'];
            $content .= '</creator>';
            $content .= " \r\n ";
            $content .= '<pubDate>';
            $content .= date('D, d M Y h:i:s', strtotime($value['created_at']));
            $content .= '</pubDate>';
            $content .= " \r\n ";
            $content .= '<category>';
            $content .= $value['category']['name'];
            $content .= '</category>';
            $content .= " \r\n ";
            $content .= '<description>';
            $content .= $value['meta_description'];
            $content .= '</description>';
            $content .= " \r\n ";
            $content .= '</item>';
            $content .= " \r\n \r\n ";
        }

        $content .= '</channel>';
        $content .= " \r\n ";
        $content .= '</rss>';

        $path_xml = 'feed.xml';
        $path_txt = 'feed.txt';
        File::put($path_xml, $content);
        // File::put($path_txt, $content);
        echo $content;

        // echo '<pre>';
        // print_r($blog_data);
        die;
    }
}
