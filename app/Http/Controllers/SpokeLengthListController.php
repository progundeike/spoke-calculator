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

    private function getLengthFromCross(string $crossR, string $crossL) : array
    {
        if($crossR === 'one') {
            $lengthR = session('radialR');
        } elseif($crossR === 'two') {
            $lengthR = session('twoCrossR');
        } elseif($crossR === 'three') {
            $lengthR = session('threeCrossR');
        } elseif($crossR === 'four') {
            $lengthR = session('fourCrossR');
        }

        if($crossL === 'one') {
            $lengthL = session('radialL');
        } elseif($crossL === 'two') {
            $lengthL = session('twoCrossL');
        } elseif($crossL === 'three') {
            $lengthL = session('threeCrossL');
        } elseif($crossL === 'four') {
            $lengthL = session('fourCrossL');
        }

        return ['R' => $lengthR, 'L' =>$lengthL];
    }

    public function store(SpokeLengthListRequest $request, SpokeLengthList $list, Hub $hubList, Rim $rimList)
    {
        $list->user_id = $hubList->user_id = $rimList->user_id = $request->user()->id;
        $list->hubModel = $hubList->hubModel = session('hubModel');
        $list->rimModel = $rimList->rimModel = session('rimModel');
        $list->crossR = $request->crossR;
        $list->crossL = $request->crossL;

        $length = $this->getLengthFromCross($request->crossR, $request->crossL);
        $list->lengthR = $length['R'];
        $list->lengthL = $length['L'];
        $list->wheelMemo = $request->wheelMemo;

        $hubList->hole = $rimList->hole = session('hole');
        $hubList->centerFlangeR = session('centerFlangeR');
        $hubList->centerFlangeL = session('centerFlangeL');
        $hubList->pcdR = session('pcdR');
        $hubList->pcdL = session('pcdL');

        $rimList->erd = session('erd');
        $rimList->nippleHoleGap = session('nippleHoleGap');
        $rimList->rimOffset = session('rimOffset');
        $rimList->rimMemo = session('rimMemo');

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
