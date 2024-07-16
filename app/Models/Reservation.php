<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primaryKey = 'reservation_id';
    protected $fillable = [
        'vehicle_id',
        'admin_id',
        'driver_name',
        'destination',
        'start_date',
        'end_date',
    ];
    use HasFactory;
}
