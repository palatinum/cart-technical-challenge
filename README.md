# Shopping Cart System

Este repositorio contiene un sistema de carrito de compras modular, organizado según los principios de **Arquitectura Hexagonal** y **DDD (Diseño Dirigido por el Dominio)**. Es altamente escalable y fácil de mantener, con un enfoque en la separación de responsabilidades y la reutilización de código.

## 🚀 Características

- **Carrito de compra**: Gestor robusto de carritos de compra con operaciones para añadir, actualizar, vaciar y eliminar productos.
- **Dominio desacoplado**: Diseñado en torno a principios de DDD para garantizar que el código del dominio sea independiente de los frameworks.
- **Contextos básicos**:
    - **ShoppingCart**: Gestor del carrito y sus productos.
    - **Order**: Creación de pedidos a partir del carrito.
    - **Shared**: Componentes y servicios compartidos entre contextos.
- **Casos de uso bien definidos**: Cada acción principal está modelada como un caso de uso para mantener un código limpio y simple.

---

## 🔧 Tecnologías utilizadas

- **PHP** (versión 8.2).
- **Laravel** como framework de infraestructura.
- **MySQL** como base de datos predeterminada (aunque el sistema soporta otros DBMS gracias al desacoplamiento).
- **PHPUnit** para las pruebas unitarias y de integración.

---

## 🔒 Entidades principales

### Cart
- Representa el carrito de compra.
- Contiene los productos seleccionados por el cliente.
- Atributos principales:
    - `id`: Identificador único.
    - `quantity`: Cantidad total de productos en el carrito.
    - Relaciones:
        - **HasMany** con `CartProduct`.

### CartProduct
- Representa un producto individual en el carrito.
- Atributos principales:
    - `id`: Identificador único.
    - `cart_id`: Identificador del carrito asociado.
    - `product_id`: Identificador del producto.
    - `quantity`: Cantidad del producto en el carrito.

---

## 📊 Contextos

### **ShoppingCart**
Este contexto gestiona la lógica relacionada con el carrito de compra. Incluye los siguientes casos de uso:

- **AddProductToCartUseCase**: Agregar un producto al carrito.
- **CreateCartUseCase**: Crear un nuevo carrito.
- **EmptyCartUseCase**: Vaciar todos los productos del carrito.
- **RemoveProductFromCartUseCase**: Eliminar un producto específico del carrito.
- **UpdateCartProductUseCase**: Actualizar la cantidad de un producto en el carrito.

### **Order**
Este contexto se centra en la creación de pedidos a partir de carritos confirmados. Incluye:

- **CreateOrderFromCartUseCase**: Generar un pedido basado en un carrito existente.

### **Shared**
Este contexto proporciona componentes y servicios compartidos entre los contextos `ShoppingCart` y `Order`. Ejemplo: DTOs, validaciones comunes y servicios auxiliares.

---

## 🔍 Estructura del proyecto

El proyecto sigue una estructura modular:

```
src/
|-- Core/
|   |-- ShoppingCart/
|   |   |-- Application/
|   |   |   |-- AddProductToCartUseCase
|   |   |   |-- CreateCartUseCase
|   |   |   |-- EmptyCartUseCase
|   |   |   |-- RemoveProductFromCartUseCase
|   |   |   |-- UpdateCartProductUseCase
|   |   |-- Domain/
|   |   |   |-- Entities
|   |   |   |   |-- Cart
|   |   |   |   |-- CartProduct
|   |   |   |-- Repositories
|   |   |       |-- CartProductRepositoryContract
|   |   |       |-- CartRepositoryContract
|   |   |-- Infrastructure/
|   |       |-- Laravel/
|   |           |-- Controllers/
|   |           |   |-- AddProductToCartController
|   |           |   |-- CreateCartController
|   |           |   |-- RemoveCartProductController
|   |           |   |-- UpdateCartProductController
|   |           |-- Eloquent/
|   |           |   |-- Cart
|   |           |   |-- CartProduct
|   |           |-- Provides/
|   |           |-- Repositories/
|   |           |   |-- CartProductRepositoryEloquent
|   |           |   |-- CartRepositoryEloquent
|   |           |-- Requests/
|   |           |-- Responses/
|   |-- Order/
|   |   |-- Application/
|   |       |-- CreateOrderFromCartUseCase
|   |   |-- Domain/
|   |       |-- Entities/
|   |           |-- Order
|-- Shared/
    |-- Responses/
    |-- Infrastructure/
        |-- Controllers/
            |-- ConfirmCartPurchaseController/
```

---

## 🌎 API Endpoints

Colección de Postman [ShoppingCart.postman_collection.json](./docs/ShoppingCart.postman_collection.json "cart-technical-challenge").


### Crear un carrito
**POST** `/api/v1/cart`

#### Request:
```json
{}
```
#### Response:
```json
{
    "id": 1,
    "quantity": 0
}
```

### Añadir un producto al carrito
**POST** `/api/v1/cart/{cartId}/add/{productId}`

#### Request:
```json
{
    "quantity": 3
}
```
#### Response:
```json
{
    "id": 1,
    "cartId": 1,
    "productId": 2463,
    "quantity": 3
}
```

### Actualizar un producto del carrito
**PUT** `/api/v1/cart/products/update/{cartProductId}`

#### Request:
```json
{
    "quantity": 3
}
```
#### Response:
```json
{
    "id": 1,
    "cartId": 1,
    "productId": 2463,
    "quantity": 3
}
```

### Eliminar un producto del carrito
**DELETE** `/api/v1/cart/products/remove/{cartProductId}`

#### Response:
```json
{
    "id": 1,
    "cartId": 1,
    "productId": 2463,
    "quantity": 3
}
```

### Confirmar compra del carrito
**GET** `/api/v1/cart/{cartId}/confirm`

#### Response:
```json
{
    "cartId": 1,
    "quantity": 3
}
```



---

## 🌐 Configuración del entorno

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/palatinum/cart-technical-challenge.git
   ```
2. Crear el .env:
   ```bash
   cd cart-technical-challenge/
   cp .env.example .env
   ```
3. Ejecutar docker:
   ```bash
   docker compose up -d
   ```

4. Ejecutar la instalacion de dependencias:
   ```bash
   docker exec -it challenge-app composer install
   ```
   
5. Ejecutar las migraciones:
   ```bash
   docker exec -it challenge-app php artisan migrate
   ```

---

## 📊 Pruebas

Ejecuta las pruebas utilizando PHPUnit:

```bash
docker exec -it challenge-app vendor/bin/phpunit
```

---
