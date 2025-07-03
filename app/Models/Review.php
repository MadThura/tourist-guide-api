<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'place_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public static function scopeFilter($query, $filters = [])
    {
        // Combine name search from user and place using nested 'where'
        if ($search = $filters['search'] ?? null) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('place', function ($q2) use ($search) {
                    $q2->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        // Filter by rating
        if ($rating = $filters['rating'] ?? null) {
            $query->where('rating', $rating);
        }

        // Filter by status
        if ($status = $filters['status'] ?? null) {
            $query->where('status', $status);
        }

        return $query;
    }
}
