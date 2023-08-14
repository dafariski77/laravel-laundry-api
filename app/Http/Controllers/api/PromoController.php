<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\UpdatePromoRequest;
use App\Models\Promo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::with('shop')->get();

        return response()->json([
            "data" => $promos
        ], 200);
    }

    public function store(StorePromoRequest $request)
    {
        $promo = Promo::create($request->validated());

        return response()->json([
            "data" => $promo
        ], 201);
    }

    public function update(UpdatePromoRequest $request, Promo $promo)
    {
        $promo->update($request->validated());

        return response()->json([
            "data" => $promo
        ], 200);
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();

        return response()->json([
            "message" => "Data deleted!"
        ], 200);
    }

    public function readByShopId(string $shopId)
    {
        try {
            $promo = Promo::where('shop_id', $shopId)->firstOrFail()->with('shop')->get();

            return response()->json([
                "data" => $promo
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Data not found!'
            ], 404);
        }
    }

    function readAll()
    {
        $promos = Promo::with('shop')->get();

        return response()->json([
            "data" => $promos
        ], 200);
    }

    function readLimit()
    {
        $promos = Promo::latest()->limit(5)->with('shop')->get();

        if (count($promos) <= 0) {
            return response()->json([
                "message" => "Data empty"
            ], 404);
        }

        return response()->json([
            "data" => $promos
        ], 200);
    }
}
