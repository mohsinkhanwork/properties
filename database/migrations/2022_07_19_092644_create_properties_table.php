<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('featured_property');
            $table->string('property_name');
            $table->string('property_slug');
            $table->string('property_type');
            $table->string('property_purpose');
            $table->string('price');
            $table->string('address');
            $table->string('map_latitude');
            $table->string('map_longitude');
            $table->string('bathrooms');
            $table->string('bedrooms');
            $table->string('garage');
            $table->string('land_area');
            $table->string('build_area');
            $table->longText('description');
            $table->string('nearest_school_km');
            $table->string('nearest_hospital_km');
            $table->string('nearest_bus_stand_km');
            $table->string('nearest_railway_km');
            $table->string('nearest_airport_km');
            $table->string('nearest_mall_km');
            $table->string('property_features');
            $table->string('featured_image');
            $table->string('floor_plan');
            $table->text('video_code');
            $table->integer('active_plan_id');
            $table->integer('property_exp_date');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
