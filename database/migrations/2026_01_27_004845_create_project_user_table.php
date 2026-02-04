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
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('status')->comment('参画状況');
            $table->unsignedTinyInteger('allocation_percent')->default(100)->comment('プロジェクトへの稼働比率（%）');
            $table->integer('assigned_role')->comment('プロジェクトロール');
            $table->date('joined_at')->nullable()->comment('参画日');
            $table->date('leave_at')->nullable()->comment('離任日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};
