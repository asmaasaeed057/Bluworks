<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AlphaStringRequest;
use App\Http\Requests\Api\CountNumbersRequest;

class ProblemSolvingController extends Controller
{

    public const ALPHABETICAL_ARRAY = [
        'A' => 1, 'B' => 2, 'C' => 3, 'D' => 4, 'E' => 5, 'F' => 6, 'G' => 7, 'H' => 8, 'I' => 9, 'J' => 10, 'K' => 11,
        'L' => 12, 'M' => 13, 'N' => 14, 'O' => 15, 'P' => 16, 'Q' => 17, 'R' => 18, 'S' => 19, 'T' => 20, 'U' => 21,
        'V' => 22, 'W' => 23, 'X' => 24, 'Y' => 25, 'Z' => 26
    ];

    /**
     * Get Count Numbers Except Including Number Five.
     *
     * @param CountNumbersRequest $request
     *
     * @return JsonResponse
     */

    public function getCountNumbers(CountNumbersRequest $request)
    {
        try {
            $exceptNumber = 5;
            $countNumbers = 0;
            foreach (range($request->start, $request->end) as $num) {
                if (!in_array($exceptNumber, str_split($num))) {
                    $countNumbers++;
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Count calculated successfully!',
                'data' => ['count' => $countNumbers]
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => "Something wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Position Of Input String.
     * 
     * example:
     * BZ =>  ZB  78
     * (pow(26, 0) * 26)  +  (pow(26, 1) * 2)
     * BFG  => GFB  1515
     * (pow(26, 0) * 7)  +  (pow(26, 1) * 6) + (pow(26, 2) * 2)
     *
     * @param AlphaStringRequest $request
     *
     * @return JsonResponse
     */

    public function getIndexOfString(AlphaStringRequest $request)
    {
        try {
            $arrAlphaInputs = str_split(strrev(strtoupper($request->alpha_string)));
            $position = 0;
            for ($i = 0; $i < count($arrAlphaInputs); $i++) {
                $position +=  pow(self::ALPHABETICAL_ARRAY['Z'], $i) * self::ALPHABETICAL_ARRAY[$arrAlphaInputs[$i]];
            }
            return response()->json([
                'status' => true,
                'message' => 'Position of the input calculated successfully!',
                'data' => ['position' => $position]
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => "Something wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
