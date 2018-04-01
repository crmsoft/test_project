<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->unsignedInteger('user_id');

            $table->string('email')
                ->nullable();
            $table->string('logo')
                ->nullable();
            $table->string('phone')
                ->nullable();
            $table->string('fax')
                ->nullable();
            $table->string('address')
                ->nullable();
            $table->string('website')
                ->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDeletes('cascade');

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
        Schema::dropIfExists('companies');
    }
}
