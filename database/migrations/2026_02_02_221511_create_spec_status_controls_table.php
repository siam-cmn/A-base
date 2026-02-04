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
        Schema::create('spec_status_controls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spec_scenario_id')->constrained();
            $table->foreignId('spec_api_id')->constrained();
            $table->boolean('is_executable')->default(true)->comment('該当状態でのAPI実行可否');
            $table->text('condition_note')->nullable()->comment('実行条件に関する詳細ルール');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spec_status_controls');
    }
};
