<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('instructor_id');
            //            $table->string('category_id');
            $table->string('thumbnail_url');
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced']);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_free')->default(false);
            $table->timestamps();
            $table->foreign('instructor_id')->references('id')->on('user');
            //            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
