<?php

namespace Tests\Feature;

use App\Services\WeatherService;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;

class WeatherServiceTest extends TestCase
{

    /** @test */
    public function it_can_retrieve_weather_data()
    {
        // Mock the HTTP client to return a predefined response
        Http::fake([
            'https://api.openweathermap.org/*' => Http::response([
                'temperature' => '20°C',
                'conditions' => 'Sunny',
            ]),
        ]);

        // Create an instance of the WeatherService
        $weatherService = new WeatherService();

        // Call the getWeatherData method
        $weatherData = $weatherService->getWeatherDataByLocation('Paris');

        // Assert the expected weather data
        $this->assertEquals('20°C', $weatherData['temperature']);
        $this->assertEquals('Sunny', $weatherData['conditions']);
    }
}
