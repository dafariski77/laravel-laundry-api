<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaundryRequest;
use App\Http\Requests\UpdateLaundryRequest;
use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    public function index()
    {
        $laundries = Laundry::with('user', 'shop')->get();

        return response()->json([
            "data" => $laundries
        ], 200);
    }

    public function store(StoreLaundryRequest $request)
    {
        $body = $request->validated();
        $body['user_id'] = 0;

        $laundry = Laundry::creaete($body);

        return response()->json([
            'data' => $laundry
        ], 201);
    }

    public function show(Laundry $laundry)
    {
        $laundry->with('user', 'shop')->get();

        return response()->json([
            'data' => $laundry
        ], 200);
    }

    public function update(UpdateLaundryRequest $request, Laundry $laundry)
    {
        $laundry->update($request->validated());

        return response()->json([
            'data' => $laundry
        ], 200);
    }

    public function destroy(Laundry $laundry)
    {
        $laundry->delete();

        return response()->json([
            'message' => 'Data deleted!'
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

    // Untuk Tracking Status Laundry, claim jika ingin memantaunya. Tidak otomatis ada
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
            "data" => $laundry
        ]);
    }
}
