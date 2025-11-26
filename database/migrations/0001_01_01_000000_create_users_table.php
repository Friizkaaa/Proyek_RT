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
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('kode_warga')->unique();
            $table->string('nama_lengkap')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->date('tanggal_lahir');
            $table->string('nik', 16);
            $table->string('no_hp', 13);
            $table->enum('role', ['Warga', 'Admin'])->default('Warga');
            $table->enum('status_keluarga', ['kepala_keluarga','anggota_keluarga','lajang','janda/duda']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
