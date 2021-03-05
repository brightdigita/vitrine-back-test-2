<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string("name");
            $table->foreignId("user_id")->nullable()->constrained();
            $table->foreignId("sub_sector_id")->nullable()->constrained();
            $table->longText("about")->nullable();
            $table->longText("poster")->nullable();
            $table->longText("backdrop")->nullable();
            $table->string("email")->nullable();
            $table->string("slug")->unique();
            $table->string("phone")->nullable();
            $table->string("phone2")->nullable();
            $table->foreignId("city_id")->constrained();
            $table->string("website")->nullable();
            $table->string("facebook_url")->nullable();
            $table->string("twitter_url")->nullable();
            $table->string("instagram_url")->nullable();
            $table->string("youtube_url")->nullable();
            $table->string("linkedin_url")->nullable();
            $table->string("zip_code")->nullable();
            $table->string("lat")->nullable();
            $table->string("lng")->nullable();
            $table->string("town")->nullable();
            $table->string("landmark")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp("banned_at")->nullable();
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
