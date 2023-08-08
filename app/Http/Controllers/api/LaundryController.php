<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    function readAll()
    {
        $laundries = Laundry::with('user', 'shop')->get();

        return response()->json([
            "data" => $laundries
        ], 200);
    }

    function readByUserId()
    {
        $laundries = Laundry::where('user_id', auth()->user()->id)->latest()->get();

        if (count($laundries) <= 0) {
            return response()->json([
                "message" => "Data empty"
            ], 404);
        }

        return response()->json([
            "data" => $laundries
        ], 200);
    }

    function claim(Request $request)
    {
        $laundry = Laundry::where([
            ['id', $request->id],
            ['claim_code', $request->claim_code]
        ])->first();

        if (!$laundry) {
            return response()->json([
                "message" => "Data not found!"
            ], 404);
        }

        if ($laundry->user_id != 0) {
            return response()->json([
                "message" => "Laundry claimed!"
            ], 400);
        }

        $laundry->user_id = auth()->user()->id;
        $updated = $laundry->save();

        if (!$updated) {
            return response()->json([
                "message" => "Server error!"
            ], 500);
        }

        return response()->json([
            "data" => $updated
        ]);
    }
}
