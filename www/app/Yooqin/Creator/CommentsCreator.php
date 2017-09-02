<?php 

namespace App\Yooqin\Creator; 

use Illuminate\Http\Request;
use App\Yooqin\Models\Comments;
use App\Yooqin\Consts\CommentsConst;
use Illuminate\Support\Facades\Auth;

class CommentsCreator{

    public function create(Request $request){
        $comment = new Comments(); 
        $request->type_id = CommentsConst::getValue('type_alias_list', $request->type);
        if (!$request->type) {
            throw new \Exception('未支持的评论类型.'); 
        }
        $comment_id = $this->transform($request, $comment);
        if (!$comment_id){
            throw new \Exception('保存失败');
        }

        return $comment_id;
    }

    public function update(Request $request, $comment_id){
        $comment = Comments::firstOrNew(['id'=>$comment_id]);
        if ($comment->user_id != Auth::id() || !Auth::id()) {
            throw new \Exception('只有作者自己能够修改');
        }

        $request->type_id = $comment->comment_type;
        $comment_id = $this->transform($request, $comment);
        if (!$comment_id) {
            throw new \Exception("数据更新失败"); 
        }

        return $comment_id;
    }

    private function transform($request, Comments $comment){

        $user_id = Auth::id() ? Auth::id() : 0;
        $fid = isset($request->fid) ? $request->fid : 0;
        $name = isset($request->name) ? $request->name : 0;
        $communication = isset($request->communication) ? $request->communication : 0;
        $title = isset($request->title) ? $request->title : 0;

        $comment->user_id = $user_id;
        $comment->document_id = $request->document_id;
        $comment->fid = $fid;
        $comment->comment_type = $request->type_id;
        $comment->name = $name;
        $comment->communication = $communication;
        $comment->title = $title;
        $comment->content = $request->content;
        $ret = $comment->save();

        return $ret ? $comment->id : $ret;
    }

}
