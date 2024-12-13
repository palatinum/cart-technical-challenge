<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Eloquent;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'shopping_cart_products';

    protected $fillable = ['cart_id', 'product_id', 'quantity'];
}
