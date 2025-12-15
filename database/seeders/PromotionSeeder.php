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
            'name'        => 'Giảm 20%',
            'description' => 'Ưu đãi lớn cho sản phẩm trên shop, Số lượng có hạn.',
            'percent'     => 20,
            'start_date'  => Carbon::now()->subDays(5),
            'end_date'    => Carbon::now()->addDays(10),
            'is_active'   => true,
        ]);

        Promotion::create([
            'name'        => 'Mua dụng cụ bất kì tặng 15% toàn đơn',
            'description' => 'Giảm 15% khi mua bất kỳ sản phẩm nào.',
            'percent'     => 15,
            'start_date'  => Carbon::now()->subDays(2),
            'end_date'    => Carbon::now()->addDays(20),
            'is_active'   => true,
        ]);

        Promotion::create([
            'name'        => 'Giảm 25% cho mọi đơn hàng',
            'description' => 'Áp dụng cho tất cả sản phẩm.',
            'percent'     => 25,
            'start_date'  => Carbon::now()->addDays(2), // sắp diễn ra
            'end_date'    => Carbon::now()->addDays(15),
            'is_active'   => true,
        ]);

        Promotion::create([
            'name'        => 'Giảm 10% cho mọi đơn hàng',
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