<?php

namespace App\Http\Controllers;

use App\Models\Models\Rim;
use App\Http\Requests\RimsRequest;
use App\Http\Requests\UpdateRimRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RimController extends Controller
{
    public function index()
    {
        $lists = Rim::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('rim.index', ['lists' => $lists]);
    }

    public static function getMyList()
    {
        $rimLists = Rim::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        $lists = [];
        foreach ($rimLists as $rimList) {
            $lists[$rimList['id']] = $rimList['rimModel'];
        }

        if (count($lists) === 0) {
            $lists[] = 'データがありません';
        }
        return $lists;
    }

    public function create()
    {
        return view('rim.create');
    }

    public function edit($rimId)
    {
        $rimData = Rim::find($rimId);
        return view('rim.edit', compact('rimData'));
    }

    public function store(RimsRequest $request, Rim $rimList)
    {
        $rimList->user_id = $request->user()->id;
        $rimList->rimModel = $request->rimModel;
        $rimList->hole = $request->hole;
        $rimList->erd = $request->erd;
        $rimList->nippleHoleGap = $request->nippleHoleGap;
        $rimList->rimOffset = $request->rimOffset;
        $rimList->rimMemo = $request->rimMemo;
        $rimList->save();
        return redirect()->route('rim.index');
    }

    public function destroy($rimId)
    {
        $rim = Rim::find($rimId);
        $rim->delete();
        return redirect()->route('rim.index');
    }

    public function update(UpdateRimRequest $request)
    {
        $rimList = Rim::find($request->id);
        $rimList->rimModel = $request->rimModel;
        $rimList->hole = $request->hole;
        $rimList->erd = $request->erd;
        $rimList->nippleHoleGap = $request->nippleHoleGap;
        $rimList->rimOffset = $request->rimOffset;
        $rimList->rimMemo = $request->rimMemo;
        $rimList->save();
        return redirect()->route('rim.index');
    }

    public function inputFormData(Request $request)
    {
        $rim = Rim::where('user_id', Auth::id())->where('id', $request->selectedRim)->first();

        return [
            'hole' => $rim->hole,
            'erd' => $rim->erd,
            'rimOffset' => $rim->rimOffset,
            'nippleHoleGap' => $rim->nippleHoleGap,
        ];
    }
}
