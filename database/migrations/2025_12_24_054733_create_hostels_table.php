<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->string('warden_name');
            $table->string('warden_phone');
            $table->text('address');
            $table->integer('total_rooms');
            $table->integer('available_rooms');
            $table->decimal('monthly_fee', 12, 2);
            $table->text('facilities')->nullable();
            $table->enum('status', ['active', 'inactive', 'full'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hostels');
    }
};
