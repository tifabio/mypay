<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->float('value', 10, 2);
            $table->timestamps();

            $table->foreignId('payer_id')->constrained('users', 'id');
            $table->foreignId('payee_id')->constrained('users', 'id');
            $table->foreignId('transfer_status_id')->constrained('transfer_status', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
