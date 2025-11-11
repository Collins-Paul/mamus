<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoginsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
         DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'support@admin.com',
            'phone' => '6768799797',
            'country_of_residence' => 'USA',
            'account_type' => 'admin',
            'verification_status' => 1,
            'who' => 2,
            'password' => Hash::make('adminPASSWORD')
        ]);
    }
}
