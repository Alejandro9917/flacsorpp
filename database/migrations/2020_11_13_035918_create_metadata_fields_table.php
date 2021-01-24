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
            $table->string('container_class')->nullable();
            $table->string('id_element')->nullable();
            $table->string('class')->nullable();
            $table->string('validation_rule')->nullable();
            $table->string('default_value')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('json_config',2048);
            $table->integer('priority')->nullable();
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
