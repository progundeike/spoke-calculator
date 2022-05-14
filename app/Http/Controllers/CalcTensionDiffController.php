<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\SpokeLengthListRequest;
use Session;

class CalcTensionDiffController extends Controller
{
    public function calcTensionDiff(SpokeLengthListRequest $cross): float
    {
        $session = Session::all();
        //綾を取る２本のスポークの合力とハブ軸がなす角
        $crossRadR = deg2rad(360 / $session['hole'] * ($this->crossToVariables($cross['rightCross'])) / 4);
        $crossRadL = deg2rad(360 / $session['hole'] * ($this->crossToVariables($cross['leftCross'])) / 4);

        //垂直方向の長さ
        $Yr = ($session['erd'] / 2) - ($session['pcdR'] / 2) * cos($crossRadR);
        $Yl = ($session['erd'] / 2) - ($session['pcdL'] / 2) * cos($crossRadL);
        Log::debug($Yr);
        Log::debug($Yl);

        //水平方向の長さ
        $Xr = $session['centerFlangeR'] - ($session['nippleHoleGap'] / 2) + $session['rimOffset'];
        $Xl = $session['centerFlangeL'] - ($session['nippleHoleGap'] / 2) - $session['rimOffset'];
        Log::debug($Xr);
        Log::debug($Xl);
        //スポークテンションの左右差(L/R)
        $LRratio = (float) $Xr / $Xl * sqrt(($Xl ** 2) + ($Yl ** 2)) / sqrt(($Xr ** 2) + ($Yr ** 2)) * 100;
        $LRratio = round($LRratio, 2);
        return $LRratio;
    }

    private function crossToVariables(string $cross): int
    {
        if ($cross === '2本組') {
            $cross = CalcController::ONE_CROSS - 1;
        } elseif ($cross === '4本組') {
            $cross = CalcController::TWO_CROSS - 1;
        } elseif ($cross === '6本組') {
            $cross = CalcController::THREE_CROSS - 1;
        } elseif ($cross === '8本組') {
            $cross = CalcController::FOUR_CROSS - 1;
        } else {
            $cross = 0;
        }
        return $cross;
    }
}
