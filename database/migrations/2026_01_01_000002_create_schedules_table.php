<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** - Portuguese
 * Migration: Tabela de agendas (schedules)
 *
 * Representa um serviço/profissional que pode ter horários disponíveis.
 * Ex: "Dr. João - Consulta Médica", "Studio XYZ - Corte de Cabelo".
 */

/** - English
 * Migration: Schedules table
 *
 * Represents a service/professional that can have available time slots.
 * Example: "Dr. John - Medical Consultation", "Studio XYZ - Haircut".
 */
return new class extends Migration
{
  public function up(): void
  {
    Schema::create('schedules', function (Blueprint $table) {
      $table->uuid('id')->primary();

      // Owner/responsible for the schedule (FK -> users)
      $table->uuid('user_id');
      $table->foreign('user_id')->references('id')->on('users');

      // Descriptive name of the schedule
      $table->string('name');

      // Optional service description
      $table->text('description')->nullable();

      // Default duration of each slot in minutes (e.g., 30, 60)
      $table->unsignedSmallInteger('slot_duration_minutes')->default(60);

      // Price charged per booking (in cents to avoid float issues)
      $table->unsignedInteger('price_cents')->default(0);

      // Whether the schedule is active to receive bookings
      $table->boolean('is_active')->default(true);

      // Logical soft delete: true = inactive/deleted record
      $table->boolean('is_deleted')->default(false);

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('schedules');
  }
};
