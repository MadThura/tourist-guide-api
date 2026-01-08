<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function savedPlaces()
    {
        return $this->belongsToMany(Place::class)->withTimestamps();
    }

    public function isSaved($place)
    {
        return $this->savedPlaces->contains('id', $place->id);
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
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        if ($role = $filters['role'] ?? null) {
            $query->where('role', $role);
        }

        if ($status = $filters['status'] ?? null) {
            if ($status === 'active') {
                $query->where('is_active', true);
            } else {
                $query->where('is_active', false);
            }
        }


        return $query;
    }
}
