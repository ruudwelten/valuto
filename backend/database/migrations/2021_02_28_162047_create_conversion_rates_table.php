<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversion_rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency_from', 10);
            $table->string('currency_to', 10);
            $table->decimal('rate', 18, 8);
            $table->date('date');
            $table->timestamps();

            $table->index(['currency', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversion_rates');
    }
}
