<?php
namespace App\Yooqin\Services;

use App\Yooqin\Models\SportRecord;
use Illuminate\Support\Facades\DB;

class SportService
{

    private static $target = [
        1=>[
            'target'=>'110KM',
            'target_value'=>110,
            'name'=>'跑步'
            ],
        2=>[
            'target'=>'200KM',
            'target_value'=>200,
            'name'=>'骑行' 
            ],
        3=>[
            'target'=>'550分钟',
            'target_value'=>550,
            'name'=>'器械' 
            ] 
        ];

    public static function getTarget()
    {

        $list = [];
        $begin = date("Ym")."01";
        $end = date("Ym").date("t", date("Ym"));
        $total = 0;
        foreach (self::$target as $_key=>$_val) {
            $_arr = $_val; 

            $sql = DB::raw('sum(distance) as total');
            $rs = DB::table('SportRecord')
                ->select($sql)
                ->where('day', '>=', $begin)
                ->where('day', '<=', $end)
                ->where('type', $_key)
                ->first();

            $_arr['total'] = isset($rs->total) ? $rs->total : 0;

            $_arr['pre'] = round($_arr['total'] / $_arr['target_value'], 2);

            $total += $_arr['pre'];
            $list[$_key] = $_arr;
        }


        return [
            'list'=>$list,
            'total'=>round($total / count(self::$target), 2) 
            ];

        return $list;
    }

    public static function getRecordList($request)
    {
        $start = date("Ymd", strtotime($request->start));  
        $end = date("Ymd", strtotime($request->stop));  

        $records = SportRecord::where('day', '>=', $start)
            ->where('day', '<=', $end)
            ->get();
        $list = [];
        if ($records) {
            foreach ($records as $_item) {
                $ts = $_item->time ? $_item->time : $_item->created_at;
                $max = 0;
                switch($_item->type){
                    case 1 :
                        $max = floor($_item->distance / 2); 
                        break;
                    case 2 :
                        $max = floor($_item->distance / 15); 
                        break;
                    case 3 :
                        $max = floor($_item->distance / 15); 
                        break;
                }

                for ($i=0; $i<$max; $i++) {
                    $list[$ts] = $_item->distance;
                    $ts += 100;
                }
            }
        }
        return $list;
    }

    public static function getList()
    {
        $start = date("Ymd", time() - 86400 * 60);  
        $end = date("Ymd");

        $records = SportRecord::where('day', '>=', $start)
            ->where('day', '<=', $end)
            ->orderBy('day', 'asc')
            ->get();
        $list = [];
        if ($records) {
            foreach ($records as $_item) {
                $_arr = $_item->toArray();
                $target = self::$target[$_arr['type']];
                $_arr['type_name'] = $target['name'];
                $_arr['target'] = $target['target'];
                $tde = $_arr['time'] ? date("Ymd H:i:s", $_arr['time']) : date("Ymd H:i:s", $_arr['created_at']);
                $_arr['time_date'] = $tde;
                $list[] = $_arr;
            }
        }
        return $list;
    }

}
