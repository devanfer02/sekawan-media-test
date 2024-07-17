<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'vehicle_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'user_id');
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(Approval::class, 'reservation_id', 'reservation_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['approver'] ?? false, function($query, $approver) {
            return $query->whereHas('approvals', function($query) use($approver) {
                return $query->where('approver_id', '=', $approver);
            });
        })->when($filters['status'] ?? false, function($query, $status) use($filters) {
            return $query->whereHas('approvals', function($query) use($status, $filters) {
                $query->where('status', '=', $status);

                if($filters['approver'])
                {
                    $query->where('approver_id', '=', auth()->user()->user_id);
                }
            });
        });
    }
}
