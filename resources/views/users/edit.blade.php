@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Edit User</h1>
            <a href="{{ route('users.index') }}" class="text-blue-500 hover:underline text-sm">← Kembali ke Daftar</a>
        </div>

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="input-label">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                    class="input-field">
                @error('name')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="input-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                    class="input-field">
                @error('email')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="input-label">Password <small>(leave blank to keep current)</small></label>
                <input id="password" name="password" type="password" class="input-field">
                @error('password')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="input-label">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="input-field">
            </div>

            <div>
                <label for="role_id" class="input-label">Role</label>
                <select id="role_id" name="role_id" required class="select-field">
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $id => $name)
                        <option value="{{ $id }}" {{ old('role_id', $user->role_id) == $id ? 'selected' : '' }}>
                            {{ $name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full inline-flex justify-center py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow focus:outline-none focus:ring focus:ring-blue-200">
                    Update User
                </button>
            </div>
        </form>
    </div>
@endsection
