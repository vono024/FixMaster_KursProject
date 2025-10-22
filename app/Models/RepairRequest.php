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
        'status',
        'scheduled_date',
        'completed_at',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function master()
    {
        return $this->belongsTo(User::class, 'master_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function canBeEditedBy(User $user)
    {
        return $this->client_id === $user->id && in_array($this->status, ['new', 'assigned']);
    }

    public function canBeDeletedBy(User $user)
    {
        return $this->client_id === $user->id && $this->status === 'new';
    }
}
