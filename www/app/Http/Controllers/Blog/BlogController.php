<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Yooqin\Models\Blog;
use App\Yooqin\Models\Tag;
use App\Yooqin\Decorator\BlogDecorator;
use App\Yooqin\Consts\BlogConst;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);
        $data = BlogDecorator::transformList($blogs);

        //最新的10条
        $new_blogs = Blog::orderBy('id', 'desc')->paginate(10);
        $news = BlogDecorator::transformList($new_blogs);

        $tags = Tag::take(20)->get();

        return view('blog.index')
            ->with('data', $data)
            ->with('tags', $tags)
            ->with('news', $news);
    }

    public function category($id){

        if (!$id) {
            return redirect('/blog');
        }

        $blogs = Blog::where('category_id', $id)->orderBy('id', 'desc')->paginate(10);
        $data = BlogDecorator::transformList($blogs);

        $tags = Tag::take(20)->get();

        //最新的10条
        $new_blogs = Blog::orderBy('id', 'desc')->paginate(10);
        $news = BlogDecorator::transformList($new_blogs);

        $current_category = BlogConst::getValue('category_detail_list', $id);


        return view('blog.index')
            ->with('data', $data)
            ->with('tags', $tags)
            ->with('current_category_id', $id)
            ->with('current_category', $current_category)
            ->with('news', $news);
    }

    public function show($id){
        if (!$id) {
            return redirect('/blog');
        }

        $blog = is_numeric($id) ? Blog::find($id) : Blog::where('uri', $id)->first();
        if (!$blog) {
            return redirect('/blog');
        }

        $blog->views += 1;
        $blog->save();
        $data = BlogDecorator::transform($blog);
        $tags = Tag::take(20)->get();


        //最新的10条
        $new_blogs = Blog::orderBy('id', 'desc')->paginate(10);
        $news = BlogDecorator::transformList($new_blogs);

        return view('blog.detail')->with('data', $data)
            ->with('tags', $tags)
            ->with('news', $news);

    }
}
