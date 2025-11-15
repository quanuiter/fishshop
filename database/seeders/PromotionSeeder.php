<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        Promotion::truncate(); // xoá sạch để seed lại

        Promotion::create([
            'name'        => 'Giảm 20% cần câu Shimano',
            'description' => 'Ưu đãi lớn cho dòng cần Shimano chính hãng. Số lượng có hạn.',
            'percent'     => 20,
            'start_date'  => Carbon::now()->subDays(5),
            'end_date'    => Carbon::now()->addDays(10),
            'is_active'   => true,
        ]);

        Promotion::create([
            'name'        => 'Mua máy Daiwa tặng 15% toàn đơn',
            'description' => 'Giảm 15% khi mua bất kỳ máy Daiwa nào.',
            'percent'     => 15,
            'start_date'  => Carbon::now()->subDays(2),
            'end_date'    => Carbon::now()->addDays(20),
            'is_active'   => true,
        ]);

        Promotion::create([
            'name'        => 'Combo cần + máy giảm 25%',
            'description' => 'Áp dụng cho khách mua combo cần câu + máy câu.',
            'percent'     => 25,
            'start_date'  => Carbon::now()->addDays(2), // sắp diễn ra
            'end_date'    => Carbon::now()->addDays(15),
            'is_active'   => true,
        ]);

        Promotion::create([
            'name'        => 'Giảm 10% cho đơn hàng từ 500k',
            'description' => 'Áp dụng cho mọi sản phẩm trong cửa hàng.',
            'percent'     => 10,
            'start_date'  => Carbon::now()->subDays(7),
            'end_date'    => Carbon::now()->addDays(5),
            'is_active'   => true,
        ]);

        Promotion::create([
            'name'        => 'Sự kiện cuối tuần – giảm 30%',
            'description' => 'Khuyến mãi cực lớn, chỉ áp dụng 2 ngày cuối tuần.',
            'percent'     => 30,
            'start_date'  => Carbon::now()->addDays(3),
            'end_date'    => Carbon::now()->addDays(4),
            'is_active'   => true,
        ]);
    }
}