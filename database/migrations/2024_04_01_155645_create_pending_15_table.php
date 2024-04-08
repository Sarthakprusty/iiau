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
        Schema::create('pending_15', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable(false);
            $table->integer('month')->nullable(false);
            $table->integer('year')->nullable(false);
            $table->text('desc');
            $table->text('reason');
            $table->text('action');
            $table->integer('created_by')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_15');
    }
};
