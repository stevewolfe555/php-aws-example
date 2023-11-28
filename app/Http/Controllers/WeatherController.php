<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function show(Request $request, $location)
    {
        // Create an instance of the WeatherService
        $weatherService = new WeatherService();

        // Call the getWeatherData method to retrieve weather data
        $weatherData = $weatherService->getWeatherDataByLocation($location);

        if ($weatherData) {
            // Extract and format the specific data
            $formattedData = [
                'location' => $weatherData['name'],
                'temperature' => $weatherData['main']['temp'],
                'conditions' => $weatherData['weather'][0]['description'],
            ];

            // Return the formatted data as a JSON response
            return new JsonResponse($formattedData);
        } else {
            // Handle the case when weather data is not available
            return new JsonResponse(['error' => 'Weather data not found'], 404);
        }
    }
}
