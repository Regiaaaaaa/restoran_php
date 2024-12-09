<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
        'subtotal',
    ];

    // Relasi: satu item pesanan termasuk dalam satu pesanan
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: satu item pesanan terkait dengan satu menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
