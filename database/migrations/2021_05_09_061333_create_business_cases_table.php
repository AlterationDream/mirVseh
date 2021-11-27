<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_cases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('slug');
            $table->foreignId('dialog_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->boolean('isArchived');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('business_cases');
    }
}
