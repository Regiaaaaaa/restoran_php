<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
    ];

    // Relasi: satu kategori memiliki banyak menu
    public function menuItems()
    {
        return $this->hasMany(Menu::class);
    }
}
