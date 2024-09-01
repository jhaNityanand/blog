<?php

use App\Models\Category;
use App\Models\Blog;

if (!function_exists('exampleHelper')) {
    function exampleHelper()
    {
        return 'This is an example helper function.';
    }
}

if (!function_exists('metaCategory')) {
    function metaCategory()
    {
        $data = Category::all();
        $returnData = [];
        foreach ($data as $key => $value) {
            $returnData[] = $value->url;
            $returnData[] = $value->name;
        }

        $impData = implode(', ', $returnData);
        $rep = str_replace('.', '', $impData);
        return $rep;
    }
}

if (!function_exists('metaBlog')) {
    function metaBlog()
    {
        $data = Blog::all();
        $returnData = [];
        foreach ($data as $key => $value) {
            $returnData[] = $value->tags;
        }

        $impData = implode(', ', $returnData);
        $rep = str_replace('.', '', $impData);
        return $rep;
    }
}
