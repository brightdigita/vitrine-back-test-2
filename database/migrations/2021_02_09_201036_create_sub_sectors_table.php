<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sectors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug")->unique();
            $table->foreignId("sector_id")->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sub_sector_translations', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId("sub_sector_id")->constrained();
            $table->string("language")->nullable();
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
        Schema::dropIfExists('sub_sectors');
    }
}
