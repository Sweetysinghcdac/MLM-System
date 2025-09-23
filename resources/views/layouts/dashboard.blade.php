<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <div class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</div>
            <div>
                <!-- Add your user menu / logout etc here -->
                <span class="text-gray-600">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-lg flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-blue-500">My Dashboard</div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                    Home
                </a>
                <a href="{{ route('transactions.create') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                    Create Transaction
                </a>
                <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                    Transactions
                </a>
                <a href="{{ route('payouts.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                    Payouts
                </a>
                <a href="{{ route('tree') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                    Referral Tree
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
