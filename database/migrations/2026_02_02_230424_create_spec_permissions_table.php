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
        Schema::create('spec_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spec_role_id')->constrained()->onDelete('cascade');
            $table->foreignId('spec_api_id')->constrained()->onDelete('cascade');
            $table->boolean('is_allowed')->default(true)->comment('この役割に実行権限があるか');
            $table->timestamps();
            $table->unique(['spec_role_id', 'spec_api_id'], 'role_api_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spec_permissions');
    }
};
