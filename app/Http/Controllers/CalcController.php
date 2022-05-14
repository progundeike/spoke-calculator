<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalcRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CalcTensionDiffController;

class CalcController extends Controller
{
    private $erd;
    private $hole;
    private $pcd;
    private $flangeDistance;
    private $rimOffset;
    private $nippleHoleGap = 0;
    public const RADIAL = 1;
    public const ONE_CROSS = 2;
    public const TWO_CROSS = 4;
    public const THREE_CROSS = 6;
    public const FOUR_CROSS = 8;
    public const SPOKE_HOLE_DIAMETER = 2.5;

    protected $redirectTo = '/';

    private function getCorrectionValue(int $cross): float
    {
        $value = (float) 0.7;
        if ($cross === self::RADIAL) {
            $value += 1.2;
        }
        return $value;
    }

    private function getSpokeLength(int $cross, string $side): float
    {
        $correctionValue = $this->getCorrectionValue($cross);
        $deg = 360 / $this->hole * $cross;
        $temp = ($this->erd / 2) ** 2 + ($this->pcd[$side] / 2) ** 2 + $this->flangeDistance[$side] ** 2;
        $cos = cos(deg2rad($deg));
        $square =  $temp - 2 * ($this->erd / 2) * ($this->pcd[$side] / 2) * $cos;

        $spokeLength = sqrt($square) - (self::SPOKE_HOLE_DIAMETER / 2) - $correctionValue;
        $spokeLength = round($spokeLength, 1);
        return $spokeLength;
    }

    public function calc(CalcRequest $request)
    {
        $this->erd = (float) $request->erd;
        $this->hole = (int) $request->hole;
        $this->rimOffset = (float) $request->rimOffset;
        $this->pcd = ['R' => (float) $request->pcdR, 'L' => (float) $request->pcdL];

        $this->flangeDistance = [
            'R' => (float) $request->centerFlangeR - $this->rimOffset,
            'L' => (float) $request->centerFlangeL + $this->rimOffset,
            ];

        $radialR = $this->getSpokeLength(self::RADIAL, 'R');
        $radialL = $this->getSpokeLength(self::RADIAL, 'L');
        $oneCrossR = $this->getSpokeLength(self::ONE_CROSS, 'R');
        $oneCrossL = $this->getSpokeLength(self::ONE_CROSS, 'L');
        $twoCrossR = $this->getSpokeLength(self::TWO_CROSS, 'R');
        $twoCrossL = $this->getSpokeLength(self::TWO_CROSS, 'L');
        $threeCrossR = $this->getSpokeLength(self::THREE_CROSS, 'R');
        $threeCrossL = $this->getSpokeLength(self::THREE_CROSS, 'L');
        $fourCrossR = $this->getSpokeLength(self::FOUR_CROSS, 'R');
        $fourCrossL = $this->getSpokeLength(self::FOUR_CROSS, 'L');

        $rimModel = $request->rimModel ?? 'リム';
        $hubModel = $request->hubModel ?? 'ハブ';

        //計算後にsessionに入れる
        session([
            'hole' => $this->hole,
            //spoke length
            'radialR' => $radialR,
            'radialL' => $radialL,
            'oneCrossR' => $oneCrossR,
            'oneCrossL' => $oneCrossL,
            'twoCrossR' => $twoCrossR,
            'twoCrossL' => $twoCrossL,
            'threeCrossR' => $threeCrossR,
            'threeCrossL' => $threeCrossL,
            'fourCrossR' => $fourCrossR,
            'fourCrossL' => $fourCrossL,
            //rim
            'rimModel' => $rimModel,
            'erd' => $this->erd,
            'rimOffset' => $this->rimOffset,
            'nippleHoleGap' => $this->nippleHoleGap,
            //hub
            'hubModel' => $hubModel,
            'pcdL' => $this->pcd['L'],
            'pcdR' => $this->pcd['R'],
            'centerFlangeR' => $request->centerFlangeR,
            'centerFlangeL' => $request->centerFlangeL,
        ]);
        
        return view('length');
    }
}
