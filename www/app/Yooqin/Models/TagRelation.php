<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;

class TagRelation extends Model
{
    protected $table = "TagRelation";

    protected $dateFormat = "U";

    protected $fillable = ['tag_id', 'relation_id', 'type'];

    public function tag(){
        return $this->hasOne('App\Yooqin\Models\Tag', 'id', 'tag_id');
    }
}



