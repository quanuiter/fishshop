<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Services\WeatherService; // Import Service

class HomeController extends Controller
{
    protected $weatherService;

    // Inject WeatherService vào Constructor
    public function __construct(WeatherService $weatherService)
    {
        // $this->middleware('auth'); // Comment dòng này nếu muốn trang chủ ai cũng xem được
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        // 1. Danh sách thành phố hỗ trợ (Key là tên gửi cho API, Value là tên hiển thị)
        $availableCities = [
            'Ho Chi Minh' => 'TP. Hồ Chí Minh',
            'Hanoi' => 'Hà Nội',
            'Da Nang' => 'Đà Nẵng',
            'Vung Tau' => 'Vũng Tàu',
            'Can Tho' => 'Cần Thơ',
            'Hai Phong' => 'Hải Phòng',
            'Nha Trang' => 'Nha Trang',
            'Hue' => 'Huế',
            'Da Lat' => 'Đà Lạt',
            'Phu Quoc' => 'Phú Quốc',
            'Quy Nhon' => 'Quy Nhơn',
            'Phan Thiet' => 'Phan Thiết'
        ];

        // 2. Xác định danh sách cần lấy thời tiết
        $selectedCity = $request->input('city'); // Lấy giá trị từ combobox

        // Nếu người dùng đã chọn, chỉ lấy thành phố đó. Nếu không, lấy 4 thành phố mặc định.
        $citiesToFetch = $selectedCity ? [$selectedCity] : ['Ho Chi Minh', 'Hanoi', 'Da Nang', 'Vung Tau'];

        $weatherData = [];
        $apiKey = env('OPENWEATHER_API_KEY');

        if ($apiKey) {
            foreach ($citiesToFetch as $cityKey) {
                // Cache 30 phút
                $data = Cache::remember("weather_{$cityKey}", 1800, function () use ($cityKey, $apiKey) {
                    try {
                        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                            'q' => $cityKey,
                            'appid' => $apiKey,
                            'units' => 'metric',
                            'lang' => 'vi'
                        ]);
                        return $response->successful() ? $response->json() : null;
                    } catch (\Exception $e) {
                        return null;
                    }
                });

                if ($data) {
                    $weatherData[] = $data;
                }
            }
        }
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'weatherData' => $weatherData,
                'selectedCity' => $selectedCity
            ]);
        }
        // Truyền thêm biến $availableCities và $selectedCity sang view
        return view('homepage', compact('weatherData', 'availableCities', 'selectedCity'));
    }
}