<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\SpokeLengthList;
use App\Http\Requests\SpokeLengthListRequest;
use App\Http\Requests\UpdateWheelRequest;
use App\Models\Models\Hub;
use App\Models\Models\Rim;
use Illuminate\Http\RedirectResponse;

class SpokeLengthListController extends Controller
{

    public function index()
    {
        $lists = SpokeLengthList::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('wheel.index', ['lists' => $lists]);
    }

    private function getLengthFromCross(SpokeLengthListRequest $request) : array
    {
        $crossR = $request->crossR;
        if($crossR === 'one') {
            $lengthR = $request->radialR;
        } elseif($crossR === 'two') {
            $lengthR = $request->twoCrossR;
        } elseif($crossR === 'three') {
            $lengthR = $request->threeCrossR;
        } elseif($crossR === 'four') {
            $lengthR = $request->fourCrossR;
        }

        $crossL = $request->crossL;
        if($request->crossL === 'one') {
            $lengthL = $request->radialL;
        } elseif($crossL === 'two') {
            $lengthL = $request->twoCrossL;
        } elseif($crossL === 'three') {
            $lengthL = $request->threeCrossL;
        } elseif($crossL === 'four') {
            $lengthL = $request->fourCrossL;
        }

        return ['R' => $lengthR, 'L' =>$lengthL];
    }

    public function store(SpokeLengthListRequest $request, SpokeLengthList $list, Hub $hubList, Rim $rimList)
    {
        $list->hubModel = $request->hubModel;
        $list->rimModel = $request->rimModel;
        $list->crossR = $request->crossR;
        $list->crossL = $request->crossL;
        $list->user_id = $request->user()->id;

        $length = $this->getLengthFromCross($request);
        $list->lengthR = $length['R'];
        $list->lengthL = $length['L'];
        $list->wheelMemo = $request->wheelMemo;

        $hubList->user_id = $request->user()->id;
        $hubList->hubModel = $request->hubModel;
        $hubList->hole = $request->hole;
        $hubList->centerFlangeR = $request->centerFlangeR;
        $hubList->centerFlangeL = $request->centerFlangeL;
        $hubList->pcdR = $request->pcdR;
        $hubList->pcdL = $request->pcdL;

        $rimList->user_id = $request->user()->id;
        $rimList->rimModel = $request->rimModel;
        $rimList->hole = $request->hole;
        $rimList->erd = $request->erd;
        $rimList->nippleHoleGap = $request->nippleHoleGap;
        $rimList->rimOffset = $request->rimOffset;
        $rimList->rimMemo = $request->rimMemo;

        $list->save();
        $hubList->save();
        $rimList->save();
        return redirect()->route('wheel.index');
    }

    public function destroy($id)
    {
        $wheel = SpokeLengthList::find($id);
        $wheel->delete();
        return redirect()->route('wheel.index');
    }

    public function edit($id)
    {
        $wheel = SpokeLengthList::find($id);
        return view('wheel.edit', compact('wheel'));
    }

    public function update(UpdateWheelRequest $request)
    {
        $wheel = SpokeLengthList::find($request->id);
        $wheel->wheelMemo = $request->wheelMemo;
        $wheel->save();
        return redirect()->route('wheel.index');
    }
}
