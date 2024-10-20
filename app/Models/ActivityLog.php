<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ActivityLog extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'activity_logs'; // Assuming this is the table name

    protected $fillable = ['user_id', 'activity_timestamp', 'activity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

