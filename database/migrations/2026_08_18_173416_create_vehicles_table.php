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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('vehicle_categories')->restrictOnDelete();
            $table->string('brand');
            $table->string('model');
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('license_plate')->unique();
            $table->string('vin')->unique()->nullable();
            $table->string('color')->nullable();
            $table->enum('transmission', ['manual','automatic'])->default('automatic');
            $table->enum('fuel_type', ['petrol','diesel','hybrid','electric','lpg'])->default('petrol');
            $table->unsignedTinyInteger('seats')->default(5);
            $table->unsignedInteger('mileage')->default(0);
            $table->decimal('daily_rate', 10, 2)->default(0);
            $table->enum('status', ['available','reserved','rented','maintenance','inactive'])->default('available')->index();
            $table->date('registration_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
