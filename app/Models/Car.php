<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_image', // add other attributes if necessary
    ];

    protected $casts = [
        'gallery_image' => 'json',
    ];

    public function getGalleryImageAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    
}
