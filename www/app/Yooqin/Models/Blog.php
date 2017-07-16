<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 
use App\Yooqin\Consts\BlogConst;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = "Blog";

    protected $dateFormat = "U";

    public function scopeFindUser($query){
        return $query->where('user_id', Auth::id());
    }

    public function scopeFindUri($query, $uri){
        return $query->where('uri', $uri);
    }

    public function getSourceName(){
        return BlogConst::getValue('source_list', $this->source);
    }

    public function getCategoryName(){
        return BlogConst::getValue('category_list', $this->category);
    }

    public function getBlogTypeName(){
        return BlogConst::getValue('type_list', $this->blog_type);
    }

    public function getBlogUri(){
        $uri = $this->id;
        if ($this->uri) {
            $uri = $this->uri;
        }

        return BlogConst::BLOG_DETAIL_PREFIX."/".$uri;
    }

    public function content(){
        return $this->hasOne('App\Yooqin\Models\BlogContent'); 
    }

    public function user(){
        return 1;
    }

}
