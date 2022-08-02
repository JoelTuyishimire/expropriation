<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpropriationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expropriation_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expropriation_id')->constrained('expropriations');
            $table->foreignId('user_id')->constrained('users');
            $table->string('status');
            $table->text('comment')->nullable();
            $table->text('external_comment')->nullable();
            $table->boolean('is_comment')->default(false);
            $table->string('attachments')->nullable();
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
        Schema::dropIfExists('expropriation_histories');
    }
}
