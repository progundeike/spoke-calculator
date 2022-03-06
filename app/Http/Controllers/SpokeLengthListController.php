<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\SpokeLengthList;
use App\Http\Requests\SpokeLengthListRequest;
use App\Models\Models\Hub;
use App\Models\Models\Rim;
use Illuminate\Http\RedirectResponse;

class SpokeLengthListController extends Controller
{

    public function index()
    {
        $lists = SpokeLengthList::all()->sortByDesc('created_at');

        return view('myDatabase', ['lists' => $lists]);
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
        return redirect()->route('myDatabase.index');
    }
}
