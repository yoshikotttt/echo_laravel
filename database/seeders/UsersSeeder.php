<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1番目の人：依頼医
        User::create([
            'name' => 'RequestDoctor1',
            'email' => 'requestdoc1@example.com',
            'password' => Hash::make('password'),
            'skyway_id' => Str::random(16),
            'role' => 0, // 0 for request doctor, 1 for accept doctor
        ]);

        // 受託医
        $regions = ['北海道', '東北', '関東', '中部', '関西', '中国四国', '九州'];
        $areas = ['上腹部', '下腹部', '心臓'];

        for ($i = 2; $i <= 8; $i++) {
            User::create([
                'name' => "AcceptDoctor$i",
                'email' => "acceptdoc$i@example.com",
                'password' => Hash::make('password'),
                'skyway_id' => Str::random(16),
                'role' => 1,
                'qualification' => ($i % 2 === 0) ? '専門医' : '検査士',
                'qualification_year' => rand(2000, 2022),
                'region' => $regions[rand(0, 6)],
                'areas' => json_encode(array_slice($areas, 0, rand(1, 3)), JSON_UNESCAPED_UNICODE),
                'status' => rand(0, 1) === 1
            ]);
        }
    }
}
