<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateServerItemsTable
 */
class CreateServerItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('server_items', function (Blueprint $table) {
            $table->id();
            $table->string('provider');
            $table->string('brand');
            $table->string('location');
            $table->string('cpu');
            $table->string('drive');
            $table->double('price');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('server_items');
    }
}
