<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased bg-gray-50">

    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100 min-h-screen">
            <!-- Navbar -->
           <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold">@yield('page-title')</h1>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Logged in as: {{ auth()->user()->name }}</span>
                    
                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </header>


            <!-- Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
