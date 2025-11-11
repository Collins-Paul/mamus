<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contact_details')->insert([
            'phone_1' => 'N/A',
            'phone_2' => 'N/A',
            'address' => 'N/A',
        ]);
    }
}
