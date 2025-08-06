<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // ユーザー1人作成
        $user = \App\Models\User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            // passwordはUserFactoryで'default'があるので省略してOK
        ]);

        // 目標体重データを1件作成
        \App\Models\WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);

        // ...前略...

        // 体重記録データを35件作成
        \App\Models\WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);

        // ↓ここに体重記録データを追記予定！
    }
}
