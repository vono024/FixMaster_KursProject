<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'experience_years',
        'average_rating',
        'total_repairs',
        'total_reviews',
        'bio',
        'available',
    ];

    protected $casts = [
        'specialization' => 'array',
        'available' => 'boolean',
        'average_rating' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    public function scopeTopRated($query)
    {
        return $query->orderBy('average_rating', 'desc');
    }

    public function scopeExperienced($query, $years = 5)
    {
        return $query->where('experience_years', '>=', $years);
    }

    public function hasSpecialization($type): bool
    {
        if (!$this->specialization) {
            return false;
        }
        return in_array($type, $this->specialization);
    }

    public function updateRating($newRating): void
    {
        $totalRating = $this->average_rating * $this->total_reviews;
        $this->total_reviews++;
        $this->average_rating = ($totalRating + $newRating) / $this->total_reviews;
        $this->save();
    }

    public function incrementRepairs(): void
    {
        $this->increment('total_repairs');
    }
}
