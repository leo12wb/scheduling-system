<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** - Portuguese
 * Migration: Tabela de usuários do sistema
 *
 * Armazena os dados de autenticação e perfil dos usuários.
 * Inclui campos para nome, email, senha, papel (admin ou cliente), telefone e controle de soft-delete.
 */

/** - English
 * Migration: System users table
 *
 * Stores authentication and user profile data.
 * Includes fields for name, email, password, role (admin or customer), phone, and soft-delete control.
 */
return new class extends Migration
{
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      // Chave primária UUID
      $table->uuid('id')->primary();

      // Dados básicos do usuário
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');

      // Papel do usuário no sistema: admin | customer
      $table->enum('role', ['admin', 'customer'])->default('customer');

      // Telefone opcional para contato
      $table->string('phone', 20)->nullable();

      // Token para lembrar sessão
      $table->rememberToken();

      // Soft-delete lógico: true = registro inativo/deletado
      $table->boolean('is_deleted')->default(false);

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
