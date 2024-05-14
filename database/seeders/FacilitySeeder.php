<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // \App\Models\Facility::factory(1)->create();
    public function run(): void
    {
        $data = [
            ['name' => 'Wifi', 'icon' => 'fa-solid fa-wifi'],
            ['name' => 'Bình nóng lạnh', 'icon' => 'fa-solid fa-temperature-full'],
            ['name' => 'Điều hòa', 'icon' => 'fa-solid fa-snowflake'],
            ['name' => 'Kệ bếp', 'icon' => 'fa-solid fa-kitchen-set'],
            ['name' => 'Giường', 'icon' => 'fa-solid fa-bed'],
            ['name' => 'Máy giặt', 'icon' => 'fa-solid fa-jug-detergent'],
            // ['name' => 'Tủ lạnh', 'icon' => 'fa-regular fa-refrigerator'],
            ['name' => 'Tủ lạnh', 'icon' => 'far fa-snowflake'],
            ['name' => 'Bãi để xe riêng', 'icon' => 'fa-solid fa-motorcycle'],
            ['name' => 'Camera an ninh', 'icon' => 'fa-solid fa-camera'],
        ];

        // Lặp qua mảng và tạo các bản ghi
        foreach ($data as $item) {
            Facility::create([
                'name' => $item['name'],
                'icon' => $item['icon'],
                'description' => fake()->text(10), // Sử dụng Faker cho description hoặc cung cấp giá trị theo ý muốn
            ]);
        }
    }
}
