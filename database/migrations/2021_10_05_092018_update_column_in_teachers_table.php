<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnInTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->string('google_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('slack_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('google_link');
            $table->dropColumn('facebook_link');
            $table->dropColumn('slack_link');
        });
    }
}
