<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Modulo3FsmService;

class Modulo3Controller extends Controller
{
    public function compute(Request $request)
    {
        $data = $request->validate([
            'bits' => ['required'],
        ]);

        $bitsRaw = $data['bits'];

        // Normalize to iterable of bits
        if (is_string($bitsRaw)) {
            if (!preg_match('/^[01]+$/', $bitsRaw)) {
                return response()->json(['error' => 'Bits string must contain only 0 and 1'], 422);
            }
            $bitsIterable = str_split($bitsRaw);
        } elseif (is_array($bitsRaw)) {
            foreach ($bitsRaw as $b) {
                if (!in_array($b, [0, 1, '0', '1'], true)) {
                    return response()->json(['error' => 'Bits array must contain only 0 or 1'], 422);
                }
            }
            $bitsIterable = $bitsRaw;
        } else {
            return response()->json(['error' => 'Bits must be a string or array of 0/1'], 422);
        }

        $fsm = new Modulo3FsmService();
        $result = $fsm->feed($bitsIterable);

        return response()->json([
            'input'       => $bitsRaw,
            'final_state' => $result['final_state'],
            'remainder'   => $result['remainder'],
            'divisible'   => $result['divisible'],
        ]);
    }
}
