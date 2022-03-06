<?php

namespace App\Http\Controllers;

use App\Models\Models\Hub;
use App\Http\Requests\HubsRequest;
use Illuminate\Http\Request;

class HubController extends Controller
{
    private $hubModel;
    private $hole;
    private $pcdRight;
    private $pcdLeft;
    private $centerFlangeRight;
    private $centerFlangeLeft;
    private $hubMemo;
    private $user_id;

    public function index()
    {
        $lists = Hub::all()->sortByDesc('created_at');
        return view('hub', ['lists' => $lists]);
    }

    public function getFromSpokeLength(SpokeLengthListRequest $request){
        
    }

    public function store(Hub $list)
    {
        $list->hubModel = $this->hubModel;
        $list->hole = $this->hole;
        $list->pcdRight = $this->pcdRight;
        $list->pcdLeft = $this->pcdLeft;
        $list->centerFlangeRight = $this->centerFlangeRight;
        $list->centerFlangeLeft = $this->centerFlangeLeft;
        $list->hubMemo = $this->hubMemo;
        $list->user_id = $request->user()->id;
        $list->save();
    }
}
