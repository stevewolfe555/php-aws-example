<?php

namespace Tests\Unit;

use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_weather_data_by_location()
    {
        // Mock HTTP client to return a predefined response
        Http::fake([
            'https://api.openweathermap.org/*' => Http::response([
                'main' => [
                    'temp' => 20.0,
                ],
                'weather' => [
                    [
                        'description' => 'Sunny',
                    ],
                ],
            ]),
        ]);

        // Create an instance of the WeatherService
        $weatherService = new WeatherService();

        // Call the getWeatherDataByLocation method
        $weatherData = $weatherService->getWeatherDataByLocation('Paris');

        // Assert the expected weather data
        $this->assertEquals(20.0, $weatherData['main']['temp']);
        $this->assertEquals('Sunny', $weatherData['weather'][0]['description']);
    }
}
