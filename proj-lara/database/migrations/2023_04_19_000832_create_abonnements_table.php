<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();

            $table->decimal('prix', 10, 2);
            $table->string('type');
            $table->date('debut');
            $table->date('expiration');

            $table->boolean('statut')->default(false);
            $table->boolean('pay_statut')->default(false);

            $table->foreignId('client_id')->nullable($value = true)->constrained()->change()->onDelete('set null')->cascadeOnUpdate();
            $table->foreignId('plan_id')->nullable($value = true)->constrained()->change()->onDelete('set null')->cascadeOnUpdate();

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
        Schema::dropIfExists('abonnements');
    }
}
