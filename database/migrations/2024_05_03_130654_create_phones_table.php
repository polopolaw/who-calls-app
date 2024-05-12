<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();

            $table->string('phone')
                ->unique();
            $table->string('type')
                ->nullable();
            $table->string('region_code')
                ->nullable();
            $table->string('country_code')
                ->nullable();
            $table->string('national_number')
                ->nullable();
            $table->dateTime('last_sync')
                ->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('phones');
        }
    }
};
