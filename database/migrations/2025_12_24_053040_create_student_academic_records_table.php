<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_academic_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->restrictOnDelete();
            $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
            $table->foreignId('class_id')->constrained()->restrictOnDelete();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->string('roll_no');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('result')->default('pending');
            $table->decimal('percentage', 5, 2)->nullable();
            $table->string('grade')->nullable();
            $table->integer('position')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'academic_year_id']);
            $table->index(['student_id', 'class_id']);
            $table->index(['academic_year_id', 'class_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_academic_records');
    }
};
