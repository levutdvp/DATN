<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Services::create([
            'name' => 'VIP 1',
            'price' => 100,
            'date_number' => 7,
            'color' => '#ea0606',
            'description' => '<p>Đứng đầu danh s&aacute;ch c&aacute;c tin đăng.</p> <p>Ti&ecirc;u đề <span style="color:#c0392b">M&Agrave;U ĐỎ</span>, IN HOA.</p> <p>C&oacute; biểu tượng ở g&oacute;c tr&aacute;i tr&ecirc;n c&ugrave;ng h&igrave;nh đại diện.</p> <p>&nbsp;</p>'
        ]);
        Services::create( [
            'name' => 'VIP 2',
            'price' => 80,
            'date_number' => 5,
            'color' => '#fb9332',
            'description' => '<p>Hiển thị dưới tin VIP 1, tr&ecirc;n tin VIP 3 v&agrave; tin thường.</p> <p>Ti&ecirc;u đề<span style="color:#e67e22"> M&Agrave;U CAM</span>, IN HOA.</p>'
        ]);
        Services::create([
            'name' => 'VIP 3',
            'price' => 60,
            'date_number' => 3,
            'color' => '#ff33cc',
            'description' => '<p>Hiển thị dưới tin VIP 1, VIP 2 v&agrave; tr&ecirc;n tin thường.</p> <p>Ti&ecirc;u đề <span style="color:#ff33cc">M&Agrave;U HỒNG</span>, IN HOA.</p>'
        ]);
        // Services::create([
        //     'name' => 'Tin thường',
        //     'price' => 0,
        //     'date_number' => 0,
        //     'color' => '#0331ff',
        //     'description' => '<p>Hiển thị dưới tin VIP 1, VIP 2, VIP 3.</p> <p>Ti&ecirc;u đề <span style="color:#0331ff">M&Agrave;U XANH</span>, IN HOA.</p>'
        // ]);

    }
}
