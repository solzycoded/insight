<?php

namespace Tests\Feature;

use App\Models\ArticleType;
use App\Models\Journal;
use App\Models\Status;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateManuscriptTest extends TestCase
{
    /**
     * A basic feature test created_manuscript-successfully
     *
     * @return void
     */
    public function test_created_manuscript_successfully()
    {
        $this->login();

        $manuscript = $this->fakeManuscriptData();
        $manuscriptFile = $this->fakeFile();

        $manuscript['manuscript_file'] = $manuscriptFile;

        $response = $this->post('publish-your-work/manuscript', $manuscript);

        $response->assertRedirect('publish-your-work/authors');
        $response->assertStatus(302);
    }

    private function fakeFile(){
        Storage::fake('public');

        $file = UploadedFile::fake()->image('public/test_image.png');

        return $file;
    }

    private function fakeManuscriptData(){
        $article = ArticleType::inRandomorder()->first();

        $journal = Journal::inRandomorder()->first();

        $this->createFakeJournalSession($journal->id);

        $manuscript = [
            'article_type' => $article->id,
            'journal_id'      => $journal->id,
            'manuscript_title'           => fake()->name(),
            'manuscript_abstract'        => fake()->word(),
            'user_id'         => auth()->user()->id,
            'status_id'       => Status::firstWhere('name', 'pending')->id
        ];

        return $manuscript;
    }

    private function createFakeJournalSession($journalId){
        session([
            'journal' => [
                'id'      => $journalId, 
                'user_id' => auth()->user()->id
            ]
        ]);
    }

    private function login(){
        $loginData = [
            'email' => 'solzyfrenzy1@gmail.com',
            'password' => 'passworded'
        ];

        $this->post('/login', $loginData);
    }
}
