<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('copier_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('master_id');
            $table->string('master_name');
            $table->string('order_id');
            $table->string('total_amount');
            $table->string('copy_proportion');
            $table->string('order_type');
            $table->string('commission_copy_trade');
            $table->string('currency_pair');
            $table->string('lot_size');
            $table->string('profit_or_loss');
            $table->string('open_price');
            $table->string('current_pice')->nullable();
            $table->string('close_price')->nullable();
            $table->string('market')->nullable();
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
        Schema::dropIfExists('copiers');
    }
}
