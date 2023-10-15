<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Title;
use \App\Models\OrganizationType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedTitle();
        $this->seedOrganizationTypes();
    }

    private function seedTitle(){
        $titles = ['Mr', 'Mrs', 'Miss', 'Dr', 'Prof'];

        foreach ($titles as $value) {
            Title::create([
                'name' => $value,
            ]);
        }
    }

    private function seedOrganizationTypes(){
        $titles = ['Company', 'Research Institute', 'College', 'University'];

        foreach ($titles as $value) {
            OrganizationType::create([
                'type' => $value,
            ]);
        }
    }
}
