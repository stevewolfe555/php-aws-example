<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'location' => $request->query('location'),
            'temperature' => '20°C',
            'conditions' => 'Sunny'
        ]);
    }
}
