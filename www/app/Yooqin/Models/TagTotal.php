<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;

class TagTotal extends Model
{
    protected $table = "TagTotal";

    protected $dateFormat = "U";

    protected $fillable = ['tag_id', 'type', 'total'];
}


