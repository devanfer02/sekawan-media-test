<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'reservation_id',
        'approver_id',
        'status',
        'comments'
    ];
    use HasFactory;
}
