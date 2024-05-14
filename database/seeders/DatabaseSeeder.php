<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\CategoryRoom::factory(10)->create();
        // \App\Models\User::factory(20)->create();
        // \App\Models\Surrounding::factory(10)->create();
        // \App\Models\Facility::factory(20)->create();
        // \App\Models\Services::factory(20)->create();
        \App\Models\CategoryPost::factory(10)->create();
        \App\Models\Setting::factory(1)->create();
        // \App\Models\Advertisement::factory(5)->create();


        // \App\Models\Facility::factory(10)->create();

        //        App\Models\Surrounding::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            FacilitySeeder::class,
            SurroundingSeeder::class,
            ServicesSeeder::class,
            AdvertisementSeeder::class,
            SuperAdminSeeder::class,
        ]);
    }
}
