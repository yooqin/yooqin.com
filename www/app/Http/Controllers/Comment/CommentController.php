<?php

namespace App\Http\Controllers\Comment;

use Validator;
use Illuminate\Http\Request;
use App\Yooqin\Models\Comments;
use App\Yooqin\Creator\CommentsCreator;
use App\Yooqin\Services\CommentsService;
use App\Yooqin\Consts\CommentsConst;
use App\Http\Controllers\Controller;
use App\Yooqin\Models\Blog;
use App\Yooqin\Models\Tag;
use App\Yooqin\Decorator\BlogDecorator;
use App\Yooqin\Consts\BlogConst;



class CommentController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = CommentsService::getList($request->type, $request->document_id);
        return $this->jsonSuccess($data);
    }

    public function comments(){
        $new_blogs = Blog::orderBy('id', 'desc')->paginate(10);
        $news = BlogDecorator::transformList($new_blogs);

        $tags = Tag::take(20)->get();

        return view('comments.index')
            ->with('tags', $tags)
            ->with('news', $news);
    }

    public function show($id){
        return [];
    }

    public function create(){
        return [];
    }

    public function destroy(){
    
        return [];
    }

    public function store(Request $request){
        try {

            if (!$request->type) {
                throw new \Exception('评论类型不能为空.');
            }

            $validator = Validator::make($request->all(),
                [
                'content' => 'required',
                'document_id' => 'required',
                'name' => 'required|max:32',
                'communication' => 'required|max:256',
                ],
                [
                'content.required'=>'评论内容不能为空',
                'document_id.required'=>'主题不能为空',
                'name.required'=>'昵称不能为空',
                'name.max'=>'昵称不能太长',
                'communication.required'=>'联系方式不能为空',
                'communication.max'=>'联系方式不能太长',
                ]
            );

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $creator = new CommentsCreator();
            $comment_id = $creator->create($request);
            if (!$comment_id) {
                throw new \Exception('数据创建失败');
            }

            return $this->jsonSuccess(['comment_id'=>$comment_id]);

        } catch (\Exception $e){

            return $this->jsonFailed($e->getMessage());
        }

    }

}
