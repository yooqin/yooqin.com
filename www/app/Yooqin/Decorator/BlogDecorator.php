<?php

namespace App\Yooqin\Decorator;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class BlogDecorator
{

    public static function transform($item){

        $data = [];
        $data = $item->toArray();
        $data['created_date'] = self::getDate($data['updated_at']);

        $data['blog_uri'] = $item->getBlogUri();
        //$data['user'] = $item->user;
        $data['source_name'] = $item->getSourceName();
        $data['type_name'] = $item->getBlogTypeName();
        $data['category_name'] = $item->getCategoryName();
        $data['content'] = $item->content->toArray();
        $data['user'] = $item->user;

        $data['tags'] = [];

        $tags = $item->tags;

        if (!empty($tags)) {
            foreach ($tags as $_t) {
                $data['tags'][] = $_t->tag;
            }
        }
        

        return $data;

    }

    public static function transformList($items){
        if (!$items) {
            return [];
        }

        $list = [
		'list'=>[],
		'paginate'=>[]
		];
        foreach ($items as $_item) {
            $list['list'][] = self::transform($_item); 
        }

        $list['paginate'] = self::getPaginate($items); 


        return $list;

    }

    public static function getPaginate($items){
        if (!method_exists($items, 'currentPage')) {
            return []; 
        }
        $data = [];
        $data['count'] = $items->count();
        $data['current_page'] = $items->currentPage();
        $data['last_item'] = $items->lastItem();
        $data['links'] = $items->links();
        return $data;
    }

    public static function getDate($ts){

        return date("Y-m-d H:i:s", $ts);
    
    }

}
