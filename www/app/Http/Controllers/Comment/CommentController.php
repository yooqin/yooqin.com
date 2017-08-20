<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;
use App\Yooqin\Models\Comments;
use App\Yooqin\Creator\CommentsCreator;
use App\Yooqin\Decorator\CommentsDecorator;
use App\Yooqin\Consts\CommentsConst;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [];
    }


    public function show($id){
        return [];
    }

    public function storeBlog(Request $request){
        $type = CommentsConst::TYPE_BLOG;
        return $this->store($request, $type);
    }

    public function store($request, $type){
        try {

            if (!$type) {
                throw new \Exception('类型不能为空');
            }

            $validator = Validator::make($request->all(),
                [
                'content' => 'required',
                'document_id' => 'required',
                'name' => 'required',
                'communitation' => 'required',
                ],
                [
                'content.required'=>'评论内容不能为空..',
                'document_id.required'=>'主题不能为空..',
                'name.required'=>'昵称不能为空..',
                'communitation.required'=>'联系方式不能为空..',
                ]
            );

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $creator = new CommnetsCreator();

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
