<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    public function getWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
        ]);

        $city = $request->input('city');

        try {
            $weatherResponse = $this->client->get("https://api.openweathermap.org/data/2.5/weather", [
                'query' => [
                    'q' => $city,
                    'units' => 'metric',
                    'appid' => $this->apiKey,
                ]
            ]);

            $weatherData = json_decode($weatherResponse->getBody(), true);

            $forecastResponse = $this->client->get("https://api.openweathermap.org/data/2.5/forecast", [
                'query' => [
                    'q' => $city,
                    'units' => 'metric',
                    'appid' => $this->apiKey,
                ]
            ]);

            $forecastData = json_decode($forecastResponse->getBody(), true);

            $response = [
                'current' => [
                    'temperature' => round($weatherData['main']['temp']),
                    'description' => $weatherData['weather'][0]['description'],
                    'icon' => $weatherData['weather'][0]['icon'],
                    'wind_speed' => $weatherData['wind']['speed'] * 3.6,
                    'humidity' => $weatherData['main']['humidity'],
                    'date' => date('d M Y', $weatherData['dt']),
                    'city' => $weatherData['name'],
                ],
                'forecast' => [],
            ];

            $dailyForecasts = [];
            foreach ($forecastData['list'] as $entry) {
                $date = date('Y-m-d', $entry['dt']);
                if (!isset($dailyForecasts[$date]) && count($dailyForecasts) < 3) {
                    $dailyForecasts[$date] = [
                        'date' => date('d M', $entry['dt']),
                        'temperature' => round($entry['main']['temp']),
                        'description' => $entry['weather'][0]['description'],
                        'icon' => $entry['weather'][0]['icon'],
                    ];
                }
            }

            $response['forecast'] = array_values($dailyForecasts);

            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error('Weather fetch error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch weather data: ' . $e->getMessage()
            ], 500);
        }
    }
}