<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::factory(10)->create();

//        $this->command->info("Organization: {$organization->name} created with 40 users and 5 projects.");
    }
}
