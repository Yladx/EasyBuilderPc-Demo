<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    use HasFactory;

    protected $table = 'builds'; // Specify the table name

    protected $fillable = [
        'user_id',
        'build_name',
        'build_note',
        'tag',
        'cpu_id', // Include the foreign keys for the relationships
        'gpu_id',
        'motherboard_id',
        'ram_id',
        'storage_id',
        'power_supply_id',
        'case_id',
        'accessories',
        'published',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // User relationship
    }

    public function cpu()
    {
        return $this->belongsTo(Cpu::class, 'cpu_id'); // CPU relationship
    }

    public function gpu()
    {
        return $this->belongsTo(Gpu::class, 'gpu_id'); // GPU relationship
    }

    public function motherboard()
    {
        return $this->belongsTo(Motherboard::class, 'motherboard_id'); // Motherboard relationship
    }


    public function ram()
    {
        return $this->belongsTo(Ram::class, 'ram_id'); // RAM relationship
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id'); // Storage relationship
    }

    public function powerSupply()
    {
        return $this->belongsTo(PowerSupply::class, 'power_supply_id'); // Power Supply relationship
    }

    public function pcCase()
    {
        return $this->belongsTo(ComputerCase::class, 'case_id'); // Updated relationship
    }

    public function ratings()
    {
        return $this->hasMany(Rate::class, 'build_id'); // Assuming 'build_id' is the foreign key in the 'rates' table
    }

}
