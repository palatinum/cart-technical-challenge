<?php

use Core\Shared\Infrastructure\Controllers\ConfirmCartPurchaseController;
use Core\ShoppingCart\Infrastructure\Laravel\Controllers\AddProductToCartController;
use Core\ShoppingCart\Infrastructure\Laravel\Controllers\CreateCartController;
use Core\ShoppingCart\Infrastructure\Laravel\Controllers\RemoveCartProductController;
use Core\ShoppingCart\Infrastructure\Laravel\Controllers\UpdateCartProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('cart', CreateCartController::class);
    Route::post('cart/{cartId}/add/{productId}', AddProductToCartController::class);
    Route::put('cart/products/update/{cartProductId}', UpdateCartProductController::class);
    Route::delete('cart/products/remove/{cartProductId}', RemoveCartProductController::class);
    Route::get('cart/{cartId}/confirm', ConfirmCartPurchaseController::class);
});
