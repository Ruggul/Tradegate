<?php

namespace App\Models\UserCartManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock'];

    // Relasi ke CartItem
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
