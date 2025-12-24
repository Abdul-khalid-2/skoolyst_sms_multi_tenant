<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->string('title');
            $table->string('isbn')->nullable();
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->integer('edition')->nullable();
            $table->integer('publication_year')->nullable();
            $table->string('category')->nullable();
            $table->integer('total_copies');
            $table->integer('available_copies');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('rack_no')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('available');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'category']);
            $table->index(['school_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
