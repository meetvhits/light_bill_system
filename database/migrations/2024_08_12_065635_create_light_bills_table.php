<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLightBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('supply_type')->nullable();
            $table->date('reading_date')->nullable();
            $table->integer('present_reading')->nullable();
            $table->integer('past_reading')->nullable();
            $table->decimal('past_amount', 8, 2)->nullable();
            $table->decimal('base_rate', 8, 2)->nullable();
            $table->decimal('total_units', 8, 2)->nullable();
            $table->decimal('govt_duty', 8, 2)->nullable();
            $table->decimal('govt_duty_charge', 8, 2)->nullable();
            $table->decimal('fixed_charge', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('light_bills');
    }
}
