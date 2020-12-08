<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Payment;
use DB;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Document;
use App\Models\DocumentService;
use App\Models\Role;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\User;
use Database\Factories\CompanyUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles Table
        $this->call([RolesTableSeeder::class]);
        // Creat Abilities Table
        $this->call([AbilitiesTableSeeder::class]);
        // Create 10 Companies
        Company::factory(10)->create();
        // Create Specialist and Users
        foreach (Company::all() as $company) {
            // Create 2 Specialists in each Company
            Specialist::factory(2)->create([
                'company_uuid' => $company->company_uuid,
            ]);
            // Create 3 Users and attach to INN number
            User::factory(3)->create([
                'inn' => $company->inn,
            ]);
            // Seeding pivot tables
            foreach (User::where('inn',$company->inn)->get() as $user){
                //Seeding company_user pivot table
                DB::table('company_user')->insert([
                    'user_id' => $user->id,
                    'inn' => $company->inn]);
                //Seeding role_user pivot table
//                DB::table('role_user')->insert([
//                    'user_id' => $user->id,
//                    'role_id' => rand(1,3)
//                ]);
            }
        }
        foreach (Role::all() as $role) {
            DB::table('ability_role')->insert([
                'role_id' => rand(1,3),
                'ability_id' => rand(1,2)
            ]);
        }
        // Seeding Services
        foreach (Specialist::all() as $specialist) {
            Service::factory(2)->create([
                'specialist_uuid' => $specialist->specialist_uuid,
            ]);
        }
        foreach (Service::all() as $service) {
            // Seeding Documents table
            $documents = Document::factory(2)->create();
            // Seeding document_service pivot table
            foreach ($documents as $document) {
                DB::table('document_service')->insert([
                    'document_id' => $document->id,
                    'service_uuid' => $service->service_uuid
                ]);
            }
            // Seeding Payments table
            $payments = Payment::factory(2)->create();
            // Seeding payment_document pivot table
            foreach ($payments as $payment) {
                DB::table('payment_service')->insert([
                    'payment_id' => $payment->id,
                    'service_uuid' => $service->service_uuid
                ]);
            }

        }


    }
}
