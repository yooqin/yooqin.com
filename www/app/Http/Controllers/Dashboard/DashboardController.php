<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Yooqin\Creator\SportRecordCreator;
use App\Yooqin\Services\SportService;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $target_list = SportService::getTarget();
        $list = SportService::getList();
        return view('dashboard.index')
            ->with('target_list', $target_list['list'])
            ->with('target_total', $target_list['total'])
            ->with('list', $list);
    }

    public function store(Request $request)
    {
        if (!Auth::id()) {
            return $this->jsonFailed('请登录..'); 
        }

        $creator = new SportRecordCreator();
        $ret = $creator->create($request);

        if ($ret) {
            return $this->jsonSuccess('success');  
        } else {
            return $this->jsonFailed('失败'); 
        }
    }

    public function getRecord(Request $request)
    {
        $list = SportService::getRecordList($request);
        return response()->json($list); 
    }


}
