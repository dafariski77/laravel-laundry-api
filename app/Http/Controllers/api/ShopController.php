<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $shops = Shop::where('owner_id', $user)->get();

        return response()->json([
            "data" => $shops
        ], 200);
    }

    public function store(StoreShopRequest $request)
    {
        $body = $request->validated();
        $body['owner_id'] = auth()->user()->id;        

        $shop = Shop::create($body);

        return response()->json([
            "data" => $shop
        ], 201);
    }

    public function show(Shop $shop)
    {
        return response()->json([
            "data" => $shop
        ], 200);
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $body = $request->validated();
        $body['owner_id'] = auth()->user()->id;

        $shop->update($body);

        return response()->json([
            "data" => $shop
        ], 200);
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();

        return response()->json([
            "message" => "Data deleted!"
        ], 200);
    }

    function readAll()
    {
        $shops = Shop::with('owner')->get();

        return response()->json([
            "data" => $shops
        ], 200);
    }

    function readRecommendationLimit()
    {
        $shops = Shop::orderBy('rate', 'desc')->limit(5)->get();

        if (count($shops) <= 0) {
            return response()->json([
                "message" => "Data empty"
            ], 404);
        }

        return response()->json([
            "data" => $shops
        ], 200);
    }

    function searchByCity($city)
    {
        $shops = Shop::where('city', 'like', '%' . $city . '%')->orderBy('name')->get();

        if (count($shops) <= 0) {
            return response()->json([
                "message" => "Data empty"
            ], 404);
        }

        return response()->json([
            "data" => $shops
        ], 200);
    }
}
