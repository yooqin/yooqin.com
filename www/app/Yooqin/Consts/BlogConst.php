<?php

namespace App\Yooqin\Consts;

class BlogConst
{
    const DEFAULT_TYPE = 1;
    const DEFAULT_SOURCE = 1;
    const DEFAULT_VIEWS = 1;
    const BLOG_DETAIL_PREFIX = "/blog/show";

    public static $type_list = [
        1=>'普通博文', 
        2=>'图片相册', 
        3=>'读后感', 
        ];

    public static $source_list = [
        1=>'原创', 
        2=>'转载', 
        ];

    public static $category_list = [
        1=>'编程技术',
        2=>'服务器',
        3=>'生活日志',
        4=>'其他',
        ];

    public static function getValue($list, $key){
        if (!$list || !$key) {
            return '';
        }

        if (empty(self::${$list})) {
            return '';
        }

        if (!self::${$list}[$key]) {
            return '';
        }

        return self::${$list}[$key];

    }

}
