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
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['stagiaire','responsable','admin'])->default('stagiaire')->after('password');
            $table->string('formation')->nullable()->after('role');
            $table->string('poste')->nullable()->after('role');
            $table->string('specialite')->nullable()->after('poste');
            $table->string('niveau_etude')->nullable()->after('formation');
            $table->string('telephone')->nullable()->after('niveau_etude');
            $table->string('adresse')->nullable()->after('telephone');
            $table->boolean('is_active')->default(true)->after('adresse'); // bloquer/supprimer logiquement un compte
            $table->timestamp('last_login_at')->nullable()->after('is_active'); // utile pour la sécurité / audits
            $table->softDeletes(); // permet la récupération si suppression non souhaitée
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
