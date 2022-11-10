<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visibilities')->insert([
            'id'=> '1',
            'name' => 'public',
        ]);
        DB::table('visibilities')->insert([
            'id'=> '2',
            'name' => 'contacts',
        ]);
        DB::table('visibilities')->insert([
            'id'=> '3',
            'name' => 'private',
        ]);
    }
}
