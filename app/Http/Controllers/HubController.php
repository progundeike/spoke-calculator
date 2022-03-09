<?php

namespace App\Http\Controllers;

use App\Models\Models\Hub;
use App\Http\Requests\HubsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HubController extends Controller
{
    public function index()
    {
        $lists = Hub::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('hub.index', ['lists' => $lists]);
    }

    public function create()
    {
        return view('hub.create');
    }

    public function store(HubsRequest $request, Hub $hubList)
    {
        $hubList->user_id = $request->user()->id;
        $hubList->hubModel = $request->hubModel;
        $hubList->hole = $request->hole;
        $hubList->centerFlangeR = $request->centerFlangeR;
        $hubList->centerFlangeL = $request->centerFlangeL;
        $hubList->pcdR = $request->pcdR;
        $hubList->pcdL = $request->pcdL;
        $hubList->hubMemo = $request->hubMemo;
        $hubList->save();
        return redirect()->route('hub.index');
    }
}
