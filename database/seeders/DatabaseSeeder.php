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
            'name' => 'Nilayam',
//            'email' => 'rti@rb.nic.in',
            'username'=>'nilayam',
            'role'=>1,
            'section_id'=>10
        ]);
        User::factory()->create([
            'name' => 'Mashobora',
//            'email' => 'household@rb.nic.in',
            'username'=>'mashobora',
            'role'=>1,
            'section_id'=>11
        ]);
        User::factory()->create([
            'name' => 'Bills(admn)',
//            'email' => 'rti@rb.nic.in',
            'username'=>'bills_admn',
            'role'=>1,
            'section_id'=>12
        ]);
        User::factory()->create([
            'name' => 'Bills(Estt)',
//            'email' => 'household@rb.nic.in',
            'username'=>'bills_estt',
            'role'=>1,
            'section_id'=>13
        ]);
        User::factory()->create([
            'name' => 'PAO Unit',
//            'email' => 'household@rb.nic.in',
            'username'=>'paounit',
            'role'=>1,
            'section_id'=>14
        ]);
        User::factory()->create([
            'name' => 'Welfare',
//            'email' => 'rti@rb.nic.in',
            'username'=>'welfare',
            'role'=>1,
            'section_id'=>15
        ]);
        User::factory()->create([
            'name' => 'Cash',
//            'email' => 'household@rb.nic.in',
            'username'=>'cash',
            'role'=>1,
            'section_id'=>16
        ]);
        User::factory()->create([
            'name' => 'CA-1',
//            'email' => 'rti@rb.nic.in',
            'username'=>'ca1',
            'role'=>1,
            'section_id'=>17
        ]);
        User::factory()->create([
            'name' => 'CA-2',
//            'email' => 'household@rb.nic.in',
            'username'=>'ca2',
            'role'=>1,
            'section_id'=>18
        ]);
        User::factory()->create([
            'name' => 'CA-3',
//            'email' => 'rti@rb.nic.in',
            'username'=>'ca3',
            'role'=>1,
            'section_id'=>19
        ]);
        User::factory()->create([
            'name' => 'Ceremonial',
//            'email' => 'household@rb.nic.in',
            'username'=>'ceremonial',
            'role'=>1,
            'section_id'=>20
        ]);
        User::factory()->create([
            'name' => 'EBA',
//            'email' => 'rti@rb.nic.in',
            'username'=>'eba',
            'role'=>1,
            'section_id'=>21
        ]);
        User::factory()->create([
            'name' => 'Garage',
//            'email' => 'household@rb.nic.in',
            'username'=>'garage',
            'role'=>1,
            'section_id'=>22
        ]);
        User::factory()->create([
            'name' => 'Garden',
//            'email' => 'rti@rb.nic.in',
            'username'=>'garden',
            'role'=>1,
            'section_id'=>23
        ]);
        User::factory()->create([
            'name' => 'Message',
//            'email' => 'household@rb.nic.in',
            'username'=>'message',
            'role'=>1,
            'section_id'=>24
        ]);
        User::factory()->create([
            'name' => 'Sanitary',
//            'email' => 'household@rb.nic.in',
            'username'=>'sanitary',
            'role'=>1,
            'section_id'=>25
        ]);
        User::factory()->create([
            'name' => 'Tour',
//            'email' => 'household@rb.nic.in',
            'username'=>'tour',
            'role'=>1,
            'section_id'=>26
        ]);
        User::factory()->create([
            'name' => 'PEC Clinic',
//            'email' => 'household@rb.nic.in',
            'username'=>'pec',
            'role'=>1,
            'section_id'=>27
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
        User::factory()->create([
            'name' => 'US Nilayam',
//            'email' => 'rti@rb.nic.in',
            'username'=>'usnilayam',
            'role'=>1,
            'section_id'=>10
        ]);
        User::factory()->create([
            'name' => 'US Mashobora',
//            'email' => 'household@rb.nic.in',
            'username'=>'usmashobora',
            'role'=>1,
            'section_id'=>11
        ]);
        User::factory()->create([
            'name' => 'Bills(admn)',
//            'email' => 'rti@rb.nic.in',
            'username'=>'us_bills_admn',
            'role'=>2,
            'section_id'=>12
        ]);
        User::factory()->create([
            'name' => 'Bills(Estt)',
//            'email' => 'household@rb.nic.in',
            'username'=>'us_bills_estt',
            'role'=>2,
            'section_id'=>13
        ]);
        User::factory()->create([
            'name' => 'PAO Unit',
//            'email' => 'household@rb.nic.in',
            'username'=>'uspaounit',
            'role'=>2,
            'section_id'=>14
        ]);
        User::factory()->create([
            'name' => 'Welfare',
//            'email' => 'rti@rb.nic.in',
            'username'=>'uswelfare',
            'role'=>2,
            'section_id'=>15
        ]);
        User::factory()->create([
            'name' => 'Cash',
//            'email' => 'household@rb.nic.in',
            'username'=>'uscash',
            'role'=>2,
            'section_id'=>16
        ]);
        User::factory()->create([
            'name' => 'CA-1',
//            'email' => 'rti@rb.nic.in',
            'username'=>'usca1',
            'role'=>2,
            'section_id'=>17
        ]);
        User::factory()->create([
            'name' => 'CA-2',
//            'email' => 'household@rb.nic.in',
            'username'=>'usca2',
            'role'=>2,
            'section_id'=>18
        ]);
        User::factory()->create([
            'name' => 'CA-3',
//            'email' => 'rti@rb.nic.in',
            'username'=>'usca3',
            'role'=>2,
            'section_id'=>19
        ]);
        User::factory()->create([
            'name' => 'Ceremonial',
//            'email' => 'household@rb.nic.in',
            'username'=>'usceremonial',
            'role'=>2,
            'section_id'=>20
        ]);
        User::factory()->create([
            'name' => 'EBA',
//            'email' => 'rti@rb.nic.in',
            'username'=>'useba',
            'role'=>2,
            'section_id'=>21
        ]);
        User::factory()->create([
            'name' => 'Garage',
//            'email' => 'household@rb.nic.in',
            'username'=>'usgarage',
            'role'=>2,
            'section_id'=>22
        ]);
        User::factory()->create([
            'name' => 'Garden',
//            'email' => 'rti@rb.nic.in',
            'username'=>'usgarden',
            'role'=>2,
            'section_id'=>23
        ]);
        User::factory()->create([
            'name' => 'Message',
//            'email' => 'household@rb.nic.in',
            'username'=>'usmessage',
            'role'=>2,
            'section_id'=>24
        ]);
        User::factory()->create([
            'name' => 'Sanitary',
//            'email' => 'household@rb.nic.in',
            'username'=>'ussanitary',
            'role'=>2,
            'section_id'=>25
        ]);
        User::factory()->create([
            'name' => 'Tour',
//            'email' => 'household@rb.nic.in',
            'username'=>'ustour',
            'role'=>2,
            'section_id'=>26
        ]);
        User::factory()->create([
            'name' => 'US PEC Clinic',
//            'email' => 'household@rb.nic.in',
            'username'=>'uspec',
            'role'=>2,
            'section_id'=>27
        ]);

    }
}
