<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expropriation_id')->constrained();
            $table->foreignId('citizen_id')->constrained('users');
            $table->string('title');
            $table->string('description');
            $table->string('status')->default('Pending');
            $table->string('attachment')->nullable();
            $table->string('priority')->default('low');
            $table->foreignId('assignee')->nullable()->constrained('users');
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
        Schema::dropIfExists('claims');
    }
}
