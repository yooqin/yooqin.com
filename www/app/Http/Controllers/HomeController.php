<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Yooqin\Models\Blog;
use App\Yooqin\Models\Tag;
use App\Yooqin\Decorator\BlogDecorator;
use App\Yooqin\Consts\BlogConst;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->take(10)->get();
        $data = BlogDecorator::transformList($blogs);


        $tags = Tag::take(20)->get();

        return view('home')
            ->with('data', $data)
            ->with('tags', $tags);
    }
}
