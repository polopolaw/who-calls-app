<?php

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phone::class);
            $table->foreignIdFor(User::class)
                ->nullable();

            $table->string('name');
            $table->string('content', 600);
            $table->enum('gender', ['male', 'female', 'unisex'])
                ->default('unisex');
            $table->string('avatar')
                ->nullable();


            $table->integer('vote')
                ->default(0);
            $table->boolean('approved')
                ->default('false');
            $table->enum('feedback_type', ['useful', 'negative', 'neutral'])
                ->default('negative');
            $table->string('emoji')
                ->nullable();
            $table->string('source_class')
                ->default('inner');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('comments');
        }
    }
};
