<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('type');
            $table->date('publish_date');
            $table->date('expiry_date')->nullable();
            $table->boolean('is_important')->default(false);
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'publish_date', 'type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('notices');
    }
};
