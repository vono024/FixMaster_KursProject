<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'master_id',
        'device_type',
        'device_brand',
        'device_model',
        'problem_description',
        'status',
        'priority',
        'estimated_cost',
        'final_cost',
        'estimated_completion_date',
        'actual_completion_date',
        'client_address',
        'photos',
        'completed_at',
    ];

    protected $casts = [
        'photos' => 'array',
        'estimated_completion_date' => 'date',
        'actual_completion_date' => 'date',
        'completed_at' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'final_cost' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function master()
    {
        return $this->belongsTo(User::class, 'master_id');
    }

    public function statuses()
    {
        return $this->hasMany(RepairStatus::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', 'assigned');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function isEditable(): bool
    {
        return in_array($this->status, ['new', 'assigned']);
    }

    public function canBeReviewed(): bool
    {
        return $this->status === 'completed' && !$this->review;
    }
}
