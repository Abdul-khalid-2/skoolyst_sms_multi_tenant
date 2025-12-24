<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->foreignId('fee_group_id')->constrained()->restrictOnDelete();
            $table->foreignId('class_id')->constrained()->restrictOnDelete();
            $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
            $table->decimal('amount', 12, 2);
            $table->date('due_date')->nullable();
            $table->integer('due_days')->default(10);
            $table->decimal('late_fee_amount', 12, 2)->default(0);
            $table->string('late_fee_type')->default('fixed');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['fee_group_id', 'class_id', 'academic_year_id']);
            $table->index(['school_id', 'academic_year_id', 'class_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('fee_structures');
    }
};
