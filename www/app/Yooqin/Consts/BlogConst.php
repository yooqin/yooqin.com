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

    public static $category_detail_list = [
        1=>[
            'title'=>'后端技术栏目,涵盖php、shell、mysql、python等)',
            'description'=>'后端技术涵盖php、shell、mysql、python等各种后端技术',
            'keywords'=>'后端,php,shell,mysql,python' 
        ], 
        2=>[
            'title'=>'前端技术栏目,涵盖html、css、javascript、jQuery、vue、webpack等',
            'description'=>'前端技术:涵盖html、css、javascript、jQuery、vue、webpack、前端工程等',
            'keywords'=>'前端,html,css,javascript,jQuery,vue,webpack' 
        ], 
        3=>[
            'title'=>'软件思想栏目,编程方面各类设计思想设计模式的学习及经验',
            'description'=>'软件思想类型主要有各种设计思想、设计模式等软件开发方法',
            'keywords'=>'软件思想,面向对象,ooa,oop,设计模式,开发流程' 
        ], 
        4=>[
            'title'=>'服务器栏目,涵盖linux centos mysql git shell等各类服务器维护经验方法',
            'description'=>'服务器类型涵盖linux centos mysql git shell等各类服务器维护经验方法',
            'keywords'=>'linux,服务器,centos7,git,shell,运维' 
        ], 
        5=>[
            'title'=>'观点感悟栏目,万事均需思考，思考需要记录',
            'description'=>'观点感悟栏目:万事均需思考，思考需要记录',
            'keywords'=>'观点,开发思考,每日感悟,学习思考' 
        ], 
        6=>[
            'title'=>'项目管理栏目，软件开发项目管理流程管理及团队管理',
            'description'=>'项目管理栏目，软件开发项目管理流程管理及团队管理',
            'keywords'=>'项目管理,软件开发,团队管理,开发流程' 
        ], 
        7=>[
            'title'=>'爱好栏目,个人爱好目前基本为骑行、跑步、旅行',
            'description'=>'爱好栏目,个人爱好目前基本为骑行、跑步、旅行',
            'keywords'=>'爱好,跑步,骑行,旅游' 
        ], 
        8=>[
            'title'=>'其他栏目,其他未分类的内容为滕州秦伟无法进行分类的内容',
            'description'=>'其他内容包含滕州秦伟暂时无法归入已有分类的内容',
            'keywords'=>'内容,其他,秦伟,滕州,日照' 
        ] 
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
