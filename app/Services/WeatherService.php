<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    /**
     * Get weather data by location name.
     *
     * @param string $location
     * @return array|null
     */
    public function getWeatherDataByLocation($location)
    {
        // Get location coordinates by name
        $coordinates = $this->getLocationCoordinates($location);

        if ($coordinates) {
            // Make a request to the One Call API using the coordinates
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'lat' => explode(',', $coordinates)[0], // Extract latitude
                'lon' => explode(',', $coordinates)[1], // Extract longitude
                'appid' => config('services.openweathermap.api_key'),
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            // Handle error cases
        }

        return null;
    }

    /**
     * Get location coordinates by location name.
     *
     * @param string $location
     * @return string|null
     */
    private function getLocationCoordinates($location)
    {
        // Make a request to the Geocoding API
        $response = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
            'q' => $location,
            'limit' => 1, // Limit to 1 result (optional)
            'appid' => config('services.openweathermap.api_key'),
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data) && count($data) > 0) {
                return $data[0]['lat'] . ',' . $data[0]['lon'];
            }
        }

        return null;
    }
}
