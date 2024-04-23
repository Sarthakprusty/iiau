<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->insert([
            'section_name' => 'IIAU'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Admin'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'GA'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Establishment'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'CR'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Public 1'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Public 2'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'RTI'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Household'
        ]);
    }
}
