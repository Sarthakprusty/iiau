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
        Schema::create('uniforms', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable(false);
            $table->integer('month')->nullable(false);
            $table->integer('year')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('status')->nullable(false);
            $table->date('cut_off_date')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniforms');
    }
};
