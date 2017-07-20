<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

use App\Yooqin\Models\Blog;
use App\Yooqin\Decorator\BlogDecorator;
use App\Yooqin\Consts\BlogConst;


class FooterComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		//浏览数最高的博客
		$blogs = Blog::orderBy('views', 'desc')
				->take(6)
				->get();

        //热点
        $hot_blogs = BlogDecorator::transformList($blogs); 
        if (!$hot_blogs) {
            $hot_blogs['list'] = [];
        }

        //分类
        $system_list = BlogConst::getList();
        $category_list = $system_list['category_list'];

        $route_info = [];
        $r = Route::current();
        if ($r) {
            $route_info['uri'] = $r->uri;
            $route_info['controller'] = $r->action['controller'];
            $route_info['namespace'] = $r->action['namespace'];
        }

        $view->with('hot_blogs', $hot_blogs['list']);
        $view->with('category_list', $category_list);
        $view->with('route_info', $route_info);
    }
}
