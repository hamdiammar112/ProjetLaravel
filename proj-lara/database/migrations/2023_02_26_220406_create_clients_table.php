<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->date('birthdate');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('cin');

            // $table->unsignedBigInteger('coach_id');
            // $table->foreign('coach_id')->references('id')->on('coaches');

            $table->foreignId('coach_id')->nullable($value = true)->constrained()->change()->onDelete('set null')->cascadeOnUpdate();



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
        Schema::dropIfExists('clients');
    }
}
