<?php

namespace Tests\Feature\E2E;

use Core\ShoppingCart\Infrastructure\Laravel\Eloquent\Cart;
use Core\ShoppingCart\Infrastructure\Laravel\Eloquent\CartProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemoveCartProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGivenCorrectRequestShouldReturnSuccessResponse () {
        $quantity = 4;
        $cart = Cart::create(['quantity' => $quantity]);
        $productId = 2463;
        $cartProduct = CartProduct::create([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
        $response = $this->deleteJson("/api/v1/cart/products/remove/$cartProduct->id");
        $response->assertStatus(200)
            ->assertJson([
                "id" => $cartProduct->id,
                "cartId" => $cartProduct->cart_id,
                "productId" => $cartProduct->product_id,
                "quantity" => $cartProduct->quantity,
            ]);
    }

    public function testGivenNoExistsCartProductShouldReturnBadRequest () {
        $response = $this->deleteJson("/api/v1/cart/products/remove/11111");
        $response->assertStatus(422)
            ->assertJson([
                "errors" => [
                    "cartProductId" => [
                        "The selected cart product id is invalid."
                    ]
                ]
            ]);
    }
}
