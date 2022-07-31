<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpropriationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expropriation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expropriation_id')->constrained('expropriations');
            $table->foreignId('property_type_id')->constrained();
            $table->foreignId('property_item_id')->constrained();
            $table->double('quantity')->default(0);
            $table->double('unit_price')->default(0);

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
        Schema::dropIfExists('expropriation_details');
    }
}
