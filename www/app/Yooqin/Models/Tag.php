<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "Tag";

    protected $dateFormat = "U";

    protected $fillable = ['name', 'content', 'uri'];
}


