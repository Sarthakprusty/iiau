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
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable(false);
            $table->integer('month')->nullable(false);
            $table->integer('year')->nullable(false);
            $table->string('desc')->nullable(true);
            $table->date('date_of_comm')->nullable(true);
            $table->date('date_of_reply')->nullable(true);
            $table->date('date_of_action')->nullable(true);
            $table->text('remarks')->nullable(true);
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
        Schema::dropIfExists('references');
    }
};
