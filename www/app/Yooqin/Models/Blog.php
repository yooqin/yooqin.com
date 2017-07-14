<?php

namespace App\Yooqin\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    const DEFAULT_TYPE = 1;
    const DEFAULT_SOURCE = 1;
    const DEFAULT_VIEWS = 1;

    private $type_list = [
        1=>'普通博文', 
        2=>'图片相册', 
        3=>'读后感', 
        ];

    private $source_list = [
        1=>'原创', 
        2=>'转载', 
        ];

    public function socpeFindUri($query, $uri){
        return $query->where('uri', $uri);
    }

}
