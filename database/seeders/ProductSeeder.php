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
                'name' => 'Cần câu Shimano Exage 2.7m',
                'brand' => 'Shimano',
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
                'name' => 'Cần câu Daiwa Samurai 3.6m',
                'brand' => 'Daiwa',
                'origin' => 'Nhật Bản',
                'warranty' => '24 tháng',
                'material' => 'Carbon Composite',
                'year' => 2023,
                'desc' => 'Dòng cần phổ thông, nhẹ, bền, phù hợp người mới bắt đầu.',
                'images' => [
                    'https://images.unsplash.com/photo-1613280647893-65ac9b7f35f8?auto=format&w=900',
                ],
                'variants' => [
                    ['sku' => 'SAM36-GRN', 'price' => 380000, 'stock' => 25, 'color' => 'Xanh lá', 'size' => '3.6m', 'image' => 'https://images.unsplash.com/photo-1613280647893-65ac9b7f35f8?auto=format&w=800'],
                    ['sku' => 'SAM30-RED', 'price' => 350000, 'stock' => 30, 'color' => 'Đỏ', 'size' => '3.0m', 'image' => 'https://images.unsplash.com/photo-1620221339866-d24064b4b6fa?auto=format&w=800'],
                ]
            ],

            // ⚙️ MÁY CÂU
            [
                'category' => 'may-cau',
                'name' => 'Máy câu Daiwa BG 4000',
                'brand' => 'Daiwa',
                'origin' => 'Nhật Bản',
                'warranty' => '12 tháng',
                'material' => 'Nhôm CNC',
                'year' => 2024,
                'desc' => 'Máy câu bền, chống nước tốt, chịu tải cao cho cá lớn.',
                'images' => [
                    'https://images.unsplash.com/photo-1508612761958-e931e9f1a3d0?auto=format&w=900',
                ],
                'variants' => [
                    ['sku' => 'BG4000-SLV', 'price' => 1250000, 'stock' => 15, 'color' => 'Bạc', 'size' => '4000', 'image' => 'https://shopcancau.vn/uploads/source/C%E1%BA%A7n%20c%C3%A2u/Daiwa/Saltiga%20AP/can-jig-daiwa-saltiga-airportable-7.jpg'],
                    ['sku' => 'BG5000-BLK', 'price' => 1390000, 'stock' => 10, 'color' => 'Đen', 'size' => '5000', 'image' => 'https://images.unsplash.com/photo-1517697471339-4aa32003c11a?auto=format&w=800'],
                ]
            ],
            [
                'category' => 'may-cau',
                'name' => 'Máy Shimano Sienna 2500',
                'brand' => 'Shimano',
                'origin' => 'Malaysia',
                'warranty' => '12 tháng',
                'material' => 'Thép + Composite',
                'year' => 2024,
                'desc' => 'Dòng máy phổ thông nổi tiếng của Shimano, nhẹ và mượt.',
                'images' => [
                    'https://images.unsplash.com/photo-1627662165246-04dcd6a693f5?auto=format&w=900',
                ],
                'variants' => [
                    ['sku' => 'SIE25-BLK', 'price' => 890000, 'stock' => 20, 'color' => 'Đen', 'size' => '2500', 'image' => 'https://images.unsplash.com/photo-1627662165246-04dcd6a693f5?auto=format&w=800'],
                    ['sku' => 'SIE30-RED', 'price' => 920000, 'stock' => 15, 'color' => 'Đỏ', 'size' => '3000', 'image' => 'https://images.unsplash.com/photo-1627662165000-9c6e76e0cb5f?auto=format&w=800'],
                ]
            ],

            // 🧵 DÂY CÂU
            [
                'category' => 'day-cau',
                'name' => 'Dây câu fluorocarbon Daiwa 150m',
                'brand' => 'Daiwa',
                'origin' => 'Thái Lan',
                'warranty' => '6 tháng',
                'material' => 'Fluorocarbon',
                'year' => 2023,
                'desc' => 'Dây chống mài mòn, bền và trơn, thích hợp câu cá biển.',
                'images' => [
                    'https://images.unsplash.com/photo-1526746329403-8a04f2f2dba6?auto=format&w=900',
                ],
                'variants' => [
                    ['sku' => 'FC100-GRN', 'price' => 95000, 'stock' => 40, 'color' => 'Xanh lá', 'size' => '100m', 'image' => 'https://images.unsplash.com/photo-1526746329403-8a04f2f2dba6?auto=format&w=800'],
                    ['sku' => 'FC150-CLR', 'price' => 120000, 'stock' => 30, 'color' => 'Trong suốt', 'size' => '150m', 'image' => 'https://images.unsplash.com/photo-1579208570378-8c970854bc23?auto=format&w=800'],
                ]
            ],

            // 🪝 MỒI & LƯỠI
            [
                'category' => 'moi-luoi',
                'name' => 'Lưỡi câu inox King Hook 20 chiếc',
                'brand' => 'King Hook',
                'origin' => 'Trung Quốc',
                'warranty' => '3 tháng',
                'material' => 'Inox 304',
                'year' => 2024,
                'desc' => 'Lưỡi câu sắc bén, chống gỉ, độ bền cao.',
                'images' => [
                    'https://images.unsplash.com/photo-1607604276583-99d87e73cc8a?auto=format&w=900',
                ],
                'variants' => [
                    ['sku' => 'HOOKM', 'price' => 70000, 'stock' => 60, 'color' => 'Bạc', 'size' => 'M', 'image' => 'https://images.unsplash.com/photo-1607604276583-99d87e73cc8a?auto=format&w=800'],
                    ['sku' => 'HOOKL', 'price' => 85000, 'stock' => 40, 'color' => 'Bạc', 'size' => 'L', 'image' => 'https://via.placeholder.com/600x400?text=Hook+size+L'],
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
                    'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&w=900',
                ],
                'variants' => [
                    ['sku' => 'PROBOX-S', 'price' => 230000, 'stock' => 30, 'color' => 'Xanh lá', 'size' => 'Nhỏ', 'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&w=800'],
                    ['sku' => 'PROBOX-L', 'price' => 270000, 'stock' => 20, 'color' => 'Cam', 'size' => 'Lớn', 'image' => 'https://via.placeholder.com/600x400?text=ProBox+Large'],
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
