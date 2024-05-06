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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable(false);
            $table->integer('month')->nullable(false);
            $table->integer('year')->nullable(false);
            $table->string('desc')->nullable(true);
            $table->integer('brought_forward')->nullable(false)->default(0);
            $table->integer('received')->nullable(false)->default(0);
            $table->integer('disposed')->nullable(false)->default(0);
            $table->integer('pending_15')->nullable(false)->default(0);
            $table->integer('pending_30')->nullable(false)->default(0);
            $table->integer('pending_60')->nullable(false)->default(0);
            $table->integer('balance')->nullable(false)->default(0);
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
        Schema::dropIfExists('works');
    }
};
