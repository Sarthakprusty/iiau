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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable(false);
            $table->integer('month')->nullable(false);
            $table->integer('year')->nullable(false);
            $table->integer('rec')->nullable(false)->default(0);
            $table->integer('settled')->nullable(false)->default(0);
            $table->integer('prev_due')->nullable(false)->default(0);
            $table->integer('bal')->nullable(false)->default(0);
            $table->text('remarks')->nullable(true);
            $table->integer('created_by')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
