<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedInteger('company_id');

            $table->string('email')
                ->nullable();
            $table->string('phone')
                ->nullable();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
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
        Schema::dropIfExists('employees');
    }
}
