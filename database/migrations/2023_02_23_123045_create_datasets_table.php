<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->string('years');
            $table->string('component');
            $table->string('description');
            $table->string('docs_url');
            $table->string('data_url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('datasets');
    }
};
