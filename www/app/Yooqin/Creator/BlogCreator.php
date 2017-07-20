<?php 

namespace App\Yooqin\Creator; 

use Illuminate\Http\Request;
use App\Yooqin\Models\Blog;
use App\Yooqin\Models\BlogContent;
use App\Yooqin\Consts\BlogConst;
use Illuminate\Support\Facades\Auth;

class BlogCreator{
    
    public function create(Request $request){

        if ($request->uri && Blog::findUri($request->uri)->count()) {
            throw new \Exception('uri已经存在，请更新');
        }

        $blog = new Blog();  
        $blog_id = $this->transform($request, $blog);
        if (!$blog_id){
            throw new \Exception('保存失败');
        }

        $blog_content = new BlogContent([
            'blog_id'=>$blog_id, 
            'md_content'=>$request->md_content,
            'content'=>$request->content
        ]);
        $blog_content->save();

        $tag = new TagCreator();
        $tag->autoCreate(explode(",", $request->keywords), $blog_id);

        return $blog_id;
    }

    public function update(Request $request, $blog_id){
        $blog = Blog::firstOrNew(['id'=>$blog_id]);

        if ($blog->user_id != Auth::id()) {
            throw new \Exception('只有文章作者自己能够修改');
        }

        if ($request->uri) {
            $bblog = Blog::findUri($request->uri)->first();
            if ($bblog && $bblog->id != $blog_id) {
                throw new \Exception('uri已经存在，请更新');
            }
        }

        $blog_id = $this->transform($request, $blog);
        if (!$blog_id) {
            throw new \Exception("数据更新失败"); 
        }

        BlogContent::where('blog_id', $blog_id)
            ->update([
                'content'=>$request->content,
                'md_content'=>$request->md_content,
            ]);

        return $blog_id;
    }

    private function transform($request, Blog $blog){

        

        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->category_id = $request->category_id;
        $blog->keywords = $request->keywords;
        $blog->description = $request->description;
        $blog->uri = $request->uri;
        $blog->views = BlogConst::DEFAULT_VIEWS;
        $blog->source = $request->source;
        $blog->blog_type = $request->blog_type;
        $blog->deleted_at = null;
        $ret = $blog->save();

        return $ret ? $blog->id : $ret;
    }

}
