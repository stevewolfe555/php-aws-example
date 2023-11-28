<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeatherData($location)
    {
        // Make a request to the Geocoding API
        $response = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
            'q' => $location,
            'limit' => 1, // Limit to 1 result (optional)
            'appid' => config('services.openweathermap.api_key'),
        ]);

        
        // Check if the request was successful
        if ($response->successful()) {
            // Decode the JSON response
            $data = $response->json();
            
            // Extract and return the coordinates (first result)
            if (!empty($data) && count($data) > 0) {
                $coordinates = $data[0]['lat'] . ',' . $data[0]['lon'];
            }
        }

        if ($coordinates) {
            // Make a request to the One Call API using the coordinates
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'lat' => explode(',', $coordinates)[0], // Extract latitude
                'lon' => explode(',', $coordinates)[1], // Extract longitude
                'appid' => config('services.openweathermap.api_key'),
                'units' => 'metric',
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                // Return the JSON response as an array
                return $response->json();
            }

            // Handle error cases
            // You can define your error handling logic here
        }

        return null;

    }
}
