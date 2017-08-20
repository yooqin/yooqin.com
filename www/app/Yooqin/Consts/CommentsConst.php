<?php

namespace App\Yooqin\Consts;

class BlogConst
{
    const TYPE_BLOG = 1;
    const TYPE_NEWS = 2;
    const TYPE_WEBSITE = 3;

    public static $type_list = [
        self::TYPE_BLOG=>'博客', 
        self::TYPE_NEWS=>'新闻资讯', 
        self::TYPE_WEBSITE=>'网站', 
        ];


    private static $lists = ['type_list'];

    public static function getList(){
        $list = [];
        foreach (self::$lists as $_value) {
            foreach (self::${$_value} as $_key=>$_name) {
                $_arr['id'] = $_key;
                $_arr['name'] = $_name;
                $list[$_value][] = $_arr;
            }
        }
        return $list;
    }

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
