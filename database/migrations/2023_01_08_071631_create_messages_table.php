<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            //insert the lines below
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            // $table->integer('sender_id')->unsigned();
            // $table->integer('recipient_id')->unsigned();

            $table->unsignedBigInteger('model_sender_id');
            $table->foreign('model_sender_id')->references('id')->on('models');

            $table->unsignedBigInteger('model_recipient_id');
            $table->foreign('model_recipient_id')->references('id')->on('models');

            $table->text('message');
            $table->timestamps();
            $table->timestamp('read_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
