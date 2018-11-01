<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePbxSchemeNodeRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbx_scheme_node_relations', function (Blueprint $table) {

            $table->increments('id')->primary();
            $table->string('type', 255);
            $table->uuid('from_node_id');
            $table->uuid('to_node_id');
            $table->uuid('pbx_scheme_id');
            $table->timestamps();
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
        Schema::drop('pbx_scheme_node_relations');
    }
}
