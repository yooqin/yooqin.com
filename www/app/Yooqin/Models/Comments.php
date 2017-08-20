<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{

    use SoftDeletes;

    protected $table = "Comments";

    protected $dateFormat = "U";

    protected $fillable = [
        'user_id', 
        'document_id', 
        'fid', 
        'comment_type', 
        'name', 
        'communication', 
        'title', 
        'content'
        ];
}


