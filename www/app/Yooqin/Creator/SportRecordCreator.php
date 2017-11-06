<?php 

namespace App\Yooqin\Creator; 

use Illuminate\Http\Request;
use App\Yooqin\Models\SportRecord;

class SportRecordCreator{
    
    public function create(Request $request){

        $data = [
            'title'=>$request->title,
            'day'=>$request->day,
            'type'=>$request->type,
            'distance'=>$request->distance,
            'time'=>$request->time 
            ];
        $sport = new SportRecord();
        $sport->title = $data['title'];
        $sport->day = $data['day'];
        $sport->type = $data['type'];
        $sport->distance = $data['distance'];
        $time = $data['time'] ? strtotime($data['time']) : 0;
        $sport->time = $time;

        return $sport->save();
    }
}
