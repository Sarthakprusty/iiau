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
            'email' => 'manager-nilayam@rb.nic.in',
            'username'=>'nilayam',
            'role'=>1,
            'section_id'=>10
        ]);
        User::factory()->create([
            'name' => 'Mashobora',
            'email' => 'sanju.dogra@nic.in',
            'username'=>'mashobora',
            'role'=>1,
            'section_id'=>11
        ]);
        User::factory()->create([
            'name' => 'Bills(admn)',
            'email' => 'so-cashsec@rb.nic.in',
            'username'=>'bills_admn',
            'role'=>1,
            'section_id'=>12
        ]);
        User::factory()->create([
            'name' => 'Bills(Estt)',
            'email' => 'so-cashsec@rb.nic.in',
            'username'=>'bills_estt',
            'role'=>1,
            'section_id'=>13
        ]);
        User::factory()->create([
            'name' => 'PAO Unit',
            'email' => 'manojkr.yadav@nic.in',
            'username'=>'pao_unit',
            'role'=>1,
            'section_id'=>14
        ]);
        User::factory()->create([
            'name' => 'Welfare',
            'email' => 'phulva.devi@nic.in',
            'username'=>'welfare',
            'role'=>1,
            'section_id'=>15
        ]);
        User::factory()->create([
            'name' => 'Cash',
            'email' => 'so-cashsec@rb.nic.in',
            'username'=>'cash',
            'role'=>1,
            'section_id'=>16
        ]);
        User::factory()->create([
            'name' => 'CA-1',
            'email' => 'ashwani.kumar.rb@rb.nic.in',
            'username'=>'ca1',
            'role'=>1,
            'section_id'=>17
        ]);
        User::factory()->create([
            'name' => 'CA-2',
            'email' => 'zubairalam.khan@nic.in',
            'username'=>'ca2',
            'role'=>1,
            'section_id'=>18
        ]);
        User::factory()->create([
            'name' => 'CA-3',
            'email' => 'zubairalam.khan@nic.in',
            'username'=>'ca3',
            'role'=>1,
            'section_id'=>19
        ]);
        User::factory()->create([
            'name' => 'Ceremonial',
            'email' => 'ceremonial.section@rb.nic.in',
            'username'=>'ceremonial',
            'role'=>1,
            'section_id'=>20
        ]);
        User::factory()->create([
            'name' => 'EBA',
            'email' => 'ajit.kumar.rb@nic.in',
            'username'=>'eba',
            'role'=>1,
            'section_id'=>21
        ]);
        User::factory()->create([
            'name' => 'Garage',
            'email' => 'kulchandra.kumar@nic.in',
            'username'=>'garage',
            'role'=>1,
            'section_id'=>22
        ]);
        User::factory()->create([
            'name' => 'Garden',
            'email' => 'suchit.manjhi@nic.in',
            'username'=>'garden',
            'role'=>1,
            'section_id'=>23
        ]);
        User::factory()->create([
            'name' => 'Message',
            'email' => 'neeta.thawani@nic.in',
            'username'=>'message',
            'role'=>1,
            'section_id'=>24
        ]);
        User::factory()->create([
            'name' => 'Sanitary',
            'email' => 'amit.kumar.rb@rb.nic.in',
            'username'=>'sanitary',
            'role'=>1,
            'section_id'=>25
        ]);
        User::factory()->create([
            'name' => 'Tour',
            'email' => 'tourofficer@rb.nic.in',
            'username'=>'tour',
            'role'=>1,
            'section_id'=>26
        ]);
        User::factory()->create([
            'name' => 'PEC Clinic',
            'email' => 'shailendra.yadav@nic.in',
            'username'=>'pec',
            'role'=>1,
            'section_id'=>27
        ]);
        User::factory()->create([
            'name' => 'Museum',
//            'email' => 'household@rb.nic.in',
            'username'=>'museum',
            'role'=>1,
            'section_id'=>28
        ]);
        User::factory()->create([
            'name' => 'VMC',
//            'email' => 'household@rb.nic.in',
            'username'=>'vmc',
            'role'=>1,
            'section_id'=>29
        ]);
        User::factory()->create([
            'name' => 'Invitation',
            'email' => 'kumar.ashok.rb@nic.in',
            'username'=>'invitation',
            'role'=>1,
            'section_id'=>30
        ]);



        User::factory()->create([
            'name' => 'US Admin',
            'email' => 'pankaj.saurabh@nic.in',
            'username'=>'us_admin',
            'role'=>2,
            'section_id'=>2
        ]);
        User::factory()->create([
            'name' => 'US GA',
            'email' => 'usga-tpt@rb.nic.in',
            'username'=>'us_ga',
            'role'=>2,
            'section_id'=>3
        ]);
        User::factory()->create([
            'name' => 'US Establishment',
            'email' => 'b.bhushan.rb@nic.in',
            'username'=>'us_establishment',
            'role'=>2,
            'section_id'=>4
        ]);
        User::factory()->create([
            'name' => 'US Central Registry',
            'email' => 'p.retheesh@rb.nic.in',
            'username'=>'us_cr',
            'role'=>2,
            'section_id'=>5
        ]);
        User::factory()->create([
            'name' => 'US Public 1',
            'email' => 'meena.pc@nic.in',
            'username'=>'us_p1',
            'role'=>2,
            'section_id'=>6
        ]);
        User::factory()->create([
            'name' => 'US Public 2',
            'email' => 'meena.pc@nic.in',
            'username'=>'us_p2',
            'role'=>2,
            'section_id'=>7
        ]);
        User::factory()->create([
            'name' => 'US RTI',
            'email' => 'p.retheesh@rb.nic.in',
            'username'=>'us_rti',
            'role'=>2,
            'section_id'=>8
        ]);
        User::factory()->create([
            'name' => 'US Household',
            'email' => 'acph-rb@rb.nic.in',
            'username'=>'us_household',
            'role'=>2,
            'section_id'=>9
        ]);
        User::factory()->create([
            'name' => 'US Nilayam',
            'email' => 'osd.ss@rb.nic.in',
            'username'=>'us_nilayam',
            'role'=>2,
            'section_id'=>10
        ]);
        User::factory()->create([
            'name' => 'US Mashobora',
            'email' => 'osd.ss@rb.nic.in',
            'username'=>'us_mashobora',
            'role'=>2,
            'section_id'=>11
        ]);
        User::factory()->create([
            'name' => 'Bills(admin)',
            'email' => 'k.gautam@nic.in',
            'username'=>'us_bills_admn',
            'role'=>2,
            'section_id'=>12
        ]);
        User::factory()->create([
            'name' => 'Bills(Estt)',
            'email' => 'k.gautam@nic.in',
            'username'=>'us_bills_estt',
            'role'=>2,
            'section_id'=>13
        ]);
        User::factory()->create([
            'name' => 'PAO Unit',
            'email' => 'mp.popli@gov.in',
            'username'=>'us_pao_unit',
            'role'=>2,
            'section_id'=>14
        ]);
        User::factory()->create([
            'name' => 'Welfare',
            'email' => 'k.gautam@nic.in',
            'username'=>'us_welfare',
            'role'=>2,
            'section_id'=>15
        ]);
        User::factory()->create([
            'name' => 'Cash',
            'email' => 'k.gautam@nic.in',
            'username'=>'us_cash',
            'role'=>2,
            'section_id'=>16
        ]);
        User::factory()->create([
            'name' => 'CA-1',
            'email' => 'sm.sami@nic.in',
            'username'=>'us_ca1',
            'role'=>2,
            'section_id'=>17
        ]);
        User::factory()->create([
            'name' => 'CA-2',
            'email' => 'sm.sami@nic.in',
            'username'=>'us_ca2',
            'role'=>2,
            'section_id'=>18
        ]);
        User::factory()->create([
            'name' => 'CA-3',
            'email' => 'p.retheesh@rb.nic.in',
            'username'=>'us_ca3',
            'role'=>2,
            'section_id'=>19
        ]);
        User::factory()->create([
            'name' => 'Ceremonial',
            'email' => 'sanjay.sundriyal27@rb.nic.in',
            'username'=>'us_ceremonial',
            'role'=>2,
            'section_id'=>20
        ]);
        User::factory()->create([
            'name' => 'EBA',
            'email' => 'pankaj.saurabh@nic.in',
            'username'=>'us_eba',
            'role'=>2,
            'section_id'=>21
        ]);
        User::factory()->create([
            'name' => 'Garage',
            'email' => 'ustransport@rb.nic.inn',
            'username'=>'us_garage',
            'role'=>2,
            'section_id'=>22
        ]);
        User::factory()->create([
            'name' => 'Garden',
            'email' => 'sm.sami@nic.in',
            'username'=>'us_garden',
            'role'=>2,
            'section_id'=>23
        ]);
        User::factory()->create([
            'name' => 'Message',
            'email' => 'dps@rb.nic.in',
            'username'=>'us_message',
            'role'=>2,
            'section_id'=>24
        ]);
        User::factory()->create([
            'name' => 'Sanitary',
            'email' => 'acph-rb@rb.nic.in',
            'username'=>'us_sanitary',
            'role'=>2,
            'section_id'=>25
        ]);
        User::factory()->create([
            'name' => 'Tour',
            'email' => 'sanjay.sundriyal27@rb.nic.in',
            'username'=>'us_tour',
            'role'=>2,
            'section_id'=>26
        ]);
        User::factory()->create([
            'name' => 'US PEC Clinic',
            'email' => 'sameeksha.jain@lhmc-hosp.gov.in',
            'username'=>'us_pec',
            'role'=>2,
            'section_id'=>27
        ]);
        User::factory()->create([
            'name' => 'US Museum',
            'email' => 'pankaj@rb.nic.in',
            'username'=>'us_museum',
            'role'=>2,
            'section_id'=>28
        ]);
        User::factory()->create([
            'name' => 'US VMC',
            'email' => 'anupam.nag@rb.nic.in',
            'username'=>'us_vmc',
            'role'=>2,
            'section_id'=>29
        ]);
        User::factory()->create([
            'name' => 'US Invitation',
            'email' => 'sanjay.sundriyal27@rb.nic.in',
            'username'=>'us_invitation',
            'role'=>2,
            'section_id'=>30
        ]);


    }
}
