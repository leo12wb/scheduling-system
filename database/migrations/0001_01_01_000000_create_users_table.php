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
      $table->uuid('id')->primary();

      // Basic user information
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');

      // User role in the system: admin | customer
      $table->enum('role', ['admin', 'customer'])->default('customer');

      // Optional phone number for contact
      $table->string('phone', 20)->nullable();

      // Token used to remember user sessions
      $table->rememberToken();

      // Logical soft delete flag: true = inactive/deleted record
      $table->boolean('is_deleted')->default(false);

      // Created_at and updated_at timestamps
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
