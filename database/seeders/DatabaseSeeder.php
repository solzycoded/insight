<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Journal;
use App\Models\Title;
use App\Models\OrganizationType;
use App\Models\ArticleType;
use App\Models\Status;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->seedJournals();
        $this->seedTitles();
        $this->seedOrganizationTypes();
        $this->seedArticleTypes();
        $this->seedStatus();
    }

    private function seedJournals(){
        // https://www.elsevier.com/search-results?query=&labels=journals&subject-0=27364
        $journals = ['IFAC Journal of Systems and Control', 'Microprocessors and Microsystems', 'Ocean Modelling', 'Computerized Medical Imaging and Graphics', 'Image and Vision Computing', 'Computer Languages, Systems & Structures', 'Computer Communications'];

        foreach ($journals as $value) {
            Journal::create([
                'name' => $value
            ]);
        }
    }

    private function seedTitles(){
        $journals = ['Mr', 'Mrs', 'Miss', 'Dr', 'Prof'];

        foreach ($journals as $value) {
            Title::create([
                'name' => $value
            ]);
        }
    }

    private function seedOrganizationTypes(){
        $articleTypes = ['Company', 'School', 'Research'];

        foreach ($articleTypes as $type) {
            OrganizationType::create([
                'type' => $type
            ]);
        }
    }

    private function seedArticleTypes(){
        $articleTypes = ['Original Research', 'Review Article', 'Perspective, Opinion and Commentary', 'Book Review'];

        foreach ($articleTypes as $type) {
            ArticleType::create([
                'type' => $type
            ]);
        }
    }

    private function seedStatus(){
        $types = ['pending', 'approved', 'rejected', 'under review'];

        foreach ($types as $type) {
            Status::create([
                'name' => $type
            ]);
        }
    }
}
