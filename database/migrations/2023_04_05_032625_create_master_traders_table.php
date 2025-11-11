<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_traders', function (Blueprint $table) {
            $table->id();
            $table->string('master_id')->unique();
            $table->string('username')->unique()->nullable();
            $table->string('fname');
            $table->string('lname');
            $table->string('photo')->default('master_default_photo.png');
            $table->longText('description')->nullable();
            $table->string('minimum_investment')->nullable();
            $table->string('risk_score')->nullable();
            $table->string('expertise')->nullable();
            $table->string('commission')->default(0.00);
            $table->string('capital')->default(0.00);
            $table->string('balance')->default(0.00);
            $table->string('bonus')->default(0.00);
            $table->string('profit')->default(0.00);
            $table->string('loss')->default(0.00);
            $table->string('master_trader_bonus')->default(0.00);
            $table->string('leverage')->nullable();
            $table->string('equity')->default(0.00);
            $table->string('max_unrealised_loss')->default(0.00);
            $table->string('max_drawndown_duration')->default(0);
            $table->string('status')->default(0);
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
        Schema::dropIfExists('master_traders');
    }
}
