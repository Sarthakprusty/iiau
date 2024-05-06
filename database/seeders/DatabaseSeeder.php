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
            'role'=>3,
            'section_id'=>1
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@rb.nic.in',
            'username'=>'admin',
            'role'=>1,
            'section_id'=>2
        ]);
        User::factory()->create([
            'name' => 'GA',
            'email' => 'ga@rb.nic.in',
            'username'=>'ga',
            'role'=>1,
            'section_id'=>3
        ]);
        User::factory()->create([
            'name' => 'Establishment',
            'email' => 'est@rb.nic.in',
            'username'=>'establishment',
            'role'=>1,
            'section_id'=>4
        ]);
        User::factory()->create([
            'name' => 'Central Registry',
            'email' => 'cr@rb.nic.in',
            'username'=>'cr',
            'role'=>1,
            'section_id'=>5
        ]);
        User::factory()->create([
            'name' => 'Public 1',
            'email' => 'p1@rb.nic.in',
            'username'=>'p1',
            'role'=>1,
            'section_id'=>6
        ]);
        User::factory()->create([
            'name' => 'Public 2',
            'email' => 'p2@rb.nic.in',
            'username'=>'p2',
            'role'=>1,
            'section_id'=>7
        ]);
        User::factory()->create([
            'name' => 'RTI',
            'email' => 'rti@rb.nic.in',
            'username'=>'rti',
            'role'=>1,
            'section_id'=>8
        ]);
        User::factory()->create([
            'name' => 'Household',
            'email' => 'household@rb.nic.in',
            'username'=>'household',
            'role'=>1,
            'section_id'=>9
        ]);


        User::factory()->create([
            'name' => 'US Admin',
            'username'=>'USadmin',
            'role'=>2,
            'section_id'=>2
        ]);
        User::factory()->create([
            'name' => 'US GA',
            'username'=>'USga',
            'role'=>2,
            'section_id'=>3
        ]);
        User::factory()->create([
            'name' => 'US Establishment',
            'username'=>'USestablishment',
            'role'=>2,
            'section_id'=>4
        ]);
        User::factory()->create([
            'name' => 'US Central Registry',
            'username'=>'UScr',
            'role'=>2,
            'section_id'=>5
        ]);
        User::factory()->create([
            'name' => 'US Public 1',
            'username'=>'USp1',
            'role'=>2,
            'section_id'=>6
        ]);
        User::factory()->create([
            'name' => 'US Public 2',
            'username'=>'USp2',
            'role'=>2,
            'section_id'=>7
        ]);
        User::factory()->create([
            'name' => 'US RTI',
            'username'=>'USrti',
            'role'=>2,
            'section_id'=>8
        ]);
        User::factory()->create([
            'name' => 'US Household',
            'username'=>'UShousehold',
            'role'=>2,
            'section_id'=>9
        ]);
    }
}
