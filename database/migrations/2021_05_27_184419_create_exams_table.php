<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->tinyInteger('term',false,false);
            $table->tinyInteger('active',false,false)->default(0);
            $table->tinyInteger('number_questions',false,false);
            $table->tinyInteger('duration',false,false);
            $table->string('token',100)->unique();
            $table->timestamps();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
