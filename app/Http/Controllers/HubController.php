<?php

namespace App\Http\Controllers;

use App\Models\Models\Hub;
use App\Http\Requests\HubsRequest;
use App\Http\Requests\UpdateHubRequest;
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

    public function edit($id)
    {
        $hubData = Hub::find($id);
        return view('hub.edit', compact('hubData'));
    }

    public function destroy($id)
    {
        $hub = Hub::find($id);
        $hub->delete();
        return redirect()->route('hub.index');
    }

    public function update(UpdateHubRequest $request)
    {
        $hubList = Hub::find($request->id);
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

    static function getMyList()
    {
        $hubLists = Hub::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        $lists = [];
        foreach($hubLists as $hubList) {
            $lists[$hubList['id']] = $hubList['hubModel'];
        }

        if(!isset($lists)) {
            $lists[] = 'データがありません';
        }
        return $lists;
    }

    public function inputFormData(Request $request)
    {
        $hub = Hub::where('user_id', Auth::id())->where('id', $request->selectedHub)->first();

        return [
            'centerFlangeR' => $hub->centerFlangeR,
            'centerFlangeR' => $hub->centerFlangeL,
            'pcdR' => $hub->pcdR,
            'pcdL' => $hub->pcdL,
        ];
    }
}
