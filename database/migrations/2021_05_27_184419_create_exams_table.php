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
            $table->timestamp('date');
            $table->tinyInteger('term',false,true);
            $table->tinyInteger('active',false,true)->default(0);
            $table->tinyInteger('number_questions',false,true);
            $table->tinyInteger('duration',false,true);
            $table->string('token',100)->unique();
            $table->timestamps();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade')->onUpdate('cascade');
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
