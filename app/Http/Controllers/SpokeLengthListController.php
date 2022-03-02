<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\SpokeLengthList;
use App\Http\Requests\SpokeLengthListRequest;
use App\Http\Requests\CalcRequest;
use Illuminate\Http\RedirectResponse;

class SpokeLengthListController extends Controller
{
    private $lengthR;
    private $lengthL;

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

    public function store(SpokeLengthListRequest $request, SpokeLengthList $list)
    {
        $list->hubModel = $request->hubModel;
        $list->rimModel = $request->rimModel;
        $list->crossR = $request->crossR;
        $list->crossL = $request->crossL;
        $list->user_id = $request->user()->id;

        $length = $this->getLengthFromCross($request);
        $list->lengthR = $length ['R'];
        $list->lengthL = $length ['L'];
        $list->wheelMemo = $request->wheelMemo;

        $list->save();
        return redirect()->route('myDatabase.index');
    }
}
