<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $table = 'shopping_carts';

    protected $fillable = ['quantity'];

    public function cartProducts(): HasMany
    {
        return $this->hasMany(CartProduct::class, 'cart_id');
    }

    public function updateQuantity()
    {
        $quantity = $this->cartProducts()->sum('quantity');
        $this->update(['quantity' => $quantity]);
        return $quantity;
    }

    public function empty(): void
    {
        $this->cartProducts()->delete();
    }
}
