<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyItemHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_item_histories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->foreignId('property_type_id')->nullable()->constrained();
            $table->foreignId('property_item_id')->nullable()->constrained();
            $table->string('measurement_unit')->nullable();
            $table->double('unit_price')->default(0);
            $table->string('location')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('property_item_histories');
    }
}
