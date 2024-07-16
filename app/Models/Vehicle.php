<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $primaryKey  = 'vehicle_id';
    protected $fillable = [
        'vehicle_name',
        'vehicle_type',
    ];
    use HasFactory;
}
