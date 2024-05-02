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
        Schema::create('report_status', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->text('remark')->nullable(true);
            $table->boolean('active')->nullable(true);
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
        Schema::dropIfExists('report_status');
    }
};
