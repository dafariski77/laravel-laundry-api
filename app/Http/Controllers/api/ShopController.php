<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function readAll()
    {
        $shops = Shop::all();

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
