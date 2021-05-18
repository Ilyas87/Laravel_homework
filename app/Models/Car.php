<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'year',
        'engine',
        'transmission',
        'mileage',
        'image'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function followers() {
        return $this->belongsToMany(User::class, Favorite::class);
    }

    function likers(){
        return $this->belongsToMany(User::class, Like::class);
    }

    function deleteImage() {
        if (!$this->image)
            return;

        $path = storage_path('app/' . $this->image);

        if (file_exists($path))
            unlink($path);
    }

    function carImage(){
        $imagePath = $this->image ? $this->image : 'images/defaultImage.jpg';
        return $imagePath;
    }
}
