<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['title', 'status', 'poster'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'table_genre_film');
    }
}
