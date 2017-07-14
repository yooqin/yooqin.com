<?php 

namespace App\Yooqin\Creator; 

use Illuminate\Http\Request;
use App\Yooqin\Models\Blog;
use App\Yooqin\Models\BlogContent;
use Illuminate\Support\Facades\Auth;

class BlogCreator{
    
    public function create(Request $request){
        $blog = new Blog();  
        $blog_id = $this->transform($request, $blog);
        if (!$blog_id){
            throw new \Exception('保存失败');
        }

        $blog_content = BlogContent([
            'blog_id'=>$blog_id, 
            'md_content'=>$request->content,
            'content'=>$request->content
        ]);
        $blog_content->save();

        return $blog_id;
    }

    public function update(Request $request, $blog_id){
        $blog = Blog::firstOrNew(['id'=>$blog_id]);

        if ($blog->user_id != Auth::id()) {
            throw new \Exception('只有文章作者自己能够修改');
        }

        $blog_id = $this->transform($request, $blog);
        if (!$blog_id) {
            throw new \Exception("数据更新失败"); 
        }

        BlogContent::where('blog_id', $blog_id)
            ->update([
                'content'=>$content,
                'md_content'=>$content,
            ]);

        return $blog_id;
    }

    private function transform($request, Blog $blog){

        if ($request->uri && Blog::findUri($request->uri)->count()) {
            throw new \Exception('uri已经存在，请更新');
        }

        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->keywords = $request->keywords;
        $blog->description = $request->description;
        $blog->uri = $request->uri;
        $blog->views = $request::DEFAULT_VIEWS;
        $blog->source = $request::DEFAULT_SOURCE;
        $blog->blog_type = $request::DEFAULT_TYPE;
        $ret = $blog->save();

        return $ret ? $blog->id : $ret;
    }

}
