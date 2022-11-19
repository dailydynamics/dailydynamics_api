<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'id' => 1,
            'name' => "admin",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()

        ]);
        DB::table('user_roles')->insert([
            'id' => 2,
            'name' => "user",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()

        ]);
    }
}
