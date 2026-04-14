<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Management (Admin Only)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b p-4">Name</th>
                            <th class="border-b p-4">Email</th>
                            <th class="border-b p-4">Role</th>
                            <th class="border-b p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="border-b p-4">{{ $user->name }}</td>
                            <td class="border-b p-4">{{ $user->email }}</td>
                            <td class="border-b p-4">
                                <span class="uppercase text-xs font-bold px-2 py-1 rounded {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="border-b p-4">
                                <a href="#" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
