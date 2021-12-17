<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DbSyncTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_sync_table', function (Blueprint $table) {
            $table->integerIncrements('db_sync_table_id');
            $table->string('name');
        });

        $tables = DB::table('db_sync')->select('table')->groupBy('table')->get();
        $ids = [];
        foreach ($tables as $table){
            $ids[$table->table] = DB::table('db_sync_table')->insertGetId([
                'name' => $table->table
            ]);
        }

        foreach ($ids as $key => $id){
            DB::table('db_sync')
                ->where('table', '=', $key)
                ->update(['table' => $id]);
        }

        Schema::table('db_sync', function (Blueprint $table){
            $table->unsignedInteger('table')->change();
            $table->renameColumn('table', 'db_sync_table_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('db_sync', function (Blueprint $table){
            $table->string('db_sync_table_id')->change();
            $table->renameColumn('db_sync_table_id', 'table');
        });

        $tables = DB::table('db_sync_table')->get();
        $ids = [];
        foreach ($tables as $table){
            $ids[$table->db_sync_table_id] = $table->name;
        }

        foreach ($ids as $key => $id){
            DB::table('db_sync')
                ->where('table', '=', $key)
                ->update(['table' => $id]);
        }
        Schema::dropIfExists('db_sync_table');
    }
}
