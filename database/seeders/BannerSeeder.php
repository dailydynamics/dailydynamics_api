<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            'image' => 'https://t4.ftcdn.net/jpg/04/67/93/01/360_F_467930159_UcfrOkjhFG436zoT9fSetYccBgpNkokp.jpg',
            'alt_text' => 'first banner',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()

        ]);
    }
}
