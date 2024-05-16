<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('receipts')->insert([
            'desc' => 'General Receipt'
        ]);
        DB::table('receipts')->insert([
            'desc' => 'VVIP ref'
        ]);
        DB::table('receipts')->insert([
            'desc' => 'RTI'
        ]);
        DB::table('receipts')->insert([
            'desc' => 'Email'
        ]);
        DB::table('receipts')->insert([
            'desc' => 'Portal'
        ]);
        DB::table('receipts')->insert([
            'desc' => 'Others'
        ]);
    }
}
