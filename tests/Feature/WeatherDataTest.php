<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherDataTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_weather_data_for_a_location()
    {
        $response = $this->get('/api/weather/paris');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'location',
            'temperature',
            'conditions'
        ]);
    }
}
