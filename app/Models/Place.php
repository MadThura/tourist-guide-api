<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'latitude', 'longitude', 'category_id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function savedUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public static function scopeFilter($query, $filters = [])
    {
        if ($search = $filters['search'] ?? null) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        if ($category = $filters['category'] ?? null) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        if ($filters['sortBy_rating'] && $filters['sortBy_rating'] === 'desc') {
            $query->withCount([
                'reviews as good_reviews_count' => function ($q) {
                    $q->where('rating', 'good');
                },
            ])->orderBy('good_reviews_count', 'desc');
        }

        if ($filters['sortBy_rating'] && $filters['sortBy_rating'] === 'asc') {
            $query->withCount([
                'reviews as good_reviews_count' => function ($q) {
                    $q->where('rating', 'good');
                },
            ])->orderBy('good_reviews_count', 'asc');
        }

        return $query;
    }
}
