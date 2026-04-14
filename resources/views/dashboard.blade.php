<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 text-lg">
                    Welcome back, <strong>{{ auth()->user()->name }}</strong>! 
                    <span class="ml-2 text-sm px-2 py-1 bg-gray-200 rounded uppercase font-bold text-gray-700">
                        Role: {{ auth()->user()->role }}
                    </span>
                </div>
            </div>

            <!-- Navigation Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Customers -->
                <a href="{{ route('customers.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition border-l-4 border-blue-500 block">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Customers</h3>
                    <p class="text-gray-600">View and manage customer profiles.</p>
                </a>

                <!-- Products -->
                <a href="{{ route('products.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition border-l-4 border-green-500 block">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Products</h3>
                    <p class="text-gray-600">Browse and manage your product catalog.</p>
                </a>

                <!-- Orders -->
                <a href="{{ route('orders.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition border-l-4 border-yellow-500 block">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Orders</h3>
                    <p class="text-gray-600">Track and manage customer orders.</p>
                </a>

                <!-- Users (Admin Only) -->
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition border-l-4 border-purple-500 block">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">User Management</h3>
                        <p class="text-gray-600">Admin area to manage system users.</p>
                    </a>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>