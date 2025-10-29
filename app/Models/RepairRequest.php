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
        'title',
        'description',
        'device_type',
        'device_brand',
        'device_model',
        'status',
        'priority',
        'estimated_cost',
        'final_cost',
        'scheduled_date',
        'estimated_completion_date',
        'actual_completion_date',
        'client_address',
        'photos',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'scheduled_date' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'final_cost' => 'decimal:2',
        'photos' => 'array',
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

    public function reviews()
    {
        return $this->hasMany(Review::class, 'repair_request_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'repair_request_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function canBeEditedBy($user)
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'client' && $this->client_id === $user->id) {
            return in_array($this->status, ['new', 'assigned']);
        }

        return false;
    }

    public function canBeDeletedBy($user)
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'client' && $this->client_id === $user->id) {
            return $this->status === 'new';
        }

        return false;
    }
}
