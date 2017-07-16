<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;

class BlogContent extends Model
{
    protected $table = "BlogContent";

    protected $dateFormat = "U";

    protected $fillable = ['blog_id', 'content', 'md_content'];
}


