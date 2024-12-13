<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Controllers;

use Core\ShoppingCart\Application\AddProductToCartUseCase;
use Core\ShoppingCart\Infrastructure\Laravel\Requests\AddProductToCartRequest;
use Core\ShoppingCart\Infrastructure\Laravel\Responses\AddProductToCartResponse;

class AddProductToCartController extends Controller
{
    public function __construct(
        private readonly AddProductToCartUseCase $addProductToCart
    ){}

    public function __invoke(AddProductToCartRequest $request): AddProductToCartResponse
    {
        $product = $this->addProductToCart->__invoke(
            $request->integer('cartId'),
            $request->integer('productId'),
            $request->integer('quantity'),
        );
        return new AddProductToCartResponse($product);
    }
}
