<?php

namespace Tests\Feature\E2E;

use Core\ShoppingCart\Infrastructure\Laravel\Eloquent\Cart;
use Core\ShoppingCart\Infrastructure\Laravel\Eloquent\CartProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCartProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGivenCorrectRequestShouldReturnSuccessResponse () {
        $quantity = 4;
        $newQuantity = 3;
        $productId = 2463;
        $cart = Cart::create(['quantity' => $quantity]);
        $cartProduct = CartProduct::create([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);

        $response = $this->putJson("/api/v1/cart/products/update/$cartProduct->id", [
            'quantity' => $newQuantity,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                "id" => $cartProduct->id,
                "cartId" => $cartProduct->cart_id,
                "productId" => $cartProduct->product_id,
                "quantity" => $newQuantity,
            ]);
    }

    public function testGivenNoExistsCartShouldReturnBadRequest () {
        $quantity = 4;
        $response = $this->putJson("/api/v1/cart/products/update/11111", [
            'quantity' => $quantity,
        ]);
        $response->assertStatus(422)
            ->assertJson([
                "errors" => [
                    "cartProductId" => [
                        "The selected cart product id is invalid."
                    ]
                ]
            ]);
    }

    public function testGivenWithoutQuantityRequestShouldReturnBadRequest () {
        $quantity = 4;
        $productId = 2463;
        $cart = Cart::create(['quantity' => $quantity]);
        $cartProduct = CartProduct::create([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);

        $response = $this->putJson("/api/v1/cart/products/update/$cartProduct->id");
        $response->assertStatus(422)
            ->assertJson([
                "errors" => [
                    "quantity" => [
                        "The quantity field is required."
                    ]
                ]
            ]);
    }
}
