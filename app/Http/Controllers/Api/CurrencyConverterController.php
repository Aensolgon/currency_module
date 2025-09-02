<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyConvertRequest;
use App\Modules\Currency\Contracts\CurrencyConverterInterface;
use Illuminate\Http\JsonResponse;

class CurrencyConverterController extends Controller
{
    public function convert(CurrencyConvertRequest $request, CurrencyConverterInterface $converter): JsonResponse
    {
        $validated = $request->validated();

        try {
            $result = $converter->convert(
                $validated['amount'],
                $validated['from'],
                $validated['to']
            );
            return response()->json([
                'from' => $validated['from'],
                'to' => $validated['to'],
                'amount' => $validated['amount'],
                'converted' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
