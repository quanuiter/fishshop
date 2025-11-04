<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Cần câu',
                'slug' => Str::slug('Cần câu'),
                'description' => 'Các loại cần câu chuyên nghiệp, từ cơ bản đến cao cấp.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Máy câu',
                'slug' => Str::slug('Máy câu'),
                'description' => 'Máy câu chất lượng cao, nhẹ, bền và dễ sử dụng.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lưỡi câu',
                'slug' => Str::slug('Lưỡi câu'),
                'description' => 'Các loại lưỡi câu inox, carbon, chống gỉ sét, sắc bén.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mồi',
                'slug' => Str::slug('Mồi'),
                'description' => 'Mồi thật, mồi giả, mồi nhân tạo phù hợp nhiều loại cá.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Phụ kiện',
                'slug' => Str::slug('Phụ kiện'),
                'description' => 'Tổng hợp các phụ kiện đi câu: hộp đồ, túi, ghế, đèn pin...',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
