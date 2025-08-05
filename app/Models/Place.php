<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'location', 'latitude', 'longitude', 'image', 'category_id'];

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
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            });
        }
        if ($category = $filters['category'] ?? null) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('id', $category);
            });
        }

        if (($filters['sort'] ?? null) === 'latest') {
            $query->latest();
        }

        if (($filters['sortBy_rating'] ?? null) === 'desc') {
            $query->withCount([
                'reviews as good_reviews_count' => function ($q) {
                    $q->where('rating', 'good');
                },
            ])->orderBy('good_reviews_count', 'desc');
        }

        if (($filters['sortBy_rating'] ?? null) === 'asc') {
            $query->withCount([
                'reviews as good_reviews_count' => function ($q) {
                    $q->where('rating', 'good');
                },
            ])->orderBy('good_reviews_count', 'asc');
        }

        return $query;
    }
}
