<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Cần câu Shimano 2.7m',
                'description' => 'Cần câu chuyên nghiệp làm bằng carbon, nhẹ và dẻo, phù hợp cho mọi địa hình câu.',
                'price' => 450000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1534080686848-b6b6b8b0b5d5?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Máy câu Daiwa BG 4000',
                'description' => 'Máy câu kim loại cao cấp với hệ thống drag mạnh mẽ và bền bỉ.',
                'price' => 1250000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1508612761958-e931e9f1a3d0?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Dây câu carbon siêu bền 100m',
                'description' => 'Dây carbon chống xoắn, chịu tải cao, thích hợp câu cá lớn.',
                'price' => 80000,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1610970878451-81747de2351d?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Bộ lưỡi câu inox 10 chiếc',
                'description' => 'Lưỡi câu chống gỉ sét, sắc bén, phù hợp nhiều loại mồi khác nhau.',
                'price' => 60000,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1607604276583-99d87e73cc8a?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Hộp đựng đồ câu chuyên dụng',
                'description' => 'Hộp đựng chống nước, nhiều ngăn, có tay cầm tiện lợi.',
                'price' => 230000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Áo chống nắng đi câu cá',
                'description' => 'Vải co giãn 4 chiều, thoáng mát, chống tia UV hiệu quả.',
                'price' => 190000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1598970434795-0c54fe7c0649?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Mồi giả mềm cho cá lóc',
                'description' => 'Mồi giả hình cá nhỏ, mềm và linh hoạt, thu hút cá lớn.',
                'price' => 50000,
                'stock' => 80,
                'image' => 'https://shopcancau.vn/uploads/source/Luoi%20moi%20phao/moi%20gia/TNT/F35C/nhai-hoi-tnt-f35c-1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Túi đựng cần câu gấp gọn',
                'description' => 'Chất liệu vải dày, chống thấm, có dây đeo vai tiện dụng.',
                'price' => 160000,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1560083750-039de7ab0b5d?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Ghế gấp câu cá mini',
                'description' => 'Ghế gấp gọn nhẹ, khung thép không gỉ, tiện mang đi xa.',
                'price' => 220000,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1512758017271-d7b84c2113f1?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Đèn pin đội đầu siêu sáng',
                'description' => 'Đèn pin LED công suất cao, 3 chế độ sáng, pin sạc lâu dài.',
                'price' => 120000,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1567443024551-f3e8a1e2cd39?auto=format&fit=crop&w=800&q=80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
