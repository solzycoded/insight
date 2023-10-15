<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // (user_id, title_id, first_name, last_name, phone_number, orcid_id)
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("first_name", 80);
            $table->string("last_name", 80);
            $table->string("phone_number", 14)->unique();
            $table->string("orcid_id", 20)->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('title_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
