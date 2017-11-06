<?php 

namespace App\Yooqin\Creator; 

use Illuminate\Http\Request;
use App\Yooqin\Models\SportRecord;

class SportRecordCreator{
    
    public function create(Request $request){

        $data = [
            'title'=>$request->title,
            'type'=>$request->type,
            'distance'=>$request->distance,
            'time'=>$request->time 
            ];
        $sport = new SportRecord();
        $sport->title = $data['title'];
        $day = isset($data['time']) ? $data['time'] : date("Ymd H:i:s");
        $day = date("Ymd", strtotime($day));
        $sport->day = $day;
        $sport->type = $data['type'];
        $sport->distance = $data['distance'];
        $time = $data['time'] ? strtotime($data['time']) : 0;
        $sport->time = $time;

        return $sport->save();
    }
}
