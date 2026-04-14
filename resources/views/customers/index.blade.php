<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b p-4">ID</th>
                            <th class="border-b p-4">Account Name (User Rel.)</th>
                            <th class="border-b p-4">Phone</th>
                            <th class="border-b p-4">Total Orders (Rel.)</th>
                            <th class="border-b p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td class="border-b p-4">{{ $customer->id }}</td>
                            <!-- Displaying Eager Loaded User Relationship -->
                            <td class="border-b p-4">{{ $customer->user->name ?? 'N/A' }}</td>
                            <td class="border-b p-4">{{ $customer->phone }}</td>
                            <!-- Displaying Eager Loaded Orders Count -->
                            <td class="border-b p-4">{{ $customer->orders->count() }}</td>
                            <td class="border-b p-4">
                                
                                {{-- REQUIREMENT: HIDE RESTRICTED ACTIONS BASED ON ROLE --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="#" class="text-blue-600 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline">
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
