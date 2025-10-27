<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'specialization',
        'bio',
        'hourly_rate',
        'avatar',
        'profile_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'hourly_rate' => 'decimal:2',
        'profile_completed' => 'boolean',
    ];

    public function clientRepairs()
    {
        return $this->hasMany(RepairRequest::class, 'client_id');
    }

    public function assignedRepairs()
    {
        return $this->hasMany(RepairRequest::class, 'master_id');
    }

    public function givenReviews()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'master_id');
    }

    public function reviews()
    {
        return $this->receivedReviews();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return null;
    }

    public function masterRepairs()
    {
        return $this->hasMany(RepairRequest::class, 'master_id');
    }
}
