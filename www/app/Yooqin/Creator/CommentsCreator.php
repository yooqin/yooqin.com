<?php 

namespace App\Yooqin\Creator; 

use Illuminate\Http\Request;
use App\Yooqin\Models\Comments;
use App\Yooqin\Consts\CommentsCont;
use Illuminate\Support\Facades\Auth;

class CommentsCreator{

    private $comment_type = 1;

    public function __construct($type = false){
        if (!$type) {
            $this->comment_type = CommentsConst::TYPE_BLOG;
        } else {
            $this->comment_type = $type;
        }
    }
    
    public function create(Request $request){

        $comment = new Comments(); 
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
        $comment->comment_type = $this->comment_type;
        $comment->name = $name;
        $comment->communication = $communication;
        $comment->title = $title;
        $comment->content = $request->content;
        $reg = $comment->save();

        return $ret ? $comment->id : $ret;
    }

}
