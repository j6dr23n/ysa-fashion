<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserInfoInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ph_number')->nullable()->after('password');
            $table->string('address')->nullable()->after('ph_number');
            $table->date('birthday')->nullable()->after('address');
            $table->string('gender')->nullable()->after('birthday');
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
            $table->dropColumn('ph_number');
            $table->dropColumn('address');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
        });
    }
}
