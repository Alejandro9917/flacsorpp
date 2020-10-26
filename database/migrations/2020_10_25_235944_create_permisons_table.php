<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisons', function (Blueprint $table) {
            $table->id();
            $table->boolean('can_create');
            $table->boolean('can_read');
            $table->boolean('can update');
            $table->boolean('can_delete');
            $table->boolean('can_upload');
            $table->boolean('can_download');
            $table->foreignId('role_id')->constrained();
            $table->foreignId('module_id')->constrained();

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
        Schema::dropIfExists('permisons');
    }
}
