<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->unsignedBigInteger('kasir_id')->nullable()->after('id');

        $table->foreign('kasir_id')
            ->references('id')->on('users')
            ->onDelete('set null');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropForeign(['kasir_id']);
        $table->dropColumn('kasir_id');
    });
}

};
