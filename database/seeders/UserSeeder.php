<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => "Jaison Saji",
            'email' => "admin@admin.com",
            'phone' => "+919544850772",
            'user_role_id' => 1,
            'password' => bcrypt('123456'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => "Jaison Saji",
            'email' => "user@user.com",
            'phone' => "+917907680129",
            'user_role_id' => 2,
            'password' => bcrypt('123456'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
