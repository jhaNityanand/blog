<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Profile;
use App\Models\Image;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Question;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sitemap()
    {
        header("Content-type: text/xml");
        $post_url = [];
        $image_url = [];
        $content = '';
        $content .= '<?xml version="1.0" encoding="UTF-8" ?>';
        $content .= " \r\n \r\n ";
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $content .= " \r\n \r\n ";

        $content .= '<url>';
        $content .= " \r\n ";
        $content .= '<loc>';
        $content .= url('/');
        $content .= '</loc>';
        $content .= " \r\n ";
        $content .= '<lastmod>';
        $content .= date('Y-m-d');
        $content .= '</lastmod>';
        $content .= " \r\n ";
        $content .= '<changefreq>';
        $content .= 'daily';
        $content .= '</changefreq>';
        $content .= " \r\n ";
        $content .= '<priority>';
        $content .= '1.0';
        $content .= '</priority>';
        $content .= " \r\n ";
        $content .= '</url>';
        $content .= " \r\n \r\n ";
       
        $blog_data = Blog::where('status', 'Active')->select('url', 'image', 'updated_at')->get()->toArray();
        $question_data = Question::where('status', 'Active')->select('url', 'updated_at')->get()->toArray();
        $category_data = Category::where('status', 'Active')->select('url', 'image', 'updated_at')->get()->toArray();
        $image_data = Image::where('status', 'Active')->select('image_url', 'updated_at')->get()->toArray();
        $profile_data = Profile::where('status', 'Active')->select('url', 'image', 'updated_at')->get()->toArray();
        
        foreach ($blog_data as $key => $value) {
            $post_url[] = ['url' => url('/') . '/post/' . $value['url'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
            $image_url[] = ['url' => url('/') . '/' . $value['image'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
        }
        foreach ($question_data as $key => $value) {
            $post_url[] = ['url' => url('/') . '/question/' . $value['url'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
        }
        foreach ($category_data as $key => $value) {
            $post_url[] = ['url' => url('/') . '/category/' . $value['url'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
            $image_url[] = ['url' => url('/') . '/' . $value['image'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
        }
        foreach ($image_data as $key => $value) {
            $image_url[] = ['url' => url('/') . '/' . $value['image_url'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
        }
        foreach ($profile_data as $key => $value) {
            $post_url[] = ['url' => url('/') . '/author/' . $value['url'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
            $image_url[] = ['url' => url('/') . '/' . $value['image'], 'updated_at' => date('Y-m-d', strtotime($value['updated_at']))];
        }

        foreach ($post_url as $key => $value) {
            $content .= '<url>';
            $content .= " \r\n ";
            $content .= '<loc>';
            $content .= $value['url'];
            $content .= '</loc>';
            $content .= " \r\n ";
            $content .= '<lastmod>';
            $content .= $value['updated_at'];
            $content .= '</lastmod>';
            $content .= " \r\n ";
            $content .= '<changefreq>';
            $content .= 'monthly';
            $content .= '</changefreq>';
            $content .= " \r\n ";
            $content .= '<priority>';
            $content .= '0.9';
            $content .= '</priority>';
            $content .= " \r\n ";
            $content .= '</url>';
            $content .= " \r\n \r\n ";
        }
        foreach ($image_url as $key => $value) {
            $content .= '<url>';
            $content .= " \r\n ";
            $content .= '<loc>';
            $content .= $value['url'];
            $content .= '</loc>';
            $content .= " \r\n ";
            $content .= '<lastmod>';
            $content .= $value['updated_at'];
            $content .= '</lastmod>';
            $content .= " \r\n ";
            $content .= '<changefreq>';
            $content .= 'monthly';
            $content .= '</changefreq>';
            $content .= " \r\n ";
            $content .= '<priority>';
            $content .= '0.8';
            $content .= '</priority>';
            $content .= " \r\n ";
            $content .= '</url>';
            $content .= " \r\n \r\n ";
        }
        $content .= '</urlset>';

        $path_xml = 'sitemap.xml';
        $path_txt = 'sitemap.txt';
        File::put($path_xml, $content);
        // File::put($path_txt, $content);
        echo $content;

        // echo '<pre>';
        // print_r($post_url);
        // print_r($image_url);
        // print_r($blog_data);
        // print_r($category_data);
        // print_r($image_data);
        // print_r($profile_data);
        die;
    }

    public function feed()
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

    public function updatePost() {
        $blog_data = Blog::select('id', 'content')->get()->toArray();

        foreach ($blog_data as $key => $value) {
            $replaceFrom = "https://microshorts.org";
            $replaceTo = url('/');
            $newContent = str_replace($replaceFrom, $replaceTo, $value['content']);
           
            Blog::where('id', $value['id'])->update([
                'content' => $newContent,
            ]);
        }
    }
}
