<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Laravel Dashboard') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex h-screen bg-gray-100 font-sans">

    <aside x-data="{ open: true }" class="flex flex-col bg-white shadow-lg transition-width duration-200"
        :class="open ? 'w-64' : 'w-16'">
        <div class="flex items-center justify-between p-4">
            <span class="text-xl font-semibold text-gray-800" x-show="open">{{ config('app.name', 'App') }}</span>
            <button @click="open = !open" class="text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-2 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
                hover:bg-blue-100 hover:text-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                </svg>
                <span x-show="open">Dashboard</span>
            </a>

            <a href="{{ route('products.index') }}"
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
                hover:bg-blue-100 hover:text-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4a2 2 0 001-1.73z" />
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                    <line x1="12" y1="22.08" x2="12" y2="12" />
                </svg>

                <span x-show="open">Products</span>
            </a>

            <a href={{ route('users.index') }}
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
                hover:bg-blue-100 hover:text-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>

                <span x-show="open">User Management</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="flex items-center justify-between bg-white shadow px-6 py-4">
            <h2 class="text-2xl font-semibold text-gray-800">
                {{-- @yield('title', 'Dashboard') --}}
            </h2>
            <div class="flex items-center space-x-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center text-gray-600 focus:outline-none">
                        <span class="mr-2">{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (performance.getEntriesByType("navigation")[0]?.type === "back_forward") {
                return;
            }
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: "3000"
            };

            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if (session('info'))
                toastr.info("{{ session('info') }}");
            @endif

            @if (session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
        });
    </script>
</body>

</html>
