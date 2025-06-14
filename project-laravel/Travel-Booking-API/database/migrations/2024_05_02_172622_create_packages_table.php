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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['light', 'heavy'])->nullable();
            $table->string('name')->nullable();
            $table->double('cost_price')->nullable();
            $table->double('sale_price')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('category', ['technology', 'consumption', 'others'])->nullable();
            $table->date('comfirmed_date')->nullable();
            $table->integer('quotas')->nullable();
            $table->boolean('current')->nullable();
            
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->foreign('destination_id')->references('id')->on('destinations')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
