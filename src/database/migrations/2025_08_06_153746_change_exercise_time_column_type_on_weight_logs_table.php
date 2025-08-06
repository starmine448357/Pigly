<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExerciseTimeColumnTypeOnWeightLogsTable extends Migration
{
    public function up()
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->string('exercise_time', 5)->change();
        });
    }

    public function down()
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->time('exercise_time')->change();
        });
    }
}
