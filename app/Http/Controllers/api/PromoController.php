<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
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
