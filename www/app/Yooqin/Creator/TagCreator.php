<?php 

namespace App\Yooqin\Creator; 

use Illuminate\Http\Request;
use App\Yooqin\Models\Tag;
use App\Yooqin\Models\TagTotal;
use App\Yooqin\Models\TagRelation;
use App\Yooqin\Consts\TagConst;
use Illuminate\Support\Facades\Auth;

class TagCreator{
    
    public function create(Request $request){

    }

    public function update(Request $request, $blog_id){
        
    }

    public function autoCreate(array $tags, $relation_id, $type = TagConst::TAG_BLOG){

        if (!$relation_id || empty($tags)) {
            return false;
        }

        foreach ($tags as $_tag) {

            $tag = Tag::firstOrNew(['name'=>$_tag]);
            $tag->name = $_tag;
            $tag->uri = '';
            $tag->content = json_encode([]);
            $ret = $tag->save();
            if (!$ret) {
                continue;
            }

            //relation
            $res_relation_id = $this->createRelation($type, $tag->id, $relation_id);
            if (!$res_relation_id) {
                continue;
            }

            //update total
            $this->updateTagTotal($type, $tag->id);
        }

        return true;
    }

    private function createRelation($type, $tag_id, $relation_id){
        if (!$type || !$tag_id) {
            return false;
        }

        $relation = TagRelation::firstOrNew(['tag_id'=>$tag_id, 'relation_id'=>$relation_id, 'type'=>$type]);
        $ret = $relation->save();

        return $ret ? $relation->id : $ret;
    }

    private function updateTagTotal($type, $tag_id){

        if (!$type || !$tag_id) {
            return false;
        }

        $total = TagTotal::firstOrNew(['type'=>$type, 'tag_id'=>$tag_id]);
        $total->total = $total->total + 1;
        $ret = $total->save();

        return $ret ? $total->id : $ret;
    }

}
