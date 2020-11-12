<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_versions', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('version_number');
            $table->string('description');
            $table->string('json_changes');
            $table->boolean('status');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('collection_id')->constrained();
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
        Schema::dropIfExists('collection_versions');
    }
}
