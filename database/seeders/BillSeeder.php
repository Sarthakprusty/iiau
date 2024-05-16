<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bills')->insert([
            'desc' => 'LTC Bills'
        ]);
        DB::table('bills')->insert([
            'desc' => 'Medical/ Medical Advance bills'
        ]);
        DB::table('bills')->insert([
            'desc' => 'GPF Withdrawl'
        ]);
        DB::table('bills')->insert([
            'desc' => 'CEA Bills'
        ]);
        DB::table('bills')->insert([
            'desc' => 'Contractor Bills'
        ]);
        DB::table('bills')->insert([
            'desc' => 'Others'
        ]);
        DB::table('bills')->insert([
            'desc' => 'Reimbursement bills'
        ]);
    }
}
