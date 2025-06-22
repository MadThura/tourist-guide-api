<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['place_id', 'path'];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
