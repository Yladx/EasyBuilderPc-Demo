<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create Motherboards table
        Schema::create('motherboards', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name');
            $table->string('socket', 50);      // Socket type (e.g., LGA1200)
            $table->string('form_factor', 20); // Form factor (e.g., ATX, mATX)
            $table->integer('max_memory');     // Max memory (GB)
            $table->integer('memory_slots');   // Number of memory slots
            $table->string('storage_interface', 50); // Interface for storage (e.g., SATA, PCIe)
            $table->integer('sata_connectors'); // Number of SATA connectors for storage
            $table->integer('pcie_slots');      // Number of PCIe slots
            $table->string('ram_generation', 20); // RAM generation (e.g., DDR4)
            $table->string('color', 50)->nullable();
            $table->string('image')->nullable();
            $table->integer('tdp')->nullable(); // TDP for the motherboard
            $table->timestamps();
        });

        // Create CPUs table
        Schema::create('cpus', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name');
            $table->string('socket', 50);      // Socket type
            $table->integer('core_count');      // Core count
            $table->decimal('core_clock', 4, 2); // Core clock (GHz)
            $table->decimal('boost_clock', 4, 2)->nullable(); // Boost clock (GHz)
            $table->integer('tdp');             // TDP (W)
            $table->string('graphics', 50)->nullable(); // Integrated graphics
            $table->boolean('smt')->nullable();         // SMT support
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Create RAMs table
        Schema::create('rams', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name');
            $table->integer('speed_ddr_version'); // DDR version (e.g., DDR4, DDR5)
            $table->integer('speed_mhz');        // RAM speed (MHz)
            $table->integer('modules');          // Number of modules
            $table->integer('module_size');      // Size of each module (GB)
            $table->string('ram_generation', 20); // Match with motherboard
            $table->string('color', 50)->nullable();
            $table->decimal('first_word_latency', 5, 2)->nullable(); // First Word Latency (ns)
            $table->decimal('cas_latency', 5, 2)->nullable();        // CAS Latency
            $table->integer('tdp')->nullable(); // TDP for RAM
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Create GPUs table
        Schema::create('gpus', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name');
            $table->string('chipset', 50);      // Chipset
            $table->integer('memory');          // Memory (GB)
            $table->decimal('core_clock', 5, 2); // Core clock (MHz)
            $table->decimal('boost_clock', 5, 2)->nullable(); // Boost clock (MHz)
            $table->integer('pcie_slots_required'); // Number of PCIe slots required by GPU
            $table->string('color', 50)->nullable();
            $table->integer('length')->nullable(); // Length (mm)
            $table->integer('tdp');               // TDP for the GPU
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Create Storages table
        Schema::create('storages', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name');
            $table->string('storage_type');     // Storage type (e.g., SSD, HDD)
            $table->integer('capacity');        // Capacity (GB)
            $table->string('drive_type', 50)->nullable();   // SSD or RPM of HDD
            $table->integer('cache')->nullable();           // Cache (MB)
            $table->string('form_factor', 50)->nullable();  // M.2 or HDD size (inches)
            $table->string('interface', 50)->nullable();    // PCIe/SATA interface
            $table->integer('tdp')->nullable(); // TDP for storage
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Create PowerSupplies table
        Schema::create('power_supplies', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name');
            $table->string('type', 20);       // ATX/SFX/etc.
            $table->string('efficiency', 20)->nullable();  // Efficiency rating
            $table->integer('wattage');       // Wattage (W)
            $table->string('modular', 10)->nullable();    // Full/Semi/false modularity
            $table->string('color', 50)->nullable();
            $table->integer('max_tdp')->nullable(); // Maximum TDP supported by the PSU
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Create Cases table
        Schema::create('computer_cases', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name');
            $table->string('form_factor', 20); // Form factor to match with motherboard
            $table->string('color', 50)->nullable();
            $table->integer('psu_wattage')->nullable();  // Wattage of included power supply (W)
            $table->string('side_panel_material', 50)->nullable(); // Side panel material
            $table->decimal('external_volume', 5, 2)->nullable(); // External volume (L)
            $table->integer('internal_35_bays')->nullable();       // Number of internal 3.5" bays
            $table->integer('gpu_length_limit')->nullable(); // Limit for GPU length
            $table->string('psu_form_factor', 20)->nullable(); // PSU form factor to match
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Create builds table
        Schema::create('builds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Allow null for admin
            $table->string('build_name');
            $table->text('build_note')->nullable();
            $table->string('tag');
            $table->unsignedBigInteger('cpu_id');
            $table->unsignedBigInteger('gpu_id');
            $table->unsignedBigInteger('motherboard_id');
            $table->unsignedBigInteger('ram_id');
            $table->unsignedBigInteger('storage_id');
            $table->unsignedBigInteger('power_supply_id');
            $table->unsignedBigInteger('case_id');
            $table->text('accessories')->nullable();
            $table->string('image')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('cpu_id')->references('id')->on('cpus')->onDelete('cascade');
            $table->foreign('gpu_id')->references('id')->on('gpus')->onDelete('cascade');
            $table->foreign('motherboard_id')->references('id')->on('motherboards')->onDelete('cascade');
            $table->foreign('ram_id')->references('id')->on('rams')->onDelete('cascade');
            $table->foreign('storage_id')->references('id')->on('storages')->onDelete('cascade');
            $table->foreign('power_supply_id')->references('id')->on('power_supplies')->onDelete('cascade');
            $table->foreign('case_id')->references('id')->on('computer_cases')->onDelete('cascade');
        });

        // Create rate table
        Schema::create('rate', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY column named 'id'
            $table->foreignId('build_id')->constrained('builds')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating')->check('rating >= 1 AND rating <= 5'); // Rating check constraint
            $table->timestamp('rated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate');
        Schema::dropIfExists('builds');
        Schema::dropIfExists('motherboards');
        Schema::dropIfExists('cpus');
        Schema::dropIfExists('rams');
        Schema::dropIfExists('gpus');
        Schema::dropIfExists('storages');
        Schema::dropIfExists('power_supplies');
        Schema::dropIfExists('computer_cases');
    }
};
