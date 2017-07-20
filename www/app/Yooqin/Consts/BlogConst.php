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
        1=>'后端技术',
        2=>'前端技术',
        3=>'软件思想',
        4=>'服务器',
        5=>'观点感悟',
        6=>'项目管理',
        7=>'爱好者',
        8=>'其他',
        ];

    private static $lists = ['type_list', 'source_list', 'category_list'];

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
