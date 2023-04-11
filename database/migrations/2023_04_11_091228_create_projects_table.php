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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('deadline');
            $table->string('description');
            $table->string('objective');
            $table->string('problem');
            $table->enum('type', ['ASD', "ZXC"]);
            $table->string('actual');
            $table->string('target_audience');
            $table->string('competitors');
            $table->string('novelty');
            $table->string('risks');
            $table->enum('product_type', ['JJ', 'TTT']);
            $table->string('product_result');
            $table->string('main_characteristics_product');
            $table->string('resources');
            $table->string('income');
            $table->string('promotion_channels');
            $table->string('partners');
            $table->enum('achieved_level', ['SSS', 'QQQ']);
            $table->enum('implementation_phase', ['GGGG', 'PPP']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
