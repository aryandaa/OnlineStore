<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_page_lists_seeded_products(): void
    {
        $this->seed();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertSee('Game');
        $response->assertSee('Safe');
        $response->assertSee('Submarine');
    }

    public function test_admin_can_open_product_panel(): void
    {
        $this->seed();
        $admin = User::where('email', 'admin@onlinestore.test')->firstOrFail();

        $response = $this->actingAs($admin)->get(route('admin.product.index'));

        $response->assertOk();
        $response->assertSee('Manage Products');
    }

    public function test_client_can_purchase_cart_products(): void
    {
        $this->seed();
        $client = User::where('email', 'client@onlinestore.test')->firstOrFail();
        $product = Product::where('name', 'Game')->firstOrFail();

        $response = $this
            ->actingAs($client)
            ->withSession([
                'products' => [
                    $product->getId() => 2,
                ],
            ])
            ->get(route('cart.purchase'));

        $response->assertOk();
        $response->assertSee('Congratulations, purchase completed');

        $this->assertDatabaseHas('orders', [
            'user_id' => $client->getId(),
            'total' => $product->getPrice() * 2,
        ]);

        $this->assertSame(1, Order::count());
    }
}
