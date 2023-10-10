<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // 主キーや一般的なカラム
            $table->id();
            $table->string('name');

            // アカウント関連のカラム
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // ユーザの詳細や設定に関するカラム
            $table->string('skyway_id')->unique();
            $table->tinyInteger('role')->unsigned(); // Role
            $table->string('qualification')->nullable(); // 超音波専門医か超音波検査士
            $table->integer('qualification_year')->nullable(); // 資格の取得年度
            $table->string('region')->nullable(); // 地域
            $table->json('areas')->nullable(); // 対応可能領域
            $table->boolean('status')->default(true); // ステータス

            // システムやメタデータ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
