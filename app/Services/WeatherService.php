<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHER_API_KEY');
    }

    public function getWeather($city)
    {
        // Tạm thời bỏ Cache để test trực tiếp
        // return Cache::remember(...) -> sửa thành gọi trực tiếp như sau:

        try {
            $response = Http::get($this->baseUrl, [
                'q' => $city,
                'appid' => $this->apiKey, // Đảm bảo key này đã lấy đúng từ env
                'units' => 'metric',
                'lang' => 'vi'
            ]);

            // Nếu lỗi, in ra lỗi để xem
            if ($response->failed()) {
                dd($response->body(), $this->apiKey); // Dừng lại và xem lỗi gì
            }

            return $response->json();
        } catch (\Exception $e) {
            dd($e->getMessage()); // Xem lỗi kết nối
            return null;
        }
    }
}