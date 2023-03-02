<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->integer('start_year');
            $table->integer('end_year');
            $table->string('component');
            $table->string('description');
            $table->string('docs_url');
            $table->string('data_url');
            $table->boolean('downloaded')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('datasets');
    }
};
