<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 to-white flex items-center justify-center">
    <div class="w-full max-w-sm p-8 bg-white rounded-2xl shadow-lg">
        <h1 class="text-center text-3xl font-bold text-gray-900 mb-2">Forgot Password</h1>
        <p class="text-center text-sm text-gray-600 mb-6">Enter your email to receive a reset link.</p>
        @if (session('status'))
            <div class="mb-4 text-sm text-green-700 bg-green-100 p-3 rounded">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->has('email'))
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded">
                {{ $errors->first('email') }}
            </div>
        @endif
        <form action="" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:border-indigo-500">
            </div>
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                Send Reset Link
            </button>
        </form>
        <p class="mt-6 text-center text-sm">
            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Back to login</a>
        </p>
    </div>
</body>

</html>
