<?php

namespace App\Yooqin\Decorator;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 
use App\User;

class CommentsDecorator
{

    public static function transform($item){

        $data = [];
        $data = $item->toArray();

        $data['created_date'] = self::getDate($data['created_at']);

        $data['contact'] = substr_replace($data['communication'], '***', 3, 6);
        unset($data['communication']);

        $data['local'] = "****"; 
        $data['show_name'] = "";
        if (!$data['user_id']) {
            $data['show_name'] = "匿名-".$data['name'];
        } else {
            //获取用户信息
            $user = User::find($data['user_id']);
            $data['show_name'] = $data['name']."(".$user->name.")";
        }

        $data['content'] = mb_strimwidth($data['content'], 0, 500, '..');

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
