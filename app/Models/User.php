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
        'phone',
        'role',
        'specialization',
        'bio',
        'hourly_rate',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'blocked_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return null;
    }

    public function repairRequests()
    {
        return $this->hasMany(RepairRequest::class, 'client_id');
    }

    public function masterRepairs()
    {
        return $this->hasMany(RepairRequest::class, 'master_id');
    }

    public function assignedRepairs()
    {
        return $this->hasMany(RepairRequest::class, 'master_id');
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'master_id');
    }

    public function givenReviews()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function isBlocked()
    {
        return !is_null($this->blocked_at);
    }

    public function block()
    {
        $this->update(['blocked_at' => now()]);
    }

    public function unblock()
    {
        $this->update(['blocked_at' => null]);
    }
}
