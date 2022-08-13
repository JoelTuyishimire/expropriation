<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpropriationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expropriations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('users');
            $table->foreignId('done_by')->constrained('users');
            $table->foreignId('property_type_id')->constrained('property_types');
            $table->double('amount')->default(0);
            $table->string('description')->nullable();
            $table->foreignId('province_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->foreignId('sector_id')->nullable()->constrained();
            $table->foreignId('cell_id')->nullable()->constrained();
            $table->string('status')->default('Pending');
            $table->string('review_decision')->nullable();
            $table->string('last_return')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('rejected_by')->nullable()->constrained('users');
            $table->date('approval_date')->nullable();
            $table->date('rejection_date')->nullable();
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
        Schema::dropIfExists('expropriations');
    }
}
