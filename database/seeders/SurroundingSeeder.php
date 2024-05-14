<?php

namespace Database\Seeders;

use App\Models\Surrounding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurroundingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Chợ', 'icon' => 'fa-solid fa-shop'],
            ['name' => 'Trường học', 'icon' => 'fa-solid fa-school'],
            ['name' => 'Siêu thị', 'icon' => 'fa-solid fa-store'],
            ['name' => 'Công viên', 'icon' => 'fa-solid fa-square-parking'],
            ['name' => 'Bệnh viện', 'icon' => 'fa-solid fa-hospital'],
            ['name' => 'Bến xe Bus', 'icon' => 'fa-solid fa-bus'],
            // Thêm các cặp name và icon khác tùy ý
        ];

        // Lặp qua mảng và tạo các bản ghi
        foreach ($data as $item) {
            Surrounding::create([
                'name' => $item['name'],
                'icon' => $item['icon'],
            ]);
        }
    }
}
