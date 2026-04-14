<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b p-4">Name</th>
                            <th class="border-b p-4">Price</th>
                            <th class="border-b p-4">In X Orders (Rel.)</th>
                            <th class="border-b p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="border-b p-4">{{ $product->name }}</td>
                            <td class="border-b p-4">${{ number_format($product->price, 2) }}</td>
                            <!-- Displaying Eager Loaded Orders -->
                            <td class="border-b p-4">{{ $product->orders->count() }} orders</td>
                            <td class="border-b p-4">
                                
                                {{-- REQUIREMENT: HIDE RESTRICTED ACTIONS BASED ON ROLE --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="#" class="text-blue-600 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
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