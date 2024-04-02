<?php

namespace Tests\Feature;

use App\Models\ArticleType;
use App\Models\Journal;
use App\Models\Manuscript;
use App\Models\ManuscriptFile;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateManuscript extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_Manuscript_Test()
    {
        $this->login();

        $manuscriptData = $this->generateFakeManuscriptData();
        $file           = $this->generateFakeManuscriptFile();

        $manuscriptData["manuscript_file"] = $file;

        $response = $this->post("/publish-your-work/manuscript", $manuscriptData);
       
        $response->assertStatus(302);
        $response->assertRedirect("/publish-your-work/authors");
        $response->assertSessionHas("success");
    }

    private function login(){
        $loginData = [
            'email' => 'solzyfrenzy1@gmail.com',
            'password' => 'passworded'
        ];

        $this->post("/login", $loginData);
    }

    private function generateFakeManuscriptData(){
        // select a journal
        $journal = Journal::inRandomOrder()->first();

        // select an article
        $article = ArticleType::inRandomOrder()->first();

        $manuscript = [
            'article_type_id' => $article->id,
            'journal_id'      => $journal->id,
            'title'           => fake()->name(),
            'abstract'        => fake()->sentences(100),
            'user_id'         => User::inRandomOrder()->first()->id,
            'status_id'       => Status::firstWhere('name', 'pending')->id
        ];

        return $manuscript;
    }

    private function generateFakeManuscriptFile(){
        Storage::fake("public");

        $file = HttpUploadedFile::fake()->image("public/test_image.jpg");

        return $file;
    }

    private function createManuscript($manuscript){
        $manuscriptInsert = Manuscript::firstOrCreate($manuscript);

        return $manuscriptInsert;
    }

    private function storeManuscriptFile($manuscriptFile, $manuscriptId){
        return ManuscriptFile::create([
            'manuscript_file' => $manuscriptFile,
            'manuscript_id'   => $manuscriptId
        ]);
    }
}
