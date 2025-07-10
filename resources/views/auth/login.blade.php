<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 to-white flex items-center justify-center">
    <div class="w-full max-w-sm p-8 bg-white rounded-2xl shadow-lg">
        <div class="flex justify-center mb-6">
            {{-- <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 w-auto" /> --}}
        </div>
        <h1 class="text-center text-3xl font-bold text-gray-900 mb-4">Welcome Back</h1>

        <div id="login-error" class="mb-4 hidden text-sm text-red-600 bg-red-100 p-3 rounded"></div>
        <div id="login-success" class="mb-4 hidden text-sm text-green-600 bg-green-100 p-3 rounded"></div>

        <form id="ajax-login-form" class="space-y-5">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" required autofocus
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:border-indigo-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:border-indigo-500">
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                    <span class="ml-2 text-gray-700">Remember me</span>
                </label>
                <a href="{{ route('password.forgot') }}" class="text-sm text-indigo-600 hover:underline">Forgot
                    password?</a>
            </div>
            <button type="submit"
                id="login-button"
                class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                Sign In
            </button>
        </form>
    </div>

    <script>
        const buttonForm = document.getElementById('login-button');
        const loginForm = document.getElementById('ajax-login-form');
        const errorBox = document.getElementById('login-error');
        const successBox = document.getElementById('login-success');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            buttonFormTxt = buttonForm.innerText;
            buttonForm.innerText = 'Processing...';
            buttonForm.classList.add('cursor-not-allowed');
            buttonForm.disabled = true;
            errorBox.classList.add('hidden');
            successBox.classList.add('hidden');

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;

            fetch('/sanctum/csrf-cookie', {
                credentials: 'include'
            }).then(() => {
                return fetch('/login/ajax', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        remember: remember
                    })
                });
            }).then(async response => {
                const data = await response.json();

                if (response.ok) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 100);
                    // successBox.classList.remove('hidden');
                    // successBox.innerText = data.message || 'Login berhasil';
                } else {
                    throw new Error(data.message || 'Login gagal');
                }
            }).catch(err => {
                errorBox.innerText = err.message;
                errorBox.classList.remove('hidden');
            }).finally(() => {
                buttonForm.innerText = buttonFormTxt;
                buttonForm.disabled = false;
                buttonForm.classList.remove('cursor-not-allowed');
            });
        });
    </script>
</body>

</html>
