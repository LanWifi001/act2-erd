<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b p-4">Order ID</th>
                            <th class="border-b p-4">Customer User (Rel.)</th>
                            <th class="border-b p-4">Products (Rel.)</th>
                            <th class="border-b p-4">Status</th>
                            <th class="border-b p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="border-b p-4">#{{ $order->id }}</td>
                            <!-- Displaying Eager Loaded Customer -> User Relationship -->
                            <td class="border-b p-4">{{ $order->customer->user->name ?? 'Unknown' }}</td>
                            <!-- Displaying Eager Loaded Products list -->
                            <td class="border-b p-4">
                                @foreach($order->products as $product)
                                    <span class="bg-gray-100 text-xs px-2 py-1 rounded">{{ $product->name }}</span>
                                @endforeach
                            </td>
                            <td class="border-b p-4">
                                <span class="capitalize px-2 py-1 rounded {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="border-b p-4">
                                
                                {{-- REQUIREMENT: HIDE RESTRICTED ACTIONS BASED ON ROLE --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="#" class="text-blue-600 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">View Only</span>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>