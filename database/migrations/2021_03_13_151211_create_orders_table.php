<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('charge_id')->unique();
            $table->enum('status',['pending','paid','refused'])->default('pending');
            $table->boolean('return_quantity')->default(0)->comment("because fix if usesr doing payment same time conflict");
            $table->string('payment_gateway');
            $table->string('payment_method');
            $table->double('amount',10,2)->unsigned();
            $table->text('note')->nullable();
            $table->text('refused_reason')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
