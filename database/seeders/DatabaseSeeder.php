<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'IIAU',
            'email' => 'iiau@rb.nic.in',
            'username'=>'iiau',
            'section_id'=>1
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@rb.nic.in',
            'username'=>'admin',
            'section_id'=>2
        ]);
        User::factory()->create([
            'name' => 'GA',
            'email' => 'ga@rb.nic.in',
            'username'=>'ga',
            'section_id'=>3
        ]);
        User::factory()->create([
            'name' => 'Establishment',
            'email' => 'est@rb.nic.in',
            'username'=>'establishment',
            'section_id'=>4
        ]);
        User::factory()->create([
            'name' => 'Central Registry',
            'email' => 'cr@rb.nic.in',
            'username'=>'cr',
            'section_id'=>5
        ]);
        User::factory()->create([
            'name' => 'Public 1',
            'email' => 'p1@rb.nic.in',
            'username'=>'p1',
            'section_id'=>6
        ]);
        User::factory()->create([
            'name' => 'Public 2',
            'email' => 'p2@rb.nic.in',
            'username'=>'p2',
            'section_id'=>7
        ]);
        User::factory()->create([
            'name' => 'RTI',
            'email' => 'rti@rb.nic.in',
            'username'=>'rti',
            'section_id'=>8
        ]);
        User::factory()->create([
            'name' => 'Household',
            'email' => 'household@rb.nic.in',
            'username'=>'household',
            'section_id'=>9
        ]);
    }
}
