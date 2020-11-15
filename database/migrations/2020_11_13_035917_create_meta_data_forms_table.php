<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaDataFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_data_forms', function (Blueprint $table) {
            $table->id();
            $table->string('form_name');
            $table->string('header');
            $table->string('priority');
            $table->string('class_container');
            $table->boolean('is_accordion');
            $table->boolean('is_collapsed');
            $table->string('extra_js');
            $table->string('extra_css');
            $table->boolean('is_required');
            $table->foreignId('collection_type_id')->constrained();
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
        Schema::dropIfExists('meta_data_forms');
    }
}
