<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

class LiveChatApp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('live_chat_apps')->insert([
            'url' => null,
            'script' => null,
        ]);
    }
}
