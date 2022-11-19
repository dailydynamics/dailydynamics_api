<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'id' => 1,
            'name' => 'Jilson',
            'email' => 'jilson@gmail.com',
            'subject' => 'New Enquiry',
            'phone' => '+919544850772',
            'message' => 'You have a new message',
        ]);
    }
}
