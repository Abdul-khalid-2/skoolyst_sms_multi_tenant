<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->foreignId('class_id')->constrained()->restrictOnDelete();
            $table->foreignId('academic_year_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('code')->nullable();
            $table->integer('capacity')->default(25);
            $table->string('shift')->default('morning');
            $table->string('room_number')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->json('weekdays')->nullable();
            $table->foreignId('class_teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assistant_teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('enable_attendance')->default(true);
            $table->boolean('enable_fee_collection')->default(true);
            $table->string('status')->default('active');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'class_id']);
            $table->index(['school_id', 'class_teacher_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
