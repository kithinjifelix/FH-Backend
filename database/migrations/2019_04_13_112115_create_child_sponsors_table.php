<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_sponsors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('childId');
            $table->integer('sponsorId');
            $table->boolean('deleteFlag');
            $table->timestamps();

            $table->foreign('childId')->references('id')->on('children');
            $table->foreign('sponsorId')->references('id')->on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_sponsors');
    }
}
