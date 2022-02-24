<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalcRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CalcController extends Controller
{
    private $erd;
    private $hole;
    private $pcd;
    private $flangeDistance;

    const RADIAL = 1;
    const TWO_CROSS = 4;
    const THREE_CROSS = 6;
    const FOUR_CROSS = 8;
    const SPOKE_HOLE_DIAMETER = 2.5;

    protected $redirectTo = '/';

    public function getCorrectionValue(int $cross): float
    {
        $value = (float) 1;
        if($cross === self::RADIAL) {
            $value += 1.2;
        }
        return $value;
    }

    public function getSpokeLength(int $cross, string $side): float
    {
        $correctionValue = $this->getCorrectionValue($cross);
        $deg = 360 / $this->hole * $cross;
        $a = ($this->erd / 2) ** 2 + ($this->pcd[$side] / 2) ** 2 + $this->flangeDistance[$side] ** 2;
        $cos = cos(deg2rad($deg));
        $square =  $a - 2 * ($this->erd / 2) * ($this->pcd[$side] / 2) * $cos;

        $spokeLength = sqrt($square) - (self::SPOKE_HOLE_DIAMETER / 2) - $correctionValue;
        $spokeLength = round($spokeLength, 1);
        return $spokeLength;
    }

    public function calc(CalcRequest $request)
    {
        $this->erd = (float) $request->erd;
        $this->hole = (int) $request->numberOfSpoke;
        $this->rimOffset = (float) $request->rimOffset;
        $this->pcd = ['R' => (float) $request->pcdRight, 'L' => (float) $request->pcdLeft];
        $this->flangeDistance = [
            'R' => (float) $request->centerFlangeRight - $request->rimOffset,
            'L' => (float) $request->centerFlangeLeft + $request->rimOffset,
            ];

        $radialR = $this->getSpokeLength(self::RADIAL, 'R');
        $radialL = $this->getSpokeLength(self::RADIAL, 'L');
        $twoCrossR = $this->getSpokeLength(self::TWO_CROSS, 'R');
        $twoCrossL = $this->getSpokeLength(self::TWO_CROSS, 'L');
        $threeCrossR = $this->getSpokeLength(self::THREE_CROSS, 'R');
        $threeCrossL = $this->getSpokeLength(self::THREE_CROSS, 'L');
        $fourCrossR = $this->getSpokeLength(self::FOUR_CROSS, 'R');
        $fourCrossL = $this->getSpokeLength(self::FOUR_CROSS, 'L');

        return view('length', [
            'radialR' => $radialR,
            'radialL' => $radialL,
            'twoCrossR' => $twoCrossR,
            'twoCrossL' => $twoCrossL,
            'threeCrossR' => $threeCrossR,
            'threeCrossL' => $threeCrossL,
            'fourCrossR' => $fourCrossR,
            'fourCrossL' => $fourCrossL,
        ]);
    }
}
