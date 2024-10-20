<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash for password hashing
use Illuminate\Support\Facades\DB;

use App\Models\Admin; // Ensure you import the Admin model
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create a single admin user with a hashed password
        Admin::create([
            'username' => 'admin', // Set the username
            'password' => Hash::make('11111'), // Hash the password
        ]);

        DB::table('builds')->insert([
            ['id' => 2, 'user_id' => 1, 'build_name' => 'Workstation Builda', 'build_note' => 'A build for video editing and rendering.', 'tag' => 'Office', 'cpu_id' => 2, 'gpu_id' => 2, 'motherboard_id' => 2, 'ram_id' => 2, 'storage_id' => 2, 'power_supply_id' => 2, 'case_id' => 1, 'accessories' => 'Additional Cooling', 'image' => NULL, 'published' => 0, 'created_at' => '2024-10-20 08:00:55', 'updated_at' => NULL],
            ['id' => 4, 'user_id' => NULL, 'build_name' => 'High-End Build', 'build_note' => 'Top-notch components for the best performance.', 'tag' => 'High-End', 'cpu_id' => 4, 'gpu_id' => 4, 'motherboard_id' => 4, 'ram_id' => 4, 'storage_id' => 4, 'power_supply_id' => 4, 'case_id' => 4, 'accessories' => 'Water Cooling', 'image' => NULL, 'published' => 1, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'user_id' => NULL, 'build_name' => 'HTPC Build', 'build_note' => 'A build for home theater purposes.', 'tag' => 'HTPC', 'cpu_id' => 5, 'gpu_id' => 5, 'motherboard_id' => 5, 'ram_id' => 5, 'storage_id' => 5, 'power_supply_id' => 5, 'case_id' => 5, 'accessories' => 'Remote Control', 'image' => NULL, 'published' => 0, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'user_id' => NULL, 'build_name' => 'Mini-ITX Build', 'build_note' => 'A compact and powerful build.', 'tag' => 'Mini-ITX', 'cpu_id' => 6, 'gpu_id' => 6, 'motherboard_id' => 6, 'ram_id' => 6, 'storage_id' => 6, 'power_supply_id' => 6, 'case_id' => 6, 'accessories' => 'Extra Storage', 'image' => NULL, 'published' => 1, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'user_id' => NULL, 'build_name' => 'All-Rounder Build', 'build_note' => 'A versatile build for all tasks.', 'tag' => 'All-Rounder', 'cpu_id' => 7, 'gpu_id' => 7, 'motherboard_id' => 7, 'ram_id' => 7, 'storage_id' => 7, 'power_supply_id' => 7, 'case_id' => 7, 'accessories' => 'Standard Accessories', 'image' => NULL, 'published' => 0, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 14, 'user_id' => NULL, 'build_name' => 'asd', 'build_note' => NULL, 'tag' => 'Tag1', 'cpu_id' => 2, 'gpu_id' => 7, 'motherboard_id' => 9, 'ram_id' => 2, 'storage_id' => 4, 'power_supply_id' => 7, 'case_id' => 7, 'accessories' => 'sad', 'image' => NULL, 'published' => 0, 'created_at' => '2024-10-20 01:03:55', 'updated_at' => '2024-10-20 01:03:55'],
            ['id' => 15, 'user_id' => NULL, 'build_name' => 'asd', 'build_note' => NULL, 'tag' => 'Tag1, Tag2', 'cpu_id' => 2, 'gpu_id' => 4, 'motherboard_id' => 8, 'ram_id' => 7, 'storage_id' => 2, 'power_supply_id' => 8, 'case_id' => 9, 'accessories' => 'sad', 'image' => NULL, 'published' => 0, 'created_at' => '2024-10-20 01:04:22', 'updated_at' => '2024-10-20 01:04:22'],
        ]);

        DB::table('computer_cases')->insert([
            ['id' => 1, 'name' => 'NZXT H510', 'form_factor' => 'ATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Tempered Glass', 'external_volume' => 42.00, 'internal_35_bays' => 2, 'gpu_length_limit' => 350, 'psu_form_factor' => 'ATX', 'image' => 'imageA.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'name' => 'Fractal Design Meshify C', 'form_factor' => 'ATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Tempered Glass', 'external_volume' => 44.00, 'internal_35_bays' => 2, 'gpu_length_limit' => 360, 'psu_form_factor' => 'ATX', 'image' => 'imageB.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'Cooler Master MasterBox Q300L', 'form_factor' => 'mATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Steel', 'external_volume' => 35.00, 'internal_35_bays' => 1, 'gpu_length_limit' => 340, 'psu_form_factor' => 'mATX', 'image' => 'imageC.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'Phanteks Eclipse P400A', 'form_factor' => 'ATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Tempered Glass', 'external_volume' => 50.00, 'internal_35_bays' => 2, 'gpu_length_limit' => 400, 'psu_form_factor' => 'ATX', 'image' => 'imageD.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'Corsair 275R Airflow', 'form_factor' => 'ATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Tempered Glass', 'external_volume' => 48.00, 'internal_35_bays' => 2, 'gpu_length_limit' => 360, 'psu_form_factor' => 'ATX', 'image' => 'imageE.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'name' => 'Lian Li PC-O11 Dynamic', 'form_factor' => 'ATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Tempered Glass', 'external_volume' => 69.00, 'internal_35_bays' => 3, 'gpu_length_limit' => 420, 'psu_form_factor' => 'ATX', 'image' => 'imageF.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'name' => 'Thermaltake Versa H15', 'form_factor' => 'mATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Steel', 'external_volume' => 32.00, 'internal_35_bays' => 1, 'gpu_length_limit' => 320, 'psu_form_factor' => 'mATX', 'image' => 'imageG.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'name' => 'SilverStone Raven RVZ02', 'form_factor' => 'mATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Steel', 'external_volume' => 32.00, 'internal_35_bays' => 1, 'gpu_length_limit' => 340, 'psu_form_factor' => 'mATX', 'image' => 'imageH.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'name' => 'be quiet! Pure Base 500DX', 'form_factor' => 'ATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Tempered Glass', 'external_volume' => 42.00, 'internal_35_bays' => 2, 'gpu_length_limit' => 350, 'psu_form_factor' => 'ATX', 'image' => 'imageI.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'name' => 'Cooler Master HAF 912', 'form_factor' => 'ATX', 'color' => 'Black', 'psu_wattage' => 0, 'side_panel_material' => 'Steel', 'external_volume' => 45.00, 'internal_35_bays' => 2, 'gpu_length_limit' => 350, 'psu_form_factor' => 'ATX', 'image' => 'imageJ.jpg', 'created_at' => NULL, 'updated_at' => NULL],
        ]);
        DB::table('gpus')->insert([
            ['id' => 1, 'name' => 'NVIDIA GeForce GTX 1660', 'architecture' => 'Turing', 'memory' => 6, 'price' => 299.99, 'base_price' => 299.99, 'cooling_solution' => 1, 'color' => 'Black', 'length' => 232, 'tdp' => 120, 'image' => 'imageA.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'name' => 'AMD Radeon RX 5700 XT', 'architecture' => 'RDNA', 'memory' => 8, 'price' => 399.99, 'base_price' => 399.99, 'cooling_solution' => 2, 'color' => 'Black', 'length' => 304, 'tdp' => 225, 'image' => 'imageB.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'NVIDIA GeForce RTX 3090', 'architecture' => 'Ampere', 'memory' => 24, 'price' => 1499.99, 'base_price' => 1499.99, 'cooling_solution' => 2, 'color' => 'Black', 'length' => 336, 'tdp' => 350, 'image' => 'imageC.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'AMD Radeon RX 6800 XT', 'architecture' => 'RDNA 2', 'memory' => 16, 'price' => 999.99, 'base_price' => 999.99, 'cooling_solution' => 2, 'color' => 'Black', 'length' => 304, 'tdp' => 300, 'image' => 'imageD.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'NVIDIA GeForce RTX 3060 Ti', 'architecture' => 'Ampere', 'memory' => 8, 'price' => 399.99, 'base_price' => 399.99, 'cooling_solution' => 1, 'color' => 'Black', 'length' => 242, 'tdp' => 200, 'image' => 'imageE.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'name' => 'AMD Radeon RX 5700', 'architecture' => 'RDNA', 'memory' => 8, 'price' => 349.99, 'base_price' => 349.99, 'cooling_solution' => 1, 'color' => 'Black', 'length' => 300, 'tdp' => 180, 'image' => 'imageF.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'name' => 'NVIDIA GeForce RTX 3080', 'architecture' => 'Ampere', 'memory' => 10, 'price' => 999.99, 'base_price' => 999.99, 'cooling_solution' => 2, 'color' => 'Black', 'length' => 300, 'tdp' => 320, 'image' => 'imageG.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'name' => 'AMD Radeon RX 6800', 'architecture' => 'RDNA 2', 'memory' => 16, 'price' => 999.99, 'base_price' => 999.99, 'cooling_solution' => 2, 'color' => 'Black/Red', 'length' => 267, 'tdp' => 250, 'image' => 'imageH.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'name' => 'NVIDIA GeForce GTX 1650', 'architecture' => 'Turing', 'memory' => 4, 'price' => 299.99, 'base_price' => 299.99, 'cooling_solution' => 1, 'color' => 'Black', 'length' => 232, 'tdp' => 75, 'image' => 'imageI.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'name' => 'NVIDIA GeForce RTX 3070', 'architecture' => 'Ampere', 'memory' => 8, 'price' => 499.99, 'base_price' => 499.99, 'cooling_solution' => 2, 'color' => 'Black', 'length' => 242, 'tdp' => 220, 'image' => 'imageJ.jpg', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

        DB::table('motherboards')->insert([
            ['id' => 2, 'name' => 'ASUS ROG Strix Z590-E', 'socket' => 'LGA1200', 'form_factor' => 'ATX', 'ram_slots' => 4, 'max_memory' => 128, 'image' => 'imageB.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'Gigabyte B550 AORUS Elite', 'socket' => 'AM4', 'form_factor' => 'ATX', 'ram_slots' => 4, 'max_memory' => 128, 'image' => 'imageC.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'MSI MPG B550 Gaming Edge WiFi', 'socket' => 'AM4', 'form_factor' => 'ATX', 'ram_slots' => 4, 'max_memory' => 128, 'image' => 'imageD.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'ASUS TUF Gaming X570-Plus', 'socket' => 'AM4', 'form_factor' => 'ATX', 'ram_slots' => 4, 'max_memory' => 128, 'image' => 'imageE.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'name' => 'Gigabyte Z490 AORUS Master', 'socket' => 'LGA1200', 'form_factor' => 'ATX', 'ram_slots' => 4, 'max_memory' => 128, 'image' => 'imageF.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'name' => 'MSI MAG B550M Mortar', 'socket' => 'AM4', 'form_factor' => 'mATX', 'ram_slots' => 4, 'max_memory' => 64, 'image' => 'imageG.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'name' => 'ASRock B450M Pro4', 'socket' => 'AM4', 'form_factor' => 'mATX', 'ram_slots' => 4, 'max_memory' => 64, 'image' => 'imageH.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'name' => 'ASUS ROG Crosshair VIII Hero', 'socket' => 'AM4', 'form_factor' => 'ATX', 'ram_slots' => 4, 'max_memory' => 128, 'image' => 'imageI.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'name' => 'Gigabyte Z590 Vision G', 'socket' => 'LGA1200', 'form_factor' => 'ATX', 'ram_slots' => 4, 'max_memory' => 128, 'image' => 'imageJ.jpg', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

        DB::table('power_supplies')->insert([
            ['id' => 1, 'name' => 'Corsair RM750', 'wattage' => 750, 'efficiency_rating' => '80+ Gold', 'modularity' => 'Fully Modular', 'color' => 'Black', 'image' => 'imageA.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'name' => 'EVGA SuperNOVA 650 G5', 'wattage' => 650, 'efficiency_rating' => '80+ Gold', 'modularity' => 'Fully Modular', 'color' => 'Black', 'image' => 'imageB.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'Thermaltake Toughpower GF1 750W', 'wattage' => 750, 'efficiency_rating' => '80+ Gold', 'modularity' => 'Fully Modular', 'color' => 'Black', 'image' => 'imageC.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'Seasonic Focus GX-650', 'wattage' => 650, 'efficiency_rating' => '80+ Gold', 'modularity' => 'Fully Modular', 'color' => 'Black', 'image' => 'imageD.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'Cooler Master MWE Gold 650', 'wattage' => 650, 'efficiency_rating' => '80+ Gold', 'modularity' => 'Fully Modular', 'color' => 'Black', 'image' => 'imageE.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'name' => 'be quiet! Straight Power 11 750W', 'wattage' => 750, 'efficiency_rating' => '80+ Platinum', 'modularity' => 'Fully Modular', 'color' => 'Black', 'image' => 'imageF.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'name' => 'Corsair CX750M', 'wattage' => 750, 'efficiency_rating' => '80+ Bronze', 'modularity' => 'Semi Modular', 'color' => 'Black', 'image' => 'imageG.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'name' => 'Cooler Master MasterWatt 650', 'wattage' => 650, 'efficiency_rating' => '80+ Bronze', 'modularity' => 'Non-Modular', 'color' => 'Black', 'image' => 'imageH.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'name' => 'Thermaltake Smart RGB 700W', 'wattage' => 700, 'efficiency_rating' => '80+ Bronze', 'modularity' => 'Non-Modular', 'color' => 'Black', 'image' => 'imageI.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'name' => 'Corsair VS650', 'wattage' => 650, 'efficiency_rating' => '80+ White', 'modularity' => 'Non-Modular', 'color' => 'Black', 'image' => 'imageJ.jpg', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

        DB::table('rams')->insert([
            ['id' => 1, 'name' => 'Corsair Vengeance LPX 16GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 16, 'price' => 79.99, 'image' => 'imageA.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'name' => 'G.Skill Ripjaws V 16GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 16, 'price' => 89.99, 'image' => 'imageB.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'Kingston HyperX Fury 16GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 16, 'price' => 79.99, 'image' => 'imageC.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'Corsair Vengeance LPX 32GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 32, 'price' => 149.99, 'image' => 'imageD.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'G.Skill Trident Z RGB 32GB', 'type' => 'DDR4', 'speed' => 3600, 'capacity' => 32, 'price' => 179.99, 'image' => 'imageE.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'name' => 'Corsair Dominator Platinum 32GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 32, 'price' => 249.99, 'image' => 'imageF.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'name' => 'G.Skill Ripjaws V 32GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 32, 'price' => 139.99, 'image' => 'imageG.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'name' => 'Corsair Vengeance LPX 8GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 8, 'price' => 49.99, 'image' => 'imageH.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'name' => 'HyperX Fury 8GB', 'type' => 'DDR4', 'speed' => 3200, 'capacity' => 8, 'price' => 59.99, 'image' => 'imageI.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'name' => 'G.Skill Trident Z Neo 32GB', 'type' => 'DDR4', 'speed' => 3600, 'capacity' => 32, 'price' => 189.99, 'image' => 'imageJ.jpg', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

        DB::table('storages')->insert([
            ['id' => 1, 'name' => 'Samsung 970 EVO Plus 1TB', 'type' => 'SSD', 'capacity' => 1, 'price' => 149.99, 'read_speed' => 3500, 'write_speed' => 3300, 'image' => 'imageA.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'name' => 'Western Digital Blue 1TB', 'type' => 'HDD', 'capacity' => 1, 'price' => 49.99, 'read_speed' => 150, 'write_speed' => 150, 'image' => 'imageB.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'Crucial P5 1TB', 'type' => 'SSD', 'capacity' => 1, 'price' => 109.99, 'read_speed' => 3400, 'write_speed' => 3000, 'image' => 'imageC.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'Seagate Barracuda 2TB', 'type' => 'HDD', 'capacity' => 2, 'price' => 69.99, 'read_speed' => 150, 'write_speed' => 150, 'image' => 'imageD.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'Samsung 860 EVO 1TB', 'type' => 'SSD', 'capacity' => 1, 'price' => 89.99, 'read_speed' => 550, 'write_speed' => 520, 'image' => 'imageE.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'name' => 'Western Digital Black 2TB', 'type' => 'HDD', 'capacity' => 2, 'price' => 99.99, 'read_speed' => 150, 'write_speed' => 150, 'image' => 'imageF.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'name' => 'Crucial MX500 2TB', 'type' => 'SSD', 'capacity' => 2, 'price' => 199.99, 'read_speed' => 560, 'write_speed' => 510, 'image' => 'imageG.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'name' => 'Seagate FireCuda 2TB', 'type' => 'SSD', 'capacity' => 2, 'price' => 199.99, 'read_speed' => 5400, 'write_speed' => 5200, 'image' => 'imageH.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'name' => 'Samsung 970 EVO 2TB', 'type' => 'SSD', 'capacity' => 2, 'price' => 299.99, 'read_speed' => 3500, 'write_speed' => 3300, 'image' => 'imageI.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'name' => 'Western Digital Gold 2TB', 'type' => 'HDD', 'capacity' => 2, 'price' => 109.99, 'read_speed' => 150, 'write_speed' => 150, 'image' => 'imageJ.jpg', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

    }
}
