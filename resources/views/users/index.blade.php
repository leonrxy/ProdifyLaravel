@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">User Management</h1>
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add User
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Created
                            At</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->role->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 mx-1"
                                    title="Edit">✏️</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $user->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 mx-1"
                                        title="Delete">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
