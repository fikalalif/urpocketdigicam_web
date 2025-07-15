<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIsActiveToIsVisibleInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('isActive', 'is_visible');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('is_visible', 'isActive');
        });
    }
}
