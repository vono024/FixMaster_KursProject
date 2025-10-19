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
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMaster(): bool
    {
        return $this->role === 'master';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function repairRequests()
    {
        if ($this->isClient()) {
            return $this->hasMany(RepairRequest::class, 'client_id');
        }
        return $this->hasMany(RepairRequest::class, 'master_id');
    }

    public function masterProfile()
    {
        return $this->hasOne(MasterProfile::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function reviews()
    {
        if ($this->isClient()) {
            return $this->hasMany(Review::class, 'client_id');
        }
        return $this->hasMany(Review::class, 'master_id');
    }

    public function statusChanges()
    {
        return $this->hasMany(RepairStatus::class, 'changed_by');
    }
}
