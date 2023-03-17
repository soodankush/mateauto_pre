<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platformsData = [
            [
                'platform_name' => 'twitter',
                'platform_url'  => 'https://twitter.com',
                'status'        => true
            ],
            [
                'platform_name' => 'gumroad',
                'platform_url'  => 'https://gumroad.com',
                'status'        => true
            ],
            [
                'platform_name' => 'linkedin',
                'platform_url'  => 'https://linkedin.com',
                'status'        => false
            ],
            [
                'platform_name' => 'youtube',
                'platform_url'  => 'https://youtube.com',
                'status'        => false
            ],
            [
                'platform_name' => 'instagram',
                'platform_url'  => 'https://instagram.com',
                'status'        => false
            ],
            [
                'platform_name' => 'facebook',
                'platform_url'  => 'https://facebook.com',
                'status'        => false
            ],
        ];

        foreach ($platformsData as $platformValue) {
            Platform::updateOrCreate([
                'platform_name' => $platformValue['platform_name'],
                'platform_url'  => $platformValue['platform_url']
            ], [
                'status'        => $platformValue['status']
            ]);
        }
    }
}
