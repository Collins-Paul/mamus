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
            $table->foreignId('who')->constrained('master_traders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('currency_pair')->nullable();
            $table->string('order_type')->nullable();
            $table->string('lot_size')->nullable();
            $table->string('profit_or_loss')->default(0.00);
            $table->string('open_price')->nullable();
            $table->string('current_price')->nullable();
            $table->string('close_price')->nullable();
            $table->string('order_id');

            $table->string('robot_id')->nullable();
            $table->string('market')->nullable();
            $table->string('method')->default('manual');
            $table->string('amount')->default(0.00);

            $table->string('commission_paid')->nullable();
            $table->string('status')->default('opened');
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
