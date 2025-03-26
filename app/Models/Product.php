<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products'; // Pastikan nama tabel benar

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'stock',
    ];

    public function transactions()
    {
        return $this->belongsTo(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
