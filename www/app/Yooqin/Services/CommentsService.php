<?php
namespace App\Yooqin\Services;

use App\Yooqin\Models\Comments;
use App\Yooqin\Consts\CommentsConst;
use App\Yooqin\Decorator\CommentsDecorator;

class CommentsService
{

    public static function getList($type = 'blog', $document_id, $limit = 50){

        $type = CommentsConst::getValue('type_alias_list', $type);
        if (!$type || !$document_id) {
            return false;
        }

        $comments = Comments::where('document_id', $document_id)
            ->where('comment_type', $type)
            ->orderBy('id', 'asc')
            ->paginate($limit);

        $data = CommentsDecorator::transformList($comments);

        return $data;
    }

}
