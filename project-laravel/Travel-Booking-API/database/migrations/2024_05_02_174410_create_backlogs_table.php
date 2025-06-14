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
        Schema::create('backlogs', function (Blueprint $table) {
            $table->id();
            $table->date('backlog_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('pay_type', ['card', 'cash'])->nullable();
            $table->double('sale_total')->nullable();
            $table->float('descuent', 2)->nullable();
            $table->double('neto_total')->nullable();
            $table->boolean('confirmed')->nullable();
            $table->boolean('canceled')->nullable();
            
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('employee_id')->references('id')->on('employees')->nullOnDelete();
            $table->foreign('package_id')->references('id')->on('packages')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backlogs');
    }
};
