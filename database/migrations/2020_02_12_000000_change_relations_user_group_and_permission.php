<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRelationsUserGroupAndPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->dropForeign('user_permissions_user_group_id_foreign');
            $table->dropColumn('user_group_id');
        });

        Schema::create('user_groups_to_permissions', function (Blueprint $table) {
            $table->unsignedInteger('user_group_id');
            $table->unsignedInteger('user_permission_id');
            $table->foreign('user_group_id')
                ->references('user_group_id')
                ->on('user_groups');
            $table->foreign('user_permission_id')
                ->references('user_permission_id')
                ->on('user_permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->unsignedInteger('user_group_id');
            $table->foreign('user_group_id')
                ->references('user_group_id')
                ->on('user_groups');
        });
        Schema::dropIfExists('user_groups_to_permissions');
    }
}
