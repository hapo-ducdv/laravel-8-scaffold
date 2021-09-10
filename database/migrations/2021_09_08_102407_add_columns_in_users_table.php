<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('fullname', 50)->nullable();
            $table->date('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('intro')->nullable();
            $table->string('role')->default(0);
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('fullname');
            $table->dropColumn('birthday');
            $table->dropColumn('avatar');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('intro');
            $table->dropColumn('role');
            $table->dropSoftDeletes();
        });
    }
}
