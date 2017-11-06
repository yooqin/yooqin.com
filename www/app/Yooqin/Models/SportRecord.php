<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;

class SportRecord extends Model
{
    protected $table = "SportRecord";

    protected $dateFormat = "U";

    protected $fillable = ['title', 'day', 'type', 'distance', 'time'];
}


