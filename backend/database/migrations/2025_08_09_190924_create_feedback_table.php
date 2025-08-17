<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('AnimeName');
            $table->string('status');
            $table->text('anime_feedback');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};

