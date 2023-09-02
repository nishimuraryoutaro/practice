<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);//BigInterger桁数の大きい,unsined -+がない
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->softdeletes();//論理削除delete_atを自動生成
            //データベースにupdate_at,create_atされた時間//更新時に値が入るようにDB::rawで直接
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users');//外部キー制約(user_idはusersテーブに存在するidでなくてはならない)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
};
