<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('product_images')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // ===========================
        // CATEGORIES
        // ===========================
        $categories = [
            ['name' => 'Cần câu',   'slug' => 'can-cau'],
            ['name' => 'Máy câu',   'slug' => 'may-cau'],
            ['name' => 'Dây câu',   'slug' => 'day-cau'],
            ['name' => 'Mồi & Lưỡi','slug' => 'moi-luoi'],
            ['name' => 'Phụ kiện',  'slug' => 'phu-kien'],
        ];
        foreach ($categories as &$cat) {
            $cat['created_at'] = $now;
            $cat['updated_at'] = $now;
        }
        DB::table('categories')->insert($categories);
        $catId = fn($slug) => DB::table('categories')->where('slug', $slug)->value('id');

        // ===========================
        // PRODUCTS
        // ===========================
        $data = [
            // 🐟 CẦN CÂU
            [
                'category' => 'can-cau',
                'name' => 'Cần jig Daiwa Saltiga AirportAble 2.7m',
                'brand' => 'Daiwa',
                'origin' => 'Nhật Bản',
                'warranty' => '12 tháng',
                'material' => 'Carbon',
                'year' => 2024,
                'desc' => 'Cần carbon siêu nhẹ, độ nhạy cao, cân bằng tốt cho cả câu sông và hồ.',
                'images' => [
                    'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Saltiga%20AP/can-jig-daiwa-saltiga-airportable-3.jpg',
                    'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Saltiga%20AP/can-jig-daiwa-saltiga-airportable-5.jpg',
                ],
                'variants' => [
                    ['sku' => 'EXAGE27-BLK', 'price' => 450000, 'stock' => 20, 'color' => 'Đen', 'size' => '2.7m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Saltiga%20AP/can-jig-daiwa-saltiga-airportable-3.jpg'],
                    ['sku' => 'EXAGE30-SLV', 'price' => 490000, 'stock' => 10, 'color' => 'Bạc', 'size' => '3.0m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Saltiga%20AP/can-jig-daiwa-saltiga-airportable-3.jpg'],
                ]
            ],
            [
                'category' => 'can-cau',
                'name' => 'Cần câu Abu Garcia Vektor Surf',
                'brand' => 'Abu Garcia',
                'origin' => 'Mỹ',
                'warranty' => '24 tháng',
                'material' => 'Carbon Composite',
                'year' => 2023,
                'desc' => 'Dòng cần phổ thông, nhẹ, bền, phù hợp người mới bắt đầu.',
                'images' => [
                    'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Abu/Vektor/can-cau-abu-garcia-vektor-1.jpg',
                    'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Abu/Vektor/can-cau-abu-garcia-vektor-2.jpg',
                ],
                'variants' => [
                    ['sku' => 'SAM36-BLE', 'price' => 380000, 'stock' => 25, 'color' => 'Xanh dương', 'size' => '3.6m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Abu/Vektor/can-cau-abu-garcia-vektor-5.jpg'],
                ]
            ],
            [
            'category' => 'can-cau',
            'name' => 'Shimano ColtSniper SS - 2024',
            'brand' => 'Shimano',
            'origin' => 'Nhật Bản',
            'warranty' => '24 tháng',
            'material' => 'Carbon / Graphite', 
            'year' => 2024,
            'desc' => 'Cần lure / jig cao cấp từ Shimano – dòng ColtSniper SS 2024.',
            'images' => [
                // bạn cần tự cập nhật link ảnh từ chi tiết sản phẩm
                'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Shimano/Coltsniper%20SS/2024/can-cau-shimano-coltsniper-ss-2024-1.jpg', 
                'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Shimano/Coltsniper%20SS/2024/can-cau-shimano-coltsniper-ss-2024-1.jpg'
            ],
            'variants' => [
                ['sku' => 'SH-CS-2024', 'price' => 5290000, 'stock' => 3, 'color' => 'Đen', 'size' => '3m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Shimano/Coltsniper%20SS/2024/can-cau-shimano-coltsniper-ss-2024-1.jpg']
            ]
        ],
        [
            'category' => 'can-cau',
            'name' => 'Shimano Poison Adrena - 2024',
            'brand' => 'Shimano',
            'origin' => 'Nhật Bản',
            'warranty' => '24 tháng',
            'material' => 'Carbon / Graphite',
            'year' => 2024,
            'desc' => 'Cần lure cao cấp Shimano Poison Adrena 2024.',
            'images' => ['https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Shimano/Poison/2024/can-lure-shimano-poison-adrena-2024-1.jpg', 
                        'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Shimano/Poison/2024/can-lure-shimano-poison-adrena-2024-1.jpg'],
            'variants' => [
                ['sku' => 'SH-PA-2024', 'price' => 6250000, 'stock' => 2, 'color' => 'Đen', 'size' => '3.2m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Shimano/Poison/2024/can-lure-shimano-poison-adrena-2024-1.jpg']
            ]
        ],
        [
            'category' => 'can-cau',
            'name' => 'Daiwa Gouin Bull - 2024',
            'brand' => 'Daiwa',
            'origin' => 'Nhật Bản',
            'warranty' => '24 tháng',
            'material' => 'Carbon / Graphite',
            'year' => 2024,
            'desc' => 'Cần lure / jig Daiwa Gouin Bull 2024.',
            'images' => ['https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Gouin%20Bull/can-cau-daiwa-gouin-bull-2024-1.jpg', 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Gouin%20Bull/can-cau-daiwa-gouin-bull-2024-1.jpg'],
            'variants' => [
                ['sku' => 'DW-GB-2024', 'price' => 8330000, 'stock' => 2, 'color' => 'Xanh Dương', 'size' => '2m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Gouin%20Bull/can-cau-daiwa-gouin-bull-2024-1.jpg']
            ]
        ],
        [
       'category' => 'can-cau',
        'name' => 'Daiwa Crossfire',
        'brand' => 'Shimano',
        'origin' => 'Nhật Bản',
        'warranty' => '18 tháng',
        'material' => 'Nano Carbon',
        'year' => 2024,
        'desc' => 'Cần lure/máy đứng Daiwa Crossfire, tải chì tốt, phù hợp bãi xa.',
        'images' => ['https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/crossfire%2019/crossfire%201.jpg',
                'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/crossfire%2019/crossfire%204.jpg'],
        'variants' => [
            ['sku' => '662MHB', 'price' => 495000, 'stock' => 14, 'color' => 'Đen xanh', 'size' => '1.9m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/crossfire%2019/can-lure-daiwa-crossfire-6.jpg'],
            ['sku' => '662MS', 'price' => 500000, 'stock' => 9,  'color' => 'Đen xanh', 'size' => '2.2m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/crossfire%2019/can-lure-daiwa-crossfire-6.jpg'],
            ['sku' => '702MS', 'price' => 550000, 'stock' => 6,  'color' => 'Đen xanh', 'size' => '2.5m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/crossfire%2019/can-lure-daiwa-crossfire-1.jpg']
        ]
    ],
    [
        'category' => 'can-cau',
        'name' => 'Cần câu Bulava Durga Ultra',
        'brand' => 'Bulava',
        'origin' => 'Nga',
        'warranty' => '12 tháng',
        'material' => 'Carbon + Fiber Glass',
        'year' => 2024,
        'desc' => 'mẫu cần được thiết kế rất cứng cáp, tải mồi cao',
        'images' => ['https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Bulava/Durga/can-cau-bulava-durga-ultra-1.jpg', 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Bulava/Durga/can-cau-bulava-durga-ultra-6.jpg'],
        'variants' => [
            ['sku' => 'S702MH', 'price' => 750000, 'stock' => 30, 'color' => 'Đen', 'size' => '3m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Bulava/Durga/can-cau-bulava-durga-ultra-3.jpg'],
            ['sku' => 'S902MH', 'price' => 950000, 'stock' => 22, 'color' => 'Đen', 'size' => '3.4m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Bulava/Durga/can-cau-bulava-durga-ultra-5.jpg']
        ]
    ],
    [
        'category' => 'can-cau',
        'name' => 'Major Craft Benkei Casting',
        'brand' => 'Major Craft',
        'origin' => 'Nhật Bản',
        'warranty' => '18 tháng',
        'material' => '30T Carbon',
        'year' => 2024,
        'desc' => 'Cần casting chuyên lure cá lóc – nảy đầu tốt, độ bền cao.',
        'images' => ['https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Major%20Craft/Benkei/can-lure-major-craft-benkei-1.jpg', 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Major%20Craft/Benkei/can-lure-major-craft-benkei-5.jpg'],
        'variants' => [
            ['sku' => 'BIC-652ML', 'price' => 2450000, 'stock' => 10, 'color' => 'Đen xám', 'size' => '1.95m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Major%20Craft/Benkei/can-lure-major-craft-benkei-3.jpg'],
            ['sku' => 'MC-BIC-692MH', 'price' => 2590000, 'stock' => 7,  'color' => 'Đen xám', 'size' => '2.07m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Major%20Craft/Benkei/can-lure-major-craft-benkei-2.jpg']
        ]
    ],
    [
        'category' => 'can-cau',
        'name' => 'Cần 2 khúc máy ngang Berkley LightNight Rod',
        'brand' => 'Berkley',
        'origin' => 'Nhật Bản',
        'warranty' => 'n/a',
        'material' => 'Carbon',
        'year' => 2023,
        'desc' => 'Một cây cần lure có vẻ ngoài nhìn rất hầm hố,chắc chắn',
        'images' => ['https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Berkley/LightNight%20Rod/lightningt%20c1.jpg', 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Berkley/LightNight%20Rod/lightningt%20c2.jpg'],  
        'variants' => [
            ['sku' => 'BCLR702MH', 'price' => 950000, 'stock' => 5, 'color' => 'Đen', 'size' => '2m1', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Berkley/LightNight%20Rod/lightningt%20c5.jpg']
        ]
    ],
     [
            'category' => 'can-cau',
            'name' => 'Cần câu Daiwa Tornado X - 2023',
            'brand' => 'Daiwa',
            'origin' => 'Nhật Bản',
            'warranty' => '24 tháng',
            'material' => 'Carbon',
            'year' => 2023,
            'desc' => 'Tornado với bản nâng cấp phôi xoắn X nửa khúc dưới giúp cần cứng cáp hơn, mạnh mẽ hơn.',
            'images' => ['https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Tornado/can-cau-daiwa-tornado-X-2023-3.jpg',
             'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Tornado/can-cau-daiwa-tornado-X-2023-2.jpg'],
            'variants' => [
                ['sku' => '662-MHB', 'price' => 1200000, 'stock' => 10, 'color' => 'Đen', 'size' => '1.98m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Tornado/can-cau-daiwa-tornado-X-2023-7.jpg'],
                ['sku' => '662-MHS', 'price' => 1200000, 'stock' => 5, 'color' => 'Đen', 'size' => '1.98m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Tornado/can-cau-daiwa-tornado-X-2023-3.jpg'],
                ['sku' => '672-MHS', 'price' => 1230000, 'stock' => 4, 'color' => 'Đen', 'size' => '2.13m', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Tornado/can-cau-daiwa-tornado-X-2023-5.jpg']
            ]
        ],


            

            // ⚙️ MÁY CÂU
            
            [
                'category' => 'may-cau',
                'name' => 'Shimano TwinPower XD 2025',
                'brand' => 'Shimano',
                'origin' => 'Nhật Bản',
                'warranty' => '12 tháng',
                'material' => 'Hợp kim / Metal',  // ước lượng
                'year' => 2025,
                'desc' => 'Máy câu lure cao cấp, dòng TwinPower XD 2025 từ Shimano.',  
                'images' => ['https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Twin%20Power/XD%202025/may-cau-shimano-twinpower-2025-1.jpg', 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Twin%20Power/XD%202025/may-cau-shimano-twinpower-2025-3.jpg'],
                'variants' => [
                    ['sku' => 'SPD-XD-3000', 'price' => 9370000, 'stock' => 2, 'color' => 'Đen', 'size' => '200gr', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Twin%20Power/XD%202025/may-cau-shimano-twinpower-2025-4.jpg'],
                    ['sku' => 'SPD-XD-4000', 'price' => 9670000, 'stock' => 1, 'color' => 'Đen', 'size' => '235gr', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Twin%20Power/XD%202025/may-cau-shimano-twinpower-2025-4.jpg'],
                    ['sku' => 'SPD-XD-5000', 'price' => 9870000, 'stock' => 1, 'color' => 'Đen', 'size' => '245gr', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Twin%20Power/XD%202025/may-cau-shimano-twinpower-2025-4.jpg']
                ]
            ],
            [
                'category' => 'may-cau',
                'name' => 'Shimano Stradic SW 2024',
                'brand' => 'Shimano',
                'origin' => 'Nhật Bản',
                'warranty' => '6 tháng',
                'material' => 'Hợp kim / Metal',
                'year' => 2024,
                'desc' => 'Máy câu nước mặn/ nước ngọt Shimano Stradic SW 2024.',  
                'images' => ['https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Stradic%20SW%2020/2024/may-cau-stradic-sw-2024-1.jpg', 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Stradic%20SW%2020/2024/may-cau-stradic-sw-2024-4.jpg'],
                'variants' => [
                    ['sku' => 'STD-SW-4000', 'price' => 5400000, 'stock' => 2, 'color' => 'Đen', 'size' => '440g', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Stradic%20SW%2020/2024/may-cau-stradic-sw-2024-7.jpg'],
                    ['sku' => 'STD-SW-8000', 'price' => 6260000, 'stock' => 1, 'color' => 'Đen', 'size' => '440g', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Shimano/Stradic%20SW%2020/2024/may-cau-stradic-sw-2024-7.jpg']
                ]
            ],
            [
                'category' => 'may-cau',
                'name' => 'Daiwa Certate LT 2024',
                'brand' => 'Daiwa',
                'origin' => 'Nhật Bản',
                'warranty' => '18 tháng',
                'material' => 'Hợp kim / Metal',
                'year' => 2024,
                'desc' => 'Máy câu Daiwa Certate LT 2024 — siêu phẩm.',  
                'images' => ['https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/daiwa/Certate%20Lt/2024/may-cau-daiwa-certate-lt-2024-1.jpg', 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/daiwa/Certate%20Lt/2024/may-cau-daiwa-certate-lt-2024-6.jpg'],
                'variants' => [
                    ['sku' => 'CRT-LT-3000', 'price' => 11500000, 'stock' => 2, 'color' => 'Bạc', 'size' => '170g', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/daiwa/Certate%20Lt/2024/may-cau-daiwa-certate-lt-2024-1.jpg']
                ]
            ],
            [
                'category' => 'may-cau',
                'name' => 'Daiwa Legalis LT 2023',
                'brand' => 'Daiwa',
                'origin' => 'Nhật Bản',
                'warranty' => 'n/a',
                'material' => 'Hợp kim / Metal',
                'year' => 2023,
                'desc' => 'Máy câu Daiwa Legalis LT 2023 — bản nhẹ, dễ dùng.',  
                'images' => ['https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/daiwa/Legalis/legalis%202023%20air/may-cau-daiwa-legalis-2023-1.jpg', 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/daiwa/Legalis/legalis%202023%20air/may-cau-daiwa-legalis-2023-5.jpg'],
                'variants' => [
                    ['sku' => 'LGL-LT-2500', 'price' => 1540000, 'stock' => 5, 'color' => 'Đen Vàng', 'size' => '2500', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/daiwa/Legalis/legalis%202023%20air/may-cau-daiwa-legalis-2023-1.jpg'],
                    ['sku' => 'LGL-LT-3000', 'price' => 1770000, 'stock' => 3, 'color' => 'Đen Vàng', 'size' => '3000', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/daiwa/Legalis/legalis%202023%20air/may-cau-daiwa-legalis-2023-1.jpg']
                ]
            ],
            [
                'category' => 'may-cau',
                'name' => 'Máy câu ngang Abu Garcia Revo4',
                'brand' => 'Abu Garcia',
                'origin' => 'Hàn Quốc',
                'warranty' => '12 tháng',
                'material' => 'Hợp kim / Metal',
                'year' => 2021,
                'desc' => 'Máy câu ngang Abu Garcia Revo4 — hàng chính hãng.',  
                'images' => ['https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Abu/Revo%20IKe/ike1.jpg', 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Abu/Revo%20IKe/ike4.jpg'],
                'variants' => [
                    ['sku' => 'REV-MGX-153', 'price' => 1850000, 'stock' => 1, 'color' => 'Đen Tím', 'size' => '214g', 'image' => 'https://shopcancau.vn/uploads/source/m%C3%A1y%20c%C3%A2u/Abu/Revo%20IKe/ike5.jpg']
                ]
            ],


            // 🧵 DÂY CÂU
            [
                'category' => 'day-cau',
                'name' => 'Cước câu Taycan cuộn 200m',
                'brand' => 'Taycan',
                'origin' => 'Việt Nam',
                'warranty' => 'n/a',
                'material' => 'Nylon', 
                'year' => 2023,
                'desc' => 'Cước câu Taycan cuộn 200m — phù hợp câu đơn / câu thư giãn.',
                'images' => ['https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Taycan/cuoc-cau-taycan-200m-1.jpg', 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Taycan/cuoc-cau-taycan-200m-2.jpg'],
                'variants' => [
                    ['sku' => 'TAY-200C', 'price' => 80000, 'stock' => 20, 'color' => 'Xanh Chuối', 'size' => '0.40mm', 'image' => 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Taycan/cuoc-cau-taycan-200m-5.jpg'],
                    ['sku' => 'TAY-200R', 'price' => 80000, 'stock' => 18, 'color' => 'Xanh Rêu', 'size' => '0.45mm', 'image' => 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Taycan/cuoc-cau-taycan-200m-7.jpg'],
                    ['sku' => 'TAY-200H', 'price' => 80000, 'stock' => 20, 'color' => 'Hồng', 'size' => '0.50mm', 'image' => 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Taycan/cuoc-cau-taycan-200m-4.jpg'],
                    ['sku' => 'TAY-200T', 'price' => 80000, 'stock' => 16, 'color' => 'Tím', 'size' => '0.55mm', 'image' => 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Taycan/cuoc-cau-taycan-200m-6.jpg']
                ]
            ],
            [
                'category' => 'day-cau',
                'name' => 'Dây leader FluoroCarbon Seaguar Shock Leader 15m',
                'brand' => 'Seaguar',
                'origin' => 'Nhật Bản',
                'warranty' => 'n/a',
                'material' => 'Nylon',
                'year' => 2023,
                'desc' => 'Dây leader FluoroCarbon Seaguar Shock Leader 15m — phù hợp câu nhẹ, câu cá nhẹ.',
                'images' => ['https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Seaguard/Day-leader-fluorocarbon-seaguar-15m-1.jpg', 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Seaguard/Day-leader-fluorocarbon-seaguar-15m-6.jpg'],
                'variants' => [
                    ['sku' => 'SL-SIG100', 'price' => 100000, 'stock' => 20, 'color' => 'Trắng', 'size' => '15m', 'image' => 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Seaguard/Day-leader-fluorocarbon-seaguar-15m-6.jpg']
                ]
            ],
            [
                'category' => 'day-cau',
                'name' => 'Cước câu Sunline Siglon V - cuộn 100m',
                'brand' => 'Sunline',
                'origin' => 'Nhật Bản',
                'warranty' => 'n/a',
                'material' => 'Monofilament / Nylon',
                'year' => 2023,
                'desc' => 'Dòng cước chất lượng cao tới từ 1 trong những thương hiệu nổi tiếng nhất trong ngành chế tạo dây câu : Sunline',
                'images' => ['https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Sunline/siglonV.jpg'],
                'variants' => [
                    ['sku' => 'SSV-100', 'price' => 110000, 'stock' => 20, 'color' => 'Trắng', 'size' => '100m', 'image' => 'https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Sunline/siglonV.jpg']
                ]
            ],
            [
                'category' => 'day-cau',
                'name' => 'Cước câu Okamoto 4 con cá cuộn 250m',
                'brand' => 'Okamoto',
                'origin' => 'Nhật Bản',
                'warranty' => 'n/a',
                'material' => 'Nylon',
                'year' => 2023,
                'desc' => 'Cước Okamoto 4 con cá — cuộn 250m, phù hợp câu cá nhỏ, câu đài.',
                'images' => ['https://shopcancau.vn/uploads/source/Day%20cau/Cuoc/Okamoto/cacom1.jpg', 'https://shopcancau.vn/uploads/medium/Day%20cau/Cuoc/Okamoto/cacom2.jpg'],
                'variants' => [
                    ['sku' => 'OK-250C-PC', 'price' => 140000, 'stock' => 10, 'color' => 'Xanh rêu', 'size' => '0.25mm', 'image' => 'https://shopcancau.vn/uploads/medium/Day%20cau/Cuoc/Okamoto/cacom1.jpg']
                ]
            ],

            // 🪝 MỒI & LƯỠI
             [
                'category' => 'moi-luoi',        
                'name' => 'Lưỡi jighead 3.5gr – vỉ 5 cái',
                'brand' => 'ABC',             
                'origin' => 'Việt Nam',
                'warranty' => null,
                'material' => 'Thép / mạ',
                'year' => 2025,
                'desc' => 'Lưỡi jighead 3.5gr, đóng vỉ 5 cái, phù hợp câu lure nhỏ.',
                'images' => ['https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/kh%C3%A1c/jighead%20titan/luoi-jighead-1.jpg', 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/kh%C3%A1c/jighead%20titan/luoi-jighead-2.jpg'],
                'variants' => [
                    ['sku' => 'JIG035-V1', 'price' => 30000, 'stock' => 19, 'color' => 'Xanh lá', 'size' => '3.5gr', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/kh%C3%A1c/jighead%20titan/luoi-jighead-8.jpg'],
                    ['sku' => 'JIG035-V2', 'price' => 30000, 'stock' => 19, 'color' => 'Trắng', 'size' => '3.5gr', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/kh%C3%A1c/jighead%20titan/luoi-jighead-6.jpg'],
                    ['sku' => 'JIG035-V3', 'price' => 30000, 'stock' => 20, 'color' => 'Đỏ', 'size' => '3.5gr', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/kh%C3%A1c/jighead%20titan/luoi-jighead-5.jpg'],
                    ['sku' => 'JIG035-V4', 'price' => 30000, 'stock' => 20, 'color' => 'Xanh chuối', 'size' => '3.5gr', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/kh%C3%A1c/jighead%20titan/luoi-jighead-4.jpg'],
                    ['sku' => 'JIG035-V5', 'price' => 30000, 'stock' => 19, 'color' => 'Cam', 'size' => '3.5gr', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/kh%C3%A1c/jighead%20titan/luoi-jighead-7.jpg']
                ]
            ],
            [
                'category' => 'moi-luoi',
                'name' => 'Lưỡi móc mồi mềm BG – thép trắng',
                'brand' => null,
                'origin' => null,
                'warranty' => null,
                'material' => 'Thép trắng',
                'year' => 2025,
                'desc' => 'Lưỡi móc mồi mềm, dùng ghép mồi mềm khi lure hoặc jigging.',
                'images' => ['https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/luoi%20thu%20cong/luoi-moc-moi-mem-BG-2.jpg'],
                'variants' => [
                    ['sku' => 'BG-HOOK-1', 'price' => 30000, 'stock' => 10, 'color' => 'Xanh dương', 'size' => '5cm', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/luoi%20thu%20cong/luoi-moc-moi-mem-BG-5.jpg'],
                    ['sku' => 'BG-HOOK-2', 'price' => 30000, 'stock' => 10, 'color' => 'Xanh dương', 'size' => '4cm', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/luoi%20thu%20cong/luoi-moc-moi-mem-BG-5.jpg'],
                    ['sku' => 'BG-HOOK-3', 'price' => 30000, 'stock' => 10, 'color' => 'Xanh dương', 'size' => '3.5cm', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/luoi%20thu%20cong/luoi-moc-moi-mem-BG-5.jpg'],
                ]
            ],
            [
                'category' => 'moi-luoi',
                'name' => 'Lưỡi móc mồi mềm AR15 bán công nghiệp',
                'brand' => null,
                'origin' => 'Việt Nam',
                'warranty' => null,
                'material' => 'Thép mạ',
                'year' => 2025,
                'desc' => 'Lưỡi móc mồi mềm AR15 – pack công nghiệp, dùng rộng rãi.',
                'images' => ['https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/luoi%20thu%20cong/luoi-ar15-ban-cong-nghiep.jpg'],
                'variants' => [
                    ['sku' => 'AR15-HOOK1', 'price' => 60000, 'stock' => 20, 'color' => 'Bạc', 'size' => '5cm', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/luoi%20thu%20cong/luoi-ar15-ban-cong-nghiep.jpg'],
                    ['sku' => 'AR15-HOOK2', 'price' => 60000, 'stock' => 7, 'color' => 'Bạc', 'size' => '4cm', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/luoi%20thu%20cong/luoi-ar15-ban-cong-nghiep.jpg']

                ]
            ],
            [
                'category' => 'moi-luoi',
                'name' => 'Lưỡi Jighead Daiwa Flat Junkie',
                'brand' => 'Daiwa',
                'origin' => 'Nhật Bản',
                'warranty' => null,
                'material' => 'Thép mạ',
                'year' => 2025,
                'desc' => 'Lưỡi jighead Flat Junkie – thương hiệu Daiwa, dùng cho mồi mềm / lure nhỏ.',
                'images' => ['https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/daiwa/Flat%20Junkie/luoi-jighead-daiwa-flat-junkie-1.jpg', 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/daiwa/Flat%20Junkie/luoi-jighead-daiwa-flat-junkie-3.jpg'],
                'variants' => [
                    ['sku' => 'DW-FJ-JH', 'price' => 100000, 'stock' => 0, 'color' => '', 'size' => '7g', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/luoi%20cau/daiwa/Flat%20Junkie/luoi-jighead-daiwa-flat-junkie-4.jpg']
                ]
            ],
            [
                'category' => 'moi-luoi',
                'name' => 'Mồi mềm Berkley Powerbait Ripple Shad - 2.5gr - bịch 10 con',
                'brand' => 'Berkley',
                'origin' => 'Trung Quốc',
                'warranty' => null,
                'material' => 'Silicon',
                'year' => 2025,
                'desc' => 'Lưỡi lure jig mềm Berkley – đầu tròn, phù hợp jig/soft bait.',
                'images' => ['https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/moi%20gia/Berkley/51.jpg'],
                'variants' => [
                    ['sku' => 'BK-Bait', 'price' => 100000, 'stock' => 0, 'color' => '', 'size' => '2.5g', 'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/moi%20gia/Berkley/52.jpg']
                ]
            ],
            [
                'category' => 'moi-luoi',
                'name' => 'Nhái hơi Eggfrog V3',
                'brand' => 'EF',
                'origin' => 'Trung Quốc',
                'warranty' => null,
                'material' => 'Silicon',
                'year' => 2025,
                'desc' => 'Nhái hơi EggFrog V3 có kích thước siêu mini , chỉ 30mm , action nổi ,dành cho các loại cá nhát, size nhỏ, bú bình',
                'images' => ['https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/moi%20gia/nhai/nhai-hoi-eggfrog-v3.jpg'],
                'variants' => [
                    ['sku' => 'E3-B1', 'price' => 70000, 'stock' => 10, 'color' => 'Xanh lá', 'size' => '5g', 'image' => ''],
                    ['sku' => 'E3-B2', 'price' => 70000, 'stock' => 10, 'color' => 'Xám', 'size' => '5g', 'image' => ''],
                    ['sku' => 'E3-B3', 'price' => 70000, 'stock' => 10, 'color' => 'Vàng', 'size' => '5g', 'image' => ''],
                    ['sku' => 'E3-B4', 'price' => 70000, 'stock' => 10, 'color' => 'Cam', 'size' => '5g', 'image' => '']
                ]
            ],

            // 🎒 PHỤ KIỆN
            [
                'category' => 'phu-kien',
                'name' => 'Hộp đồ câu Rapala ProBox',
                'brand' => 'Rapala',
                'origin' => 'Việt Nam',
                'warranty' => '12 tháng',
                'material' => 'Nhựa ABS',
                'year' => 2024,
                'desc' => 'Hộp đa năng 15 ngăn, chống nước, chống sốc.',
                'images' => [
                    'https://www.rapala.eu/img/940/940/resize/catalog/product/3/9/3940b758ccd334_emipdn7eb52nj898613ekcql38_d2699525.png',
                ],
                'variants' => [
                    ['sku' => 'PROBOX-S', 'price' => 230000, 'stock' => 30, 'color' => 'Xanh lá', 'size' => 'Nhỏ', 'image' => 'https://www.rapala.eu/img/940/940/resize/catalog/product/3/9/3940b758ccd334_emipdn7eb52nj898613ekcql38_d2699525.png'],
                    ['sku' => 'PROBOX-L', 'price' => 270000, 'stock' => 20, 'color' => 'Cam', 'size' => 'Lớn', 'image' => 'https://www.rapala.eu/img/940/940/resize/catalog/product/3/9/3940b758ccd334_emipdn7eb52nj898613ekcql38_d2699525.png'],
                ]
            ],
             [
                'category' => 'phu-kien',
                'name' => 'Kéo cắt PE Frichy XS655',
                'brand' => 'Frichy',
                'origin' => 'N/A',
                'warranty' => 'n/a',
                'material' => 'Thép không gỉ',
                'year' => 2025,
                'desc' => 'Kéo chuyên dụng cắt dây PE, nhỏ gọn dễ mang theo.',
                'images' => ['https://shopcancau.vn/uploads/source/Phu%20kien/khoa%20mani%20kim%20kep/frichy/keo%20frichy%202.jpg'],
                'variants' => [
                    ['sku' => 'FRI-XS655', 'price' => 50000, 'stock' => 10, 'color' => 'Đen', 'size' => '', 'image' => 'https://shopcancau.vn/uploads/source/Phu%20kien/khoa%20mani%20kim%20kep/frichy/ke%20frichy%201.jpg']
                ]
            ],
            [
                'category' => 'phu-kien',
                'name' => 'Bao đựng máy câu in logo SMN DW',
                'brand' => 'SMN',
                'origin' => 'N/A',
                'warranty' => 'n/a',
                'material' => 'Vải bố / nylon',
                'year' => 2025,
                'desc' => 'Bao chống sốc, đựng máy câu khi di chuyển.',
                'images' => ['https://shopcancau.vn/uploads/source/Phu%20kien/bao%20hop/bao-may-logo-dw-smn-1.jpg', 'https://shopcancau.vn/uploads/source/Phu%20kien/bao%20hop/bao-may-logo-dw-smn-2.jpg'],
                'variants' => [
                    ['sku' => 'SMN-DW-M', 'price' => 60000, 'stock' => 15, 'color' => 'Đen', 'size' => 'M', 'image' => 'https://shopcancau.vn/uploads/source/Phu%20kien/bao%20hop/bao-may-logo-dw-smn-1.jpg'],
                    ['sku' => 'SMN-DW-L', 'price' => 65000, 'stock' => 10, 'color' => 'Đen', 'size' => 'L', 'image' => 'https://shopcancau.vn/uploads/source/Phu%20kien/bao%20hop/bao-may-logo-dw-smn-1.jpg']
                ]
            ],
            [
                'category' => 'phu-kien',
                'name' => 'Khóa mani bạc đạn Ghost Blade Magic-Bearing Swive PKKGB04',
                'brand' => 'Ghost Blade',
                'origin' => 'Taiwan',
                'warranty' => 'n/a',
                'material' => 'Thép mạ / hợp kim',
                'year' => 2025,
                'desc' => 'Khóa mani vòng bi, tăng độ mượt khi quăng câu hoặc jigging.',
                'images' => ['https://shopcancau.vn/uploads/source/Phu%20kien/khoa%20mani%20kim%20kep/khoamanigb.jpg'],
                'variants' => [
                    ['sku' => 'GB-PKKGB04', 'price' => 79000, 'stock' => 10, 'color' => 'Bạc', 'size' => '', 'image' => 'https://shopcancau.vn/uploads/source/Phu%20kien/khoa%20mani%20kim%20kep/khoamanigb.jpg']
                ]
            ],
            [
                'category' => 'phu-kien',
                'name' => 'Khoen mồi giả Ghost Blade Split Ring - PKKGB05',
                'brand' => 'Ghost Blade',
                'origin' => 'Taiwan',
                'warranty' => 'n/a',
                'material' => 'Thép mạ',
                'year' => 2025,
                'desc' => 'Khoen kết nối mồi giả / lure – phụ kiện tiện lợi cho cần thủ.',
                'images' => ['https://shopcancau.vn/uploads/source/Phu%20kien/khoa%20mani%20kim%20kep/spitring.jpg'],
                'variants' => [
                    ['sku' => 'GB-PKKGB05', 'price' => 79000, 'stock' => 10, 'color' => 'Bạc', 'size' => '', 'image' => 'https://shopcancau.vn/uploads/source/Phu%20kien/khoa%20mani%20kim%20kep/spitring.jpg']
                ]
        ],
        [
                'category' => 'phu-kien',
                'name' => 'Bao đựng cần Daiwa SL Rod Case 125S',
                'brand' => 'Daiwa',
                'origin' => 'TaiWan',
                'warranty' => 'n/a',
                'material' => 'Da cao cấp',
                'year' => 2022,
                'desc' => 'Bao đựng cần Daiwa SL Rod Case 125S(C) - mẫu cao đựng cần cao cấp , với kiểu dáng cực kỳ sang trọng, giúp bảo vệ những cây cần quý giá của anh em cần thủ.',
                'images' => ['https://shopcancau.vn/uploads/source/Phu%20kien/bao%20hop/Daiwa/SL%20125s/bao-dung-can-daiwa-sl-rod-case-125sc-1.jpg'],
                'variants' => [
                    ['sku' => 'GB-DW125S', 'price' => 1550000, 'stock' => 10, 'color' => 'Đỏ', 'size' => '', 'image' => 'https://shopcancau.vn/uploads/source/Phu%20kien/bao%20hop/Daiwa/SL%20125s/bao-dung-can-daiwa-sl-rod-case-125sc-2.jpg']
                ]
        ],
        ];

        foreach ($data as $p) {
            $pid = DB::table('products')->insertGetId([
                'category_id' => $catId($p['category']),
                'name' => $p['name'],
                'description' => $p['desc'],
                'brand' => $p['brand'],
                'origin' => $p['origin'],
                'warranty' => $p['warranty'],
                'material' => $p['material'],
                'year' => $p['year'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($p['variants'] as $v) {
                DB::table('product_variants')->insert([
                    'product_id' => $pid,
                    'sku' => $v['sku'],
                    'price' => $v['price'],
                    'stock' => $v['stock'],
                    'color' => $v['color'] ?? null,
                    'size' => $v['size'] ?? null,
                    'image' => $v['image'] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            foreach ($p['images'] as $i => $url) {
                DB::table('product_images')->insert([
                    'product_id' => $pid,
                    'image_url' => $url,
                    'is_thumbnail' => $i === 0,
                    'sort_order' => $i + 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
