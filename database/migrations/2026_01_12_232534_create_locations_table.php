<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Migura Wash Pekanbaru Pusat
            $table->string('code')->unique(); // MIG-PKU-01
            $table->text('address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            
            // Operating details
            $table->time('open_time')->default('08:00:00');
            $table->time('close_time')->default('20:00:00');
            $table->json('operating_days')->nullable(); // ['monday', 'tuesday', ...]
            
            // Service area
            $table->decimal('max_service_radius_km', 5, 2)->default(10.00);
            
            // Capacity
            $table->integer('daily_capacity')->default(50); // Max bookings per day
            $table->integer('slot_capacity')->default(5); // Max bookings per time slot
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_main_branch')->default(false); // Flag for main branch
            $table->integer('sort_order')->default(0);
            
            // Additional info
            $table->text('description')->nullable();
            $table->json('facilities')->nullable(); // ['parking', 'wifi', 'waiting_room']
            $table->json('photos')->nullable(); // Array of photo URLs
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('code');
            $table->index('is_active');
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
