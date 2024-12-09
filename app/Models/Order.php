<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'total_price',
        'order_date',
    ];

    // Relasi: satu pesanan memiliki banyak item pesanan
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Model Order
    public function menu()
    {
         return $this->belongsTo(Menu::class);
    }


}
    