<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('education')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('village')->nullable();
            $table->string('gender', 6)->nullable();
            $table->string('identification_number', 20)->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('life_status')->nullable();
            $table->string('marital_status')->nullable();
            $table->unsignedInteger('father_id')->nullable();
            $table->unsignedInteger('mother_id')->nullable();
            $table->tinyInteger('child_number', false, true)->nullable();
            $table->date('dead_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
