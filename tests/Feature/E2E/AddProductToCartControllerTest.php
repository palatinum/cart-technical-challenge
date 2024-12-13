<?php

namespace Tests\Feature\E2E;

use Core\ShoppingCart\Domain\Entities\CartProduct;
use Core\ShoppingCart\Infrastructure\Laravel\Eloquent\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddProductToCartControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGivenCorrectRequestShouldReturnSuccessResponse () {
        $cart = Cart::create(['quantity' => 0]);
        $quantity = 4;
        $productId = 2463;
        $cartProduct = new CartProduct(1, $cart->id, $productId, $quantity);

        $response = $this->postJson("/api/v1/cart/$cart->id/add/$productId", [
            'quantity' => $quantity,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                "id" => $cartProduct->id(),
                "cartId" => $cartProduct->cartId(),
                "productId" => $cartProduct->productId(),
                "quantity" => $cartProduct->quantity(),
            ]);
    }

    public function testGivenNoExistsCartShouldReturnBadRequest () {
        $quantity = 4;
        $productId = 2463;
        $response = $this->postJson("/api/v1/cart/xxxx/add/$productId", [
            'quantity' => $quantity,
        ]);
        $response->assertStatus(422)
            ->assertJson([
                "errors" => [
                    "cartId" => [
                        "The cart id field must be an integer."
                    ]
                ]
            ]);
    }

    public function testGivenWithoutQuantityRequestShouldReturnBadRequest () {
        $cart = Cart::create(['quantity' => 0]);
        $productId = 2463;

        $response = $this->postJson("/api/v1/cart/$cart->id/add/$productId");
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
