<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            $table->string('titre')->unique();
            $table->string('description');
            $table->string('features');
            $table->decimal('prix_mensuel', 10, 2);
            $table->decimal('prix_trimestriel', 10, 2);
            $table->decimal('prix_semestriel', 10, 2);
            $table->decimal('prix_annuel', 10, 2);

            $table->boolean('statut')->default(false);


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
        Schema::dropIfExists('plans');
    }
}
