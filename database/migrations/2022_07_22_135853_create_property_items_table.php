<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_type_id')->nullable()->constrained();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('measurement_unit')->nullable();
            $table->double('unit_price')->default(0);
            $table->text('description')->nullable();
            $table->string('location')->nullable();

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
        Schema::dropIfExists('property_items');
    }
}
