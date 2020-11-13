<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadataFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadata_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->boolean('is_required');
            $table->string('validation_rule');
            $table->string('default_value');
            $table->string('placeholder');
            $table->string('json_config');
            $table->integer('priority');
            $table->foreignId('field_type_id')->constrained();
            $table->foreignId('meta_data_form_id')->constrained();
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
        Schema::dropIfExists('metadata_fields');
    }
}
