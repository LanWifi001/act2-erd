<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database based on the provided migrations.
     */
    public function run(): void
    {
        // 1. Create Products
        $productsData = [
            ['name' => 'High-End Laptop', 'price' => 75000.00],
            ['name' => 'Wireless Mouse', 'price' => 1200.50],
            ['name' => 'Mechanical Keyboard', 'price' => 4500.00],
            ['name' => '27-inch Monitor', 'price' => 15000.00],
        ];

        foreach ($productsData as $item) {
            Product::updateOrCreate(['name' => $item['name']], $item);
        }

        // 2. Create a Regular User 
        // Note: Admin is not seeded here as per your request.
        $regularUser = User::updateOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // 3. Create Customer Profile for the Regular User
        $regularCustomer = Customer::updateOrCreate(
            ['user_id' => $regularUser->id],
            [
                'name' => 'John Doe (User)',
                'phone' => '09187654321'
            ]
        );

        // 4. Create a sample Order
        // Matches the 'customer_id', 'total_amount', and 'status' columns
        $order = Order::create([
            'customer_id' => $regularCustomer->id,
            'total_amount' => 76200.50,
            'status' => 'completed',
        ]);

        // 5. Attach Products to the Order (Pivot Table)
        $laptop = Product::where('name', 'High-End Laptop')->first();
        $mouse = Product::where('name', 'Wireless Mouse')->first();

        if ($laptop && $mouse) {
            // Matches the 'order_id', 'product_id', and 'quantity' columns
            $order->products()->attach([
                $laptop->id => ['quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
                $mouse->id => ['quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}