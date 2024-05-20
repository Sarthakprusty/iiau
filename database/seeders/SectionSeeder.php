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
            'section_name' => 'Administration'
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
        DB::table('sections')->insert([
            'section_name' => 'Nilayam'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Mashobora'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Bills(Admn)'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Bills(Estt)'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'PAO Unit'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Welfare'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Cash'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'CA-1'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'CA-2'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'CA-3'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Ceremonial'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'EBA'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Garage'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Garden'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Message'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Sanitary'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Tour'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'PEC Clinic'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Museum'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'VMC'
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Invitation'
        ]);
    }
}
